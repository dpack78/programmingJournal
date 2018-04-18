<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/init.php");

$a_verify = [
	"pageName" => "nr_string",
	"lineNumber" => "nr_string",
	"brainDump" => "nr_string",
	"accomplished" => "nr_string",
	"tomorrowsGoals" => "nr_string",
];

$a_in = $FormValidation->validate_in($a_verify,$_POST, true);
if($a_in == -1){
	echo "validatePost failed";
	exit();
}

$pageName = (isset($a_in['pageName'])) ? $a_in['pageName'] : null;
$lineNumber = (isset($a_in['lineNumber'])) ? $a_in['lineNumber'] : null;
$brainDump = (isset($a_in['brainDump'])) ? $a_in['brainDump'] : null;
$accomplished = (isset($a_in['accomplished'])) ? $a_in['accomplished'] : null;
$tomorrowsGoals = (isset($a_in['tomorrowsGoals'])) ? $a_in['tomorrowsGoals'] : null;

$Entry = new Entry($DB);
$newEntryID = $Entry->saveEntry($pageName, $lineNumber, $brainDump, $accomplished, $tomorrowsGoals);

$Entry->saveGoalResponses($newEntryID,$_POST['goal']);
header("location:/home/index.php");
exit();