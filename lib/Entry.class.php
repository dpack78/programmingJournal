<?php

class Entry {
	private $DB;
	public function __construct($DB){
		$this->DB = $DB;
	}
	
	public function saveEntry($pageName,$lineNumber,$brainDump,$accomplished,$tomorrowsGoals){
		$a_q = [
			"pageName" => $pageName,
			"lineNumber" => $lineNumber,
			"brainDump" => $brainDump,
			"accomplished" => $accomplished,
			"tomorrowsGoals" => $tomorrowsGoals,
		];
		$insert_query = "INSERT INTO entry (date,pageName,currentLineNumber,brainDump,accomplished,tomorrowsGoals)
			VALUES 
			(NOW(),:pageName,:lineNumber,:brainDump,:accomplished,:tomorrowsGoals)";
		$this->DB->query($insert_query,$a_q);
		return $this->DB->lastID();
	}
	
	public function saveGoalResponses($entryID,$a_response){
		$insert_query = "INSERT INTO entry_goal_link";
		foreach($a_response as $goalID => $thisResponse){
			if(!is_numeric($goalID) || !is_numeric($thisResponse) || $thisResponse < 1 || $thisResponse > 3){
				echo "bad goal responses";
				exit();
			}
		}
	}
}