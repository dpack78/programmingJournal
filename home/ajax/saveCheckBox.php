<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/init.php");

$a_verify = [
	"mode" => "#choose||add||edit",
	"checkBoxName" =>"string",
	"parentID" => "nr_number"
];

$a_in = $FormValidation->validate_in($a_verify,$_POST,true);
//print_r($a_in);
//exit();
if($a_in == -1){
	echo "_failure";
	exit();
}

$CheckBox = new CheckBox($db);
echo $CheckBox->insertCheckBox($a_in);

exit();