<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Journalentry_model extends CI_Model {

	public function insertTransaction($info){
		$this->db->insert('transaction', $info);
		return $this->db->insert_id();
	}

	public function insertTransactionDetail($info){
		$this->db->insert('transaction_detail', $info);
	}

	public function updateTransaction($info, $id){
		$this->db->where('transaction_id', $id);
		$this->db->update('transaction', $info);
	}

	public function updateTransactionDetail($info, $id){
		$this->db->where('transaction_detail_id', $id);
		$this->db->update('transaction_detail', $info);
	}

	public function getJournal(){
		$this->db->select('*');
		$this->db->from('transaction');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getJournalByRange($begin, $end){
		if(empty($begin)){
			$begin = '0000-00-00 00:00:00';
		}
		if(empty($end)){
			$end = '0000-00-00 00:00:00';
		}
		$this->db->where('encode_date >=', $begin);
		$this->db->where('encode_date <=', $end);
		$this->db->order_by('transaction_id','desc');
		$query = $this->db->get('transaction');
		return $query->result_array();
	}

	public function getMaxReference($prefix){
		$this->db->select('reference');
		$this->db->from('transaction');
		$this->db->where('book_prefix', $prefix);
		$this->db->order_by('transaction_id', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function setSubsidiaryTableByCode($code){
		$this->db->select("account_subsidiary.*");
		$this->db->from('account_subsidiary');
		$this->db->join('account', 'account.account_id = account_subsidiary.account_id', 'inner');
		$this->db->where('account.account_code', $code);
		$this->db->where('account.status_id', '1');
		$this->db->where('account_subsidiary.status_id', '1');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getTransactionByID($transactionid){
		$this->db->select('*');
		$this->db->from('transaction');
		$this->db->join('book_registers', 'transaction.book_code = book_registers.book_code','left');
		$this->db->where('transaction.transaction_id', $transactionid);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getTransactionDetailByID($transactionid){
		$this->db->select('*');
		$this->db->from('transaction_detail');
		$this->db->join('account','account.account_code = transaction_detail.account_code','left');
		$this->db->join('account_subsidiary', 'account_subsidiary.subsidiary_code = transaction_detail.subsidiary_code', 'left');
		$this->db->where('transaction_id', $transactionid);
		$this->db->order_by('transaction_detail_id', 'ASC');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getBookByBookCode($code){
		$this->db->where('book_code', $code);
		$query = $this->db->get('book_registers');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getAccountByCode($code){
		$this->db->where('account_code', $code);
		$this->db->where('status_id', '1');
		$query = $this->db->get('account');
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getSubsidiaryByCode($maincode, $subcode){
		$this->db->select("account_subsidiary.*");
		$this->db->from('account_subsidiary');
		$this->db->join('account', 'account.account_id = account_subsidiary.account_id', 'inner');
		$this->db->where('account.account_code', $maincode);
		$this->db->where('account_subsidiary.subsidiary_code', $subcode);
		$this->db->where('account.status_id', '1');
		$this->db->where('account_subsidiary.status_id', '1');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getCustomers(){
		$query = $this->db->query("select client.subsidiary_code, concat(COALESCE(person.lastname,''), ', ', COALESCE(person.firstname,''), ' ', COALESCE(person.middlename,'')) as customer_name
			from client 
			inner join person on person.person_id = client.reference_id and client.client_type_id = '1'
			union 
			select client.subsidiary_code, organization.organization_name as customer_name
			from client
			inner join organization on organization.organization_id = client.reference_id and client.client_type_id = '2'
			where client.status_id = '1'
			order by customer_name asc"
			);
		return $query->result_array();
	}

	public function getSuppliers(){
		$query = $this->db->query("select supplier.subsidiary_code, concat(person.lastname, ', ', person.firstname, ' ', person.middlename) as supplier_name
			from supplier
			inner join person on person.person_id = supplier.reference_id and supplier.client_type_id = '1'
			union
			select supplier.subsidiary_code, organization.organization_name as supplier_name
			from supplier
			inner join organization on organization.organization_id = supplier.reference_id and supplier.client_type_id = '2'
			where supplier.status_id = '1'");
		return $query->result_array();
	}

	public function getEmployees(){
		$this->db->select("employee.subsidiary_code, concat(person.lastname, ', ', person.firstname, ' ', person.middlename) as employee_name");
		$this->db->from('employee');
		$this->db->join('person', 'person.person_id = employee.person_id');
		$this->db->where('employee.status_id', '1');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getProjects(){
		$this->db->where('status_id', '1');
		$query = $this->db->get('project');
		return $query->result_array();
	}

	public function getDepartments(){
		$this->db->where('status_id', '1');
		$query = $this->db->get('department');
		return $query->result_array();
	}

	public function getBooks(){
		$query = $this->db->get('book_registers');
		return $query->result_array();
	}

	public function getAccount(){
		$this->db->where('status_id', '1');
		$query = $this->db->get('account');
		return $query->result_array();
	}

	public function getSubsidiary(){
		$this->db->where('status_id', '1');
		$query = $this->db->get('account_subsidiary');
		return $query->result_array();
	}

	public function getAccountSubsidiaryByAccountID($accountid){
		$this->db->where('account_id', $accountid);
		$this->db->where('status_id', '1');
		$query = $this->db->get('account_subsidiary');
		return $query->result_array();
	}
}