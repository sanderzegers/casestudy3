<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct()
		{
		parent::__construct();
		}
	
	function index()
		{
		$this->load->view('head/standard');
		$this->load->model('menu');
		$menuData = ($this->menu->getMenu());
		$this->load->view('content_left/standard',array("menu" => $menuData));
		$this->load->view('content_center/standard',array("title" => "CodeIgniter Test2","content" => "Diese Seite läuft unter CodeIgniter!"));
		$this->load->view('content_right/standard');
		$this->load->view('foot/standard');
		}
}

