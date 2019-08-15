<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Glsupplier_model extends CI_Model{
	public function getSupplierGLInfo(){
		$query = $this->db->get('account_payable_vendor');
    return $query->result_array();
  }

  public function getNotDone(){
  	$this->db->where('done', 0);
  	$query = $this->db->get('account_payable_vendor');
  	return $query->result_array();
  }

  public function getNotDonePerson(){
  	$this->db->where('done', 0);
  	$this->db->where('type', 1);
  	$query = $this->db->get('account_payable_vendor');
  	return $query->result_array();
  }

  public function getNotDoneCompany(){
  	$this->db->where('done', 0);
  	$this->db->where('type', 2);
  	$query = $this->db->get('account_payable_vendor');
  	return $query->result_array();
  }

  public function getDoneCompany(){
  	$this->db->where('done', 1);
  	$this->db->where('type', 2);
  	$query = $this->db->get('account_payable_vendor');
  	return $query->result_array();
  }

  public function getDone(){
  	$this->db->where('done', 1);
  	$query = $this->db->get('account_payable_vendor');
  	return $query->result_array();
  }

  public function insSupplier($info){
  	$this->db->insert('supplier', $info);
  	return $this->db->insert_id();
  }

  public function insOrganization($info){
  	$this->db->insert('organization', $info);
  	return $this->db->insert_id();
  }

  public function findOrganization($name){
  	$this->db->where('organization_name', $name);
  	$query = $this->db->get('organization');

  	if($query->num_rows() > 0){
  		return $query->row_array();
  	} else {
  		return false;
  	}
  }

  public function findSupplierByName($name){
		$this->db->select('*');
		$this->db->from('supplier');
		$this->db->join('organization', "organization.organization_id = supplier.reference_id and supplier.client_type_id = '2'");
		$this->db->where('organization.organization_name', $name);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findPersonSupplierByName($last, $first){
		$query = $this->db->query("select * from supplier 
			inner join person on person.person_id = supplier.reference_id
			and supplier.client_type_id = '1' 
			where (person.lastname like ".'"'.$last.'"'." and person.firstname like ".'"'.$first.'")');
		if($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findSupplierGLInfo($supplierid){
		$this->db->where('supplier_id', $supplierid);
		$query = $this->db->get('supplier_glinfo');
		if($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findSupplierCompany(){
		$this->db->select('supplier.supplier_id, supplier.reference_id, organization.organization_name');
		$this->db->from('supplier');
		$this->db->join('organization', "organization.organization_id = supplier.reference_id and supplier.client_type_id = '2'");
		$query = $this->db->get();
		return $query->result_array();
	}


	public function insertSupplierGLInfo($info){
		$this->db->insert('supplier_glinfo',$info);
	}

	public function updateAPV($info,$id){
		$this->db->where('vendor_id', $id);
		$this->db->update('account_payable_vendor', $info);
	}

	public function checkMigrate(){
		$query = $this->db->query("select a.vendor_id, a.vendor_name, organization.organization_name as supplier_name 
			from account_payable_vendor a
			inner join supplier on supplier.supplier_id = a.supplier_id
			inner join organization on organization.organization_id = supplier.reference_id and supplier.client_type_id = '2'
			union 
			select a.vendor_id, a.vendor_name, concat(person.lastname,', ', person.firstname,' ', person.middlename) as supplier_name 
			from account_payable_vendor a
			inner join supplier on supplier.supplier_id = a.supplier_id
			inner join person on person.person_id = supplier.reference_id and supplier.client_type_id = '1'
			order by vendor_id");
		return $query->result_array();
	}

	
}