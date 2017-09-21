<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/init.php");

$a_verify =[
	"curIndex"=>"number"
];
$a_in = $FormValidation->validate_in($a_verify,$_POST,false);
if($a_in == -1){
	echo "no";
	exit();
}

$CheckBoxListBuilder = new CheckBoxListBuilder($db);
echo $CheckBoxListBuilder->newCheckBox($a_in['curIndex']);
exit();
