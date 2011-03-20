<?php

class Loginmod extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/** Get all Userdetails from a user with a specific $username */
	function getUserDetails($username){
				
		$sql = "SELECT * from kunde where KundeBenutzername = ? LIMIT 0,1";
		
		$query = $this->db->query($sql,$username);

		$a = $query->result_array();
		if (count($a) == 1){
			return $a[0];
		}
		else return null;
	}
	
	/** Check if a username already exist */
	function userNameExist($username){
		$sql = "SELECT * from kunde where kundeBenutzername = ?";
		$query = $this->db->query($sql,$username);

		$a = $query->result_array();
		if (count($a) >= 1){
			return true;
		}
		
		return false;
	}
	
	/** Write a new user to the DB. Takes a CostumerClass object as an argument */
	function createNewUser($newUser){
		$this->db->insert('kunde',$newUser->getDbArray());
	}
	
	/** Will update a user settings. Takes a CostumerClass object as an argument */
	function updateUser($user){
		$this->db->where('KundeBenutzername',$user->benutzername);
		$this->db->update('kunde', $user->getDbArray()); 
	}
	 

}

?>
