<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Its_model extends CI_Model{
public function __construct()
    {
        // call parent constructor
        parent::__construct();
    }
   function retrieve_status()
    {
    $this->db->select('*');
    $this->db->from('civil_status'); 
    $this->db->where('status_id',1);         
    $query = $this->db->get();   
    return $query->result_array();

    }
function retrieve_department()
    {
    $this->db->select('*');
    $this->db->from('department'); 
    $this->db->where('status_id',1);         
    $query = $this->db->get();   
    return $query->result_array();

    }
        function getAllCity(){
       $this->db->select('*');
       $this->db->from('address_city');
       $query = $this->db->get();
       return $query->result_array();
    }

     function getAllProvince(){
       $this->db->select('*');
       $this->db->from('address_province');
       $query = $this->db->get();
       return $query->result_array();
    }

     function getAddressType(){
       $this->db->select('*');
       $this->db->from('address_type');
       $query = $this->db->get();
       return $query->result_array();
    }

     function getAllCountry(){
       $this->db->select('*');
       $this->db->from('address_country');
       $query = $this->db->get();
       return $query->result_array();
    }

    function get_contact_type()
    {
       $this->db->select('*');
       $this->db->from('contact_type');
       $query = $this->db->get();
       return $query->result_array();
    }
   
}


