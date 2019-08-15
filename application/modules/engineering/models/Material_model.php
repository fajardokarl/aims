<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Material_model extends CI_Model {
	public function __construct()
    {
        // call parent constructor
        parent::__construct();

    }
    // SELECTS
    function item_list_model(){
    	$this->db->select('*');
    	$this->db->from('item');
      	$query = $this->db->get();
      	return $query->result_array();
    }

    function bom_list_model(){
        $this->db->select('*');
        $this->db->from('bom a');
        $this->db->join('lot b', 'b.lot_id = a.lot_id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }

    function project_list_model(){
        $this->db->select('*');
        $this->db->from('project');
        $query = $this->db->get();
        return $query->result_array();
    }

    function lots_list_model(){
        $this->db->select('*');
        $this->db->from('lot');
        $query = $this->db->get();
        return $query->result_array();
    }

    function uom_list_model(){
        $this->db->select('*');
        $this->db->from('item_uommaster');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_item_uom_model($id){
        $this->db->select('*');
        $this->db->from('item_relationuom a');
        $this->db->join('item b', 'b.item_id = a.item_id', 'inner');
        $this->db->join('item_uommaster c', 'c.uom_id = a.uom_id', 'inner');
        $this->db->where('a.item_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_bom_model($id){
        $this->db->select('*');
        $this->db->from('bom a');
        $this->db->join('bom_detail b', 'b.bom_id = a.bom_id', 'inner');
        $this->db->join('item c', 'c.item_id = b.item_id', 'inner');
        $this->db->join('item_relationuom d', 'd.item_id = c.item_id', 'inner');
        $this->db->join('item_uommaster e', 'd.uom_id = e.uom_id', 'inner');
        $this->db->join('construction_activity f', 'f.construction_act_id = b.construction_act_id', 'inner');
        $this->db->join('construction_description g', 'g.construction_desc_id = b.construction_desc_id', 'inner');
        $this->db->join('lot h', 'h.lot_id = a.lot_id', 'inner');
        $this->db->where('b.bom_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function construct_desc_model(){
        $this->db->select('*');
        $this->db->from('construction_description');
        $query = $this->db->get();
        return $query->result_array();
    }

    function construct_activity_model(){
        $this->db->select('*');
        $this->db->from('construction_activity');
        $query = $this->db->get();
        return $query->result_array();
    }

        function get_proj_lots_model($id){
        $this->db->select('*');
        $this->db->from('lot a');
        $this->db->where('project_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    // INSERTS

    function insert_bom_model($data){
        $this->db->trans_start();
        $this->db->insert('bom', $data);
        $bom = $this->db->insert_id();
        $this->db->trans_complete();
        return $bom;
    }

    function insert_bom_details_model($data){
        $this->db->trans_start();
        $this->db->insert('bom_detail', $data);
        $this->db->trans_complete();
    }

}