<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Mailbox {

    private $CI;
    private $message_id;
    private $sender_id;
    private $recipients = [];
    private $forward_uri;
    private $seen;
    private $answered;
    private $archive;
    private $important;
    private $deleted;
    private $status_id;

    public function __construct() {
        $this->CI = &get_instance();
    }
    public function set_message_id($message_id) { $this->message_id = $message_id; }
    public function get_message_id() { return $this->message_id; }

    public function set_sender_id($sender_id) { $this->sender_id = $sender_id; }
    public function get_sender_id() { return $this->sender_id; }

    public function set_recipients($recipients) { $this->recipients = $recipients; }
    public function get_recipients() { return $this->recipients; }

    public function set_forward_uri($forward_uri) { $this->forward_uri = $forward_uri; }
    public function get_forward_uri() { return $this->forward_uri; }

    public function set_seen($seen) { $this->seen = $seen; }
    public function get_seen() { return $this->seen; }

    public function set_answered($answered) { $this->answered = $answered; }
    public function get_answered() {return $this->answered; }

    public function set_archive($archive) { $this->archive = $archive; }
    public function get_archive() { return $this->archive; }

    public function set_important($important) { $this->important = $important; }
    public function get_important() { return $this->important; }

    public function set_deleted($deleted) { $this->deleted = $deleted; }
    public function get_deleted() { return $this->deleted; }

    public function set_status_id($status_id) { $this->status_id = $status_id; }
    public function get_status_id() { return $this->status_id; }

    // $option is an array of format array('name' => $name, 'title' => $title, 'status' => $status);
    function get_mails($employee_id, $option='')
    {
        $this->CI->db->select('*,lastname,firstname,subject,date_sent');
        $this->CI->db->from('inbox');
        $this->CI->db->join('inbox_message', 'inbox_message.message_id = inbox.message_id');
        $this->CI->db->join('inbox_recipient', 'inbox_recipient.message_id = inbox.message_id');
        $this->CI->db->join('employee', 'employee.employee_id = inbox_message.sender_id');
        $this->CI->db->join('person', 'employee.person_id = person.person_id');
        $this->CI->db->where('inbox_recipient.recipient_id', $employee_id);
        $this->CI->db->order_by('inbox.inbox_id','DESC');
        if (!empty($option)) $this->CI->db->where($option);
        $query = $this->CI->db->get();
        return $query->result_array();
    }

    function send($message_data, $recipient_data, $inbox_data)
    {
        $this->CI->db->trans_start();

        $this->CI->db->insert('inbox_message', $message_data);
        $message_id = $this->CI->db->insert_id();

        foreach($recipient_data as $index => $recipient)
        {
            $recipient_data[$index]['message_id'] = $message_id;
        }
        $this->CI->db->insert_batch('inbox_recipient', $recipient_data);

        $inbox_data['message_id'] = $message_id;
        $this->CI->db->insert('inbox', $inbox_data);
        $inbox_id = $this->CI->db->insert_id();

        $this->CI->db->trans_complete();
        return $inbox_id;
    }

}