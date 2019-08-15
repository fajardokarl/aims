<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_model extends CI_Model{
	function insertSupplier($info){
		$this->db->insert('supplier', $info);
	}


	function updateSupplier($info, $id){
		$this->db->where('supplier_id', $id);
		$this->db->update('supplier', $info);
	}



	function getTypeBySupplierID($id){
		$this->db->select('client_type_id');
		$this->db->from('supplier');
		$this->db->where('supplier_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	function getPersonSupplierByID($id){
		$this->db->select("supplier.supplier_id as supplier_id, supplier.client_type_id as client_type_id, supplier.reference_id as reference_id, concat(person.lastname,', ', person.firstname,' ', person.middlename) as supplier_name, supplier.status_id as status_id, supplier.vatable");
			$this->db->from('supplier');
			$this->db->join('person', 'person.person_id = supplier.reference_id');
			$this->db->where('supplier.supplier_id', $id);
			$query = $this->db->get();
			return $query->result_array();
	}

	function getOrganizationSupplierByID($id){
		$this->db->select("supplier.supplier_id as supplier_id, supplier.client_type_id as client_type_id, supplier.reference_id as reference_id, organization.organization_name as supplier_name, supplier.status_id as status_id, supplier.vatable");
			$this->db->from('supplier');
			$this->db->join('organization', 'organization.organization_id = supplier.reference_id');
			$this->db->where('supplier.supplier_id', $id);
			$query = $this->db->get();
			return $query->result_array();
	}

	function getSupplier(){
		$query = $this->db->query("select supplier.supplier_id, concat(person.lastname,', ', person.firstname,' ', person.middlename) as supplier_name, client_type.client_type_name as supplier_type, status.status_name from supplier 
			inner join person on supplier.client_type_id= '1' and supplier.reference_id = person.person_id
			inner join client_type on supplier.client_type_id = client_type.client_type_id 
			inner join status on status.status_id = supplier.status_id
			UNION
			select supplier.supplier_id, organization.organization_name as supplier_name, client_type.client_type_name as supplier_type, status.status_name from supplier 
			inner join organization on supplier.client_type_id = '2' and supplier.reference_id = organization.organization_id
			inner join client_type on supplier.client_type_id = client_type.client_type_id
			inner join status on status.status_id = supplier.status_id
			order by supplier_id");
		return $query->result_array();
	}

	function getType(){
		$this->db->where('status_id', 1);
		$query = $this->db->get('client_type');
		return $query->result_array();
	}
	
	function insertPerson($info){
		$this->db->insert('person', $info);
		return $this->db->insert_id();
	}

	function updatePersonByID($info, $id){
		$this->db->where('person_id', $id);
		$this->db->update('person', $info);
	}

	function getPersonByID($id){
		$this->db->where('person_id', $id);
		$query = $this->db->get('person');
		return $query->result_array();
	}

	function getOptionPerson(){
		$query = $this->db->query("select person.person_id as reference_id, concat(person.lastname,', ', person.firstname,' ', person.middlename) as supplier_name from person where not exists ( select 0 from supplier where supplier.client_type_id = '1' and person.person_id = supplier.reference_id) order by supplier_name");
			return $query->result_array();
	}

	function insertOrganization($info){
		$this->db->insert('organization', $info);
		return $this->db->insert_id();
	}

	function updateOrganizationByID($info, $id){
		$this->db->where('organization_id', $id);
		$this->db->update('organization', $info);
	}

	function getOrganization(){
		$this->db->where('status_id', '1');
		$query = $this->db->get('organization');
		return $query->result_array();
	}

	function getOrganizationByID($id){
		$this->db->where('organization_id', $id);
		$query = $this->db->get('organization');
		return $query->result_array();
	}

	function getOptionOrganization(){
		$query = $this->db->query("select organization.organization_id as reference_id, organization.organization_name as supplier_name from organization where organization.status_id = '1' and not exists (select 0 from supplier where supplier.client_type_id = '2' and organization.organization_id = supplier.reference_id) order by supplier_name");
			return $query->result_array();
	}

	function getPersonContactInfo($personid){
		$this->db->where('person_id', $personid);
		$query = $this->db->get('contact');

		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return '';
		}
	}

	function getCompanyContactInfo($organizationid){
		$this->db->select('*');
		$this->db->from('organization_contact');
		$this->db->join('contact', 'contact.contact_id = organization_contact.contact_id');
		$this->db->where('organization_contact.organization_id', $organizationid);
		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return '';
		}
	}

	function insertPersonContact($info){
		$this->db->insert('contact', $info);
	}

	function insertOrganizationContact($info, $id){
		$this->db->insert('contact', $info);
		$contactid = $this->db->insert_id();

		$data = array(
			'organization_id' => $id,
			'contact_id' => $contactid,
			'status_id' => '1'
		);
		$this->db->insert('organization_contact', $data);
	}

	function updateContactByID($info, $id){
		$this->db->where('contact_id', $id);
		$this->db->update('contact', $info);
	}

	function getContactType(){
		$query = $this->db->query("select contact_type_id, contact_type_name from contact_type where status_id='1'");
		return $query->result_array();
	}

	function getCivilStatus(){
		$query = $this->db->get('civil_status');
		return $query->result_array();
	}

	function insertAddress($info){
		$this->db->insert('address', $info);
		return $this->db->insert_id();
	}

	function insertPersonAddress($info){
		$this->db->insert('person_address', $info);
	}

	function insertOrganizationAddress($info){
		$this->db->insert('organization_address', $info);
	}

	function updateAddressByID($info, $id){
		$this->db->where('address_id', $id);
		$this->db->update('address', $info);
	}

	function getCompanyAddressInfo($id){
		$this->db->select('*');
		$this->db->from('organization_address');
		$this->db->join('address', 'address.address_id = organization_address.address_id');
		$this->db->where('organization_address.organization_id', $id);
		$query = $this->db->get();

		if($query->num_rows() > 0)
    {
      return $query->result_array();
    } else {
       return ' ';
    }
	}

	function getPersonAddressInfo($id){
		$this->db->select('*');
		$this->db->from('person_address');
		$this->db->join('address', 'address.address_id = person_address.address_id');
		$this->db->where('person_address.person_id', $id);
		$query = $this->db->get();

		if($query->num_rows() > 0)
    {
      return $query->result_array();
    } else {
       return ' ';
    }
	}

	function getCompanyAddress($id){
		$this->db->where('organization_id', $id);
		$query = $this->db->get('organization_address');
		return $query->result_array();
	}

	function getAddressType(){
		$query = $this->db->get('address_type');
		return $query->result_array();
	}

	function getCountry(){
		$query = $this->db->get('address_country');
		return $query->result_array();
	}

	function getProvince(){
		$query = $this->db->get('address_province');
		return $query->result_array();
	}

	function getCity(){
		$query = $this->db->get('address_city');
		return $query->result_array();
	}
}