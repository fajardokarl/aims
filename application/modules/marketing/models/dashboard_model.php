<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {


	public function __construct()
    {
        // call parent constructor
        parent::__construct();

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

    function reserve_count(){
    	$month = date('m');
    	$year = date('Y');
    	$this->db->select('contract_id');
    	$this->db->from('contract a');
		$this->db->where('YEAR(a.contract_date)', $year);
    	$this->db->where('MONTH(a.contract_date)', $month);
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
    
    function get_survey_model(){
        $this->db->select('COUNT(reason_price) as count_reason_price, COUNT(reason_location) as count_reason_location, COUNT(reason_design) as count_reason_design, COUNT(reason_developer) as count_reason_developer, COUNT(reason_others) as count_reason_others, COUNT(source_flyers) as count_source_flyers, COUNT(source_refer) as count_source_refer, COUNT(source_invitation) as count_source_invitation, COUNT(source_billboard) as count_source_billboard, COUNT(source_magazine) as count_source_magazine, COUNT(source_activity) as count_source_activity, COUNT(source_online) as count_source_online, COUNT(source_others) as count_source_others');
        $this->db->from('client a');
        $this->db->where('reason_price', 1);
        $this->db->where('reason_location', 1);
        $this->db->where('reason_design', 1);
        $this->db->where('reason_developer', 1);
        $this->db->where('reason_others', 1);
        $this->db->where('source_flyers', 1);
        $this->db->where('source_refer', 1);
        $this->db->where('source_invitation', 1);
        $this->db->where('source_billboard', 1);
        $this->db->where('source_magazine', 1);
        $this->db->where('source_activity', 1);
        $this->db->where('source_online', 1);
        $this->db->where('source_others', 1);
        $query = $this->db->get();
        return $query->result_array();

    }
}






