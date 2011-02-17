<?php


class Articleclass{
	
	public $nummer = 0;
	public $bezeichnung = '';
	public $beschreibung = '';
	public $kategorie = '';
	public $preis = 0;
	public $status = 0;
	public $bestand = 0;
	
	public $verfuegbarkeit = 1;
	public $bildname = array();
	private $tempbildname = '';
	

public function __construct($artikelArray){
	// Same fields as DB
	$this->nummer = $artikelArray->ArtikelNummer;
	$this->bezeichnung =  $artikelArray->ArtikelBezeichnung;
	$this->beschreibung = $artikelArray->ArtikelBeschreibung;
	$this->kategorie = $artikelArray->ArtikelKategorie;
	$this->preis = $artikelArray->ArtikelPreis;
	$this->status = $artikelArray->ArtikelStatus;
	$this->bestand = $artikelArray->ArtikelBestand;
	$this->tempbildname = $artikelArray->BildName;
	
	// New Fields
	$this->verfuegbarkeit = $this->calcVerfuegbarkeit();
	
	//$this->tempbildname = $artikelArray->BildName;

	if(!empty($this->tempbildname)){
		$this->bildname = $this->picsToArray();
		unset($this->tempbildname);
	}

}

public function getId(){
	return $this->id;
}

/**
 * Returns a availability value of 1-5 depending on $bestand
 */
public function calcVerfuegbarkeit(){
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
public function picsToArray(){
	return explode(",",$this->tempbildname);
}

}
//$test = new artikel(array("irgendoepis" => 123, "ArtikelNummer" => 1,"ArtikelBezeichnung" => "testArtikel", "ArtikelPreis" => 12, "ArtikelKategorie" =>1));
//print_r($test);

?>
