<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Users extends CI_Controller {

    private $data = array();

    function __construct()
    {        
        // Construct the parent class
        parent::__construct();
        $this->load->model('Route_model','route');
        $this->load->model('User_model','user');
        $this->load->helper(array('form', 'url'));
        //$this->load->model('Route_model','route');

        //$this->data['navigation'] = 'marketing/navigation';
        $this->data['customjs'] = 'marketing/customjs';
    }
    public function index()
    {
        //admins only page

        $this->data['content'] = 'user_masterlist';
        $this->data['page_title'] = 'User Management';
        // $this->data['all_employees'] = $this->user->retrieve_all_employee();
        // $this->data['all_dept'] = $this->user->retrieve_all_department();


        if(isset($this->session->userdata['logged_in'])){
            // get all users
            // get all routes
            // get all permissions
            // get all roles

            // get user permissions

            $this->data['users'] = $this->user->get_users();
            //$this->data['routes'] = $this->route->get_routes();
            //$this->data['permissions'] = $this->permission->get_permissions();
            //$this->data['roles'] = $this->role->get_roles();
        }

        $this->load->view('default/index', $this->data);         
    }
    
    public function registration()
    {     
    
    // experimentation
        $this->data['content'] = 'add_user';
        $this->data['page_title'] = 'Add New User';
        if(isset($this->session->userdata['logged_in'])){}
        $this->load->model('Route_model','route_model', TRUE);
        $this->load->library('form_validation');
        // $this->form_validation->set_rules("all_employees", "Name", 'required');
        // $this->form_validation->set_rules("all_dept", "Department", 'required');
        $this->form_validation->set_rules("username", "Username", 'required');
        $this->form_validation->set_rules("password", "password", 'required');
        $this->form_validation->set_rules("email", "Email add", 'required');    
        // $this->form_validation->set_rules("status_id", "Status ID", 'required');
        $this->load->helper('url');
        $this->load->helper('date');
        $this->data['all_employees'] = $this->user->retrieve_all_employee();
        $this->data['all_dept'] = $this->user->retrieve_all_department();
        $this->data['all_permission'] = $this->user->retrieve_all_permission();
    if ($this->form_validation->run())
    {
    $this->load->model("User_model");  

    $data = array(
            //database-------------unique identifier
            "username"   =>$this->input->post('username'),
            "password"   =>$this->input->post('password'),
            "status_id"   =>$this->input->post('status_id'),
            "email"   =>$this->input->post('email'),
            "created_by"    =>$this->input->post('created_by'),

            //$this->db->where('person_id', $this->input->post('employee_id'));
            "person_id" =>$this->input->post('employee_id'),
            "created"   =>date('Y-m-d'),                    
            "status_id"    =>$this->input->post('status_id')      
        );      
        
        $id = $this->User_model->insert_user($data); 
        $this->User_model->log_user($id);

    $data2 = array(
            "employee_id"   =>$this->input->post('employee_id'),
            "from_date"   =>date('Y-m-d'),
            "department_id"   => $this->input->post('department_id')
        );    
        $this->User_model->insert_dept($data2);

    $data3 = array(
             "status_id"   =>$this->input->post('status_id'),
             "created_by"    =>$this->input->post('created_by'),
             "user_id"    =>$this->input->post('employee_id'),
             "route_id"    =>$this->input->post('department_id'),
             "created"   =>date('Y-m-d'),
             "permission_id"   =>$this->input->post('all_permission')
        );
        $this->User_model->insert_urrp($data3);


    $data4 = array(
             "status_id"   =>$this->input->post('status_id'),
             "created_by"    =>$this->input->post('created_by'),
             "user_id"    =>$this->input->post('employee_id'),
             "route_id"    =>$this->input->post('department_id'),
             "created"   =>date('Y-m-d'),
             "permission_id"   =>$this->input->post('all_permission')
        );
        $this->User_model->insert_urp($data4);

        redirect(base_url() . "login/users/inserted"); 
        }
        $this->load->view('default/index', $this->data);
        }       
public function inserted()
         {        
            echo "<script>alert('Message sent!');
                  </script>";
             $this->index();
         } 



}     
 

   