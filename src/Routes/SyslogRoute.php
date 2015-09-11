<?php
namespace Logger\Routes;

use Logger\Route;
use Psr\Log\LogLevel;

/**
 * Class SyslogRoute
 */
class SyslogRoute extends Route
{
	/**
	 * @var string Шаблон сообщения
	 */
	public $template = "{message} {context}";

	/**
	 * @inheritdoc
	 */
	public function log($level, $message, array $context = [])
	{
		$level = $this->resolveLevel($level);
		if ($level === null)
		{
			return;
		}

		syslog($level, trim(strtr($this->template, [
			'{message}' => $message,
			'{context}' => $this->contextStringify($context),
		])));
	}

	/**
	 * Преобразование уровня логов в формат подходящий для syslog()
	 *
	 * @see http://php.net/manual/en/function.syslog.php
	 * @param $level
	 * @return string
	 */
	private function resolveLevel($level)
	{
		$map = [
			LogLevel::EMERGENCY => LOG_EMERG,
			LogLevel::ALERT     => LOG_ALERT,
			LogLevel::CRITICAL  => LOG_CRIT,
			LogLevel::ERROR     => LOG_ERR,
			LogLevel::WARNING   => LOG_WARNING,
			LogLevel::NOTICE    => LOG_NOTICE,
			LogLevel::INFO      => LOG_INFO,
			LogLevel::DEBUG     => LOG_DEBUG,
		];
		return isset($map[$level]) ? $map[$level] : null;
	}
}
