<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Hris extends CI_Controller {
    private $data = array();

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('hris_model','hris');
        //$this->load->model('Inbox_model','inbox');
         $this->data['customjs'] = 'hris/hriscustomjs';
    }   
    public function index()
    {
        if(!isset($this->session->userdata['logged_in'])){
            redirect('logout', 'refresh');
        }

        $this->data['page_title'] = 'Human Resource Information System';
        $this->data['content'] = 'hris_dashboard';
        $this->data['navigation'] = 'hris_navigation';
    


        $this->load->view('default/index', $this->data);

    }
    public function inbox(){
        if(isset($this->session->userdata['logged_in'])){
        
        $this->load->library('layouts');

        $this->layouts->set_title('Welcom Home!');
                                                      //foldername/filename 
        $this->layouts->view('home',array('latest' => 'sidebar/latest')); 
        // $this->load->view('default/index', $this->data);
        }
    }

    public function employee_info(){
      $this->data['content'] = 'testing';
      $this->data['page_title'] = 'Employee information';
      $this->data['navigation'] = 'hris_navigation';    
      $this->data['add_family_type'] = $this->hris->retrieve_add_family();
      $this->data['all_employees'] = $this->hris->evaluated_by();
      $this->data['emp'] = $this->hris->get_employee_info($this->input->get('personid'));
      $this->data['address'] = $this->hris->get_employee_address($this->input->get('personid'));
      $this->data['contact'] = $this->hris->get_employee_contact($this->input->get('personid'));
      $this->data['school'] = $this->hris->get_employee_school($this->input->get('personid'));
      $this->data['exam'] = $this->hris->get_employee_exam($this->input->get('personid'));
      $this->data['work'] = $this->hris->get_employee_work($this->input->get('personid'));
      $this->data['family'] = $this->hris->get_employee_family($this->input->get('personid'));
      $this->data['evaluation'] = $this->hris->get_employee_evaluation($this->input->get('personid'));
      $this->data['movement'] = $this->hris->get_employee_movement($this->input->get('personid'));
      $this->data['language'] = $this->hris->get_employee_language($this->input->get('personid'));
      $this->data['civil_status'] = $this->hris->retrieve_status($this->input->get('personid'));
      $this->load->view('default/index', $this->data); 
}


      public function employees_list()
    {
        //admins only page

        $this->data['content'] = 'employee_list';
        $this->data['page_title'] = 'Employees list';
        $this->data['navigation'] = 'hris_navigation';
    
        // $this->data['all_employees'] = $this->user->retrieve_all_employee();
        $this->data['emp_list'] = $this->hris->retrieve_all_employee();


        if(isset($this->session->userdata['logged_in'])){
            // get all users
            // get all routes
            // get all permissions
            // get all roles

            // get user permissions

            // $this->data['users'] = $this->hris->get_users();
            //$this->data['routes'] = $this->route->get_routes();
            //$this->data['permissions'] = $this->permission->get_permissions();
            //$this->data['roles'] = $this->role->get_roles();
        }

        $this->load->view('default/index', $this->data);         
    }
     public function employees(){
        if(isset($this->session->userdata['logged_in'])){   
    }
       
        $this->data['page_title'] = 'New employee';
        $this->data['content'] = 'employee_form';
        $this->data['navigation'] = 'hris_navigation';       

   
        $this->data['all_department'] = $this->hris->retrieve_department();
        $this->data['all_status'] = $this->hris->retrieve_status();
        $this->data['family_type'] = $this->hris->retrieve_family();
        $this->data['addschool'] = $this->hris->retrieve_school();
        $this->data['all_employees'] = $this->hris->retrieve_all_employee();
        $this->data['allcity'] = $this->hris->getAllCity();
        $this->data['addtype'] = $this->hris->getAddressType();
        $this->data['addcountry'] = $this->hris->getAllCountry();
        $this->data['allprovince'] = $this->hris->getAllProvince();       
        $this->data['contact_type'] = $this->hris->get_contact_type();
        $this->data['all_permission'] = $this->hris->retrieve_all_permission();

        $this->load->view('default/index', $this->data);
    }
    

