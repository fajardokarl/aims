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
   
  }