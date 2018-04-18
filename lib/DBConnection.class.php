<?php
class DBConnection {
	private static $dbInstance = false;

	public function __construct() {
	}
	
	private function setUpConnectionInstance(){
		try{
			$config = parse_ini_file($_SERVER['DOCUMENT_ROOT']."/../config.ini");
			$connection = new PDO("mysql:host=".$config['serverName'].";dbname=".$config['dbname'],$config['username'],$config['password']);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$dbInstance = $connection;
		} catch (PDOException $e) {
			echo "Connection failed: ". $e->getMessage();
		}
	}

	public function getInstance(){
		if(!self::$dbInstance){
			$this->setUpConnectionInstance();
		}
		return self::$dbInstance;
	}
}

