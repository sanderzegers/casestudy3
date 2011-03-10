<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show extends MY_Controller {
	
	function __construct()
		{
		parent::__construct();
		}
	
	
	function index()
		{
		$this->load->view('head/standard');
		$this->createMenuLeft();
		$this->load->view('content_center/standard',array("title" => "test","content" => "inhalt"));
		$this->createMiniCartRight();;
		$this->load->view('foot/standard');
		}
	
	function category($id){
		
	
		$this->load->model('article');
		
		
		$dbGetByCategorie = $this->article->getByCategorie($id);
		$dbgetCategorieName = $this->article->getCategorieName($id);
		
		$this->load->view('head/standard');
		$this->createMenuLeft();

		$data['h1'] = $dbgetCategorieName;
		
		if(!empty($dbGetByCategorie)){
		foreach($dbGetByCategorie as $dbArticle){
			$articles[] = new ArticleClass($dbArticle);
		}
			$data['content'] = $articles;
			$this->load->view('content_center/category',$data);
		}
		else {
			$this->load->view('content_center/standard',array("title" => "Hoppla","content" => "Keine Artikel gefunden!"));
		}
		
		
		$this->createMiniCartRight();;
		$this->load->view('foot/standard');
	}
	
	
}

