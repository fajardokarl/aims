<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class prf_quotation_controller extends CI_Controller{


	  function __construct()
    {
        // Construct the parent class
        parent::__construct();

       $this->load->model('prf_quotation_model','prf_quotation');
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
        $this->data['content'] = 'prf_quotation';
        $this->data['page_title'] = 'Logistics Module || List of all PRF';        
        $this->load->helper('url');
        $this->load->helper('date');
        $this->data['prf_quotation'] = $this->prf_quotation->retrieve_all_prf();      
        $this->load->view('default/index', $this->data);  
     
}

    public function retrieve_all_prf_details(){
      $this->data['content'] = 'prf_quotation_list';
      $this->data['page_title'] = 'Logistics Module || Create Quotation';   
      $this->data['prf'] = $this->prf_quotation->getOnePrf($this->input->get('prfid'));
      $this->data['details'] = $this->prf_quotation->get_details_messages($this->input->get('prfid'));
      $this->data['all_items'] = $this->prf_quotation->get_items($this->input->get('prfid'));      
      $this->data['all_items2'] = $this->prf_quotation->get_items($this->input->get('prfid'));       
      $this->data['suppliers'] = $this->prf_quotation->getAllSupplier(); 
      

      //-------------experiment starts here----------

      $this->data['sample_qoutation'] = $this->prf_quotation->retrieve_sample_prf_item($this->input->get('prfid'));     

      //-------------experiment end here-------------        
      $this->load->view('default/index', $this->data); 


}

public function all_quotation(){
      $this->data['content'] = 'all_quotation';
      $this->data['page_title'] = 'Logistics Module || Quotation Detail'; 
      $this->data['quotation'] = $this->prf_quotation->quotation_all_head($this->input->get('prf_id'));
      $this->data['details'] = $this->prf_quotation->quote_details($this->input->get('prf_id'));
    

      
      // $this->data['detail'] = $this->prf_quotation->supplier_name($this->input->get('prf_id')); 
      // $this->data['quotation_details'] = $this->prf_quotation->get_quotation_details($this->input->get('prfid'));
      // $this->data['all_suppliers'] = $this->prf_quotation->retrieve_needed_supplier($this->input->get('prfid'));      
     
      // This 'capexid' is the last var of  window.open(baseurl+"Logistics/capex_list_controller/retrieve_all_capex_details?capexid=" + capex_id);

      //This is to retrieve database into capexlist  
    
      $this->load->view('default/index', $this->data); 
    }

public function save_quotation()

    {  
        $this->load->helper('date'); 
        $this->load->model('prf_quotation_model');
        $data = array(
                'prf_id' =>$this->input->post('prf_id'),                        
                'requested_by_id' =>$this->input->post('requested_by_id'),
                'quotation_status' =>$this->input->post('request_quotation'),
                'date_request' =>date('Y-m-d')                
            );
        $id = $this->prf_quotation_model->insert_quotation($data);

        foreach ($this->input->post('item_description') as $i => $value)
        {
            $items = array(
                'quotation_id' => $id,
                'prf_id' =>$this->input->post('prf_id'), 
                'item_id' => $this->input->post('item_description')[$i],
                'budget_id' => $this->input->post('budget_id')[$i],
                'quote_qty' => $this->input->post('quote_qty')[$i],
                'supplier_id' => $this->input->post('supplier_name')[$i],
                'quote_unit' => $this->input->post('quote_unit')[$i],
                'quote_remark' => $this->input->post('quote_remark')[$i]

           );
       $this->prf_quotation_model->insert_quotation_details($items);   
       }
}   

public function quotation_list(){
      $this->data['content'] = 'quotation_list';
      $this->data['page_title'] = 'Logistics Module || Quotation List'; 
      $this->data['quotation_list'] = $this->prf_quotation->getAllQuotation();         
      $this->load->view('default/index', $this->data); 
}


public function prf_details(){
        echo json_encode($this->prf_quotation->budget_by_department($this->input->post('item_id'),$this->input->post('prf_id')));
    }


public function pdf_quotation()
     {
        $id = $this->input->get('quote_detail_id');
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



        $head_val = $this->prf_quotation->to_head($id);
        $detail_val = $this->prf_quotation->get_details($id);
        // $person_contract_val = $this->->get_contracts($id);

        $id    = $head_val->supplier_name;
        // $requestedby    = $head_val->firstname . " ". $head_val->middlename ." ". $head_val->lastname;
        // $department      = $head_val->department_name;
        // $dateneeded        = $head_val->date_needed;
        // $daterequested     = $head_val->date_requested;
        // $totalamount         = $head_val->total_amount;
        // $justification = $head_val->justification;
        // $purpose         = $head_val->purpose;
        // $project         = $head_val->project_id;
        // $project_id          =$head_val->remarks;
        $font_size = $pdf->pixelsToUnits('5');
        
        

        $pdf->AddPage();
        // $pdf->WriteHTML($htmla, true, 0, true, true);
        $y = $pdf->getY();
        // set color for background
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(10);

        $pdf->writeHTMLCell(40, '', '', $y, '<b>Supplier: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $id, 0, 0, 0, true, 'L', true);      

         
        $pdf->Ln(7);
        $pdf->Ln(10);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Item Requested: </b>', 0, 0, 0, true, 'L', true);
        
       
         $pdf->SetFont ('helvetica', '', 9 , 15, 'default', true );

        $pdf->Ln(8);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);
        $pdf->Ln(5);
        $pdf->writeHTMLCell(30, '', 15, '', '<b>Description</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', 70, '', '<b>Quantity</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', 120, '', '<b>Price Offer</b>', 0, 0, 0, true, 'L', true);
       
        $pdf->Ln(1);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);


        $add_ref = 0;
        foreach ($detail_val as $key => $value) {
            $pdf->Ln(7);
            $address_val = 

            $pdf->writeHTMLCell(40, '', 15, '', $value['description'], 0, 0, 0, true, 'L', true);            
            $pdf->writeHTMLCell(40, '', 70, '', $value['quote_qty'], 0, 0, 0, true, 'L', true);         
           
            $add_ref = $value['quotation_detail_id'];
        }

        $pdf->Ln(7);
       
      
        $pdf->Output('Customer_info.pdf', 'I'); 
    }

}