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
	
	function category($id){
		
		$this->load->model('article');
		
		// include() is not the CI way.. but apparently the only way to load multiple objects from the same class
		include("application/libraries/Articleclass.php");
		
		$dbGetByCategorie = $this->article->getByCategorie($id);
		$dbgetCategorieName = $this->article->getCategorieName($id);
		
		$this->load->view('head');
		$this->createMenuLeft();
		
		$data['h1'] = $dbgetCategorieName;
		
		if(!empty($dbGetByCategorie)){
		foreach($dbGetByCategorie as $dbArticle){
			$articles[] = new Articleclass($dbArticle);
		}
			$data['content'] = $articles;
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

