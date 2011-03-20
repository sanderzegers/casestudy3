<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Passwordclass{


function createNewSalt(){
	$characters = 'abcdefghijklmnopqrstuvwxyz-:;><*#%&()ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

	$salt = "";

	for ($i = 0; $i<32; $i++){
        $salt = $salt.$characters[rand(0,strlen($characters)-1)];
	}
	
	return $salt;
}

function getPasswordHash($password,$salt){
		return hash('sha256',$salt.$password);
}

function checkPassword($password,$salt,$hash){
	
	$haschedpw = hash('sha256',$salt.$password);
	
	if (trim($haschedpw) == trim($hash)){
		return true;
	}
	return false;
}

}
?>
