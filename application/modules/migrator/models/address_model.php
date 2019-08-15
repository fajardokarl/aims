<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address_model extends CI_Model{
	public function insertAddress($info){
		$data = array(
			'line_1' => $info['line_1'],
			'line_2' => $info['line_2'],
			'line_3' => $info['line_3'],
			'city_id' => $info['city_id'],
			'province_id' => $info['province_id'],
			'country_id' => $info['country_id']
			);

		$this->db->insert('address', $data);
		return $this->db->insert_id();  
	}

	public function insertOrganizationAddress($personid,$addressid,$statusid){
		$data = array(
			'organization_id' => $personid,
			'address_id' => $addressid,
			'status_id' => $statusid
			);

		$this->db->insert('organization_address', $data);
	}

	public function findOrganizationAddressById($id){
		$this->db->where('organization_id', $id);
    $query = $this->db->get('organization_address');

    if($query->num_rows() > 0)
    {
      return $query->row();
    } else {
       return false;
    }
	}

	public function insertPersonAddress($personid,$addressid,$statusid){
		$data = array(
			'person_id' => $personid,
			'address_id' => $addressid,
			'status_id' => $statusid
			);

		$this->db->insert('person_address', $data);
	}

	public function findPersonAddressById($id){
		$this->db->where('person_id', $id);
    $query = $this->db->get('person_address');

    if($query->num_rows() > 0)
    {
      return $query->row();
    } else {
       return false;
    }
	}

	public function getCountry($lugar){
		$this->db->where('country_name', $lugar);
    $query = $this->db->get('address_country');

    if($query->num_rows() > 0){
    	return $query->row('id');
    } else {
    	return 0;
    }
	}//end getCountry

	public function getProvince($lugar){
		$this->db->where('province_name', $lugar);
		$query = $this->db->get('address_province');

		if($query->num_rows() > 0)
    {
      return $query->row('address_province_id');
    } else {
      return 0;
    }
	}//end getProvince

	public function getCity($lugar){
		$this->db->where('city_name',$lugar);
		$query = $this->db->get('address_city');

		if($query->num_rows() > 0){
			return $query->row('address_city_id');
		} else {
			return 0;
		}
	}
		
}//end class