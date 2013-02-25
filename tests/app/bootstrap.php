<?php

include __DIR__ . '/../../libs/autoload.php';

if (!class_exists('Tester\Assert')) {
	echo "Install Nette Tester using `composer update --dev`\n";
	exit(1);
}

if (extension_loaded('xdebug')) {
	xdebug_disable();
	Tester\CodeCoverage\Collector::start(__DIR__ . '/coverage.dat');
}

function run(Tester\TestCase $testCase) {
	$testCase->run(isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : NULL);
}

// configure environment
Tester\Helpers::setup();
date_default_timezone_set('Europe/Prague');

define('APP_DIR', __DIR__ . '/../../app');
// create temporary directory
define('TEMP_DIR', __DIR__ . '/../temp/' . (isset($_SERVER['argv']) ? md5(serialize($_SERVER['argv'])) : getmypid()));
Tester\Helpers::purge(TEMP_DIR);

$_SERVER = array_intersect_key($_SERVER, array_flip(array('PHP_SELF', 'SCRIPT_NAME', 'SERVER_ADDR', 'SERVER_SOFTWARE', 'HTTP_HOST', 'DOCUMENT_ROOT', 'OS', 'argc', 'argv')));
$_SERVER['REQUEST_TIME'] = 1234567890;
$_ENV = $_GET = $_POST = array();

$logDir = __DIR__ . '/../log';
Flame\Tools\Files\FileSystem::mkDir($logDir);
\Nette\Diagnostics\Debugger::$logDirectory = $logDir;
\Nette\Diagnostics\Debugger::$productionMode = false;

$configurator = new \Flame\Config\Configurator;
$configurator->setDebugMode(FALSE);
$configurator->addParameters(array(
		'appDir' => APP_DIR,
		'wwwDir' => realpath(APP_DIR . '/../www'),
		'rootDir' => realpath(APP_DIR . '/..'))
);
$configurator->setTempDirectory(TEMP_DIR);
$configurator->createRobotLoader()
	->addDirectory(APP_DIR)
	->register();

$configurator->addConfig(APP_DIR . '/AppBundle/config/config.neon');
$configurator->addConfig(APP_DIR . '/AppBundle/config/config.dev.neon');
return $configurator->createContainer();