public function get_one_person(){
        $info_person_id = $this->input->post('person_id');
        $info_person_id = $this->file->get_person_detail($info_person_id);
        echo json_encode($info_person_id);
    }

    public function get_one_to(){
        $person_id = $this->input->post('person_id');
        $person_id = $this->hris->get_to_detail($person_id);
        echo json_encode($person_id);
    }

public function update_evaluation(){
        $this->load->helper('date'); 
        $this->load->model('hris_model');

        // Employee information
    $data = array(        
             'employee_id'    =>$this->input->post('add_employee_id'),
             'current_position'   =>$this->input->post('add_job_position'),
             'evaluated_by'    =>$this->input->post('add_evaluated_by'),            
             'eval_from'    =>$this->input->post('add_evaldate_from'),     
             'eval_to'   =>$this->input->post('add_evaldate_to'),
             'eval_result'   =>$this->input->post('add_eval_result'),       
             'eval_remark'   =>$this->input->post('add_eval_remarks')       
        );
            $this->hris_model->insert_add_evaluation($data);
    }

public function update_movement(){
        $this->load->helper('date'); 
        $this->load->model('hris_model');

        // Employee information
    $data = array(        
             'employee_id'    =>$this->input->post('movement_employee_id'),
             'movement_from'   =>$this->input->post('add_movement_from'),
             'movement_to'    =>$this->input->post('add_movement_to'),            
             'effective_date'    =>$this->input->post('add_effective_date'),     
             'approval_date'   =>$this->input->post('add_approval_date'),
             'movement_remarks'   =>$this->input->post('add_movement_remarks')      
       
        );
            $this->hris_model->insert_add_movement($data);
    }

public function update_exam(){
        $this->load->helper('date'); 
        $this->load->model('hris_model');

        // Employee information
    $data = array(        
             'employee_id'    =>$this->input->post('exam_employee_id'),            
             'exam_type'   =>$this->input->post('add_exam_type'),
             'exam_name'    =>$this->input->post('add_exam_name'),            
             'exam_rating'    =>$this->input->post('add_exam_rating'),            
             'exam_taken'    =>$this->input->post('add_date_taken'),     
             'date_expiration'   =>$this->input->post('add_date_exp')  
       
        );
            $this->hris_model->insert_add_exam($data);
    }

public function update_family(){
        $this->load->helper('date'); 
        $this->load->model('hris_model');

        // Employee information
    $data = array(        
             'employee_id'    =>$this->input->post('family_employee_id'),
             'fam_desc'   =>$this->input->post('add_fam'),
             'fam_name'    =>$this->input->post('add_fam_name'),            
             'fam_age'    =>$this->input->post('add_fam_age'),     
             'fam_contact'   =>$this->input->post('add_fam_contact'),
             'fam_address'   =>$this->input->post('add_fam_add')      
       
        );
            $this->hris_model->insert_add_family($data);
    }

