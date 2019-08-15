<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate1_info extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Migrator_model', 'migrates');		
	}

	public function index()
	{
		set_time_limit(0);	
		$records = $this->migrates->getAll();
		$linecounter = 0;
	
		foreach ($records as $record) {
			$linecounter++;
			$customer = array(
			'account' => "",
			'name' => "",
			'code' => "",
			'type' => "",
			'id' => $record->CustID,
			'newid' => "",
			);

			$nameholder = $record->CustName;
			echo "$linecounter: <u>".$customer['id']."  ".$record->CustName."</u><br/>";
			//----------------------------------------------------------------------------
			for ($i=0; $i < strlen($nameholder); $i++) { 
				if(
						substr($nameholder, $i,1) == '*' 
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '[' 
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i-2 );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == 'S' 
					and substr($nameholder, $i+1,1) == 'T'
					and substr($nameholder, $i+2,1) == '/'
					){
					$customer['code'] = 'ST'.substr($nameholder, $i+3,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == 'X' 
					and substr($nameholder, $i+1,1) == 'V'
					and substr($nameholder, $i+2,1) == '/'
					){
					$customer['code'] = 'XV'.substr($nameholder, $i+3,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == 'X' 
					and substr($nameholder, $i+1,1) == 'E'
					and substr($nameholder, $i+2,1) == '/'
					){
					$customer['code'] = 'XE'.substr($nameholder, $i+3,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == 'X' 
					and substr($nameholder, $i+1,1) == 'E'
					and substr($nameholder, $i+2,1) == '-'
					){
					$customer['code'] = substr($nameholder, $i,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == 'W' 
					and substr($nameholder, $i+1,1) == 'H'
					and substr($nameholder, $i+2,1) == '-'
					){
					$customer['code'] = substr($nameholder, $i,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == 'X' 
					and substr($nameholder, $i+1,1) == 'E'
					and substr($nameholder, $i+2,1) == ' '
					and substr($nameholder, $i+3,1) == '/'
					){
					$customer['code'] = 'XE'.substr($nameholder, $i+4,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == 'T' 
					and substr($nameholder, $i+1,1) == 'W'
					and substr($nameholder, $i+2,1) == '/'
					){
					$customer['code'] = 'TW'.substr($nameholder, $i+3,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == 'T' 
					and substr($nameholder, $i+1,1) == 'W'
					and substr($nameholder, $i+2,1) == ' '
					and substr($nameholder, $i+3,1) == '/'
					){
					$customer['code'] = 'TW'.substr($nameholder, $i+4,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == 'C' 
					and substr($nameholder, $i+1,1) == 'R'
					and substr($nameholder, $i+2,1) == 'E'
					and substr($nameholder, $i+3,1) == '/'
					){
					$customer['code'] = 'CRE'.substr($nameholder, $i+4,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == 'M' 
					and substr($nameholder, $i+1,1) == 'V'
					and substr($nameholder, $i+2,1) == 'H'
					and substr($nameholder, $i+3,1) == '/'
					){
					$customer['code'] = 'MVH'.substr($nameholder, $i+4,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == 'M' 
					and substr($nameholder, $i+1,1) == 'V'
					and substr($nameholder, $i+2,1) == 'H'
					and substr($nameholder, $i+3,1) == ' '
					and substr($nameholder, $i+4,1) == '/'
					){
					$customer['code'] = 'MVH'.substr($nameholder, $i+5,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'X'
					and substr($nameholder, $i+2,1) == 'E'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'X'
					and substr($nameholder, $i+2,1) == 'V'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'X'
					and substr($nameholder, $i+2,1) == 'H'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'V'
					and substr($nameholder, $i+2,1) == 'E'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'V'
					and substr($nameholder, $i+2,1) == 'L'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'V'
					and substr($nameholder, $i+2,1) == 'R'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'T'
					and substr($nameholder, $i+2,1) == 'W'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'W'
					and substr($nameholder, $i+2,1) == 'H'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'S'
					and substr($nameholder, $i+2,1) == 'T'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'B'
					and substr($nameholder, $i+2,1) == ':'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'B'
					and substr($nameholder, $i+2,1) == '('
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'B'
					and substr($nameholder, $i+3,1) == '('
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'B'
					and substr($nameholder, $i+2,1) == 'l'
					and substr($nameholder, $i+3,1) == 'k'
					){
					$customer['code'] = "B".substr($nameholder, $i+4,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'P'
					and substr($nameholder, $i+2,1) == '('
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'A'
					and substr($nameholder, $i+2,1) == 'P'
					and substr($nameholder, $i+3,1) == 'R'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'C'
					and substr($nameholder, $i+2,1) == 'R'
					and substr($nameholder, $i+3,1) == 'E'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'M'
					and substr($nameholder, $i+2,1) == 'V'
					and substr($nameholder, $i+3,1) == 'H'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'P'
					and substr($nameholder, $i+2,1) == 'H'
					and substr($nameholder, $i+3,1) == 'E'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'P'
					and substr($nameholder, $i+2,1) == 'T'
					and substr($nameholder, $i+3,1) == 'W'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'T'
					and substr($nameholder, $i+2,1) == 'a'
					and substr($nameholder, $i+3,1) == 'n'
					and substr($nameholder, $i+4,1) == 'a'
					and substr($nameholder, $i+5,1) == 'y'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and intval(substr($nameholder, $i+1,1)) != 0
				
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'P'
					and intval(substr($nameholder, $i+2,1)) != 0
				
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'B'
					and intval(substr($nameholder, $i+2,1)) != 0
				
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'S'
					and substr($nameholder, $i+3,1) == 'T'
					){
					$customer['code'] = substr($nameholder, $i+2,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'T'
					and substr($nameholder, $i+3,1) == 'W'
					){
					$customer['code'] = substr($nameholder, $i+2,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'X'
					and substr($nameholder, $i+3,1) == 'V'
					){
					$customer['code'] = substr($nameholder, $i+2,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'X'
					and substr($nameholder, $i+3,1) == 'E'
					){
					$customer['code'] = substr($nameholder, $i+2,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'X'
					and substr($nameholder, $i+3,1) == 'H'
					){
					$customer['code'] = substr($nameholder, $i+2,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'W'
					and substr($nameholder, $i+3,1) == 'H'
					){
					$customer['code'] = substr($nameholder, $i+2,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'V'
					and substr($nameholder, $i+3,1) == 'E'
					){
					$customer['code'] = substr($nameholder, $i+2,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'V'
					and substr($nameholder, $i+3,1) == 'L'
					){
					$customer['code'] = substr($nameholder, $i+2,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'A'
					and substr($nameholder, $i+3,1) == 'P'
					and substr($nameholder, $i+4,1) == 'R'
					){
					$customer['code'] = substr($nameholder, $i+2,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'M'
					and substr($nameholder, $i+3,1) == 'V'
					and substr($nameholder, $i+4,1) == 'H'
					){
					$customer['code'] = substr($nameholder, $i+2,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'C'
					and substr($nameholder, $i+3,1) == 'R'
					and substr($nameholder, $i+4,1) == 'E'
					){
					$customer['code'] = substr($nameholder, $i+2,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'S'
					and substr($nameholder, $i+3,1) == 't'
					and substr($nameholder, $i+4,1) == '.'
					){
					$customer['code'] = substr($nameholder, $i+2,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'B'
					and substr($nameholder, $i+2,1) == 'L'
					and substr($nameholder, $i+3,1) == 'O'
					and substr($nameholder, $i+4,1) == 'C'
					and substr($nameholder, $i+5,1) == 'K'
					){
					$customer['code'] = "B".substr($nameholder, $i+6,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'B'
					and substr($nameholder, $i+3,1) == 'L'
					and substr($nameholder, $i+4,1) == 'O'
					and substr($nameholder, $i+5,1) == 'C'
					and substr($nameholder, $i+6,1) == 'K'
					){
					$customer['code'] = "B".substr($nameholder, $i+7,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == 'P'
					and substr($nameholder, $i+2,1) == 'H'
					and substr($nameholder, $i+3,1) == 'A'
					and substr($nameholder, $i+4,1) == 'S'
					and substr($nameholder, $i+5,1) == 'E'
					){
					$customer['code'] = "P".substr($nameholder, $i+6,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'P'
					and intval(substr($nameholder, $i+3,1)) != 0
				
					){
					$customer['code'] = substr($nameholder, $i+2,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '/' 
					and substr($nameholder, $i+1,1) == ' '
					and substr($nameholder, $i+2,1) == 'B'
					and intval(substr($nameholder, $i+3,1)) != 0
				
					){
					$customer['code'] = substr($nameholder, $i+2,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '(' 
					and substr($nameholder, $i+1,1) == 'T'
					and substr($nameholder, $i+2,1) == 'W'
					and substr($nameholder, $i+3,1) == ')'
					){
					$customer['code'] = "TW B".substr($nameholder, $i+10,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '(' 
					and substr($nameholder, $i+1,1) == 'S'
					and substr($nameholder, $i+2,1) == 'T'
					and substr($nameholder, $i+3,1) == ')'
					){
					$customer['code'] = "ST B".substr($nameholder, $i+10,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == ' ' 
					and substr($nameholder, $i+1,1) == 'V'
					and substr($nameholder, $i+2,1) == 'L'
					and substr($nameholder, $i+3,1) == ' '
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == ' ' 
					and substr($nameholder, $i+1,1) == 'T'
					and substr($nameholder, $i+2,1) == 'W'
					and substr($nameholder, $i+3,1) == ' '
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == ' ' 
					and substr($nameholder, $i+1,1) == 'X'
					and substr($nameholder, $i+2,1) == 'V'
					and substr($nameholder, $i+3,1) == ' '
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == ' ' 
					and substr($nameholder, $i+1,1) == 'X'
					and substr($nameholder, $i+2,1) == 'E'
					and substr($nameholder, $i+3,1) == ' '
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == ' ' 
					and substr($nameholder, $i+1,1) == 'W'
					and substr($nameholder, $i+2,1) == 'H'
					and substr($nameholder, $i+3,1) == ' '
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == ' ' 
					and substr($nameholder, $i+1,1) == 'M'
					and substr($nameholder, $i+2,1) == 'V'
					and substr($nameholder, $i+3,1) == 'H'
					and substr($nameholder, $i+4,1) == ' '
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == ' ' 
					and substr($nameholder, $i+1,1) == 'A'
					and substr($nameholder, $i+2,1) == 'P'
					and substr($nameholder, $i+3,1) == 'R'
					and substr($nameholder, $i+4,1) == ' '
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == ' ' 
					and substr($nameholder, $i+1,1) == 'B'
					and substr($nameholder, $i+2,1) == 'L'
					and substr($nameholder, $i+3,1) == 'O'
					and substr($nameholder, $i+4,1) == 'C'
					and substr($nameholder, $i+5,1) == 'K'
					){
					$customer['code'] = "B".substr($nameholder, $i+6,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == ' ' 
					and substr($nameholder, $i+1,1) == 'S'
					and substr($nameholder, $i+2,1) == 'T'
					and substr($nameholder, $i+3,1) == ' '
					and substr($nameholder, $i+4,1) == 'B'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == ' ' 
					and substr($nameholder, $i+1,1) == 'C'
					and substr($nameholder, $i+2,1) == 'R'
					and substr($nameholder, $i+3,1) == 'E'
					and substr($nameholder, $i+4,1) == ' '
					and substr($nameholder, $i+5,1) == 'B'
					){
					$customer['code'] = substr($nameholder, $i+1,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == 'T' 
					and substr($nameholder, $i+1,1) == 'W'
					and substr($nameholder, $i+2,1) == 'B'
					){
					$customer['code'] = substr($nameholder, $i,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == 'V' 
					and substr($nameholder, $i+1,1) == 'E'
					and substr($nameholder, $i+2,1) == ' '
					and substr($nameholder, $i+3,1) == 'B'
					){
					$customer['code'] = substr($nameholder, $i,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == 'B' 
					and intval(substr($nameholder, $i+1,1)) != 0
				
					){
					$customer['code'] = substr($nameholder, $i,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == 'P' 
					and intval(substr($nameholder, $i+1,1)) != 0
				
					){
					$customer['code'] = substr($nameholder, $i,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
				if(
						substr($nameholder, $i,1) == '-' 
					and substr($nameholder, $i+1,1) == 'L'
					and intval(substr($nameholder, $i+2,1)) != 0
				
					){
					$customer['code'] = substr($nameholder, $i,strlen($nameholder)-$i );
					$customer['name'] = substr($nameholder, 0, $i);
					break;
				}
							
			}//end forloop

			if($customer['name'] == ""){
				$customer['name'] = $nameholder;
			}

			if(
				substr_count(strtolower($record->CustName),'co.')>0 or
				substr_count(strtolower($record->CustName),'corp.')>0 or 
				substr_count(strtolower($record->CustName),'corporation')>0 or 
				substr_count(strtolower($record->CustName),'inc.')>0 or 
				substr_count(strtolower($record->CustName),'ltd.')>0 or 
				substr_count(strtolower($record->CustName),'company')>0 or 
				substr_count(strtolower($record->CustName),'service')>0 or 
				substr_count(strtolower($record->CustName),'supply')>0 or 
				substr_count(strtolower($record->CustName),'construction')>0 or  
				substr_count(strtolower($record->CustName),'contruction')>0 or
				substr_count(strtolower($record->CustName),'builders')>0 or 
				substr_count(strtolower($record->CustName),'builder')>0 or 
				substr_count(strtolower($record->CustName),'electrical')>0 or 
				substr_count(strtolower($record->CustName),'development')>0 or 
				substr_count(strtolower($record->CustName),'realty')>0 or 
				substr_count(strtolower($record->CustName),'professional')>0 or 
				substr_count(strtolower($record->CustName),'trading')>0 or 
				substr_count(strtolower($record->CustName),'cepalco')>0 or 
				substr_count(strtolower($record->CustName),'corpus christi')>0 or 
				substr_count(strtolower($record->CustName),'steel')>0 or 
				substr_count(strtolower($record->CustName),'golden')>0 or 
				substr_count(strtolower($record->CustName),'seven')>0 or 
				substr_count(strtolower($record->CustName),'works')>0 or 
				substr_count(strtolower($record->CustName),'nmmdc')>0 or 
				substr_count(strtolower($record->CustName),'buildres')>0 or 
				substr_count(strtolower($record->CustName),'wbc')>0 or 
				substr_count(strtolower($record->CustName),'warehse')>0 or 
				substr_count(strtolower($record->CustName),'foundation')>0 or 
				substr_count(strtolower($record->CustName),'argusland')>0 or 
				substr_count(strtolower($record->CustName),'resort')>0 or 
				substr_count(strtolower($record->CustName),'holdings')>0 or 
				substr_count(strtolower($record->CustName),'mining')>0 or 
				substr_count(strtolower($record->CustName),'phils.')>0 or 
				substr_count(strtolower($record->CustName),'fruits')>0 or 
				substr_count(strtolower($record->CustName),'roadside')>0 or 
				substr_count(strtolower($record->CustName),'bank')>0 or 
				substr_count(strtolower($record->CustName),'slers')>0 or 
				substr_count(strtolower($record->CustName),'products')>0 or 
				substr_count(strtolower($record->CustName),'hapit-anay')>0 or 
				substr_count(strtolower($record->CustName),'sb-one')>0 or 
				substr_count(strtolower($record->CustName),'quarry')>0 or 
				substr_count(strtolower($record->CustName),'mdk')>0 or 
				substr_count(strtolower($record->CustName),'motors')>0 or 
				substr_count(strtolower($record->CustName),'coroporation')>0 or 
				substr_count(strtolower($record->CustName),'vcr')>0 or 
				substr_count(strtolower($record->CustName),'memorial')>0 or 
				substr_count(strtolower($record->CustName),'tires')>0 or 
				substr_count(strtolower($record->CustName),'equipment')>0 or 
				substr_count(strtolower($record->CustName),'rubber')>0 or 
				substr_count(strtolower($record->CustName),'devt')>0 or 
				substr_count(strtolower($record->CustName),'paints')>0 or 
				substr_count(strtolower($record->CustName),'ventures')>0 or 
				substr_count(strtolower($record->CustName),'training')>0 or 
				substr_count(strtolower($record->CustName),'a c m d c')>0 or 
				substr_count(strtolower($record->CustName),'estate')>0 or 
				substr_count(strtolower($record->CustName),'nmdb')>0 or 
				substr_count(strtolower($record->CustName),'mcat')>0 or 
				substr_count(strtolower($record->CustName),'copyfax')>0 or 
				substr_count(strtolower($record->CustName),'agricultural')>0 or 
				substr_count(strtolower($record->CustName),'plumbline')>0 or 
				substr_count(strtolower($record->CustName),'sample')>0 or 
				substr_count(strtolower($record->CustName),'others')>0 or 
				substr_count(strtolower($record->CustName),'cdo benrose')>0 or 
				substr_count(strtolower($record->CustName),'g.a.m.')>0 or 
				substr_count(strtolower($record->CustName),'adjustment')>0 or 
				substr_count(strtolower($record->CustName),'c.d.o.')>0 or 
				substr_count(strtolower($record->CustName),'school')>0
			){
				//organization = 2
				$customer['type'] = '2';
			} else {
				//individual = 1
				$customer['type'] = '1';
			}


			// database -------------------------------------------------------------
			$this->migrates->updateInfo($customer);	


			//debugger --------------------------------------------------------------
			
			echo $customer['name']."<br/>";
			echo $customer['code']."<br/>";
			echo $customer['type']."<br/>";
			echo "<br/>";

		}//end foreach
		$this->load->view('home_view');
	}//end index
}//end class