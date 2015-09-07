<?php
namespace Logger;

use SplObjectStorage;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

/**
 * Class Logger
 */
class Logger extends AbstractLogger implements LoggerInterface
{
	/**
	 * @var SplObjectStorage Список роутов
	 */
	public $routes;

	/**
	 * Конструктор
	 */
	public function __construct()
	{
		$this->routes = new SplObjectStorage();
	}

	/**
	 * @inheritdoc
	 */
	public function log($level, $message, array $context = [])
	{
		foreach ($this->routes as $route)
		{
			if (!$route instanceof Route)
			{
				continue;
			}
			if (!$route->isEnable)
			{
				continue;
			}

			$route->log($level, $message, $context);
		}
	}
}
