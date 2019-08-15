<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chartofaccounts_model extends CI_Model {
	public function insertAccountSubsidiary($info){
		$this->db->insert('account_subsidiary', $info);
	}

	public function findAccountSubsidiary($info){
		$this->db->where('account_id',$info['account_id']);
		$this->db->where('subsidiary_description',$info['subsidiary_description']);
		$query = $this->db->get('account_subsidiary');

		if($query->num_rows() > 0){
			return $query->row();
		} else {
			return false;
		}
	}

	public function updateAccount($info, $id){
		$this->db->where('account_id', $id);
		$this->db->update('account', $info);
	}

	public function findAccountByCode($code){
		$this->db->where('account_code',$code);
		$query = $this->db->get('account');

		if($query->num_rows() > 0){
			return $query->row();
		} else {
			return false;
		}
	}

	public function getGluploading(){
		$query = $this->db->get('glchartforuploading');
		return $query->result_array();
	}

	public function findGluploading($code){
		$this->db->where('account_code', $code);
		$query = $this->db->get('account');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}
}