public function update_person(){
        $this->load->helper('date'); 
        $this->load->model('hris_model');
    $info_person_id = $this->input->post('info_person_id');        
    $data = array(        
                 
                'lastname' =>$this->input->post('edit_lastname'),
                'firstname' =>$this->input->post('edit_firstname'),
                'middlename' =>$this->input->post('edit_middlename'),
                'prefix' =>$this->input->post('edit_prefix'),               
                'suffix' =>$this->input->post('edit_suffix'),                
                'sex' =>$this->input->post('edit_sex'),                
                'birthdate' =>$this->input->post('edit_birthdate'),                
                'birthplace' =>$this->input->post('edit_birthplace'),
                'nationality' =>$this->input->post('edit_nationality'),
                'civil_status_id' =>$this->input->post('edit_civil_status'),
                'height' =>$this->input->post('edit_height'),
                'weight' =>$this->input->post('edit_weight'),
                'phic' =>$this->input->post('edit_philhealth'),
                'sss' =>$this->input->post('edit_sss'),
                'hdmf' =>$this->input->post('edit_hdmf'),
                'tin' =>$this->input->post('edit_tin')
                 );      
       
   
            $this->hris_model->update_person($info_person_id,$data);
    }

    public function save_employee(){
        $this->load->helper('date'); 
        $this->load->model('hris_model');

        // Employee information
    $data = array(        
                'lastname' =>$this->input->post('lastname'),
                'firstname' =>$this->input->post('firstname'),
                'middlename' =>$this->input->post('middlename'),
                'prefix' =>$this->input->post('prefix'),               
                'suffix' =>$this->input->post('suffix'),                
                'sex' =>$this->input->post('sex'),                
                'birthdate' =>$this->input->post('birthdate'),                
                'birthplace' =>$this->input->post('birthplace'),
                'nationality' =>$this->input->post('nationality'),
                'civil_status_id' =>$this->input->post('civil_status'),
                'height' =>$this->input->post('height'),
                'weight' =>$this->input->post('weight'),
                'phic' =>$this->input->post('philhealth'),
                'sss' =>$this->input->post('sss'),
                'hdmf' =>$this->input->post('hdmf'),
                'tin' =>$this->input->post('tin')
                 );
        $personid = $this->hris_model->insert_person($data);


    $dataemp = array(
                'person_id' => $personid,
                'date_hired' =>$this->input->post('date_hired'),
                'initial' =>$this->input->post('initial')
                 );
    $employeeID = $this->hris_model->insert_employee($dataemp);

          // Address information
    foreach ($this->input->post('line_1') as $i => $value)
        {
            $data4 = array(
              
                'address_type_id' => $this->input->post('addtype')[$i],
                'line_1' => $this->input->post('line_1')[$i],
                'line_2' => $this->input->post('line_2')[$i],              
                'city_id' => $this->input->post('allcity')[$i],
                'province_id' => $this->input->post('allprovince')[$i],
                'postal_code' => $this->input->post('postal')[$i],             
                'country_id' => $this->input->post('addcountry')[$i]
                                                   
        );
        $address_id = $this->hris_model->insert_address($data4);         
   }

       foreach ($this->input->post('contact_value') as $i => $value)
        {
            $data10 = array(
                                 
    
                'person_id' =>$personid,
                'contact_type_id' => $this->input->post('contact_type_id')[$i],             
                'contact_value' => $this->input->post('contact_value')[$i]
                                                   
        );
                $this->hris_model->insert_contact($data10);         
   } 



    $data5 = array(
            'person_id'   =>$personid,
            'address_id'   =>$address_id
        );    
        $this->hris_model->insert_person_address($data5);


       // Account information  
    $data2 = array(
                'person_id' => $personid, 
                'status_id'   =>$this->input->post('saveEmployee'),
                'username' =>$this->input->post('username'),
                'password' =>$this->input->post('password'),
                'email' =>$this->input->post('email'),
                'created' =>date('Y-m-d'),
                'created_by' =>$this->input->post('created_by')         
                 );
        $userid = $this->hris_model->insert_user($data2);
        $this->hris_model->log_user($employeeID);


       // Department Employee
    $data3 = array(
            "employee_id"   =>$employeeID,
            "from_date"   =>date('Y-m-d'),
            "department_id"   => $this->input->post('department_id'),
            "job_position"   => $this->input->post('job_position')
        );    
        $this->hris_model->insert_dept_employee($data3);


    $data6 = array(
             "status_id"   =>$this->input->post('saveEmployee'),
             "created_by"    =>$this->input->post('created_by'),
             "user_id"    =>$userid,
             "route_id"    =>$this->input->post('department_id'),
             "created"   =>date('Y-m-d'),
             "permission_id"   =>$this->input->post('all_permission')
        );
        $this->hris_model->insert_urrp($data6);


    $data7 = array(
             "status_id"   =>$this->input->post('saveEmployee'),
             "created_by"    =>$this->input->post('created_by'),
             "user_id"    =>$userid,
             "route_id"    =>$this->input->post('department_id'),
             "created"   =>date('Y-m-d'),
             "permission_id"   =>$this->input->post('all_permission')
        );
        $this->hris_model->insert_urp($data7);


    foreach ($this->input->post('level') as $i => $value)
        {
    $data8 = array(
             'employee_id'    =>$employeeID,
             'level'   =>$this->input->post('level')[$i],
             'school_name'    =>$this->input->post('schoolName')[$i],            
             'fromdate'    =>$this->input->post('fromdate')[$i],     
             'todate'   =>$this->input->post('todate')[$i],
             'year_graduate'   =>$this->input->post('yearGraduate')[$i]
        );
      $this->hris_model->insert_school($data8);         
   }

    foreach ($this->input->post('examtype') as $i => $value)
        {
    $dat9 = array(
             'employee_id'    =>$employeeID,
             'exam_type'   =>$this->input->post('examtype')[$i],
             'exam_name'    =>$this->input->post('examName')[$i],            
             'exam_rating'    =>$this->input->post('examRating')[$i],            
             'exam_taken'    =>$this->input->post('examTaken')[$i],     
             'date_expiration'   =>$this->input->post('dateExpiration')[$i]
       
        );
      $this->hris_model->insert_exam($dat9);         
   }
    foreach ($this->input->post('fam_desc') as $i => $value)
        {
    $data12 = array(
             'employee_id'    =>$employeeID,
             'fam_desc'   =>$this->input->post('fam_desc')[$i],
             'fam_name'    =>$this->input->post('fam_name')[$i],            
             'fam_age'    =>$this->input->post('fam_age')[$i],     
             'fam_address'   =>$this->input->post('fam_address')[$i],
             'fam_contact'   =>$this->input->post('fam_contact')[$i]       
        );
      $this->hris_model->insert_family($data12);         
   }
    foreach ($this->input->post('previous_position') as $i => $value)
        {
    $data11 = array(
             'employee_id'    =>$employeeID,
             'previous_position'   =>$this->input->post('previous_position')[$i],
             'employer'    =>$this->input->post('employer')[$i],            
             'exclusive_from'    =>$this->input->post('exclusive_from')[$i],     
             'exclusive_to'   =>$this->input->post('exclusive_to')[$i],
             'compensation'   =>$this->input->post('compensation')[$i]       
        );
      $this->hris_model->insert_work_experience($data11);         
   }
    foreach ($this->input->post('current_position') as $i => $value)
        {
    $data13 = array(
             'employee_id'    =>$employeeID,
             'current_position'   =>$this->input->post('current_position')[$i],
             'evaluated_by'    =>$this->input->post('evaluated_by')[$i],            
             'eval_from'    =>$this->input->post('eval_from')[$i],     
             'eval_to'   =>$this->input->post('eval_to')[$i],
             'eval_result'   =>$this->input->post('eval_result')[$i],       
             'eval_remark'   =>$this->input->post('eval_remark')[$i]       
        );
      $this->hris_model->insert_evaluation($data13);         
   }
    foreach ($this->input->post('movement_from') as $i => $value)
        {
    $data14 = array(
             'employee_id'    =>$employeeID,
             'movement_from'   =>$this->input->post('movement_from')[$i],
             'movement_to'    =>$this->input->post('movement_to')[$i],            
             'effective_date'    =>$this->input->post('effective_date')[$i], 
             'approval_date'   =>$this->input->post('approval_date')[$i],       
             'movement_remarks'   =>$this->input->post('movement_remarks')[$i]       
        );
      $this->hris_model->insert_movement($data14);         
   }

    foreach ($this->input->post('language') as $i => $value)
        {
    $data15 = array(
             'employee_id'    =>$employeeID,
             'language'   =>$this->input->post('language')[$i]
                  
        );
      $this->hris_model->insert_language($data15);         
   }
   }
    }
