<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	
	function __construct()
		{
		parent::__construct();
		}
	
	function index()
		{
		$this->load->view('head/standard');
		$this->createMenuLeft();
		$this->load->view('content_center/standard',array("title" => "Casestudy TI 5 - Webshop","content" => "Eine Casestudy von Roland Hürlimann, Sander Zegers und Christoph Zihlmann."));
		$this->createMiniCartRight();;
		$this->load->view('foot/standard');
		}
}

