<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Item_model');
		$this->load->model('Legacy_model');
	}

	public function index(){
		
	}
}