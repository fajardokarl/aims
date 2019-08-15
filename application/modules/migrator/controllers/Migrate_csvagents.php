<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate_csvagents extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Csvagents_model','agent');
	}

	public function index(){

	}

	public function load_cdobrokers(){
		set_time_limit(0);
		$linecounter = 0;
		$this->db->trans_start();
		$records = $this->agent->getCdobrokers();
		foreach ($records as $record) {
			$linecounter++;
			$message = '';

			$agentinfo = array(
				'realty_id' => '',
				'broker_id' => '',
				'person_id' => '',
				'status_id' => '1',
				'is_broker' => 0
				);

			$personinfo = array(
				'lastname' 				=> trim($record['lastname']),
        'firstname' 			=> trim($record['firstname']),
        'middlename' 			=> trim($record['middlename']),
        'prefix' 					=> '',
        'suffix' 					=> '',
        'sex' 						=> '',
        'birthdate' 			=> '',
        'birthplace' 			=> '',
        'nationality' 		=> '',
        'civil_status_id' => '',
        'tin' 						=> '',
        'picture_url' 		=> '',
        'mergeto' 				=> ''
				);

			$organizationinfo = array(
				'organization_name'		=> 'CDO Brokers',
        'tin' 								=> '',
        'special_instruction' => '',
        'status_id' 					=> '1'
				);

			$realtyinfo = array(
				'organization_id' => '',
				'address_id' 			=> '',
				'contact_id' 			=> ''
				);

			#find person
			$person = $this->agent->findPerson($personinfo['lastname'], $personinfo['firstname']);
			if(!$person){
				$agentinfo['person_id'] = $this->agent->insertPerson($personinfo);
				$message = $message . ' Added Person';
			} else {
				$agentinfo['person_id'] = $person['person_id'];
				$message = $message . ' Duplicate Person';
			}

			#find organization
			$organization = $this->agent->findOrganization($organizationinfo['organization_name']);
			if (!$organization) {
				$realtyinfo['organization_id'] = $this->agent->insertOrganization($organizationinfo);
				$message = $message . ' Added Organization';
			} else {
				$realtyinfo['organization_id'] = $organization['organization_id'];
				$message = $message . ' Duplicate Organization';
			}

			#find organization address
			$organizationaddress = $this->agent->findOrganizationAddress($realtyinfo['organization_id']);
			if (!$organizationaddress) {
				$realtyinfo['address_id'] = '';
				$message = $message . ' No Address';
			} else {
				$realtyinfo['address_id'] = $organizationaddress['address_id'];
				$message = $message . ' Address Found';
			}

			#find realty id
			$realty = $this->agent->findRealtyByOrganizationName($organizationinfo['organization_name']);
			if (!$realty) {
				$agentinfo['realty_id'] = $this->agent->insertRealty($realtyinfo);
				$message = $message . ' Added Realty';
			} else {
				$agentinfo['realty_id'] = $realty['realty_id'];
				$message = $message . ' Duplicate Realty';
			}

			#find agent
			$agent = $this->agent->findAgentByIds($agentinfo['realty_id'], $agentinfo['person_id']);
			if (!$agent){
				$this->agent->insertAgent($agentinfo);
				$message = $message . ' Added Agent';
			} else {
				$message = $message . ' Duplicate Agent';
			}

			echo "<u>$linecounter: ".$record['lastname'].", ".$record['firstname']."</u><br/>";
			echo $message."<br/>";
			echo "<br/>";

		}//end foreach
		$this->db->trans_complete();
	}

	public function load_leuteriorealty(){
		set_time_limit(0);
		$records = $this->agent->getLeuterio();
		$this->db->trans_start();
		$linecounter = 0;
		foreach ($records as $record) {
			$linecounter++;
			$message = '';

			$agentinfo = array(
				'realty_id' => '',
				'broker_id' => '',
				'person_id' => '',
				'status_id' => '1',
				'is_broker' => 0
				);

			$personinfo = array(
				'lastname' 				=> trim($record['lastname']),
        'firstname' 			=> trim($record['firstname']),
        'middlename' 			=> '',
        'prefix' 					=> '',
        'suffix' 					=> '',
        'sex' 						=> '',
        'birthdate' 			=> '',
        'birthplace' 			=> '',
        'nationality' 		=> '',
        'civil_status_id' => '',
        'tin' 						=> '',
        'picture_url'			=> '',
        'mergeto'					=> 0
				);

			$organizationinfo = array(
				'organization_name' 	=> 'Leuterio Realty',
        'tin' 								=> '',
        'special_instruction'	=> '',
        'status_id' 					=> 1
				);

			$realtyinfo = array(
				'organization_id' => '',
				'address_id' 			=> '',
				'contact_id' 			=> ''
				);

			#find person
			$person = $this->agent->findPerson($personinfo['lastname'], $personinfo['firstname']);
			if(!$person){
				$agentinfo['person_id'] = $this->agent->insertPerson($personinfo);
				$message = $message . ' Added Person';
			} else {
				$agentinfo['person_id'] = $person['person_id'];
				$message = $message . ' Duplicate Person';
			}

			#find organization
			$organization = $this->agent->findOrganization($organizationinfo['organization_name']);
			if (!$organization) {
				$realtyinfo['organization_id'] = $this->agent->insertOrganization($organizationinfo);
				$message = $message . ' Added Organization';
			} else {
				$realtyinfo['organization_id'] = $organization['organization_id'];
				$message = $message . ' Duplicate Organization';
			}

			#find organization address
			$organizationaddress = $this->agent->findOrganizationAddress($realtyinfo['organization_id']);
			if (!$organizationaddress) {
				$realtyinfo['address_id'] = '';
				$message = $message . ' No Address';
			} else {
				$realtyinfo['address_id'] = $organizationaddress['address_id'];
				$message = $message . ' Address Found';
			}

			#find realty id
			$realty = $this->agent->findRealtyByOrganizationName($organizationinfo['organization_name']);
			if (!$realty) {
				$agentinfo['realty_id'] = $this->agent->insertRealty($realtyinfo);
				$message = $message . ' Added Realty';
			} else {
				$agentinfo['realty_id'] = $realty['realty_id'];
				$message = $message . ' Duplicate Realty';
			}

			#find agent
			$agent = $this->agent->findAgentByIds($agentinfo['realty_id'], $agentinfo['person_id']);
			if (!$agent){
				$this->agent->insertAgent($agentinfo);
				$message = $message . ' Added Agent';
			} else {
				$message = $message . ' Duplicate Agent';
			}

			echo "<u>$linecounter: ".$record['lastname'].", ".$record['firstname']."</u><br/>";
			echo $message."<br/>";
			echo "<br/>";

		}//end foreach
		$this->db->trans_complete();
	}

	public function load_trulywealthy(){
		set_time_limit(0);
		$records = $this->agent->getTrulywealthy();
		$this->db->trans_start();
		$linecounter = 0;
		foreach ($records as $record) {
			$linecounter++;
			$message = '';

			$agentinfo = array(
				'realty_id' => '',
				'broker_id' => '',
				'person_id' => '',
				'status_id' => 1,
				'is_broker' => 0
				);

			$personinfo = array(
				'lastname' 				=> trim($record['lastname']),
        'firstname' 			=> trim($record['firstname']),
        'middlename' 			=> trim($record['middlename']),
        'prefix'					=> '',
        'suffix' 					=> '',
        'sex' 						=> '',
        'birthdate' 			=> '',
        'birthplace' 			=> '',
        'nationality' 		=> '',
        'civil_status_id' => '',
        'tin' 						=> '',
        'picture_url'			=> '',
        'mergeto'					=> 0
				);

			$organizationinfo = array(
				'organization_name' 	=> 'Truly Wealthy Realty Corp',
        'tin' 								=> '',
        'special_instruction'	=> '',
        'status_id' 					=> 1
				);

			$realtyinfo = array(
				'organization_id' => '',
				'address_id' => '',
				'contact_id' => ''
				);

			#find person
			$person = $this->agent->findPerson($personinfo['lastname'], $personinfo['firstname']);
			if(!$person){
				$agentinfo['person_id'] = $this->agent->insertPerson($personinfo);
				$message = $message . ' Added Person';
			} else {
				$agentinfo['person_id'] = $person['person_id'];
				$message = $message . ' Duplicate Person';
			}

			#find organization
			$organization = $this->agent->findOrganization($organizationinfo['organization_name']);
			if (!$organization) {
				$realtyinfo['organization_id'] = $this->agent->insertOrganization($organizationinfo);
				$message = $message . ' Added Organization';
			} else {
				$realtyinfo['organization_id'] = $organization['organization_id'];
				$message = $message . ' Duplicate Organization';
			}

			#find organization address
			$organizationaddress = $this->agent->findOrganizationAddress($realtyinfo['organization_id']);
			if (!$organizationaddress) {
				$realtyinfo['address_id'] = '';
				$message = $message . ' No Address';
			} else {
				$realtyinfo['address_id'] = $organizationaddress['address_id'];
				$message = $message . ' Address Found';
			}

			#find realty id
			$realty = $this->agent->findRealtyByOrganizationName($organizationinfo['organization_name']);
			if (!$realty) {
				$agentinfo['realty_id'] = $this->agent->insertRealty($realtyinfo);
				$message = $message . ' Added Realty';
			} else {
				$agentinfo['realty_id'] = $realty['realty_id'];
				$message = $message . ' Duplicate Realty';
			}

			#find agent
			$agent = $this->agent->findAgentByIds($agentinfo['realty_id'], $agentinfo['person_id']);
			if (!$agent){
				$this->agent->insertAgent($agentinfo);
				$message = $message . ' Added Agent';
			} else {
				$message = $message . ' Duplicate Agent';
			}

			echo "<u>$linecounter: ".$record['lastname'].", ".$record['firstname']."</u><br/>";
			echo $message."<br/>";
			echo "<br/>";

		}//end foreach
		$this->db->trans_complete();
	}

	public function load_gamberealty(){
		set_time_limit(0);
		$records = $this->agent->getGamberealty();
		$this->db->trans_start();
		$linecounter = 0;
		foreach ($records as $record) {
			$linecounter++;
			$message = '';

			$agentinfo = array(
				'realty_id' => '',
				'broker_id' => '',
				'person_id' => '',
				'status_id' => 1,
				'is_broker' => 0
				);

			$personinfo = array(
				'lastname' 				=> trim($record['lastname']),
        'firstname' 			=> trim($record['firstname']),
        'middlename' 			=> trim($record['middlename']),
        'prefix'					=> '',
        'suffix' 					=> '',
        'sex' 						=> '',
        'birthdate' 			=> '',
        'birthplace' 			=> '',
        'nationality' 		=> '',
        'civil_status_id' => '',
        'tin' 						=> '',
        'picture_url'			=> '',
        'mergeto'					=> 0
				);

			$organizationinfo = array(
				'organization_name' 	=> 'Gambe Realty',
        'tin' 								=> '',
        'special_instruction' => '',
        'status_id' 					=> 1
				);

			$realtyinfo = array(
				'organization_id' => '',
				'address_id' => '',
				'contact_id' => ''
				);

			#find person
			$person = $this->agent->findPerson($personinfo['lastname'], $personinfo['firstname']);
			if(!$person){
				$agentinfo['person_id'] = $this->agent->insertPerson($personinfo);
				$message = $message . ' Added Person';
			} else {
				$agentinfo['person_id'] = $person['person_id'];
				$message = $message . ' Duplicate Person';
			}

			#find organization
			$organization = $this->agent->findOrganization($organizationinfo['organization_name']);
			if (!$organization) {
				$realtyinfo['organization_id'] = $this->agent->insertOrganization($organizationinfo);
				$message = $message . ' Added Organization';
			} else {
				$realtyinfo['organization_id'] = $organization['organization_id'];
				$message = $message . ' Duplicate Organization';
			}

			#find organization address
			$organizationaddress = $this->agent->findOrganizationAddress($realtyinfo['organization_id']);
			if (!$organizationaddress) {
				$realtyinfo['address_id'] = '';
				$message = $message . ' No Address';
			} else {
				$realtyinfo['address_id'] = $organizationaddress['address_id'];
				$message = $message . ' Address Found';
			}

			#find realty id
			$realty = $this->agent->findRealtyByOrganizationName($organizationinfo['organization_name']);
			if (!$realty) {
				$agentinfo['realty_id'] = $this->agent->insertRealty($realtyinfo);
				$message = $message . ' Added Realty';
			} else {
				$agentinfo['realty_id'] = $realty['realty_id'];
				$message = $message . ' Duplicate Realty';
			}

			#find agent
			$agent = $this->agent->findAgentByIds($agentinfo['realty_id'], $agentinfo['person_id']);
			if (!$agent){
				$this->agent->insertAgent($agentinfo);
				$message = $message . ' Added Agent';
			} else {
				$message = $message . ' Duplicate Agent';
			}

			echo "<u>$linecounter: ".$record['lastname'].", ".$record['firstname']."</u><br/>";
			echo $message."<br/>";
			echo "<br/>";

		}//end foreach
		$this->db->trans_complete();
	}

	public function load_powerproperties(){
		set_time_limit(0);
		$records = $this->agent->getPowerproperties();
		$this->db->trans_start();
		$linecounter = 0;
		foreach ($records as $record) {
			$linecounter++;
			$message = '';

			$agentinfo = array(
				'realty_id' => '',
				'broker_id' => '',
				'person_id' => '',
				'status_id' => 1,
				'is_broker' => 0
				);

			$personinfo = array(
				'lastname' 				=> trim($record['lastname']),
        'firstname' 			=> trim($record['firstname']),
        'middlename' 			=> trim($record['middlename']),
        'prefix'					=> '',
        'suffix' 					=> '',
        'sex' 						=> '',
        'birthdate' 			=> '',
        'birthplace' 			=> '',
        'nationality' 		=> '',
        'civil_status_id' => '',
        'tin'	 						=> '',
        'picture_url'			=> '',
        'mergeto'					=> 0
				);

			$organizationinfo = array(
				'organization_name' 	=> 'Power Properties Realty Mgt and Dev Corp',
        'tin' 								=> '',
        'special_instruction' => '',
        'status_id' 					=> 1
				);

			$realtyinfo = array(
				'organization_id' => '',
				'address_id' => '',
				'contact_id' => ''
				);

			#find person
			$person = $this->agent->findPerson($personinfo['lastname'], $personinfo['firstname']);
			if(!$person){
				$agentinfo['person_id'] = $this->agent->insertPerson($personinfo);
				$message = $message . ' Added Person';
			} else {
				$agentinfo['person_id'] = $person['person_id'];
				$message = $message . ' Duplicate Person';
			}

			#find organization
			$organization = $this->agent->findOrganization($organizationinfo['organization_name']);
			if (!$organization) {
				$realtyinfo['organization_id'] = $this->agent->insertOrganization($organizationinfo);
				$message = $message . ' Added Organization';
			} else {
				$realtyinfo['organization_id'] = $organization['organization_id'];
				$message = $message . ' Duplicate Organization';
			}

			#find organization address
			$organizationaddress = $this->agent->findOrganizationAddress($realtyinfo['organization_id']);
			if (!$organizationaddress) {
				$realtyinfo['address_id'] = '';
				$message = $message . ' No Address';
			} else {
				$realtyinfo['address_id'] = $organizationaddress['address_id'];
				$message = $message . ' Address Found';
			}

			#find realty id
			$realty = $this->agent->findRealtyByOrganizationName($organizationinfo['organization_name']);
			if (!$realty) {
				$agentinfo['realty_id'] = $this->agent->insertRealty($realtyinfo);
				$message = $message . ' Added Realty';
			} else {
				$agentinfo['realty_id'] = $realty['realty_id'];
				$message = $message . ' Duplicate Realty';
			}

			#find agent
			$agent = $this->agent->findAgentByIds($agentinfo['realty_id'], $agentinfo['person_id']);
			if (!$agent){
				$this->agent->insertAgent($agentinfo);
				$message = $message . ' Added Agent';
			} else {
				$message = $message . ' Duplicate Agent';
			}

			echo "<u>$linecounter: ".$record['lastname'].", ".$record['firstname']."</u><br/>";
			echo $message."<br/>";
			echo "<br/>";

		}//end foreach
		$this->db->trans_complete();
	}

	public function load_jcarealty(){
		set_time_limit(0);
		$records = $this->agent->getJcarealty();
		$this->db->trans_start();
		$linecounter = 0;
		foreach ($records as $record) {
			$linecounter++;
			$message = '';

			$agentinfo = array(
				'realty_id' => '',
				'broker_id' => '',
				'person_id' => '',
				'status_id' => 1,
				'is_broker' => 0
				);

			$personinfo = array(
				'lastname' 				=> trim($record['lastname']),
        'firstname' 			=> trim($record['firstname']),
        'middlename' 			=> trim($record['middlename']),
        'prefix'					=> '',
        'suffix' 					=> '',
        'sex' 						=> '',
        'birthdate'	 			=> '',
        'birthplace' 			=> '',
        'nationality' 		=> '',
        'civil_status_id' => '',
        'tin' 						=> '',
        'picture_url'			=> '',
        'mergeto'					=> 0
				);

			$organizationinfo = array(
				'organization_name' 	=> 'JCA Realty',
        'tin' 								=> '',
        'special_instruction' => '',
        'status_id' 					=> 1
				);

			$realtyinfo = array(
				'organization_id' => '',
				'address_id' 			=> '',
				'contact_id' 			=> ''
				);

			#find person
			$person = $this->agent->findPerson($personinfo['lastname'], $personinfo['firstname']);
			if(!$person){
				$agentinfo['person_id'] = $this->agent->insertPerson($personinfo);
				$message = $message . ' Added Person';
			} else {
				$agentinfo['person_id'] = $person['person_id'];
				$message = $message . ' Duplicate Person';
			}

			#find organization
			$organization = $this->agent->findOrganization($organizationinfo['organization_name']);
			if (!$organization) {
				$realtyinfo['organization_id'] = $this->agent->insertOrganization($organizationinfo);
				$message = $message . ' Added Organization';
			} else {
				$realtyinfo['organization_id'] = $organization['organization_id'];
				$message = $message . ' Duplicate Organization';
			}

			#find organization address
			$organizationaddress = $this->agent->findOrganizationAddress($realtyinfo['organization_id']);
			if (!$organizationaddress) {
				$realtyinfo['address_id'] = '';
				$message = $message . ' No Address';
			} else {
				$realtyinfo['address_id'] = $organizationaddress['address_id'];
				$message = $message . ' Address Found';
			}

			#find realty id
			$realty = $this->agent->findRealtyByOrganizationName($organizationinfo['organization_name']);
			if (!$realty) {
				$agentinfo['realty_id'] = $this->agent->insertRealty($realtyinfo);
				$message = $message . ' Added Realty';
			} else {
				$agentinfo['realty_id'] = $realty['realty_id'];
				$message = $message . ' Duplicate Realty';
			}

			#find agent
			$agent = $this->agent->findAgentByIds($agentinfo['realty_id'], $agentinfo['person_id']);
			if (!$agent){
				$this->agent->insertAgent($agentinfo);
				$message = $message . ' Added Agent';
			} else {
				$message = $message . ' Duplicate Agent';
			}

			echo "<u>$linecounter: ".$record['lastname'].", ".$record['firstname']."</u><br/>";
			echo $message."<br/>";
			echo "<br/>";

		}//end foreach
		$this->db->trans_complete();
	}

	public function load_cheerealty(){
		set_time_limit(0);
		$records = $this->agent->getCheerealty();
		$this->db->trans_start();
		$linecounter = 0;
		foreach ($records as $record) {
			$linecounter++;
			$message = '';

			$agentinfo = array(
				'realty_id' => '',
				'broker_id' => '',
				'person_id' => '',
				'status_id' => 1,
				'is_broker' => 0
				);

			$personinfo = array(
				'lastname' 				=> trim($record['lastname']),
        'firstname' 			=> trim($record['firstname']),
        'middlename' 			=> trim($record['middlename']),
        'prefix' 					=> '',
        'suffix' 					=> '',
        'sex' 						=> '',
        'birthdate' 			=> '',
        'birthplace' 			=> '',
        'nationality' 		=> '',
        'civil_status_id' => '',
        'tin' 						=> '',
        'picture_url' 		=> '',
        'mergeto' 				=> 0
				);

			$organizationinfo = array(
				'organization_name' 	=> 'Chee Realty Development Corp',
        'tin' 								=> '',
        'special_instruction' => '',
        'status_id' 					=> 1
				);

			$realtyinfo = array(
				'organization_id' => '',
				'address_id' 			=> '',
				'contact_id' 			=> ''
				);

			#find person
			$person = $this->agent->findPerson($personinfo['lastname'], $personinfo['firstname']);
			if(!$person){
				$agentinfo['person_id'] = $this->agent->insertPerson($personinfo);
				$message = $message . ' Added Person';
			} else {
				$agentinfo['person_id'] = $person['person_id'];
				$message = $message . ' Duplicate Person';
			}

			#find organization
			$organization = $this->agent->findOrganization($organizationinfo['organization_name']);
			if (!$organization) {
				$realtyinfo['organization_id'] = $this->agent->insertOrganization($organizationinfo);
				$message = $message . ' Added Organization';
			} else {
				$realtyinfo['organization_id'] = $organization['organization_id'];
				$message = $message . ' Duplicate Organization';
			}

			#find organization address
			$organizationaddress = $this->agent->findOrganizationAddress($realtyinfo['organization_id']);
			if (!$organizationaddress) {
				$realtyinfo['address_id'] = '';
				$message = $message . ' No Address';
			} else {
				$realtyinfo['address_id'] = $organizationaddress['address_id'];
				$message = $message . ' Address Found';
			}

			#find realty id
			$realty = $this->agent->findRealtyByOrganizationName($organizationinfo['organization_name']);
			if (!$realty) {
				$agentinfo['realty_id'] = $this->agent->insertRealty($realtyinfo);
				$message = $message . ' Added Realty';
			} else {
				$agentinfo['realty_id'] = $realty['realty_id'];
				$message = $message . ' Duplicate Realty';
			}

			#find agent
			$agent = $this->agent->findAgentByIds($agentinfo['realty_id'], $agentinfo['person_id']);
			if (!$agent){
				$this->agent->insertAgent($agentinfo);
				$message = $message . ' Added Agent';
			} else {
				$message = $message . ' Duplicate Agent';
			}

			echo "<u>$linecounter: ".$record['lastname'].", ".$record['firstname']."</u><br/>";
			echo $message."<br/>";
			echo "<br/>";

		}//end foreach
		$this->db->trans_complete();
	}
}