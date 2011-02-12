<?php

class Site extends CI_Controller {
	
/*
	function index(){
		$this->load->model("testdb");
		$data['query'] = $this->testdb->test();
		$this->load->view("home",$data);
		
	}
	
	function test(){
		$data['myTitle'] = "My Test Title from the Controller";
		$data['myH2'] = "H2 from the controller";
		$this->load->view("home",$data);
	}
*/


	function index(){
		$this->load->model("day2");
		$data['rows'] = $this->day2->getAll();
		
		$this->load->view("day2",$data);
	}
	
	function __construct() {
        parent::__construct();
    }  
	
	
}
