<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Department extends CI_Controller 
{
    public function __construct(){
        parent::__construct();
        $this->load->model('department_model',"departments");       
        $this->load->model('route_model');
        $this->load->model('department_manager_model');
        $this->load->helper(array('form', 'url'));  
        $this->data['customjs'] = 'department_js';
    }

    public function index(){
        $this->data['content'] = 'department_list';
        $this->data['page_title'] = 'Department';
        $this->data['navigation'] = 'navigation'; 
        
        if(isset($this->session->userdata['logged_in'])){

            $this->data['records'] = $this->departments->get_departments();
            $this->data['manager'] = $this->department_manager_model->get_Manager();
            $this->data['all_routes'] = $this->route_model->get_Route();
        
            $this->load->view('default/index', $this->data);
        }
    }   
    public function inbox()
    {

        if(isset($this->session->userdata['logged_in'])){
        $this->load->library('layouts');

        $this->layouts->set_title('Welcom Home!');
                                                      //foldername/filename 
        $this->layouts->view('home',array('latest' => 'sidebar/latest')); 
        
        }
    }

    public function edit_submit()
    {
        $user_id = (int) $this->input->post('user_id')?:0;
        $username = $this->input->post('username')?:'';
        $password = $this->input->post('password')?:'';
        $email = $this->input->post('email')?:'';
        $verified = $this->input->post('verified')?:0;
        $status_id = (int) $this->input->post('status_id')?:0;
        $user = array(
            'user_id' => $user_id,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'verified' => $verified,
            'status_id' => $status_id
        );
        echo json_encode($this->users->update_user($user,$user_id));
    }


    // public function update_department(){
    //  $info = [
    //      'department_id' => $this->input->post('department_id'),
    //      'department_code' => $this->input->post('department_code'),
    //      'department_name' => $this->input->post('department_name'),
    //      'swf_actiongeturl(url, target)vity_code' => $this->input->post('activity_code'),
    //      'route_id' => $this->input->post('route_id'),
    //      'status_id' => $this->input->post('status_id')
    //  ];
    //  $this->department_model->update_department($info);
    //  redirect('department', 'refresh');
    // }

    public function news()
    {
        $this->load->model('hris/Department_model','department');
        //$employees = $this->employees->get_all();
        $this->data['content'] = 'department_new';
        $this->data['page_title'] = 'Department Management';

        $this->load->view('default/index', $this->data);
    }



    // public function getDepartment(){
    //  $data = $this->department_model->getDepartmentByID($this->input->post('departmentid'));
    //  echo json_encode($data);
    // } 

    public function ajax_get_departments()
    {
        $this->load->model('hris/Department_model','departments');
        echo json_encode($this->departments->get_departments());
    }

public function ajax_insert_item()
    {
        // $item_specs = $_POST['item_specs'];
        // echo json_encode($this->request->insert_item($item_specs));
        echo ("HI WORLD!");
    }
 //    public function update_department() 
    // {   
    //  $department_id= $this->input->post('did');
    //     $data = array(
    //         'department' => 'department', // pass the real table name
    //         'department_id' => $this->input->post('department_id'),
    //         'status_id' => $this->input->post('status_id')
    //     );

    //     $this->load->model('hris/Department_model','departments'); // load the model first

    //      $this->db->where('department_id', $department_id);
 //        $this->db->update($department, array('status_id' => $status_id));
 //        return true;
    // }

    public function update_department()
    {

        $department_id = (int) $this->input->post('inputDepartmentId');
        $department_code = (string) $this->input->post('inputName');
        $activity_code = (string) $this->input->post('inputActivityCode'); 
        $department_name = (string) $this->input->post('inputDepartment');
        $route_id = (int) $this->input->post('inputRoute');       
        $status_id = (int) $this->input->post('inputDepartmentStatus');
        $department = array(
            'department_id' => $department_id,
            'department_code' => $department_code,
            'activity_code' => $activity_code,
            'department_name' => $department_name,
            'route_id' => $route_id,
            'status_id' => $status_id,
        );
        /*echo("Department id");
        print_r($this->input->post('department_id'));
        echo("Department status");
        print_r($this->input->post('inputDepartmentStatus'));*/
        $this->db->replace('department',$department); 
        /*print_r($department);
        $this->departments->update_department($department_id,$department);
        echo json_encode($this->departments->update_department($department_id,$department));*/
    }

    public function update_department_manager()
    {
        $manager_employee_id = (int) $this->input->post('manager_employee_id');
        $department_id = (int) $this->input->post('department_id');

        $this->db->select('employee_id');
        $this->db->from('department_manager');
        $this->db->where('department_id', $department_id);
        $query = $this->db->get();

        $manager = array(
            'department_id' => $department_id,
            'employee_id' => $manager_employee_id
        );

        if( $query->result_id->num_rows == 1 ) {
            print_r("UPDATE");
            print_r($query);
            print_r($manager);
            $this->db->where('department_id', $department_id);
            $this->db->update('department_manager', $manager);
        } else {
            print_r("INSERT");
            print_r($query);
            print_r($manager);
            $this->db->where('department_id', $department_id);
            $this->db->insert('department_manager', $manager);
        }
        // $department_employee_id = (int) $this->input->post('department_employee_id');
    }
}

