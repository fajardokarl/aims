<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Request_model extends CI_Model
{

	  function retrieve_all_employee()
    {
         $this->db->select('*');
         $this->db->from('user a');
         $this->db->join('person b', 'a.person_id = b.person_id', 'inner');
         $this->db->where('a.status_id', null);
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

       function retrieve_all_uom()
    {
         $this->db->select('*');
         $this->db->from('item_uom');
         // $this->db->join('person b', 'a.person_id = b.person_id', 'inner');
         // $this->db->where('a.status_id', null);
         $query = $this->db->get();
         return $query->result_array();
    }

    function insert_request($data)
    {
    	$this->db->trans_start();
    	$this->db->insert('prf', $data);
    	$lastRequest = $this->db->insert_id();
    	$this->db->trans_complete();
    	return $lastRequest;

    }

    function insert_prf_details($data)
    {
    	$this->db->trans_start();
    	$this->db->insert('prf_detail',$data);
    	$lastItems = $this->db->insert_id();
    	$this->db->trans_complete();
    	return $lastItems;
    }

    // function insert_prf_status($data)
    // {
    //     $this->db->trans_start();
    //     $this->db->insert('prf_status',$data);
    //     $lastStatus = $this->db->insert_id();
    //     $this->db->trans_complete();
    //     return $lastStatus;
    // }

}