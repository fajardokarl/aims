<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Attachmenttype_model extends CI_Model{
	public function insertAttach($info){
		$this->db->insert('attachment_type', $info);
	}

	public function updateAttach($info, $id){
		$this->db->where('attachment_type_id', $id);
		$this->db->update('attachment_type', $info);
	}

	public function getAttach(){
		$query = $this->db->get('attachment_type');
		return $query->result_array();
	}

	public function getAttachByID($id){
		$this->db->where('attachment_type_id', $id);
		$query = $this->db->get('attachment_type');
		return $query->result_array();
	}
}