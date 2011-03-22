<?php


class CartClass{


private $allArticles; //Array containing all Articles with amount

function __construct() {
	$this->allArticles = array();
}


/** Add an article to the cart */
public function add(ArticleClass $artikel, $anzahl){
		
	foreach ($this->allArticles as &$articleCart){
			if($articleCart["artikel"]->getId() == $artikel->getId()){
				$articleCart["menge"] += $anzahl;
				return;
		}
	}

	$this->allArticles[] = array("menge"=>$anzahl,"artikel"=>$artikel);	
	
}

/** Remove an article from the cart */
public function remove(ArticleClass $artikel){
		foreach ($this->allArticles as $key => &$articleCart){
			if($articleCart["artikel"]->getId() == $artikel->getId()){
				
				unset($this->allArticles[$key]);
			}
		}
}

/** Change the amount of a specific article */
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

/** Empty the cart */
public function destroy(){
		$this->allArticles = array();
	}


/** Returns all articles (ArticleClass[]) in the cart */
public function getContent(){
		return ($this->allArticles);
}

/** Returns total Value of the cart */
public function getTotalValue(){
	$total = 0;
	foreach ($this->allArticles as $articleCart){
		$total += $articleCart["menge"]*$articleCart["artikel"]->getPrice();
	}
	return $total;
}

}


?>
