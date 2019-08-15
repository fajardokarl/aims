<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Subsidiaryaccount_model extends CI_Model {
	public function updateCustomer($info, $id){
		$this->db->where('client_id', $id);
		$this->db->update('client', $info);
	}

	public function updateDepartment($info, $id){
		$this->db->where('department_id', $id);
		$this->db->update('department', $info);
	}

	public function updateSupplier($info, $id){
		$this->db->where('supplier_id', $id);
		$this->db->update('supplier', $info);
	}

	public function updateEmployee($info, $id){
		$this->db->where('employee_id', $id);
		$this->db->update('employee', $info);
	}

	public function updateProject($info, $id){
		$this->db->where('project_id', $id);
		$this->db->update('project', $info);
	}

	public function checkSubCode($tblname, $fldname, $subcode, $id, $recordid){
		$this->db->where($fldname, $subcode);
		$this->db->where($id, $recordid);
		$query = $this->db->get($tblname);
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getCustomers(){
		$query = $this->db->query("select client.client_id, client.subsidiary_code, concat(COALESCE(person.lastname, ''), ', ',COALESCE(person.firstname,''), ' ', COALESCE(person.middlename,'')) as customer_name, status.status_name
			from client
			inner join person on person.person_id = client.reference_id and client.client_type_id = '1'
			inner join status on client.status_id = status.status_id
			union 
			select client.client_id, client.subsidiary_code, organization.organization_name as customer_name, status.status_name
			from client 
			inner join organization on organization.organization_id = client.reference_id and client.client_type_id = '2' 
			inner join status on client.status_id = status.status_id
			order by client_id asc");
		return $query->result_array();
	}

	public function getDepartments(){
		$this->db->select('department.*, status.status_name');
		$this->db->from('department');
		$this->db->join('status','status.status_id = department.status_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function getSuppliers(){
		$query = $this->db->query("select supplier.supplier_id, supplier.subsidiary_code, concat(person.lastname,', ', person.firstname, ' ', person.middlename) as supplier_name, status.status_name
			from supplier 
			inner join person on person.person_id = supplier.reference_id and supplier.client_type_id = '1' 
			inner join status on status.status_id = supplier.status_id
			union 
			select supplier.supplier_id, supplier.subsidiary_code, organization.organization_name as supplier_name, status.status_name
			from supplier 
			inner join organization on organization.organization_id = supplier.reference_id and supplier.client_type_id = '2' 
			inner join status on status.status_id = supplier.status_id");
		return $query->result_array();
	}

	public function getEmployees(){
		$this->db->select("employee.employee_id, employee.subsidiary_code, concat(person.lastname, ', ',person.firstname, ' ',person.middlename) as employee_name, status.status_name");
		$this->db->from('employee');
		$this->db->join('person', 'person.person_id = employee.person_id');
		$this->db->join('status', 'status.status_id = employee.status_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getProjects(){
		$this->db->select('project.*, status.status_name');
		$this->db->from('project');
		$this->db->join('status','status.status_id = project.status_id');
		$query = $this->db->get();
		return $query->result_array();
	}
}