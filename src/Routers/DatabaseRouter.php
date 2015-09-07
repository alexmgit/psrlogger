<?php
namespace Logger\Routers;

use PDO;
use Logger\Router;

/**
 * Class DatabaseRouter
 *
 * CREATE TABLE default_log (
 *      id integer PRIMARY KEY,
 *      date date,
 *      level varchar(16),
 *      message text,
 *      context text
 * );
 */
class DatabaseRouter extends Router
{
	/**
	 * @var string
	 */
	public $dsn;
	/**
	 * @var string
	 */
	public $username;
	/**
	 * @var string
	 */
	public $password;
	/**
	 * @var string
	 */
	public $table;

	/**
	 * @var PDO
	 */
	private $connection;

	/**
	 * @inheritdoc
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);

		$this->connection = new PDO($this->dsn, $this->username, $this->password);
	}

	/**
	 * @inheritdoc
	 */
	public function log($level, $message, array $context = [])
	{
		$statement = $this->connection->prepare(
			'INSERT INTO ' . $this->table . ' (date, level, message, context) ' .
			'VALUES (:date, :level, :message, :context)'
		);

		$statement->bindParam(':date',      $this->getDate());
		$statement->bindParam(':level',     $level);
		$statement->bindParam(':message',   $message);
		$statement->bindParam(':context',   $this->contextStringify($context));

		$statement->execute();
	}
}
