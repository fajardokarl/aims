<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Marketing extends CI_Controller {

	private $data = array();

	  function __construct(){
        // Construct the parent class
        parent::__construct();

        $this->load->model('Dashboard_model','dashboards');
        $this->load->model('Customer_model','customer');
        // model init for 'Logs'
        $this->load->model('logs/Logs_model', 'logs');
        // model init for 'Users'
        $this->load->model('users/Users_model','users');

        $this->load->helper(array('form', 'url'));

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['navigation'] = 'marketing/navigation';
        $this->data['customjs'] = 'marketing/customjs';
        $this->data['customcss'] = 'marketing/customcss';

    }
 
	public function index(){
		$this->data['content'] = 'dashboard';
        $this->data['page_title'] = 'Sales and Marketing';
        $this->data['reserve_amount'] = $this->dashboards->reservationfees_total();
        $this->data['reserve_count'] = $this->dashboards->reserve_count();
        $this->data['customer_count'] = $this->dashboards->customer_count();
        $this->data['agent_count'] = $this->dashboards->agent_count();
        $this->data['reserve_activity'] = $this->dashboards->reservations_activity();
        $this->data['top_agents'] = $this->dashboards->top_agents();
        $this->data['customjs'] = 'dashboardjs';
		$this->load->view('default/index', $this->data);     
	}

	public function customerslist(){
		//$data['customcss'] = 'marketing/customcss';
    	$this->data['content'] = 'customer_info';
        $this->data['page_title'] = 'Sales and Marketing';
        $this->data['customjs'] = 'marketing/customerjs';
		$this->data['customer'] = $this->customer->get_customers();
		$this->data['allcity'] = $this->customer->getAllCity();
		$this->data['addtype'] = $this->customer->getAddressType();
		$this->data['addcountry'] = $this->customer->getAllCountry();
		$this->data['allprovince'] = $this->customer->getAllProvince();
		$this->data['lots_available'] = $this->customer->getAllAvailableLots();


		$this->load->view('default/index', $this->data);
    }


	public function lots(){
		$this->data['content'] = 'lots';
		$this->data['page_title'] = 'Sales and Marketing';
		$this->data['all_project'] = $this->customer->retrieve_all_project();
		$this->data['lots'] = $this->customer->retrieve_project_byid_model(1);
        $this->data['customjs'] = 'marketing/lotjs';

		$this->load->view('default/index', $this->data);
	}

	public function get_one_lot(){
		$lot_id = $this->input->post('lot_id');
		$lots = $this->customer->get_lot($lot_id);
		echo json_encode($lots);
	}
	public function update_lot(){
		$lot_id = $this->input->post('lot_id');
		$data = array(
			'price_per_sqr_meter' => $this->input->post('price_p_sqm'),
			'house_price' => $this->input->post('house_price'),
			'lot_vat' => $this->input->post('lot_vat')
			
			);
		$data2 = array(
				'tct_no' => $this->input->post('tct'),
				'tax_declaration_no' => $this->input->post('tax_dec_no'),
				'cor_no' => $this->input->post('cor_no'),
				'lot_area' => $this->input->post('lot_area'),
			);
		$lot_update = $this->customer->update_lot_model($lot_id,$data,$data2);


		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'update',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " updated Lot ID " . $lot_id
        );
        $this->logs->log($log_entry);

		echo json_encode($lot_update);
	}

	
	public function listingReservation(){
      	$this->data['content'] = 'listingReservation';
		$this->data['page_title'] = 'Sales and Marketing';
		$this->data['lots_available'] = $this->customer->getAllAvailableLots();
		$this->data['all_project'] = $this->customer->retrieve_all_project();
		// $this->data['all_projects'] = $this->customer->retrieve_all_employee();
		// $this->data['all_employeer'] = $this->customer->retrieve_all_employeer();
		$this->data['customer'] = $this->customer->get_customers();
        // $this->data['customjs'] = 'marketing/reservationjs';

		$this->load->view('default/index', $this->data);
        $this->session->unset_userdata('client_id_ses');
	}



	public function reservationAgreement(){
		$clientid = $this->input->get('clientid');
		$lot = $this->input->get('lotid');
		$name = $this->customer->get_name_model($clientid);
		$project_id = $this->customer->get_projectid_model($lot);

		$this->data['client_id'] = $clientid;
		$this->data['client_name'] = $name->firstname . ', ' . $name->lastname;

		$this->data['client'] = $this->customer->getOnePerson($clientid);
		$this->data['one_lot'] = $this->customer->getOneAvailableLots($lot);
		$this->data['customer'] = $this->customer->get_customers();
		$this->data['person'] = $this->customer->get_persons();
		$this->data['lots_available'] = $this->customer->getAllAvailableLots();
		$this->data['payment_scheme'] = $this->customer->getPaymentScheme($project_id);
		$this->data['banklist'] = $this->customer->getBankList();
		$this->data['finance_types'] = $this->customer->finance_type_model();
		$this->data['allcity'] = $this->customer->getAllCity();
		$this->data['addtype'] = $this->customer->getAddressType();
		$this->data['addcountry'] = $this->customer->getAllCountry();
		$this->data['allprovince'] = $this->customer->getAllProvince();
		$this->data['realty'] = $this->customer->get_realty_model();
		$this->data['brokers'] = $this->customer->getBrokers();
      	$this->data['content'] = 'reservationagreement';
		$this->data['page_title'] = 'Sales and Marketing';
        $this->data['customjs'] = 'marketing/reservationjs';
        
        $this->session->unset_userdata('client_id_ses');
		$this->load->view('default/index', $this->data);   


	}






















	// NEW CUSTOMER FORM ------------------------------------------ START

	public function save_new_customer(){
        $this->load->helper('date');

		$file_name = '';
		$client_id = '';
		$valid_id = '';
		$legal_id = '';
		$filipino_id = '';
		$consent_id = '';
		$selfemployed_id = '';

		$config['upload_path'] = './public/images/profiles/'; //public\images\profiles
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '900000';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('userfile')) {
			// echo $this->upload->display_errors();
			$file_name = '';
		}else{
			$data = $this->upload->data();
			$file_name = $data['file_name'];
		}

		$person = array(
			'lastname' => $this->input->post('cust_lname'),
			'firstname' => $this->input->post('cust_fname'),
			'middlename' => $this->input->post('cust_mname'),
			'sex' => $this->input->post('cust_gender'),
			'birthdate' => $this->input->post('cust_birthdate'),
			'birthplace' => $this->input->post('cust_birthplace'),
			'nationality' => $this->input->post('cust_nationality'),
			'profession' => $this->input->post('cust_profession'),
			'civil_status_id' => $this->input->post('cust_civil'),
			'tin' => $this->input->post('cust_tin'),
			'picture_url' => $file_name,
		);
		$person_id = $this->customer->insert_person_model($person);

		$client = array(
			'client_type_id' => 1,
			'reference_id' => $person_id,
			'date_created' => date('Y-m-d',now()),
			'status_id' => 1
		);
		$client_id = $this->customer->insert_client_model($client);


    // ADDRESS
		$pre_address = array(
			'line_1' => $this->input->post('present_line_1'),
			'line_2' => $this->input->post('present_line_2'),
			'line_3' => $this->input->post('present_line_3'),
			'city_id' => $this->input->post('present_city'),
			'province_id' => $this->input->post('present_province'),
			'country_id' => $this->input->post('present_country'),
			'postal_code' => $this->input->post('present_postalcode'),
			'stay_length' => $this->input->post('present_lengthofstay'),
			'address_type_id' => 3
     	);
		$pre_addr = $this->customer->insert_address_model($pre_address);

		$pre_person_addr = array(
			'person_id' => $person_id,
			'address_id' => $pre_addr,
			'status_id' =>1
		);
		$this->customer->insert_personaddress_model($pre_person_addr);


		$per_address = array(
			'line_1' => $this->input->post('permanent_line_1'),
			'line_2' => $this->input->post('permanent_line_2'),
			'line_3' => $this->input->post('permanent_line_3'),
			'city_id' => $this->input->post('permanent_city'),
			'province_id' => $this->input->post('permanent_province'),
			'country_id' => $this->input->post('permanent_country'),
			'postal_code' => $this->input->post('permanent_postalcode'),
			'stay_length' => $this->input->post('permanent_lengthofstay'),
			'address_type_id' => 4
     	);
		$per_addr = $this->customer->insert_address_model($per_address);

		$per_person_addr = array(
			'person_id' => $person_id,
			'address_id' => $per_addr,
			'status_id' =>1
		);
		$this->customer->insert_personaddress_model($per_person_addr);


    // CONTACT
		$contact = array(
			'person_id' => $person_id,
			'residential_phone' => $this->input->post('cust_residential'), 
			'business_phone' => $this->input->post('cust_bphone'), 
			'mobile_phone' => $this->input->post('cust_mphone'), 
			'fax_no' => $this->input->post('cust_fax'), 
			'email' => $this->input->post('cust_email'), 
		);
		$this->customer->insert_contact_model($contact);
		

	// FUND
		foreach ($this->input->post('customer_source') as $key => $value) {
			$source = array(
				'client_id' => $client_id,
				'source_of_fund_id' => $value,
			);
			$this->customer->insert_clientfund_model($source);
		}


    // WORK
		$work_address = array(
			'line_1' => $this->input->post('permanent_line_1'),
			'line_2' => $this->input->post('permanent_line_2'),
			'line_3' => $this->input->post('permanent_line_3'),
			'city_id' => $this->input->post('permanent_city'),
			'province_id' => $this->input->post('permanent_province'),
			'country_id' => $this->input->post('permanent_country'),
			'postal_code' => $this->input->post('permanent_postalcode'),
			'stay_length' => $this->input->post('permanent_lengthofstay'),
			'address_type_id' => 2
     	);
		$work_addr_id = $this->customer->insert_address_model($work_address);

		$work = array(
			'employer_name' => $this->input->post('cust_employer'),
			'person_id' => $person_id,
			'address_id' => $work_addr_id,
			'occupation_id' => $this->input->post('cust_occupation'),
			'job_title' => $this->input->post('cust_job'),
			'monthly_gross_income' => $this->input->post('cust_gross')
		);
		$this->customer->insert_customerwork_model($work);




    // SPOUSE
		if ($this->input->post('has_spouse_val') == 1) {
			if (!$this->upload->do_upload('spouse_userfile')) {
				// echo $this->upload->display_errors();
				$spouse_file_name = '';
			}else{
				$data = $this->upload->data();
				$spouse_file_name = $data['file_name'];
			}

			$spouse_person = array(
				'lastname' => $this->input->post('spouse_lname'),
				'firstname' => $this->input->post('spouse_fname'),
				'middlename' => $this->input->post('spouse_mname'),
				'birthdate' => $this->input->post('spouse_birthdate'),
				'birthplace' => $this->input->post('spouse_birthplace'),
				'nationality' => $this->input->post('spouse_nationality'),
				'profession' => '',
				'civil_status_id' => $this->input->post('cust_civil'),
				'tin' => $this->input->post('spouse_tin'),
				'picture_url' => $spouse_file_name,

			);
			$spouse_person_id = $this->customer->insert_person_model($spouse_person);

			
			$spouse_contact = array(
				'person_id' => $spouse_person_id,
				'residential_phone' => $this->input->post('spouse_residential'), 
				'business_phone' => $this->input->post('spouse_bphone'), 
				'mobile_phone' => $this->input->post('spouse_mphone'), 
				'fax_no' => $this->input->post('spouse_fax'), 
				'email' => $this->input->post('spouse_email'), 
			);
			$this->customer->insert_contact_model($spouse_contact);
			
			$spouse_work_address = array(
				'line_1' => $this->input->post('spouse_line_1'),
				'line_2' => $this->input->post('spouse_line_2'),
				'line_3' => $this->input->post('spouse_line_3'),
				'city_id' => $this->input->post('spouse_city'),
				'province_id' => $this->input->post('spouse_province'),
				'country_id' => $this->input->post('spouse_country'),
				'postal_code' => $this->input->post('spouse_postalcode'),
				'stay_length' => '',
				'address_type_id' => 2
	     	);
			$spouse_work_addr_id = $this->customer->insert_address_model($spouse_work_address);

			$spouse_work = array(
				'employer_name' => $this->input->post('spouse_employer'),
				'person_id' => $spouse_person_id,
				'address_id' => $spouse_work_addr_id,
				'occupation_id' => '',
				'job_title' => $this->input->post('spouse_job'),
				'monthly_gross_income' => ''
			);
			$spouse_work = $this->customer->insert_customerwork_model($spouse_work);
			
			$spouse_partner = array(
				'client_id' => $client_id,
				'person_id' => $spouse_person_id,
				'customer_relation' => '',
				'status_id' => 1,
				'customer_work_id' => $spouse_work
			);
			$this->customer->insert_partner_model($spouse_partner);
		}
		
		foreach ($this->input->post('reference_fullname') as $i => $value) {
			$reference = array(
				'person_id' => $person_id,
				'reference_name' => $value,
				'address' => $this->input->post('reference_address')[$i],
				'relation' => $this->input->post('reference_relation')[$i],
				'contact_no' => $this->input->post('reference_tel')[$i],
			);
			$this->customer->insert_reference_model($reference);
		}

		$data = array( 
			'client_id' => $client_id,
			'file_id' => 1, // id in database.
			'upload_date' => date('Y-m-d',now())
		);
		$valid_id = $this->customer->insert_file_model($data); // FOR TWO VALID IDs

		if ($this->input->post('is_legal') == 0) {
			$data = array(
				'client_id' => $client_id,
				'file_id' => 4, // id in database.
				'upload_date' => date('Y-m-d',now())
			);
			$legal_id = $this->customer->insert_file_model($data); 
		}

		if ($this->input->post('is_filipino') == 0) {
			$data = array(
				'client_id' => $client_id,
				'file_id' => 2, // id in database.
				'upload_date' => date('Y-m-d',now())
			);
			$filipino_id = $this->customer->insert_file_model($data); 
		}

		// if ($this->input->post('is_consent') == 1) {
		// 	$data = array(
		// 		'client_id' => $client_id,
		// 		'file_id' => 3, // id in database.
		// 		'upload_date' => date('Y-m-d',now())
		// 	);
		// 	$consent_id = $this->customer->insert_file_model($data); 
		// }

		if ($this->input->post('is_selfemployed') == 1) {
			$data = array(
				'client_id' => $client_id,
				'file_id' => 5, // id in database.
				'upload_date' => date('Y-m-d',now())
			);
			$selfemployed_id = $this->customer->insert_file_model($data); 
		}

		$data_return = array(
			'client_id' => $client_id,
			'valid_id' => $valid_id,
			'legal_id' => $legal_id,
			'filipino_id' => $filipino_id,
			'consent_id' => $consent_id,
			'selfemployed_id' => $selfemployed_id
		);

		echo json_encode($data_return);

	}





	public function upload_file(){
		$req_id = $this->input->post('requirement_id');
		$client_id = $this->input->post('client_id');
		$file_name = '';

		$config['upload_path'] = './public/images/requirements/'; 
		$config['allowed_types'] = 'jpg|jpeg|png|pdf';
		$config['max_size'] = '9000000';
		$config['file_name'] = $client_id . '__' . $req_id;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('files')) {
			// echo $this->upload->display_errors();
			// echo json_encode($file_name);
			$file_name = 0;
		}else{
			$data = $this->upload->data();
			// echo json_encode($data['file_name']);
			$file_name = $data['file_name'];
			$id = $this->customer->update_file_model($req_id, array('document_filename' => $data['file_name']));
			echo json_encode($file_name);
		}
	}


	public function get_personaddress(){
		$datareturn = $this->customer->get_personaddress_model($this->input->post('person_id'));
      	echo json_encode($datareturn);
	}

	public function get_references(){
		$datareturn = $this->customer->get_references_model($this->input->post('person_id'));
      	echo json_encode($datareturn);
	}

	public function get_fundsource(){
		$datareturn = $this->customer->get_fundsource_model($this->input->post('clientid'));
      	echo json_encode($datareturn);
	}


	 // if($query !== FALSE && $query->num_rows() > 0){
	  //        $data = $query->row();
	 //    }
	 //    return $data;



	public function reservationagreement_pdf(){
    	$this->load->helper('date');
    	$this->load->library('Pdf');
		$pdf = new Pdf('L', 'in', 'MEMO', true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('ABCI');
		$pdf->SetTitle('Reservation Agreement');
		$pdf->SetSubject('Reservation Agreement');
		$pdf->SetKeywords('Reservation Agreement');

		// remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}


		// // $font_size = $pdf->pixelsToUnits('5');
	
		// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
		// ------------------------------------------------------------------------------------------------------------------------
        

		$contract_id = $this->input->get('id_contract');
		$contract = $this->customer->get_contract_model($contract_id);
		$spouse = $this->customer->get_partner_model($contract->client_id);
		$realty_info = $this->customer->get_salesperson_contract_model($contract_id);

		$spouse_last = isset($spouse->lastname) ? $spouse->lastname : "";
		$spouse_first = isset($spouse->firstname) ? $spouse->firstname : "";
		$spouse_middle = isset($spouse->middlename) ? $spouse->middlename : "";

		$realty_name = isset($realty_info->realty_name) ? $realty_info->realty_name : "";


		$reserve_fee = $contract->reservation_fee;
		$dp = ($contract->total_contract_price * ($contract->downpayment_ratio / 100)) - $contract->downpayment_discount;
		$dp = $dp - $contract->new_reserve_fee;
		$pdf->SetFont ('helvetica', '', 10 , 15, 'default', true );

        $pdf->AddPage();
        
		// $pdf->writeHTMLCell(180, '', '', '', "<h2>BROKER APPLICATION FORM</h2>", 0, 0, 0, true, 'C', false);

        // $pdf->writeHTMLCell(80, 6, '', '', '', 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(180, 6, '', '', '<font size="10"><strong>RESERVATION AGREEMENT,' .strtoupper($contract->project_description . ' - ' . $contract->phase_name) . '</strong></font>', 1, 0, 0, false, 'R', true);
        $pdf->Ln(8);
        $pdf->writeHTMLCell(80, 6, '', '', "BUYER'S NAME:", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(100, 6, '', '', '<font size="10">' . $contract->lastname . ', ' . $contract->firstname . ' ' . $contract->middlename . '</font>', 1, 0, 0, false, 'L', true);

        $pdf->Ln(8);
        $pdf->writeHTMLCell(180, 6, '', '', '<font size="8">I offer to buy a property in <strong>' . $contract->project_description . ' - ' . $contract->phase_name . '</strong>, Fr. Mastersons Ave., Upper Balulang, Cagayan de Oro City and hereby request that you reserve following property in my favor.</font>', 0, 0, 0, false, 'L', true);
        
        $pdf->Ln(8);
        $pdf->writeHTMLCell(20, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(50, 6, '', '', "<strong>BLOCK</strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(50, 6, '', '', '<font size="10">' . $contract->block_no . '</font>', 0, 0, 0, false, 'R', true);
        $pdf->Ln(6);
        $pdf->writeHTMLCell(20, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(50, 6, '', '', "<strong>LOT</strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(50, 6, '', '', '<font size="10">' . $contract->lot_no . '</font>', 0, 0, 0, false, 'R', true);
        $pdf->Ln(6);
        $pdf->writeHTMLCell(20, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(50, 6, '', '', "<strong>AREA</strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(50, 6, '', '', '<font size="10">' . $contract->lot_area . '</font>', 0, 0, 0, false, 'R', true);
        $pdf->Ln(6);
        $pdf->writeHTMLCell(20, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(50, 6, '', '', "<strong>PRICE/SQM.</strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(50, 6, '', '', '<font size="10">' . $contract->price_per_sqr_meter . '</font>', 0, 0, 0, false, 'R', true);
        $pdf->Ln(6);
        $pdf->writeHTMLCell(20, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(50, 6, '', '', "<strong>TCP, VAT inclusive</strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(50, 6, '', '', '<font size="10">PHP ' . number_format(($contract->lot_area * $contract->price_per_sqr_meter) + $contract->house_price + $contract->lot_vat, 2) . '</font>', 0, 0, 0, false, 'R', true);
		$pdf->Ln(6);
        $pdf->writeHTMLCell(20, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(50, 6, '', '', "<strong>TOTAL PAYABLES</strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(50, 6, '', '', '<font size="10">PHP ' . number_format(($contract->lot_area * $contract->price_per_sqr_meter) + $contract->house_price + $contract->lot_vat, 2)  . '</font>', 0, 0, 0, false, 'R', true);

        $pdf->Ln(10);
        $pdf->writeHTMLCell(20, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(160, 6, '', '', '<font size="8">I consideration of this reservation, I am depositing the amount of Philippine Pesos:</font>', 0, 0, 0, false, 'L', true);

		$pdf->Ln(6);
        $pdf->writeHTMLCell(180, 6, '', '', '<font size="8">(P<u> ' . number_format($contract->new_reserve_fee, 2) . ' </u>)</font> as reservation fee. The reservation fee shall be credited as part of the downpayment shall be paid as schedule below: ', 0, 0, 0, false, 'L', true);

        $pdf->Ln(12);
        $pdf->writeHTMLCell(180, 6, '', '', '<font size="8"><strong>PRIVACY NOTICE: <br />
		For the purpose of reserving the above-described property in my favor, I hereby consent to the collection, recording, organization, storage, updating or modification, retrieval, use, consolidation, retention, and other means of processing of my personal data, such as but not limited to, my full name, home address, e-mail address, business address, telephone numbers, age, birthday, marital status, photograph, TIN, SSS, HDMF, Passport and such other government-issued identification, by A Brown Company, Inc. (the “Company”). I agree that the Company may further require and process my personal data for the purpose of executing this Agreement, assisting me in my loan application, if any, assisting me in obtaining insurance, if any, preparing the Deed of Absolute Sale, transferring the title to the Property, and for such other purposes as will give effect of this Agreement. I know that  I have the choice as to what information  provided and that withholding or falsifying information may act against the best of this Agreement and my relationship with the Company. The consent for the Company to collect, record, organize, store, update or modify, retrieve, use, consolidate, retain, and otherwise process my personal data shall be valid for the duration of  this Agreement and for thirty (30) years thereafter or until the transfer of the title to the Property in my name, whichever is later.
		</strong></font>', 1, 0, 0, false, 'L', true);

        $pdf->Ln(50);
        $pdf->writeHTMLCell(60, 2, '', '', '<font size="8"><b>' . $contract->downpayment_ratio . '% DOWN PAYMENT IN ' . $contract->downpayment_terms . ' MONTHS</b></font>', 1, 0, 0, false, 'L', true);
		
		$pdf->Ln(6);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(70, 2, '', '', '<font size="8"></i></font>', 0, 0, 0, false, 'L', true);
        $pdf->writeHTMLCell(38, 2, '', '', '<font size="8"><strong>Date</strong></font>', 0, 0, 0, false, 'R', true);
        $pdf->writeHTMLCell(52, 2, '', '', '<font size="8"><strong>Amount</strong></font>', 0, 0, 0, false, 'R', true);
		
		$pdf->Ln(4);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(70, 2, '', '', '<font size="8">' . $contract->downpayment_ratio . '% of TCP</font>', 0, 0, 0, false, 'L', true);
        $pdf->writeHTMLCell(50, 2, '', '', '<font size="8"><strong></strong></font>', 0, 0, 0, false, 'R', true);
        $pdf->writeHTMLCell(50, 2, '', '', '<font size="8"><strong>____________________</strong></font>', 0, 0, 0, false, 'R', true);

		$pdf->Ln(4);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(70, 2, '', '', '<font size="8">Less: <i>Reservation Fee</i></font>', 0, 0, 0, false, 'L', true);
        $pdf->writeHTMLCell(50, 2, '', '', '<font size="8"><strong>____________________</strong></font>', 0, 0, 0, false, 'R', true);
        $pdf->writeHTMLCell(50, 2, '', '', '<font size="8"><strong>____________________</strong></font>', 0, 0, 0, false, 'R', true);

        $pdf->Ln(4);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(70, 2, '', '', '<font size="8">' . $contract->downpayment_ratio . ' DP, net of reservation fee payable in ' . $contract->downpayment_terms . ' month/s</font>', 0, 0, 0, false, 'L', true);
        $pdf->writeHTMLCell(50, 2, '', '', '<font size="8"><strong></strong></font>', 0, 0, 0, false, 'R', true);
        $pdf->writeHTMLCell(50, 2, '', '', '<font size="8"><strong>____________________</strong></font>', 0, 0, 0, false, 'R', true);
		$pdf->writeHTMLCell(50, 2, 140, 160, '<font size="8"><strong>' . number_format($dp, 2) . '</strong></font>', 0, 0, 0, false, 'R', true);

        // insert DP monthly

        $pdf->Ln(8);
        $amort_val = $this->customer->get_amortization($contract_id);
        $amort_val2 = $this->customer->get_amortization($contract_id);
		$i = 1; 
		$y = 168; // magic constant for dp, 168
		$str = ""; 
        $total_amort = 0; 
        $total_int = 0; 
        $total_princ = 0;
        $reserve_fee = 0;
        if (count($amort_val) > 0) {
	        $type = $amort_val[0]['line_type'];
	        foreach ($amort_val as $amort_val) {
	        	if ($amort_val['line_type'] == 3) {
			        $pdf->writeHTMLCell(50, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'L', false);
			        $pdf->writeHTMLCell(30, 6, '', '', "<font size='8'><strong>Month " . $i . "</strong></font>", 0, 0, 0, true, 'L', false);
					$pdf->writeHTMLCell(50, 2, '', '', '<font size="8"><strong>____________________</strong></font>', 0, 0, 0, false, 'R', true);
	        		$pdf->writeHTMLCell(50, 2, '', '', '<font size="8"><strong>____________________</strong></font>', 0, 0, 0, false, 'R', true);
					$pdf->writeHTMLCell(50, 2, 85, $y, '<font size="8"><strong>' . date("M d, Y", strtotime($amort_val['due_date'])) . '</strong></font>', 0, 0, 0, false, 'R', true);
					$pdf->writeHTMLCell(50, 2, 140, $y, '<font size="8"><strong>' . number_format($amort_val['amortization_amount'], 2) . '</strong></font>', 0, 0, 0, false, 'R', true);
			        $pdf->Ln(4);
		        	$i++;
	        	}else if ($amort_val['line_type'] == 2) {
			        $reserve_fee = $amort_val['amortization_amount'];
					// $pdf->writeHTMLCell(50, 2, 140, $y - 20, '<font size="8"><strong>' . number_format($amort_val['amortization_amount'], 2) . '</strong></font>', 0, 0, 0, false, 'R', true);
					$pdf->writeHTMLCell(50, 2, 85, $y - 12, '<font size="8"><strong>' . date("M d, Y", strtotime($amort_val['due_date'])) . '</strong></font>', 0, 0, 0, false, 'R', true);
					$pdf->writeHTMLCell(50, 2, 140, $y - 12, '<font size="8"><strong>' . number_format($amort_val['amortization_amount'], 2) . '</strong></font>', 0, 0, 0, false, 'R', true);
			        $pdf->Ln(20);
	        	}

		        $y += 4;
	        	$total_amort += $amort_val['amortization_amount'];
				$total_int 	 += $amort_val['interest_amount'];
				$total_princ += $amort_val['principal_amount'];
				$top_margin = PDF_MARGIN_HEADER; 
				if ($pdf->getY() > (240 /*height*/ - $top_margin + 30 /* magic constant*/)) {
					$y = 10;
				    $pdf->addPage();
				}
	        }

			$pdf->Ln(8);
	        $pdf->writeHTMLCell(60, 2, '', '', '<font size="8"><b>' . $contract->balance_ratio . '% REMAINING BALANCE</b></font>', 1, 0, 0, true, 'L', true);
			$pdf->Ln(8);
			$i = 1;
	        foreach ($amort_val2 as $amort_val2) {

        		$pdf->writeHTMLCell(15, 5, '', '', '<font size="8"><strong>' . $i . '</strong></font>', 1, 0, 0, false, 'L', true);
        		$pdf->writeHTMLCell(40, 5, '', '', '<font size="8"><strong>' . date("M d, Y", strtotime($amort_val2['due_date'])) . '</strong></font>', 1, 0, 0, false, 'L', true);
				$pdf->writeHTMLCell(40, 5, '','', '<font size="8"><strong>' . number_format($amort_val2['amortization_amount'], 2) . '</strong></font>', 1, 0, 0, false, 'R', true);
		        $pdf->Ln(5);
		        $i++;
		        if ($pdf->getY() > (240 /*height*/ - $top_margin + 30 /*another magic constant*/)) {
					$y = 10;
				    $pdf->addPage();
				}
	        }
	    }
	    $pdf->Ln(20);
	    $y += 84;
        $pdf->writeHTMLCell(20, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(60, 6, '', '', "<strong>THE BUYER:</strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(60, 6, '', '', "<strong>____________________________</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(60, 6, 95, $y, "<strong>" . $contract->lastname . ', ' . $contract->firstname . ' ' . $contract->middlename . "</strong>", 0, 0, 0, true, 'C', false);
        $pdf->writeHTMLCell(60, 6, 95, $y + 5, '<font size="7">SIGNATURE OVER PRINTED NAME</font>', 0, 0, 0, true, 'C', false);
        // $pdf->writeHTMLCell(40, 6, '', '', "<strong>____________________________________</strong>", 0, 0, 0, true, 'R', false);
	    $pdf->Ln(15);

        $pdf->writeHTMLCell(20, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(60, 6, '', '', "<strong>SPOUSAL CONSENT:</strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(60, 6, '', '', "<strong>____________________________</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(60, 6, 95, $y + 19, "<strong>" . $spouse_last . ', ' . $spouse_first . ' ' . $spouse_middle . "</strong>", 0, 0, 0, true, 'C', false);
        $pdf->writeHTMLCell(60, 6, 95, $y + 24, '<font size="7">SIGNATURE OVER PRINTED NAME</font>', 0, 0, 0, true, 'C', false);

	    $pdf->Ln(10);
        $pdf->writeHTMLCell(17, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(5, 6, '', '', '<font size="8">1.</font>', 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(135, 6, '', '', '<font size="8">Reservation Fee is non-refundable and non-transferable. It forms part of quity</font>', 0, 0, 0, true, 'L', false);

        $pdf->Ln(5);
        $pdf->writeHTMLCell(17, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(5, 6, '', '', '<font size="8">2.</font>', 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(135, 6, '', '', '<font size="8">with Value Added Tax(VAT). Price is subject to change without prior notice. In case of typographical errors, A Brown Company, Inc. reserves the right to correct the figures of this reservation/proposal.</font>', 0, 0, 0, true, 'L', false);

        $pdf->Ln(8);
        $pdf->writeHTMLCell(17, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(5, 6, '', '', '<font size="8">3.</font>', 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(135, 6, '', '', '<font size="8">Total contract price EXCULDES cost of retitling fee. Processing expenses and taxes are subject to change based on the government mandated rates. The estimated cost of retitling fee will be billed once the account is fully paid.</font>', 0, 0, 0, true, 'L', false);

        $pdf->Ln(12);
        $pdf->writeHTMLCell(17, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(5, 6, '', '', '<font size="8">4.</font>', 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(135, 6, '', '', '<font size="8">Postdated checks required</font>', 0, 0, 0, true, 'L', false);

        $pdf->Ln(5);
        $pdf->writeHTMLCell(17, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(5, 6, '', '', '<font size="8">5.</font>', 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(135, 6, '', '', '<font size="8">All checks should be made payable to A BROWN COMPANY, INC.</font>', 0, 0, 0, true, 'L', false);


			
		$pdf->addPage();

        $pdf->writeHTMLCell(10, 6, '', '', "<strong>1.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "The amount stipulated in the Contract to Sell is inclusive of VAT.", 0, 0, 0, true, 'L', false);
		// $pdf->Ln(5);

	    $pdf->Ln(10);
		$pdf->writeHTMLCell(10, 6, '', '', "<strong>2.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "The amount stipulated in the Deed of Absolute Sale is net of discount and VAT.", 0, 0, 0, true, 'L', false);

	    $pdf->Ln(10);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong>3.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "I hereby agree and accept the automatic cancellation of my Reservation Agreement and forfeiture of my reservation fee and other equity payments made if the following circumstances occurred:", 0, 0, 0, true, 'L', false);

		    $pdf->Ln(10);
		    $pdf->writeHTMLCell(15, 6, '', '', "<strong>a.</strong>", 0, 0, 0, true, 'R', false);
	        $pdf->writeHTMLCell(165, 6, '', '', "For cash sales, failure by me to tender the required total cash payment after thirty (30) days of payment of my reservation;", 0, 0, 0, true, 'L', false);

		    $pdf->Ln(10);
		    $pdf->writeHTMLCell(15, 6, '', '', "<strong>b.</strong>", 0, 0, 0, true, 'R', false);
	        $pdf->writeHTMLCell(165, 6, '', '', "(1) For bank financing, failure by me to apply for a loan and secure the approval thereof with a banking or financing institution not later than two (2) months from payment of the reservation agreement except however when I can settle the balance by paying it in cash;", 0, 0, 0, true, 'L', false);

		    $pdf->Ln(15);
		    $pdf->writeHTMLCell(15, 6, '', '', "<strong>c.</strong>", 0, 0, 0, true, 'R', false);
	        $pdf->writeHTMLCell(165, 6, '', '', "Voluntary withdrawal or cancellation;", 0, 0, 0, true, 'L', false);

		    $pdf->Ln(5);
		    $pdf->writeHTMLCell(15, 6, '', '', "<strong>d.</strong>", 0, 0, 0, true, 'R', false);
	        $pdf->writeHTMLCell(165, 6, '', '', "Non-submittal of the required documents of ABCI (if applicable) within the prescribed period;", 0, 0, 0, true, 'L', false);

		    $pdf->Ln(5);
		    $pdf->writeHTMLCell(15, 6, '', '', "<strong>e.</strong>", 0, 0, 0, true, 'R', false);
	        $pdf->writeHTMLCell(165, 6, '', '', "Failure by me to comply with any of the provisions of this Reservation Agreement and other agreements related thereto.", 0, 0, 0, true, 'L', false);


	    $pdf->Ln(10);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong>4.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "Upon my first payment after reservation fee, I shall sign, execute and deliver the prescribed Contract to Sell and Deed of Restrictions after reading and fully understanding the terms and conditions thereof.", 0, 0, 0, true, 'L', false);

        $pdf->Ln(13);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong>5.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "I agree to start paying the monthly amortization without demand as scheduled above, whether or not the Contract to Sell and Deed of Restrictions are not yet signed, executed and delivered to me by A BROWN COMPANY, INC (ABCI). I further agree to issue postdated checks (PDCs) covering succeeding payments after reservation fee and shall be submitted or delivered to ABCI within thirty (30) days from date of reservation.", 0, 0, 0, true, 'L', false);

        $pdf->Ln(25);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong>6.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "I agree that upon my first payment after reservation fee, even if I have not signed the Contract to Sell and Deed of Restrictions, I automatically become a member of the VENTURA RESIDENCES II HOMEOWNERS ASSOCIATION INC., - XAVIER ESTATES and shall be bound by rules and regulations thereof which include the payment of fees as mandated by its by-laws. The membership fee and the payment of the annual dues shall commence upon twenty-five (25%) percent of the Total Contract Price.", 0, 0, 0, true, 'L', false);

        $pdf->Ln(27);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong>7.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "In the event that the property above-described has been previously reserved or sold to a third party, I shall withdraw this reservation and exercise my option within five (5) days from notice of such fact,  to transfer my reservation application to another location with the same area or price & classification, or get a refund of my payments, which shall free A BROWN COMPANY, INC. from any further liability of whatever kind and nature.", 0, 0, 0, true, 'L', false);

        $pdf->Ln(22);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong>8.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "It is likewise understood that any representation or warranty made to me by my sales agent when handed this reservation, which is not embodied herein shall not be binding upon ABCI unless reduced into writing and signed by ABCI. This however shall not be considered as changed, modified or altered or in any way amended by any act(s) of tolerance of ABCI unless such change(s) modification(s) or amendments(s) are made in writing and signed by ABCI.", 0, 0, 0, true, 'L', false);

        $pdf->Ln(26);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong>9.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "This reservation fee shall be non-refundable, non-assignable, and non-transferrable to other applicants or to another unit or location, unless with the written consent of ABCI subject to contract adjustments per prices and terms prevailing at the time of transfer, payment of tax due related thereon and the payment of a processing fee.", 0, 0, 0, true, 'L', false);

        $pdf->Ln(20);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong>10.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "Approval of this reservation shall be temporary and shall be subject to final confirmation after my bank loan applied for has been finally approved.", 0, 0, 0, true, 'L', false);

        $pdf->Ln(15);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong>11.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "In the event that the approved bank loan is lower than the amount applied for, I am agreeable to pay the differential as additional cash required within fifteen (15) days from receipt of notice. My failure to do shall allow ABCI to cancel my reservation Agreement and forfeit all partial payments made to Maceda Law.", 0, 0, 0, true, 'L', false);

        $pdf->Ln(19);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong>12.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "In case there is any discrepancy as to the actual size of the lot are of my reserved unit, due to errors in surveying or other reasons, I am amenable to either get a price reduction where it is found to be smaller or to pay the corresponding additional amount should the lot area be larger. I agree to make my payment within seven (7) days from receipt of notice from ABCI or its assigns.", 0, 0, 0, true, 'L', false);
	    

		$pdf->addPage();


		$pdf->writeHTMLCell(10, 6, '', '', "<strong>13.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "I hereby agree to submit my Tax Identification Number (TIN) simultaneous with my payment of the required Reservation Fee. The failure, non-submission or erroneous submission of TIN shall authorize ABCI to process my TIN with the office of the Bureau of Internal Revenue and I shall reimburse ABCI for any resultant cost or expenses thereof.", 0, 0, 0, true, 'L', false);

        $pdf->Ln(20);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong>14.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "Any representation, stipulation, warranty, amendment or other terms and conditions whether made verbally or in writing but which is not expressly contained in this Reservation Agreement, or incorporated herein by express reference shall not bind A BROWN COMPANY, INC.", 0, 0, 0, true, 'L', false);

        $pdf->Ln(16);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong>15.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "For the purpose of reserving the above-described property in my favor, I hereby consent to the collection, recording, organization, storage, updating or modification, retrieval, use, consolidation, retention, and other means of processing of my personal data, such as but not limited to, my full name, home address, e-mail address, business address, telephone numbers, age, birthday, marital status, photograph, TIN, SSS/GSIS, HDMF, Passport, and such other government-issued identification, by ABCI. I agree that ABCI may further require and process my personal data for the purpose of executing this Agreement, assisting me in my loan application, if any, assisting me in obtaining insurance, if any, preparing the Deed of Absolute Sale, transferring the title to the Property, and for such other purposes as will give effect to this Agreement. I know that I have the choice as to what information I provide, and that the withholding or falsifying of information may act against the best interest of this Agreement and my relationship with ABCI. The BUYER’s consent for ABCI to collect, record, organize, store, update or modify, retrieve, use, consolidate, retain, and otherwise process my personal data shall be valid for the duration of this Agreement and for thirty (30) years thereafter or until the transfer of the title to the Property in my name, whichever is later.", 0, 0, 0, true, 'L', false);

        $pdf->Ln(60);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong>16.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "In the event of any lawsuit, the venue shall exclusively be in Cagayan de Oro City.", 0, 0, 0, true, 'L', false);

        $pdf->Ln(10);
        $pdf->writeHTMLCell(10, 6, '', '', "<strong>17.</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(175, 6, '', '', "I perfectly understand that A BROWN COMPANY, INC. has the absolute right to approve or disapprove this Reservation Agreement. In the event of disapproval, I shall get a refund of my reservation fee.", 0, 0, 0, true, 'L', false);

        $pdf->Ln(20);
		$pdf->writeHTMLCell(10, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'R', false);
		$pdf->writeHTMLCell(50, 6, '', '', "Place of Execution:", 0, 0, 0, true, 'L', false);
		$pdf->writeHTMLCell(60, 6, '', '', "Cagayan de Oro City, Philippines", 0, 0, 0, true, 'L', false);

		$pdf->Ln(20);
        $y += 61;
        $pdf->writeHTMLCell(10, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(50, 6, '', '', "<strong>THE BUYER:</strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(60, 6, '', '', "<strong>___________________________</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(60, 6, '', '', "<strong>______________</strong>", 0, 0, 0, true, 'C', false);
        
        $pdf->writeHTMLCell(60, 6, 78, $y, "<strong>" . $contract->lastname . ', ' . $contract->firstname . ' ' . $contract->middlename . "</strong>", 0, 0, 0, true, 'C', false);
        $pdf->writeHTMLCell(60, 6, 78, $y + 5, '<font size="7">SIGNATURE OVER PRINTED NAME</font>', 0, 0, 0, true, 'C', false);
        $pdf->writeHTMLCell(60, 6, 135, $y + 5, '<font size="7">DATE SIGNED</font>', 0, 0, 0, true, 'C', false);
        // $pdf->writeHTMLCell(40, 6, '', '', "<strong>____________________________________</strong>", 0, 0, 0, true, 'R', false);
	    $pdf->Ln(15);

        $pdf->writeHTMLCell(10, 6, '', '', "<strong></strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(50, 6, '', '', "<strong>SPOUSAL CONSENT:</strong>", 0, 0, 0, true, 'L', false);
        $pdf->writeHTMLCell(60, 6, '', '', "<strong>___________________________</strong>", 0, 0, 0, true, 'R', false);
        $pdf->writeHTMLCell(60, 6, '', '', "<strong>______________</strong>", 0, 0, 0, true, 'C', false);
        if (isset($spouse->lastname)) {
	        $pdf->writeHTMLCell(60, 6, 78, $y + 19, "<strong>" . $spouse_last . ', ' . $spouse_first . ' ' . $spouse_middle . "</strong>", 0, 0, 0, true, 'C', false);
        }
        $pdf->writeHTMLCell(60, 6, 78, $y + 24, '<font size="7">SIGNATURE OVER PRINTED NAME</font>', 0, 0, 0, true, 'C', false);
        $pdf->writeHTMLCell(60, 6, 135, $y + 24, '<font size="7">DATE SIGNED</font>', 0, 0, 0, true, 'C', false);

	    // $pdf->Ln(15);
     //    $pdf->writeHTMLCell(60, 6, '', '', '<font size="9"><strong>REALTY: </strong></font>', 0, 0, 0, true, 'L', false);
     //    $pdf->writeHTMLCell(60, 6, '', '', '<font size="9"><strong>'. $realty_info->realty_name . '</strong></font>', 0, 0, 0, true, 'C', false);
	    
	    // $pdf->Ln(8);
     //    $pdf->writeHTMLCell(60, 6, '', '', '<font size="9"><strong>PRC: </strong></font>', 0, 0, 0, true, 'L', false);
     //    $pdf->writeHTMLCell(60, 6, '', '', '<font size="9"><strong>'. $realty_info->realty_name . '</strong></font>', 0, 0, 0, true, 'C', false);





        $pdf->Output('Reservation_agreement.pdf', 'I'); 

	}


// NEW CUSTOMER FORM ------------------------------------------ END


// NEW BANK FORM------------------------------------- START

	public function insert_bank(){
		$bank = array(
			'bank_name' => $this->input->post('bank_name'),
			'person_id' => 0,
			'type' => 0,
			'account_number' => $this->input->post('bank_number'),
			'address_id' => 0,
			'contact_id' => 0,
			'status_id' => 1,
			'legacy_subcode' => 0,
			'unit_type' => $this->input->post('unit_type'),
			'representative' => $this->input->post('bank_representative'),
			'rep_designation' => $this->input->post('bank_designation'),
			'principal_address' => $this->input->post('bank_address'),
			'maxloan_amount' => $this->input->post('bank_max_amount'),
			'minloan_amount' => $this->input->post('bank_min_amount'),
			'min_equity' => $this->input->post('bank_min_equity'),
			'max_loan_term' => $this->input->post('bank_max_term'),
			'max_age' => $this->input->post('bank_max_age'),
			
		);
		echo json_encode($this->customer->insert_bank_model($bank));
	}





// NEW BANK FORM------------------------------------- END


// RESERVATION AGREEMENT----------------------------- Star

	public function get_salesperson(){
    	echo json_encode($this->customer->get_salesperson_model($this->input->post('broker_id')));
    }


// RESERVATION AGREEMENT----------------------------- End






















	public function save_new_agent(){
      	$arrfile =  $this->fileupload('userfile');
		$filename = "";
		if(array_key_exists('data',$arrfile)){
		$filename = $arrfile['data'];
	    } 
	    $person = array(
			'lastname' => $this->input->post('custLname'),
			'firstname' => $this->input->post('custFname'),
			'middlename' => $this->input->post('custMname'),
			'sex' => $this->input->post('custGender'),
			'birthdate' => $this->input->post('birthdate'),
			'birthplace' => $this->input->post('custPlaceOfBirth'),
			'nationality' => $this->input->post('custNationality'),
			'civil_status_id' => $this->input->post('custCivilStatus'),
			'tin' => $this->input->post('custTIN'),
			'picture_url' => $filename,
			);
	    $client = $this->input->post('clientpass');
	    $lotid = $this->input->post('lotidpass');
	    $realty = $this->input->post('realtypass');
	    $broker = $this->input->post('brokerpass');
		$lastpersonid = $this->customer->insert_agent($person);
		$address = array(
			'line_1' => $this->input->post('barangay'),
			'city_id' => $this->input->post('city'),
			'province_id' => $this->input->post('province'),
			'country_id' => $this->input->post('country'),
			'address_type_id' => $this->input->post('addtype'),
	    );
		$datareturn = $this->customer->insertAddress($address,$lastpersonid);

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " inserted new agent ID " . $lastpersonid
        );
        $this->logs->log($log_entry);


		$this->data['message'] = 'Data Inserted Successfully';
		redirect(base_url().'marketing/reservationAgreement?clientid='.$client.'&lotid='.$lotid.'&realty='.$realty.'&broker='.$broker, 'refresh');
	}


	public function paymentSchemes(){
		$this->data['content'] = 'paymentschemes';
		$this->data['page_title'] = 'Payment Schemes';
        $this->data['project'] = $this->customer->getProjects();
        
        $this->data['customjs'] = 'paymentschemesjs';
        $this->data['payment_scheme'] = $this->customer->getPaymentScheme2();
		$this->load->view('default/index', $this->data);  
	}

	public function savePaymentScheme(){
		$paymentSchemeDescription = 'Downpayment '.$this->input->post('deposit_rate').'% Discount '.$this->input->post('discount_rate').'%';
		$paymentScheme = array (
			// 'project_id' => $this->input->post('project_id'),
			'payment_scheme_name' => $this->input->post('payment_scheme_name'),
			'payment_scheme_desc' => $paymentSchemeDescription,
			'reservation_fee' => $this->input->post('reservation_fee'),
			'deposit_rate' => $this->input->post('deposit_rate'),
			'discount_rate' => $this->input->post('discount_rate'),
			'interest_rate' => $this->input->post('interest_rate'),
			'surcharge_rate' => $this->input->post('surcharge_rate'),
			'terms' => $this->input->post('terms'),
			'amortization_rate' => $this->input->post('amortization_rate'),
			'amortization_discount_rate' => $this->input->post('amortization_discount_rate'),
			'amortization_interest_rate' => $this->input->post('amortization_interest_rate'),
			'amortization_surcharge_rate' => $this->input->post('amortization_surcharge_rate'),
			'amortization_terms' => $this->input->post('amortization_terms'),
			);
		$pay_scheme = $this->customer->insertPaymentScheme($paymentScheme);

		$project_scheme = $this->input->post('project_scheme');
		foreach ($project_scheme as $i => $value) {
			$scheme_proj = array(
				'payment_scheme_id' => $pay_scheme,
				'project_id' => $value,
				'status_id' => 1
			);
			$this->customer->pay_scheme_model($scheme_proj);
		}

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " inserted new payment Scheme ID " . $pay_scheme
        );
        $this->logs->log($log_entry);

	}
	public function retrieveOnPaymentScheme(){
      $datareturn = $this->customer->getOnePaymentScheme($this->input->post('paymentschemeid'));
      echo json_encode($datareturn);
	}

	public function modifyPaymentScheme(){
		$paymentSchemeDescription = 'Downpayment '.$this->input->post('deposit_rate').'% Discount '.$this->input->post('discount_rate').'%';
		$paymentSchemeId = $this->input->post('payment_scheme_id');
		$paymentScheme = array (
			'payment_scheme_name' => $this->input->post('payment_scheme_name'),
			'payment_scheme_desc' => $paymentSchemeDescription,
			'reservation_fee' => $this->input->post('reservation_fee'),
			'deposit_rate' => $this->input->post('deposit_rate'),
			'discount_rate' => $this->input->post('discount_rate'),
			'interest_rate' => $this->input->post('interest_rate'),
			'surcharge_rate' => $this->input->post('surcharge_rate'),
			'terms' => $this->input->post('terms'),
			'amortization_rate' => $this->input->post('amortization_rate'),
			'amortization_discount_rate' => $this->input->post('amortization_discount_rate'),
			'amortization_interest_rate' => $this->input->post('amortization_interest_rate'),
			'amortization_surcharge_rate' => $this->input->post('amortization_surcharge_rate'),
			'amortization_terms' => $this->input->post('amortization_terms'),
			);
		$this->customer->updatePaymentScheme($paymentScheme, $paymentSchemeId);

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'update',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " updated payment Scheme ID " . $paymentSchemeId
        );
        $this->logs->log($log_entry);
	}

	public function incentiveschemes(){
		$this->data['content'] = 'incentiveschemes';
		$this->data['page_title'] = 'Incentive Schemes';
        $this->data['customjs'] = 'incentiveschemesjs';
        $this->data['incentives'] = $this->customer->getIncentives();
        $this->data['payment_schemes'] = $this->customer->getPaymentScheme();
        $this->data['projects'] = $this->customer->getProjects();
        $this->data['payment_schemes2'] = $this->customer->getPaymentScheme();
        $this->data['projects2'] = $this->customer->getProjects();
		$this->load->view('default/index', $this->data);  
	}

	public function saveIncentive(){
		$incentive = array (
			'project_id' => $this->input->post('project_id'),
			'payment_scheme_id' => $this->input->post('payment_scheme_id'),
			'reservation_bonus' => $this->input->post('reservation_bonus'),
			'scheme_bonus' => $this->input->post('scheme_bonus'),
			);
		$incent_id = $this->customer->insertIncentiveScheme($incentive);

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " Inserted new incentive Scheme ID " . $incent_id
        );
        $this->logs->log($log_entry);

	}

	public function retrieveOnIncentiveScheme(){
		$datareturn = $this->customer->getOneIncentiveScheme($this->input->post('incentiveid'));
      	echo json_encode($datareturn);
	}

	public function populateContract(){
		$this->load->helper('date');
		$contractdata = array(
				'client_id'=> $this->input->post('client_id'),
                'lot_id'=> $this->input->post('lot_id'),
                'contract_date'=> $this->input->post('contract_date'),
                'sold_date'=> $this->input->post('sold_date'),
                'total_contract_price'=> $this->input->post('total_contract_price'),
                'free_club_share'=> $this->input->post('free_club_share'),
                'reservation_fee' => $this->input->post('reservation_fee'),
                'contract_status_id' => $this->input->post('contract_status_id'),
                'is_vatable'=> $this->input->post('is_vatable'),
                'is_tax_deferred' => $this->input->post('is_tax_deferred'),
                'salesperson_id'=> $this->input->post('salesperson_id'),
                'bank_id' => $this->input->post('bank_id'),
                'vat_rate' => $this->input->post('vat_rate'),
                'scheme_type_id'=> $this->input->post('scheme_type_id'),
                'deposit_amount'=> $this->input->post('deposit_amount'),
                'deposit_date'=> $this->input->post('deposit_date'),
                'amortization_date'=> $this->input->post('amortization_date'),
                'downpayment_ratio'=> $this->input->post('downpayment_ratio'),
                'downpayment_interest_rate'=> $this->input->post('downpayment_interest_rate'),
                'downpayment_terms'=> $this->input->post('downpayment_terms'),
                'downpayment_discount_rate'=> $this->input->post('downpayment_discount_rate'),
                'downpayment_discount'=> $this->input->post('downpayment_discount'),
                'downpayment_surcharge_rate'=> $this->input->post('downpayment_surcharge_rate'),
                'balance_ratio'=> $this->input->post('balance_ratio'),
                'balance_terms'=> $this->input->post('balance_terms'),
                'balance_interest_rate'=> $this->input->post('balance_interest_rate'),
                'balance_surcharge_rate'=> $this->input->post('balance_surcharge_rate'), 
                'added_by'=> $this->input->post('added_by'),
                'incentive_rate'=> $this->input->post('incentive_rate'),
                
			);
		$lastcontractID = $this->customer->save_contract($contractdata);
		// lot_availability_model
		// print_r($contractdata);
		// echo $lastcontractID;
		$history = array(
			'contract_id' => $lastcontractID,
            'scheme_type_id'=> $this->input->post('scheme_type_id'),
            'history_date' => $this->input->post('contract_date'),
			'downpayment_ratio'=> $this->input->post('downpayment_ratio'),
            'downpayment_interest_rate'=> $this->input->post('downpayment_interest_rate'),
            'downpayment_terms'=> $this->input->post('downpayment_terms'),
            'downpayment_discount_rate'=> $this->input->post('downpayment_discount_rate'),
            'downpayment_discount'=> $this->input->post('downpayment_discount'),
            'downpayment_surcharge_rate'=> $this->input->post('downpayment_surcharge_rate'),
            'balance_ratio'=> $this->input->post('balance_ratio'),
            'balance_terms'=> $this->input->post('balance_terms'),
            'balance_interest_rate'=> $this->input->post('balance_interest_rate'),
            'balance_surcharge_rate'=> $this->input->post('balance_surcharge_rate'),
		);

		$this->customer->save_contract_history($history);

		$arr = $this->input->post('arr_data');
		foreach ($arr as $key => $value) {
			$amortdata = array(
				'contract_id'=> $lastcontractID,
				'line_type' => $value['line_type'],
				'line_order' => $value['line_order'],
				'due_date'=> $value['due_date'],
				'amortization_amount'=> $value['amortization_amount'],
				'outstanding_balance'=> $value['outstanding_balance'],
				'principal_amount'=> $value['principal_amount'],
				'interest_amount'=> $value['interest_amount'],
				'line_description' => $value['line_description'],
				//'miscellaneous_fee'=> $value['miscellaneous_fee'],
				'cashier_id'=> $value['cashier_id'],
				'paid_up'=> $value['paid_up'],
				'rebate'=> $value['rebate'],
				'is_active' => 1,
				'is_reconstruct' => 0,
		   );
		 $insertstatus = $this->customer->save_amortization($amortdata);
		 // echo $insertstatus;
		}
		// print_r($arr);

		// //karl
		$arr_misc = $this->input->post('arr_misc');
		if($this->input->post('is_checked') == 1){
			foreach ($arr_misc as $key => $value) {
				$misc_data = array(
					'contract_id'=> $lastcontractID,
					'line_order' => $value['line_order'],
					'due_date'=> $value['due_date'],
					// 'outstanding_balance'=> $value['outstanding_balance'],
					'principal_amount'=> $value['principal_amount'],
					'miscelaneous_amount'=> $value['miscellaneous_amount'],
					'cashier_id'=> $value['cashier_id'],
					'paid_up'=> $value['paid_up'],
					'rebate'=> $value['rebate'],
			   );
			 $insertstatus = $this->customer->save_miscellaneous($misc_data);
			}
		}

		$lot = $this->customer->get_one_lot($this->input->post('lot_id'));

		foreach ($lot as $key => $value) {
			if ($value['with_house'] == 1) {
				$commission = $this->customer->get_commission_model(2);
			}else{
				$commission = $this->customer->get_commission_model(1);
			}
			foreach ($commission as $key => $value) {
					$commission_value = ($this->input->post('total_contract_price') * ($value['percent_commission'] / 100));
					// echo $commission_value . "<br />";
					$commission_data = array(
						'contract_id' => $lastcontractID,
						'agent_id' => $this->input->post('agent_id'),
						'commission_id' => $value['commission_id'],
						'amount' => $commission_value,
						'date_release' => date('Y-m-d H:i:s',now()),
						'is_paid' => 0,
						);
					$this->customer->insert_commission_model($commission_data);
			}
		}
		$availability = array('availability'=> 0);
		$this->customer->lot_availability_model($this->input->post('lot_id'), $availability);

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " Inserted new contract ID " . $lastcontractID
        );
        $this->logs->log($log_entry);

	 	echo json_encode($lastcontractID);
	 	
		// redirect(base_url().'marketing/amortizationdetails?contractid='. $lastcontractID, 'refresh');
		
	}

	public function miscellaneous_save(){
		$misc_arr = $this->input->post('misc_arr');
		$contractid = 0;
		foreach ($misc_arr as $key => $value) {
			$misc_data = array(
				'contract_id'=> $value['contract_id'],
				'line_order' => $value['line_order'],
				'due_date'=> $value['due_date'],
				// 'outstanding_balance'=> $value['outstanding_balance'],
				'principal_amount'=> $value['principal_amount'],
				'miscelaneous_amount'=> $value['miscellaneous_amount'],
				'cashier_id'=> $value['cashier_id'],
				'paid_up'=> $value['paid_up'],
				'rebate'=> $value['rebate']
		   );
			$contractid = $value['contract_id'];
			$miscel_data = $this->customer->save_miscellaneous($misc_data);
		}

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " Inserted new miscellaneous ID " . $miscel_data
        );
        $this->logs->log($log_entry);
		echo json_encode($misc_arr);
		redirect(base_url().'marketing/amortizationdetails?contractid=' . $contractid, 'refresh');
	}

	public function banks(){
		$this->data['content'] = 'banks';
		$this->data['page_title'] = 'Marketing';
		$this->data['page_title'] = 'Banks';
        $this->data['customjs'] = 'banksjs';
        $this->data['banks'] = $this->customer->getBanks();
        $this->data['allcity'] = $this->customer->getAllCity();
		$this->data['addtype'] = $this->customer->getAddressType();
		$this->data['addcountry'] = $this->customer->getAllCountry();
		$this->data['allprovince'] = $this->customer->getAllProvince();
		$this->load->view('default/index', $this->data);
	}

	public function saveBank(){
		$arrfile =  $this->fileupload('userfile');
		$filename = "sample";
		//bank contact person
		$person = array(
			'lastname' => $this->input->post('lastName'),
			'middlename' => $this->input->post('middleName'),
			'firstname' => $this->input->post('firstName'),
			'suffix' => $this->input->post('suffix'),
			'sex' => $this->input->post('sex'),
			'birthdate' => $this->input->post('birthdate'),
			'birthplace' => $this->input->post('birthplace'),
			'nationality' => $this->input->post('nationality'),
			'sex' => $this->input->post('sex'),
			'civil_status_id' => $this->input->post('civil_status'),
			'picture_url' => $filename,
			);
		$lastPersonID = $this->customer->insertPersonBank($person);
		//bank contact person address with person address in model
		$personAddress = array(
			'line_1' => $this->input->post('person_address_line1'),
			'line_2' => $this->input->post('person_address_line2'),
			'line_3' => $this->input->post('person_address_line3'),
			'city_id' => $this->input->post('person_address_city'),
			'province_id' => $this->input->post('person_address_province'),
			'country_id' => $this->input->post('person_address_country'),
			'address_type_id' => $this->input->post('person_address_type'),
			);
		$this->customer->insertAddressBankContactPerson($personAddress,$lastPersonID);
		//bank contact person contact information
		$contact = array(
			'person_id' => $lastPersonID,
			'contact_type_id' => $this->input->post('person_contact_type'),
			'contact_value' => $this->input->post('person_contact'),
			'status_id' => 1,
			);
		$bankContactId = $this->customer->insertContactsBank($contact);
		//bank address
		$bankAddress = array(
			'line_1' => $this->input->post('bank_address_line1'),
			'line_2' => $this->input->post('bank_address_line2'),
			'line_3' => $this->input->post('bank_address_line3'),
			'city_id' => $this->input->post('bank_address_city'),
			'province_id' => $this->input->post('bank_address_province'),
			'country_id' => $this->input->post('person_address_country'),
			'address_type_id' => $this->input->post('bank_address_type'),
			);
		$bankAddressId = $this->customer->insertAddressBank($bankAddress);
		//bank information
		$bank = array(
			'bank_name' => $this->input->post('bank_name'),
			'account_number' => $this->input->post('account_number'),
			'person_id' => $lastPersonID,
			'address_id' => $bankAddressId,
			'contact_id' => $bankContactId,
			'status_id' => 1,
			);
		$last_bank = $this->customer->insertBank($bank);

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " Inserted new Bank ID " . $last_bank
        );
        $this->logs->log($log_entry);

	}

	public function retrieveOnBank(){
		$bankid = $this->input->post('bankid');
		$personid = $this->input->post('personid');
		$addressid = $this->input->post('addressid');
		$datareturn['bank'] = $this->customer->getOneBank($bankid,$addressid);
		$datareturn['person'] = $this->customer->getOneBankPerson($personid);
      	echo json_encode($datareturn);
	}

	public function modifyBank(){
		$arrfile =  $this->fileupload('userfile');
		$filename = "sample";
		//bank contact person
		$personID = $this->input->post('person_id');
		$personAddressID = $this->input->post('person_address_id');
		$bankID = $this->input->post('bank_id');
		$bankAddressID = $this->input->post('bank_address_id');
		$contactID = $this->input->post('bank_contact_id');
		$person = array(
			'lastname' => $this->input->post('person_lastname'),
			'middlename' => $this->input->post('person_middlename'),
			'firstname' => $this->input->post('person_firstname'),
			'suffix' => $this->input->post('person_suffix'),
			'sex' => $this->input->post('person_sex'),
			'birthdate' => $this->input->post('person_birthday'),
			'birthplace' => $this->input->post('person_birthplace'),
			'nationality' => $this->input->post('person_nationality'),
			'civil_status_id' => $this->input->post('person_civilstatus'),
			'picture_url' => $filename,
			);
		$this->customer->updatePersonBank($person,$personID);
		//bank contact person address with person address in model
		$personAddress = array(
			'line_1' => $this->input->post('person_line_1'),
			'line_2' => $this->input->post('person_line_2'),
			'line_3' => $this->input->post('person_line_3'),
			'city_id' => $this->input->post('person_address_city'),
			'province_id' => $this->input->post('person_address_province'),
			'country_id' => $this->input->post('person_address_country'),
			'address_type_id' => $this->input->post('person_address_type'),
			);
		$this->customer->updateAddressBankContactPerson($personAddress,$personAddressID);
		//bank contact person contact information
		$contact = array(
			'person_id' => $personID,
			'contact_type_id' => $this->input->post('person_contact_type'),
			'contact_value' => $this->input->post('person_contact'),
			'status_id' => 1,
			);
		$this->customer->updateContactsBank($contact,$contactID);
		//bank address
		$bankAddress = array(
			'line_1' => $this->input->post('bank_line_1'),
			'line_2' => $this->input->post('bank_line_2'),
			'line_3' => $this->input->post('bank_line_3'),
			'city_id' => $this->input->post('bank_address_city'),
			'province_id' => $this->input->post('bank_address_province'),
			'country_id' => $this->input->post('bank_address_country'),
			'address_type_id' => $this->input->post('bank_address_type'),
			);
		$this->customer->updateAddressBank($bankAddress,$bankAddressID);
		//bank information
		$bank = array(
			'bank_name' => $this->input->post('bank_name'),
			'account_number' => $this->input->post('account_number'),
			'person_id' => $personID,
			'address_id' => $bankAddressID,
			'contact_id' => $contactID,
			'status_id' => 1,
			);
		$this->customer->updateBank($bank,$bankID);

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'update',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " Updated Bank ID " . $bankID
        );
        $this->logs->log($log_entry);
	}

	public function retrieveOneSchemeType(){
		$datareturn = $this->customer->getOneSchemeType($this->input->post('schemeid'));
		echo json_encode($datareturn);
	}
	









	public function saveCustomer(){ //redirect to listing reservation
		$arrfile =  $this->fileupload('userfile');
		$filename = "";

		if(array_key_exists('data',$arrfile)){
		$filename = $arrfile['data'];
	    }
	    // if(array_key_exists('error',$arrfile)){
        //       echo json_encode($arrfile);
        //      die();
	    // }
	    $person = array(
			'lastname' => $this->input->post('custLname'),
			'firstname' => $this->input->post('custFname'),
			'middlename' => $this->input->post('custMname'),
			'sex' => $this->input->post('custGender'),
			'birthdate' => $this->input->post('birthdate'),
			'birthplace' => $this->input->post('custPlaceOfBirth'),
			'nationality' => $this->input->post('custNationality'),
			'civil_status_id' => $this->input->post('custCivilStatus'),
			'tin' => $this->input->post('custTIN'),
			'picture_url' => $filename,
			// 'reason_price' => $reason_price,
			// 'reason_location' => $reason_location,
			// 'reason_design' => $reason_design,
			// 'reason_developer' => $reason_developer,
			// 'reason_others' => $reason_others,
			// 'source_flyers' => $source_flyers,
			// 'source_refer' => $source_refer,
			// 'source_invitation' => $source_invitation,
			// 'source_billboard' => $source_billboard,
			// 'source_magazine' => $source_magazine,
			// 'source_activity' => $source_activity,
			// 'source_online' => $source_online,
			// 'source_others' => $source_others,
			);
	    $survey = array(
	    	'reason_price' => $this->input->post('reason_price1'),
			'reason_location' => $this->input->post('reason_location1'),
			'reason_design' => $this->input->post('reason_design1'),
			'reason_developer' => $this->input->post('reason_developer1'),
			'reason_others' => $this->input->post('reason_others1'),
			'source_flyers' => $this->input->post('source_flyers1'),
			'source_refer' => $this->input->post('source_refer1'),
			'source_invitation' => $this->input->post('source_invitation1'),
			'source_billboard' => $this->input->post('source_billboard1'),
			'source_magazine' => $this->input->post('source_magazine1'),
			'source_activity' => $this->input->post('source_activity1'),
			'source_online' => $this->input->post('source_online1'),
			'source_others' => $this->input->post('source_others1')
	    	);


	    $cust_org = array(
			'organization_name' => $this->input->post('comp_name'),
			'status_id' => 1,
			);

		$last_org = $this->customer->insertOrg($cust_org);

		$customer_work = array(
			'organization_id' => $last_org,
			'occupation' => $this->input->post('cust_occupation'),
			'job_title' => $this->input->post('job_title'),
			'monthly_gross_income' => $this->input->post('cust_income'),
			'source_of_funds' => $this->input->post('cust_funds')
			);
		$last_cust_work = $this->customer->insert_cust_work($customer_work);

		$ids = $this->customer->insertPerson($person, $last_cust_work);

		$this->customer->update_survey($ids['lastclient'] ,$survey);

		$address = array(
			'line_1' => $this->input->post('barangay'),
			'line_2' => $this->input->post('street_line2'),
			'line_3' => $this->input->post('house_num_line3'),
			'city_id' => $this->input->post('city'),
			'province_id' => $this->input->post('province'),
			'country_id' => $this->input->post('country'),
			'address_type_id' => $this->input->post('addtype'),
     	);
     	// $custid = $this->input->post('custid');
     
     	$datareturn = $this->customer->insertAddress($address);
     
     	$addPersonAddress = array(
            'person_id' => $ids['lastperson'],
            'address_id' =>  $datareturn,
            'status_id' =>  1,
        );
     	$this->customer->insertPersonAddress($addPersonAddress);
     	$this->data['message'] = 'Data Inserted Successfully';
     

		foreach ($this->input->post('cust_cont_values') as $i => $value) {
			$cust_contact = array(
				'person_id'=> $ids['lastperson'],
				'contact_type_id' => $this->input->post('cust_cont_types')[$i],
				'contact_value' => $value,
				'status_id' => 1
			);
			$this->customer->insertContacts($cust_contact);
		}
		if (($this->input->post('old_cust_id')) > 0) {
			foreach ($this->input->post('old_cust_id') as $i => $value) {
				$cust_contact = array(
					'client_id' => $ids['lastclient'],
					'legacy_customer_id' => $value
				);
				$this->customer->save_legacy($cust_contact);
			}			
		}

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " Inserted new client ID " . $ids['lastclient']
        );
        $this->logs->log($log_entry);

        // echo json_encode($ids['lastclient']);
        // $this->data['kk'] = $ids['lastclient'];

        $this->session->set_userdata('client_id_ses', $ids['lastclient']);

		redirect(base_url().'marketing/listingreservation');
	}

	public function saveCustomer2(){
		$arrfile =  $this->fileupload('userfile');
		$filename = "";
		if(array_key_exists('data',$arrfile)){
		$filename = $arrfile['data'];
	    }
	    // if(array_key_exists('error',$arrfile)){
        //       echo json_encode($arrfile);
        //      die();
	    // }
	    // $reason_price = ;
		// $reason_location = ;
		// $reason_design = ;
		// $reason_developer = ;
		// $reason_others = ;
		// $source_flyers = ;
		// $source_refer = ;
		// $source_invitation = ;
		// $source_billboard = ;
		// $source_magazine = ;
		// $source_activity = ;
		// $source_online = ;
		// $source_others = ;


	    $person = array(
			'lastname' => $this->input->post('custLname'),
			'firstname' => $this->input->post('custFname'),
			'middlename' => $this->input->post('custMname'),
			'sex' => $this->input->post('custGender'),
			'birthdate' => $this->input->post('birthdate'),
			'birthplace' => $this->input->post('custPlaceOfBirth'),
			'nationality' => $this->input->post('custNationality'),
			'civil_status_id' => $this->input->post('custCivilStatus'),
			'tin' => $this->input->post('custTIN'),
			'picture_url' => $filename,
			
			);
	    $survey = array(
	    	'reason_price' => $this->input->post('reason_price1'),
			'reason_location' => $this->input->post('reason_location1'),
			'reason_design' => $this->input->post('reason_design1'),
			'reason_developer' => $this->input->post('reason_developer1'),
			'reason_others' => $this->input->post('reason_others1'),
			'source_flyers' => $this->input->post('source_flyers1'),
			'source_refer' => $this->input->post('source_refer1'),
			'source_invitation' => $this->input->post('source_invitation1'),
			'source_billboard' => $this->input->post('source_billboard1'),
			'source_magazine' => $this->input->post('source_magazine1'),
			'source_activity' => $this->input->post('source_activity1'),
			'source_online' => $this->input->post('source_online1'),
			'source_others' => $this->input->post('source_others1')
	    	);

	    $cust_org = array(
			'organization_name' => $this->input->post('comp_name'),
			'status_id' => 1,
			);

		$last_org = $this->customer->insertOrg($cust_org);

		
		$customer_work = array(
			'organization_id' => $last_org,
			'occupation' => $this->input->post('cust_occupation'),
			'job_title' => $this->input->post('job_title'),
			'monthly_gross_income' => $this->input->post('cust_income'),
			'source_of_funds' => $this->input->post('cust_funds')
			);
		$last_cust_work = $this->customer->insert_cust_work($customer_work);

		$ids = $this->customer->insertPerson($person, $last_cust_work, $survey);

		$this->customer->update_survey($ids['lastclient'] ,$survey);
		
		$address = array(
			'line_1' => $this->input->post('barangay'),
			'line_2' => $this->input->post('street_line2'),
			'line_3' => $this->input->post('house_num_line3'),
			'city_id' => $this->input->post('city'),
			'province_id' => $this->input->post('province'),
			'country_id' => $this->input->post('country'),
			'address_type_id' => $this->input->post('addtype'),
     	);
     	// $custid = $this->input->post('custid');
     
     	$datareturn = $this->customer->insertAddress($address);
     
     	$addPersonAddress = array(
            'person_id' => $ids['lastperson'],
            'address_id' =>  $datareturn,
            'status_id' =>  1,
        );
     	$this->customer->insertPersonAddress($addPersonAddress);
     	$this->data['message'] = 'Data Inserted Successfully';
     

		foreach ($this->input->post('cust_cont_values') as $i => $value) {
			$cust_contact = array(
				'person_id'=> $ids['lastperson'],
				'contact_type_id' => $this->input->post('cust_cont_types')[$i],
				'contact_value' => $value,
				'status_id' => 1
			);
			$this->customer->insertContacts($cust_contact);
		}
		if (($this->input->post('old_cust_id')) > 0) {
			foreach ($this->input->post('old_cust_id') as $i => $value) {
				$cust_contact = array(
					'client_id' => $ids['lastclient'],
					'legacy_customer_id' => $value
				);
				$this->customer->save_legacy($cust_contact);
			}			
		}

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " Inserted new client ID " . $ids['lastclient']
        );
        $this->logs->log($log_entry);

        // echo json_encode($ids['lastclient']);
        // $this->session->unset_userdata('client_id_ses' => '');
        $this->session->set_userdata('client_id_ses', $ids['lastclient']);

		redirect(base_url().'marketing/customerslist');
	}

	

	public function saveCustomer_org(){
        $this->load->helper('date');

		// $arrfile =  $this->fileupload('userfile');
		// $filename = "";
		// if(array_key_exists('data',$arrfile)){
		// $filename = $arrfile['data'];
	 //    }
		$person = array(
			'lastname' => $this->input->post('cust_org_lname'),
			'firstname' => $this->input->post('cust_org_fname'),
			'middlename' => $this->input->post('cust_org_mname'),
			'sex' => $this->input->post('cust_org_gender'),
			'birthdate' => $this->input->post('cust_org_birthday'),
			'birthplace' => $this->input->post('cust_org_nationality'),
			'nationality' => $this->input->post('custNationality'),
			'civil_status_id' => $this->input->post('cust_org_civil'),
			'tin' => $this->input->post('cust_org_tin'),
			// 'picture_url' => $filename,
			);
		$person_id = $this->customer->insert_orgcontact_person_model($person);


		$cust_org = array(
			'organization_name' => $this->input->post('cust_org_name'),
			'person_id' => $person_id,
			'status_id' => 1,
			);
		$cust_org_id = $this->customer->insert_org_model($cust_org);


		$client = array(
            'client_type_id' => 2,
            'reference_id' =>  $cust_org_id,
            // 'person_id' => $person_id,
            'date_created' => date('Y-m-d H:i:s',now()),
            'status_id' =>  1,
        );
		$client_id = $this->customer->insert_client_model($client);

		
		foreach ($this->input->post('cust_org_cont_values') as $i => $value) {
			$cust_contact = array(
				'person_id'=> $person_id,
				'contact_type_id' => $this->input->post('cust_org_cont_types')[$i],
				'contact_value' => $value,
				'status_id' => 1
			);
			$cont_val = $this->customer->insertContacts($cust_contact);

			$org_cont = array(
				'organization_id' => $cust_org_id,
				'contact_id' => $cont_val,
				'status_id' => 1,
			);
			$cont_val = $this->customer->insert_org_contacts($org_cont);
			
		}


		$address = array(
			'line_1' => $this->input->post('cust_org_barangay'),
			'line_2' => $this->input->post('cust_org_street'),
			'line_3' => $this->input->post('cust_org_houseno'),
			'city_id' => $this->input->post('cust_org_city'),
			'province_id' => $this->input->post('cust_org_province'),
			'country_id' => $this->input->post('cust_org_country'),
			'address_type_id' => $this->input->post('cust_org_addtype'),
     	);
		$address_id = $this->customer->insertAddress($address);


		$comp_address = array(
			'organization_id' => $cust_org_id,
			'address_id' => $address_id,
			'status_id' => 1,
		);
		$this->customer->insert_org_address($comp_address);

        $this->session->set_userdata('client_id_ses', $client_id);

		redirect(base_url().'marketing/listingreservation');

		// redirect(base_url().'marketing/customerslist');
		// echo "string";
	}


	public function saveCustomer_org2(){
        $this->load->helper('date');

		// $arrfile =  $this->fileupload('userfile');
		// $filename = "";
		// if(array_key_exists('data',$arrfile)){
		// $filename = $arrfile['data'];
	 //    }
		$person = array(
			'lastname' => $this->input->post('cust_org_lname'),
			'firstname' => $this->input->post('cust_org_fname'),
			'middlename' => $this->input->post('cust_org_mname'),
			'sex' => $this->input->post('cust_org_gender'),
			'birthdate' => $this->input->post('cust_org_birthday'),
			'birthplace' => $this->input->post('cust_org_birthplace'),
			'nationality' => $this->input->post('cust_org_nationality'),
			'civil_status_id' => $this->input->post('cust_org_civil'),
			'tin' => $this->input->post('cust_org_tin'),
			// 'picture_url' => $filename,
			);
		$person_id = $this->customer->insert_orgcontact_person_model($person);


		$cust_org = array(
			'organization_name' => $this->input->post('cust_org_name'),
			'person_id' => $person_id,
			'status_id' => 1,
			);
		$cust_org_id = $this->customer->insert_org_model($cust_org);


		$client = array(
            'client_type_id' => 2,
            'reference_id' =>  $cust_org_id,
            // 'person_id' => $person_id,
            'date_created' => date('Y-m-d H:i:s',now()),
            'status_id' =>  1,
        );
		$client_id = $this->customer->insert_client_model($client);

		
		foreach ($this->input->post('cust_org_cont_values') as $i => $value) {
			$cust_contact = array(
				'person_id'=> $cust_org_id,
				'contact_type_id' => $this->input->post('cust_org_cont_types')[$i],
				'contact_value' => $value,
				'status_id' => 1
			);
			$cont_val = $this->customer->insertContacts($cust_contact);

			$org_cont = array(
				'organization_id' => $cust_org_id,
				'contact_id' => $cont_val,
				'status_id' => 1,
			);
			$cont_val = $this->customer->insert_org_contacts($org_cont);
			
		}


		$address = array(
			'line_1' => $this->input->post('cust_org_barangay'),
			'line_2' => $this->input->post('cust_org_street'),
			'line_3' => $this->input->post('cust_org_houseno'),
			'city_id' => $this->input->post('cust_org_city'),
			'province_id' => $this->input->post('cust_org_province'),
			'country_id' => $this->input->post('cust_org_country'),
			'address_type_id' => $this->input->post('cust_org_addtype'),
     	);
		$address_id = $this->customer->insertAddress($address);


		$comp_address = array(
			'organization_id' => $cust_org_id,
			'address_id' => $address_id,
			'status_id' => 1,
		);
		$this->customer->insert_org_address($comp_address);


		redirect(base_url().'marketing/customerslist');
		// echo "string";
	}



	public function get_org_info(){
		$datareturn = $this->customer->get_org_info_model($this->input->post('clientid'));
    	echo json_encode($datareturn);
	}
	

	public function savePartner(){
		 $id = $this->input->post('CustomerID');
		 $arrfile =  $this->fileupload('userfile');
		 $filename = "";
		 if(array_key_exists('data',$arrfile)){
		 $filename = $arrfile['data'];
	     }
		$person = array(
			'lastname' => $this->input->post('custLname'),
			'firstname' => $this->input->post('custFname'),
			'middlename' => $this->input->post('custMname'),
			'sex' => $this->input->post('custGender'),
			'birthdate' => $this->input->post('birthdate'),
			'birthplace' => $this->input->post('custPlaceOfBirth'),
			'nationality' => $this->input->post('custNationality'),
			'civil_status_id' => $this->input->post('custCivilStatus'),
			'tin' => $this->input->post('custTIN'),
			'picture_url' => $filename,
			);

		$last_personid = $this->customer->insertPersonPartner($person, $id);
		
		$address = array(
			'line_1' => $this->input->post('barangay'),
			'line_2' => $this->input->post('street_line2'),
			'line_3' => $this->input->post('house_num_line3'),
			'city_id' => $this->input->post('city'),
			'province_id' => $this->input->post('province'),
			'country_id' => $this->input->post('country'),
			'address_type_id' => $this->input->post('addtype'),
	    );
	    $last_addr = $this->customer->insertAddress($address);

	    $person_address_data = array(
                'person_id' => $last_personid,
                'address_id' =>  $last_addr,
                'status_id' =>  1,
            );
	    $this->customer->insertPersonAddress($person_address_data);

	    $user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " Inserted new partner person ID" . $last_personid . ' of customer ' . $id
        );
        $this->logs->log($log_entry);

	}


	public function enrollBroker(){
		$this->data['content'] = 'Enrollbroker';
		$this->data['page_title'] = 'Marketing';
		$this->load->view('default/index', $this->data);
	
	}

	public function modifyPerson(){

		$id = $this->input->post('CustomerID');
		$arrfile =  $this->fileupload('userfile');
		$filename = "";
		if(array_key_exists('data',$arrfile)){
		$filename = $arrfile['data'];
	    }
     	$dataperson = array(
			'lastname' => $this->input->post('custLname'),
			'firstname' => $this->input->post('custFname'),
			'middlename' => $this->input->post('custMname'),
			'sex' => $this->input->post('custGender'),
			'birthdate' => $this->input->post('birthdate'),
			'birthplace' => $this->input->post('custPlaceOfBirth'),
			'nationality' => $this->input->post('custNationality'),
			'civil_status_id' => $this->input->post('custCivilStatus'),
			'tin' => $this->input->post('custTIN'),
			'picture_url' => $filename,
			);
     	$cust_org_data = array('organization_name' => $this->input->post('comp_name'));
     	$this->customer->update_organization($cust_org_data, $this->input->post('cust_org_id'));
     	
		$cust_work_data = array(
			'organization_id' => $this->input->post('cust_org_id'),
			'occupation' => $this->input->post('cust_occupation'),
			'job_title' => $this->input->post('job_title'),
			'monthly_gross_income' => $this->input->post('cust_income'),
			'source_of_funds' => $this->input->post('cust_funds')
			);
		$this->customer->update_customer_work($cust_work_data, $this->input->post('cust_work_id'));
		// print_r($cust_work_data);

     	$customer = array(
            'customer_fullname' =>  $this->input->post('custLname') .', '. $this->input->post('custFname') .' '. $this->input->post('custMname'),
            );

		$this->customer->updatePerson($id, $dataperson, $customer);

		//Address loop
     	if (($this->input->post('cust_addtype')) > 0) {
     		foreach ($this->input->post('cust_addtype') as $i => $value) {
		     	$address = array(
					'line_1' => $this->input->post('cust_brgy')[$i],
					'line_2' => $this->input->post('cust_street')[$i],
					'line_3' => $this->input->post('cust_house')[$i],
					'city_id' => $this->input->post('cust_city')[$i],
					'province_id' => $this->input->post('cust_prov')[$i],
					'country_id' => $this->input->post('cust_country')[$i],
					'address_type_id' => $value,
			 	);
			 	// $custid = $this->input->post('custid');

				$datareturn = $this->customer->insertAddress($address);

				$addPersonAddress = array(
			              'person_id' => $id,
			              'address_id' =>  $datareturn,
			              'status_id' =>  1,
			          );
				$this->customer->insertPersonAddress($addPersonAddress);
     		}
     	}


     	//contact loop
		if (($this->input->post('cust_cont_values')) > 0) {
			foreach ($this->input->post('cust_cont_values') as $i => $value) {
				$cust_contact = array(
					'person_id'=> $id,
					'contact_type_id' => $this->input->post('cust_cont_types')[$i],
					'contact_value' => $value,
					'status_id' => 1
					);
					$this->customer->insertContacts($cust_contact);
			}
				
		}

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'update',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . "updated Customer ID " . $id
        );
        $this->logs->log($log_entry);

		redirect(base_url().'marketing/customerslist', 'refresh');
	}

	public function retrieveOnCustomer(){
    	$datareturn = $this->customer->getOnePerson($this->input->post('clientid'));
    	echo json_encode($datareturn);
	}

	public function get_address(){
		$datareturn = $this->customer->get_address_model($this->input->post('clientid'));
      	echo json_encode($datareturn);
	}
	
	public function add_agent(){
      $agent_info = array(
			'broker_id' => $this->input->post('broker'),
			'person_id' => $this->input->post('person'),
			'status_id' => 1,
	        );
	  $datareturn = $this->customer->save_agent($agent_info);

	  $user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . "Inserted new Agent ID " . $datareturn
        );
        $this->logs->log($log_entry);

      echo json_encode($datareturn);
	}

	public function retrieve_customers_amortization(){
      $datareturn = $this->customer->get_contracts($this->input->post('clientid'));
      echo json_encode($datareturn);
	}
	public function retrieveOnCustomerPartner(){
      $datareturn = $this->customer->getCustomerPartner($this->input->post('clientid'));
      echo json_encode($datareturn);
	}
	public function amortizationdetails(){
	  $this->data['content'] = 'amortizationdetails';
	  $this->data['page_title'] = 'Sales and Marketing';
	  $this->data['amort'] = $this->customer->get_amortization($this->input->get('contractid'));
	  $this->data['misc'] = $this->customer->get_miscellaneous_model($this->input->get('contractid'));
	  $this->data['contract'] = $this->customer->get_contract_model($this->input->get('contractid'));
	  $this->data['payment'] = $this->customer->paid_amortization_model($this->input->get('contractid'));
	  $this->data['cont_stat_val'] = $this->customer->contract_status_model();
      $this->load->view('default/index', $this->data); 
	}
	
	public function trigger_update_amort(){
	  $newdata = array(
			'due_date' => $this->input->post('det_duedate'),
			'amortization_amount' => $this->input->post('det_amort_amt'),
			'miscellaneous_fee' => $this->input->post('det_misc'),
			'interest_amount' => $this->input->post('det_interest'),
			'principal_amount' => $this->input->post('det_principal'),
			'outstanding_balance' => $this->input->post('det_balance'),
	        ); 
	  $this->customer->update_amortization($newdata,$this->input->post('det_id'));
	  redirect(base_url().'marketing/amortizationdetails?contractid='. $this->input->post('det_contid'), 'refresh');
	
	}
	public function addressSave(){
      $address = array(
		'line_1' => $this->input->post('barangay'),
		'line_2' => $this->input->post('street2'),
		'line_3' => $this->input->post('house_num2'),
		'city_id' => $this->input->post('city'),
		'province_id' => $this->input->post('province'),
		'country_id' => $this->input->post('country'),
		'address_type_id' => $this->input->post('addid'),
	  );
	  $custid = $this->input->post('custid');

	  $datareturn = $this->customer->insertAddress($address);

	  $addPersonAddress = array(
                'person_id' => $custid,
                'address_id' =>  $datareturn,
                'status_id' =>  1,
            );
	  $this->customer->insertPersonAddress($addPersonAddress);
      echo json_encode($datareturn);
	}
	public function fileupload($userfile){
        $config['upload_path']          = "./public/images/profiles/";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 50000;
        $config['max_width']            = 52024;
        $config['max_height']           = 51768;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        // echo($userfile);
        if ( ! $this->upload->do_upload($userfile))
        {		  
               $error =  array('error' => $this->upload->display_errors());
               return $error;
        }
        else
        {
                $datafile = array('data' => $this->upload->data('file_name'));
                return $datafile;
        }
    }

    public function reservationreport(){
        $this->data['content'] = 'reservationreport';
		$this->data['page_title'] = 'Reservation Report';
        $this->data['customjs'] = 'reservationreportjs';
        $this->data['reservation_report'] = $this->customer->getReservationReport();
		$this->load->view('default/index', $this->data);     
    }

    public function generateReservationReport(){
    	$fromDate = $this->input->post('fromDate');
    	$toDate = $this->input->post('toDate');
    	$datareturn = $this->customer->getReservationReportByDate($fromDate,$toDate);
    	echo json_encode($datareturn);
    }

    public function modifyIncentive(){
    	$incentiveId = $this->input->post('incentive_id');
		$incentiveScheme = array (
			'project_id' => $this->input->post('project_id'),
			'payment_scheme_id' => $this->input->post('payment_scheme_id'),
			'reservation_bonus' => $this->input->post('reservation_bonus'),
			'scheme_bonus' => $this->input->post('scheme_bonus'),
			);
		$this->customer->updateIncentiveScheme($incentiveId, $incentiveScheme);

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'update',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " updated incentive ID " . $incentiveId
        );
        $this->logs->log($log_entry);

    }

    public function commissionschemes(){
    	$this->data['content'] = 'commissionschemes';
		$this->data['page_title'] = 'Commission Schemes';
        $this->data['customjs'] = 'commissionjs';
        $this->data['commission'] = $this->customer->getCommissions();
        $this->data['commission_type'] = $this->customer->getCommissionsType();
        $this->data['commission_type2'] = $this->customer->getCommissionsType();
		$this->load->view('default/index', $this->data);  
    }

    public function saveCommission(){
    	$commission = array (
			'commission_name' => $this->input->post('commission_name'),
			'commission_type' => $this->input->post('commission_type'),
			'percent_commission' => $this->input->post('percent_commission'),
			'percent_tcp_paid' => $this->input->post('percent_tcp_paid'),
			);
		$comms_id = $this->customer->insertCommissionScheme($commission);

		$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'insert',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " inserted commission ID " . $comms_id
        );
        $this->logs->log($log_entry);

    }

    public function retrieveOnCommissionScheme(){
    	$datareturn = $this->customer->getOneCommissionScheme($this->input->post('commissionid'));
      	echo json_encode($datareturn);
    }

    public function modifyCommission(){
    	$commission_id = $this->input->post('commission_id');
    	$commission = array (
    		'commission_name' => $this->input->post('commission_name'),
			'commission_type' => $this->input->post('commission_type'),
			'percent_commission' => $this->input->post('percent_commission'),
			'percent_tcp_paid' => $this->input->post('percent_tcp_paid'),
    		);
    	$this->customer->updateCommission($commission_id,$commission);

    	$user = $this->users->get_user($this->session->userdata('user_id'));
		$log_entry = array(
            'log_date'=>date('Y-m-d H:i:s'),
            'user_id'=>$user['user_id'],
            'location'=>'Marketing Module',
            'object'=>'marketing',
            'event_type'=>'update',
            'description'=>$user['lastname'] . ", " . $user['firstname'] . " updated commission ID " . $commission_id
        );
        $this->logs->log($log_entry);
    }

    public function salesreport(){
    	$this->data['content'] = 'salesreport';
		$this->data['page_title'] = 'Sales Report';
        $this->data['customjs'] = 'salesreportjs';
        $this->data['sales'] = $this->customer->getSalesReport();
		$this->load->view('default/index', $this->data);  
    }
    public function generateSalesReport()
    {
    	$fromDate = $this->input->post('fromDate');
    	$toDate = $this->input->post('toDate');
    	$datareturn = $this->customer->getSalesReportByDate($fromDate,$toDate);
    	echo json_encode($datareturn);
    }

    public function getAllAvailableLot(){
       echo json_encode($this->customer->getAllAvailableLots());
    }

    public function get_broker_realty(){
       echo json_encode($this->customer->get_realty_brokers($this->input->post('realtyid')));
    }

     public function get_agent_realty(){
       echo json_encode($this->customer->getAgents($this->input->post('brokerid')));
    }

     public function get_project_byids(){
       echo json_encode($this->customer->retrieve_project_byids($this->input->post('projectid')));
    }

    public function retrieve_project_byid(){
       echo json_encode($this->customer->retrieve_project_byid_model($this->input->post('projectid')));
    }

    public function get_all_lots(){
       echo json_encode($this->customer->get_all_lots());
    }

    public function update_contract_status(){
    	$data = array(
    		'contract_status_id'=> $this->input->post('cont_status_id')
    	);
    	$datareturn = $this->customer->update_contract_status_model($this->input->post('cont_id'), $data);
    	echo json_encode($datareturn);
	}

    public function customer_pdf(){
    	$id = $this->input->get('personid');
    	// $this->data['content'] = 'reportpdf_view'; 
    	// $this->data['page_title'] = 'PDF';
    	$this->data['persons'] = $this->customer->getOnePerson($id);
    	// $this->load->view('marketing/reportpdf_view', $this->data); 
    	$this->load->library('Pdf');

		$pdf = new Pdf('L', 'in', 'MEMO', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('IRM System Generated PDF');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		ob_clean();
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,0,0), array(0,0,0));
		$pdf->setFooterData(array(0,0,0), array(0,0,0));

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}



        $person_val = $this->customer->getOnePerson($id);
        $person_address_val = $this->customer->get_address_model($id);
        $person_contract_val = $this->customer->get_contracts($id);

        $fullname 	 = $person_val[0]['lastname'] . ', ' . $person_val[0]['firstname'] . ' ' . $person_val[0]['middlename'];
        $gender 	 = $person_val[0]['sex'];
        $bday 		 = $person_val[0]['birthdate'];
        $cs 		 = $person_val[0]['civil_status_id'];
        $pob 		 = $person_val[0]['birthplace'];
        $nationality = $person_val[0]['nationality'];
        $tin 		 = $person_val[0]['tin'];
       
		// $font_size = $pdf->pixelsToUnits('5');
		


        $pdf->AddPage();
        // $pdf->WriteHTML($htmla, true, 0, true, true);
        $y = $pdf->getY();
		// set color for background
		$pdf->SetFillColor(255, 255, 255);
		$pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(10);

        $pdf->writeHTMLCell(30, '', '', $y, '<b>Name: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(60, '', '', '', $fullname, 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Gender: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $gender, 0, 0, 0, true, 'L', true);
        // $pdf->Ln(7);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Birthdate: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $bday , 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Birthplace: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $pob, 0, 0, 0, true, 'L', true);
        
        $pdf->writeHTMLCell(30, '', '', '', '<b>Nationality: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $nationality, 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(30, '', '', '', '<b>TIN: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $tin, 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(15);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Address: </b>', 0, 0, 0, true, 'L', true);
        
        $add_ref = 0;
        foreach ($person_address_val as $key => $value) {
        	$pdf->Ln(7);
        	$address_val = 
        		$value['line_1'] . " " . 
        		$value['line_2'] . " " . 
        		$value['line_3'] . ", " . 
	        	$value['city_name'] . ", " . 
	        	$value['province_name'] . ", " . 
	        	$value['country_name'];

        	if ($value['province_name'] !== null && $value['province_name'] !== null) {
	        	$pdf->writeHTMLCell(200, '', 20, '', $address_val, 0, 0, 0, true, 'L', true);
    		}else{
    			$pdf->writeHTMLCell(200, '', 20, '', 'No Data to Display', 0, 0, 0, true, 'L', true);
    		}
		 	$add_ref = $value['address_id'];
        		
        }

        $pdf->Ln(15);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Contacts: </b>', 0, 0, 0, true, 'L', true);
        
        $ref = 0;
        foreach ($person_val as $key => $value) {
        	$contact_type_val = $value['contact_type_name'];
        	$contact_val = $value['contact_value'];
        	if ($contact_val !== null && $ref !=  $value['contact_id']) {
	        	$pdf->Ln(7);
	        	$pdf->writeHTMLCell(30, '', 20, '',$contact_type_val . ': ', 0, 0, 0, true, 'L', true);
	        	$pdf->writeHTMLCell(50, '', '', '', $contact_val, 0, 0, 0, true, 'L', true);
        	}else{
        		$pdf->Ln(7);
        		$pdf->writeHTMLCell(200, '', 20, '', 'No Data to Display', 0, 0, 0, true, 'L', true);
        	}
        	$ref = $value['contact_id'];
        }

        $pdf->Ln(15);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Accounts: </b>', 0, 0, 0, true, 'L', true);
        foreach ($person_contract_val as $key => $value) {
        	if ($value['lot_description'] !== null) {
	        	$cont_val = $value['lot_description'];
        	}else{
        		$cont_val = 'No Data to Display';
        	}
	        $pdf->Ln(7);		
			$pdf->writeHTMLCell(200, '', 20, '', ($key + 1) .'. '. $cont_val, 0, 0, 0, true, 'L', true);
        }


        $pdf->Output('Customer_info.pdf', 'I'); 
    }

    public function pdf_amortsched(){
    	//pdf_amort_sched ------> (customermasterlist.js)button ID for Amortization Schedule to PDF

		$this->load->library('Pdf');
		$pdf = new Pdf('L', 'in', 'MEMO', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('IRM System Generated PDF');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,0,0), array(0,0,0));
		$pdf->setFooterData(array(0,0,0), array(0,0,0));


		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);


		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		$pdf->SetFont ('helvetica', '', 9 , 15, 'default', true );

		$id_contract = $this->input->get('id_contract');
    	$contract_val = $this->customer->get_contract_model($id_contract);
    	$amort_val = $this->customer->get_amortization($id_contract);
		ob_clean();
		// $dpint = "";
		// $balint = "";
		
		if ($contract_val->downpayment_interest_rate != 0.00) {
			$dpint = $contract_val->downpayment_interest_rate . " Interest";
		}else{
			$dpint = "INTEREST FREE";
		}
		if ($contract_val->balance_interest_rate != 0.00) {
			$balint = $contract_val->balance_interest_rate . " Interest";
		}else{
			$balint = "INTEREST FREE";
		}
		$contract_date  = strtotime(date("Y-m-d", strtotime($contract_val->contract_date)) . "+1 month");
		// $amort_date 	= date_add($contract_date, date_interval_create_from_date_string('1 month'));
		$contractid 	= $contract_val->contract_id;
		$cust_name 		= $contract_val->lastname . ', ' . $contract_val->firstname . ' ' . $contract_val->middlename;
		$dp_scheme      = $contract_val->downpayment_ratio . "% TCP in " . $contract_val->downpayment_terms . "months @ - " . $dpint . " - " . $contract_val->downpayment_discount_rate . "% Discount - and " . $contract_val->downpayment_surcharge_rate . "% Surcharge";
		$bal_scheme		= $contract_val->balance_ratio . "% TCP in " . $contract_val->balance_terms . "months @ - " . $balint . " - and " . $contract_val->balance_surcharge_rate . "% Surcharge";
		$lot_desc 		= $contract_val->lot_description;
		$plan_type 		= $contract_val->payment_scheme_name;
		$sqm 			= $contract_val->lot_area;
		$price_sqm 		= number_format($contract_val->price_per_sqr_meter, 2);
		$lot_price 		= number_format($contract_val->lot_area * $contract_val->price_per_sqr_meter, 2);
		$house 			= number_format($contract_val->house_price, 2);
		$tcp_amount 	= number_format($contract_val->lot_price, 2);
		$added_vat 		= number_format($contract_val->lot_vat, 2);
		if ($plan_type == null) {
			$plan_type = "Custom";
		}else{
			$plan_type  = $contract_val->payment_scheme_name;
		}

 
		$pdf->AddPage();
        // $pdf->WriteHTML($htmla, true, 0, true, true);
        $y = $pdf->getY();
		// set color for background
		$pdf->SetFillColor(255, 255, 255);
		$pdf->SetTextColor(0, 0, 0);

		// $pdf->WriteHTML("<h2 align='center'>Amortization Schedule</center></h2>");
		$pdf->writeHTMLCell(190, '', '', '', "<h2>Amortization Schedule</h2>", 0, 0, 0, true, 'C', true);
		
		$pdf->Ln(10);
 		$pdf->writeHTMLCell(30, '', '', '', '<b>Buyer: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(80, '', '', '', $cust_name, 0, 0, 0, true, 'L', true);
        
        $pdf->writeHTMLCell(40, '', '', '', '<b>Area(Sq.Mtr): </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', $sqm, 0, 0, 0, true, 'R', true);

		$pdf->Ln(5);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Lot : </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(80, '', '', '', $lot_desc, 0, 0, 0, true, 'L', true);
        
        $pdf->writeHTMLCell(40, '', '', '', '<b>Price/Sqr.Mtr: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', $price_sqm, 0, 0, 0, true, 'R', true);

        $pdf->Ln(1);
        $pdf->writeHTMLCell(30, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(80, '', '', '', '', 0, 0, 0, true, 'L', true);

        // $pdf->writeHTMLCell(40, '', '', '', '<b>TCP: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(70, '', '', '', '______________________________________', 0, 0, 0, true, 'R', true);

        $pdf->Ln(4);
        $pdf->writeHTMLCell(30, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(80, '', '', '', '', 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(40, '', '', '', '<b>TCP: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', $lot_price, 0, 0, 0, true, 'R', true);

        $pdf->Ln(5);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Scheme/Terms: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(80, '', '', '', '', 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(40, '', '', '', '<b>House: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', $house, 0, 0, 0, true, 'R', true);



		$pdf->Ln(1);
        $pdf->SetFont ('helvetica', '', 9 , 15, 'default', true );
        $pdf->writeHTMLCell(30, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(80, '', '', '', '', 0, 0, 0, true, 'L', true);
        
        $pdf->writeHTMLCell(70, '', '', '', '______________________________________', 0, 0, 0, true, 'R', true);

		$pdf->Ln(4);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );
        $pdf->writeHTMLCell(30, '', '', '', '<b> Downpayment: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(80, '', '', '', $dp_scheme, 0, 0, 0, true, 'L', true);

        $pdf->SetFont ('helvetica', '', 9 , 15, 'default', true );
        $pdf->writeHTMLCell(40, '', '', '', '<b>Add VAT: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', $added_vat, 0, 0, 0, true, 'R', true);

		$pdf->Ln(4);
		$pdf->writeHTMLCell(30, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(80, '', '', '', '', 0, 0, 0, true, 'L', true);
        
		$pdf->writeHTMLCell(40, '', '', '', '<b>Total TCP: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>'.$tcp_amount.'</b>', 0, 0, 0, true, 'R', true);


        $pdf->Ln(5);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );
        $pdf->writeHTMLCell(30, '', '', '', '<b> Balance: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(80, '', '', '', $bal_scheme, 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Amortization Date: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', date("M d, Y", $contract_date), 0, 0, 0, true, 'R', true);

        //Amort Schedule Infos
        $pdf->SetFont ('helvetica', '', 9 , 15, 'default', true );

        $pdf->Ln(8);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);
        $pdf->Ln(5);
        $pdf->writeHTMLCell(10, '', 15, '', '<b>No.</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', 40, '', '<b>Date</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', 70, '', '<b>Amortization</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 100, '', '<b>Interest</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 140, '', '<b>Principal</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(35, '', 160, '', '<b>Balance</b>', 0, 0, 0, true, 'R', true);
        // $pdf->writeHTMLCell(20, '', '', '', '<b>Plan Type: </b>', 0, 0, 0, true, 'L', true);
        $pdf->Ln(1);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);
        
        $i = 0; $str = "";
        $total_amort = 0; $total_int = 0; $total_princ = 0;
        if (count($amort_val) > 0) {
	        $type = $amort_val[0]['line_type'];
	        foreach ($amort_val as $amort_val) {
	        	if ($amort_val['line_type'] == 4 || $amort_val['line_type'] == 3) {
	        		if ($amort_val['line_type'] != $type) {
						$i = 0;
					}
	        		$i++;
	        	}else{
	        		$i = 1;
	        	}
				if ($amort_val['line_type'] == 4) {
					$str = "A" . str_pad($i, 3, "0",STR_PAD_LEFT);
				}else if ($amort_val['line_type'] == 3) {
					$str = "DP" . str_pad($i, 3, "0", STR_PAD_LEFT);
				}else if ($amort_val['line_type'] == 2){
					$str = "Deposit";
				}else if ($amort_val['line_type'] == 1) {
					$str = "Discount";
				}
				
	        	$pdf->Ln(5);
	        	$pdf->writeHTMLCell(20, '', 15, '', $str, 0, 0, 1, true, 'L', true);
		        $pdf->writeHTMLCell(30, '', 40, '', date("M d, Y", strtotime($amort_val['due_date'])), 0, 0, 0, true, 'L', true);
		        $pdf->writeHTMLCell(25, '', 70, '', number_format($amort_val['amortization_amount'], 2), 0, 0, 0, true, 'R', true);
		        $pdf->writeHTMLCell(25, '', 100, '', number_format($amort_val['interest_amount'], 2), 0, 0, 0, true, 'R', true);
		        $pdf->writeHTMLCell(25, '', 140, '', number_format($amort_val['principal_amount'], 2), 0, 0, 0, true, 'R', true);
		        $pdf->writeHTMLCell(35, '', 160, '', number_format($amort_val['outstanding_balance'], 2), 0, 0, 0, true, 'R', true);
	        	$type = $amort_val['line_type'];
	        	$total_amort += $amort_val['amortization_amount'];
				$total_int 	 += $amort_val['interest_amount'];
				$total_princ += $amort_val['principal_amount'];
				$top_margin = PDF_MARGIN_HEADER;
				if ($pdf->getY() > (240 /*height*/ - $top_margin + 30 /*another magic constant*/)) {
				    $pdf->addPage();
				}
	        }

	        // $pdf->AddPage(8);
	        $pdf->Ln(4);

        	$pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);
	        $pdf->Ln(4);
	        $pdf->writeHTMLCell(10, '', 15, '', '', 0, 0, 0, true, 'L', true);
	        $pdf->writeHTMLCell(30, '', 40, '', '<b>TOTALS: </b>', 0, 0, 0, true, 'L', true);
	        $pdf->writeHTMLCell(25, '', 70, '', number_format($total_amort, 2), 0, 0, 0, true, 'R', true);
	        $pdf->writeHTMLCell(25, '', 100, '', number_format($total_int, 2), 0, 0, 0, true, 'R', true);
	        $pdf->writeHTMLCell(25, '', 140, '', number_format($total_princ, 2), 0, 0, 0, true, 'R', true);
	        // $pdf->writeHTMLCell(35, '', 160, '', '<b>Balance</b>', 0, 0, 0, true, 'R', true);
	        
	        $pdf->Ln(8);
        	$pdf->SetFont ('helvetica', '', 7 , 15, 'default', true );
        	$pdf->writeHTMLCell(100, '', '', '', 'Please be reminded that in case of any payment default, a penalty of 3% per month compounded monthly shall be charged as stipulated  in the Reservation Agreement and the Contract to Sell.', 0, 0, 0, true, 'L', true);
	        
	        $pdf->Ln(15);
        	$pdf->SetFont ('helvetica', '', 9 , 15, 'default', true );
        	$pdf->writeHTMLCell(108, '', '', '', 'Conforme:', 0, 0, 0, true, 'R', true);

	        $pdf->Ln(10);
	        $pdf->writeHTMLCell(30, '', '', '', '', 0, 0, 0, true, 'L', true);
	        $pdf->writeHTMLCell(60, '', '', '', '', 0, 0, 0, true, 'L', true);

	        $pdf->writeHTMLCell(50, '', '', '', $cust_name, 0, 0, 0, true, 'C', true);
	        $pdf->writeHTMLCell(50, '', '', '', '', 0, 0, 0, true, 'C', true);

	        $pdf->Ln(1);
        	$pdf->writeHTMLCell(30, '', '', '', '', 0, 0, 0, true, 'L', true);
	        $pdf->writeHTMLCell(60, '', '', '', '', 0, 0, 0, true, 'L', true);

	        $pdf->writeHTMLCell(50, '', '', '', '___________________________', 0, 0, 0, true, 'L', true);
	        $pdf->writeHTMLCell(50, '', '', '', '___________________________', 0, 0, 0, true, 'R', true);

	        $pdf->Ln(4);
	        $pdf->writeHTMLCell(30, '', '', '', '', 0, 0, 0, true, 'L', true);
	        $pdf->writeHTMLCell(60, '', '', '', '', 0, 0, 0, true, 'L', true);

 			$pdf->writeHTMLCell(50, '', '', '', 'Buyer', 0, 0, 0, true, 'C', true);
	        $pdf->writeHTMLCell(50, '', '', '', 'Spouse', 0, 0, 0, true, 'C', true);
 			

        }

        $pdf->Output('Amortization_Schedule.pdf', 'I'); 
    }

    public function xls_reserevationreport(){
    	$this->load->library('Excel', NULL, 'excel');
    	$this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('reservations');
    	$this->excel->setActiveSheetIndex(0);

    	$from = $this->input->post('from_date');
    	$to = $this->input->post('to_date');

    	$data = $this->customer->getReservationReportByDate($from,$to);

        $styleArray = array(
        	'font'  => array(
            'bold'  => true,
            'size'  => 15,
        ));

        $styleArray2 = array(
        	'font'  => array(
            'size'  => 15,
        ));

        $styleArray3 = array(
        	'font'  => array(
            'bold'  => true,
            'size'  => 15,
            'color' => array('rgb' => 'FFFFFF'),
        ));

        $styleArray4 = array(
          	'borders' => array(
            'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
            )
          )
        );

        $this->excel->getActiveSheet()->mergeCells('A1:H1');
        $this->excel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A1', 'Reservation Report(' . $from . ' - ' . $to . ')');
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray4);

        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(80);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(40);

        $this->excel->getActiveSheet()->setCellValue('A2', 'Due Date');
        $this->excel->getActiveSheet()->setCellValue('B2', 'Lot Description');
        $this->excel->getActiveSheet()->setCellValue('C2', 'Lot Area');
        $this->excel->getActiveSheet()->setCellValue('D2', 'Area Cost');
        $this->excel->getActiveSheet()->setCellValue('E2', 'TCP');
        $this->excel->getActiveSheet()->setCellValue('F2', 'Customer Name');
        $this->excel->getActiveSheet()->setCellValue('G2', 'Realty');
        $this->excel->getActiveSheet()->setCellValue('H2', 'Agent');

        $r = 3;
        foreach ($data as $data) {
        	$this->excel->getActiveSheet()->fromArray(array($data['contract_date'], $data['lot_description'], $data['lot_area'] , $data['price_per_sqr_meter'], $data['total_contract_price'], $data['lname'] . ', ' . $data['fname'] . ' ' . $data['mname'], $data['organization_name'], $data['agent_lname'] . ', ' . $data['agent_fname'] . ' ' . $data['agent_mname']), null, 'A'.$r);
            $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray2);
            $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray4);
        	$r++;
        }

        date_default_timezone_set("Asia/Manila");
        $timestamp=date("Y-m-d-His");
        $filename='reservations.xls'; 
 
        $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0');

        ob_end_clean();
        $writer->save('../irm/reports/' . $filename);
        // $writer->save('/var/www/html/reports/' . $filename); sa Server

        exit();
    }

    public function xls_salesreport(){
    	// getSalesReportByDate - model for the sales report
    	$this->load->helper('date');
    	$this->load->library('Excel', NULL, 'excel');
    	$this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('reservations');
    	$this->excel->setActiveSheetIndex(0);

    	$from = $this->input->post('from_date');
    	$to = $this->input->post('to_date');

    	$data = $this->customer->getSalesReportByDate($from,$to);

        $styleArray = array(
        	'font'  => array(
            'bold'  => true,
            'size'  => 15,
        ));

        $styleArray2 = array(
        	'font'  => array(
            'size'  => 15,
        ));

        $styleArray3 = array(
        	'font'  => array(
            'bold'  => true,
            'size'  => 15,
            'color' => array('rgb' => 'FFFFFF'),
        ));

        $styleArray4 = array(
          	'borders' => array(
            'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
            )
          )
        );


        $this->excel->getActiveSheet()->mergeCells('A1:H1');
        $this->excel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A1', 'Sales Report(' . $from . ' - ' . $to . ')');
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray4);

        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(80);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);

        $this->excel->getActiveSheet()->setCellValue('A2', 'Block');
        $this->excel->getActiveSheet()->setCellValue('B2', 'Lot');
        $this->excel->getActiveSheet()->setCellValue('C2', 'Project Name');
        $this->excel->getActiveSheet()->setCellValue('D2', 'Buyer');
        $this->excel->getActiveSheet()->setCellValue('E2', 'Date of Sale');
        $this->excel->getActiveSheet()->setCellValue('F2', 'Date Registered');
        $this->excel->getActiveSheet()->setCellValue('G2', 'Contract Status');
        $this->excel->getActiveSheet()->setCellValue('H2', 'Remarks');

        $r = 3;
        foreach ($data as $data) {
        	if ($data['is_paid'] === 1) {
        		$remarks = 'Fully Paid';
        	}else{
        		$remarks = 'Installment';
        	}
        	$this->excel->getActiveSheet()->fromArray(array($data['block_no'], $data['lot_no'],  $data['project_name'], $data['lastname'] . ', ' . $data['firstname'] . ' ' . $data['middlename'], $data['sold_date'], $data['contract_date'], $data['contract_status_name'],  $remarks), null, 'A'.$r);
            $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray2); 
            $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray4);
        	$r++;
        }

        date_default_timezone_set("Asia/Manila");
        $timestamp=date("Y-m-d-His");
        $filename='salesreport.xls'; 
 
        $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0');

        ob_end_clean();
        // $writer->save('/var/www/html/reports/' . $filename); sa Server
        $writer->save('../irm/reports/' . $filename);

        exit();

    }

    public function legacycustomer(){
    	$this->data['content'] = 'legacycustomers';
        $this->data['page_title'] = 'Sales and Marketing';
        $this->data['legacy_cust'] = $this->customer->get_all_legacy_model();

		$this->load->view('default/index', $this->data);
    }

    public function get_legacycust(){
    	$fname = $this->input->post('fname');
    	$lname = $this->input->post('lname');
    	$custname = $this->customer->get_legacycust_model($fname, $lname);
		echo json_encode($custname);
    }

    public function get_legacy_info(){
    	$legacy = $this->customer->get_legacy_info_model($this->input->post('clientid'));
		echo json_encode($legacy);
    	// get_legacy_info_model
    }



    #functions for dashboard
    public function get_reserve_fees(){
    	$reserve = $this->dashboards->reservations_activity();
		echo json_encode($reserve);
    }
    public function get_tcp(){
    	$tcp = $this->dashboards->tcp_activity();
		echo json_encode($tcp);
    }
    public function get_survey(){
    	$tcp = $this->dashboards->get_survey_model();
		echo json_encode($tcp);
    }


    // mancom reports
    public function mancom(){
		//$data['customcss'] = 'marketing/customcss';
    	$this->data['content'] = 'mancom';
        $this->data['page_title'] = 'Management Committee Reports';
        $this->data['customjs'] = 'marketing/mancomjs';
		$this->data['all_projects'] = $this->customer->retrieve_all_project();

		$this->load->view('default/index', $this->data);
    }

    public function get_mancom_year(){
    	$mancom = $this->customer->get_mancom_year_model($this->input->post('mancom_date'));
		echo json_encode($mancom);
    }

    public function get_mancom_monthly(){
    	$mancom = $this->customer->get_mancom_monthy_model($this->input->post('mancom_date'));
		echo json_encode($mancom);
    }

    public function lotinventory(){
    	$this->data['content'] = 'lotinventory';
        $this->data['page_title'] = 'Lot Inventory Report';
        $this->data['customjs'] = 'marketing/lotinventoryjs';
		// $this->data['all_projects'] = $this->customer->retrieve_all_project();

		$this->load->view('default/index', $this->data);
    }

    public function get_all_lotinv(){
    	$mancom = $this->customer->get_all_lotinv_model($this->input->post('inventory_date'));
		echo json_encode($mancom);
    }

    public function get_sold_lotinv(){
    	$mancom = $this->customer->get_sold_lotinv_model($this->input->post('inventory_date'));
		echo json_encode($mancom);
    }

    public function get_avail_lotinv(){
    	$mancom = $this->customer->get_ending_lotinv_model($this->input->post('inventory_date'));
		echo json_encode($mancom);
    }

    public function get_unit_count(){
    	$mancom = $this->customer->get_unit_count_model($this->input->post('proj_id'));
		echo json_encode($mancom);
    }

    public function documentstatus(){
    	$this->data['content'] = 'docstatus';
        $this->data['page_title'] = "Customer's Documents Status";
        $this->data['customjs'] = 'marketing/docstatusjs';
		$this->data['all_projects'] = $this->customer->retrieve_all_project();

		$this->load->view('default/index', $this->data);
    }

    public function get_contracts_docs(){
    	$docs = $this->customer->get_contracts_docs_model($this->input->post('proj_id'));
		echo json_encode($docs);
    }

    public function update_docs(){
    	$id = $this->input->post('contract_id');
    	$data = array(
    		'cts_date' => $this->input->post('edit_cts_date'),
			'cts_signed' => $this->input->post('edit_cts_signed'),
			'cts_notarized' => $this->input->post('edit_cts_notarized'),
			'doas_date' => $this->input->post('edit_doas_date'),
			'doas_signed' => $this->input->post('edit_doas_signed'),
			'doas_amount' => $this->input->post('edit_doas_amount')
    	);
    	// $this->customer->update_docs_model($id, $data);
    	echo json_encode($this->customer->update_docs_model($id, $data));
    }


    public function legacyreport(){
    	// $oks = $this->customer->test_old_model();
    	// echo "<script>console.log('" . json_encode($oks) . "');</script>"; 
    	$this->data['content'] = 'legacyreports';
        $this->data['page_title'] = "Legacy Reports";
        $this->data['customjs'] = 'marketing/legacyreportsjs';
		$this->data['contracts'] = $this->customer->get_legacy_contracts_model();

		$this->load->view('default/index', $this->data);

    }

    
    public function test_old(){
    	$oks = $this->customer->test_old_model();
    	echo "<script>console.log('" . json_encode($oks) . "');</script>";
    }
}

?>
