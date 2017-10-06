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

		//Validate
		foreach($a_response as $goalID => $thisResponse){
			if(!is_numeric($goalID) || !is_numeric($thisResponse) || $thisResponse < 1 || $thisResponse > 3){
				echo "bad goal responses";
				exit();
			}
		}
		//Insert:
		$i = 1;
		$a_q = [
			"entryID" => $entryID,
		];
		$insert_query = "INSERT INTO entry_goal_link 
								(entryID,goalID,goal_responseID)
								VALUES";
		foreach($a_response as $goalID => $thisResponse){
			$insert_query.= "(:entryID,:goalID$i,:goal_responseID$i),";
			$a_q["goalID$i"] = $goalID;
			$a_q["goal_responseID$i"] = $thisResponse;
			$i++;
		}
		$this->DB->query(rtrim($insert_query,","),$a_q);
	}
	
	public function getYesterdayEntryText(){
		$select_query = "SELECT * FROM entry ORDER BY entryID DESC LIMIT 1";
		return $this->DB->getRow($select_query,[]);
	}
}