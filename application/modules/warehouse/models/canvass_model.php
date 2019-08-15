<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class canvass_model extends CI_Model{
    public function __construct()
    {
        // call parent constructor
        parent::__construct();
    }

    function get_all_details($supid,$prfid)
    {
  $this->db->select('*');         
         $this->db->from('canvass_detail a');
         $this->db->join('item b', 'a.item_id = b.item_id', 'inner'); 
         // $this->db->join('prf_detail c', 'a.prf_id = c.prf_id', 'inner');          
         $this->db->where('a.supplier_id', $supid);
         $this->db->where('a.prf_id', $prfid);        
         $this->db->where('a.is_approved',1);         
         $query = $this->db->get();
         return $query->result_array();
    return $query->result_array();
    }


    function get_approved_supplier($id)
    {
  $this->db->select('*');         
         $this->db->from('canvass_detail a');
         $this->db->join('item b', 'a.item_id = b.item_id', 'inner');         
         $this->db->where('a.is_approved',1); 
         $this->db->where('prf_id', $id);
         $query = $this->db->get();
         return $query->result_array();
    return $query->result_array();
    }


    function retrieve_selected_supplier($id)
    {
         $this->db->select('*');         
         $this->db->from('canvass_detail'); 
         // $this->db->join('canvass b', 'a.prf_id = b.prf_id', 'inner');
         // $this->db->join('canvass_detail c', 'b.canvass_id = c.canvass_id', 'inner');  
         $this->db->where('is_approved',1); 
         $this->db->where('prf_id', $id);
         $query = $this->db->get();
         return $query->result_array();
     }

      function retrieve_all_canvass()
    {
    $this->db->select('*');
    $this->db->from('prf a');
    $this->db->join('person b', 'a.requested_by_id=b.person_id', 'inner');
    $this->db->join('department c', 'a.department_id=c.department_id', 'inner');
    $this->db->where('a.prf_status_id',1);
    $query = $this->db->get();
    return $query->result_array();
    }


     function retrieve_po()
    {
    $this->db->select('*');
    $this->db->from('purchase_order a');
    // $this->db->join('purchase_order_detail b', 'a.po_id=b.po_id', 'inner');
    $this->db->join('person c', 'a.created_by_id=c.person_id', 'inner');

    $query = $this->db->get();
    return $query->result_array();
    }


    //retreiving PO data to pdf

      function headPO($data)
    {
     $this->db->select('*');
     $this->db->from('purchase_order a');    
     $this->db->join('prf b', 'a.prf_id=b.prf_id', 'inner');
     $this->db->join('warehouse c', 'b.deliverTo=c.warehouse_id', 'inner');
     $this->db->join('canvass d', 'b.prf_id=d.prf_id', 'inner');
     $this->db->join('person e', 'd.requested_by=e.person_id', 'inner');
     $this->db->where('po_id', $data);
     $query = $this->db->get();
     return $query->row();
    }

    function detailPO($data)
    {
    $this->db->select('*');
    $this->db->from('purchase_order_detail a');    
    $this->db->join('item b', 'a.item_id = b.item_id', 'inner');
    $this->db->join('item_uommaster c', 'a.po_uom_id = c.uom_id', 'inner');
     $this->db->where('a.po_id', $data);
     $query = $this->db->get();
    return $query->result_array();
    }
    //retrieving data end


    function getPOHead($id)
    {
     $this->db->select('*');
     $this->db->from('prf a'); 
     $this->db->join('person b', 'a.requested_by_id = b.person_id', 'inner');  
     $this->db->join('department c', 'a.department_id = c.department_id', 'inner');
     $this->db->where('a.prf_id', $id);
     $query = $this->db->get();
     return $query->row();
    }


    function getPODetails($id)
    {
    $this->db->select('*');
    $this->db->from('prf a');
    $this->db->join('canvass_detail b', 'a.prf_id = b.prf_id', 'inner');
    $this->db->join('item c', 'b.item_id = c.item_id', 'inner');
    // $this->db->join('warehouse d', 'b.deliver = d.warehouse_id', 'inner');
    $this->db->where('b.prf_id', $id);
    $this->db->where('is_approved', 1); 
    // $this->db->where('supplier_id = supplier_id');
     $query = $this->db->get();
    return $query->result_array();
    }



 function retrieve_all_PO()
    {
        $this->db->select('*');
        $this->db->from('prf a');
        $this->db->join('person b', 'a.requested_by_id=b.person_id', 'inner');
        $this->db->join('department c', 'a.department_id=c.department_id', 'inner');
        $this->db->where('a.prf_status_id',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    // function reportDetails($id)
    // {
    // $this->db->select('*');
    // $this->db->from('prf_detail a');
    // $this->db->join('item c', 'a.item_id = c.item_id', 'inner');
    // $this->db->where('prf_id', $id);
    // $this->db->where('is_approved', 1);
    //  $query = $this->db->get();
    // return $query->result_array();
    // }


    function change_status_model($id, $data){
        $this->db->trans_start();
        $this->db->where('canvass_detail_id', $id);
        $this->db->update('canvass_detail', $data);
        $this->db->trans_complete();
    }


    function change_budget_status_model($budget_id, $price_offer){
        $this->db->trans_start();
        $this->db->where('budget_detail_id', $budget_id);
        $this->db->update('budget_detail', $price_offer);
        $this->db->trans_complete();
    }

    function change_prf_status_model($id, $data){
        $this->db->trans_start();
        $this->db->where('prf_id', $id);
        $this->db->update('prf', $data);
        $this->db->trans_complete();
    }

    function retrieve_canvass_list()
    {
         $this->db->select('*');
         $this->db->from('prf a');  
         $this->db->join('person b', 'a.requested_by_id = b.person_id', 'inner'); 
         // $this->db->join('quotation c', 'a.prf_id = c.prf_id', 'inner');        
         // $this->db->where('a.status_id', null);
         $query = $this->db->get();
         return $query->result_array();
    }


    function retrieve_prf_list()
    {
         $this->db->select('*');
         $this->db->from('prf a');  
         $this->db->join('person b', 'a.requested_by_id = b.person_id', 'inner');
         $this->db->join('department c', 'a.department_id = c.department_id', 'inner');
         // $this->db->where('a.prf_status_id', 0);
         $query = $this->db->get();
         return $query->result_array();
    }

     function retrieve_approved_canvass()
    {
         $this->db->select('*');
         $this->db->from('prf a');  
         $this->db->join('person b', 'a.requested_by_id = b.person_id', 'inner');
         // $this->db->join('canvass c', 'a.prf_id = c.prf_id', 'inner');
         $this->db->where('a.prf_status_id', 1);
         $query = $this->db->get();
         return $query->result_array();
    }

    function retrieve_canvass()
    {
         $this->db->select('*');
         $this->db->from('prf a');
         $this->db->join('person b', 'a.requested_by_id = b.person_id', 'inner');
         $this->db->join('quotation c', 'a.prf_id = c.prf_id', 'inner');
         $this->db->where('c.quotation_status', 1);
         $query = $this->db->get();
         return $query->result_array();
    } 
    function retrieve_needed_supplier($id)
    {
         $this->db->select('*');         
         $this->db->from('prf a'); 
         $this->db->join('quotation b', 'a.prf_id = b.prf_id', 'inner');
         $this->db->join('quotation_detail c', 'b.quotation_id = c.quotation_id', 'inner');   
         $this->db->where('b.prf_id', $id);
         $query = $this->db->get();
         return $query->result_array();
     }


    function get_canvass_model($data){
         $this->db->select('*');
         $this->db->from('canvass a'); 
         $this->db->join('canvass_detail b', 'a.canvass_id = b.canvass_id', 'inner');    
         $this->db->join('item c', 'b.item_id = c.item_id', 'inner');
         $this->db->where('a.canvass_id', $data);
         $query = $this->db->get();
        return $query->result_array();
    }  


        function quotation_details_head($id)
    {
     $this->db->select('*');
     $this->db->from('prf a'); 
     $this->db->join('person b', 'a.requested_by_id = b.person_id', 'inner');  
     $this->db->join('department c', 'a.department_id = c.department_id', 'inner');
     $this->db->join('quotation d', 'a.prf_id = d.prf_id', 'inner');
     $this->db->where('a.prf_id', $id);
     $query = $this->db->get();
     return $query->row();
    }


    function retrieve_needed_supplier_sample($data){
        $query = $this->db->query("select supplier.supplier_id, concat(person.lastname,', ', person.firstname,' ', person.middlename) as supplier_name, client_type.client_type_name as supplier_type, status.status_name from supplier 
            inner join person on supplier.client_type_id= '1' and supplier.reference_id = person.person_id
            inner join client_type on supplier.client_type_id = client_type.client_type_id 
            inner join status on status.status_id = supplier.status_id
            UNION
            select supplier.supplierplier_id, organization.organization_name as supplier_name, client_type.client_type_name as supplier_type, status.status_name from supplier 
            inner join organization on supplier.client_type_id = '2' and supplier.reference_id = organization.organization_id
            inner join client_type on supplier.client_type_id = client_type.client_type_id
            inner join status on status.status_id = supplier.status_id
            order by supplier_id");
        $this->db->where('supplier_id',$data);
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


    function getReportHead($id)
    {
     $this->db->select('*');
     $this->db->from('prf a'); 
     $this->db->join('person b', 'a.requested_by_id = b.person_id', 'inner');  
     $this->db->join('department c', 'a.department_id = c.department_id', 'inner');
     $this->db->where('a.prf_id', $id);
     $query = $this->db->get();
     return $query->row();
    }


    function reportHead($id)
    {
     $this->db->select('*');
     $this->db->from('prf a'); 
     $this->db->join('person b', 'a.requested_by_id = b.person_id', 'inner');  
     $this->db->join('department c', 'a.department_id = c.department_id', 'inner');
     $this->db->join('canvass d', 'a.prf_id = d.prf_id', 'inner'); 
     $this->db->where('a.prf_id', $id);
     $query = $this->db->get();
     return $query->row();
    }


    function getReportDetails($id)
    {
    $this->db->select('*');
    $this->db->from('canvass_detail a');
    $this->db->join('item c', 'a.item_id = c.item_id', 'inner');
    $this->db->where('prf_id', $id);
    $this->db->where('is_approved', 1);
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
     $query = $this->db->get();
    return $query->result_array();
    }

    function getCanvassHead($canvass_id)
    {
     $this->db->select('*');
     $this->db->from('prf a'); 
     $this->db->join('person b', 'a.requested_by_id = b.person_id', 'inner');  
     $this->db->join('quotation c', 'a.prf_id = c.prf_id', 'inner');  
     $this->db->where('a.prf_id', $canvass_id);
     $query = $this->db->get();
     return $query->row();
    }

   function retrieve($canvass_id)
    {
     $this->db->select('*');
     $this->db->from('canvass_detail a'); 
     // $this->db->join('person b', 'a.requested_by_id = b.person_id', 'inner');  
     // $this->db->join('quotation c', 'a.prf_id = c.prf_id', 'inner');  
     $this->db->where('a.prf_id', $canvass_id);
     $query = $this->db->get();
     return $query->row();
    }

    function getPrfDetails()
    {
     $this->db->select('*');
     $this->db->from('prf a');  
     $this->db->join('person b', 'a.requested_by_id = b.person_id', 'inner');
     $this->db->join('department c', 'a.department_id = c.department_id', 'inner');
     // $this->db->where('a.prf_status_id', 0);   
     $query = $this->db->get();
     return $query->result_array();
    }

    function getCanvassDetails($prf_id)
    {
     $this->db->select('*');

     // $this->db->from('prf a');
     // $this->db->join('prf_detail b', 'a.prf_id = b.prf_id', 'inner');
     // $this->db->join('canvass_detail c', 'a.prf_id = c.prf_id', 'left');
     // $this->db->join('item d', 'c.item_id = d.item_id', 'inner'); 
     // $this->db->join('budget_detail e', 'b.budget_id = e.budget_id', 'left'); 
     // $this->db->where('c.prf_id', $prf_id);

     $this->db->from('canvass_detail a'); 
     $this->db->join('item c', 'a.item_id = c.item_id', 'inner'); 
     $this->db->join('budget_detail d', 'a.budget_id = d.budget_id', 'left'); 
     $this->db->where('a.prf_id', $prf_id);

     // $this->db->from('canvass_detail a');     
     // $this->db->join('item b', 'a.item_id = b.item_id', 'inner');
     // $this->db->join('canvass c', 'a.canvass_id = c.canvass_id', 'inner');
     // // $this->db->join('prf d', 'c.prf_id = d.prf_id', 'inner');
     // // $this->db->join('prf_detail e', 'c.prf_id = e.prf_id', 'inner'); 
     // $this->db->where('a.canvass_id', $canvass_id);
     $query = $this->db->get();
     return $query->result_array();
    }

    
    // function getDetails($canvass_id)
    // {
    //  $this->db->select('*');

    //  // $this->db->from('prf a');
    //  // $this->db->join('canvass b', 'a.prf_id = b.prf_id', 'inner');
    //  // $this->db->join('canvass_detail c', 'b.canvass_id = c.canvass_id', 'inner');
    //  // $this->db->join('item d', 'c.item_id = d.item_id', 'inner'); 
    //  // $this->db->where('b.prf_id', $canvass_id);

    //  $this->db->from('canvass_detail a');     
    //  $this->db->join('item b', 'a.item_id = b.item_id', 'inner');
    //  $this->db->join('canvass c', 'a.canvass_id = c.canvass_id', 'inner');
    //  // $this->db->join('prf d', 'c.prf_id = d.prf_id', 'inner');
    //  // $this->db->join('prf_detail e', 'c.prf_id = e.prf_id', 'inner'); 
    //  $this->db->where('a.canvass_id', $canvass_id);
    //  $query = $this->db->get();
    //  return $query->result_array();
    // }

    function puchase_order_head($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a'); 
     $this->db->join('person b', 'a.requested_by_id = b.person_id', 'inner');
     $this->db->join('quotation c', 'a.prf_id = c.prf_id', 'inner'); 
     $this->db->where('a.prf_id', $prf_id);
     $query = $this->db->get();
     return $query->row();
    }

    function get_quotation_details($id)
    {
     $this->db->select('*');
     $this->db->from('quotation_detail a');    
     $this->db->join('item c','a.item_id = c.item_id','inner');
     $this->db->where('quotation_id', $id);
     $query = $this->db->get();
     return $query->result_array();
     }

  
   function selected_item($sid,$pid)
   {
        $this->db->select('*');
        $this->db->from('prf a');
        $this->db->join('quotation b','a.prf_id = b.prf_id','inner');
        $this->db->join('quotation_detail c','b.quotation_id = c.quotation_id','inner');
        $this->db->join('item d','c.item_id = d.item_id','inner');       
        $this->db->where('b.prf_id', $pid);  
        $this->db->where('c.supplier_id', $sid);
        $query = $this->db->get();
        return $query->result_array();
    }

   // function budget_by_department($item_id,$prf_id)
   //  {
   //      $this->db->select('*');
   //      $this->db->from('prf a');
   //      $this->db->join('prf_detail b','a.prf_id = b.prf_id','inner');
   //      $this->db->where('b.item_id = ',$item_id);
   //      $this->db->where('b.prf_id = ',$prf_id);
   //      $query = $this->db->get();
   //      return $query->result_array();
   //  }

   //   function selected_item($sid,$item_id,$pid)
   // {
   //      $this->db->select('*');
   //      $this->db->from('prf a');
   //      $this->db->join('quotation b','a.prf_id = b.prf_id','inner');
   //      $this->db->join('quotation_detail c','b.quotation_id = c.quotation_id','inner');
   //      $this->db->join('item d','c.item_id = d.item_id','inner');       
   //      $this->db->where('b.prf_id', $pid);  
   //      //$this->db->where('c.prf_id', $pid);  
   //      $this->db->where('c.item_id', $item_id); 
   //      $this->db->where('c.supplier_id', $sid);
   //      $query = $this->db->get();
   //      return $query->result_array();
   //  }

    function budget_by_department($item_id,$prf_id)
    {
        $this->db->select('*');
        $this->db->from('quotation a');
        $this->db->join('quotation_detail b','a.prf_id = b.prf_id','inner');
        $this->db->join('item_uommaster c', 'b.quote_unit = c.uom_id', 'inner');        
        $this->db->where('b.item_id = ',$item_id);
        $this->db->where('b.prf_id = ',$prf_id);
        $query = $this->db->get();
        return $query->result_array();       

    }

      function insert_canvass($data)
    {
        $this->db->trans_start();
        $this->db->insert('canvass', $data);
        $lastCanvass = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastCanvass;

    }

    function insert_canvass_detail($id)
    {
        $this->db->trans_start();
        $this->db->insert('canvass_detail', $id);
        $lastDetails = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastDetails;
    }

          function insert_po_model($data)
    {
        $this->db->trans_start();
        $this->db->insert('purchase_order', $data);
        $lastPO = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastPO;

    }
        function insert_po_details_model($data)
    {
        $this->db->trans_start();
        $this->db->insert('purchase_order_detail', $data);
        $lastPO = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastPO;

    }

 
}