/*INSERTCI_DB_mysqli_result Object
(
    [conn_id] => mysqli Object
        (
            [affected_rows] => 0
            [client_info] => mysqlnd 5.0.12-dev - 20150407 - $Id: b396954eeb2d1d9ed7902b8bae237b287f21ad9e $
            [client_version] => 50012
            [connect_errno] => 0
            [connect_error] => 
            [errno] => 0
            [error] => 
            [error_list] => Array
                (
                )

            [field_count] => 1
            [host_info] => localhost via TCP/IP
            [info] => 
            [insert_id] => 0
            [server_info] => 5.5.5-10.1.25-MariaDB
            [server_version] => 50505
            [stat] => Uptime: 502  Threads: 1  Questions: 775  Slow queries: 0  Opens: 37  Flush tables: 1  Open tables: 31  Queries per second avg: 1.543
            [sqlstate] => 00000
            [protocol_version] => 10
            [thread_id] => 102
            [warning_count] => 0
        )

    [result_id] => mysqli_result Object
        (
            [current_field] => 0
            [field_count] => 1
            [lengths] => 
            [num_rows] => 0
            [type] => 0
        )

    [result_array] => Array
        (
        )

    [result_object] => Array
        (
        )

    [custom_result_object] => Array
        (
        )

    [current_row] => 0
    [num_rows] => 
    [row_data] => 
)
Array
(
    [department_id] => 7
    [employee_id] => 12
)
*/

/*UPDATECI_DB_mysqli_result Object
(
    [conn_id] => mysqli Object
        (
            [affected_rows] => 1
            [client_info] => mysqlnd 5.0.12-dev - 20150407 - $Id: b396954eeb2d1d9ed7902b8bae237b287f21ad9e $
            [client_version] => 50012
            [connect_errno] => 0
            [connect_error] => 
            [errno] => 0
            [error] => 
            [error_list] => Array
                (
                )

            [field_count] => 1
            [host_info] => localhost via TCP/IP
            [info] => 
            [insert_id] => 0
            [server_info] => 5.5.5-10.1.25-MariaDB
            [server_version] => 50505
            [stat] => Uptime: 547  Threads: 1  Questions: 790  Slow queries: 0  Opens: 37  Flush tables: 1  Open tables: 31  Queries per second avg: 1.444
            [sqlstate] => 00000
            [protocol_version] => 10
            [thread_id] => 105
            [warning_count] => 0
        )

    [result_id] => mysqli_result Object
        (
            [current_field] => 0
            [field_count] => 1
            [lengths] => 
            [num_rows] => 1
            [type] => 0
        )

    [result_array] => Array
        (
        )

    [result_object] => Array
        (
            [0] => stdClass Object
                (
                    [employee_id] => 8
                )

        )

    [custom_result_object] => Array
        (
        )

    [current_row] => 0
    [num_rows] => 
    [row_data] => 
)
Array
(
    [department_id] => 7
    [employee_id] => 11
)
*/