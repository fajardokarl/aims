<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class capex_list_model extends CI_Model
{


    function retrieve_all_capex()
    {
     $this->db->select('*');
     $this->db->from('capex a');      
     $this->db->join('capex_replacement b', 'a.capex_id = b.capex_id', 'inner');
     $this->db->join('department c', 'c.department_id = a.department_id', 'inner');
     $this->db->join('person d', 'd.person_id = b.custodian_id', 'inner'); 
     $this->db->join('item e', 'b.item_id = e.item_id', 'inner'); 
     $query = $this->db->get();
     return $query->result_array();
    }

    function retrieve_all_acquisition()
    {
     $this->db->select('*');
     $this->db->from('capex a');      
     $this->db->join('capex_acquisition b', 'a.capex_id = b.capex_id', 'inner');
     $this->db->join('department c', 'c.department_id = a.department_id', 'inner');     
     $this->db->join('person d', 'd.person_id = b.custodian_id', 'inner'); 
     $query = $this->db->get();
     return $query->result_array();
    }

    function retrieve_all_capex_details()
    {
     $this->db->select('*');
     $this->db->from('capex a');
     // $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     // $this->db->join('item c', 'b.item_id = c.item_id', 'inner'); 
     $this->db->join('capex_replacement b', 'a.capex_id = b.capex_id', 'inner');
     $this->db->join('department c', 'c.department_id = a.department_id', 'inner');
     $this->db->join('person d', 'd.person_id = b.custodian_id', 'inner'); 
     // $this->db->where('a.prf_status_id', 1);
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

  //CAPEX NEW PROJECT/ACQUISITION QUERY START
    function capex_acquisition_details($capex_id)
    {
     $this->db->select('*, a.purpose as capex_purpose');
     $this->db->from('capex a');
     $this->db->join('capex_acquisition b', 'b.capex_id = a.capex_id', 'inner');
     $this->db->join('person c', 'c.person_id = b.custodian_id', 'inner');    
     $this->db->join('department d', 'd.department_id = a.department_id', 'inner');
     $this->db->join('prf e', 'e.prf_id = a.prf_id', 'inner');
     $this->db->join('budget_classification g', 'g.budget_classification_id = a.is_budgeted', 'inner');
     $this->db->join('item f', 'b.item_id = f.item_id', 'inner');
     $this->db->where('a.capex_id', $capex_id);
     $query = $this->db->get();
     return $query->row();
    }

    function get_capex_project_details($capex_id)
    {
     $this->db->select('*');
     $this->db->from('capex a');
     $this->db->join('capex_acquisition b', 'b.capex_id = a.capex_id', 'inner');
     $this->db->join('person c', 'c.person_id = b.custodian_id', 'inner');    
     $this->db->join('item f', 'b.item_id = f.item_id', 'inner');     
     $this->db->where('a.capex_id', $capex_id);
     $query = $this->db->get();
     return $query->result_array();
     } 
//CAPEX NEW PROJECT/ACQUISITION QUERY END 


    //CAPEX REPLACEMENT/CAPITALIZABLE REPAIRS QUERY START
    function capex_details($capex_id)
    {
     $this->db->select('*, a.purpose as capex_purpose');
     $this->db->from('capex a');
     $this->db->join('capex_replacement b', 'b.capex_id = a.capex_id', 'inner');
     $this->db->join('person c', 'c.person_id = b.custodian_id', 'inner');    
     $this->db->join('department d', 'd.department_id = a.department_id', 'inner');
     $this->db->join('prf e', 'e.prf_id = a.prf_id', 'inner');
     $this->db->join('budget_classification g', 'g.budget_classification_id = a.is_budgeted', 'inner');
     $this->db->join('item f', 'f.item_id = b.item_id', 'inner');
     $this->db->where('a.capex_id', $capex_id);
     $query = $this->db->get();
     return $query->row();
    }

    function get_capex_details($capex_id)
    {
     $this->db->select('*');
     $this->db->from('capex a');
     $this->db->join('capex_replacement b', 'b.capex_id = a.capex_id', 'inner');
     $this->db->join('person c', 'c.person_id = b.custodian_id', 'inner');    
     $this->db->where('a.capex_id', $capex_id);
     $query = $this->db->get();
     return $query->result_array();
     }  
  //CAPEX REPLACEMENT/CAPITALIZABLE REPAIRS QUERY END

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
   function toCapexPDF($capex_id)
    {
     $this->db->select('*, a.purpose as capex_purpose');
     $this->db->from('capex a');
     $this->db->join('capex_replacement b', 'b.capex_id = a.capex_id', 'inner');
     $this->db->join('person c', 'c.person_id = b.custodian_id', 'inner');
     $this->db->join('department d', 'd.department_id = a.department_id', 'inner');
     $this->db->join('prf e', 'e.prf_id = a.prf_id', 'inner');
     $this->db->join('item f', 'f.item_id = b.item_id', 'inner');
     $this->db->join('budget_classification g', 'g.budget_classification_id = a.is_budgeted', 'inner');   
     $this->db->where('a.capex_id', $capex_id);
     $query = $this->db->get();
     return $query->row();
    }

    function get_pdf_capex_details($capex_id)
    {
      $this->db->select('*');
     $this->db->from('capex_replacement a');    
     $this->db->join('person b', 'b.person_id = a.custodian_id', 'inner');    
     $this->db->where('a.capex_id', $capex_id);
     $query = $this->db->get();
     return $query->result_array();
     }
//-------test end here-----
    
    function toCapexAcquisitionPDF($capex_id)
    {
     $this->db->select('*, a.purpose as capex_purpose');
     $this->db->from('capex a');
     $this->db->join('capex_acquisition b', 'b.capex_id = a.capex_id', 'inner');
     $this->db->join('person c', 'c.person_id = b.custodian_id', 'inner');
     $this->db->join('department d', 'd.department_id = a.department_id', 'inner');
     $this->db->join('prf e', 'e.prf_id = a.prf_id', 'inner');
     $this->db->join('item f', 'f.item_id = b.item_id', 'inner');
     $this->db->join('budget_classification g', 'g.budget_classification_id = a.is_budgeted', 'inner');   
     $this->db->where('a.capex_id', $capex_id);
     $query = $this->db->get();
     return $query->row();
    }

    function get_pdf_capex_acquisition_details($capex_id)
    {
      $this->db->select('*');
     $this->db->from('capex_acquisition a');    
     $this->db->join('person b', 'b.person_id = a.custodian_id', 'inner');    
     $this->db->where('a.capex_id', $capex_id);
     $query = $this->db->get();
     return $query->result_array();
     }


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


}

