<?php

class artikel{
	
	private $id = 0;
	private $name = '';
	private $preis = 0;
	private $kategorie = 0;
	

public function __construct($artikelArray){
	
	//print_r($artikelArray);
	$this->id = $artikelArray["ArtikelNummer"];
	$this->name = $artikelArray["ArtikelBezeichnung"];
	$this->preis = $artikelArray["ArtikelPreis"];
	$this->kategorie = $artikelArray["ArtikelKategorie"];

}

public function getId(){
	return $this->id;
}


}

//$test = new artikel(array("irgendoepis" => 123, "ArtikelNummer" => 1,"ArtikelBezeichnung" => "testArtikel", "ArtikelPreis" => 12, "ArtikelKategorie" =>1));
//print_r($test);

?>
