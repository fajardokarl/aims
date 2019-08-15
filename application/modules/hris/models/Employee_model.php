<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_model extends CI_Model {

    public function __construct()
    {
        // call parent constructor
        parent::__construct();
        // $this->load->model('Department_manager_model');
    }

    public function get_all()
    {
        $this->db->select('*');
        $this->db->from('employee');
        $this->db->join('person', 'person.person_id = employee.employee_id', 'inner');
        $query = $this->db->get();
        return $query->result();
    }
   function get_employee_info($person_id)
    {
     $this->db->select('*');
     $this->db->from('person');
     $this->db->where('person_id = ',$person_id);
     $query = $this->db->get();
     return $query->row();
     }

    /**
     * used in users controller
     * -- aos
     */
    function get_employees()
    {
        /*$this->db->select('employee_id');
        $this->db->from('department_manager');*/
        // $managers = $this->department_manager_model->get_Manager_Employee_Id();

        // print_r($managers);

        //$managers = $this->mana();

        // $array[0] = 1;
        // $array[1] = 5;

        $this->db->select('*,employee.employee_id');
        // for( $i = 0; $i < count($array); $i++) {
        //     $this->db->where('employee.employee_id !=', $array[$i]);
        // }
        $this->db->from('employee');
        $this->db->join('person', 'employee.person_id = person.person_id', 'left');
        $this->db->join('department_employee', 'department_employee.employee_id = employee.employee_id', 'left');
        $this->db->join('department', 'department.department_id = department_employee.department_id', 'left');
        $this->db->join('department_manager', 'department_manager.employee_id = employee.employee_id', 'left');
        $this->db->where('department_manager.employee_id IS NULL');
        $query = $this->db->get();
        return $query->result_array();
    }
/* function get_employees($id){
      $query = $this->db->query('select * from employee where employee_id not in (select employee_id from department_manager)');
      return $query->result_array();
    }*/
    /*function managers()
    {
        $this->db->select('employee_id');
        $this->db->from('department_manager');
        $managers = $this->db->query('SELECT employee_id FROM department_manager')->result_array();
        return $managers;
    }*/
    
}