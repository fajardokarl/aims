<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customeraccount_model extends CI_Model {

    //added August 15, 2017
    public function find($customer)
    {
        $this->db->where('customer_old_id',$customer->customer_old_id);
        $this->db->where('person_id',$customer->person_id);   
        $query = $this->db->get('customer_account');

        if($query->num_rows() >= 1) 
        { 
            //echo var_dump($query->num_rows());
            return $query->row();
        } else {
            return false;
        }
    }

    public function insert_customer($customer, $person_id)
    {
    	$data = array(
    		'person_id' => $person_id,
    		'customer_old_id' => $customer->customer_old_id,
            'customer_old_subcode' => $customer->subcode
    	);
        $this->db->insert('customer_account', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
}