<?php
namespace Logger;

use DateTime;
use ReflectionClass;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

/**
 * Class Route
 */
abstract class Route extends AbstractLogger implements LoggerInterface
{
	/**
	 * @var bool Включен ли роут
	 */
	public $enabled = true;
	/**
	 * @var string Формат даты логов
	 */
	public $dateFormat = DateTime::RFC2822;

	/**
	 * Конструктор
	 *
	 * @param array $attributes Атрибуты роута
	 */
	public function __construct(array $attributes = [])
	{
		$reflection = new ReflectionClass($this);
		foreach ($attributes as $attribute => $value)
		{
			$property = $reflection->getProperty($attribute);
			if ($property->isPublic())
			{
				$property->setValue($this, $value);
			}
		}
	}

	/**
	 * Текущая дата
	 *
	 * @return string
	 */
	protected function getDate()
	{
		return (new DateTime())->format($this->dateFormat);
	}

	/**
	 * Преобразование $context в строку
	 *
	 * @param array $context
	 * @return string
	 */
	protected function contextStringify(array $context = [])
	{
		return !empty($context) ? json_encode($context) : null;
	}
}