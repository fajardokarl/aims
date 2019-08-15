<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gl_customer extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Glcustomer_model', 'Glcustomer');
		$this->load->model('commonfunctions', 'common');
	}

	public function index(){
		$this->data['content'] = 'glinfo_view';
		$this->data['page_title'] = 'Migrator';
		$this->data['records'] = $this->Glcustomer->getWasha();

		$this->load->view('default/index', $this->data);
	}//end index

	public function checkMigrate(){
		set_time_limit(0);
		$lc =0;
		$records = $this->Glcustomer->checkMigrate();
		echo "<table>";
		echo "<thead>";
		echo "<tr><th>customer_name</th><th>type</th><th>supplier_name</th></tr>";
		echo "</thead>";
		echo "<tbody>";
		foreach ($records as $record) {
			$lc++;
			echo "<tr>";
			echo "<td>".$lc." ".$record['customer_name']."</td>";
			echo "<td>".$record['type']."</td>";
			echo "<td>".$record['supplier_name']."</td>";
			echo "</tr>";
		}
		echo "</tbody></table>";
	}

	public function setType(){
		set_time_limit(0);
		$lc = 0;
		$records = $this->Glcustomer->getMigrate();

		foreach ($records as $record) {
			$lc++;
			$nameholder = $record['customer_name'];
			if(substr_count($nameholder, '(') > 0 and substr_count($nameholder, ')') > 0){
				$pos1 = strpos($nameholder, '(');
				$pos2 = strpos($nameholder, ')');

				$nameholder = trim(substr($nameholder, 0, $pos1)).trim(substr($nameholder, $pos2+1, strlen($nameholder)-$pos2-1));
			}

			$info = array(
				'type' => '',
			);

			if($this->common->checkCompany($nameholder) == true ){
				$info['type'] = '2';
			} else {
				$info['type'] = '1';
			}
			if($this->common->deleteType($nameholder) == true){
				$info['type'] = '0';
			}
			echo "$lc: ".str_replace(' ', '#', $nameholder)."   <br/>";
			echo "type: ".$info['type']."<br/>";
			echo "<br/>";
			$this->Glcustomer->updARC($info, $record['customer_id']);
		}
	}

	public function migrateCompany(){
		set_time_limit(0);
		$records = $this->Glcustomer->getNotDoneCompany();
		$lc = 0;

		foreach ($records as $record) {
			$lc++;
			$message = '';
			$code = '';

			$glinfo = array(
				'client_id' => '',
				'peachtree_glid' => ''
			);

			$updinfo = array(
				'client_id' => '',
				'done' => ''
			);

			$nameholder = $record['customer_name'];
			echo "$lc: ".$record['customer_name']."<br/>";
			for ($i=0; $i < strlen($nameholder); $i++) { 
				if ( substr($nameholder, $i, 1) == '/'
						and substr($nameholder, $i+1, 1) == 'B'
						and is_numeric(substr($nameholder, $i+2,1))	) {
					$code = substr($nameholder, $i+1, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if ( substr($nameholder, $i, 1) == 'B'
						and is_numeric(substr($nameholder, $i+1,1))
						and is_numeric(substr($nameholder, $i+2,1))	) {
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
			}

			$result = $this->Glcustomer->findCompanyClient($nameholder);
			if($result != false){
				$glinfo['client_id'] = $result['client_id'];
				$glinfo['peachtree_glid'] = $record['gl_sales_account'];

				$updinfo['client_id'] = $result['client_id'];
				$updinfo['done'] = '1';

			} else {
				$org = $this->Glcustomer->findOrganization($nameholder);
				if($org == false){
					$orginfo = array(
						'organization_name' => $nameholder,
						'customer_old_id' => '',
						'tin' => '',
						'special_instruction' => '',
						'status_id' => '1'
					);
					$orgid = $this->Glcustomer->insOrganization($orginfo);
					$clientinfo = array(
						'client_type_id' => '2',
						'reference_id' => $orgid,
						'date_created' => '',
						'status_id' => '1',
					);
					$clientid = $this->Glcustomer->insClient($clientinfo);
					$glinfo['client_id'] = $clientid;
					$glinfo['peachtree_glid'] = $record['gl_sales_account'];

					$updinfo['client_id'] = $clientid;
					$updinfo['done'] = '1';

				} else {
					$clientinfo = array(
						'client_type_id' => '2',
						'reference_id' => $org['organization_id'],
						'date_created' => '',
						'status_id' => '1',
					);
					$clientid = $this->Glcustomer->insClient($clientinfo);
					$glinfo['client_id'] = $clientid;
					$glinfo['peachtree_glid'] = $record['gl_sales_account'];

					$updinfo['client_id'] = $clientid;
					$updinfo['done'] = '1';

				}
			}
			if($this->Glcustomer->findClientGlinfo($glinfo['client_id']) == false) {
				$this->Glcustomer->insClientGlinfo($glinfo);
				$this->Glcustomer->updARC($updinfo, $record['customer_id']);
					echo "done <br/>";
			}
				echo "$code <br/>";
				echo "<br/>";
		}
	}

	public function migratePerson(){
		set_time_limit(0);
		$records = $this->Glcustomer->getNotDonePerson();
		$lc = 0;

		foreach ($records as $record) {
			$lc++;
			$message = '';
			$lastname = '';
			$firstname = '';
			$middlename = '';
			$suffix = '';
			$code = '';

			$char = [];
			$charpos = [];

			$nameholder = $this->common->eraseDoubleSpace($record['customer_name']);
			if (substr_count($nameholder, '(') > 0 and substr_count($nameholder, ')') > 0) {
				$pos1 = strpos($nameholder, '(');
				$pos2 = strpos($nameholder, ')');
				$nameholder = trim(substr($nameholder, 0, $pos1)).trim(substr($nameholder, $pos2+1, strlen($nameholder)-$pos2-1));
			}

			for ($i=0; $i < strlen($nameholder); $i++) { 
				if ( substr($nameholder, $i, 5) == 'Atty.') {
					$nameholder = trim(substr($nameholder, 0, $i)).trim(substr($nameholder, $i+5,strlen($nameholder)-$i-5));
				}


				if ( substr($nameholder, $i, 1) == 'B'
						and is_numeric(substr($nameholder, $i+1,1))	) {
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if ( is_numeric(substr($nameholder, $i,1))
							) {
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if ( substr($nameholder, $i, 1) == 'P'
						and is_numeric(substr($nameholder, $i+1,1))	) {
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
			}

			for ($i=0; $i < strlen($nameholder); $i++) { 
				if (substr($nameholder, $i,1) == ':') {
					array_push($char, ':');
					array_push($charpos, $i);
				}
				if (substr($nameholder, $i,1) == '(') {
					array_push($char, '(');
					array_push($charpos, $i);
				}
				if (substr($nameholder, $i,1) == '-') {
					array_push($char, '-');
					array_push($charpos, $i);
				}
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
						substr($nameholder, $i-1,1) == '(' or 
						substr($nameholder, $i-1,1) == '-' or 
						substr($nameholder, $i-1,1) == '.' or 
						substr($nameholder, $i-1,1) == '/' or 
						substr($nameholder, $i-1,1) == '&' or 
						substr($nameholder, $i+1,1) == ',' or
						substr($nameholder, $i+1,1) == '(' or 
						substr($nameholder, $i+1,1) == '-' or
						substr($nameholder, $i+1,1) == '.' or 
						substr($nameholder, $i+1,1) == '/' or 
						substr($nameholder, $i+1,1) == '&'){

					} else{
						array_push($char, ' ');
						array_push($charpos, $i);
					}			
				}
			}
			echo "$lc: ".str_replace(' ', '#', $nameholder)."<br/>";

			switch(sizeof($char)) {
				case '1':
					if($char[0] == ' '){
						$lastname = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));
						$firstname = trim(substr($nameholder, 0, $charpos[0]));
					}
					if($char[0] == ','){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));
					}
				break;
				case '2':
					if($char[0] == ',' and $char[1] == ' '){
						if($charpos[1]+2 == strlen($nameholder)){
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							$middlename = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
						} elseif($charpos[1]+3 == strlen($nameholder)) {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							$suffix = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
						} else {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));
						}
					}
					if($char[0] == ',' and $char[1] == '.'){
						if($charpos[1]+1 == strlen($nameholder)){
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						} else {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));
						}
					}
					if($char[0] == ',' and $char[1] == '&'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == '.' and $char[1] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == '/' and $char[1] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ' ' and $char[1] == ','){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
					}
					if($char[0] == ' ' and $char[1] == '.'){
						$lastname = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
						$firstname = trim(substr($nameholder, 0, $charpos[0]));
						$middlename = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
				break;
				case '3':
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' '){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						if ($charpos[2]+2 == strlen($nameholder)) {
							$middlename = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
						}
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.'){
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						if($charpos[1]+2 == $charpos[2]){
							$middlename = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));
						} else {
							$suffix = trim(substr($nameholder, $charpos[1]+1,$charpos[2]-$charpos[1]-1));
 						}
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						if (substr_count($nameholder, 'III') > 0) {
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							$suffix = 'III';
						}
						if (substr_count($nameholder, ' Jr') > 0) {
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
							$suffix = 'Jr';
						}
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == ' '){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$middlename = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '/'){
						if(substr($nameholder, $charpos[1]-2, 2) == 'Ma'){
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						} else {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						}
					}
					if($char[0] == ',' and $char[1] == '-' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == ' '){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '/' and $char[2] == ' '){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '/' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '/' and $char[2] == ':'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$middlename = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
					}
					if($char[0] == '-' and $char[1] == ',' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
					}
					if($char[0] == ' ' and $char[1] == ' ' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						$firstname = trim(substr($nameholder, 0, $charpos[0]));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == ' '){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
					}
				break;
				case '4':
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						$middlename = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						if(trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'Sr'){
							$middlename = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
							$suffix = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						}
						if(trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'Jr'){
							$middlename = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
							$suffix = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						}
						if(trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1)) == 'Jr'){
							$middlename = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
							$suffix = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
						}
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						if(trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'Jr'){
							$suffix = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						} elseif(trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'Sr'){
							$suffix = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						} else {
							$middlename = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						}
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == ' ' and $char[3] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						$middlename = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '.' and $char[3] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						$middlename = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == '.' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '/' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == '-' and $char[1] == ',' and $char[2] == ' ' and $char[3] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						$middlename = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
					}
					if($char[0] == '-' and $char[1] == ',' and $char[2] == ' ' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
					}
					if($char[0] == '-' and $char[1] == ',' and $char[2] == '/' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
					}
					if($char[0] == '/' and $char[1] == ',' and $char[2] == ' ' and $char[3] == '.'){
						$lastname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						$middlename = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == ' ' and $char[3] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						$middlename = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == ' ' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == '.' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == '/' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
					}
				break;
				case '5':
					if($char[0] == ' ' and $char[1] == ' ' and $char[2] == ',' and $char[3] == ' ' and $char[4] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[2]));
						$firstname = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
						$middlename = trim(substr($nameholder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
					}
					if($char[0] == ' ' and $char[1] == ' ' and $char[2] == ',' and $char[3] == ' ' and $char[4] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[2]));
						$firstname = trim(substr($nameholder, $charpos[2]+1, $charpos[4]-$charpos[2]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '.' and $char[4] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ' ' and $char[1] == ' ' and $char[2] == ',' and $char[3] == '&' and $char[4] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[2]));
						$firstname = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
					}	
				break;
			}

			$glinfo = array(
				'client_id' => '',
				'peachtree_glid' => ''
			);

			$updinfo = array(
				'client_id' => '',
				'done' => ''
			);

			$person = $this->Glcustomer->findPersonClient($lastname, $firstname);
			if($person != false){
				$glinfo['client_id'] = $person['client_id'];
				$glinfo['peachtree_glid'] = $record['gl_sales_account'];

				$updinfo['client_id'] = $person['client_id'];
				$updinfo['done'] = '1';

			} else {
				$per = $this->Glcustomer->findPerson($lastname, $firstname);
				if($per == false){
					$perinfo = array(
						'lastname' => $lastname,
						'firstname' => $firstname,
						'middlename' => $middlename,
						'suffix' => $suffix
					);
					$perid = $this->Glcustomer->insPerson($perinfo);
					$cusinfo = array(
						'customer_fullname' => $record['customer_name'],
						'person_id' => $perid,
						'customer_old_id' => '',
						'customer_work_id' => '',
						'special_instruction' => ''
					);
					$this->Glcustomer->insCustomer($cusinfo);
					$clientinfo = array(
						'client_type_id' => '1',
						'reference_id' => $perid,
						'date_created' => '',
						'status_id' => '1'
					);

					$clientid = $this->Glcustomer->insClient($clientinfo);
					$glinfo['client_id'] = $clientid;
					$glinfo['peachtree_glid'] = $record['gl_sales_account'];

					$updinfo['client_id'] = $clientid;
					$updinfo['done'] = '1';
				} else {
					$clientinfo = array(
						'client_type_id' => '1',
						'reference_id' => $per['person_id'],
						'date_created' => '',
						'status_id' => '1'
					);
					if($this->Glcustomer->findCustomer($per['person_id']) == false){
						$cusinfo = array(
						'customer_fullname' => $record['customer_name'],
						'person_id' => $per['person_id'],
						'customer_old_id' => '',
						'customer_work_id' => '',
						'special_instruction' => ''
						);
						$this->Glcustomer->insCustomer($cusinfo);
					}

					$clientid = $this->Glcustomer->insClient($clientinfo);
					$glinfo['client_id'] = $clientid;
					$glinfo['peachtree_glid'] = $record['gl_sales_account'];

					$updinfo['client_id'] = $clientid;
					$updinfo['done'] = '1';
				}
			}
			if($this->Glcustomer->findClientGlinfo($glinfo['client_id']) == false){
				$this->Glcustomer->insClientGlinfo($glinfo);
				$this->Glcustomer->updARC($updinfo, $record['customer_id']);
				echo "done <br/>";
			}
			echo "code: $code <br/>";
			echo "last: $lastname <br/>";
			echo "first: $firstname <br/>";
			echo "middle: $middlename <br/>";
			echo "suffix: $suffix <br/>";
			echo "$message <br/>";
			echo "<br/>";
		}
	}
}
