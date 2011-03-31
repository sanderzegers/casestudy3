<?php
/*
 * Created on Feb 17, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 class Cart extends MY_Controller{
 
	/** Show cart contents */
	public function show(){
		$this->load->view('head/standard');
		$this->createMenuLeft();
		
		$myCart = $this->session->userdata('myCart');
		
		$this->load->view('content_center/cartcontent',array("title" => "Warenkorb","myCart" => $myCart));
		$this->createMiniCartRight();;
		$this->load->view('foot/standard');
	}
	

	/** Add article to your cart */
	public function add(){
		
		$sourceSite = $this->input->post('currentSite');
		$artikel = unserialize(base64_decode($this->input->post('article')));
		$myCart = $this->session->userdata('myCart');
		
		$myCart->add($artikel,1);
		$this->session->set_userdata(array("myCart" => $myCart));
		redirect($sourceSite);
		
	}
	
	/** Add, subtract or remove article from the cart */
	public function action(){
		
		$sourceSite = $this->input->post('currentSite');
		$actionType = $this->input->post('actionType');
		$artikel = unserialize(base64_decode($this->input->post('article')));
		$myCart = $this->session->userdata('myCart');
		
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
		
		$this->session->set_userdata(array("myCart" => $myCart));
		
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
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		
		if($this->form_validation->run('address') == FALSE){
			$this->load->view('head/standard');
			$this->createMenuLeft();
		
			$myCart = $this->session->userdata('myCart');
			$costumer = $this->session->userdata('costumer');
				
			$this->load->view('content_center/checkout1',array("title" => "Warenkorb","myCart" => $myCart, "costumer" => $costumer));
			$this->createMiniCartRight();
			$this->load->view('foot/standard');
		}
		else{
		
		$costumerArray["KundeName"] = set_value('lastname');
		$costumerArray["KundeVorname"] = set_value('firstname');
		$costumerArray["KundeAdresse"] = set_value('address');
		$costumerArray["KundePLZ"] = set_value('zipcode');
		$costumerArray["KundeOrt"] = set_value('location');
		$costumerArray["KundeTelefon"] = set_value('phone');
		$costumerArray["KundeMail"] = set_value('email');
		
		$costumer = new CostumerClass((object)$costumerArray);
		
		$this->session->set_userdata(array('costumer'=>$costumer));
		
		$this->checkout2();
		
		}
	}
	
	/** 2. Checkout step: Confirm Details */
	public function checkout2(){
		$this->load->view('head/standard');
		$this->createMenuLeft();
		
		$myCart = $this->session->userdata('myCart');
		$costumer = $this->session->userdata('costumer');
				
		
		$this->load->view('content_center/checkout2',array("title" => "Warenkorb","myCart" => $myCart, "costumer" => $costumer));
		$this->createMiniCartRight();;
		$this->load->view('foot/standard');
	}
	
	/** Check out succesful: Send Confirmation E-Mail. Destroy Cart*/
	public function checkoutsuccess(){
		
		$costumer = $this->session->userdata('costumer');
		$currency = $this->config->item('currency'); 
		$emailTemplate = $this->config->item('emailTemplate'); 
		
		$myCart = $this->session->userdata('myCart');
		$costumer = $this->session->userdata('costumer');
		
		$body = file_get_contents($emailTemplate);
		
		$CART = '';
		
		// Replace {CART}
		
		foreach ($myCart->getContent() as $position){
			$CART = $CART.$position["menge"]." Stück\n";
			$CART = $CART.$position["artikel"]->bezeichnung."\n";	
			$temp = sprintf("%01.2f", $position["artikel"]->preis*$position["menge"]);
			$CART = $CART.$currency." ".$temp."\n\n";
		}
		$body = str_replace("{CART}",$CART,$body);
		
		// Replace {CARTVALUE}
		$CARTVALUE = $currency." ".sprintf("%01.2f", $myCart->getTotalValue());
		$body = str_replace("{CARTVALUE}",$CARTVALUE,$body);
		
		// Replace {ADDRESS}
		$ADDRESS = $costumer->vorname." ".$costumer->name."\n";
		$ADDRESS = $ADDRESS.$costumer->adresse."\n";
		$ADDRESS = $ADDRESS.$costumer->plz." ".$costumer->ort."\n";
		$body = str_replace("{ADDRESS}",$ADDRESS,$body);
		
		$this->load->library('email');
		$this->email->from('webshop@z2h.com', 'Z2H Webshop');
		$this->email->to($costumer->email); 
		$this->email->subject('Ihre Bestellung bei Z2H Webshop');
		$this->email->message($body);
		$this->email->send();
		
		$myCart = $this->session->userdata('myCart');
		$myCart->destroy();
		$this->session->set_userdata(array("myCart" => $myCart));
						
		$this->load->view('head/standard');
		$this->createMenuLeft();
		$this->load->view('content_center/checkoutsuccess',array("title" => "Warenkorb"));
		$this->createMiniCartRight();;
		$this->load->view('foot/standard');
		
		
		
	}
	
	/** Empty the cart */
	public function destroy(){

		$myCart = $this->session->userdata('myCart');
		$myCart->destroy();
		$this->session->set_userdata(array("myCart" => $myCart));
		redirect($this->input->post('currentSite'));
				
	}
	
	
		
 }
 
?>
