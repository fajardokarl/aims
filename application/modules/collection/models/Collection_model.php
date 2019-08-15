<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Collection_model extends CI_Model {

	public function __construct()
    {
        // call parent constructor
        parent::__construct();

    }
    function get_customers(){
    	$this->db->select('*');
        $this->db->from('client a');
        $this->db->join('customer b', 'a.reference_id = b.customer_id', 'inner');
        $this->db->join('client_type c', 'c.client_type_id = a.client_type_id', 'inner');
        $this->db->join('person d', 'd.person_id = b.person_id', 'inner');
        $this->db->where('a.status_id',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getAllBanks(){
        $this->db->select('*');
        $this->db->from('bank');
        $query = $this->db->get();
        return $query->result_array();
    }
    function getAllLots(){
        $this->db->select('*');
        $this->db->from('lot');
        //$this->db->join('lot b', 'b.lot_id=a.lot_id', 'inner');
        //$this->db->group_by('a.contract_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_or_code($contract_id){
        $this->db->select('or_code');
        $this->db->from('contract a');
        $this->db->join('lot b', 'b.lot_id=a.lot_id', 'inner');
        $this->db->join('project c', 'c.project_id=b.project_id', 'inner');
        $this->db->where('a.contract_id', $contract_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result->or_code;
    }

    function getPaymentTypes(){
        $this->db->select('*');
        $this->db->from('payment_mode');
        $query = $this->db->get();
        return $query->result_array();
    }
    function getPropertiesDropdown($clientid){
    	$this->db->select('*, b.reference_id as custID');
    	$this->db->from('contract a');
    	$this->db->join('client b', 'b.client_id=a.client_id', 'inner');
    	$this->db->join('lot c', 'c.lot_id=a.lot_id', 'inner');
    	// $this->db->join('project d', 'd.project_id=c.project_id', 'inner');
    	// $this->db->join('phase e', 'e.phase_id=c.phase_id', 'inner');
    	// $this->db->join('payment_scheme f', 'f.payment_scheme_id=a.scheme_type_id', 'left');
    	$this->db->join('client g', 'g.client_id=a.client_id', 'inner');
    	$this->db->join('customer h', 'h.customer_id=g.reference_id', 'inner');
    	$this->db->join('person i', 'i.person_id=h.person_id', 'inner');
    	// $this->db->join('amortization j', 'j.contract_id=a.contract_id', 'inner');
        $this->db->join('lot_price k', 'k.lot_id=c.lot_id', 'inner');
        $this->db->join('contract_status l', 'l.contract_status_id=a.contract_status_id', 'left');
        //$this->db->join('payment l','l.contract_id=a.contract_id', 'inner');
    	$this->db->group_by('a.contract_id'); 
    	$this->db->where('a.client_id',$clientid);
    	$query = $this->db->get();
        return $query->result_array();
    }
    function getDiscount($contractid){
        $this->db->select('*');
        $this->db->from('amortization');
        $this->db->where('contract_id',$contractid);
        $this->db->where('line_type',1);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getClientDetailsForPayment($contractid){
    	$this->db->select('*');
    	$this->db->from('contract a');
    	$this->db->join('client b', 'b.client_id=a.client_id', 'inner');
    	$this->db->join('lot c', 'c.lot_id=a.lot_id', 'inner');
    	$this->db->join('project d', 'd.project_id=c.project_id', 'inner');
    	$this->db->join('phase e', 'e.phase_id=c.phase_id', 'inner');
    	$this->db->join('payment_scheme f', 'f.payment_scheme_id=a.scheme_type_id', 'left');
    	$this->db->join('client g', 'g.client_id=a.client_id', 'inner');
    	$this->db->join('customer h', 'h.customer_id=g.reference_id', 'inner');
    	$this->db->join('person i', 'i.person_id=h.person_id', 'inner');
    	$this->db->join('amortization j', 'j.contract_id=a.contract_id', 'inner');
    	$this->db->join('lot_price k', 'k.lot_id=c.lot_id', 'inner');
    	$this->db->join('person_address l', 'l.person_id=h.person_id', 'left');
    	$this->db->join('address m', 'm.address_id=l.address_id', 'left');
    	$this->db->join('address_city n', 'n.address_city_id=m.city_id', 'left');
    	$this->db->join('address_province o', 'o.address_province_id=m.province_id', 'left');
    	$this->db->join('address_country p', 'p.id=m.country_id', 'left');
    	// $this->db->join('amortization q', 'q.contract_id=a.contract_id', 'inner');
        $this->db->join('contract_status r', 'r.contract_status_id=a.contract_status_id', 'left');
    	$this->db->where('a.contract_id',$contractid);
    	$query = $this->db->get();
        return $query->result_array();
    }
    // function getClientDetailsForPayment2($contractid){
    //     $this->db->select('*');
    //     $this->db->from('contract a');
    //     $this->db->join('client b', 'b.client_id=a.client_id', 'inner');
    //     $this->db->join('lot c', 'c.lot_id=a.lot_id', 'inner');
    //     $this->db->join('project d', 'd.project_id=c.project_id', 'inner');
    //     $this->db->join('phase e', 'e.phase_id=c.phase_id', 'inner');
    //     $this->db->join('payment_scheme f', 'f.payment_scheme_id=a.scheme_type_id', 'left');
    //     $this->db->join('client g', 'g.client_id=a.client_id', 'inner');
    //     $this->db->join('customer h', 'h.customer_id=g.reference_id', 'inner');
    //     $this->db->join('person i', 'i.person_id=h.person_id', 'inner');
    //     $this->db->join('amortization j', 'j.contract_id=a.contract_id', 'inner');
    //     $this->db->join('lot_price k', 'k.lot_id=c.lot_id', 'inner');
    //     $this->db->join('person_address l', 'l.person_id=h.person_id', 'left');
    //     $this->db->join('address m', 'm.address_id=l.address_id', 'left');
    //     $this->db->join('address_city n', 'n.address_city_id=m.city_id', 'left');
    //     $this->db->join('address_province o', 'o.address_province_id=m.province_id', 'left');
    //     $this->db->join('address_country p', 'p.id=m.country_id', 'left');
    //     // $this->db->join('amortization q', 'q.contract_id=a.contract_id', 'inner');
    //     $this->db->join('contract_status r', 'r.contract_status_id=a.contract_status_id', 'left');
    //     $this->db->where('a.contract_id',$contractid);
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }
    function getSingleContract($lotid){
        $this->db->select('*, g.reference_id as custID');
        $this->db->from('contract a');
        $this->db->join('lot b', 'b.lot_id=a.lot_id', 'inner');
        $this->db->join('project c', 'c.project_id=b.project_id', 'inner');
        $this->db->join('phase e', 'e.phase_id=b.phase_id', 'inner');
        $this->db->join('lot_price f', 'f.lot_id=b.lot_id', 'inner');
        $this->db->join('client g', 'g.client_id=a.client_id', 'inner');
        $this->db->join('contract_status h', 'h.contract_status_id=a.contract_status_id', 'left');
        $this->db->where('a.lot_id',$lotid);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getAmortizationDetails($contractid){
        $date = date('Y-m-d');

        $this->db->select('*');
        $this->db->from('amortization');
        $this->db->where('contract_id',$contractid);
        $this->db->where('paid_up',0);
        $this->db->where('is_active',1);
        $this->db->where('line_type !=', 1);
        $this->db->where('due_date <',$date);
        $query1 = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('amortization');
        $this->db->where('contract_id',$contractid);
        $this->db->where('paid_up',0);
        $this->db->where('is_active',1);
        $this->db->where('line_type !=', 1);
        $this->db->where('due_date >=',$date);
        $this->db->limit(1);
        $query2 = $this->db->get()->result_array();

        $query = array_merge($query1,$query2);
        return $query;
    }
    function getAmortizationDetails2($contractid){
        $this->db->select('*');
        $this->db->from('amortization');
        $this->db->where('contract_id',$contractid);
        $this->db->where('paid_up',0);
        // $this->db->where('is_active',1);
        $this->db->where('line_type =', 4);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getAmortizationDetails3($contractid){
        $this->db->select('*');
        $this->db->from('amortization a');
        $this->db->join('line_type b', 'b.line_type_id=a.line_type', 'inner');
        $this->db->where('a.contract_id',$contractid);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getAmortizationDetails4($contractid){
        $this->db->select('*');
        $this->db->from('amortization');
        $this->db->where('contract_id',$contractid);
        $this->db->where('paid_up',0);
        $this->db->where('is_active',1);
        $this->db->where('line_type !=', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getAmortizationDetails5($contractid){
        $this->db->select('*');
        $this->db->from('amortization');
        $this->db->where('contract_id',$contractid);
        $this->db->where('paid_up',0);
        // $this->db->where('is_active',1);
        $this->db->where('line_type !=', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getPaymentDetails($contractid){
        $this->db->select('*');
        $this->db->from('payment a');
        $this->db->join('payment_mode b', 'b.payment_mode_id=a.payment_type', 'inner');
        $this->db->where('a.contract_id',$contractid);
        $this->db->where('a.is_cancelled',0);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getMiscDetails($contractid){
        $this->db->select('*');
        $this->db->from('miscelaneous');
        $this->db->where('contract_id',$contractid);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getAmortizationDetailsByNewDate($contractid,$surcharge_date){
        $this->db->select('*');
        $this->db->from('amortization');
        $this->db->where('contract_id',$contractid);
        $this->db->where('paid_up',0);
        $this->db->where('is_active',1);
        $this->db->where('line_type', 4);
        $this->db->where('due_date <=',$surcharge_date);
        // $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getAmortizationDetailsByNewDate2($contractid,$surcharge_date){
        $date = $surcharge_date;

        $this->db->select('*');
        $this->db->from('amortization');
        $this->db->where('contract_id',$contractid);
        $this->db->where('paid_up',0);
        $this->db->where('is_active',1);
        $this->db->where('line_type !=', 1);
        $this->db->where('due_date <',$date);
        $query1 = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('amortization');
        $this->db->where('contract_id',$contractid);
        $this->db->where('paid_up',0);
        $this->db->where('is_active',1);
        $this->db->where('line_type !=', 1);
        $this->db->where('due_date >=',$date);
        $this->db->limit(1);
        $query2 = $this->db->get()->result_array();

        $query = array_merge($query1,$query2);
        return $query;
    }
    function updateAmortizationLine($amortizationid,$interest,$principal,$vat,$surcharge,$ips,$paidup,$pay_date,$ips_accrued,$ips_interest){
        $this->db->trans_start();
        $this->db->set('interest_paid', $interest);
        $this->db->set('principal_paid', $principal);
        $this->db->set('vat_paid', $vat);
        $this->db->set('surcharge_paid', $surcharge);
        $this->db->set('ips_accrued_paid', $ips_accrued);
        $this->db->set('ips_interest_paid', $ips_interest);
        $this->db->set('paid_up', $paidup);
        $this->db->set('pay_date', $pay_date);
        $this->db->where('amortization_id', $amortizationid);  
        $this->db->update('amortization');
        $this->db->trans_complete();
    }
    function updateContractLine($contract_id,$contract_status_id){
        $this->db->trans_start();
        $this->db->set('contract_status_id', $contract_status_id);
        $this->db->where('contract_id', $contract_id);  
        $this->db->update('contract');
        $this->db->trans_complete();
    }
    function insertPayment($data){
        $this->db->trans_start();
        $this->db->insert('payment', $data);
        $lastPaymentID = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastPaymentID;
    }
    function insertPaymentCheck($data){
        $this->db->trans_start();
        $this->db->insert('payment_check', $data);
        $this->db->trans_complete();
    }
    function insertPaymentInterBranch($data){
        $this->db->trans_start();
        $this->db->insert('payment_interbranch', $data);
        $this->db->trans_complete();
    }
    function getPostDatedChecks1($fromDate){
        date_default_timezone_set("Asia/Manila");
        $this->db->select('*, b.bank_name as bankname1, c.bank_name as bankname2');
        $this->db->from('postdated_check a');
        $this->db->join('bank b', 'b.bank_id=a.from_bank_id', 'inner');
        $this->db->join('bank c', 'c.bank_id=a.to_bank_id', 'inner');
        $this->db->join('customer d', 'd.customer_id=a.customer_id', 'inner');
        $this->db->join('person e', 'e.person_id=d.customer_id', 'inner');
        $this->db->where('a.check_date >',$fromDate);
        $this->db->order_by('a.check_date', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function getPostDatedChecks2($fromDate,$toDate){
        date_default_timezone_set("Asia/Manila");
        $this->db->select('*, b.bank_name as bankname1, c.bank_name as bankname2');
        $this->db->from('postdated_check a');
        $this->db->join('bank b', 'b.bank_id=a.from_bank_id', 'inner');
        $this->db->join('bank c', 'c.bank_id=a.to_bank_id', 'inner');
        $this->db->join('customer d', 'd.customer_id=a.customer_id', 'inner');
        $this->db->join('person e', 'e.person_id=d.customer_id', 'inner');
        $this->db->where('a.check_date >=', $fromDate);
        $this->db->where('a.check_date <=', $toDate);
        $this->db->order_by('a.check_date', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function getPostDatedChecks3($customerid){
        date_default_timezone_set("Asia/Manila");
        $fromDate = date('Y-m-d');
        $this->db->select('*, b.bank_name as bankname1, c.bank_name as bankname2');
        $this->db->from('postdated_check a');
        $this->db->join('bank b', 'b.bank_id=a.from_bank_id', 'inner');
        $this->db->join('bank c', 'c.bank_id=a.to_bank_id', 'inner');
        $this->db->join('customer d', 'd.customer_id=a.customer_id', 'left');
        $this->db->join('person e', 'e.person_id=d.person_id', 'left');
        $this->db->where('a.check_date >=', $fromDate);
        $this->db->where('a.customer_id', $customerid);
        $this->db->where('a.is_paid', 0);
        $this->db->order_by('a.check_date', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_this_month_due(){
        date_default_timezone_set("Asia/Manila");
        $month=date("m");
        $year=date("Y");
        $this->db->select('*');
        $this->db->from('contract a');
        $this->db->join('client b', 'b.client_id=a.client_id', 'inner');
        $this->db->join('lot c', 'c.lot_id=a.lot_id', 'inner');
        $this->db->join('project d', 'd.project_id=c.project_id', 'inner');
        $this->db->join('phase e', 'e.phase_id=c.phase_id', 'inner');
        $this->db->join('payment_scheme f', 'f.payment_scheme_id=a.scheme_type_id', 'left');
        $this->db->join('client g', 'g.client_id=a.client_id', 'inner');
        $this->db->join('customer h', 'h.customer_id=g.reference_id', 'inner');
        $this->db->join('person i', 'i.person_id=h.person_id', 'inner');
        $this->db->join('amortization j', 'j.contract_id=a.contract_id', 'inner');
        $this->db->join('lot_price k', 'k.lot_id=c.lot_id', 'inner');
        $this->db->where('j.paid_up',0);
        $this->db->where('j.is_active',1);
        $this->db->where('MONTH(j.due_date)',$month);
        $this->db->where('YEAR(j.due_date)',$year);
        $this->db->order_by('j.due_date', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function getDailySales(){
        $date = date('Y-m-d');
        // $date = '2017-09-21';
        $this->db->select('SUM(amount) AS dailySales', FALSE);
        $this->db->from('payment');
        $this->db->where('pay_date',$date);
        $this->db->where('is_cancelled',0);
        $query = $this->db->get();
        return $query->row();
    }
    function getMonthlySales(){
        $month=date("m");
        $year=date("Y");
        $this->db->select('SUM(amount) AS monthlySales', FALSE);
        $this->db->from('payment');
        $this->db->where('MONTH(pay_date)',$month);
        $this->db->where('YEAR(pay_date)',$year);
        $this->db->where('is_cancelled',0);
        $query = $this->db->get();
        return $query->row();
    }

    function getMonthlyReceivablesAmortization(){
        $month=date("m");
        $year=date("Y");
        $this->db->select('SUM(principal_amount) AS monthlyReceivableAmort', FALSE);
        $this->db->from('amortization');
        $this->db->where('MONTH(due_date)',$month);
        $this->db->where('YEAR(due_date)',$year);
        $this->db->where('paid_up',0);
        $this->db->where('is_active',1);
        $query = $this->db->get();
        return $query->row();
    }
    function getMonthlyReceivablesMiscelaneous(){
        $month=date("m");
        $year=date("Y");
        $this->db->select('SUM(miscelaneous_amount) AS monthlyReceivableMisc', FALSE);
        $this->db->from('miscelaneous');
        $this->db->where('MONTH(due_date)',$month);
        $this->db->where('YEAR(due_date)',$year);
        $this->db->where('paid_up',0);
        $query = $this->db->get();
        return $query->row();
    }
    function getMonthlySales2(){
        $year=date("Y");
        $this->db->select('SUM(amount) AS monthlySales2, MONTH(pay_date) as month', FALSE);
        $this->db->from('payment');
        $this->db->where('YEAR(pay_date)',$year);
        $this->db->where('is_cancelled',0);
        $this->db->group_by(array('YEAR(pay_date)', 'MONTH(pay_date)'));
        $query = $this->db->get();
        return $query->result_array();
    }
    function getAllAmortization(){
        $date = date('Y-m-d');
        $this->db->select('*, b.contract_id as contractID');
        $this->db->from('amortization a');
        $this->db->join('contract b', 'b.contract_id=a.contract_id', 'inner');
        $this->db->join('client c', 'c.client_id=b.client_id', 'inner');
        $this->db->join('customer d', 'd.customer_id=c.reference_id', 'inner');
        $this->db->join('person e', 'e.person_id=d.person_id', 'inner');
        $this->db->join('lot f', 'f.lot_id=b.lot_id', 'inner');
        $this->db->join('lot_price g', 'g.lot_id=f.lot_id', 'inner');
        $this->db->join('project h', 'h.project_id=f.project_id', 'inner');
        $this->db->join('phase i', 'i.phase_id=f.phase_id', 'inner');
        $this->db->join('payment j', 'j.contract_id=b.contract_id', 'left');
        $this->db->where('a.paid_up',0);
        $this->db->where('a.is_active',1);
        $this->db->where('a.line_type', 4);
        $this->db->where('a.due_date <',$date);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getPerson($contractid){
        $this->db->select('*, b.contract_id as contractID');
        $this->db->from('amortization a');
        $this->db->join('contract b', 'b.contract_id=a.contract_id', 'inner');
        $this->db->join('client c', 'c.client_id=b.client_id', 'inner');
        $this->db->join('customer d', 'd.customer_id=c.reference_id', 'inner');
        $this->db->join('person e', 'e.person_id=d.person_id', 'inner');
        $this->db->join('lot f', 'f.lot_id=b.lot_id', 'inner');
        $this->db->join('lot_price g', 'g.lot_id=f.lot_id', 'inner');
        $this->db->join('project h', 'h.project_id=f.project_id', 'inner');
        $this->db->join('phase i', 'i.phase_id=f.phase_id', 'inner');
        $this->db->join('payment j', 'j.contract_id=b.contract_id', 'left');
        $this->db->where('a.contract_id',$contractid);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getProjects(){
        $this->db->select('*');
        $this->db->from('project');
        $this->db->where('status_id',1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCollectionProjection($projectid){
        $year=date("Y");
        $this->db->select('*, b.contract_id as contractID');
        $this->db->from('amortization a');
        $this->db->join('contract b', 'b.contract_id=a.contract_id', 'inner');
        $this->db->join('client c', 'c.client_id=b.client_id', 'inner');
        $this->db->join('customer d', 'd.customer_id=c.reference_id', 'inner');
        $this->db->join('person e', 'e.person_id=d.person_id', 'inner');
        $this->db->join('lot f', 'f.lot_id=b.lot_id', 'inner');
        $this->db->join('lot_price g', 'g.lot_id=f.lot_id', 'inner');
        $this->db->join('project h', 'h.project_id=f.project_id', 'inner');
        $this->db->join('phase i', 'i.phase_id=f.phase_id', 'inner');
        $this->db->join('payment j', 'j.contract_id=b.contract_id', 'left');  
        $this->db->where('a.paid_up',0);
        $this->db->where('a.is_active',1);
        $this->db->where('a.line_type',4);
        $this->db->where('YEAR(a.due_date)',$year);
        $this->db->where('f.project_id',$projectid);
        // $this->db->group_by('b.contract_id'); 
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCollectionProjection2($year,$projectid){
        $this->db->select('*, b.contract_id as contractID');
        $this->db->from('amortization a');
        $this->db->join('contract b', 'b.contract_id=a.contract_id', 'inner');
        $this->db->join('client c', 'c.client_id=b.client_id', 'inner');
        $this->db->join('customer d', 'd.customer_id=c.reference_id', 'inner');
        $this->db->join('person e', 'e.person_id=d.person_id', 'inner');
        $this->db->join('lot f', 'f.lot_id=b.lot_id', 'inner');
        $this->db->join('lot_price g', 'g.lot_id=f.lot_id', 'inner');
        $this->db->join('project h', 'h.project_id=f.project_id', 'inner');
        $this->db->join('phase i', 'i.phase_id=f.phase_id', 'inner');
        $this->db->join('payment j', 'j.contract_id=b.contract_id', 'left');  
        $this->db->where('a.paid_up',0);
        $this->db->where('a.is_active',1);
        $this->db->where('a.line_type',4);
        $this->db->where('YEAR(a.due_date)',$year);
        $this->db->where('f.project_id',$projectid);
        $query = $this->db->get();
        return $query->result_array();
    }

    function deleteOldAmortization($contractid){
        $this->db->where('contract_id', $contractid);
        $this->db->where('paid_up', 0);
        $this->db->where('is_active',1);
        $this->db->where('line_type',4);
        $this->db->delete('amortization'); 
    }

    function updateContractReconstructed($contract_id,$balance_ratio,$balance_term,$balance_interest_rate,$balance_surcharge_rate,$restruction_date,$principal_balance){
        $this->db->trans_start();
        $this->db->set('balance_ratio', $balance_ratio);
        $this->db->set('balance_terms', $balance_term);
        $this->db->set('balance_interest_rate', $balance_interest_rate);
        $this->db->set('balance_surcharge_rate', $balance_surcharge_rate);
        $this->db->set('restructure_date', $restruction_date);
        $this->db->set('restructure_amount', $principal_balance);
        $this->db->where('contract_id', $contract_id);  
        $this->db->update('contract');
        $this->db->trans_complete();

    }

    function saveContractScheme($data){
        $this->db->trans_start();
        $this->db->insert('contract_scheme_history', $data);
        $this->db->trans_complete();
    }

    function getLastReconstructed($contract_id){
        $this->db->select('is_reconstruct');
        $this->db->from('amortization');
        $this->db->where('is_active',1);
        $this->db->where('line_type',4);
        $this->db->where('contract_id', $contract_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    function updateAmortizationReconstructed($contract_id){
        $this->db->trans_start();
        $this->db->set('is_active', 0);
        $this->db->where('contract_id', $contract_id);  
        $this->db->update('amortization');
        $this->db->trans_complete();
    }

    function insertReconstructedAmortization($data){
        $this->db->trans_start();
        $this->db->insert('amortization', $data);
        $this->db->trans_complete();
    }

    function updateAmortizationLine2($amortizationid,$principal,$pay_date){
        $this->db->trans_start();
        $this->db->set('principal_paid', $principal);
        $this->db->set('pay_date', $pay_date);
        $this->db->set('paid_up', 1);
        $this->db->where('amortization_id', $amortizationid);  
        $this->db->update('amortization');
        $this->db->trans_complete();
    }

    function getSinglePayment($datareturn2){
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->where('payment_id',$datareturn2);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getSingleAmortization($amortizationid){
        $this->db->select('*');
        $this->db->from('amortization');
        $this->db->where('amortization_id',$amortizationid);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getLineOrder($amortizationid){
        $this->db->select('line_order');
        $this->db->from('amortization');
        $this->db->where('amortization_id',$amortizationid);
        $query = $this->db->get();
        return $query->row();
    }
    function getCountAmortLeft($lineorder,$contract_id){
        $this->db->select('COUNT(amortization_id) as num');
        $this->db->from('amortization');
        $this->db->where('is_active',1);
        $this->db->where('line_type',4);
        $this->db->where('paid_up',0);
        $this->db->where('line_order >', $lineorder);
        $this->db->where('contract_id',$contract_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getAmortLeft($lineorder,$contract_id){
        $this->db->select('*');
        $this->db->from('amortization');
        $this->db->where('is_active',1);
        $this->db->where('line_type',4);
        $this->db->where('paid_up',0);
        $this->db->where('line_order >', $lineorder);
        $this->db->where('contract_id',$contract_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    function updateAmortizationLine3($amortization_amount,$principal_amount,$amortization_id,$outstanding_balance){
        $this->db->trans_start();
        $this->db->set('amortization_amount', $amortization_amount);
        $this->db->set('principal_amount', $principal_amount);
        $this->db->set('outstanding_balance', $outstanding_balance);
        $this->db->where('amortization_id', $amortization_id);  
        $this->db->update('amortization');
        $this->db->trans_complete();
    }
    function get_accounts(){
        $this->db->select('*');
        $this->db->from('account');
        $query = $this->db->get();
        return $query->result_array();
    }
    function getAccountCodeDescription($account_code){
        $this->db->select('*');
        $this->db->from('account');
        $this->db->where('account_code',$account_code);
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_books(){
        $this->db->select('*');
        $this->db->from('book_registers');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_organizations(){
        $this->db->select('*, a.reference_id as custID');
        $this->db->from('client a');
        $this->db->join('organization b', 'b.organization_id=a.reference_id', 'inner');
        $this->db->where('a.client_type_id',2);
        $this->db->where('a.status_id',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_customers2(){
        $this->db->select('*, a.reference_id as custID');
        $this->db->from('client a');
        $this->db->join('customer b', 'a.reference_id = b.customer_id', 'inner');
        $this->db->join('client_type c', 'c.client_type_id = a.client_type_id', 'inner');
        $this->db->join('person d', 'd.person_id = b.person_id', 'inner');
        $this->db->where('a.client_type_id',1);
        $this->db->where('a.status_id',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_suppliers(){
        $this->db->select('*');
        $this->db->from('supplier a');
        $this->db->join('organization b', 'b.organization_id=a.reference_id', 'inner');
        $this->db->where('a.status_id',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_employees(){
        $this->db->select('*');
        $this->db->from('employee a');
        $this->db->join('person b', 'b.person_id=a.person_id', 'inner');
        $this->db->where('a.status_id',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getBookCodePrefix($bookcode){
        $this->db->select('*');
        $this->db->from('book_registers');
        $this->db->where('book_code',$bookcode);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getCustomerDetails($clientid){
        $this->db->select('*');
        $this->db->from('client a');
        $this->db->join('customer b', 'a.reference_id=b.customer_id', 'inner');
        $this->db->join('person c', 'c.person_id=b.person_id', 'inner');
        $this->db->where('a.client_id',$clientid);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getOrganizationDetails($orgid){
        $this->db->select('*');
        $this->db->from('organization a');
        $this->db->join('client b', 'a.organization_id=b.reference_id', 'inner');
        $this->db->where('a.organization_id',$orgid);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getSupplierDetails($suppid){
        $this->db->select('*');
        $this->db->from('supplier a');
        $this->db->join('organization b', 'b.organization_id=a.reference_id', 'inner');
        $this->db->where('a.supplier_id',$suppid);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getEmployeeDetails($empid){
        $this->db->select('*');
        $this->db->from('employee a');
        $this->db->join('person b', 'b.person_id=a.person_id', 'inner');
        $this->db->where('a.employee_id',$suppid);
        $query = $this->db->get();
        return $query->result_array();
    }  
    function getDailyCollectionPerProject($projectid){
        $date = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('payment a');
        $this->db->join('contract b', 'b.contract_id=a.contract_id', 'inner');
        $this->db->join('lot c', 'c.lot_id=b.lot_id', 'inner');
        $this->db->join('project d', 'd.project_id=c.project_id', 'inner');
        $this->db->join('client e', 'e.client_id=b.client_id', 'inner');
        $this->db->join('customer f', 'f.customer_id=e.client_id', 'inner');
        $this->db->join('person g', 'g.person_id=f.person_id', 'left');
        $this->db->join('payment_mode h', 'h.payment_mode_id=a.pay_reference', 'left');
        $this->db->where('d.project_id',$projectid);
        $this->db->where('a.pay_date',$date);
        $this->db->where('a.is_cancelled',0);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getDailyCollectionPerVatType($vatid){
        $date = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('payment a');
        $this->db->join('contract b', 'b.contract_id=a.contract_id', 'inner');
        $this->db->join('lot c', 'c.lot_id=b.lot_id', 'inner');
        $this->db->join('project d', 'd.project_id=c.project_id', 'inner');
        $this->db->join('client e', 'e.client_id=b.client_id', 'inner');
        $this->db->join('customer f', 'f.customer_id=e.client_id', 'inner');
        $this->db->join('person g', 'g.person_id=f.person_id', 'inner');
        // $this->db->join('payment_mode h', 'h.payment_mode_id=a.pay_reference', 'left');
        $this->db->where('b.is_vatable',$vatid);
        $this->db->where('a.pay_date',$date);
        $this->db->where('a.is_cancelled',0);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getMonthlyCollectionPerProject($projectid){
        $month = date('m');
        $this->db->select('*, j.bank_name as fromBank, k.bank_name as toBank');
        $this->db->from('payment a');
        $this->db->join('contract b', 'b.contract_id=a.contract_id', 'inner');
        $this->db->join('lot c', 'c.lot_id=b.lot_id', 'inner');
        $this->db->join('project d', 'd.project_id=c.project_id', 'inner');
        $this->db->join('client e', 'e.client_id=b.client_id', 'inner');
        $this->db->join('customer f', 'f.customer_id=e.client_id', 'inner');
        $this->db->join('person g', 'g.person_id=f.person_id', 'inner');
        $this->db->join('payment_mode h', 'h.payment_mode_id=a.pay_reference', 'left');
        $this->db->join('payment_check i', 'i.payment_id=a.payment_id', 'left');
        $this->db->join('bank j', 'j.bank_id=i.from_bank_id', 'left');
        $this->db->join('bank k', 'k.bank_id=i.to_bank_id', 'left');
        $this->db->where('d.project_id',$projectid);
        $this->db->where('MONTH(a.pay_date)',$month);
        $this->db->where('a.is_cancelled',0);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getMonthlyCollectionPerVatType($vatid){
        $month = date('m');
        $this->db->select('*, j.bank_id as fromBank, k.bank_id as toBank');
        $this->db->from('payment a');
        $this->db->join('contract b', 'b.contract_id=a.contract_id', 'inner');
        $this->db->join('lot c', 'c.lot_id=b.lot_id', 'inner');
        $this->db->join('project d', 'd.project_id=c.project_id', 'inner');
        $this->db->join('client e', 'e.client_id=b.client_id', 'inner');
        $this->db->join('customer f', 'f.customer_id=e.client_id', 'inner');
        $this->db->join('person g', 'g.person_id=f.person_id', 'inner');
        $this->db->join('payment_mode h', 'h.payment_mode_id=a.pay_reference', 'left');
        $this->db->join('payment_check i', 'i.payment_id=a.payment_id', 'left');
        $this->db->join('bank j', 'j.bank_id=i.from_bank_id', 'left');
        $this->db->join('bank k', 'k.bank_id=i.to_bank_id', 'left');
        $this->db->where('b.is_vatable',$vatid);
        $this->db->where('MONTH(a.pay_date)',$month);
        $this->db->where('a.is_cancelled',0);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getBanks()
    {
        $this->db->select('*');
        $this->db->from('bank a');
        $this->db->join('person b', 'a.person_id=b.person_id', 'left');
        $this->db->join('contact c', 'c.contact_id=a.contact_id', 'left');
        $this->db->join('contact_type d', 'd.contact_type_id=c.contact_type_id', 'left');
        $this->db->join('address e', 'e.address_id=a.address_id', 'left');
        $this->db->join('address_city f', 'f.address_city_id=e.city_id', 'left');
        $this->db->join('address_country g', 'g.id=e.country_id', 'left');
        $this->db->join('address_province h', 'h.address_province_id=e.province_id', 'left');
        $this->db->join('address_type i', 'i.address_type_id=e.address_type_id', 'left');
        $this->db->where('a.status_id',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getAllCity(){
       $this->db->select('*');
       $this->db->from('address_city');
       $query = $this->db->get();
       return $query->result_array();
    }
    function getAddressType(){
       $this->db->select('*');
       $this->db->from('address_type');
       $query = $this->db->get();
       return $query->result_array();
    }
    function getAllCountry(){
       $this->db->select('*');
       $this->db->from('address_country');
       $query = $this->db->get();
       return $query->result_array();
    }
    function getAllProvince(){
       $this->db->select('*');
       $this->db->from('address_province');
       $query = $this->db->get();
       return $query->result_array();
    }
    function insertPersonBank($data)
    {
        $this->db->trans_start();
        $this->db->insert('person', $data);
        $lastPersonID = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastPersonID;
    }
    function insertAddressBankContactPerson($data,$lastPersonID){
        $this->db->trans_start();
        $this->db->insert('address', $data);
        $lastaddressid = $this->db->insert_id();
        $addPersonAddress = array(
                'person_id' => $lastPersonID,
                'address_id' =>  $lastaddressid,
                'status_id' =>  1,
            );
        $this->db->insert('person_address', $addPersonAddress);
        $this->db->trans_complete();
        return $lastaddressid;
    }
    function insertContactsBank($data){
        $this->db->trans_start();
        $this->db->insert('contact', $data);
        $lastContactId = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastContactId;
    }
    function insertAddressBank($data){
        $this->db->trans_start();
        $this->db->insert('address', $data);
        $lastaddressid = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastaddressid;
    }
    function insertBank($data){
        $this->db->trans_start();
        $this->db->insert('bank', $data);
        $this->db->trans_complete();
    }
    function getOneBank($bankid,$addressid){
        $this->db->select('*');
        $this->db->from('bank a');
        $this->db->join('person b', 'a.person_id=b.person_id', 'inner');
        $this->db->join('contact c', 'c.contact_id=a.contact_id', 'inner');
        $this->db->join('contact_type d', 'd.contact_type_id=c.contact_type_id', 'inner');
        $this->db->join('address e', 'e.address_id=a.address_id', 'inner');
        $this->db->join('address_city f', 'f.address_city_id=e.city_id', 'inner');
        $this->db->join('address_country g', 'g.id=e.country_id', 'inner');
        $this->db->join('address_province h', 'h.address_province_id=e.province_id', 'inner');
        $this->db->join('address_type i', 'i.address_type_id=e.address_type_id', 'inner');
        //$this->db->join('address_type k', 'k.address_type_id=e.address_type_id', 'inner');
        $this->db->where('a.status_id', 1);
        $this->db->where('a.bank_id',$bankid);
        $this->db->where('e.address_id',$addressid);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getOneBankPerson($personid){
        $this->db->select('*');
        $this->db->from('person a');
        $this->db->join('contact b', 'b.person_id=a.person_id', 'inner');
        $this->db->join('contact_type c', 'c.contact_type_id=b.contact_type_id', 'inner');
        $this->db->join('person_address d', 'd.person_id=a.person_id', 'inner');
        $this->db->join('address e', 'e.address_id=d.address_id', 'inner');
        $this->db->join('address_city f', 'f.address_city_id=e.city_id', 'inner');
        $this->db->join('address_country g', 'g.id=e.country_id', 'inner');
        $this->db->join('address_province h', 'h.address_province_id=e.province_id', 'inner');
        $this->db->join('address_type i', 'i.address_type_id=e.address_type_id', 'inner');
        $this->db->where('a.person_id',$personid);
        $query = $this->db->get();
        return $query->result_array();
    }
    function updatePersonBank($person,$personID){
        $this->db->trans_start();
        $this->db->where('person_id', $personID);
        $this->db->update('person', $person);
        $this->db->trans_complete();
    }
    function updateAddressBankContactPerson($personAddress,$personAddressID){
        $this->db->trans_start();
        $this->db->where('address_id', $personAddressID);
        $this->db->update('address', $personAddress);
        $this->db->trans_complete();
    }
    function updateContactsBank($contact,$contactID){
        $this->db->trans_start();
        $this->db->where('contact_id', $contactID);
        $this->db->update('contact', $contact);
        $this->db->trans_complete();
    }
    function updateAddressBank($bankAddress,$bankAddressID){
        $this->db->trans_start();
        $this->db->where('address_id', $bankAddressID);
        $this->db->update('address', $bankAddress);
        $this->db->trans_complete();
    }
    function updateBank($bank,$bankID){
        $this->db->trans_start();
        $this->db->where('bank_id', $bankID);
        $this->db->update('bank', $bank);
        $this->db->trans_complete();
    }
    function getCommissions(){
        $this->db->select('*');
        $this->db->from('commission a');
        $this->db->join('commission_type b', 'a.commission_type=b.commission_type', 'inner');
        $this->db->where('a.status_id', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getCommissionsType(){
        $this->db->select('*');
        $this->db->from('commission_type');
        $query = $this->db->get();
        return $query->result_array();
    }
    function insertCommissionScheme($data){
        $this->db->trans_start();
        $this->db->insert('commission', $data);
        $this->db->trans_complete();
    }
    function getOneCommissionScheme($data){
        $this->db->select('*');
        $this->db->from('commission');
        $this->db->where('status_id',1);
        $this->db->where('commission_id',$data);
        $query = $this->db->get();
        return $query->result_array();
    }
    function updateCommission($commission_id,$commission){
        $this->db->trans_start();
        $this->db->where('commission_id', $commission_id);
        $this->db->update('commission', $commission);
        $this->db->trans_complete();
    }
    function getIncentives(){
        $this->db->select('*');
        $this->db->from('incentive a');
        $this->db->join('project b', 'b.project_id=a.project_id', 'inner');
        $this->db->join('payment_scheme c', 'c.payment_scheme_id=a.payment_scheme_id', 'inner');
        $this->db->where('a.status_id',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getPaymentScheme(){
       $this->db->select('*');
       $this->db->from('payment_scheme');
       $this->db->where('status_id',1);
       $query = $this->db->get();
       return $query->result_array();
    }
    function insertIncentiveScheme($data){
        $this->db->trans_start();
        $this->db->insert('incentive', $data);
        $this->db->trans_complete();
    }
    function getOneIncentiveScheme($data){
        $this->db->select('*');
        $this->db->from('incentive');
        $this->db->where('status_id',1);
        $this->db->where('incentive_id',$data);
        $query = $this->db->get();
        return $query->result_array();
    }
    function updateIncentiveScheme($incentiveId, $incentiveScheme){
        $this->db->trans_start();
        $this->db->where('incentive_id', $incentiveId);
        $this->db->update('incentive', $incentiveScheme);
        $this->db->trans_complete();
    }
    function savePostdatedCheck($data){
        $this->db->trans_start();
        $this->db->insert('postdated_check', $data);
        $this->db->trans_complete();
    }
    function insertTransaction($data){
        $this->db->trans_start();
        $this->db->insert('transaction', $data);
        $lastTransactionID = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastTransactionID;
    }
    function insertTransactionDetails($data){
        $this->db->trans_start();
        $this->db->insert('transaction_detail', $data);
        $this->db->trans_complete();
    }
    function getPayments($contractid){
        $this->db->select('*');
        $this->db->from('payment a');
        $this->db->join('payment_mode b', 'b.payment_mode_id=a.pay_reference', 'inner');
        $this->db->where('a.contract_id',$contractid);
        $this->db->where('a.is_cancelled',0);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getTCPandDiscount($contractid){
        $this->db->select('total_contract_price, downpayment_discount');
        $this->db->from('contract');
        $this->db->where('contract_id',$contractid);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getPaidAmounts($amortizationid){
        $this->db->select('SUM(principal) as total_paid');
        $this->db->from('payment');
        $this->db->where('amortization_id <=',$amortizationid);
        $this->db->where('is_cancelled',0);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getThisAmortization($amortizationid){
        $this->db->select('*');
        $this->db->from('amortization');
        $this->db->where('amortization_id',$amortizationid);
        $query = $this->db->get();
        return $query->result_array();
    }
    function cancelPaymentAmortization($amortizationid,$principal_paid,$interest_paid,$surcharge_paid,$ips_interest_paid,$ips_accrued_paid){
        $this->db->trans_start();
        $this->db->set('pay_date', '');
        $this->db->set('principal_paid', $principal_paid);
        $this->db->set('interest_paid', $interest_paid);
        $this->db->set('surcharge_paid', $surcharge_paid);
        $this->db->set('ips_interest_paid', $ips_interest_paid);
        $this->db->set('ips_accrued_paid', $ips_accrued_paid);
        $this->db->set('paid_up', 0);
        $this->db->where('amortization_id', $amortizationid);  
        $this->db->update('amortization');
        $this->db->trans_complete();
    }
    function setPaymentCancelled($paymentid){
        $this->db->trans_start();
        $this->db->set('is_cancelled', 1);
        $this->db->where('payment_id', $paymentid);  
        $this->db->update('payment');
        $this->db->trans_complete();
    }
    function setPaymentCheckCancelled($paymentid){
        $this->db->trans_start();
        $this->db->set('is_cancelled', 1);
        $this->db->where('payment_id', $paymentid);  
        $this->db->update('payment_check');
        $this->db->trans_complete();
    }
    function setPaymentInterBranchCancelled($paymentid){
        $this->db->trans_start();
        $this->db->set('is_cancelled', 1);
        $this->db->where('payment_id', $paymentid);  
        $this->db->update('payment_interbranch');
        $this->db->trans_complete();
    }
    function retrieve_all_project()
    {
         $this->db->select('*');
         $this->db->from('project');
         $query = $this->db->get();
         return $query->result_array();
    }
    function retrieve_project_byid_model($data)
    {
         $this->db->select('*');
         $this->db->from('project a');
         $this->db->join('lot b', 'b.project_id = a.project_id', 'inner');
         $this->db->join('lot_price c', 'c.lot_id = b.lot_id', 'inner');
         $this->db->join('project d', 'd.project_id = b.project_id', 'inner');
         $this->db->join('phase f', 'f.phase_id = b.phase_id', 'inner');
         $this->db->where('a.project_id', $data);
         $query = $this->db->get();
         return $query->result_array();
    }
    function getBrokers(){
        $this->db->select('*');
        $this->db->from('broker a');
        $this->db->join('person b', 'a.person_id = b.person_id','inner');
        $this->db->join('realty c', 'a.realty_id=c.realty_id', 'inner');
        $this->db->join('organization m', 'c.organization_id=m.organization_id', 'left');
         $this->db->join('tax_type k', 'a.vat_type_id=k.tax_type_id', 'left');
        // $this->db->join('organization c', 'a.organization_id=c.organization_id', 'inner');
        // $this->db->join('');
        // $this->db->where('realty_id', $realtyid);
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_realty_model(){
        $this->db->select('*');
        $this->db->from('realty a');
        $this->db->join('organization b', 'a.organization_id = b.organization_id','inner');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_contact_type()
    {
       $this->db->select('*');
       $this->db->from('contact_type');
       $query = $this->db->get();
       return $query->result_array();
    }
    function get_contract_by_broker_model($id){
        $this->db->select('*');
        $this->db->from('contract a');
        $this->db->join('agent b', 'a.agent_id=b.agent_id', 'inner');
        $this->db->join('broker c', 'b.broker_id=c.broker_id', 'inner');
        $this->db->join('lot d', 'a.lot_id=d.lot_id', 'left');
        $this->db->join('client e', 'a.client_id=e.client_id', 'left');
        $this->db->join('customer f', 'e.reference_id=f.customer_id', 'left');
        $this->db->join('person g', 'f.person_id=g.person_id', 'left');
        $this->db->join('organization h', 'e.reference_id=h.organization_id', 'left');
        $this->db->where('b.broker_id',$id);
        // $this->db->order_by('deposit_date', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_customers3()
    {
        $this->db->select('*');
        $this->db->from('client a');
        $this->db->join('organization e', 'a.reference_id = e.organization_id', 'inner');
        $this->db->join('customer b', 'a.reference_id = b.customer_id', 'inner');
        $this->db->join('client_type c', 'c.client_type_id = a.client_type_id', 'left');
        $this->db->join('person d', 'd.person_id = b.person_id', 'left');

        $this->db->where('a.status_id',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getOnePerson($data)
    {
        $this->db->select('*,d.person_id AS new_person_id');
        $this->db->from('person d');
        $this->db->join('customer b', 'd.person_id = b.person_id', 'left');
        $this->db->join('client a', 'a.reference_id = b.customer_id', 'left');
        $this->db->join('client_type c', 'c.client_type_id = a.client_type_id', 'left');
        $this->db->join('customer_work l', 'b.customer_work_id = l.customer_work_id', 'left');
        $this->db->join('organization m', 'l.organization_id = m.organization_id', 'left');
        $this->db->join('contact n', 'd.person_id = n.person_id', 'left');
        $this->db->join('contact_type o', 'n.contact_type_id = o.contact_type_id', 'left');
        $this->db->join('organization p ', 'p.organization_id = a.reference_id', 'left');
        $this->db->where('a.status_id',1);
        $this->db->where('a.client_id',$data);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getCustomerPartner($client_id)
    {
        $this->db->select('*, a.customer_id AS new_customer_id');
        $this->db->from('customer_partner a');
        $this->db->join('customer b', 'b.customer_id = a.customer_id', 'left');
        $this->db->join('client c', 'c.reference_id = b.customer_id', 'inner');
        $this->db->where('client_id',$client_id);
        $query = $this->db->get();
        if($query->num_rows() > 0 ){
            $data = $query->result_array();
            $new_customer_id = $data[0]['new_customer_id'];
            $this->db->select('*');
            $this->db->from('person a');
            $this->db->join('customer_partner b', 'b.person_id = a.person_id', 'left');
            $this->db->join('person_address c', 'a.person_id = c.person_id', 'left');
            $this->db->join('address d', 'c.address_id = d.address_id', 'left');
            $this->db->join('address_city g', 'd.city_id = g.address_city_id', 'left');
            $this->db->join('address_province h', 'd.province_id = h.address_province_id', 'left');
            $this->db->join('address_country i', 'd.country_id = i.id', 'left');
            $this->db->join('address_type k', 'd.address_type_id = k.address_type_id', 'left');
            $this->db->where('customer_id',$new_customer_id);
            $query2 = $this->db->get(); 
            return $query2->result_array();
         }else{
            return false;
         }
          
    }
    function get_contracts($data){
        $this->db->select('*');
        $this->db->from('contract a');
        $this->db->join('client b', 'b.client_id = a.client_id', 'inner');
        $this->db->join('lot c', 'c.lot_id = a.lot_id', 'inner');
        $this->db->where('a.client_id', $data);
        $query = $this->db->get();
        return $query->result_array();
     }
     function get_address_model($data){
        $this->db->select('*,d.person_id AS new_person_id');
        $this->db->from('person d');
        $this->db->join('customer b', 'd.person_id = b.person_id', 'inner');
        $this->db->join('client a', 'a.reference_id = b.customer_id', 'inner');
        $this->db->join('client_type c', 'c.client_type_id = a.client_type_id', 'inner');
        $this->db->join('person_address e', 'd.person_id = e.person_id', 'left');
        $this->db->join('address f', 'e.address_id = f.address_id', 'left');
        $this->db->join('address_city g', 'f.city_id = g.address_city_id', 'left');
        $this->db->join('address_province h', 'f.province_id = h.address_province_id', 'left');
        $this->db->join('address_country i', 'f.country_id = i.id', 'left');
        $this->db->join('address_type k', 'f.address_type_id = k.address_type_id', 'left');
        $this->db->where('a.status_id',1);
        $this->db->where('a.client_id',$data);
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_contracts_model(){ 
         $this->db->select('*');
        $this->db->from('contract a');
        $this->db->join('lot b', 'a.lot_id=b.lot_id', 'inner');
        $this->db->join('lot_price c', 'c.lot_id=b.lot_id', 'inner');
        $this->db->join('project d', 'd.project_id=b.project_id', 'inner');
        $this->db->join('client e', 'e.client_id=a.client_id', 'inner');
        $this->db->join('customer f', 'f.customer_id=e.reference_id', 'inner');
        $this->db->join('person g', 'g.person_id=f.person_id', 'inner');
        $this->db->join('agent h', 'h.agent_id=a.agent_id', 'inner');
        $this->db->join('broker i', 'i.broker_id=h.broker_id', 'left');
        $this->db->join('realty j', 'j.realty_id=i.realty_id', 'left');
        $this->db->join('organization k', 'k.organization_id=j.organization_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_amortization($data){
        $this->db->select('*');
        $this->db->from('amortization a');
        $this->db->join('line_type b', 'a.line_type=b.line_type_id', 'left');
        $this->db->join('contract c', 'a.contract_id=c.contract_id');
        $this->db->where('a.contract_id', $data);
        $query = $this->db->get();
        return $query->result_array();
     }
     function get_miscellaneous_model($id){
        $this->db->select('*');
        $this->db->from('miscelaneous a');
        $this->db->join('contract b', 'a.contract_id=b.contract_id');
        $this->db->where('a.contract_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_contract_model($id){
        $this->db->select('*, a.contract_id AS new_contract_id');
        $this->db->from('contract a');
        $this->db->join('client b', 'a.client_id=b.client_id', 'inner');
        $this->db->join('customer c', 'b.reference_id=c.customer_id', 'left');
        $this->db->join('person d', 'c.person_id=d.person_id', 'left');
        $this->db->join('organization e', 'b.reference_id=e.organization_id', 'left');
        $this->db->join('lot f', 'a.lot_id=f.lot_id', 'left');
        $this->db->join('agent g', 'a.agent_id=g.agent_id', 'left');
        $this->db->join('payment_scheme h', 'a.scheme_type_id=h.payment_scheme_id', 'left');
        $this->db->join('lot_price i', 'a.lot_id=i.lot_id', 'left');
        $this->db->join('contract_status j', 'a.contract_status_id=j.contract_status_id', 'left');
        $this->db->where('a.contract_id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    function paid_amortization_model($id){
        $this->db->select('*');
        $this->db->from('payment a');
        $this->db->where('a.contract_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    function contract_status_model(){
        $this->db->select('*');
        $this->db->from('contract_status');
        $this->db->where('status_id', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_remaining_amortization($contractid){
        $this->db->select('*');
        $this->db->from('amortization');
        $this->db->where('is_active', 1);
        $this->db->where('line_type !=', 1);
        $this->db->where('paid_up', 0);
        $this->db->where('contract_id', $contractid);
        $query = $this->db->get();
        return $query->result_array();
    }
    function update_amortization_sched_diminishing($amortization_id,$amortization_amount,$interest,$principal,$remaining_balance){
        $this->db->trans_start();
        $this->db->set('amortization_amount', $amortization_amount);
        $this->db->set('interest_amount', $interest);
        $this->db->set('principal_amount', $principal);
        $this->db->set('outstanding_balance', $remaining_balance);
        $this->db->where('amortization_id', $amortization_id);  
        $this->db->update('amortization');
        $this->db->trans_complete();
    }
    function updateAmortizationLine4($amortizationid,$principal,$outstanding_balance){
        $this->db->trans_start();
        $this->db->set('principal_paid', $principal);
        $this->db->set('outstanding_balance', $outstanding_balance);
        $this->db->where('amortization_id', $amortizationid);  
        $this->db->update('amortization');
        $this->db->trans_complete();
    }




}

?>
