<?php

class Menu extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
	}


	function getMenu(){
		$this->load->database();
		
		$sql = "select * from kategorie where KategorieOberkategorie = 0"; //=Oberkategorien
		$sql2 = "select * from kategorie where KategorieOberkategorie = ?"; //Alle Unterkategorien von Oberkategorie
		
		$query = $this->db->query($sql);
		//$data = "";
		$data2 = array(array());
		$i = 0;
		foreach($query->result() as $row){
			
			//$data .= '<p id="text_content" class="level1l">'.$row->KategorieName."</p>\n";
			$data2[$i] = array($row->KategorieName,1,$row->KategorieID);
			$i++;
			$subquery = $this->db->query($sql2,$row->KategorieID);
			foreach ($subquery->result() as $eintrag2){
				//$data .= '<p id="text_content" class="level2l"><a href="index.php?show='.$eintrag2->KategorieID.'">'.$eintrag2->KategorieName."</a></p>\n";
				$data2[$i] = array($eintrag2->KategorieName,2,$eintrag2->KategorieID);
				$i++;
			}
			

		}
		//print_r($data);
		return $data2;
	}
	
	
}
