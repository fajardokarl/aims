<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Engineering_model extends CI_Model {


	public function __construct()
    {
        // call parent constructor
        parent::__construct();

    }


   	function get_projects_model(){
      // $this->db->select('a.project_id, project_name, COUNT(*) AS num_lot', FALSE);
    	$this->db->select('a.project_id, project_name, COUNT(*) AS num_lot', FALSE);
      $this->db->from('project a');
      $this->db->join('lot b', 'b.project_id = a.project_id', 'left');
      $this->db->where('b.project_id !=', null);
     	$this->db->group_by('b.project_id');
      $query = $this->db->get();
      return $query->result_array();
    }

    function save_project_model($data){
      $this->db->trans_start();
      $this->db->insert('project', $data);
      $id = $this->db->insert_id();
      $this->db->trans_complete();

      return $id;
    }

    function get_project_model($id){
      $this->db->select('*');
      $this->db->from('project');
      $this->db->where('project_id', $id);
      $query = $this->db->get();
      return $query->result_array();
    }

    function save_project_changes_model($id, $data){
      $this->db->trans_start();
      $this->db->where('project_id', $id);
      $this->db->update('project', $data);
      $this->db->trans_complete();
    }

    function get_allprojects_model(){
      $this->db->select('*');
      $this->db->from('project');
      $query = $this->db->get();
      return $query->result_array();
    }
    function get_phases_model(){
      $this->db->select('*');
      $this->db->from('phase');
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_all_phase_model($id){
      $query = $this->db->query('select * FROM phase WHERE phase_id NOT IN (SELECT phase_id FROM lot WHERE project_id = ' . $id .')');
      return $query->result_array();
    }

    function save_lots_model($data){
      $this->db->trans_start();
      $this->db->insert('lot', $data);
      $this->db->trans_complete();
    }
  }