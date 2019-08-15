<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partner_model extends CI_Model {

	public function findOrgPartnerByIds($accountid,$orgid,$personid){
		$this->db->where("organization_account_id = '".$accountid."' and organization_id = '".$orgid."' and person_id = '".$personid."'");
        $query = $this->db->get('organization_partner');

        if($query->num_rows() > 0)
        {
            return $query->row();
        } else {
            return false;
        }
	}

	public function insertOrgPartner($info, $person_id){
		$data = array(
            'organization_account_id' => $info['accountid'],
            'organization_id' => $info['newid'],
            'person_id' => $person_id,
            'status_id' => $info['status_id']

            );

        $this->db->insert('organization_partner', $data);
	}

    public function findCusPartnerByIds($accountid,$cusid,$personid){
        $this->db->where("customer_account_id = '".$accountid."' and customer_id = '".$cusid."' and person_id = '".$personid."'");
        $query = $this->db->get('customer_partner');

        if($query->num_rows() > 0)
        {
            return $query->row();
        } else {
            return false;
        }
    }

    public function insertCusPartner($info, $person_id){
        $data = array(
            'customer_account_id' => $info['accountid'],
            'customer_id' => $info['newid'],
            'person_id' => $person_id,
            'status_id' => $info['status_id']

            );

        $this->db->insert('customer_partner', $data);
    }
}