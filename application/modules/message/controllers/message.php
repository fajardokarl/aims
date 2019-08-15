<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Message extends CI_Controller{

	  function __construct()
    {
        // Construct the parent class
        parent::__construct();

       $this->load->model('getMessage_model','message');
       //$this->load->model('inbox/inbox_main');
        $this->load->helper(array('form', 'url'));

        $this->load->model('logs/Logs_model', 'logs');
        // model init for 'Users'
        $this->load->model('users/Users_model','users');

        $this->data['customjs'] = 'message/message_js';
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['verifies'] = $this->message->get_verifies();
        $this->data['prf_details'] = $this->message->get_details_messages($this->input->get('messageid'));
        $this->data['details'] = $this->message->get_message($this->input->get('messageid'));
        $this->data['key'] = $this->message->get_details($this->input->get('messageid'));
    }

	public function index() {
	$this->data['content'] = 'main3';
    $this->data['page_title'] = 'MESSAGE';   
    $this->load->view('default/index', $this->data);
         // $this->load->view('logistics_main');       
    }

    public function get_messages(){
        $prf_id = $this->input->post('prf_id');
        $prf = $this->message->get_message($prf_id);
        echo json_encode($prf);
    }

    public function prfdetails(){
      $this->data['content'] = 'prfdetails';
      $this->data['page_title'] = 'PRF Details';
      // $this->data['amort'] = $this->message->get_amortization($this->input->get('contractid'));
      $this->data['prf'] = $this->message->getOnePrf($this->input->get('messageid'));
      $this->data['prf_details'] = $this->message->get_details_messages($this->data['prf']->prf_id);
      // $this->data['payment'] = $this->message->paid_amortization_model($this->input->get('contractid'));
      // $this->data['cont_stat_val'] = $this->message->contract_status_model();
      $this->load->view('default/index', $this->data); 
    }

    public function myPRFDetails(){
      $this->data['content'] = 'myprfdetails';
      $this->data['page_title'] = 'PRF Details';     
      $this->data['myhead'] = $this->message->myPRFhead($this->input->get('prf_id'));
      $this->data['mydetails'] = $this->message->myPRFdetails($this->input->get('prf_id'));      
      $this->load->view('default/index', $this->data); 
    }


    public function request(){
      $this->data['content'] = 'request';
      $this->data['page_title'] = 'List of Request';          
      $this->data['retrieve'] = $this->message->getMyPRF($this->session->userdata('department_id'));
      $this->load->view('default/index', $this->data); 
    }
    public function sent_prf(){
      $this->data['content'] = 'sent_item';
      $this->data['page_title'] = 'PRF Details';
      $this->data['my_prf'] = $this->message->my_prf_model($this->session->userdata('department_id'));   
      // $this->data['details_request'] = $this->message->get_request_head($this->input->get('messageid'));
      // $this->data['request'] = $this->message->get_request_details($this->input->get('messageid'));     
      $this->load->view('default/index', $this->data); 
    }

     public function prf_request(){
      $this->data['content'] = 'prfrequest';
      $this->data['page_title'] = 'PRF Details';   
      $this->data['details_request'] = $this->message->get_request_head($this->input->get('messageid'));
      $this->data['request'] = $this->message->get_request_details($this->input->get('messageid'));     
      $this->load->view('default/index', $this->data); 
    }

    

public function change_qty(){

        $id = $this->input->post('id');
        $stat_val = $this->input->post('stat_val');
        $approve_reason = $this->input->post('approve_reason');
        $sub_total = $this->input->post('sub_total');
        $user = $this->users->get_user($this->session->userdata('user_id'));
        $log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Canvass Module',
            'object'=>'canvass',
            'event_type'=>'update',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " change status of Message approval " . $id
        );
        $this->logs->log($log_entry);



echo json_encode($this->message->change_status_model($id, array('sub_total' => $sub_total,'is_change' => $stat_val,'qty' => $approve_reason)));
    }


public function get_updated_qty(){
        echo json_encode($this->message->getUpdatedQty($this->input->post('id')));
    } 


