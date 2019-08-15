<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate5_client extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Migrator_model', 'migrates');
		$this->load->model('client_model');
		
	}

	public function index()
	{
		set_time_limit(0);
		$records = $this->migrates->getAll();
		$linecounter = 0;

		foreach ($records as $record) {
			# code...
			$linecounter++;
			echo "$linecounter: ";
			$info = array(
				'client_id' => '',
				'client_type_id' => $record->type,
				'reference_id' => $record->newid,
				'status_id' => $record->Active
				);

			$client = $this->client_model->findClient($info);
			if ($client == false){
				$this->client_model->insertClient($info);
				echo "Added Client";
			} else {
				echo "Duplicate Client";
			}
			echo "<br/>";
		}

		$this->load->view('home_view');
	}//end index
}//end class