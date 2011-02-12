<?php

class testdb extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
	}


	function test(){
		$this->load->database();
		$query = $this->db->get("kategorie");

		foreach($query->result() as $row){
			$data[] = $row;
		}
		return $data;
	}
}
