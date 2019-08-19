<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hris_model extends CI_Model{
public function __construct()
    {
        // call parent constructor
        parent::__construct();
    }


    function get_to_detail($person_id)
    {
     $this->db->select('*');
     $this->db->from('person');    
     $this->db->where('person_id',$person_id);
     $query = $this->db->get();
     return $query->result_array();
     }

  function retrieve_all_employee()
  {
   $this->db->select('*');
   $this->db->from('user a');
   $this->db->join('person b', 'a.person_id = b.person_id', 'inner');
   $this->db->join('employee c', 'c.person_id = b.person_id', 'left');  
   $this->db->join('department_employee d', 'c.employee_id = d.employee_id', 'left');  
   $this->db->join('department e', 'd.department_id = e.department_id', 'left');  
   // $this->db->where('a.status_id', null);
   $query = $this->db->get();
   return $query->result_array();
  }

  function retrieve_all_applicant()
  {
   $this->db->select('*');
   $this->db->from('app_department a');
   // $this->db->join('person b', 'a.person_id = b.person_id', 'inner');
   // $this->db->join('employee c', 'c.person_id = b.person_id', 'left');  
   $this->db->join('person d', 'a.person_id = d.person_id', 'inner');  
   $this->db->join('department e', 'a.app_department_id = e.department_id', 'inner');  
   // $this->db->where('a.person_type', 2);
   $query = $this->db->get();
   return $query->result_array();
  }  
     function get_applicant_info($id)
    {
     $this->db->select('*');
     $this->db->from('person a');     
     $this->db->join('app_department c', 'a.person_id = c.person_id', 'inner');  
     $this->db->join('department d', 'c.app_department_id = d.department_id', 'left');  
     $this->db->join('person_address e', 'a.person_id = e.person_id', 'left');  
     $this->db->join('address f', 'e.address_id = f.address_id', 'left');  
     $this->db->join('civil_status g', 'a.civil_status_id = g.civil_status_id', 'left');  
     $this->db->where('a.person_id= ',$id);
     $query = $this->db->get();
     return $query->row();
     }

     function get_employee_info($id)
    {
     $this->db->select('*');
     $this->db->from('person a');
     $this->db->join('employee b', 'a.person_id = b.person_id', 'left');  
     $this->db->join('department_employee c', 'b.employee_id = c.employee_id', 'left');  
     $this->db->join('department d', 'c.department_id = d.department_id', 'left');  
     $this->db->join('person_address e', 'a.person_id = e.person_id', 'left');  
     $this->db->join('address f', 'e.address_id = f.address_id', 'left');  
     $this->db->join('civil_status g', 'a.civil_status_id = g.civil_status_id', 'inner');       
     $this->db->where('a.person_id= ',$id);
     $query = $this->db->get();
     return $query->row();
     }
     
     function get_employee_address($id)
    {
     $this->db->select('*');
     $this->db->from('person a');
     $this->db->join('employee b', 'a.person_id = b.person_id', 'left');  
     $this->db->join('department_employee c', 'b.employee_id = c.employee_id', 'left');  
     $this->db->join('department d', 'c.department_id = d.department_id', 'left');  
     $this->db->join('person_address e', 'a.person_id = e.person_id', 'left');  
     $this->db->join('address f', 'e.address_id = f.address_id', 'left');  
     $this->db->join('address_type h', 'f.address_type_id = h.address_type_id', 'inner'); 
     $this->db->join('address_city i', 'f.city_id = i.address_city_id', 'left'); 
     $this->db->join('address_province j', 'f.province_id = j.address_province_id', 'left'); 
     $this->db->join('address_country l', 'f.country_id = l.id', 'left'); 
     $this->db->where('a.person_id= ',$id);
     $query = $this->db->get();
     return $query->result_array();
     }
     
     function get_employee_contact($id)
    {
     $this->db->select('*');
     $this->db->from('person a');
     $this->db->join('contact b', 'a.person_id = b.person_id', 'inner');  
     $this->db->join('contact_type d', 'b.contact_type_id = d.contact_type_id', 'left');    
     $this->db->where('b.person_id= ',$id);
     $query = $this->db->get();
     return $query->result_array();
     }

     function get_app_school($id)
    {
     $this->db->select('*');
     $this->db->from('person a');     
     $this->db->join('app_school d', 'a.person_id = d.person_id', 'left');    
     $this->db->join('school_level c', 'd.app_level = c.school_id', 'left');    
     $this->db->where('d.person_id= ',$id);
     $query = $this->db->get();
     return $query->result_array();
     }

     function get_employee_school($id)
    {
     $this->db->select('*');
     $this->db->from('person a');
     $this->db->join('employee b', 'a.person_id = b.person_id', 'left');  
     $this->db->join('school_attended d', 'b.employee_id = d.employee_id', 'left');    
     $this->db->join('school_level c', 'd.level = c.school_id', 'left');    
     $this->db->where('a.person_id= ',$id);
     $query = $this->db->get();
     return $query->result_array();
     }

  function evaluated_by()
  {
   $this->db->select('*');
   $this->db->from('user a');
   $this->db->join('person b', 'a.person_id = b.person_id', 'inner'); 
   $this->db->where('a.status_id', null);
   $query = $this->db->get();
   return $query->result_array();
  }
    function get_app_exam($id)
    {
     $this->db->select('*');
     $this->db->from('person a');    
     $this->db->join('app_exam_taken d', 'a.person_id = d.person_id', 'inner');    
     $this->db->where('d.person_id= ',$id);
     $query = $this->db->get();
     return $query->result_array();
     }
function get_app_answer($id)
    {
     $this->db->select('*');
     $this->db->from('person a');    
     $this->db->join('app_answer d', 'a.person_id = d.person_id', 'inner');    
     $this->db->where('d.person_id= ',$id);
     $query = $this->db->get();
     return $query->row();
     }


    function get_employee_exam($id)
    {
     $this->db->select('*');
     $this->db->from('person a');
     $this->db->join('employee b', 'a.person_id = b.person_id', 'inner');  
     $this->db->join('exam_taken d', 'b.employee_id = d.employee_id', 'inner');    
     $this->db->where('a.person_id= ',$id);
     $query = $this->db->get();
     return $query->result_array();
     }

    function get_employee_evaluation($id)
    {
     $this->db->select('*');
     $this->db->from('employee a');     
     $this->db->join('employee_evaluation b', 'a.employee_id =b.employee_id', 'inner');    
     $this->db->join('person c', 'b.evaluated_by =c.person_id', 'inner');    
     
     $this->db->where('a.person_id= ',$id);
     $query = $this->db->get();
     return $query->result_array();
     }
    function get_employee_movement($id)
    {
     $this->db->select('*');
    $this->db->from('person a');
     $this->db->join('employee b', 'a.person_id = b.person_id', 'left');          
     $this->db->join('employee_movement c', 'b.employee_id =c.employee_id', 'inner');    
     
     $this->db->where('a.person_id= ',$id);
     $query = $this->db->get();
     return $query->result_array();
     }
     function get_app_work($id)
    {
     $this->db->select('*');
     $this->db->from('app_work_experience');  
     $this->db->where('person_id= ',$id);
     $query = $this->db->get();
     return $query->result_array();
     }
    function get_employee_work($id)
    {
     $this->db->select('*');
     $this->db->from('person a');
     $this->db->join('employee b', 'a.person_id = b.person_id', 'left');  
     $this->db->join('work_experience d', 'b.employee_id = d.employee_id', 'left');    
     $this->db->where('a.person_id= ',$id);
     $query = $this->db->get();
     return $query->result_array();
     }

    function get_app_family($id)
    {
     $this->db->select('*');
     $this->db->from('app_family');    
     $this->db->where('person_id= ',$id);
     $query = $this->db->get();
     return $query->result_array();
     }
    function get_employee_family($id)
    {
     $this->db->select('*');
     $this->db->from('person a');
     $this->db->join('employee b', 'a.person_id = b.person_id', 'left');  
     $this->db->join('family_information d', 'b.employee_id = d.employee_id', 'left');    
     $this->db->join('family c', 'd.fam_desc = c.family_id', 'left');    
     $this->db->where('a.person_id= ',$id);
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

   function retrieve_add_family()
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

        function insert_language($data)
    {
        $this->db->trans_start();
        $this->db->insert('language', $data);
        $lastlanguage = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastlanguage;
    }

         function insert_person($data)
    {
        $this->db->trans_start();
        $this->db->insert('person', $data);
        $personID = $this->db->insert_id();
        $this->db->trans_complete();
        return $personID;
    }

         function insert_peron_address($data)
    {
        $this->db->trans_start();
        $this->db->insert('person_address', $data);
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

    function insert_add_evaluation($data)
    {
        $this->db->trans_start();
        $this->db->insert('employee_evaluation', $data);
        $addevalid = $this->db->insert_id();
        $this->db->trans_complete();
        return $addevalid;
    }
    function insert_add_movement($data)
    {
        $this->db->trans_start();
        $this->db->insert('employee_movement', $data);
        $addmoveid = $this->db->insert_id();
        $this->db->trans_complete();
        return $addmoveid;
    }
        function insert_add_family($data)
    {
        $this->db->trans_start();
        $this->db->insert('family_information', $data);
        $addfamid = $this->db->insert_id();
        $this->db->trans_complete();
        return $addfamid;
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

         function insert_address($data)
    {
        $this->db->trans_start();
        $this->db->insert('address', $data);
        $addressID = $this->db->insert_id();
        $this->db->trans_complete();
        return $addressID;
    }

        function insert_person_address($data)
    {
        $this->db->trans_start();
        $this->db->insert('person_address', $data);
        $lastPerson = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastPerson;
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

//Applicant models
         function insert_answers($data)
    {
        $this->db->trans_start();
        $this->db->insert('app_answer', $data);
        $appanswerID = $this->db->insert_id();
        $this->db->trans_complete();
        return $appanswerID;
    }
       function insert_app_dept($data)
    {
        $this->db->trans_start();
        $this->db->insert('app_department', $data);
        $appdeptID = $this->db->insert_id();
        $this->db->trans_complete();
        return $appdeptID;
    }
        function insert_app_school($data)
    {
        $this->db->trans_start();
        $this->db->insert('app_school', $data);
        $appschoolID = $this->db->insert_id();
        $this->db->trans_complete();
        return $appschoolID;
    }
        function insert_app_exam($data)
    {
        $this->db->trans_start();
        $this->db->insert('app_exam_taken', $data);
        $appexamID = $this->db->insert_id();
        $this->db->trans_complete();
        return $appexamID;
    }
        function insert_app_family($data)
    {
        $this->db->trans_start();
        $this->db->insert('app_family', $data);
        $appfamID = $this->db->insert_id();
        $this->db->trans_complete();
        return $appfamID;
    }
        function insert_app_work_experience($data)
    {
        $this->db->trans_start();
        $this->db->insert('app_work_experience', $data);
        $appworkID = $this->db->insert_id();
        $this->db->trans_complete();
        return $appworkID;
    }
        function insert_app_language($data)
    {
        $this->db->trans_start();
        $this->db->insert('app_language', $data);
        $applangID = $this->db->insert_id();
        $this->db->trans_complete();
        return $applangID;
    }
        function insert_app_references($data)
    {
        $this->db->trans_start();
        $this->db->insert('applicant_reference', $data);
        $apprefID = $this->db->insert_id();
        $this->db->trans_complete();
        return $apprefID;
    }
        function insert_app_source($data)
    {
        $this->db->trans_start();
        $this->db->insert('applicant_source', $data);
        $appsourceID = $this->db->insert_id();
        $this->db->trans_complete();
        return $appsourceID;
    }
}



