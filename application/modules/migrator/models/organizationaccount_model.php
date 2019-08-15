<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organizationaccount_model extends CI_Model {

	public function insertOrganizationAccount($org){

		$data = array(
			'person_id' => $org['newid'],
			'subcode'  => $org['subcode'],
			'customer_old_id' => $org['id'],
			'remarks' => $org['remarks'],
			'status_id' => $org['status_id']
			);

		$this->db->insert('organization_account', $data);
		return $this->db->insert_id();  
	}//close insertOrganizationAccount

	public function findOrgAccountByIds($personid, $oldid){
		$this->db->where("person_id = '".$personid."' and customer_old_id = '".$oldid."'");
        $query = $this->db->get('organization_account');

        if($query->num_rows() > 0)
        {
            return $query->row();
        } else {
            return false;
        }
	}//end function

	public function getPersonidFromOrganizationAccount($oldid){
		$this->db->where('customer_old_id', $oldid);
		$query = $this->db->get('organization_account');

		if($query->num_rows() > 0){
			return $query->row('person_id');
		} else {
			return false;
		}
	}
}//end class