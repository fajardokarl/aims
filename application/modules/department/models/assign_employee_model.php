<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class assign_employee_model extends CI_Model{

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

    public function employee_in_department($dept_id) {
    	$query = $this->db->query("SELECT p.lastname,p.firstname FROM person as p INNER JOIN employee as e ON p.person_id = e.person_id INNER JOIN employee_department as ed ON e.employee_id = ed.employee_id INNER JOIN department as d ON d.department_id = ed.department_id WHERE ed.department_id =". $dept_id);
    	return $query->result_array();
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