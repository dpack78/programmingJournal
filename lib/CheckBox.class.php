<?php
/**
 * Description of CheckBox
 *
 * @author Dave Packer
 */
class CheckBox {
	//put your code here
	public $db;

	public function __construct($db) {
		$this->db = $db;
	}

//GET FUNCTIONS
	
//INSERT FUNCTIONS
public function insertCheckBox($a_in){
	if(isset($a_in['parentID'])){
		$parentID = $a_in['parentID'];
	}else{
		$parentID = NULL;
	}
	$insert_query = "INSERT INTO check_box (check_box_parent_id,check_box_name,additional_explanation,due_time) 
							VALUES (?,?,NULL,NULL)";
	$this->db->query($insert_query,[$parentID,$a_in['checkBoxName']]);
	return $this->db->lastID();
}

public function saveSortOrder(&$a_in){
	$this->r_saveSortOrder($a_in, NULL,0);
}

private function r_saveSortOrder(&$a_in,$parentID,$sortOrder){
	foreach($a_in as $thisSet){
		$drillDown = true;
		if(isset($thisSet['id'])){
			if($parentID == NULL){
				$parentID = "NULL";
			}
			$update_query = "UPDATE check_box SET check_box_parent_id = $parentID, sort_order = $sortOrder WHERE check_box_id = ".$thisSet["id"];
			echo $update_query."<br>";
			$this->db->query($update_query,[]);
			$sortOrder++;
			$drillDown = false;
		}
		if(isset($thisSet["children"])){
			$this->r_saveSortOrder($thisSet['children'], $thisSet['id'], $sortOrder);
			$drillDown = false;
		}
		if($drillDown){
			$this->r_saveSortOrder($thisSet, $parentID, $sortOrder);
		}
	}
}

//UDPATE FUNCTIONS
	
//SAVE FUNCTIONS
	
}
