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

var_dump($logger);

$logger->debug("Debug message");