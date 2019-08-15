<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class Brokers extends CI_Controller {
	private $data = array();

	 function __construct(){
        // Construct the parent class
        parent::__construct();

        $this->load->model('Customer_model','customer');
        // model init for 'Logs'
        $this->load->model('logs/Logs_model', 'logs');
        // model init for 'Users'
        $this->load->model('users/Users_model','users');

        $this->load->helper(array('form', 'url'));

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
      	$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['navigation'] = 'navigation';
        $this->data['customjs'] = 'marketing/customjs';
        $this->data['customcss'] = 'marketing/customcss';
    }

	public function index(){
        $this->data['content'] = 'brokermasterlist';
        $this->data['page_title'] = 'Sales and Marketing';
        $this->data['allcity'] = $this->customer->getAllCity();
        $this->data['allcity1'] = $this->customer->getAllCity();
        $this->data['allprovince'] = $this->customer->getAllProvince();
        $this->data['allprovince1'] = $this->customer->getAllProvince();
        $this->data['addcountry'] = $this->customer->getAllCountry();
        $this->data['addcountry1'] = $this->customer->getAllCountry();
        $this->data['addtype'] = $this->customer->getAddressType();
        $this->data['brokers'] = $this->customer->get_brokers_model();
        $this->data['realty'] = $this->customer->get_realty_model();
        $this->data['realty2'] = $this->customer->get_realty_model();
        $this->data['contact_type'] = $this->customer->get_contact_type();
        $this->data['contact_type1'] = $this->customer->get_contact_type();
        // $this->data['brokers'] = $this->customer->getBrokers();
        $this->load->view('default/index', $this->data);
	}

	//BROKER --------------------------------------------------------------
	public function get_realty(){
		$this->data = $this->customer->get_realty_model();
        echo json_encode($this->data);
	}
	public function get_brokers(){
		$this->data = $this->customer->get_brokers_model();
        echo json_encode($this->data);
	}

    public function getBrokersMasterlist(){
     	$this->data['content'] = 'brokermasterlist';
		$this->data['page_title'] = 'Brokers';
		$this->data['allcity'] = $this->customer->getAllCity();
		$this->data['allprovince'] = $this->customer->getAllProvince();
		$this->data['addcountry'] = $this->customer->getAllCountry();
		$this->data['addtype'] = $this->customer->getAddressType();
		$this->data['brokers'] = $this->customer->getBrokers();
		$this->load->view('default/index', $this->data);
	}
	public function save_realty(){
		$address = array(
			'line_1' => $this->input->post('realty_street'),
			'line_2' => $this->input->post('realty_brgy'),
			'city_id' => $this->input->post('realty_city'),
			'province_id' => $this->input->post('realty_province'),
			'postal_code' => $this->input->post('realty_postalcode'),
			'country_id' => $this->input->post('realty_country'),
			'address_type_id' => 2,
			);
			$last_address = $this->customer->insertBrokerAddress($address);

		$org = array(
			'organization_name' => $this->input->post('realty_name'),
			'status_id' => 1,
			);
			$last_org = $this->customer->insertOrg($org);

		$contact = array(
			'contact_type_id' => $this->input->post('realty_contacttype'),
			'contact_value' => $this->input->post('realty_contact'),
			'status_id' => 1
			);
			$last_contact = $this->customer->insertContacts($contact);

		$realty = array(
			'organization_id' => $last_org,
			'address_id' => $last_address,
			'contact_id' => $last_contact,
			);
		$last_realty_id = $this->customer->save_realty_model($realty);
		// $this->session-> set_flashdata('msg', 'Realty Successfully Enrolled!');

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'brokers',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " inserted new Realty ID " . $last_realty_id
        );
        $this->logs->log($log_entry);

		redirect('marketing/brokers');
	}



	public function getOneBroker(){
      $this->data = $this->customer->getSingleBroker($this->input->post('brokerID'));
      echo json_encode($this->data);
	}
	
	public function get_broker_address(){
      $this->data = $this->customer->get_broker_address_model($this->input->post('brok_id'));
      echo json_encode($this->data);
	}
	
	public function saveBroker(){
		$this->load->helper('date');
		$this->data['content'] = 'brokermasterlist';
		$this->data['page_title'] = 'Marketing';

		$arrfile =  $this->fileupload('userfile');
		$filename = "";
		if(array_key_exists('data',$arrfile)){
		$filename = $arrfile['data'];
	    }
	//person
		$person = array(
			'lastname' => $this->input->post('brokerLname'),
			'firstname' => $this->input->post('brokerFname'),
			'middlename' => $this->input->post('brokerMname'),
			'suffix' => $this->input->post('brokerExt'),
			'sex' => $this->input->post('brokerGender'),
			'birthdate' => $this->input->post('birthdate'),
			'birthplace' => $this->input->post('brokerPlaceBirth'),
			'civil_status_id' => $this->input->post('brokerCivilStatus'),
			'nationality' => $this->input->post('brokerNationality'),
			'tin' => $this->input->post('brokerTIN'),
			'picture_url' => $filename,
			);

			$lastPersonID = $this->customer->insert_person($person);
			
	//broker
		$broker = array(
			'realty_id' => $this->input->post('broker_realty'),
			'date_created' => date('Y-m-d H:i:s', now()),
			'person_id' => $lastPersonID,
			'vat_type_id' => $this->input->post('brokerVatType'),
			);
		$last_broker_id = $this->customer->insertBroker($broker);
			// redirect ('Marketing/getBrokersMasterlist');


	//address

		foreach ($this->input->post('addtype') as $i => $value) {
			$address = array(
				'line_1' => $this->input->post('street')[$i],
				'line_2' => $this->input->post('brgy')[$i],
				'city_id' => $this->input->post('city')[$i],
				'province_id' => $this->input->post('prov')[$i],
				'postal_code' => $this->input->post('postal')[$i],
				'country_id' => $this->input->post('country')[$i],
				'address_type_id' => $this->input->post('addtype')[$i]
				);
			$lastBrokerAddr = $this->customer->insertBrokerAddress($address);

			$personAddress = array(
				'person_id'=> $lastPersonID, 
				'address_id' => $lastBrokerAddr,
				'status_id' => 1,
				);
			$this->customer->insertPersonAddress($personAddress);
		}

	//contacts
		foreach ($this->input->post('contact_value') as $i => $value) {
			$contact = array(
				'person_id'=> $lastPersonID,
				'contact_type_id' => $this->input->post('contact_type')[$i],
				'contact_value' => $value,
				'status_id' => 1
				);
				$this->customer->insertContacts($contact);
		}

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'brokers',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " inserted new Broker ID " . $last_broker_id
        );
        $this->logs->log($log_entry);
		redirect('marketing/brokers');
	}

	public function saveUpdateBroker(){
		$personid = $this->input->post('broker_person_id');
		$brokerid = $this->input->post('broker_id');
		// $addid = $this->input->post('id_address');

		$person = array(
			'lastname' => $this->input->post('brokerLname'),
			'firstname' => $this->input->post('brokerFname'),
			'middlename' => $this->input->post('brokerMname'),
			'suffix' => $this->input->post('brokerExt'),
			'sex' => $this->input->post('brokerGender'),
			'birthdate' => $this->input->post('birthdate'),
			'birthplace' => $this->input->post('brokerPlaceBirth'),
			'nationality' => $this->input->post('brokerNationality'),
			'civil_status_id' => $this->input->post('brokerCivilStatus'),
			'tin' => $this->input->post('brokerTIN'),
			);

		$broker = array(
			'vat_type_id' => $this->input->post('brokerVatType'),
			'realty_id' => $this->input->post('broker_realty'),
			);
		
		// $address = array(
		// 	'line_1' => $this->input->post('brokerStreet'),
		// 	'line_2' => $this->input->post('brokerBarangay'),
		// 	'city_id' => $this->input->post('brokerCity'),
		// 	'province_id' => $this->input->post('brokerProvince'),
		// 	'postal_code' => $this->input->post('brokerPostal'),
		// 	'country_id' => $this->input->post('brokerCountry'),
		// 	'address_type_id' => $this->input->post('BrokerAddType')
		// 	);


		$updated = $this->customer->updateBroker($personid, $person, $brokerid, $broker);
		// redirect ('Marketing/getBrokersMasterlist');

		echo json_encode($updated);

		if (count($this->input->post('contact_value')) > 0) {
			foreach ($this->input->post('contact_value') as $i => $value) {
				$contact = array(
					'person_id'=> $personid,
					'contact_type_id' => $this->input->post('contact_type')[$i],
					'contact_value' => $value,
					'status_id' => 1
					);
				$this->customer->insertContacts($contact);
			}
		}

		if (count($this->input->post('addtype')) > 0) {
			foreach ($this->input->post('addtype') as $i => $value) {
				$address = array(
					'line_1' => $this->input->post('street')[$i],
					'line_2' => $this->input->post('barangay')[$i],
					'city_id' => $this->input->post('city')[$i],
					'province_id' => $this->input->post('province')[$i],
					'postal_code' => $this->input->post('postal')[$i],
					'country_id' => $this->input->post('country')[$i],
					'address_type_id' => $this->input->post('addtype')[$i]
					);
				$lastBrokerAddr = $this->customer->insertBrokerAddress($address);

				$personAddress = array(
					'person_id'=> $personid, 
					'address_id' => $lastBrokerAddr,
					'status_id' => 1,
					);
				$this->customer->insertPersonAddress($personAddress);
			}
		}

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'brokers',
            'event_type'=>'update',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " updated Broker ID " . $brokerid
        );
        $this->logs->log($log_entry);

	}

	public function fileupload($userfile){
        $config['upload_path']   = "./public/images/profiles/";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 50000;
        $config['max_width']     = 52024;
        $config['max_height']    = 51768;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        // echo($userfile);
        if ( ! $this->upload->do_upload($userfile))
        {		  
           $error =  array('error' => $this->upload->display_errors());
           return $error;
        }
        else
        {
            $datafile = array('data' => $this->upload->data('file_name'));
            return $datafile;
        }
    }

	public function save_agent(){
		$this->load->helper('date');
		$this->data['content'] = 'brokermasterlist';
		$this->data['page_title'] = 'Marketing';

		$arrfile =  $this->fileupload('userfile');
		$filename = "";

		if(array_key_exists('data',$arrfile)){
			$filename = $arrfile['data'];
	    }	

		$person = array(
			'lastname' => $this->input->post('brokerLname'),
			'firstname' => $this->input->post('brokerFname'),
			'middlename' => $this->input->post('brokerMname'),
			'suffix' => $this->input->post('brokerExt'),
			'sex' => $this->input->post('brokerGender'),
			'birthdate' => $this->input->post('birthdate'),
			'birthplace' => $this->input->post('brokerPlaceBirth'),
			'nationality' => $this->input->post('brokerNationality'),
			'civil_status_id' => $this->input->post('brokerCivilStatus'),
			'tin' => $this->input->post('brokerTIN'),
			'picture_url' => $filename,
			);
			$lastPersonID = $this->customer->insert_person($person);

		$agent = array(
			'broker_id' => $this->input->post('txtBrokerID'),
			'realty_id' => $this->input->post('realty_id'),
			'person_id' => $lastPersonID,
			'is_broker' => 0,
			'status_id' => 1
			);
		$last_agent = $this->customer->insert_agent_model($agent);
			
		foreach ($this->input->post('addtype') as $i => $value) {
			$address = array(
				'line_1' => $this->input->post('street')[$i],
				'line_2' => $this->input->post('barangay')[$i],
				'city_id' => $this->input->post('city')[$i],
				'province_id' => $this->input->post('province')[$i],
				'postal_code' => $this->input->post('postal')[$i],
				'country_id' => $this->input->post('country')[$i],
				'address_type_id' => $this->input->post('addtype')[$i]
				);
			$lastBrokerAddr = $this->customer->insertBrokerAddress($address);

			$personAddress = array(
				'person_id'=> $lastPersonID, 
				'address_id' => $lastBrokerAddr,
				'status_id' => 1,
				);
			$this->customer->insertPersonAddress($personAddress);
		}

		foreach ($this->input->post('contact_value') as $i => $value) {
			// echo $value . "---->" . $this->input->post('contact_type')[$key] . "<br>";
			$contact = array(
				'person_id'=> $lastPersonID,
				'contact_type_id' => $this->input->post('contact_type')[$i],
				'contact_value' => $value,
				'status_id' => 1
				);
				$this->customer->insertContacts($contact);
		}

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'brokers',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " inserted new Agent ID " . $last_agent
        );
        $this->logs->log($log_entry);
	}

	public function get_agent(){
    	echo json_encode($this->customer->get_agent_model($this->input->post('brok_id')));
	}
	
	public function get_contract_by_broker(){
    	echo json_encode($this->customer->get_contract_by_broker_model($this->input->post('brok_id')));
	}

	public function get_one_agent(){
    	echo json_encode($this->customer->get_one_agent_model($this->input->post('agent_id')));
	}

	public function get_contacts(){
    	echo json_encode($this->customer->get_contacts_model($this->input->post('brokerID')));
	}

	public function insert_contacts($data){
		echo json_encode($this->customer->insertContacts());
	}

	public function realty_agents(){
    	echo json_encode($this->customer->agents_by_realty($this->input->post('realty_id')));
	}

	public function realty_brokers(){
       echo json_encode($this->customer->get_realty_brokers($this->input->post('realty_id')));
    }

    public function get_broker_req(){
       echo json_encode($this->customer->get_broker_req_model($this->input->post('ref_id'), $this->input->post('type')));
    }
    
    public function insert_agent_to_broker(){
    	// is_broker_update_modal
		$this->load->helper('date');

    	$data = array(
    		'person_id' => $this->input->post('person_id'),
    		'realty_id' => $this->input->post('realty_id'),
    		'date_created' => date('Y-m-d H:i:s', now()),
    		'vat_type_id' => $this->input->post('vat_type_id'),
    		'prc_license' => $this->input->post('prc_license'),
    		'hlurb_no' => $this->input->post('hlurb_no'),
    		'license_validity_date' => $this->input->post('license_validity_date'),
    	);
    	$id = $this->customer->insertBroker($data);

    	$this->customer->is_broker_update_modal($this->input->post('person_id'), array('is_broker' => 1));

    	$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'brokers',
            'event_type'=>'update',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " updated agent ID" . $id. "to Broker"
        );
        $this->logs->log($log_entry);

    	echo json_encode($id);
    	
    }

    public function upload_file(){
		$req_id = $this->input->post('requirement_id');
		$ref = $this->input->post('ref_id');
		$ref_text = $this->input->post('ref_text');
		$file_name = '';

		$config['upload_path'] = './public/images/requirements/brokers/'; 
		$config['allowed_types'] = 'jpg|jpeg|png|pdf';
		$config['max_size'] = '9000000';
		$config['file_name'] = $ref . '' . $ref_text . '_' . $req_id;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('file_name')) {
			// echo $this->upload->display_errors();
			// echo json_encode($file_name);
			$file_name = 0;
		}else{
			$data = $this->upload->data();
			// echo json_encode($data['file_name']);
			$file_name = $data['file_name'];
			$id = $this->customer->update_brokerfile_model($req_id, array('document_filename' => $data['file_name']));
			echo json_encode($file_name);
		}
	}






























    // NEW BROKER FORM


    public function save_broker(){
    	$this->load->helper('date');
    	// insert_person_model
    	// insert_address_model
    	// insert_broker_model
    	// insert_personaddress_model
    	// insert_contact_model




		$file_name = '';

    	$config['upload_path'] = './public/images/profiles/'; //public\images\profiles
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '900000';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('broker_userfile')) {
			// echo $this->upload->display_errors();
			$file_name = '';
		}else{
			$data = $this->upload->data();
			$file_name = $data['file_name'];
		}

    	$person = array(
			'lastname' => $this->input->post('broker_lastname'),
			'firstname' => $this->input->post('broker_firstname'),
			'middlename' => $this->input->post('broker_middlename'),
			'sex' => $this->input->post('broker_sex'),
			'birthdate' => $this->input->post('broker_birthdate'),
			'birthplace' => $this->input->post('broker_birthplace'),
			'civil_status_id' => $this->input->post('broker_civil'),
			'nationality' => $this->input->post('broker_citizen'),
			'tin' => $this->input->post('broker_tin'),
			'picture_url' => $file_name,
		);
		$person_id = $this->customer->insert_person_model($person);

		// ADDRESS
		$broker_addr = array(
			'line_1' => $this->input->post('broker_line_1'),
			'line_2' => $this->input->post('broker_line_2'),
			'line_3' => $this->input->post('broker_line_3'),
			'city_id' => $this->input->post('broker_city'),
			'province_id' => $this->input->post('broker_province'),
			'country_id' => $this->input->post('broker_country'),
			'postal_code' => $this->input->post('broker_postalcode'),
			'address_type_id' => 1
     	);
		$addr_id = $this->customer->insert_address_model($broker_addr);

		$pre_person_addr = array(
			'person_id' => $person_id,
			'address_id' => $addr_id,
			'status_id' =>1
		);
		$this->customer->insert_personaddress_model($pre_person_addr);

		// CONTACT
		$contact = array(
			'person_id' => $person_id,
			'residential_phone' => $this->input->post('broker_residential'), 
			'business_phone' => '',
			'mobile_phone' => $this->input->post('broker_mobile'), 
			'fax_no' => $this->input->post('broker_fax'), 
			'email' => $this->input->post('broker_email'), 
		);
		$this->customer->insert_contact_model($contact);

		$realty_id = $this->input->post('broker_realty_id');
		if ($this->input->post('is_corporation') == 1) {
			$realty = array(
				'realty_name' => $this->input->post('broker_realtyname'),
				'realty_representative' => $this->input->post('broker_represent'),
				'representative_designation' => $this->input->post('broker_designation'),
				'affiliation_date' => $this->input->post('broker_affdate'),
			);
			$realty_id = $this->customer->save_realty_model($realty);

			$req = array(
				array(
					'reference_id' => $realty_id,
					'file_id' => 7,
					'type' => 2,
					'upload_date' => date('Y-m-d',now())
				),
				array(
					'reference_id' => $realty_id,
					'file_id' => 14,
					'type' => 2,
					'upload_date' => date('Y-m-d',now())
				),
				array(
					'reference_id' => $realty_id,
					'file_id' => 15,
					'type' => 2,
					'upload_date' => date('Y-m-d',now())
				),
				array(
					'reference_id' => $realty_id,
					'file_id' => 1,
					'type' => 2,
					'upload_date' => date('Y-m-d',now())
				),
				array(
					'reference_id' => $realty_id,
					'file_id' => 13,
					'type' => 2,
					'upload_date' => date('Y-m-d',now())
				),
			);
			$this->customer->insert_broker_req_model($req);
		}

		$broker = array(
			// 'realty_id'
			'date_created' => date('Y-m-d',now()),
			'person_id' => $person_id,
			'realty_id' => $realty_id,
			'religion' => $this->input->post('broker_religion'),
			'spouse_name' => $this->input->post('broker_spouse'),
			'passport_number' => $this->input->post('broker_passport'),
			'passport_from' => $this->input->post('broker_pass_from'),
			'passport_to' => $this->input->post('broker_pass_to'),
			'sss_number' => $this->input->post('broker_sss'),
			'business_nature' => $this->input->post('broker_business_nature'),
			'business_name' => $this->input->post('broker_business_name'),
			'business_address' => $this->input->post('broker_business_address'),
			'business_zip' => $this->input->post('broker_business_zip'),
			'business_phone' => $this->input->post('broker_business_phone'),
			'business_fax' => $this->input->post('broker_business_fax'),
			'prc_number' => $this->input->post('broker_prc'),
			'prc_from' => $this->input->post('broker_prc_from'),
			'prc_to' => $this->input->post('broker_prc_to'),
			'ptr_number' => $this->input->post('broker_ptr'),
			'ptr_from' => $this->input->post('broker_ptr_from'),
			'ptr_to' => $this->input->post('broker_ptr_to'),
			'aipo_membership' => $this->input->post('broker_aipo_org'),
			'aipo_from' => $this->input->post('broker_aipo_from'),
			'aipo_to' => $this->input->post('broker_aipo_to'),
			'aipo_receipt' => $this->input->post('broker_aipo_receipt'),
		);
		$broker_id = $this->customer->insert_broker_model($broker);

		if ($this->input->post('is_corporation') == 1) {
			$req = array(
				array(
					'reference_id' => $broker_id,
					'file_id' => 9,
					'type' => 2,
					'upload_date' => date('Y-m-d',now())
				),
				array(
					'reference_id' => $broker_id,
					'file_id' => 7,
					'type' => 2,
					'upload_date' => date('Y-m-d',now())
				),
				array(
					'reference_id' => $broker_id,
					'file_id' => 1,
					'type' => 2,
					'upload_date' => date('Y-m-d',now())
				),
				
			);
			$this->customer->insert_broker_req_model($req);
		}else{
			$req = array(
				array(
					'reference_id' => $broker_id,
					'file_id' => 9,
					'type' => 1,
					'upload_date' => date('Y-m-d',now())
				),
				array(
					'reference_id' => $broker_id,
					'file_id' => 7,
					'type' => 1,
					'upload_date' => date('Y-m-d',now())
				),
				array(
					'reference_id' => $broker_id,
					'file_id' => 1,
					'type' => 1,
					'upload_date' => date('Y-m-d',now())
				),
				array(
					'reference_id' => $broker_id,
					'file_id' => 10,
					'type' => 1,
					'upload_date' => date('Y-m-d',now())
				),
				array(
					'reference_id' => $broker_id,
					'file_id' => 5,
					'type' => 1,
					'upload_date' => date('Y-m-d',now())
				),
				array(
					'reference_id' => $broker_id,
					'file_id' => 13,
					'type' => 1,
					'upload_date' => date('Y-m-d',now())
				),

			);
			$this->customer->insert_broker_req_model($req);
		}


		// $arr = $this->input->post('salesperson');
		foreach ($this->input->post('salesperson_name') as $i => $value) {
			$salesperson = array(
				'broker_id' => $broker_id, 
				'salesperson_name' => $value,
				'prc_accrtn_license' => $this->input->post('prc_accrtn_license')[$i],
				'salesperson_mobile' => $this->input->post('salesperson_mobile')[$i],
				'salesperson_email' => $this->input->post('salesperson_email')[$i]
			);
		    $this->customer->insert_salesperson_model($salesperson);
		}



		echo json_encode($broker_id);

    }

    public function get_onebroker(){
    	echo json_encode($this->customer->get_onebroker_model($this->input->post('broker_id')));
    }

    public function get_salesperson(){
    	echo json_encode($this->customer->get_salesperson_model($this->input->post('broker_id')));
    }
    

    // FOR PRINTING BROKER
    public function broker_pdf(){
    	$this->load->helper('date');
    	$broker_id = $this->input->get('broker');
    	// $this->data['content'] = 'reportpdf_view'; 
    	// $this->data['page_title'] = 'PDF';
    	$broker = $this->customer->get_onebroker_model($broker_id);
    	$salesperson = $this->customer->get_salesperson_model($broker_id);
    	// $this->load->view('marketing/reportpdf_view', $this->data); 
    	$this->load->library('Pdf');

		$pdf = new Pdf('P', 'mm', [612,936], true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('IRM System Generated PDF');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		ob_clean();
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,0,0), array(0,0,0));
		$pdf->setFooterData(array(0,0,0), array(0,0,0));

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}


       
		// // $font_size = $pdf->pixelsToUnits('5');
		

		// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
		// ------------------------------------------------------------------------------------------------------------------------
        $pdf->AddPage();
  //       // $pdf->WriteHTML($htmla, true, 0, true, true);
  //       $y = $pdf->getY();
		// // set color for background
		// $pdf->SetFillColor(255, 255, 255);
		// $pdf->SetTextColor(0, 0, 0);
        $address_val = $broker[0]['line_1'] . " " . 
        		$broker[0]['line_2'] . " " . 
        		$broker[0]['line_3'] . ", " . 
	        	$broker[0]['city_name'] . ", " . 
	        	$broker[0]['province_name'] . ", " . 
	        	$broker[0]['country_name'];

		$pdf->writeHTMLCell(180, '', '', '', "<h2>BROKER APPLICATION FORM</h2>", 0, 0, 0, true, 'C', false);

		$pdf->SetFont ('helvetica', '', 10 , 15, 'default', true );
        $pdf->Ln(10);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->writeHTMLCell(180, 6, '', '', '<font color="white">PERSONAL PROFILE</font>', 1, 0, 1, true, 'C', false);
        
        $pdf->Ln(6);
        $pdf->writeHTMLCell(60, 9, '', '', '<font size="8">Firstname: <br /> </font>' . $broker[0]['firstname'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(60, 9, '', '', '<font size="8">Middlename: <br /> </font>' . $broker[0]['middlename'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(60, 9, '', '', '<font size="8">Lastname: <br /> </font>' . $broker[0]['lastname'], 1, 0, 0, true, 'L', false);
        
        $pdf->Ln(9);
        $pdf->writeHTMLCell(90, 9, '', '', '<font size="8">Address: <br /> </font>' . $address_val, 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(45, 9, '', '', '<font size="8">City/Province: <br /> </font>' . $broker[0]['firstname'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(45, 9, '', '', '<font size="8">ZIP Code: <br /> </font>' . $broker[0]['postal_code'], 1, 0, 0, true, 'L', false);

        $pdf->Ln(9);
        $pdf->writeHTMLCell(45, 9, '', '', '<font size="8">Residence Phone: <br /> </font>' . $broker[0]['residential_phone'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(45, 9, '', '', '<font size="8">Mobile No.: <br /> </font>' . $broker[0]['mobile_phone'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(45, 9, '', '', '<font size="8">Fax No.: <br /> </font>' . $broker[0]['fax_no'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(45, 9, '', '', '<font size="8">Email: <br /> </font>' . $broker[0]['email'], 1, 0, 0, true, 'L', false);
        // $pdf->writeHTMLCell(36, 6, '', '', '<font size="8">Sex: <br /> </font>' . $broker[0]['tin'], 1, 0, 0, true, 'L', false);

        $pdf->Ln(9);
        $pdf->writeHTMLCell(45, 9, '', '', '<font size="8">Birthdate: <br /> </font>' . $broker[0]['birthdate'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(45, 9, '', '', '<font size="8">Place of Birth: <br /> </font>' . $broker[0]['birthplace'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(45, 9, '', '', '<font size="8">Religion: <br /> </font>' . $broker[0]['religion'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(45, 9, '', '', '<font size="8">Citezenship: <br /> </font>' . $broker[0]['nationality'], 1, 0, 0, true, 'L', false);

        $pdf->Ln(9);
        $pdf->writeHTMLCell(45, 9, '', '', '<font size="8">Sex: <br /> </font>' . $broker[0]['sex'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(45, 9, '', '', '<font size="8">Passport No.: <br /> </font>' . $broker[0]['passport_number'], 1, 0, 0, true, 'L', false);
        // $pdf->writeHTMLCell(45, 9, '', '', '<font size="8">Place Issued: <br /> </font>' . $broker[0]['firstname'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(45, 9, '', '', '<font size="8">Valid From: <br /> </font>' . $broker[0]['passport_from'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(45, 9, '', '', '<font size="8">Valid Until: <br /> </font>' . $broker[0]['passport_to'], 1, 0, 0, true, 'L', false);

        $pdf->Ln(9);
        $pdf->writeHTMLCell(36, 9, '', '', '<font size="8">TIN: <br /> </font>' . $broker[0]['tin'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(36, 9, '', '', '<font size="8">SSS no.: <br /> </font>' . $broker[0]['sss_number'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(36, 9, '', '', '<font size="8">Nature of Business: <br /> </font>' . $broker[0]['business_nature'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(72, 9, '', '', '<font size="8">Business Name: <br /> </font>' . $broker[0]['business_name'], 1, 0, 0, true, 'L', false);

        $pdf->Ln(9);
        $pdf->writeHTMLCell(144, 9, '', '', '<font size="8">Business Address: <br /> </font>' . $broker[0]['business_address'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(36, 9, '', '', '<font size="8">ZIP code: <br /> </font>' . $broker[0]['business_zip'], 1, 0, 0, true, 'L', false);

        $pdf->Ln(9);
        $pdf->writeHTMLCell(90, 6, '', '', '<font color="white" size="10">PRC LICENSE INFORMATION</font>', 1, 0, 1, true, 'L', false);
        $pdf->writeHTMLCell(90, 6, '', '', '<font color="white" size="10">PTR</font>', 1, 0, 1, true, 'L', false);

        $pdf->Ln(6);
        $pdf->writeHTMLCell(30, 9, '', '', '<font size="8">PRC Registration No.: <br /> </font>' . $broker[0]['prc_number'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(30, 9, '', '', '<font size="8">Registration Date: <br /> </font>' . $broker[0]['prc_from'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(30, 9, '', '', '<font size="8">Valid Until: <br /> </font>' . $broker[0]['prc_to'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(30, 9, '', '', '<font size="8">PTR No.: <br /> </font>' . $broker[0]['ptr_number'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(30, 9, '', '', '<font size="8">Valid From: <br /> </font>' . $broker[0]['ptr_from'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(30, 9, '', '', '<font size="8">Valid Until: <br /> </font>' . $broker[0]['ptr_to'], 1, 0, 0, true, 'L', false);

        $pdf->Ln(9);
        $pdf->writeHTMLCell(180, 6, '', '', '<font color="white" size="10">AIPO MEMBERSHIP</font>', 1, 0, 1, true, 'L', false);

        $pdf->Ln(6);
        $pdf->writeHTMLCell(72, 9, '', '', '<font size="8">Organization: <br /> </font>' . $broker[0]['aipo_membership'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(36, 9, '', '', '<font size="8">Valid From: <br /> </font>' . $broker[0]['aipo_from'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(36, 9, '', '', '<font size="8">Valid Until.: <br /> </font>' . $broker[0]['aipo_to'], 1, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(36, 9, '', '', '<font size="8">Receipt No.: <br /> </font>' . $broker[0]['aipo_receipt'], 1, 0, 0, true, 'L', false);

        $pdf->Ln(9);
        $pdf->writeHTMLCell(180, 6, '', '', '<font color="white">C O M M I T M E N T</font>', 1, 0, 1, true, 'C', false);

        $pdf->Ln(6);
        $pdf->writeHTMLCell(125, 55, '', '', '
        	<font size="8">
        	<table border="">
			    <tr>
			        <td colspan="3">I hereby commit to abide by, and/or achieve the following as the basis of my accreditation:</td>
			    </tr>
			    <tr>
			        <td width="5%"></td>
			        <td width="5%">a.)</td>
			        <td width="90%">Abide by the Accreditation Agreement and Code of Ethics governing accredited Brokers ABCI  and its assigns;</td>
			    </tr>
			    <tr>
			        <td width="5%"></td>
			        <td width="5%">b.)</td>
			        <td width="90%">Attain the required sales production set by the management of ABCI and its assign;</td>
			    </tr>
			    <tr>
			        <td width="5%"></td>
			        <td width="5%">c.)</td>
			        <td width="90%">Actively participate in all sales and marketing activities of ABCI and its assigns;</td>
			    </tr>
			    <br />
			    <tr>
			        <td colspan="3">I understand that failure to satisfy any of the aforementioned condition and any false statements/informatione herein may be grounds fir ABCI and assigns to disapprove my application for accreditation.</td>
			    </tr>
			</table>       		
			</font>', 1, 0, 0, true, 'L', true);
        	// $pdf->writeHTMLCell(45, 45, '', '', '<font size="8">Receipt No.: <br /> </font>' . $broker[0]['firstname'], 1, 0, 0, true, 'L', true);
    	$pdf->Image(base_url(). "public/images/profiles/" . $broker[0]['picture_url'], '', '', 55, 55, '', '', '', true, 150, '', false, false, 1);
        
        $pdf->Ln(45);
        $pdf->writeHTMLCell(75, 9, '', '',' _________________________________ <br /> <font size="8">SIGNATURE OVER PRINTED NAME</font>' , 0, 0, 0, true, 'C', false);
        $pdf->writeHTMLCell(50, 9, '', '',' _____________________ <br /> <font size="8">DATE</font>' , 0, 0, 0, true, 'C', false);

        $pdf->writeHTMLCell(75, 9, 15, 187, strtoupper($broker[0]['firstname'] . ' ' . $broker[0]['lastname']), 0, 0, 0, true, 'C', false);
        $pdf->writeHTMLCell(50, 9, '', '', date_format(date_create(date('Y-m-d',now())), 'M d, Y') , 0, 0, 0, true, 'C', false);

        $pdf->Ln(10);
        // $pdf->writeHTMLCell(36, 9, '', '', '<font size="8">Receipt No.: <br /> </font>' . $broker[0]['aipo_receipt'], 1, 0, 0, true, 'L', false);

        $pdf->Ln(9);
        // $pdf->writeHTMLCell(180, 6, '', '', '<font color="white">LIST OF REQUIREMENTS</font>', 1, 0, 1, true, 'C', false);




        // Sales Person
        $pdf->AddPage();
		$pdf->writeHTMLCell(180, '', '', '', "<h2>LOCAL BROKER NETWORK</h2>", 0, 0, 0, true, 'C', false);
		$pdf->Ln(6);
		$pdf->writeHTMLCell(180, '', '', '', "<h4>LIST OF ACCREDITED REAL ESTATE SALESPERSON</h4>", 0, 0, 0, true, 'C', false);
        $pdf->Ln(6);
        $pdf->writeHTMLCell(100, 9, '', '', '<font size="8"><i>NOTE:</i> Fill-out the necessary information of accredited Real Estate Salesperson under you</font>', 0, 0, 0, true, 'L', false);
		
		
		$pdf->Ln(10);
        $pdf->writeHTMLCell(7, 9, '', '', '', 1, 0, 1, true, 'L', false);
        $pdf->writeHTMLCell(65, 9, '', '', '<font color="white" size="9"> <br> NAME OF SALESPERSON</font>', 1, 0, 1, true, 'C', true);
        $pdf->writeHTMLCell(36, 9, '', '', '<font color="white" size="9"> PRC LICENSE/ ACCREDITATION NO.</font>', 1, 0, 1, true, 'C', true);
        $pdf->writeHTMLCell(36, 9, '', '', '<font color="white" size="9"> <br> MOBILE NO.</font>', 1, 0, 1, true, 'C', true);
        $pdf->writeHTMLCell(36, 9, '', '', '<font color="white" size="9"> <br> EMAIL</font>', 1, 0, 1, true, 'C', true);
		$pdf->Ln(9);

		$no = 1;
		if (count($salesperson) > 0) {
			foreach ($salesperson as $salesperson) {
		        $pdf->writeHTMLCell(7, 7, '', '', $no++, 1, 0, 0, true, 'L', false);
		        $pdf->writeHTMLCell(65, 7, '', '', $salesperson['salesperson_name'], 1, 0, 0, true, 'L', true);
		        $pdf->writeHTMLCell(36, 7, '', '', $salesperson['prc_accrtn_license'], 1, 0, 0, true, 'L', true);
		        $pdf->writeHTMLCell(36, 7, '', '', $salesperson['salesperson_mobile'], 1, 0, 0, true, 'L', true);
		        $pdf->writeHTMLCell(36, 7, '', '', $salesperson['salesperson_email'], 1, 0, 0, true, 'L', true);
		        $pdf->Ln(7);
			}
		}else{
		        $pdf->writeHTMLCell(180, 7, '', '', 'No salesperson Recorded', 1, 0, 0, true, 'C', true);
		        $pdf->Ln(7);


		}

		$pdf->Ln(10);
        $pdf->writeHTMLCell(180, 9, '', '', '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; I/We have familiarized myself/ourselves with the Real Estate Service Act and promise to abide by and comply with its provisions, ints implementating Rules and Regulations, and all laws governing the Real Estate trade and business. Further, I/we hereby agree to comply all with all the terms and conditions stated in the Accreditation Agreement of Brokers issued by A Brown Company, Inc. and its assigns.', 0, 0, 0, true, 'L', false);
		$pdf->Ln(25);
        $pdf->writeHTMLCell(180, 9, '', '', '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; I/We hereby certify the the above information is true and correct to the best of my/our knowledge and that A Brown Company, Inc. and its assigns is authorized to obtain such information as it may require for the purpose of evaluating my/our application.', 0, 0, 0, true, 'L', false);



        // General Policies
        $pdf->AddPage();
        $pdf->writeHTMLCell(180, 55, '', '', '
        	<font size="12">
        	<table border="">
			    <tr>
			        <td colspan="3">GENERAL POLICIES</td>
			    </tr>
			    <tr>
			        <td width="5%"></td>
			        <td width="5%"></td>
			        <td width="90%"></td>
			    </tr>
			    <tr>
			        <td width="5%"></td>
			        <td width="5%">1.</td>
			        <td width="90%">Accreditation is valid for a year. And is renewable annually.</td>
			    </tr>
			    <tr>
			        <td width="5%"></td>
			        <td width="5%">2.</td>
			        <td width="90%">An agent shall be locked to a licensed broker for a year. In case the former request to be released prior to expiry, a Certification of Release shall be issued by the licensed broker to ABCI. This is same for a broker-realty set-up.</td>
			    </tr>
			    <tr>
			        <td width="5%"></td>
			        <td width="5%">3.</td>
			        <td width="90%">ABCI shall entertain sales only from accredited brokers/realty.</td>
			    </tr>
			    <tr>
			        <td width="5%"></td>
			        <td width="5%">4.</td>
			        <td width="90%">No walk-in licensed brokers with sales reservation. Otherwise, said sales reservation shall be entertained only if the licensed broker will transfer the particular sale to his preferred ABCI licensed broker/realty. Must have himself accredited first.</td>
			    </tr>
			    <tr>
			        <td width="5%"></td>
			        <td width="5%">5.</td>
			        <td width="90%">Online inquiries shall be forwarded to assigned broker of the day. The date of the online inquiry is the reckoning date.</td>
			    </tr>
			    <tr>
			        <td width="5%"></td>
			        <td width="5%">6.</td>
			        <td width="90%">Reservation Agreements must have an attached photocopy of the Licensed of the Broker, to be able to determine the expiry.</td>
			    </tr>
			    <tr>
			        <td width="5%"></td>
			        <td width="5%">7.</td>
			        <td width="90%">There must be a broker-seller agreement, to validate whose sale the transaction belongs. The agreement indicates the names of the agent and the licensed broker.</td>
			    </tr>
			    <tr>
			        <td width="5%"></td>
			        <td width="5%">8.</td>
			        <td width="90%">Broker must abide the Certification Slip Agreement. <br></td>
			    </tr>
			</table>
			<table>
				<tr>
					<td width="12%" align="right"> a.</td>
					<td width="2%"></td>
					<td width="85%">Once the buyer signs the certification, any affidavit/ document/ verbal advises to void such certification shall not be honored. Client has to wait until expiry of the said certification to change broker/agent.</td>
				</tr>
				<tr>
					<td width="12%" align="right"> b.</td>
					<td width="2%"></td>
					<td width="85%">Expiry of certification shall now be 7 calendar days instead of 30 days.</td>
				</tr>
				<tr>
					<td width="12%" align="right"> c.</td>
					<td width="2%"></td>
					<td width="85%">All projects shall now be covered by one certification instead of a per project certification. This means that one (1) certification binds a client with his current broker/agent for all ABCI real estate projects. The ABCI Marketing Department registers this certification in the logbook. </td>
				</tr>
				<tr>
					<td width="12%" align="right"> d.</td>
					<td width="2%"></td>
					<td width="85%">Block_ Lot_ and Project Name shall be deleted from the old certification.</td>
				</tr>
				<tr>
					<td width="12%" align="right"> e.</td>
					<td width="2%"></td>
					<td width="85%">Should issues arise on the validity of the certification, client preference is no longer honored. Buyer should wait for the 7-day lock-up period before transferring to his preferred broker.</td>
				</tr>
				<tr>
					<td width="12%" align="right">f.</td>
					<td width="2%"></td>
					<td width="85%">A certification shall be issued regardless to affinity or friendship.</td>
				</tr>

			</table>
			</font>', 0, 0, 0, true, 'L', true);

			$pdf->Ln(200);
			$pdf->writeHTMLCell(75, 9, '', '','&nbsp; &nbsp; CONFORME:', 0, 0, 0, true, 'L', false);
			$pdf->Ln(10);
			$pdf->writeHTMLCell(55, 9, '', '','&nbsp; &nbsp; <font size="12">Name of Licensed Broker:</font>' , 0, 0, 0, true, 'L', false);
	        $pdf->writeHTMLCell(60, 9, '', '',' ________________________ <br />' , 0, 0, 0, true, 'L', false);
			$pdf->Ln(8);
	        $pdf->writeHTMLCell(55, 9, '', '','&nbsp; &nbsp; <font size="12">Date:</font>' , 0, 0, 0, true, 'L', false);
	        $pdf->writeHTMLCell(60, 9, '', '',' ________________________ <br />' , 0, 0, 0, true, 'L', false);
        	

        	$pdf->Output('broker.pdf', 'I'); 
    }


}