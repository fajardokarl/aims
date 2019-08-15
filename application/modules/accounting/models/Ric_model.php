<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ric_model extends CI_Model{
	public function insertRIC($info){
		$this->db->insert('ric',$info);
		return $this->db->insert_id();
	}

	public function insertRICAction($info){
		$this->db->insert('ric_action', $info);
	}

	public function insertRICDetail($info){
		$this->db->insert('ric_detail', $info);
	}

	public function insertAttachment($info){
		$this->db->insert('attachment', $info);
		$id = $this->db->insert_id();
		$this->db->where('attachment_id', $id);
		$query = $this->db->get('attachment');
		return $query->result_array();
	}

	public function updateRIC($info, $id){
		$this->db->where('ric_id', $id);
		$this->db->update('ric', $info);
	}

	public function updateRICDetail($info, $id){
		$this->db->where('ric_detail_id', $id);
		$this->db->update('ric_detail', $info);
	}

	public function updateAttachment($info, $id){
		$this->db->where('attachment_id', $id);
		$this->db->update('attachment', $info);
	}

	public function getEmployees(){
		$this->db->select("a.*, concat(b.lastname, ', ',b.firstname, ' ',b.middlename,' ', b.suffix) as employee");
		$this->db->from('employee a');
		$this->db->join('person b','b.person_id = a.person_id');
		$this->db->where('a.status_id','1');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getDepartments(){
		$query = $this->db->get('department');
		return $query->result_array();
	}

	public function getEmployeeDepartment($employeeid){
		$this->db->where('employee_id', $employeeid);
		$query = $this->db->get('department_employee');
		if ($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getRICByID($id){
		$this->db->where('ric_id', $id);
		$query = $this->db->get('ric');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getRICActionByID($id){
		$this->db->select('*');
		$this->db->from('ric_action');
		$this->db->where('ric_id', $id);
		$this->db->order_by('ric_action_id','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getRICDetailByID($id){
		$this->db->where('ric_id', $id);
		$query = $this->db->get('ric_detail');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getAttachmentByFilename($filename){
		$this->db->where('is_deleted', 'no');
		$this->db->where('filename', $filename);
		$query = $this->db->get('attachment');
		return $query->result_array();
	}

	public function getAttachmentByRicid($id){
		$this->db->where('is_deleted', 'no');
		$this->db->where('reference_id', $id);
		$query = $this->db->get('attachment');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getRICViewByID($id){
		$this->db->select("a.*,(select concat(b.lastname, ', ',b.firstname, ' ',b.middlename,' ', b.suffix) from person b inner join employee c on c.person_id = b.person_id where a.employee_id = c.employee_id) as employee, d.department_name as department, (select concat(b.lastname, ', ', b.firstname, ' ', b.middlename, ' ', b.suffix) from person b inner join employee on employee.person_id = b.person_id where a.prepared_by = employee.employee_id) as prepared, (select concat(b.lastname, ', ', b.firstname, ' ', b.middlename, ' ', b.suffix) from person b inner join employee on employee.person_id = b.person_id where a.requested_by = employee.employee_id) as requested");
		$this->db->from('ric a');
		$this->db->join('department d', 'd.department_id = a.department_id');
		$this->db->where('a.ric_id', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getRICActionViewByID($id){
		$this->db->select("a.*, (select concat(b.lastname, ', ', b.firstname, ' ', b.middlename, ' ', b.suffix) from person b inner join employee on employee.person_id = b.person_id where a.action_employee_id = employee.employee_id) as employee_name");
		$this->db->from('ric_action a');
		$this->db->where('ric_id', $id);
		$this->db->order_by('ric_action_id','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getUserRole($ricid, $userid, $documentcode){
		$this->db->select('a.*, b.action_status');
		$this->db->from('user_role a');
		$this->db->join('ric b',"a.department_id = b.department_id and b.ric_id = '".$ricid."'");
		$this->db->where('a.user_id', $userid);
		$this->db->where('a.document_code', $documentcode);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->first_row('array');
		} else {
			return false;
		}
	}

	public function getRecipient($department, $documentcode, $rolecode){
		$this->db->select('employee.employee_id');
		$this->db->from('user_role');
		$this->db->join('user', 'user.user_id = user_role.user_id');
		$this->db->join('employee', 'employee.person_id = user.person_id');
		$this->db->where('user_role.department_id', $department);
		$this->db->where('user_role.document_code', $documentcode);
		$this->db->where('user_role.role_code', $rolecode);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}

	}

	public function getRIC($begin, $end){
		$this->db->select("a.*, (select concat(b.lastname, ', ', b.firstname, ' ', b.middlename, ' ', b.suffix) from person b inner join employee on employee.person_id = b.person_id where a.employee_id = employee.employee_id) as employee, d.department_name as department, (select concat(b.lastname, ', ', b.firstname, ' ', b.middlename, ' ', b.suffix) from person b inner join employee on employee.person_id = b.person_id where a.prepared_by = employee.employee_id) as prepared, (select concat(b.lastname, ', ', b.firstname, ' ', b.middlename, ' ', b.suffix) from person b inner join employee on employee.person_id = b.person_id where a.requested_by = employee.employee_id) as requested, if(a.is_cancelled = 0, 'No', 'Yes') as cancelled");
		$this->db->from('ric a');
		$this->db->join('department d', 'd.department_id = a.department_id', 'left');
		$this->db->where("ric_date between '".$begin."' and '".$end."'");
		$this->db->order_by('ric_id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function checkActionStatus($action, $id){
		$this->db->select('*');
		$this->db->from('ric');
		$this->db->where('ric_id', $id);
		$this->db->where('action_status', $action);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

}