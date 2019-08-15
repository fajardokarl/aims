<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department_model extends CI_Model {

    public function __construct()
    {
        // call parent constructor
        parent::__construct();
    }

    function get_departments()
    {
        $this->db->select('*');
        $this->db->from('department');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    // public function update_department($data){

    //     $this->db->where('department_id', $department_id);
    //     $this->db->update($table_name, array('status_id' => $status_id));
    //     return true;
    // }
    function update_department($department,$id)
    {
        $this->db->where('department_id',$id); 
        $this->db->update('department',$department); 
        return $this->db->affected_rows();
    }

    // function insertDepartment($info){
    //     $data = array(
    //         'department_code' => $info['department_code'],
    //         'activity_code' => $info['activity_code'],
    //         'department_name' => $info['department_name'],
    //         'route_id' => $info['route_id'],
    //         'status_id' => $info['status_id']
    //         );

    //     $this->db->trans_start();
    //     $this->db->insert('department', $data);
    //     $this->db->trans_complete();
    // }

    // function updateDepartment($info){
    //     $data = array(
    //         'department_code' => $info['department_code'],
    //         'activity_code' => $info['activity_code'],
    //         'department_name' => $info['department_name'],
    //         'route_id' => $info['route_id'],
    //         'status_id' => $info['status_id']
    //     );

    //     $this->db->trans_start();
    // $this->db->where('department_id', $info['department_id']);
    // $this->db->update('department', $data);
    // $this->db->trans_complete();
    // }

    // function getDepartmentByID($id){
    //     $this->db->where('department_id', $id);
    //     $query = $this->db->get('department');
    //     return $query->result_array();
    // }
    
}