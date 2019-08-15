<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Issuance extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('issuance_model', 'issuance');		
		$this->load->helper(array('form', 'url'));
		$this->data['navigation'] = 'warehouse/navigation';
		$this->data['customjs'] = 'warehouse/issuance_js';
		$this->data['verifies'] = $this->issuance->get_verifies();
	}

	public function index(){
		$this->data['content'] = 'issuance_prfs';
		$this->data['page_title'] = 'Issuances';
		// $this->load->helper('url');
		// $this->load->helper('date');				
		$this->load->view('default/index', $this->data);
	}

	/*public function issuance_prf(){
		$this->data['content'] = 'issuance_prf';
	      $this->data['page_title'] = 'PRF Details';
	      // $this->data['amort'] = $this->message->get_amortization($this->input->get('contractid'));
	      $this->data['po'] = $this->issuance->getOnePrf($this->input->get('po_id'));
	      $this->data['po_details'] = $this->issuance->get_details_messages($this->input->get('po_id'));
	      $this->data['po_id'] = $this->issuance->get_po_id($this->input->get('prf_id'));
	      // $this->data['payment'] = $this->message->paid_amortization_model($this->input->get('contractid'));
	      // $this->data['cont_stat_val'] = $this->message->contract_status_model();
	      $this->load->view('default/index', $this->data);
	}*/

	public function issuance_prf(){
		$this->data['content'] = 'issuance_prf';
	      $this->data['page_title'] = 'PRF Details';
	      // $this->data['amort'] = $this->message->get_amortization($this->input->get('contractid'));
	      $this->data['prf'] = $this->issuance->getOnePrf($this->input->get('prf_id'));
	      $this->data['prf_details'] = $this->issuance->get_details_messages($this->input->get('prf_id'));
	      $this->data['po_id'] = $this->issuance->get_po_id($this->input->get('prf_id'));
	      // $this->data['payment'] = $this->message->paid_amortization_model($this->input->get('contractid'));
	      // $this->data['cont_stat_val'] = $this->message->contract_status_model();
	      $this->load->view('default/index', $this->data);
	}

	public function request_mis(){
		$this->data['content'] = 'request_mis';
		$this->data['page_title'] = 'Request for a Materials Issuance Slip';
		$this->load->view('default/index', $this->data);
	}

}