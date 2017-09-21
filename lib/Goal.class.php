<?php

class Goal {
	private $DB;
	public function __construct($DB){
		$this->DB = $DB;
	}

	public function getCurrentGoals(){
		$select_query = "SELECT * FROM goal WHERE isActive = 1";
		return $this->DB->getRows($select_query,[]);
	}
}