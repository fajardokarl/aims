<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class report_controller extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('report_model', 'report');		
		$this->load->helper(array('form', 'url'));
		$this->data['navigation'] = 'logistics/navigation';
		$this->data['customjs'] = 'reportJS';
	}

	public function index(){
		$this->data['content'] = 'summary_report';
		$this->data['page_title'] = 'Summary of purchases';
		$this->load->helper('url');
		$this->load->helper('date');				
		$this->load->view('default/index', $this->data);
	}

   public function generateSalesReport()
    {
    	$fromDate = $this->input->post('fromDate');
    	$toDate = $this->input->post('toDate');
    	$datareturn = $this->report->getSalesReportByDate($fromDate,$toDate);
    	echo json_encode($datareturn);
    }


public function poDetailsReport(){
		$this->data['content'] = 'po_report';
		$this->data['page_title'] = 'Purchase Orders Report';      
        $this->data['PO_details'] = $this->report->retrieve_po_report_details();

        $this->load->view('default/index', $this->data); 

	}
  

}//end class