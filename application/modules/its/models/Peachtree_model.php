<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Peachtree_model extends CI_Model{

	public function insertAddress($info){
		$this->db->insert('address', $info);
		return $this->db->insert_id();
	}

	public function insertAPRetitlingLot($info){
		$this->db->insert('peachtree_apretitlinglot', $info);
	}

	public function insertClient($info){
		$this->db->insert('client', $info);
	}

	public function insertContact($info){
		$this->db->insert('contact', $info);
		return $this->db->insert_id();
	}

	public function insertPerson($info){
		$this->db->insert('person', $info);
		return $this->db->insert_id();
	}

	public function insertCashDisbursementJournal($info){
		$this->db->insert('peachtree_cashdisbursementjournal', $info);
	}

	public function insertCashReceiptsJournal($info){
		$this->db->insert('peachtree_cashreceiptsjournal', $info);
	}

	public function insertCheckRegister($info){
		$this->db->insert('peachtree_checkregister', $info);
	}

	public function insertCIBUBP($info){
		$this->db->insert('peachtree_cibubp', $info);
	}

	public function insertCustomer($info){
		$this->db->insert('customer', $info);
		return $this->db->insert_id();
	}

	public function insertCustomerAccount($info){
		$this->db->insert('customer_account', $info);
	}

	public function insertCustomerLedger($info){
		$this->db->insert('peachtree_customerledger', $info);
	}

	public function insertEWT($info){
		$this->db->insert('peachtree_ewt', $info);
	}

	public function insertFixedAssets($info){
		$this->db->insert('peachtree_fixedassets', $info);
	}

	public function insertGeneralJournal($info){
		$this->db->insert('peachtree_generaljournal', $info);
	}

	public function insertGeneralLedger($info){
		$this->db->insert('peachtree_generalledger', $info);
	}

	public function insertGLManilaOffice($info){
		$this->db->insert('peachtree_glmanilaoffice', $info);
	}

	public function insertInvoiceRegister($info){
		$this->db->insert('peachtree_invoiceregister', $info);
	}

	public function insertOrganization($info){
		$this->db->insert('organization', $info);
		return $this->db->insert_id();
	}

	public function insertOrganizationAccount($info){
		$this->db->insert('organization_account', $info);
	}

	public function insertOrganizationAddress($info){
		$this->db->insert('organization_address', $info);
	}

	public function insertOrganizationContact($info){
		$this->db->insert('organization_contact', $info);
	}

	public function insertPurchaseJournal($info){
		$this->db->insert('peachtree_purchasejournal', $info);
	}

	public function insertReceiptList($info){
		$this->db->insert('peachtree_receiptlist', $info);
	}

	public function insertSalesInvoice($info){
		$this->db->insert('peachtree_salesinvoice', $info);
	}

	public function insertSalesJournal($info){
		$this->db->insert('peachtree_salesjournal', $info);
	}

	public function insertSupplier($info){
		$this->db->insert('supplier', $info);
	}

	public function insertTransactionReport($info){
		$this->db->insert('peachtree_transactionreport', $info);
	}

	public function insertVendorLedger($info){
		$this->db->insert('peachtree_vendorledger', $info);
	}

	public function insertVendorList($info){
		$this->db->insert('peachtree_vendorlist', $info);
	}

	public function updateClient($info, $clientid){
		$this->db->where('client_id', $clientid);
		$this->db->update('client', $info);
	}

	public function updatePerson($info, $personid){
		$this->db->where('person_id', $personid);
		$this->db->update('person', $info);
	}

	public function findOrganizationByName($name){
		$query = $this->db->select('*')
			->from('organization')
			->where('organization_name', $name)
			->get();
		if ($query->num_rows() > 0) {
			return $query->first_row('array');
		} else {
			return false;
		}
	}

	public function findOrganizationAccount($organizationid, $account){
		$query = $this->db->select('*')
			->from('organization_account')
			->where(array('organization_id' => $organizationid, 'account' => $account) )
			->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function findOrganizationAddress($organizationid){
		$query = $this->db->select('*')
			->from('organization_address')
			->where('organization_id', $organizationid)
			->get();
		if ($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function findOrganizationContactByValue($organizationid, $contactvalue){
		$query = $this->db->select('*')
			->from('organization_contact')
			->join('contact','contact.contact_id = organization_contact.contact_id')
			->where(array('organization_contact.organization_id' => $organizationid, 
										'contact.contact_value' => $contactvalue, 
										'organization_contact.status_id' => 1, 
										'contact.status_id' => 1))
			->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function findPerson($last, $first){
		$query = $this->db->select('*')
			->from('person')
			->where(array('lastname' => $last, 'firstname' => $first))
			->get();
		if ($query->num_rows() > 0) {
			return $query->first_row('array');
		} else {
			return false;
		}
	} 

	public function findCustomer($personid){
		$query = $this->db->select('*')
			->from('customer')
			->where('person_id', $personid)
			->get();
		if ($query->num_rows() > 0) {
			return $query->first_row('array');
		} else {
			return false;
		}
	}

	public function findCustomerAccount($personid, $account){
		$query = $this->db->select('*')
			->from('customer_account')
			->where(array('person_id' => $personid, 'account' => $account))
			->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function findClient($referenceid, $typeid){
		$query = $this->db->select('*')
			->from('client')
			->where(array('client_type_id' => $typeid, 'reference_id' => $referenceid))
			->get();
		if ($query->num_rows() > 0) {
			return $query->first_row('array');
		} else {
			return false;
		}
	}

	public function findSupplier($typeid, $referenceid){
		$query = $this->db->select('*')
			->from('supplier')
			->where(array('client_type_id' => $typeid,
										'reference_id' => $referenceid,
										'status_id' => 1))
			->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function getAPRetitlingLotTemp(){
		return $this->db->get('peachtree_apretitlinglottemp')->result_array();
	}

	public function getRetitlingLots($start, $end){
		return $this->db->where(array('ap_date >=' => $start, 'ap_date <=' => $end))->get('peachtree_apretitlinglot');
	}

	public function getCustomers(){
		return $this->db->get('peachtree_customer');
	}

	public function getCustomerLedgerTemp(){
		return $this->db->get('peachtree_customerledgertemp')->result_array();
	}

	public function getCashDisbursementJournals($start, $end){
		return $this->db->where(array('cdj_date >=' => $start, 'cdj_date <=' => $end))->get('peachtree_cashdisbursementjournal');
	}

	public function getCashDisbursementJournalTemp(){
		return $this->db->get('peachtree_cashdisbursementjournaltemp')->result_array();
	}

	public function getCashReceiptsJournals($start, $end){
		if ($start and $end) {
			return $this->db->where(array('crj_date >=' => $start, 'crj_date <=' => $end))->get('peachtree_cashreceiptsjournal');
		} else {
			return $this->db->get('peachtree_cashreceiptsjournal');
		}
	}

	public function getCashReceiptsJournalTemp(){
		return $this->db->get('peachtree_cashreceiptsjournaltemp')->result_array();
	}

	public function getCheckRegisters($start, $end){
		return $this->db->where(array('cr_date >=' => $start, 'cr_date <=' => $end))->get('peachtree_checkregister');
	}

	public function getCheckRegisterTemp(){
		return $this->db->get('peachtree_checkregistertemp')->result_array();
	}

	public function getCIBUBP($start, $end){
		return $this->db->where(array('cib_date >=' => $start, 'cib_date <=' => $end))->get('peachtree_cibubp');
	}

	public function getCIBUBPTemp(){
		return $this->db->get('peachtree_cibubptemp')->result_array();
	}

	public function getEWT($start, $end){
		return $this->db->where(array('ewt_date >=' => $start, 'ewt_date <=' => $end))->get('peachtree_ewt');
	}

	public function getEWTTemp(){
		return $this->db->get('peachtree_ewttemp')->result_array();
	}

	public function getFixedAssets($start, $end){
		return $this->db->where(array('fa_date >=' => $start, 'fa_date <=' => $end))->get('peachtree_fixedassets');
	}

	public function getFixedAssetsTemp(){
		return $this->db->get('peachtree_fixedassetstemp')->result_array();
	}

	public function getGeneralJournals($start, $end){
		return $this->db->where(array('gj_date >=' => $start, 'gj_date <=' => $end))->get('peachtree_generaljournal');
	}

	public function getGeneralJournalTemp(){
		return $this->db->get('peachtree_generaljournaltemp')->result_array();
	}

	public function getGeneralLedger($start, $end){
		return $this->db->where(array('gl_date >=' => $start, 'gl_date <=' => $end))->get('peachtree_generalledger');
	}

	public function getGeneralLedgerTemp(){
		return $this->db->get('peachtree_generalledgertemp')->result_array();
	}

	public function getGLManilaOffice($start, $end){
		return $this->db->where(array('gl_date >=' => $start, 'gl_date <=' => $end))->get('peachtree_glmanilaoffice');
	}

	public function getGLManilaOfficeTemp(){
		return $this->db->get('peachtree_glmanilaofficetemp')->result_array();
	}

	public function getInvoiceRegister($start, $end){
		return $this->db->where(array('ir_date >=' => $start, 'ir_date <=' => $end))->get('peachtree_invoiceregister');
	}

	public function getInvoiceRegisterTemp(){
		return $this->db->get('peachtree_invoiceregistertemp')->result_array();
	}

	public function getPurchaseJournal($start, $end){
		return $this->db->where(array('pj_date >=' => $start, 'pj_date <=' => $end))->get('peachtree_purchasejournal');
	}

	public function getPurchaseJournalTemp(){
		return $this->db->get('peachtree_purchasejournaltemp')->result_array();
	}

	public function getReceiptList($start, $end){
		return $this->db->where(array('rl_date >=' => $start, 'rl_date <=' => $end))->get('peachtree_receiptlist');
	}

	public function getReceiptListTemp(){
		return $this->db->get('peachtree_receiptlisttemp')->result_array();
	}

	public function getSalesInvoice($start, $end){
		return $this->db->where(array('si_date >=' => $start, 'si_date <=' => $end))->get('peachtree_salesinvoice');
	}

	public function getSalesInvoiceTemp(){
		return $this->db->get('peachtree_salesinvoicetemp')->result_array();
	}

	public function getSalesJournal($start, $end){
		return $this->db->where(array('sj_date >=' => $start, 'sj_date <=' => $end))->get('peachtree_salesjournal');
	}

	public function getSalesJournalTemp(){
		return $this->db->get('peachtree_salesjournaltemp')->result_array();
	}

	public function getTransactionReport($start, $end){
		return $this->db->where(array('tr_date >=' => $start, 'tr_date <=' => $end))->get('peachtree_transactionreport');
	}

	public function getTransactionReportTemp(){
		return $this->db->get('peachtree_transactionreporttemp')->result_array();
	}

	public function getVendorLedger($start, $end){
		return $this->db->where(array('vl_date >=' => $start, 'vl_date <=' => $end))->get('peachtree_vendorledger');
	}

	public function getVendorLedgerTemp(){
		return $this->db->get('peachtree_vendorledgertemp')->result_array();
	}

	public function getVendors(){
		return $this->db->get('peachtree_vendorlist');
	}

	public function getVendorListTemp(){
		return $this->db->get('peachtree_vendorlisttemp')->result_array();
	}

	public function countRecords($table){
		$result = $this->db->select('*')
			->from($table)
			->count_all_results();
		return $result;
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
			"Audit Adjustment",
			"Adjustment",
			"Adjustments -",
			"Acc. Cost of CIP",
			"B. Park-",
			"B. Park/Site Dev",
			"Bank Charges",
			"BDO- Opening of ee's atm",
			"CIP -",
			"Cost of Ins Sales",
			"Cost of Inst.",
			"Directors",
			"Equipment Operator",
			"Find",
			"From CAINTA",
			"General Acct",
			"Head Office",
			"Inv. in RE-",
			"Manila Office",
			"Misposting",
			"Others",
			"P1-",
			"P2-",
			"P3 -",
			"P4-",
			"Prepaid Rent",
			"Pumphouse",
			"Refundable Dep",
			"Suppliers",
			"Temporary",
			"Various Contractors",
			"Xavierville Houses",
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

	public function checkCompany($holder){
		$dictionary = array(
			"22 Karats Printing",
			"3 J Marketing",
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
			"ABS General Merchandise",
			"Ace De Oro Commercial",
			"Ace Hardware",
			"ACS MANUFACTURING CORP",
			"ADNET SIGNS Advertising",
			"Adonis Security",
			"Advance Prosoft Computer",
			"Aeronics Incorporated",
			"After Six Tailoring",
			"Agusan del Norte Elect",
			"Agway Chemicals",
			"AJ Wood Products",
			"Aldiz Multi Service",
			"Alfe Commercial",
			"Alfonso Sia Marketing",
			"Aliw Broadcasting Corp",
			"All Just Forms",
			"Alliance Builders Management",
			"Allison Trading",
			"Alpha Engineering Works",
			"Alpha Pools",
			"Alora House",
			"ALSJEM Construction",
			"ALSJEM Devt.",
			"Amzen Industries",
			"ANCO Merchandising",
			"Angeles Ranch",
			"Angeles Shell Station",
			"Anya Equipment Parts",
			"Aqua Haus",
			"ARA Industrial Supply",
			"Ardent Builders",
			"Arujville Realty Corp",
			"Asia International",
			"Asia Philippine",
			"Asian Pacific",
			"Atlantic Computer Center",
			"ATOP Design",
			"AUC Gasoline Station",
			"Auto Brands",
			"Automo Display Center",
			"AVL Industrial Sales",
			"AVP Trading and Construction",
			"B G C Builders",
			"B4M Marketing",
			"Bacphil Planters Fertilizers",
			"Banco de Oro",
			"Bank of Philippine Island",
			"Bayan Telecommunications",
			"Begul Builders",
			"Beguls Builders",
			"Belcars Auto Parts",
			"Ben Ben Welding Shop",
			"Ben Dy Machine Shop",
			"Beta Industrial Sales",
			"Big Wave Advertising",
			"BIR",
			"BME Partners",
			"Bordeos Heavy Equip. Parts Center",
			"BP & Co",
			"BPI Family Savings Bank",
			"Brown Resources Corp",
			"Brownman Advertising",
			"Business Machines Corp.",
			"Business Park",
			"Butuan Champion Hardware",
			"Butuan Mega Const. Supply",
			"C D O",
			"C E P A L C O",
			"C. Puertas Enterprises",
			"C&G Refrigeration & Airconditioning",
			"Cabadbaran Concrete Products",
			"Cabangca & Sons Ent",
			"Cabezas Pest Cont",
			"Cagayan Balita Marketing",
			"Cagayan de Oro Hardware",
			"Cagayan De Oro Hydraulics",
			"Cagayan de Oro Timber",
			"Cagayan De Oro Water District",
			"Cagayan Educational Supply",
			"Cagayan Goodrich Marketing",
			"Cagayan Isuzu Center",
			"Cagayan Jaycolor Place",
			"Cagayan Regent Furnishing",
			"Cagayan Swani Hardware",
			"Capears Marketing",
			"Carmen Isuzu Parts",
			"Carmen Lumber Trading",
			"Carrant Realty",
			"Castro Heavy Metal Equip",
			"CDO Brokers & Associates",
			"CDO Electrocare & Supply",
			"CDO Hydraulics",
			"Cebu Hydraulic",
			"Cebu Southern Motors, Inc.",
			"Cebu Titan Surplus",
			"CECA Engineering Services",
			"Ceca Engineering",
			"CEPALCO",
			"Chamber of Real Estate",
			"Chee Realty",
			"Chemtrust Industrial",
			"China Bank Corp",
			"Citi Motors",
			"City Ads",
			"City Treasurer's Office",
			"CJ Architects",
			"Classic Style",
			"Classic Wood Products",
			"Coins General Merchandise",
			"Colent Diversified Products",
			"Columbia Computer Center",
			"Comglasco Aguila Glass Corp",
			"Commercial Area -Xavier Heights",
			"Compstream Sales",
			"Conarch Construction",
			"Consolidated Broadcasting System",
			"Constech Asia Corporation",
			"Continental Diesel Parts",
			"Cool Knight",
			"Copylandia Office System",
			"Corpus Christi",
			"Crear'E Couture",
			"Create One Cons.",
			"CRM Digitech Prints",
			"Crown Paper & Stationer",
			"Cut 'N Style Iron",
			"Cygnus Construction",
			"Dal Arms Sports House",
			"Danster General Mechandise",
			"DARL AGRICULTURAL",
			"Dataworld Computer Center",
			"Davao Citi Hardware",
			"Davao Citihardware",
			"DDIS, Inc.",
			"Dela Torre & Co.",
			"De Oro Bayanihan",
			"De Oro Construction",
			"De Oro Glass",
			"De Oro Lotus",
			"De Oro Maramag",
			"De Oro Pacific",
			"De Oro THT Trading",
			"De Oro Trapal",
			"Dept. of Science & Technology",
			"Denki Electric Corporation",
			"Design Setter Construction",
			"Desmark",
			"Digi-Kaden, Inc.",
			"DJJ Surplus",
			"DMT Marketing",
			"DN Steel",
			"Do It PrintShoppe",
			"Donna Sign & Printing",
			"Doongan Solid Transport",
			"Dulfer Lending Service",
			"Dyteban Hardware & Auto Supply",
			"E & V General Merchandise",
			"E.C.E. Construction & Supply",
			"Eagle Equipment Co",
			"East West Seed",
			"EBC Electronics & Communication Center",
			"Economic Briefing",
			"EduChild",
			"Efco Philippines",
			"El Elyon Shell Service Station",
			"ELC Equipment Parts, Inc.",
			"ElectroPro Mktg.",
			"ElectroWorld Office Systems",
			"Elmar Marketing",
			"Enterprise Holdings",
			"Envisage Security Agency, Inc.",
			"Eon Computer Center",
			"EON Computer Center",
			"Epic",
			"Excellent Parts & Industrial Mktg",
			"F.P. Carreon Construction",
			"Family Congress",
			"Fargo Motor Parts",
			"Fast Autoworld Phils.",
			"Fergo Printing Service",
			"FG Ever, Inc.",
			"FGBMFI-Butuan City",
			"FGW Construction",
			"FIBECO Inc.",
			"Fil Conveyor Components",
			"FIL Trading", 
			"FIRST BUKIDNON ELECTRIC",
			"Flowcrete Const. Equip",
			"Forest Park - Palm Oil",
			"Footprints Award Centrum",
			"FP Carreon Construction",
			"Freeway Tire Center",
			"Freeway Tires Center",
			"Full Throttle Accessories Center",
			"G & P Builders",
			"G! ATV Motors Sales & Rental",
			"Gargar",
			"Gail's Tailors",
			"Gails Tailors and Design",
			"Gails' Tailors & Design",
			"Gaisano Interpace",
			"GAITS",
			"Galili Machine Shop",
			"GCL Enterprises",
			"Gendiesel Philippines",
			"Geoex Farm",
			"Geoex Holdings",
			"GG Giant Hardware",
			"Glainier Industrial Corp",
			"Globalchips Technologies",
			"Globatronics Marketing",
			"Globe Telecom",
			"Go To Surplus, Inc.",
			"Goldcrest Marketing",
			"Golden Cars Service Center",
			"Golden Dragon Metal Products",
			"Golden Edge",
			"Golden Pebbles Devt Corp",
			"Golden Tire Supply",
			"Golden Transport Surplus",
			"Goldstar Daily",
			"Goldtown Industrial Sales",
			"Goodmorning Int'l Corp.",
			"Goodwish Enterprise",
			"Gordiel Auto Parts",
			"Gotesco Marketing",
			"Gotil Realty Corp",
			"Grand C Graphics",
			"Grand Glazing Center",
			"Grand Machinery Works",
			"Grandblocks Enterprises",
			"Grantman Industrial Corp.",
			"Graphic All In Store",
			"Grasco Trading Co.,",
			"Greencars Mindanao Corp.",
			"Greenmix Farm & Garden",
			"GT Go Enterprises",
			"GT Realty Corp.",
			"GTS Construction Supply",
			"Guill-Bern Corporation",
			"H & C Builders",
			"H. S. A.",
			"Halasan Surveying Office",
			"Handy Do It Center",
			"Harvest Field Rice Trading",
			"HDMF",
			"HEMO",
			"Herohito MD Store",
			"Hexagon Bolt",
			"HNH Builders & Enterprises",
			"Hi-Tek Paint",
			"Higala Foundation",
			"Hirayama Trading",
			"Hoc Siu Marketing",
			"Home Development Mutual Fund",
			"Hotel",
			"Housing & Land Use Regulatory Board",
			"I Click Digishop Corp.",
			"IC Marketing",
			"Idol's Auto Repair",
			"Ilaya Coco Lumber & Construction Supply",
			"Ink Now! Corp.",
			"Innove Communications, Inc.",
			"Insular Life Assurance Co.",
			"Integrated Electrical Control",
			"Interlock Sales",
			"Interpace Computer System",
			"Interserve",
			"Isalama Industries, Inc.",
			"ISALAMA Industries",
			"J & M Petron Service",
			"J. E. T. Hardware",
			"J. E. Machine Shop",
			"J. Eguia Machine Shop",
			"J.B. & Sons Equipment",
			"J.E Auto Parts",
			"J.E.T. Hardware",
			"Jacka Enterprises",
			"Jacsons Ent",
			"Janette Agri-Supply Dealer",
			"Japnar Trak Corp.",
			"Jarex Ind. Sales",
			"JAS Trading & Gen.",
			"Jay Builders",
			"JCA Realty",
			"JDE Construction",
			"JFG Tech",
			"JG Construction",
			"JGG PestMaster",
			"Jhaymart Industries",
			"Jhaymarts Industries",
			"Jimar Construction",
			"Jimwen Construction",
			"JMDC Const",
			"Jobstreet.com Philippines, Inc.",
			"Jodaca Marketing",
			"Joe Cars Auto Repair Shop",
			"Joesons Commercial Co.",
			"John Offset Press",
			"JRA Surplus & Parts Supply",
			"JT Surplus Parts Center",
			"Juliano Automotive Repair Shop",
			"Juswin Trade & Automotive Services",
			"JVAN Steel Works",
			"JVS Audio",
			"JVS AUDIO SYSTEM",
			"KAISA Cooperative",
			"Kaking Import & Export Co.",
			"KASAMA KA",
			"Kimwa Construction",
			"King Sun Enterprises",
			"Kopya de Oro Services",
			"KRA Marketing",
			"Krypton Industrial Resources",
			"Kupler DCMC Phils",
			"Kwik Way Engineering Works",
			"L & B Concrete Products",
			"La Victoria Grocery",
			"Land Asia",
			"Land Bank of the Phil.",
			"LBL Traffic Control",
			"LCG Marketing",
			"Legacy Sales & Printing",
			"Levi Printing Press",
			"Life Auto Supply",
			"Lilibeth Couture",
			"Livan Trade Corporation",
			"LJMA Phoenix Gas Station",
			"LKKS & Milling",
			"Local Government Unit",
			"Louin Industrial Sales",
			"Loyola Plans Consolidated",
			"LT Datu",
			"Longhapros Marketing",
			"Lonucan Agri. Corp",
			"Lower Balulang",
			"Lucky Seven",
			"LYL Development Corporation",
			"M. & Jr. Enterprises",
			"M.L. Cabanducos Iron Works",
			"Ma. Cristina Agro Trading",
			"Mabuhay Vinyl Corp",
			"Mackun Marketing",
			"Madison Shopping Plaza",
			"Magnet Advertising",
			"Magnet Motors Corporation",
			"Makati Foundry Inc",
			"Maken Traders",
			"Man Stone Trading",
			"Management Asso. of the Phils",
			"Mandaue Foam Industries",
			"Mantrade Development Corp.",
			"MAPECON Phils",
			"Marga Glass Marketing",
			"Maxicare",
			"Maxima Machineries",
			"Meridian Assurance Corporation",
			"Meter King Inc.",
			"Metro Bank",
			"MF Auto Parts",
			"MICROPHASE CORPORATION",
			"Microtrade GCM Corp",
			"Microtronix Marketing Sales",
			"Microtronix Mktg. Sales",
			"Mindanao Ace Marketing",
			"Mindanao Development Bank",
			"Mindanao Leader Cable Supply",
			"Mindanao Oriental Builders",
			"Mindanao Precast Structures",
			"MinPalm Agricultural Co., Inc.",
			"Mitsubishi Motors",
			"MJ Lime & Gravel",
			"MLN Concrete",
			"MN Lluch Dev't Corp",
			"Modern Paints Center",
			"Monark Corporation",
			"Monark Equipment",
			"Monjab's Upholstery",
			"Monte Oro Resources & Energy Inc.",
			"MORESCO",
			"Motormate Merchand",
			"Motormate Merchandizing",
			"Motorworld Motorcycle Parts",
			"Mountain Pines Farm",
			"Multi-Artworkds",
			"Multi-Artworks",
			"Mustard Seed System Corp",
			"Nakeen Corp.",
			"National Book",
			"NAZCA Designs",
			"NB Iron Works",
			"Nissan Cagayan",
			"Nissan CDO Distributors",
			"NIZA Builders",
			"NKAC",
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
			"Oliver D. Pe Benito Const",
			"Ommix Concrete Construction",
			"Opal Auto Parts",
			"Oro Autofix",
			"Oro Graphic",
			"Oro Hi-Speed",
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
			"Palm Concepcion Power Corp.",
			"Palm Conception Power Corp.",
			"PBJ Corporation",
			"PC Chain Superstore",
			"People's Agri Service",
			"People's Parts",
			"Phigold Metallic Ore Inc.",
			"Phil. Belt Manufacturing Corp.",
			"Phil. Health Insurance Corp",
			"PHIL. SPAN ASIA CARRIER CORP.",
			"Phil. Span Asia Carrier",
			"Phil. valve Manufacturing",
			"Philcopy Corporation",
			"Philippine Belt",
			"Philpipes Corporation",
			"PHILRES - Mis. Or.",
			"Philtyres Corporation",
			"PHILEX",
			"PJ Glass Supply",
			"Picture City",
			"Pinnacle Engineering",
			"Pioneer Insurance",
			"Pioneer Refrigeration",
			"Pisa-an Memorial Gar",
			"PLDT-Philcom, Inc.",
			"PNB Trust Banking Group",
			"Power Heavy Parts",
			"Primadera",
			"Prime Event",
			"Progress Marketing",
			"Prov. Treasurer's Off. - Bukidnon",
			"Provident Insurance",
			"PSB Enterprise",
			"Pueblo de Oro",
			"Quality Appliance Plaza",
			"Quicktronic Enterprises",
			"Quinto Construction",
			"R. G. Sand",
			"Rachelle's Dress Shop",
			"Raf Raf Auto Surplus",
			"Rajah Bagani Protective Agency",
			"Rajah Bagani Security Agency, Inc.",
			"Ramon Rodriguez Const.",
			"RAQ Enterprises",
			"RAS Carpets Enterprises",
			"Rasa Prema",
			"RCCA Glass",
			"RCJ Engineering",
			"RCW Construction",
			"RDV Agro Industrial",
			"Red Star Aggregates",
			"Regent Furnishing",
			"Registry of Deeds",
			"Remantec Corporation",
			"Remantic Corporation",
			"Republic Courier Service",
			"Resort Sports Equipment (RSE)",
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
			"Roadstar Auto Supply",
			"Robbin's Auto Parts",
			"Robins Home Depot",
			"Robinson's Handyman",
			"Rock Builders",
			"ROG Construction & Supplies",
			"Ronwood Construction",
			"Rosevale School",
			"Roy Cool Air",
			"Rufina Marketing",
			"S.E.F Concrete Products",
			"Saarenas Construction Supply",
			"Safevue Glass Enterprises",
			"Saguittarius Security Agency",
			"Sameah Travel & Tours",
			"Samuel Auto Repair",
			"San Jose Concrete Aggregates",
			"San Pascual",
			"Sanitary Care Products",
			"SBG Construction",
			"SB Marketing",
			"Service Partners",
			"SGS Vehicle Assembler",
			"Sharp Electrical Supply",
			"Shejan Construction",
			"Shellac Petrol Corp.",
			"Siccion Marketing",
			"Sign Head Graphics Advertising",
			"Silicon Electrical Supply",
			"Simplex Industrial Corporation",
			"Smart Communications",
			"Smart Tech Industrial",
			"SMCB3 construction & services",
			"SMCB3 Construction",
			"SMCB3 Enterprises",
			"Social Security System",
			"Solaris Gas Service",
			"Solid Shipping Lines",
			"Soriano Law Office",
			"South Milandia Inc.",
			"Southern Electrical Supply",
			"Spot Wireless Systems",
			"Square Deal Enterprises",
			"St. Justine Realty",
			"Star Appliance Center",
			"Starpons Enterprises",
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
			"Survey Tech Trading",
			"Tabada Concrete Products",
			"Tagbagani Security",
			"TCGI, Inc",
			"TDM Motorcycle Parts",
			"TDX Builders",
			"Techno Mart Computer",
			"Techno-Stress",
			"Techno-Trade",
			"Techno-trade Resources",
			"Telow and Company",
			"Terra Asia",
			"Textar Sales Corporation",
			"Toyota Cagayan de Oro",
			"Toyota Makati",
			"Top Lifegear Marketing",
			"Toto's Surplus Center",
			"Tourism Promotions Board",
			"Transway Sales Corporation",
			"TRANSWAY SALES CORPORATION",
			"Tri-J & Enterprises",
			"Tri-Star Paints Center",
			"Tripocap Trading",
			"Trix Offroad Car Accessories",
			"Trixoffroad Accessories",
			"Tromech Industrial Sales & Services",
			"Trusses",
			"UCPBank",
			"Ultimate Bivouac",
			"Ultracraft Advertising Corp",
			"Uni Offroad Ventures Corp",
			"Union Galvasteel Corp",
			"United Auctioneers Inc",
			"United Bearing Industrial Sales",
			"United Coconut Planters",
			"UP Marketing",
			"Valencia City Water District",
			"Valencia Goodwill Commercial",
			"Vazquez Building Systems",
			"Velez Property",
			"VIC Imperial Appliance Corporation",
			"Viman Marketing",
			"Visco Industrial Sales",
			"VM Paras Construction",
			"VR2 Builders",
			"VSE Hollow blocks/E. Emata",
			"Water Nature",
			"WBC",
			"Wellnon Enterprises",
			"Wesley's Marble & Gen. Merchandise",
			"Westbridge",
			"Wheel Gallery",
			"Wiena Calibration Service Center",
			"William Enterprises",
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