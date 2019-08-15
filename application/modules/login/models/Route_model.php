<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Route_model extends CI_Model
{


    public function __construct()
    {
        // call parent constructor
        parent::__construct();

    }

    // public function ibase_add_user(service_handle, user_name, password)r($employee, $department)
    // {
    //     $this->db->insert('user', $employee);
    //     $employee_id = $this->db->insert_id();

    //     //insert into department table
    //     $department['employee_id'] = $employee_id;
    //     $this->db->insert('department_employee', $department);
    //     return $insert_id = $this->db->insert_id();
    // }

        
        public function add_user($employee, $department)
        {
            $this->db->trans_start();
            $this->db->query('INSERT INTO user (username,password,email,user_id) VALUES (username, password,email,user_id)');
            $table1_id = $this->db->insert_id();


            $this->db->query('INSERT INTO department_employee (employee_id,department_id,from_date) VALUES (employee_id,department_id)');


            $this->db->query('INSERT INTO person (registration_code) VALUES (registration_code)');

            // $this->db->query('INSERT INTO department_employee VALUES(' . $table1_id . ',employee_id,department_id)');
            $this->db->trans_complete(); 
        }


    function get_routes()
    {
        $this->db->select('*');
        $this->db->from('route');
        $this->db->where('status_id', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

  
}