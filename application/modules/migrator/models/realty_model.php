<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Realty_model extends CI_Model {
	public function findRealtyByOrganizationName($orgname){
		$this->db->select('realty_id');
		$this->db->from('realty');
		$this->db->join('organization','realty.organization_id = organization.organization_id', 'inner');
		$this->db->where('organization.organization_name', $orgname);

		$query = $this->db->get();
		if($query->num_rows() > 0)
    {
      return $query->row();
    } else {
      return false;
    }
	}//end function

	public function insertRealty($info){
		$data = array(
			'organization_id' => $info['organization_id'],
			'address_id' => $info['address_id'],
			'contact_id' => $info['contact_id']
			);

		$this->db->insert('realty', $data);
		return $this->db->insert_id();
	}

}//end class