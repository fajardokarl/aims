<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Engineering extends CI_Controller {

	private $data = array();

	  function __construct(){
        // Construct the parent class
        parent::__construct();
        // model init for 'Logs'
        $this->load->model('logs/Logs_model', 'logs');
        // model init for 'Users'
        $this->load->model('users/Users_model','users');
        // main model
        $this->load->model('Engineering_model','engrg');
        // $this->load->model('Customer_model','customer');

        $this->load->helper(array('form', 'url'));

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['navigation'] = 'engineering/navigation';
        $this->data['customjs'] = 'engineering/customjs';

    }
 
    public function index(){
        $this->data['content'] = 'dashboard';
        $this->data['page_title'] = 'Engineering and Construction';

        $this->load->view('default/index', $this->data);     
    }

    public function projects(){
        $this->data['content'] = 'projects_list';
        // $this->data['customjs'] = 'engineering/projectjs';
        $this->data['page_title'] = 'Engineering and Construction | Projects Listing';
        $this->data['project_list'] = $this->engrg->get_projects_model();

        $this->data['projects'] = $this->engrg->get_allprojects_model();
        // $this->data['phase'] = $this->engrg->get_all_phase_model();
        $this->load->view('default/index', $this->data);    
	}

     public function masterplan(){
        $this->data['content'] = 'master_plan';
        // $this->data['customjs'] = 'engineering/projectjs';
        $this->data['page_title'] = 'Engineering and Construction | Masterplan';
        $this->data['project_list'] = $this->engrg->get_projects_model();
        $this->data['projects'] = $this->engrg->get_allprojects_model();
        // $this->data['phase'] = $this->engrg->get_all_phase_model();
        $this->load->view('default/index', $this->data);    
    }
    

//INSERTS & UPDATES

    public function save_project(){
        $data = array(
            'project_name' => $this->input->post('project_name'),
            'project_description' => $this->input->post('project_description')
        );
        
        $last_proj_id = $this->engrg->save_project_model($data);

        $user = $this->users->get_user($this->session->userdata('user_id'));
        $log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'engineering Module',
            'object'=>'engineering',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " inserted new project ID " . $last_proj_id
        );
        $this->logs->log($log_entry);

        echo json_encode($last_proj_id);

    }

    public function save_project_changes(){
        $id = $this->input->post('proj_id');
        $data = array(
            'project_name' => $this->input->post('project_name'),
            'project_description' => $this->input->post('project_description')
        );
        echo json_encode($this->engrg->save_project_changes_model($id, $data));

        $user = $this->users->get_user($this->session->userdata('user_id'));
        $log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'engineering Module',
            'object'=>'engineering',
            'event_type'=>'update',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " updated project ID " . $id
        );
        $this->logs->log($log_entry);

    }

    public function save_lots(){
        $arr = $this->input->post('lot_arr');
        $proj_name = $this->input->post('proj_name');
        $proj_desc = $this->input->post('proj_desc');
        $new_proj  = $this->input->post('new_proj');
        $id;

        if ($new_proj == 1) {
            $proj = array(
                'project_name' => $proj_name,
                'project_description' => $proj_desc,
            );
            $id = $this->engrg->save_project_model($proj);


            $proj_id = $id;
            foreach ($arr as $key => $value) {
                $data = array(
                    'project_id' => $proj_id,
                    'phase_id' => $value['phase_id'],
                    'block_no' => $value['block_no'],
                    'lot_no' => $value['lot_no'],
                    'lot_description' => $value['lot_description'],
                    'lot_area' => $value['lot_area'],
                    'with_house' => $value['with_house'],
                    'status_id' => 1,
                    'availability' => 1
                );
                // echo json_encode($this->engrg->save_lots_model($data));
                $this->engrg->save_lots_model($data);

                $user = $this->users->get_user($this->session->userdata('user_id'));
                $log_entry = array(
                    'log_date'=>date('Y-m-d H:i:s'),
                    'user_id'=>$user['user_id'],
                    'location'=>'engineering Module',
                    'object'=>'engineering',
                    'event_type'=>'insert',
                    'description'=>$user['lastname'] . ", " . $user['firstname'] . " inserted new project ID " . $id . 'with lots'
                );
                $this->logs->log($log_entry);

            }
        }else{
            $proj_id = $value['project_id'];
            foreach ($arr as $key => $value) {
                $data = array(
                    'project_id' => $proj_id,
                    'phase_id' => $value['phase_id'],
                    'block_no' => $value['block_no'],
                    'lot_no' => $value['lot_no'],
                    'lot_description' => $value['lot_description'],
                    'lot_area' => $value['lot_area'],
                    'with_house' => $value['with_house'],
                    'status_id' => 1,
                    'availability' => 1
                );
                // echo json_encode($this->engrg->save_lots_model($data));
                $this->engrg->save_lots_model($data);
            }

            $user = $this->users->get_user($this->session->userdata('user_id'));
            $log_entry = array(
                'log_date'=>date('Y-m-d H:i:s'),
                'user_id'=>$user['user_id'],
                'location'=>'engineering Module',
                'object'=>'engineering',
                'event_type'=>'insert',
                'description'=>$user['lastname'] . ", " . $user['firstname'] . " inserted new lots of Project ID " . $proj_id
            );
            $this->logs->log($log_entry);
        }
        
    }

//SELECTS

    public function get_project(){
        $id = $this->input->post('proj_id');
        echo json_encode($this->engrg->get_project_model($id));
    }

    public function get_all_phase(){
        $id = $this->input->post('proj_id');
        echo json_encode($this->engrg->get_all_phase_model($id));
    }
    
    public function get_phases(){
        echo json_encode($this->engrg->get_phases_model());
    }
 
    
    // public function save_lots(){
    //     $arr = $this->input->post('lot_arr');
    //     $id;

    //     foreach ($arr as $key => $value) {
    //         $proj_id = $value['project_id'];
    //         $data = array(
    //             'project_id' => $proj_id,
    //             'phase_id' => $value['phase_id'],
    //             'block_no' => $value['block_no'],
    //             'lot_no' => $value['lot_no'],
    //             'lot_description' => $value['lot_description'],
    //             'lot_area' => $value['lot_area'],
    //             'with_house' => $value['with_house'],
    //             'status_id' => 1,
    //             'availability' => 1
    //         );
    //         $this->engrg->save_lots_model($data);
    //     }
    //     // echo json_encode($arr);
    // }


}