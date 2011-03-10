<?php

class Login extends MY_Controller {
	
	private $message = "";
	
	function index(){
		
		$this->load->helper('form');

		$this->load->view('head/standard');
		$this->load->model('menu');
		$this->createMenuLeft();
		$this->load->view('content_center/login',array("title" => "Login"));
		$this->createMiniCartRight();;
		$this->load->view('foot/standard');
	}
	
	function send(){
		
		$formUsername = $this->input->post('username');
		$formPassword = $this->input->post('password');
		$this->load->model('loginmod');
		$this->load->library('PasswordClass','password');
		
		//TODO: Replace with Form helper
		if ($formUsername == null or $formPassword == null){
			$this->message = "Benutzername/Passwort falsch";
			$this->index();
			return;
		}
		
		$user = $this->loginmod->getUserDetails($formUsername);		
		
		$passCorrect = $this->passwordclass->checkPassword($formPassword,$user['KundePasswortSalz'],$user['KundePasswort']);
		
		if ($passCorrect == true){
			$costumer = new CostumerClass((object)$user);
			$this->session->set_userdata('name',$costumer->name);
			$this->session->set_userdata('costumer',$costumer);
		}
		else {
			$this->message = "Benutzername/Passwort falsch";
		}
	$this->index();
	}
	
	/** Will logout the user, by simpling deleting Session */
	function logout(){
		$this->session->sess_destroy();
		redirect();
	}
	

}

?>