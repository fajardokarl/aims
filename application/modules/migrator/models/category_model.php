<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model{
	public function insertCategory($info){
		$data = array(
			'category_code' => $info['category_code'],
			'description' => $info['description'],
			'type' => $info['type']
			);

		$this->db->insert('category', $data);  
	}

	public function findCategory($code){
		$this->db->where('category_code', $code);
    $query = $this->db->get('category');

    if($query->num_rows() > 0)
    {
      return $query->row();
    } else {
       return false;
    }

	}
}