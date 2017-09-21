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
		$call = $this->link->prepare($query);
		$call->execute($a_q);
		$a_return = [];
		while(($thisRow = $call->fetch(PDO::FETCH_ASSOC)) !== false){
			$a_return[] = $thisRow;
		}
		return $a_return;
	}
	
	public function getRow($query,$a_q){
		$call = $this->link->prepare($query);
		$call->execute($a_q);
		return $call->fetch(PDO::FETCH_ASSOC);
	}
	
	public function getCol($query,$a_q,$colName){
		$call = $this->link->prepare($query);
		$call->execute($a_q);
		$return = $call->fetch(PDO::FETCH_ASSOC);
		return $return[$colName];
	}
	
	public function query($query,$a_q){
		$call = $this->link->prepare($query);
		$call->execute($a_q);
	}
	
	public function lastID(){
		return $this->link->lastInsertId();
	}
	
}
