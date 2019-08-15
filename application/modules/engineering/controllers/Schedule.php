<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Schedule extends CI_Controller {

	private $data = array();

	  function __construct(){
        // Construct the parent class
        parent::__construct();

        // model init for 'Logs'
        $this->load->model('logs/Logs_model', 'logs');
        // model init for 'Users'
        $this->load->model('users/Users_model','users');
        // main model
        $this->load->model('Schedule_model','sched');

        $this->load->helper(array('form', 'url'));

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['customjs'] = 'engineering/schedjs';
        // $this->data['navigation'] = 'asset/navigation';

    }

 	public function index(){
 		$this->data['content'] = 'material_schedule';
        $this->data['page_title'] = 'Material Schedule';
        // $this->data['dept_code'] = $this->asset->get_dept_model();
        // $this->data['emp'] = $this->asset->get_emp_model();
        // $this->data['assets'] = $this->asset->get_assets_model();
        // $this->data['location'] = $this->asset->get_location_model();

        $this->load->view('default/index', $this->data);
 	}



 }