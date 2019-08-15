<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merger_model extends CI_Model{
	public function upd_Person($info, $id){
		$this->db->where('person_id', $id);
		$this->db->update('person', $info);
	}

	public function findPersonByID($id){
		$query = $this->db->query("select person.*, civil_status.civil_status_name as civilstatus 
			from person 
			left join civil_status on civil_status.civil_status_id = person.civil_status_id
			where person.person_id = ". $id);
		return $query->result_array();
	}

	public function getAll2(){
		$query = $this->db->query("select person_id, mergeto, concat(lastname,', ', firstname,' ', middlename,' ', IFNULL(suffix, ' ')) as name from person order by lastname");
		return $query->result_array();
	}

	public function getAll(){
		$query = $this->db->query("select person_id, concat(lastname,', ', firstname,' ', middlename,' ', IFNULL(suffix, ' ')) as name from person where mergeto = 0 order by lastname");
		return $query->result_array();
	}

	public function formatName($name){
		if (substr_count($name, '-') > 0){
			$name = mb_strtolower($name);
			$name = implode('-', array_map('ucfirst', explode('-', $name)));
		} else {
			$name = ucwords(mb_strtolower($name));
		}
		return $name;
	}
}