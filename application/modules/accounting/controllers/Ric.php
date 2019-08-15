<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ric extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Ric_model','rick');
		$this->data['customjs'] = 'ric_js';
		$this->data['navigation'] = 'navigation';
	}

	public function index(){
		$this->data['content'] = 'ric_view';
		$this->data['page_title'] = 'Request of Issuance of Check';
		//$this->data['records'] = $this->rick->getRIC();
		$this->data['rec_employees'] = $this->rick->getEmployees();
		$this->data['rec_departments'] = $this->rick->getDepartments();
 
		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}

	public function view_RIC(){
		$id = $this->uri->segment(4,0);
		$this->data['content'] = 'viewric_view';
		$this->data['customjs'] = 'viewric_js';
		$this->data['page_title'] = 'Request of Issuance of Check Verification';

		if (isset($this->session->userdata['logged_in'])) {
			$this->data['rec_ric'] = $this->rick->getRICViewByID($id);
			$this->data['rec_details'] = $this->rick->getRICDetailByID($id);
			$this->data['rec_attachments'] = $this->rick->getAttachmentByRicid($id);
			$this->data['rec_actions'] = $this->rick->getRICActionViewByID($id);
			$this->data['rec_userrole'] = $this->rick->getUserRole($id, $this->session->userdata['user_id'], '5');
		 	$this->load->view('default/index', $this->data);	
		} 
	}

	public function insertRIC(){
		$this->db->trans_start();
		$info = array(
			'employee_id' => $this->input->post('employee_id'),
			'ric_date' => date("Y-m-d H:i:s"),
			'department_id' => $this->input->post('department_id'),
			'purpose' => $this->input->post('purpose'),
			'prepared_by' => $this->input->post('prepared_by'),
			'requested_by' => $this->input->post('requested_by'),
			'action_status' => 'Submitted',
			'is_cancelled' => '0'
		);
		$ricid = $this->rick->insertRIC($info);

		$infoaction = array(
			'ric_id' => $ricid,
			'action_id' => '9',
			'action_employee_id' => $this->input->post('prepared_by'),
			'action_date' => date("Y-m-d H:i:s")
		);
		$this->rick->insertRICAction($infoaction);

		foreach ($this->input->post('particular') as $i => $value) {
			if(trim($this->input->post('particular')[$i])){
				$infodetail = array(
					'ric_id' => $ricid,
					'particular' => $this->input->post('particular')[$i],
					'amount' => $this->input->post('amount')[$i]
				);
				$this->rick->insertRICDetail($infodetail);
			}		
		}		

		foreach ($this->input->post('attachment_id') as $i => $value) {
			$attachmentid = $this->input->post('attachment_id')[$i];
			$info = array(
				'reference_id' => $ricid
				
			);
			$this->rick->updateAttachment($info, $attachmentid);
		}

		/*$message = array(
			'sender_id' => $this->session->userdata('employee_id'),
			'subject' => 'RIC '.$ricid.' for verification',
			'body' => 'Please verify this request. RIC ID: '.$ricid,
			'date_sent' => date("Y-m-d H:i:s"),
			'template_id' => 1
		);
		$recipients = $this->rick->getRecipient($this->input->post('department_id'),'5','2');
		$recipient = array();
		echo $this->input->post('department_id');
		print_r($recipients);
		print_r($recipient);
		
		foreach ($recipients as $rec_recipient) {
			$recipient[] = array('recipient_id' => $rec_recipient['employee_id'], 'status_id' => 1);
		}
		$inboxdata = array(
			'employee_id' => $this->session->userdata('employee_id'), 
			'forward_uri' => base_url().'Accounting/Ric/view_RIC/'.$ricid, 
			'seen' => 0, 
			'answered' => 0, 
			'archive' => 0, 
			'important' => 0, 
			'deleted' => 0, 
			'status_id' => 1
		);
		$inbox = new Mailbox();
		$inbox->send($message, $recipient, $inboxdata);*/

		$this->db->trans_complete();
		redirect('Accounting/Ric', 'refresh');
	}

	public function updateRIC(){
		$this->db->trans_start();
		$info = array(
			'employee_id' => $this->input->post('employee_id'),
			'ric_date' => $this->input->post('ric_date'),
			'department_id' => $this->input->post('department_id'),
			'purpose' => $this->input->post('purpose'),
			'prepared_by' => $this->input->post('prepared_by'),
			'requested_by' => $this->input->post('requested_by'),
			'action_status' => 'Submitted'
		);
		$this->rick->updateRIC($info, $this->input->post('ric_id'));

		if(is_array($this->input->post('particular')) || is_object($this->input->post('particular'))){
			foreach ($this->input->post('particular') as $i => $value) {
				$ricdetailid = $this->input->post('ric_detail_id')[$i];
				if($ricdetailid == ''){
					if(trim($this->input->post('particular')[$i])){
						$infodetail = array(
							'ric_id' => $this->input->post('ric_id'),
							'particular' => $this->input->post('particular')[$i],
							'amount' => $this->input->post('amount')[$i]
						);
						$this->rick->insertRICDetail($infodetail);
					}
				} else {
					$infodetail = array(
						'particular' => $this->input->post('particular')[$i],
						'amount' => $this->input->post('amount')[$i]
					);
					$this->rick->updateRICDetail($infodetail, $ricdetailid);
				}
			}
		}

		if (is_array($this->input->post('attachment_id')) || is_object($this->input->post('attachment_id'))) {
			foreach ($this->input->post('attachment_id') as $i => $value) {
				$attachmentid = $this->input->post('attachment_id')[$i];
				$info = array(
					'reference_id' => $this->input->post('ric_id')
				);
				$this->rick->updateAttachment($info, $attachmentid);
			}
		}

		$message = array(
			'sender_id' => $this->session->userdata('employee_id'),
			'subject' => 'RIC '.$this->input->post('ric_id').' for verification',
			'body' => 'Please verify this request. RIC ID: '.$this->input->post('ric_id'),
			'date_sent' => date("Y-m-d H:i:s"),
			'template_id' => 1
		);
		$recipients = $this->rick->getRecipient($this->input->post('department_id'),'5','2');
		$recipient = array();
		foreach ($recipients as $rec_recipient) {
			$recipient[] = array('recipient_id' => $rec_recipient['employee_id'], 'status_id' => 1);
		}
		$inboxdata = array(
			'employee_id' => $this->session->userdata('employee_id'), 
			'forward_uri' => base_url().'Accounting/Ric/view_RIC/'.$this->input->post('ric_id'), 
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
		redirect('Accounting/Ric','refresh');
	}

	public function verifyRIC(){
		$this->db->trans_start();
		$info = array(
			'action_status' => 'Verified'
		);
		$this->rick->updateRIC($info, $this->input->post('ric_id'));

		$infoaction = array(
			'ric_id' => $this->input->post('ric_id'),
			'action_id' => '1',
			'action_employee_id' => $this->session->userdata('employee_id'),
			'action_date' => date("Y-m-d H:i:s")
		);
		$this->rick->insertRICAction($infoaction);

		$message = array(
			'sender_id' => $this->session->userdata('employee_id'),
			'subject' => 'VERIFIED:RIC '.$this->input->post('ric_id').' for Approval',
			'body' => 'Please approve this RIC ID: '.$this->input->post('ric_id'),
			'date_sent' => date("Y-m-d H:i:s"),
			'template_id' => 1);
		$asdf = $this->rick->getRICByID($this->input->post('ric_id'));
		$recipis = $this->rick->getRecipient($asdf['0']['department_id'],'5','3');
		$recipient = array();
		print_r($asdf);
		foreach ($recipis as $recipi) {
			$recipient[] = array('recipient_id' => $recipi['employee_id'], 'status_id' => 1);
		}
		$inboxdata = array('employee_id' => $this->session->userdata('employee_id'), 'forward_uri' => base_url().'Accounting/Ric/view_RIC/'.$this->input->post('ric_id'), 'seen' => 0, 'answered' => 0, 'archive' => 0, 'important' => 0, 'deleted' => 0, 'status_id' => 1);
		$inbox = new Mailbox();
		$inbox->send($message, $recipient, $inboxdata);
		
		$this->db->trans_complete();
		redirect('Accounting/Ric','refresh');
	}

	public function denyRIC(){
		$this->db->trans_start();
		$info = array(
			'action_status' => 'Denied'
		);
		$this->rick->updateRIC($info, $this->input->post('ric_id'));

		$infoaction = array(
			'ric_id' => $this->input->post('ric_id'),
			'action_id' => '7',
			'action_employee_id' => $this->session->userdata('employee_id'),
			'action_date' => date("Y-m-d H:i:s")
		);
		$this->rick->insertRICAction($infoaction);

		$message = array(
			'sender_id' => $this->session->userdata('employee_id'),
			'subject' => 'DENIED:RIC '.$this->input->post('ric_id').' for Revision',
			'body' => 'Request was denied. RIC ID: '.$this->input->post('ric_id'),
			'date_sent' => date("Y-m-d H:i:s"),
			'template_id' => 1);
		$asdf = $this->rick->getRICByID($this->input->post('ric_id'));
		$recipient = array(array('recipient_id' => $asdf['0']['prepared_by'], 'status_id' => 1));
		$inboxdata = array('employee_id' => $this->session->userdata('employee_id'), 'forward_uri' => base_url().'Accounting/Ric/view_RIC/'.$this->input->post('ric_id'), 'seen' => 0, 'answered' => 0, 'archive' => 0, 'important' => 0, 'deleted' => 0, 'status_id' => 1);
		$inbox = new Mailbox();
		$inbox->send($message, $recipient, $inboxdata);			
		

		$this->db->trans_complete();
		redirect('Accounting/Ric', 'refresh');
	}

	public function approveRIC(){
		$this->db->trans_start();
		$info = array(
			'action_status' => 'Approved'
		);
		$this->rick->updateRIC($info, $this->input->post('ric_id'));

		$infoaction = array(
			'ric_id' => $this->input->post('ric_id'),
			'action_id' => '6',
			'action_employee_id' => $this->session->userdata('employee_id'),
			'action_date' => date("Y-m-d H:i:s")
		);
		$this->rick->insertRICAction($infoaction);

		$message = array(
			'sender_id' => $this->session->userdata('employee_id'),
			'subject' => 'APPROVED:RIC '.$this->input->post('ric_id'),
			'body' => 'Request Approved. RIC ID: '.$this->input->post('ric_id'),
			'date_sent' => date("Y-m-d H:i:s"),
			'template_id' => 1
		);
		$asdf = $this->rick->getRICByID($this->input->post('ric_id'));
		$recipient = array(array('recipient_id' => $asdf['0']['prepared_by'], 'status_id' => 1));
		$inboxdata = array(
			'employee_id' => $this->session->userdata('employee_id'), 
			'forward_uri' => base_url().'Accounting/Ric/view_RIC/'.$this->input->post('ric_id'), 
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
		redirect('Accounting/Ric', 'refresh');
	}

	public function disapproveRIC(){
		$this->db->trans_start();
		$info = array(
			'action_status' => 'Disapproved'
		);
		$this->rick->updateRIC($info, $this->input->post('ric_id'));

		$infoaction = array(
			'ric_id' => $this->input->post('ric_id'),
			'action_id' => '8',
			'action_employee_id' => $this->session->userdata('employee_id'),
			'action_date' => date("Y-m-d H:i:s")
		);
		$this->rick->insertRICAction($infoaction);

		$message = array(
			'sender_id' => $this->session->userdata('employee_id'),
			'subject' => 'DISAPPROVED:RIC '.$this->input->post('ric_id'),
			'body' => 'Request was disapproved. RIC ID: '.$this->input->post('ric_id'),
			'date_sent' => date("Y-m-d H:i:s"),
			'template_id' => 1
		);
		$asdf = $this->rick->getRICByID($this->input->post('ric_id'));
		$recipient = array(array('recipient_id' => $asdf['0']['prepared_by'], 'status_id' => 1));
		$inboxdata = array(
			'employee_id' => $this->session->userdata('employee_id'), 
			'forward_uri' => base_url().'Accounting/Ric/view_RIC/'.$this->input->post('ric_id'), 
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
		redirect('Accounting/Ric', 'refresh');
	}

	public function cancelRIC(){
		$this->db->trans_start();
		$info = array(
			'action_status' => 'Cancelled',
			'is_cancelled' => '1'
		);
		$this->rick->updateRIC($info, $this->input->post('ric_id'));

		$infoaction = array(
			'ric_id' => $this->input->post('ric_id'),
			'action_id' => '10',
			'action_employee_id' => $this->session->userdata('employee_id'),
			'action_date' => date("Y-m-d H:i:s")
		);
		$this->rick->insertRICAction($infoaction);

		$this->db->trans_complete();
		redirect('Accounting/Ric', 'refresh');
	}

	public function checkActionStatus(){
		$data = $this->rick->checkActionStatus($this->input->post('action_status'), $this->input->post('ric_id'));
		echo json_encode($data);
	}

	public function getEmployeeDepartment(){
		$data = $this->rick->getEmployeeDepartment($this->input->post('employee_id'));
		echo json_encode($data);
	}

	public function getUserRole(){
		// echo "getUserRole";
		// echo $this->input->post('ricid');
		// echo $this->session->userdata['user_id'];
		$data = $this->rick->getUserRole($this->input->post('ricid'), $this->session->userdata['user_id'], '5');
		echo json_encode($data);
	}

	public function getRIC(){
		$end = $this->input->post('end').' 23:59:59';
		$data = $this->rick->getRIC($this->input->post('begin'), $end);
		echo json_encode($data);
	}

	public function getRICByID(){
		$data = $this->rick->getRICByID($this->input->post('ricid'));
		echo json_encode($data);
	}

	public function getRICActionByID(){
		$data = $this->rick->getRICActionByID($this->input->post('ricid'));
		echo json_encode($data);
	}

	public function getRICDetailByID(){
		$data = $this->rick->getRICDetailByID($this->input->post('ricid'));
		echo json_encode($data);
	}

	public function getAttachmentByFilename(){
		$data = $this->rick->getAttachmentByFilename($this->input->post('filename'));
		echo json_encode($data);
	}

	public function getAttachmentByRicid(){
		$data = $this->rick->getAttachmentByRicid($this->input->post('ricid'));
		echo json_encode($data);
	}

	public function deleteAttachment(){
		$info = array(
			'is_deleted' => 'yes'
		);
		$this->rick->updateAttachment($info, $this->input->post('attachmentid'));
		$data = true;
		echo json_encode($data);
	}

	public function uploadAttachment(){
		$arrfile =  $this->fileupload('attachment_file');
    $filename = "";
    if(array_key_exists('data',$arrfile)){
      $filename = $arrfile['data'];
	    $info = array(
	    	'attachment_type_id' => '1',
	    	'filename' => $filename['file_name'],
	    	'orig_file' => $filename['orig_name'],
	    	'is_deleted' => 'no'
	    );
	    $data = $this->rick->insertAttachment($info);
    } else {
    	$data = false;
    }
    echo json_encode($data);
	}

	public function fileupload($userfile){
		$config['upload_path']          = "./public/files/attachments/";
    $config['allowed_types']        = 'pdf';
    $config['max_size']             = 50000;
    $config['max_width']            = 52024;
    $config['max_height']           = 51768;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ( ! $this->upload->do_upload($userfile)){		  
      $error =  array('error' => $this->upload->display_errors());
      return $error;
    } else {
      $this->datafile = array('data' => $this->upload->data());
      return $this->datafile;
    }
	}
}