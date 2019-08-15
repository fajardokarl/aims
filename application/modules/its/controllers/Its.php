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

        $this->data['allcity'] = $this->its->getAllCity();
        $this->data['addtype'] = $this->its->getAddressType();
        $this->data['addcountry'] = $this->its->getAllCountry();
        $this->data['allprovince'] = $this->its->getAllProvince();
       
        $this->data['contact_type'] = $this->its->get_contact_type(); 

        $this->load->view('default/index', $this->data);
    }


}