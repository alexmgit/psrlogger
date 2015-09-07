<?php
namespace Logger;

use DateTime;
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
	public $isEnable = true;
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
		foreach ($attributes as $attribute => $value)
		{
			if (property_exists($this, $attribute))
			{
				$this->{$attribute} = $value;
			}
		}
	}

	/**
	 * Текущая дата
	 *
	 * @return string
	 */
	public function getDate()
	{
		return (new DateTime())->format($this->dateFormat);
	}

	/**
	 * Преобразование $context в строку
	 *
	 * @param array $context
	 * @return string
	 */
	public function contextStringify(array $context = [])
	{
		return !empty($context) ? json_encode($context) : null;
	}
}
