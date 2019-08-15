<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Checkvoucher extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Checkvoucher_model', 'check');
		$this->data['customjs'] = 'checkvoucher_js';
		$this->data['navigation'] = 'navigation';
	}

	public function index(){
		$this->data['content'] = 'checkvoucher_view';
		$this->data['page_title'] = 'Check Voucher';
		$this->data['rec_banks'] = $this->check->getBanks();
		$this->data['rec_ric'] = $this->check->getRICs();
		$this->data['rec_employees'] = $this->check->getEmployees();
		if(isset($this->session->userdata['logged_in'])){
			$this->load->view('default/index', $this->data);
		}
	}

	public function view_CV(){
		$id = $this->uri->segment(4,0);
		$this->data['content'] = 'viewcv_view';
		$this->data['customjs'] = 'viewcv_js';
		$this->data['page_title'] = 'Check Voucher';

		if (isset($this->session->userdata['logged_in'])) {
			$this->data['rec_cv'] = $this->check->getCVViewByID($id);
			$this->data['rec_cvdetails'] = $this->check->getCVDetailViewByID($id);
			$this->data['rec_actions'] = $this->check->getCVActionViewByID($id);
			$this->data['rec_userrole'] = $this->check->getUserRole($id,$this->session->userdata['user_id'], '6');

			$this->load->view('default/index', $this->data);
		}
	}

	public function insertCV(){
		$this->db->trans_start();
		$info = array(
			'ric_id' => $this->input->post('ric_id'),
			'bank_id' => $this->input->post('bank_id'),
			'reference_number' => $this->input->post('reference_number'),
			'payee_table' => $this->input->post('payee_table'),
			'payee_id' => $this->input->post('payee_id'),
			'payee' => $this->input->post('payee'),
			'check_amount' => $this->input->post('check_amount'),
			'check_amount_words' => $this->input->post('check_amount_words'),
			'received_from' => $this->input->post('received_from'),
			'payment_type' => $this->input->post('payment_type'),
			'prepared_by' => $this->session->userdata('employee_id'),
			'check_voucher_date' => date("Y-m-d H:i:s"),
			'check_date' => $this->input->post('check_date'),
			'action_status' => 'Submitted',
			'is_issued' => 0
		);
		$cvid = $this->check->insertCV($info);
		
		$infoaction = array(
			'check_voucher_id' => $cvid,
			'action_id' => '9', 
			'action_employee_id' => $this->session->userdata('employee_id'),
			'action_date' => date('Y-m-d H:i:s')
		);
		$this->check->insertCVAction($infoaction);

		foreach ($this->input->post('particular') as $i => $value) {
			if (trim($this->input->post('particular')[$i])) {
				$infodetail = array(
					'check_voucher_id' => $cvid,
					'particular' => $this->input->post('particular')[$i],
					'amount' => $this->input->post('amount')[$i]	
				);
				$this->check->insertCVDetail($infodetail);
			}
		}

		$message = array(
			'sender_id' => $this->session->userdata('employee_id'),
			'subject' => 'CV '.$cvid.' Submitted for Approval',
			'body' => 'Please approve this check voucher: '.$cvid,
			'date_sent' => date('Y-m-d H:i:s'),
			'template_id' => 1
		);
		$recipients = $this->check->getRecipient('6','3');
		$recipient = array();
		foreach ($recipients as $rec_recipient) {
		 	$recipient[] = array('recipient_id' => $rec_recipient['employee_id'],'status_id' => 1);
		} 
		$inboxdata = array(
			'employee_id' => $this->session->userdata('employee_id'),
			'forward_uri' => base_url().'Accounting/Checkvoucher/view_CV/'.$cvid,
			'seen' => 0,
			'answered' => 0,
			'archive' => 0,
			'important' => 0,
			'deleted' => 0,
			'status_id' => 1
		);
		$inbox = new Mailbox();
		$inbox->send($message, $recipient, $inboxdata);
		
		$this->db->trans_complete();
		redirect('Accounting/Checkvoucher', 'refresh');
	}

	public function updateCV(){
		$this->db->trans_start();
		$info = array(
			'ric_id' => $this->input->post('ric_id'),
			'bank_id' => $this->input->post('bank_id'),
			'reference_number' => $this->input->post('reference_number'),
			'payee_table' => $this->input->post('payee_table'),
			'payee_id' => $this->input->post('payee_id'),
			'payee' => $this->input->post('payee'),
			'check_amount' => $this->input->post('check_amount'),
			'check_amount_words' => $this->input->post('check_amount_words'),
			'received_from' => $this->input->post('received_from'),
			'payment_type' => $this->input->post('payment_type'),
			'prepared_by' => $this->input->post('prepared_by'),
			'check_date' => $this->input->post('check_date'),
			'action_status' => 'Submitted'
		);
		$this->check->updateCV($info, $this->input->post('check_voucher_id'));

		if (is_array($this->input->post('particular')) || is_object($this->input->post('particular'))) {
			foreach ($this->input->post('particular') as $i => $value) {
				if($this->input->post('cv_detail_id')[$i] == ''){
					if (trim($this->input->post('particular')[$i])) {
						$infodetail = array(
							'check_voucher_id' => $this->input->post('check_voucher_id'),
							'particular' => $this->input->post('particular')[$i],
							'amount' => $this->input->post('amount')[$i]
						);
						$this->check->insertCVDetail($infodetail);
					}
				} else {
					$infodetail = array(
						'particular' => $this->input->post('particular')[$i],
						'amount' => $this->input->post('amount')[$i]
					);
					$this->check->updateCVDetail($infodetail, $this->input->post('cv_detail_id')[$i]);
				}
			}
		}

		$message = array(
			'sender_id' => $this->session->userdata('employee_id'),
			'subject' => 'CV'.$this->input->post('check_voucher_id').' for approval',
			'body' => 'Please approve this check voucher: '.$this->input->post('check_voucher_id'),
			'date_sent' => date('Y-m-d H:i:s'),
			'template_id' => 1
		);
		$recipients = $this->check->getRecipient('6','3');
		$recipient = array();
		foreach ($recipients as $rec_recipient) {
			$recipient[] = array('recipient_id' => $rec_recipient['employee_id'], 'status_id' => 1);
		}
		$inboxdata = array(
			'employee_id' => $this->session->userdata('employee_id'),
			'forward_uri' => base_url().'Accounting/Checkvoucher/view_CV/'.$this->input->post('check_voucher_id'),
			'seen' => 0,
			'answered' => 0,
			'archive' => 0,
			'important' => 0,
			'deleted' => 0,
			'status_id' => 1
		);
		$inbox = new Mailbox();
		$inbox->send($message, $recipient, $inboxdata);

		$this->db->trans_complete();
		redirect('Accounting/Checkvoucher', 'refresh');
	}

	public function approveCV(){
		$this->db->trans_start();
		$info = array(
			'action_status' => 'Approved',
			'is_issued' => 1
		);
		$this->check->updateCV($info, $this->input->post('check_voucher_id'));

		$infoaction = array(
			'check_voucher_id' => $this->input->post('check_voucher_id'),
			'action_id' => '6',
			'action_employee_id' => $this->session->userdata('employee_id'),
			'action_date' => date('Y-m-d H:i:s')
		);		
		$this->check->insertCVAction($infoaction);

		$message = array(
			'sender_id' => $this->session->userdata('employee_id'),
			'subject' => 'Approved: CV '.$this->input->post('check_voucher_id'),
			'body' => 'Check Voucher Approved. CV ID: '.$this->input->post('check_voucher_id'),
			'date_sent' => date('Y-m-d H:i:s'),
			'template_id' => 1
		);
		$asdf = $this->check->getCVViewByID($this->input->post('check_voucher_id'));
		$recipient = array(array('recipient_id' => $asdf['0']['prepared_by'], 'status_id' => 1));
		$inboxdata = array(
			'employee_id' => $this->session->userdata('employee_id'),
			'forward_uri' => base_url().'Accounting/Checkvoucher/view_CV/'.$this->input->post('check_voucher_id'),
			'seen' => 0,
			'answered' => 0,
			'archive' => 0,
			'important' => 0,
			'deleted' => 0,
			'status_id' => 1
		);
		$inbox = new Mailbox();
		$inbox->send($message, $recipient, $inboxdata);

		$this->db->trans_complete();
		redirect('Accounting/Checkvoucher','refresh');
	}

	public function disapproveCV(){
		$this->db->trans_start();
		$info = array(
			'action_status' => 'Disapproved'
		);
		$this->check->updateCV($info, $this->input->post('check_voucher_id'));

		$infoaction = array(
			'check_voucher_id' => $this->input->post('check_voucher_id'),
			'action_id' => '8',
			'action_employee_id' => $this->session->userdata('employee_id'),
			'action_date' => date('Y-m-d H:i:s')
		);
		$this->check->insertCVAction($infoaction);

		$message = array(
			'sender_id' => $this->session->userdata('employee_id'),
			'subject' => 'Disapproved:CV '.$this->input->post('check_voucher_id'),
			'body' => 'Check voucher was disapproved. CV ID: '.$this->input->post('check_voucher_id'),
			'date_sent' => date('Y-m-d H:i:s'),
			'template_id' => 1
		);
		$asdf = $this->check->getCVViewByID($this->input->post('check_voucher_id'));
		$recipient = array(array('recipient_id' => $asdf['0']['prepared_by'], 'status_id' => 1));
		$inboxdata = array(
			'employee_id' => $this->session->userdata('employee_id'),
			'forward_uri' => '#',
			'seen' => 0,
			'answered' => 0,
			'archive' => 0,
			'important' => 0,
			'deleted' => 0,
			'status_id' => 1
		);
		$inbox = new Mailbox();
		$inbox->send($message, $recipient, $inboxdata);

		$this->db->trans_complete();
		redirect('Accounting/Checkvoucher', 'refresh');
	}

	public function checkActionStatus(){
		$data = $this->check->checkActionStatus($this->input->post('action_status'), $this->input->post('cvid'));
		echo json_encode($data);
	}

	public function getUserRole(){
		$data = $this->check->getUserRole($this->input->post('cvid'), $this->session->userdata['user_id'], '6');
		echo json_encode($data);
	}

	public function getCVByID(){
		$data = $this->check->getCVViewByID($this->input->post('cvid'));
		echo json_encode($data);
	}

	public function getCVDetailByID(){
		$data = $this->check->getCVDetailViewByID($this->input->post('cvid'));
		echo json_encode($data);
	}

	public function getCVActionByID(){
		$data = $this->check->getCVActionViewByID($this->input->post('cvid'));
		echo json_encode($data);
	}

	public function getRICByID(){
		$data = $this->check->getRICByID($this->input->post('ricid'));
		echo json_encode($data);
	}

	public function getCheckVoucherByRange(){
		$enddate = trim($this->input->post('enddate')).' 23:59:59';
		$data = $this->check->getCheckVoucherByRange($this->input->post('startdate'), $enddate);
		echo json_encode($data);
	}
}