<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lot extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Lot_model', 'lots');

    }

    public function index()
    {
        $lots_old = $this->lots->get_all_old();

        foreach ($lots_old as $lot_old)
        {
            $lot_id = $this->lots->insert_lot($lot_old);
        }

        $data['page_title'] = 'Lots';
        $data['userprofile'] = 'welcome/userprofile';
        $data['navigation'] = 'welcome/navigation';
        $data['content'] = 'content';

        $this->load->view('default/index', $data);
    }

}
