<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_model extends CI_Model{
	public function findSupplierByName($name){
		$this->db->select('*');
		$this->db->from('supplier');
		$this->db->join('organization', "organization.organization_id = supplier.reference_id and supplier.client_type_id = '2'");
		$this->db->where('organization.organization_name', $name);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		} else {
			return false;
		}
	}

	public function insertSupplier($info){
		$data = array(
			'client_type_id' => $info['client_type_id'],
			'reference_id' => $info['reference_id'],
			'status_id' => $info['status_id']
			);

		$this->db->insert('supplier', $data);
		return $this->db->insert_id();  
	}//end function

	public function findSupplierByIds($type,$id){
		$this->db->where('client_type_id', $type);
		$this->db->where('reference_id', $id);
		$query = $this->db->get('supplier');

		if($query->num_rows() > 0)
    {
      return $query->row();
    } else {
       return false;
    }
	}//end function

}//end class