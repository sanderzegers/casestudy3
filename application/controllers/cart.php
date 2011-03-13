<?php
/*
 * Created on Feb 17, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 class Cart extends MY_Controller{
 	
 	 	
 	/** Needed for UTF-8 serialization issues */
 	private function mb_unserialize($serial_str) {
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
		
	/** Show cart contents */
	public function show(){
		$this->load->view('head/standard');
		$this->load->model('menu');
		$this->createMenuLeft();
		
		$myCart = (unserialize($this->session->userdata('myCart')));
		
		$this->load->view('content_center/cartcontent',array("title" => "Warenkorb","myCart" => $myCart));
		$this->createMiniCartRight();;
		$this->load->view('foot/standard');
	}
	

	/** Add article to your cart */
	public function add(){
		
		$sourceSite = $this->input->post('currentSite');
		$artikel = $this->mb_unserialize($this->input->post('article'));
		$myCart = (unserialize($this->session->userdata('myCart')));

		
		$myCart->add($artikel,1);
		$this->session->set_userdata(array("myCart" => serialize($myCart)));
		redirect($sourceSite);
	}
	
	/** Add, subtract or remove article from the cart */
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
	
	/** Checkout entry point. */
	public function checkout(){
		$temp = $this->session->userdata('costumer');
		if(is_object($temp) && ($temp instanceof CostumerClass)){
			$this->checkout2();
		}
		else $this->checkout1();
	}
	
	/** 1. Checkout step: Address */
	public function checkout1(){
		//TODO: Fix Form Validation
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->load->view('head/standard');
		$this->load->model('menu');
		$this->createMenuLeft();
		
		$myCart = (unserialize($this->session->userdata('myCart')));
		$costumer = $this->session->userdata('costumer');
				
		$this->load->view('content_center/checkout1',array("title" => "Warenkorb","myCart" => $myCart, "costumer" => $costumer));
		$this->createMiniCartRight();;
		$this->load->view('foot/standard');
	}
	
	/** 2. Checkout step: Confirm Details */
	public function checkout2(){
		$this->load->view('head/standard');
		$this->load->model('menu');
		$this->createMenuLeft();
		
		$myCart = (unserialize($this->session->userdata('myCart')));
		$costumer = $this->session->userdata('costumer');
				
		
		$this->load->view('content_center/checkout2',array("title" => "Warenkorb","myCart" => $myCart, "costumer" => $costumer));
		$this->createMiniCartRight();;
		$this->load->view('foot/standard');
	}
	
	/** Check out succesful: Send Confirmation E-Mail. Destroy Cart*/
	public function checkoutsuccess(){
		echo "Danke Anke!";
		$this->destroy();
	}
	
	/** Empty the cart */
	public function destroy(){

		$myCart = (unserialize($this->session->userdata('myCart')));
		$myCart->destroy();
		$this->session->set_userdata(array("myCart" => serialize($myCart)));
		
		redirect($this->input->post('currentSite'));
		
	}
	
		
 }
 
?>
