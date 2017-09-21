<?php
$calledByInit = true;
session_start();
include("classAutoLoader.php");
$db = new db();
$FormValidation = new FormValidation();
