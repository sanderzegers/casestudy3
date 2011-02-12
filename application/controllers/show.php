<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show extends CI_Controller {
	
	function __construct()
		{
		parent::__construct();
		}
	
	function index()
		{
		$this->load->view('head');
		$this->createMenuLeft();
		$this->load->view('content_center',array("title" => "test","content" => "inhalt"));
		$this->load->view('content_right');
		$this->load->view('foot');
		}
	
	/*
	 function product($id){
	 $this->load->model('article');
	 $data['content'] = $this->article->getDetails($id);
	 $data['title'] = "getDetails: ".$id;
	 $this->load->view('head');
	 $this->createMenuLeft();
	 $this->load->view('content_center',$data);
	 $this->load->view('content_right');
	 $this->load->view('foot');
	 }
	 */
	
	function category($id){
		
		$this->load->model('article');
		$data['content'] = $this->article->getByCategorie($id);
		$data['h1'] = $this->article->getCategorieName($id);
		
		//$data['availabillity'] = array(array(;
		
		
		$this->load->view('head');
		
		$this->createMenuLeft();
		
		if(!empty($data['content'])){
			$this->load->view('content_center_category',$data);
		}
		else {
			$this->load->view('content_center',array("title" => "Hoppla","content" => "Keine Artikel gefunden!"));
		}
		$this->load->view('content_right');
		$this->load->view('foot');
	}
	
	
	private function createMenuLeft(){
		//TODO: Irgendwo Zentral speichern
		$this->load->model('menu');
		$menuData = ($this->menu->getMenu());
		$this->load->view('content_left',array("menu" => $menuData));
	}
	
	
}

