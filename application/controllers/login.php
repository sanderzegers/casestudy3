<?php

class Login extends CI_Controller {
	
	function index(){
		
		
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		if ($this->form_validation->run() == FALSE)
		{
			//$this->load->view('content_center/login',array("title" => "Login"));
		}
		else
		{
			$this->load->view('formsuccess');
		}
		
		
		$this->load->view('head/standard');
		$this->load->model('menu');
		$menuData = ($this->menu->getMenu());
		$this->load->view('content_left/standard',array("menu" => $menuData));
		$this->load->view('content_center/login',array("title" => "Login","content" => "Diese Seite läuft unter CodeIgniter!"));
		$this->load->view('content_right/standard');
		$this->load->view('foot/standard');
	}
	
	function send(){
		//TODO: Password check
		$username = $this->input->post('username');
		$this->load->model('loginmod');
		
		print_r($this->loginmod->getUserDetails($username));
		
		
		$this->session->set_userdata('name',$username);
		$this->index();
	}
	
}

?>
