<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department_model extends CI_Model{

    function get_departments()
    {
		$query = $this->db->get('department');
    	return $query->result_array();
    }

    function insertDepartment($info){
		$data = array(
			'department_code' => $info['department_code'],
			'activity_code' => $info['activity_code'],
			'department_name' => $info['department_name'],
			'route_id' => $info['route_id'],
			'status_id' => $info['status_id']
			);

		$this->db->trans_start();
		$this->db->insert('department', $data);
		$this->db->trans_complete();
	}

	public function update_department($department_id , $status_id){
        $this->db->where('department_id', $department_id);
        $this->db->update('department', $status_id);
        return true;
    }

	

	/*
	function get_department(){
		$this->db->where('status_id', 1);
		$query = $this->db->get('department');
    return $query->result_array();
	}

	function insertDepartment($info){
		$data = array(
			'department_code' => $info['department_code'],
			'activity_code' => $info['activity_code'],
			'department_name' => $info['department_name'],
			'route_id' => $info['route_id'],
			'status_id' => $info['status_id']
			);

		$this->db->trans_start();
		$this->db->insert('department', $data);
		$this->db->trans_complete();
	}

	function updateDepartment($info){
		$data = array(
			'department_code' => $info['department_code'],
			'activity_code' => $info['activity_code'],
			'department_name' => $info['department_name'],
			'route_id' => $info['route_id'],
			'status_id' => $info['status_id']
		);

		$this->db->trans_start();
    $this->db->where('department_id', $info['department_id']);
    $this->db->update('department', $data);
    $this->db->trans_complete();
	}

	function getDepartmentByID($id){
		$this->db->where('department_id', $id);
		$query = $this->db->get('department');
		return $query->result_array();
	}
	*/
}