<?php
/*
 * Created on Feb 17, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 class Cart extends CI_Controller{
 	
 	
 	//function 
 	
 	// Needed for UTF-8 serialization issues
 	function mb_unserialize($serial_str) {
		$out = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str );
		return unserialize($out);
	} 
 
 	function __construct()
		{
		parent::__construct();
				
		$temp = unserialize($this->session->userdata('myCart'));

		if(!(is_object($temp) && ($temp instanceof CartClass))){
			$myCart = new CartClass;			
			$this->session->set_userdata(array("myCart" => serialize($myCart)));		
			}
		}
		
		
	public function show(){
		$this->load->view('head/standard');
		$this->load->model('menu');
		$menuData = ($this->menu->getMenu());
		$this->load->view('content_left/standard',array("menu" => $menuData));
		
		$myCart = (unserialize($this->session->userdata('myCart')));
		
		$this->load->view('content_center/cartcontent',array("title" => "Warenkorb","myCart" => $myCart));
		$this->load->view('content_right/standard');
		$this->load->view('foot/standard');
	}
	

	
	public function add(){
		
		$sourceSite = $this->input->post('currentSite');
		$artikel = $this->mb_unserialize($this->input->post('article'));
		$myCart = (unserialize($this->session->userdata('myCart')));

		
		$myCart->add($artikel,1);
		$this->session->set_userdata(array("myCart" => serialize($myCart)));
		redirect($sourceSite);
	}
	
	public function action(){
		$sourceSite = $this->input->post('currentSite');
		$actionType = $this->input->post('actionType');
		$artikel = $this->mb_unserialize($this->input->post('article'));
		$myCart = (unserialize($this->session->userdata('myCart')));
		
		$add = (boolean)$this->input->post('add');
		$subtract = (boolean)$this->input->post('subtract');
		$remove = (boolean)$this->input->post('remove');

		
		switch($actionType){
			case "add":
				$myCart->changeAmount($artikel,1);
				break;
				
			case "subtract":
				$myCart->changeAmount($artikel,-1);
				break;
				
			case "remove":
				$myCart->remove($artikel);
				break;
		}
		
		$this->session->set_userdata(array("myCart" => serialize($myCart)));
		
		
		
		redirect($sourceSite);
		
	}
	
	
	public function checkout(){
		
		
		$this->load->view('head/standard');
		$this->load->model('menu');
		$menuData = ($this->menu->getMenu());
		$this->load->view('content_left/standard',array("menu" => $menuData));
		
		$myCart = (unserialize($this->session->userdata('myCart')));
		$costumer = $this->session->userdata('costumer');
		
		$this->load->view('content_center/checkout',array("title" => "Warenkorb","myCart" => $myCart, "costumer" => $costumer));
		$this->load->view('content_right/standard');
		$this->load->view('foot/standard');
	}
	
	
	public function destroy(){

		$myCart = (unserialize($this->session->userdata('myCart')));
		$myCart->destroy();
		$this->session->set_userdata(array("myCart" => serialize($myCart)));
		
		redirect($this->input->post('currentSite'));
		
	}
	
		
 }
 
?>
