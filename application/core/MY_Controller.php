<?php

class MY_Controller extends CI_Controller{
	
	function createMenuLeft(){
		$this->load->model('menu');
		$menuData = ($this->menu->getMenu());
		$this->load->view('content_left/standard',array("menu" => $menuData));
	}
	
	function createMiniCartRight(){
		
	}
}


?>
