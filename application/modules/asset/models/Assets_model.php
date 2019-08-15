<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assets_model extends CI_Model {
	public function __construct()
    {
        // call parent constructor
        parent::__construct();
    }


// SELECTS---------------
    function get_dept_model(){
        $this->db->select('*');
        $this->db->from('department');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_location_model(){
        $this->db->select('*');
        $this->db->from('asset_location');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_emp_model(){
        $this->db->select('employee_id, a.person_id, lastname, firstname, middlename');
        $this->db->from('employee a');
        $this->db->join('person b', 'b.person_id = a.person_id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_assetno($id){
        $this->db->from('asset_barcode');
        $this->db->where('department_id', $id);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function get_assets_model(){
        $this->db->select('*');
        $this->db->from('asset_barcode a');
        $this->db->join('employee b', 'b.employee_id = a.employee_id', 'inner');
        $this->db->join('person c', 'c.person_id = b.person_id', 'inner');
        $this->db->join('asset_location d', 'd.asset_location_id = a.asset_location_id', 'left');
        $this->db->join('department e', 'e.department_id = a.department_id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function change_status_model($id, $data){
        $this->db->trans_start();
        $this->db->where('asset_barcode_id', $id);
        $this->db->update('asset_barcode', $data);
        $this->db->trans_complete();

    }


// INSERTS---------------
    function insert_assetbarcode_model($data){
        // $this->db->trans_start();
        $this->db->insert('asset_barcode', $data);
        $asst_bar = $this->db->insert_id();
        // $this->db->trans_complete();
        return $asst_bar;
    }



// UPDATES---------------
    function update_tagno_model($data, $id){
        $this->db->trans_start();
        $this->db->where('asset_barcode_id', $id);
        $this->db->update('asset_barcode', $data);
        $this->db->trans_complete();
    }

}