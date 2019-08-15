<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Person_model extends CI_Model {

	public function findPersonByName($lastname,$firstname){
    $this->db->where("lastname", $lastname);
    $this->db->where("firstname", $firstname);
		$query = $this->db->get('person');

    if($query->num_rows() > 0)
    {
      return $query->row();
    } else {
      return false;
    }
	}//closing findPersonByName

	public function insertPerson($person){
		$data = array(
      'lastname' => $person['lastname'],
      'firstname' => $person['firstname'],
      'middlename' => $person['middlename'],
      'suffix' => $person['suffix'],
      'sex' => $person['sex'],
      'birthdate' => $person['birthdate'],
      'birthplace' => $person['birthplace'],
      'nationality' => $person['nationality'],
      'civil_status_id' => $person['civil_status_id'],
      'tin' => $person['tin']
      );

    $this->db->insert('person', $data);
    return $this->db->insert_id();     
	}//closing insertPerson

  public function updatePerson($person){
    $data = array(
      'sex' => $person['sex'],
      'birthdate' => $person['birthdate'],
      'birthplace' => $person['birthplace'],
      'nationality' => $person['nationality'],
      'civil_status_id' => $person['civil_status_id'],
      'tin' => $person['tin']
      );
    
    $this->db->where('person_id', $person['newid']);
    $this->db->update('person', $data);
  }

  public function updPerson($info, $id){
    $this->db->where('person_id', $id);
    $this->db->update('person', $info);
  }

  public function getAllPerson(){
    $query = $this->db->get('person');
    return $query->result_array();
  }
}//closing class