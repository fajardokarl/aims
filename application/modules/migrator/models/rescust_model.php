<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rescust_model extends CI_Model{

	public function deleteResCustById($id){
		$this->db->where('CustID', $id);
		$this->db->delete('rescust');
	}


}