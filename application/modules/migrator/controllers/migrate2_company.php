<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate2_company extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Migrator_model', 'migrates');
		$this->load->model('commonfunctions');
		$this->load->model('organization_model', 'mod_organization');	
		$this->load->model('organizationaccount_model', 'mod_organizationaccount');
		$this->load->model('partner_model', 'mod_partner');
		$this->load->model('person_model', 'mod_person');
		$this->load->model('address_model', 'mod_address');
		$this->load->model('contact_model', 'mod_contact');
	}

	public function index()
	{
		set_time_limit(0);	
		$records = $this->migrates->getCompany();

	
		foreach ($records as $record) {
			$info = array(
			'account' => $record->CustName,
			'organization_name' => $record->name,
			'subcode' => $record->code,
			'id' => $record->CustID,
			'newid' => "",
			'accountid' => "",
			'status_id' =>$record->Active,
			'remarks' => $record->Personal2,
			'cpname' => $record->CPName
			);

			$partnerinfo = array(
			'lastname' => "",
			'firstname' => "",
			'middlename' => "",
			'prefix' => "",
			'suffix' => "",
			'sex' => "",
     	'birthdate' => "",
     	'birthplace' => "",
     	'nationality' => "",
     	'civil_status_id' => "",
     	'status_id' =>$record->Active,
     	'tin' => ""
			);
	
			$partnerinfo2 = array(
			'lastname' => "",
			'firstname' => "",
			'middlename' => "",
			'prefix' => "",
			'suffix' => "",
			'sex' => "",
     	'birthdate' => "",
     	'birthplace' => "",
     	'nationality' => "",
     	'civil_status_id' => "",
     	'tin' => ""
			);
			$message ="";

			$charpos = [];
			$char = [];

			$partner = $record->CPName; 
			// erase represented ----------------------------------------------------
			if(substr_count($partner, 'N/A') > 0	)
			{
				$partner = trim(substr($partner, 3, strlen($partner)-3));
			}
			if(substr_count(strtolower($partner), 'c/o') > 0	)
			{
				$partner = trim(substr($partner, 4, strlen($partner)-4));
			}
			if(substr_count(strtolower($partner), 'represented by:') > 0	)
			{
				$partner = trim(substr($partner, 15, strlen($partner)-15));
			}
			if(substr_count(strtolower($partner), 'represented by') > 0	)
			{
				$partner = trim(substr($partner, 14, strlen($partner)-14));
			}
			if(substr_count(strtolower($partner), 'represeted by:') > 0	)
			{
				$partner = trim(substr($partner, 14, strlen($partner)-14));
			}
			if(substr_count(strtolower($partner), 'rep by:') > 0	)
			{
				$partner = trim(substr($partner, 7, strlen($partner)-7));
			}
			if(substr_count(strtolower($partner), 'rep. by:') > 0	)
			{
				$partner = trim(substr($partner, 8, strlen($partner)-8));
			}

			//erase mr. & mrs.-------------------------------------------------------
			if(substr_count(strtolower($partner), 'mr.') > 0 ){
				$pos = strpos(strtolower($partner), 'mr.');
 				$partner = trim(substr($partner, 0, $pos).substr($partner, $pos+3,strlen($partner)-$pos+3));
				//$partnerinfo['prefix']
			}
			if(substr_count(strtolower($partner), 'mrs.') > 0){
				$pos = strpos(strtolower($partner), 'mrs.');
				$partner = trim(substr($partner, 0, $pos).substr($partner, $pos+4,strlen($partner)-$pos+4));
			}

			//erase jr sr iii -------------------------------------------------------
			if(substr_count(strtolower($partner), 'jr') > 0 ){
				$pos = strpos(strtolower($partner), 'jr');
				if(
					(substr(strtolower($partner), $pos-1,1) == ' ' or 
						substr(strtolower($partner), $pos-1,1) == '.') and 
					(substr(strtolower($partner), $pos+2,1) == ' ' or 
						substr(strtolower($partner), $pos+2,1) == '.' or 
						substr(strtolower($partner), $pos+2,1) == '')
					){
					$partner = trim(substr($partner, 0, $pos).substr($partner, $pos+3,strlen($partner)-$pos+3));
 					$partnerinfo['suffix'] = 'Jr.';
				}
			}
			if(substr_count(strtolower($partner), 'sr') > 0 ){
				$pos = strpos(strtolower($partner), 'sr');
				if(
					(substr(strtolower($partner), $pos-1,1) == ' ' or 
						substr(strtolower($partner), $pos-1,1) == '.') and 
					(substr(strtolower($partner), $pos+2,1) == ' ' or 
						substr(strtolower($partner), $pos+2,1) == '.' or 
						substr(strtolower($partner), $pos+2,1) == '')
					){
					$partner = trim(substr($partner, 0, $pos).substr($partner, $pos+3,strlen($partner)-$pos+3));
 					$partnerinfo['suffix'] = 'Sr.';
				}
			}
			if(substr_count(strtolower($partner), 'iii') > 0 ){
				$pos = strpos(strtolower($partner), 'iii');
 				$partner = trim(substr($partner, 0, $pos).substr($partner, $pos+3,strlen($partner)-$pos+3));
 				$partnerinfo['suffix'] = 'III';
			}
			//-----------------------------------------------------------------------
			//erase sps
			if(substr_count(strtolower($partner), 'sps') > 0 ){
				$pos = strpos(strtolower($partner), 'sps');
				if(
					(substr(strtolower($partner), $pos-1,1) == ' ' or 
						substr(strtolower($partner), $pos-1,1) == '.' or 
						substr(strtolower($partner), $pos-1,1) == '') and 
					(substr(strtolower($partner), $pos+3,1) == ' ' or 
						substr(strtolower($partner), $pos+3,1) == '.' or 
						substr(strtolower($partner), $pos+3,1) == '')
					){
					$partner = trim(substr($partner, 0, $pos).substr($partner, $pos+4,strlen($partner)-$pos+4));
				} elseif($pos == 0) {
					$partner = trim(substr($partner, $pos+4,strlen($partner)-$pos+4));
				}
			}
			//-------------------------------------------------------------------------
			for ($i=0; $i < strlen($partner) ; $i++) { 
				if (substr($partner, $i,1) == ',' ){
				
					array_push($char, ',');
					array_push($charpos, $i);

				}
				if (substr($partner, $i,1) == '.' ){
					array_push($char, '.');
					array_push($charpos, $i);
				}
				if (substr($partner, $i,1) == '/' ){
					array_push($char, '/');
					array_push($charpos, $i);
				}
				if (substr($partner, $i,1) == '&' ){
					array_push($char, '&');
					array_push($charpos, $i);
				}
				if (substr($partner, $i,1) == ' ' ){
					array_push($char, ' ');
					array_push($charpos, $i);
				}
			}
 
			switch (sizeof($char)) {
				case '1':
					if($char[0] == ' '){
						$partnerinfo['lastname'] = substr($partner, $charpos[0], strlen($partner)-$charpos[0]);
						$partnerinfo['firstname'] = substr($partner, 0, $charpos[0]);
					}
					break;

				case '2':
					if($char[0] == '&' and $char[1] == ' '){
						$partnerinfo['lastname'] = substr($partner, $charpos[1], strlen($partner)-$charpos[1]);
						$partnerinfo['firstname'] = substr($partner, 0, $charpos[0]);

						$partnerinfo2['lastname'] = substr($partner, $charpos[1], strlen($partner)-$charpos[1]);
						$partnerinfo2['firstname'] = substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1);
					}
					if($char[0] == ' ' and $char[1] == ' '){
						$partnerinfo['lastname'] = substr($partner, $charpos[1], strlen($partner)-$charpos[1]);
						$partnerinfo['firstname'] = substr($partner, 0, $charpos[1]);
					}
					if($char[0] == ',' and $char[1] == ' '){
						$partnerinfo['lastname'] = substr($partner, 0, $charpos[0]);
						$partnerinfo['firstname'] = substr($partner, $charpos[1]+1, strlen($partner)-$charpos[0]-1);
					}
					break;

				case '3':
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' '){
						$partnerinfo['lastname'] = substr($partner, 0, $charpos[0]);
						$partnerinfo['firstname'] = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));
						//$partnerinfo['middle'] = substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1);
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.'){
						if(($charpos[1]-$charpos[0])==1){
							echo 'sulod';
						}
						$partnerinfo['lastname'] = substr($partner, 0, $charpos[0]);
						$partnerinfo['firstname'] = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$partnerinfo['middlename'] = substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1);
					}
					//de la 
					if($char[0] == ' ' and $char[1] == ' ' and $char[2] == ' '){
						if (substr(strtolower($partner), $charpos[0]+1, $charpos[2]-$charpos[0]-1) == 'de la'){
							$partnerinfo['lastname'] = substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1);
							$partnerinfo['firstname'] = substr($partner, 0, $charpos[0]);
						} else {
							$partnerinfo['lastname'] = substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1);
							$partnerinfo['firstname'] = substr($partner, 0, $charpos[2]);
						}
					}
					if($char[0] == ' ' and $char[1] == '.' and $char[2] == ' '){
						$partnerinfo['lastname'] = substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1);
						$partnerinfo['firstname'] = substr($partner, 0, $charpos[0]);
						$partnerinfo['middlename'] = substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1);
					}
					break;
					
				case '4':
	
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == ' '){
						if (substr(strtolower($partner), $charpos[2]+1, $charpos[3]-$charpos[2]-1) == 'dela'){
							$partnerinfo['lastname'] = substr($partner, 0,$charpos[0]);
							$partnerinfo['firstname'] = substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1);
							$partnerinfo['middlename'] = substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1);
						} else {
							$partnerinfo['lastname'] = substr($partner, 0,$charpos[0]);
							$partnerinfo['firstname'] = substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1);						
						}		
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == '.'){		
						$partnerinfo['lastname'] = substr($partner, 0,$charpos[0]);
						$partnerinfo['firstname'] = substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1);
						$partnerinfo['middlename'] = substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1);
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == ' '){		
						$partnerinfo['lastname'] = substr($partner, 0,$charpos[0]);
						$partnerinfo['firstname'] = substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1);				
					}
					//walter n. brown
					if($char[0] == ' ' and $char[1] == ' ' and $char[2] == '.' and $char[3] == ' '){
						$partnerinfo['lastname'] = substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1);
						$partnerinfo['firstname'] = substr($partner, 0, $charpos[0]);
						$partnerinfo['middlename'] = substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1);
					}
					if($char[0] == ' ' and $char[1] == '.' and $char[2] == ' ' and $char[3] == ','){
						$partnerinfo['lastname'] = substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1);
						$partnerinfo['firstname'] = substr($partner, 0, $charpos[0]);
						$partnerinfo['middlename'] = substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1);
					}
					if($char[0] == ' ' and $char[1] == '&' and $char[2] == ' ' and $char[3] == ' '){
						$partnerinfo['lastname'] = substr($partner, $charpos[3]+1, strlen($partner)-$charpos[3]-1);
						$partnerinfo['firstname'] = trim(substr($partner, 0, $charpos[1]));
						//$partnerinfo['middle'] = substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1);

						$partnerinfo2['lastname'] = substr($partner, $charpos[3]+1, strlen($partner)-$charpos[3]-1);
						$partnerinfo2['firstname'] = trim(substr($partner, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
						//$partnerinfo2['middle'] = substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1);
					}
					break;
				case '5':
					
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == ' ' and $char[4] == '.'){		
						$partnerinfo['lastname'] = substr($partner, 0,$charpos[0]);
						$partnerinfo['firstname'] = substr($partner, $charpos[1]+1, $charpos[3]-$charpos[1]-1);
						$partnerinfo['middlename'] = substr($partner, $charpos[3]+1, $charpos[4]-$charpos[3]-1);
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ',' and $char[3] == ' ' and $char[4] == '.'){		
						$partnerinfo['lastname'] = substr($partner, 0,$charpos[0]);
						$partnerinfo['firstname'] = trim(substr($partner, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						$partnerinfo['middlename'] = trim(substr($partner, $charpos[2]+1, $charpos[4]-$charpos[2]-1));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == ' ' and $char[3] == ' ' and $char[4] == ' '){		
						$partnerinfo['lastname'] = substr($partner, 0,$charpos[1]);
						$partnerinfo['firstname'] = substr($partner, $charpos[2]+1, $charpos[4]-$charpos[2]-1);
						$partnerinfo['middlename'] = substr($partner, $charpos[4]+1, strlen($partner)-$charpos[4]-1);
					}
					break;
				
				case '6':
					//echo "sulod";
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == ' ' and $char[3] == ' ' and $char[4] == ' '){		
						$partnerinfo['lastname'] = substr($partner, 0,$charpos[1]);
						$partnerinfo['firstname'] = substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1);
						//$partnerinfo['middle'] = substr($partner, $charpos[3]+1, $charpos[4]-$charpos[3]-1);
					}
					break;
				case '8':
					if($char[0] == ' ' and $char[1] == '.' and $char[2] == ' ' and $char[3] == ',' and $char[4] == ' ' and $char[5] == ' ' and $char[6] == '.' and $char[7] == ' '){
						$partnerinfo['lastname'] = substr($partner, $charpos[2]+1,$charpos[3]-$charpos[2]-1);
						$partnerinfo['firstname'] = substr($partner, 0, $charpos[0]);
						$partnerinfo['middlename'] = substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1);

						$partnerinfo2['lastname'] = substr($partner, $charpos[7],strlen($partner)-$charpos[7]);
						$partnerinfo2['firstname'] = trim(substr($partner, $charpos[3]+1, $charpos[5]-$charpos[3]-1));
						$partnerinfo2['middlename'] = substr($partner, $charpos[5]+1, $charpos[6]-$charpos[5]-1);
					}

					break;
			}

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

			//DATABASE --------------------------------------------------------------------
			$org = $this->mod_organization->findOrganizationByName($info['organization_name']);
			if($org == false){
				$id = $this->mod_organization->insertOrganization($info);
				$info['newid'] = $id;
				$message = $message."Added Org";
			} else {
				$info['newid'] = $org->organization_id;
				$message = $message."Duplicate Org";
			}

			$this->migrates->updateInfoNewid($info);
			//--address------------	
			if($this->mod_address->findOrganizationAddressById($info['newid']) == false){
				$addrid = $this->mod_address->insertAddress($address);	
				$this->mod_address->insertOrganizationAddress($info['newid'],$addrid,$record->Active);
				$message = $message." Added Address ";
			} else {
				$message = $message." Duplicate Address ";
			}
			//---------------------
				
			$orgaccount = $this->mod_organizationaccount->findOrgAccountByIds($info['newid'],$info['id']);
			if($orgaccount == false){
				$accountid = $this->mod_organizationaccount->insertOrganizationAccount($info);
				$info['accountid'] = $accountid;
				$message = $message." Added Acc ";
			} else {
				$info['accountid'] = $orgaccount->organization_account_id;
				$message = $message." Duplicate Acc"; 
			}

		//partner1 -------------------------
		//if partner exists
		if($partnerinfo['lastname'] !=''){
			//find partner in person table
			$per = $this->mod_person->findPersonByName($partnerinfo['lastname'], $partnerinfo['firstname']);
			if($per == false){
				$perid = $this->mod_person->insertPerson($partnerinfo);
				$message = $message." Added Person1 ";
			} else {
				$perid = $per->person_id;
				$message = $message." Duplicate Person1 ";
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
				#partner contact ------------------------------
				$contactinfo = array(
					'person_id' => $perid,
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
				//---------------------------------------------
		//organization_partner table
			$part = $this->mod_partner->findOrgPartnerByIds($info['accountid'], $info['newid'] ,$perid);
			//if partner doest exist in partner table
			if($part == false){			
				$this->mod_partner->insertOrgPartner($info,$perid);
				$message = $message." Added Partner1";
			} else {
				$message = $message." Duplicate Partner1";
			}	
				
		}

		
			
		//partner2 -------------------------
		//if partner exists
		if($partnerinfo2['lastname'] !=''){
			//find partner in person table
			$per = $this->mod_person->findPersonByName($partnerinfo2['lastname'], $partnerinfo2['firstname']);
			if($per == false){
				$perid = $this->mod_person->insertPerson($partnerinfo2);
				$message = $message." Added Person2 ";
			} else {
				$perid = $per->person_id;
				$message = $message." Duplicate Person2 ";
			}

			//organization_partner table
			$part = $this->mod_partner->findOrgPartnerByIds($info['accountid'], $info['newid'] ,$perid);
			//if partner doest exist in partner table
			if($part == false){			
				$this->mod_partner->insertOrgPartner($info,$perid);
				$message = $message." Added Partner2";
			} else {
				$message = $message." Duplicate Partner2";
			}
		}

		

			//debugger --------------------------------------------------------------
			echo $info['id']." <u> ".$record->CustName."</u><br/>";
			echo $message."<br />";
			echo "<br/>";
		}//closing foreach		

		$this->load->view('home_view');
	}//closing index
}//closing class