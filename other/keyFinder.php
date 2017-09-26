<?php

function errorHandle($errorMessage){
	echo "error in ".$errorMessage;
	exit();
}

function fixStringLength($stringIn){
	$stringIn = rtrim($stringIn);
	if(strlen($stringIn) < 16){
		$charactorsToAdd = 16 - strlen($stringIn);
		
		for($i = 0; $i < $charactorsToAdd; $i++){
			$stringIn.= " ";	
		}
	}
	if(strlen($stringIn) < 16){
		echo "wrongstring length";
		echo " $stringIn";
		exit();
	}
	return $stringIn;
}

function getStringFromFile($fileName){
	$handle = fopen($fileName,"r");
	if(!$handle){
		errorHandle("opening $fileName");
	}
	return fgets($handle);
}


//START HERE:
$handle = fopen("dictionary.txt", "r");
if (!$handle) {
	errorHandle("opening dictionary.txt");
}

$plainText = getStringFromFile("plaintext.txt");
$cipherText = getStringFromFile("ciphertext.txt");
//$iv = "0000000000000000";
$iv = "0000000000000000";
//$iv = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
//echo hex2bin($ivHex);

//exit();

while (($word = fgets($handle)) !== false) {
	$word = fixStringLength($word);
	$encrypted = openssl_encrypt($plainText, "aes-128-cbc", $word, OPENSSL_ZERO_PADDING, $iv);
	$encHex = bin2hex($encrypted);
//	$decrypted = openssl_decrypt($cipherText, AES_256_CBC, $encryption_key, 0, $iv);
	if($encHex == $cipherText){
		echo "winner: ".$word;
		echo "<br>";
	}
	$total+= strlen($encHex);
//	echo $encrypted."<br>";
}
echo "done";


//echo "Encrypted: $encrypted\n\n";
//$encrypted = $encrypted . ':' . $iv;
//$parts = explode(':', $encrypted);
//$decrypted = openssl_decrypt($parts[0], AES_256_CBC, $encryption_key, 0, $parts[1]);
//echo "Decrypted: $decrypted\n\n";

fclose($handle);