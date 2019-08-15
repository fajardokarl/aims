<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Accounting extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->data['navigation'] = 'navigation';
	}

	public function index(){
		$this->data['content'] = 'dashboard';
		$this->data['page_title'] = 'Accounting';
		$this->load->view('default/index', $this->data);
	}
}