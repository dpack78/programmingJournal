<?php

class Util {
	public function echoClean($stringIn){
		echo htmlentities($stringIn, ENT_QUOTES| ENT_HTML5 );
		return;
	}
}
