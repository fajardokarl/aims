<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Mailbox extends CI_Controller {

	private $data = array();

	  function __construct(){
        // Construct the parent class
        parent::__construct();

        // model init for 'Logs'
        $this->load->model('logs/Logs_model', 'logs');
        // model init for 'Users'
        $this->load->model('users/Users_model','users');
        // main model
        $this->load->model('Mailbox_model','mail');

        $this->load->helper(array('form', 'url'));

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['customjs'] = 'mailboxjs';
        // $this->data['navigation'] = 'asset/navigation';

    }

 	public function index(){
        $employee_id = $this->session->userdata('employee_id');

 		$this->data['content'] = 'mailbox_main';
        $this->data['page_title'] = 'My Mailbox';
        $this->data['emp'] = $this->mail->get_users_model();
        $this->data['mails'] = $this->mail->get_mail_model($employee_id, array('seen'=>''));
        // $this->data['dept_code'] = $this->mail->get_dept_model();
        // $this->data['assets'] = $this->mail->get_assets_model();

        $this->load->view('default/index', $this->data);
 	}

    public function get_onemail(){
        $inbox1 = $this->mail->get_onemail_model($this->input->post('inbox_id'));
        echo json_encode($inbox1);
    }

    public function send_mail(){
        $message = array(
            'sender_id' => $this->session->userdata('employee_id'),
            'subject' => 'CV '. 1000 .' Submitted for Approval',
            'body' => 'Please approve this check voucher: '. 1,
            'date_sent' => date('Y-m-d H:i:s'),
            'template_id' => 1
        );
        $recipients = $this->mail->getRecipient('6','3');
        $recipient = array();
        foreach ($recipients as $rec_recipient) {
            $recipient[] = array('recipient_id' => $rec_recipient['employee_id'],'status_id' => 1);
        } 
        $inboxdata = array(
            'employee_id' => $this->session->userdata('employee_id'),
            'forward_uri' => base_url().'Accounting/Checkvoucher/view_CV/'. 1,
            'seen' => 0,
            'answered' => 0,
            'archive' => 0,
            'important' => 0,
            'deleted' => 0,
            'status_id' => 1
        );
        $inbox = new Mailbox();
        $inbox->send($message, $recipient, $inboxdata);
    }



 }