<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lotcost extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Lotcost_model', 'cost');
		$this->data['customjs'] = 'lotcost_js';
		$this->data['navigation'] = 'navigation';
	}

	public function index(){
		$this->data['content'] = 'lotcost_view';
		$this->data['page_title'] = 'Cost of Lot';
		$this->data['records'] = $this->cost->getLotCost();
		$this->data['rec_projects'] = $this->cost->getProjects();
		$this->data['rec_phases'] = $this->cost->getPhases();
 
		if(isset($this->session->userdata['logged_in'])){
			$this->load->view('default/index', $this->data);
		}
	}

	public function insertLotCost(){
		$info = array(
			'project_id' => $this->input->post('project_id'),
			'phase_id' => $this->input->post('phase_id'),
			'cost_month' => $this->input->post('cost_month'),
			'cost_year' => $this->input->post('cost_year'),
			'lot_cost' => $this->input->post('lot_cost'),
			'devt_cost' => $this->input->post('devt_cost'),
			'xu_share' => $this->input->post('xu_share'),
			'house_cost' => $this->input->post('house_cost'),
			'tucked_in_share' => $this->input->post('tucked_in_share'),
			'transfer_fee' => $this->input->post('transfer_fee')
		);
		$this->cost->insertLotCost($info);
		redirect('Accounting/Lotcost','refresh');
	}

	public function updateLotCost(){
		$info = array(
			'project_id' => $this->input->post('project_id'),
			'phase_id' => $this->input->post('phase_id'),
			'cost_month' => $this->input->post('cost_month'),
			'cost_year' => $this->input->post('cost_year'),
			'lot_cost' => $this->input->post('lot_cost'),
			'devt_cost' => $this->input->post('devt_cost'),
			'xu_share' => $this->input->post('xu_share'),
			'house_cost' => $this->input->post('house_cost'),
			'tucked_in_share' => $this->input->post('tucked_in_share'),
			'transfer_fee' => $this->input->post('transfer_fee')
		);
		$this->cost->updateLotCost($info, $this->input->post('lot_cost_id'));
		redirect('Accounting/Lotcost', 'refresh');
	}

	public function getLotCostByID(){
		$data = $this->cost->getLotCostByID($this->input->post('lotcostid'));
		echo json_encode($data);
	}
}