<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model {

    public function get_all_old()
    {
            $query = $this->db->get('customer_old');
            return $query->result();
    }

    public function find($customer)
    {
            //$this->db->where('customer_old_id',$customer->customer_old_id); changed Aug 15, 2017
            $this->db->where('person_id',$customer->person_id);
            $query = $this->db->get('customer');

	        //if($query->num_rows() == 1) changed Aug 15, 2017
            if($query->num_rows() >= 1)
	        {
	            return $query->row();
	        } else {
                return false;
            }
	        
    }

    public function insert_customer($customer, $person_id)
    {
    	$data = array(
    		'customer_fullname' => $customer->customer_fullname,
    		'person_id' => $person_id,
    		'customer_old_id' => $customer->customer_old_id
    	);
        $this->db->insert('customer', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
}