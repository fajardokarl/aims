<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Materialsrequest extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('materialsrequest_model', 'mr');      
        $this->load->helper(array('form', 'url'));
        $this->data['navigation'] = 'warehouse/navigation';
        $this->data['customjs'] = 'materialsrequestjs';
    }

    public function index() {
        $this->data['content'] = 'materialsrequest';
        $this->data['page_title'] = 'Materials Requested';
        $this->data['MR_details'] = $this->mr->getMaterialsRequisition();
        $this->load->view('default/index', $this->data);
    }

    public function request() {
        $this->data['content'] = 'request';
        $this->data['page_title'] = 'Request for Materials';
        $this->data['MR_details'] = $this->mr->getMaterialsRequisition();
        $this->data['item_details'] = $this->mr->getItemDescription();
        $this->data['employee_details'] = $this->mr->getEmployees();
        $this->data['warehouse'] = $this->mr->get_warehouse_model();
        $this->data['project'] = $this->mr->get_allproject_model();
        $this->data['issuance'] = $this->mr->get_allissuance_model();
        $this->load->view('default/index', $this->data);
    }

    public function requestDetail() {
        $this->data['content'] = 'requestDetail';
        $this->data['page_title'] = 'Request for Materials';
        $this->data['MR_details'] = $this->mr->getMaterialsRequisitionById($this->input->get('mr_id'));
        $this->data['item_details'] = $this->mr->getItemDescription();
        $this->data['employee_details'] = $this->mr->getEmployees();
        $this->load->view('default/index', $this->data);
    }

    public function get_item_uom() {
        $uomDetails = $this->mr->getItemUom($_POST['material_item_id']);
        echo json_encode($uomDetails);
    }

    public function generate_mr() {
        $info = [
            'department_project' => $_POST['department_project'],
            'material_item_id ' => $_POST['material_item'],
            'material_uom_id ' => $_POST['material_uom'],
            'material_quantity ' => $_POST['quantity'],
            'material_block ' => $_POST['block'],
            'material_lot ' => $_POST['lot'],
            'requested_by_id  ' => $_POST['requested_by'],
            'request_date ' => $_POST['date_requested']
        ];

        $uomDetails = $this->mr->generateMR($info);
        echo json_encode($uomDetails);
    }

    public function verify() {
        // $this->data['content'] = 'verify';
        $this->data['page_title'] = 'Item Price';
        // $this->load->helper('url');
        // $this->data['details_request'] = $this->message->get_request_head($this->input->get('poid'));
        // $this->data['request'] = $this->message->get_request_details($this->input->get('poid'));
        $rrDetails = $this->mr->retrieve_rr_details($this->input->post('rr_id'));
        $this->data['rrDetails'] = $rrDetails;
        echo json_encode($rrDetails);
        // $this->load->view('default/index', $this->data);
    }

    public function get_po_admin_status() {
        $status = $this->mr->retrieve_po_admin_status($this->input->post('po_id'));
        echo json_encode($itemAvailability);
    }

    public function get_item_availability() {
        $items = $this->mr->retrieve_po_item_availability($this->input->post('po_id'));
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
        $this->mr->confirm_po($info1, $po_id);

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
            $this->mr->update_pod($info2, $pod_id[0]);

            if($_POST['status_clicked'] == "complete") {
                $this->mr->update_item_qty($qty_received, $item_id[0]);
            }
            $i++;
        }

        $info3 = [
            'delivery_receipt_number' => $_POST['dr_no'],
            'invoice_number' => $_POST['invoice_no']
        ];
        $this->mr->update_rr_upon_confirmation($info3, $rr_id);
        
        redirect('Warehouse/adminsaving', 'refresh');
    }

    public function insert_issuance(){
        $this->load->helper('date');

        $issuance = array(
            'requested_by' => $this->input->post('requested_by'),
            'issuance_project' => $this->input->post('issuance_project'),
            'warehouse_id' => $this->input->post('warehouse_id'),
            'issuance_date' => $this->input->post('issuance_date'),
        );
        $issuance_id = $this->mr->insert_issuance_model($issuance);

        foreach ($this->input->post('issuance_items') as $value) {
            $issuance_item = array(
                'issuance_id' => $issuance_id,
                'item_id' => $value['item_id'], 
                'qty' => $value['qty'], 
                'received' => 0, 
                'issuance_uom_id' => $value['issuance_uom_id'], 
                'issuance_detail_project' => $value['issuance_detail_project'], 
                'block' => $value['block'], 
                'lot' => $value['lot'], 
            );
            $this->mr->insert_issuancedetail_model($issuance_item);

            $warehouse_id = $this->input->post('warehouse_id');
            $item = $value['item_id'];
            $qty = $value['qty'];

            $inventory = $this->mr->get_iteminventory_model($item, $warehouse_id);

            if (is_null($inventory) || $inventory->quantity <= 0) {

            }else{
                $data = array(
                    // 'item_id' => $item,
                    // 'warehouse_id' => $warehouse_id,
                    'quantity' => ($inventory->quantity - $qty),
                    'last_updated' => date('Y-m-d',now())
                );
                $this->mr->update_itemqty_model($item, $warehouse_id, $data);
            }
            
            
        }
        echo json_encode($issuance_id);
        
    }

    public function confirm_issuance() {
        $is_id = $this->input->post('issuance_id');
        $i = 0;
        $names = array();
        $info1 = [
            'issuance_status' => "CONFIRMED"
        ];
        $this->mr->confirm_issuance($info1, $is_id);
        foreach ($_POST as $name => $val)
        {
            if(strpos($name, '-isd_id')) {
                array_push($names, $name);
            }
        }

        while($i < $_POST['inc']) {
            $isd_id = explode('-isd_id', $names[$i]);
            $info2 = [
                'received' => $_POST[$isd_id[0] . '-isd_item_qty_received']
            ];
            $this->mr->update_isd($info2, $isd_id[0]);
            $i++;
        }
        redirect('Warehouse/materialsrequest', 'refresh');
    }

    public function cancel_issuance() {
        $issuance_id = $this->input->post('issuance_id');

        $info = array( 'issuance_status' => 'CANCELLED' );
        $this->mr->cancel_issuance($info, $issuance_id);
    }

}//end class