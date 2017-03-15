<?php

class SQL extends PDO
{
	public static $config, $connection, $nbQueries = 0;

	public static function init()
	{

		if(empty(Config::$database->host)
		|| empty(Config::$database->user)
		|| empty(Config::$database->password)
		|| empty(Config::$database->database))
			Error::fatal('Missing sql credentials');

		self::$config = new Object();

		foreach(Config::$database as $k => $v)
			self::$config->$k = $v;


		return self::connect();
	}

	private static function connect()
	{
		try
		{
			return self::$connection =
			new PDO
			(
				'mysql:host='.self::$config->host.';
				dbname='.self::$config->database,
				self::$config->user,
				self::$config->password,
				[
					PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
					PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
				]
			);
		}
		catch(Exception $e)
		{ Error::fatal($e->getMessage()); }
	}


	public function exec($q)
	{
		self::$nbQueries++;
		return self::$connection->exec($q);
	}

	public function query($q)
	{
		self::$nbQueries++;
		return self::$connection->query($q);
	}
}

?>