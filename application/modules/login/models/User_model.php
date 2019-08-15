<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{

    function get_users()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('person', 'user.person_id = person.person_id', 'inner');
        $this->db->where('status_id', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    /*function inbox_seen()
    {
        $this->db->select('COUNT(seen_receipt) as seen_receipt');
        $this->db->from('prf');
        $this->db->where('seen_receipt =', 0);
        $query = $this->db->get();
        return $query->row();
    }*/

    function inbox_total()
    {
        $this->load->database();
        $this->db->trans_start();
        $this->db->select('COUNT(prf_id) as prf_count');
        $this->db->from('prf');
        $query = $this->db->get();
        $this->db->trans_complete();
        return $query->row();
    }

    function getUnseen()
    {
        $this->load->database();
        $this->db->trans_start();
        $this->db->select('COUNT(seen_receipt) as unseen_receipt_count');
        $this->db->from('prf');
        $this->db->where('seen_receipt =', 0);
        $query = $this->db->get();
        $this->db->trans_complete();
        return $query->row();
    }


    // function insert_user($data)
    // {
    //     $this->db->trans_start();
    //     $this->db->where('person_id', $data['employee_id']);    
    //     $this->db->update('user', $data);
    //     $lastuserID = $this->db->insert_id();
    //     $this->db->trans_complete();
    //     return $lastuserID;

    // }

    // function insert_dept($data){
    //     $this->db->trans_start();
    //     $this->db->insert('department_employee', $data);        
    //     $lastEmpID = $this->db->insert_id();
    //     $this->db->trans_complete();
    //     return $lastEmpID;
    // }
    //----end 2 tables here

//end here



      function insert_user($data)
    {
        $this->db->trans_start();
        $this->db->where('person_id', $data['person_id']);
        $this->db->update('user', $data);
        $lastEmp = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastEmp;
    }

    function log_user($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('user', array('last_logged' => date('Y-m-d H:i:s')));
    }

     function insert_dept($data)
    {
        $this->db->trans_start();
        $this->db->insert('department_employee', $data);
        $lastDept = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastDept;
    }
    
    function insert_urrp($data)
    {
        $this->db->trans_start();
        $this->db->insert('user_route_role_permission', $data);
        $lasturrp = $this->db->insert_id();
        $this->db->trans_complete();
        return $lasturrp;
    }

     function insert_urp($data)
    {
        $this->db->trans_start();
        $this->db->insert('user_role_permission', $data);
        $lasturp = $this->db->insert_id();
        $this->db->trans_complete();
        return $lasturp;
    }




    //inserting employee data to database
    // function insert_user($data)
    // {
    //     $this->db->insert("user", $data);
    // }
    //end here


    function check_valid_user($data)    
    {
        //var_dump($data);die;
        $condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "'";
        $this->db->select('user.*, person.firstname, person.middlename, person.lastname, person.suffix, person.sex, person.birthdate, employee.employee_id, department.department_id, department.department_name, route.route_name');
        $this->db->where($condition);
        $this->db->where('user.status_id', 1);
        $this->db->where('user.verified', 1);
        $this->db->from('user');
        $this->db->join('person', 'person.person_id = user.person_id', 'left');
        $this->db->join('employee', 'employee.person_id = user.person_id', 'left');
        $this->db->join('department_employee', 'department_employee.employee_id = employee.employee_id', 'left');
        $this->db->join('department', 'department_employee.department_id = department.department_id', 'left');

         $this->db->join('budget', 'department_employee.department_id = budget.department_id', 'left');

        $this->db->join('budget_detail', 'budget_detail.budget_id = budget.budget_id', 'left');
          
        $this->db->join('route', 'department.route_id = route.route_id', 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        //var_dump($query);die;
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    //create here!


    
    function retrieve_all_employee()
    {
         $this->db->select('*');
         $this->db->from('user a');
         $this->db->join('person b', 'a.person_id = b.person_id', 'inner');
         $this->db->where('a.status_id', null);
         $query = $this->db->get();
         return $query->result_array();
    }

    // function permission()
    // {
    //    $this->db->select('activity_code');
    //    $this->db->from('user');
    //    $this->db->where('a.status_id', 0001);
    //    $query = $this->db->get();
    //    return $query->result_array();
    // }

     function retrieve_all_permission()
    {
         $this->db->select('*');
         $this->db->from('permission');
         $query = $this->db->get();
         return $query->result_array();
    }


    function retrieve_all_department()
    {
         $this->db->select('*');
         $this->db->from('department');
         $query = $this->db->get();
         return $query->result_array();
    }
    //status query
    // function retrieve_all_status()
    // {
    //      $this->db->select('*');
    //      $this->db->from('status');
    //      $query = $this->db->get();
    //      return $query->result_array();
    //  }

    
    public function read_user_information($username)
    {
        $condition = "username =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($condition);
        $this->db->join('person', 'person.person_id = user.user_id', 'inner');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

}