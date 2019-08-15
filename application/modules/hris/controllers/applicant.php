<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Applicant extends CI_Controller {
    private $data = array();

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('hris_model','hris');
        //$this->load->model('Inbox_model','inbox');
         $this->data['customjs'] = 'hris/applicantcustomjs';
    }   
    public function index()
    {
        if(!isset($this->session->userdata['logged_in'])){
            redirect('logout', 'refresh');
        }

        $this->data['page_title'] = 'Human Resource Information System';
        $this->data['content'] = 'applicant_form';
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
      public function applicant_list()
    {
        //admins only page

        $this->data['content'] = 'applicant_list';
        $this->data['page_title'] = 'Applicant list';
         $this->data['navigation'] = 'hris_navigation';
    
        // $this->data['all_employees'] = $this->user->retrieve_all_employee();
        $this->data['app_list'] = $this->hris->retrieve_all_applicant();


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


    public function applicant_info(){
      $this->data['content'] = 'applicant_information';
      $this->data['page_title'] = 'Applicant information';
      
      $this->data['app'] = $this->hris->get_applicant_info($this->input->get('personid'));
      $this->data['address'] = $this->hris->get_employee_address($this->input->get('personid'));
      $this->data['contact'] = $this->hris->get_employee_contact($this->input->get('personid'));
      $this->data['app_school'] = $this->hris->get_app_school($this->input->get('personid'));      
      $this->data['app_work'] = $this->hris->get_app_work($this->input->get('personid'));      
      $this->data['app_family'] = $this->hris->get_app_family($this->input->get('personid'));
      $this->data['app_exam'] = $this->hris->get_app_exam($this->input->get('personid'));      
      $this->data['answer'] = $this->hris->get_app_answer($this->input->get('personid'));      
      $this->load->view('default/index', $this->data); 
}


     public function applicant_form(){
        if(isset($this->session->userdata['logged_in'])){   
    }
       
        $this->data['page_title'] = 'Human Resource Information System/Application Form';
        $this->data['content'] = 'applicant_form';
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

    public function save_applicant(){
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
                'weight' =>$this->input->post('weight'),
                'height' =>$this->input->post('height'),
                'civil_status_id' =>$this->input->post('civil_status'),
              
                'tin' =>$this->input->post('tin'),
                'phic' =>$this->input->post('philhealth'),
                'sss' =>$this->input->post('sss'),
                'hdmf' =>$this->input->post('hdmf')
                 );
        $personid = $this->hris_model->insert_person($data);

    foreach ($this->input->post('app_line_1') as $i => $value)
        {
            $data4 = array(
              
                'address_type_id' => $this->input->post('app_addtype')[$i],
                'line_1' => $this->input->post('app_line_1')[$i],
                'line_2' => $this->input->post('app_line_2')[$i],              
                'city_id' => $this->input->post('app_allcity')[$i],
                'province_id' => $this->input->post('app_allprovince')[$i],
                'postal_code' => $this->input->post('app_postal')[$i],             
                'country_id' => $this->input->post('app_addcountry')[$i]
        );
           $address_id = $this->hris_model->insert_address($data4);         
   }
    $data5 = array(
            'person_id'   =>$personid,
            'address_id'   =>$address_id
        );    
    $address_id = $this->hris_model->insert_person_address($data5);


    $data16 = array( 
                'person_id' =>$personid,
                'impairment' =>$this->input->post('impairment'),
                'impairment_yes' =>$this->input->post('impairment_yes'),
                'doctor' =>$this->input->post('doctor'),
                'doctor_yes' =>$this->input->post('doctor_yes'),               
                'accident' =>$this->input->post('accident'),                
                'accident_yes' =>$this->input->post('accident_yes'),                
                'surgery' =>$this->input->post('surgery'),                
                'surgery_yes' =>$this->input->post('surgery_yes'),
                'law' =>$this->input->post('law'),
                'law_yes' =>$this->input->post('law_yes'),
                'discharge_yes' =>$this->input->post('discharge_yes'),                
                'affiliates' =>$this->input->post('affiliates'),                
                'affiliates_yes' =>$this->input->post('affiliates_yes'),
                'hospitalized' =>$this->input->post('hospitalized'),
                'work_with' =>$this->input->post('work_with'),

                'goals' =>$this->input->post('goals'),                
                'strong_points' =>$this->input->post('strong_points'),                
                'weak_points' =>$this->input->post('weak_points'),
                'start' =>$this->input->post('start'),
                'salary' =>$this->input->post('salary'),

                'discharge' =>$this->input->post('discharge')
                 );
        $this->hris_model->insert_answers($data16);
    // $dataemp = array(
    //             'person_id' => $personid                     
    //              );
    // $employeeID = $this->hris_model->insert_employee($dataemp);

          // Address information




    foreach ($this->input->post('contact_value') as $i => $value)
        {
            $data10 = array(                            
    
                'person_id' =>$personid,
                'contact_type_id' => $this->input->post('contact_type_id')[$i],             
                'contact_value' => $this->input->post('contact_value')[$i]
                                                   
        );
                $this->hris_model->insert_contact($data10);         
   } 

      // Department Employee
    $data3 = array(
            "person_id"   =>$personid,          
            "app_department_id"   => $this->input->post('app_department_id'),
            "app_job_position"   => $this->input->post('app_job_position'),
            "date_applied"   =>date('Y-m-d')
        );    
        $this->hris_model->insert_app_dept($data3);

    $data19 = array(
            "person_id"   =>$personid,          
            "source_id"   => $this->input->post('source_id')          
        );    
        $this->hris_model->insert_app_source($data19);

    foreach ($this->input->post('app_level') as $i => $value)
        {
    $data8 = array(
             'person_id'   =>$personid,
             'app_level'   =>$this->input->post('app_level')[$i],
             'app_schoolName'    =>$this->input->post('app_schoolName')[$i],            
             'app_fromdate'    =>$this->input->post('app_fromdate')[$i],     
             'app_todate'   =>$this->input->post('app_todate')[$i],
             'app_yearGraduate'   =>$this->input->post('app_yearGraduate')[$i]
        );
      $this->hris_model->insert_app_school($data8);         
   }

    foreach ($this->input->post('app_examtype') as $i => $value)
        {
    $dat9 = array(
             'person_id'   =>$personid,
             'app_examtype'   =>$this->input->post('app_examtype')[$i],
             'app_examName'    =>$this->input->post('app_examName')[$i],            
             'app_examTaken'    =>$this->input->post('app_examTaken')[$i],     
             'app_examRating'    =>$this->input->post('app_examRating')[$i],     
             'app_dateExpiration'   =>$this->input->post('app_dateExpiration')[$i]
       
        );
      $this->hris_model->insert_app_exam($dat9);         
   }
    foreach ($this->input->post('app_fam_desc') as $i => $value)
        {
    $data12 = array(
             'person_id'   =>$personid,
             'app_fam_desc'   =>$this->input->post('app_fam_desc')[$i],
             'app_fam_name'    =>$this->input->post('app_fam_name')[$i],            
             'app_fam_age'    =>$this->input->post('app_fam_age')[$i],     
             'app_fam_address'   =>$this->input->post('app_fam_address')[$i],
             'app_fam_contact'   =>$this->input->post('app_fam_contact')[$i]       
        );
      $this->hris_model->insert_app_family($data12);         
   }
    foreach ($this->input->post('app_previous_position') as $i => $value)
        {
    $data11 = array(
             'person_id'   =>$personid,
             'app_previous_position'   =>$this->input->post('app_previous_position')[$i],
             'app_employer'    =>$this->input->post('app_employer')[$i],            
             'app_exclusive_from'    =>$this->input->post('app_exclusive_from')[$i],     
             'app_exclusive_to'   =>$this->input->post('app_exclusive_to')[$i],
             'app_compensation'   =>$this->input->post('app_compensation')[$i]       
        );
      $this->hris_model->insert_app_work_experience($data11);         
   }
    foreach ($this->input->post('app_ref_name') as $i => $value)
        {
    $data13 = array(
             'person_id'   =>$personid,
             'app_ref_name'   =>$this->input->post('app_ref_name')[$i],
             'app_ref_position'    =>$this->input->post('app_ref_position')[$i],            
             'app_ref_company'    =>$this->input->post('app_ref_company')[$i],     
             'app_ref_contact'   =>$this->input->post('app_ref_contact')[$i],
             'app_ref_relationship'   =>$this->input->post('app_ref_relationship')[$i]     
           
        );
      $this->hris_model->insert_app_references($data13);         
   }
    foreach ($this->input->post('app_language') as $i => $value)
        {
    $data15 = array(
             'person_id'   =>$personid,
             'app_language'   =>$this->input->post('app_language')[$i]
                  
        );
      $this->hris_model->insert_app_language($data15);         
   }
   }
    }
