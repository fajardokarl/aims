<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Monthlypost extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Monthlypost_model', 'posting');
		$this->data['customjs'] = 'monthlypost_js';
		$this->data['navigation'] = 'navigation';
	}

	public function index(){
		$this->data['content'] = 'monthlypost_view';
		$this->data['page_title'] = 'Monthly Posting';
		$this->createFiscalPosting();
		$this->data['records'] = $this->posting->getFiscalYear();

		if(isset($this->session->userdata['logged_in'])){
			$this->load->view('default/index', $this->data);
		}
	}

	public function getLocked(){
		$this->db->trans_start();
		if (!empty($this->input->post('fiscal_id'))) {
			$rec_trans = $this->posting->getTransactionByRange($this->input->post('begin_date'), $this->input->post('end_date'));
			if ($rec_trans != false) {
				foreach ($rec_trans as $rec_tran) {
					$info = [
						'is_locked' => $this->input->post('is_locked')
					];
					$this->posting->updateTransaction($info, $rec_tran['transaction_id']);
				}
			}

			$fiscalinfo = [
				'is_locked' => $this->input->post('is_locked')
			];
			$this->posting->updateFiscalMonth($fiscalinfo, $this->input->post('fiscal_id'));
		}
		$this->db->trans_complete();
		redirect('Accounting/Monthlypost', 'refresh');
	}

	public function getPosted(){
		$this->db->trans_start();
		$msg = [];
		$rec_trans = $this->posting->getTransSumCreditDebit($this->input->post('begin_date'), $this->input->post('end_date'));
		if ($rec_trans) {
			foreach ($rec_trans as $rec_tran) {
				if ($rec_tran['total'] == '0.00') {
					$info = [
						'post_date' => date('Y-m-d h:i:s'),
						'post_status' => 'posted',
						'edit_by' => $this->session->userdata['user_id'],
						'edit_date' => date('Y-m-d h:i:s')
					];
					$this->posting->updateTransaction($info,$rec_tran['transaction_id']);
				} else {
					array_push($msg, $rec_tran['transaction_id']);
				}
			}//end foreach rec_trans
		}//end if
		if (sizeof($msg) == 0) {
			$fiscalinfo = [
				'status' => 'posted'
			];
			$this->posting->updateFiscalMonth($fiscalinfo, $this->input->post('fiscal_id'));
		}
		$this->db->trans_complete();
		redirect('Accounting/Monthlypost', 'refresh');
	}

	public function getTransactions(){
		$data = $this->posting->getTransactionOrderByStatus($this->input->post('begin_date'), $this->input->post('end_date'));
		echo json_encode($data);
	}

	function createFiscalPosting(){
		if (!$this->posting->findFiscalMonth(date('Y-m-01'))) {
			$info = [
				'fiscal_name' => date('Y').'-'.date('F'),
				'begin' => date('Y-m-01 00:00:00'),
				'end' => date('Y-m-t 23:59:59'),
				'status' => 'draft',
				'is_locked' => 'no'
			];	
			$this->posting->insertFiscalMonth($info);
		}
	}

}