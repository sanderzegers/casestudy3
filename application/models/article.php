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
				
		//$sql = "SELECT ArtikelNummer, ArtikelBezeichnung, ArtikelBeschreibung, ArtikelKategorie, ArtikelPreis, ArtikelStatus, ArtikelBestand,BildPfad, group_concat(bild.BildName) as BildName FROM artikel LEFT JOIN bild ON bild.BildArtikel=artikel.ArtikelNummer WHERE artikelKategorie = ? group by ArtikelNummer";
		
		$sql = "select artikel.ArtikelNummer, artikel.ArtikelBezeichnung, ArtikelBeschreibung, ArtikelKategorie, ArtikelPreis, 
ArtikelStatus, ArtikelBestand, group_concat(DISTINCT feature.FeatureBezeichnung) as Features, group_concat(DISTINCT bild.BildName ) as 
BildName from artikel left join artikel_feature on (artikel.ArtikelNummer = artikel_feature.FK_ArtFeaArtikel) left join 
feature on (artikel_feature.FK_ArtFeaFeature = feature.FeatureID) left join bild ON bild.BildArtikel = artikel.ArtikelNummer WHERE artikelKategorie = ? group by artikel.ArtikelNummer";
		
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
