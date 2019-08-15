<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class capex_list_controller extends CI_Controller{


	  function __construct()
    {
        // Construct the parent class
        parent::__construct();

       $this->load->model('capex_list_model','capex_list');
       //$this->load->model('inbox/inbox_main');
        $this->load->helper(array('form', 'url'));
        $this->data['customjs'] = 'logistics/canvass_list_js';
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['navigation'] = 'navigation';      

    }

	public function index() {	
        $this->data['content'] = 'capex_list';
        $this->data['page_title'] = 'List of all CAPEX';        
        $this->load->helper('url');
        $this->load->helper('date');        
        $this->data['capex_list'] = $this->capex_list->retrieve_all_capex();
        $this->data['capex_aquisition_list'] = $this->capex_list->retrieve_all_acquisition();        
        $this->load->view('default/index', $this->data);        
}

    public function retrieve_all_capex_project_details(){
      $this->data['content'] = 'capexlist_aquisition';
      $this->data['page_title'] = 'CAPEX Details';      

      $this->data['acquisition_capex'] = $this->capex_list->capex_acquisition_details($this->input->get('capex_repair'));
      $this->data['capex_acquisition_details'] = $this->capex_list->get_capex_project_details($this->input->get('capex_repair'));

      // This 'capexid' is the last var of  window.open(baseurl+"Logistics/capex_list_controller/retrieve_all_capex_details?capexid=" + capex_id);

      //This is to retrieve database into capexlist 
      
      $this->load->view('default/index', $this->data); 
    }

    public function retrieve_all_capex_details(){
      $this->data['content'] = 'capexlist_repair';
      $this->data['page_title'] = 'CAPEX Details';
   

      $this->data['capex'] = $this->capex_list->capex_details($this->input->get('capexid'));
      $this->data['capex_details'] = $this->capex_list->get_capex_details($this->input->get('capexid'));      
     
      // This 'capexid' is the last var of  window.open(baseurl+"Logistics/capex_list_controller/retrieve_all_capex_details?capexid=" + capex_id);

      //This is to retrieve database into capexlist  
     
      $this->load->view('default/index', $this->data); 
}
   
 public function pdf_capexlist()
     {
        //('capexid') is taken from your JS baseurl (window.open(baseurl+"Logistics/capex_list_controller/pdf_capexlist?capexid="+capex_id);)
        
        $id = $this->input->get('capexid');     
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



        $person_val = $this->capex_list->toCapexPDF($id);
        $person_address_val = $this->capex_list->get_pdf_capex_details($id);
        // $person_contract_val = $this->->get_contracts($id);

        $capexid    = $person_val->capex_id;
        $requestedby    = $person_val->firstname . " ". $person_val->middlename ." ". $person_val->lastname;
        $department      = $person_val->department_name;
        $daterequested        = $person_val->capex_date;
        $itemDescription     = $person_val->description;    
        $descriptionOfProject        = $person_val->capex_purpose;
        $is_budgeted         = $person_val->classification_name;
        $project_id          =$person_val->remarks;
        // $font_size = $pdf->pixelsToUnits('5');
        $capexType    = $person_val->capex_type;
        $itemid    = $person_val->description;
        $custodian    = $person_val->firstname . " ". $person_val->middlename ." ". $person_val->lastname;
        $location      = $person_val->location;
        $dateacquired        = $person_val->date_acquired;
        $netbookvalue     = $person_val->net_book_value;    
        $reasonforreplacement        = $person_val->reason_for_replacement;
        $advantageovernew         = $person_val->advantage_over_new;

        $equipmentcost    = $person_val->equipment_cost;
        $laborcost    = $person_val->labor_cost;
        $freightcost      = $person_val->freight_cost;
        $incidentalexpenses        = $person_val->incidental_expenses;
        $estimatedcost     = $person_val->estimated_cost;    
        $lesstradein        = $person_val->less_trade_in;
        $netestematedcost         = $person_val->net_estimated_cost;
        $remark        =$person_val->remarks;
        

        $pdf->AddPage();
        // $pdf->WriteHTML($htmla, true, 0, true, true);
        $y = $pdf->getY();
        // set color for background
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(10);
    
        $pdf->writeHTMLCell(100, '', '', $y, '<b>Date Requested: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $daterequested, 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>CAPEX ID: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $capexid, 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>CAPEX Type: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $capexType, 0, 0, 0, true, 'L', true);


        $pdf->Ln(7);        
        $pdf->writeHTMLCell(100, '', '', '', '<b>Requested by: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', $requestedby, 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Department: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', $department, 0, 0, 0, true, 'L', true);     
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Item/Project Description: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $itemDescription , 0, 0, 0, true, 'L', true);     
                
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Purpose: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $descriptionOfProject, 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Project/Item Classification: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $is_budgeted, 0, 0, 0, true, 'L', true);
     
        $pdf->Ln(7);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________', 0, 0, 0, true, 'L', true);
        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(100, '', '', '', '<b>Item Replaced: </b>', 0, 0, 0, true, 'L', true);
        // // $pdf->writeHTMLCell(100, '', '', '', $itemid, 0, 0, 0, true, 'L', true);

        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(100, '', '', '', '<b>Custodian: </b>', 0, 0, 0, true, 'L', true);
        // // $pdf->writeHTMLCell(100, '', '', '', $custodian, 0, 0, 0, true, 'L', true);

        // $pdf->Ln(7);        
        // $pdf->writeHTMLCell(100, '', '', '', '<b>Location: </b>', 0, 0, 0, true, 'L', true);
        // // $pdf->writeHTMLCell(95, '', '', '', $location, 0, 0, 0, true, 'L', true);

        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(100, '', '', '', '<b>Date Acquired: </b>', 0, 0, 0, true, 'L', true);
        // // $pdf->writeHTMLCell(95, '', '', '', $dateacquired, 0, 0, 0, true, 'L', true);     
        
        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(100, '', '', '', '<b>Net Book Value: </b>', 0, 0, 0, true, 'L', true);
        // // $pdf->writeHTMLCell(100, '', '', '', $netbookvalue , 0, 0, 0, true, 'L', true);     
                
        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(100, '', '', '', '<b>Reason for replacement: </b>', 0, 0, 0, true, 'L', true);
        // // $pdf->writeHTMLCell(100, '', '', '', $reasonforreplacement, 0, 0, 0, true, 'L', true);
        
        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(100, '', '', '', '<b>Advantage over purchase, lease or trade in: </b>', 0, 0, 0, true, 'L', true);
        // // $pdf->writeHTMLCell(90, '', '', '', $advantageovernew, 0, 0, 0, true, 'L', true);


        $pdf->Ln(7);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________', 0, 0, 0, true, 'L', true);


        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>REPLACEMENT/CAPITALIZATION REPAIRS </b>', 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Item Replaced: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $itemid, 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Custodian: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $custodian, 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);        
        $pdf->writeHTMLCell(100, '', '', '', '<b>Location: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', $location, 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Date Acquired: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', $dateacquired, 0, 0, 0, true, 'L', true);     
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Net Book Value: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $netbookvalue , 0, 0, 0, true, 'L', true);     
                
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Reason for replacement: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $reasonforreplacement, 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Advantage over purchase, lease or trade in: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', $advantageovernew, 0, 0, 0, true, 'L', true);

        
        $pdf->writeHTMLCell(100, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->Ln(7);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________', 0, 0, 0, true, 'L', true);
        $pdf->Ln(7);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________', 0, 0, 0, true, 'L', true);
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>SUMMARY OF ESTIMATED PROJECT COST </b>', 0, 0, 0, true, 'L', true);


                        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Equipment/Material/Supplies: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', "P ".number_format($equipmentcost,2), 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Labor: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '',"P ".number_format($laborcost,2), 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);        
        $pdf->writeHTMLCell(100, '', '', '', '<b>Frieght and Handling: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', "P ".number_format($freightcost,2), 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Other Incidental cost: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', "P ".number_format($incidentalexpenses,2), 0, 0, 0, true, 'L', true);        
                        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Total Estimated Project Cost: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', "P ".number_format($estimatedcost,2), 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Less: Trade-in: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', "P ".number_format($lesstradein,2) , 0, 0, 0, true, 'L', true); 

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Net Estimated Project Cost: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', "P ".number_format($netestematedcost,2) , 0, 0, 0, true, 'L', true); 

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Remark: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $remark, 0, 0, 0, true, 'L', true);       
        
        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(40, '', '', '', '<b>Project: </b>', 0, 0, 0, true, 'L', true);
        // $pdf->writeHTMLCell(50, '', '', '', $project, 0, 0, 0, true, 'L', true);
        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(40, '', '', '', '<b>Project: </b>', 0, 0, 0, true, 'L', true);
        // if ($project_id !== 101) {
        // $pdf->writeHTMLCell(50, '', '', '', $project, 0, 0, 0, true, 'L', true);
        // }else{
        // $pdf->writeHTMLCell(60, '', '', '', 'Deparment Usage', 0, 0, 0, true, 'L', true);
        // }         
     
        $pdf->Output('Customer_info.pdf', 'I'); 
    }



    public function pdf_capex_acquisition()
     {
        $id = $this->input->get('capexid');
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



        $capex_acquisition_val = $this->capex_list->toCapexAcquisitionPDF($id);
        $person_address_val = $this->capex_list->get_pdf_capex_acquisition_details($id);
        // $person_contract_val = $this->->get_contracts($id);

        $capexid    = $capex_acquisition_val->capex_id;
        $requestedby    = $capex_acquisition_val->firstname . " ". $capex_acquisition_val->middlename ." ". $capex_acquisition_val->lastname;
        $department      = $capex_acquisition_val->department_name;
        $daterequested        = $capex_acquisition_val->capex_date;
        $itemDescription     = $capex_acquisition_val->description;    
        $descriptionOfProject        = $capex_acquisition_val->capex_purpose;
        $is_budgeted         = $capex_acquisition_val->classification_name;
     
        // $font_size = $pdf->pixelsToUnits('5');
        $capexType    = $capex_acquisition_val->capex_type;
        $itemid    = $capex_acquisition_val->description;
        $custodian    = $capex_acquisition_val->firstname . " ". $capex_acquisition_val->middlename ." ". $capex_acquisition_val->lastname;
        $location      = $capex_acquisition_val->location;
        $estUsefulLife        = $capex_acquisition_val->estimate_useful_life;
        $capacityOfUnit     = $capex_acquisition_val->capacity_of_unit;    
        $advantageOverRepair        = $capex_acquisition_val->advantage_over_repair;
        $limitationOfUnit         = $capex_acquisition_val->limitations_of_unit;

        $equipmentcost    = $capex_acquisition_val->equipment_cost;
        $laborcost    = $capex_acquisition_val->labor_cost;
        $freightcost      = $capex_acquisition_val->freight_cost;
        $incidentalexpenses        = $capex_acquisition_val->incidental_expenses;
        $estimatedcost     = $capex_acquisition_val->estimated_cost;    
        $lesstradein        = $capex_acquisition_val->less_trade_in;
        $netestematedcost         = $capex_acquisition_val->net_estimated_cost;
        $remark        =$capex_acquisition_val->remarks;
        

        $pdf->AddPage();
        // $pdf->WriteHTML($htmla, true, 0, true, true);
        $y = $pdf->getY();
        // set color for background
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

         $pdf->Ln(10);
    
        $pdf->writeHTMLCell(100, '', '', $y, '<b>Date Requested: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $daterequested, 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>CAPEX ID: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $capexid, 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>CAPEX Type: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $capexType, 0, 0, 0, true, 'L', true);

         $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>CAPEX Justification: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $capexType, 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);        
        $pdf->writeHTMLCell(100, '', '', '', '<b>Requested by: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', $requestedby, 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Department: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', $department, 0, 0, 0, true, 'L', true);     
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Item/Project Description: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $itemDescription , 0, 0, 0, true, 'L', true);     
                
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Purpose: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $descriptionOfProject, 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Project/Item Classification: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $is_budgeted, 0, 0, 0, true, 'L', true);
     
        $pdf->Ln(7);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________', 0, 0, 0, true, 'L', true);
        $pdf->Ln(7);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________', 0, 0, 0, true, 'L', true);
       
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Item Replaced: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $itemid, 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Custodian: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $custodian, 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);        
        $pdf->writeHTMLCell(100, '', '', '', '<b>Location: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', $location, 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Estimated useful life: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', $estUsefulLife, 0, 0, 0, true, 'L', true);     
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Capacity of unit: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $capacityOfUnit , 0, 0, 0, true, 'L', true);     
                
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Limitation of unit: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $limitationOfUnit, 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Advantage over purchase, lease or trade in: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', $advantageOverRepair, 0, 0, 0, true, 'L', true);


        $pdf->Ln(7);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________', 0, 0, 0, true, 'L', true);


        $pdf->Ln(7);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________', 0, 0, 0, true, 'L', true);
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>SUMMARY OF ESTIMATED PROJECT COST </b>', 0, 0, 0, true, 'L', true);


                        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Equipment/Material/Supplies: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', "P ".number_format($equipmentcost,2), 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Labor: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', "P ".number_format($laborcost,2), 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);        
        $pdf->writeHTMLCell(100, '', '', '', '<b>Frieght and Handling: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', "P ".number_format($freightcost,2), 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Other Incidental cost: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(95, '', '', '', "P ".number_format($incidentalexpenses,2), 0, 0, 0, true, 'L', true);        
                        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Total Estimated Project Cost: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', "P ".number_format($estimatedcost,2), 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Less: Trade-in: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', "P ".number_format($lesstradein,2) , 0, 0, 0, true, 'L', true); 

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Net Estimated Project Cost: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', "P ".number_format($netestematedcost,2) , 0, 0, 0, true, 'L', true); 

        $pdf->Ln(7);
        $pdf->writeHTMLCell(100, '', '', '', '<b>Remark: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $remark, 0, 0, 0, true, 'L', true);
        
              
     
        $pdf->Output('Customer_info.pdf', 'I'); 
    }


}