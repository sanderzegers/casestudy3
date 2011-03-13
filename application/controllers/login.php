<?php

class Login extends MY_Controller {
		
	function index(){
		$this->load->model('loginmod');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('PasswordClass','password');
		
		
		$this->form_validation->set_rules('username', 'Benutzername', 'required');
		$this->form_validation->set_rules('password', 'Passwort', 'required|callback_credentialsCheck');
		
		$formUsername = $this->input->post('username');
		$formPassword = $this->input->post('password');
		
		if ($this->form_validation->run() == TRUE){
			redirect("/");
			//var_dump($this->session);
		}
		else
		{
			$this->load->view('head/standard');
			$this->load->model('menu');
			$this->createMenuLeft();
			$this->load->view('content_center/login',array("title" => "Login"));
			$this->createMiniCartRight();;
			$this->load->view('foot/standard');
		}
		

	}
	
	function credentialsCheck(){
		
		$formUsername = set_value('username');
		$formPassword = set_value('password');
						
		$user = $this->loginmod->getUserDetails($formUsername);		
		
		$passCorrect = $this->passwordclass->checkPassword($formPassword,$user['KundePasswortSalz'],$user['KundePasswort']);
				
		if ($passCorrect == true){
			$costumer = new CostumerClass((object)$user);
			$this->session->set_userdata('name',$costumer->name);
			$this->session->set_userdata('costumer',$costumer);
			return true;
		}
		else {
			$this->form_validation->set_message('credentialsCheck','Benutzerangaben sind falsch!');
			return false;
		}
	}
	
	/** Will logout the user, by simpling deleting the session */
	
	function logout(){
		$this->session->sess_destroy();
		redirect();
	}
	

}

?>