<?php

class Login extends CI_Controller {
	
	private $message = "";
	
	function index(){
		
		$this->load->helper(array('form', 'url'));

		
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
		$this->load->library('password');
		
		if ($formUsername == null or $formPassword == null){
			$this->message = "Benutzername/Passwort falsch";
			$this->index();
			return;
		}
		
		$user = $this->loginmod->getUserDetails($formUsername);
		
		
		$passCorrect = $this->password->checkPassword($formPassword,$user['KundePasswortSalz'],$user['KundePasswort']);
		
		if ($passCorrect == true){
			$this->session->set_userdata('name',$formUsername);
		}
		else {
			$this->message = "Benutzername/Passwort falsch";
		}
	$this->index();
	}
}

?>