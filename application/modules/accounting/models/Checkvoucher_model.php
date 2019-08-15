<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Checkvoucher_model extends CI_Model{

	public function insertCV($info){
		$this->db->insert('check_voucher', $info);
		return $this->db->insert_id();
	}

	public function insertCVAction($info){
		$this->db->insert('check_voucher_action', $info);
	}

	public function insertCVDetail($info){
		$this->db->insert('check_voucher_detail', $info);
	}

	public function updateCV($info, $id){
		$this->db->where('check_voucher_id', $id);
		$this->db->update('check_voucher', $info);
	}

	public function updateCVDetail($info, $id){
		$this->db->where('check_voucher_detail_id', $id);
		$this->db->update('check_voucher_detail', $info);
	}

	public function getEmployees(){
		$this->db->select("a.*, concat(b.lastname, ', ',b.firstname, ' ',b.middlename,' ', b.suffix) as employee");
		$this->db->from('employee a');
		$this->db->join('person b','b.person_id = a.person_id');
		$this->db->where('a.status_id','1');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getBanks(){
		$query = $this->db->get('bank');
		return $query->result_array();
	}

	public function getRecipient($documentcode, $rolecode){
		$this->db->select('employee.employee_id');
		$this->db->from('user_role');
		$this->db->join('user','user.user_id = user_role.user_id');
		$this->db->join('employee','employee.person_id = user.person_id');
		$this->db->where('user_role.document_code',$documentcode);
		$this->db->where('user_role.role_code', $rolecode);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function  getCheckVoucherByRange($start, $end){
		$this->db->select("a.*, (select bank_name from bank where bank.bank_id = a.bank_id) as bank_name, (select concat(b.lastname, ', ', b.firstname, ' ', b.middlename, ' ', b.suffix) from person b inner join employee on employee.person_id = b.person_id where a.prepared_by = employee.employee_id) as prepared");
		$this->db->from('check_voucher a');
		$this->db->where('check_voucher_date >=', $start);
		$this->db->where('check_voucher_date <=', $end);
		$this->db->order_by('check_voucher_id','DESC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getCheckVoucher(){
		$this->db->select("a.*, c.bank_name, (select concat(b.lastname, ', ', b.firstname, ' ', b.middlename, ' ', b.suffix) from person b inner join employee on employee.person_id = b.person_id where a.prepared_by = employee.employee_id) as prepared");
		$this->db->from('check_voucher a');
		$this->db->join('bank c','c.bank_id = a.bank_id', 'left');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getCVViewByID($id){
		$this->db->select("a.*, c.bank_name, c.account_number, (select concat(b.lastname, ', ', b.firstname, ' ', b.middlename, ' ', b.suffix) from person b inner join employee on employee.person_id = b.person_id where a.prepared_by = employee.employee_id) as prepared");
		$this->db->from('check_voucher a');
		$this->db->join('bank c', 'c.bank_id = a.bank_id', 'left');
		$this->db->where('a.check_voucher_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getCVDetailViewByID($id){
		$this->db->where('check_voucher_id', $id);
		$query = $this->db->get('check_voucher_detail');
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getCVActionViewByID($id){
		$this->db->select("a.*, (select concat(b.lastname,', ',b.firstname, ' ', b.middlename,' ', b.suffix) from person b inner join employee on employee.person_id = b.person_id where a.action_employee_id = employee.employee_id) as employee_name");
		$this->db->from('check_voucher_action a');
		$this->db->where('check_voucher_id', $id);
		$this->db->order_by('cv_action_id', 'desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getUserRole($id, $userid, $documentcode){
		$this->db->select('a.*, b.action_status');
		$this->db->from('user_role a');
		$this->db->join('check_voucher b',"b.check_voucher_id ='".$id."'");
		$this->db->where('a.user_id', $userid);
		$this->db->where('a.document_code', $documentcode);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->first_row('array');
		} else {
			return false;
		}
	}

	public function getRICByID($id){
		$this->db->select("*, (select concat(person.lastname, ', ', person.firstname, ' ', person.middlename, ' ', person.suffix) from person  inner join employee on employee.person_id = person.person_id where a.employee_id = employee.employee_id) as employee");
		$this->db->from('ric a');
		$this->db->join('ric_detail b','b.ric_id = a.ric_id','left');
		$this->db->where('a.ric_id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getRICs(){
		$this->db->select("a.*, (select concat(b.lastname, ', ', b.firstname, ' ', b.middlename, ' ', b.suffix) from person b inner join employee on employee.person_id = b.person_id where a.employee_id = employee.employee_id) as employee, d.department_name");
		$this->db->from('ric a');
		$this->db->join('department d', 'd.department_id = a.department_id', 'left');
		$this->db->where('action_status','Approved');
		$this->db->where('is_cancelled', '0');
		$this->db->where('not exists (select 0 from check_voucher where check_voucher.ric_id = a.ric_id)','',false);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function checkActionStatus($action, $id){
		$this->db->select('*');
		$this->db->from('check_voucher');
		$this->db->where('check_voucher_id', $id);
		$this->db->where('action_status', $action);
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return true;
		} else {
			return false;
		}
	}
}