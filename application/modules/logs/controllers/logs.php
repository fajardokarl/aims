<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Logs extends CI_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->model('Logs_model','logs');

        $this->data['customjs'] = 'logs/js/logscustomjs';
        //$this->data['customcss'] = 'logs/css/customcss';
    }

    public function index()
    {
        $this->data['content'] = 'logs_list';
        $this->data['page_title'] = 'User Logs';
        $this->data['logs'] = $this->logs->get_logs();
        $this->load->view('default/index', $this->data);
    }

    public function user()
    {
        $user_id = $this->uri->segment(3)?:'';
        $this->data['content'] = 'user_logs';
        $this->data['page_title'] = 'User Logs';
        $this->data['logs'] = $this->logs->get_user_log($user_id);
        $this->load->view('default/index', $this->data);
    }

    public function object()
    {
        $user_id = $this->uri->segment(3)?:'';
        $this->data['content'] = 'user_logs';
        $this->data['page_title'] = 'User Logs';
        $this->data['logs'] = $this->logs->get_object_log($user_id);
        $this->load->view('default/index', $this->data);
    }



}