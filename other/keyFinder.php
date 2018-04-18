<?php
/**
 * David Packer 
 * CS 5460 problem 3.5 solution
 * PHP provides a much simpler ssl api and more in-house string manipulation, so I opted to use PHP for this problem. 
 * 
 * Haley Chambers and I collaborated ideas on how to write this in php, so our scripts may look similar.
 * Please note that the actual coding of the scripts took place separately outside of our discussions.
 */


//Called when a file can't be opened
function errorHandle($errorMessage){
	echo "error in ".$errorMessage;
	exit();
}

//Make sure all keys are padded to 16
function fixStringLength($stringIn){
	$stringIn = rtrim($stringIn);
	if(strlen($stringIn) < 16){
		$charactorsToAdd = 16 - strlen($stringIn);
		
		for($i = 0; $i < $charactorsToAdd; $i++){
			$stringIn.= " ";	
		}
	}
	if(strlen($stringIn) < 16){
		echo "wrong string length";
		echo " $stringIn";
		exit();
	}
	return $stringIn;
}

//Get the first row of a file 
function getStringFromFile($fileName){
	$handle = fopen($fileName,"r");
	if(!$handle){
		errorHandle("opening $fileName");
	}
	return fgets($handle);
}

//START HERE:

//Get the dictionary
$handle = fopen("dictionary.txt", "r");
if (!$handle) {
	errorHandle("opening dictionary.txt");
}

$plainText = getStringFromFile("plaintext.txt");

if(strlen($plainText) != 21){
	echo "plain text is not the right length. exiting...";
	exit();
}

$cipherText = getStringFromFile("ciphertext.txt");

//This "hack" needs to be used to get php to intrepret the 0's as int's instead of character's;
$ivhex = "00000000000000000000000000000000";
$iv = hex2bin($ivhex);

//Loop through the dictionary encrypting the plain text trying to find a key match
while (($word = fgets($handle)) !== false) {
	$word = fixStringLength($word);
	$encrypted = openssl_encrypt($plainText, "aes-128-cbc", $word,  OPENSSL_RAW_DATA, $iv);
	$encHex = bin2hex($encrypted);	
	if($encHex == $cipherText){
		echo "The winning key: ".$word;
		echo "<br>";
	}
}
echo "done";
fclose($handle);