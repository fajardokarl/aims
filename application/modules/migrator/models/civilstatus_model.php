<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Civilstatus_model extends CI_Model {
	public function getCivilStatusId($civilstatus){
		
        $this->db->where('civil_status_name', $civilstatus);
        $query = $this->db->get('civil_status');
 
        if($query->num_rows() > 0)
        {
            return $query->row('civil_status_id');
        } else {
            return 0;
        }
	}
}