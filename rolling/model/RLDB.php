<?php

require_once('RLConnectVars.php');

class RLDB
{
	public static function instance()
	{
		static $db;
		if(!isset($db))
			$db = new RLDB();
		return $db;
	}

	public function __construct()
	{
		$this->mDbh = $this->connect();
	}

	public function getHandler()
	{
		return $this->mDbh;
	}

	protected function connect()
	{
		$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
		return $dbh;
	}

	protected $mDbh;
}

?>
