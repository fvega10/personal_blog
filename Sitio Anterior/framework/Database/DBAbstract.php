<?php 
namespace EasilyPHP\Database{
	abstract class DBAbstract
	{
		protected $server;
		protected $database;
		protected $user;
		protected $password;
		protected $driver;

		public function __construct($server, $database, $user, $password)
		{
			$this->server   = $server;
			$this->database = $database;
			$this->user     = $user;
			$this->password = $password;

		}
		abstract public function connect();
		abstract public function disconnect();
		abstract public function runSql($sql);
		abstract public function prepareSql($sql); //hacer un query con un prepare stadment
		abstract public function nextResultRow($result);
		abstract public function getAll($result);
		abstract public function getError();
	}
}