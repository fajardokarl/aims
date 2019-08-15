<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Csvagents_model extends CI_Model{
	
	public function insertAgent($info){
		$this->db->insert('agent', $info);
	}

	public function insertOrganization($info){
		$this->db->insert('organization', $data);
		return $this->db->insert_id();
	}

	public function insertPerson($info){
		$this->db->insert('person', $info);
		return $this->db->insert_id();
	}

	public function insertRealty($info){
		$this->db->insert('realty', $info);
		return $this->db->insert_id();
	}

	public function findAgentByIds($realtyid, $personid){
		$query = $this->db->select('*')
			->from('agent')
			->where(array('realty_id' => $realtyid,
										'person_id' => $personid))
			->get();

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findOrganization($organization_name){
		$query = $this->db->select('*')
			->from('organization')
			->where('organization_name', $organization_name)
			->get();
		
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findOrganizationAddress($organizationid){
		$query = $this->db->select('*')
			->from('organization_address')
			->where('organization_id', $organizationid)
			->get();
		
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findPerson($lastname, $firstname){
		$query = $this->db->select('*')
			->from('person')
			->where(array("lastname" => $lastname,
										"firstname" => $firstname))
			->get();
		
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findRealtyByOrganizationName($organization_name){
		$query = $this->db->select('realty_id')
			->from('realty')
			->join('organization', 'realty.organization_id = organization.organization_id')
			->where('organization.organization_name', $organization_name)
			->get();
		
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function getCdobrokers(){
		return $this->db->get('temp_agentcdobrokers')->result_array();
	}

	public function getLeuterio(){
		return $this->db->get('temp_agentleuterio')->result_array();
	}

	public function getTrulywealthy(){
		return $this->db->get('temp_agenttrulywealthy')->result_array();
	}

	public function getGamberealty(){
		return $this->db->get('temp_agentgamberealty')->result_array();
	}

	public function getPowerproperties(){
		return $this->db->get('temp_agentpowerproperties')->result_array();
	}

	public function getJcarealty(){
		return $this->db->get('temp_agentjcarealty')->result_array();
	}

	public function getCheerealty(){
		return $this->db->get('temp_agentcheerealty')->result_array();
	}
}