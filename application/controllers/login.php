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
			$this->load->model('menu');
			$this->createMenuLeft();
			$this->load->view('content_center/login',array("title" => "Login"));
			$this->createMiniCartRight();;
			$this->load->view('foot/standard');
		}
		

	}
	
	/** Used by the formvalidator. */
	function credentialsCheck(){
		
		$formUsername = $this->input->post('username');
		$formPassword = $this->input->post('password');
		
								
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
	
	/** Will logout the user, by simply deleting the session */
	
	function logout(){
		$this->session->sess_destroy();
		redirect();
	}
	

}

?>