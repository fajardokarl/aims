<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Canvass extends CI_Controller{


	  function __construct()
    {
        // Construct the parent class
        parent::__construct();
        
       $this->load->model('canvass_model','canvass');
       //$this->load->model('inbox/inbox_main');
        $this->load->model('logs/Logs_model', 'logs');
        // model init for 'Users'
        $this->load->model('users/Users_model','users');
        // main model
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
        // $this->data['content'] = 'canvas_form';
        $this->data['content'] = 'quotation';
        $this->data['page_title'] = 'Canvass Form';        
        $this->load->helper('url');
        $this->load->helper('date');        
        $this->data['quotation'] = $this->canvass->retrieve_canvass();
        // $this->data['all_suppliers'] = $this->item->retrieve_all_suppliers();   
        $this->load->view('default/index', $this->data);  
        $this->load->model("canvass_model");  
     // $this->load->view('logistics_main');
       
}

 public function get_all_details(){  
       echo json_encode($this->canvass->get_all_details($this->input->post('supplierid'),$this->input->post('prfid')));
    }

public function list_uom(){
        echo json_encode($this->canvass->supplier_code($this->input->post('item_id')));
    }

 public function quotedetails(){
        $this->data['content'] = 'quotation_details';
      $this->data['page_title'] = 'Logistics Module || Canvass Detail'; 
      $this->data['quotation_head'] = $this->canvass->quotation_details_head($this->input->get('prfid'));
      // $this->data['quotation_details'] = $this->canvass->get_quotation_details($this->input->get('prfid'));
      $this->data['all_suppliers'] = $this->canvass->retrieve_needed_supplier($this->input->get('prfid'));      
     
      // This 'capexid' is the last var of  window.open(baseurl+"Logistics/capex_list_controller/retrieve_all_capex_details?capexid=" + capex_id);

      //This is to retrieve database into capexlist  
    
      $this->load->view('default/index', $this->data); 
    }


    //  public function purchase_order_form(){
    //   $this->data['content'] = 'purchase_order_details';
    //   $this->data['page_title'] = 'Logistics Module || PO FORM'; 
    //   $this->data['POhead'] = $this->canvass->puchase_order_head($this->input->get('prfid'));
    //   $this->data['PO_details'] = $this->canvass->get_approved_supplier($this->input->get('prfid'));    
    //   $this->data['supplier_selected'] = $this->canvass->retrieve_selected_supplier($this->input->get('prfid'));      
     
    //   // This 'capexid' is the last var of  window.open(baseurl+"Logistics/capex_list_controller/retrieve_all_capex_details?capexid=" + capex_id);

    //   //This is to retrieve database into capexlist  
    
    //   $this->load->view('default/index', $this->data); 
    // }


public function save_canvass(){
$this->load->helper('date');
$this->load->model("canvass_model");  
    $data = array(
            //database-------------unique identifier
            'quotation_id' =>$this->input->post('quotation_id'),
            'prf_id' =>$this->input->post('prf_id'),
            'date_quote'  =>date('Y-m-d'),
            'canvassed_by' =>$this->input->post('canvassed_by'),            
            'canvass_total' =>$this->input->post('canvass_total'),
            'canvass_status_id' =>$this->input->post('save_canvass_item')
            );            
    $id = $this->canvass->insert_canvass($data);

    foreach ($this->input->post('contact_number') as $i => $value)
    {
    $details = array(
             'canvass_id' => $id,
             'prf_id' => $this->input->post('prf_id'),   
             'supplier_id' =>$this->input->post('quote_supplier_name')[$i],
             'item_id' =>$this->input->post('item_description')[$i], 
             'budget_id' =>$this->input->post('budget_id')[$i], 
             'qty_item' =>$this->input->post('qty_item')[$i],
             'uom_id' =>$this->input->post('uom')[$i],
             'remarks' =>$this->input->post('quote_remark')[$i],
             'price_offer' =>$this->input->post('price_offer')[$i],
             'total' =>$this->input->post('sub_total')[$i],
             'terms_of_payment' =>$this->input->post('terms_of_payment')[$i],
             'contact_person' =>$this->input->post('contact_person')[$i],
             'contact_number' =>$this->input->post('contact_number')[$i]          
             );
            $this->canvass->insert_canvass_detail($details);
        }
}

public function save_rush_po(){
$this->load->helper('date');
$this->load->model("canvass_model");  
    $data = array(
            //database-------------unique identifier
            'prf_id' =>$this->input->post('prf_id'),
            'po_date'  =>date('Y-m-d'),
            'rush_po_by' =>$this->input->post('rush_po_by'),            
            'spo_item' =>$this->input->post('canvass_total'),
            'spo_qty' =>$this->input->post('save_canvass_item')
            );            
    $id = $this->canvass->insert_rush_po($data);

    foreach ($this->input->post('contact_number') as $i => $value)
    {
    $details = array(
             'po_esp_id' => $id,
           
             'supplier_id' =>$this->input->post('quote_supplier_name')[$i],           
             
             'price_offer' =>$this->input->post('price_offer')[$i],
           
             'terms_of_payment' =>$this->input->post('terms_of_payment')[$i],
             'contact_person' =>$this->input->post('contact_person')[$i],
             'contact_number' =>$this->input->post('contact_number')[$i]          
             );
            $this->canvass->insert_rush_po_detail($details);
        }
}

 public function purchaseOrder(){
      $this->data['content'] = 'purchase_order';
      $this->data['page_title'] = 'Purchase Order'; 
      // $this->data['quotation_head'] = $this->canvass->quotation_details_head($this->input->get('quoteid'));
      // $this->data['quotation_details'] = $this->canvass->get_quotation_details($this->input->get('quoteid'));
      // $this->data['all_suppliers'] = $this->canvass->retrieve_needed_supplier($this->input->get('quoteid'));      
     
      // This 'capexid' is the last var of  window.open(baseurl+"Logistics/capex_list_controller/retrieve_all_capex_details?capexid=" + capex_id);

      //This is to retrieve database into capexlist 

      // $this->data['details'] = $this->canvass->retrieve_po();  
      $this->data['purchase_list'] = $this->canvass->retrieve_all_canvass(); 
      $this->load->view('default/index', $this->data); 
    }

     public function RushPurchaseOrder(){
      $this->data['content'] = 'rush_po';
      $this->data['page_title'] = 'Rush Purchase Order'; 
      // $this->data['quotation_head'] = $this->canvass->quotation_details_head($this->input->get('quoteid'));
      // $this->data['quotation_details'] = $this->canvass->get_quotation_details($this->input->get('quoteid'));
      // $this->data['all_suppliers'] = $this->canvass->retrieve_needed_supplier($this->input->get('quoteid'));      
     
      // This 'capexid' is the last var of  window.open(baseurl+"Logistics/capex_list_controller/retrieve_all_capex_details?capexid=" + capex_id);

      //This is to retrieve database into capexlist 

      // $this->data['details'] = $this->canvass->retrieve_po();  
      $this->data['purchase_list'] = $this->canvass->retrieve_all_rush_request(); 
      $this->load->view('default/index', $this->data); 
    }

 public function PurchaseOrderDetails(){
      $this->data['content'] = 'purchase_order_details';
      $this->data['page_title'] = 'CREATE REGULAR PO';    
      $this->data['POhead'] = $this->canvass->getPOHead($this->input->get('prf_id'));
      $this->data['PO_details'] = $this->canvass->getPODetails($this->input->get('prf_id'));
      $this->data['supplier_selected'] = $this->canvass->retrieve_selected_supplier($this->input->get('prf_id'));
      $this->load->view('default/index', $this->data); 
    }

 public function RushPurchaseOrderDetails(){
      $this->data['content'] = 'rush_po_details';
      $this->data['page_title'] = 'CREATE RUSH PO';    
      $this->data['POhead'] = $this->canvass->getPOHead($this->input->get('prf_id'));
      $this->data['PO_details'] = $this->canvass->getPODetails($this->input->get('prf_id'));


      $this->data['all_items'] = $this->canvass->get_items($this->input->get('prf_id'));      
      $this->data['all_items2'] = $this->canvass->get_items($this->input->get('prf_id')); 


       $this->data['suppliers'] = $this->canvass->getAllSupplier(); 
      //$this->data['supplier_selected'] = $this->canvass->retrieve_selected_supplier($this->input->get('prf_id'));
      $this->load->view('default/index', $this->data); 
    }
public function prf_details(){
        echo json_encode($this->canvass->budget_by_departments($this->input->post('item_id'),$this->input->post('prf_id')));
    }

 public function ShowAllPO(){
      $this->data['content'] = 'PO_list';
      $this->data['page_title'] = 'List of all PO'; 
      // $this->data['quotation_head'] = $this->canvass->quotation_details_head($this->input->get('quoteid'));
      // $this->data['quotation_details'] = $this->canvass->get_quotation_details($this->input->get('quoteid'));
      // $this->data['all_suppliers'] = $this->canvass->retrieve_needed_supplier($this->input->get('quoteid'));      
     
      // This 'capexid' is the last var of  window.open(baseurl+"Logistics/capex_list_controller/retrieve_all_capex_details?capexid=" + capex_id);

      //This is to retrieve database into capexlist 

      // $this->data['details'] = $this->canvass->retrieve_po();  
      $this->data['po_list'] = $this->canvass->retrieve_po(); 
      $this->load->view('default/index', $this->data); 
    }


function inbox(){
    //$this->data['content'] = 'inbox_main';

    $this->load->view('default/index', $this->data);
}

// public function list_item(){
//         echo json_encode($this->canvass->selected_item($this->input->post('supplier_id'),$this->input->post('item_id'),$this->input->post('prf_id')));
//     }

public function list_item(){
        echo json_encode($this->canvass->selected_item($this->input->post('supplier_id'),$this->input->post('prf_id')));
    }

public function qty_list(){
        echo json_encode($this->canvass->budget_by_department($this->input->post('item_id'),$this->input->post('prf_id')));
    }
public function canvass_list(){
      $this->data['content'] = 'canvass_list';
      $this->data['page_title'] = 'Canvass Detail'; 
      $this->data['canvass_list'] = $this->canvass->retrieve_canvass_list(); 
     
      $this->load->view('default/index', $this->data); 
    }


 public function insert_po(){
        $this->load->helper('date');
        
        $bom = array(
            'prf_id' => $this->input->post('prf_id'),
            'supplier_id' => $this->input->post('supplier_id'),
            'created_by_id'=> $this->session->userdata('user_id'),
            'po_date' => date('Y-m-d',now()),
            // 'project_id' => $this->input->post('project_id'),
            // 'lot_id' => $this->input->post('lot_id'),
        );

        $po_id = $this->canvass->insert_po_model($bom);
        $po_items = $this->input->post('po_items');
        // print_r($po_items);
        foreach ($po_items as $value) {
            $po_data = array(
                'po_id' => $po_id,
                'item_id' => $value['item_id'],
                'po_uom_id' => $value['po_uom_id'],
                'po_item_remark' => $value['po_item_remark'],
                'po_qty' => $value['qty_item'],
                'po_price' => $value['price_offer'],
                'po_subtotal' => $value['total'],
                'pbudget_id' => $value['budget_id'],
                'TOP' => $value['TOP']
                // 'construction_desc_id' => $value['construction_desc_id'],
            );
            $this->canvass->insert_po_details_model($po_data);
        }

        $user = $this->users->get_user($this->session->userdata('user_id'));
        $log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=> $this->session->userdata('user_id'),
            'location'=>'Logistics Module',
            'object'=>'canvass',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " inserted new PO ID " . $po_id
        );
        $this->logs->log($log_entry);

        echo json_encode($po_id);
    }


