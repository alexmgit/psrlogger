<?php
namespace Logger;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

/**
 * Class Component
 */
class Component extends AbstractLogger implements LoggerInterface
{
	/**
	 * @var Router[]
	 */
	private $_routers;

	/**
	 * @param array $routers
	 */
	public function __construct(array $routers = [])
	{
		foreach ($routers as $routerConfig)
		{
			if (!isset($routerConfig['class']))
			{
				continue;
			}
			$className = $routerConfig['class'];
			unset($routerConfig['class']);

			$this->_routers = new $className($routerConfig);
		}
	}

	/**
	 * @inheritdoc
	 */
	public function log($level, $message, array $context = [])
	{
		foreach ($this->_routers as $router)
		{
			$router->log($level, $message, $context);
		}
	}
}
