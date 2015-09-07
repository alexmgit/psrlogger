<?php
namespace Logger;

use DateTime;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

/**
 * Class Router
 */
abstract class Router extends AbstractLogger implements LoggerInterface
{
	/**
	 * @var bool
	 */
	public $isEnable = true;
	/**
	 * @var string
	 */
	public $dateFormat = DateTime::RFC2822;

	/**
	 * @param array $attributes
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
	 * @return string
	 */
	public function getDate()
	{
		return (new DateTime())->format($this->dateFormat);
	}

	/**
	 * @param array $context
	 * @return string
	 */
	public function contextStringify(array $context = [])
	{
		return !empty($context) ? json_encode($context) : null;
	}
}
