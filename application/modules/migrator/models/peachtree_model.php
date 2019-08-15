<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Peachtree_model extends CI_Model{
	public function getPaymentRecord(){
		$query = $this->db->get('pt_accpay_payment');
		return $query->result_array();
	}

	public function getGLConverter(){
		$query = $this->db->get('pt_legacy_converter');
		return $query->result_array();
	}

	public function getPTGeneralJournal(){
		$query = $this->db->select('*')
			->from('peachtree_tempgeneraljournal')
			->get();
		return $query->result_array();
	}
}