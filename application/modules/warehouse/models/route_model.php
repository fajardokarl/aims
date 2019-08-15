<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Route_model extends CI_Model{
	function get_Route(){
		$this->db->where('status_id', 1);
		$query = $this->db->get('route');
    return $query->result_array();
	}
}