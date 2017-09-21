<?php
/**
 * Description of db
 *
 * @author Dave Packer
 */
class DB extends DBConnection{
	public $link;
	public function __construct(){
		parent::__construct();
		$this->link = $this->getInstance();
	}
	
	public function getRows($query,$a_q){
		try{
			$call = $this->link->prepare($query);
			$call->execute($a_q);
			$a_return = [];
			while(($thisRow = $call->fetch(PDO::FETCH_ASSOC)) !== false){
				$a_return[] = $thisRow;
			}
			return $a_return;
		} catch (Exception $ex) {
			$this->errorHandle($ex);
		}
	}
	
	public function getRow($query,$a_q){
		try{
			$call = $this->link->prepare($query);
			$call->execute($a_q);
			return $call->fetch(PDO::FETCH_ASSOC);
		} catch (Exception $ex) {
			$this->errorHandle($ex);
		}
	}
	
	public function getCol($query,$a_q,$colName){
		try {
			$call = $this->link->prepare($query);
			$call->execute($a_q);
			$return = $call->fetch(PDO::FETCH_ASSOC);
			return $return[$colName];
		} catch (Exception $ex) {
			$this->errorHandle($ex);
		}
	}
	
	public function query($query,$a_q){
		try {
			$call = $this->link->prepare($query);
			$call->execute($a_q);
		} catch (Exception $ex) {
			$this->errorHandle($ex);
		}
	}
	
	public function lastID(){
		return $this->link->lastInsertId();
	}
	
	public function errorHandle($ex){
		echo "database error: ".$ex->getMessage();
		exit();
	}
	
}
