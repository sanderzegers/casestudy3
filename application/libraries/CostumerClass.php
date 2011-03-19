<?php


class CostumerClass{
	
	public $name = '';
	public $vorname = '';
	public $adresse = '';
	public $plz = '';
	public $ort = '';
	public $telefon = '';
	public $email = '';
	public $benutzername = '';
	public $passwort = '';
	public $passwortSalz = '';
	
public function __construct($kundeArray){
	// Same fields as DB
	$this->name = $kundeArray->KundeName;
	$this->vorname = $kundeArray->KundeVorname;
	$this->adresse = $kundeArray->KundeAdresse;
	$this->plz = $kundeArray->KundePLZ;
	$this->ort = $kundeArray->KundeOrt;
	$this->telefon = $kundeArray->KundeTelefon;
	$this->email = $kundeArray->KundeMail;
	
	// Only needed for saving user settings.
	if(isset($kundeArray->KundeBenutzername))
	$this->benutzername = $kundeArray->KundeBenutzername;
	if(isset($kundeArray->KundePasswort))
	$this->passwort = $kundeArray->KundePasswort;
	if(isset($kundeArray->KundePasswortSalz))
	$this->passwortSalz = $kundeArray->KundePasswortSalz;
}

/**
 * This function will return contents of this class as an Array, to directly import into the DB
 */
public function getDbArray(){
	$DbArray["KundeName"] = $this->name;
	$DbArray["KundeVorname"] = $this->vorname;
	$DbArray["KundeAdresse"] = $this->adresse;
	$DbArray["KundePLZ"] = $this->plz;
	$DbArray["KundeOrt"] = $this->ort;
	$DbArray["KundeTelefon"] = $this->telefon;
	$DbArray["KundeMail"] = $this->email;
	$DbArray["KundeBenutzername"] = $this->benutzername;
	
	$DbArray["KundePasswort"] = $this->passwort;
	$DbArray["KundePasswortSalz"] = $this->passwortSalz;
	
	return $DbArray;
}

}


?>
