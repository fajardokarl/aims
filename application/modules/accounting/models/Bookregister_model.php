<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Bookregister_model extends CI_Model {
	public function insertBook($info){
		$this->db->insert('book_registers', $info);
	}

	public function updateBook($info, $id){
		$this->db->where('book_register_id', $id);
		$this->db->update('book_registers', $info);
	}

	public function checkSubCode($code, $id){
		$this->db->where('book_code', $code);
		$this->db->where('book_register_id <>', $id);
		$query = $this->db->get('book_registers');
		if($query->num_rows() > 0){
			return true;
		} else {
			return false;
		}
	}

	public function getBooks(){
		$query = $this->db->get('book_registers');
		return $query->result_array();
	}
}