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
	
	public function getYesterdayGoalAnswers($entryID){
		$a_q = [
			"entry" => $entryID
		];
		$select_query = "SELECT gr.goal_responseName FROM entry_goal_link AS egl
								JOIN goal_response AS gr
									ON gr.goal_responseID = egl.goal_responseID
									AND egl.entryID = :entry";
		return $this->DB->getRows($select_query,$a_q);
	}
}