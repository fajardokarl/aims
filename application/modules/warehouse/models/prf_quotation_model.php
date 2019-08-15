<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class prf_quotation_model extends CI_Model
{

    function quote_details($id)
    {
         $this->db->select('*');
         $this->db->from('prf a');
         $this->db->join('quotation b', 'a.prf_id = b.prf_id', 'inner');   
         $this->db->join('quotation_detail c', 'b.quotation_id = c.quotation_id', 'inner');
         $this->db->join('item d', 'c.item_id = d.item_id', 'inner');  
        
         $this->db->where('b.prf_id', $id);
         $query = $this->db->get();
         return $query->result_array(); 
    }

    function quotation_all_head($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a'); 
     $this->db->join('person b', 'a.requested_by_id = b.person_id', 'inner');
     $this->db->join('department c', 'a.department_id = c.department_id', 'inner');      
     $this->db->where('a.prf_id', $prf_id);
     $query = $this->db->get();
     return $query->row();
    }


   function budget_by_department($item_id,$prf_id)
    {
        $this->db->select('*');
        $this->db->from('prf a');
        $this->db->join('prf_detail b','a.prf_id = b.prf_id','inner');
        $this->db->join('item_uommaster c','b.prf_uom_id= c.uom_id','inner');
        $this->db->where('b.item_id = ',$item_id);
        $this->db->where('b.prf_id = ',$prf_id);
        $query = $this->db->get();
        return $query->result_array();       

    }

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

    function retrieve_all_prf_details()
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('person g', 'a.requested_by_id = g.person_id', 'inner');
     $this->db->join('department f', 'f.department_id = a.department_id', 'inner');
     $this->db->join('project h', 'a.project_id = h.project_id', 'left'); 
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

    function get_items($prf_id)
    {
         $this->db->select('*');
         $this->db->from('prf_detail a');
         $this->db->join('item b', 'a.item_id = b.item_id', 'inner');
         $query = $this->db->get();
        $this->db->where('a.prf_id', $prf_id);
         return $query->result_array();
    }

    function retrieve_sample_prf_item($prf_id)
    {
         $this->db->select('*');
         $this->db->from('prf_detail a');
         // $this->db->from('prf_detail b', 'a.prf_id = b.prf_id','inner ');
         $this->db->join('item c', 'a.item_id = c.item_id', 'inner');
         $query = $this->db->get();
        $this->db->where('a.prf_id', $prf_id);
         return $query->result_array();
    }


    function getAllSupplier(){
        $query = $this->db->query("select supplier.supplier_id, concat(person.lastname,', ', person.firstname,' ', person.middlename) as supplier_name, client_type.client_type_name as supplier_type, status.status_name from supplier 
            inner join person on supplier.client_type_id= '1' and supplier.reference_id = person.person_id
            inner join client_type on supplier.client_type_id = client_type.client_type_id 
            inner join status on status.status_id = supplier.status_id
            UNION
            select supplier.supplier_id, organization.organization_name as supplier_name, client_type.client_type_name as supplier_type, status.status_name from supplier 
            inner join organization on supplier.client_type_id = '2' and supplier.reference_id = organization.organization_id
            inner join client_type on supplier.client_type_id = client_type.client_type_id
            inner join status on status.status_id = supplier.status_id
            order by supplier_id");
        return $query->result_array();
    }

    function item_qty($id)
    {
        $this->db->select('*');
        $this->db->from('prf_detail');       
        $this->db->where('prf_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }



    function getAllQuotation()
    {
         $this->db->select('*');
         $this->db->from('prf a');        
         $this->db->join('person c', 'a.requested_by_id = c.person_id', 'inner');
         $this->db->join('department d', 'a.department_id = d.department_id', 'inner');
         $query = $this->db->get();
         return $query->result_array();
    }


       function to_head($id)
    {
         $this->db->select('*');
         $this->db->from('quotation_detail a');
         $this->db->join('quotation b', 'a.quotation_id = b.quotation_id', 'inner');         
         $this->db->where('a.quotation_detail_id', $id);
         $query = $this->db->get();
         return $query->row();
    }


     function get_details($id)
    {
         $this->db->select('*');
         $this->db->from('quotation_detail a'); 
         // $this->db->join('quotation_detail b', 'a.quotation_id = b.quotation_id', 'inner'); 
         $this->db->join('item c', 'a.item_id = c.item_id', 'inner');
         // $this->db->join('prf_detail d', 'a.prf_id = d.prf_id', 'inner');         
         $this->db->where('a.quotation_detail_id', $id);
         $query = $this->db->get();
         return $query->result_array();
    }


      function insert_quotation($data)
    {
        $this->db->trans_start();
        $this->db->insert('quotation', $data);
        $lastCanvass = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastCanvass;

    }

    function insert_quotation_details($data)
    {
        $this->db->trans_start();
        $this->db->insert('quotation_detail', $data);
        $lastSupplier = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastSupplier;
    }


    function capex_details($data)
    {
     $this->db->select('*');
     $this->db->from('quotation');
     // $this->db->join('capex_acquisition b', 'b.capex_id = a.capex_id', 'inner');
     // $this->db->join('person c', 'c.person_id = b.custodian_id', 'inner');
     // $this->db->join('department d', 'd.department_id = a.department_id', 'inner');
     // $this->db->join('prf e', 'e.prf_id = a.prf_id', 'inner');
     // $this->db->join('item f', 'f.item_id = b.item_id', 'inner');
     // $this->db->join('budget_classification g', 'g.budget_classification_id = a.is_budgeted', 'inner');   
     $this->db->where('canvass_id', $data);
     $query = $this->db->get();
     return $query->row();
    }

    function get_capex_details($data)
    {
      $this->db->select('*');
     $this->db->from('quotation_detail');    
     // $this->db->join('person b', 'b.person_id = a.custodian_id', 'inner');    
     $this->db->where('quotation_detail_id', $data);
     $query = $this->db->get();
     return $query->result_array();
     }


    
    function get_details_messages($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->join('item c', 'b.item_id = c.item_id', 'inner');
     $this->db->join('item_uommaster e', 'b.prf_uom_id = e.uom_id', 'inner');
     $this->db->join('warehouse f', 'b.deliver = f.warehouse_id', 'inner');   
     $this->db->where('b.prf_id', $prf_id);
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
     $this->db->join('item_uommaster e', 'b.uom_id = e.uom_id', 'inner');
     $this->db->join('warehouse f', 'b.deliver = f.warehouse_id', 'inner');   
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


}

