<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Its extends CI_Controller {
    private $data = array();

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('its_model','its');
        //$this->load->model('Inbox_model','inbox');
         $this->data['customjs'] = 'its/itscustomjs';
    }   
    public function index()
    {
        if(!isset($this->session->userdata['logged_in'])){
            redirect('logout', 'refresh');
        }

        $this->data['page_title'] = 'IT Services';
        $this->data['content'] = 'dashboard';
        $this->data['navigation'] = 'navigation';
    


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
     public function employees(){
        if(isset($this->session->userdata['logged_in'])){   
    }
       
        $this->data['page_title'] = 'New employee';
        $this->data['content'] = 'employee_form';
        $this->data['navigation'] = 'navigation';       

        $this->data['all_department'] = $this->its->retrieve_department();
        $this->data['all_status'] = $this->its->retrieve_status();
        $this->data['family_type'] = $this->its->retrieve_family();
        $this->data['addschool'] = $this->its->retrieve_school();
        $this->data['all_employees'] = $this->its->retrieve_all_employee();
        $this->data['allcity'] = $this->its->getAllCity();
        $this->data['addtype'] = $this->its->getAddressType();
        $this->data['addcountry'] = $this->its->getAllCountry();
        $this->data['allprovince'] = $this->its->getAllProvince();       
        $this->data['contact_type'] = $this->its->get_contact_type();
        $this->data['all_permission'] = $this->its->retrieve_all_permission();


        $this->load->view('default/index', $this->data);
    }

    public function save_employee(){
        $this->load->helper('date'); 
        $this->load->model('its_model');

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
                'tin' =>$this->input->post('tin')
                 );
        $personid = $this->its_model->insert_person($data);


    $dataemp = array(
                'person_id' => $personid                     
                 );
    $employeeID = $this->its_model->insert_employee($dataemp);

          // Address information
    foreach ($this->input->post('line_1') as $i => $value)
        {
            $data4 = array(
              
                'address_type_id' => $this->input->post('addtype')[$i],
                'line_1' => $this->input->post('line_1')[$i],
                'line_2' => $this->input->post('line_2')[$i],              
                'city_id' => $this->input->post('city_id')[$i],
                'province_id' => $this->input->post('allprovince')[$i],
                'postal_code' => $this->input->post('postal')[$i],             
                'country_id' => $this->input->post('addcountry')[$i]
                                                   
        );
        $address_id = $this->its_model->insert_peron_address($data4);         
   }

       foreach ($this->input->post('contact_value') as $i => $value)
        {
            $data10 = array(
                                 
    
                'person_id' =>$personid,
                'contact_type_id' => $this->input->post('contact_type_id')[$i],             
                'contact_value' => $this->input->post('contact_value')[$i]
                                                   
        );
                $this->its_model->insert_contact($data10);         
   } 



    $data5 = array(
            'person_id'   =>$personid,
            'address_id'   =>$address_id
        );    
        $this->its_model->insert_address($data5);


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
        $userid = $this->its_model->insert_user($data2);
        $this->its_model->log_user($employeeID);


       // Department Employee
    $data3 = array(
            "employee_id"   =>$employeeID,
            "from_date"   =>date('Y-m-d'),
            "department_id"   => $this->input->post('department_id'),
            "job_position"   => $this->input->post('job_position')
        );    
        $this->its_model->insert_dept_employee($data3);


    $data6 = array(
             "status_id"   =>$this->input->post('saveEmployee'),
             "created_by"    =>$this->input->post('created_by'),
             "user_id"    =>$userid,
             "route_id"    =>$this->input->post('department_id'),
             "created"   =>date('Y-m-d'),
             "permission_id"   =>$this->input->post('all_permission')
        );
        $this->its_model->insert_urrp($data6);


    $data7 = array(
             "status_id"   =>$this->input->post('saveEmployee'),
             "created_by"    =>$this->input->post('created_by'),
             "user_id"    =>$userid,
             "route_id"    =>$this->input->post('department_id'),
             "created"   =>date('Y-m-d'),
             "permission_id"   =>$this->input->post('all_permission')
        );
        $this->its_model->insert_urp($data7);


    foreach ($this->input->post('level') as $i => $value)
        {
    $data8 = array(
             'employee_id'    =>$employeeID,
             'level'   =>$this->input->post('level')[$i],
             'schoolName'    =>$this->input->post('schoolName')[$i],            
             'fromdate'    =>$this->input->post('fromdate')[$i],     
             'todate'   =>$this->input->post('todate')[$i],
             'yearGraduate'   =>$this->input->post('yearGraduate')[$i]
        );
      $this->its_model->insert_school($data8);         
   }

    foreach ($this->input->post('examtype') as $i => $value)
        {
    $dat9 = array(
             'employee_id'    =>$employeeID,
             'examtype'   =>$this->input->post('examtype')[$i],
             'examName'    =>$this->input->post('examName')[$i],            
             'examTaken'    =>$this->input->post('examTaken')[$i],     
             'dateExpiration'   =>$this->input->post('dateExpiration')[$i]
       
        );
      $this->its_model->insert_exam($dat9);         
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
      $this->its_model->insert_family($data12);         
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
      $this->its_model->insert_work_experience($data11);         
   }
    foreach ($this->input->post('current_position') as $i => $value)
        {
    $data13 = array(
             'employee_id'    =>$employeeID,
             'current_position'   =>$this->input->post('current_position')[$i],
             'evaluated_by'    =>$this->input->post('evaluated_by')[$i],            
             'eval_from'    =>$this->input->post('eval_from')[$i],     
             'eval_to'   =>$this->input->post('eval_to')[$i],
             'eval_remark'   =>$this->input->post('eval_result')[$i],       
             'eval_remark'   =>$this->input->post('eval_remark')[$i]       
        );
      $this->its_model->insert_evaluation($data13);         
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
      $this->its_model->insert_movement($data14);         
   }
   }
    }
