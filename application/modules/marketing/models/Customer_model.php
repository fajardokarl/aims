<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model {


	public function __construct()
    {
        // call parent constructor
        parent::__construct();

    }
    
    function get_customers(){
        $this->db->select('*');
        $this->db->from('client a');
        $this->db->join('organization e', 'a.reference_id = e.organization_id', 'left');
        // $this->db->join('customer b', 'a.reference_id = b.customer_id', 'left');
        $this->db->join('client_type c', 'c.client_type_id = a.client_type_id', 'left');
        $this->db->join('person d', 'd.person_id = a.reference_id', 'left');

        $this->db->where('a.status_id',1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_name_model($id){
        $this->db->select('organization_name, d.lastname, d.firstname, d.middlename, a.client_type_id');
        $this->db->from('client a');
        $this->db->join('organization e', 'a.reference_id = e.organization_id', 'left');
        $this->db->join('customer b', 'a.reference_id = b.customer_id', 'left');
        $this->db->join('client_type c', 'c.client_type_id = a.client_type_id', 'left');
        $this->db->join('person d', 'd.person_id = b.person_id', 'left');

        $this->db->where('a.status_id',1);
        $this->db->where('a.client_id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    function update_organization($data, $id){
        $this->db->trans_start();
        $this->db->where('organization_id', $id);
        $this->db->update('organization', $data);
        $this->db->trans_complete();
    }

    function update_customer_work($data, $id){
        $this->db->trans_start();
        $this->db->where('customer_work_id', $id);
        $this->db->update('customer_work', $data);
        $this->db->trans_complete();
    }

    function get_persons()
    {
        $this->db->select('*');
        $this->db->from('broker a');
        $this->db->join('person b', 'a.person_id=b.person_id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_org_info_model($id){
        $this->db->select('*');
        $this->db->from('client a');
        $this->db->join('organization b', 'a.reference_id = b.organization_id', 'inner');
        $this->db->join('person c', 'b.person_id = c.person_id', 'inner');
        // $this->db->join('organization_contact d', 'b.or = c.person_id', 'inner'); //Adjusted from database
        $this->db->join('contact e', 'b.person_id = e.person_id', 'left');
        $this->db->join('organization_address f', 'b.organization_id = f.organization_id', 'inner');
        $this->db->join('address g', 'f.address_id = g.address_id', 'inner');


        $this->db->where('client_id', $id);
        $query = $this->db->get();
        return $query->result_array(); 
    }
// New Customer Form

    // function insert_client_model($data){
    //     $this->db->trans_start();
    //     $this->db->insert('client', $data);
    //     $client = $this->db->insert_id();
    //     $this->db->trans_complete();
    //     return $client;
    // }
    function insert_person_model($data){
        $this->db->trans_start();
        $this->db->insert('person', $data);
        $person = $this->db->insert_id();
        $this->db->trans_complete();
        return $person;
    }
    
    function insert_address_model($data){
        $this->db->trans_start();
        $this->db->insert('address', $data);
        $addr = $this->db->insert_id();
        $this->db->trans_complete();
        return $addr;
    }

    function insert_personaddress_model($data){
        $this->db->trans_start();
        $this->db->insert('person_address', $data);
        $p_addr = $this->db->insert_id();
        $this->db->trans_complete();
        return $p_addr;
    }

    function insert_contact_model($data){
        $this->db->trans_start();
        $this->db->insert('person_contact', $data);
        $cont = $this->db->insert_id();
        $this->db->trans_complete();
        return $cont;
    }

    function insert_clientfund_model($data){
        $this->db->trans_start();
        $this->db->insert('client_fund_source', $data);
        $fund = $this->db->insert_id();
        $this->db->trans_complete();
        return $fund;
    }

    function insert_customerwork_model($data){  
        $this->db->trans_start();
        $this->db->insert('customer_work', $data);
        $work = $this->db->insert_id();
        $this->db->trans_complete();
        return $work;
    }

    function insert_partner_model($data){  
        $this->db->trans_start();
        $this->db->insert('customer_partner', $data);
        $partner = $this->db->insert_id();
        $this->db->trans_complete();
        return $partner;
    }

    function insert_reference_model($data){  
        $this->db->trans_start();
        $this->db->insert('personal_reference', $data);
        $ref = $this->db->insert_id();
        $this->db->trans_complete();
        return $ref;
    }

    function get_partner_model($id){
        $this->db->select('lastname, firstname, middlename');
        $this->db->from('customer_partner a');
        $this->db->join('person b', 'a.person_id = b.person_id', 'inner');
        $this->db->where('a.client_id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    // function insertPerson($data, $last_org, $survey) ORIGINAL
    // {
    //     $this->db->trans_start();
    //     $this->db->insert('person', $data);
    //     $lastPersonID = $this->db->insert_id();
    //     $customer = array(
    //         'customer_fullname' => $data['lastname'].', '. $data['firstname'].' '. $data['middlename'],
    //         'person_id' =>  $lastPersonID,
    //         'customer_work_id' => $last_org
    //      );

    //     $this->db->insert('customer', $customer);
    //     $lastCustomerID = $this->db->insert_id();
    //     $client = array(
    //         'client_type_id' => 1,
    //         'reference_id' =>  $lastCustomerID,
    //         'status_id' =>  1,
    //         // 'reason_price' => $survey['reason_price'],
    //         // 'reason_location' => $survey['reason_location'],
    //         // 'reason_design' => $survey['reason_design'],
    //         // 'reason_developer' => $survey['reason_developer'],
    //         // 'reason_others' => $survey['reason_others'],
    //         // 'source_flyers' => $survey['source_flyers'],
    //         // 'source_refer' => $survey['source_refer'],
    //         // 'source_invitation' => $survey['source_invitation'],
    //         // 'source_billboard' => $survey['source_billboard'],
    //         // 'source_magazine' => $survey['source_magazine'],
    //         // 'source_activity' => $survey['source_activity'],
    //         // 'source_online' => $survey['source_online'],
    //         // 'source_others' => $survey['source_others'],
    //      );
    //     $this->db->insert('client', $client);
    //     $last_client = $this->db->insert_id();
    //     $this->db->trans_complete();
    //     return array(
    //         'lastperson' => $lastPersonID,
    //         'lastclient'   => $last_client,
    //         // '' =>
    //     );
    // }

    function update_survey($id,$survey)
    {
        $this->db->trans_start();
        $this->db->where('client_id', $id);
        $this->db->update('client', $survey);
        $this->db->trans_complete();
    }

    function insert_orgcontact_person_model($data){
        $this->db->trans_start();
        $this->db->insert('person', $data);
        $personid = $this->db->insert_id();
        $this->db->trans_complete();
        return $personid;
    }

    function insert_client_model($data){
        $this->db->trans_start();
        $this->db->insert('client', $data);
        $clientid = $this->db->insert_id();
        $this->db->trans_complete();
        return $clientid;
    }

    function insert_org_model($data){
        $this->db->trans_start();
        $this->db->insert('organization', $data);
        $orgid = $this->db->insert_id();
        $this->db->trans_complete();
        return $orgid;        
    }

    function insert_org_contacts($data){
        $this->db->trans_start();
        $this->db->insert('organization_contact', $data);
        $cont = $this->db->insert_id();
        $this->db->trans_complete();
        // return $orgid;        
    }
    function insert_org_address($data){
        $this->db->trans_start();
        $this->db->insert('organization_address', $data);
        $add = $this->db->insert_id();
        $this->db->trans_complete();
        // return $orgid;        
    }

    function save_realty_model($data){
        $this->db->trans_start();
        $this->db->insert('realty', $data);
        $last_realty_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $last_realty_id;
    }

    // function insert_cust_org($data, $org_id){
    //     $this->db->trans_start();
    //     $this->db->insert('person', $data);
    //     $lastPersonID = $this->db->insert_id();
    //     $customer = array(
    //         'customer_fullname' => $data['lastname'].', '. $data['firstname'].' '. $data['middlename'],
    //         'person_id' =>  $lastPersonID,
    //         'customer_work_id' => $last_org
    //      );

    //     $this->db->insert('customer', $customer);
    //     $lastCustomerID = $this->db->insert_id();
    //     $client = array(
    //         'client_type_id' => 2,
    //         'reference_id' =>  $org_id,
    //         // 'person_id' => $lastCustomerID,
    //         'status_id' =>  1,
    //      );
    //     $this->db->insert('client', $client);
    //     $last_client = $this->db->insert_id();
    //     $this->db->trans_complete();
    //     return array(
    //         'lastorg' => $org_id,
    //         'lastclient'   => $last_client
    //         // '' =>
    //     );
    // }


    function insert_cust_work($data){
        $this->db->trans_start();
        $this->db->insert('customer_work', $data);
        $work = $this->db->insert_id();
        $this->db->trans_complete();
        return $work;
    }

    function insert_agent($data)
    {
        $this->db->trans_start();
        $this->db->insert('person', $data);
        $lastPersonID = $this->db->insert_id();
        return  $lastPersonID;
    }
    function insertPaymentScheme($data)
    {
        // $this->db->trans_start();
        $this->db->insert('payment_scheme', $data);
        $pay_scheme = $this->db->insert_id();
        return $pay_scheme;
        // $this->db->trans_complete();
    }
    function getOnePaymentScheme($data)
    {
        $this->db->select('*');
        $this->db->from('payment_scheme');
        $this->db->where('payment_scheme_id', $data);
        $query = $this->db->get();
        return $query->result_array();
    }
    function updatePaymentScheme($paymentScheme,$paymentSchemeId)
    {
        $this->db->trans_start();
        $this->db->where('payment_scheme_id', $paymentSchemeId);
        $this->db->update('payment_scheme', $paymentScheme);
        $this->db->trans_complete();
    }
    function save_contract($data){
        // $this->db->trans_start();
        $this->db->insert('contract', $data);
        $lastcontractID = $this->db->insert_id();
        return $lastcontractID;
        // $this->db->trans_complete();
    }
    function save_contract_history($data){
        // $this->db->trans_start();
        $this->db->insert('contract_scheme_history', $data);
        $lastcontractID = $this->db->insert_id();
        return $lastcontractID;
        // $this->db->trans_complete();
    }

    function lot_availability_model($id, $data){
        $this->db->trans_start();
        $this->db->where('lot_id', $id);
        $this->db->update('lot', $data);
        $this->db->trans_complete();
    }

    function save_amortization($data){
        // $this->db->trans_start();
        $this->db->insert('amortization', $data);
        $lastcontractID = $this->db->insert_id();
        return $lastcontractID;
        // $this->db->trans_complete();
    }
    function save_miscellaneous($data){
        // $this->db->trans_start();
        $this->db->insert('miscelaneous', $data);
        $misc = $this->db->insert_id();
        // return ($this->db->affected_rows() != 1) ? false : true;
        return $misc;
        // $this->db->trans_complete();
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
    function get_amortization($data){
        $this->db->select('*');
        $this->db->from('amortization a');
        $this->db->join('line_type b', 'a.line_type=b.line_type_id', 'left');
        $this->db->join('contract c', 'a.contract_id=c.contract_id');
        $this->db->where('a.contract_id', $data);
        $query = $this->db->get();
        return $query->result_array();
     }
    function save_agent($data){
        $this->db->insert('agent', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
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
    function insertPersonBank($data){
        $this->db->trans_start();
        $this->db->insert('person', $data);
        $lastPersonID = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastPersonID;
    }

     function retrieve_project_byids($data){
         $this->db->select('*');
         $this->db->from('project a');
         $this->db->join('lot b', 'b.project_id = a.project_id', 'left');
         $this->db->join('lot_price c', 'c.lot_id = b.lot_id', 'left');
         $this->db->join('project d', 'd.project_id = b.project_id', 'left');
         $this->db->join('phase f', 'f.phase_id = b.phase_id', 'left');
         $this->db->where('a.project_id', $data);
         $this->db->where('b.availability',1);
         $query = $this->db->get();
         return $query->result_array();
    }
    function retrieve_project_byid_model($data)
    {
         $this->db->select('*');
         $this->db->from('project a');
         $this->db->join('lot b', 'b.project_id = a.project_id', 'inner');
         $this->db->join('lot_price c', 'c.lot_id = b.lot_id', 'inner');
         $this->db->join('project d', 'd.project_id = b.project_id', 'left');
         $this->db->join('phase f', 'f.phase_id = b.phase_id', 'left');
         $this->db->where('a.project_id', $data);
         $query = $this->db->get();
         return $query->result_array();
    }

    function retrieve_all_project()
    {
         $this->db->select('*');
         $this->db->from('project');
         $query = $this->db->get();
         return $query->result_array();
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
        $last_bank = $this->db->insert_id();
        $this->db->trans_complete();
        return $last_bank;
    }

    function getOneBank($bankid,$addressid){
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
        //$this->db->join('address_type k', 'k.address_type_id=e.address_type_id', 'left');
        $this->db->where('a.status_id', 1);
        $this->db->where('a.bank_id',$bankid);
        $this->db->where('e.address_id',$addressid);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getOneBankPerson($personid){ 
        $this->db->select('*');
        $this->db->from('person a');
        $this->db->join('contact b', 'b.person_id=a.person_id', 'left');
        $this->db->join('contact_type c', 'c.contact_type_id=b.contact_type_id', 'left');
        $this->db->join('person_address d', 'd.person_id=a.person_id', 'left');
        $this->db->join('address e', 'e.address_id=d.address_id', 'left');
        $this->db->join('address_city f', 'f.address_city_id=e.city_id', 'left');
        $this->db->join('address_country g', 'g.id=e.country_id', 'left');
        $this->db->join('address_province h', 'h.address_province_id=e.province_id', 'left');
        $this->db->join('address_type i', 'i.address_type_id=e.address_type_id', 'left');
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
    function getReservationReport(){
        $this->db->select('*');
        $this->db->from('contract a');
        $this->db->join('lot b', 'a.lot_id=b.lot_id', 'inner');
        $this->db->join('lot_price c', 'c.lot_id=b.lot_id', 'inner');
        $this->db->join('project d', 'd.project_id=b.project_id', 'inner');
        $this->db->join('client e', 'e.client_id=a.client_id', 'inner');
        $this->db->join('customer f', 'f.customer_id=e.reference_id', 'inner');
        $this->db->join('person g', 'g.person_id=f.person_id', 'inner');
        $this->db->join('agent h', 'h.agent_id=a.agent_id', 'inner');
        $this->db->join('broker i', 'i.broker_id=h.broker_id', 'inner');
        $this->db->join('realty j', 'j.realty_id=i.realty_id', 'inner');
        $this->db->join('organization k', 'k.organization_id=j.organization_id', 'inner');
        //$this->db->join('broker i', 'i.broker_id=h.broker_id', 'inner');
        //$this->db->join('broker i', 'i.broker_id=h.broker_id', 'inner');
        //$this->db->where('a.status_id',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getReservationReportByDate($fromDate,$toDate){
        $this->db->trans_start();
        $this->db->select('*, l.lastname AS agent_lname, l.middlename AS agent_mname, l.firstname AS agent_fname, g.lastname AS lname, g.middlename AS mname, g.firstname AS fname');
        $this->db->from('contract a');
        $this->db->join('lot b', 'a.lot_id=b.lot_id', 'inner');
        $this->db->join('lot_price c', 'c.lot_id=b.lot_id', 'inner');
        $this->db->join('project d', 'd.project_id=b.project_id', 'inner');
        $this->db->join('client e', 'e.client_id=a.client_id', 'inner');
        $this->db->join('customer f', 'f.customer_id=e.reference_id', 'inner');
        $this->db->join('person g', 'g.person_id=f.person_id', 'inner');
        $this->db->join('agent h', 'h.agent_id=a.agent_id', 'left');
        $this->db->join('broker i', 'i.broker_id=h.broker_id', 'left');
        $this->db->join('realty j', 'j.realty_id=i.realty_id', 'left');
        $this->db->join('organization k', 'k.organization_id=j.organization_id', 'left');
        $this->db->join('person l', 'h.person_id=l.person_id', 'left');
        $this->db->where('a.contract_date >=', $fromDate);
        $this->db->where('a.contract_date <=', $toDate);
        $query = $this->db->get();
        return $query->result_array();
        $this->db->trans_complete();
    }


    function insertPersonPartner($data, $personid){
         $this->db->trans_start();
         $this->db->insert('person', $data);
         $lastPersonID = $this->db->insert_id();
         // $this->insertAddress($address,$personid);

         $this->db->select('customer_id');
         $this->db->from('customer');
         $this->db->where('person_id', $personid);
         $query = $this->db->get();
         $data = $query->row();
         $custmer_id = $data->customer_id;
         // echo $data[0]['customer_id'];

          $customer_partner = array(
            'customer_id'  =>  $custmer_id,
            'person_id' =>  $lastPersonID,
            'customer_relation' => "",
            'status_id' => 1,
         );
         $this->db->insert('customer_partner', $customer_partner);
         $this->db->trans_complete();
         
         return $lastPersonID;
    }

      function getOnePerson($data){
        $this->db->select('*,d.person_id AS new_person_id, d.tin as tin2');
        $this->db->from('client a');
        $this->db->join('person d', 'a.reference_id = d.person_id', 'left');
        // $this->db->join('customer b', 'd.person_id = b.person_id', 'left');
        $this->db->join('client_type c', 'c.client_type_id = a.client_type_id', 'left');
        $this->db->join('customer_work l', 'd.person_id = l.person_id', 'left');
        $this->db->join('address m', 'l.address_id = m.address_id', 'left');
        $this->db->join('person_contact n', 'd.person_id = n.person_id', 'left');
        // $this->db->join('contact_type o', 'n.contact_type_id = o.contact_type_id', 'left');
        $this->db->join('organization p ', 'p.organization_id = a.reference_id', 'left');
        $this->db->where('a.status_id',1);
        $this->db->where('a.client_id',$data);
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
    function updatePerson($id,$data,$customer)
    {
     $this->db->trans_start();
     $this->db->where('person_id', $id);
     $this->db->update('person', $data);

     $this->db->where('person_id', $id);
     $this->db->update('customer', $customer);
     
     // $this->db->select('address_id');
     // $this->db->from('person_address');
     // $this->db->where('person_id',$id);
     // return  $this->db->get()->result();
     $this->db->trans_complete();
    }
    function update_amortization($data,$id)
    {
     $this->db->trans_start();
     $this->db->where('amortization_id', $id);
     $this->db->update('amortization', $data);
     $this->db->trans_complete();
    }
    
    function updateAddress($id,$data){
     $this->db->where('person_id', $id); 
     $this->db->update('address', $data);
    }

    function insertAddress($data){
     $this->db->trans_start();
     $this->db->insert('address', $data);
     $lastaddressid = $this->db->insert_id();
     // $addcust = array(
     //        'person_id' => $personid,
     //        'address_id' =>  $lastaddressid,
     //        'status_id' =>  1,
     //     );
     // $this->db->insert('person_address', $addcust);
     $this->db->trans_complete();
     return $lastaddressid;
    }

    function get_all_lots()
    {
     $this->db->select('*');
     $this->db->from('lot a');
     $this->db->join('lot_price b', 'b.lot_id = a.lot_id', 'left');
     $this->db->join('project c', 'c.project_id = a.project_id', 'left');
     $this->db->join('phase d', 'd.phase_id = a.phase_id', 'inner');
     $query = $this->db->get();
     return $query->result_array();
    }
    
    function update_lot_model($lot_id, $data,$data2){
        $this->db->trans_start();
        $this->db->where('lot_id', $lot_id);
        $this->db->update('lot_price', $data);

        $this->db->where('lot_id', $lot_id);
        $this->db->update('lot', $data2);
        $this->db->trans_complete();
    }

    function getAllAvailableLots()
    {
     $this->db->select('*');
     $this->db->from('lot a');
     $this->db->join('lot_price b', 'b.lot_id = a.lot_id', 'inner');
     $this->db->join('project c', 'c.project_id = a.project_id', 'inner');
     $this->db->join('phase d', 'd.phase_id = a.phase_id', 'inner');
     $this->db->where('a.availability',1);
     $query = $this->db->get();
     return $query->result_array();
    }

    function getOneAvailableLots($lotid)
    {
     $this->db->select('*');
     $this->db->from('lot a');
     $this->db->join('lot_price b', 'a.lot_id = b.lot_id', 'left');
     $this->db->join('project c', 'a.project_id = c.project_id', 'left');
     $this->db->join('phase d', 'a.phase_id = d.phase_id', 'left');
     // $this->db->join('contract e', 'e.lot_id = a.lot_id', 'left');
     // $this->db->join('client f', 'e.client_id = f.client_id', 'left');
     // $this->db->join('customer g', 'f.reference_id = g.customer_id', 'left');
     // $this->db->join('person h', 'g.person_id = h.person_id', 'left');
     $this->db->where('a.lot_id',$lotid);
     $query = $this->db->get();
     return $query->result_array();
    }


    function get_lot($lotid)
    {
     $this->db->select('*');
     $this->db->from('lot a');
     $this->db->join('lot_price b', 'a.lot_id = b.lot_id', 'right');
     $this->db->join('project c', 'a.project_id = c.project_id', 'left');
     $this->db->join('phase d', 'a.phase_id = d.phase_id', 'left');
     $this->db->join('contract e', 'e.lot_id = a.lot_id', 'left');
     $this->db->join('client f', 'e.client_id = f.client_id', 'left');
     $this->db->join('customer g', 'f.reference_id = g.customer_id', 'left');
     $this->db->join('person h', 'g.person_id = h.person_id', 'left');
     $this->db->where('a.lot_id',$lotid);
     $query = $this->db->get();
     return $query->result_array();
     }

    function getBankList()
    {
       $this->db->select('*');
       $this->db->from('bank');
       $query = $this->db->get();
       return $query->result_array();
    }
    function finance_type_model()
    {
       $this->db->select('*');
       $this->db->from('financing_type');
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

    function getAllCity(){
       $this->db->select('*');
       $this->db->from('address_city');
       $query = $this->db->get();
       return $query->result_array();
    }

     function getAllProvince(){
       $this->db->select('*');
       $this->db->from('address_province');
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

    function getPaymentScheme($project_id){
       $this->db->select('*');
       $this->db->from('project_scheme a');
       $this->db->join('payment_scheme b', 'a.payment_scheme_id = b.payment_scheme_id', 'inner');
       $this->db->where('project_id', $project_id);
       $this->db->where('a.status_id',1);
       $query = $this->db->get();
       return $query->result_array();
    }

    function getPaymentScheme2(){
       $this->db->select('*');
       $this->db->from('payment_scheme a');
       $this->db->where('a.status_id',1);
       $query = $this->db->get();
       return $query->result_array();
    }
    
    function getOneSchemeType($schemid){
       $this->db->select('*');
       $this->db->from('payment_scheme');
       $this->db->where('payment_scheme_id', $schemid);
       $query = $this->db->get();
       return $query->result_array();
    }

    function get_projectid_model($id){
       $this->db->select('project_id');
       $this->db->from('lot a');
       $this->db->where('lot_id', $id);
       $query = $this->db->get();
       return $query->row()->project_id;
    }
    
    //brokers


    function getBrokers(){
        $this->db->select('*');
        $this->db->from('broker a');
        $this->db->join('person b', 'a.person_id = b.person_id','left');
        $this->db->join('realty c', 'a.realty_id=c.realty_id', 'left');
        $this->db->join('organization m', 'c.organization_id=m.organization_id', 'left');
         // $this->db->join('tax_type k', 'a.vat_type_id=k.tax_type_id', 'left');
        // $this->db->join('organization c', 'a.organization_id=c.organization_id', 'inner');
        // $this->db->join('');
        // $this->db->where('realty_id', $realtyid);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_realty_brokers($realtyid){
        $this->db->select('*');
        $this->db->from('broker a');
        $this->db->join('person b', 'a.person_id = b.person_id','inner');
        // $this->db->join('organization c', 'a.organization_id=c.organization_id', 'inner');
        // $this->db->join('');
        $this->db->where('realty_id', $realtyid);
        // $this->db->where('broker_id', $realtyid);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function agents_by_realty($id){
        $this->db->select('*');
        $this->db->from('agent a');
        $this->db->join('person b', 'a.person_id = b.person_id','inner');
        $this->db->where('realty_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

     function getAgents($brokerid){
        $this->db->select('*');
        $this->db->from('agent a');
        $this->db->join('person b', 'a.person_id = b.person_id','inner');
        // $this->db->join('organization c', 'a.organization_id=c.organization_id', 'inner');
        // $this->db->join('');
        $this->db->where('broker_id', $brokerid);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getSingleBroker($brokerID){
        $this->db->select('*,a.person_id AS new_id, b.tin as new_tin');
        $this->db->from('broker a');
        $this->db->join('person b', 'a.person_id = b.person_id','inner');
        $this->db->join('realty c', 'a.realty_id=c.realty_id', 'left');
        $this->db->join('contact j', 'b.person_id=j.person_id', 'left');
        $this->db->join('tax_type k', 'a.vat_type_id=k.tax_type_id', 'left');
        $this->db->join('civil_status l', 'b.civil_status_id=l.civil_status_id', 'left');
        $this->db->join('organization m', 'c.organization_id=m.organization_id', 'left');
        $this->db->join('contact_type n', 'j.contact_type_id=n.contact_type_id', 'left');

        $this->db->where('broker_id', $brokerID);

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_broker_address_model($id){
        $this->db->select('*');
        $this->db->from('person_address e');
        $this->db->join('address f', 'e.address_id = f.address_id', 'left');
        $this->db->join('address_city g', 'f.city_id = g.address_city_id', 'left');
        $this->db->join('address_province h', 'f.province_id = h.address_province_id', 'left');
        $this->db->join('address_country i', 'f.country_id = i.id', 'left');
        $this->db->join('address_type k', 'f.address_type_id = k.address_type_id', 'left');
        $this->db->where('e.status_id', 1);
        $this->db->where('e.person_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function insert_person($data){
        $this->db->trans_start();
        $this->db->insert('person', $data);
        $lastPersonID = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastPersonID;
    }

    function insertOrg($data){
        $this->db->trans_start();
        $this->db->insert('organization', $data);
        $lastOrgID = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastOrgID;
    }

    function insertBroker($data){
        $this->db->trans_start();
        $this->db->insert('broker', $data);
        $lastBrokerID = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastBrokerID;
    }
    
    function insertBrokerAddress($data){
      $this->db->trans_start();
      $this->db->insert('address', $data);
      $lastBrokerAddr = $this->db->insert_id();
      $this->db->trans_complete();
      return $lastBrokerAddr;
    }

    function insertContacts($data){
      $this->db->trans_start();
      $this->db->insert('contact', $data);
      $last_contact = $this->db->insert_id();
      $this->db->trans_complete();
      return $last_contact;
    }
     
    function insertPersonAddress($data){
      $this->db->trans_start();
      $this->db->insert('person_address', $data);
      // $lastBrokerAddr = $this->db->insert_id();
      $this->db->trans_complete();
      // return $lastBrokerAddr;
    }


    function updateBroker($id,$data,$brokerid,$data2){
      $this->db->trans_start();
      $this->db->where('person_id', $id);
      $this->db->update('person', $data);

      $this->db->where('broker_id', $brokerid);
      $this->db->update('broker', $data2);

      // $this->db->where('address_id', $addressid);
      // $this->db->update('address', $data3);

      $this->db->trans_complete();
    }

    function get_contacts_model($id){
        $this->db->select('*');
        $this->db->from('contact a');
        $this->db->join('contact_type b', 'a.contact_type_id = b.contact_type_id','inner');
        $this->db->where('person_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function update_contact($data){
        $this->db->trans_start();
        $this->db->where('person_id', $id);
        $this->db->update('contact', $data);
        $this->db->trans_complete();
    }

    function insert_agent_model($data){
        $this->db->trans_start();
        $this->db->insert('agent', $data);
        $last_agent = $this->db->insert_id();
        $this->db->trans_complete();
        return $last_agent;
    }
    function is_broker_update_modal($id, $data){
        $this->db->trans_start();
        $this->db->where('person_id', $id);
        $this->db->update('agent', $data);
        $this->db->trans_complete();
    }
    function get_agent_model($id){
        $this->db->select('*');
        $this->db->from('agent a');
        $this->db->join('person b', 'a.person_id = b.person_id','inner');
        // $this->db->join('broker c', 'a.broker_id = c.broker_id','left');
        $this->db->where('a.broker_id', $id);
        $this->db->where('a.status_id', 1);
        $query = $this->db->get();
        return $query->result_array();
    }


    function get_realty_model(){
        $this->db->select('*');
        $this->db->from('realty a');
        // $this->db->join('organization b', 'a.organization_id = b.organization_id','inner');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_commission_model($id){
        $this->db->select('*');
        $this->db->from('commission a');
        $this->db->join('commission_type b', 'a.commission_type=b.commission_type','inner');
        $this->db->where('a.commission_type', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_contract($id){
        $this->db->select('*');
        $this->db->from('contract');
        $query = $this->db->get();
        return $query->result_array();
    }

    function insert_commission_model($data){
        $this->db->trans_start();
        $this->db->insert('commission_release', $data);
        $this->db->trans_complete();
    }

    function get_one_lot($id){
        $this->db->select('*');
        $this->db->from('lot');
        $this->db->where('lot_id', $id);
        $query = $this->db->get();
        return $query->result_array();
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
    function getProjects(){
        $this->db->select('*');
        $this->db->from('project');
        $this->db->where('status_id',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    function insertIncentiveScheme($data){
        $this->db->trans_start();
        $this->db->insert('incentive', $data);
        $incent_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $incent_id;
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
        $comms_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $comms_id;
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
    function getSalesReport(){
        $this->db->select('*');
        $this->db->from('contract a');
        $this->db->join('client b', 'a.client_id=b.client_id', 'inner');
        $this->db->join('customer c', 'c.customer_id=b.reference_id', 'inner');
        $this->db->join('person d', 'd.person_id=c.person_id', 'inner');
        $this->db->join('lot e', 'e.lot_id=a.lot_id', 'inner');
        $this->db->join('project f', 'f.project_id=e.project_id', 'inner');
        $this->db->join('phase g', 'g.phase_id=e.phase_id', 'inner');
        $this->db->join('lot_price h', 'h.lot_id=e.lot_id', 'inner');
        $this->db->join('contract_status i', 'i.contract_status_id=a.contract_status_id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }
    function getSalesReportByDate($fromDate,$toDate){
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('contract a');
        $this->db->join('client b', 'a.client_id=b.client_id', 'inner');
        $this->db->join('customer c', 'c.customer_id=b.reference_id', 'inner');
        $this->db->join('person d', 'd.person_id=c.person_id', 'inner');
        $this->db->join('lot e', 'e.lot_id=a.lot_id', 'left');
        $this->db->join('project f', 'f.project_id=e.project_id', 'left');
        $this->db->join('phase g', 'g.phase_id=e.phase_id', 'left');
        $this->db->join('lot_price h', 'h.lot_id=e.lot_id', 'left');
        $this->db->join('contract_status i', 'i.contract_status_id=a.contract_status_id', 'left');
        $this->db->where('a.sold_date >=', $fromDate);
        $this->db->where('a.sold_date <=', $toDate);
        $query = $this->db->get();
        return $query->result_array();
        $this->db->trans_complete();
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

    function get_one_agent_model($agentid){
        $this->db->select('*');
        $this->db->from('agent a');
        $this->db->join('person b', 'a.person_id = b.person_id','inner');
        $this->db->join('person_address d', 'b.person_id=d.person_id', 'left');
        $this->db->join('address e', 'd.address_id=e.address_id', 'left');
        $this->db->join('address_province f', 'e.province_id=f.address_province_id', 'left');
        $this->db->join('address_city g', 'e.city_id=g.address_city_id', 'left');
        $this->db->join('address_country h', 'e.country_id=h.id', 'left');
        $this->db->join('address_type i', 'e.address_type_id=i.address_type_id', 'left');
        $this->db->join('contact j', 'b.person_id=j.person_id', 'left');
        // $this->db->join('tax_type k', 'a.vat_type_id=k.tax_type_id', 'left');
        $this->db->join('civil_status l', 'b.civil_status_id=l.civil_status_id', 'left');
        $this->db->join('contact_type n', 'j.contact_type_id=n.contact_type_id', 'left');
        $this->db->where('agent_id', $agentid);
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
        $this->db->select('*, a.contract_id AS new_contract_id, a.reservation_fee AS new_reserve_fee');
        $this->db->from('contract a');
        $this->db->join('client b', 'a.client_id=b.client_id', 'inner');
        // $this->db->join('customer c', 'b.reference_id=c.customer_id', 'left');
        $this->db->join('person d', 'b.reference_id=d.person_id', 'left');
        $this->db->join('organization e', 'b.reference_id=e.organization_id', 'left');
        $this->db->join('lot f', 'a.lot_id=f.lot_id', 'left');
        $this->db->join('project g', 'f.project_id=g.project_id', 'left');
        $this->db->join('phase k', 'f.phase_id=k.phase_id', 'left');
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
        $this->db->select('*');;
        $this->db->from('contract_status');
        $this->db->where('status_id', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function update_contract_status_model($id, $data){
        $this->db->trans_start();
        $this->db->where('contract_id', $id);
        $this->db->update('contract', $data);
        $this->db->trans_complete();
    }

    function get_all_legacy_model(){  
        $legacy_db = $this->load->database('legacy', TRUE);
        $legacy_db->select('custname, custid');
        $legacy_db->from('rescust');
        // $legacy_db->like(array('custname' => $lname, 'custname' => $fname));
        // $legacy_db->like('custname', $lname);
        // $legacy_db->like('custname', $fname);
        $query = $legacy_db->get();
        return $query->result_array();

        $legacy_db->close();
    }

    function get_legacycust_model($fname, $lname){
        $legacy_db = $this->load->database('legacy', TRUE);
        $legacy_db->select('custname, custid');
        $legacy_db->from('rescust');
        // $legacy_db->like(array('custname' => $lname, 'custname' => $fname));
        $legacy_db->like('custname', $lname);
        $legacy_db->like('custname', $fname);
        $query = $legacy_db->get();
        return $query->result_array();

        $legacy_db->close();
    }

    function save_legacy($data){
        $this->db->trans_start();
        $this->db->insert('customer_old_link', $data);
        $cust_link = $this->db->insert_id();
        $this->db->trans_complete();
        return $cust_link;
        // customer_old_link_id    customer_id legacy_customer_id
    }

    function get_legacy_info_model($id){

        $this->db->select('legacy_customer_id');
        $this->db->from('customer_old_link');
        $this->db->where('client_id', $id);
        $cust_id = $this->db->get();
        $cust_arr = array();
        foreach ($cust_id->result_array() as $ids) {
            $cust_arr[] = $ids['legacy_customer_id'];
        }

        if ( count($cust_arr) > 0) {
            $legacy_db = $this->load->database('legacy', TRUE);
            // $legacy_db->select('*');
            $legacy_db->select('a.custid, custname, lotdesc, d.lotid contractdate, tcpamount');
            $legacy_db->from('rescontract a');
            $legacy_db->join('rescust b', 'a.custid = b.custid', 'inner');
            // $legacy_db->join('resamortztn c', 'b.contractid = c.contractid', 'inner'); 
            $legacy_db->join('tbllot d', 'a.lotid = d.lotid', 'left'); 
            $legacy_db->where_in('b.custid', $cust_arr);
            $query = $legacy_db->get();
            return $query->result_array();

            $legacy_db->close(); 
        }
        unset($cust_arr);
    }
    


    function get_mancom_year_model($date){
        $mancom_date = strtotime($date);
        $month = date("m", $mancom_date );
        $year = date("Y", $mancom_date );

        $this->db->select('project_name, COUNT(a.lot_id) AS units, SUM(total_contract_price) AS totals, ');
        $this->db->from('contract a');
        $this->db->join('lot b', 'a.lot_id = b.lot_id', 'inner');
        $this->db->join('project c', 'b.project_id = c.project_id', 'inner');
        $this->db->where('MONTH(a.sold_date) <=', $month);
        $this->db->where('YEAR(a.sold_date)', $year);
        // $this->db->where('YEAR(a.sold_date)', $year);
        $this->db->group_by('b.project_id');

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_mancom_monthy_model($date){
        $mancom_date = strtotime($date);
        $month = date("m", $mancom_date );
        $year = date("Y", $mancom_date );

        $this->db->select('project_name, COUNT(a.lot_id) AS units, SUM(total_contract_price) AS totals, ');
        $this->db->from('contract a');
        $this->db->join('lot b', 'a.lot_id = b.lot_id', 'inner');
        $this->db->join('project c', 'b.project_id = c.project_id', 'inner');
        $this->db->where('MONTH(a.sold_date)', $month);
        $this->db->where('YEAR(a.sold_date)', $year);
        // $this->db->where('YEAR(a.sold_date)', $year);
        $this->db->group_by('b.project_id');

        $query = $this->db->get(); 
        return $query->result_array();
    }


    function get_all_lotinv_model($date){
        $inv_date = strtotime($date);

        $this->db->select('b.project_id, b.lot_id, project_name, COUNT(b.lot_id) AS units, SUM(total_contract_price) AS totals, d.phase_name AS phase, SUM(lot_area) AS lot_area, b.availability');
        $this->db->from('contract a');
        $this->db->join('lot b', 'a.lot_id = b.lot_id', 'right');
        $this->db->join('project c', 'b.project_id = c.project_id', 'inner');
        $this->db->join('phase d', 'b.phase_id = d.phase_id', 'inner');
        $this->db->group_by('b.project_id');
        $this->db->where('a.sold_date <=', $inv_date);
        $this->db->order_by('project_id', 'desc');
        // $this->db->where('b.availability', 1);
        
        $query = $this->db->get(); 
        return $query->result_array();
    }

    // function get_sold_lotinv_model($date){
    //     $inv_date = strtotime($date);

    //     $this->db->select('b.lot_id, project_name, COUNT(b.lot_id) AS units, SUM(total_contract_price) AS totals, d.phase_name AS phase, SUM(lot_area) AS lot_area, b.availability');
    //     $this->db->from('contract a');
    //     $this->db->join('lot b', 'a.lot_id = b.lot_id', 'inner');
    //     $this->db->join('project c', 'b.project_id = c.project_id', 'inner');
    //     $this->db->join('phase d', 'b.phase_id = d.phase_id', 'inner');
    //     // $this->db->group_by(array('availability', 'b.phase_id', 'b.project_id'));
    //     $this->db->where('a.sold_date <=', $inv_date);
    //     $this->db->order_by('project_name');
    //     $this->db->where('b.availability', 0);
        
    //     $query = $this->db->get(); 
    //     return $query->result_array();
    // }

    function get_unit_count_model($proj){
        $this->db->select('b.project_id, b.lot_id, project_name, COUNT(b.lot_id) AS units, SUM(total_contract_price) AS totals, SUM(b.lot_area) AS lot_area');
        $this->db->from('contract a');
        $this->db->join('lot b', 'a.lot_id = b.lot_id', 'right');
        $this->db->join('project c', 'b.project_id = c.project_id', 'inner');
        $this->db->join('phase d', 'b.phase_id = d.phase_id', 'inner');
        $this->db->order_by('project_id', 'desc');
        
        $this->db->where('b.project_id', $proj);
        $this->db->where('b.availability', 0);
        $this->db->where('a.sold_date !=', null);
        $query = $this->db->get(); 
        return $query->result_array();

    }

    function get_contracts_docs_model($proj){
        $this->db->select('contract_id, block_no, lot_no, lastname, firstname, middlename, financing_name, contract_status_name, cts_date, cts_signed, cts_notarized, doas_signed, doas_amount, doas_date, client_type_id, organization_name, is_transferred, financing_name, i.financing_type_id');
        $this->db->from('contract a');
        $this->db->join('lot b', 'a.lot_id = b.lot_id', 'inner');
        $this->db->join('lot_price c', 'c.lot_id = b.lot_id', 'inner');
        $this->db->join('project d', 'd.project_id = b.project_id', 'inner');
        $this->db->join('client e', 'e.client_id = a.client_id', 'inner');
        $this->db->join('customer f', 'f.customer_id = e.reference_id', 'inner');
        $this->db->join('person g', 'g.person_id = f.person_id', 'inner');
        $this->db->join('contract_status h', 'h.contract_status_id = a.contract_status_id', 'left');
        $this->db->join('financing_type i', 'i.financing_type_id = a.financing_type_id', 'left');
        $this->db->join('organization j', 'j.organization_id = e.reference_id', 'left');
        
        // $this->db->where('b.project_id', $proj);
        // $this->db->where('b.availability', 0);
        $this->db->where('b.project_id', $proj);
        $query = $this->db->get(); 
        return $query->result_array();
    }

    function update_docs_model($id, $data){
        $this->db->trans_start();
        $this->db->where('contract_id', $id);
        $this->db->update('contract', $data);
        $this->db->trans_complete();
    }

    function insert_file_model($data){
        $this->db->trans_start();
        $this->db->insert('client_requirement', $data);
        $req = $this->db->insert_id();
        $this->db->trans_complete();
        return $req;
    }

    function update_file_model($id, $data){
        $this->db->trans_start();
        $this->db->where('requirement_id', $id);
        $this->db->update('client_requirement', $data);
        $this->db->trans_complete();
    }

    function get_personaddress_model($id){
        $this->db->select('*');
        $this->db->from('address a');
        $this->db->join('person_address b', 'a.address_id = b.address_id', 'inner');
        $this->db->where('status_id', 1);
        $this->db->where('b.person_id', $id);

        $query = $this->db->get(); 
        return $query->result_array();
    }


    function get_personwork_model($id){
        $this->db->select('*');
        $this->db->from('customer_work a');
        $this->db->join('address b', 'a.address_id = b.address_id', 'inner');
        $this->db->where('status_id', 1);
        $this->db->where('b.person_id', $id);

        $query = $this->db->get(); 
        return $query->result_array();
    }


    function get_references_model($id){
        $this->db->select('*');
        $this->db->from('personal_reference a');
        $this->db->where('a.person_id', $id);
        $query = $this->db->get(); 
        return $query->result_array();
    }

    function get_fundsource_model($id){
        $this->db->select('*');
        $this->db->from('client_fund_source a');
        $this->db->join('source_of_fund b', 'a.source_of_fund_id = b.source_of_fund_id', 'inner');
        $this->db->where('a.client_id', $id);
        $query = $this->db->get(); 
        return $query->result_array();
    }

    function insert_broker_model($data){
        $this->db->trans_start();
        $this->db->insert('broker', $data);
        $lastBrokerID = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastBrokerID;
    }

    function get_brokers_model(){
        $this->db->select('*');
        $this->db->from('broker a');
        $this->db->join('person b', 'a.person_id = b.person_id', 'inner');
        $this->db->join('person_address c', 'a.person_id = c.person_id', 'inner');
        $this->db->join('address d', 'c.address_id = d.address_id', 'inner');
        $this->db->join('person_contact e', 'c.person_id = e.person_id', 'inner');
        $this->db->join('realty f', 'a.realty_id = f.realty_id', 'left');
        // $this->db->where('a.client_id', $id);
        $query = $this->db->get(); 
        return $query->result_array();
    }


    function get_salesperson_contract_model($id){
        $this->db->select('*');
        $this->db->from('contract a');
        $this->db->join('salesperson b', 'a.salesperson_id = b.salesperson_id', 'inner');
        $this->db->join('broker c', 'b.broker_id = c.broker_id', 'inner');
        $this->db->join('realty d', 'c.realty_id = d.realty_id', 'left');
        // $this->db->join('person e', 'a.person_id = b.person_id', 'inner');
        $this->db->where('a.contract_id', $id);
        $query = $this->db->get(); 
        return $query->row();
    }
    
    function get_onebroker_model($id){
        $this->db->select('*, a.business_phone AS business_phone2');
        $this->db->from('broker a');
        $this->db->join('person b', 'a.person_id = b.person_id', 'inner');
        $this->db->join('person_address c', 'a.person_id = c.person_id', 'inner');
        $this->db->join('address d', 'c.address_id = d.address_id', 'left');
        $this->db->join('person_contact e', 'c.person_id = e.person_id', 'left');
        $this->db->join('civil_status f', 'b.civil_status_id = f.civil_status_id', 'left');
        $this->db->join('address_country g', 'd.country_id = g.id', 'left');
        $this->db->join('address_province h', 'd.province_id = h.address_province_id', 'left');
        $this->db->join('address_city i', 'd.city_id = i.address_city_id', 'left');
        $this->db->join('realty j', 'a.realty_id = j.realty_id', 'left');
        $this->db->where('a.broker_id', $id);
        $query = $this->db->get(); 
        return $query->result_array();
    }

    function insert_salesperson_model($data){
        $this->db->trans_start();
        $this->db->insert('salesperson', $data);
        $sales_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $sales_id;  
    }

    function get_salesperson_model($id){
        $this->db->select('*');
        $this->db->from('salesperson a');
        $this->db->where('a.broker_id', $id);
        $query = $this->db->get(); 
        return $query->result_array();
    }
    function get_broker_req_model($id, $type){
        $this->db->select('*');
        $this->db->from('broker_requirement a');
        $this->db->join('file_requirement b', 'a.file_id = b.file_id', 'inner');
        $this->db->where('a.reference_id', $id);
        $this->db->where('a.type', $type);
        $query = $this->db->get(); 
        return $query->result_array();
    }

    function insert_broker_req_model($data){
        $this->db->trans_start();
        $this->db->insert_batch('broker_requirement', $data);
        $this->db->trans_complete();
    }

    function update_brokerfile_model($id, $data){
        $this->db->trans_start();
        $this->db->where('broker_requirement_id', $id);
        $this->db->update('broker_requirement', $data);
        $this->db->trans_complete();
    }



    // NEW BANK

    function insert_bank_model($data){
        $this->db->trans_start();
        $this->db->insert('bank', $data);
        $last_bank = $this->db->insert_id();
        $this->db->trans_complete();
        return $last_bank;
    }



    // PAYMENT SCHEME

    function pay_scheme_model($data){
        $this->db->trans_start();
        $this->db->insert('project_scheme', $data);
        $pay = $this->db->insert_id();
        $this->db->trans_complete();
        return $pay;
    }











    function get_legacy_contracts_model(){

        $legacy_db = $this->load->database('local_mssql', TRUE);
        $legacy_db->distinct('ContractId');
        $legacy_db->select('CustName, d.Description as Project, e.AgentName, FTerm as Terms1, STerm as Terms2, c.LotDesc, c.LotArea, c.AreaCost, c.TCP, a.ContractId, a.ContractDate, a.CustId, e.AgentID, CatId, cast([FTCPPercent] as varchar(6)) as Scheme1,cast([STCPPercent] as varchar(6)) as Scheme2');
        $legacy_db->from('ResContract a');
        $legacy_db->join('ResCust b', 'a.CustId = b.CustID', 'inner');
        $legacy_db->join('TblLot c', 'a.LotId = c.LotId', 'inner');
        $legacy_db->join('ResCategory d', 'c.EnterpriseId = d.CatId', 'inner');
        $legacy_db->join('TblAgent e', 'a.AgentID = e.AgentID', 'inner');
        $legacy_db->join('resPayments f', 'a.ContractId = f.ContractId', 'inner');
        // $legacy_db->group_by('f.ContractId');
        // $legacy_db->join('TblAgent e', '', 'inner');
        $legacy_db->where('year(ContractDate)', 2018);
        $query = $legacy_db->get();
        return $query->result_array();

        $legacy_db->close();
    }




    // function test_old_model(){
    //     $legacy_db = $this->load->database('local_mssql', TRUE);
    //     $legacy_db->select('DepartmentId');
    //     $legacy_db->from('GLBudget');
    //     $query = $legacy_db->get();
    //     return $query->result_array();

    //     $legacy_db->close();
    // }

    // function get_all_legacy_model(){ 
    //     $legacy_db = $this->load->database('legacy', TRUE);
    //     $legacy_db->select('custname, custid');
    //     $legacy_db->from('rescust');
    //     // $legacy_db->like(array('custname' => $lname, 'custname' => $fname));
    //     // $legacy_db->like('custname', $lname);
    //     // $legacy_db->like('custname', $fname);
    //     $query = $legacy_db->get();
    //     return $query->result_array();

    //     $legacy_db->close();
    // }


    // function get_ending_lotinv_model($date){
    //     $inv_date = strtotime($date);

    //     $this->db->select('b.project_id, b.lot_id, project_name, COUNT(b.lot_id) AS units, SUM(total_contract_price) AS totals, d.phase_name AS phase, SUM(lot_area) AS lot_area, b.availability');
    //     $this->db->from('contract a');
    //     $this->db->join('lot b', 'a.lot_id = b.lot_id', 'inner');
    //     $this->db->join('project c', 'b.project_id = c.project_id', 'inner');
    //     $this->db->join('phase d', 'b.phase_id = d.phase_id', 'inner');
    //     // $this->db->group_by(array('availability', 'b.phase_id', 'b.project_id'));
    //     $this->db->where('a.sold_date <=', $inv_date);
    //     $this->db->order_by('project_name');
    //     $this->db->where('b.availability', 1);
        
    //     $query = $this->db->get(); 
    //     return $query->result_array();
    // }

    

    // function get_contracts_model($project){ 
    //     $this->db->select('*');
    //     $this->db->from('contract a');
    //     $this->db->join('lot b', 'a.lot_id=b.lot_id', 'inner');
    //     $this->db->join('lot_price c', 'c.lot_id=b.lot_id', 'inner');
    //     $this->db->join('project d', 'd.project_id=b.project_id', 'inner');
    //     $this->db->join('client e', 'e.client_id=a.client_id', 'inner');
    //     $this->db->join('customer f', 'f.customer_id=e.reference_id', 'inner');
    //     $this->db->join('person g', 'g.person_id=f.person_id', 'inner');
    //     $this->db->join('agent h', 'h.agent_id=a.agent_id', 'inner');
    //     $this->db->join('broker i', 'i.broker_id=h.broker_id', 'left');
    //     $this->db->join('realty j', 'j.realty_id=i.realty_id', 'left');
    //     $this->db->join('organization k', 'k.organization_id=j.organization_id', 'left');
    //     $this->db->where('b.project_id', $project);

    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

}