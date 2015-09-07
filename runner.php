<?php
include 'vendor/autoload.php';

$logger = new Logger\Logger();

$logger->routes->attach(new Logger\Routers\FileRoute([
	'isEnable'  => true,
	'filePath'  => 'data/default.log',
]));

$logger->routes->attach(new Logger\Routers\DatabaseRoute([
	'isEnable'  => true,
	'dsn'       => 'sqlite:data/default.sqlite',
	'table'     => 'default_log',
]));

$logger->routes->attach(new Logger\Routers\SyslogRoute([
	'isEnable'  => true,
]));

$logger->info("Info message");
$logger->alert("Alert message");
$logger->error("Error message");
$logger->debug("Debug message");
$logger->notice("Notice message");
$logger->warning("Warning message");
$logger->critical("Critical message");
$logger->emergency("Emergency message");