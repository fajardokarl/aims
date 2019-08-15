<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sample extends CI_Controller {
function index()
	{
		

		// $this->load->library('layouts');

		// $this->layouts->set_title('Welcom Home!');	

		// 											  //foldername/filename	
		// $this->layouts->view('home',array('latest' => 'sidebar/latest')); 


		if(!isset($this->session->userdata['logged_in'])){
            redirect('logout', 'refresh');
        }

        $this->data['page_title'] = 'IT Services';
        $this->data['content'] = 'sample';
      

        $this->load->view('default/index', $this->data);
	
	}  
	
}
	
