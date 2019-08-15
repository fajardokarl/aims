<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bankfile extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('legacy_model');
	}

	public function index(){
		set_time_limit(0);
		$records = $this->legacy_model->getGlsubsidiary();
		$lc = 0;

		foreach ($records as $record) {
			if ($record['subtype'] == 'BankFile') {
				$lc++;
				echo "$lc: ".$record['subfullname']." <br/>";

				$nh = $record['subfullname'];
				$name = $record['subfullname'];
				for ($i=0; $i < strlen($nh); $i++) { 
					if(
						substr($nh, $i,1) == '(' 
						and is_numeric(substr($nh, $i+2,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						is_numeric(substr($nh, $i,1))  
						and is_numeric(substr($nh, $i+1,1)) 
						and is_numeric(substr($nh, $i+2,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						substr($nh, $i,2) == 'CA' 
						and is_numeric(substr($nh, $i+2,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						substr($nh, $i,2) == 'SA' 
						and is_numeric(substr($nh, $i+2,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						substr($nh, $i,2) == 'LA' 
						and is_numeric(substr($nh, $i+2,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						substr($nh, $i,3) == 'SA#' 
						and is_numeric(substr($nh, $i+3,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						substr($nh, $i,3) == 'CA#' 
						and is_numeric(substr($nh, $i+3,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						substr($nh, $i,3) == 'CA ' 
						and is_numeric(substr($nh, $i+3,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						substr($nh, $i,3) == 'FB#' 
						and is_numeric(substr($nh, $i+3,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						substr($nh, $i,3) == 'DIV' 
						and is_numeric(substr($nh, $i+3,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						substr($nh, $i,1) == '#' 
						and is_numeric(substr($nh, $i+1,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						substr($nh, $i,2) == '# ' 
						and is_numeric(substr($nh, $i+2,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						substr($nh, $i,3) == '$ #' 
						and is_numeric(substr($nh, $i+3,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						substr($nh, $i,6) == '$Acct#' 
						and is_numeric(substr($nh, $i+6,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						substr($nh, $i,7) == '$Acct #' 
						and is_numeric(substr($nh, $i+7,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						substr($nh, $i,4) == 'ACCT' 
						and is_numeric(substr($nh, $i+4,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
					if(
						substr($nh, $i,7) == 'ACCOUNT' 
						and is_numeric(substr($nh, $i+7,1)) 
						){
							$code = substr($nh, $i, strlen($nh)-$i);
							$name = substr($nh, 0, $i);
							echo "$code <br/> $name <br/>";
						break;
					}
				}
				$info = array(
					'bank_name' => $name,
					'account_number' => $code,
					'type' => 1,
					'status_id' => 1 ,
					'legacy_subcode' => $record['subcode']
				);
				$this->legacy_model->insertBank($info);
				echo "$name <br/>";
			}
		}
	}
	
	
}

