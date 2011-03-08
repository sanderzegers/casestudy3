<?php

class Login extends CI_Controller {
	
	private $message = "";
	
	function index(){
		
		$this->load->helper('form');

		
		$this->load->view('head/standard');
		$this->load->model('menu');
		$menuData = ($this->menu->getMenu());
		$this->load->view('content_left/standard',array("menu" => $menuData, "message" => $this->message));
		$this->load->view('content_center/login',array("title" => "Login"));
		$this->load->view('content_right/standard');
		$this->load->view('foot/standard');
	}
	
	function send(){
		
		//TODO: Password check
		$formUsername = $this->input->post('username');
		$formPassword = $this->input->post('password');
		$this->load->model('loginmod');
		$this->load->library('PasswordClass','password');
		
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
	

}

?>