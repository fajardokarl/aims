<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model{

	public function insertAccount($info){
		$this->db->insert('account',$info);
		return $this->db->insert_id();
	}

	public function insertSubAccount($info){
		$this->db->insert('account_subsidiary', $info);
	}

	public function updateAccount($info, $id){
		$this->db->where('account_id', $id);
		$this->db->update('account', $info);
	}

	public function updateSubAccount($info, $id){
		$this->db->where('account_subsidiary_id', $id);
		$this->db->update('account_subsidiary', $info);
	}

	public function deleteAccount($info, $id){
		$this->db->where('account_id', $id);
		$this->db->update('account', $info);
	}

	public function deleteSubAccount($info, $id){
		$this->db->where('account_subsidiary_id', $id);
		$this->db->update('account_subsidiary', $info);
	}

	public function checkSubCode($subcode, $id){
		$this->db->where('account_code', $subcode);
		$this->db->where('account_id <>', $id);
		$query = $this->db->get('account');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/*public function checkSubCodeSub($code, $id, $accountid){

	}*/

	public function getAccountByID($id){
		$this->db->where('account_id',$id);
		$query = $this->db->get('account');
		return $query->result_array();
	}

	public function getSubAccountByID($id){
		$this->db->where('account_id', $id);
		$query = $this->db->get('account_subsidiary');
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getAccounts(){
		$query = $this->db->get('account');
		return $query->result_array();
	}
}