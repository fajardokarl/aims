<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->model('Bank_model','bank');
		$this->data['customjs'] = 'bank_js';
		$this->data['navigation'] = 'navigation';
	}

	public function index(){
		$this->data['content'] = 'bank_view';
		$this->data['page_title'] = 'Bank Masterlist';
		$this->data['records'] = $this->bank->getBanks();
		$this->data['rec_cities'] = $this->bank->getCities();
		$this->data['rec_provinces'] = $this->bank->getProvinces();
		$this->data['rec_countries'] = $this->bank->getCountries();

		if(isset($this->session->userdata['logged_in'])){
			$this->load->view('default/index', $this->data);
		}
	}

	public function insertBank(){
		$this->db->trans_start();
		$contactinfo = array(
			'person_id' => 0,
			'contact_type_id' => 2,
			'contact_value' => $this->input->post('contact_number'),
			'status_id' => 1
		);
		$contactid = $this->bank->insertContact($contactinfo);

		$addressinfo = array(
			'line_1' => $this->input->post('line_1'),
			'line_2' => $this->input->post('line_2'),
			'line_3' => $this->input->post('line_3'),
			'city_id' => $this->input->post('city_id'),
			'province_id' => $this->input->post('province_id'),
			'country_id' => $this->input->post('country_id'),
			'postal_code' => $this->input->post('postal_code'),
			'address_type_id' => 2
		);
		$addressid = $this->bank->insertAddress($addressinfo);

		$info = array(
			'bank_name' => $this->input->post('bank_name'),
			'account_number' => $this->input->post('account_number'),
			'person_id' => 0,
			'type' => 0,
			'address_id' => $addressid,
			'contact_id' => $contactid,
			'status_id' => 1
		);
		$this->bank->insertBank($info);
		$this->db->trans_complete();
		redirect('Accounting/Bank','refresh');
	}

	public function updateBank(){
		$this->db->trans_start();
		$contactinfo = array(
			'person_id'=> 0,
			'contact_type_id' => 2,
			'contact_value' => $this->input->post('contact_number'),
			'status_id' => 1
		);
		$this->bank->updateContact($contactinfo, $this->input->post('contact_id'));

		$addressinfo = array(
			'line_1' => $this->input->post('line_1'),
			'line_2' => $this->input->post('line_2'),
			'line_3' => $this->input->post('line_3'),
			'city_id' => $this->input->post('city_id'),
			'province_id' => $this->input->post('province_id'),
			'country_id' => $this->input->post('country_id'),
			'postal_code' => $this->input->post('postal_code'),
			'address_type_id' => 2
		);
		$this->bank->updateAddress($addressinfo, $this->input->post('address_id'));

		$info = array(
			'bank_name' => $this->input->post('bank_name'),
			'account_number' => $this->input->post('account_number'),
		);
		$this->bank->updateBank($info, $this->input->post('bank_id'));
		$this->db->trans_complete();
		redirect('Accounting/Bank', 'refresh');
	}

	public function getBankByID(){
		$data = $this->bank->getBankByID($this->input->post('bank_id'));
		echo json_encode($data);
	}
}