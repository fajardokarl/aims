<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Attachmenttype extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Attachmenttype_model', 'attach');
		$this->data['customjs'] = 'attachmenttype_js';
		$this->data['navigation'] = 'navigation';
	}

	public function index(){
		$this->data['content'] = 'attachmenttype_view';
		$this->data['page_title'] = 'Attachment Type Setting';
		$this->data['records'] = $this->attach->getAttach();

		if(isset($this->session->userdata['logged_in'])){
			$this->load->view('default/index', $this->data);
		}
	}

	public function insertAttach(){
		$info = array(
			'attachment_type' => $this->input->post('attachment_type'),
			'description' => $this->input->post('description')
		);
		$this->attach->insertAttach($info);
		redirect('Accounting/Attachmenttype', 'refresh');
	}

	public function updateAttach(){
		$info = array(
			'attachment_type' => $this->input->post('attachment_type'),
			'description' => $this->input->post('description')
		);
		$this->attach->updateAttach($info, $this->input->post('attachment_type_id'));
		redirect('Accounting/Attachmenttype', 'refresh');
	}

	public function getAttachByID(){
		$data = $this->attach->getAttachByID($this->input->post('attachid'));
		echo json_encode($data);
	}
}