public function get_one_prf(){
        $prf_detail_id = $this->input->post('prf_detail_id');
        $detail_id = $this->message->get_prf_detail($prf_detail_id);
        echo json_encode($detail_id);
    }

    public function update_prf(){
        $prf_id = $this->input->post('prf_id');
        $prf_detail_id = $this->input->post('prf_detail_id');
        $data = array(
            'qty' => $this->input->post('qty'),
            'amount' => $this->input->post('amount'),
            'remarks' => $this->input->post('remarks'),            
            'sub_total' => $this->input->post('sub_total'),  
            'activate_cancel' => $this->input->post('activate_cancel')
            );
        $this->message->update_detail_model($prf_detail_id, $data); 
        $subtotal =  $this->message->get_prf_sum($prf_id); 

        $data2 = array(    
            'is_cancel' => $this->input->post('is_cancel'),
            'total_amount' => $subtotal->subtotal
            );
        $lot_update = $this->message->update_prf_model($prf_id,$data2);


        $user = $this->users->get_user($this->session->userdata('user_id'));
        $log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Message Module',
            'object'=>'message',
            'event_type'=>'update',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " updated Lot ID " . $prf_detail_id
        );
        $this->logs->log($log_entry);

        echo json_encode($lot_update);
    }




     public function pdf_prfdetails()
     {
        $id = $this->input->get('id_prf');       
        $this->load->library('Pdf');

        $pdf = new Pdf('L', 'in', 'MEMO', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('IRM System Generated PDF');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        ob_clean();
        // // set default header data
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



        $person_val = $this->message->toPDF($id);
        $person_address_val = $this->message->get_prf_details($id);
        // $person_contract_val = $this->->get_contracts($id);

        $prfid    = $person_val->prf_id;
        $requestedby    = $person_val->firstname . " ". $person_val->middlename ." ". $person_val->lastname;
        $department      = $person_val->department_name;
        $dateneeded        = $person_val->date_needed;
        $daterequested     = $person_val->date_requested;
        $totalamount         = $person_val->total_amount;
        $justification = $person_val->justification;
        $purpose         = $person_val->purpose;
        $project_id         = $person_val->project_id;
        $project         = $person_val->project_name;
        $lot_id          =$person_val->lot_description;
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
        $pdf->writeHTMLCell(40, '', '', '', '<b>Project: </b>', 0, 0, 0, true, 'L', true);

        if ($project_id != 0) {
        $pdf->writeHTMLCell(50, '', '', '', $project." ". $lot_id, 0, 0, 0, true, 'L', true);
        }else{
        $pdf->writeHTMLCell(50, '', '', '', 'Deparment Usage', 0, 0, 0, true, 'L', true);            
        //$pdf->writeHTMLCell(60, '', '', '', 'Deparment Usage', 0, 0, 0, true, 'L', true);
        }

         
        $pdf->Ln(7);
        $pdf->Ln(10);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Item Requested: </b>', 0, 0, 0, true, 'L', true);
        
       
         $pdf->SetFont ('helvetica', '', 9 , 15, 'default', true );

        $pdf->Ln(8);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);
        $pdf->Ln(5);
        $pdf->writeHTMLCell(30, '', 15, '', '<b>Description</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', 70, '', '<b>QTY </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', 73, '', '<b>Budget</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 100, '', '<b>Amount</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 115, '', '<b>Total</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(35, '', 138, '', '<b>Item Remarks</b>', 0, 0, 0, true, 'R', true);        
        
        $pdf->Ln(1);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);


        // $add_ref = 0;
        foreach ($person_address_val as $key => $value) {
            $pdf->Ln(7);
            $address_val = 

            $pdf->writeHTMLCell(45, '', 16, '', $value['description'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(45, '', 70, '', $value['qty']. " ".$value['uom_code'], 0, 0, 0, true, 'L', true);
            // $pdf->writeHTMLCell(45, '', 65, '', $value['uom_code'], 0, 0, 0, true, 'L', true);
            if ($value['budgeted'] != 0) {
            $pdf->writeHTMLCell(45,'', 85, '', 'budgeted', 0, 0, 0, true, 'L', true);
            }else{
            $pdf->writeHTMLCell(45,'', 85, '', 'Unbudgeted', 0, 0, 0, true, 'L', true); 
            }  
            //$pdf->writeHTMLCell(45, '', 85, '', $value['budgeted'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(50, '', 110, '', number_format($value['amount']), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(50, '', 130, '', number_format($value['sub_total']), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(50, '', 150, '', $value['remarks'], 0, 0, 0, true, 'L', true);
           
          


            // if ($value['province_name'] !== null && $value['province_name'] !== null) {
            //     $pdf->writeHTMLCell(200, '', 20, '', $address_val, 0, 0, 0, true, 'L', true);
            // }else{
            //     $pdf->writeHTMLCell(200, '', 20, '', 'No Data to Display', 0, 0, 0, true, 'L', true);
            // // }
            // $add_ref = $value['prf_detail_id'];

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

    public function changeStatus(){
        $info = [
            'prf_status_id' => $this->input->post('mod_statusid')
        ];
        $this->message->updateStatus($info, $this->input->post('mod_prf_id'));
        redirect('message', 'refresh');
    }


}