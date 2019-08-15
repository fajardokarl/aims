<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbox extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
        parent::__construct();  
        $this->load->model('getInbox_list2','inbox');
        $this->load->helper(array('form', 'url'));
        //$this->data['customjs'] = 'marketing/customjs';
        $this->data['customjs'] = 'application/inboxCustomjs';
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        

    }

	public function index()
	{

		//load library
		$this->load->library('layouts');

		$this->layouts->set_title('Welcom Home!');
													  //foldername/filename	
		$this->layouts->view('home',array('latest' => 'sidebar/latest')); 
		$this->data['content'] = 'home';
  //       $this->data['page_title'] = 'My Inbox';        
        // $this->load->view('default/index', $this->data
        $this->data['message'] = $this->inbox->get_users();
        $this->data['all_employees'] = $this->inbox->retrieve_all_employee();
             
		
	}
	 public function message_form()
    {
     $this->data['content'] = 'createMessage';
     $this->data['page_title'] = 'Message';
     $this->load->library('form_validation');
     $this->form_validation->set_rules("subject", "Subject", 'required');
     $this->form_validation->set_rules("body", "Body", 'required');
     $this->load->helper('date');
     date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
     $now = date('Y-m-d H:i:s');  

     $this->load->library('layouts');

		$this->layouts->set_title('Welcom Home!');
													  //foldername/filename	
		$this->layouts->view('home',array('latest' => 'sidebar/latest')); 
		$this->data['content'] = 'home';
     if ($this->form_validation->run())
    {
        //true
    $this->load->model("getInbox_list2");        
    $data = array(
            //database-------------unique identifier
            "subject"   =>$this->input->post('subject'),
            "body"   =>$this->input->post('body'),
            "date_sent"   =>date('Y-m-d'),           
            "message_type_id"    =>$this->input->post('message_type_id'),         
            "sender_id"   =>$this->input->post('sender_id'),
        );
    $id = $this->getInbox_list2->insert_data($data);
    $data2 = array(
            "user_id"   =>$this->input->post('sender_id'),
            "message_id"   => $id
        );      
    
    $this->getInbox_list2->insertMailbox($data2);
    redirect(base_url() . "inbox/inserted");
    }        
    $this->load->view('default/index', $this->data);    
    }
    public function inserted()
     {
        echo "<script>alert('Message sent!');
              </script>";
         $this->index();
     }
     echo "samok";

//Controller for inserting datas in 2 tables ends here----
    public function update()
     {
        echo "here we go";
     }






     //BROKER --------------------------------------------------------------

     public function getBrokersMasterlist(){
        $this->data['content'] = 'brokermasterlist';
        $this->data['page_title'] = 'Brokers';
        $this->data['allcity'] = $this->inbox->getAllCity();
        $this->data['allprovince'] = $this->inbox->getAllProvince();
        $this->data['addcountry'] = $this->inbox->getAllCountry();
        $this->data['addtype'] = $this->inbox->getAddressType();
        $this->data['brokers'] = $this->inbox->getBrokers();
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
            $last_address = $this->inbox->insertBrokerAddress($address);

        $org = array(
            'organization_name' => $this->input->post('realty_name'),
            'status_id' => 1,
            );
            $last_org = $this->inbox->insertOrg($org);

        $contact = array(
            'contact_type_id' => $this->input->post('realty_contacttype'),
            'contact_value' => $this->input->post('realty_contact'),
            'status_id' => 1
            );
            $last_contact = $this->inbox->insertContacts($contact);

        $realty = array(
            'organization_id' => $last_org,
            'address_id' => $last_address,
            'contact_id' => $last_contact,
            );
        $this->inbox->save_realty_model($realty);
        // $this->session-> set_flashdata('msg', 'Realty Successfully Enrolled!');
        redirect('marketing/brokers');
    }



    public function getOneBroker(){
      $this->data = $this->inbox->getSingleBroker($this->input->post('brokerID'));
      echo json_encode($this->data);
    }
    
    public function saveBroker(){
        $this->load->helper('date');
        $this->data['content'] = 'brokermasterlist';
        $this->data['page_title'] = 'Marketing';

        $arrfile =  $this->fileupload($this->input->post('userfile'));
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

            $lastPersonID = $this->inbox->insert_person($person);
            
    //broker
        $broker = array(
            'realty_id' => $this->input->post('broker_realty'),
            'date_created' => date('Y-m-d H:i:s', now()),
            'person_id' => $lastPersonID,
            'vat_type_id' => $this->input->post('brokerVatType'),
            );
            $this->inbox->insertBroker($broker);
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
            $lastBrokerAddr = $this->inbox->insertBrokerAddress($address);

            $personAddress = array(
                'person_id'=> $lastPersonID, 
                'address_id' => $lastBrokerAddr,
                'status_id' => 1,
                );
            $this->inbox->insertPersonAddress($personAddress);
        }

    //contacts
        foreach ($this->input->post('contact_value') as $i => $value) {
            $contact = array(
                'person_id'=> $lastPersonID,
                'contact_type_id' => $this->input->post('contact_type')[$i],
                'contact_value' => $value,
                'status_id' => 1
                );
                $this->inbox->insertContacts($contact);
        }
        redirect('marketing/brokers');
    }

    public function saveUpdateBroker(){
        $personid = $this->input->post('broker_person_id');
        $brokerid = $this->input->post('broker_id');
        $addid = $this->input->post('id_address');

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
        
        $address = array(
            'line_1' => $this->input->post('brokerStreet'),
            'line_2' => $this->input->post('brokerBarangay'),
            'city_id' => $this->input->post('brokerCity'),
            'province_id' => $this->input->post('brokerProvince'),
            'postal_code' => $this->input->post('brokerPostal'),
            'country_id' => $this->input->post('brokerCountry'),
            'address_type_id' => $this->input->post('BrokerAddType')
            );

        $updated = $this->inbox->updateBroker($personid, $person, $brokerid, $broker, $addid, $address);
        // redirect ('Marketing/getBrokersMasterlist');

        echo json_encode($updated);
    }

    public function fileupload($userfile){
        $config['upload_path']          = "./public/images/profile_pic/";
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
            $lastPersonID = $this->inbox->insert_person($person);

        $agent = array(
            'broker_id' => $this->input->post('txtBrokerID'),
            'person_id' => $lastPersonID,
            'status_id' => 1
            );
            $this->inbox->insert_agent_model($agent);
            
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
            $lastBrokerAddr = $this->inbox->insertBrokerAddress($address);

            $personAddress = array(
                'person_id'=> $lastPersonID, 
                'address_id' => $lastBrokerAddr,
                'status_id' => 1,
                );
            $this->inbox->insertPersonAddress($personAddress);
        }

        foreach ($this->input->post('contact_value') as $i => $value) {
            // echo $value . "---->" . $this->input->post('contact_type')[$key] . "<br>";
            $contact = array(
                'person_id'=> $lastPersonID,
                'contact_type_id' => $this->input->post('contact_type')[$i],
                'contact_value' => $value,
                'status_id' => 1
                );
                $this->inbox->insertContacts($contact);
        }
    }

    public function get_agent(){
        echo json_encode($this->inbox->get_agent_model($this->input->post('brok_id')));
    }
    
    public function get_contract_by_broker(){
        echo json_encode($this->inbox->get_contract_by_broker_model($this->input->post('brok_zzid')));
    }

    public function get_one_agent(){
        echo json_encode($this->inbox->get_users($this->input->post('message_id')));
    }
}
}
?>