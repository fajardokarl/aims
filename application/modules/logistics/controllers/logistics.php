<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Logistics extends CI_Controller{


	  function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model('logistic_dashboard','dashboards');
        $this->load->model('getItem_model','item');
       //$this->load->model('inbox/inbox_main');
        $this->load->helper(array('form', 'url'));
        $this->data['customjs'] = 'logistics/formCustomJs';
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['navigation'] = 'navigation';
        //$this->data['customjs'] = 'collection/customjs';
        $this->data['customjs'] = 'logistics/logistics_js';
        $this->data['items'] = $this->item->get_items();
    }

	public function index() {	
	$this->data['content'] = 'logistics_main';
    $this->data['page_title'] = 'Logistics';
    $this->data['prf_count'] = $this->dashboards->prf_count();
    $this->data['ppr_count'] = $this->dashboards->ppr_count();
    $this->data['po_count'] = $this->dashboards->po_count();    
    $this->data['all_prf_count'] = $this->dashboards->all_prf_count(); 
    $this->data['po_list'] = $this->dashboards->retrieve_po();        
    //$this->data['customjs'] = 'dashboardjs';
    $this->data['prf_list'] = $this->item->retrieve_all_prf();
    $this->load->view('default/index', $this->data);
     // $this->load->view('logistics_main');
       
}

function add_item(){
     $this->data['content'] = 'add_item';
     $this->data['page_title'] = 'Add New Item';
     $this->load->view('default/index', $this->data);
     $this->load->model("getItem_model");  

    $data = array(
            //database-------------unique identifier
            "description"   =>$this->input->post('description'),
            "category_code"   =>$this->input->post('category_code'),
            "legacy_itemid"   =>$this->input->post('legacy_itemid'),                       
            "status_id"    =>$this->input->post('status_id')      
        );      
        
        $this->getItem_model->insert_item($data); 
	
}

function view_item(){

     $this->data['content'] = 'view_item';
     $this->data['page_title'] = 'Logistics Items';
     $this->load->view('default/index', $this->data);
     $this->data['items'] = $this->item->get_items();   
}


function inbox(){
    //$this->data['content'] = 'inbox_main';

    $this->load->view('default/index', $this->data);
}

}