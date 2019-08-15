<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Legacy_model extends CI_Model{

	public function getLotCost(){
		$query = $this->db->get('lot_cost');
		return $query->result_array();
	}

	public function insertLotCost($info){
		$this->db->insert('lot_cost', $info);
	}

	public function insertBank($info){
		$this->db->insert('bank', $info);
	}

	public function insertCheckVoucher($info){
		$this->db->insert('check_voucher', $info);
	}

	public function updateLotCost($info, $id){
		$this->db->where('lot_cost_id', $id);
		$this->db->update('lot_cost', $info);
	}

	public function getLegacyLotCost(){
		$query = $this->db->get('legacy_tbllotcost');
		return $query->result_array();
	}

	public function get_A_Company(){
		$query = $this->db->get('legacy_A_Company');
		return $query->result_array();
	}

	public function getCheckVoucher(){
		$query = $this->db->get('legacy_m_checkvouchers');
		return $query->result_array();
	}

	public function getItem(){
		$query = $this->db->get('legacy_item_inventorymaster');
		return $query->result();
	}

	public function getItemUOMMaster(){
		$query = $this->db->get('legacy_item_uommaster');
		return $query->result_array();
	}

	public function getRelationItem(){
		$query = $this->db->get("legacy_item_relationuom");
		return $query->result_array();
	}

	public function getRelationWithItemID(){
		$query = $this->db->query("select * from legacy_item_relationuom
			inner join legacy_item_measurableuom on legacy_item_relationuom.MeasureId = legacy_item_measurableuom.MeasureId
			where legacy_item_relationuom.UOMId <> legacy_item_measurableuom.UOMId_Smallest");
		return $query->result_array();
	}

	public function getMeasurableuom(){
		$query = $this->db->get('legacy_item_measurableuom');
		return $query->result_array();
	}

	public function getGlsubsidiary(){
		$this->db->order_by('subfullname');
		$query = $this->db->get('legacy_glsubsidiary');
		return $query->result_array();
	}

	public function getClientPerson(){
		$this->db->select('*');
		$this->db->from('client');
		$this->db->join('organization', "organization.organization_id = client.reference_id and client.client_type_id = '2'");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getSupplier(){
		$this->db->select('*');
		$this->db->from('supplier');
		$this->db->join('person', "person.person_id = supplier.reference_id and supplier.client_type_id = '1'");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getEmployee(){
		$this->db->select('employee.employee_id, person.lastname, person.firstname, person.middlename, person.suffix');
		$this->db->from('employee');
		$this->db->join('person', 'person.person_id = employee.person_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getProject(){
		$query = $this->db->get('project');
		return $query->result_array();
	}

	public function findPhaseByName($name){
		$this->db->where('phase_name', $name);
		$query = $this->db->get('phase');
		return $query->first_row('array');
	}

	public function findLegacyPhase($id){
		$this->db->where('phaseid', $id);
		$query = $this->db->get('legacy_resphase');
		return $query->first_row('array');
	}

	//public function findGlsubsidiary($last, $first){
	public function findGlsubsidiary($last){
		$this->db->select('*');
		$this->db->from('legacy_glsubsidiary');
		$this->db->where('subtype', 'Properties');
		$this->db->like('subfullname', $last);
		//$this->db->like('subfullname', $first);
		$query = $this->db->get();
		
		return $query->result_array();
	}

	public function updateSubcode($info, $id){
		$this->db->where('supplier_id', $id);
		$this->db->update('supplier', $info);
	}
}