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
		$data['employee'] = $this->employees->get_all();



		$data['page_title'] = 'Manage Employees';
		$data['userprofile'] = 'welcome/userprofile';
		$data['navigation'] = 'welcome/navigation';
		$data['content'] = 'employee_content';

		$this->load->view('default/index', $data);
	}


}
