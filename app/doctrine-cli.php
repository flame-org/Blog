<?php
/**
 * doctrine-cli.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package DoctrineSandbox
 *
 * @date    20.08.12
 */

use Doctrine\Common\ClassLoader;

define('WWW_DIR', __DIR__ . '/../www');
define('APP_DIR', __DIR__ . '/../app');
define('LIBS_DIR', __DIR__ . '/../libs');

require APP_DIR . '/bootstrap.php';

$classLoader = new ClassLoader('Doctrine\DBAL\Migrations', $container->expand('%entities%'));
$classLoader->register();

$entityManager = $container->getByType('Doctrine\ORM\EntityManager');

// symfony console app helpers
$helperSet = new Symfony\Component\Console\Helper\HelperSet(array(
	'db' => new Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($entityManager->getConnection()),
	'em' => new Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($entityManager),
	'dialog' => new \Symfony\Component\Console\Helper\DialogHelper(),
));

// symfony console app
$cli = new Symfony\Component\Console\Application('Doctrine Command Line Interface', Doctrine\ORM\Version::VERSION);
$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);
$cli->addCommands(array(
	// DBAL Commands
	new Doctrine\DBAL\Tools\Console\Command\RunSqlCommand(),
	new Doctrine\DBAL\Tools\Console\Command\ImportCommand(),

	// ORM Commands
	new Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand(),
	new Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand(),
	new Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand(),
	new Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand(),
	new Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand(),
	new Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand(),
	new Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand(),
	new Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand(),
	new Doctrine\ORM\Tools\Console\Command\RunDqlCommand(),
	new Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand(),
));

$cli->run();
