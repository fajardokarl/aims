<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class getItem_model extends CI_Model
{

    function retrieve_all_prf()
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('person g', 'a.requested_by_id = g.person_id', 'inner');
     $this->db->join('department f', 'f.department_id = a.department_id', 'inner');
     $this->db->join('project h', 'a.project_id = h.project_id', 'left'); 
     $this->db->where('a.prf_status_id', 1);
         $query = $this->db->get();
         
         return $query->result_array();
    }
    function get_items()
    {
        $this->db->select('*');
        $this->db->from('item');
        // $this->db->join('person', 'user.person_id = person.person_id', 'inner');
        $this->db->where('status_id', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

     function retrieve_all_items()
    {
         $this->db->select('*');
         $this->db->from('item');
         // $this->db->join('person b', 'a.person_id = b.person_id', 'inner');
         // $this->db->where('a.status_id', null);
         $query = $this->db->get();
         return $query->result_array();
    }

    //  function retrieve_all_suppliers()
    // {
    //      $this->db->select('*');
    //      $this->db->from('supplier a ');
    //      $this->db->join('person b', 'b.person_id = a.referrence_id AND  a.client_type_id = 1' ,'inner');

    //      // $this->db->where('a.status_id', null);
    //      $query = $this->db->get();
    //      return $query->result_array();
    // }



    function insert_item($data)
    {
    	$this->db->trans_start();
    	$this->db->insert('item', $data);
    	$lastRequest = $this->db->insert_id();
    	$this->db->trans_complete();
    	return $lastRequest;

    }


    function canvass_uom($id){
        $this->db->select('*');
        $this->db->from('item a');
        $this->db->join('item_relationuom c','a.item_id = c.item_id','inner');
        $this->db->join('item_uommaster b', 'c.uom_id = b.uom_id','inner');     
        $this->db->where('a.item_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
}

