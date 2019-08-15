<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
// use Restserver\Libraries\REST_Controller;


// class Customers extends CI_Controller {
//     private $data = array();

//     function __construct(){
//         // Construct the parent class
//         parent::__construct();

//         $this->load->model('Customer_model','customer');
//         $this->load->helper(array('form', 'url'));

//         // Configure limits on our controller methods
//         // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
//         $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
//         $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
//         $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
//         $this->data['navigation'] = 'marketing/navigation';
//         // $this->data['customjs'] = 'marketing/customjs';

//     }

//     public function index()
//     {
//         $this->data['content'] = 'customers';
//         $this->data['page_title'] = 'Marketing';
//         //$data['customcss'] = 'marketing/customcss';

//         $this->data['customer'] = $this->customer->get_customers();
//         $this->data['allcity'] = $this->customer->getAllCity();
//         $this->data['addtype'] = $this->customer->getAddressType();
//         $this->data['addcountry'] = $this->customer->getAllCountry();
//         $this->data['allprovince'] = $this->customer->getAllProvince();
//         $this->data['customjs'] = 'marketing/customerjs';

//         $this->load->view('default/index', $this->data);
//     }
//     public function modifyPerson(){

//         $id = $this->input->post('CustomerID');
//         $arrfile =  $this->fileupload('userfile');
//         $filename = "";
//         if(array_key_exists('data',$arrfile)){
//             $filename = $arrfile['data'];
//         }
//         $dataperson = array(
//             'lastname' => $this->input->post('custLname'),
//             'firstname' => $this->input->post('custFname'),
//             'middlename' => $this->input->post('custMname'),
//             'sex' => $this->input->post('custGender'),
//             'birthdate' => $this->input->post('birthdate'),
//             'birthplace' => $this->input->post('custPlaceOfBirth'),
//             'nationality' => $this->input->post('custNationality'),
//             'civil_status_id' => $this->input->post('custCivilStatus'),
//             'tin' => $this->input->post('custTIN'),
//             'picture_url' => $filename,
//         );
//         $customer = array(
//             'customer_fullname' =>  $this->input->post('custLname') .', '. $this->input->post('custFname') .' '. $this->input->post('custMname'),
//         );
//         $address = array(
//             'line_1' => $this->input->post('barangay'),
//             'city_id' => $this->input->post('city'),
//             'province_id' => $this->input->post('province'),
//             'country_id' => $this->input->post('country'),
//             'address_type_id' => $this->input->post('addtype'),
//         );

//         $user = $this->users->get_user($this->session->userdata('user_id'));
//         $log_entry = array(
//             'log_date'=>date('Y-m-d H:i:s'),
//             'user_id'=>$user['user_id'],
//             'location'=>'Marketing Module',
//             'object'=>'marketing',
//             'event_type'=>'update',
//             'description'=>$user['lastname'] . ", " . $user['firstname'] . "update Customer ID " . $id
//         );
//         $this->logs->log($log_entry);

//         $this->customer->updatePerson($id, $dataperson, $customer);


//     }
//     public function saveCustomer(){
//         $arrfile =  $this->fileupload('userfile');
//         $filename = "";
//         if(array_key_exists('data',$arrfile)){
//             $filename = $arrfile['data'];
//         }
//         // if(array_key_exists('error',$arrfile)){
//         //       echo json_encode($arrfile);
//         //      die();
//         // }
//         $person = array(
//             'lastname' => $this->input->post('custLname'),
//             'firstname' => $this->input->post('custFname'),
//             'middlename' => $this->input->post('custMname'),
//             'sex' => $this->input->post('custGender'),
//             'birthdate' => $this->input->post('birthdate'),
//             'birthplace' => $this->input->post('custPlaceOfBirth'),
//             'nationality' => $this->input->post('custNationality'),
//             'civil_status_id' => $this->input->post('custCivilStatus'),
//             'tin' => $this->input->post('custTIN'),
//             'picture_url' => $filename,
//         );
//         $lastpersonid = $this->customer->insertPerson($person);
//         $address = array(
//             'line_1' => $this->input->post('barangay'),
//             'city_id' => $this->input->post('city'),
//             'province_id' => $this->input->post('province'),
//             'country_id' => $this->input->post('country'),
//             'address_type_id' => $this->input->post('addtype'),
//         );
//         $datareturn = $this->customer->insertAddress($address,$lastpersonid);
//         $this->data['message'] = 'Data Inserted Successfully';
//         //Loading View
//         $user = $this->users->get_user($this->session->userdata('user_id'));
//         $log_entry = array(
//             'log_date'=>date('Y-m-d H:i:s'),
//             'user_id'=>$user['user_id'],
//             'location'=>'Marketing Module',
//             'object'=>'marketing',
//             'event_type'=>'insert',
//             'description'=>$user['lastname'] . ", " . $user['firstname'] . " Insert new customer with Person ID " . $lastpersonid
//         );
//         $this->logs->log($log_entry);

