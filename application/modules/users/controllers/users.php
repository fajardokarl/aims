<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Users extends CI_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->model('Users_model','users');
        //$this->load->library('Mailbox');

        $this->data['customjs'] = 'users/js/userscustomjs';
        $this->data['customcss'] = 'users/css/customcss';
        // $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        // $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        // $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key

    }

    public function index()
    {

        $this->data['content'] = 'users_list';
        $this->data['page_title'] = 'Users';

        $this->data['users'] = $this->users->get_users();
        $this->data['nouser'] = $this->session->flashdata('nouser');
        //echo $this->data['nouser'];

        $this->load->view('default/index', $this->data);
    }

    public function edit()
    {
        $this->load->library('user_agent');
        $referrer = $this->agent->referrer();
        $user_id = $this->uri->segment(3)?:'';

        if(!$user_id)
        {
            if (!$referrer)
            {
                $this->session->set_flashdata('nouser', 1);
                redirect(base_url('users'));
            }
            redirect($referrer);
        }
        
        $this->data['user'] = $this->users->get_user($user_id);
        $this->data['content'] = 'user_edit';
        $this->data['page_title'] = 'User Management';

        $this->load->view('default/index', $this->data);
    }

    public function edit_submit()
    {
        $user_id = (int) $this->input->post('user_id')?:0;
        $username = $this->input->post('username')?:'';
        $password = $this->input->post('password')?:'';
        $email = $this->input->post('email')?:'';
        $verified = $this->input->post('verified')?:0;
        $status_id = (int) $this->input->post('status_id')?:0;
        $user = array(
            'user_id' => $user_id,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'verified' => $verified,
            'status_id' => $status_id
        );
        echo json_encode($this->users->update_user($user,$user_id));
    }

    public function news()
    {
        $this->load->model('hris/Employee_model','employees');
        //$employees = $this->employees->get_all();
        $this->data['content'] = 'user_new';
        $this->data['page_title'] = 'User Management';

        $this->load->view('default/index', $this->data);
    }

    public function ajax_get_employees()
    {
        $this->load->model('hris/Employee_model','employees');
        echo json_encode($this->employees->get_employees());
    }

}