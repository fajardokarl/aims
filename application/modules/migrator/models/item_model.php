<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_model extends CI_Model{
	public function insertItem($info){
		$this->db->insert('item', $info);
		//return $this->db->insert_id();  
	}

	public function insertItemRelationUOM($info){
		$this->db->insert('item_relationuom', $info);
	}

	public function findItem($name){
		$this->db->where('description', $name);
    $query = $this->db->get('item');

    if($query->num_rows() > 0){
      return $query->row_array();
    } else {
      return false;
    }
	}


	public function findItemByLegacyID($id){
		$this->db->where('legacy_itemid', $id);
		$query = $this->db->get('item');

		if($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findItemUOMMaster($name){
		$this->db->where('uom_name', $name);
		$query = $this->db->get('item_uommaster');
		if($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findItemUOMMasterByLegacyID($id){
		$this->db->where('legacy_uomid', $id);
		$query = $this->db->get('item_uommaster');
		if($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function updateItemUOMMaster($info, $id){
		$this->db->where('uom_id', $id);
		$this->db->update('item_uommaster', $info);
	}
}