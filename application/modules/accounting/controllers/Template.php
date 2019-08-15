<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->model('Template_model', 'template');
		$this->data['customjs'] = 'template_js';
		$this->data['navigation'] = 'navigation';
	}

	public function index(){
		$this->data['content'] = 'template_view';
		$this->data['page_title'] = 'Transaction Template';
		$this->data['records'] = $this->template->getTemplate();
		$this->data['rec_accounts'] = $this->template->getAccounts();
		if(isset($this->session->userdata['logged_in'])){
			$this->load->view('default/index', $this->data);
		}
	}

	public function insertTemplate(){
		$this->db->trans_start();
		foreach ($this->input->post('account_code') as $i => $value) {
			if($this->input->post('account_code')[$i]){
				$info = array(
					'transaction_type' => $this->input->post('transaction_type'),
					'drcr' => $this->input->post('drcr')[$i],
					'account_code' => $this->input->post('account_code')[$i],
					'remarks' => $this->input->post('remarks')[$i]
				);
				$this->template->insertTemplate($info);
			}
		}
		$this->db->trans_complete();
		redirect('Accounting/Template', 'refresh');
	}

	public function updateTemplate(){
		$this->db->trans_start();
		foreach ($this->input->post('account_code') as $i => $value) {
			if($this->input->post('id')[$i] == ''){
				if(trim($this->input->post('account_code')[$i])){
					$info = array(
						'transaction_type' => $this->input->post('transaction_type'),
						'drcr' => $this->input->post('drcr')[$i],
						'account_code' => $this->input->post('account_code')[$i],
						'remarks' => $this->input->post('remarks')[$i]
					);
					$this->template->insertTemplate($info);
				}
			} else {
				$info = array(
					'transaction_type' => $this->input->post('transaction_type'),
					'drcr' => ($this->input->post('account_code') == '')? '': $this->input->post('drcr')[$i],
					'account_code' => $this->input->post('account_code')[$i],
					'remarks' => $this->input->post('remarks')[$i]
				);
				$this->template->updateTemplate($info, $this->input->post('id')[$i]);
			}
		}
		$this->db->trans_complete();
		redirect('Accounting/Template','refresh');
	}

	public function getTemplateByTransactionType(){
		$data = $this->template->getTemplateByTransactionType($this->input->post('transaction_type'));
		echo json_encode($data);
	}

	public function checkAccountCode(){
		$data = $this->template->checkAccountCode($this->input->post('account_code'));
		echo json_encode($data);
	}
}