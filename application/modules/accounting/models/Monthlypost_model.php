<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Monthlypost_model extends CI_Model{

	public function insertFiscalMonth($info){
		$this->db->insert('fiscal_year', $info);
	}

	public function updateFiscalMonth($info, $id){
		$this->db->where('fiscal_year_id', $id);
		$this->db->update('fiscal_year', $info);
	}

	public function findFiscalMonth($begin){
		$this->db->where('begin', $begin);
		$query = $this->db->get('fiscal_year');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function updateTransaction($info, $id){
		$this->db->where('transaction_id', $id);
		$this->db->update('transaction', $info);
	}

	public function getTransactionByRange($begin, $end){
		$this->db->where('encode_date >=', $begin);
		$this->db->where('encode_date <=', $end);
		$query = $this->db->get('transaction');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getTransactionOrderByStatus($begin, $end){
		$this->db->where('encode_date >=', $begin);
		$this->db->where('encode_date <=', $end);
		$this->db->order_by('post_status','asc');
		$this->db->order_by('transaction_id', 'asc');
		$query = $this->db->get('transaction');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getDraftTransactionByRange($begin, $end){
		$this->db->where('post_status', 'draft');
		$this->db->where('encode_date >=', $begin);
		$this->db->where('encode_date <=', $end);
		$query = $this->db->get('transaction');
		return $query->result_array();
	}

	public function getTransactionDetail($transactid){
		$this->db->where('transaction_id', $transactid);
		$query = $this->db->get('transaction_detail');
		if($query->num_rows() > 0){
			return $query->first_row('array');
		} else {
			return false;
		}
	}

	public function getTransSumCreditDebit($begin, $end){
		$this->db->select('a.transaction_id, (select (sum(b.debit)-sum(b.credit))  from transaction_detail b where b.transaction_id = a.transaction_id) as total');
		$this->db->from('transaction a');
		$this->db->where('a.post_status', 'draft');
		$this->db->where('a.encode_date >=', $begin);
		$this->db->where('a.encode_date <=', $end);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getFiscalYear(){
		$this->db->order_by('fiscal_year_id', 'desc');
		$query = $this->db->get('fiscal_year');
		return $query->result_array();
	}

	public function getTransactions(){
		$query = $this->db->get('transaction');
		return $query->result_array();
	}
}