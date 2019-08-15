<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suppliercategory_model extends CI_Model{
	

	public function insertSupplierCategory($info){
		$data = array(
			'supplier_id' => $info['supplier_id'],
			'category_code' => $info['category_code'],
			'vatable' => $info['vatable'],
			'status_id' => $info['status_id']
			);

		$this->db->insert('supplier_category', $data);
	}//end function

	public function findSupplierCategoryByIds($id,$code){
		$this->db->where('supplier_id', $id);
		$this->db->where('category_code', $code);
		$query = $this->db->get('supplier_category');

		if($query->num_rows() > 0)
    {
      return $query->row();
    } else {
       return false;
    }
	}//end function
}