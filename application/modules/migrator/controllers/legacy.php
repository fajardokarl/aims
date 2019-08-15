<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Legacy extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('legacy_model','legacy');
	}

	public function index(){

	}
	
	public function migrate_employee(){
		set_time_limit(0);
		$records = $this->legacy->getProject();
		$lc = 0;

		foreach ($records as $record) {
			//echo $record['supplier_id'].' '.$record['lastname'].', '.$record['firstname'].' '.$record['middlename'].' '.$record['suffix']."<br/>";
			//echo $record['supplier_id'].' '.str_replace(' ', '#', $record['organization_name'])."<br/>";
			echo $record['project_id'].' '.$record['project_name']."<br/>";
			
			//$res = $this->legacy->findGlsubsidiary(trim($record['lastname']),trim($record['firstname']));
			$res = $this->legacy->findGlsubsidiary(trim($record['project_name']));
			if (!empty($res[0]['subfullname'])) {
				echo $res[0]['subfullname'];
				$info = [
					'subsidiary_code' => $res[0]['subcode']
				];
				//$this->legacy->updateSubcode($info, $record['supplier_id']);
			}
			echo "<br/>";
		}
	}
/*
	public function migrate_lotcost(){
		set_time_limit(0);
		$records = $this->legacy->getLegacyLotCost();
		$lc = 0;
		foreach ($records as $record) {
			$lc++;
			$info = array(
				'project_id' => $record['projectid'],
				'legacy_projectid' => $record['projectid'],
				'legacy_phaseid' => $record['phaseid'],
				'cost_month' => substr($record['costyear'], 0,2),
				'cost_year' => substr($record['costyear'], 2,4),
				'lot_cost' => $record['costlot'],
				'devt_cost' => $record['costdev']
			);
			$this->legacy->insertLotCost($info);
			//echo "$lc: "+$record['costid']+"<br/>";
		}
	}

	public function update_lotcost(){
		set_time_limit(0);
		$records = $this->legacy->getLotCost();
		foreach ($records as $record) {
			$leg_phase = $this->legacy->findLegacyPhase($record['legacy_phaseid']);
			$phase = $this->legacy->findPhaseByName($leg_phase['phasetitle']);
			$info = array(
				'phase_id' => $phase['phase_id']
			);
			$this->legacy->updateLotCost($info, $record['lot_cost_id']);
		}
	}*/

/*	public function migrate_checkvoucher(){
		set_time_limit(0);
		$records = $this->legacy->getCheckVoucher();
		$lc = 0;
		foreach ($records as $record) {
			$lc++;
			$info = array(
				'check_amount' => $record['checkamount'],
				'check_voucher_date' => $record['cvdate'],
				'check_date' => $record['checkdate'],
				'is_issued' => $record['issued'],
				'legacy_cvnumber' => $record['cvnumber'],
				'legacy_bankcode' => $record['bankcode'],
				'legacy_payeecode' => $record['payeecode'],
				'legacy_encoder' => $record['encoder'],
				'legacy_transdate' => $record['transdate']
			);
			$this->legacy->insertCheckVoucher($info);
			echo $lc."<br/>";;
		}
	}*/
}