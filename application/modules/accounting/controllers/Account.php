<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Account_model', 'account');
		$this->data['customjs'] = 'account_js';
		$this->data['navigation'] = 'navigation';
	}

	public function index(){
		$this->data['content'] = 'account_view';
		$this->data['page_title'] = 'Chart of Accounts';
		$this->data['records'] = $this->account->getAccounts();

		if(isset($this->session->userdata['logged_in'])){
			$this->load->view('default/index', $this->data);
		}
	}

	public function insertAccount(){
		$this->db->trans_start();
		$info = [
			'account_code' => $this->input->post('account_code'),
			'account_name' => $this->input->post('account_name'),
			'status_id' => '1'
		];
		$accountid = $this->account->insertAccount($info);

		foreach ($this->input->post('subsidiary_code') as $key => $value) {
			if ($this->input->post('subsidiary_code')[$key]) {
				$infodetail = array(
					'account_id' => $accountid,
					'subsidiary_code' => $this->input->post('subsidiary_code')[$key],
					'subsidiary_description' => $this->input->post('subsidiary_description')[$key],
					'status_id' => $this->input->post('substatus')[$key]
				);
				$this->account->insertSubAccount($infodetail);
			}
		}
		$this->db->trans_complete();
		redirect('Accounting/Account', 'refresh');
	}

	public function updateAccount(){
		$this->db->trans_start();
		$accountid = $this->input->post('account_id');
		$info = [
			'account_code' => $this->input->post('account_code'),
			'account_name' => $this->input->post('account_name')
		];
		$this->account->updateAccount($info, $accountid);

		if(is_array($this->input->post('subsidiary_code')) || is_object($this->input->post('subsidiary_code'))){
			foreach ($this->input->post('subsidiary_code') as $key => $value) {
				$subaccountid = $this->input->post('account_subsidiary_id')[$key];
				if ($subaccountid == '') {
					if ($this->input->post('subsidiary_code')[$key]) {
						$infodetail = array(
							'account_id' => $accountid,
							'subsidiary_code' => $this->input->post('subsidiary_code')[$key],
							'subsidiary_description' => $this->input->post('subsidiary_description')[$key],
							'status_id' => $this->input->post('substatus')[$key]
						);
						$this->account->insertSubAccount($infodetail);
					}
				} else {
					$infodetail = array(
						'subsidiary_code' => $this->input->post('subsidiary_code')[$key],
						'subsidiary_description' => $this->input->post('subsidiary_description')[$key],
						'status_id' => $this->input->post('substatus')[$key]
					);
					$this->account->updateSubAccount($infodetail, $subaccountid);
				}
			}	
		}
		$this->db->trans_complete();
		redirect('Accounting/Account', 'refresh');
	}

	public function changeStatus(){
		$info = [
			'status_id' => $this->input->post('mod_statusid')
		];
		$this->account->updateAccount($info, $this->input->post('mod_accountid'));
		redirect('Accounting/Account', 'refresh');
	}

	public function getAccountByID(){
		$data = $this->account->getAccountByID($this->input->post('account_id'));
		echo json_encode($data);
	}

	public function getSubAccountByID(){
		$data = $this->account->getSubAccountByID($this->input->post('account_id'));
		echo json_encode($data);
	}

	public function checkSubCode(){
		$data = $this->account->checkSubCode($this->input->post('account_code'), $this->input->post('account_id'));
		echo json_encode($data);
	}


}