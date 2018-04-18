<?php
include($_SERVER['DOCUMENT_ROOT']."/includes/init.php");

$a_in = $_POST['itemSort'][0];
//print_r($a_in);
//exit();

$CheckBox = new CheckBox($db);
$CheckBox->saveSortOrder($a_in);