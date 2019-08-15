<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model', 'customers');
        $this->load->model('Customeraccount_model', 'customer_accounts');
        $this->load->model('Person_model', 'persons');
        $this->load->model('Client_model', 'clients');
    }

	public function index()
	{
		// get all old customers
		// iterate on each 
		// if current iteration is not on persons table add it
		// if its already there check if the cust id is not on the table and add it

        /*code ni sir alfred na akong gipulihan August 15, 2017
		$customers_old = $this->customers->get_all_old();

		foreach ($customers_old as $customer_old)
        {
        	if($person = $this->persons->find($customer_old))
        	{
        		echo " found ";
        		if ($this->customers->find($customer_old))
        		{
        			echo " DUPLICATE <br>";
        			continue;
        		} else {
        			// insert to customers
        			echo " ADDED:".$person->person_id." <br>";
        			$this->customer_accounts->insert_customer($customer_old, $person->person_id);
        		}
        	} else {
        		// insert to persons
        		$person_id = $this->persons->insert_customer($customer_old);
        		// insert to customers
        		$customer_id = $this->customers->insert_customer($customer_old, $person_id);
        		// insert to client,
        		$this->clients->insert_customer($customer_old, $customer_id);
        		echo " NEW:".$person_id." <br>";
        	}

        }
        */



        set_time_limit(0);
        $customers_old = $this->customers->get_all_old();

        foreach ($customers_old as $customer_old) {

            $person = $this->persons->find($customer_old); 
            if ($person == false)
            {
                //insert to person table
                $person_id = $this->persons->insert_customer($customer_old);
                echo "Added to Person: ".$person_id;
                //$person = $this->persons->find($customer_old);
            } else {
                echo "Found Person: ".$person->person_id;
            }   

            $customer = $this->customers->find($person);
            if ($customer == false)
            {
            
                $customer_id = $this->customers->insert_customer($customer_old, $person->person_id);
                echo "  Added to Customer: ".$customer_id;
                //$customer = $this->customers->find($person);
            } else {
                echo "  Found Customer: ".$customer->customer_id;
            }

            //find customer account
            $customeraccount = $this->customer_accounts->find($customer);
            if ($customeraccount == false)
            {
            
                $customeraccount_id = $this->customer_accounts->insert_customer($customer_old, $person->person_id);
                echo "  Added to Customer Account: ".$customeraccount_id."<br />";
            } else {
                echo "  Found Customer Account: ".$customeraccount->customer_account_id."<br />";
            }   
        }//end sa foreach
		
        $data['persons'] = $this->persons->get_all();

		$data['page_title'] = 'Home Page';
		$data['userprofile'] = 'welcome/userprofile';
		$data['navigation'] = 'welcome/navigation';
		$data['content'] = 'content';

		$this->load->view('default/index', $data);
	}
}
