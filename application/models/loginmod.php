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

		$a = $query->result_array();
		if (count($a) == 1){
			return $a[0];
		}
		else return null;
	}

}

?>