public function prf_status(){
      $this->data['content'] = 'prf_status';
      $this->data['page_title'] = 'PRF Approval Section'; 
      $this->data['prf_status'] = $this->canvass->retrieve_prf_list(); 
     
      $this->load->view('default/index', $this->data); 
    } 
public function get_prf_status(){
        echo json_encode($this->canvass->getPrfDetails());
    } 

public function prf_change_status(){

        $id = $this->input->post('id');
        $data = $this->input->post('stat_val');

        $user = $this->users->get_user($this->session->userdata('user_id'));
        $log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Canvass Module',
            'object'=>'canvass',
            'event_type'=>'update',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " change status of PRF approval " . $id
        );
        $this->logs->log($log_entry);

echo json_encode($this->canvass->change_prf_status_model($id, array('prf_status_id' => $data)));
    }

public function change_status(){

        $id = $this->input->post('id');
        $data = $this->input->post('stat_val');
        $reason = $this->input->post('approve_reason');

        $user = $this->users->get_user($this->session->userdata('user_id'));
        $log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Canvass Module',
            'object'=>'canvass',
            'event_type'=>'update',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " change status of Canvass approval " . $id
        );
        $this->logs->log($log_entry);

echo json_encode($this->canvass->change_status_model($id, array('is_approved' => $data,'approve_reason' => $reason)));
    }


    public function update_budget(){

        $budget_id = $this->input->post('budget_id');
        $budget_amount = $this->input->post('budget_amount');
        $budget_quantity = $this->input->post('budget_quantity');
        $status = $this->input->post('status');
        
        $user = $this->users->get_user($this->session->userdata('user_id'));
        $log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Canvass Module',
            'object'=>'canvass',
            'event_type'=>'update',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " change status of Canvass approval " . $budget_id
        );
        $this->logs->log($log_entry);

