<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logistic_dashboard extends CI_Model {


	public function __construct()
    {
        // call parent constructor
        parent::__construct();

    }

     function retrieve_po()
    {
    $this->db->select('*');
    $this->db->from('purchase_order a');
    // $this->db->join('purchase_order_detail b', 'a.po_id=b.po_id', 'inner');
    $this->db->join('person c', 'a.created_by_id=c.person_id', 'inner');

    $query = $this->db->get();
    return $query->result_array();
    }

    function reservationfees_total(){
    	$month = date('m');
    	$year = date('Y');
    	$this->db->select('SUM(reservation_fee) AS total_reserve', FALSE);
    	$this->db->from('contract a');
    	$this->db->where('YEAR(a.contract_date)', $year);
    	$this->db->where('MONTH(a.contract_date)', $month);
    	$query = $this->db->get();
        return $query->row();
    }

    function prf_count(){
    	$month = date('m');
    	$year = date('Y');
    	$this->db->select('prf_id');
    	$this->db->from('prf a');
		$this->db->where('YEAR(a.date_requested)', $year);
    	$this->db->where('MONTH(a.date_requested)', $month);
        $this->db->where('prf_status_id =', 1); 

    	$query = $this->db->get();
    	return $query->num_rows();
    }
      function ppr_count(){
        $month = date('m');
        $year = date('Y');
        $this->db->select('prf_id');
        $this->db->from('prf a');
        $this->db->where('YEAR(a.date_requested)', $year);
        $this->db->where('MONTH(a.date_requested)', $month);
        $this->db->where('prf_status_id =', 0); 

        $query = $this->db->get();
        return $query->num_rows();
    }

      function po_count(){
        $month = date('m');
        $year = date('Y');
        $this->db->select('po_id');
        $this->db->from('purchase_order a');
        $this->db->where('YEAR(a.po_date)', $year);
        $this->db->where('MONTH(a.po_date)', $month);    
        $query = $this->db->get();
        return $query->num_rows();
    }

    function all_prf_count(){    
        $this->db->select('prf_id');
        $this->db->from('prf a');
        // $this->db->where('prf_status_id =', 1); 
        $query = $this->db->get();
        return $query->num_rows();
    }


    function customer_count(){ 
    	$this->db->select('customer_id');
    	$this->db->from('customer a');
    	$query = $this->db->get();
    	return $query->num_rows();
    }

    function agent_count(){
    	$this->db->select('agent_id');
    	$this->db->from('agent a');
    	$this->db->where('status_id', 1);
    	$query = $this->db->get();
    	return $query->num_rows();
    }

    function top_agents(){
        $month = date('m');
    	$this->db->select('picture_url, lastname, firstname, middlename,SUM(total_contract_price) AS total, COUNT(*) as count' , FALSE);
    	$this->db->from('contract a');
    	$this->db->join('agent b', 'a.agent_id=b.agent_id', 'left');
    	$this->db->join('person c', 'b.person_id=c.person_id', 'left');
    	$this->db->where('a.agent_id !=', null);
    	$this->db->group_by('a.agent_id');
    	$this->db->order_by('total', 'desc'); 
        $this->db->where('MONTH(a.contract_date)', $month);
    	$query = $this->db->get();
        return $query->result_array();
    }

    function reservations_activity(){
        $month = date('m');
        $this->db->select('SUM(reservation_fee) AS reserve_fees, MONTH(a.contract_date) AS months, YEAR(a.contract_date) as year', FALSE);
        $this->db->from('contract a');
        $this->db->group_by(array('YEAR(a.contract_date)', 'MONTH(a.contract_date)'));
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function tcp_activity(){
        $month = date('m');
        $this->db->select('SUM(total_contract_price) AS total_tcp, MONTH(a.contract_date) AS months, YEAR(a.contract_date) as year', FALSE);
        $this->db->from('contract a');
        $this->db->group_by(array('YEAR(a.contract_date)', 'MONTH(a.contract_date)'));
        $query = $this->db->get();
        return $query->result_array();
    }
    
}






