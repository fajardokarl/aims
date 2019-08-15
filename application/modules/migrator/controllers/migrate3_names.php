<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate3_names extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Migrator_model', 'migrates');
		$this->load->model('commonfunctions');
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
				'lastname' => "",
				'firstname' => "",
				'middlename' => "",
				'prefix' => "",
				'suffix' => "",
				);

			$cpinfo = array(
				'lastname' => "",
				'firstname' => "",
				'middlename' => "",
				'prefix' => "",
				'suffix' => ""
				);

			$info2 = array(
				'lastname' => "",
				'firstname' => "",
				'middlename' => "",
				'prefix' => "",
				'suffix' => ""
				);

			$info3 = array(
				'lastname' => "",
				'firstname' => "",
				'middlename' => "",
				'prefix' => "",
				'suffix' => ""
				);

			$info4 = array(
				'lastname' => "",
				'firstname' => "",
				'middlename' => "",
				'prefix' => "",
				'suffix' => ""
				);
			

			$message = "";

			$char = [];
			$charpos = [];

			$cpchar = [];
			$cpcharpos = [];
			
			$nameholder = trim($record->name);
			echo "$linecounter:  <u>".$info['id']."  ".$info['name']."</u><br/>";
			$cpholder = trim($record->CPName);

			if($cpholder == 'N/A' or $cpholder == 'N/A.' or $cpholder == 'NA/' or $cpholder == 'N/A/' or $cpholder == '' or $cpholder == 'N.A' or $cpholder == 'NA' or $cpholder == 'n/a' or $cpholder == '-NA' or $cpholder == '-NA-' or substr_count(strtolower($cpholder), 'none')> 0 or substr_count(strtolower($cpholder), 'deceased')> 0){
				
				$cpinfo['lastname'] = '';
			
			}else {
				if(substr_count(strtolower($cpholder), 'c/o ') >0){
		
					$cpholder = substr($cpholder, 0, strpos(strtolower($cpholder), 'c/o ')).substr($cpholder, strpos(strtolower($cpholder), 'c/o ')+4,strlen($cpholder)-strpos(strtolower($cpholder), 'c/o ')-4);
				}
				if(substr_count(strtolower($cpholder), 'jr.') >0){
					$cpinfo['suffix'] = 'Jr.';
					$cpholder = substr($cpholder, 0, strpos(strtolower($cpholder), 'jr.')).substr($cpholder, strpos(strtolower($cpholder), 'jr.')+3,strlen($cpholder)-strpos(strtolower($cpholder), 'jr.')-3);
				}
				if(substr_count(strtolower($cpholder), 'sr.') >0){
					$cpinfo['suffix'] = 'Sr.';
					$cpholder = substr($cpholder, 0, strpos(strtolower($cpholder), 'sr.')).substr($cpholder, strpos(strtolower($cpholder), 'sr.')+3,strlen($cpholder)-strpos(strtolower($cpholder), 'sr.')-3);
				}
				if(substr_count($cpholder, ' II') >0){
					$cpinfo['suffix'] = 'II';
					$cpholder = substr($cpholder, 0, strpos($cpholder, ' II')).substr($cpholder, strpos($cpholder, ' II')+3,strlen($cpholder)-strpos($cpholder, ' II')-3);
				}
				if(substr_count($cpholder, ' III') >0){
					$cpinfo['suffix'] = 'III';
					$cpholder = substr($cpholder, 0, strpos($cpholder, ' III')).substr($cpholder, strpos($cpholder, ' III')+4,strlen($cpholder)-strpos($nameholder, ' III')-4);
				}
				if(substr_count(strtolower($cpholder), 'sps.') > 0){
					$cpholder = substr($cpholder, 0, strpos(strtolower($cpholder), 'sps.')).substr($cpholder, strpos(strtolower($cpholder), 'sps.')+4,strlen($cpholder)-strpos(strtolower($cpholder), 'sps.')-4);
				}

				//echo $cpholder."<br/>";
				for ($i=0; $i < strlen($cpholder) ; $i++) { 
					if (substr($cpholder, $i,1) == ',' ){
						array_push($cpchar, ',');
						array_push($cpcharpos, $i);
					}
					if (substr($cpholder, $i,1) == '.' ){
						array_push($cpchar, '.');
						array_push($cpcharpos, $i);
					}
					if (substr($cpholder, $i,1) == '/' ){
						array_push($cpchar, '/');
						array_push($cpcharpos, $i);
					}
					if (substr($cpholder, $i,1) == '&' ){
						array_push($cpchar, '&');
						array_push($cpcharpos, $i);
					}
					if (substr($cpholder, $i,1) == ' '){
						if (substr($cpholder, $i-1,1) == ',' or 
							substr($cpholder, $i-1,1) == '.' or 
							substr($cpholder, $i-1,1) == '/' or 
							substr($cpholder, $i-1,1) == '&' or 
							substr($cpholder, $i+1,1) == ',' or 
							substr($cpholder, $i+1,1) == '.' or 
							substr($cpholder, $i+1,1) == '/' or 
							substr($cpholder, $i+1,1) == '&'){

						} else{
							array_push($cpchar, ' ');
							array_push($cpcharpos, $i);
						}
					} 
				} 


				switch (sizeof($cpchar)) {
					case '1':
						if($cpchar[0] == ' '){
				
							$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[0]+1, strlen($cpholder)-$cpcharpos[0]-1));
							$cpinfo['firstname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
						}
						if($cpchar[0] == ','){
					
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, strlen($cpholder)-$cpcharpos[0]-1));
						}
						if($cpchar[0] == '.'){

							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, strlen($cpholder)-$cpcharpos[0]-1));
						}
						break;
		//----------------------------------------------
					case '2':
						if($cpchar[0] == ' ' and $cpchar[1] == '.'){
							if($cpcharpos[0]+2 == $cpcharpos[1]){
								$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[1]+1, strlen($cpholder)-$cpcharpos[1]-1));
								$cpinfo['firstname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
								$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[0]+1,$cpcharpos[1]-$cpcharpos[0]-1));
							}	
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ','){						
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[1]+1, strlen($cpholder)-$cpcharpos[1]-1));
						}
						if($cpchar[0] == ',' and $cpchar[1] == ' '){
						
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, strlen($cpholder)-$cpcharpos[0]-1));
						}
						if($cpchar[0] == ',' and $cpchar[1] == '&'){
						
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[1]-$cpcharpos[0]-1));
						}
						if($cpchar[0] == ',' and $cpchar[1] == '.'){
						
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, strlen($cpholder)-$cpcharpos[0]-1));
						}
						if($cpchar[0] == ',' and $cpchar[1] == ','){
						
							if($cpcharpos[1]+1 == strlen($cpholder)){
								$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
								$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[1]-$cpcharpos[0]-1));
							} else {
								$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
								$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[1]-$cpcharpos[0]-1));
								$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[1]+1, strlen($cpholder)-$cpcharpos[1]-1));
							}
							
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ' '){
					
							$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[1]+1, strlen($cpholder)-$cpcharpos[1]-1));
							$cpinfo['firstname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
						}
						if($cpchar[0] == '.' and $cpchar[1] == ' '){
				
							if(substr(strtolower($cpholder), $cpcharpos[0]-2,2)== 'dr'){
								$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[1]+1, strlen($cpholder)-$cpcharpos[1]-1));
								$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1,$cpcharpos[1]-$cpcharpos[0]-1));
								$cpinfo['prefix'] = 'Dr.';
							} elseif(substr(strtolower($cpholder), $cpcharpos[0]-4,4)== 'engr'){
								$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[1]+1, strlen($cpholder)-$cpcharpos[1]-1));
								$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1,$cpcharpos[1]-$cpcharpos[0]-1));
								$cpinfo['prefix'] = 'Engr.';
							} elseif(substr(strtolower($cpholder), $cpcharpos[0]-3,3)== 'dra'){
								$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[1]+1, strlen($cpholder)-$cpcharpos[1]-1));
								$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1,$cpcharpos[1]-$cpcharpos[0]-1));
								$cpinfo['prefix'] = 'Dra.';
							} elseif(substr(strtolower($cpholder), $cpcharpos[0]-4,4)== 'atty'){
								$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[1]+1, strlen($cpholder)-$cpcharpos[1]-1));
								$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1,$cpcharpos[1]-$cpcharpos[0]-1));
								$cpinfo['prefix'] = 'Atty.';
							} elseif(substr(strtolower($cpholder), $cpcharpos[0]-2,2)== 'ma'){
								$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[1]+1, strlen($cpholder)-$cpcharpos[1]-1));
								$cpinfo['firstname'] = trim(substr($cpholder, 0,$cpcharpos[1]));
								
							} else {
								$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[1]+1, strlen($cpholder)-$cpcharpos[1]-1));
								$cpinfo['firstname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
							}
						}
						break;
