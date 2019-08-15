<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent_model extends CI_Model{
	public function findAgentByIds($realtyid, $personid){
		$this->db->where('realty_id', $realtyid);
		$this->db->where('person_id', $personid);
		$query = $this->db->get('agent');

		if($query->num_rows() > 0)
    {
      return $query->row();
    } else {
       return false;
    }
	}//end function

	public function insertAgent($info){
		$data = array(
			'realty_id' => $info['realty_id'],
			'broker_id' => $info['broker_id'],
			'person_id' => $info['person_id'],
			'status_id' => $info['status_id']
			);

		$this->db->insert('agent', $data);
	}//end function
}//end class