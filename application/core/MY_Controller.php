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
}


?>