//         echo json_encode($datareturn);
//     }

//     public function savePartner(){
//         $id = $this->input->post('CustomerID');
//         $arrfile =  $this->fileupload('userfile');
//         $filename = "";
//         if(array_key_exists('data',$arrfile)){
//             $filename = $arrfile['data'];
//         }
//         $person = array(
//             'lastname' => $this->input->post('custLname'),
//             'firstname' => $this->input->post('custFname'),
//             'middlename' => $this->input->post('custMname'),
//             'sex' => $this->input->post('custGender'),
//             'birthdate' => $this->input->post('birthdate'),
//             'birthplace' => $this->input->post('custPlaceOfBirth'),
//             'nationality' => $this->input->post('custNationality'),
//             'civil_status_id' => $this->input->post('custCivilStatus'),
//             'tin' => $this->input->post('custTIN'),
//             'picture_url' => $filename,
//         );
//         $address = array(
//             'line_1' => $this->input->post('barangay'),
//             'city_id' => $this->input->post('city'),
//             'province_id' => $this->input->post('province'),
//             'country_id' => $this->input->post('country'),
//             'address_type_id' => $this->input->post('addtype'),
//         );
        
//         $last_personid = $this->customer->insertPersonPartner($person,$address,$id);

//         $user = $this->users->get_user($this->session->userdata('user_id'));
//         $log_entry = array(
//             'log_date'=>date('Y-m-d H:i:s'),
//             'user_id'=>$user['user_id'],
//             'location'=>'Marketing Module',
//             'object'=>'marketing',
//             'event_type'=>'insert',
//             'description'=>$user['lastname'] . ", " . $user['firstname'] . " Insert new partner person ID" . $last_personid . ' of customer ' . $id
//         );
//         $this->logs->log($log_entry);
//     }
//     public function retrieveOnCustomer(){
//         $datareturn = $this->customer->getOnePerson($this->input->post('clientid'));
//         echo json_encode($datareturn);
//     }
//     public function retrieveOnCustomerPartner(){
//         $datareturn = $this->customer->getCustomerPartner($this->input->post('clientid'));
//         echo json_encode($datareturn);
//     }
//     public function addressSave(){
//         $address = array(
//             'line_1' => $this->input->post('barangay'),
//             'city_id' => $this->input->post('city'),
//             'province_id' => $this->input->post('province'),
//             'country_id' => $this->input->post('country'),
//             'address_type_id' => $this->input->post('addid'),
//         );
//         $custid = $this->input->post('custid');
//         $datareturn = $this->customer->insertAddress($address,$custid);
//         echo json_encode($datareturn);
//     }
//     public function fileupload($userfile)
//     {
//         $config['upload_path']          = "./public/images/profile_pic/";
//         $config['allowed_types']        = 'gif|jpg|png';
//         $config['max_size']             = 50000;
//         $config['max_width']            = 52024;
//         $config['max_height']           = 51768;

//         $this->load->library('upload', $config);
//         $this->upload->initialize($config);
//         // echo($userfile);
//         if ( ! $this->upload->do_upload($userfile))
//         {
//             $error =  array('error' => $this->upload->display_errors());

//             return $error;
//         }
//         else
//         {
//             $datafile = array('data' => $this->upload->data('file_name'));
//             return $datafile;
//         }
//     }

// }
?>