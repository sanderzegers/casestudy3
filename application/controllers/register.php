<?php

class Register extends MY_Controller {
		
	
	/**
	 * Change userdetails. Possible actions:
	 * start: just load form
	 * password: change password
	 * address: change address
	 */
	function userdetails($action){
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('PasswordClass');
		$this->load->model('loginmod');
		
		$costumer = $this->session->userdata('costumer');
		
		switch($action){
			
			
			case "start":
					$this->load->view('head/standard');
					$this->createMenuLeft();
					$this->load->view('content_center/userdetails',array("costumer" => $costumer));
					$this->createMiniCartRight();;
					$this->load->view('foot/standard');
					break;
					
					
			case "password":
				if($this->form_validation->run('resetPassword') == FALSE){
					$this->load->view('head/standard');
					$this->createMenuLeft();
					$this->load->view('content_center/userdetails',array("costumer" => $costumer));
					$this->createMiniCartRight();
					$this->load->view('foot/standard');
				}
				else{
					$tempHash =  $this->passwordclass->createNewSalt();
					$tempPlainTextPass = $this->input->post('newpassword');
					$costumer->passwort = $this->passwordclass->getPasswordHash($tempPlainTextPass,$tempHash);
					$costumer->passwortSalz = $tempHash;
					
					$this->loginmod->updateUser($costumer);
					$this->session->set_userdata(array("costumer" => $costumer));
					
					$this->load->view('head/standard');
					$this->createMenuLeft();
					$this->load->view('content_center/userdetailssuccess');
					$this->createMiniCartRight();
					$this->load->view('foot/standard');
				}
				break;
				
				
			case "address":
				if($this->form_validation->run('address') == FALSE){
					$this->load->view('head/standard');
					$this->createMenuLeft();
					$this->load->view('content_center/userdetails',array("costumer" => $costumer));
					$this->createMiniCartRight();
					$this->load->view('foot/standard');
				}
				else{
					$costumer->name = set_value('lastname');
					$costumer->vorname = set_value('firstname');
					$costumer->adresse = set_value('address');
					$costumer->plz = set_value('zipcode');
					$costumer->ort = set_value('location');
					$costumer->telefon = set_value('phone');
					$costumer->email = set_value('email');
					$this->loginmod->updateUser($costumer);
					$this->session->set_userdata(array("costumer" => $costumer));
					
					$this->load->view('head/standard');
					$this->createMenuLeft();
					$this->load->view('content_center/userdetailssuccess');
					$this->createMiniCartRight();
					$this->load->view('foot/standard');
				}
			
		}

	}
		
	function index(){
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('PasswordClass');
		$this->load->model('loginmod');
		
		
		if($this->form_validation->run('register') == FALSE){
		
		// Form not valid
		
		$this->load->view('head/standard');
		$this->createMenuLeft();
		$this->load->view('content_center/register',array("title" => "Registrieren"));
		$this->createMiniCartRight();;
		$this->load->view('foot/standard');
		}
		
		else{
			
		// Form valid
				
		$costumerArray["KundeBenutzername"] = set_value('username');
		$costumerArray["KundeName"] = set_value('lastname');
		$costumerArray["KundeVorname"] = set_value('firstname');
		$costumerArray["KundeAdresse"] = set_value('address');
		$costumerArray["KundePLZ"] = set_value('zipcode');
		$costumerArray["KundeOrt"] = set_value('location');
		$costumerArray["KundeTelefon"] = set_value('phone');
		$costumerArray["KundeMail"] = set_value('email');
		
		$tempHash =  $this->passwordclass->createNewSalt();
		$tempPlainTextPass = $this->input->post('password');
		$costumerArray["KundePasswort"] = $this->passwordclass->getPasswordHash($tempPlainTextPass,$tempHash);
		$costumerArray["KundePasswortSalz"] = $tempHash;
		
		
		$costumer = new CostumerClass((object)$costumerArray);
				
		$this->loginmod->createNewUser($costumer);
			
		$this->load->view('head/standard');
		$this->createMenuLeft();
		$this->load->view('content_center/registersuccess',array("title" => "Registrieren"));
		$this->createMiniCartRight();;
		$this->load->view('foot/standard');
		
		$this->session->set_userdata(array("costumer" => $costumer));
			
		}
	}
	
}

?>
