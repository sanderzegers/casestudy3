<?php

class Loginmod extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function getUserDetails($username){
		
		$sql = "SELECT * from kunde where KundeBenutzername = ? LIMIT 0,1";
		
		$query = $this->db->query($sql,$username);

		return $query->result();
	}

}

?>
