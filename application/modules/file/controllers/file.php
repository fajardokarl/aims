<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class file extends CI_Controller{

	  function __construct()
    {
        // Construct the parent class
        parent::__construct();

       $this->load->model('file_model','file');
       //$this->load->model('inbox/inbox_main');
        $this->load->helper(array('form', 'url'));

        $this->load->model('logs/Logs_model', 'logs');
        // model init for 'Users'
        $this->load->model('users/Users_model','users');
        $this->data['navigation'] = 'file_dashboard';
        $this->data['customjs'] = 'file/file_js';
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        // $this->data['verifies'] = $this->message->get_verifies();
        // $this->data['prf_details'] = $this->message->get_details_messages($this->input->get('messageid'));
        // $this->data['details'] = $this->message->get_message($this->input->get('messageid'));
        // $this->data['key'] = $this->message->get_details($this->input->get('messageid'));
    }

	public function index() {
	$this->data['content'] = 'travel_form';
    $this->data['page_title'] = 'Travel Form';
    $this->data['all_destination'] = $this->file->get_destination();
    $this->load->view('default/index', $this->data);
         // $this->load->view('logistics_main');       
    } 


    public function request_to(){
        $this->load->helper('date'); 
        $this->load->model('file_model');

        // Employee information
    $data = array(        
                'requested_by_id' =>$this->input->post('created_by'),
                'department_id' =>$this->input->post('department'),
                'date_requested' =>date('Y-m-d'),
                'date_from' =>$this->input->post('datefrom'),               
                'date_to' =>$this->input->post('dateTo'),                
                'destination' =>$this->input->post('destination'),                
                'EDT' =>$this->input->post('etd'),                
                'ETA' =>$this->input->post('eta'),                
                'purpose' =>$this->input->post('purpose'),                
                'through' =>$this->input->post('through')                   
                 );
        $this->file_model->insert_to($data);
        }

public function retrieve_transport(){
    echo json_encode($this->file->destination_transport($this->input->post('destination_type')));
}


public function sent_request_to(){
      $this->data['content'] = 'sentTO';
      $this->data['page_title'] = 'Sent requested TO';          
      $this->data['retrieve'] = $this->file->getMyTO($this->session->userdata('user_id'));
      $this->load->view('default/index', $this->data); 
    }


public function retrieve_TO_detailsf(){
      $this->data['content'] = 'TO_detail';
      $this->data['page_title'] = 'Travel Order Details';  
      $this->data['TO'] = $this->file->getOnePrf($this->input->get('TO_id'));    
      $this->load->view('default/index', $this->data); 
}
public function prf_request(){
      $this->data['content'] = 'edit_TO';
      $this->data['page_title'] = 'PRF Details';   
      $this->data['details_request'] = $this->file->get_request_head($this->input->get('messageid'));     
      $this->load->view('default/index', $this->data); 
}


public function update_TO(){
    $to_id = $this->input->post('to_id');
    $data = array(
        'is_cancel' => $this->input->post('is_cancel'),
        'date_from' => $this->input->post('datefrom'),
        'date_to' => $this->input->post('dateTo'),
        'purpose' =>$this->input->post('purpose'),                  
        'EDT' => $this->input->post('etd'),  
        'ETA' => $this->input->post('eta')
        );
    $this->file->update_TO_detail($to_id, $data); 
    

    $user = $this->users->get_user($this->session->userdata('user_id'));
    $log_entry = array(
        'log_date'=>date('Y-m-d H:i:s'),
        'user_id'=>$user['user_id'],
        'location'=>'File Module',
        'object'=>'travel order',
        'event_type'=>'update',
        'description'=>$user['lastname'] . ", " . $user['firstname'] . " updated Travel Order " . $to_id
    );
    $this->logs->log($log_entry);

    echo json_encode($data);
}


public function get_one_to(){
        $to_id = $this->input->post('to_id');
        $to_id = $this->file->get_to_detail($to_id);
        echo json_encode($to_id);
    }

public function create_ca(){
      $this->data['content'] = 'CA_form';
      $this->data['page_title'] = 'Create Cash advance for Hotel and meal allowance';          
      $this->data['retrieve'] = $this->file->getMyTO($this->session->userdata('user_id'));
      $this->load->view('default/index', $this->data); 
    }

}