//-----------------------------------------------------------
					case '3':
						if($cpchar[0] == ',' and $cpchar[1] == ' ' and $cpchar[2] == ' '){
							
							if($cpcharpos[2]+2 == strlen($cpholder)){
							
								$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
								$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[2]-$cpcharpos[0]-1));
								$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[2]+1,1));
							} else {
								$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
								$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, strlen($cpholder)-$cpcharpos[0]-1));
							}
						}
						if($cpchar[0] == '.' and $cpchar[1] == ' ' and $cpchar[2] == '.'){
							
							if($cpcharpos[0] == 2){
								$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[2]+1,strlen($cpholder)-$cpcharpos[2]-1));
								$cpinfo['firstname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
								$cpinfo['middlename'] =  trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[2]-$cpcharpos[1]-1));
							} else {
								$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
								$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[1]-$cpcharpos[0]-1));
								$cpinfo['middlename'] =  trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[2]-$cpcharpos[1]-1));
							}
						}
						if($cpchar[0] == '.' and $cpchar[1] == ',' and $cpchar[2] == '.'){

							$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[1]-$cpcharpos[0]-1));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[1]+1, strlen($cpholder)-$cpcharpos[1]-1));
							$cpinfo['prefix'] = 'Dr.';  
						}
						if($cpchar[0] == ',' and $cpchar[1] == '.' and $cpchar[2] == ','){
			
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[2]-$cpcharpos[0]-1));
							$cpinfo['middlename'] =  trim(substr($cpholder, $cpcharpos[2]+1, strlen($cpholder)-$cpcharpos[2]-1));
						}
						if($cpchar[0] == ',' and $cpchar[1] == ',' and $cpchar[2] == ','){
							
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[1]-$cpcharpos[0]-1));
						}
						if($cpchar[0] == ',' and $cpchar[1] == '/' and $cpchar[2] == '/'){
							
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[1]-$cpcharpos[0]-1));
						}
						if($cpchar[0] == ',' and $cpchar[1] == ' ' and $cpchar[2] == '/'){
			
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[2]-$cpcharpos[0]-1));
							$cpinfo['middlename'] =  trim(substr($cpholder, $cpcharpos[2]+1, strlen($cpholder)-$cpcharpos[2]-1));
						}
						if($cpchar[0] == ',' and $cpchar[1] == ' ' and $cpchar[2] == ','){
						
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[2]-$cpcharpos[0]-1));
							$cpinfo['middlename'] =  trim(substr($cpholder, $cpcharpos[2]+1, strlen($cpholder)-$cpcharpos[2]-1));
						}
						if($cpchar[0] == ',' and $cpchar[1] == ' ' and $cpchar[2] == '.'){
							
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[1]-$cpcharpos[0]-1));
							$cpinfo['middlename'] =  trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[2]-$cpcharpos[1]-1));
						}
						if($cpchar[0] == ',' and $cpchar[1] == '.' and $cpchar[2] == ' '){
					
							if($cpcharpos[2]+2 == strlen($cpholder)){
								$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
								$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[2]-$cpcharpos[0]-1));
								$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[2]+1, strlen($cpholder)-$cpcharpos[2]-1));
							} else {
								$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
								$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, strlen($cpholder)-$cpcharpos[0]-1));	
							}				
						}
						if($cpchar[0] == ',' and $cpchar[1] == ',' and $cpchar[2] == ' '){
					
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
								$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[1]-$cpcharpos[0]-1));
								$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[1]+1, strlen($cpholder)-$cpcharpos[1]-1));
						}
						if($cpchar[0] == '.' and $cpchar[1] == ' ' and $cpchar[2] == ' '){
						
							if(substr(strtolower($cpholder), $cpcharpos[0]-4,4)== 'atty'){
								$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[2]+1, strlen($cpholder)-$cpcharpos[1]-1));
								$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1,$cpcharpos[2]-$cpcharpos[0]-1));
								$cpinfo['prefix'] = 'Atty.';
							} else {
								$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[2]+1, strlen($cpholder)-$cpcharpos[1]-1));
								$cpinfo['firstname'] = trim(substr($cpholder, 0,$cpcharpos[1]));
								$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[2]-$cpcharpos[1]-1));
							}
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ',' and $cpchar[2] == ','){
				
							$cpinfo['lastname'] = trim(substr($cpholder, 0,$cpcharpos[1]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[2]-$cpcharpos[1]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[2]+1, strlen($cpholder)-$cpcharpos[2]-1));
						}
						if($cpchar[0] == ' ' and $cpchar[1] == '.' and $cpchar[2] == ','){
					
							if($cpcharpos[2]+2 < strlen($cpholder)){
								$cpinfo['suffix'] = trim(substr($cpholder, $cpcharpos[2]+1, strlen($cpholder)-$cpcharpos[2]-1));
							}
								$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[2]-$cpcharpos[1]-1));
								$cpinfo['firstname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
								$cpinfo['middlename'] =  trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[1]-$cpcharpos[0]-1));
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ' ' and $cpchar[2] == ','){
				
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[2]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[2]+1, strlen($cpholder)-$cpcharpos[2]-1));
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ' ' and $cpchar[2] == '.'){
						
							$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[2]+1, strlen($cpholder)-$cpcharpos[2]-1));
							$cpinfo['firstname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
							$cpinfo['middlename'] =  trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[2]-$cpcharpos[1]-1));
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ',' and $cpchar[2] == ' '){
			
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[2]+1, strlen($cpholder)-$cpcharpos[2]-1));
							
						}
						if($cpchar[0] == ' ' and $cpchar[1] == '.' and $cpchar[2] == ' '){
		
							$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[1]+1, strlen($cpholder)-$cpcharpos[1]-1));
								$cpinfo['firstname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
								$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[0]+1,$cpcharpos[1]-$cpcharpos[0]-1));
							
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ' ' and $cpchar[2] == ' '){
	
							if($cpcharpos[0] == 2){
								$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
								$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[1]+1, strlen($cpholder)-$cpcharpos[1]-1));
							} else {
								if ($cpcharpos[2]+2 < strlen($cpholder)) {
									$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[2]+1, strlen($cpholder)-$cpcharpos[2]-1));
									$cpinfo['firstname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
									$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[1]+1,$cpcharpos[2]-$cpcharpos[1]-1));
								} else {
									$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[1]+1, strlen($cpholder)-$cpcharpos[1]-1));
									$cpinfo['firstname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
									$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[0]+1,$cpcharpos[1]-$cpcharpos[0]-1));
								}
							}
							
						}
						break;
