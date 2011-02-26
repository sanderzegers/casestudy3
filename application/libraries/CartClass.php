<?php


class CartClass{


private $allArticles; //Array containing all Articles with amount

function __construct() {
	$this->allArticles = array();
}


public function add(ArticleClass $artikel, $anzahl){
		
	foreach ($this->allArticles as &$articleCart){
			if($articleCart["artikel"]->getId() == $artikel->getId()){
				$articleCart["menge"] += $anzahl;
				return;
		}
	}

	$this->allArticles[] = array("menge"=>$anzahl,"artikel"=>$artikel);	
	
}

public function remove(ArticleClass $artikel){
		foreach ($this->allArticles as $key => &$articleCart){
			if($articleCart["artikel"]->getId() == $artikel->getId()){
				
				unset($this->allArticles[$key]);
			}
		}
}


public function changeAmount(ArticleClass $artikel, $anzahl){
	foreach ($this->allArticles as &$articleCart){
			if($articleCart["artikel"]->getId() == $artikel->getId()){
				$articleCart["menge"] = $articleCart["menge"] + $anzahl;
				if($articleCart["menge"] <= 0){
					$this->remove($articleCart["artikel"]);
				}
				return;
		}
	}
	
}

public function destroy(){
		$this->allArticles = array();
	}



public function getContent(){
		return ($this->allArticles);
}

public function getTotalValue(){
	$total = 0;
	foreach ($this->allArticles as $articleCart){
		$total += $articleCart["menge"]*$articleCart["artikel"]->getPrice();
	}
	return $total;
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
