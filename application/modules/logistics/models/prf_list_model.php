<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class prf_list_model extends CI_Model
{


//---------test here start----
    function reportHead($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->join('person c', 'a.requested_by_id = c.person_id', 'inner');
     $this->db->join('department d', 'a.department_id = d.department_id', 'inner');  
     $this->db->where('b.prf_id', $prf_id);
     $query = $this->db->get();
     return $query->row();
    }

    function reportDetails($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->join('item c', 'b.item_id = c.item_id', 'inner');
     $this->db->join('item_uommaster e', 'b.uom_id = e.uom_id', 'inner');
     $this->db->join('warehouse f', 'b.deliver = f.warehouse_id', 'inner');   
     $this->db->where('b.prf_id', $prf_id);
     $query = $this->db->get();
     return $query->result_array();
     }
//-------test end here-----

function retrieve_all_prf()
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('person g', 'a.requested_by_id = g.person_id', 'inner');
     $this->db->join('department f', 'f.department_id = a.department_id', 'inner');
     $this->db->join('project h', 'a.project_id = h.project_id', 'left'); 
     $this->db->where('a.request_type', 1);
         $query = $this->db->get();
         return $query->result_array();
    }

function retrieve_all_rush()
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('person g', 'a.requested_by_id = g.person_id', 'inner');
     $this->db->join('department f', 'f.department_id = a.department_id', 'inner');
     $this->db->join('project h', 'a.project_id = h.project_id', 'left'); 
     $this->db->where('a.request_type', 2);
         $query = $this->db->get();
         return $query->result_array();
    }    

    function retrieve_all_canvasses()
    {
         $this->db->select('*');
         $this->db->from('canvass a');
         $this->db->join('person b', 'a.canvassed_by = b.person_id', 'inner');
         // $this->db->where('a.status_id', null);
         $query = $this->db->get();
         return $query->result_array();
    }   
  
     
    function getOnePrf($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->join('person c', 'a.requested_by_id = c.person_id', 'inner');    
     $this->db->where('b.prf_id', $prf_id);
     $query = $this->db->get();
     return $query->row();
    } 

    // function get_details_messages($prf_id)
    // {
    //  $this->db->select('*');
    //  $this->db->from('prf a');
    //  $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
    //  $this->db->join('item c', 'b.item_id = c.item_id', 'inner');
    //  $this->db->join('item_uommaster d', 'b.uom_id = d.uom_id', 'inner');
    //  $this->db->join('warehouse e', 'b.deliver = e.warehouse_id', 'inner');   
    //  // $this->db->where('b.prf_id', $prf_id);
    //  $query = $this->db->get();
    //  return $query->result_array();
    //  } 

    function get_details_messages($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->join('item c', 'b.item_id = c.item_id', 'inner');
     $this->db->join('item_uommaster d', 'b.prf_uom_id = d.uom_id', 'inner');
     $this->db->join('warehouse e', 'b.deliver = e.warehouse_id', 'left');   
     $this->db->where('b.prf_id', $prf_id);
     $query = $this->db->get();
     return $query->result_array();
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

       function getOneCanvass($canvass_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->where('b.prf_id', $canvass_id);
     $query = $this->db->get();
     return $query->row();
    }

     function get_canvass_detaileds($canvassid)
    {
    $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->join('item c', 'b.item_id = c.item_id', 'inner');
     $this->db->join('item_uommaster e', 'b.uom_id = e.uom_id', 'inner');
     $this->db->join('warehouse f', 'b.deliver = f.warehouse_id', 'inner');   
     $this->db->where('b.prf_id', $canvassid);
     $query = $this->db->get();
     return $query->result_array();
     }


//---------test here start----
    function toPDF($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->join('person c', 'a.requested_by_id = c.person_id', 'inner');
     $this->db->join('department d', 'a.department_id = d.department_id', 'inner');  
     $this->db->where('b.prf_id', $prf_id);
     $query = $this->db->get();
     return $query->row();
    }

    function get_prf_details($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->join('item c', 'b.item_id = c.item_id', 'inner');
     $this->db->join('item_uommaster e', 'b.prf_uom_id = e.uom_id', 'inner');
     $this->db->join('warehouse f', 'b.deliver = f.warehouse_id', 'left');   
     $this->db->where('b.prf_id', $prf_id);
     $query = $this->db->get();
     return $query->result_array();
     }
//-------test end here-----
    


    function get_canvass_details($canvass_id)
    {
     $this->db->select('*');
     $this->db->from('canvass a');
     $this->db->join('canvass_supplier b', 'b.canvass_id = a.canvass_id', 'inner');
     $this->db->join('canvass_item c', 'b.canvass_id = c.canvass_id', 'inner'); 
     $this->db->join('person g', 'a.canvassed_by = g.person_id', 'inner');    
     $this->db->where('b.canvass_id', $canvass_id);
     $query = $this->db->get();
     return $query->row();
    }


      function updateCancelStatus($info, $id){
        $this->db->where('prf_id', $id);
        $this->db->update('prf', $info);
    }


}