echo json_encode($this->canvass->change_budget_status_model($budget_id, array('budget_amount' => $budget_amount,'budget_quantity' => $budget_quantity,'status' => $status)));

    }


public function canvassApproval(){
      $this->data['content'] = 'canvass_approval';
      $this->data['page_title'] = 'Logistics Module || Approval for canvass'; 
      // $this->data['customjs'] = 'logistics/approve_js';
      $this->data['canvass'] = $this->canvass->getCanvassHead($this->input->get('prf_id'));
      $this->data['approval_details'] = $this->canvass->getCanvassDetails($this->input->get('prf_id'));
      $this->data['total'] = $this->canvass->retrieve($this->input->get('prf_id'));

     
      $this->load->view('default/index', $this->data); 
    }

public function get_canvass(){
        echo json_encode($this->canvass->getCanvassDetails($this->input->post('id')));
    } 


public function canvass_report(){
      $this->data['content'] = 'canvass_report';
      $this->data['page_title'] = 'Select Canvass Report';
      $this->data['canvass_report'] = $this->canvass->retrieve_approved_canvass();      
      $this->load->view('default/index', $this->data); 
    }

public function report(){
      $this->data['content'] = 'report';
      $this->data['page_title'] = 'Generate Canvass Report'; 
        
      $this->data['report_head'] = $this->canvass->getReportHead($this->input->get('prf_id'));
      $this->data['report_details'] = $this->canvass->getReportDetails($this->input->get('prf_id'));    
      $this->load->view('default/index', $this->data); 
    }



 public function pdf_report()
     {
        $id = $this->input->get('prf_id');
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



        $report_head = $this->canvass->reportHead($id);
        $report_details = $this->canvass->getReportDetails($id);


        $prfid    = $report_head->prf_id;
        $canvassid    = $report_head->canvass_id;
        $date_canvassed    = $report_head->date_quote;
        $canvassed_by    =  $report_head->canvasser;
        $requestedby    = $report_head->requestor;
        $department      = $report_head->department_name;
        $dateneeded        = $report_head->date_needed;
        $daterequested     = $report_head->date_requested;
        $totalamount         = $report_head->total_amount;
        $justification = $report_head->justification;
        $purpose         = $report_head->purpose;
        $project         = $report_head->project_id;
        $project_id          =$report_head->remarks;
       
        // $font_size = $pdf->pixelsToUnits('5');
        
        

        $pdf->AddPage('L');
        // $pdf->WriteHTML($htmla, true, 0, true, true);
        $y = $pdf->getY();
        // set color for background
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);        

        $pdf->Ln(10);
        // C,L,R are Center, Left and Right
        $pdf->writeHTMLCell(250, '', '', $y, '<h2><b>CANVASS REPORT </b></h2>' , 0, 0, 0, true, 'C', true);
        $pdf->Ln(7);
        $pdf->writeHTMLCell(60, '', '', '', '<b>PRF NO: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', $prfid, 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(130, '', '', '', '<b>Date: </b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(30, '', '', '', $daterequested, 0, 0, 0, true, 'R', true);
         
      

        $pdf->Ln(7);
        $pdf->writeHTMLCell(60, '', '', '', '<b>CANVASS REPORT NO: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', $canvassid, 0, 0, 0, true, 'L', true);

         
       
        $pdf->Ln(7);
        $pdf->writeHTMLCell(60, '', '', '', '<b>REQUESTED BY: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(60, '', '', '', $requestedby, 0, 0, 0, true, 'L', true);
        // $pdf->Ln(7);
        $pdf->Ln(10);
              
        $pdf->SetFont ('helvetica', '', 9 , 15, 'default', true );

        $pdf->Ln(8);
        // $pdf->writeHTMLCell(330, '', '', '', '______________________________________________________________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);
        $pdf->Ln(5);
        $pdf->writeHTMLCell(50, 7.2, '', '', '<b>Supplier Name</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(40, 7.2, '' , '', '<b>Item Description</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, 7.2, '' , '', '<b>Unit Price</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, 7.2, '' , '', '<b>Price Offer</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(35, 7.2, '' , '', '<b>Contact Person</b>', 1, 0, 0, true, 'L', true);        
        $pdf->writeHTMLCell(30, 7.2, '' , '', '<b>Contact No.</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(40, 7.2, '' , '', '<b>Terms of Payment</b>', 1, 0, 0, true, 'L', true);
         $pdf->writeHTMLCell(30, 7.2, '' , '', '<b>Result</b>', 1, 0, 0, true, 'L', true);
        $pdf->Ln(1);
        // $pdf->writeHTMLCell(330, '', '', '', '______________________________________________________________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);


        $add_ref = 0;
        foreach ($report_details as $key => $value) {
            $pdf->Ln(6);
            $address_val = 

            $pdf->writeHTMLCell(50, 5.8, '', '', $value['supplier_id'], 1, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(40, 5.8, '', '', $value['description'], 1, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, 5.8, '', '', number_format($value['price_offer']), 1, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, 5.8, '', '', number_format($value['price_offer']), 1, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(35, 5.8, '', '', $value['contact_person'], 1, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, 5.8, '', '', $value['contact_number'], 1, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(40, 5.8, '', '', $value['terms_of_payment'], 1, 0, 0, true, 'L', true);
            // $pdf->writeHTMLCell(30, 5.8, '', '', $value['is_approved'], 1, 0, 0, true, 'L', true);


        if ($value['is_approved'] != 0) {
        $pdf->writeHTMLCell(30, 5.8, '', '','Approved', 1, 0, 0, true, 'L', true);
        }else{
        $pdf->writeHTMLCell(30, 5.8, '', '','Denied', 1, 0, 0, true, 'L', true);       
        }
    
            $add_ref = $value['canvass_detail_id'];

          
        }

        $pdf->Ln(7);
        // $pdf->writeHTMLCell(40, '', '', 150, '<b>Total Amount: </b>', 0, 0, 0, true, 'L', true);
        // $pdf->writeHTMLCell(40, '', '', 150, '<b>Total Amount: </b>', 0, 0, 0, true, 'C', true);
        // $pdf->writeHTMLCell(40, '', '', 150, '<b>Total Amount: </b>', 0, 0, 0, true, 'R', true);
        //$pdf->writeHTMLCell(50, '', '', '', number_format($totalamount,2), 0, 0, 0, true, 'L', true); 

        $pdf->writeHTMLCell(60, '', '', 100, '<b>CANVASSED BY: </b>', 0, 0, 0, true, 'L', true);
       // $pdf->writeHTMLCell(30, '', 50, 100, $prfid, 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(130, '', 80, 100, '<b>VERIFIED BY: </b>', 0, 0, 0, true, 'C', true);
        //$pdf->writeHTMLCell(30, '', 100, 100, $daterequested, 0, 0, 0, true, 'C', true); 
        $pdf->writeHTMLCell(130, '', 120, 100, '<b>APPROVED BY: </b>', 0, 0, 0, true, 'R', true);
       // $pdf->writeHTMLCell(30, '', 150, 100, $daterequested, 0, 0, 0, true, 'R', true);

         $pdf->Ln(7);
        $pdf->writeHTMLCell(30, '', '', 110, $date_canvassed, 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', 130, 110, $daterequested, 0, 0, 0, true, 'C', true); 
        $pdf->writeHTMLCell(30, '', 215, 110, $daterequested, 0, 0, 0, true, 'R', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(60, '', '', 115, $canvassed_by, 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(60, '', 120, 115, $canvassed_by, 0, 0, 0, true, 'C', true); 
        $pdf->writeHTMLCell(60, '', 205, 115, $canvassed_by, 0, 0, 0, true, 'R', true);

        $pdf->Output('Customer_info.pdf', 'I'); 
    }



 

    public function pdfPO()
     {
        $id = $this->input->get('PO');
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


        $supplier = $this->canvass->supplier_details($id);
        $head = $this->canvass->headPO($id);
        $details = $this->canvass->detailPO($id);
        // $address = $this->canvass->getPersonAddressInfo($id);



        
       

        // $supplierTIN = $supplier->tin;

        if ($supplier->client_type_id == 1) {
        $supplierAddress = strtoupper($supplier->person_add);
        $supplierTIN = $supplier->person_tin;        
        $supplierName = $supplier->person_name; 

        }elseif ($supplier->client_type_id == 2) {
        $supplierAddress = strtoupper($supplier->org_add);
        $supplierTIN = $supplier->org_tin;
        $supplierName = $supplier->organization_name;         
         
        }

        // $supplier = $head->supplier_id;        
        $poid = $head->po_id;
        $date = $head->po_date;
        $prf = $head->prf_id;
        $po_total = $head->po_total;
        $canvassby = $head->firstname . " ". $head->middlename ." ". $head->lastname;
        $delivery = $head->warehouse_description;

        // $canvassed_by    = $report_head->firstname . " ". $report_head->middlename ." ". $report_head->lastname;;
        // $requestedby    = $report_head->firstname . " ". $report_head->middlename ." ". $report_head->lastname;
        // $department      = $report_head->department_name;
        // $dateneeded        = $report_head->date_needed;
        // $daterequested     = $report_head->date_requested;
        // $totalamount         = $report_head->total_amount;
        // $justification = $report_head->justification;
        // $purpose         = $report_head->purpose;
        // $project         = $report_head->project_id;
        // $project_id          =$report_head->remarks;
        $font_size = $pdf->pixelsToUnits('5');
        
        

        $pdf->AddPage('P');
        // $pdf->WriteHTML($htmla, true, 0, true, true);
        $y = $pdf->getY();
        // set color for background
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);        

        $pdf->SetFont ('helvetica', '', 9 , 15, 'default', true );
        $br = "<br />";
        $pdf->Ln(10);
        // C,L,R are Center, Left and Right
        $pdf->writeHTMLCell(180, '', '', $y, '<h3><b>PURCHASE ORDER </b></h3>' , 0, 0, 0, true, 'C', true);
        $pdf->Ln(7);
        $pdf->writeHTMLCell(60, '', '', '', '<b>TO:</b>'.$supplierName.$br.$br.'<b>ADD:</b>'.$supplierAddress.$br.$br.'<b>TIN:</b>'.$supplierTIN.$br, 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(60, 28, 75, '', '<b>Delivered To:</b>'.$br.$delivery.$br, 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(60, 5, 135, '', '<b>PO Date:</b>'.$date, 1, 0, 0, true, 'L', true);
        $pdf->Ln(5);
        $pdf->writeHTMLCell(60,5, 135, '', '<b>Delivery Date:</b>'.$date, 1, 0, 0, true, 'L', true);
        $pdf->Ln(5);
        $pdf->writeHTMLCell(60,18, 135, '', '30 DAYS AFTER RECEIPT OF ORIGINAL INVOICE', 1, 0, 0, true, 'C', true);
        
        
         // $pdf->writeHTMLCell(50, '', '', '', $supplier, 0, 0, 0, true, 'L', true);
        // $pdf->writeHTMLCell(50, '', '', '', '<h5><b>Delivered To: </b></h5>', 0, 0, 0, true, 'C', true);
        // //$pdf->writeHTMLCell(30, '', '', '', $poid, 0, 0, 0, true, 'R', true);       
        // $pdf->writeHTMLCell(35, '', '', '', '<h5><b>PO Date: </b><h5>', 0, 0, 0, true, 'R', true);
        // $pdf->writeHTMLCell(30, '', '', '', $date, 0, 0, 0, true, 'R', true);              



        // $pdf->Ln(7);
        //  $pdf->writeHTMLCell(10, '', '', '', '<h5><b>Add </b></h5>', 0, 0, 0, true, 'L', true);
        //  $pdf->writeHTMLCell(50, '', '', '', $supplier, 0, 0, 0, true, 'L', true);
       
        // $pdf->writeHTMLCell(85, '', '', '', '<h5><b>Delivery Date: </b><h5>', 0, 0, 0, true, 'R', true);
        // $pdf->writeHTMLCell(30, '', '', '', $date, 0, 0, 0, true, 'R', true);       
       
         
      
     
        // $pdf->writeHTMLCell(40, '', '', '', '<b>Item Requested: </b>', 0, 0, 0, true, 'L', true);
        
       
         $pdf->SetFont ('helvetica', '', 9 , 15, 'default', true );
         
            
        $pdf->Ln(21);
        $pdf->writeHTMLCell(50, 0, '', '', '<b>Item Description</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, 0, '' , '', '<b>Packing</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(35, 0, '' , '', '<b>Item Specification</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, 0, '' , '', '<b>Qty</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(35, 0, '' , '', '<b>Price</b>', 0, 0, 0, true, 'L', true);        
        $pdf->writeHTMLCell(30, 0, '' , '', '<b>Amount</b>', 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(2);
        $pdf->writeHTMLCell(330, '', '', '', '_____________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);

      
        $add_ref = 0;
        foreach ($details as $key => $data) {
            $pdf->Ln(6);
            $address_val = 

            $pdf->writeHTMLCell(50, 5.8, '', '', $data['description'], '', 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, 5.8, '', '', $data['uom_name'], '', 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(35, 5.8, '', '', $data['po_item_remark'], '', 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, 5.8, '', '', $data['po_qty'], '', 0, 0, true, 'L', true);           
            $pdf->writeHTMLCell(35, 5.8, '', '', number_format($data['po_price']), '', 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, 5.8, '', '', number_format($data['po_subtotal']), '', 0, 0, true, 'L', true);
           
    
            $add_ref = $data['po_id'];          
        } 
        

        $pdf->Ln(7);
        $pdf->writeHTMLCell(170, '', '', '', '<b>***NOTHING FOLLOWS***</b>', 0, 0, 0, true, 'C', true);
       

        $pdf->SetFont ('helvetica', '', 9 , 15, 'default', true );
        $br = "<br />";
        $notes = '<i>NOTES TO ALL SUPPLIER:</i>';
        $one = '<i>1. Subject to quality approval</i>';
        $two = '<i>2. Invoice must clearly show amount of sales, vat accreditation number otherwise payment will not be.</i>';
        $three = '<i>3. 5% - 10% overrun/underrun is available.</i>';
        $four = '<i>4. Prices include suitable packing unless otherwise stated by us.</i>';
        $five = '<i>5. We reserved the right to cancel any or all items on this order on your failure to meet delivery date or your failure to deliver full quantities.</i>';
        $six = '<i>6. Your invoices & delivery docs must quote this PO No. & should be promptly presented in duplicate sets to our Accounting Dept.</i>';
        $seven = '<i>7. All shipments by common carrier should be documented in your name as shipper.</i>';
        $impt = '<b>IMPORTANT</b>';
        $prno = '<b>PRF#s:</b>';
        $canvass = '<b>Canvassed by:</b>';
        $recommend = '<b>Recommeded by:</b>';
        $ack = '<b>SUPPLIERS ACKNOWLEDGEMENT</b>';
        $letter = 'We confirm our willingness and ability to supply all the materials covered by this order at price indicated and deliver specified under the terms and conditions contained herein:';


        $pdf->Ln(7);       
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

$pdf->writeHTMLCell(130, 5.8, '', '',$notes.$br.$one.$br.$two.$br.$three.$br.$four.$br.$five.$br.$six.$br.$seven, 1, 0, 0, true, 'L', true);
        // $pdf->Ln(7);
$pdf->writeHTMLCell(50, 10, '','','Total: '.$po_total, 1,0,0, true, 'C', true);
$pdf->Ln();   
$pdf->writeHTMLCell(50, 24, 145, '', '', 1, 0, 0, true, 'C', true);
$pdf->Ln();
$pdf->writeHTMLCell(50, 10, 145, '', '<b>Authorized Signature</b>'.$br.'P.O. No.'.$poid, 1, 0, 0, true, 'C', true);
$pdf->Ln(10);     
$pdf->writeHTMLCell(70, 5.8, '', '',$br.$impt.$br.$br.$prno.$prf.$br.$br.$canvass.$canvassby.$br.$br.$recommend.$br, 1, 0, 0, true, 'L', true);
$pdf->writeHTMLCell(90, 5.8, '', '',$br.$ack,0, 0, 0, true, 'C', true);

$pdf->Ln(7);       
$pdf->writeHTMLCell(90, 5.8, 90, '',$br.$letter,0, 0, 0, true, 'J', true);


$pdf->Ln(15);       
$pdf->writeHTMLCell(90, 5.8, 90, '','<b>_____________________</b>',0, 0, 0, true, 'J', true); 
$pdf->writeHTMLCell(90, 5.8, 150, '','<b>_____________________</b>',0, 0, 0, true, 'J', true); 
$pdf->Ln(7);       
$pdf->writeHTMLCell(120, 5.8, 103, '','<b>Supplier</b>',0, 0, 0, true, 'J', true);  
$pdf->writeHTMLCell(120, 5.8, 165, '','<b>Date</b>',0, 0, 0, true, 'J', true);    
// $pdf->writeHTMLCell(60, '', '', 100, '<b>Supplier </b>', 0, 0, 0, true, 'c', true);
// // $pdf->writeHTMLCell(30, '', 50, 100, $prfid, 0, 0, 0, true, 'L', true);

// $pdf->writeHTMLCell(80, '','', 100, '<b>Date </b>', 0, 0, 0, true, 'R', true);

$pdf->Ln(90);
$pdf->writeHTMLCell(80, '', 155, '','<b><h3>P.O. No.</h3></b>', 0, 0, 0, true, 'L', true);
$pdf->Ln(8);
$pdf->writeHTMLCell(80, '', 175, '',$poid, 0, 0, 0, true, 'L', true);    


        // $pdf->writeHTMLCell(30, '', '', 110, $date_canvassed, 0, 0, 0, true, 'L', true);
        // $pdf->writeHTMLCell(30, '', 130, 110, $daterequested, 0, 0, 0, true, 'C', true); 
        // $pdf->writeHTMLCell(30, '', 215, 110, $daterequested, 0, 0, 0, true, 'R', true);

        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(60, '', '', 115, $canvassed_by, 0, 0, 0, true, 'L', true);
        // $pdf->writeHTMLCell(60, '', 120, 115, $canvassed_by, 0, 0, 0, true, 'C', true); 
        // $pdf->writeHTMLCell(60, '', 205, 115, $canvassed_by, 0, 0, 0, true, 'R', true);

        $pdf->Output('Customer_info.pdf', 'I'); 
    }



}


