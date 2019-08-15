<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Receiving_model extends CI_Model {
	public function __construct()
    {
        // call parent constructor
        parent::__construct();
    }


// SELECTS---------------
	function get_warehouse_model(){
        $this->db->select('*');
        $this->db->from('warehouse');
        $query = $this->db->get();
        return $query->result_array();
    }

    function item_list_model(){
    	$this->db->select('*');
    	$this->db->from('item');
      	$query = $this->db->get();
      	return $query->result_array();
    }

    function get_item_uom_model($id){
        $this->db->select('*');
        $this->db->from('item_relationuom a');
        $this->db->join('item b', 'b.item_id = a.item_id', 'inner');
        $this->db->join('item_uommaster c', 'c.uom_id = a.uom_id', 'inner');
        $this->db->where('a.item_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
     function get_item_uominv_model($id, $warehouse){
        $this->db->select('*');
        $this->db->from('item_relationuom a');
        $this->db->join('item b', 'b.item_id = a.item_id', 'inner');
        $this->db->join('item_uommaster c', 'c.uom_id = a.uom_id', 'inner');
        $this->db->join('item_inventory d', 'b.item_id = d.item_id', 'inner');
        $this->db->where('a.item_id', $id);
        $this->db->where('d.warehouse_id', $warehouse);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_suppliers_model(){
        $this->db->select('organization_name, CONCAT(c.lastname, ", ", c.firstname) as supp_name, supplier_id, a.client_type_id');
        $this->db->from('supplier a');
        $this->db->join('organization b', 'a.reference_id = b.organization_id', 'left');
        $this->db->join('person c', 'a.reference_id = c.person_id', 'left');
        $this->db->join('client_type d', 'a.client_type_id = d.client_type_id', 'inner');	
        $query = $this->db->get();
        return $query->result_array();

    }

    function get_iteminventory_model($item, $warehouse){
    	$this->db->select('*');
    	$this->db->from('item_inventory');
    	$this->db->where('item_id', $item);
    	$this->db->where('warehouse_id', $warehouse);
        $query = $this->db->get();
        return $query->row();
    }
    function get_iteminventory_model2($item, $warehouse){
        $this->db->select('*');
        $this->db->from('item_inventory');
        $this->db->where('item_id', $item);
        $this->db->where('warehouse_id', $warehouse);
        $query = $this->db->get();
        return $query->row();

    }

    function get_allpo_model(){
        $this->db->select('*');
        $this->db->from('purchase_order a');
        $this->db->join('supplier b', 'a.supplier_id = b.supplier_id', 'inner');
        $this->db->join('organization c', 'b.reference_id = c.organization_id', 'inner');
        $this->db->where('po_num !=', null);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_onepo_model($po_id){
        $this->db->select('*');
        $this->db->from('purchase_order_detail a');
        $this->db->join('purchase_order b', 'a.po_id = b.po_id', 'inner');
        $this->db->join('item_uommaster c', 'a.po_uom_id = c.uom_id', 'inner');
        $this->db->join('item d', 'a.item_id = d.item_id', 'inner');
        $this->db->where('a.po_id', $po_id);

        $query = $this->db->get();
        return $query->result_array();       
    }
    
    function get_onerr_model($id){
        $this->db->select('*');
        $this->db->from('receiving_report_detail a');
        $this->db->join('item b', 'a.item_id = b.item_id', 'inner');
        $this->db->where('a.rr_id', $id);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_allcategories_model(){
        $this->db->select('*');
        $this->db->from('category');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_itembycat_model($cat_id){
        $this->db->select('*');
        $this->db->from('item a');
        $this->db->join('item_relationuom b', 'a.item_id = b.item_id', 'left');
        $this->db->join('item_uommaster c', 'b.uom_id = c.uom_id', 'left');
        $this->db->where('a.category_code', $cat_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_itemsearch_model($item){
        $this->db->select('*');
        $this->db->from('item a');
        $this->db->join('item_relationuom b', 'a.item_id = b.item_id', 'left');
        $this->db->join('item_uommaster c', 'b.uom_id = c.uom_id', 'left');
        $this->db->like('description', $item );
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_allproject_model(){
        $this->db->select('*');
        $this->db->from('project');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_inventoryitems_model($warehouse_id){
        $this->db->select('*');
        $this->db->from('item_inventory a');
        $this->db->join('item b', 'a.item_id = b.item_id', 'inner');
        $this->db->where('a.warehouse_id', $warehouse_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_allissuance_model(){
        $this->db->select('*');
        $this->db->from('issuance a');
        $this->db->join('project b', 'a.issuance_project = b.project_id', 'inner');
        $this->db->join('warehouse c', 'a.warehouse_id = c.warehouse_id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_issuance_model($id){
        $this->db->select('*');
        $this->db->from('issuance_detail a');
        $this->db->join('issuance b', 'a.issuance_id = b.issuance_id', 'inner');
        $this->db->join('item_uommaster c', 'a.issuance_uom_id = c.uom_id', 'inner');
        $this->db->join('item d', 'a.item_id = d.item_id', 'inner');
        $this->db->where('a.issuance_id', $id);

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_alluom_model(){
        $this->db->select('*');
        $this->db->from('item_uommaster');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_allreceiving_model(){
        $this->db->select('*');
        $this->db->from('receiving_report');
        $query = $this->db->get();
        return $query->result_array();
    }



// INSERTS---------------
     function insert_po_model($data){
        $this->db->trans_start();
        $this->db->insert('purchase_order', $data);
        $bom = $this->db->insert_id();
        $this->db->trans_complete();
        return $bom;
    }

    function insert_po_details_model($data){
        $this->db->trans_start();
        $this->db->insert('purchase_order_detail', $data);
        $this->db->trans_complete();
    }
    
    function insert_iteminventory_model($data){
    	$this->db->trans_start();
        $this->db->insert('item_inventory', $data);
        $this->db->trans_complete();
    }

    function insert_rr_model($data){
        $this->db->trans_start();
        $this->db->insert('receiving_report', $data);
        $rr = $this->db->insert_id();
        $this->db->trans_complete();
        return $rr;
    }

    function insert_rrdetail_model($data){
        $this->db->trans_start();
        $this->db->insert('receiving_report_detail', $data);
        $this->db->trans_complete();
    }

    function insert_item_model($data){
        $this->db->trans_start();
        $this->db->insert('item', $data);
        $item = $this->db->insert_id();
        $this->db->trans_complete();
        return $item;
    }

    function insert_uom_model($data){
        $this->db->trans_start();
        $this->db->insert('item_relationuom', $data);
        $this->db->trans_complete();
    }

    function insert_issuance_model($data){
        $this->db->trans_start();
        $this->db->insert('issuance', $data);
        $iss = $this->db->insert_id();
        $this->db->trans_complete();
        return $iss;
    }

    function insert_issuancedetail_model($data){
        $this->db->trans_start();
        $this->db->insert('issuance_detail', $data);
        $this->db->trans_complete();
    }


// UPDATES--------------- 

    function update_itemqty_model($item, $warehouse, $data){
    	// $this->db->trans_start();
        $this->db->where('item_id', $item);
        $this->db->where('warehouse_id', $warehouse);
        $this->db->update('item_inventory', $data);
        // $this->db->trans_complete();
    }
    function update_poamount_model($id, $data){
        $this->db->trans_start();
        $this->db->where('po_id', $id);
        $this->db->update('purchase_order', $data);
        $this->db->trans_complete();
    }

    function update_pod_model($pod, $data){
        $this->db->trans_start();
        $this->db->where('pod_id', $pod);
        $this->db->update('purchase_order_detail', $data);
        $this->db->trans_complete();
    }
}

