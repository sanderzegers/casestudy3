<?php

class Register extends CI_Controller {
	
	function index(){
		$this->load->view('head/standard');
		$this->load->model('menu');
		$menuData = ($this->menu->getMenu());
		$this->load->view('content_left/standard',array("menu" => $menuData));
		$this->load->view('content_center/login',array("title" => "Registrieren","content" => "Diese Seite läuft unter CodeIgniter!"));
		$this->load->view('content_right/standard');
		$this->load->view('foot/standard');
	}
	
}

?>
