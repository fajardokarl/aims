<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate4_person extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Migrator_model', 'migrates');
		$this->load->model('partner_model', 'mod_partner');
		$this->load->model('person_model', 'mod_person');
		$this->load->model('commonfunctions');
		$this->load->model('civilstatus_model', 'mod_civilstatus');
		$this->load->model('customer_model', 'mod_customer');
		$this->load->model('customeraccount_model', 'customer_account');
		$this->load->model('address_model', 'mod_address');
		$this->load->model('contact_model', 'mod_contact');
		$this->load->model('customerwork_model', 'mod_customerwork');
		$this->load->model('organization_model');
	}

	public function index()
	{
		set_time_limit(0);
		$records = $this->migrates->getPerson();
		$linecounter = 0;

		foreach ($records as $record) {
			$linecounter++;
			$info = array(
				'account' => $record->CustName,
				'name' => $record->name,
				'subcode' => $record->code,
				'type' => $record->type,
				'id' => $record->CustID,
				'newid' => "",
				'accountid' => "",
				'status_id' =>$record->Active,
				'cpname' => $record->CPName,
				'lastname' => $record->lastname,
				'firstname' => $record->firstname,
				'middlename' => $record->middlename,
				'prefix' => $record->prefix,
				'suffix' => $record->suffix,
				'sex' => $this->commonfunctions->getGender($record->Gender),
        'birthdate' => $record->BDate,
        'birthplace' => $record->PlaceofBirth,
        'nationality' => $record->Nationality,
        'civil_status_id' => $this->mod_civilstatus->getCivilStatusId($record->CivilStatus),
        'remarks' => $record->Personal2,
        'customer_work_id' => '',
        'tin' => "",
				);

			$workinfo = array(
				'organization_id' => '',
				'address_id' => '',
				'occupation' => $record->Occupation,
				'job_title' => $record->JobTitle,
				'monthly_gross_income' => $record->GrossIncome,
				'source_of_funds' => $record->FundSource
				);

			$cpinfo = array(
				'lastname' => $record->cplastname,
				'firstname' => $record->cpfirstname,
				'middlename' => $record->cpmiddlename,
				'prefix' => $record->cpprefix,
				'suffix' => $record->cpsuffix,
				'sex' => "",
				'birthdate' => $record->BDate2,
				'birthplace' => "",
				'nationality' => "",
				'civil_status_id' => "",
				'status_id' =>$record->Active,
				'tin' => ""
				);

			$info2 = array(
				'lastname' => $record->lastname2,
				'firstname' => $record->firstname2,
				'middlename' => $record->middlename2,
				'prefix' => $record->prefix2,
				'suffix' => $record->suffix2,
				'sex' => "",
        'birthdate' => "",
        'birthplace' => "",
        'nationality' => "",
        'civil_status_id' => "",
        'tin' => ""
				);

			$info3 = array(
				'lastname' => $record->lastname3,
				'firstname' => $record->firstname3,
				'middlename' => $record->middlename3,
				'prefix' => $record->prefix3,
				'suffix' => $record->suffix3,
				'sex' => "",
        'birthdate' => "",
        'birthplace' => "",
        'nationality' => "",
        'civil_status_id' => "",
        'tin' => ""
				);

			$info4 = array(
				'lastname' => $record->lastname4,
				'firstname' => $record->firstname4,
				'middlename' => $record->middlename4,
				'prefix' => $record->prefix4,
				'suffix' => $record->suffix4,
				'sex' => "",
        'birthdate' => "",
        'birthplace' => "",
        'nationality' => "",
        'civil_status_id' => "",
        'tin' => ""
				);
			

			$message = "";

			echo "$linecounter:  <u>".$info['id']."  ".$info['name']."</u><br/>";

			//	ADDRESS CODE ---------------------------------------------------------------		
			$address = array(
				'line_1' => '',
				'line_2' => '',
				'line_3' => "",
				'province_id' => "",
				'city_id' => "",
				'postal_code' => "",
				'country_id' => "",
				'address_type_id' => ""
				);

			$address2 = array(
				'line_1' => '',
				'line_2' => '',
				'line_3' => "",
				'province_id' => "",
				'city_id' => "",
				'postal_code' => "",
				'country_id' => "",
				'address_type_id' => ""
				);	
					
				if ($record->AddrStreet === null) {
					$address['line_1'] = '';
				} else {
					$address['line_1'] = $record->AddrStreet;
				}
				if ($record->AddrBrgy === null) {
					$address['line_2'] = '';
				} else {
					$address['line_2'] = $record->AddrBrgy;
				}

				if ($record->AddrStreet1 === null) {
					$address2['line_1'] = '';
				} else {
					$address2['line_1'] = $record->AddrStreet1;
				}
				if ($record->AddrBrgy1 === null) {
					$address2['line_2'] = '';
				} else {
					$address2['line_2'] = $record->AddrBrgy1;
				}

			//province	
			$holder = trim(ucwords(strtolower($record->AddrProvince)));			
			$holder = $this->commonfunctions->eraseDoubleSpace($holder);
			$address['province_id'] = $this->mod_address->getProvince($holder);

			if ($address['province_id'] == 0 and $record->AddrProvince != '') {
				$holder = $this->commonfunctions->renameProvince($record->AddrProvince);
				$address['province_id'] = $this->mod_address->getProvince($holder);
			}

			if ($address['province_id'] == 0 and $record->AddrProvince != '') {
				$address['line_3'] = $record->AddrProvince;
			}

			// CITY ------------------------------------------------------------
			//city 
			$holder = trim(ucwords(strtolower($record->AddrCity)));		
			$holder = $this->commonfunctions->eraseDoubleSpace($holder);	
			$address['city_id'] = $this->mod_address->getCity($holder);

			if ($address['city_id'] == 0 and $record->AddrCity != ''){
					$holder = $this->commonfunctions->addDeleteWordCity($holder);
					$address['city_id'] = $this->mod_address->getCity($holder);
			}

			if ($address['city_id'] == 0 and $record->AddrCity != '') {
				$holder = $this->commonfunctions->renameCity($record->AddrCity);
				$address['city_id'] = $this->mod_address->getCity($holder);
			}

			if ($address['city_id'] == 0 and $record->AddrCity != '') {
				$address['line_3'] = $address['line_3']."/".$record->AddrCity;
			}

			$address['country_id'] = '175';
			// ADDRESS 2--------------------------------------------------
			//province 2
			$holder = trim(ucwords(strtolower($record->AddrProvince1)));			
			$holder = $this->commonfunctions->eraseDoubleSpace($holder);
			$address2['province_id'] = $this->mod_address->getProvince($holder);

			if ($address2['province_id'] == 0 and $record->AddrProvince1 != '') {
				$holder = $this->commonfunctions->renameProvince($record->AddrProvince1);
				$address2['province_id'] = $this->mod_address->getProvince($holder);
			}

			if ($address2['province_id'] == 0 and $record->AddrProvince1 != '') {
				$address2['line_3'] = $record->AddrProvince1;
			}

			//city 2
			$holder = trim(ucwords(strtolower($record->AddrCity1)));		
			$holder = $this->commonfunctions->eraseDoubleSpace($holder);	
			$address2['city_id'] = $this->mod_address->getCity($holder);

			if ($address2['city_id'] == 0 and $record->AddrCity1 != ''){
					$holder = $this->commonfunctions->addDeleteWordCity($holder);
					$address2['city_id'] = $this->mod_address->getCity($holder);
			}

			if ($address2['city_id'] == 0 and $record->AddrCity1 != '') {
				$holder = $this->commonfunctions->renameCity($record->AddrCity1);
				$address2['city_id'] = $this->mod_address->getCity($holder);
			}

			if ($address2['city_id'] == 0 and $record->AddrCity1 != '') {
				$address2['line_3'] = $address2['line_3']."/".$record->AddrCity1;
			}

			$address2['country_id'] = '175';

			
			//database ---------------------------------------------------------------------
			$person = $this->mod_person->findPersonByName($info['lastname'],$info['firstname']);
				if($person == false){
					$info['newid'] = $this->mod_person->insertPerson($info);
					$message = $message."Added Person ";
				} else {
					$info['newid'] = $person->person_id;
					//$this->mod_person->updatePerson($info);
					$message = $message."Duplicate Person";
				}

				$this->migrates->updateInfoNewid($info);
				//--address------------	
				if($this->mod_address->findPersonAddressById($info['newid']) == false){
					$addrid = $this->mod_address->insertAddress($address);	
					$this->mod_address->insertPersonAddress($info['newid'],$addrid,$record->Active);
					$message = $message." Added Address ";
				} else {
					$message = $message." Duplicate Address ";
				}
				//---------------------
			#contact-------------------------------------
			$contactinfo = array(
				'person_id' => $info['newid'],
				'contact_type_id' => '',
				'contact_value' => '',
				'status_id' => $record->Active
				);
			
			if(!empty($record->ContactNumber)){
				$contactinfo['contact_type_id'] = '1';
				$contactinfo['contact_value'] = $record->ContactNumber;

				if($this->mod_contact->findContact($contactinfo) == false){
					$this->mod_contact->insertContact($contactinfo);
				}	
			}
			if(!empty($record->Business)){
				$contactinfo['contact_type_id'] = '2';
				$contactinfo['contact_value'] = $record->Business;

				if($this->mod_contact->findContact($contactinfo) == false){
					$this->mod_contact->insertContact($contactinfo);
				}	
			}

			if(!empty($record->EmailAdd)){
				$contactinfo['contact_type_id'] = '3';
				$contactinfo['contact_value'] = $record->EmailAdd;

				if($this->mod_contact->findContact($contactinfo) == false){
					$this->mod_contact->insertContact($contactinfo);
				}	
			}
			if(!empty($record->FaxNumber)){
				$contactinfo['contact_type_id'] = '5';
				$contactinfo['contact_value'] = $record->FaxNumber;

				if($this->mod_contact->findContact($contactinfo) == false){
					$this->mod_contact->insertContact($contactinfo);
				}	
			}
			//-------------------------------------------
				//customer table ---------
				$cust = $this->mod_customer->findCustomerByPersonId($info['newid']);
				if($cust == false){
					//insert customer work first				
					$info['customer_work_id'] = $this->mod_customerwork->insertCustomerWork($workinfo);

					$custid = $this->mod_customer->insertCustomer($info);
					$message = $message." Added Customer ";
				} else {
					$message = $message." Duplicate Customer ";
				}

				//customer account
				$custaccount = $this->customer_account->findCusAccountByIds($info['newid'],$info['id']);
				if( $custaccount == false){
					$accountid = $this->customer_account->insertCustomerAccount($info);
					$info['accountid'] = $accountid;
					$message = $message." Added Account ";
				}else{
					$message = $message." Duplicate Account ";
					$info['accountid'] = $custaccount->customer_account_id;
				}

	//if cpname exist
				if($cpinfo['lastname'] != ''){
					//find partner in person table
					if(substr_count($cpinfo['firstname'], "'") > 0){
						$cpinfo['firstname'] = str_replace("'"," ",$cpinfo['firstname']);
					}
					$per = $this->mod_person->findPersonByName($cpinfo['lastname'], $cpinfo['firstname']);
					if($per == false){
						$perid = $this->mod_person->insertPerson($cpinfo);
						$message = $message." Added Person ";
					} else {
						$perid = $per->person_id;
						$message = $message." Duplicate Person ";
					}

				//--CPaddress------------	
				if($this->mod_address->findPersonAddressById($perid) == false){
					$addrid = $this->mod_address->insertAddress($address2);	
					$this->mod_address->insertPersonAddress($perid,$addrid, $record->Active);
					$message = $message." Added CPAddress ";
				} else {
					$message = $message." Duplicate CPAddress ";
				}
				//---------------------
				#partner contact-------------------------------------
				$contactinfo = array(
					'person_id' => $perid,
					'contact_type_id' => '',
					'contact_value' => '',
					'status_id' => $record->Active
					);
				
				if(!empty($record->Contact2)){
					$contactinfo['contact_type_id'] = '1';
					$contactinfo['contact_value'] = $record->Contact2;

					if($this->mod_contact->findContact($contactinfo) == false){
						$this->mod_contact->insertContact($contactinfo);
					}	
				}
				if(!empty($record->BusinessPhone2)){
					$contactinfo['contact_type_id'] = '2';
					$contactinfo['contact_value'] = $record->BusinessPhone2;

					if($this->mod_contact->findContact($contactinfo) == false){
						$this->mod_contact->insertContact($contactinfo);
					}	
				}

				if(!empty($record->EmailAdd2)){
					$contactinfo['contact_type_id'] = '3';
					$contactinfo['contact_value'] = $record->EmailAdd2;

					if($this->mod_contact->findContact($contactinfo) == false){
						$this->mod_contact->insertContact($contactinfo);
					}	
				}
			 	//---------------------------------------------------
					//organization_partner table
					$part = $this->mod_partner->findCusPartnerByIds($info['accountid'], $info['newid'] ,$perid);
					//if partner doest exist in partner table
					if($part == false){			
						$this->mod_partner->insertCusPartner($info,$perid);
						$message = $message." Added Partner";
					} else {
						$message = $message." Duplicate Partner";
					}	
				}

	//if partner2 exist
				if($info2['lastname'] != ''){
					//find partner in person table
					$per = $this->mod_person->findPersonByName($info2['lastname'], $info2['firstname']);
					if($per == false){
						$perid = $this->mod_person->insertPerson($info2);
						$message = $message." Added Person ";
					} else {
						$perid = $per->person_id;
						$message = $message." Duplicate Person ";
					}

					//organization_partner table
					$part = $this->mod_partner->findCusPartnerByIds($info['accountid'], $info['newid'] ,$perid);
					//if partner doest exist in partner table
					if($part == false){			
						$this->mod_partner->insertCusPartner($info,$perid);
						$message = $message." Added Partner";
					} else {
						$message = $message." Duplicate Partner";
					}	
				}

	//if partner3 exist
				if($info3['lastname'] != ''){
					//find partner in person table
					$per = $this->mod_person->findPersonByName($info3['lastname'], $info3['firstname']);
					if($per == false){
						$perid = $this->mod_person->insertPerson($info3);
						$message = $message." Added Person ";
					} else {
						$perid = $per->person_id;
						$message = $message." Duplicate Person ";
					}

					//organization_partner table
					$part = $this->mod_partner->findCusPartnerByIds($info['accountid'], $info['newid'] ,$perid);
					//if partner doest exist in partner table
					if($part == false){			
						$this->mod_partner->insertCusPartner($info,$perid);
						$message = $message." Added Partner";
					} else {
						$message = $message." Duplicate Partner";
					}	
				}

	
	//if partner4 exist
				if($info4['lastname'] != ''){
					//find partner in person table
					$per = $this->mod_person->findPersonByName($info4['lastname'], $info4['firstname']);
					if($per == false){
						$perid = $this->mod_person->insertPerson($info4);
						$message = $message." Added Person ";
					} else {
						$perid = $per->person_id;
						$message = $message." Duplicate Person ";
					}

					//organization_partner table
					$part = $this->mod_partner->findCusPartnerByIds($info['accountid'], $info['newid'] ,$perid);
					//if partner doest exist in partner table
					if($part == false){			
						$this->mod_partner->insertCusPartner($info,$perid);
						$message = $message." Added Partner";
					} else {
						$message = $message." Duplicate Partner";
					}	
				}

			//debugger --------------------------------------------------------------		
			echo $message."<br />";
			echo "<br/>";
			echo '<script>window.scrollTo(0, document.body.scrollHeight);</script>';
		}//end foreach
		$this->load->view('home_view');
	}//end index

	public function showChar($a){
		echo "charsize:".sizeof($a)."<br/>";
		echo "charstart:";
		for ($i=0; $i < sizeof($a) ; $i++) { 
			if($a[$i]== ' '){
				echo "s";
			}else{
				echo $a[$i];
			}
		}
		echo " <br/>";
	}

	public function showPos($a){
		echo "charpos:";
		for ($i=0; $i < sizeof($a) ; $i++) { 	
				echo $a[$i]." ";
		}
		echo "<br/>";
	}
}//end class