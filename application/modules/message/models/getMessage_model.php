<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class getMessage_model extends CI_Model
{


    function get_prf()
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner'); 
     $this->db->join('department c', 'c.department_id = a.department_id', 'inner');    
     // $this->db->where('a.prf_id = ',$prfid);
     $query = $this->db->get();
     return $query->result_array();
     }

    function get_verifies()
    {
        $this->db->select('*');
        $this->db->from('prf a');
        $this->db->join('department b', 'b.department_id = a.department_id', 'inner');
        $this->db->join('document c', 'a.document_id = c.document_id', 'inner');
        $this->db->join('person d', 'a.requested_by_id = d.person_id', 'inner');
        // $this->db->where('b.department_id =', $dept_id);       
        $query = $this->db->get();
        return $query->result_array();
    }

<<<<<<< HEAD
    function my_prf_model($dept_id)
=======
    // function get_verifies($dept_id)
    function get_verifies()
>>>>>>> 90d04401af680771cfbe33047da30f1942436631
    {
        $this->db->select('*');
        $this->db->from('prf a');
        $this->db->join('department b', 'b.department_id = a.department_id', 'inner');
        $this->db->join('document c', 'a.document_id = c.document_id', 'inner');
        $this->db->join('person d', 'a.requested_by_id = d.person_id', 'inner');
<<<<<<< HEAD
        $this->db->where('b.department_id =', $dept_id);       
=======
        // $this->db->where('b.department_id =', $dept_id);
>>>>>>> 90d04401af680771cfbe33047da30f1942436631
        $query = $this->db->get();
        return $query->result_array();
    }

     function get_message($prfid)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->where('a.prf_id = ',$prfid);
     $query = $this->db->get();
     return $query->result_array();
     }


     function get_message_details($prfid)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');      
     $this->db->where('a.prf_id = ',$prfid);
     $query = $this->db->get();
     return $query->result_array();
     }

    function myPRFhead($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');    
     $this->db->join('person c', 'a.requested_by_id = c.person_id', 'inner');     
     $this->db->where('a.prf_id', $prf_id);
     $query = $this->db->get();
     return $query->row();
    }
    
    function myPRFdetails($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner'); 
     $this->db->join('item c', 'b.item_id = c.item_id', 'inner');
     $this->db->join('item_uommaster d', 'b.prf_uom_id = d.uom_id', 'inner');
     //$this->db->join('warehouse e', 'b.deliver = e.warehouse_id', 'inner');        
     $this->db->where('b.prf_id = ',$prf_id);
     $query = $this->db->get();
     return $query->result_array();
     }

    function getOnePrf($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->join('person c', 'a.requested_by_id = c.person_id', 'inner');
     // $this->db->join('item c', 'b.item_id = c.item_id', 'inner'); 
     // $this->db->join('person g', 'a.requested_by_id = g.person_id', 'inner');
     // $this->db->join('department f', 'f.department_id = a.department_id', 'inner');
     // $this->db->join('project h', 'a.project_id = h.project_id', 'inner'); 
<<<<<<< HEAD
     $this->db->where('a.prf_id', $prf_id);
=======
     $this->db->where('a.prf_id =', $prf_id);
>>>>>>> 90d04401af680771cfbe33047da30f1942436631
     $query = $this->db->get();
     return $query->row();
    }


    function getUpdatedQty($prf_detail_id)
    {
     $this->db->select('*');
     $this->db->from('prf_detail a'); 
     $this->db->join('item c', 'a.item_id = c.item_id', 'inner'); 
     $this->db->join('budget_detail d', 'a.budget_id = d.budget_id', 'left'); 
     $this->db->where('a.prf_id', $prf_detail_id);
     $query = $this->db->get();
     return $query->result_array();
    }


      function get_request_head($prfid)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'left'); 
     $this->db->join('item c', 'b.item_id = c.item_id', 'left'); 
     $this->db->join('person g', 'a.requested_by_id = g.person_id', 'left');
     $this->db->join('department f', 'f.department_id = a.department_id', 'left');     
       $this->db->where('a.prf_id = ',$prfid);
     $query = $this->db->get();
     return $query->result_array();
     }

    /*function update_seen_receipt() // sets all seen_receipt to 1
    {
        $query = $this->db->query("UPDATE prf SET seen_receipt = 1");
    }*/

     function get_inbox_num()
     {
        $this->load->database();
        $this->db->trans_start();
        $this->db->select('COUNT(prf_id) as updated_prf_count');
        $this->db->from('prf');
        // $this->db->where('seen_receipt =', 1);
        $query = $this->db->get();
        $this->db->trans_complete();
        return $query->row();
     }


    function get_request_details($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->join('item c', 'b.item_id = c.item_id', 'inner'); 
     $this->db->join('person g', 'a.requested_by_id = g.person_id', 'inner');
     $this->db->join('department f', 'f.department_id = a.department_id', 'inner');
     // $this->db->join('project h', 'a.project_id = h.project_id', 'inner'); 
     $this->db->where('a.prf_id', $prf_id);
     $query = $this->db->get();
     return $query->row();
    }

    function getMyPRF($dept_id)
    {
     $this->db->select('*');      
     $this->db->from('prf a');
     // $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'right');
     // $this->db->join('item c', 'b.item_id = c.item_id', 'inner');
     // $this->db->join('item_uommaster e', 'b.prf_uom_id = e.uom_id', 'inner');
     // $this->db->join('warehouse f', 'b.deliver = f.warehouse_id', 'left'); 
     $this->db->join('department g', 'g.department_id = a.department_id', 'inner'); 
     $this->db->join('person h', 'a.requested_by_id = h.person_id', 'inner');      
     $this->db->where('g.department_id', $dept_id);
     $this->db->order_by('a.prf_id');
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
     

     function get_canvassed_details($prfid){
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->join('item c', 'c.item_id = b.item_id', 'inner');
     $this->db->join('item_uommaster d', 'd.uom_id = b.prf_uom_id', 'inner');
     $this->db->join('warehouse f', 'b.deliver = f.warehouse_id', 'inner');
     // $this->db->join('project g', 'a.project_id = g.project_id', 'inner');
     $this->db->where('a.prf_id = ',$prfid);
     $query = $this->db->get();
     return $query->result_array();
    }

      function getOnePrf_details($data)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->join('item c', 'b.item_id = c.item_id', 'inner');
     $this->db->join('item_uommaster e', 'b.prf_uom_id = e.uom_id', 'inner');
     $this->db->join('person g', 'a.requested_by_id = g.person_id', 'inner');
     $this->db->join('department f', 'f.department_id = a.department_id', 'inner');
     $this->db->join('project h', 'a.project_id = h.project_id', 'inner');
     $this->db->where('b.prf_id', $data);
     $query = $this->db->get();
     return $query->row();
    }  


    //---------test here start----
    function toPDF($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->join('person c', 'a.requested_by_id = c.person_id', 'inner');
     $this->db->join('department d', 'a.department_id = d.department_id', 'inner');  
     $this->db->join('lot e', 'a.lot_id = e.lot_id', 'left');  
     $this->db->join('project f', 'a.project_id = f.project_id', 'left');  
     $this->db->where('b.prf_id', $prf_id);
     $query = $this->db->get();
     return $query->row();
    }

    function get_prf_details($prf_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'left');
     $this->db->join('item c', 'b.item_id = c.item_id', 'left');
     $this->db->join('item_uommaster e', 'b.prf_uom_id = e.uom_id', 'left');
     $this->db->join('warehouse f', 'b.deliver = f.warehouse_id', 'left');   
     $this->db->where('b.prf_id', $prf_id);
     $query = $this->db->get();
     return $query->result_array();
     }
