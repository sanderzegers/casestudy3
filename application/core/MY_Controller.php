<?php

class MY_Controller extends CI_Controller{
	
	function __construct()
		{
		parent::__construct();
				
		$temp = unserialize($this->session->userdata('myCart'));

		if(!(is_object($temp) && ($temp instanceof CartClass))){
			$myCart = new CartClass;			
			$this->session->set_userdata(array("myCart" => serialize($myCart)));		
			}
		}
		
	function createMenuLeft(){
		$this->load->model('menu');
		$menuData = ($this->menu->getMenu());
		$this->load->view('content_left/standard',array("menu" => $menuData));
	}
	
	function createMiniCartRight(){
		$usr = $this->session->userdata('name');
		$myCart = (unserialize($this->session->userdata('myCart')));
		//var_dump($myCart);
		
		if (strlen($usr)>=1){
				$this->load->view('content_right/onlinecart',array("myCart" => $myCart));
		}
		else{
		$this->load->view('content_right/offlinecart',array("myCart" => $myCart));
		}
	}
	
	/** Used by the formvalidator. */
	function credentialsCheck(){
		
		$this->load->library('PasswordClass','password');
		$this->load->model('loginmod');
		
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
	
	/** Function used by the Form Validation Class */
	function validUsername($str){
		$this->load->model('loginmod');
		
		$exist = $this->loginmod->userNameExist($str);
		
		if($exist == FALSE)
		{
			return TRUE;
		}
		if($exist == TRUE){
			$this->form_validation->set_message('validUsername','Dieser Benutzername existiert schon.');
			return FALSE;
		}
		
	}
	
	
	
}


?>
