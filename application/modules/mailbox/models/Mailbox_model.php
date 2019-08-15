<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailbox_model extends CI_Model {
	public function __construct()
    {
        // call parent constructor
        parent::__construct();
    }


// SELECTS---------------
    function get_mail_model($employee_id, $option=''){
    	$this->db->select('*,lastname, firstname, subject, date_sent');
        $this->db->from('inbox');
        $this->db->join('inbox_message', 'inbox_message.message_id = inbox.message_id', 'left');
        $this->db->join('inbox_recipient', 'inbox_recipient.message_id = inbox.message_id', 'left');
        $this->db->join('employee', 'employee.employee_id = inbox_message.sender_id', 'left');
        $this->db->join('person', 'employee.person_id = person.person_id', 'left');
        $this->db->where('inbox_recipient.recipient_id', $employee_id);
        $this->db->order_by('inbox.inbox_id','DESC');
        if (!empty($option)) $this->db->where($option);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_onemail_model($id){
    	$this->db->select('*,lastname, firstname, subject, date_sent');
        $this->db->from('inbox');
        $this->db->join('inbox_message', 'inbox_message.message_id = inbox.message_id', 'inner');
        $this->db->join('inbox_recipient', 'inbox_recipient.message_id = inbox.message_id', 'inner');
        $this->db->join('employee', 'employee.employee_id = inbox_message.sender_id', 'inner');
        $this->db->join('person', 'employee.person_id = person.person_id', 'inner');
        $this->db->where('inbox.inbox_id', $id);
        // $this->db->order_by('inbox.inbox_id','DESC');
        // if (!empty($option)) $this->db->where($option);
        $query = $this->db->get();
        return $query->row();
    }

    	
    function get_users_model(){
		$this->db->select("c.*, a.*, concat(b.lastname, ', ',b.firstname, ' ',b.middlename,' ', b.suffix) as employee");
		$this->db->from('employee a');
		$this->db->join('person b','b.person_id = a.person_id', 'inner');
		$this->db->join('user c','c.person_id = b.person_id', 'inner');
		$this->db->where('a.status_id','1');
		$query = $this->db->get();
		return $query->result_array();
    }

// INSERTS---------------
    function insert_inbox_modal(){
    	$this->db->trans_start();
        $this->db->insert('inbox', $data);
        $inbox = $this->db->insert_id();
        $this->db->trans_complete();
        return $inbox;
    }

    function insert_inboxmessage_modal(){
    	$this->db->trans_start();
        $this->db->insert('inbox_message', $data);
        $inbox_message = $this->db->insert_id();
        $this->db->trans_complete();
        return $inbox_message;
    }

    function insert_inboxrecipient_modal(){
    	$this->db->trans_start();
        $this->db->insert('inbox_recipient', $data);
        $inbox_recepient = $this->db->insert_id();
        $this->db->trans_complete();
        return $inbox_recepient;
    }
// UPDATES---------------











    function send($message_data, $recipient_data, $inbox_data){
        $this->db->trans_start();

        $this->db->insert('inbox_message', $message_data);
        $message_id = $this->db->insert_id();

        foreach($recipient_data as $index => $recipient)
        {
            $recipient_data[$index]['message_id'] = $message_id;
        }
        $this->db->insert_batch('inbox_recipient', $recipient_data);

        $inbox_data['message_id'] = $message_id;
        $this->db->insert('inbox', $inbox_data);
        $inbox_id = $this->db->insert_id();

        $this->db->trans_complete();
        return $inbox_id;
    }

    public function getRecipient($documentcode, $rolecode){
		$this->db->select('employee.employee_id');
		$this->db->from('user_role');
		$this->db->join('user','user.user_id = user_role.user_id');
		$this->db->join('employee','employee.person_id = user.person_id');
		$this->db->where('user_role.document_code',$documentcode);
		$this->db->where('user_role.role_code', $rolecode);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return false;
		}
	}

}