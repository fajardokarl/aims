<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class prf_list_controller extends CI_Controller{


	  function __construct()
    {
        // Construct the parent class
        parent::__construct();

       $this->load->model('prf_list_model','prf_list');
       //$this->load->model('inbox/inbox_main');
        $this->load->helper(array('form', 'url'));
        $this->data['customjs'] = 'logistics/canvass_list_js';
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['navigation'] = 'navigation';
       
        //$this->data['customjs'] = 'collection/customjs';
        //$this->data['customjs'] = 'logistics/logistics_js';
    }
    
	public function index() {	
        $this->data['content'] = 'prf_list';
        $this->data['page_title'] = 'List of all Regular PRF';        
        $this->load->helper('url');
        $this->load->helper('date');        
        $this->data['prf_list'] = $this->prf_list->retrieve_all_prf();
        // $this->data['all_suppliers'] = $this->item->retrieve_all_suppliers();   
        $this->load->view('default/index', $this->data);  
        // $this->load->model("canvass_model");  

     // $this->load->view('logistics_main');
       
}

public function rush_prf(){
      $this->data['content'] = 'rush_prf';
      $this->data['page_title'] = 'List of all Rush PRF';
  
      $this->data['prf_list'] = $this->prf_list->retrieve_all_rush();
      $this->load->view('default/index', $this->data); 
}


    public function retrieve_all_prf(){
      $this->data['content'] = 'canvasslist';
      $this->data['page_title'] = 'PR Details';
  
      $this->data['prf'] = $this->prf_list->getOnePrf($this->input->get('prf_id'));
      $this->data['details'] = $this->prf_list->get_details_messages($this->input->get('prf_id'));
      $this->load->view('default/index', $this->data); 
}

 public function pdf_prfdetails()
     {
        $id = $this->input->get('id_prf');
        // $this->data['content'] = 'reportpdf_view'; 
        // $this->data['page_title'] = 'PDF';
        // $this->data['prfs'] = $this->message->getOnePrf_details($id);
        // $this->load->view('marketing/reportpdf_view', $this->data); 
        $this->load->library('Pdf');

        $pdf = new Pdf('L', 'in', 'MEMO', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('IRM System Generated PDF');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        ob_clean();
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,0,0), array(0,0,0));
        $pdf->setFooterData(array(0,0,0), array(0,0,0));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        // $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }



        $person_val = $this->prf_list->toPDF($id);
        $person_address_val = $this->prf_list->get_prf_details($id);
        // $person_contract_val = $this->->get_contracts($id);

        $prfid    = $person_val->prf_id;
        $requestedby    = $person_val->firstname . " ". $person_val->middlename ." ". $person_val->lastname;
        $department      = $person_val->department_name;
        $dateneeded        = $person_val->date_needed;
        $daterequested     = $person_val->date_requested;
        $totalamount         = $person_val->total_amount;
        $justification = $person_val->justification;
        $purpose         = $person_val->purpose;
        $project         = $person_val->project_id;
        $project_id          =$person_val->remarks;
        // $font_size = $pdf->pixelsToUnits('5');
        
        

        $pdf->AddPage();
        // $pdf->WriteHTML($htmla, true, 0, true, true);
        $y = $pdf->getY();
        // set color for background
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(10);

        $pdf->writeHTMLCell(40, '', '', $y, '<b>PRF ID: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', $prfid, 0, 0, 0, true, 'L', true);
       
        $pdf->Ln(7);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Requested by: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $requestedby, 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Department: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', $department, 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Date Requested: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', $daterequested, 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Date Needed: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', $dateneeded , 0, 0, 0, true, 'L', true);        
        
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Justification: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $justification, 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Purpose: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $purpose, 0, 0, 0, true, 'L', true);

        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(40, '', '', '', '<b>Project: </b>', 0, 0, 0, true, 'L', true);
        // $pdf->writeHTMLCell(50, '', '', '', $project, 0, 0, 0, true, 'L', true);
        $pdf->Ln(7);
        // $pdf->writeHTMLCell(40, '', '', '', '<b>Project: </b>', 0, 0, 0, true, 'L', true);
        // if ($project_id !== 101) {
        // $pdf->writeHTMLCell(50, '', '', '', $project, 0, 0, 0, true, 'L', true);
        // }else{
        // $pdf->writeHTMLCell(60, '', '', '', 'Deparment Usage', 0, 0, 0, true, 'L', true);
        // }

         
        $pdf->Ln(7);
        $pdf->Ln(10);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Item Requested: </b>', 0, 0, 0, true, 'L', true);
        
       
         $pdf->SetFont ('helvetica', '', 9 , 15, 'default', true );

        $pdf->Ln(8);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);
        $pdf->Ln(5);
        $pdf->writeHTMLCell(30, '', 15, '', '<b>Description</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', 65, '', '<b>QTY </b>', 0, 0, 0, true, 'L', true);        
        $pdf->writeHTMLCell(25, '', 75, '', '<b>Amount</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 95, '', '<b>Total</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(20, '', 125, '', '<b>Remark</b>', 0, 0, 0, true, 'R', true);
        $pdf->Ln(1);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);


        $add_ref = 0;
        foreach ($person_address_val as $key => $value) {
            $pdf->Ln(7);
            $address_val = 

            $pdf->writeHTMLCell(60, '', 15, '', $value['description'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(45, '', 65, '', $value['qty']. " ".$value['uom_code'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(50, '', 85, '', number_format($value['amount']), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(50, '', 110, '', number_format($value['sub_total']), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(50, '', 130, '', $value['remarks'], 0, 0, 0, true, 'L', true);            
          


            // if ($value['province_name'] !== null && $value['province_name'] !== null) {
            //     $pdf->writeHTMLCell(200, '', 20, '', $address_val, 0, 0, 0, true, 'L', true);
            // }else{
            //     $pdf->writeHTMLCell(200, '', 20, '', 'No Data to Display', 0, 0, 0, true, 'L', true);
            // // }
            $add_ref = $value['prf_detail_id'];

            // if ($value['province_name'] !== null && $value['province_name'] !== null) {
            //     $pdf->writeHTMLCell(200, '', 20, '', $address_val, 0, 0, 0, true, 'L', true);
            // }else{
            //     $pdf->writeHTMLCell(200, '', 20, '', 'No Data to Display', 0, 0, 0, true, 'L', true);
            // }
            // $add_ref = $value['address_id'];
            
        }

        $pdf->Ln(7);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Total Amount: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', number_format($totalamount,2), 0, 0, 0, true, 'L', true);  
      
        $pdf->Output('Customer_info.pdf', 'I'); 
    }



}
