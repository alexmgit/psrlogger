<?php
namespace Logger;

use Iterator;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

/**
 * Class Logger
 */
class Logger extends AbstractLogger implements LoggerInterface
{
	/**
	 * @var Iterator Список роутов
	 */
	public $routes;

	/**
	 * Конструктор
	 *
	 * @param Iterator $routes
	 */
	public function __construct(Iterator $routes)
	{
		$this->routes = $routes;
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
			if (!$route->enabled)
			{
				continue;
			}

			$route->log($level, $message, $context);
		}
	}
}
