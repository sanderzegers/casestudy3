<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Passwordclass{

/** Returns new 32 Char random Salt */
function createNewSalt(){
	$characters = 'abcdefghijklmnopqrstuvwxyz-:;><*#%&()ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

	$salt = "";

	for ($i = 0; $i<32; $i++){
        $salt = $salt.$characters[rand(0,strlen($characters)-1)];
	}
	
	return $salt;
}

/** returns SHA256 Password hash
 *  $password: Password to hash
 *  $salt: Salt
 */
function getPasswordHash($password,$salt){
		return hash('sha256',$salt.$password);
}

/** Compares plaintext $password with $salt and $hash
 *  $password: Plaintext password (delivered by User)
 *  $salt: Salt from DB
 *  $hash: Hash from DB
 */
function checkPassword($password,$salt,$hash){
	
	$haschedpw = hash('sha256',$salt.$password);
	
	if (trim($haschedpw) == trim($hash)){
		return true;
	}
	return false;
}

}
?>
