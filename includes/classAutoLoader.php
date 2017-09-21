<?php
if(!isset($calledByInit) || !$calledByInit){
	echo "error in setting up page.";
	exit();
}
spl_autoload_register( function( $class_name ) {
	include $_SERVER['DOCUMENT_ROOT'].'/lib/'. $class_name . '.class.php';
} );