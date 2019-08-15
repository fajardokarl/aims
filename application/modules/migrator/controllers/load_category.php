<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Load_category extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Migrator_model', 'migrates');		
		$this->load->model('category_model');
	}

	public function index()
	{
		set_time_limit(0);
		$records = $this->migrates->getCategory();
		$linecounter = 0;

		foreach ($records as $record) {
			# code...
			$linecounter++;
			$message = '';
			echo "$linecounter:".$record->categorydesc."<br/>";

			$info = array(
				'category_code' => $record->categorycode,
				'description' => $record->categorydesc,
				'type' => $record->type
				);

			$category = $this->category_model->findCategory($info['category_code']);
			if ($category == false) {
				# code...
				$this->category_model->insertCategory($info);
				$message = $message." Added Category <br/>";
			} else {
				$message = $message." Duplicate Category <br/>";
			}

			echo "$message <br /><br/>";
		}
	}//end function
}//end class