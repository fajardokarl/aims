<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rubix extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('rubix_view');
	}//end index
}//end class