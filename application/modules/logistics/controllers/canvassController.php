<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class canvassController extends CI_Controller {
	private $data = array();

	 function __construct(){
        // Construct the parent class
        parent::__construct();

        $this->load->model('CanvassModel','customer');
        $this->load->helper(array('form', 'url'));

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
      	$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['navigation'] = 'navigation';
        $this->data['customjs'] = 'logistics/canvassSampleJs';

    }

	public function index()
	{
        $this->data['content'] = 'canvassForm';
        $this->data['page_title'] = 'Sample canvass';
        $this->data['allcity'] = $this->customer->getAllCity();
        $this->data['allcity1'] = $this->customer->getAllCity();
        $this->data['allprovince'] = $this->customer->getAllProvince();
        $this->data['allprovince1'] = $this->customer->getAllProvince();
        $this->data['addcountry'] = $this->customer->getAllCountry();
        $this->data['addcountry1'] = $this->customer->getAllCountry();
        $this->data['addtype'] = $this->customer->getAddressType();
        $this->data['brokers'] = $this->customer->getBrokers();
        $this->data['realty'] = $this->customer->get_realty_model();
        $this->data['realty2'] = $this->customer->get_realty_model();
        $this->data['contact_type'] = $this->customer->get_contact_type();
        $this->data['contact_type1'] = $this->customer->get_contact_type();
        $this->data['brokers'] = $this->customer->getBrokers();
        $this->load->view('default/index', $this->data);
	}

	//BROKER --------------------------------------------------------------

     public function getBrokersMasterlist(){
     	$this->data['content'] = 'canvassForm';
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
		$this->customer->save_realty_model($realty);
		// $this->session-> set_flashdata('msg', 'Realty Successfully Enrolled!');
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
		$this->data['content'] = 'canvassForm';
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
			$this->customer->insertBroker($broker);
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
	}

	public function fileupload($userfile){
        $config['upload_path']          = "./public/images/profiles/";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 50000;
        $config['max_width']            = 52024;
        $config['max_height']           = 51768;

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
            $this->datafile = array('data' => $this->upload->data('file_name'));
            return $this->datafile;
        }
    }







	public function save_agent(){
		$this->load->helper('date');
		$this->data['content'] = 'canvassForm';
		// $this->data['page_title'] = 'Marketing';

    // $data = array(
    // //database-------------unique identifier
    // 'canvass_date'  =>date('Y-m-d'),
    // 'remarks' =>$this->input->post('remarks'),
    // 'canvassed_by' =>$this->input->post('canvassed_by'),
    // );            
    // $id = $this->customer->insert_canvass($data);


    // foreach ($this->input->post('canvass_supplier') as $i => $value)
    // {
    // $suppliers = array(
    //          'canvass_id' => $id,
    //          'supplier_name' =>$this->input->post('supplier_name')[$i],
    //          'contact_person' =>$this->input->post('contact_person')[$i],
    //          'contact_number' =>$this->input->post('contact_number')[$i],
    //          'terms_of_payment' =>$this->input->post('terms_of_payment')[$i]
    //          );
    //          $id = $this->customer->insert_suppliers($suppliers);
    //     }

    // foreach ($this->input->post('canvass_item') as $i => $value)
    // {
    // $items = array(
    //         'canvass_id' => $id,            
    //         'canvass_supplier_id' => $id,
    //         'qty' => $this->input->post('qty')[$i],
    //         'uom_opt' => $this->input->post('uom_opt')[$i],
    //         'item_description' => $this->input->post('item_description')[$i],
    //         'unit_price' => $this->input->post('unit_price')[$i],
    //         'offer_price' => $this->input->post('offer_price')[$i]            
    //         );
    //         $lastItems = $this->customer->insert_canvass_items($items);   
    //     }



		// $arrfile =  $this->fileupload('userfile');
		// $filename = "";

		// if(array_key_exists('data',$arrfile)){
		// 	$filename = $arrfile['data'];
	 //    }	

		$person = array(
		// 	'lastname' => $this->input->post('brokerLname'),
		// 	'firstname' => $this->input->post('brokerFname'),
		// 	'middlename' => $this->input->post('brokerMname'),
		// 	'suffix' => $this->input->post('brokerExt'),
		// 	'sex' => $this->input->post('brokerGender'),
		// 	'birthdate' => $this->input->post('birthdate'),
		// 	'birthplace' => $this->input->post('brokerPlaceBirth'),
		// 	'nationality' => $this->input->post('brokerNationality'),
		// 	'civil_status_id' => $this->input->post('brokerCivilStatus'),
		// 	'tin' => $this->input->post('brokerTIN'),
		// 	'picture_url' => $filename,

			'canvass_date'  =>date('Y-m-d'),
    		'remarks' =>$this->input->post('remarks'),
    		'canvassed_by' =>$this->input->post('canvassed_by'),
			);
			$lastPersonID = $this->customer->insert_person($person);

		// $agent = array(
		// 	'broker_id' => $this->input->post('txtBrokerID'),
		// 	'realty_id' => $this->input->post('realty_id'),
		// 	'person_id' => $lastPersonID,
		// 	'is_broker' => 0,
		// 	'status_id' => 1
		// 	);
		// 	$this->customer->insert_agent_model($agent);
			
		foreach ($this->input->post('canvass_supplier') as $i => $value) {
			$address = array(
			'canvass_id' => $lastPersonID,            
            'canvass_supplier_id' => $lastPersonID,
            'qty' => $this->input->post('qty')[$i],
            'uom_opt' => $this->input->post('uom_opt')[$i],
            'item_description' => $this->input->post('item_description')[$i],
            'unit_price' => $this->input->post('unit_price')[$i],
            'offer_price' => $this->input->post('offer_price')[$i] 
		// 		'line_1' => $this->input->post('street')[$i],
		// 		'line_2' => $this->input->post('barangay')[$i],
		// 		'city_id' => $this->input->post('city')[$i],
		// 		'province_id' => $this->input->post('province')[$i],
		// 		'postal_code' => $this->input->post('postal')[$i],
		// 		'country_id' => $this->input->post('country')[$i],
		// 		'address_type_id' => $this->input->post('addtype')[$i]
				);
			$lastBrokerAddr = $this->customer->insertBrokerAddress($address);

			// $personAddress = array(
			// 	'person_id'=> $lastPersonID, 
			// 	'address_id' => $lastBrokerAddr,
			// 	'status_id' => 1,
			// 	);
			// $this->customer->insertPersonAddress($personAddress);
		}

		foreach ($this->input->post('canvass_item') as $i => $value) {
			// echo $value . "---->" . $this->input->post('contact_type')[$key] . "<br>";
			$contact = array(
			 'canvass_id' => $lastBrokerAddr,
             'supplier_name' =>$this->input->post('supplier_name')[$i],
             'contact_person' =>$this->input->post('contact_person')[$i],
             'contact_number' =>$this->input->post('contact_number')[$i],
             'terms_of_payment' =>$this->input->post('terms_of_payment')[$i]
             );
				$this->customer->insertContacts($contact);
		}
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

    public function insert_agent_to_broker(){
    	// is_broker_update_modal
		$this->load->helper('date');

    	$data = array(
    		'person_id' => $this->input->post('person_id'),
    		'realty_id' => $this->input->post('realty_id'),
    		'date_created' => date('Y-m-d H:i:s', now()),
    		'vat_type_id' => $this->input->post('vat_type_id'),
    	);
    	$id = $this->customer->insertBroker($data);

    	$this->customer->is_broker_update_modal($this->input->post('person_id'), array('is_broker' => 1));
    	echo json_encode($id);
    	
    }

}
?>