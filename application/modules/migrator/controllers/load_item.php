<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Load_item extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('legacy_model');		
		$this->load->model('item_model');
	}

	public function index()
	{
		set_time_limit(0);
		$records = $this->legacy_model->getItem();
		$l = 0;
		

		foreach ($records as $record) {
			# code...
			$l++;
			$message = '';
			echo "$l: ".$record->ItemDescription." ".$record->CategoryCode." ".$record->ItemID."<br/>";

			$info = array(
				'description' => $record->ItemDescription,
				'category_code' => $record->CategoryCode,
				'legacy_itemid' => $record->ItemID,
				'status_id' => '1'
				);

			$item = $this->item_model->findItem($info['description']);
			if ($item == false) {
				# code...
				$this->item_model->insertItem($info);
				$message = $message." Added Item";
			} else {
				$message = $message." Duplicate Item";
			}

			echo "$message <br/><br/>";
		}
	}//end index

	public function load_uomid(){
		set_time_limit(0);
		$records = $this->legacy_model->getItemUOMMaster();
		$l = 0;
		foreach ($records as $record) {
			$l++;
			echo "$l: ".$record['UOMDesc']." id:".$record['UOMID']."<br/>";

			$rec_item = $this->item_model->findItemUOMMaster($record['UOMDesc']);
			$info = array(
				'legacy_uomid' => $record['UOMID']
			);
			$this->item_model->updateItemUOMMaster($info, $rec_item->uom_id);
			echo "<br/>";
		}
	}

	public function load_relationuomwithlegacymeasurable(){
		set_time_limit(0);
		$records = $this->legacy_model->getMeasurableuom();
		$l = 0;
		foreach ($records as $record) {
			$l++;

			$itemid = $this->item_model->findItemByLegacyID($record['ItemId']);
			if ($itemid != false) {
				echo $record['ItemId']."<br/>";
				$uomid = $this->item_model->findItemUOMMasterByLegacyID($record['UOMId_Smallest']);
				$info = array(
					'item_id' => $itemid['item_id'],
					'uom_id' => $uomid['uom_id']
				);
				$this->item_model->insertItemRelationUOM($info);
				echo "<br/>";
			}
		}
	}

	public function load_relationuomwithlegacyrelation(){
		set_time_limit(0);
		$records = $this->legacy_model->getRelationWithItemID();

		foreach ($records as $record) {
			$itemid = $this->item_model->findItemByLegacyID($record['ItemId']);
			if($itemid != false){
				echo $record['UOMId']."<br/>";
				$uomid = $this->item_model->findItemUOMMasterByLegacyID($record['UOMId_Smallest']);
				$info = array(
					'item_id' => $itemid['item_id'],
					'uom_id' => $uomid['uom_id']
				);
				$this->item_model->insertItemRelationUOM($info);
				echo "<br/>"; 
			}
		}
	}
}//end class