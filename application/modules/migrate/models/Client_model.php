<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends CI_Model {

    public function insert($client)
    {
        $this->db->insert('client', $client);
    }

    public function insert_customer($customer, $customer_id)
    {
    	$data = array(
    		'client_type_id' => 1,
    		'reference_id' => $customer_id
    	);
        $this->db->insert('client', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
}