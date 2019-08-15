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


    
    //    function retrieve_all_justification()
    // {
    //      $this->db->select('*');
    //      $this->db->from('capex_justification');     
    //      $query = $this->db->get();
    //      return $query->result_array();
    // }   

       function retrieve_all_classification()
    {
         $this->db->select('*');
         $this->db->from('capex_classification');     
         $query = $this->db->get();
         return $query->result_array();
    }



    function retrieve_all_items_replacements()
    {
         $this->db->select('*');
         $this->db->from('item');        
         $query = $this->db->get();
         return $query->result_array();
    }


    function retrieve_all()
    {
         $this->db->select('*');
         $this->db->from('item');        
         $query = $this->db->get();
         return $query->result_array();
    }




       function retrieve_all_uom()
    {
         $this->db->select('*');
         $this->db->from('item_uommaster');
         // $this->db->join('person b', 'a.person_id = b.person_id', 'inner');
         // $this->db->where('a.status_id', null);
         $query = $this->db->get();
         return $query->result_array();
    }

       function retrieve_all_project()
    {
         $this->db->select('*');
         $this->db->from('project');
         // $this->db->join('person b', 'a.person_id = b.person_id', 'inner');
         // $this->db->where('a.status_id', null);
         $query = $this->db->get();
         return $query->result_array();
    }

      function retrieve_all_warehouse()
    {
         $this->db->select('*');
         $this->db->from('warehouse');
         // $this->db->join('person b', 'a.person_id = b.person_id', 'inner');
         // $this->db->where('a.status_id', null);
         $query = $this->db->get();
         return $query->result_array();
    }

    function retrieve_all_justification()
    {
        $this->db->select('*');
        $this->db->from('capex_justification');
        $query = $this->db->get();
        return $query->result_array();
    }

       function retrieve_all_justification_repairs()
    {
        $this->db->select('*');
        $this->db->from('capex_justification');
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

    function insert_capex($data)
    {
        $this->db->trans_start();
        $this->db->insert('capex',$data);
        $lastCapex = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastCapex;
    }

    function insert_acquisition($data)
    {
        $this->db->trans_start();
        $this->db->insert('capex_acquisition',$data);
        $lastReplacement = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastReplacement;
    }

    function insert_replacement($data)
    {
        $this->db->trans_start();
        $this->db->insert('capex_replacement',$data);
        $lastRepairs = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastRepairs;
    }

       function insert_reppair_maintenance($data)
    {
        $this->db->trans_start();
        $this->db->insert('prf_maintenance',$data);
        $lastmaintenance = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastmaintenance;
    }

    function item_by_uom($id){
        $this->db->select('*');
        $this->db->from('item a');
        $this->db->join('item_relationuom c','a.item_id = c.item_id','inner');
        $this->db->join('item_uommaster b', 'c.uom_id = b.uom_id','inner');     
        $this->db->where('a.item_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

//this will query if the item you've selected is either budgeted or unbudgeted
    function budget_by_department($id,$dept_id)
    {
        $this->db->select('*');
        $this->db->from('budget a');
        $this->db->join('budget_detail c','a.budget_id = c.budget_id','inner');
        $this->db->where('item_id = ',$id);
        $this->db->where('department_id = ',$dept_id);
        $query = $this->db->get();
        return $query->result_array();       

    }
        function person_asset($id)
    {
        $this->db->select('*');
        $this->db->from('asset_barcode');
        // $this->db->join('budget_detail c','a.budget_id = c.budget_id','inner');
        $this->db->where('employee_id = ',$id);       
        $query = $this->db->get();
        return $query->result_array();       

    }

        function project_lots($id)
    {
        $this->db->select('*');
        $this->db->from('lot');
        // $this->db->join('budget_detail c','a.budget_id = c.budget_id','inner');
        $this->db->where('project_id = ',$id);       
        $query = $this->db->get();
        return $query->result_array();       

    }
    //This will query all your budgeted items based on your department.
     function retrieve_all_budgeted($dept_id)
    {
        $this->db->select('*');
        $this->db->from('item a');
        $this->db->join('budget_detail c','a.item_id = c.item_id','inner');
        $this->db->join('budget b','c.budget_id = b.budget_id','inner');
        $this->db->join('person f','b.approve_by = f.person_id','inner');
        // $this->db->where('item_id = ',$id);
        $this->db->where('department_id =',$dept_id);
        $query = $this->db->get();
        return $query->result_array();        

    }
    function retrieve_custodian($dept_id)
    {
        // $this->db->distinct('employee_id');
        $this->db->select('*');
        $this->db->from('asset_barcode a');
        $this->db->join('department c','a.department_id = c.department_id','inner');
        // $this->db->join('budget b','c.budget_id = b.budget_id','inner');
        $this->db->join('person f','a.employee_id = f.person_id','inner');
        // $this->db->where('item_id = ',$id);
        $this->db->where('a.department_id =',$dept_id);
        $this->db->group_by('a.employee_id');
        $query = $this->db->get();
        return $query->result_array();        

    }

}