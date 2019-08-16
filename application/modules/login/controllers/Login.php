<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Login extends CI_Controller {

	  function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model('User_model','user');
        $this->data['customjs'] = 'login_js/customjs';
    }
	public function index()
	{
		if(isset($this->session->userdata['logged_in'])){
            $route = $this->session->userdata('route');
		    redirect($route, 'refresh');
		}
        $this->load->view('login_main');
	}


	 public function userlogin()
    	//read user from user table
    	//read permissions
    	//set cookies
    	// redirect to appropriate controller
    {
    	if (isset($this->session->userdata['logged_in'])){
            $route = $this->session->userdata('route');
			redirect($route, 'refresh');
		}
        else{
            $data = array(
		        'username' => $this->input->post('username'),
		        'password' => $this->input->post('password')
            );
            $user = $this->user->check_valid_user($data);
            //var_dump($user); die;
            if ($user == TRUE) {
                $session_data = array(
                    'username' => $user[0]->username,
                    'user_id' => $user[0]->user_id,
                    'person_id' =>$user[0]->person_id,
                    'email' => $user[0]->email,
                    'logged_in'=>'yes',
                    'firstname'=>$user[0]->firstname,
                    'lastname'=>$user[0]->lastname,
                    'employee_id'=>$user[0]->employee_id,
                    'department_id'=>$user[0]->department_id,
                    'department_name'=>$user[0]->department_name,                    
                    'route'=>$user[0]->route_name
                );
                $this->session->set_userdata($session_data);
                //get department
                //set page variables

                // set user as logged date
                $this->user->log_user($user[0]->user_id);
                
                // add an entry to logs
                $this->load->model('logs/Logs_model','logs');
                $log_entry = array(
                    'log_date'=>date('Y-m-d H:i:s'),
                    'user_id'=>$user[0]->user_id,
                    'location'=>'Login Module',
                    'object'=>'login',
                    'event_type'=>'login',
                    'description'=>$user[0]->lastname.", ".$user[0]->firstname." logged in to the system"
                );
                $this->logs->log($log_entry);

                //redirect to department default route
                redirect($user[0]->route_name, 'refresh');

            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('login_main',$data);
            }
        }

    }

    public function logout() {

        // add an entry to logs
        $this->load->model('logs/Logs_model','logs');
        $this->load->model('users/Users_model','users');
        $user = $this->users->get_user($this->session->userdata('user_id'));
        $log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Login Module',
            'object'=>'logout',
            'event_type'=>'logout',
            'description'=>$user['lastname'].', '.$user['firstname']." logged out from the system"
        );
        $this->logs->log($log_entry);

		// Removing session data
		$sess_array = array(
		'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';
        //$this->load->view('login_main', $data);

		redirect('login', 'refresh');
	}

}
