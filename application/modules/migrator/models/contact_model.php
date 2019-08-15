<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model{
	public function findContact($info)
	{
		$this->db->where('person_id', $info['person_id']);
		$this->db->where('contact_type_id', $info['contact_type_id']);
		$this->db->where('contact_value', $info['contact_value']);
		$query = $this->db->get('contact');

    if($query->num_rows() > 0)
    {
      return $query->row();
    } else {
       return false;
    }
	}//end function

	public function insertContact($info)
	{
		$data = array(
			'person_id' => $info['person_id'],
			'contact_type_id' => $info['contact_type_id'],
			'contact_value' => $info['contact_value'],
			'status_id' => $info['status_id']
			);

		$this->db->insert('contact', $data);
	}//end function

}