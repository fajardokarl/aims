<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_model extends CI_Model
{
	function get_employees()
    {
        $this->db->select('employee.*, person.firstname, person.middlename, person.lastname, person.suffix, person.sex, person.birthdate');
        $this->db->from('employee');
        $this->db->join('person', 'person.person_id = employee.employee_id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }

}