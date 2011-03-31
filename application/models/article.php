<?php

class Article extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	function getDetails($artikelNummer){
		
		$sql = "SELECT * from artikel where artikelNummer = ?";
		
		$query = $this->db->query($sql,$artikelNummer);

		foreach($query->result() as $row){
			$data[] = $row;
		}
		
		
		return $data;
	}
	
	
	function getByCategorie($artikelKategorie){
				
		$sql = "SELECT ArtikelNummer, ArtikelBezeichnung, ArtikelBeschreibung, ArtikelKategorie, ArtikelPreis, ArtikelStatus, ArtikelBestand,BildPfad, group_concat(bild.BildName) as BildName FROM artikel LEFT JOIN bild ON bild.BildArtikel=artikel.ArtikelNummer WHERE artikelKategorie = ? group by ArtikelNummer";
		
		$query = $this->db->query($sql,$artikelKategorie);
		
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
		
		
	}
	
	function getCategorieName($artikelKategorie){
		
		$sql = "SELECT KategorieName from kategorie where KategorieID = ? LIMIT 0,1";
		
		$query = $this->db->query($sql,$artikelKategorie);

		$data = $query->result();
		

		return $data;
	}
	
	
}
