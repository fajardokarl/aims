<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Subsidiaryaccount extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Subsidiaryaccount_model','account');
		$this->data['customjs'] = 'subsidiaryaccount_js';
		$this->data['navigation'] = 'navigation';
	}

	public function index(){
		$this->data['content'] = 'subsidiaryaccount_view';
		$this->data['page_title'] = 'Subsidiary Accounts';
		$this->data['rec_customers'] = $this->account->getCustomers();
		$this->data['rec_departments'] = $this->account->getDepartments();
		$this->data['rec_suppliers'] = $this->account->getSuppliers();
		$this->data['rec_employees'] = $this->account->getEmployees();
		$this->data['rec_projects'] = $this->account->getProjects();

		if(isset($this->session->userdata['logged_in'])){
			$this->load->view('default/index', $this->data);
		}
	}

	public function updateCustomer(){
		$info = [
			'subsidiary_code' => strtoupper($this->input->post('subsidiary_code'))
		];
		$this->account->updateCustomer($info, $this->input->post('record_id'));
		redirect('Accounting/Subsidiaryaccount', 'refresh');
	}

	public function updateDepartment(){
		$info = [
			'activity_code' => strtoupper($this->input->post('subsidiary_code'))
		];
		$this->account->updateDepartment($info, $this->input->post('record_id'));
		redirect('Accounting/Subsidiaryaccount', 'refresh');
	}	

	public function updateSupplier(){
		$info = [
			'subsidiary_code' => strtoupper($this->input->post('subsidiary_code'))
		];
		$this->account->updateSupplier($info, $this->input->post('record_id'));
		redirect('Accounting/Subsidiaryaccount', 'refresh');
	}

	public function updateEmployee(){
		$info = [
			'subsidiary_code' => strtoupper($this->input->post('subsidiary_code'))
		];
		$this->account->updateEmployee($info, $this->input->post('record_id'));
		redirect('Accounting/Subsidiaryaccount', 'refresh');
	}

	public function updateProject(){
		$info = [
			'subsidiary_code' => strtoupper($this->input->post('subsidiary_code'))
		];
		$this->account->updateProject($info, $this->input->post('record_id'));
		redirect('Accounting/Subsidiaryaccount', 'refresh');
	}

	public function checkSubCode(){
		$id = $this->input->post('tablename').'_id <>';
		$data = $this->account->checkSubCode($this->input->post('tablename'), $this->input->post('fieldname'), $this->input->post('subcode'),$id, $this->input->post('record_id'));	
		echo json_encode($data);
	}
}