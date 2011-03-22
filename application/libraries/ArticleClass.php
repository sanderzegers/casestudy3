<?php


class ArticleClass{
	
	public $nummer = 0;
	public $bezeichnung = '';
	public $beschreibung = '';
	public $kategorie = '';
	public $preis = 0;
	public $status = 0;
	public $bestand = 0;
	
	public $verfuegbarkeit = 1;
	public $bildname;
	private $tempbildname = '';
	

public function __construct($articleDbObject){
	// Same fields as DB
	$this->nummer = $articleDbObject->ArtikelNummer;
	$this->bezeichnung =  $articleDbObject->ArtikelBezeichnung;
	$this->beschreibung = $articleDbObject->ArtikelBeschreibung;
	$this->kategorie = $articleDbObject->ArtikelKategorie;
	$this->preis = $articleDbObject->ArtikelPreis;
	$this->status = $articleDbObject->ArtikelStatus;
	$this->bestand = $articleDbObject->ArtikelBestand;
	$this->tempbildname = $articleDbObject->BildName;
	
	
	// New Fields
	$this->verfuegbarkeit = $this->calcAvailability();
	
	
	if(strlen($this->tempbildname)>1){
		$this->bildname = $this->picsToArray();
	}
	
	unset($this->tempbildname);

}

/** Return ID of the Article */
public function getId(){
	return $this->nummer;
}

/** Returns price */
public function getPrice(){
	return $this->preis;
}

/**
 * Returns a availability value of 1-5 depending on $bestand
 */
private function calcAvailability(){
	if ($this->bestand<5) return 1;
	if ($this->bestand<10) return 2;
	if ($this->bestand<20) return 3;
	if ($this->bestand<30) return 4;
	return 5;
}

/**
 * Will create an Array of different pictures delivered comma seperated by the DB
 * 
 */
private function picsToArray(){
	return explode(",",$this->tempbildname);
}

}
//$test = new artikel(array("irgendoepis" => 123, "ArtikelNummer" => 1,"ArtikelBezeichnung" => "testArtikel", "ArtikelPreis" => 12, "ArtikelKategorie" =>1));
//print_r($test);

?>
