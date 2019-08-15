<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Bank_model extends CI_Model{

	public function insertBank($info){
		$this->db->insert('bank', $info);
	}

	public function insertContact($info){
		$this->db->insert('contact', $info);
		return $this->db->insert_id();
	}

	public function insertAddress($info){
		$this->db->insert('address', $info);
		return $this->db->insert_id();
	}

	public function updateBank($info, $id){
		$this->db->where('bank_id', $id);
		$this->db->update('bank', $info);
	}

	public function updateAddress($info, $id){
		$this->db->where('address_id', $id);
		$this->db->update('address', $info);
	}

	public function updateContact($info, $id){
		$this->db->where('contact_id', $id);
		$this->db->update('contact', $info);
	}

	public function getCountries(){
		$query = $this->db->get('address_country');
		return $query->result_array();
	}

	public function getProvinces(){
		$query = $this->db->get('address_province');
		return $query->result_array();
	}

	public function getCities(){
		$query = $this->db->get('address_city');
		return $query->result_array();
	}

	public function getBanks(){
		$this->db->select("*");
		$this->db->from('bank a');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getBankByID($id){
		$this->db->select("*");
		$this->db->from('bank');
		$this->db->join('contact','contact.contact_id = bank.contact_id', 'left');
		$this->db->join('address', 'address.address_id = bank.address_id', 'left');
		$this->db->where('bank_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
}