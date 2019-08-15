<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class canvass_list_model extends CI_Model
{


function retrieve_all_canvasses()
    {
         $this->db->select('*');
         $this->db->from('canvass a');
         $this->db->join('person b', 'a.canvassed_by = b.person_id', 'inner');
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
     $this->db->from('canvass a');
     $this->db->join('canvass_item b', 'b.canvass_id = a.canvass_id', 'inner');
     // $this->db->join('item c', 'b.item_id = c.item_id', 'inner'); 
     // $this->db->join('person g', 'a.requested_by_id = g.person_id', 'inner');
     // $this->db->join('department f', 'f.department_id = a.department_id', 'inner');
     // $this->db->join('project h', 'a.project_id = h.project_id', 'inner'); 
     $this->db->where('b.canvass_id', $canvass_id);
     $query = $this->db->get();
     return $query->row();
    }

     function get_canvass_detaileds($canvassid)
    {
     $this->db->select('*');
     $this->db->from('canvass a');
     $this->db->join('canvass_item b', 'b.canvass_id = a.canvass_id', 'inner');
     $this->db->join('canvass_supplier c', 'c.canvass_id = b.canvass_id', 'inner');  
     $this->db->where('b.canvass_id = ',$canvassid);
     $query = $this->db->get();
     return $query->result_array();
     }



    function toPDF($prf_id)
    {
     $this->db->select('*');
     $this->db->from('canvass a');
     $this->db->join('canvass_supplier b', 'b.canvass_id = a.canvass_id', 'inner');
     $this->db->join('canvass_item c', 'b.canvass_id = c.canvass_id', 'inner'); 
     $this->db->join('person g', 'a.canvassed_by = g.person_id', 'inner');
     // $this->db->join('department f', 'f.department_id = a.department_id', 'inner');
     // $this->db->join('project h', 'a.project_id = h.project_id', 'left'); 
     $this->db->where('b.canvass_id', $prf_id);
     $query = $this->db->get();
     return $query->row();
    }



    function get_canvass_details($canvass_id)
    {
     $this->db->select('*');
     $this->db->from('canvass a');
     $this->db->join('canvass_supplier b', 'b.canvass_id = a.canvass_id', 'inner');
     $this->db->join('canvass_item c', 'b.canvass_id = c.canvass_id', 'inner'); 
     $this->db->join('person g', 'a.canvassed_by = g.person_id', 'inner');
     // $this->db->join('department f', 'f.department_id = a.department_id', 'inner');
     // $this->db->join('project h', 'a.project_id = h.project_id', 'left'); 
     $this->db->where('b.canvass_id', $canvass_id);
     $query = $this->db->get();
     return $query->row();
    }



     function get_canvassed_details($canvass_id){
     $this->db->select('*');
     $this->db->from('canvass a');
     $this->db->join('canvass_supplier b', 'b.canvass_id = a.canvass_id', 'inner');
     $this->db->join('canvass_item c', 'b.canvass_id = c.canvass_id', 'inner'); 
     $this->db->join('item d', 'c.canvass_id = d.item_id', 'inner'); 
     $this->db->join('item_uommaster e', 'c.unit = e.uom_id', 'inner'); 
     $this->db->where('a.canvass_id',$canvass_id);
     $query = $this->db->get();
     return $query->result_array();
    }
      

    //  function get_canvassed_details($prfid){
    //  $this->db->select('*');
    //  $this->db->from('prf a');
    //  $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
    //  $this->db->join('item c', 'c.item_id = b.item_id', 'inner');
    //  $this->db->join('item_uommaster d', 'd.uom_id = b.uom_id', 'inner');
    //  $this->db->join('warehouse f', 'b.deliver = f.warehouse_id', 'inner');
    //  // $this->db->join('project g', 'a.project_id = g.project_id', 'inner');
    //  $this->db->where('a.prf_id = ',$prfid);
    //  $query = $this->db->get();
    //  return $query->result_array();
    // }

}

