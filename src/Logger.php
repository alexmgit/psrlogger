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
	public $routers;

	/**
	 * Конструктор
	 */
	public function __construct()
	{
		$this->routers = new SplObjectStorage();
	}

	/**
	 * @inheritdoc
	 */
	public function log($level, $message, array $context = [])
	{
		foreach ($this->routers as $router)
		{
			if (!$router instanceof Router)
			{
				continue;
			}
			if (!$router->isEnable)
			{
				continue;
			}

			$router->log($level, $message, $context);
		}
	}
}
