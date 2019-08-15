<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class Contracts extends CI_Controller {
    private $data = array();

    function __construct(){
        // Construct the parent class
        parent::__construct();

        $this->load->model('Contract_model','contract');
        $this->load->helper(array('form', 'url'));
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['navigation'] = 'marketing/navigation';
        $this->data['customjs'] = 'marketing/customjs';
    }

    public function index(){
        // $this->data['heading'] = 'To be implemented';
        // $this->data['message'] = 'This module is to be implemented in the future';
        $this->data['content'] = 'contractsmasterlist';
        $this->data['all_contracts'] = $this->contract->get_contracts_model();
        $this->data['page_title'] = 'Sales and Marketing';
        $this->load->view('default/index', $this->data);
        // $this->load->view('errors/html/error_general', $this->data);
    }


}
?>