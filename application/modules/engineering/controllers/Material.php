<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Material extends CI_Controller {

	private $data = array();

	  function __construct(){
        // Construct the parent class
        parent::__construct();
        // model init for 'Logs'
        $this->load->model('logs/Logs_model', 'logs');
        // model init for 'Users'
        $this->load->model('users/Users_model','users');
        // model init for 'Material'
        $this->load->model('Material_model','materials');

        
        $this->load->helper(array('form', 'url'));

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['navigation'] = 'engineering/navigation';
        $this->data['customjs'] = 'engineering/customjs';
    }

 	public function index(){
 		$this->data['content'] = 'bill_of_materials';
        $this->data['page_title'] = 'Engineering and Construction | Bill of Materials';
        $this->data['items'] = $this->materials->item_list_model();
        $this->data['uom'] = $this->materials->uom_list_model();
        $this->data['bom'] = $this->materials->bom_list_model();
        $this->data['project'] = $this->materials->project_list_model();
        $this->data['desc'] = $this->materials->construct_desc_model();
        $this->data['activity'] = $this->materials->construct_activity_model();

 		$this->load->view('default/index', $this->data);
 	}

    public function get_boms(){
        echo json_encode($this->materials->bom_list_model());
    }

    public function get_item_uom(){
        echo json_encode($this->materials->get_item_uom_model($this->input->post('item_id')));
    }

    public function get_bom(){
        echo json_encode($this->materials->get_bom_model($this->input->post('bom_id')));
    }

    public function get_proj_lots(){
        echo json_encode($this->materials->get_proj_lots_model($this->input->post('project_id')));
    }

    public function insert_bom(){
        $this->load->helper('date');
        
        $bom = array(
            'department_id' => $this->session->userdata('department_id'),
            'date_needed' => $this->input->post('date_needed'),
            'date_request' => date('Y-m-d',now()),
            'project_id' => $this->input->post('project_id'),
            'lot_id' => $this->input->post('lot_id'),
        );

        $bom_id = $this->materials->insert_bom_model($bom);
        $bom_items = $this->input->post('bom_items');
        // print_r($bom_items);
        foreach ($bom_items as $value) {
            $dom_data = array(
                'bom_id' => $bom_id,
                'item_id' => $value['item_id'],
                'uom_id' => $value['uom_id'],
                'qty' => $value['qty'],
                'unit_cost' => $value['unit_cost'],
                'construction_act_id' => $value['construction_act_id'],
                'construction_desc_id' => $value['construction_desc_id'],
            );
            $this->materials->insert_bom_details_model($dom_data);
        }

        $user = $this->users->get_user($this->session->userdata('user_id'));
        $log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=> $this->session->userdata('user_id'),
            'location'=>'Engineering Module',
            'object'=>'material',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " inserted new bom ID " . $bom_id
        );
        $this->logs->log($log_entry);

        echo json_encode($bom_id);
    }


    public function pdf_bom(){
        $id = $this->input->get('bomid');
        $this->load->library('Pdf');

        $pdf = new Pdf('L', 'in', 'MEMO', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('IRM');
        $pdf->SetTitle('IRM System Generated PDF');
        $pdf->SetSubject('IRM');
        $pdf->SetKeywords('IRM, PDF, example, test, guide');
        ob_clean();
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,0,0), array(0,0,0));
        $pdf->setFooterData(array(0,0,0), array(0,0,0));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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



        $bom = $this->materials->get_bom_model($id);

        $lot_desc  = $bom[0]['lot_description'];;
        $date_req  = date_format(date_create($bom[0]['date_request']), "M d, Y");
        $date_need = date_format(date_create($bom[0]['date_needed']), "M d, Y");


        $pdf->AddPage( );
        // $pdf->WriteHTML($htmla, true, 0, true, true);
        $y = $pdf->getY();
        // set color for background
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
        $pdf->SetFont ('helvetica', '', 10 , 12, 'default', true );
        $pdf->Ln(7);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Lot: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(130, '', '', '', $lot_desc, 0, 0, 0, true, 'L', true);

        $pdf->Ln(10);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Date requested: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(110, '', '', '', $date_req, 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Date Needed: </b>', 0, 0, 0, true, 'L', true);
        $pdf->WriteHTMLCell(110, '', '', '', $date_need, 0, 0, 0, true, 'L', true);

        $temp = '';
        $temp_act = '';
        $num = 1;
        foreach ($bom as $bom_desc) {
            if ($temp != $bom_desc['construction_desc_id']) {
                $char_code = 65; // letter A
                $pdf->Ln(7);
                $temp = $bom_desc['construction_desc_id'];
                $pdf->writeHTMLCell(20, 5.8, '', '', '<b>ITEM NO</b>', 1, 0, 0, true, 'C', true);
                $pdf->writeHTMLCell(72, 5.8, '', '', '<b>DESCRIPTION</b>', 1, 0, 0, true, 'C', true);
                $pdf->writeHTMLCell(18, 5.8, '', '', '<b>QTY</b>', 1, 0, 0, true, 'C', true);
                $pdf->writeHTMLCell(18, 5.8, '', '', '<b>UNIT</b>', 1, 0, 0, true, 'C', true);
                $pdf->writeHTMLCell(26, 5.8, '', '', '<b>UNIT PRICE</b>', 1, 0, 0, true, 'C', true);
                $pdf->writeHTMLCell(26, 5.8, '', '', '<b>TOTAL COST</b>', 1, 0, 0, true, 'C', true);
                $pdf->Ln(6);
                $pdf->writeHTMLCell(20, 5.8, '', '', '<b>' . $num .'</b>', 1, 0, 0, true, 'C', true);
                $pdf->writeHTMLCell(72, 5.8, '', '', $bom_desc['description_name'], 1, 0, 0, true, 'C', true);
                $pdf->writeHTMLCell(18, 5.8, '', '', '', 1, 0, 0, true, 'C', true);
                $pdf->writeHTMLCell(18, 5.8, '', '', '', 1, 0, 0, true, 'C', true);
                $pdf->writeHTMLCell(26, 5.8, '', '', '', 1, 0, 0, true, 'C', true);
                $pdf->writeHTMLCell(26, 5.8, '', '', '', 1, 0, 0, true, 'C', true);
                $num++;
                
                foreach ($bom as $bom_act) {
                    if ($temp_act != $bom_act['construction_act_id'] && $temp == $bom_act['construction_desc_id']) {
                        $temp_act = $bom_act['construction_act_id'];
                        $pdf->Ln(10);
                        $pdf->writeHTMLCell(100, '', '', '','<b>' . (chr($char_code)) . ') ' . strtoupper($bom_act['activity_name']) . '</b>', 0, 0, 0, true, 'L', true);
                        $char_code++;
                    }

                    if ($temp_act == $bom_act['construction_act_id'] && $temp == $bom_act['construction_desc_id']) {
                        $pdf->Ln(6);
                        $pdf->writeHTMLCell(20, 5.8, '', '', ' ', 0, 0, 0, true, 'C', true);
                        $pdf->writeHTMLCell(72, 5.8, '', '', $bom_act['description'], 0, 0, 0, true, 'C', true);
                        $pdf->writeHTMLCell(18, 5.8, '', '', $bom_act['qty'], 0, 0, 0, true, 'C', true);
                        $pdf->writeHTMLCell(18, 5.8, '', '', $bom_act['uom_code'], 0, 0, 0, true, 'C', true);
                        $pdf->writeHTMLCell(26, 5.8, '', '', $bom_act['unit_cost'], 0, 0, 0, true, 'R', true);
                    $pdf->writeHTMLCell(26, 5.8, '', '', number_format($bom_act['qty'] * $bom_act['unit_cost']) , 0, 0, 0, true, 'R', true);
                    }

                    $top_margin = PDF_MARGIN_HEADER;
                    if ($pdf->getY() > (240 /*height*/ - $top_margin + 30 /*another magic constant*/)) {
                        $pdf->addPage();
                    }
                        // $temp_act = $bom_act['construction_act_id'];
                }
                $pdf->Ln(7); 
                 
            }

            $top_margin = PDF_MARGIN_HEADER;

            if ($pdf->getY() > (240 /*height*/ - $top_margin + 30 /*another magic constant*/)) {
                $pdf->addPage();
            }
            // $temp = $bom_desc['construction_desc_id'];
        }


        $pdf->Output('bill_of_materials.pdf', 'I'); 
    }
    

 }

