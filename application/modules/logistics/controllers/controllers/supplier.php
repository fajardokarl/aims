<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Supplier_model');
		$this->data['navigation'] = 'logistics/navigation';
		$this->data['customjs'] = 'supplier_js';
	}

	public function index(){
		$this->data['content'] = 'supplier_view';
		$this->data['page_title'] = 'Supplier Management';

		if(isset($this->session->userdata['logged_in'])){
			$this->data['records'] = $this->Supplier_model->getSupplier();
			$this->data['rec_types'] = $this->Supplier_model->getType();
			$this->data['cities'] = $this->Supplier_model->getCity();
			$this->data['provinces'] = $this->Supplier_model->getProvince();
			$this->data['countries'] = $this->Supplier_model->getCountry();
			$this->data['addrtypes'] = $this->Supplier_model->getAddressType();
			$this->data['contacttypes'] = $this->Supplier_model->getContactType();
			$this->data['rec_civilstatus'] = $this->Supplier_model->getCivilStatus();
			$this->load->view('default/index', $this->data);
		} 
	}

	public function optionAddSupplier(){
		if ($this->input->post('typeid')==1) {
			$data = $this->Supplier_model->getOptionPerson();
		} else {
			$data = $this->Supplier_model->getOptionOrganization();
		}
		echo json_encode($data);
	}

	public function addSupplierNewCompany(){
		$supplierinfo = [
			'client_type_id' => $this->input->post('client_type_id'),
			'reference_id' => '',
			'status_id' => $this->input->post('status_id'),
			'vatable' => $this->input->post('vatable')
		];

		$organizationinfo = [
			'organization_name' => $this->input->post('organization_name'),
			'tin' => $this->input->post('tin'),
			'special_instruction' => $this->input->post('special_instruction'),
			'status_id' => '1'
		];

		$addressinfo = [
			'line_1' => $this->input->post('line_1'),
			'line_2' => $this->input->post('line_2'),
			'line_3' => $this->input->post('line_3'),
			'city_id' => $this->input->post('city_id'),
			'province_id' => $this->input->post('province_id'),
			'postal_code' => $this->input->post('postal_code'),
			'country_id' => $this->input->post('country_id'),
			'address_type_id' => $this->input->post('address_type_id')
		];

		$organizationaddressinfo = [
			'organization_id' => '',
			'address_id' => '',
			'status_id' => '1'
		];

		$contactinfo = [
			'person_id' => '',
			'contact_type_id' => '',
			'contact_value' => '',
			'status_id' => '1'
		];

		$this->db->trans_start();
		$supplierinfo['reference_id'] = $this->Supplier_model->insertOrganization($organizationinfo);
		$organizationaddressinfo['organization_id'] = $supplierinfo['reference_id'];
		$organizationaddressinfo['address_id'] = $this->Supplier_model->insertAddress($addressinfo);
		$this->Supplier_model->insertOrganizationAddress($organizationaddressinfo);

		if (!empty($this->input->post('contact_value2'))) {
			$contactinfo['contact_type_id'] = '2';
			$contactinfo['contact_value'] = $this->input->post('contact_value2');
			$this->Supplier_model->insertOrganizationContact($contactinfo, $supplierinfo['reference_id']);
		}
		if (!empty($this->input->post('contact_value4'))) {
			$contactinfo['contact_type_id'] = '4';
			$contactinfo['contact_value'] = $this->input->post('contact_value4');
			$this->Supplier_model->insertOrganizationContact($contactinfo, $supplierinfo['reference_id']);
		}
		if (!empty($this->input->post('contact_value5'))) {
			$contactinfo['contact_type_id'] = '5';
			$contactinfo['contact_value'] = $this->input->post('contact_value5');
			$this->Supplier_model->insertOrganizationContact($contactinfo, $supplierinfo['reference_id']);
		}

	 	$this->Supplier_model->insertSupplier($supplierinfo);
		$this->db->trans_complete();
		redirect('Logistics/supplier','refresh');
	}

	public function addSupplierNewPerson(){
		$supplierinfo = [
			'client_type_id' => $this->input->post('client_type_id'),
			'reference_id' => '',
			'status_id' => $this->input->post('status_id'),
			'vatable' => $this->input->post('vatable')
		];

		$arrfile =  $this->fileupload('userfile');
    $filename = "";
    if(array_key_exists('data',$arrfile)){
      $filename = $arrfile['data'];
    }
		$personinfo = [
			'lastname' => $this->input->post('lastname'),
			'firstname' => $this->input->post('firstname'),
			'middlename' => $this->input->post('middlename'),
			'prefix' => $this->input->post('prefix'),
			'suffix' => $this->input->post('suffix'),
			'sex' => $this->input->post('sex'),
			'birthdate' => $this->input->post('birthdate'),
			'birthplace' => $this->input->post('birthplace'),
			'nationality' => $this->input->post('nationality'),
			'civil_status_id' => $this->input->post('civil_status_id'),
			'tin' => $this->input->post('ptin'),
			'picture_url' => $filename
		];

		$addressinfo = [
			'line_1' => $this->input->post('line_1'),
			'line_2' => $this->input->post('line_2'),
			'line_3' => $this->input->post('line_3'),
			'city_id' => $this->input->post('city_id'),
			'province_id' => $this->input->post('province_id'),
			'postal_code' => $this->input->post('postal_code'),
			'country_id' => $this->input->post('country_id'),
			'address_type_id' => $this->input->post('address_type_id')
		];

		$personaddressinfo = [
			'person_id' => '',
			'address_id' => '',
			'status_id' => '1'
		];

		$contactinfo = [
			'person_id' => '',
			'contact_type_id' => '',
			'contact_value' => '',
			'status_id' => '1'
		];
		$this->db->trans_start();
		$supplierinfo['reference_id'] = $this->Supplier_model->insertPerson($personinfo);
		$contactinfo['person_id'] = $supplierinfo['reference_id'];
		$personaddressinfo['person_id'] = $supplierinfo['reference_id'];
		$personaddressinfo['address_id'] = $this->Supplier_model->insertAddress($addressinfo);
		$this->Supplier_model->insertPersonAddress($personaddressinfo);

		if (!empty($this->input->post('contact_value1'))) {
			$contactinfo['contact_type_id'] = '1';
			$contactinfo['contact_value'] = $this->input->post('contact_value1');
			$this->Supplier_model->insertPersonContact($contactinfo);
		}
		if (!empty($this->input->post('contact_value2'))) {
			$contactinfo['contact_type_id'] = '2';
			$contactinfo['contact_value'] = $this->input->post('contact_value2');
			$this->Supplier_model->insertPersonContact($contactinfo);
		}
		if (!empty($this->input->post('contact_value3'))) {
			$contactinfo['contact_type_id'] = '3';
			$contactinfo['contact_value'] = $this->input->post('contact_value3');
			$this->Supplier_model->insertPersonContact($contactinfo);
		}
		if (!empty($this->input->post('contact_value4'))) {
			$contactinfo['contact_type_id'] = '4';
			$contactinfo['contact_value'] = $this->input->post('contact_value4');
			$this->Supplier_model->insertPersonContact($contactinfo);
		}
		if (!empty($this->input->post('contact_value5'))) {
			$contactinfo['contact_type_id'] = '5';
			$contactinfo['contact_value'] = $this->input->post('contact_value5');
			$this->Supplier_model->insertPersonContact($contactinfo);
		}

		$this->Supplier_model->insertSupplier($supplierinfo);
		$this->db->trans_complete();
		redirect('Logistics/supplier','refresh');
	}

	public function addSupplier(){
		$supplierinfo = [
			'client_type_id' => $this->input->post('client_type_id'),
			'reference_id' => $this->input->post('reference_id'),
			'status_id' => $this->input->post('status_id'),
			'vatable' => $this->input->post('vatable')
		];

		$arrfile =  $this->fileupload('userfile');
    $filename = "";
    if(array_key_exists('data',$arrfile)){
      $filename = $arrfile['data'];
    }

    $personinfo = [
			'lastname' => $this->input->post('lastname'),
			'firstname' => $this->input->post('firstname'),
			'middlename' => $this->input->post('middlename'),
			'prefix' => $this->input->post('prefix'),
			'suffix' => $this->input->post('suffix'),
			'sex' => $this->input->post('sex'),
			'birthdate' => $this->input->post('birthdate'),
			'birthplace' => $this->input->post('birthplace'),
			'nationality' => $this->input->post('nationality'),
			'civil_status_id' => $this->input->post('civil_status_id'),
			'tin' => $this->input->post('ptin'),
			'picture_url' => $filename
		];

		$organizationinfo = [
			'organization_name' => $this->input->post('organization_name'),
			'tin' => $this->input->post('tin'),
			'special_instruction' => $this->input->post('special_instruction')
		];

		$addressinfo = [
			'line_1' => $this->input->post('line_1'),
			'line_2' => $this->input->post('line_2'),
			'line_3' => $this->input->post('line_3'),
			'city_id' => $this->input->post('city_id'),
			'province_id' => $this->input->post('province_id'),
			'postal_code' => $this->input->post('postal_code'),
			'country_id' => $this->input->post('country_id'),
			'address_type_id' => $this->input->post('address_type_id')
		];

		$contactinfo = [
			'person_id' => '',
			'contact_type_id' => '',
			'contact_value' => '',
			'status_id' => '1'
		];

		$contactinfo2 = [
			'contact_value' => ''
		];


		$this->db->trans_start();
		$this->Supplier_model->insertSupplier($supplierinfo);
		
		if ($this->input->post('client_type_id') == 1) {
			$this->Supplier_model->updatePersonByID($personinfo, $this->input->post('person_id'));
		} else {
			$this->Supplier_model->updateOrganizationByID($organizationinfo, $this->input->post('organization_id'));
		}

		$this->Supplier_model->updateAddressByID($addressinfo, $this->input->post('address_id'));

		if (!empty($this->input->post('contact_id1'))) {
			$contactinfo2['contact_value'] = $this->input->post('contact_value1');
			$this->Supplier_model->updateContactByID($contactinfo2, $this->input->post('contact_id1'));
		}	else {
			if (!empty($this->input->post('contact_value1'))) {
				if ($this->input->post('client_type_id') == 1) {
					$contactinfo['person_id'] = $this->input->post('person_id');
					$contactinfo['contact_type_id'] = '1';
					$contactinfo['contact_value'] = $this->input->post('contact_value1');
					$this->Supplier_model->insertPersonContact($contactinfo);
				} else {
					$contactinfo['contact_type_id'] = '1';
					$contactinfo['contact_value'] = $this->input->post('contact_value1');
					$this->Supplier_model->insertOrganizationContact($contactinfo, $this->input->post('organization_id'));
				}
			}
		}

		
		if (!empty($this->input->post('contact_id2'))) {
			$contactinfo2['contact_value'] = $this->input->post('contact_value2');
			$this->Supplier_model->updateContactByID($contactinfo2, $this->input->post('contact_id2'));
		}	else {
			if (!empty($this->input->post('contact_value2'))) {
				if ($this->input->post('client_type_id') == 1) {
					$contactinfo['person_id'] = $this->input->post('person_id');
					$contactinfo['contact_type_id'] = '2';
					$contactinfo['contact_value'] = $this->input->post('contact_value2');
					$this->Supplier_model->insertPersonContact($contactinfo);
				} else {
					$contactinfo['contact_type_id'] = '2';
					$contactinfo['contact_value'] = $this->input->post('contact_value2');
					$this->Supplier_model->insertOrganizationContact($contactinfo, $this->input->post('organization_id'));
				}
			}
		}

	
		if (!empty($this->input->post('contact_id3'))) {
			$contactinfo2['contact_value'] = $this->input->post('contact_value3');
			$this->Supplier_model->updateContactByID($contactinfo2, $this->input->post('contact_id3'));
		}	else {
			if (!empty($this->input->post('contact_value3'))) {
				if ($this->input->post('client_type_id') == 1) {
					$contactinfo['person_id'] = $this->input->post('person_id');
					$contactinfo['contact_type_id'] = '3';
					$contactinfo['contact_value'] = $this->input->post('contact_value3');
					$this->Supplier_model->insertPersonContact($contactinfo);
				} else {
					$contactinfo['contact_type_id'] = '3';
					$contactinfo['contact_value'] = $this->input->post('contact_value3');
					$this->Supplier_model->insertOrganizationContact($contactinfo, $this->input->post('organization_id'));
				}
			}
		}

	
		if (!empty($this->input->post('contact_id4'))) {
			$contactinfo2['contact_value'] = $this->input->post('contact_value4');
			$this->Supplier_model->updateContactByID($contactinfo2, $this->input->post('contact_id4'));
		}	else {
			if (!empty($this->input->post('contact_value4'))) {
				if ($this->input->post('client_type_id') == 1) {
					$contactinfo['person_id'] = $this->input->post('person_id');
					$contactinfo['contact_type_id'] = '4';
					$contactinfo['contact_value'] = $this->input->post('contact_value4');
					$this->Supplier_model->insertPersonContact($contactinfo);
				} else {
					$contactinfo['contact_type_id'] = '4';
					$contactinfo['contact_value'] = $this->input->post('contact_value4');
					$this->Supplier_model->insertOrganizationContact($contactinfo, $this->input->post('organization_id'));
				}
			}
		}

	
		if (!empty($this->input->post('contact_id5'))) {
			$contactinfo2['contact_value'] = $this->input->post('contact_value5');
			$this->Supplier_model->updateContactByID($contactinfo2, $this->input->post('contact_id5'));
		}	else {
			if (!empty($this->input->post('contact_value5'))) {
				if ($this->input->post('client_type_id') == 1) {
					$contactinfo['person_id'] = $this->input->post('person_id');
					$contactinfo['contact_type_id'] = '5';
					$contactinfo['contact_value'] = $this->input->post('contact_value5');
					$this->Supplier_model->insertPersonContact($contactinfo);
				} else {
					$contactinfo['contact_type_id'] = '5';
					$contactinfo['contact_value'] = $this->input->post('contact_value5');
					$this->Supplier_model->insertOrganizationContact($contactinfo, $this->input->post('organization_id'));
				}
			}
		}
		$this->db->trans_complete();
		redirect('Logistics/supplier','refresh');
	}

	public function updateSupplier(){
		$arrfile =  $this->fileupload('userfile');
		var_dump($arrfile);
    $filename = "";
    if(array_key_exists('data',$arrfile)){
      $filename = $arrfile['data'];
    }
    var_dump($filename);
		$supplierinfo = [
			'status_id' => $this->input->post('status_id'),
			'vatable' => $this->input->post('vatable')
		];

		$personinfo = [
			'lastname' => $this->input->post('lastname'),
			'firstname' => $this->input->post('firstname'),
			'middlename' => $this->input->post('middlename'),
			'prefix' => $this->input->post('prefix'),
			'suffix' => $this->input->post('suffix'),
			'sex' => $this->input->post('sex'),
			'birthdate' => $this->input->post('birthdate'),
			'birthplace' => $this->input->post('birthplace'),
			'nationality' => $this->input->post('nationality'),
			'civil_status_id' => $this->input->post('civil_status_id'),
			'tin' => $this->input->post('ptin'),
			'picture_url' => $filename
		];

		$organizationinfo = [
			'organization_name' => $this->input->post('organization_name'),
			'tin' => $this->input->post('tin'),
			'special_instruction' => $this->input->post('special_instruction')
		];

		$addressinfo = [
			'line_1' => $this->input->post('line_1'),
			'line_2' => $this->input->post('line_2'),
			'line_3' => $this->input->post('line_3'),
			'city_id' => $this->input->post('city_id'),
			'province_id' => $this->input->post('province_id'),
			'postal_code' => $this->input->post('postal_code'),
			'country_id' => $this->input->post('country_id'),
			'address_type_id' => $this->input->post('address_type_id')
		];

		$contactinfo = [
			'person_id' => '',
			'contact_type_id' => '',
			'contact_value' => ''
		];

		$contactinfo2 = [
			'contact_value' => ''
		];
		
		$this->db->trans_start();
		$this->Supplier_model->updateSupplier($supplierinfo, $this->input->post('supplier_id'));
		
		if ($this->input->post('client_type_id') == 1) {
			$this->Supplier_model->updatePersonByID($personinfo, $this->input->post('person_id'));
		} else {
			$this->Supplier_model->updateOrganizationByID($organizationinfo, $this->input->post('organization_id'));
		}

		$this->Supplier_model->updateAddressByID($addressinfo, $this->input->post('address_id'));

		if (!empty($this->input->post('contact_id1'))) {
			$contactinfo2['contact_value'] = $this->input->post('contact_value1');
			$this->Supplier_model->updateContactByID($contactinfo2, $this->input->post('contact_id1'));
		}	else {
			if (!empty($this->input->post('contact_value1'))) {
				if ($this->input->post('client_type_id') == 1) {
					$contactinfo['person_id'] = $this->input->post('person_id');
					$contactinfo['contact_type_id'] = '1';
					$contactinfo['contact_value'] = $this->input->post('contact_value1');
					$this->Supplier_model->insertPersonContact($contactinfo);
				} else {
					$contactinfo['contact_type_id'] = '1';
					$contactinfo['contact_value'] = $this->input->post('contact_value1');
					$this->Supplier_model->insertOrganizationContact($contactinfo, $this->input->post('organization_id'));
				}
			}
		}


		if (!empty($this->input->post('contact_id2'))) {
			$contactinfo2['contact_value'] = $this->input->post('contact_value2');
			$this->Supplier_model->updateContactByID($contactinfo2, $this->input->post('contact_id2'));
		}	else {
			if (!empty($this->input->post('contact_value2'))) {
				if ($this->input->post('client_type_id') == 1) {
					$contactinfo['person_id'] = $this->input->post('person_id');
					$contactinfo['contact_type_id'] = '2';
					$contactinfo['contact_value'] = $this->input->post('contact_value2');
					$this->Supplier_model->insertPersonContact($contactinfo);
				} else {
					$contactinfo['contact_type_id'] = '2';
					$contactinfo['contact_value'] = $this->input->post('contact_value2');
					$this->Supplier_model->insertOrganizationContact($contactinfo, $this->input->post('organization_id'));
				}
			}
		}

		
		if (!empty($this->input->post('contact_id3'))) {
			$contactinfo2['contact_value'] = $this->input->post('contact_value3');
			$this->Supplier_model->updateContactByID($contactinfo2, $this->input->post('contact_id3'));
		}	else {
			if (!empty($this->input->post('contact_value3'))) {
				if ($this->input->post('client_type_id') == 1) {
					$contactinfo['person_id'] = $this->input->post('person_id');
					$contactinfo['contact_type_id'] = '3';
					$contactinfo['contact_value'] = $this->input->post('contact_value3');
					$this->Supplier_model->insertPersonContact($contactinfo);
				} else {
					$contactinfo['contact_type_id'] = '3';
					$contactinfo['contact_value'] = $this->input->post('contact_value3');
					$this->Supplier_model->insertOrganizationContact($contactinfo, $this->input->post('organization_id'));
				}
			}
		}

	;
		if (!empty($this->input->post('contact_id4'))) {
			$contactinfo2['contact_value'] = $this->input->post('contact_value4');
			$this->Supplier_model->updateContactByID($contactinfo2, $this->input->post('contact_id4'));
		}	else {
			if (!empty($this->input->post('contact_value4'))) {
				if ($this->input->post('client_type_id') == 1) {
					$contactinfo['person_id'] = $this->input->post('person_id');
					$contactinfo['contact_type_id'] = '4';
					$contactinfo['contact_value'] = $this->input->post('contact_value4');
					$this->Supplier_model->insertPersonContact($contactinfo);
				} else {
					$contactinfo['contact_type_id'] = '4';
					$contactinfo['contact_value'] = $this->input->post('contact_value4');
					$this->Supplier_model->insertOrganizationContact($contactinfo, $this->input->post('organization_id'));
				}
			}
		}

	
		if (!empty($this->input->post('contact_id5'))) {
			$contactinfo2['contact_value'] = $this->input->post('contact_value5');
			$this->Supplier_model->updateContactByID($contactinfo2, $this->input->post('contact_id5'));
		}	else {
			if (!empty($this->input->post('contact_value5'))) {
				if ($this->input->post('client_type_id') == 1) {
					$contactinfo['person_id'] = $this->input->post('person_id');
					$contactinfo['contact_type_id'] = '5';
					$contactinfo['contact_value'] = $this->input->post('contact_value5');
					$this->Supplier_model->insertPersonContact($contactinfo);
				} else {
					$contactinfo['contact_type_id'] = '5';
					$contactinfo['contact_value'] = $this->input->post('contact_value5');
					$this->Supplier_model->insertOrganizationContact($contactinfo, $this->input->post('organization_id'));
				}
			}
		}
		$this->db->trans_complete();
		redirect('Logistics/supplier', 'refresh');
	}

	public function getPersonContactInfo(){
		$data = $this->Supplier_model->getPersonContactInfo($this->input->post('personid'));
		echo json_encode($data);
	}

	public function getCompanyContactInfo(){
		$data = $this->Supplier_model->getCompanyContactInfo($this->input->post('organizationid'));
		echo json_encode($data);
	}

	public function getPersonAddressInfo(){
		$data = $this->Supplier_model->getPersonAddressInfo($this->input->post('personid'));
		echo json_encode($data);
	}

	public function getCompanyAddressInfo(){
		$data = $this->Supplier_model->getCompanyAddressInfo($this->input->post('organizationid'));
		echo json_encode($data);
	}

	public function getSupplierInfo(){
		if($this->input->post('typeid') == 1){
			$data = $this->Supplier_model->getPersonByID($this->input->post('referenceid'));
		} else {
			$data = $this->Supplier_model->getOrganizationByID($this->input->post('referenceid'));
		}
		echo json_encode($data);
	}

	public function getSupplierByID(){
		$type = $this->Supplier_model->getTypeBySupplierID($this->input->post('supplierid'));
		if ($type[0]['client_type_id'] == '1') {
			$data = $this->Supplier_model->getPersonSupplierByID($this->input->post('supplierid'));
		} else {
			$data = $this->Supplier_model->getOrganizationSupplierByID($this->input->post('supplierid'));
		}
		echo json_encode($data);
	}

	public function fileupload($userfile){
		$config['upload_path']          = "./public/images/profiles/";
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 50000;
    $config['max_width']            = 52024;
    $config['max_height']           = 51768;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    
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
}//end class