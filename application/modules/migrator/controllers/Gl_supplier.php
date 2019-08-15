<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gl_supplier extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Glsupplier_model', 'Glsupplier');
		$this->load->model('commonfunctions', 'common');
	}

	public function index(){
		$this->data['content'] = 'glinfo_view';
		$this->data['page_title'] = 'Migrator';
		$this->data['records'] = $this->Glsupplier->getSupplierGLInfo();

		$this->load->view('default/index', $this->data);
	}

	public function viewNotDone(){
		$this->data['content'] = 'glinfo_view';
		$this->data['page_title'] = 'Migrator';
		$this->data['records'] = $this->Glsupplier->getNotDone();

		$this->load->view('default/index', $this->data);
	}

	public function viewDone(){
		$this->data['content'] = 'glinfo_view';
		$this->data['page_title'] = 'Migrator';
		$this->data['records'] = $this->Glsupplier->getDone();
		
		$this->load->view('default/index', $this->data);	
	}

	public function checkMigrate(){
		set_time_limit(0);
		$lc =0;
		$records = $this->Glsupplier->checkMigrate();
		echo "<table>";
		echo "<thead>";
		echo "<tr><th>vendor_name</th><th>supplier_name</th></tr>";
		echo "</thead>";
		echo "<tbody>";
		foreach ($records as $record) {
			$lc++;
			echo "<tr>";
			echo "<td>".$lc." ".$record['vendor_name']."</td>";
			echo "<td>".$record['supplier_name']."</td>";
			echo "</tr>";
		}
		echo "</tbody></table>";
	}

	public function setType(){
		set_time_limit(0);
		$records = $this->Glsupplier->getSupplierGLInfo();
		$linecounter = 0;

		foreach ($records as $record) {
			$linecounter++;
			$message = '';

			$info = array(
				'type' => ''
			);
			echo "$linecounter: ".$record['vendor_name']."<br/>";
			if ($this->common->checkCompany($record['vendor_name']) == true ) {
				$info['type'] = '2';
			} else {
				$info['type'] = '1';
			}
			if($this->common->deleteType($record['vendor_name']) == true){
				$info['type'] = '0';
			}
			$this->Glsupplier->updateAPV($info, $record['vendor_id']);
			echo "type: ".$info['type']."<br/>";
			echo $message."<br/>";
		}
	}

	public function migrateCompany(){
		set_time_limit(0);
		$records = $this->Glsupplier->getNotDoneCompany();
		$lc = 0;

		foreach ($records as $record) {
			$lc++;
			$message = '';
			$code = '';

			$glinfo = array(
				'supplier_id' => '',
				'peachtree_glid' => ''
			);

			$updinfo = array(
				'type' => '',
				'supplier_id' => '',
				'done' => ''
			);

			echo "$lc: ".$record['vendor_name']."<br/>";
			$nameholder = $record['vendor_name'];
			for ($i=0; $i < strlen($nameholder); $i++){
				if ( substr($nameholder, $i, 1) == '/'
						and is_numeric(substr($nameholder, $i+1,1))
						and is_numeric(substr($nameholder, $i+2,1))	) {
					$code = substr($nameholder, $i+1, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if ( substr($nameholder, $i, 1) == '/'
						and substr($nameholder, $i+1, 1) == 'B'
						and is_numeric(substr($nameholder, $i+2,1))	) {
					$code = substr($nameholder, $i+1, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if ( substr($nameholder, $i, 1) == '/'
						and substr($nameholder, $i+1, 2) == 'B:'
						and is_numeric(substr($nameholder, $i+3,1))	) {
					$code = substr($nameholder, $i+1, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if ( substr($nameholder, $i, 1) == '/'
						and substr($nameholder, $i+1, 4) == 'VE B'
						and is_numeric(substr($nameholder, $i+5,1))	) {
					$code = substr($nameholder, $i+1, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if ( substr($nameholder, $i, 1) == '/'
						and substr($nameholder, $i+1, 3) == 'XEB'
						and is_numeric(substr($nameholder, $i+4,1))	) {
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
				if ( substr($nameholder, $i, 5) == 'B/L: '
						and is_numeric(substr($nameholder, $i+5,1))
						and is_numeric(substr($nameholder, $i+6,1))	) {
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
			}
			echo "$nameholder <br/>";
			$result = $this->Glsupplier->findSupplierByName($nameholder);
			if ($result != false) {
				$glinfo['supplier_id'] = $result['supplier_id'];
				$glinfo['peachtree_glid'] = $record['expense_account'];

				$updinfo['supplier_id'] = $result['supplier_id'];
				$updinfo['done'] = '1';
				
			} else {
				$org = $this->Glsupplier->findOrganization($nameholder);
				if ($org == false) {
					$orginfo = array(
						'organization_name' => $nameholder,
						'customer_old_id' => '',
						'tin' => '',
						'special_instruction' => '',
						'status_id' => '1'
					);
					$orgid = $this->Glsupplier->insOrganization($orginfo);
					$supplierinfo = array(
						'client_type_id' => '2',
						'reference_id' => $orgid,
						'status_id' => '1'
					);
					$supplierid = $this->Glsupplier->insSupplier($supplierinfo);
					$glinfo['supplier_id'] = $supplierid;
					$glinfo['peachtree_glid'] = $record['expense_account'];

					$updinfo['supplier_id'] = $supplierid;
					$updinfo['done'] = '1';
				} else {
					$supplierinfo = array(
						'client_type_id' => '2',
						'reference_id' => $org['organization_id'],
						'status_id' => '1'
					);
					$supplierid = $this->Glsupplier->insSupplier($supplierinfo);
					$glinfo['supplier_id'] = $supplierid;
					$glinfo['peachtree_glid'] = $record['expense_account'];

					$updinfo['supplier_id'] = $supplierid;
					$updinfo['done'] = '1';
				}
			}
			
			if ($this->Glsupplier->findSupplierGLInfo($glinfo['supplier_id']) == false) {
				$this->Glsupplier->insertSupplierGLInfo($glinfo);
				$this->Glsupplier->updateAPV($updinfo, $record['vendor_id']);
			} 
			echo $message."<br/>";

		}
	}

	/*public function migratePerson(){
		set_time_limit(0);
		$records = $this->Glsupplier->getNotDonePerson();
		$lc = 0;

		foreach ($records as $record) {
			$lc++;
			$lastname = '';
			$firstname = '';
			$code = '';
			$word2 = "";
			$message = '';
			$char = [];
			$charpos = [];

			echo "$lc: ".str_replace(' ', '#', $record['vendor_name'])."<br/>";

			$nameholder = $this->common->eraseDoubleSpace($record['vendor_name']);
			
			for ($i=0; $i < strlen($nameholder); $i++) { 
				//delete sps
				if ( substr($nameholder, $i, 4) == 'SPS ') {
					$nameholder = trim(substr($nameholder, 0, $i)).trim(substr($nameholder, $i+4,strlen($nameholder)-$i-4));
				}
				if ( substr($nameholder, $i, 4) == 'Sps.') {
					$nameholder = trim(substr($nameholder, 0, $i)).trim(substr($nameholder, $i+4,strlen($nameholder)-$i-4));
				}
				if ( substr($nameholder, $i, 5) == 'Atty.') {
					$nameholder = trim(substr($nameholder, 0, $i)).trim(substr($nameholder, $i+5,strlen($nameholder)-$i-5));
				}
				if ( substr($nameholder, $i, 3) == 'Dr.') {
					$nameholder = trim(substr($nameholder, 0, $i)).trim(substr($nameholder, $i+3,strlen($nameholder)-$i-3));
				}
				//
				if ( substr($nameholder, $i, 1) == 'B'
						and is_numeric(substr($nameholder, $i+1,1))	) {
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if ( substr($nameholder, $i, 1) == 'N'
						and is_numeric(substr($nameholder, $i+1,1))	) {
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if ( substr($nameholder, $i, 1) == 'P'
						and is_numeric(substr($nameholder, $i+1,1)) 	) {
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if ( intval(substr($nameholder, $i, 1)) != 0) {
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if ( substr($nameholder, $i, 2) == 'B '
						and is_numeric(substr($nameholder, $i+2,1))	) {
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if ( substr($nameholder, $i, 2) == 'B:'
						and is_numeric(substr($nameholder, $i+2,1))	) {
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if ( substr($nameholder, $i, 4) == 'b/l:' ) {
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 5) == 'B/L: '
					and is_numeric(substr($nameholder, $i+5,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 3) == 'TWB'
					and is_numeric(substr($nameholder, $i+3,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 3) == 'XEP'
					and is_numeric(substr($nameholder, $i+3,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 3) == 'XEB'
					and is_numeric(substr($nameholder, $i+3,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 3) == 'XV/'
					and is_numeric(substr($nameholder, $i+3,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 3) == 'XVB'
					and is_numeric(substr($nameholder, $i+3,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 4) == 'XE B'
					and is_numeric(substr($nameholder, $i+4,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 4) == 'XV/B'
					and is_numeric(substr($nameholder, $i+4,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 4) == 'XE P'
					and is_numeric(substr($nameholder, $i+4,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 4) == 'XH/B'
					and is_numeric(substr($nameholder, $i+4,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 4) == 'VE/B'
					and is_numeric(substr($nameholder, $i+4,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 4) == 'VE B'
					and is_numeric(substr($nameholder, $i+4,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 4) == 'XV B'
					and is_numeric(substr($nameholder, $i+4,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 3) == 'TW/'
					and is_numeric(substr($nameholder, $i+3,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 4) == 'TW/B'
					and is_numeric(substr($nameholder, $i+4,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 4) == 'TW B'
					and is_numeric(substr($nameholder, $i+4,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 4) == 'ST B'
					and is_numeric(substr($nameholder, $i+4,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
				if(
					substr($nameholder, $i, 5) == 'ST. B'
					and is_numeric(substr($nameholder, $i+5,1)) 
				){
					$code = substr($nameholder, $i, strlen($nameholder)-$i);
					$nameholder = substr($nameholder, 0, $i);
					break;
				}
			}


			for ($i=0; $i < strlen($nameholder) ; $i++) { 
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
			
			switch (sizeof($char)) {
				case '1':
					if ($char[0] == ',') {
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));
					}
					if ($char[0] == ' ') {
						$lastname = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));
						$firstname = trim(substr($nameholder, 0, $charpos[0]));
					}
					if ($char[0] == '/') {
						if ($charpos[0]+1 == strlen($nameholder)) {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
						} else {
							$lastname = 'Mimbalawag';
							$firstname = 'Racma';
						}
					}
					if ($char[0] == '.'){
						$lastname = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));
						$firstname = trim(substr($nameholder, 0, $charpos[0]));
					}
				break;
				case '2':
					if ($char[0] == ',' and $char[1] == ' ') {
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));
					}
					if ($char[0] == ',' and $char[1] == '.') {
						if ($charpos[1]+1 == strlen($nameholder)) {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						} else {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, strlen($nameholder)-$charpos[0]-1));
						}
					}
					if ($char[0] == ',' and $char[1] == ',') {
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if ($char[0] == ',' and $char[1] == '-') {
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if ($char[0] == ',' and $char[1] == '&') {
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));						
					}
					if ($char[0] == ',' and $char[1] == '/') {
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));						
					}
					if ($char[0] == ',' and $char[1] == '(') {
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if ($char[0] == '.' and $char[1] == '/') {
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if ($char[0] == '-' and $char[1] == ',') {
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
					}
					if ($char[0] == ' ' and $char[1] == ',') {
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
					}
					if ($char[0] == ' ' and $char[1] == '-') {
						$lastname = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
						$firstname = trim(substr($nameholder, 0, $charpos[0])); 
					}
					if ($char[0] == ' ' and $char[1] == '.') {
						$lastname = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
						$firstname = trim(substr($nameholder, 0, $charpos[0]));
					}
					if ($char[0] == ' ' and $char[1] == '/') {
						$lastname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						$firstname = trim(substr($nameholder, 0, $charpos[0]));
					}
					if ($char[0] == ' ' and $char[1] == ' ') {
						if ($charpos[1]+1 == strlen($nameholder)) {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						} else {
							$lastname = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
							$firstname = trim(substr($nameholder, 0, $charpos[1]));
						}
					}
				break;
				case '3':
					if($char[0] == ' ' and $char[1] == ' ' and $char[2] == ' ') {
						$lastname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						$firstname = trim(substr($nameholder, 0, $charpos[1]));
					}
					if($char[0] == ' ' and $char[1] == ' ' and $char[2] == '.'){
						if ($charpos[2]+1 == strlen($nameholder)) {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						} else {
							$lastname = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
							$firstname = trim(substr($nameholder, 0, $charpos[1]));
						}
					}
					if($char[0] == ' ' and $char[1] == ' ' and $char[2] == ','){
						$lastname = trim(substr($nameholder, 0, $charpos[2]));
						$firstname = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
					}
					if($char[0] == ' ' and $char[1] == ' ' and $char[2] == '-'){
						$lastname = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
						$firstname = trim(substr($nameholder, 0, $charpos[1]));
					}
					if($char[0] == ' ' and $char[1] == ' ' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						$firstname = trim(substr($nameholder, 0, $charpos[0]));
					}
					if ($char[0] == ' ' and $char[1] == '.' and $char[2] == '-') {
						if ($charpos[2]+2 == strlen($nameholder)) {
							$lastname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
							$firstname = trim(substr($nameholder, 0, $charpos[0]));
						} else {
							$lastname = trim(substr($nameholder, $charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
							$firstname = trim(substr($nameholder, 0, $charpos[0]));
						}
					}
					if ($char[0] == ' ' and $char[1] == ',' and $char[2] == ' ') {
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder,$charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
					}
					if ($char[0] == ' ' and $char[1] == ',' and $char[2] == '.') {
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder,$charpos[1]+1, strlen($nameholder)-$charpos[1]-1));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ') {
						if (substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1) == 'Del') {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						} else {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						}
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '-'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '/'){
						if (strtolower(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'jr' or strtolower(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'sr') {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						} else {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						}
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '('){
						if ($charpos[1]+3 == $charpos[2]) {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						} else {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						}
					}
					if($char[0] == ',' and $char[1] == '-' and $char[2] == ' '){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '-' and $char[2] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '-' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ',' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == ' '){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == ','){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == ' '){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '('){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '/'){
						if ($charpos[1]+1 == $charpos[2]) {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
						} else {
							$lastname = trim(substr($nameholder, 0, $charpos[0]));
							$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
						}
					}
					if($char[0] == ',' and $char[1] == '(' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '/' and $char[2] == ' '){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '/' and $char[2] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '/' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == '.' and $char[1] == ' ' and $char[2] == '.'){
						$lastname = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
						$firstname = trim(substr($nameholder, 0, $charpos[1]));
					}
					if($char[0] == '-' and $char[1] == ' ' and $char[2] == '.'){
						$lastname = trim(substr($nameholder, $charpos[2]+1, strlen($nameholder)-$charpos[2]-1));
						$firstname = trim(substr($nameholder, 0,$charpos[1]));
					}
					if($char[0] == '-' and $char[1] == ',' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
					}
					if($char[0] == '-' and $char[1] == ',' and $char[2] == '('){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
					}
					if($char[0] == '/' and $char[1] == '/' and $char[2] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
					}
				break;
				case '4':
					if($char[0] == ' ' and $char[1] == ' ' and $char[2] == ',' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[2]));
						$firstname = trim(substr($nameholder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
					}
					if($char[0] == ' ' and $char[1] == '.' and $char[2] == ' ' and $char[3] == '.'){
						$lastname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						$firstname = trim(substr($nameholder, 0, $charpos[0]));
					}
					if($char[0] == ' ' and $char[1] == '.' and $char[2] == ',' and $char[3] == '.'){
						$lastname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
						$firstname = trim(substr($nameholder, 0, $charpos[0]));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == ' ' and $char[3] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == ' ' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == '.' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == '-' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == '/' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == ' '){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ':' and $char[3] == ' '){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '('){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '&' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '/' and $char[3] == ' '){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '/' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ',' and $char[2] == '.' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == ' ' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == ' ' and $char[3] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '.' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '/' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '/' and $char[3] == '('){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '-' and $char[2] == '/' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == ' ' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == '.' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == ',' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '&' and $char[2] == '&' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '/' and $char[2] == ' ' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '/' and $char[2] == ',' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '/' and $char[2] == '.' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '(' and $char[2] == ' ' and $char[3] == '-'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == '.' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '('){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == '-' and $char[1] == ',' and $char[2] == ' ' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
					}
					if($char[0] == '-' and $char[1] == ',' and $char[2] == '-' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
					}
					if($char[0] == '/' and $char[1] == '&' and $char[2] == ',' and $char[3] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
				break;
				case '5':
					if($char[0] == ' ' and $char[1] == ' ' and $char[2] == ',' and $char[3] == ' ' and $char[4] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[2]));
						$firstname = trim(substr($nameholder, $charpos[2]+1, $charpos[4]-$charpos[2]-1));
					}
					if($char[0] == ' ' and $char[1] == ',' and $char[2] == ' ' and $char[3] == '.' and $char[4] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == ',' and $char[4] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == '.' and $char[4] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == ' ' and $char[3] == '.' and $char[4] == '('){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '(' and $char[4] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '.' and $char[4] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == ' ' and $char[2] == '.' and $char[3] == '/' and $char[4] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '(' and $char[2] == ' ' and $char[3] == '.' and $char[4] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '-' and $char[3] == ',' and $char[4] == '.'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '/' and $char[3] == ',' and $char[4] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == ',' and $char[1] == '.' and $char[2] == ' ' and $char[3] == '.' and $char[4] == '('){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
					}
					if($char[0] == '-' and $char[1] == ',' and $char[2] == ' ' and $char[3] == '.' and $char[4] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[1]));
						$firstname = trim(substr($nameholder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
					}
					if($char[0] == ',' and $char[1] == '/' and $char[2] == ' ' and $char[3] == ',' and $char[4] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
				break;
				case '6':
					if($char[0] == ',' and $char[1] == '.' and $char[2] == '/' and $char[3] == ',' and $char[4] == '.' and $char[5] == '/'){
						$lastname = trim(substr($nameholder, 0, $charpos[0]));
						$firstname = trim(substr($nameholder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
					}
				break;
			}

			$glinfo = array(
				'supplier_id' => '',
				'peachtree_glid' => ''
			);

			$updinfo = array(
				'type' => '',
				'supplier_id' => '',
				'done' => ''
			);

			$person = $this->Glsupplier->findPersonSupplierByName($lastname, $firstname);
			if ($person == false) {
				$message = $message. "nothing found";
			} else {
				$message = $message. "supplier found";
				$glinfo['supplier_id'] = $person['supplier_id'];
				$glinfo['peachtree_glid'] = $record['expense_account'];

				$updinfo['type'] = $person['client_type_id'];
				$updinfo['supplier_id'] = $person['supplier_id'];
				$updinfo['done'] = '1';

				$resultglinfo = $this->Glsupplier->findSupplierGLInfo($person['supplier_id']);
				if ($resultglinfo == false) {
					$this->Glsupplier->insertSupplierGLInfo($glinfo);
				} else {
					echo "found: ".$resultglinfo['peachtree_glid']." ur id=".$record['expense_account']."<br/>";
				}
				
				$this->Glsupplier->updateAPV($updinfo, $record['vendor_id']);
			}			
			//echo "code: $code <br/>";
			//echo "lastname: $lastname <br/>";
			//echo "firstname: $firstname <br/>";
			//echo "$message <br/>";
			echo "<br/>";
		}//end foreach
	}*/
}