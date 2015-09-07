<?php
include 'vendor/autoload.php';

$logger = new Logger\Logger();

$logger->routers->attach(new Logger\Routers\FileRouter([
		'filePath' => 'data/default.log',
]));

$logger->routers->attach(new Logger\Routers\DatabaseRouter([
		'dsn'   => 'sqlite:data/default.sqlite',
		'table' => 'default_log',
]));

$logger->routers->attach(new Logger\Routers\SyslogRouter([

]));

$logger->info("Info message");
$logger->alert("Alert message");
$logger->error("Error message");
$logger->debug("Debug message");
$logger->notice("Notice message");
$logger->warning("Warning message");
$logger->critical("Critical message");
$logger->emergency("Emergency message");