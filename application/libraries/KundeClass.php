<?php

// TODO: Kunde Klasse schreiben

class KundeClass{
	
	public $name = '';
	public $vorname = '';
	public $adresse = '';
	public $plz = '';
	public $ort = '';
	public $telefon = '';
	public $mail = '';
	public $benutzername = '';
	public $passwort = '';
	public $passwortSalz = '';
	
public function __construct($kundeArray){
	// Same fields as DB
	$this->nummer = $kundeArray->ArtikelNummer;	

}

}


?>
