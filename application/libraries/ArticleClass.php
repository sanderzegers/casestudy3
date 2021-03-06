<?php

//TODO: Implement PHP Magic Setter and Getter

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
	public $feature;
	private $tempbildname = '';
	private $tempfeaturename = '';
	

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
	$this->tempfeaturename = $articleDbObject->Features;
	
	// New Fields
	$this->verfuegbarkeit = $this->calcAvailability();
	
	if(strlen($this->tempfeaturename)>1){
		$this->feature = explode(",",$this->tempfeaturename);
	}
	
	if(strlen($this->tempbildname)>1){
		$this->bildname = explode(",",$this->tempbildname);
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


}
//$test = new artikel(array("irgendoepis" => 123, "ArtikelNummer" => 1,"ArtikelBezeichnung" => "testArtikel", "ArtikelPreis" => 12, "ArtikelKategorie" =>1));
//print_r($test);

?>
