<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Warehouse_temp extends CI_Controller {

	private $data = array();

	  function __construct(){
        // Construct the parent class
        parent::__construct();

        // model init for 'Logs'
        $this->load->model('logs/Logs_model', 'logs');
        // model init for 'Users'
        $this->load->model('users/Users_model','users');
        // main model below
        $this->load->model('Receiving_model','whouse');

        $this->load->helper(array('form', 'url'));

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['customjs'] = 'engineering/schedjs';
        $this->data['navigation'] = 'Warehouse_temp/navigation';

    }

    public function index(){
        $this->data['content'] = 'dashboard';
        $this->data['page_title'] = 'Temporary Warehousing';

        $this->load->view('default/index', $this->data);
    }
// PO

    public function po(){
        $this->data['content'] = 'po';
        $this->data['page_title'] = 'Purchase Order';
        $this->data['warehouse'] = $this->whouse->get_warehouse_model();
        $this->data['project'] = $this->whouse->get_allproject_model();
        $this->data['items'] = $this->whouse->item_list_model();
        $this->data['suppliers'] = $this->whouse->get_suppliers_model();
        $this->data['pos'] = $this->whouse->get_allpo_model();
        $this->data['customjs'] = 'warehouse_temp/pojs';

        $this->load->view('default/index', $this->data);
    }

    public function get_item_uom(){
        echo json_encode($this->whouse->get_item_uom_model($this->input->post('item_id')));
    }

    public function get_allpo(){
        echo json_encode($this->whouse->get_allpo_model());
    }

    public function get_iteminventory(){
        echo json_encode($this->whouse->get_iteminventory_model2($this->input->post('item_id'), $this->input->post('warehouse_id')));

    }
    public function insert_po(){
        $this->load->helper('date');

        $po = array(
            'prf_id' => $this->input->post('prf_id'),
            'po_num' => $this->input->post('po_num'),
            'po_date' => $this->input->post('po_date'),
            'po_date_received' => $this->input->post('po_date_received'),
            'warehouse_id' => $this->input->post('warehouse_id'),
            'supplier_id' => $this->input->post('supplier_id'),
            'po_remark' => $this->input->post('po_remark'),
            'project_id' => $this->input->post('project_id'),
        );
        $total = 0;
        $po_id = $this->whouse->insert_po_model($po);

        foreach ($this->input->post('po_items') as $value) {
            $po_data = array(
                'po_id' => $po_id,
                'item_id' => $value['item_id'],
                'po_uom_id' => $value['po_uom_id'],
                // 'po_item_remark' => $value['po_item_remark'],
                'po_qty' => $value['po_qty'],
                // 'po_received' => $value['po_received'],
                'po_price' => $value['po_price'],
                'po_subtotal' => $value['po_subtotal'],
            );
            $this->whouse->insert_po_details_model($po_data);

    // RR - Inventory
            // $rr = array(
            //     'po_id' => $po_id,
            //     'non-vat_amount' => $this->input->post('non-vat_amount'),
            //     'invoice_number' => $this->input->post('invoice_number')
            // );
            // $this->whouse->insert_rr_model($rr);

            // $total += $value['po_subtotal'];
            // $item = $value['item_id'];
            // $warehouse = $this->input->post('warehouse_id');
            // $received = $value['po_received'];

            // $inventory = $this->whouse->get_iteminventory_model($item, $warehouse);
            // if (is_null($inventory)) {
            //     $data = array(
            //         'item_id' => $item,
            //         'warehouse_id' => $warehouse,
            //         'quantity' => $received,
            //         'last_updated' => date('Y-m-d',now())
            //     );
            //     $this->whouse->insert_iteminventory_model($data);
            // }else{
            //     $data = array(
            //         'item_id' => $item,
            //         'warehouse_id' => $warehouse,
            //         'quantity' => ($received + $inventory->quantity),
            //         'last_updated' => date('Y-m-d',now())
            //     );
            //     $this->whouse->update_itemqty_model($item, $warehouse, $data);
            // }
    // RR - Inventory end

            // $amount_data = array(
            //     'po_total' => $total
            // );
            // $this->whouse->update_poamount_model($po_id, $$amount_data);
    

        }
        echo json_encode($po_id);
    }

    public function get_onepo(){
        echo json_encode($this->whouse->get_onepo_model($this->input->post('po_id')));

    }



//RECEIVING
    public function receiving(){
        $this->data['content'] = 'receiving';
        $this->data['page_title'] = 'Receiving';
        $this->data['warehouse'] = $this->whouse->get_warehouse_model();
        $this->data['items'] = $this->whouse->item_list_model();
        $this->data['suppliers'] = $this->whouse->get_suppliers_model();
        $this->data['rr'] = $this->whouse->get_allreceiving_model();
        $this->data['customjs'] = 'warehouse_temp/receivingjs';

        $this->load->view('default/index', $this->data);
    }

    public function update_pod(){
        $pod_id = $this->input->post('pod_id');
        $data = array(
            // '' => $this->input->post('request_abbr'),
            'po_received' => $this->input->post('po_received'),
            'po_item_remark' => $this->input->post('po_item_remark'),
        );

        // insert_rr_model

        echo json_encode($this->whouse->update_pod_model($pod_id, $data));
    }

    public function update_receiving(){
        $this->load->helper('date');

        $data = array(
            'po_id' => $this->input->post('po_id'),
            'non_vat_amount' => $this->input->post('non_vat_amount'),
            'delivery_receipt_number' => $this->input->post('delivery_receipt_number'),
            'invoice_number' => $this->input->post('invoice_number'),
            'rr_date' => date('Y-m-d',now())
        );

        $rr = $this->whouse->insert_rr_model($data);
        echo json_encode($rr);

        foreach ($this->input->post('arr_data') as $value) {
              $rr_item = array(
                'po_received' => ($value['po_received'] + $value['pow_new_rcv']),
                'po_item_remark' => $value['po_item_remark'],
            );
            $this->whouse->update_pod_model($value['pod_id'], $rr_item);

            $rrd_data = array(
                'rr_id' => $rr,
                'po_id' => $this->input->post('po_id'),
                'pod_id' => $value['pod_id'],
                'item_id' => $value['item_id'],
                'qty_rcv' => $value['pow_new_rcv'],
                // 'rr_date' => date('Y-m-d',now())
            );
            $this->whouse->insert_rrdetail_model($rrd_data);

            // Newly Added
            $item = $value['item_id'];
            $warehouse = $this->input->post('warehouse_id');
            $received = $value['pow_new_rcv'];

            $inventory = $this->whouse->get_iteminventory_model($item, $warehouse);
            if (is_null($inventory)) {
                $data = array(
                    'item_id' => $item,
                    'warehouse_id' => $warehouse,
                    'quantity' => $received,
                    'last_updated' => date('Y-m-d',now())
                );
                $this->whouse->insert_iteminventory_model($data);
            }else{
                $data = array(
                    'item_id' => $item,
                    'warehouse_id' => $warehouse,
                    'quantity' => ($received + $inventory->quantity),
                    'last_updated' => date('Y-m-d',now())
                );
                $this->whouse->update_itemqty_model($item, $warehouse, $data);
            }
        }   

    }

    public function get_onerr(){
        echo json_encode($this->whouse->get_onerr_model($this->input->post('rr_id')));

    }


// ISSUANCE
    public function issuance(){
        $this->data['content'] = 'issuance';
        $this->data['page_title'] = 'Issuance';
        $this->data['customjs'] = 'warehouse_temp/issuancejs';

        $this->data['warehouse'] = $this->whouse->get_warehouse_model();
        $this->data['project'] = $this->whouse->get_allproject_model();
        $this->data['issuance'] = $this->whouse->get_allissuance_model();

        $this->load->view('default/index', $this->data);
    }

    public function get_warehouseitem(){
        echo json_encode($this->whouse->get_inventoryitems_model($this->input->post('warehouse_id')));
    }

    public function insert_issuance(){
        $this->load->helper('date');

        $issuance = array(
            'request_abbr' => $this->input->post('request_abbr'),
            'issuance_project' => $this->input->post('issuance_project'),
            'warehouse_id' => $this->input->post('warehouse_id'),
            'issuance_date' => $this->input->post('issuance_date'),
        );
        $issuance_id = $this->whouse->insert_issuance_model($issuance);

        foreach ($this->input->post('issuance_items') as $value) {
            $issuance_item = array(
                'issuance_id' => $issuance_id,
                'item_id' => $value['item_id'], 
                'qty' => $value['qty'], 
                'issuance_uom_id' => $value['issuance_uom_id'], 
                'issuance_detail_project' => $value['issuance_detail_project'], 
                'block' => $value['block'], 
                'lot' => $value['lot'], 
            );
            $this->whouse->insert_issuancedetail_model($issuance_item);

            $warehouse_id = $this->input->post('warehouse_id');
            $item = $value['item_id'];
            $qty = $value['qty'];

            $inventory = $this->whouse->get_iteminventory_model($item, $warehouse_id);

            if (is_null($inventory) || $inventory->quantity <= 0) {

            }else{
                $data = array(
                    // 'item_id' => $item,
                    // 'warehouse_id' => $warehouse_id,
                    'quantity' => ($inventory->quantity - $qty),
                    'last_updated' => date('Y-m-d',now())
                );
                $this->whouse->update_itemqty_model($item, $warehouse_id, $data);
            }
            
            
        }
        echo json_encode($issuance_id);
        

    }
        
    public function get_issuance(){
        echo json_encode($this->whouse->get_issuance_model($this->input->post('issuance_id')));

    }

// ITEMS
    public function iteminput(){
        $this->data['content'] = 'items';
        $this->data['page_title'] = 'Items Input';
        $this->data['customjs'] = 'warehouse_temp/itemsjs';

        $this->data['cat'] = $this->whouse->get_allcategories_model();
        $this->data['cat_sort'] = $this->whouse->get_allcategories_model();
        $this->data['uom'] = $this->whouse->get_alluom_model();
        $this->data['warehouse'] = $this->whouse->get_warehouse_model();

        $this->load->view('default/index', $this->data);
    }

    public function insert_item(){
        $this->load->helper('date');

        $item = array(
            'description' =>  $this->input->post('item_brand'). ' ' .$this->input->post('item_desc'). ' ' .$this->input->post('item_dimen'),
            'category_code' =>  $this->input->post('opt_item_cat'),
            'item_code' =>  $this->input->post('opt_item_cat'),
            'status_id' => 1
        );
        $item_id = $this->whouse->insert_item_model($item);
        $uom = array(
            'item_id' => $item_id,
            'uom_id' => $this->input->post('opt_item_uom')
        );
        echo json_encode($this->whouse->insert_uom_model($uom));

        // $rr = array(
        //     'po_id' => $po_id,
        //     'non-vat_amount' => $this->input->post('non-vat_amount'),
        //     'invoice_number' => $this->input->post('invoice_number')
        // );
        // $this->whouse->insert_rr_model($rr);

        // $total += $value['po_subtotal'];

        
        $warehouse = $this->input->post('opt_item_warehouse');
        $received = $this->input->post('item_qty_left');

        // $inventory = $this->whouse->get_iteminventory_model($item, $warehouse);
        // if (is_null($inventory)) {
        $data = array(
            'item_id' => $item_id,
            'warehouse_id' => $warehouse,
            'quantity' => $received,
            'last_updated' => date('Y-m-d',now())
        );
        $this->whouse->insert_iteminventory_model($data);

        // }else{
        //     $data = array(
        //         'item_id' => $item,
        //         'warehouse_id' => $warehouse,
        //         'quantity' => ($received + $inventory->quantity),
        //         'last_updated' => date('Y-m-d',now())
        //     );
        //     $this->whouse->update_itemqty_model($item, $warehouse, $data);
        // }

        // $amount_data = array(
        //     'po_total' => $total
        // );
        // $this->whouse->update_poamount_model($po_id, $$amount_data);


    }

    public function item_search(){
       echo json_encode($this->whouse->get_itemsearch_model($this->input->post('item_name')));
       
        
    }

 }
