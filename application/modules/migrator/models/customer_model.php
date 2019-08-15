<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model{

	public function findCustomerByPersonId($id){
		$this->db->where('person_id', $id);
        $query = $this->db->get('customer');

        if($query->num_rows() > 0)
        {
            return $query->row();
        } else {
            return false;
        }
	}//closing sa function

	public function insertCustomer($customer){

		$data = array(
            'customer_fullname' => $customer['account'],
            'person_id' => $customer['newid'],
            'customer_old_id' => $customer['id'],
            'customer_work_id' => $customer['customer_work_id']
            );

        $this->db->insert('customer', $data);
        return $this->db->insert_id();     
	}//end insertCustomer
}//end class