<?php
$calledByInit = true;
session_start();
include("classAutoLoader.php");
$DB = new DB();
$FormValidation = new FormValidation();
$Util = new Util();