//-------test end here-----
    
     function get_details($prfid){
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'b.prf_id = a.prf_id', 'inner');
     $this->db->where('a.prf_id',$prfid);
     $query = $this->db->get();
     return $query->result_array();
    }

    function updateStatus($info, $id){
        $this->db->where('prf_id', $id);
        $this->db->update('prf', $info);
    }
<<<<<<< HEAD

    function change_status_model($id, $data){
        $this->db->trans_start();
        $this->db->where('prf_detail_id', $id);
        $this->db->update('prf_detail', $data);
        $this->db->trans_complete();
=======

    function updateRemark($info, $prf_id) {
        $this->db->where('prf_id', $prf_id);
        $this->db->update('prf', $info);
    }

    function updateSeenReceipt($info, $prf_id) {
        $this->db->where('prf_id', $prf_id);
        $this->db->update('prf', $info);
    }

    function getPrfDocRemark($prf_id) {
        $this->db->select('document_remark');
        $this->db->from('prf');
        $this->db->where('prf_id', $prf_id);
        $query = $this->db->get();
        return $query->row();
>>>>>>> 90d04401af680771cfbe33047da30f1942436631
    }

    function get_prf_detail($detail_id)
    {
     $this->db->select('*');
     $this->db->from('prf a');
     $this->db->join('prf_detail b', 'a.prf_id = b.prf_id', 'right');    
     $this->db->where('b.prf_detail_id',$detail_id);
     $query = $this->db->get();
     return $query->result_array();
     }

 function get_prf_sum($detail_id)
    {
     $this->db->select('sum(sub_total) as subtotal');
     $this->db->from('prf_detail');      
     $this->db->where('prf_id',$detail_id);
     $query = $this->db->get();
     return $query->row();
     }

   function update_prf_model($prf_id, $data){
    $this->db->trans_start();
     $this->db->where('prf_id', $prf_id);
    $this->db->update('prf', $data);
   
    $this->db->trans_complete();
    }

    function update_detail_model($prf_detail_id, $data2){
    $this->db->trans_start();
    $this->db->where('prf_detail_id', $prf_detail_id);
    $this->db->update('prf_detail', $data2);

   
    $this->db->trans_complete();
    }
}