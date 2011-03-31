<?php

class Menu extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Will return an array containing all menu items read from the Db.
	 * Example: Array (	[0] => Array ( [name] => Tastaturen [class] => 1 [id] => 2 [amount] => 0 ) 
	 * 					[1] => Array ( [name] => Tastaturen [class] => 2 [id] => 15 [amount] => 3 )
	 */
	function getMenu(){
		$this->load->database();
		//$this->db->cache_on();
		$result = array(array());
		$i = 0;
		
		$sql = "select * from kategorie where KategorieOberkategorie = 0"; //= Top Category
		$sql2 = "select * from kategorie where KategorieOberkategorie = ?"; // All subcategories from a top category
		$sql3 = "select count(*) as articleCount from artikel where ArtikelKategorie = ?"; // amount of articles in a articlegroup
		
		$queryTopCategory = $this->db->query($sql);
		
		foreach($queryTopCategory->result() as $row){
			$queryArticleAmount = $this->db->query($sql3,$row->KategorieID)->result();
			$result[$i] = array("name" => $row->KategorieName,"class" => 1,"id" => $row->KategorieID,"amount" => $queryArticleAmount[0]->articleCount);
			$i++;
			
			$querySubCategory = $this->db->query($sql2,$row->KategorieID);
			
			foreach ($querySubCategory->result() as $row2){
				$queryArticleAmount = $this->db->query($sql3,$row2->KategorieID)->result();
				$result[$i] = array("name" => $row2->KategorieName,"class" => 2,"id" => $row2->KategorieID,"amount" => $queryArticleAmount[0]->articleCount);
				$i++;
			}
			

		}
		//$this->db->cache_off();
		return $result;
	}
	
	
}
