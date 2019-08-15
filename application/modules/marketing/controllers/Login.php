<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Login extends CI_Controller {
	//functions

private $data = array();

    function __construct(){
        // Construct the parent class
        parent::__construct();

        $this->load->model('Customer_model','add');
        $this->load->helper(array('form', 'url'));

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['navigation'] = 'marketing/navigation';
        $this->data['customjs'] = 'marketing/customjs';

    }



	public functions index(){


        $this->data['content'] = 'customers';
        $this->data['page_title'] = 'Marketing';
        //$data['customcss'] = 'marketing/customcss';

        $this->data['customer'] = $this->add->get_customers();
        $this->data['allcity'] = $this->add->getAllCity();
        $this->data['addtype'] = $this->add->getAddressType();
        $this->data['addcountry'] = $this->add->getAllCountry();
        $this->data['allprovince'] = $this->add->getAllProvince();
        $this->load->view('default/index', $this->data);
	}
	
	public function form_validation(){
		echo "weeeeeeee";
	}
