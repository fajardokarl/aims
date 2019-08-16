<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class file_model extends CI_Model
{

    function insert_to($data)
    {
        $this->db->trans_start();
        $this->db->insert('travel_order', $data);
        $personID = $this->db->insert_id();
        $this->db->trans_complete();
        return $personID;
    }

    function get_destination()
    {
         $this->db->select('*');
         $this->db->from('fuel_matrix');
         $query = $this->db->get();
         return $query->result_array();
    }
    function destination_transport($id)
    {
        $this->db->select('*');
        $this->db->from('transportation');                   
        $this->db->where('transpo_type = ',$id);       
        $query = $this->db->get();
        return $query->result_array();       

    }
    function getMyTO($id)
    {
        $this->db->select('*');
        $this->db->from('travel_order');             
        $this->db->where('requested_by_id = ',$id);       
        $query = $this->db->get();
        return $query->result_array();       

    }

    function getOnePrf($prf_id)
    {
     $this->db->select('*');
     $this->db->from('travel_order a');
         $this->db->join('person c', 'a.requested_by_id = c.person_id', 'inner');    
     $this->db->where('a.to_id', $prf_id);
     $query = $this->db->get();
     return $query->row();
    }

    function update_TO_detail($to_id, $data)
    {
    $this->db->trans_start();
    $this->db->where('to_id', $to_id);
    $this->db->update('travel_order', $data);   
    $this->db->trans_complete();
    }

    function get_to_detail($to_id)
    {
     $this->db->select('*');
     $this->db->from('travel_order');    
     $this->db->where('to_id',$to_id);
     $query = $this->db->get();
     return $query->result_array();
     }

}