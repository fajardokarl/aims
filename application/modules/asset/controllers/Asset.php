<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Asset extends CI_Controller {

	private $data = array();

	  function __construct(){
        // Construct the parent class
        parent::__construct();

        // model init for 'Logs'
        $this->load->model('logs/Logs_model', 'logs');
        // model init for 'Users'
        $this->load->model('users/Users_model','users');
        // main model
        $this->load->model('Assets_model','asset');

        $this->load->helper(array('form', 'url'));

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['customjs'] = 'asset/assetjs';
        // $this->data['navigation'] = 'asset/navigation';

    }

 	public function index(){
 		$this->data['content'] = 'asset_barcode';
        $this->data['page_title'] = 'Asset Inputs';
        $this->data['dept_code'] = $this->asset->get_dept_model();
        $this->data['emp'] = $this->asset->get_emp_model();
        $this->data['assets'] = $this->asset->get_assets_model();
        $this->data['location'] = $this->asset->get_location_model();

        $this->load->view('default/index', $this->data);
 	}

    public function get_assets(){
        echo json_encode($this->asset->get_assets_model());

    }

    public function insert_assetbarcode(){
        $this->load->helper('date');
        $asset_no = ($this->asset->get_assetno($this->input->post('department_id')) + 1);
        $a = sprintf('%02d', $asset_no);
        $asset_num = $this->input->post('dep_code') . '_' . $a;
        $year = date('Y');

        $asset = array(
            'serial_number' => $this->input->post('serial_number'),
            'asset_description' => $this->input->post('asset_description'),
            'employee_id' => $this->input->post('employee_id'),
            'department_id' => $this->input->post('department_id'),
            'asset_location_id' => $this->input->post('location'),
            'asset_number' => $asset_num,
            'date_counted' => date('Y-m-d'),
            'tag_number' => '0'
        );

        $asst = $this->asset->insert_assetbarcode_model($asset);

        $num = sprintf('%04d', $asst);
        $data = array(
            'tag_number' => ($year . '_' . $num),
        );
        $tagno = $this->asset->update_tagno_model($data, $asst);

        $user = $this->users->get_user($this->session->userdata('user_id'));
        $log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Asset Module',
            'object'=>'asset',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " inserted new asset barcode ID " . $asst
        );

        echo json_encode($asst);
    }

    public function change_status(){
        $id = $this->input->post('id');
        $data = $this->input->post('stat_val');

        $user = $this->users->get_user($this->session->userdata('user_id'));
        $log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Asset Module',
            'object'=>'asset',
            'event_type'=>'update',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " change status of asset barcode ID " . $id
        );

        $this->logs->log($log_entry);
        echo json_encode($this->asset->change_status_model($id, array('is_damaged' => $data)));

    }

 }