<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Inbox extends CI_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        //$this->load->model('Inbox_model','inbox');
        $this->load->library('Mailbox');

        $this->data['customjs'] = 'inbox/inboxCustomjs';
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key

    }

    public function index()
    {

//        $message = array('sender_id' => 102, 'subject'=>'hello 2', 'body'=> 'bodydofjks', 'date_sent'=>'2017-10-17', 'template_id'=>1);
//        $recipient = array(array('recipient_id'=>101, 'status_id'=>1));
//        $inboxdata = array('employee_id'=>101, 'forward_uri'=>'#', 'seen'=>0, 'answered'=>0, 'archive'=>0, 'important'=>0, 'deleted'=>0, 'status_id'=>1);
        //
        //$inbox = new Mailbox();
        //$inbox->send($message, $recipient, $inboxdata);

        // if(isset($this->session->userdata['logged_in'])){
        //     redirect('welcome', 'refresh');
        // }

        //get logged employee
        $employee_id = $this->session->employee_id;
        $inbox = new Mailbox();
        $mail_array = array();
        $unread_array = array();
        $unread_array = $inbox->get_mails($employee_id, array('seen'=>0));
        $mail_array = $inbox->get_mails($employee_id, array('seen'=>1));
        
        $this->data['mails'] = $mail_array;
        $this->data['unreads'] = $unread_array;
        $this->data['content'] = 'inbox_main';
        $this->data['page_title'] = 'User Inbox';
        $this->load->view('default/index', $this->data);
    }

}