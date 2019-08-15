<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class create_canvass_model extends CI_Model
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

       function retrieve_all_items()
    {
         $this->db->select('*');
         $this->db->from('item');
         // $this->db->join('person b', 'a.person_id = b.person_id', 'inner');
         // $this->db->where('a.status_id', null);
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


}