//--------------------------------------------------------
					case '4':
						if($cpchar[0] == ',' and $cpchar[1] == ' ' and $cpchar[2] == ' ' and $cpchar[3] == ' '){
				
							if($cpcharpos[3]+2 == strlen($cpholder)){
								$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
								$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1,$cpcharpos[3]-$cpcharpos[0]-1));
								$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[3]+1,strlen($cpholder)-$cpcharpos[3]-1));
							} else {
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1,strlen($cpholder)-$cpcharpos[0]-1));
							}
						}
						if($cpchar[0] == ',' and $cpchar[1] == ' ' and $cpchar[2] == ',' and $cpchar[3] == ' '){
						
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1,$cpcharpos[2]-$cpcharpos[0]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[2]+1,$cpcharpos[3]-$cpcharpos[2]-1));
						}
						if($cpchar[0] == ',' and $cpchar[1] == ' ' and $cpchar[2] == ' ' and $cpchar[3] == '.'){
						
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[2]-$cpcharpos[0]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[2]+1, $cpcharpos[3]-$cpcharpos[2]-1)); 
						}
						if($cpchar[0] == ',' and $cpchar[1] == '.' and $cpchar[2] == ' ' and $cpchar[3] == '.'){
				
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[2]-$cpcharpos[0]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[2]+1, $cpcharpos[3]-$cpcharpos[2]-1)); 
						}
						if($cpchar[0] == '.' and $cpchar[1] == ' ' and $cpchar[2] == ' ' and $cpchar[3] == ' '){

							$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[3]+1, strlen($cpholder)-$cpcharpos[3]-1));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[1]-$cpcharpos[0]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[2]+1, $cpcharpos[3]-$cpcharpos[2]-1)); 
							$cpinfo['prefix'] = 'Dr.';
						}
						if($cpchar[0] == '.' and $cpchar[1] == ' ' and $cpchar[2] == '.' and $cpchar[3] == ' '){
					
							$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[2]+1, strlen($cpholder)-$cpcharpos[2]-1));
							$cpinfo['firstname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[2]-$cpcharpos[1]-1)); 
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ' ' and $cpchar[2] == ' ' and $cpchar[3] == '.'){
							
							$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[3]+1, strlen($cpholder)-$cpcharpos[2]-1));
							$cpinfo['firstname'] = trim(substr($cpholder, 0, $cpcharpos[2]));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[2]+1, $cpcharpos[3]-$cpcharpos[2]-1)); 
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ',' and $cpchar[2] == ' ' and $cpchar[3] == ' '){
	
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[3]-$cpcharpos[1]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[3]+1, strlen($cpholder)-$cpcharpos[3]-1)); 
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ',' and $cpchar[2] == ' ' and $cpchar[3] == ','){
			
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[3]-$cpcharpos[1]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[3]+1, strlen($cpholder)-$cpcharpos[3]-1)); 
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ',' and $cpchar[2] == ' ' and $cpchar[3] == '.'){
	
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[2]-$cpcharpos[1]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[2]+1, $cpcharpos[3]-$cpcharpos[2]-1)); 
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ' ' and $cpchar[2] == '.' and $cpchar[3] == '.'){
						
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[3]+1, strlen($cpholder)-$cpcharpos[3]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[3]-$cpcharpos[1]-1)); 
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ' ' and $cpchar[2] == '.' and $cpchar[3] == ' '){
	
							$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[3]+1, strlen($cpholder)-$cpcharpos[3]-1)); 
							$cpinfo['firstname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[2]-$cpcharpos[1]-1));
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ' ' and $cpchar[2] == ' ' and $cpchar[3] == ' '){
	
							$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[2]+1, strlen($cpholder)-$cpcharpos[2]-1)); 
							$cpinfo['firstname'] = trim(substr($cpholder, 0, $cpcharpos[2]));
							
						}
						break;
	//----------------------------------------------------------------------------
					case '5':
						if($cpchar[0] == ',' and $cpchar[1] == ' ' and $cpchar[2] == ' ' and $cpchar[3] == ' ' and $cpchar[4] == '.'){
							
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[3]-$cpcharpos[0]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[3]+1, $cpcharpos[4]-$cpcharpos[3]-1)); 
						}
						if($cpchar[0] == ',' and $cpchar[1] == ' ' and $cpchar[2] == '/' and $cpchar[3] == ',' and $cpchar[4] == ' '){

							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[1]-$cpcharpos[0]-1));
						
						}
						if($cpchar[0] == ',' and $cpchar[1] == ',' and $cpchar[2] == ',' and $cpchar[3] == ' ' and $cpchar[4] == ' '){
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[1]-$cpcharpos[0]-1));
						}
						if($cpchar[0] == ',' and $cpchar[1] == '.' and $cpchar[2] == ' ' and $cpchar[3] == ' ' and $cpchar[4] == '.'){
						
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[0]+1, $cpcharpos[3]-$cpcharpos[0]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[3]+1, $cpcharpos[4]-$cpcharpos[3]-1)); 
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ',' and $cpchar[2] == ' ' and $cpchar[3] == ' ' and $cpchar[4] == '.'){
				
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[3]-$cpcharpos[1]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[3]+1, $cpcharpos[4]-$cpcharpos[3]-1)); 
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ',' and $cpchar[2] == '.' and $cpchar[3] == ' ' and $cpchar[4] == '.'){
			
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[1]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[3]-$cpcharpos[1]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[3]+1, $cpcharpos[4]-$cpcharpos[3]-1)); 
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ' ' and $cpchar[2] == ',' and $cpchar[3] == ' ' and $cpchar[4] == '.'){
			
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[2]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[2]+1, $cpcharpos[3]-$cpcharpos[2]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[3]+1, $cpcharpos[4]-$cpcharpos[3]-1)); 
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ' ' and $cpchar[2] == ' ' and $cpchar[3] == '.' and $cpchar[4] == ' '){
	
							$cpinfo['lastname'] = trim(substr($cpholder, $cpcharpos[3]+1, $cpcharpos[4]-$cpcharpos[3]-1)); 
							$cpinfo['firstname'] = trim(substr($cpholder, 0, $cpcharpos[2]));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[2]+1, $cpcharpos[3]-$cpcharpos[2]-1));
						}
						break;
	//--------------------------------------------------------------------------
					case '6':
					
						if($cpchar[0] == ' ' and $cpchar[1] == ' ' and $cpchar[2] == ',' and $cpchar[3] == ' ' and $cpchar[4] == ' ' and $cpchar[5] == '.'){
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[2]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[2]+1, $cpcharpos[4]-$cpcharpos[2]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[4]+1, $cpcharpos[5]-$cpcharpos[4]-1));
						}
						if($cpchar[0] == ' ' and $cpchar[1] == ' ' and $cpchar[2] == ' ' and $cpchar[3] == '.' and $cpchar[4] == '&' and $cpchar[5] == '.'){
						
							$cpinfo['lastname'] = trim(substr($cpholder, 0, $cpcharpos[0]));
							$cpinfo['firstname'] = trim(substr($cpholder, $cpcharpos[1]+1, $cpcharpos[2]-$cpcharpos[1]-1));
							$cpinfo['middlename'] = trim(substr($cpholder, $cpcharpos[2]+1, $cpcharpos[3]-$cpcharpos[2]-1));
						}
						break;
				}
			}//end partner

			//---------------------------------------------------
			//delete carloan
			if(substr_count($nameholder, 'CAR-LOAN') > 0){
				$nameholder = trim(substr($nameholder, 0,strpos($nameholder, 'CAR-LOAN')));
			}
			//delete ()
			if(substr_count($nameholder, '(') == 1 and 
				substr_count($nameholder, ')') == 0){
				
				$nameholder = trim(substr($nameholder,0,strpos($nameholder, '(')));
			}
			if(substr_count($nameholder, '(') == 1 and 
				substr_count($nameholder, ')') == 1){
				
				$nameholder = trim(substr($nameholder, 0, strpos($nameholder, '(')).substr($nameholder, strpos($nameholder, ')')+1, strlen($nameholder)-strpos($nameholder, ')')-1));
			}
			if(substr_count($nameholder, '(') == 2 and 
				substr_count($nameholder, ')') == 1){
				$nameholder = trim(substr($nameholder, 0, strpos($nameholder, '(')));
			}
			if(substr_count($nameholder, '(') == 2 and 
				substr_count($nameholder, ')') == 2){
				$nameholder = trim(substr($nameholder, 0, strpos($nameholder, '(')));
			}
			//delete XSCC
			if(substr_count($nameholder, '- XSCC') > 0){
				$nameholder = trim(substr($nameholder, 0,strpos($nameholder, '- XSCC')));
			}
			//delete XSCC
			if(substr_count($nameholder, 'XSCC') > 0){
				$nameholder = trim(substr($nameholder, 0,strpos($nameholder, 'XSCC')));
			}
			//delete -Per
			if(substr_count($nameholder, '-Per.') > 0){
				$nameholder = trim(substr($nameholder, 0,strpos($nameholder, '-Per.')));
			}
			//delete -Per
			if(substr_count($nameholder, '-Cluster') > 0){
				$nameholder = trim(substr($nameholder, 0,strpos($nameholder, '-Cluster')));
			}
			//delete -Per
			if(substr_count($nameholder, '-Club') > 0){
				$nameholder = trim(substr($nameholder, 0,strpos($nameholder, '-Club')));
			}
			if(substr_count($nameholder, '/ Club') > 0){
				$nameholder = trim(substr($nameholder, 0,strpos($nameholder, '/ Club')));
			}
			//delete sps.
			if(substr_count(strtolower($nameholder), 'sps.') > 0){
				if(strpos(strtolower($nameholder), 'sps.') == 0){
					$nameholder = trim(substr($nameholder, strpos(strtolower($nameholder), 'sps.')+4,strlen($nameholder)-strpos(strtolower($nameholder), 'sps.')-4));
				} else {
					$nameholder = substr($nameholder, 0, strpos(strtolower($nameholder), 'sps.')).substr($nameholder, strpos(strtolower($nameholder), 'sps.')+4,strlen($nameholder)-strpos(strtolower($nameholder), 'sps.')-4);
				}
			}

			$nameholder = trim($nameholder);
		
			for ($i=0; $i < strlen($nameholder) ; $i++) { 
				if (substr($nameholder, $i,1) == ',' ){
					array_push($char, ',');
					array_push($charpos, $i);
				}
				if (substr($nameholder, $i,1) == '.' ){
					array_push($char, '.');
					array_push($charpos, $i);
				}
				if (substr($nameholder, $i,1) == '/' ){
					array_push($char, '/');
					array_push($charpos, $i);
				}
				if (substr($nameholder, $i,1) == '&' ){
					array_push($char, '&');
					array_push($charpos, $i);
				}
				if (substr($nameholder, $i,1) == ' '){
					if (substr($nameholder, $i-1,1) == ',' or 
						substr($nameholder, $i-1,1) == '.' or 
						substr($nameholder, $i-1,1) == '/' or 
						substr($nameholder, $i-1,1) == '&' or 
						substr($nameholder, $i+1,1) == ',' or 
						substr($nameholder, $i+1,1) == '.' or 
						substr($nameholder, $i+1,1) == '/' or 
						substr($nameholder, $i+1,1) == '&'){

					} else{
						array_push($char, ' ');
						array_push($charpos, $i);
					}			
				} 				
			}// end forloop
 

			switch (sizeof($char)) {
				case '0':
					$info['lastname'] = $nameholder;
					break;
				case '1':
					if($char[0] == ' '){
						$info['lastname'] = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));	
						$info['firstname'] = trim(substr($nameholder, 0, $charpos[0]));
					} else {
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));		
					}
					break;
				case '2':
					if($char[0] == ',' and $char[1] == ' '){
						
						if($charpos[1]+1 == strlen($nameholder)){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));
						}elseif($charpos[1]+2 == strlen($nameholder)){

							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							$info['middlename'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
							
						}else{
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));
						}
					}
					if($char[0] == ',' and $char[1] == ','){	
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '.'){
						if($charpos[1]+1 == strlen($nameholder)){
					
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						}else {
							if(substr(strtolower($nameholder), $charpos[1]-2,2) == 'dr'){
								$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
								$info['prefix'] = 'Dr.';
							} elseif(substr(strtolower($nameholder), $charpos[1]-3,3) == 'dra'){
								$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
								$info['prefix'] = 'Dra.';
								
							} elseif(substr(strtolower($nameholder), $charpos[1]-4,4) == 'atty'){
								$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
								$info['prefix'] = 'Atty.';
								
							} elseif(substr(strtolower($nameholder), $charpos[1]-4,4) == 'engr'){
								$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
								$info['prefix'] = 'Engr.';
								
							} else {
								$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));
							
							}
						}
					}
					if($char[0] == ',' and $char[1] == '&'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						
						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));

					}
					if($char[0] == '/' and $char[1] == '/'){

						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						
						$info2['lastname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

						$info3['lastname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));						

					}
					if($char[0] == ',' and $char[1] == '/'){

						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						
						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));

					}
					if($char[0] == ' ' and $char[1] == ','){
						if (substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1) == 'II') {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
							$info['suffix'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							
						} elseif (substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1) == 'III') {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
							$info['suffix'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						} elseif (substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1) == 'IV') {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
							$info['suffix'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							
						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
							$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
							
						}
						
					}
					if($char[0] == ' ' and $char[1] == '.'){
						if($charpos[1]+1 == strlen($nameholder)){
							$info['lastname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							$info['firstname'] = trim(substr($nameholder, 0, $charpos[0]));
						} else {
							$info['lastname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
							$info['firstname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['middlename'] = trim(substr($nameholder, $charpos[0]+1,$charpos[1]-$charpos[0]-1));
						}
					}
					if($char[0] == ' ' and $char[1] == '&'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1,$charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1,strlen($nameholder)-$charpos[1]-1));
					}
					break;
//--------------------------------------------------------------------------------------
				case '3':
					if($char[0] == ' ' and $char[1]== ' ' and $char[2] == ' '){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[2]));
						$info['firstname'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1)); 
					}
					if($char[0] == ',' and $char[1]== ' ' and $char[2] == ' '){
						if($charpos[2]+2 == strlen($nameholder)){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
							$info['middlename'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
							
						} elseif(substr($nameholder, $charpos[2]+1,3) == 'III') {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
							$info['suffix'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
						} elseif(substr($nameholder, $charpos[2]+1,3) == 'VII'){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
							$info['suffix'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));						
						}
					}
					if($char[0] == ',' and $char[1]== ' ' and $char[2] == '.'){
						if ($charpos[2]+1 == strlen($nameholder)){
							if(substr(strtolower($nameholder), $charpos[2]-2,3) == 'sr.'){
								$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
								$info['suffix'] = "Sr.";
							} elseif(substr(strtolower($nameholder), $charpos[2]-2,3) == 'jr.'){

								$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
								$info['suffix'] = "Jr.";
							} else {
								
								$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
								$info['middlename'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
							}
						} else {
							if($charpos[1]+2 == $charpos[2]){
								
								$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
								$info['suffix'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
								$info['middlename'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
								
							} else {

								$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
								$info['middlename'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
								$info['suffix'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]));
							}
							
						}
					}
					if($char[0] == ',' and $char[1]== ' ' and $char[2] == '/'){
						if($charpos[2]+1 == strlen($nameholder)){
						
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						} else {
						
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
						}
					}
					if($char[0] == ',' and $char[1]== ' ' and $char[2] == '&'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
					}
					if($char[0] == ',' and $char[1]== '.' and $char[2] == '&'){
					
						if(substr($nameholder, $charpos[1]-2,2) == 'Dr'){
							
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
							$info['prefix'] = 'Dr.';

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
						}
					}
					if($char[0] == ',' and $char[1]== ',' and $char[2] == '.'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$info['suffix'] = 'Jr.';
					}
					if($char[0] == ',' and $char[1]== ',' and $char[2] == '&'){
		
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

						$info3['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info3['firstname'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
					}
					if($char[0] == ',' and $char[1]== '.' and $char[2] == ' '){
						if (substr($nameholder, $charpos[1]-2,2)== 'Mr') {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));
						}
					}
					if($char[0] == ',' and $char[1]== '.' and $char[2] == '.'){
						
						if(substr(strtolower($nameholder), $charpos[1]-3,3) == 'dra'){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname']= trim(substr($nameholder, $charpos[1]+1,strlen($nameholder)-$charpos[1]-1));
							$info['prefix'] = 'Dra.';
						} else {
						
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname']= trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							$info['middlename'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						}
					}
					if($char[0] == ',' and $char[1]== '.' and $char[2] == '/'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));						
					}
					if($char[0] == ',' and $char[1]== ' ' and $char[2] == ','){
						if($charpos[2]+2 == strlen($nameholder)){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
							$info['middlename'] = trim(substr($nameholder, $charpos[2]+1,strlen($nameholder)-$charpos[2]-1));
							
						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
							$info['suffix'] = trim(substr($nameholder, $charpos[2]+1,strlen($nameholder)-$charpos[2]-1));
							
						}
					}
					if($char[0] == ',' and $char[1]== '/' and $char[2] == ' '){
						
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
					}
					if($char[0] == ',' and $char[1]== '/' and $char[2] == '/'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

						$info3['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info3['firstname'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
					}
					if($char[0] == ',' and $char[1]== '&' and $char[2] == ' '){
						if(substr($nameholder, $charpos[2]+1,strlen($nameholder)-$charpos[2]-1) == 'Jr'){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
							$info2['suffix'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
							
						} elseif(substr($nameholder, $charpos[2]+1,strlen($nameholder)-$charpos[2]-1) == 'III'){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
							$info2['suffix'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
							
						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
						}
					}
					if($char[0] == ',' and $char[1]== '/' and $char[2] == '.'){
					
						if($charpos[2]+1 == strlen($nameholder)){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1,$charpos[1]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));

						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1,$charpos[1]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1,strlen($nameholder)-$charpos[1]-1));						
						}						
					}
					if($char[0] == ',' and $char[1]== '/' and $char[2] == ','){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1,$charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1,strlen($nameholder)-$charpos[2]-1));
						
					}
					if($char[0] == ',' and $char[1]== '&' and $char[2] == '.'){
					
						if(substr($nameholder, $charpos[2]-2,2)== 'Ma'){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1,$charpos[1]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1,$charpos[1]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						}
					}
					if($char[0] == ',' and $char[1]== '&' and $char[2] == ','){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1,$charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));

					}
					if($char[0] == '.' and $char[1]== ',' and $char[2] == ' '){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
						$info['firstname'] = trim(substr($nameholder, $charpos[1]+1,strlen($nameholder)-$charpos[1]-1));
					}
					if($char[0] == ' ' and $char[1]== ',' and $char[2] == '/'){
						
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
						$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
						
					}
					if($char[0] == ' ' and $char[1]== ',' and $char[2] == '&'){
						
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
						$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
						
					}
					if($char[0] == ' ' and $char[1]== ',' and $char[2] == '.'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
						$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
					}
					if($char[0] == ' ' and $char[1]== ',' and $char[2] == ' '){
						if($charpos[2]+2 == strlen($nameholder)){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
							$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
							$info['middlename'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
							
						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
							$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));

						}
					} 
					if($char[0] == ' ' and $char[1]== ' ' and $char[2] == ','){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[2]));
						$info['firstname'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
					
					}
					if($char[0] == ' ' and $char[1]== ' ' and $char[2] == '.'){ 
						if ($charpos[2]+1 == strlen($nameholder)){
							$info['lastname'] = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));
							$info['firstname'] = trim(substr($nameholder, 0, $charpos[1]));
						} else {
							$info['lastname'] = trim(substr($nameholder, $charpos[2]+1,strlen($nameholder)-$charpos[2]-1));
							$info['firstname'] = trim(substr($nameholder, 0, $charpos[1]));
							$info['middlename'] = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));

						}
					}
					break;
		#------------------------------------------------------------------------------
				case '4':
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == ' '){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));

					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == '.'){
						if($charpos[2]+2 == $charpos[3]){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
							$info['middlename'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));

						} else {
							if(substr(strtolower($nameholder), $charpos[2]+1, 2) == 'jr'){
								$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
								$info['suffix'] = 'Jr.';
							} elseif(substr(strtolower($nameholder), $charpos[2]+1, 2) == 'sr'){
								$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
								$info['suffix'] = 'Sr.';
							} else {
								$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
								$info['middlename'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
								
							}
						}					
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '/'){
					
						if(substr($nameholder, $charpos[2]-2,2)== 'Jr'){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						  $info['suffix'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));			

						  $info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						  $info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, strlen($nameholder)-$charpos[3]-1));
						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						  $info['middlename'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));			

						  $info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						  $info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, strlen($nameholder)-$charpos[3]-1));
						}
						
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '.'){
						if($charpos[1]+2==$charpos[2]){
							if($charpos[2]+2 == $charpos[3]){
								$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[3]-$charpos[0]-1));
							} else {
								$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
								$info['middlename'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
								$info['suffix'] = trim(substr($nameholder, $charpos[2]+1,$charpos[3]-$charpos[2]-1));
							}					
						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
								$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
								$info['suffix'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
								$info['middlename'] = trim(substr($nameholder, $charpos[2]+1,$charpos[3]-$charpos[2]-1));
						}
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '&'){
						
						if(substr($nameholder, $charpos[2]-2,2)=='Jr'){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							$info['suffix'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, strlen($nameholder)-$charpos[3]-1));

						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							$info['middlename'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, strlen($nameholder)-$charpos[3]-1));

						}
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == ' ' and $char[3] == '.'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
						
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '.' and $char[3] == ' '){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[3]+1, strlen($nameholder)-$charpos[3]-1));	
						$info['prefix'] = 'Dr.';
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '.' and $char[3] == '.'){

						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));			
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '&' and $char[3] == '.'){
					
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '/' and $char[3] == '.'){
						
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$info['suffix'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));	

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));		
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == '&'){

						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[3]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1,strlen($nameholder)-$charpos[3]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '&' and $char[3] == ' '){
						
						if(substr($nameholder, $charpos[2]-4,3) == "III"){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							$info['suffix'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1,strlen($nameholder)-$charpos[2]-1));
						} else {
						
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1,strlen($nameholder)-$charpos[2]-1));
						}
						
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '&' and $char[3] == '.'){

						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$info['suffix'] = 'Jr.';

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
					}
					if($char[0] == '.' and $char[1] == ' ' and $char[2] == '&' and $char[3] == '.'){
						
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$info['suffix'] = 'Jr.';

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '&' and $char[3] == ','){
						
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1,strlen($nameholder)-$charpos[3]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == ' ' and $char[3] == ','){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1,strlen($nameholder)-$charpos[3]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == ' ' and $char[3] == '.'){
						if($charpos[2]+2 == $charpos[3]){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));
							$info2['middlename'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));

						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));
							$info2['suffix'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));

						}
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == ',' and $char[3] == ' '){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1,$charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1,strlen($nameholder)-$charpos[2]-1));

					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == '.' and $char[3] == '/'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == ',' and $char[3] == '.'){
						
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1,$charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1,$charpos[3]-$charpos[2]-1));

					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == '/' and $char[3] == ' '){
			
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1,$charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));

						$info3['lastname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
						$info3['firstname'] = trim(substr($nameholder, $charpos[3]+1,strlen($nameholder)-$charpos[3]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == '/' and $char[3] == ','){
					
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1,$charpos[1]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));

							$info3['lastname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
							$info3['firstname'] = trim(substr($nameholder, $charpos[3]+1,strlen($nameholder)-$charpos[3]-1));

					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == '/' and $char[3] == '&'){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1,$charpos[1]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));

							$info3['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info3['firstname'] = trim(substr($nameholder, $charpos[2]+1,$charpos[3]-$charpos[2]-1));

							$info4['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info4['firstname'] = trim(substr($nameholder, $charpos[3]+1,strlen($nameholder)-$charpos[3]-1));
					}
					if($char[0] == ',' and $char[1] == '/' and $char[2] == '/' and $char[3] == '&'){

						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

						$info3['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info3['firstname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));

						$info4['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info4['firstname'] = trim(substr($nameholder, $charpos[3]+1, strlen($nameholder)-$charpos[3]-1));
					}
					if($char[0] == ',' and $char[1] == '/' and $char[2] == '/' and $char[3] == '/'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

						$info3['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info3['firstname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));

						$info4['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info4['firstname'] = trim(substr($nameholder, $charpos[3]+1, strlen($nameholder)-$charpos[3]-1));
					}
					if($char[0] == ',' and $char[1] == '/' and $char[2] == ',' and $char[3] == '.'){
					
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1,$charpos[3]-$charpos[2]-1));
						
					}
					if($char[0] == ',' and $char[1] == '/' and $char[2] == ' ' and $char[3] == '.'){
						
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));
						$info2['middlename'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
					}
					if($char[0] == ' ' and $char[1] == '/' and $char[2] == ' ' and $char[3] == ' '){
						$info['lastname'] = trim(substr($nameholder, $charpos[3]+1,strlen($nameholder)-$charpos[3]-1));
						$info['firstname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['suffix'] = 'Jr';

						$info2['lastname'] = trim(substr($nameholder, $charpos[3]+1,strlen($nameholder)-$charpos[3]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1,$charpos[3]-$charpos[1]-1));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == ' ' and $char[3] == '.'){
						if($charpos[2]+2 == $charpos[3]){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
							$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
							$info['middlename'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
							$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
						}	
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == ' ' and $char[3] == '.'){
					
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
						$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == '&' and $char[3] == '.'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
						$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));

					}
					if($char[0] == ' ' and $char[1] == ' ' and $char[2] == ',' and $char[3] == ' '){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[2]));
						$info['firstname'] = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
					}
					if($char[0] == ' ' and $char[1] == ' ' and $char[2] == ',' and $char[3] == '&'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[2]));
						$info['firstname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[2]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, strlen($nameholder)-$charpos[3]-1));
					}
					if($char[0] == '.' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == '.'){
						
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
						
					}
					break;
