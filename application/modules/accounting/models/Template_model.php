<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Template_model extends CI_Model{
	public function insertTemplate($info){
		$this->db->insert('transaction_template', $info);
	}

	public function updateTemplate($info, $id){
		$this->db->where('transaction_template_id', $id);
		$this->db->update('transaction_template', $info);
	}

	public function checkAccountCode($code){
		$this->db->where('account_code', $code);
		$this->db->where('status_id', '1');
		$query = $this->db->get('account');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getTemplateByTransactionType($type){
		$this->db->where('transaction_type', $type);
		$query = $this->db->get('transaction_template');
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getTemplate(){
		$this->db->group_by('transaction_type');
		$this->db->order_by('transaction_type','asc');
		$this->db->order_by('drcr', 'desc');
		$query = $this->db->get('transaction_template');
		return $query->result_array();
	}

	public function getAccounts(){
		$query = $this->db->get('account');
		return $query->result_array();
	}
}