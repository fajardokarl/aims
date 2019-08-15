<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contract_model extends CI_Model {


	public function __construct()
    {
        // call parent constructor
        parent::__construct();

    }
    
    function get_contracts_model(){ 
    	$this->db->select('*, a.contract_id AS new_contract_id');
        $this->db->from('contract a');
        $this->db->join('client b', 'a.client_id=b.client_id', 'inner');
        // $this->db->join('customer c', 'b.reference_id=c.customer_id', 'left');
        $this->db->join('person d', 'b.reference_id=d.person_id', 'left');
        $this->db->join('organization e', 'b.reference_id=e.organization_id', 'left');
        $this->db->join('lot f', 'a.lot_id=f.lot_id', 'left');
        // $this->db->join('agent g', 'a.agent_id=g.agent_id', 'left');
        $this->db->join('payment_scheme h', 'a.scheme_type_id=h.payment_scheme_id', 'left');
        $this->db->join('lot_price i', 'a.lot_id=i.lot_id', 'left');
        $this->db->join('contract_status j', 'a.contract_status_id=j.contract_status_id', 'left');
        // $this->db->where('a.contract_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

}