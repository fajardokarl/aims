<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organization_model extends CI_Model{

	public function findOrganizationByName($organization){
        $this->db->where("organization_name = '".$organization."'");
        $query = $this->db->get('organization');

        if($query->num_rows() > 0)
        {
            return $query->row();
        } else {
            return false;
        }
    }
    
    public function insertOrganization($organization){
        $data = array(
            'organization_name' => $organization['organization_name'],
            'customer_old_id' => $organization['id'],
            'tin' => $organization['tin'],
            'status_id' => $organization['status_id']
            );

        $this->db->insert('organization', $data);
        return $this->db->insert_id();      
    }
}