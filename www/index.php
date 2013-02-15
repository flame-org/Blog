<?php

// Uncomment this line if you must temporarily take down your site for maintenance.
// require '.maintenance.php';

// Let bootstrap to create Dependency Injection container.
$container = require __DIR__ . '/../app/bootstrap.php';

// Run application.
if (!$container->parameters['consoleMode'])
	$container->application->run();
