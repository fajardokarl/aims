<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logs_model extends CI_Model
{

    function get_logs()
    {
        $this->db->select('*');
        $this->db->from('user_log');
        $this->db->join('user','user.user_id = user_log.user_id','inner');
        $this->db->order_by('user_log_id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function log($log_entry)
    {
        $this->db->insert('user_log', $log_entry); 
    }

    function get_user_log($user_id)
    {
        $this->db->select('*');
        $this->db->from('user_log');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('user_log_id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_object_log($object)
    {
        $this->db->select('*');
        $this->db->from('user_log');
        $this->db->where('object', $object);
        $this->db->order_by('user_log_id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}