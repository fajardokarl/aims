<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Merger extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Merger_model', 'merge');
		$this->data['customjs'] = 'merger_js';
	}

	public function index(){
		$this->data['content'] = 'merger_view';
		$this->data['page_title'] = 'Merger';
		$this->data['records'] = $this->merge->getAll();
		$this->data['record2s'] = $this->merge->getAll2();

		$this->load->view('default/index', $this->data);
	}

	public function findPersonByID(){
		$data = $this->merge->findPersonByID($this->input->post('personid'));
		echo json_encode($data);
	}

	public function merge(){
		$info = array(
			'mergeto' => $this->input->post('mainid')
		);
		$this->merge->upd_Person($info, $this->input->post('mergeid'));
	}
}