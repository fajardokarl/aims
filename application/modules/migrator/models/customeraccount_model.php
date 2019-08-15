<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customeraccount_model extends CI_Model{
	public function findCusAccountByIds($personid, $oldid){
		$this->db->where("person_id = '".$personid."' and customer_old_id = '".$oldid."'");
        $query = $this->db->get('customer_account');

        if($query->num_rows() > 0)
        {
            return $query->row();
        } else {
            return false;
        }
	}

	public function insertCustomerAccount($customer){

		$data = array(
			'person_id' => $customer['newid'],
			'subcode'  => $customer['subcode'],
			'customer_old_id' => $customer['id'],
			'remarks' => $customer['remarks'],
			'status_id' => $customer['status_id']
			);

		$this->db->insert('customer_account', $data);
		return $this->db->insert_id();
	}//close insertOrganizationAccount

	public function getPersonidFromcustomerAccount($oldid){
		$this->db->where('customer_old_id', $oldid);
		$query = $this->db->get('customer_account');

		if($query->num_rows() > 0){
			return $query->row('person_id');
		} else {
			return false;
		}
	}
}