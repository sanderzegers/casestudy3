<?php

//include("/application/libraries/Articleclass.php");


class CartClass{


public $allArticles; //Array containing all Articles with amount

public function __construct(){
	$allArticles = array();
}


public function add(ArticleClass $artikel, $anzahl){
		
	//var_dump($artikel);
	//var_dump($this);
		
	foreach ($this->allArticles as &$articleCart){
			if($articleCart["artikel"]->getId() == $artikel->getId()){
				$articleCart["menge"] += $anzahl;
				return;
		}
	}
	//$this->allArticles[] = array("menge"=>$anzahl,"artikel"=>$artikel);	
	$this->allArticles[] = array("menge"=>$anzahl,"artikel"=>$artikel);	
	$this->show();
}


public function changeAmount(ArticleClass $artikel, $anzahl){
	foreach ($this->allArticles as &$articleCart){
			if($articleCart["artikel"]->getId() == $artikel->getId()){
				$articleCart["menge"] = $anzahl;
				return;
		}
	}
	
}

public function destroy(){
		unset($this->allArticles);
	}



public function show(){
	//var_dump($this);
}

}


//$test = new ArticleClass((object)array("ArtikelNummer" => 431,"ArtikelBezeichnung" => "testArtikel", "ArtikelPreis" => 12, "ArtikelKategorie" =>1));;
//$test2 = new ArticleClass((object)array("ArtikelNummer" => 225,"ArtikelBezeichnung" => "zweiterArtikel", "ArtikelPreis" => 14, "ArtikelKategorie" =>1));
//
//$warekoerbli = new CartClass();
//$warekoerbli->add($test,1);
//$warekoerbli->add($test2,4);
//$warekoerbli->add($test2,2);
//$warekoerbli->changeAmount($test,5);
//$warekoerbli->show()


?>
