<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchaseorder_model extends CI_Model {
public function __construct()
    {
        // call parent constructor
        parent::__construct();
    }

    function get_verifies()
    {
        $this->db->select('*');
        $this->db->from('purchase_order po');
        $this->db->join('prf a', 'po.prf_id = a.prf_id', 'inner');
        $this->db->join('department b', 'b.department_id = a.department_id', 'inner');
        $this->db->join('document c', 'a.document_id = c.document_id', 'inner');
        $this->db->join('person d', 'a.requested_by_id = d.person_id', 'inner');
        // $this->db->join('purchase_order po', 'po.prf_id = a.prf_id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getSalesReportByDate($fromDate,$toDate){
        $this->db->trans_start();
        $this->db->select('*,a.prf_id AS POprf_id');
        // $this->db->from('purchase_order a');
        // $this->db->join('purchase_order_detail b', 'a.po_id=b.po_id', 'inner');
        // $this->db->join('prf c', 'a.prf_id=c.prf_id', 'inner');
        // $this->db->join('prf_detail d', 'c.prf_id=d.prf_id', 'inner');
        // $this->db->where('a.po_date >=', $fromDate);
        // $this->db->where('a.po_date <=', $toDate);


        $this->db->from('purchase_order a');
        $this->db->join('purchase_order_detail b', 'a.po_id=b.po_id', 'inner');
        $this->db->join('prf c', 'a.prf_id=c.prf_id', 'inner');       
        $this->db->join('department d', 'c.department_id=d.department_id', 'inner');       
        $this->db->where('a.po_date >=', $fromDate);
        $this->db->where('a.po_date <=', $toDate);

        $query = $this->db->get();
        return $query->result_array();
        $this->db->trans_complete();
    }


      function retrieve_po_report_details(){
        $this->db->trans_start();
        $this->db->select('*,a.prf_id AS POprf_id');      
        $this->db->from('purchase_order a');
        $this->db->join('purchase_order_detail b', 'a.po_id=b.po_id', 'inner');
        $this->db->join('prf c', 'a.prf_id=c.prf_id', 'left');
        $this->db->join('department d', 'c.department_id=d.department_id', 'left');
        $this->db->join('capex f', 'a.prf_id=f.prf_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
        $this->db->trans_complete();
    }

    function retrieve_po_details($po_id) {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('purchase_order AS po');
        $this->db->where('po.po_id =', $po_id);
        $this->db->join('purchase_order_detail pod', 'po.po_id=pod.po_id', 'inner');
        $this->db->join('item', 'pod.item_id=item.item_id', 'inner');
        $this->db->join('item_relationuom item_ruom', 'item_ruom.item_id=item.item_id', 'inner');
        $this->db->join('item_uommaster item_uom', 'item_ruom.uom_id=item_uom.uom_id', 'inner');
        $this->db->join('supplier sp', 'po.supplier_id=sp.supplier_id', 'inner');
        $this->db->join('person p', 'sp.reference_id=p.person_id', 'inner');
        $this->db->join('person_address pa', 'p.person_id=pa.person_id', 'inner');
        $this->db->join('address a', 'pa.address_id=a.address_id', 'inner');
        // $this->db->join('contact c', 'c.person_id=p.person_id', 'inner');
        $this->db->join('tax_type tt', 'tt.tax_type_id=sp.tax_type_id', 'inner');
        $this->db->join('employee e', 'e.employee_id=po.created_by_id', 'inner');
        $this->db->join('employee_department ed', 'ed.employee_id=e.employee_id', 'inner');
        $this->db->join('department dept', 'dept.department_id=ed.department_id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
        $this->db->trans_complete();
    }

    function retrieve_po_contact_details($po_id) {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('purchase_order AS po');
        $this->db->join('supplier sp', 'po.supplier_id=sp.supplier_id', 'inner');
        $this->db->join('person p', 'sp.reference_id=p.person_id', 'inner');
        $this->db->join('contact c', 'c.person_id=p.person_id', 'left');
        $this->db->where('po.po_id =', $po_id);
        $query = $this->db->get();
        return $query->result_array();
        $this->db->trans_complete();
    }

    function retrieve_po_item_availability($po_id) {
        $this->db->trans_start();
        $this->db->select('i.quantity,pod.po_qty');
        $this->db->from('purchase_order po');
        $this->db->join('purchase_order_detail pod', 'pod.po_id=po.po_id', 'inner');
        $this->db->join('item i', 'i.item_id=pod.item_id', 'inner');
        $this->db->where('po.po_id =', $po_id);
        $query = $this->db->get();
        return $query->result_array();
        $this->db->trans_complete();
    }

    function confirm_po($info, $po_id) {
        $this->db->where('po_id', $po_id);
        $this->db->update('purchase_order', $info);
    }

    function update_pod($info, $pod_id) {
        $this->db->where('pod_id', $pod_id);
        $this->db->update('purchase_order_detail', $info);
    }

    // function get_item_qty($item_id) {
    //     $this->db->trans_start();
    //     $this->db->select('quantity');
    //     $this->db->from('item');
    //     $this->db->where('item_id =', $item_id);
    //     $query = $this->db->get();
    //     return $query->row();
    //     $this->db->trans_complete();
    // }

    function update_item_qty($qty_received, $item_id) {
        $this->db->trans_start();
        $this->db->select('quantity');
        $this->db->from('item');
        $this->db->where('item_id =', $item_id);
        $item_qty = $this->db->get()->row();
        $this->db->trans_complete();
        $info = [
            'quantity' => $item_qty->quantity - $qty_received
        ];
        $this->db->trans_start();
        $this->db->where('item_id', $item_id);
        $this->db->update('item', $info);
        $this->db->trans_complete();
    }

    function headPO($data) {
        $this->db->select('*');
        $this->db->from('purchase_order');    
        // $this->db->join('person b', 'a.created_by_id = b.person_id', 'inner');  
        $this->db->where('po_id', $data);
        $query = $this->db->get();
        return $query->row();
    }

    function detailPO($data) {
        $this->db->select('*');
        $this->db->from('purchase_order_detail a');
        $this->db->join('item b', 'a.item_id = b.item_id', 'inner');
        $this->db->join('item_uommaster c', 'a.po_uom_id = c.uom_id', 'inner');
        $this->db->where('a.po_id', $data);
        $query = $this->db->get();
        return $query->result_array();
    }
   
  }