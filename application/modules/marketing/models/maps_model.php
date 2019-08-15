<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maps_model extends CI_Model {


	public function __construct()
    {
        // call parent constructor
        parent::__construct();

    }

    function all_lots_model(){
	    $this->db->select('*');
	    $this->db->from('lot a');
		$this->db->join('project c', 'c.project_id = a.project_id', 'left');
		$this->db->join('phase d', 'd.phase_id = a.phase_id', 'inner');
		$query = $this->db->get();
		return $query->result_array();
    }


    function get_lot_model($lotid){
        $this->db->select('*');
        $this->db->from('lot a');
        $this->db->join('project c', 'a.project_id = c.project_id', 'left');
        $this->db->join('phase d', 'a.phase_id = d.phase_id', 'left');
        $this->db->where('a.lot_id',$lotid);
        $query = $this->db->get();
        return $query->result_array();
    }

    function save_lot_info($id,$data){
        $this->db->trans_start();
        $this->db->where('lot_id', $id);
        $this->db->update('lot', $data);
        $this->db->trans_complete();
    }
}