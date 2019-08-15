<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Load_chartofaccounts extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('peachtree_model');
		$this->load->model('chartofaccounts_model', 'charts');
	}

	public function index()
	{
		set_time_limit(0);
		$records = $this->peachtree_model->getGLConverter();

		foreach ($records as $record) {
			if (!empty($record['subsidiary_code']) or !empty($record['department_code'])) {
				echo "sub: ".$record['subsidiary_code']." dep: ".$record['department_code']."<br/>";
				$info = array(
					'account_id' => $record['account_id'],
					'subsidiary_code' => '',
					'subsidiary_description' => $record['subsidiary_description'],
					'peachtree_code' => $record['peachtree_code'],
					'peachtree_glid' => $record['peachtree_glid'],
					'status_id' => $record['status_id']
				);

				$info2 = array(
					'has_subsidiary' => 1
				);

				if (!empty($record['subsidiary_code'])) {
					$info['subsidiary_code'] = $record['subsidiary_code'];
				} else {
					$info['subsidiary_code'] = $record['department_code'];
				}
							
				$this->charts->insertAccountSubsidiary($info);
				$this->charts->updateAccount($info2, $record['account_id']);
			}
		}
	}//end index

	public function load_gluploading(){
		set_time_limit(0);
		$lc = 0;
		$records = $this->charts->getGluploading();
		$mainclass = 0; 

		foreach ($records as $record) {
			$lc++;
			$info = array(
				'main_class' => $record['MainClass'],
				'sub_class' => $record['SubClass'],
				'gltype' => $record['GLTypenew'],
				'glsubtype' => $record['GLSubtypenew'],
				'projectdepartment' => $record['Project_Department'],
				'subsidiary' => $record['Subsidiary'],
				'glconnector' => $record['GLConnector'],
				'eliminations' => $record['Eliminations'],
				'cashflowclass' => $record['CashflowClass'],
				'cashflowsubclass' => $record['CashflowsubClass'],
				'dr' => $record['DR'],
				'cr' => $record['CR']
			);

			//echo "$lc:".$record['GLAccountNo']." ".$record['MainClass']." ".$record['SubClass']." ".$record['GLTypenew']." ".$record['GLSubtypenew']." ".$record['Project_Department']." ".$record['Subsidiary']." ".$record['GLConnector']." ".$record['Eliminations']." ".$record['CashflowClass']." ".$record['CashflowsubClass']." ".$record['DR']." ".$record['CR']."<br/>";
			echo "$lc";
			$result = $this->charts->findGluploading($record['GLAccountNo']);
			if ($result != false) {
				echo "not false <br/>";
				$this->charts->updateAccount($info, $result['account_id']);
			} else {
				echo "false <br/>";
			}
		}
		//echo "$mainclass";
	}
}//end class