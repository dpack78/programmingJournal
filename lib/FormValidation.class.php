<?php

class FormValidation {
	public function __construct(){
		//
	}
	
	public function validate_in($a_verify, &$a_input,$debugMode = false){
		$a_return = [];
		$passed = true;
		$s_failures = "";
		foreach($a_verify as $varName=>$varType){
			$required = true;
			$cleanInput = strip_tags(trim($a_input[$varName]));
			if(strpos($varType,"nr_") !== false){
				$varType = str_replace("nr_", "", $varType); 
				$required = false;
			}
			if(!isset($cleanInput) && $required){
				$s_failures.= $varName.", ";
				$passed = false;
			}else if(isset($cleanInput) && !empty($cleanInput)){
				switch($varType){
					case "number":
						if(is_numeric($cleanInput)){
							$a_return[$varName] = $cleanInput; 
						}else{
							$s_failures.= $varName.", ";
							$passed = false;
						}
						break;
					case "string":
						if(!empty($cleanInput)){
							$a_return[$varName] = $cleanInput;
						}else{
							$s_failures.= $varName.", ";
							$passed = false;
						}
						break;
					default:
						$a_possibleValues = explode("||",$varType);
						$checkType = $a_possibleValues[0];
						unset($a_possibleValues[0]);
						if($checkType == "#between"){
							//TODO: write this.
						}else if($checkType == "#choose"){
							if(in_array($a_input[$varName],$a_possibleValues)){
								$a_return[$varName] = $a_input[$varName];
							}else{
								$s_failures .= $varName.", ";
								$passed = false;
							}
						}else{
							$s_failures .= "checkTypeNotSet: ".$varType.",";
							$passed = false;
						}
						
				
				}
			}
		}
		if($passed){
			return $a_return;
		}else if($debugMode){
			return "////DEBUG ON////<br><br>".$s_failures;
		}else{
			return -1;
		}
	}
}
