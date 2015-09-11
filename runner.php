<?php
include 'vendor/autoload.php';

$routes = new SplObjectStorage();

$routes->attach(new Logger\Routes\FileRoute([
	'enabled' => true,
	'filePath' => 'data/default.log',
]));

$routes->attach(new Logger\Routes\DatabaseRoute([
	'enabled' => true,
	'dsn' => 'sqlite:data/default.sqlite',
	'table' => 'default_log',
]));

$routes->attach(new Logger\Routes\SyslogRoute([
	'enabled' => true,
]));

$logger = new Logger\Logger($routes);

$logger->info("Info message");
$logger->alert("Alert message");
$logger->error("Error message");
$logger->debug("Debug message");
$logger->notice("Notice message");
$logger->warning("Warning message");
$logger->critical("Critical message");
$logger->emergency("Emergency message");