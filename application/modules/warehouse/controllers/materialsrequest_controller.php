<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Materialsrequest extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('materialsrequest_model', 'as');      
        $this->load->helper(array('form', 'url'));
        $this->data['navigation'] = 'warehouse/navigation';
        $this->data['customjs'] = 'warehouse/admin_savingjs';
        $this->data['verifies'] = $this->as->get_verifies();
    }

    public function index() {
        $this->data['content'] = 'materialsrequest';
        $this->data['page_title'] = 'Receiving Report';
        $this->data['RR_details'] = $this->as->retrieve_receiving_report_details();
        $this->load->view('default/index', $this->data);
    }

    public function verify() {
        // $this->data['content'] = 'verify';
        $this->data['page_title'] = 'Item Price';
        // $this->load->helper('url');
        // $this->data['details_request'] = $this->message->get_request_head($this->input->get('poid'));
        // $this->data['request'] = $this->message->get_request_details($this->input->get('poid'));
        $rrDetails = $this->as->retrieve_rr_details($this->input->post('rr_id'));
        $this->data['rrDetails'] = $rrDetails;
        echo json_encode($rrDetails);
        // $this->load->view('default/index', $this->data);
    }

    public function get_po_admin_status() {
        $status = $this->as->retrieve_po_admin_status($this->input->post('po_id'));
        echo json_encode($itemAvailability);
    }

    public function get_item_availability() {
        $items = $this->as->retrieve_po_item_availability($this->input->post('po_id'));
        $itemAvailability = "";
        $i = 0;
        while($i < count($items)) {
            if(($items[$i]['quantity'] - $items[$i]['po_qty']) < 0) {
                $itemAvailability .= "unavailable";
                break;
            }
            $i++;
        }
        echo json_encode($itemAvailability);
    }

    public function po_confirm() {
        $rr_id = $this->input->post('rr_id');
        $po_id = $this->input->post('po_id');

        $i = 0;
        $ii = 0;

        $names1 = array();
        $names2 = array();
        $item = array();
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        $info1 = [
            'po_date' => $_POST['po_date'],
            'po_date_received' => $_POST['po_date_received'],
            // 'po_admin_remark' => $_POST['po_admin_status_remark'],
            'po_admin_status' => $_POST['status_clicked']
        ];
        $this->as->confirm_po($info1, $po_id);

        foreach ($_POST as $name => $val)
        {
            if(strpos($name, '-pod_id')) {
                array_push($names1, $name);
            } elseif(strpos($name, '-item_id')) {
                array_push($names2, $name);
            }
        }
        // echo '<pre>';
        // print_r($names);
        // echo '</pre>';

        while($i < $_POST['inc']) {
            $pod_id = explode('-pod_id', $names1[$i]);
            $item_id = explode('-item_id', $names2[$i]);
            $qty_received = $_POST[$pod_id[0] . '-pod_item_qty_received'];

            $info2 = [
                'po_received' => $qty_received
            ];
            $this->as->update_pod($info2, $pod_id[0]);

            if($_POST['status_clicked'] == "complete") {
                $this->as->update_item_qty($qty_received, $item_id[0]);
            }
            $i++;
        }

        $info3 = [
            'delivery_receipt_number' => $_POST['dr_no'],
            'invoice_number' => $_POST['invoice_no']
        ];
        $this->as->update_rr_upon_confirmation($info3, $rr_id);
        
        redirect('Warehouse/adminsaving', 'refresh');
    }

    public function pdfPO() {
        $id = $this->input->get('po_id');
        $poDetails = $this->as->retrieve_po_details($id);
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

        $head = $this->as->headPO($id);
        $details = $this->as->detailPO($id);

        $supplier = $head->supplier_id;
        $poid = $head->po_id;
        $date = $head->po_date;

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

        $pdf->Ln(10);
        // C,L,R are Center, Left and Right
        $pdf->writeHTMLCell(180, '', '', $y, '<h4><b>PURCHASE ORDER </b></h4>' , 0, 0, 0, true, 'C', true);
        $pdf->Ln(7);
         $pdf->writeHTMLCell(10, '', '', '', '<h5><b>TO: </b></h5>', 0, 0, 0, true, 'L', true);
         $pdf->writeHTMLCell(50, '', '', '', $supplier, 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', '<h5><b>Delivered To: </b></h5>', 0, 0, 0, true, 'C', true);
        //$pdf->writeHTMLCell(30, '', '', '', $poid, 0, 0, 0, true, 'R', true);       
        $pdf->writeHTMLCell(35, '', '', '', '<h5><b>PO Date: </b><h5>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(30, '', '', '', $date, 0, 0, 0, true, 'R', true);              



        $pdf->Ln(7);
         $pdf->writeHTMLCell(10, '', '', '', '<h5><b>Add </b></h5>', 0, 0, 0, true, 'L', true);
         $pdf->writeHTMLCell(50, '', '', '', $supplier, 0, 0, 0, true, 'L', true);
       
        $pdf->writeHTMLCell(85, '', '', '', '<h5><b>Delivery Date: </b><h5>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(30, '', '', '', $date, 0, 0, 0, true, 'R', true);       
       
         
        $pdf->Ln(7);
        $pdf->Ln(10);
        // $pdf->writeHTMLCell(40, '', '', '', '<b>Item Requested: </b>', 0, 0, 0, true, 'L', true);
        
       
         $pdf->SetFont ('helvetica', '', 9 , 15, 'default', true );

        $pdf->Ln(8);
        $pdf->writeHTMLCell(330, '', '', '', '___________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);
        $pdf->Ln(5);
        $pdf->writeHTMLCell(50, 0, '', '', '<b>Item Description</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, 0, '' , '', '<b>Packing</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(35, 0, '' , '', '<b>Item Specification</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, 0, '' , '', '<b>Qty</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(35, 0, '' , '', '<b>Price</b>', 0, 0, 0, true, 'L', true);        
        $pdf->writeHTMLCell(30, 0, '' , '', '<b>Amount</b>', 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(1);
        $pdf->writeHTMLCell(330, '', '', '', '___________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);

      
        $add_ref = 0;
        foreach ($details as $key => $data) {
            /*echo '<pre>';
            print_r($poDetails[0]['supplier_id']);
            echo '</pre>';*/
            $pdf->Ln(6);
            // $address_val = 

            $pdf->writeHTMLCell(50, 5.8, '', '', $data['description'], '', 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, 5.8, '', '', $data['item_id'], '', 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(35, 5.8, '', '', $data['item_id'], '', 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, 5.8, '', '', $data['po_qty'], '', 0, 0, true, 'L', true);           
            $pdf->writeHTMLCell(35, 5.8, '', '', number_format($data['po_price']), '', 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, 5.8, '', '', number_format($data['po_subtotal']), '', 0, 0, true, 'L', true);
           
    
            $add_ref = $data['po_id'];

          
        } 
        $pdf->Ln(7);
        $pdf->writeHTMLCell(170, '', '', '', '<b>***NOTHING FOLLOWS***</b>', 0, 0, 0, true, 'C', true);
        $pdf->Ln(3);
        $pdf->writeHTMLCell(330, '', '', '', '___________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);

      
        $pdf->Ln(7);
      
        $pdf->writeHTMLCell(60, '', '', 100, '<b>Supplier </b>', 0, 0, 0, true, 'c', true);
        $pdf->writeHTMLCell(60, '', '', 105,  'Supplier ID: ' . $poDetails[0]['supplier_id'], 0, 0, 0, true, 'c', true);
        $pdf->writeHTMLCell(60, '', '', 110,  'Name: ' . $poDetails[0]['lastname'] . ', ' . $poDetails[0]['firstname'], 0, 0, 0, true, 'c', true);
        $pdf->writeHTMLCell(60, '', '', 115,  'Address: ' . $poDetails[0]['line_1'], 0, 0, 0, true, 'c', true);
        $pdf->writeHTMLCell(60, '', '', 120,  'Contact Number: ' . $poDetails[0]['contact_value'], 0, 0, 0, true, 'c', true);
        $pdf->writeHTMLCell(60, '', '', 125,  'TIN #: ' . $poDetails[0]['tin'], 0, 0, 0, true, 'c', true);
        $pdf->writeHTMLCell(60, '', '', 130,  'Tax Type: ' . $poDetails[0]['tax_type_name'], 0, 0, 0, true, 'c', true);
        $pdf->writeHTMLCell(60, '', '', 135,  'Email Address: ' . $poDetails[0]['contact_value'], 0, 0, 0, true, 'c', true);
       // $pdf->writeHTMLCell(30, '', 50, 100, $prfid, 0, 0, 0, true, 'L', true);

        /*;
        ;
        if($poDetails[0]['contact_type_id'] == 1 || $poDetails[0]['contact_type_id'] == 2 || $poDetails[0]['contact_type_id'] == 5) {
            echo $poDetails[0]['contact_value'];
        }
        $poDetails[0]['tin'];
        $poDetails[0]['tax_type_name'];
        if($poDetails[0]['contact_type_id'] == 3 || $poDetails[0]['contact_type_id'] == 4) {
            echo $poDetails[0]['contact_value'];
        }*/
     
        $pdf->writeHTMLCell(80, '','', 100, '<b>Date </b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(90, '', '', 105,  $date, 0, 0, 0, true, 'R', true);


        $pdf->Ln(7);
        // $pdf->writeHTMLCell(30, '', '', 110, $date_canvassed, 0, 0, 0, true, 'L', true);
        // $pdf->writeHTMLCell(30, '', 130, 110, $daterequested, 0, 0, 0, true, 'C', true); 
        // $pdf->writeHTMLCell(30, '', 215, 110, $daterequested, 0, 0, 0, true, 'R', true);

        // $pdf->Ln(7);
        // $pdf->writeHTMLCell(60, '', '', 115, $canvassed_by, 0, 0, 0, true, 'L', true);
        // $pdf->writeHTMLCell(60, '', 120, 115, $canvassed_by, 0, 0, 0, true, 'C', true); 
        // $pdf->writeHTMLCell(60, '', 205, 115, $canvassed_by, 0, 0, 0, true, 'R', true);

        $pdf->Output('PO_info.pdf', 'I'); 
    }

}//end class