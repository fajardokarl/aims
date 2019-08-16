<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Its_model extends CI_Model{
public function __construct()
    {
        // call parent constructor
        parent::__construct();
    }

  function retrieve_all_employee()
  {
   $this->db->select('*');
   $this->db->from('user a');
   $this->db->join('person b', 'a.person_id = b.person_id', 'inner');
   $this->db->where('a.status_id', null);
   $query = $this->db->get();
   return $query->result_array();
  }

   function retrieve_status()
    {
    $this->db->select('*');
    $this->db->from('civil_status'); 
    $this->db->where('status_id',1);         
    $query = $this->db->get();   
    return $query->result_array();
    }
   function retrieve_family()
    {
    $this->db->select('*');
    $this->db->from('family'); 
    $query = $this->db->get();   
    return $query->result_array();
    }
    function retrieve_school()
    {
    $this->db->select('*');
    $this->db->from('school_level'); 
    $query = $this->db->get();   
    return $query->result_array();
    }
    function retrieve_department()
    {
    $this->db->select('*');
    $this->db->from('department'); 
    $this->db->where('status_id',1);         
    $query = $this->db->get();   
    return $query->result_array();

    }
        function getAllCity(){
       $this->db->select('*');
       $this->db->from('address_city');
       $query = $this->db->get();
       return $query->result_array();
    }

     function getAllProvince(){
       $this->db->select('*');
       $this->db->from('address_province');
       $query = $this->db->get();
       return $query->result_array();
    }

     function getAddressType(){
       $this->db->select('*');
       $this->db->from('address_type');
       $query = $this->db->get();
       return $query->result_array();
    }

     function getAllCountry(){
       $this->db->select('*');
       $this->db->from('address_country');
       $query = $this->db->get();
       return $query->result_array();
    }

    function get_contact_type()
    {
       $this->db->select('*');
       $this->db->from('contact_type');
       $query = $this->db->get();
       return $query->result_array();
    }
         function retrieve_all_permission()
    {
         $this->db->select('*');
         $this->db->from('permission');
         $query = $this->db->get();
         return $query->result_array();
    }

         function insert_person($data)
    {
        $this->db->trans_start();
        $this->db->insert('person', $data);
        $personID = $this->db->insert_id();
        $this->db->trans_complete();
        return $personID;
    }

        function insert_school($data)
    {
        $this->db->trans_start();
        $this->db->insert('school_attended', $data);
        $schoolid = $this->db->insert_id();
        $this->db->trans_complete();
        return $schoolid;
    }

        function insert_exam($data)
    {
        $this->db->trans_start();
        $this->db->insert('exam_taken', $data);
        $examid = $this->db->insert_id();
        $this->db->trans_complete();
        return $examid;
    }

        function insert_family($data)
    {
        $this->db->trans_start();
        $this->db->insert('family_information', $data);
        $faminfoid = $this->db->insert_id();
        $this->db->trans_complete();
        return $faminfoid;
    }
        function insert_work_experience($data)
    {
        $this->db->trans_start();
        $this->db->insert('work_experience', $data);
        $workid = $this->db->insert_id();
        $this->db->trans_complete();
        return $workid;
    }  
        function insert_evaluation($data)
    {
        $this->db->trans_start();
        $this->db->insert('employee_evaluation', $data);
        $evalid = $this->db->insert_id();
        $this->db->trans_complete();
        return $evalid;
    }
        function insert_movement($data)
    {
        $this->db->trans_start();
        $this->db->insert('employee_movement', $data);
        $moveid = $this->db->insert_id();
        $this->db->trans_complete();
        return $moveid;
    }


        function insert_employee($data)
    {
        $this->db->trans_start();
        $this->db->insert('employee', $data);
        $empID = $this->db->insert_id();
        $this->db->trans_complete();
        return $empID;
    }

         function insert_peron_address($data)
    {
        $this->db->trans_start();
        $this->db->insert('address', $data);
        $addressID = $this->db->insert_id();
        $this->db->trans_complete();
        return $addressID;
    }

         function insert_contact($data)
    {
        $this->db->trans_start();
        $this->db->insert('contact', $data);
        $contactID = $this->db->insert_id();
        $this->db->trans_complete();
        return $contactID;
    }
   
         function insert_dept_employee($data)
    {
        $this->db->trans_start();
        $this->db->insert('department_employee', $data);
        $lastDept = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastDept;
    }

      function insert_address($data)
    {
        $this->db->trans_start();
        $this->db->insert('person_address', $data);
        $lastPerson = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastPerson;
    }

      function insert_user($data)
    {
        $this->db->trans_start();
        $this->db->insert('user', $data);
        $lastUser = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastUser;
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

    function log_user($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('user', array('last_logged' => date('Y-m-d H:i:s')));
    }
}


