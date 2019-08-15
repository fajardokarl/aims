<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class getInbox_list2 extends CI_Model
{

    function get_users()
    {
        $this->db->select('*');
        $this->db->from('message');
        //$this->db->join('person', 'user.person_id = person.person_id', 'inner');
       //$this->db->where('status_id', 1);
        $query = $this->db->get();
        return $query->result_array();

    
    }
    
    function retrieve_all_employee()
    {
         $this->db->select('*');
         $this->db->from('user a');
         $this->db->join('person b', 'a.person_id = b.person_id', 'inner');
         $this->db->where('a.status_id', null);
         $query = $this->db->get();
         return $query->result_array();
    }

    //--This is how to insert data in 2 tables
    
    function insert_data($data)
    {
        $this->db->trans_start();
    	$this->db->insert('message', $data);
        $lastMessageID = $this->db->insert_id();        
        $this->db->trans_complete();
         return $lastMessageID;
    }

    function insertMailbox($data){
        $this->db->trans_start();
        $this->db->insert('mailbox', $data);
        $lastMailboxid = $this->db->insert_id();
        $this->db->trans_complete();
        return $lastMailboxid;
    }
    //----end 2 tables here 
    

    //For broker

     function get_customers()
    {
        $this->db->select('*');
        $this->db->from('client a');
        $this->db->join('customer b', 'a.reference_id = b.customer_id', 'inner');
        $this->db->join('client_type c', 'c.client_type_id = a.client_type_id', 'inner');
        $this->db->join('person d', 'd.person_id = b.person_id', 'inner');
        $this->db->where('a.status_id',1);

      //----sample------------  
        // $this->db->select('*');
        // $this->db->from('message');
    //---------sample end-----
        $query = $this->db->get();
        return $query->result_array();
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
// <<<<<<< .mine
//     function insertUser($data)
//     {
//         $this->db->trans_start();
//         $this->db->insert('user', $data);
//         $this->db->trans_complete();
//     }
    
// ||||||| .r229
// =======

// >>>>>>> .r271
    function insertPerson($data, $last_org)
    {
        $this->db->trans_start();
        $this->db->insert('person', $data);
        $lastPersonID = $this->db->insert_id();
        $customer = array(
            'customer_fullname' => $data['lastname'].', '. $data['firstname'].' '. $data['middlename'],
            'person_id' =>  $lastPersonID,
            'customer_work_id' => $last_org
         );
        $this->db->insert('customer', $customer);
        $lastCustomerID = $this->db->insert_id();
        $client = array(
            'client_type_id' => 1,
            'reference_id' =>  $lastCustomerID,
            'status_id' =>  1,
         );
        $this->db->insert('client', $client);
        $this->db->trans_complete();
        return  $lastPersonID;
    }

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
        $this->db->trans_start();
        $this->db->insert('payment_scheme', $data);
        $this->db->trans_complete();
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
        $this->db->insert('contract', $data);
        $lastcontractID = $this->db->insert_id();
        return $lastcontractID;
    }

    function lot_availability_model($id, $data){
        $this->db->trans_start();
        $this->db->where('lot_id', $id);
        $this->db->update('lot', $data);
        $this->db->trans_complete();
    }

    function save_amortization($data){
        $this->db->insert('amortization', $data);
        $lastcontractID = $this->db->insert_id();
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    function save_miscellaneous($data){
        $this->db->trans_start();
        $this->db->insert('miscelaneous', $data);
        // $misc = $this->db->insert_id();
        // return ($this->db->affected_rows() != 1) ? false : true;
        $this->db->trans_complete();
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
        $this->db->join('person b', 'a.person_id=b.person_id', 'inner');
        $this->db->join('contact c', 'c.contact_id=a.contact_id', 'inner');
        $this->db->join('contact_type d', 'd.contact_type_id=c.contact_type_id', 'inner');
        $this->db->join('address e', 'e.address_id=a.address_id', 'inner');
        $this->db->join('address_city f', 'f.address_city_id=e.city_id', 'inner');
        $this->db->join('address_country g', 'g.id=e.country_id', 'inner');
        $this->db->join('address_province h', 'h.address_province_id=e.province_id', 'inner');
        $this->db->join('address_type i', 'i.address_type_id=e.address_type_id', 'inner');
        $this->db->where('a.status_id',1);
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
     function retrieve_project_byids($data)
    {
         $this->db->select('*');
         $this->db->from('project a');
         $this->db->join('lot b', 'b.project_id = a.project_id', 'inner');
         $this->db->join('lot_price c', 'c.lot_id = b.lot_id', 'inner');
         $this->db->join('project d', 'd.project_id = b.project_id', 'inner');
         $this->db->join('phase f', 'f.phase_id = b.phase_id', 'inner');
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
         $this->db->join('project d', 'd.project_id = b.project_id', 'inner');
         $this->db->join('phase f', 'f.phase_id = b.phase_id', 'inner');
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


    //  function retrieve_all_employee()
    // {
    //      $this->db->select('*');
    //      $this->db->from('person');
    //      $query = $this->db->get();
    //      return $query->result_array();
    // }


    //  function retrieve_all_employeer()
    // {
    //      $this->db->select('*');
    //      $this->db->from('employee_ofbiz');
    //      $query = $this->db->get();
    //      return $query->result_array();
    // }



    //  function retrieve_all_employee()
    // {
    //      $this->db->select('*');
    //      $this->db->from('person');
    //      $query = $this->db->get();
    //      return $query->result_array();
    // }

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
        $this->db->where('a.status_id',1);
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
        $this->db->join('broker i', 'i.broker_id=a.broker_id', 'inner');
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
        $this->db->select('*');
        $this->db->from('contract a');
        $this->db->join('lot b', 'a.lot_id=b.lot_id', 'inner');
        $this->db->join('lot_price c', 'c.lot_id=b.lot_id', 'inner');
        $this->db->join('project d', 'd.project_id=b.project_id', 'inner');
        $this->db->join('client e', 'e.client_id=a.client_id', 'inner');
        $this->db->join('customer f', 'f.customer_id=e.reference_id', 'inner');
        $this->db->join('person g', 'g.person_id=f.person_id', 'inner');
        $this->db->join('agent h', 'h.agent_id=a.agent_id', 'inner');
        $this->db->join('broker i', 'i.broker_id=a.broker_id', 'inner');
        $this->db->join('organization j', 'j.organization_id=i.organization_id', 'inner');
        $this->db->where('a.contract_date >=', $fromDate);
        $this->db->where('a.contract_date <=', $toDate);
        $query = $this->db->get();
        return $query->result_array();
        $this->db->trans_complete();
    }


    function insertPersonPartner($data,$address,$personid){
         $this->db->trans_start();
         $this->db->insert('person', $data);
         $lastPersonID = $this->db->insert_id();
         $this->insertAddress($address,$personid);

         $this->db->select('customer_id');
         $this->db->from('customer');
         $this->db->where('person_id',$personid);
         $query = $this->db->get();
         $data = $query->result_array();
         $custmer_id = $data[0]['customer_id'];
         echo $data[0]['customer_id'];

          $customer_partner = array(
            'customer_id'  =>  $custmer_id,
            'person_id' =>  $lastPersonID,
            'customer_relation' => "",
            'status_id' => 1,
         );
         $this->db->insert('customer_partner', $customer_partner);
         $this->db->trans_complete();
    }
      function getOnePerson($data)
    {
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
        $this->db->join('customer_work l', 'b.customer_work_id = l.customer_work_id', 'left');
        $this->db->join('organization m', 'l.organization_id = m.organization_id', 'left');
        $this->db->join('contact n', 'd.person_id = n.person_id', 'left');
        $this->db->join('contact_type o', 'n.contact_type_id = o.contact_type_id', 'left');
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
     $this->db->join('lot_price b', 'b.lot_id = a.lot_id', 'inner');
     $this->db->join('project c', 'c.project_id = a.project_id', 'inner');
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
     $this->db->join('lot_price b', 'a.lot_id = b.lot_id', 'inner');
     $this->db->join('project c', 'a.project_id = c.project_id', 'inner');
     $this->db->join('phase d', 'a.phase_id = d.phase_id', 'inner');
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

    function getAllCity()
    {
       $this->db->select('*');
       $this->db->from('address_city');
       $query = $this->db->get();
       return $query->result_array();
    }
     function getAllProvince()
    {
       $this->db->select('*');
       $this->db->from('address_province');
       $query = $this->db->get();
       return $query->result_array();
    }
     function getAddressType()
    {
       $this->db->select('*');
       $this->db->from('address_type');
       $query = $this->db->get();
       return $query->result_array();
    }
     function getAllCountry()
    {
       $this->db->select('*');
       $this->db->from('address_country');
       $query = $this->db->get();
       return $query->result_array();
    }
     function getPaymentScheme()
    {
       $this->db->select('*');
       $this->db->from('payment_scheme');
       $this->db->where('status_id',1);
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

    // function get_all_projects(){
    //     $this->db->select('*');
    //     $this->db->from('project');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }
    // function get_all_phase(){
    //     $this->db->select('*');
    //     $this->db->from('phase');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }
    // function get_all_phase(){
    //     $this->db->select('*');
    //     $this->db->from('project');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }



    
    //broker

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
        $this->db->select('*');
        $this->db->from('message');
        // $this->db->select('*,a.person_id AS new_id');
        // $this->db->from('broker a');
        // $this->db->join('person b', 'a.person_id = b.person_id','inner');
        // $this->db->join('realty c', 'a.realty_id=c.realty_id', 'inner');
        // $this->db->join('person_address d', 'b.person_id=d.person_id', 'left');
        // $this->db->join('address e', 'd.address_id=e.address_id', 'left');
        // $this->db->join('address_province f', 'e.province_id=f.address_province_id', 'left');
        // $this->db->join('address_city g', 'e.city_id=g.address_city_id', 'left');
        // $this->db->join('address_country h', 'e.country_id=h.id', 'left');
        // $this->db->join('address_type i', 'e.address_type_id=i.address_type_id', 'left');
        // $this->db->join('contact j', 'b.person_id=j.person_id', 'left');
        // $this->db->join('tax_type k', 'a.vat_type_id=k.tax_type_id', 'left');
        // $this->db->join('civil_status l', 'b.civil_status_id=l.civil_status_id', 'left');
        // $this->db->join('organization m', 'c.organization_id=m.organization_id', 'left');
        // $this->db->join('contact_type n', 'j.contact_type_id=n.contact_type_id', 'left');

        // $this->db->join('');
        $this->db->where('message_id', $brokerID);

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


    function updateBroker($id,$data,$brokerid,$data2,$addressid,$data3){
      $this->db->trans_start();
      $this->db->where('person_id', $id);
      $this->db->update('person', $data);

      $this->db->where('broker_id', $brokerid);
      $this->db->update('broker', $data2);

      $this->db->where('address_id', $addressid);
      $this->db->update('address', $data3);

      $this->db->trans_complete();
    }

    function get_contacts_model($personid){
        $this->db->from('contact');
        $this->db->select('*');
        $this->db->where('person_id', $personid);
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

    function save_realty_model($data){
        $this->db->trans_start();
        $this->db->insert('realty', $data);
        $last_realty_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $last_realty_id;
    }

    function get_realty_model(){
        $this->db->select('*');
        $this->db->from('realty a');
        $this->db->join('organization b', 'a.organization_id = b.organization_id','inner');
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
        $this->db->join('lot e', 'e.lot_id=a.lot_id', 'inner');
        $this->db->join('project f', 'f.project_id=e.project_id', 'inner');
        $this->db->join('phase g', 'g.phase_id=e.phase_id', 'inner');
        $this->db->join('lot_price h', 'h.lot_id=e.lot_id', 'inner');
        $this->db->join('contract_status i', 'i.contract_status_id=a.contract_status_id', 'inner');
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

    // function get_contract_by_broker_model()
    // {
    //     $this->db->select('*');
    //     $this->db->from('message');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    function get_miscellaneous_model($id){
        $this->db->select('*');
        $this->db->from('miscelaneous a');
        $this->db->join('contract b', 'a.contract_id=b.contract_id');
        $this->db->where('a.contract_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_contract_model($id){
        $this->db->select('*');
        $this->db->from('contract a');
        $this->db->join('client b', 'a.client_id=b.client_id', 'inner');
        $this->db->join('customer c', 'b.reference_id=c.customer_id', 'left');
        $this->db->join('person d', 'c.person_id=d.person_id', 'left');
        $this->db->join('organization e', 'b.reference_id=e.organization_id', 'left');
        $this->db->join('lot f', 'a.lot_id=f.lot_id', 'left');
        $this->db->join('agent g', 'a.agent_id=g.agent_id', 'left');
        $this->db->join('payment_scheme h', 'a.scheme_type_id=h.payment_scheme_id', 'left');
        $this->db->join('lot_price i', 'a.lot_id=i.lot_id', 'left');
        $this->db->where('a.contract_id', $id);
        $query = $this->db->get();
        return $query->row();
     }
    
}