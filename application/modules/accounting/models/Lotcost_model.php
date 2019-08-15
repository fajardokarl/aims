<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Lotcost_model extends CI_Model{

	public function insertLotCost($info){
		$this->db->insert('lot_cost', $info);
	}

	public function updateLotCost($info, $id){
		$this->db->where('lot_cost_id', $id);
		$this->db->update('lot_cost', $info);
	}

	public function getLotCostByID($id){
		$this->db->select('b.project_name, c.phase_name, a.* ');
		$this->db->from('lot_cost a');
		$this->db->join('project b', 'b.project_id = a.project_id');
		$this->db->join('phase c', 'c.phase_id = a.phase_id', 'left');
		$this->db->where('a.lot_cost_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getPhases(){
		$query = $this->db->get('phase');
		return $query->result_array();
	}

	public function getProjects(){
		$query = $this->db->get('project');
		return $query->result_array();
	}

	public function getLotCost(){
		$this->db->select('b.project_name as project, c.phase_name as phase, monthname(concat(a.cost_year,"-",a.cost_month,"-01")) as month, a.lot_cost_id, a.cost_year, a.lot_cost, a.devt_cost, a.xu_share, a.house_cost, a.tucked_in_share, a.transfer_fee');
		$this->db->from('lot_cost a');
		$this->db->join('project b', 'b.project_id = a.project_id');
		$this->db->join('phase c', 'c.phase_id = a.phase_id', 'left');
		$this->db->order_by('lot_cost_id','desc');
		$query = $this->db->get();
		return $query->result_array();
	}
}