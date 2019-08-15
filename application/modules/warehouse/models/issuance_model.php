<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class issuance_model extends CI_Model {

    public function __construct()
    {
        // call parent constructor
        parent::__construct();
    }

    function get_verifies()
    {
        $this->db->select('*');
        $this->db->from('prf a');
        $this->db->join('department b', 'b.department_id = a.department_id', 'inner');
        $this->db->join('document c', 'a.document_id = c.document_id', 'inner');
        $this->db->join('person d', 'a.requested_by_id = d.person_id', 'inner');
        $this->db->join('purchase_order e', 'e.prf_id = a.prf_id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }


    /*function getOnePrf($po_id)
    {
     $this->db->select('*');
     $this->db->from('purchase_order a');
     $this->db->join('purchase_order_detail b', 'a.po_id = b.po_id', 'inner');
     $this->db->join('person c', 'a.created_by_id = c.person_id', 'inner');
     // $this->db->join('item c', 'b.item_id = c.item_id', 'inner'); 
     // $this->db->join('person g', 'a.requested_by_id = g.person_id', 'inner');
     // $this->db->join('department f', 'f.department_id = a.department_id', 'inner');
     // $this->db->join('project h', 'a.project_id = h.project_id', 'inner'); 
     $this->db->where('a.po_id =', $po_id);
     $query = $this->db->get();
     return $query->row();
    }*/

    function getOnePrf($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'a.prf_id = b.prf_id', 'inner');
     $this->db->join('person c', 'a.requested_by_id = c.person_id', 'inner');
     // $this->db->join('item c', 'b.item_id = c.item_id', 'inner'); 
     // $this->db->join('person g', 'a.requested_by_id = g.person_id', 'inner');
     // $this->db->join('department f', 'f.department_id = a.department_id', 'inner');
     // $this->db->join('project h', 'a.project_id = h.project_id', 'inner'); 
     $this->db->where('a.prf_id =', $prf_id);
     $query = $this->db->get();
     return $query->row();
    }

    /*function get_details_messages($po_id)
    {
     $this->db->select('*');
     $this->db->from('purchase_order a');
     $this->db->join('purchase_order_detail b', 'b.po_id = a.po_id', 'inner');
     $this->db->join('item c', 'b.item_id = c.item_id', 'inner');
     $this->db->join('item_uommaster e', 'b.po_uom_id = e.uom_id', 'inner');
     // $this->db->join('warehouse f', 'b.deliver = f.warehouse_id', 'inner');   
     $this->db->where('b.po_id', $po_id);
     $query = $this->db->get();
     return $query->result_array();
     }*/

     function get_details_messages($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->join('item c', 'b.item_id = c.item_id', 'inner');
     $this->db->join('item_uommaster e', 'b.prf_uom_id = e.uom_id', 'inner');
     $this->db->join('warehouse f', 'b.deliver = f.warehouse_id', 'inner');   
     $this->db->where('b.prf_id', $prf_id);
     $query = $this->db->get();
     return $query->result_array();
     }

    function get_po_id($prf_id)
    {
        $this->db->select('po_id');
        $this->db->from('purchase_order');
        $this->db->where('prf_id =', $prf_id);
        $query = $this->db->get();
        return $query->row();
    }

}