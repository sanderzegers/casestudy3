<?php

class Login extends MY_Controller {
		
	function index(){
		$this->load->model('loginmod');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('PasswordClass','password');
		
		
		if ($this->form_validation->run('login') == TRUE){
			redirect("/");
		}
		else
		{
			$this->load->view('head/standard');
			$this->createMenuLeft();
			$this->load->view('content_center/login',array("title" => "Login"));
			$this->createMiniCartRight();;
			$this->load->view('foot/standard');
		}
		

	}
	
	
	/** Will logout the user, by simply deleting the session */
	function logout(){
		//TODO: Save Cart.
		$this->session->sess_destroy();
		redirect();
	}
	

}

?>