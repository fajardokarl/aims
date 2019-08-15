<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Glcustomer_model extends CI_Model{
	public function insClientGlinfo($info){
		$this->db->insert('client_glinfo', $info);
	}

	public function insClient($info){
		$this->db->insert('client', $info);
		return $this->db->insert_id();
	}

	public function insCustomer($info){
		$this->db->insert('customer', $info);
	}

	public function insPerson($info){
		$this->db->insert('person', $info);
		return $this->db->insert_id();
	}

	public function insOrganization($info){
		$this->db->insert('organization', $info);
		return $this->db->insert_id(); 
	}

	public function findClientGlinfo($clientid){
		$this->db->where('client_id', $clientid);
		$query = $this->db->get('client_glinfo');
		if($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findPersonClient($last, $first){
		$this->db->select('*');
		$this->db->from('client');
		$this->db->join('person', "person.person_id = client.reference_id and client.client_type_id = '1'");
		$this->db->where('person.lastname', $last);
		$this->db->where('person.firstname', $first);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return false;
		}
	}
	public function findCompanyClient($name){
		$this->db->select('*');
		$this->db->from('client');
		$this->db->join('organization',"organization.organization_id = client.reference_id 
			and client.client_type_id = '2'");
		$this->db->where('organization.organization_name', $name);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findCustomer($perid){
		$this->db->where('person_id', $perid);
		$query = $this->db->get('customer');

		if($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findPerson($last, $first){
		$this->db->where('lastname', $last);
		$this->db->where('firstname', $first);
		$query = $this->db->get('person');

		if($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return false;
		}
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

	public function getNotDonePerson(){
		$this->db->where('done', 0);
		$this->db->where('type', 1);
		$query = $this->db->get('account_receivable_customer');
		return $query->result_array();
	}

	public function getNotDoneCompany(){
		$this->db->where('done', 0);
		$this->db->where('type', 2);
		$query = $this->db->get('account_receivable_customer');
		return $query->result_array();
	}

	public function getWasha(){
		$query = $this->db->query("select customer_name as vendor_name, 
			gl_sales_account as expense_account, done, type, client_id as supplier_id
			from account_receivable_customer");
		return $query->result_array();
	}

	public function updARC($info, $id){
		$this->db->where('customer_id', $id);
		$this->db->update('account_receivable_customer', $info);
	}

	public function getMigrate(){
		$query = $this->db->get('account_receivable_customer');
		return $query->result_array();
	}

	public function checkMigrate(){
		$query = $this->db->query("select a.customer_id, a.customer_name, a.type, organization.organization_name as supplier_name 
			from account_receivable_customer a
			inner join client on client.client_id = a.client_id
			inner join organization on organization.organization_id = client.reference_id and client.client_type_id = '2'
			union 
			select a.customer_id, a.customer_name, a.type, concat(person.lastname,', ', person.firstname,' ', person.middlename,' ', IFNULL(person.suffix,'')) as supplier_name 
			from account_receivable_customer a
			inner join client on client.client_id = a.client_id
			inner join person on person.person_id = client.reference_id and client.client_type_id = '1'");
			//order by customer_id");
		return $query->result_array();
	}
}