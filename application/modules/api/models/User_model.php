<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
	function get_users()
    {
    	$this->db->select('user.*, person.firstname, person.middlename, person.lastname, person.suffix, person.sex, person.birthdate');
        $this->db->from('user');
        $this->db->join('person', 'person.person_id = user.user_id', 'inner');
        $this->db->where('status_id', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

}