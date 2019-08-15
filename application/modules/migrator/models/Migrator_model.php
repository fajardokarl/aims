<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrator_model extends CI_Model {

  

  public function getChartofAccounts(){
    $query = $this->db->get('asubsidiary');
    return $query->result();
  }

  public function getItem(){
    $query = $this->db->get('item_inventorymaster');
    return $query->result();
  }

  public function getCategory(){
    $query = $this->db->get('item_category');
    return $query->result();
  }
  
  public function getSubsidiary(){
    $query = $this->db->get('glsubsidiary');
    return $query->result();
  }
  
  public function getCheerealty(){
    $query = $this->db->get('agentcheerealty');
    return $query->result();
  }

  public function getJcarealty(){
    $query = $this->db->get('agentjcarealty');
    return $query->result();
  }

  public function getPowerproperties(){
    $query = $this->db->get('agentpowerproperties');
    return $query->result();
  }

  public function getGamberealty(){
    $query = $this->db->get('agentgamberealty');
    return $query->result();
  }

  public function getTrulywealthy(){
    $query = $this->db->get('agenttrulywealthy');
    return $query->result();
  }

  public function getCdobrokers(){
    $query = $this->db->get('agentcdobrokers');
    return $query->result();
  }

  public function getLeuterio()
  {
    $query = $this->db->get('agentleuterio');
    return $query->result();
  }

  public function getAll()
  {
    $query = $this->db->get('rescust');
    return $query->result();
  }

  public function getCompany()
  {
    $this->db->where('type','2');
    $query = $this->db->get('rescust');
    return $query->result();
  }

  public function getPerson()
  {
    $this->db->where('type','1');
    $query = $this->db->get('rescust');
    return $query->result();
  }

  public function updateInfo($info)
  {
    $data = array(
      'name' => $info['name'],
      'code' => $info['code'],
      'type' => $info['type']
      );

    $this->db->where('CustID', $info['id']);
    $this->db->update('rescust', $data);
  }

  public function updateInfoNewid($info)
  {
    $data = array(
      'newid' => $info['newid']
      );

    $this->db->where('CustID', $info['id']);
    $this->db->update('rescust', $data);
  }

  public function updateNames($info, $cpinfo, $info2, $info3, $info4){
    $data = array(
      'lastname' => $info['lastname'],
      'firstname' => $info['firstname'],
      'middlename' => $info['middlename'],
      'prefix' => $info['prefix'],
      'suffix' => $info['suffix'],
      
      'cplastname' => $cpinfo['lastname'],
      'cpfirstname' => $cpinfo['firstname'],
      'cpmiddlename' => $cpinfo['middlename'],
      'cpprefix' => $cpinfo['prefix'],
      'cpsuffix' => $cpinfo['suffix'],
      
      'lastname2' => $info2['lastname'],
      'firstname2' =>$info2['firstname'],
      'middlename2' => $info2['middlename'],
      'prefix2' => $info2['prefix'],
      'suffix2' => $info2['suffix'],

      'lastname3' => $info3['lastname'],
      'firstname3' => $info3['firstname'],
      'middlename3' => $info3['middlename'],
      'prefix3' => $info3['prefix'],
      'suffix3' => $info3['suffix'],

      'lastname4' => $info4['lastname'],
      'firstname4' => $info4['firstname'],
      'middlename4' => $info4['middlename'],
      'prefix4' => $info4['prefix'],
      'suffix4' => $info4['suffix']
      );

    $this->db->where('CustID', $info['id']);
    $this->db->update('rescust', $data);
  }
}