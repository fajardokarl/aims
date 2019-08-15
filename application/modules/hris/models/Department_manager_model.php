<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department_manager_model extends CI_Model{
	function get_Manager(){
		$this->db->select('department_manager.department_id,person.lastname,person.firstname');
                $this->db->from('department_manager');
                $this->db->join('employee', 'department_manager.employee_id = employee.employee_id', 'inner');
                $this->db->join('person', 'employee.person_id = person.person_id', 'inner');
                // $this->db->join('department', 'department_manager.department_id = department.department_id', 'inner');
                // $this->db->where('department_id', 'department.department_id');
                $query = $this->db->get();
                return $query->result_array();
	}

	function get_Manager_Employee_Id() {
		$this->db->select('employee_id');
                $this->db->from('department_manager');
                $managers = $this->db->get();
                return $managers->result_array();
	}
}
