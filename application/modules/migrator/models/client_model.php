<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends CI_Model {
	public function findClient($info){
		$this->db->where('client_type_id', $info['client_type_id']);
		$this->db->where('reference_id', $info['reference_id']);
		$query = $this->db->get('client');

		if($query->num_rows() > 0)
    {
      return $query->row();
    } else {
       return false;
    }
	}

	public function insertClient($info){
		$data = array(
			'client_type_id' => $info['client_type_id'],
			'reference_id' => $info['reference_id'],
			'status_id' => $info['status_id']
			);

		$this->db->insert('client', $data);
	}

}//end class