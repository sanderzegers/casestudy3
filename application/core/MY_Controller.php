<?php

class MY_Controller extends CI_Controller{
	
	function createMenuLeft(){
		$this->load->model('menu');
		$menuData = ($this->menu->getMenu());
		$this->load->view('content_left/standard',array("menu" => $menuData));
	}
	
	function createMiniCartRight(){
		$usr = $this->session->userdata('name');
		if (strlen($usr)>=1){
				$this->load->view('content_right/onlinecart');
		}
		else{
		$this->load->view('content_right/offlinecart');
		}
	}
}


?>
