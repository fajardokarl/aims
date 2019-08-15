<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Warehouse extends CI_Controller{


	  function __construct() {
        // Construct the parent class
        parent::__construct();

        $this->load->model('getItem_model','item');
        $this->load->model('report_model','report');
        $this->load->model('materialsrequest_model', 'mr');
        //$this->load->model('inbox/inbox_main');
        $this->load->helper(array('form', 'url'));
        $this->data['customjs'] = 'logistics/formCustomJs';
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['navigation'] = 'navigation';
        //$this->data['customjs'] = 'collection/customjs';
        $this->data['customjs'] = 'warehouse/warehouse_js';
        $this->data['items'] = $this->item->get_items();
    }

	public function index() {	
    	$this->data['content'] = 'warehouse_main';
        $this->data['page_title'] = 'Warehouse';
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
        $this->data['page_title'] = 'Masterlist';
        $this->data['items'] = $this->item->get_items();
        $this->data['warehouse'] = $this->item->get_warehouses();
        $this->data['customjs'] = 'warehouse/item_inventoryjs';
        $this->load->view('default/index', $this->data);
            
    }

    public function insert_items(){
        $this->data['content'] = 'insert_items';
        $this->data['page_title'] = 'Items Input';
        $this->data['customjs'] = 'warehouse_temp/itemsjs';
        $this->data['cat'] = $this->item->get_allcategories_model();
        $this->data['cat_sort'] = $this->item->get_allcategories_model();
        $this->data['uom'] = $this->item->get_alluom_model();
        $this->data['warehouse'] = $this->item->get_warehouse_model();

        $this->load->view('default/index', $this->data);
    }



    function item_inventory(){
        $this->data['content'] = 'item_inventory';
        $this->data['page_title'] = 'Inventory';
        $this->data['items'] = $this->item->get_items();
        $this->data['warehouse'] = $this->item->get_warehouses();
        $this->data['customjs'] = 'warehouse/item_inventoryjs'; 
        $this->load->view('default/index', $this->data);
    }

    function approved_reports(){
        $this->data['content'] = 'approved_reports';
        $this->data['page_title'] = 'Approved Reports';
        $this->data['items'] = $this->item->get_items();
        $this->data['warehouse'] = $this->item->get_warehouses();
        $this->data['PO_details'] = $this->report->retrieve_po_report_details();
        $this->data['pos'] = $this->report->get_allpo_model();
        $this->data['MR_details'] = $this->mr->getMaterialsRequisitionConfirmed();
        $this->data['customjs'] = 'warehouse/item_inventoryjs';
        $this->load->view('default/index', $this->data);
            
    }

    function cancelled_reports(){

        $this->data['content'] = 'cancelled_reports';
        $this->data['page_title'] = 'Cancelled Reports';
        $this->data['items'] = $this->item->get_items();
        $this->data['warehouse'] = $this->item->get_warehouses();
        $this->data['PO_details'] = $this->report->retrieve_po_report_details();
        $this->data['pos'] = $this->report->get_allpo_model();
        $this->data['MR_details'] = $this->mr->getMaterialsRequisitionCancelled();
        $this->data['customjs'] = 'warehouse/item_inventoryjs';
        $this->load->view('default/index', $this->data);
            
    }



    function inbox(){
        //$this->data['content'] = 'inbox_main';

        $this->load->view('default/index', $this->data);
    }

    public function get_issuance(){
        echo json_encode($this->whouse->get_issuance_model($this->input->post('issuance_id')));
    }

    public function generateSalesReport()
    {
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $datareturn = $this->report->getSalesReportByDate($fromDate,$toDate);
        echo json_encode($datareturn);
    }

}
