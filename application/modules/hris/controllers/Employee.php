<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model', 'employees');

    }

	public function index()
	{

		if(!isset($this->session->userdata['logged_in'])){
            redirect('logout', 'refresh');        }

		$data['employee'] = $this->employees->get_all();

		$data['page_title'] = 'Manage Employees';
		$data['userprofile'] = 'welcome/userprofile';
		$data['navigation'] = 'welcome/navigation';
		$data['content'] = 'employee_content';

		$this->load->view('default/index', $data);
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
      $this->data['content'] = 'employee_information';
      $this->data['page_title'] = 'Employee information';
      $this->data['emp'] = $this->employees->get_employee_info($this->input->get('personid'));
      $this->load->view('default/index', $this->data); 
}


}
