<?php


class day2 extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getAll(){
		$this->load->database();
		$q = $this->db->query("SELECT * FROM kategorie");
		
		if($q->num_rows() > 0){
			foreach ($q->result() as $row){
				$data[] = $row;
			}
		}
		
		return $data;
		
	}
}


?>
