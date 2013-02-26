<?php

// Load Nette Framework
require __DIR__ . '/../libs/autoload.php';

$configurator = new Flame\Config\Configurator;

$configurator->registerExtension('doctrine', '\Flame\Doctrine\Config\Extension');
$configurator->registerExtension('bundles', '\Flame\Bundles\Config\Extension');
// Enable Nette Debugger for error visualisation & logging
// $configurator->setDebugMode(TRUE);
$configurator->enableDebugger(__DIR__ . '/../log');

// Enable RobotLoader - this will load all classes automatically
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->addParameters(array('appDir' => __DIR__));
$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->register();

// Create Dependency Injection container from config.neon file
$configurator->addConfig(__DIR__ . '/AppBundle/config/config.neon');
$configurator->addConfig(__DIR__ . '/UserBundle/config/config.neon');
$configurator->addConfig(__DIR__ . '/SettingBundle/config/config.neon');
$configurator->addConfig(__DIR__ . '/PostBundle/config/config.neon');
if(file_exists($configDev = __DIR__ . '/AppBundle/config/config.dev.neon'))
	$configurator->addConfig($configDev);
$container = $configurator->createContainer();

return $container;
