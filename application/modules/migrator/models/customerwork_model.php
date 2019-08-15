<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customerwork_model extends CI_Model{
	public function insertCustomerWork($info)
	{
		$data = array(
        'organization_id' => $info['organization_id'],
        'address_id' => $info['address_id'],
        'occupation' => $info['occupation'],
        'job_title' => $info['job_title'],
        'monthly_gross_income' => $info['monthly_gross_income'],
        'source_of_funds' => $info['source_of_funds']
        );

    $this->db->insert('customer_work', $data);
    return $this->db->insert_id();  
	}

}//end class