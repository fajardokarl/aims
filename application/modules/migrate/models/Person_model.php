<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Person_model extends CI_Model {

	public function __construct()
    {
        // call parent constructor
        parent::__construct();

    }

    public function get_all()
    {
        $query = $this->db->get('person');
        return $query->result();
    }

    public function find($customer)
    {
        $this->db->where('lastname',$customer->lastname);
        $this->db->where('firstname',$customer->firstname);
        $query = $this->db->get('person');

        //if($query->num_rows() == 1) akong gipulihan Aug 15 2017
        if($query->num_rows() >= 1)
        {
            return $query->row();
        } else {
            return false;
        }
    }

    public function insert_customer($customer)
    {
    	$data = array(
    		'lastname' => $customer->lastname,
    		'firstname' => $customer->firstname
    	);

		$this->db->insert('person', $data);
		$last_id = $this->db->insert_id();
		return $last_id;
	}
}