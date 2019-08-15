<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items_model extends CI_Model
{

    function getSupplier(){
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

    function retrieveAllItems()
    {
        $DB2 = $this->load->database('legacy', TRUE);
        $DB2->select('ItemId, ItemDescription');
        $DB2->from('item_inventorymaster');
        $DB2->order_by('ItemDescription', "ASC");
        $query = $DB2->get();
        return $query->result_array();
    }

    function retrieveAllCategories()
    {
        $this->db->select('category_code, description');
        $this->db->from('category');
        $query = $this->db->get();
        return $query->result_array();
    }

     function insert_quotation($data)
    {
        $this->db->trans_start();
        $this->db->insert('quotation', $data);
        $lastRequest = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastRequest;
    }

    function insert_quotation_details($items)
    {
        $this->db->trans_start();
        $this->db->insert('quotation_detail',$items);
        $lastItems = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastItems;
    }

    function insert_item($item_specs)
    {
        $this->db->trans_start();
        $this->db->insert('specs', $item_specs);
        $item = $this->db->insert_id();
        $this->db->trans_complete();
        return $item;
    }

    function select_items_category($cat_code)
    {
        $this->db->trans_start();
        $this->db->select("description");
        $this->db->from("category");
        $this->db->where("category_code", $cat_code[0]['CategoryCode']);
        $query = $this->db->get();
        $this->db->trans_complete();
        return $query->result_array();
    }

    function edit_item_specs($item_specs)
    {
        $this->db->where('specs_id',$item_specs['specs_id']); 
        $this->db->update('specs',$item_specs); 
        return $this->db->affected_rows();
    }

    function delete_spec($spec_id)
    {
        $this->db->trans_start();
        $this->db->where("specs_id", $spec_id);
        $this->db->delete("specs");
        $this->db->trans_complete();
        return 2;
    }

    function getItemSpecs()
    {
        $this->db->trans_start();
        $query = $this->db->query("select * from specs");
        $this->db->trans_complete();
        return $query->result_array();
    }

    function getItemName()
    {
        $this->db->select('legacy.item_inventorymaster.ItemId,legacy.item_inventorymaster.ItemDescription');
        $this->db->select('irmdb.specs.item_id')->from('irmdb.specs');
        $this->db->join('legacy.item_inventorymaster', 'legacy.item_inventorymaster.ItemId = irmdb.specs.item_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCategoryDescription()
    {
        $this->db->select('category.category_code,category.description');
        $this->db->select('specs.category')->from('specs');
        $this->db->join('category', 'category.category_code = specs.category');
        $query = $this->db->get();
        return $query->result_array();
    }

}