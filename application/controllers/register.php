q<?php

class Register extends MY_Controller {
	
	function username_check($str){
		$this->load->model('loginmod');
		
		$exist = $this->loginmod->userNameExist($str);
		
		if($exist == FALSE)
		{
			return TRUE;
		}
		if($exist == TRUE){
			$this->form_validation->set_message('username_check','Dieser Benutzername existiert schon.');
			return FALSE;
		}
		
	}
		
		
	
	function index(){
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('PasswordClass');
		$this->load->model('loginmod');
		
		
		$this->form_validation->set_rules('username', 'Benutzername', 'required|callback_username_check');
		$this->form_validation->set_rules('password', 'Passwort', 'required');
		$this->form_validation->set_rules('passwordconf', 'Passwort Wiederholung', 'required|matches[password]');
		$this->form_validation->set_rules('email', 'E-Mail', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'Telefon', 'required');
		$this->form_validation->set_rules('lastname', 'Name', 'required');
		$this->form_validation->set_rules('firstname', 'Vorname', 'required');
		$this->form_validation->set_rules('address', 'Adresse', 'required');
		$this->form_validation->set_rules('zipcode', 'PLZ', 'required|min_length[4]|is_natural');
		$this->form_validation->set_rules('location', 'Ort', 'required');
		
		
		if($this->form_validation->run() == FALSE){
		
		// Form not valid
		
		$this->load->view('head/standard');
		$this->load->model('menu');
		$this->createMenuLeft();
		$this->load->view('content_center/register',array("title" => "Registrieren"));
		$this->createMiniCartRight();;
		$this->load->view('foot/standard');
		}
		
		else{
			
		// Form valid
				
		$costumerArray["KundeBenutzername"] = $this->input->post('username');
		$costumerArray["KundeName"] = $this->input->post('lastname');
		$costumerArray["KundeVorname"] = $this->input->post('firstname');
		$costumerArray["KundeAdresse"] = $this->input->post('address');
		$costumerArray["KundePLZ"] = $this->input->post('zipcode');
		$costumerArray["KundeOrt"] = $this->input->post('location');
		$costumerArray["KundeTelefon"] = $this->input->post('country');
		$costumerArray["KundeMail"] = $this->input->post('email');
		
		$tempHash =  $this->passwordclass->createNewSalt();
		$tempPlainTextPass = $this->input->post('password');
		$costumerArray["KundePasswort"] = $this->passwordclass->getPasswordHash($tempPlainTextPass,$tempHash);
		$costumerArray["KundePasswortSalz"] = $tempHash;
		
		
		$costumer = new CostumerClass((object)$costumerArray);
		
		
		//var_dump($costumer);
		
		$this->loginmod->createNewUser($costumer);
			
		$this->load->view('head/standard');
		$this->load->model('menu');
		$this->createMenuLeft();
		$this->load->view('content_center/registersuccess',array("title" => "Registrieren"));
		$this->createMiniCartRight();;
		$this->load->view('foot/standard');
		
		$this->session->set_userdata(array("costumer" => serialize($costumer)));
			
		}
	}
	
}

?>
