<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class report_model extends CI_Model {


	public function __construct()
    {
        // call parent constructor
        parent::__construct();

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

    function get_allpo_model(){
        $this->db->select('*');
        $this->db->from('purchase_order a');
        $this->db->join('supplier b', 'a.supplier_id = b.supplier_id', 'inner');
        $this->db->join('organization c', 'b.reference_id = c.organization_id', 'inner');
        $this->db->where('po_num !=', null);
        $query = $this->db->get();
        return $query->result_array();
    }


      function retrieve_po_report_details(){
        $this->db->trans_start();
        $this->db->select('*,a.prf_id AS POprf_id');      
        $this->db->from('purchase_order a');
        $this->db->join('purchase_order_detail b', 'a.po_id=b.po_id', 'inner');
        $this->db->join('prf c', 'a.prf_id=c.prf_id', 'left');
        $this->db->join('department d', 'c.department_id=d.department_id', 'left');
        $this->db->join('item e', 'b.item_id=e.item_id', 'left');
        $this->db->join('capex f', 'a.prf_id=f.prf_id', 'left');

        // $this->db->join('canvass_detail e', 'a.prf_id=e.prf_id', 'inner');

        // $this->db->where('e.is_approved',1);
        // $this->db->join('prf d', 'a.prf_id=d.prf_id', 'left');
        // $this->db->join('prf_detail d', 'c.prf_id=d.prf_id', 'inner');
        // $this->db->join('canvass_detail e', 'c.prf_id=e.prf_id', 'inner');
        //$this->db->join('prf_detail d', 'c.prf_id=d.prf_id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
        $this->db->trans_complete();
    }

    function retrieve_po_details($po_id) {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('purchase_order po');
        $this->db->where('po.po_id =', $po_id);
        $this->db->join('prf', 'prf.prf_id=po.prf_id', 'right');
        $this->db->join('purchase_order_detail pod', 'po.po_id=pod.po_id', 'inner');
        $this->db->join('item', 'pod.item_id=item.item_id', 'inner');
        $this->db->join('item_relationuom item_ruom', 'item_ruom.item_id=item.item_id', 'inner');
        $this->db->join('item_uommaster item_uom', 'item_ruom.uom_id=item_uom.uom_id', 'inner');
        $this->db->join('supplier sp', 'po.supplier_id=sp.supplier_id', 'inner');
        $this->db->join('organization org', 'org.organization_id=sp.reference_id', 'inner');
        $this->db->join('customer cs', 'cs.customer_id=sp.reference_id', 'inner');
        $this->db->join('client_type cp', 'cp.client_type_id=sp.client_type_id', 'inner');
        $this->db->join('person p', 'cs.person_id=p.person_id', 'inner');
        $this->db->join('person_address pa', 'p.person_id=pa.person_id', 'inner');
        $this->db->join('address a', 'pa.address_id=a.address_id', 'inner');
        $this->db->join('organization_address org_a', 'org.organization_id = org_a.id', 'left');
        $this->db->join('address a2', 'org_a.address_id = a2.address_id', 'left');
        $this->db->join('address_city ac', 'a.city_id = ac.address_city_id', 'left');
        // $this->db->join('contact c', 'c.person_id=p.person_id', 'left');
        $this->db->join('tax_type tt', 'tt.tax_type_id=sp.tax_type_id', 'inner');
        // $this->db->join('receiving_report rr', 'rr.po_id=po.po_id', 'left');
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

    function retrieve_po_rr_details($po_id) {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('receiving_report rr');
        $this->db->join('purchase_order po', 'po.po_id=rr.po_id', 'inner');
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

    function cancel_po($info, $po_id) {
        $this->db->where('po_id', $po_id);
        $this->db->update('purchase_order', $info);
    }

    function update_pod($info, $pod_id) {
        $this->db->where('pod_id', $pod_id);
        $this->db->update('purchase_order_detail', $info);
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

    function generateReceivingReport($data) {
        $this->db->trans_start();
        $this->db->insert('receiving_report', $data);
        $rr_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $rr_id;
    }

    function getRR($po_id) {
        $this->db->select('rr_id');
        $this->db->from('receiving_report');
        $this->db->where('po_id', $po_id);
        $query = $this->db->get();
        return $query->row();
    }

    function updatePOMod($po_id, $info) {
        $this->db->where('po_id', $po_id);
        $this->db->update('purchase_order', $info);
    }

    function update_rr_upon_confirmation($info, $rr_id) {
        $this->db->where('rr_id', $rr_id);
        $this->db->update('receiving_report', $info);
    }
   
  }



  