<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class create_canvass_controller extends CI_Controller {
        function __construct()
    {
        // Construct the parent class
        parent::__construct();  
        $this->load->model('create_canvass_model','request');
        $this->load->helper(array('form', 'url'));
        //$this->data['customjs'] = 'marketing/customjs';
        $this->data['customjs'] = 'logistics/create_canvass_form_custom_js';
        $this->data['navigation'] = 'navigation';
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
       
    }

     public function index()
    {        
        $this->data['content'] = 'create_canvass_form';
        $this->data['page_title'] = 'Quotation Form';        
        $this->load->helper('url');
        $this->load->helper('date');
        $this->data['all_suppliers'] = $this->request->getSupplier();
        $this->data['all_items'] = $this->request->retrieve_all_items(); 
        $this->load->view('default/index', $this->data);        
    }

    
    
    public function save_quotation()
    {   
    $this->load->model('create_canvass_model');
    $data = array(  
        'supplier_name' =>$this->input->post('supplier_name'),      
        'requested_by_id' =>$this->input->post('requested_by_id'),
        'department_id' =>$this->input->post('department_id'),           
        'date_requested' =>date('Y-m-d'),            
        'contact_person' =>$this->input->post('contact_person'),       
        'contact_number' =>$this->input->post('contact_number'),          
        'terms_of_payment' =>$this->input->post('terms_of_payment')
        );

    $id = $this->request->insert_quotation($data);


    foreach ($this->input->post('item_id') as $i => $value)
    {
        $items = array(
            'qoutation_id' => $id,            
            'item_id' => $this->input->post('item')[$i],
            'underline_opt' => $this->input->post('underline_opt')[$i]          
        );
   $this->request->insert_quotation_details($items);   
   } 
}
}