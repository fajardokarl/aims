<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class canvass_list_controller extends CI_Controller{


	  function __construct()
    {
        // Construct the parent class
        parent::__construct();

       $this->load->model('canvass_list_model','canvass_list');
       //$this->load->model('inbox/inbox_main');
        $this->load->helper(array('form', 'url'));
        $this->data['customjs'] = 'logistics/canvassJs';
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['navigation'] = 'navigation';
       
        //$this->data['customjs'] = 'collection/customjs';
        //$this->data['customjs'] = 'logistics/logistics_js';
    }

	public function index() {	
        $this->data['content'] = 'canvass_list_view';
        $this->data['page_title'] = 'List of all PRF';        
        $this->load->helper('url');
        $this->load->helper('date');        
        $this->data['canvass'] = $this->canvass_list->retrieve_all_canvasses();
        // $this->data['all_suppliers'] = $this->item->retrieve_all_suppliers();   
        $this->load->view('default/index', $this->data);  
        // $this->load->model("canvass_model");  

     // $this->load->view('logistics_main');
       
}

    public function canvassdetails(){
      $this->data['content'] = 'canvassdetails';
      $this->data['page_title'] = 'PRF Details';
      // $this->data['amort'] = $this->message->get_amortization($this->input->get('contractid'));
      $this->data['canvass_details'] = $this->canvass_list->get_canvass_detaileds($this->input->get('canvassid'));
      $this->data['canvass'] = $this->canvass_list->getOneCanvass($this->input->get('canvassid'));
      // $this->data['payment'] = $this->message->paid_amortization_model($this->input->get('contractid'));
      // $this->data['cont_stat_val'] = $this->message->contract_status_model();
      $this->load->view('default/index', $this->data); 
}
public function pdf_canvassdetails()
     {
         $this->data['key'] = $this->canvass_list->get_canvassed_details($this->input->get('canvass_id'));
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



        $person_val = $this->canvass_list->toPDF($id);
        $person_address_val = $this->canvass_list->get_canvassed_details($id);
        // $person_contract_val = $this->->get_contracts($id);

    
        $canvass_id    = $person_val->canvass_id;
        $canvassed_by    = $person_val->firstname . " ". $person_val->middlename ." ". $person_val->lastname;      
        $canvassed_date        = $person_val->canvassed_date;
        $remarks     = $person_val->remarks;
        // $totalamount         = $person_val->total_amount;
        // $justification = $person_val->justification;
        // $purpose         = $person_val->purpose;
        // $project         = $person_val->project_description;
        // $project_id          =$person_val->project_id;
        // $font_size = $pdf->pixelsToUnits('5');
        

        //This is how you set as Landscape or portrait your page
        $pdf->AddPage('L');
        // $pdf->WriteHTML($htmla, true, 0, true, true);
        $y = $pdf->getY();
        // set color for background
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(10);

        $pdf->writeHTMLCell(40, '', '', $y, '<b>Canvass ID: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', $canvass_id, 0, 0, 0, true, 'L', true);

       
        $pdf->Ln(7);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Canvassed by: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(80, '', '', '', $canvassed_by, 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Date Canvassed: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', $canvassed_date, 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Remarks: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', $remarks, 0, 0, 0, true, 'L', true);
        
        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(40, '', '', '', '<b>Date Needed: </b>', 0, 0, 0, true, 'L', true);
        // $pdf->writeHTMLCell(30, '', '', '', $canvass_date , 0, 0, 0, true, 'L', true);        
        
        
        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(40, '', '', '', '<b>Justification: </b>', 0, 0, 0, true, 'L', true);
        // $pdf->writeHTMLCell(50, '', '', '', $justification, 0, 0, 0, true, 'L', true);
        
        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(40, '', '', '', '<b>Purpose: </b>', 0, 0, 0, true, 'L', true);
        // $pdf->writeHTMLCell(50, '', '', '', $purpose, 0, 0, 0, true, 'L', true);

        // // $pdf->Ln(7);
        // // $pdf->writeHTMLCell(40, '', '', '', '<b>Project: </b>', 0, 0, 0, true, 'L', true);
        // // $pdf->writeHTMLCell(50, '', '', '', $project, 0, 0, 0, true, 'L', true);
        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(40, '', '', '', '<b>Project: </b>', 0, 0, 0, true, 'L', true);
        // if ($project_id !== 101) {
        // $pdf->writeHTMLCell(50, '', '', '', $project, 0, 0, 0, true, 'L', true);
        // }else{
        // $pdf->writeHTMLCell(60, '', '', '', 'Deparment Usage', 0, 0, 0, true, 'L', true);
        // }

         
        $pdf->Ln(7);
        $pdf->Ln(10);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Item Canvassed: </b>', 0, 0, 0, true, 'L', true);
        
       
         $pdf->SetFont ('helvetica', '', 9 , 15, 'default', true );

        $pdf->Ln(8);
        $pdf->writeHTMLCell(300, '', '', '', '_____________________________________________________________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);
        $pdf->Ln(5);
        $pdf->writeHTMLCell(30, '', 15, '', '<b>Supplier</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', 55, '', '<b>Contact person </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', 85, '', '<b>Contact no.</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(35, '', 115, '', '<b>Item Description</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 150, '', '<b>QTY</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(35, '', 165, '', '<b>Unit Price</b>', 0, 0, 0, true, 'R', true);        
        $pdf->writeHTMLCell(50, '', 210, '', '<b>Offer Price</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', 240, '', '<b>Terms of payment</b>', 0, 0, 0, true, 'L', true);
        $pdf->Ln(1);
        $pdf->writeHTMLCell(300, '', '', '', '_____________________________________________________________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);


        $add_ref = 0;
        foreach ($person_address_val as $key => $value) {
            $pdf->Ln(7);
            $address_val = 

            $pdf->writeHTMLCell(40, '', 15, '', $value['supplier_name'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(45, '', 55, '', $value['contact_person'], 0, 0, 0, true, 'L', true);
            // $pdf->writeHTMLCell(45, '', 65, '', $value['uom_code'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(45, '', 90, '', $value['contact_number'], 0, 0, 0, true, 'L', true);


            $pdf->writeHTMLCell(50, '', 121, '',$value['description'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(50, '', 166, '', $value['qty']." ". $value['uom_code'], 0, 0, 0, true, 'L', true);

            $pdf->writeHTMLCell(50, '', 181, '',$value['unit_price'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(50, '', 210, '', $value['offer_price'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(50, '', 240, '', $value['terms_of_payment'], 0, 0, 0, true, 'L', true);
       


            // if ($value['province_name'] !== null && $value['province_name'] !== null) {
            //     $pdf->writeHTMLCell(200, '', 20, '', $address_val, 0, 0, 0, true, 'L', true);
            // }else{
            //     $pdf->writeHTMLCell(200, '', 20, '', 'No Data to Display', 0, 0, 0, true, 'L', true);
            // // }
            $add_ref = $value['canvass_item_id'];

            // if ($value['province_name'] !== null && $value['province_name'] !== null) {
            //     $pdf->writeHTMLCell(200, '', 20, '', $address_val, 0, 0, 0, true, 'L', true);
            // }else{
            //     $pdf->writeHTMLCell(200, '', 20, '', 'No Data to Display', 0, 0, 0, true, 'L', true);
            // }
            // $add_ref = $value['address_id'];
            
        }

        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(40, '', '', '', '<b>Total Amount: </b>', 0, 0, 0, true, 'L', true);
        // $pdf->writeHTMLCell(50, '', '', '', number_format($totalamount,2), 0, 0, 0, true, 'L', true);  
      
        $pdf->Output('Customer_info.pdf', 'I'); 
    }



function inbox(){
    //$this->data['content'] = 'inbox_main';

    $this->load->view('default/index', $this->data);
}

}


