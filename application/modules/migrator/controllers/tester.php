<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tester extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('testing_model', 'test');
		$this->data['customjs'] = 'tester_js';

	}

	public function index(){
		$this->data['content'] = 'tester_view';
		$this->data['page_title'] = 'Testing';
		var_dump($this->test->getMssql());
		//$this->load->view('default/index', $this->data);
	}//end function


}//end

