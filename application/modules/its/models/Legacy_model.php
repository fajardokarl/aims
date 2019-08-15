<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Legacy_model extends CI_Model{
	

	public function insertAddress($info){
		$this->db->insert('address', $info);
		return $this->db->insert_id();
	}

	public function insertClient($info){
		$this->db->insert('client', $info);
	}

	public function insertContact($info){
		$this->db->insert('contact', $info);
		return $this->db->insert_id();
	}


	public function insertCustomer($info){
		$this->db->insert('customer', $info);
		return $this->db->insert_id();
	}

	public function insertCustomerAccount($info){
		$this->db->insert('customer_account', $info);
		return $this->db->insert_id();
	}

	public function insertCustomerWork($info){
		$this->db->insert('customer_work', $info);
		return $this->db->insert_id();
	}


	public function insertOrganization($info){
		$this->db->insert('organization', $info);
		return $this->db->insert_id();
	}

	public function insertOrganizationAccount($info){
		$this->db->insert('organization_account', $info);
		return $this->db->insert_id();
	}

	public function insertOrganizationAddress($info){
		$this->db->insert('organization_address', $info);
	}

	public function insertOrganizationContact($info){
		$this->db->insert('organization_contact', $info);
	}



	public function insertPerson($info){
		$this->db->insert('person', $info);
		return $this->db->insert_id();
	}

	public function insertPersonAddress($info){
		$this->db->insert('person_address', $info);
	}


	public function insertSupplier($info){
		$this->db->insert('supplier', $info);
	}


	public function findCity($city){
		$query = $this->db->where('city_name', $city)
			->get('address_city');
		if ($query->num_rows() == 1) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findClient($clienttype, $referenceid){
		$query = $this->db->where(array('client_type_id' => $clienttype, 'reference_id' => $referenceid))
			->get('client');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findClientByLegacyCustID($legacycustid){
		$query = $this->db->where('legacy_custid', $legacycustid)
			->get('client');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}


	public function findContact($personid){
		$query = $this->db->where('person_id', $personid)
			->get('contact');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}


	public function findCustomer($personid){
		$query = $this->db->where('person_id', $personid)
			->get('customer');
		if ($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findCustomerAccount($personid, $account){
		$query = $this->db->where(array('person_id' => $personid, 'account' => $account))
			->get('customer_account');
		if ($query->num_rows() > 0){
			return $query->row_array();
		} else {
			return false;
		}
	}


	public function findOrganization($name){
		$query = $this->db->where('organization_name', $name)
			->get('organization');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findOrganizationAccount($organizationid, $account){
		$query = $this->db->where(array('organization_id' => $organizationid, 
																		'account' => $account))
			->get('organization_account');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findOrganizationAddress($organizationid){
		$query = $this->db->where('organization_id', $organizationid)
			->get('organization_address');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findOrganizationContact($organizationid){
		$query = $this->db->where('organization_id', $organizationid)
			->get('organization_contact');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findOrganizationContactValue($organizationid, $contactvalue){
		$query = $this->db->select('*')
			->from('organization_contact')
			->join('contact','contact.contact_id = organization_contact.contact_id')
			->where(array('organization_contact.organization_id' => $organizationid,
										'contact.contact_value' => $contactvalue))
			->get();
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findPerson($last, $first){
		$query = $this->db->where(array('lastname' => $last, 
																		'firstname' => $first))
			->get('person');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findPersonAddress($personid){
		$query = $this->db->where('person_id', $personid)
			->get('person_address');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findPersonContactValue($personid, $contactvalue){
		$query = $this->db->select('*')
			->from('contact')
			->where(array('person_id' => $personid, 'contact_value' => $contactvalue))
			->get();
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findProvince($province){
		$query = $this->db->where('province_name', $province)
			->get('address_province');
		if ($query->num_rows() == 1) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function findSupplier($typeid, $referenceid){
		$query = $this->db->where(array('client_type_id'  => $typeid,
																		'reference_id' => $referenceid))
			->get('supplier');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function getCivilStatusID($civilstatus){
		$query = $this->db->where('civil_status_name', $civilstatus)
			->get('civil_status');
		if ($query->num_rows() > 0){
			return $query->row('civil_status_id');
		} else {
			return 0;
		}
	}


	public function getLegacyResCust(){
		$legacydb = $this->load->database('migrate', true);
		return $legacydb->select('*')->get('AbrownNew.dbo.ResCust')->result_array();
	}

	public function getLegacySupplier(){
		$legacydb = $this->load->database('migrate', true);
		return $legacydb->select('*')
			->from('AbrownNew.dbo.GlSubsidiary')
			->where('SubType', 'Supplier')
			->get()->result_array();
	}

	public function getREMSDBAccumulatedDepreciation(){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select gltransactions.glacctno, gltransactions.glactivitycode, glactivity.activitydesc, glaccountmaster.glacctdesc, concat(gltransactions.glbookprefix, gltransactions.glrefnum) as glreference, gltransactions.gltrndate, gltransactions.glbookprefix, gltransactions.gldebit, gltransactions.glcredit, glaccountmaster.recordnum, concat(glbooktransaction.booksubsidiary, '-', glbooktransaction.booktransremarks) as glremarks, glbooktransaction.booksubsidiary 
			from gltransactions 
			inner join glaccountmaster on glaccountmaster.glacctno = gltransactions.glacctno 
			left outer join glactivity on glactivity.activitycode = gltransactions.glactivitycode 
			inner join glbooktransaction on concat(glbooktransaction.bookprefix, glbooktransaction.bookdocno) = concat(gltransactions.glbookprefix, gltransactions.glrefnum)
			where (gltransactions.branch = 12) and (gltransactions.glrefnum = '2013695')  ");
	}

	public function getREMSDBAgingReceivables(){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select resamortization.contract_id, rescust.custname, rescontract.lotid, rescategory.cattitle, resphase.phasetitle, resamortization.line_desc, resamortization.amortization_date, resamortization.pay_date, resamortization.amortization_amount, resamortization.principal, resamortization.outstanding_balance, resamortization.principal_pay, resamortization.principal - resamortization.principal_pay as unpaidamort 
			from resamortization 
			left outer join rescontract on rescontract.contractid = resamortization.contract_id 
			left outer join rescust on rescust.custid = rescontract.custid 
			left outer join tbllot on tbllot.lotid = rescontract.lotid 
			left outer join rescategory on rescategory.catid = tbllot.enterpriseid 
			left outer join resphase on resphase.phaseid = tbllot.phaseid 
			order by rescategory.cattitle, rescust.custname ");
	}

	public function getREMSDBBankRecon($start, $end){
		$resmdb = $this->load->database('remsdb', true);
		return $remsdb->query("select gltransactions.gltrndate, concat(gltransactions.glbookprefix, gltransactions.glrefnum) as reference, m_payablecheck.checknumber, glbooktransaction.booksubsidiary as payee, gltransactions.gldebit, gltransactions.glcredit, gltransactions.glremarks, gltransactions.glacctno, glsubsidiary.subfullname, m_payablecheck.checkdate 
			from gltransactions 
			left outer join glsubsidiary on glsubsidiary.subcode = gltransactions.glsubcode 
			left outer join m_payablecheck on m_payablecheck.reference = concat(ltrim(gltransactions.glbookprefix), ltrim(gltransactions.glrefnum)) 
			left outer join glbooktransaction on concat(glbooktransaction.bookprefix, glbooktransaction.bookdocno) = m_payablecheck.reference 
			where (gltransactions.glacctno = '10030') and (gltransactions.branch = 12) and (gltransactions.gltrndate >= '".$start."') and (gltransactions.gltrndate <= '".$end."') and (gltransactions.glsubcode = 'UBP-1') 
			order by gltrndate, concat(ltrim(gltransactions.glbookprefix), gltransactions.glrefnum)");
	}

	public function getREMSDBBreakdownCollectedSales(){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select concat(gltransactions.glbookprefix, gltransactions.glrefnum) as reference, rescollection.ornumber, gltransactions.glyear, gltransactions.gltrndate, gltransactions.glacctno, glaccountmaster.glacctdesc, gltransactions.gldebit, gltransactions.glcredit, gltransactions.glremarks, gltransactions.branch, rescontract.taxtype, rescollection.contractid 
			from gltransactions
			left outer join rescollection on rescollection.ornumber = concat(gltransactions.glbookprefix, gltransactions.glrefnum) 
			left outer join rescontract on rescontract.contractid = rescollection.contractid 
			left outer join glaccountmaster on glaccountmaster.glacctno = gltransactions.glacctno 
			where (gltransactions.branch = 12) and (gltransactions.glyear = '2015') and (gltransactions.glacctno = '30000') or (gltransactions.branch = 12) and (gltransactions.glyear = '2015') and (gltransactions.glacctno = '30010') 
			order by gltransactions.glacctno ");
	}

	public function getREMSDBCheckVoucher($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select gltransactions.gltrndate, concat(gltransactions.glbookprefix, gltransactions.glrefnum) as reference, m_payablecheck.checknumber, m_payablecheck.amount, glbooktransaction.booksubsidiary as payee, gltransactions.glremarks, gltransactions.glacctno, glsubsidiary.subfullname, m_payablecheck.checkdate 
			from gltransactions 
			left outer join glsubsidiary on glsubsidiary.subcode = gltransactions.glsubcode 
			left outer join m_payablecheck on m_payablecheck.reference = concat(ltrim(gltransactions.glbookprefix), gltransactions.glrefnum) 
			left outer join glbooktransaction on concat(glbooktransaction.bookprefix, glbooktransaction.bookdocno) = m_payablecheck.reference 
			where (gltransactions.branch = 12) and (gltransactions.gltrndate >= '".$start."') and (gltransactions.gltrndate <= '".$end."') and (gltransactions.glbookprefix = 'CV#') 
			order by gltrndate, ltrim(gltransactions.glacctno), concat(ltrim(gltransactions.glbookprefix), gltransactions.glrefnum) ");
	}

	public function getREMSDBCIP($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select gltransactions.glacctno, concat(gltransactions.glbookprefix,gltransactions.glrefnum) as reference, gltransactions.gltrndate as trndate, gltransactions.glactivitycode, glactivity.activitytype, glactivity.activitydesc, gltransactions.glsubcode, glsubsidiary.subfullname, gltransactions.gldebit, gltransactions.glcredit, gltransactions.glremarks, glbooktransaction.booksubsidiary 
			from gltransactions 
			left outer join glsubsidiary on glsubsidiary.subcode = gltransactions.glsubcode
			left outer join glactivity on ltrim(glactivity.activitycode) = ltrim(gltransactions.glactivitycode)
			left outer join glbooktransaction on concat(ltrim(glbooktransaction.bookprefix),ltrim(glbooktransaction.bookdocno)) = concat(ltrim(gltransactions.glbookprefix),gltransactions.GlRefNum)
			left outer join m_payablecheck on m_payablecheck.reference = concat(ltrim(gltransactions.glbookprefix), gltransactions.glrefnum) 
			where (gltransactions.branch = 12) and (gltransactions.glacctno = '16000') and (gltransactions.gltrndate >= '".$start."') and (gltransactions.gltrndate <= '".$end."')
			order by gltransactions.glactivitycode, trndate, concat(ltrim(gltransactions.glbookprefix),gltransactions.glrefnum)");
	}

	public function getREMSDBCollectionEntry($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select gltransactions.glbookprefix, gltransactions.glrefnum, gltransactions.gltrndate, gltransactions.glactivitycode, gltransactions.glacctno, glaccountmaster.glacctdesc, gltransactions.glsubcode, gltransactions.gldebit, gltransactions.glcredit, gltransactions.glremarks, gltransactions.glentryby
			from gltransactions
			left outer join glaccountmaster on glaccountmaster.glacctno = gltransactions.glacctno 
			where (gltransactions.glbookprefix = 'ORW#') and (gltransactions.branch = 12) and (gltransactions.gltrndate between '".$start."' and '".$end."') 
			order by gltransactions.glrefnum ");
	}

	public function getREMSDBCostFactor(){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select rescategory.cattitle, resphase.phasetitle, tbllotcost.costyear, tbllotcost.costlot, tbllotcost.costdev, tbllotcost.costid, tbllotcost.projectid, tbllotcost.phaseid  
			from tbllotcost 
			left outer join resphase on resphase.phaseid = tbllotcost.phaseid 
			left outer join rescategory on rescategory.catid = tbllotcost.projectid 
			order by rescategory.cattitle, resphase.phasetitle, tbllotcost.costyear ");
	}

	public function getREMSDBCustomerPaymentLedger(){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select respayments.paymentid, rescontract.custid, rescontract.lotid, tbllot.lotdesc, tbllot.lotarea, tbllot.areacost, tbllot.tcp, tbllot.withhouse, rescust.custname, respayments.paydate, respayments.refnum, respayments.amount, respayments.interest, respayments.principal, respayments.surcharge, respayments.vatamnt, respayments.newbal, respayments.sundry, respayments.ips, respayments.accrdips, respayments.ipsnewbal, respayments.shares, respayments.contractid, respayments.principal/1.12 as principalpay, respayments.principal/1.12*.12 as vatonprin, respayments.interest/1.12 as intpay, respayments.interest/1.12 * .12 as vatonint, respayments.surcharge/1.12 as surpay, respayments.surcharge/1.12*.12 as vatonsur, respayments.sundry/1.12 as sundrypay, respayments.sundry/1.12*.12 as vatonsundry, respayments.ips/1.12 as ipspay, respayments.ips/1.12*.12 as vatonips, respayments.accrdips*.12 as accrdipspay, respayments.accrdips*.12*.12 as vatonaccrdipspay 
			from respayments 
			left outer join rescontract on rescontract.contractid = respayments.contractid 
			left outer join rescust on rescust.custid = rescontract.custid 
			left outer join tbllot on tbllot.lotid = rescontract.lotid 
			where (respayments.contractid = '23982')
			order by respayments.paydate  ");
	}

	public function getREMSDBDepartmentExpenses($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select glactivity.activitydesc, gltransactions.glactivitycode, gltransactions.glacctno, glaccountmaster.glacctdesc, concat(gltransactions.glbookprefix,gltransactions.glrefnum) as glreference, gltransactions.gltrndate, gltransactions.gldebit, gltransactions.glcredit, concat(glbooktransaction.booksubsidiary, '-' , glbooktransaction.booktransremarks) as glremarks
			from gltransactions 
			inner join glaccountmaster on glaccountmaster.glacctno = gltransactions.glacctno 
			left outer join glactivity on glactivity.activitycode = gltransactions.glactivitycode
			inner join glbooktransaction on concat(glbooktransaction.bookprefix,glbooktransaction.bookdocno) = concat(gltransactions.glbookprefix, gltransactions.glrefnum) 
			where (gltransactions.branch = 12) and (gltransactions.gltrndate between '".$start."' and '".$end."') and (glbooktransaction.branch = 12) and (gltransactions.glacctno between '51000' and '90020') 
			order by glactivity.activitydesc, gltransactions.glacctno, gltransactions.gltrndate, gltransactions.glactivitycode");
	}

	public function getREMSDBDCRNoSundry($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select rescontract.custid, rescust.custname, rescollection.ornumber, rescollection.ordate, rescollection.oramount, rescollection.cashamount, rescollection.checkamount, rescollection.bankdepoamt, rescollection.creditcardamt, rescollection.bankid, rescollection.checknumber, rescollection.checkdate, rescollection.bankdesc, rescollection.collectionid, rescollection.contractid, tbllot.lotid, tbllot.lotdesc
			from rescollection 
			inner join rescontract on rescontract.contractid = rescollection.contractid 
			inner join rescust on rescust.custid = rescontract.custid 
			left outer join tbllot on tbllot.lotid = rescontract.lotid 
			where (rescollection.ordate between '".$start."' and '".$end."')
			order by rescollection.ornumber  ");
	}

	public function getREMSDBDCRWithSundry($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select glbooktransaction.bookprefix, concat(glbooktransaction.bookprefix, glbooktransaction.bookdocno) as ornumber, glbooktransaction.booktransdate, glbooktransaction.booksubsidiary, gltransactions.gldebit, rescollection.cashamount, rescollection.checkamount, rescollection.bankdepoamt, rescollection.creditcardamt, rescollection.bankdesc, rescollection.checknumber, gltransactions.glremarks 
			from glbooktransaction 
			left outer join gltransactions on concat(gltransactions.glbookprefix, gltransactions.glrefnum) = concat(glbooktransaction.bookprefix, glbooktransaction.bookdocno) 
			left outer join rescollection on rescollection.ornumber = concat(glbooktransaction.bookprefix, glbooktransaction.bookdocno) 
			where (gltransactions.glacctno = '10010') and glbooktransaction.booktransdate between '".$start."' and '".$end."'
			order by glbooktransaction.bookdocno ");
	}

	public function getREMSDBDMCMEntry($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select gltransactions.glbookid, gltransactions.glbookprefix, gltransactions.glrefnum, gltransactions.gltrndate, gltransactions.glacctno, glaccountmaster.glacctdesc, gltransactions.glsubcode, gltransactions.gldebit, gltransactions.glcredit, gltransactions.glremarks, gltransactions.branch
			from gltransactions
			left outer join glaccountmaster on glaccountmaster.glacctno = gltransactions.glacctno
			where (gltransactions.glbookid = '0I') and (gltransactions.gltrndate between '".$start."' and '".$end."') order by gltransactions.glrefnum");
	}

	public function getREMSDBEWT($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select gltransactions.glacctno, gltransactions.glactivitycode, glactivity.activitydesc, glaccountmaster.glacctdesc, concat(gltransactions.glbookprefix, gltransactions.glrefnum) as reference, gltransactions.gltrndate, gltransactions.gldebit, gltransactions.glcredit, glaccountmaster.recordnum, concat(glbooktransaction.booksubsidiary, '-', glbooktransaction.booktransremarks) as glremarks, glbooktransaction.booksubsidiary 
			from gltransactions 
			inner join glaccountmaster on glaccountmaster.glacctno = gltransactions.glacctno 
			left outer join glactivity on glactivity.activitycode = gltransactions.glactivitycode 
			inner join glbooktransaction on concat(glbooktransaction.bookprefix, glbooktransaction.bookdocno) = concat(gltransactions.glbookprefix, gltransactions.glrefnum)
			where (gltransactions.glacctno between '20260' and '20299.06') and (gltransactions.branch = 12) and (gltransactions.gltrndate between '".$start."' and '".$end."') and (glbooktransaction.branch = 12)
			order by gltransactions.glacctno, gltransactions.gltrndate ");
	}

	public function getReMSDBInputTax($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select gltransactions.glacctno, gltransactions.glactivitycode, glactivity.activitydesc, glaccountmaster.glacctdesc, concat(gltransactions.glbookprefix, gltransactions.glrefnum) as glreference, gltransactions.gltrndate, gltransactions.glbookprefix, gltransactions.gldebit, gltransactions.glcredit, glaccountmaster.recordnum, concat(glbooktransaction.booksubsidiary, '-', glbooktransaction.booktransremarks) as glremarks 
			from gltransactions
			inner join glaccountmaster on glaccountmaster.glacctno = gltransactions.glacctno 
			left outer join glactivity on glactivity.activitycode = gltransactions.glactivitycode 
			inner join glbooktransaction on concat(glbooktransaction.bookprefix, glbooktransaction.bookdocno) = concat(gltransactions.glbookprefix, gltransactions.glrefnum) 
			where (gltransactions.gltrndate between '".$start."' and '".$end."') and (gltransactions.branch = 12) and (glbooktransaction.branch = 12) and (gltransactions.glacctno between '17010' and '17060') order by gltransactions.glacctno, gltransactions.gltrndate ");
	}

	public function getREMSDBInventory17081($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select gltransactions.glacctno, concat(gltransactions.glbookprefix, gltransactions.glrefnum) as reference, gltransactions.gltrndate, gltransactions.glactivitycode, glactivity.activitytype, glactivity.activitydesc, gltransactions.glsubcode, glsubsidiary.subfullname, gltransactions.gldebit, gltransactions.glcredit, gltransactions.glremarks, glbooktransaction.booksubsidiary 
			from gltransactions
			left outer join glsubsidiary on glsubsidiary.subcode = gltransactions.glsubcode 
			left outer join glactivity on ltrim(glactivity.activitycode) = ltrim(gltransactions.glactivitycode) 
			left outer join glbooktransaction on concat(ltrim(glbooktransaction.bookprefix), ltrim(glbooktransaction.bookdocno)) = concat(ltrim(gltransactions.glbookprefix), gltransactions.glrefnum) 
			left outer join m_payablecheck on m_payablecheck.reference = concat(ltrim(gltransactions.glbookprefix), gltransactions.glrefnum)
			where (gltransactions.branch = 12) and (gltransactions.glacctno = '17081') and (gltransactions.gltrndate >= '".$start."') and (gltransactions.gltrndate <= '".$end."') 
			order by gltransactions.glactivitycode, gltrndate, concat(ltrim(gltransactions.glbookprefix), gltransactions.glrefnum) ");
	}

	public function getREMSDBInventoryMovement($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select item_invoice.salesdocnumber, item_invoicedetailed.transactiondate, item_invoicedetailed.entrydate, item_inventorymaster.itemid, item_inventorymaster.itemdescription, item_invoice.drivername as remarks, item_invoice.customername, item_invoicedetailed.transactiontype, glactivity.activitycode, item_invoice.truckplate as project, glactivity.activitydesc, item_invoicedetailed.branch, a_company.companydesc, item_invoicedetailed.salesid, item_invoicedetailed.inqty, item_invoicedetailed.outqty, item_invoicedetailed.price, item_invoicedetailed.cost, item_invoicedetailed.batchnumber, glactivity.activitydesc as projectcode 
			from item_invoicedetailed 
			left outer join item_inventorymaster on item_inventorymaster.itemid = item_invoicedetailed.itemid 
			left outer join item_invoice on item_invoice.salesid = item_invoicedetailed.salesid 
			left outer join glactivity on glactivity.activitycode = item_invoice.truckplate 
			left outer join a_company on a_company.recordno = item_invoicedetailed.branch 
			left outer join item_invoicedetailed as item_invoicedetailed_1 on item_invoicedetailed.batchnumber = glactivity.activitycode 
			where (item_invoicedetailed.transactiondate between '".$start."' and '".$end."') ");
	}

	public function getREMSDBInventoryPerProject(){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select item_invoice.salesdocnumber, item_invoicedetailed.transactiondate, item_invoicedetailed.entrydate, item_inventorymaster.itemid, item_inventorymaster.itemdescription, item_invoice.drivername as remarks, item_invoice.customername, item_invoicedetailed.transactiontype, glactivity.activitycode, item_invoice.truckplate as project, glactivity.activitydesc, item_invoicedetailed.salesid, item_invoicedetailed.inqty, item_invoicedetailed.outqty, item_invoicedetailed.price, item_invoicedetailed.cost, item_invoicedetailed.batchnumber, item_invoicedetailed.batchid, item_invoicedetailed.branch 
			from item_invoicedetailed 
			left outer join item_inventorymaster on item_inventorymaster.itemid = item_invoicedetailed.itemid 
			left outer join item_invoice on item_invoice.salesid = item_invoicedetailed.salesid 
			left outer join glactivity on glactivity.activitycode = item_invoicedetailed.batchnumber 
			where (item_invoicedetailed.batchnumber = '2080') or (item_invoice.truckplate = '2080') 
			order by item_invoicedetailed.itemid ");
	}

	public function getREMSDBInventorySummaryPerProject($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select item_invoicedetailed.itemid, item_inventorymaster.itemdescription, sum(item_invoicedetailed.inqty - item_invoicedetailed.outqty) as balance, item_invoicedetailed.price, sum((item_invoicedetailed.inqty - item_invoicedetailed.outqty) * item_invoicedetailed.price) as totalcost, item_invoicedetailed.branch, a_company.companydesc, item_invoicedetailed.batchnumber, glactivity.activitydesc 
			from item_invoicedetailed 
			left outer join item_inventorymaster on item_inventorymaster.itemid = item_invoicedetailed.itemid 
			left outer join a_company on a_company.recordno = item_invoicedetailed.branch 
			left outer join glactivity on glactivity.activitycode = item_invoicedetailed.batchnumber 
			where (item_invoicedetailed.transactiondate between '".$start."' and '".$end."') 
			group by item_invoicedetailed.itemid, item_invoicedetailed.price, item_inventorymaster.itemdescription, item_invoicedetailed.branch, a_company.companydesc, item_invoicedetailed.batchnumber, glactivity.activitydesc
			order by item_inventorymaster.itemdescription ");
	}

	public function getREMSDBInventorySummaryPerWarehouse(){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select item_invoicedetailed.itemid, item_inventorymaster.itemdescription, sum(item_invoicedetailed.inqty - item_invoicedetailed.outqty) as balance, item_invoicedetailed.price, sum((item_invoicedetailed.inqty - item_invoicedetailed.outqty) * item_invoicedetailed.price) as totalcost, item_invoicedetailed.branch, a_company.companydesc 
			from item_invoicedetailed 
			left outer join item_inventorymaster on item_inventorymaster.itemid = item_invoicedetailed.itemid 
			left outer join a_company on a_company.recordno = item_invoicedetailed.branch 
			where (item_invoicedetailed.branch = 41)
			group by item_invoicedetailed.itemid, item_invoicedetailed.price, item_inventorymaster.itemdescription, item_invoicedetailed.branch, a_company.companydesc, item_invoicedetailed.price
			order by item_inventorymaster.itemdescription ");
	}

	public function getREMSDBLapsing($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select gltransactions.glacctno, glaccountmaster.glacctdesc, concat(gltransactions.glbookprefix, gltransactions.glrefnum) as reference, gltransactions.gltrndate, gltransactions.glactivitycode, glactivity.activitytype, glactivity.activitydesc, gltransactions.glsubcode, glsubsidiary.subfullname, gltransactions.gldebit, gltransactions.glcredit, gltransactions.glremarks, glbooktransaction.booksubsidiary 
			from gltransactions 
			left outer join glsubsidiary on glsubsidiary.subcode = gltransactions.glsubcode 
			left outer join glactivity on ltrim(glactivity.activitycode) = ltrim(gltransactions.glactivitycode) 
			left outer join glaccountmaster on glaccountmaster.glacctno = gltransactions.glacctno 
			left outer join glbooktransaction on concat(ltrim(glbooktransaction.bookprefix), ltrim(glbooktransaction.bookdocno)) = concat(ltrim(gltransactions.glbookprefix), gltransactions.glrefnum)
			left outer join m_payablecheck on m_payablecheck.reference = concat(ltrim(gltransactions.glbookprefix), gltransactions.glrefnum) 
			where (gltransactions.glacctno = '18024') and (gltransactions.branch = 12) and (gltransactions.gltrndate >= '".$start."') and (gltransactions.gltrndate <= '".$end."')
			order by gltrndate, concat(ltrim(gltransactions.glbookprefix), gltransactions.glrefnum) ");
	}

	public function getREMSDBMRISIssuance($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select item_invoice.salesdocnumber, item_invoicedetailed.transactiondate, item_invoicedetailed.entrydate, Item_InventoryMaster.itemid, item_inventorymaster.itemdescription, item_invoice.drivername as remarks, item_invoice.customername, item_invoicedetailed.transactiontype, glactivity.activitycode, item_invoice.truckplate as project, glactivity.activitydesc, item_invoicedetailed.batchnumber, item_invoicedetailed.batchid, item_invoicedetailed.branch 
		  from item_invoicedetailed 
		  left outer join item_inventorymaster on item_inventorymaster.itemid = item_invoicedetailed.itemid 
		  left outer join item_invoice on item_invoice.salesid = item_invoicedetailed.salesid
		  left outer join glactivity on glactivity.activitycode = item_invoicedetailed.batchnumber
			where (item_invoicedetailed.transactiondate between '".$start."' and '".$end."') and item_invoicedetailed.transactiontype = 'ISSUEOUT' order by item_invoice.salesdocnumber ");
	}

	public function getREMSDBOutputTax($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select gltransactions.glacctno, gltransactions.glactivitycode, glactivity.activitydesc, glaccountmaster.glacctdesc, concat(gltransactions.glbookprefix, gltransactions.glrefnum) as glreference, gltransactions.gltrndate, gltransactions.glbookprefix, gltransactions.gldebit, gltransactions.glcredit, glaccountmaster.recordnum, concat(glbooktransaction.booksubsidiary, '-', glbooktransaction.booktransremarks) as glremarks, respayments.contractid, rescontract.lotid, tbllot.lotdesc
			from gltransactions 
			inner join glaccountmaster on glaccountmaster.glacctno = gltransactions.glacctno 
			left outer join glactivity on glactivity.activitycode = gltransactions.glactivitycode 
			left outer join respayments on respayments.refnum = concat(gltransactions.glbookprefix, gltransactions.glrefnum)
			left outer join rescontract on rescontract.contractid = respayments.contractid 
			left outer join tbllot on tbllot.lotid = rescontract.lotid 
			inner join glbooktransaction on concat(glbooktransaction.bookprefix, glbooktransaction.bookdocno) = concat(gltransactions.glbookprefix, gltransactions.glrefnum)
			where (gltransactions.branch = 12) and (gltransactions.gltrndate between '".$start."' and '".$end."') and (glbooktransaction.branch = 12) and (gltransactions.glacctno between '20300' and '20400')
			order by gltransactions.glacctno, gltransactions.gltrndate  ");
	}

	public function getREMSDBPORange($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select item_purchaseorder.recordnumber, item_purchaseorder.ponumber, item_purchaseorder.podate, item_purchaseorder.entrydate, item_purchaseorder.status, item_purchaseorder.supplierid, glsubsidiary.subfullname, item_purchaseorder.branch, item_purchaseorder.encoder, item_purchaseorder.drdate, item_purchaseorder.terms, item_purchaseorder.deliveradd, item_purchaseorder.prfnums, item_purchaseorder.canvasser 
			from item_purchaseorder
			left outer join glsubsidiary on glsubsidiary.recordno = item_purchaseorder.supplierid 
			where (item_purchaseorder.podate between '".$start."' and '".$end."') 
			order by item_purchaseorder.ponumber  ");
	}

	public function getREMSDPoserved($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select item_purchaseorder.podate, item_podetails.ponumber, item_purchaseorder.supplierid, glsubsidiary.subfullname, sum(item_podetails.poqty * item_podetails.itemcost) as poamount, sum(item_podetails.receivedqty * item_podetails.itemcost) as rramount, sum(item_podetails.poqty * item_podetails.itemcost) - sum(item_podetails.receivedqty * item_podetails.itemcost) as balance, item_purchaseorder.status, glactivity.activitydesc as project 
			from item_podetails 
			left outer join item_purchaseorder on item_purchaseorder.ponumber = item_podetails.ponumber 
			left outer join glsubsidiary on glsubsidiary.recordno = item_purchaseorder.supplierid 
			left outer join glactivity on glactivity.activitycode = item_podetails.projectcode 
			where (item_purchaseorder.podate between '".$start."' and '".$end."')
			group by item_podetails.ponumber, item_purchaseorder.supplierid, glsubsidiary.subfullname, item_purchaseorder.podate, item_purchaseorder.status, glactivity.activitydesc 
			order by item_podetails.ponumber, item_purchaseorder.podate  ");
	}

	public function getREMSDBProsdb(){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select rescust.custid, rescust.custname, rescontract.tcpamount, rescontract.contractdate, rescontract.restdate, rescontract.solddate, rescust.cpname, rescust.cpposition, rescust.contactnumber, rescust.emailadd, rescust.addrprovince, rescust.addrcity, rescust.addrbrgy, rescust.addrstreet, rescust.hpictfilenm, rescust.spictfilenm, rescust.active, rescust.rc, rescust.rm, rescust.rcu, rescust.rmu, rescust.branch, rescust.tin, rescust.addrstreet1, rescust.addrbrgy1, rescust.addrcity1, rescust.addrprovince1, rescust.business, rescust.faxnumber, rescust.fundsource, rescust.bdate, rescust.placeofbirth, rescust.nationality, rescust.gender, rescust.civilstatus, rescust.dependents, rescust.employername, rescust.jobtitle, rescust.occupation, rescust.grossincome, rescust.bdate2, rescust.tin2, rescust.businessphone2, rescust.contact2, rescust.emailadd2, rescust.employername2, rescust.jobtitle2, rescust.personal2, rescust.sendto, rescust.oldacct 
			from rescust
			left outer join rescontract on rescontract.custid = rescust.custid 
			order by rescontract.tcpamount, rescust.custname ");
	}

	public function getREMSDBReservationListing($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select rescontract.contractid, rescontract.contractdate, rescategory.description, tbllot.lotdesc, tbllot.lotarea, tbllot.areacost, tbllot.tcp, rescust.custname 
			from rescontract
			left outer join tbllot on tbllot.lotid = rescontract.lotid 
			left outer join rescust on rescust.custid = rescontract.custid 
			left outer join rescategory on rescategory.catid = tbllot.enterpriseid 
			where (rescontract.contractdate between '".$start."' and '".$end."') 
			order by rescontract.contractdate");
	}

	public function getREMSDBRR152010($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select gltransactions.glacctno, gltransactions.glactivitycode, gltransactions.glsubcode, gltransactions.gltrndate, gltransactions.gldebit, gltransactions.glcredit, concat(gltransactions.glbookprefix, gltransactions.glrefnum) as reference, gltransactions.glremarks, glsubsidiary.subfullname, glbooktransaction.booksubsidiary, glactivity.activitydesc, glactivity.activitytype 
			from gltransactions 
			left outer join glsubsidiary on glsubsidiary.subcode = gltransactions.glsubcode 
			left outer join glactivity on ltrim(glactivity.activitycode) = ltrim(gltransactions.glactivitycode) 
			left outer join glbooktransaction on concat(ltrim(glbooktransaction.bookprefix), ltrim(glbooktransaction.bookdocno)) = concat(ltrim(gltransactions.glbookprefix), gltransactions.glrefnum) 
			left outer join m_payablecheck on m_payablecheck.reference = concat(ltrim(gltransactions.glbookprefix), gltransactions.glrefnum) 
			where (gltransactions.glacctno = '17023') and (gltransactions.branch = 12) and (gltransactions.gltrndate >= '".$start."') and (gltransactions.gltrndate <= '".$end."')
			order by gltrndate, concat(ltrim(gltransactions.glbookprefix), gltransactions.glrefnum)");
	}

	public function getREMSDBUnbalancedEntries($start, $end){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select gltransactions.glbookprefix, gltransactions.glrefnum, sum(gltransactions.gldebit) as debit, sum(gltransactions.glcredit) as credit, sum(gltransactions.gldebit)-sum(gltransactions.glcredit) as difference, glbooktransaction.booksubsidiary, glbooktransaction.booktransdate from gltransactions inner join glbooktransaction on glbooktransaction.bookprefix = gltransactions.glbookprefix and glbooktransaction.bookdocno = gltransactions.glrefnum where (gltransactions.branch = 12) and (gltransactions.gltrndate between '".$start."' and '".$end."' ) and (gltransactions.gldebit - gltransact <> 0) group by gltransactions.glbookprefix, gltransactions.glrefnum, glbooktransaction.booksubsidiary, glbooktransaction.booktransdate order by difference");
	}

	public function getREMSDBUomitem(){
		$remsdb = $this->load->database('remsdb', true);
		return $remsdb->query("select item_inventorymaster.itemid, item_inventorymaster.itemnumber, item_inventorymaster.categorycode, item_inventorymaster.itemdescription, item_measurableuom.measureid, item_relationuom.uomid, item_uommaster.uomdesc 
			from item_inventorymaster 
			left outer join item_measurableuom on item_measurableuom.itemid = item_inventorymaster.itemid 
			left outer join item_relationuom on item_relationuom.measureid = item_measurableuom.measureid 
			left outer join item_uommaster on item_uommaster.uomid = item_relationuom.uomid ");
	}

	public function updateClient($info, $clientid){
		$this->db->where('client_id', $clientid)
			->update('client', $info);
	}

	public function updateOrganization($info, $organizationid){
		$this->db->where('organization_id', $organizationid)
			->update('organization', $info);
	}

	public function updateSupplier($info, $supplierid){
		$this->db->where('supplier_id', $supplierid)
			->update('supplier', $info);
	}


	public function countRecords($table, $option=''){
		$legacydb = $this->load->database('migrate', true);
		$legacydb->select('*')->from($table);
		if (!empty($option)) $legacydb->where($option);
		$query = $legacydb->count_all_results();
		return $query;
	}

	public function eraseDoubleSpace($holder){
		$a = [];
		$temp = '';
		for ($i=0; $i < strlen($holder); $i++) { 
			if (substr($holder, $i, 1) == ' ' and substr($holder, $i+1, 1) == ' ') {
					
			} else {
				array_push($a, substr($holder, $i, 1));
			}
		}
		for ($i=0; $i < sizeof($a); $i++) { 
			$temp = $temp.$a[$i];
		}
		return $temp;
	}

	public function deleteType($holder){
		$dictionary = array(
			"AP HEIRS OF",
			"AP-Heirs of",
			"Const. Bond",
			"LP-CBC17-PN#",
			"PN#100"
		);
		$tick = false;
		for ($i=0; $i < sizeof($dictionary); $i++){
			if (substr_count($holder, $dictionary[$i]) > 0) {
				$tick = true;
				break;
			}
		}
		return $tick;
	}

	public function renameCity($holder){
		switch (trim($holder)) {
			case 'Mandue City':
						$holder = 'Mandaue City';
						break;
			case 'Cagayan de Oro City':
			case 'Cagayn De Oro City':
			case 'CAGAYAN DE ORO CIT':	
			case 'CAGAYAN DE ORO CITY':
			case 'CAGAYAN DE ORO CITTY':
			case 'CAGAYAN DE ORO CTIY':	
			case 'CDO CITY':
			case 'CDO':	
			case 'CDOC':	
			case 'CAGAYAN DE ORO C ITY':
						$holder = 'Cagayan de Oro';
						break;

			case 'Las Piñas':		
			case 'LAS PIÑAS':					
			case 'LAS PIÑAS CITY':
						$holder = 'Las Piñas';
						break;
			
			case 'Dasmariñas':
						$holder = 'Dasmariñas City';
						break;

			case 'MAKATI CITY':
						$holder = 'Makati';
						break;

			case 'Mandaluyung City':
						$holder = 'Mandaluyong';
						break;

			case 'MUNTILUPA':
			case 'Muntinlupa City':
						$holder = 'Muntinlupa';
						break;


			case 'OZAMIS CITY':
						$holder = 'Ozamiz City';
						break;

			
			case 'Parañaque City':
			case 'PARAÑAQUE':
			case 'PARAÑAQUE CITY':			
			case 'Paranaque City':
						$holder = 'Parañaque';
						break;			

			case 'PASIG CITY':
						$holder = 'Pasig';
						break;						
			
		}
		return $holder;
	}

	public function renameProvince($holder){
		switch (trim($holder)) {
			//falling cases, careful in adding
			case 'ADN':
						$holder = 'Agusan del Norte'; 
						break;

			case 'AGN':
						$holder = 'Agusan del Norte';					 
						break;

			case 'Camiguin Province':
						$holder = 'Camiguin'; 
						break;

			case 'LANAOO DEL SUR':
						$holder = 'Lanao del Sur';	 
						break;
			case 'LDN':
						$holder = 'Lanao del Norte';						 
						break;

			case 'MISAMIS ORIETAL':
			case 'MISAMIS OREINTAL':
			case 'MISAMS ORIENTAL':
			case 'MISAMIS ORIENTAL V':
			case 'MISAMIS ORIENAL':
			case 'Mis Or':
			case 'Mis. Or.':
			case 'MIS. OR.':
			case 'MIS.OR.':
						$holder = 'Misamis Oriental';					
						break;

			case 'MIS. OCC.':
						$holder = 'Misamis Occidental';					
						break;	
			
			case 'SDN':
						$holder = 'Surigao del Norte';						 
						break;
			default:
						# code...
						break;
				}
		return $holder;
	}

	public function checkCompany($holder){
		$dictionary = array(
			"22 Karats Printing",
			"3 J Marketing",
			"3J Marketing",
			"A Brown Co",
			"A Brown Energy",
			"A C M D C",
			"A.M.R. Trading",
			"A.Q.G. Electrical Services",
			"A. J. Wood",
			"A.D. MHZ Trading",
			"AB & T Resorces",
			"Abarro, Carlos-Zambo. Warehse",
			"Abba's Orchard School",
			"ABC Commodities Corporation",
			"ABCI - Manila",
			"ABENSON",
			"ABS General Merchandise",
			"ABS-CBN",
			"Accessories",
			"ACCESSORIES",
			"Ace De Oro Commercial",
			"Ace Hardware",
			"ACS MANUFACTURING CORP",
			"ADNET SIGNS Advertising",
			"Adonis Security",
			"Advance Prosoft Computer",
			"Advertising",
			"Aeronics Incorporated",
			"After Six Tailoring",
			"AGCAOILI and ASSOCIATES",
			"AGGREGRATES",
			"Agricultural",
			"Agriventures",
			"Agusan del Norte Elect",
			"AGUSAN DEL NORTE ELECTRICIANS MULTI PURPOSE COOPER",
			"Agway Chemicals",
			"AIA Inc.",
			"AJ Wood Products",
			"Aldiz Multi Service",
			"Alfe Commercial",
			"Alfonso Sia Marketing",
			"Aliw Broadcasting Corp",
			"All Just Forms",
			"ALL JUST FORMS INC.",
			"Alliance Builders Management",
			"Allison Trading",
			"Alpha Engineering Works",
			"Alpha Insurance",
			"Alpha Pools",
			"ALPHA POOLS, INC.",
			"Alora House",
			"ALSJEM Construction",
			"ALSJEM Devt.",
			"AMERICAN TECHNOLOGIES",
			"Amzen Industries",
			"ANCO Merchandising",
			"Andrea North Condominium",
			"Angeles Ranch",
			"Angeles Shell Station",
			"Anya Equipment Parts",
			"AP Cargo Logistics Network Corp.",
			"APB Foundation, Inc.",
			"Appliance",
			"Aqua Haus",
			"ARA Industrial Supply",
			"ARCHIGLOBAL, INC.",
			"Ardent Builders",
			"Argusland Inc",
			"ARIANOS HOME BUILDERS DEPOT",
			"ARJ COLOUR STATION",
			"ARTAN HARDWARE",
			"Arujville Realty Corp",
			"As Powertech Corporation",
			"Asia International",
			"Asia Philippine",
			"ASIAN APPRAISAL COMPANY INC",
			"Asian Pacific",
			"ASSURANCE",
			"Atlantic Computer Center",
			"ATOP Design",
			"AUB Credit Cards",
			"AUC Gasoline Station",
			"AUC GASOLINE STATION BRANCH",
			"Auto Brands",
			"AUTOHAUS QUEZON CITY, INC",
			"Automo Display Center",
			"AVK Philippines Incorporated",
			"AVL Industrial Sales",
			"AVP Trading and Construction",
			"AZITSOROG, INC.",
			"B G C Builders",
			"B4M Marketing",
			"Bacphil Planters Fertilizers",
			"BACPHIL PLANTERS FERTILIZERS CORP",
			"Banco de Oro",
			"Bank of Philippine Island",
			"BANK OF THE PHILIPPINE ISLANDS",
			"Barangay Bonbon",
			"Bayan Telecommunications",
			"BCG Konstrukt Engineering Services",
			"BCP Realty",
			"Begul Builders",
			"Beguls Builders",
			"Belcars Auto Parts",
			"Ben Ben Welding Shop",
			"Ben Dy Machine Shop",
			"Best Buy",
			"BEST CHOICE ENTERPRISES",
			"Beta Industrial Sales",
			"BGC Philbuilder Inc.",
			"Big Wave Advertising",
			"BIR",
			"BME Partners",
			"Bordeos Heavy Equip. Parts Center",
			"BP & Co",
			"BPI Family Savings Bank",
			"BPI FAMILY SAVINGS BANK",
			"Broadcasting",
			"Brown Resources Corp",
			"Brownman Advertising",
			"Builder",
			"BUILDER",
			"Buildres",
			"Bureau of Fire Protection",
			"Bureau of Internal Revenue",
			"Bureau of Treasury",
			"Business",
			"BUTUAN BOLT CENTER",
			"Butuan Champion Hardware",
			"BUTUAN CHAMPION HARDWARE",
			"Butuan City Water District",
			"BUTUAN EXPRESS HARDWARE WORKSHOP INC",
			"Butuan Mega Const. Supply",
			"C D O",
			"C E P A L C O",
			"C. Puertas Enterprises",
			"C.D.O.",
			"C&G Refrigeration & Airconditioning",
			"Cabadbaran Concrete Products",
			"CABADBARAN CONCRETE PRODUCTS",
			"Cabangca & Sons Ent",
			"Cabezas Pest Cont",
			"Cagayan Balita Marketing",
			"CAGAYAN DE ORO GAS CORP",
			"Cagayan de Oro Hardware",
			"Cagayan De Oro Hydraulics",
			"Cagayan de Oro Timber",
			"Cagayan de Oro Water District",
			"Cagayan De Oro Water District",
			"Cagayan Educational Supply",
			"Cagayan Electric Power & Light Co",
			"Cagayan Goodrich Marketing",
			"Cagayan Isuzu Center",
			"Cagayan Jaycolor Place",
			"Cagayan Regent Furnishing",
			"Cagayan Swani Hardware",
			"Capears Marketing",
			"CARAGA FUEL DISTRIBUTOR",
			"CARLOS P. DIZON LAND SURVEYS",
			"Carmen Isuzu Parts",
			"Carmen Lumber Trading",
			"Carrant Realty",
			"Casa Isabella",
			"Casamia Furniture Center, Inc.",
			"Castro Heavy Metal Equip",
			"Cattle Farm",
			"CB BARANGAY ENTERPRISES",
			"CBBE Crane Rental & Trucking",
			"CBF Publishing",
			"CBL COURIER EXPRESS INTERNATIONAL",
			"CCC PEOPLES AUTO PARTS SUPPLY",
			"CDO",
			"CDO Brokers & Associates",
			"CDO Brokers and Associates",
			"CDO Electrocare & Supply",
			"CDO Hydraulics",
			"CDO N-CAR, INC.",
			"CENTER FOR GLOBAL BEST PRACTICES",
			"CENTRAL QUALITY APPLIANCE, INC.",
			"Cebu Hydraulic",
			"Cebu Southern Motors, Inc.",
			"Cebu Titan Surplus",
			"CECA Engineering Services",
			"Ceca Engineering",
			"CENTER",
			"CEPALCO",
			"CGKFORMAPRINT, INC",
			"CG Refrigeration & Airconditioning",
			"Chamber of Real Estate",
			"Charlz Construction",
			"Chee Realty",
			"Chemtrust Industrial",
			"CHENSAN ENTERPRISE",
			"China Bank Corp",
			"CHRIS T. SPORTS CENTRIO, INC.",
			"Circuits & Beads",
			"CITI HARDWARE BACOLOD, INC.",
			"Citi Motors",
			"City Ads",
			"City Treasurer's Office",
			"City Treasurers Office",
			"CITY TREASURER",
			"CIVIC MERCHANDISING INC.",
			"CJ Architects",
			"CJ Modelworks Inc.",
			"Classic Style",
			"Classic Wood Products",
			"CLIXLogic, Inc.",
			"CM Enterprise",
			"Coins General Merchandise",
			"Colent Diversified Products",
			"College",
			"COLLIER PHILIPPINES INC",
			"Columbia Computer Center",
			"Comglasco Aguila Glass Corp",
			"COMPUTER",
			"Commercial Area -Xavier Heights",
			"COMMUNICATION",
			"Company",
			"Compstream Sales",
			"Conarch Construction",
			"Consolidated Broadcasting System",
			"CONSTANTINO GUADALQUIVER AND CO",
			"Constech Asia Corporation",
			"CONSULTING",
			"Construction",
			"CONSTRUCTION",
			"Contruction",
			"Continental Diesel Parts",
			"CONTRACT DESIGN AND SYSTEMS FURNITU",
			"Cool Knight",
			"Copyfax Com",
			"Copylandia Office System",
			"CORAL RESOURCES PHILS INC",
			"CORP.",
			"Corporation",
			"CORPORATION",
			"Corpus Christi",
			"COUNTRY CLUB",
			"Crear'E Couture",
			"CREARE Couture",
			"Create One Cons.",
			"CREBA, Inc",
			"CRM Digitech Prints",
			"CRM DIGITECH PRINTS",
			"Crown Paper & Stationer",
			"CUBIXOFFICE, INC",
			"CUERVO APPRAISERS",
			"Cut 'N Style Iron",
			"CVO Caterers Food Center",
			"Cyclone Transport Corporation",
			"Cygnus Construction",
			"D ONE DIGITAL CREATION",
			"Dal Arms Sports House",
			"DAN DARYLL PHILS INC",
			"DANIEL MERCHANDISING",
			"Danster General Mechandise",
			"Danster General Merchandise",
			"DARL AGRICULTURAL",
			"Darnells Catering Services",
			"DASAN USED CAR DEALER, INC.",
			"Dataworld Computer Center",
			"DATAWORLD COMPUTER CENTER BUTUAN CITY",
			"Davao Citi Hardware",
			"Davao Citihardware",
			"DAVAO CITIHARDWARE, INC.",
			"DAVAO SUN-ASIA GENERAL MERCHANDISING INC.",
			"DDIS, Inc.",
			"DDIS, INC.",
			"Del Castillo Copy Center",
			"DESIGNS",
			"De la Torre & Co.",
			"Dela Torre & Co.",
			"De Oro Bayanihan",
			"De Oro Construction",
			"De Oro Glass",
			"De Oro Lotus",
			"De Oro Maramag",
			"De Oro Pacific",
			"De Oro THT Trading",
			"De Oro Trapal",
			"DEPOT",
			"Dept. of Science & Technology",
			"Denki Electric Corporation",
			"Design Setter Const",
			"Desmark",
			"Destinations Unlimited Travel Agency, Inc.",
			"Development",
			"DEVELOPMENT",
			"Digi-Kaden, Inc.",
			"DIGITAL TELECOMMUNICATION PHILS INC",
			"Diocese of Tagum",
			"DJJ Surplus",
			"DMT Marketing",
			"DN Steel",
			"Do It PrintShoppe",
			"Domain Merch. Serv., Inc.",
			"Donna Sign & Printing",
			"Doongan Solid Transport",
			"DPE Upholstery Shop",
			"DUAL FORCE HYDRAULIC CENTER",
			"Dulfer Lending Service",
			"Dyteban Hardware & Auto Supply",
			"E & V General Merchandise",
			"E.C.E. Construction & Supply",
			"E.M. Zalamea Actuarial Services,Inc",
			"E-POWER INDUSTRIAL TECHNOLOGIES",
			"E&E Appliance Service and Supply",
			"Eagle Equipment",
			"East West Seed",
			"EB STONE DESIGNS",
			"EBC Electronics & Communication",
			"Economic Briefing",
			"ECOTRANS CAR RENTALS",
			"EduChild",
			"Efco Philippines",
			"EGD Lopez & Partners",
			"EGD LOPEZ AND PARTNERS",
			"EJB TRAPAL CENTER",
			"El Elyon Shell Station",
			"El Elyon Shell Service Station",
			"ELC Equipment Parts, Inc.",
			"Electronics",
			"ElectroPro Mktg.",
			"ElectroWorld Office Systems",
			"ELIM DISTRIBUTOR",
			"Elmar Marketing",
			"Emerging Dragons Business",
			"EN-TIRE CAR CENTER INC",
			"ENERGETIX POWER TECH CORP",
			"ENGINEERING",
			"Enterprise",
			"ENTERPRISE",
			"Envisage Security Agency, Inc.",
			"ENVISAGE SECURITY AGENCY INC",
			"Eon Computer Center",
			"EON Computer Center",
			"EPALS HOLDINGS INC",
			"Epic",
			"Equipment",
			"EQUIPMENT",
			"Excellent Parts & Industrial Mktg",
			"F. G. Autoclinic Center",
			"F.D.J. ROSMAR CORP",
			"F.E.D. CONSTRUCTION COMPANY, INC.",
			"F.G. Ever, Inc.",
			"F.P Carreon Construction",
			"F.P. Carreon Construction",
			"Fablues Fastfood Catering",
			"Faithful I.T. Solutions",
			"Family Congress",
			"FANM Enterprise",
			"Fargo Motor Parts",
			"Fast Autoworld Phil",
			"Fatzo Lechon",
			"Federal Phoenix Assurance",
			"Felix Refrigeration & Aircon Services",
			"Fergo Printing Service",
			"FG Ever, Inc.",
			"FGBMFI-Butuan City",
			"FGC CONSTRUCTION",
			"FGW Construction",
			"FIBECO Inc.",
			"FIBECO, Inc.",
			"Fil Conveyor Components",
			"FIL CONVEYOR COMPONENT",
			"FIL Trading", 
			"Financial Execs Institute of the Phils",
			"FIRST ASIAN METALS CORP",
			"FIRST BUKIDNON ELECTRIC",
			"Fit Cars Service Center", 
			"FLAIRE MEDIA CONSULTING, INC",
			"Flowcrete Const. Equip",
			"FNB PRINTING HAUS",
			"Foods",
			"FOODSPHERE, INC",
			"Footprints Award Centrum",
			"Forest Park - Palm Oil",
			"Fortune General Insurance Corp",
			"FOTHELO ADVERTISING PHILIPPINES",
			"Foundation",
			"FOUNDATION",
			"FP Carreon Construction",
			"Freeway Tire Center",
			"Freeway Tires Center",
			"FREON TECHNOLOGY ENTERPRISES",
			"FSWT Corporation",
			"Fuji Xerox Phils",
			"Fulgado Matignas & Associates Law Office",
			"Full Throttle Accessories",
			"FURN CARE PHILS",
			"FURNITURE",
			"FYRELYN INDUSTRIES, INC.",
			"G & P Builders",
			"G! ATV Motors Sales & Rental",
			"G.A.M.",
			"G.G. Giant Hardware & Const.",
			"Gargar",
			"Garment",
			"Gail's Tailors",
			"Gails Tailors and Design",
			"Gails' Tailors & Design",
			"GAISANO CITY",
			"Gaisano Interpace",
			"GAITS",
			"Galili Machine Shop",
			"GCL Enterprises",
			"Gendiesel Philippines",
			"GEO-TRANSPORT & CONSTRUCTION",
			"Geoex Farm",
			"Geoex Holdings",
			"Geotecnica Corp.",
			"Gerbec Construction & Devt. Corp",
			"GG Giant Hardware",
			"GG GIANT HARDWARE",
			"Gil M. Cembrano Sand Gravel Quarrying",
			"GL Autoworks and Supply",
			"Glainier Industrial Corp",
			"Glass Supply & Gen. Merchandise",
			"GLOBAL EASY HARDWARE",
			"Globalchips Technologies",
			"Globatronics Marketing",
			"Globe Telecom",
			"GLOBE TELECOMMUNICATIONS",
			"GMA Network",
			"Go To Surplus, Inc.",
			"GOLD COIN STEEL PHILIPPINES CORP",
			"Goldcrest Marketing",
			"Golden Cars Service Center",
			"Golden Dragon Metal Products",
			"Golden Edge",
			"Golden Pebbles Devt Corp",
			"Golden Pebbles Devt. Corp.",
			"Golden Pension House",
			"Golden Tire Supply",
			"Golden Transport Surplus",
			"Goldstar Daily",
			"Goldtown Industrial Sales",
			"Good Morning Intl",
			"Goodmorning Int'l Corp.",
			"Goodway Thermo Engineering",
			"Goodwish Enterprise",
			"Gordiel Auto Parts",
			"Gordiel Auto Supply",
			"GORDIEL AUTO SUPPLY",
			"Gotesco Marketing",
			"Gotil Realty Corp",
			"GRAFFITTI",
			"Grand C Graphics",
			"Grand Glazing Center",
			"Grand Machinery Works",
			"Grandblocks Enterprises",
			"Grandscape Travel & Tours",
			"Grantman Industrial Corp.",
			"GRAPHIC",
			"Graphic All In Store",
			"Grasco Trading Co.,",
			"GREEN ENERGY GAS STATION",
			"Greencars Mindanao Corp.",
			"Greenmix Farm & Garden",
			"GRUNDFOS PUMPS",
			"GSC-RAC COMPANY",
			"GSFERROLINO CONSTRUCTION & SUPPLY",
			"GT Go Enterprises",
			"GT Realty Corp.",
			"GTPC BOLT CENTER",
			"GTS Construction Supply",
			"Guardians of the Earth Assn",
			"Guill-Bern Corporation",
			"H & C Builders",
			"H. S. A.",
			"Halasan Surveying Office",
			"Handy Do It Center",
			"Hapit-Anay",
			"HAPPY ENTERPRISES AND RESOURCES",
			"Hardin Flowerworks",
			"HARDWARE",
			"Harvest Field Rice Trading",
			"HDMF",
			"HELGAR BUILDERS",
			"HEMO",
			"HENRO STEEL CORP",
			"Herohito MD Store",
			"Hexagon Bolt",
			"HNH Builders & Enterprises",
			"HI-POWER STEEL INDUSTRIAL CORP",
			"Hi-Tek Paint",
			"Higala Foundation",
			"HILTI PHILIPPINES, INC",
			"Hirayama Trading",
			"HLURB",
			"Hoc Siu Marketing",
			"HOLCIM PHILIPPINES",
			"HOLDING",
			"HOME DESIGN",
			"Home Development Mutual Fund",
			"HONDA MOTOR WORLD",
			"HOSPITALITY INTERNATIONAL",
			"Hotel",
			"HOTEL",
			"Housing",
			"I Click Digishop Corp.",
			"I4ONE INC",
			"IBM Global Financing Phils",
			"IBUILD CONSTRUCTION SOLUTIONS INC",
			"IC Marketing",
			"Idol s Auto Repair Shop",
			"Idol's Auto Repair",
			"IEQUITY TECHNOLOGIES CORP",
			"Ilaya Coco Lumber & Construction Supply",
			"Inc.",
			"INC.",
			"INCORPORATED",
			"INDUSTRIAL",
			"Ink Now! Corp.",
			"Innove Communications, Inc.",
			"Insular Life Assurance Co.",
			"Integrated BAR of the Phil",
			"Integrated Electrical Control",
			"Interlock Sales",
			"International Consolidator Phils",
			"INTERNATIONAL",
			"Interpace Computer System",
			"Interserve",
			"INVESTMENT",
			"Isalama Industries, Inc.",
			"ISALAMA Industries",
			"ISAY ENTERPRISES",
			"ISSI INFORMATION TECHNOLOGIES",
			"J & M Petron Service",
			"J & M PETRON SERVICE STATION",
			"J. E. T. Hardware",
			"J. E. Machine Shop",
			"J. Eguia Machine Shop",
			"J.B. & Sons Equipment",
			"J.B. and Sons Equipment",
			"J.E Auto Parts",
			"J.E.T. Hardware",
			"J.Eguia Auto Parts",
			"J-BHOY OFFICE SUPPLIES STORE",
			"Jacala Metal Works Corp",
			"Jacka Enterprises",
			"Jacos Lechon",
			"Jacsons Ent",
			"Janette Agri-Supply Dealer",
			"JANIKKAS CATERING",
			"Jannette Agri-Supply Dealer",
			"Japnar Trak Corp.",
			"Jaraula Devt.",
			"Jaraula Devt Corp",
			"JARAULA DEVT CORP",
			"Jarex Ind. Sales",
			"JAS Trading & Gen.",
			"JATICO EVENTS",
			"Jay Builders",
			"JCA Realty",
			"JDE Construction",
			"JEELS MASAGANA FARM SUPPLY",
			"JFG Tech",
			"JG Construction",
			"JGG Pestmaster",
			"JGG PestMaster",
			"Jhaymart Industries",
			"Jhaymarts Industries",
			"JHAYMARTS INDUSTRIES",
			"JIABIN INDUSTRIAL ENTERPRISE CO.",
			"Jimar Construction",
			"Jimwen Construction",
			"JLBC GLOBAL LOGISTICS",
			"JMDC Const",
			"JOBSTREET.COM PHIL. INC.",
			"Jobstreet.com Philippines, Inc.",
			"Jodaca Marketing",
			"Joe Cars Auto Repair Shop",
			"Joesons Commercial Co.",
			"JOESONS COMMERCIAL CO",
			"John Offset Press",
			"JR GASUL CENTER",
			"JRA Surplus & Parts Supply",
			"JS Pirante Surveying Serv.",
			"JT Surplus Parts Center",
			"JTA COMMERCIAL MERCHANDISING",
			"JUAN SIA ENTERPRISES",
			"Juliano Automotive Repair Shop",
			"Juswin Trade & Automotive Services",
			"JVAN Steel Works",
			"JVS Audio",
			"JVS AUDIO SYSTEM",
			"JWL SOURCING GROUP",
			"K & G CONCRETE PRODUCTS",
			"K & G Construction and Supply",
			"Kagay Car Rental",
			"Kagay-an de Oro Bazaar",
			"KAISA Coop",
			"Kaking Import & Export Co.",
			"KARILAGAN INTERNATIONAL TRAVEL",
			"KASAMA KA",
			"Kathryn Bakeshop",
			"KAYLA GAY CREATION",
			"Kenbru Construction Services",
			"Kenise Automobiles",
			"KIL BUILDERS & CONSTRUCTION SUPPLY",
			"Kimwa Construction",
			"King Sun Enterprises",
			"Kopya de Oro Services",
			"KRA Marketing",
			"Krypton Industrial Resources",
			"KUMKANG KIND CO., LTD",
			"Kupler DCMC Phils",
			"Kwik Way Engineering Works",
			"L & B Concrete Products",
			"L & B CONCRETE PRODUCTS",
			"L AND A TRAVEL & TOURS",
			"La Victoria Grocery",
			"LA VICTORIA GROCERY",
			"Lagman Electronics Services",
			"LANCASTER HOTELS, LAND",
			"Land Asia",
			"Land Bank of the Phil",
			"LARA UY SANTOS LAW OFFICES",
			"LAROBIS ENTERPRISES",
			"LBC Express Inc.",
			"LBL Traffic Control",
			"LCG Marketing",
			"LCR AUTO SEAT COVER",
			"Legacy Sales & Printing",
			"LEOPARD INTEGRATED SECURITY SRVICES",
			"Levi Printing Press",
			"LEXUS MANILA INC",
			"LGU PASIG",
			"Life Auto Supply",
			"Lilibeth Couture",
			"Links Machine Works",
			"Livan Trade Corporation",
			"LJMA Phoenix Gas Station",
			"LKKS & Milling",
			"Local Govt Unit",
			"Local Government Unit",
			"Louin Industrial Sales",
			"Loyola Plans Consolidated",
			"LT Datu",
			"Longhapros Marketing",
			"Lonucan Agri. Corp",
			"LOVE ELECTRONICS SERVICE CENTER",
			"Lower Balulang",
			"Lucky Seven",
			"Lumber",
			"LYL Development Corporation",
			"M. & Jr. Enterprises",
			"M. and Jr. Enterprises",
			"M.L. Cabanducos Iron Works",
			"Ma. Cristina Agro Trading",
			"Mabuhay Vinyl Corp",
			"Mackun Marketing",
			"Machine",
			"Madison Shopping Plaza",
			"Magnet Advertising",
			"Magnet Motors Corporation",
			"MAGNUM COMPUTERWARE",
			"MAIL EXPERT MESSENGERIAL AND GEN",
			"Majesty Sales Center",
			"Makati Foundry Inc",
			"MAKATI FOUNDRY",
			"Maken Traders",
			"Man Stone Trading",
			"MANAGEMENT",
			"Management Asso. of the Phils",
			"Management Assoc. of the Phils",
			"MANAGER",
			"Mandaue Foam Industries",
			"Manila Bulletin Publishing Corp",
			"MANILA BULLETIN PUBLISHING CORP",
			"MANILA WATER COMPANY INC",
			"Mantrade Development Corp.",
			"MANUEL STATIONERY",
			"Manufacturing",
			"MAPECON Phils",
			"MAPFRE Insular Insurance Corp",
			"Marketing",
			"MARKETING",
			"Marga Glass Marketing",
			"Maxicare",
			"MAXICARE HEALTH",
			"Maxima Machineries",
			"MAXIMUM SOLUTIONS CORP",
			"Maybank Phils",
			"MBG Trucking Services",
			"MCAT",
			"MDK ANRO DEVT CORP",
			"Media",
			"MEDIA CENTRAL INC",
			"Megaprinting and Supplies",
			"MERCHANDISE",
			"Meridian Assurance Corporation",
			"Meter King Inc.",
			"Metro Bank",
			"METRO DAVAO SUPREME PUMPS INDUSTRIES",
			"MF Auto Parts",
			"MICHIEL GILE MYTURF PARTS SUPPLIES",
			"MICROPACIFIC TECHNOLOGIES INC",
			"MICROPHASE CORPORATION",
			"Microtrade GCM Corp",
			"Microtronix Marketing Sales",
			"Microtronix Mktg. Sales",
			"MIDTOWN PRINGTING CO",
			"Midtown Printing Co",
			"MILLENNIUM CARS MINDANAO INC.",
			"Mindanao Ace Marketing",
			"Mindanao Assoc. for Quality Inc.",
			"Mindanao Daily News",
			"MINDANAO DAILY NEWS PUBLISHING CORP",
			"Mindanao Development Bank",
			"Mindanao Leader Cable Supply",
			"Mindanao Oriental Builders",
			"Mindanao Precast Structures",
			"Minkay Restobar and Catering Services",
			"MING BISTRO CAFE CORP",
			"MinPalm Agricultural Co., Inc.",
			"MIRAFLOR NEWSSTAND",
			"Mitsubishi Motors",
			"MJ Lime & Gravel",
			"ML Cabanducos Iron Works",
			"MLE AGGREGATES",
			"MLN Concrete",
			"MM MARBLE AND CONSTRUCTION SUPPLY",
			"MN Lluch Dev't Corp",
			"MN Lluch Devt Corp",
			"Modern Paints Center",
			"Monark Corporation",
			"Monark Equipment",
			"Monjab's Upholstery",
			"Monjabs Upholstery",
			"Monte Oro Resources & Energy Inc.",
			"MORESCO",
			"Moreta Shipping Lines, Inc.",
			"MOTORJOY DEPOT INC",
			"Motormate Merchand",
			"Motormate Merchandizing",
			"Motors",
			"Motortrade Nationwide Corp",
			"MOTORWERKS",
			"Motorworld Motorcycle Parts",
			"Mountain Pines Farm",
			"Multi-Artworkds",
			"Multi-Artworks",
			"Multi-Line Davao, Inc.",
			"Municipal Treasurer",
			"Mustard Seed System Corp",
			"Mynimo Inc",
			"Nakeen Corp.",
			"National Book",
			"NAZCA Designs",
			"NB Iron Works",
			"NEW ROCKS",
			"Nissan Cagayan",
			"Nissan CDO Distributors",
			"NIZA Builders",
			"NKAC",
			"NMDB",
			"NMMDC",
			"North Kitanglad",
			"North Mindanao",
			"North Mining Dev.",
			"Northmin Mining Dev. Corp.",
			"Numinous Marketing",
			"Nursery",
			"OCG Rances",
			"Octagon Computer Superstore",
			"Office of Municapal Treasurer",
			"Office of Municipal Treasurer",
			"OFFICE",
			"Oliver D. Pe Benito Const",
			"Ommix Concrete Construction",
			"Opal Auto Parts",
			"Organizer",
			"Oro Autofix",
			"Oro Graphic",
			"Oro Hi-Speed",
			"Oro JJ-",
			"Oro JJ -",
			"Oro Mighty Enterprises",
			"Oro Solid Hardware",
			"Ororama Super Center",
			"Osin Motors Corp.",
			"Osmeña Motor Sales",
			"Otis Shell Station",
			"P C D W Foundation",
			"P.T. Cerna Corp.",
			"Paderbros Builders",
			"Paints",
			"Palm Concepcion Power Corp.",
			"Palm Conception Power Corp.",
			"Parts",
			"PARTS",
			"PBJ Corporation",
			"PC Chain Superstore",
			"People's Agri Service",
			"People's Parts",
			"Peoples Agri Service & Supply",
			"PERFORMANCE",
			"Phigold Metallic Ore Inc.",
			"Phil.",
			"Phil. Belt Manufacturing Corp.",
			"Phil. Daily Inquirer, Inc.",
			"Phil. Health Insurance Corp",
			"PHIL. SPAN ASIA CARRIER CORP.",
			"Phil. Span Asia Carrier",
			"Phil. valve Manufacturing",
			"Philcopy Corporation",
			"Philippine",
			"PHILIPPINE",
			"Philpipes Corporation",
			"PHILRES - Mis. Or.",
			"Philtyres Corporation",
			"PHILEX",
			"PHOTOGRAPHY",
			"PJ Glass Supply",
			"Plumbing",
			"PICAZO BUYCO TAN FIDER",
			"Picture City",
			"Pilipinas",
			"PILIPINAS",
			"Pinnacle Engineering",
			"Pioneer Insurance",
			"Pioneer Refrigeration",
			"Pisa-an Memorial Gar",
			"PLDT-Philcom, Inc.",
			"PLUMBLINE DEVT CORP",
			"PNB Trust Banking Group",
			"Polytechnic",
			"Power Heavy Parts",
			"PR360 INC",
			"Primadera",
			"PRIMADERA",
			"Prime Event",
			"PRINTSHOPPE",
			"PRODUCTS",
			"PRO-SHOP",
			"PROFESSIONAL",
			"Progress Marketing",
			"Prov. Treasurer's Off. - Bukidnon",
			"Provident Insurance",
			"Pryce Corp.",
			"PSB Enterprise",
			"PUBLISHING",
			"Pueblo de Oro",
			"Quality Appliance Plaza",
			"Quarry",
			"Quicktronic Enterprises",
			"Quinto Construction",
			"R. G. Sand",
			"Rachelle's Dress Shop",
			"Rachelles Dress Shop",
			"Raf Raf Auto Surplus",
			"Rajah Bagani Protective Agency",
			"Rajah Bagani Security Agency, Inc.",
			"Ramon Rodriguez Const.",
			"RAQ Enterprises",
			"RAS Carpets Enterprises",
			"Rasa Prema",
			"RCCA Glass",
			"RCJ Engineering",
			"RCL 4455 INC",
			"RCW Construction",
			"RDV Agro Industrial",
			"Real Estate",
			"Realty",
			"Red Star Aggregates",
			"Refrigeration",
			"Regent Furnishing",
			"Registry of Deeds",
			"Remantec Corporation",
			"Remantic Corporation",
			"Repair",
			"Republic Courier Service",
			"Resort Sports Equipment (RSE)",
			"RESORT",
			"Resources",
			"RESOURCES",
			"Restaurant",
			"RESTAURANT",
			"Retail International Corp.",
			"RH Electricals",
			"Ricciny's Garment",
			"Richfield Agricultuaral Supply",
			"Richfield Agricultural Supply",
			"Rifranz Manufacturer",
			"Rifranz Mfg.",
			"Rightstop Convenience Store",
			"Rightstop Convenient Store",
			"Riverview Family Inn",
			"Trading",
			"RMGO Hardware",
			"Roadnet Enterprises",
			"Roadside Shop",
			"ROADSIDE",
			"Roadstar Auto Supply",
			"Robbin's Auto Parts",
			"Roberto R. Escano and Associates",
			"Robins Home Depot",
			"Robinson's Handyman",
			"Rock Builders",
			"ROG Construction & Supplies",
			'ROMULO MABANTA BUENAVENTURA SAYOC AND DELOS ANGELES',
			"Ronwood Construction",
			"Rosevale School",
			"Rovency",
			"Roy Cool Air",
			"Rufina Marketing",
			"S.E.F Concrete Products",
			"Saarenas Construction Supply",
			"Safevue Glass Enterprises",
			"Saguittarius Security Agency",
			"Salay Handmade Products Indus",
			"Sameah Travel & Tours",
			"Samuel Auto Repair",
			"San Jose Concrete Aggregates",
			"SAN JUAN ACQUA PRIMERA INC",
			"San Pascual",
			"SAND AND GRAVEL",
			"Sanitary Care Products",
			"SBG Construction",
			"SB Marketing",
			"SB-One Way",
			"Service Partners",
			"Service",
			"SERVICE",
			"SGS Vehicle Assembler",
			"SGV AND CO",
			"Sharp Electrical Supply",
			"Shejan Construction",
			"Shellac Petrol Corp.",
			"Siccion Marketing",
			"Sign Head Graphics Advertising",
			"Silicon Electrical Supply",
			"Simplex Industrial Corporation",
			"SISON CORILLO PARONE AND CO",
			"SLERS",
			"Smart Communications",
			"Smart Tech Industrial",
			"SMCB3 construction & services",
			"SMCB3 Construction",
			"SMCB3 Enterprises",
			"Social Security System",
			"Solaris Gas Service",
			"Solid Shipping Lines",
			"Solution",
			"SOLUTION",
			"Soriano Law Office",
			"South Milandia Inc.",
			"Southern Electrical Supply",
			"Spot Wireless Systems",
			"SPECIALIST",
			"Square Deal Enterprises",
			"St. Justine Realty",
			"St. Nicolas Inn",
			"Star Appliance Center",
			"Starpons Enterprises",
			"STATION",
			"Stone Pro Trading Corp",
			"Streamflow Trading",
			"Stronghold Insurance",
			"STRZ Pro Audio",
			"SUGECO",
			"Sultan sa Masiu",
			"Summit Deep",
			"Sunix General Marketing",
			"Sunstar Cagayan De Oro",
			"Super Motor Parts",
			"Superior Gas & Equipment Co",
			"SUPERMARKET",
			"SUPERVALUE",
			"Supply",
			"SUPPLY",
			"Survey Tech Trading",
			"Sycip Gorres Velayo & Co",
			"SYSTEMS",
			"Tabada Concrete Products",
			"Tagbagani Security",
			"Tailor Made",
			"TAILORING",
			"TCGI Engineers",
			"TCGI, Inc",
			"TDM Motorcycle Parts",
			"TDX Builders",
			"Techno Mart Computer",
			"Techno-Stress",
			"Techno-Trade",
			"Techno-trade Resources",
			"TECHNOLOG",
			"Telow and Company",
			"Terra Asia",
			"Textar Sales Corporation",
			"TONE GUIDE PRESS",
			"Toyota",
			"TOYOTA",
			"Top Lifegear Marketing",
			"Toto's Surplus Center",
			"Totos Surplus Center",
			"Tourism Promotions Board",
			"TRADING",
			"Transway Sales Corporation",
			"TRANSWAY SALES CORPORATION",
			"Transworld Tires",
			"Travel",
			"TRAVEL",
			"Treasurer",
			"Tri-J & Enterprises",
			"Tri-Star Paints Center",
			"Tripocap Trading",
			"Trix Offroad Car Accessories",
			"Trixoffroad Accessories",
			"Tromech Industrial Sales & Services",
			"Tropical Fruits",
			"Trusses",
			"UCPB General Insurance",
			"UCPBank",
			"Ultimate Bivouac",
			"Ultracraft Advertising Corp",
			"Uni Offroad Ventures Corp",
			"Union Galvasteel Corp",
			"UNIONBANK VISA",
			"United",
			"UNITED",
			"University",
			"UNIVERSITY",
			"UP Marketing",
			"Valencia City Water District",
			"Valencia Goodwill Commercial",
			"Vazquez Building Systems",
			"VCR Agsao Agro",
			"Velez Property",
			"Ventures",
			"VIC Imperial Appliance Corpora",
			"Viman Marketing",
			"Virtual",
			"Visco Industrial Sales",
			"VM Paras Construction",
			"VR2 Builders",
			"VSE Hollow blocks/E. Emata",
			"Water Nature",
			"WATER SYSTEMS",
			"WBC",
			"Wellnon Enterprises",
			"Wesley's Marble & Gen. Merchandise",
			"Wesleys Marble & Gen. Merchan",
			"WESSELINK",
			"Westbridge",
			"Wheel Gallery",
			"Wiena Calibration Service Cent",
			"William Enterprises",
			"Wireless",
			"Wirtgen",
			"Wirtgen Phils.",
			"Xavier Estates Homeowners Assoc.",
			"Xavier Sports",
			"Xavier University",
			"Xehai Interest",
			"Zambo Warehse",
			"Zamed Enterprises",
			"Zeph Auto Parts",
		);
		$tick = false;
		for ($i=0; $i < sizeof($dictionary); $i++) { 
			if (substr_count($holder, $dictionary[$i]) > 0) {
				$tick = true;
				break;
			}
		}
		return $tick;
	}
}