//-----------------------------------------------------------------------------------
				case '5':
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == ' ' and $char[4] == '.'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[3]-$charpos[0]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));

					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == '.' and $char[4] == '.'){

						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
						$info['suffix'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '.' and $char[4] == ','){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						$info['suffix'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '&' and $char[4] == ' '){
						if ($charpos[4]+2 == strlen($nameholder)){
							
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							$info['middlename'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
							$info2['middlename'] = trim(substr($nameholder, $charpos[4]+1, strlen($nameholder)-$charpos[4]-1));
						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							$info['middlename'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

							$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, strlen($nameholder)-$charpos[3]-1));
						}
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '&' and $char[4] == ','){
						if($charpos[1]+2 == $charpos[2]){
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							$info['middlename'] = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));

							$info2['lastname'] = trim(substr($nameholder, $charpos[3]+1,$charpos[4]-$charpos[3]-1));
							$info2['firstname'] = trim(substr($nameholder, $charpos[4]+1, strlen($nameholder)-$charpos[4]-1));					
						} else {
							$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							$info['suffix'] = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));

							$info2['lastname'] = trim(substr($nameholder, $charpos[3]+1,$charpos[4]-$charpos[3]-1));
							$info2['firstname'] = trim(substr($nameholder, $charpos[4]+1, strlen($nameholder)-$charpos[4]-1));
						}
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '&' and $char[3] == ',' and $char[4] == ' '){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						
						$info2['lastname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, strlen($nameholder)-$charpos[3]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '&' and $char[3] == ',' and $char[4] == '.'){
		
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						
						$info2['lastname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == ' ' and $char[3] == ' ' and $char[4] == '.'){
						
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						
						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
						$info2['middlename'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == ',' and $char[3] == ' ' and $char[4] == '.'){
						
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						
						$info2['lastname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
						$info2['middlename'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
					}
					if($char[0] == ',' and $char[1] == '/' and $char[2] == ' ' and $char[3] == ',' and $char[4] == '.'){
				
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						
						$info2['lastname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));

					}
					if($char[0] == '.' and $char[1] == ',' and $char[2] == ' ' and $char[3] == ' ' and $char[4] == '.'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
						$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
					}
					if($char[0] == ' ' and $char[1] == '.' and $char[2] == ',' and $char[3] == ' ' and $char[4] == '.'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
						$info['suffix'] = 'Jr.';
					}
					if($char[0] == ' ' and $char[1] == '.' and $char[2] == '&' and $char[3] == ' ' and $char[4] == '.'){
						
						if($charpos[4]+1 == strlen($nameholder)){
			
							$info['lastname'] = trim(substr($nameholder, 0,$charpos[0]));
							$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
							$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
						} else {
							$info['lastname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
							$info['firstname'] = trim(substr($nameholder, 0,$charpos[0]));
							$info['middlename'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

							$info2['lastname'] = trim(substr($nameholder, $charpos[4]+1, strlen($nameholder)-$charpos[4]-1));
							$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
							$info2['middlename'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
						}
					}
					break;
		#---------------------------------------------------
				case '6':
					
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '&' and $char[4] == ',' and $char[5] == ' ' ){
						
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

						$info2['lastname'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[5]+1, strlen($nameholder)-$charpos[5]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '&' and $char[3] == ' ' and $char[4] == ',' and $char[5] == '.' ){
						
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));

						$info2['lastname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[4]-$charpos[2]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[4]+1, $charpos[5]-$charpos[4]-1));
						
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '&' and $char[3] == ',' and $char[4] == ' ' and $char[5] == '.' ){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

						$info2['lastname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
						$info2['middlename'] = trim(substr($nameholder, $charpos[4]+1, $charpos[5]-$charpos[4]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == ' ' and $char[3] == '&' and $char[4] == ',' and $char[5] == ' ' ){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						
						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
						
						$info3['lastname'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
						$info3['firstname'] = trim(substr($nameholder, $charpos[4]+1, strlen($nameholder)-$charpos[4]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == ' ' and $char[3] == ',' and $char[4] == '&' and $char[5] == ',' ){
						
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						
						$info2['lastname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
						
						$info3['lastname'] = trim(substr($nameholder, $charpos[4]+1, $charpos[5]-$charpos[4]-1));
						$info3['firstname'] = trim(substr($nameholder, $charpos[5]+1, strlen($nameholder)-$charpos[5]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '.' and $char[3] == '/' and $char[4] == ',' and $char[5] == '.'){
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						
						$info2['lastname'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[4]+1, $charpos[5]-$charpos[4]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '&' and $char[4] == ' ' and $char[5] == '.'){
				
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

						$info2['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
						$info2['middlename'] = trim(substr($nameholder, $charpos[4]+1, $charpos[5]-$charpos[4]-1));
					}	
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == ' ' and $char[3] == ' ' and $char[4] == ' ' and $char[5] == '.'){
					
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[1]));
						$info['firstname'] = trim(substr($nameholder, $charpos[1]+1, $charpos[4]-$charpos[1]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[4]+1, $charpos[5]-$charpos[4]-1));
					}
					break;
				case '7':
				
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '&' and $char[4] == ' ' and $char[5] == ' ' and $char[6] == '.'){
				
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));

						$info2['lastname']  = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, $charpos[5]-$charpos[3]-1));
						$info2['middlename'] = trim(substr($nameholder, $charpos[5]+1,$charpos[6]-$charpos[5]-1));
					}
					if ($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '&' and $char[4] == ',' and $char[5] == ' ' and $char[6] == '.') {
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));

						$info2['lastname']  = trim(substr($nameholder, $charpos[3]+1,$charpos[4]-$charpos[3]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[4]+1, $charpos[5]-$charpos[4]-1));
						$info2['middlename'] = trim(substr($nameholder, $charpos[5]+1,$charpos[6]-$charpos[5]-1));
					}
					if ($char[0] == ',' and $char[1] == '.' and $char[2] == ',' and $char[3] == '.' and $char[4] == ',' and $char[5] == '&' and $char[6] == '.') {
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[2]+1,$charpos[3]-$charpos[2]-1));

						$info2['lastname']  = trim(substr($nameholder, 0, $charpos[0]));
						$info2['firstname'] = trim(substr($nameholder, $charpos[5]+1, $charpos[6]-$charpos[5]-1));
					}
					break;
				case '8':
					
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '&' and $char[4] == ',' and $char[5] == ' ' and $char[6] == ' ' and $char[7] == '.' ){
						
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$info['middlename'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

						$info2['lastname'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[4]+1, $charpos[6]-$charpos[4]-1));
						$info2['middlename'] = trim(substr($nameholder, $charpos[6]+1, $charpos[7]-$charpos[6]-1));
					} else {
						$info['lastname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['firstname'] = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));						
					}
					break;
				case '9':
						$info['lastname'] = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$info['firstname'] = trim(substr($nameholder, 0, $charpos[0]));
						$info['suffix'] = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));

						$info2['lastname'] = trim(substr($nameholder,$charpos[4]+1, $charpos[5]-$charpos[4]-1));
						$info2['firstname'] = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
						$info2['suffix'] = trim(substr($nameholder, $charpos[5]+1, $charpos[6]-$charpos[5]-1));

						$info3['lastname'] = trim(substr($nameholder, $charpos[8]+1, strlen($nameholder)-$charpos[8]-1));
						$info3['firstname'] = trim(substr($nameholder, $charpos[7]+1, $charpos[8]-$charpos[7]-1));
					break;
			}//end switch

			#ñ ----------------------------------------------------
			/*$info['lastname'] = $this->commonfunctions->checkEnye($info['lastname']); 
			$cpinfo['lastname'] = $this->commonfunctions->checkEnye($cpinfo['lastname']);
			$info2['lastname'] = $this->commonfunctions->checkEnye($info2['lastname']);
			$info3['lastname'] = $this->commonfunctions->checkEnye($info3['lastname']);
			$info4['lastname'] = $this->commonfunctions->checkEnye($info4['lastname']);*/
			
			//-----------------------------------------------------
			
			$info['lastname']   = $this->commonfunctions->formatName($info['lastname']);
			$info['firstname']  = $this->commonfunctions->formatName($info['firstname']);
			$info['middlename'] = $this->commonfunctions->formatName($info['middlename']);

			$cpinfo['lastname']   = $this->commonfunctions->formatName($cpinfo['lastname']);
			$cpinfo['firstname']  = $this->commonfunctions->formatName($cpinfo['firstname']);
			$cpinfo['middlename'] = $this->commonfunctions->formatName($cpinfo['middlename']);

			$info2['lastname']  = $this->commonfunctions->formatName($info2['lastname']);
			$info2['firstname'] = $this->commonfunctions->formatName($info2['firstname']);

			$info3['lastname']  = $this->commonfunctions->formatName($info3['lastname']);
			$info3['firstname'] = $this->commonfunctions->formatName($info3['firstname']);

			$info4['lastname']  = $this->commonfunctions->formatName($info4['lastname']);
			$info4['firstname'] = $this->commonfunctions->formatName($info4['firstname']);
			
			
			//database ---------------------------------------------------------------------
			$this->migrates->updateNames($info, $cpinfo, $info2, $info3, $info4);

			//debugger --------------------------------------------------------------		
			//echo $message."<br />";
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