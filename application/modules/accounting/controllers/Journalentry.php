<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Journalentry extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Journalentry_model', 'journal');
		$this->data['customjs'] = 'journalentry_js';
		$this->data['navigation'] = 'navigation';
	}

	public function index(){
		$this->data['content'] = 'journalentry_view';
		$this->data['page_title'] = 'Jounal Entry';
		//$begin = date('Y-m-01');
		//$end = date('Y-m-d 23:59:59');
		//$this->data['records'] = $this->journal->getJournalByRange($begin,$end);
		$this->data['rec_customers'] = $this->journal->getCustomers();
		$this->data['rec_departments'] = $this->journal->getDepartments();
		$this->data['rec_suppliers'] = $this->journal->getSuppliers();
		$this->data['rec_employees'] = $this->journal->getEmployees();
		$this->data['rec_projects'] = $this->journal->getProjects();
 		$this->data['rec_books'] = $this->journal->getBooks();
		$this->data['rec_accounts'] = $this->journal->getAccount();
		$this->data['rec_subsidiaries'] = $this->journal->getSubsidiary();

		if(isset($this->session->userdata['logged_in'])){

			$this->load->view('default/index', $this->data);
		}
	}

	public function insertJournal(){
		$this->db->trans_start();
		//$refnum = substr($this->input->post('reference_number'), 13,strlen($this->input->post('reference_number'))-13);
		$info = array(
			'book_code' => strtoupper($this->input->post('book_code')),
			'book_prefix' => $this->input->post('reference_code'),
			//'reference' => $refnum,
			'reference' => $this->input->post('reference_number'),
			'subsidiary_code' => $this->input->post('sub_code'),
			'subsidiary_table' => $this->input->post('subsidiary_table'),
			'subsidiary_name' => $this->input->post('department'),
			'remarks' => $this->input->post('remarks'),
			'encode_by' => $this->input->post('user_id'),
			'encode_date' => $this->input->post('date_now'),
			'edit_by' => '',
			'edit_date' => '',
			'location_id' => $this->input->post('userdepartment_id'),
			'post_date' => ($this->input->post('post_status') == 'posted')? $this->input->post('post_date'):'',
			'post_status' => $this->input->post('post_status'),
			'is_locked' => $this->input->post('is_locked')
		);
		$transaction_id = $this->journal->insertTransaction($info);

		foreach ($this->input->post('account_code') as $i => $value) {
			if(trim($this->input->post('account_code')[$i])){
				$infodetail = array(
					'transaction_id' => $transaction_id,
					'book_code' => $this->input->post('book_code'),
					'prefix' => $this->input->post('reference_code'),
					'reference' => $this->input->post('reference_number'),
					'account_code' => $this->input->post('account_code')[$i],
					'period_id' => '',
					'post_date' => ($this->input->post('post_status') == 'posted')? $this->input->post('post_date'):'',
					'activity_code' => '',
					'debit' => $this->input->post('debit')[$i],
					'credit' => $this->input->post('credit')[$i],
					'remarks' => $this->input->post('detail_remarks')[$i],
					'subsidiary_code' => $this->input->post('subsidiary_code')[$i]
				);
				$this->journal->insertTransactionDetail($infodetail);
			}
		}
		$this->db->trans_complete();
		redirect('accounting/journalentry', 'refresh');
	}

	public function updateJournal(){
		$this->db->trans_start();
		$transactionid = $this->input->post('transaction_id');
		$info = array(
			'book_code' => $this->input->post('book_code'),
			'book_prefix' => $this->input->post('reference_code'),
			'reference' => $this->input->post('reference_number'),
			'subsidiary_code' => $this->input->post('sub_code'),
			'subsidiary_table' => $this->input->post('subsidiary_table'),
			'subsidiary_name' => $this->input->post('department'),
			'remarks' => $this->input->post('remarks'),
			'edit_by' => $this->input->post('user_id'),
			'edit_date' => $this->input->post('date_now'),
			'location_id' => $this->input->post('userdepartment_id'),
			'post_date' => ($this->input->post('post_status') == 'posted')? $this->input->post('post_date'):'',
			'post_status' => $this->input->post('post_status'),
			'is_locked' => $this->input->post('is_locked')
		);
		$this->journal->updateTransaction($info, $transactionid);

		if(is_array($this->input->post('account_code')) || is_object($this->input->post('account_code'))){
			foreach ($this->input->post('account_code') as $i => $value) {
				$transactiondetailid = $this->input->post('transaction_detail_id')[$i];			
				if($transactiondetailid == '0'){
					if(trim($this->input->post('account_code')[$i])){
						$infodetail = array(
							'transaction_id' => $transactionid,
							'book_code' => $this->input->post('book_code'),
							'prefix' => $this->input->post('reference_code'),
							'reference' => $this->input->post('reference_number'),
							'account_code' => $this->input->post('account_code')[$i],
							'period_id' => '',
							'post_date' => ($this->input->post('post_status') == 'posted')? $this->input->post('post_date'):'',
							'activity_code' => '',
							'debit' => $this->input->post('debit')[$i],
							'credit' => $this->input->post('credit')[$i],
							'remarks' => $this->input->post('detail_remarks')[$i],
							'subsidiary_code' => $this->input->post('subsidiary_code')[$i]
						);
						$this->journal->insertTransactionDetail($infodetail);
					}
				} else {
					$infodetail = array(
						'book_code' => $this->input->post('book_code'),
						'prefix' => $this->input->post('reference_code'),
						'reference' => $this->input->post('reference_number'),
						'account_code' => $this->input->post('account_code')[$i],
						'period_id' => '',
						'post_date' => ($this->input->post('post_status') == 'posted')? $this->input->post('post_date'):'',
						'activity_code' => '',
						'debit' => $this->input->post('debit')[$i],
						'credit' => $this->input->post('credit')[$i],
						'remarks' => $this->input->post('detail_remarks')[$i],
						'subsidiary_code' => $this->input->post('subsidiary_code')[$i]
					);
					$this->journal->updateTransactionDetail($infodetail, $transactiondetailid);
				}
			}
		}
		$this->db->trans_complete();
		redirect('accounting/journalentry', 'refresh');
	}


	public function setSubsidiaryTableByCode(){
		$data = $this->journal->setSubsidiaryTableByCode($this->input->post('accountcode'));
		echo json_encode($data);
	}

	public function getJournalByRange(){
		$end = trim($this->input->post('end')). ' 23:59:59';
		$data = $this->journal->getJournalByRange($this->input->post('begin'), $end);
		echo json_encode($data);
	}

	public function getTransactionByID(){
		$data = $this->journal->getTransactionByID($this->input->post('transactionid'));
		echo json_encode($data);
	}

	public function getTransactionDetailByID(){
		$data = $this->journal->getTransactionDetailByID($this->input->post('transactionid'));
		echo json_encode($data);
	}

	public function getMaxReference(){
		$data = $this->journal->getMaxReference($this->input->post('prefix'));
		echo json_encode($data);
	}

	public function getBookByCode(){
		$data = $this->journal->getBookByBookCode($this->input->post('bookcode'));
		echo json_encode($data);
	}

	public function getActivityByCode(){
		$data = $this->journal->getActivityByCode($this->input->post('activitycode'));
		echo json_encode($data);
	}

	public function getAccountByCode(){
		$data = $this->journal->getAccountByCode($this->input->post('accountcode'));
		echo json_encode($data);
	}

	public function getSubsidiaryByCode(){
		$data = $this->journal->getSubsidiaryByCode($this->input->post('accountcode'), $this->input->post('subsidiarycode'));
		echo json_encode($data);
	}

	public function getAccountCode(){
		$data = $this->journal->getAccount();
		echo json_encode($data);
	}

	public function getAccountSubsidiary(){
		$data = $this->journal->getAccountSubsidiaryByAccountID($this->input->post('accountid'));
		echo json_encode($data);
	}
}