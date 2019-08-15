<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Collection extends CI_Controller {

    private $data = array();

    function __construct(){
        // Construct the parent class
        parent::__construct();

        $this->load->model('Collection_model','collection');
        $this->load->helper(array('form', 'url'));
        //$this->load->library('fb');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->data['navigation'] = 'collection/navigation';
        $this->data['customjs'] = 'collection/customjs';

        $CI =& get_instance();

    }

    public $reference_no = 123;

    public function index()
    {
        $this->data['content'] = 'dashboard';
        $this->data['page_title'] = 'Credit and Collection';
        $this->data['customjs'] = 'dashboardjs';
        $this->data['daily_sales'] = $this->collection->getDailySales();
        $this->data['monthly_sales'] = $this->collection->getMonthlySales();
        $this->data['amort_receivable'] = $this->collection->getMonthlyReceivablesAmortization();
        $this->data['misc_receivable'] = $this->collection->getMonthlyReceivablesMiscelaneous();
        $this->data['monthly_sales2'] = $this->collection->getMonthlySales2();
        $this->load->view('default/index', $this->data);
    }

    public function reservation()
    { 
        $this->data['content'] = 'reservation';
        $this->data['page_title'] = 'Reservation Payment';
        $this->data['customjs'] = 'reservationjs';
        $this->data['customers'] = $this->collection->get_customers();
        $this->data['customers2'] = $this->collection->get_customers();
        $this->data['allbanks'] = $this->collection->getAllBanks();
        $this->data['banks'] = $this->collection->getAllBanks();
        $this->data['lots'] = $this->collection->getAllLots();
        $this->data['paymentType'] = $this->collection->getPaymentTypes();
        $this->load->view('default/index', $this->data);
    }

    public function populateDropdownCProperties()
    {
        $clientid = $this->input->post('clientid');
        $clientproperties = $this->collection->getPropertiesDropdown($clientid);
        echo json_encode($clientproperties);
    }

    public function getClientDetails()
    {
        $contractid = $this->input->post('contractid');
        $customerid = $this->input->post('customerid');
        $datareturn['contract'] = $this->collection->getClientDetailsForPayment($contractid);
        $datareturn['amortization'] = $this->collection->getAmortizationDetails($contractid);
        $datareturn['amortization2'] = $this->collection->getAmortizationDetails3($contractid);
        $datareturn['payment'] = $this->collection->getPaymentDetails($contractid);
        $datareturn['discount'] = $this->collection->getDiscount($contractid);
        $datareturn['misc'] = $this->collection->getMiscDetails($contractid);
        $datareturn['pdc'] = $this->collection->getPostDatedChecks3($customerid);
        echo json_encode($datareturn);
    }
    public function getSingleAmort()
    {
        $contractid = $this->input->post('contractid');
        $datareturn['amortization'] = $this->collection->getAmortizationDetails4($contractid);
        echo json_encode($datareturn);
    }
    public function getSingleContractDetails()
    {
        $lotid = $this->input->post('lotid');
        $datareturn = $this->collection->getSingleContract($lotid);
        echo json_encode($datareturn);
    }
    public function getPayments()
    {
        $contractid = $this->input->post('contractid');
        $datareturn = $this->collection->getPaymentDetails($contractid);
        echo json_encode($datareturn);
    }

    public function getDetailsByNewDate()
    {
        $contractid = $this->input->post('contractid_new');
        $surcharge_date = $this->input->post('surcharge_date_new');
        $datareturn = $this->collection->getAmortizationDetailsByNewDate2($contractid,$surcharge_date);
        echo json_encode($datareturn);
    }

    public function updateContractAndAmortizationLine()
    {
        $amortizationid = $this->input->post('amortization_id');
        $principal = $this->input->post('principal_total');
        $surcharge = $this->input->post('surcharge_total');
        $vat = $this->input->post('vat_total');
        $ips = $this->input->post('ips_total');
        $interest = $this->input->post('interest_total');
        //$ips_surcharge = $this->input->post('ips_surcharge_total');
        $ips_accrued = $this->input->post('ips_accrued_total');
        $ips_interest = $this->input->post('ips_interest_total');
        $paidup = $this->input->post('paid_up');
        $contract_id = $this->input->post('contract_id');
        $contract_status_id = $this->input->post('contract_status_id');
        $pay_date = $this->input->post('payment_date');
        
        $this->collection->updateContractLine($contract_id,$contract_status_id);

        $this->collection->updateAmortizationLine($amortizationid,$interest,$principal,$vat,$surcharge,$ips,$paidup,$pay_date,$ips_accrued,$ips_interest);

        // $payment = array(
        //     'contract_id' => $this->input->post('contract_id'),
        //     'pay_reference' => $this->input->post('payment_type'),
        //     'pay_date' => $this->input->post('payment_date'),
        //     'amount' => $this->input->post('amount'),
        //     'principal' => $this->input->post('principal'),
        //     'interest' => $this->input->post('interest'),
        //     'surcharge' => $this->input->post('surcharge'),
        //     'sundry' => $this->input->post('sundry'),
        //     'balance' => $this->input->post('balance'),
        //     'cashier_id' => $this->input->post('cashier_id'),
        //     );

        // $datareturn2 = $this->collection->insertPayment($payment);
    }

    public function savePaymentCheck()
    {
        $amortizationid = $this->input->post('amortization_id');
        $principal = $this->input->post('principal_paid');
        $surcharge = $this->input->post('surcharge_paid');
        $paidup = $this->input->post('paid_up');
        $vat = $this->input->post('vat_paid');
        //$ips = $this->input->post('ips_paid');
        $interest = $this->input->post('interst_paid');
        $contract_id = $this->input->post('contract_id');
        $contract_status_id = $this->input->post('contract_status_id');
        $pay_date = $this->input->post('payment_date');
        
        $this->collection->updateContractLine($contract_id,$contract_status_id);
        
        $this->collection->updateAmortizationLine($amortizationid,$interest,$principal,$vat,$surcharge,$paidup,$pay_date);

        // $payment = array(
        //     'contract_id' => $this->input->post('contract_id'),
        //     'pay_reference' => $this->input->post('payment_type'),
        //     'pay_date' => $this->input->post('payment_date'),
        //     'amount' => $this->input->post('amount'),
        //     'principal' => $this->input->post('principal'),
        //     'interest' => $this->input->post('interest'),
        //     'surcharge' => $this->input->post('surcharge'),
        //     'sundry' => $this->input->post('sundry'),
        //     'balance' => $this->input->post('balance'),
        //     'cashier_id' => $this->input->post('cashier_id'),
        //     );
        // $datareturn2 = $this->collection->insertPayment($payment);

        // $checkPayment = array(
        //     'payment_id' => $datareturn2,
        //     'amount' => $this->input->post('amount'),
        //     'check_number' => $this->input->post('check_number'),
        //     'check_date' => $this->input->post('check_date'),
        //     'bank_id' => $this->input->post('bank_id'),
        //     );

        // $this->collection->insertPaymentCheck($checkPayment);
    }

    public function savePaymentCashAndCheck()
    {
        $amortizationid = $this->input->post('amortization_id');
        $principal = $this->input->post('principal_paid');
        $surcharge = $this->input->post('surcharge_paid');
        $paidup = $this->input->post('paid_up');
        $vat = $this->input->post('vat_paid');
        //$ips = $this->input->post('ips_paid');
        $interest = $this->input->post('interst_paid');
        $contract_id = $this->input->post('contract_id');
        $contract_status_id = $this->input->post('contract_status_id');
        $pay_date = $this->input->post('payment_date');
        
        $this->collection->updateContractLine($contract_id,$contract_status_id);
        
        $this->collection->updateAmortizationLine($amortizationid,$interest,$principal,$vat,$surcharge,$paidup,$pay_date);

        // $payment = array(
        //     'contract_id' => $this->input->post('contract_id'),
        //     'pay_reference' => $this->input->post('payment_type'),
        //     'pay_date' => $this->input->post('payment_date'),
        //     'amount' => $this->input->post('amount'),
        //     'principal' => $this->input->post('principal'),
        //     'interest' => $this->input->post('interest'),
        //     'surcharge' => $this->input->post('surcharge'),
        //     'sundry' => $this->input->post('sundry'),
        //     'balance' => $this->input->post('balance'),
        //     'cashier_id' => $this->input->post('cashier_id'),
        //     );
        // $datareturn2 = $this->collection->insertPayment($payment);

        // $checkPayment = array(
        //     'payment_id' => $datareturn2,
        //     'amount' => $this->input->post('amount_check'),
        //     'check_number' => $this->input->post('check_number'),
        //     'check_date' => $this->input->post('check_date'),
        //     'bank_id' => $this->input->post('bank_id'),
        //     );

        // $this->collection->insertPaymentCheck($checkPayment);
    }

    public function savePaymentInterBranch()
    {
        $amortizationid = $this->input->post('amortization_id');
        $principal = $this->input->post('principal_paid');
        $surcharge = $this->input->post('surcharge_paid');
        $paidup = $this->input->post('paid_up');
        $vat = $this->input->post('vat_paid');
        //$ips = $this->input->post('ips_paid');
        $interest = $this->input->post('interst_paid');
        $contract_id = $this->input->post('contract_id');
        $contract_status_id = $this->input->post('contract_status_id');
        $pay_date = $this->input->post('payment_date');
        
        $this->collection->updateContractLine($contract_id,$contract_status_id);
        
        $this->collection->updateAmortizationLine($amortizationid,$interest,$principal,$vat,$surcharge,$paidup,$pay_date);

        // $payment = array(
        //     'contract_id' => $this->input->post('contract_id'),
        //     'pay_reference' => $this->input->post('payment_type'),
        //     'pay_date' => $this->input->post('payment_date'),
        //     'amount' => $this->input->post('amount'),
        //     'principal' => $this->input->post('principal'),
        //     'interest' => $this->input->post('interest'),
        //     'surcharge' => $this->input->post('surcharge'),
        //     'sundry' => $this->input->post('sundry'),
        //     'balance' => $this->input->post('balance'),
        //     'cashier_id' => $this->input->post('cashier_id'),
        //     );
        // $datareturn2 = $this->collection->insertPayment($payment);

        // $interbranchPayment = array(
        //     'payment_id' => $datareturn2,
        //     'amount' => $this->input->post('amount'),
        //     'account_number' => $this->input->post('account_number'),
        //     'deposit_date' => $this->input->post('deposit_date'),
        //     'bank_id' => $this->input->post('bank_id'),
        //     );

        // $this->collection->insertPaymentInterBranch($interbranchPayment);
    }

    public function postdatedchecks(){

        $this->data['content'] = 'postdatedchecks';
        $this->data['page_title'] = 'Post Dated Checks';
        $this->data['customjs'] = 'postdatedchecksjs';
        $this->data['projects'] = $this->collection->getProjects();
        $this->data['customers'] = $this->collection->get_customers2();
        $this->data['customers2'] = $this->collection->get_customers2();
        $this->data['organizations'] = $this->collection->get_organizations();
        $this->data['organizations2'] = $this->collection->get_organizations();
        $this->data['allbanks'] = $this->collection->getAllBanks();
        $this->data['allbanks2'] = $this->collection->getAllBanks();
        $this->data['allbanks3'] = $this->collection->getAllBanks();
        $this->data['allbanks4'] = $this->collection->getAllBanks();
        $this->load->view('default/index', $this->data);
    
    }

    public function monthlydues(){

        $this->data['content'] = 'monthlydues';
        $this->data['page_title'] = 'Monthly Dues';
        $this->data['customjs'] = 'monthlyduesjs';
        $this->data['monthlydues'] = $this->collection->get_this_month_due();
        $this->load->view('default/index', $this->data);

    
    }

    public function agingreport(){

        $this->data['content'] = 'agingreport';
        $this->data['page_title'] = 'Aging Reports';
        $this->data['customjs'] = 'agingreportjs';
        //$this->data['monthlydues'] = $this->collection->get_this_month_due();
        $this->load->view('default/index', $this->data);

    
    }

    public function get_postdatedchecks_1()
    {
        $fromDate = $this->input->post('fromDate');
        $datareturn = $this->collection->getPostDatedChecks1($fromDate);
        echo json_encode($datareturn);
    }
    public function get_postdatedchecks_2()
    {
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $datareturn = $this->collection->getPostDatedChecks2($fromDate,$toDate);
        echo json_encode($datareturn);
    }

    public function get_monthly_dues_report2()
    {
        $datareturn = $this->collection->get_this_month_due();
        echo json_encode($datareturn);
    }

    public function get_monthly_dues_report()
    {
        $month=date("M");
        $year=date("Y");
        $this->load->library('PHPExcel', NULL, 'excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Monthly Dues ('.$month.' '.$year.')');
        $data = $this->input->post('data');
        $data = json_decode($data,true);

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
        $this->excel->getActiveSheet()->mergeCells('A1:L1');
        $this->excel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A1', 'Monthly Dues ('.$month.' '.$year.')');
        $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
        $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(60);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(60);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
        $this->excel->getActiveSheet()->setCellValue('A2', 'Due Date');
        $this->excel->getActiveSheet()->setCellValue('B2', 'Customer Name');
        $this->excel->getActiveSheet()->setCellValue('C2', 'Lot Description');
        $this->excel->getActiveSheet()->setCellValue('D2', 'Days Due');
        $this->excel->getActiveSheet()->setCellValue('E2', 'Amount Due');
        $this->excel->getActiveSheet()->setCellValue('F2', 'Amortization Amount');
        $this->excel->getActiveSheet()->setCellValue('G2', 'Surcharge Amount');
        $this->excel->getActiveSheet()->setCellValue('H2', 'VAT');
        $this->excel->getActiveSheet()->setCellValue('I2', 'IP & S');
        $this->excel->getActiveSheet()->setCellValue('J2', 'Interest');
        $this->excel->getActiveSheet()->setCellValue('K2', 'Principal');
        $this->excel->getActiveSheet()->setCellValue('L2', 'Payments');
        $ips = '0';
        $row = 3;
        
        foreach($data as $r){
            if($r['interest']==""){
                $interest = '0';
            } else {
                $interest = $r['interest'];
            }
            if($r['vat']==""){
                $vat = '0';
            } else {
                $vat = $r['vat'];
            }
            $this->excel->getActiveSheet()->fromArray(array($r['duedate'], $r['customername'], $r['lotdesc'], $r['daysdue'], $r['amountdue'], $r['amortdue'], $r['surcharge'], $r['vat'], $r['ips'], $r['interest'], $r['principal'], $r['payments']), null, 'A'.$row);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':L'.$row)->applyFromArray($styleArray2);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':L'.$row)->applyFromArray($styleArray4);
            $row++;
        }

        
        date_default_timezone_set("Asia/Manila");
        $timestamp=date("Y-m-d-His");
        $filename='MonthlyDues.xls'; 
 
        $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0');

        ob_end_clean();
        $writer->save('./reports/'.$filename);
        exit();
    }

    public function get_postdatedchecks_1_report()
    {
        $this->load->library('PHPExcel', NULL, 'excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Postdated Checks');
        $fromDate = $this->input->post('fromDate');
        $data = $this->collection->getPostDatedChecks1($fromDate);

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
        $this->excel->getActiveSheet()->mergeCells('A1:F1');
        $this->excel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A1', 'Post Dated Checks from '.$fromDate);
        $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
        $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $this->excel->getActiveSheet()->setCellValue('A2', 'Customer');
        $this->excel->getActiveSheet()->setCellValue('B2', 'Check Date');
        $this->excel->getActiveSheet()->setCellValue('C2', 'Source Bank');
        $this->excel->getActiveSheet()->setCellValue('D2', 'Check Number');
        $this->excel->getActiveSheet()->setCellValue('E2', 'Check Amount');
        $this->excel->getActiveSheet()->setCellValue('F2', 'Destination Bank');

        $row = 3;
        foreach($data as $r){
            $this->excel->getActiveSheet()->fromArray(array($r['firstname'].' '.$r['middlename'].' '.$r['lastname'], $r['check_date'], $r['bankname1'], $r['check_number'], $r['amount'],  $r['bankname2'],), null, 'A'.$row);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($styleArray2);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($styleArray4);
            $row++;
        }

        
        date_default_timezone_set("Asia/Manila");
        $timestamp=date("Y-m-d-His");
        $filename='PostdatedChecks.xls'; 
        $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0');

        ob_end_clean();
        $writer->save('./reports/'.$filename);
        exit();
        //ob_end_flush();

    }

    public function get_postdatedchecks_2_report()
    {
        $this->load->library('PHPExcel', NULL, 'excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Postdated Checks');
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $data = $this->collection->getPostDatedChecks2($fromDate,$toDate);

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
        $this->excel->getActiveSheet()->mergeCells('A1:F1');
        $this->excel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A1', 'Post Dated Checks from '.$fromDate.' to '.$toDate);
        $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
        $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $this->excel->getActiveSheet()->setCellValue('A2', 'Date');
        $this->excel->getActiveSheet()->setCellValue('B2', 'Bank');
        $this->excel->getActiveSheet()->setCellValue('C2', 'Customer');
        $this->excel->getActiveSheet()->setCellValue('D2', 'Check Number');
        $this->excel->getActiveSheet()->setCellValue('E2', 'Amount');
        $this->excel->getActiveSheet()->setCellValue('F2', 'Destination Bank');

        $row = 3;
        foreach($data as $r){
            $this->excel->getActiveSheet()->fromArray(array($r['firstname'].' '.$r['middlename'].' '.$r['lastname'], $r['check_date'], $r['bankname1'], $r['check_number'], $r['amount'],  $r['bankname2'],), null, 'A'.$row);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($styleArray2);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($styleArray4);
            $row++;
        }

        
        date_default_timezone_set("Asia/Manila");
        $timestamp=date("Y-m-d-His");
        $filename='PostdatedChecks.xls'; 
 
        header('Content-Type: application/vnd.ms-excel'); 
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
 
        header('Cache-Control: max-age=0'); 
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');

        ob_end_clean();
        $objWriter->save('./reports/'.$filename);
        exit();
    }

    public function receipt(){
        //adjust the 'pay_reference' => $or_code to a new correct format

        $or_code = $this->collection->get_or_code($this->input->post('contract_id'));

        $payment = array(
            'contract_id' => $this->input->post('contract_id'),
            'amortization_id' => $this->input->post('amortization_id'),
            'pay_reference' => $or_code,
            'payment_type' => $this->input->post('payment_type'),
            'pay_reference' => $or_code,
            'pay_date' => $this->input->post('payment_date'),
            'amount' => $this->input->post('r_total_amount'),
            'principal' => $this->input->post('r_principal'),
            'interest' => $this->input->post('r_interest'),
            'surcharge' => $this->input->post('r_surcharge_paid'),
            'ips_accrued' => $this->input->post('r_ips_accrued_paid'),
            'ips_interest' => $this->input->post('r_ips_interest_paid'),
            'sundry' => $this->input->post('sundry'),
            'balance' => $this->input->post('balance'),
            'cashier_id' => $this->input->post('cashier_id'),
            );

        $datareturn2 = $this->collection->insertPayment($payment);

        $check_exist = $this->input->post('r_check_date');

        if ($check_exist){

            $checkPayment = array(
            'payment_id' => $datareturn2,
            'amount' => $this->input->post('r_check_amount'),
            'check_number' => $this->input->post('r_check_number'),
            'check_date' => $this->input->post('r_check_date'),
            'bank_id' => $this->input->post('bank_id'),
            );

            $this->collection->insertPaymentCheck($checkPayment);
        }

        $bank_exist = $this->input->post('r_bank_deposit_date');

        if ($bank_exist){
            $interbranchPayment = array(
            'payment_id' => $datareturn2,
            'amount' => $this->input->post('r_bank_amount'),
            'account_number' => $this->input->post('account_number'),
            'deposit_date' => $this->input->post('r_bank_deposit_date'),
            'bank_id' => $this->input->post('bank_id'),
            );

            $this->collection->insertPaymentInterBranch($interbranchPayment);
        }

        $is_tax_deferred = $this->input->post('is_tax_deferred');
        $license_to_sell = $this->input->post('license_to_sell');

        $paymenttype = $this->input->post('payment_type');

        if($paymenttype == '1'){
            $paymenttypedesc = 'Cash Payment';
        }
        if($paymenttype == '1'){
            $paymenttypedesc = 'Check Payment';
        }
        if($paymenttype == '1'){
            $paymenttypedesc = 'Cash and Check Payment';
        }
        if($paymenttype == '1'){
            $paymenttypedesc = 'Interbranch Payment';
        }

        date_default_timezone_set("Asia/Manila");
        $date = date('Y-m-d');
        $customername = $this->input->post('customername');
        $lotdesc = $this->input->post('r_lot_desc');
        $remarks = $customername.' / '.$lotdesc.' '.$paymenttypedesc;
        if ($is_tax_deferred == '1' && $license_to_sell == '0') {
            $transaction = array (
                'book_code' => '0F',
                'book_prefix' => 'OR#',
                'reference' => $reference_no,
                'subsidiary_name' => $this->input->post('customername'),
                'remarks' => $remarks,
                'encode_by' => $this->input->post('cashier_id'),
                );
            $transaction_id = $this->collection->insertTransaction($transaction);

            $transaction_detail1 = array (
                'transaction_id' => $transaction_id,
                'book_code' => '0F',
                'prefix' => 'OR#',
                'reference' => $reference_no,
                'account_code' => '10010',
                'post_date' => $date,
                'debit' => $this->input->post('r_total_payment_details2'),
                'subsidiary_code' => $this->input->post('subsidiary_code'),
                );
            $this->collection->insertTransactionDetails($transaction_detail1);

            $transaction_detail2 = array (
                'transaction_id' => $transaction_id,
                'book_code' => '0F',
                'prefix' => 'OR#',
                'reference' => $reference_no,
                'account_code' => '20500',
                'post_date' => $date,
                'credit' => $this->input->post('r_total_payment_details2'),
                'subsidiary_code' => $this->input->post('subsidiary_code'),
                );
            $this->collection->insertTransactionDetails($transaction_detail2);
        }

        if ($is_tax_deferred == '1' && $license_to_sell == '1') {
            
        }

        if ($is_tax_deferred == '0' && $license_to_sell == '0') {
            $transaction = array (
                'book_code' => '0F',
                'book_prefix' => 'OR#',
                'reference' => $reference_no,
                'subsidiary_name' => $this->input->post('customername'),
                'remarks' => $remarks,
                'encode_by' => $this->input->post('cashier_id'),
                );
            $transaction_id = $this->collection->insertTransaction($transaction);

            $transaction_detail3 = array (
                'transaction_id' => $transaction_id,
                'book_code' => '0F',
                'prefix' => 'OR#',
                'reference' => $reference_no,
                'account_code' => '10010',
                'post_date' => $date,
                'debit' => $this->input->post('r_total_payment_details2'),
                'subsidiary_code' => $this->input->post('subsidiary_code'),
                );
            $this->collection->insertTransactionDetails($transaction_detail3);

            $transaction_detail4 = array (
                'transaction_id' => $transaction_id,
                'book_code' => '0F',
                'prefix' => 'OR#',
                'reference' => $reference_no,
                'account_code' => '20500',
                'post_date' => $date,
                'credit' => $this->input->post('r_total_payment_details2'),
                'subsidiary_code' => $this->input->post('subsidiary_code'),
                );
            $this->collection->insertTransactionDetails($transaction_detail4);
        }

        if ($is_tax_deferred == '0' && $license_to_sell == '1') {
            
        }


        $this->load->library('Pdf');
        $r_customer_name = $this->input->post('r_customer_name');
        $r_customer_address = $this->input->post('r_customer_address');
        $r_customer_tin = $this->input->post('r_customer_tin');
        $r_lot_desc = $this->input->post('r_lot_desc');
        $r_vatable_amount = $this->input->post('r_vatable_amount');
        $r_vat_exempt_amount = $this->input->post('r_vat_exempt_amount');
        $r_vat_zero_rated_amount = $this->input->post('r_vat_zero_rated_amount');
        $r_add_vat = $this->input->post('r_add_vat');
        $r_total_or_details = $this->input->post('r_total_or_details');
        $r_surcharge_paid = $this->input->post('r_surcharge_paid');
        $r_ips = $this->input->post('r_ips');
        $r_interest = $this->input->post('r_interest');
        $r_principal = $this->input->post('r_principal');
        $r_total_payment_details = $this->input->post('r_total_payment_details');
        $r_cash_amount = $this->input->post('r_cash_amount');
        $r_check_amount = $this->input->post('r_check_amount');
        $r_check_date = $this->input->post('r_check_date');
        //get designated bank
        $r_check_bank = $this->input->post('r_check_bank');
        $r_check_number = $this->input->post('r_check_number');
        $r_bank_amount = $this->input->post('r_bank_amount');
        //get designated bank
        $r_bank_designated = $this->input->post('r_bank_designated');
        $r_bank_deposit_date = $this->input->post('r_bank_deposit_date');
        $r_total_amount = $this->input->post('r_total_amount');
        //get user
        $user_id = $this->input->post('user_id');
        

        $pdf = new Pdf('L', 'in', 'MEMO', true, 'UTF-8', false);
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

        $pdf->AddPage();
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        
        //ayuha niiiiii!
        $pdf->writeHTMLCell(110, '', '', '', '<h4>OFFICIAL RECEIPT</h4>', 0, 0, 0, true, 'R', true);
        $pdf->SetTextColor(0, 63, 127);
        $pdf->writeHTMLCell(70, '', '', '', 'OR#' .  $or_code . '' . $datareturn2, 0, 0, 0, true, 'R', true);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->SetFont ('helvetica', '', 10 , 15, 'default', true );

        $pdf->Ln(6);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Customer Name: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', $r_customer_name, 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Date: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', date_format(date_create($date), "M d, Y"), 0, 0, 0, true, 'L', true);

        $pdf->Ln(5);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Customer Address: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', $r_customer_address, 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>TIN: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $r_customer_tin, 0, 0, 0, true, 'L', true);

        $pdf->Ln(10);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Lot Description: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', $r_lot_desc, 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Amount: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', number_format($r_total_amount, 2), 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);

        $pdf->writeHTMLCell(86, '', '', '', '<b>OR DETAILS</b>', 'LTBR', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(86, '', '', '', '<b>AMORT PAYMENT DETAILS</b>', 'LTBR', 0, 0, true, 'C', true);

        $pdf->Ln(5);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(43, '', '', '', '<b>Vatable Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_vatable_amount, 2), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Surcharge</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_surcharge_paid, 2), 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Vat Exempt Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_vat_exempt_amount, 2), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>IP & S</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_ips, 2), 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Vat Zero Rated Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_vat_zero_rated_amount, 2), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Interest</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_interest, 2), 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Principal</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_principal, 2), 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Total Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_total_or_details, 2), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>add VAT</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_add_vat, 2), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Net Amount Received</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b></b>', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Total Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>'.number_format($r_total_payment_details, 2).'</b>', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(6);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Authenticated by</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Payment Type</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Bank</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Check No.</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Check Date</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Amount</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Remarks</b>', 'LTB', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(12, '', '', '', '', 'TRB', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '', 'LR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Cash</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', number_format($r_cash_amount, 2), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'L', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'R', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '', 'LR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Check</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $r_check_bank, 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $r_check_number, 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $r_check_date, 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', number_format($r_check_amount, 2), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'L', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'R', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '', 'LRB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Bank Deposit</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $r_bank_designated, 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', number_format($r_bank_amount, 2), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'L', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'R', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Cashier/Date</b>', 'LBT', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Credit Card</b>', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'LB', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'BR', 0, 0, true, 'L', true);

        $pdf->Ln(5);

        $pdf->writeHTMLCell(180, '', '', '', '<i>This receipt, if fully authenticated by our cashier is our official confirmation of your payment made on or Provisional Receipt. Check payment will not be credited upon proper clearance from bank. Thank you.</i>', 0, 0, 0, true, 'L', true);

        // redirect(base_url(). 'collection/reservation', 'refresh');


        // $pdf->Output('Receipt.pdf', 'I');
        $pdf->Output('C:\wamp64\www\irm\reports\Receipt.pdf', 'F');

    }

    public function receipt2(){

        $this->load->library('Pdf');
        $r_customer_name = $this->input->post('r_customer_name');
        $r_customer_address = $this->input->post('r_customer_address');
        $r_customer_tin = $this->input->post('r_customer_tin');
        $r_lot_desc = $this->input->post('r_lot_desc');
        $r_vatable_amount = $this->input->post('r_vatable_amount');
        $r_vat_exempt_amount = $this->input->post('r_vat_exempt_amount');
        $r_vat_zero_rated_amount = $this->input->post('r_vat_zero_rated_amount');
        $r_add_vat = $this->input->post('r_add_vat');
        $r_total_or_details = $this->input->post('r_total_or_details');
        $r_surcharge_paid = $this->input->post('r_surcharge_paid');
        $r_ips = $this->input->post('r_ips');
        $r_interest = $this->input->post('r_interest');
        $r_principal = $this->input->post('r_principal');
        $r_total_payment_details = $this->input->post('r_total_payment_details');
        $r_cash_amount = $this->input->post('r_cash_amount');
        $r_check_amount = $this->input->post('r_check_amount');
        $r_check_date = $this->input->post('r_check_date');
        //get designated bank
        $r_check_bank = $this->input->post('r_check_bank');
        $r_check_number = $this->input->post('r_check_number');
        $r_bank_amount = $this->input->post('r_bank_amount');
        //get designated bank
        $r_bank_designated = $this->input->post('r_bank_designated');
        $r_bank_deposit_date = $this->input->post('r_bank_deposit_date');
        $r_total_amount = $this->input->post('r_total_amount');
        //get user
        $user_id = $this->input->post('user_id');
        date_default_timezone_set("Asia/Manila");
        $date = date('Y-m-d');

        $pdf = new Pdf('L', 'in', 'MEMO', true, 'UTF-8', false);
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

        $pdf->AddPage();
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        

        $pdf->writeHTMLCell(180, '', '', '', '<h4>OFFICIAL RECEIPT</h4>', 0, 0, 0, true, 'C', true);
        $pdf->SetFont ('helvetica', '', 10 , 15, 'default', true );

        $pdf->Ln(6);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Customer Name: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', $r_customer_name, 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Date: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $date, 0, 0, 0, true, 'L', true);

        $pdf->Ln(5);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Customer Address: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', $r_customer_address, 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>TIN: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $r_customer_tin, 0, 0, 0, true, 'L', true);

        $pdf->Ln(5);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Lot Description: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', $r_lot_desc, 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Amount: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', number_format($r_total_amount, 2), 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);

        $pdf->writeHTMLCell(86, '', '', '', '<b>OR DETAILS</b>', 'LTBR', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(86, '', '', '', '<b>AMORT PAYMENT DETAILS</b>', 'LTBR', 0, 0, true, 'C', true);

        $pdf->Ln(5);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(43, '', '', '', '<b>Vatable Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_vatable_amount, 2), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Surcharge</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_surcharge_paid, 2), 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Vat Exempt Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_vat_exempt_amount, 2), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>IP & S</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_ips, 2), 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Vat Zero Rated Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_vat_zero_rated_amount, 2), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Interest</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_interest, 2), 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Principal</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_principal, 2), 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Total Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_total_or_details, 2), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>add VAT</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_add_vat, 2), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Net Amount Received</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b></b>', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Total Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>'.number_format($r_total_payment_details, 2).'</b>', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(6);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Authenticated by</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Payment Type</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Bank</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Check No.</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Check Date</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Amount</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Remarks</b>', 'LTB', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(12, '', '', '', '', 'TRB', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '', 'LR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Cash</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', number_format($r_cash_amount, 2), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'L', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'R', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '', 'LR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Check</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $r_check_bank, 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $r_check_number, 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $r_check_date, 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', number_format($r_check_amount, 2), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'L', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'R', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '', 'LRB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Bank Deposit</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $r_bank_designated, 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', number_format($r_bank_amount, 2), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'L', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'R', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Cashier/Date</b>', 'LBT', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Credit Card</b>', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'LB', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'BR', 0, 0, true, 'L', true);

        $pdf->Ln(5);

        $pdf->writeHTMLCell(180, '', '', '', '<i>This receipt, if fully authenticated by our cashier is our official confirmation of your payment made on or Provisional Receipt. Check payment will not be credited upon proper clearance from bank. Thank you.</i>', 0, 0, 0, true, 'L', true);



        // $pdf->Output('C:\xampp\htdocs\irm\reports\Receipt.pdf', 'F');
        $pdf->Output('C:\wamp64\www\irm\reports\Receipt.pdf', 'F');
        
    }

    public function print_all_payments(){
        $this->load->library('Pdf');
        $contractid = $this->input->post('contractid');
        $contract = $this->collection->getClientDetailsForPayment($contractid);
        $amortization = $this->collection->getAmortizationDetails($contractid);
        $payment = $this->collection->getPaymentDetails($contractid);
        
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

        $fullname    = $contract[0]['lastname'] . ', ' . $contract[0]['firstname'] . ' ' . $contract[0]['middlename'];
        $lot_description      = $contract[0]['lot_description'];
        $address        = $contract[0]['line_1'].', '.$contract[0]["city_name"].', '.$contract[0]["province_name"].', '.$contract[0]["country_name"];
        $tcp          = number_format($contract[0]['total_contract_price'], 2);
        $area         = number_format($contract[0]['lot_area'], 2);
        $psqm = number_format($contract[0]['price_per_sqr_meter'], 2);
        $tin         = $contract[0]['tin'];

        $pdf->AddPage();
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(10);

        $pdf->writeHTMLCell(40, '', '', $y, '<b>Name: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(70, '', '', '', $fullname, 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>TIN: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $tin, 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Address: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $address, 0, 0, 0, true, 'L', true);

        $pdf->Ln(12);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Lot Description: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(100, '', '', '', $lot_description , 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Lot Area: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(70, '', '', '', $area, 0, 0, 0, true, 'L', true);
        
        $pdf->writeHTMLCell(25, '', '', '', '<b>TCP: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $tcp, 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(7);
        $pdf->writeHTMLCell(40, '', '', '', '<b>Price Per Sqr. Meter: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $psqm, 0, 0, 0, true, 'L', true);
        
        $pdf->Ln(5);
        $pdf->writeHTMLCell(190, '', '', '', '<b><h2>SUMMARY OF PAYMENTS</h2></b>', 0, 0, 0, true, 'C', true);

        $pdf->SetFont ('helvetica', '', 10 , 15, 'default', true );
        $pdf->Ln(20);
        $pdf->writeHTMLCell(25, '', 15, '', '<b>Payment Date</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', 40, '', '<b>Payment Type</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', 65, '', '<b>Amount Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', 92, '', '<b>Principal Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', 120, '', '<b>Surcharge Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', 145, '', '<b>Interest Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', 167, '', '<b>I P & S Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', 187, '', '<b>Unpaid Amount</b>', 0, 0, 0, true, 'L', true);
        $pdf->Ln(7);
        foreach ($payment as $payment) {
            $pdf->Ln(5);
            $pdf->writeHTMLCell(25, '', 15, '', $payment['pay_date'], 0, 0, 1, true, 'L', true);
            $pdf->writeHTMLCell(25, '', 40, '', ucfirst(strtolower($payment['payment_name'])), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', 65, '', number_format($payment['amount'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(25, '', 92, '', number_format($payment['principal'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(25, '', 120, '', number_format($payment['surcharge'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', 145, '', number_format($payment['interest'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', 167, '', number_format($payment['ips'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', 187, '', number_format($payment['balance'], 2), 0, 0, 0, true, 'L', true);
            $type = $amort_val['line_type'];
        }


        $pdf->Output('C:\wamp64\www\irm\reports\SummaryOfPayments.pdf', 'FD');
    }

    public function print_postdatedchecks_1_report(){

        $fromDate = $this->input->post('fromDate');
        $data = $this->collection->getPostDatedChecks1($fromDate);

        $fromDate2 = date('M d Y', strtotime($fromDate));

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

        $pdf->AddPage();
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(3);

        $pdf->writeHTMLCell(190, '', '', '', '<h3>Postdated Checks from '.$fromDate2.'</h3>', 0, 0, 0, true, 'C', true);

        $pdf->Ln(10);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(40, '', '', '', '<b>Customer</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Check Date</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Source Bank</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Check Number</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Check Amount</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Destination Bank</b>', 0, 0, 0, true, 'L', true);

        $pdf->Ln(5);

        foreach ($data as $r){
            $pdf->Ln(5);
            $date = date('M d Y', strtotime($r['check_date']));
            $pdf->writeHTMLCell(40, '', '', '', $r['firstname'].' '.$r['middlename'].' '.$r['lastname'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['check_date'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', $r['bankname1'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', $r['check_number'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['amount'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', $r['bankname2'], 0, 0, 0, true, 'L', true);

        }

        $pdf->Output('C:\wamp64\www\irm\reports\PostdatedChecks.pdf', 'F');

    }

    public function print_postdatedchecks_2_report(){

        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $data = $this->collection->getPostDatedChecks2($fromDate,$toDate);

        $fromDate2 = date('M d, Y', strtotime($fromDate));
        $toDate2 = date('M d, Y', strtotime($toDate));

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

        $pdf->AddPage();
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(3);

        $pdf->writeHTMLCell(170, '', '', '', '<h3>Postdated Checks from '.$fromDate2.' to '.$toDate2.'</h3>', 0, 0, 0, true, 'C', true);

        $pdf->Ln(10);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(40, '', '', '', '<b>Customer</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Check Date</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Source Bank</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Check Number</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Check Amount</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Destination Bank</b>', 0, 0, 0, true, 'L', true);

        $pdf->Ln(5);

        foreach ($data as $r){
            $pdf->Ln(5);
            $date = date('M d Y', strtotime($r['check_date']));
            $pdf->writeHTMLCell(40, '', '', '', $r['firstname'].' '.$r['middlename'].' '.$r['lastname'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['check_date'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', $r['bankname1'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', $r['check_number'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', $r['amount'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', $r['bankname2'], 0, 0, 0, true, 'L', true);

        }

        $pdf->Output('C:\wamp64\www\irm\reports\PostdatedChecks.pdf', 'F');
        
    }

    public function print_monthly_dues_report(){

        $data = $this->input->post('data');
        $data = json_decode($data,true);

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

        $pdf->AddPage("L");
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(3);
        $date = date('M Y');
        $pdf->writeHTMLCell(270, '', '', $y, '<h3>Monthly Dues '.$date.'</h3>', 0, 0, 0, true, 'C', true);

        $pdf->Ln(7);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(20, '', '', '', '<b>Due Date</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(35, '', '', '', '<b>Customer Name</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(45, '', '', '', '<b>Lot Description</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(15, '', '', '', '<b>Days Due</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Amount Due</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Amortization</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Surcharge</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>VAT</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>IP & S</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Interest</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Principal</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Payments</b>', 0, 0, 0, true, 'L', true);

        foreach ($data as $r){
            $pdf->Ln(7);
            $pdf->writeHTMLCell(20, '', '', '', date('M d Y', strtotime($r['duedate'])), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(35, '', '', '', $r['customername'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(45, '', '', '', $r['lotdesc'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(15, '', '', '', $r['daysdue'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['amountdue'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['amortdue'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['surcharge'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['vat'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['ips'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['interest'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['principal'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['payments'], 0, 0, 0, true, 'L', true);
        }

        $pdf->Output('C:\wamp64\www\irm\reports\MonthlyDues.pdf', 'F');

    }

    public function get_daily_sales(){
        $datareturn = $this->collection->getDailySales();
        echo json_encode($datareturn);
    }

    public function get_monthly_sales(){
        $datareturn = $this->collection->getMonthlySales();
        echo json_encode($datareturn);
    }

    public function get_monthly_sales2(){
        $datareturn = $this->collection->getMonthlySales2();
        echo json_encode($datareturn);
    }

    public function get_amort_for_aging(){
        $datareturn = $this->collection->getAllAmortization();
        echo json_encode($datareturn);
    }

    public function get_person_for_aging(){
        $contractid = $this->input->post('contractid');
        $datareturn = $this->collection->getPerson($contractid);
        echo json_encode($datareturn);
    }

    public function get_aging_report_detailed(){

        $date = date('M d, Y');
        $this->load->library('PHPExcel', NULL, 'excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Aging Report Detailed');
        $data = $this->input->post('data');
        $data = json_decode($data,true);

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
        $this->excel->getActiveSheet()->setCellValue('A1', 'Aging Report Detailed  ('.$date.')');
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(60);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
        $this->excel->getActiveSheet()->setCellValue('A2', 'Customer Name');
        $this->excel->getActiveSheet()->setCellValue('B2', '0-30 Days');
        $this->excel->getActiveSheet()->setCellValue('C2', '31-60 Days');
        $this->excel->getActiveSheet()->setCellValue('D2', '61-90 Days');
        $this->excel->getActiveSheet()->setCellValue('E2', '91-120 Days');
        $this->excel->getActiveSheet()->setCellValue('F2', '120 Days and More');
        $this->excel->getActiveSheet()->setCellValue('G2', 'Current Total');
        $this->excel->getActiveSheet()->setCellValue('H2', 'Longterm Total');

        $row = 3;

        $days_total_030 = 0;
        $days_total_3160 = 0;
        $days_total_6190 = 0;
        $days_total_91120 = 0;
        $daysmore_total_120 = 0;
        $currenttotal_total = 0;
        $longtermtotal_total = 0;
        
        foreach($data as $r){
            $this->excel->getActiveSheet()->fromArray(array($r['customername'], number_format($r['030days'], 2), number_format($r['3160days'], 2), number_format($r['6190days'], 2), number_format($r['91120days'], 2), number_format($r['120daysmore'], 2), number_format($r['currenttotal'], 2), number_format($r['longtermtotal'], 2)), null, 'A'.$row);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray2);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray4);
            $row++;

            $days_total_030 += floatval($r['030days']);
            $days_total_3160 += floatval($r['3160days']);
            $days_total_6190 += floatval($r['6190days']);
            $days_total_91120 += floatval($r['91120days']);
            $daysmore_total_120 += floatval($r['120daysmore']);
            $currenttotal_total += floatval($r['currenttotal']);
            $longtermtotal_total += floatval($r['longtermtotal']);
        }
        $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->fromArray(array('TOTAL', number_format($days_total_030, 2), number_format($days_total_3160, 2), number_format($days_total_6190, 2), number_format($days_total_91120, 2), number_format($daysmore_total_120, 2), number_format($currenttotal_total, 2), number_format($longtermtotal_total, 2)), null, 'A'.$row);

        
        date_default_timezone_set("Asia/Manila");
        $timestamp=date("Y-m-d-His");
        $filename='AgingDetailed.xls'; 
 
        $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0');

        ob_end_clean();
        $writer->save('./reports/'.$filename);
        exit();
    }

    public function print_aging_report_detailed(){

        $data = $this->input->post('data');
        $data = json_decode($data,true);
        $title = $this->input->post('title');
        $date = date('F d, Y');

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

        $pdf->AddPage("L");
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(3);
        $date = date('M Y');
        $pdf->writeHTMLCell(270, '', '', $y, '<h3>Aging Report Detailed - '.$date.'</h3>', 0, 0, 0, true, 'C', true);

        $pdf->Ln(10);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(50, '', '', '', '<b>Customer Name</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>0-30 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>31-60 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>61-90 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>91-120 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>120 Days and More</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Current Total</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Longterm Total</b>', 0, 0, 0, true, 'L', true);
        $pdf->Ln(3);
        foreach ($data as $r){
            $pdf->Ln(7);
            $pdf->writeHTMLCell(50, '', '', '', $r['customername'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['030days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['3160days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['6190days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['91120days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['120daysmore'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['currenttotal'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['longtermtotal'], 2), 0, 0, 0, true, 'L', true);
        }

        $pdf->Output('C:\wamp64\www\irm\reports\AgingReportDetailed.pdf', 'F');
    }

    public function get_aging_report_summary1(){

        $date = date('M d, Y');
        $this->load->library('PHPExcel', NULL, 'excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Aging Report Summary (Projects)');
        $data = $this->input->post('data');
        $data = json_decode($data,true);

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
        $this->excel->getActiveSheet()->setCellValue('A1', 'Aging Report Summary (Projects) ('.$date.')');
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(60);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
        $this->excel->getActiveSheet()->setCellValue('A2', 'Project Name');
        $this->excel->getActiveSheet()->setCellValue('B2', '0-30 Days');
        $this->excel->getActiveSheet()->setCellValue('C2', '31-60 Days');
        $this->excel->getActiveSheet()->setCellValue('D2', '61-90 Days');
        $this->excel->getActiveSheet()->setCellValue('E2', '91-120 Days');
        $this->excel->getActiveSheet()->setCellValue('F2', '120 Days and More');
        $this->excel->getActiveSheet()->setCellValue('G2', 'Current Total');
        $this->excel->getActiveSheet()->setCellValue('H2', 'Longterm Total');

        $row = 3;

        $days_total_030 = 0;
        $days_total_3160 = 0;
        $days_total_6190 = 0;
        $days_total_91120 = 0;
        $daysmore_total_120 = 0;
        $currenttotal_total = 0;
        $longtermtotal_total = 0;
        
        foreach($data as $r){
            $this->excel->getActiveSheet()->fromArray(array($r['projectname'], number_format($r['030days'], 2), number_format($r['3160days'], 2), number_format($r['6190days'], 2), number_format($r['91120days'], 2), number_format($r['120daysmore'], 2), number_format($r['currenttotal'], 2), number_format($r['longtermtotal'], 2)), null, 'A'.$row);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray2);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray4);
            $row++;

            $days_total_030 += floatval($r['030days']);
            $days_total_3160 += floatval($r['3160days']);
            $days_total_6190 += floatval($r['6190days']);
            $days_total_91120 += floatval($r['91120days']);
            $daysmore_total_120 += floatval($r['120daysmore']);
            $currenttotal_total += floatval($r['currenttotal']);
            $longtermtotal_total += floatval($r['longtermtotal']);
        }

        $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->fromArray(array('TOTAL', number_format($days_total_030, 2), number_format($days_total_3160, 2), number_format($days_total_6190, 2), number_format($days_total_91120, 2), number_format($daysmore_total_120, 2), number_format($currenttotal_total, 2), number_format($longtermtotal_total, 2)), null, 'A'.$row);

        
        date_default_timezone_set("Asia/Manila");
        $timestamp=date("Y-m-d-His");
        $filename='AgingSummaryProject.xls'; 
 
        $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0');

        ob_end_clean();
        $writer->save('./reports/'.$filename);
        exit();
    }

    public function print_aging_report_detailed1(){

        $data = $this->input->post('data');
        $data = json_decode($data,true);
        $title = $this->input->post('title');
        $date = date('F d, Y');

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

        $pdf->AddPage("L");
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(3);
        $pdf->writeHTMLCell(270, '', '', $y, '<h3>Aging Report Projects - '.$date.'</h3>', 0, 0, 0, true, 'C', true);

        $pdf->Ln(10);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(60, '', '', '', '<b>Project</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>0-30 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>31-60 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>61-90 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>91-120 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>120 Days and More</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Current Total</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Longterm Total</b>', 0, 0, 0, true, 'L', true);
        $pdf->Ln(3);
        foreach ($data as $r){
            $pdf->Ln(7);
            $pdf->writeHTMLCell(60, '', '', '', $r['projectname'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['030days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['3160days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['6190days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['91120days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['120daysmore'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['currenttotal'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['longtermtotal'], 2), 0, 0, 0, true, 'L', true);
        }

        $pdf->Output('C:\xampp\htdocs\irm\reports\AgingReportProject.pdf', 'F');
    }

    public function get_aging_report_summary2(){

        $date = date('M d, Y');
        $this->load->library('PHPExcel', NULL, 'excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Aging Report Summary (Tax Type)');
        $data = $this->input->post('data');
        $data = json_decode($data,true);

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
        $this->excel->getActiveSheet()->setCellValue('A1', 'Aging Report Summary (Tax) ('.$date.')');
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(60);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
        $this->excel->getActiveSheet()->setCellValue('A2', 'Tax Type');
        $this->excel->getActiveSheet()->setCellValue('B2', '0-30 Days');
        $this->excel->getActiveSheet()->setCellValue('C2', '31-60 Days');
        $this->excel->getActiveSheet()->setCellValue('D2', '61-90 Days');
        $this->excel->getActiveSheet()->setCellValue('E2', '91-120 Days');
        $this->excel->getActiveSheet()->setCellValue('F2', '120 Days and More');
        $this->excel->getActiveSheet()->setCellValue('G2', 'Current Total');
        $this->excel->getActiveSheet()->setCellValue('H2', 'Longterm Total');

        $row = 3;

        $days_total_030 = 0;
        $days_total_3160 = 0;
        $days_total_6190 = 0;
        $days_total_91120 = 0;
        $daysmore_total_120 = 0;
        $currenttotal_total = 0;
        $longtermtotal_total = 0;
        
        foreach($data as $r){
            $this->excel->getActiveSheet()->fromArray(array($r['taxtype'], number_format($r['030days'], 2), number_format($r['3160days'], 2), number_format($r['6190days'], 2), number_format($r['91120days'], 2), number_format($r['120daysmore'], 2), number_format($r['currenttotal'], 2), number_format($r['longtermtotal'], 2)), null, 'A'.$row);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray2);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray4);
            $row++;

            $days_total_030 += floatval($r['030days']);
            $days_total_3160 += floatval($r['3160days']);
            $days_total_6190 += floatval($r['6190days']);
            $days_total_91120 += floatval($r['91120days']);
            $daysmore_total_120 += floatval($r['120daysmore']);
            $currenttotal_total += floatval($r['currenttotal']);
            $longtermtotal_total += floatval($r['longtermtotal']);
        }
        $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->fromArray(array('TOTAL', number_format($days_total_030, 2), number_format($days_total_3160, 2), number_format($days_total_6190, 2), number_format($days_total_91120, 2), number_format($daysmore_total_120, 2), number_format($currenttotal_total, 2), number_format($longtermtotal_total, 2)), null, 'A'.$row);

        
        date_default_timezone_set("Asia/Manila");
        $timestamp=date("Y-m-d-His");
        $filename='AgingSummaryTax.xls'; 
 
        $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0');

        ob_end_clean();
        $writer->save('./reports/'.$filename);
        exit();
    }

    public function print_aging_report_detailed2(){

        $data = $this->input->post('data');
        $data = json_decode($data,true);
        $title = $this->input->post('title');
        $date = date('F d, Y');

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

        $pdf->AddPage("L");
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(3);
        $pdf->writeHTMLCell(270, '', '', $y, '<h3>Aging Report Projects - '.$date.'</h3>', 0, 0, 0, true, 'C', true);

        $pdf->Ln(10);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(50, '', '', '', '<b>Tax Type</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>0-30 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>31-60 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>61-90 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>91-120 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>120 Days and More</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Current Total</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Longterm Total</b>', 0, 0, 0, true, 'L', true);
        $pdf->Ln(3);
        foreach ($data as $r){
            $pdf->Ln(7);
            $pdf->writeHTMLCell(50, '', '', '', $r['taxtype'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['030days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['3160days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['6190days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['91120days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['120daysmore'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['currenttotal'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['longtermtotal'], 2), 0, 0, 0, true, 'L', true);
        }

        $pdf->Output('C:\xampp\htdocs\irm\reports\AgingReportTax.pdf', 'F');
    }

    public function get_aging_report_summary3(){

        $date = date('M d, Y');
        $this->load->library('PHPExcel', NULL, 'excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Aging Report Summary');
        $data1 = $this->input->post('data1');
        $data1 = json_decode($data1,true);
        $data2 = $this->input->post('data2');
        $data2 = json_decode($data2,true);

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
        $this->excel->getActiveSheet()->setCellValue('A1', 'Aging Report Summary');
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(60);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
        $this->excel->getActiveSheet()->setCellValue('A2', 'Project Name');
        $this->excel->getActiveSheet()->setCellValue('B2', '0-30 Days');
        $this->excel->getActiveSheet()->setCellValue('C2', '31-60 Days');
        $this->excel->getActiveSheet()->setCellValue('D2', '61-90 Days');
        $this->excel->getActiveSheet()->setCellValue('E2', '91-120 Days');
        $this->excel->getActiveSheet()->setCellValue('F2', '120 Days and More');
        $this->excel->getActiveSheet()->setCellValue('G2', 'Current Total');
        $this->excel->getActiveSheet()->setCellValue('H2', 'Longterm Total');

        $row = 3;

        $days_total_0301 = 0;
        $days_total_31601 = 0;
        $days_total_61901 = 0;
        $days_total_911201 = 0;
        $daysmore_total_1201 = 0;
        $currenttotal_total1 = 0;
        $longtermtotal_total1 = 0;
        
        foreach($data1 as $r){
            $this->excel->getActiveSheet()->fromArray(array($r['projectname'], number_format($r['030days'], 2), number_format($r['3160days'], 2), number_format($r['6190days'], 2), number_format($r['91120days'], 2), number_format($r['120daysmore'], 2), number_format($r['currenttotal'], 2), number_format($r['longtermtotal'], 2)), null, 'A'.$row);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray2);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray4);
            $row++;

            $days_total_0301 += floatval($r['030days']);
            $days_total_31601 += floatval($r['3160days']);
            $days_total_61901 += floatval($r['6190days']);
            $days_total_911201 += floatval($r['91120days']);
            $daysmore_total_1201 += floatval($r['120daysmore']);
            $currenttotal_total1 += floatval($r['currenttotal']);
            $longtermtotal_total1 += floatval($r['longtermtotal']);
        }

        $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->fromArray(array('TOTAL', number_format($days_total_0301, 2), number_format($days_total_31601, 2), number_format($days_total_61901, 2), number_format($days_total_911201, 2), number_format($daysmore_total_1201, 2), number_format($currenttotal_total1, 2), number_format($longtermtotal_total1, 2)), null, 'A'.$row);

        $row = $row + 2;

        $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
        $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray4);

        $this->excel->getActiveSheet()->setCellValue('A'.$row, 'Tax Type');
        $this->excel->getActiveSheet()->setCellValue('B'.$row, '0-30 Days');
        $this->excel->getActiveSheet()->setCellValue('C'.$row, '31-60 Days');
        $this->excel->getActiveSheet()->setCellValue('D'.$row, '61-90 Days');
        $this->excel->getActiveSheet()->setCellValue('E'.$row, '91-120 Days');
        $this->excel->getActiveSheet()->setCellValue('F'.$row, '120 Days and More');
        $this->excel->getActiveSheet()->setCellValue('G'.$row, 'Current Total');
        $this->excel->getActiveSheet()->setCellValue('H'.$row, 'Longterm Total');

        

        $days_total_0302 = 0;
        $days_total_31602 = 0;
        $days_total_61902 = 0;
        $days_total_911202 = 0;
        $daysmore_total_1202 = 0;
        $currenttotal_total2 = 0;
        $longtermtotal_total2 = 0;

        $row = $row + 1;
        foreach($data2 as $r){
            $this->excel->getActiveSheet()->fromArray(array($r['taxtype'], number_format($r['030days'], 2), number_format($r['3160days'], 2), number_format($r['6190days'], 2), number_format($r['91120days'], 2), number_format($r['120daysmore'], 2), number_format($r['currenttotal'], 2), number_format($r['longtermtotal'], 2)), null, 'A'.$row);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray2);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray4);
            $row++;

            $days_total_0302 += floatval($r['030days']);
            $days_total_31602 += floatval($r['3160days']);
            $days_total_61902 += floatval($r['6190days']);
            $days_total_911202 += floatval($r['91120days']);
            $daysmore_total_1202 += floatval($r['120daysmore']);
            $currenttotal_total2 += floatval($r['currenttotal']);
            $longtermtotal_total2 += floatval($r['longtermtotal']);
        }

        $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->fromArray(array('TOTAL', number_format($days_total_0302, 2), number_format($days_total_31602, 2), number_format($days_total_61902, 2), number_format($days_total_911202, 2), number_format($daysmore_total_1202, 2), number_format($currenttotal_total2, 2), number_format($longtermtotal_total2, 2)), null, 'A'.$row);

        
        date_default_timezone_set("Asia/Manila");
        $timestamp=date("Y-m-d-His");
        $filename='AgingSummaryBoth.xls'; 
 
        $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0');

        ob_end_clean();
        $writer->save('./reports/'.$filename);
        exit();
    }

    public function print_aging_report_detailed3(){

        $data1 = $this->input->post('data1');
        $data2 = $this->input->post('data2');
        $data1 = json_decode($data1,true);
        $data2 = json_decode($data2,true);
        $title = $this->input->post('title');
        $date = date('F d, Y');

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

        $pdf->AddPage("L");
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(3);
        $pdf->writeHTMLCell(270, '', '', $y, '<h3>Aging Report Projects and Tax Types - '.$date.'</h3>', 0, 0, 0, true, 'C', true);

        $pdf->Ln(10);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(50, '', '', '', '<b>Project</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>0-30 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>31-60 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>61-90 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>91-120 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>120 Days and More</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Current Total</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Longterm Total</b>', 0, 0, 0, true, 'L', true);
        $pdf->Ln(3);
        foreach ($data1 as $r){
            $pdf->Ln(7);
            $pdf->writeHTMLCell(50, '', '', '', $r['projectname'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['030days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['3160days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['6190days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['91120days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['120daysmore'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['currenttotal'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['longtermtotal'], 2), 0, 0, 0, true, 'L', true);
        }

        $pdf->Ln(10);

        $pdf->writeHTMLCell(50, '', '', '', '<b>Tax Type</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>0-30 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>31-60 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>61-90 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>91-120 Days</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>120 Days and More</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Current Total</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Longterm Total</b>', 0, 0, 0, true, 'L', true);
        $pdf->Ln(3);
        foreach ($data2 as $r){
            $pdf->Ln(7);
            $pdf->writeHTMLCell(50, '', '', '', $r['taxtype'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['030days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['3160days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['6190days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['91120days'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['120daysmore'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['currenttotal'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['longtermtotal'], 2), 0, 0, 0, true, 'L', true);
        }

        $pdf->Output('C:\xampp\htdocs\irm\reports\AgingReportProjectsAndTax.pdf', 'F');

    }

    public function collectionprojection(){

        $this->data['content'] = 'collectionprojection';
        $this->data['page_title'] = 'Collection Projection';
        $this->data['customjs'] = 'collectionprojectionjs';
        $this->data['projects'] = $this->collection->getProjects();
        $this->load->view('default/index', $this->data);

    }

    public function get_collection_projection(){
        $projectid = $this->input->post('projectid');
        $datareturn = $this->collection->getCollectionProjection($projectid);
        echo json_encode($datareturn);
    }

    public function get_collection_projection2(){
        $year = $this->input->post('year');
        $projectid = $this->input->post('projectid');
        $datareturn = $this->collection->getCollectionProjection2($year,$projectid);
        echo json_encode($datareturn);
    }

    public function salesprojection(){

        $this->data['content'] = 'salesprojection';
        $this->data['page_title'] = 'Sales Projection';
        $this->data['customjs'] = 'salesprojectionjs';
        $this->data['projects'] = $this->collection->getProjects();
        $this->load->view('default/index', $this->data);

    }

    public function get_collection_projection_report(){


        $date = date('M d, Y');
        $this->load->library('PHPExcel', NULL, 'excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Collection Projection');
        $data = $this->input->post('data');
        $project = $this->input->post('project');
        $year = $this->input->post('year');
        $data = json_decode($data,true);

        $styleArray = array(
        'font'  => array(
            'bold'  => true,
            'size'  => 12,
        ));

        $styleArray2 = array(
        'font'  => array(
            'size'  => 12,
        ));

        $styleArray3 = array(
        'font'  => array(
            'bold'  => true,
            'size'  => 12,
            'color' => array('rgb' => 'FFFFFF'),
        ));

        $styleArray4 = array(
          'borders' => array(
            'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
            )
          )
        );
        $this->excel->getActiveSheet()->mergeCells('A1:U1');
        $this->excel->getActiveSheet()->getStyle('A1:U1')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getStyle('A1:U1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A1', 'Collection Projection - '.$project.' ('.$year.')');
        $this->excel->getActiveSheet()->getStyle('A2:U2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
        $this->excel->getActiveSheet()->getStyle('A2:U2')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A2:U2')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(30);
        $this->excel->getActiveSheet()->setCellValue('A2', 'Lot ID');
        $this->excel->getActiveSheet()->setCellValue('B2', 'Lot Description');
        $this->excel->getActiveSheet()->setCellValue('C2', 'TCP');
        $this->excel->getActiveSheet()->setCellValue('D2', 'Customer');
        $this->excel->getActiveSheet()->setCellValue('E2', 'Invoiced');
        $this->excel->getActiveSheet()->setCellValue('F2', 'Booked');
        $this->excel->getActiveSheet()->setCellValue('G2', 'Deffered');
        $this->excel->getActiveSheet()->setCellValue('H2', 'Vattable');
        $this->excel->getActiveSheet()->setCellValue('I2', '% Paid');
        $this->excel->getActiveSheet()->setCellValue('J2', 'January');
        $this->excel->getActiveSheet()->setCellValue('K2', 'February');
        $this->excel->getActiveSheet()->setCellValue('L2', 'March');
        $this->excel->getActiveSheet()->setCellValue('M2', 'April');
        $this->excel->getActiveSheet()->setCellValue('N2', 'May');
        $this->excel->getActiveSheet()->setCellValue('O2', 'June');
        $this->excel->getActiveSheet()->setCellValue('P2', 'July');
        $this->excel->getActiveSheet()->setCellValue('Q2', 'August');
        $this->excel->getActiveSheet()->setCellValue('R2', 'September');
        $this->excel->getActiveSheet()->setCellValue('S2', 'October');
        $this->excel->getActiveSheet()->setCellValue('T2', 'November');
        $this->excel->getActiveSheet()->setCellValue('U2', 'December');

        $row = 3;

        foreach($data as $r){
            echo $r['lotid'];
        }
        
        foreach($data as $r){
            $this->excel->getActiveSheet()->fromArray(array($r['lotid'], $r['lotdescription'], number_format($r['tcp'], 2), $r['customer'], $r['invoiced'], $r['booked'], $r['deffered'], $r['vattable'], $r['percent'],number_format($r['jan'], 2), number_format($r['feb'], 2), number_format($r['mar'], 2), number_format($r['apr'], 2), number_format($r['may'], 2), number_format($r['jun'], 2), number_format($r['jul'], 2), number_format($r['aug'], 2), number_format($r['sep'], 2), number_format($r['oct'], 2), number_format($r['nov'], 2), number_format($r['dec'], 2)), null, 'A'.$row);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':U'.$row)->applyFromArray($styleArray2);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':U'.$row)->applyFromArray($styleArray4);
            $row++;
        }
        
        date_default_timezone_set("Asia/Manila");
        $timestamp=date("Y-m-d-His");
        $filename='CollectionProjection.xls'; 
 
        $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0');

        ob_end_clean();
        $writer->save('./reports/'.$filename);
        exit();
    }

    public function get_sales_projection_report(){


        $date = date('M d, Y');
        $this->load->library('PHPExcel', NULL, 'excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Sales Projection');
        $data = $this->input->post('data');
        $project = $this->input->post('project');
        $year = $this->input->post('year');
        $data = json_decode($data,true);

        $styleArray = array(
        'font'  => array(
            'bold'  => true,
            'size'  => 12,
        ));

        $styleArray2 = array(
        'font'  => array(
            'size'  => 12,
        ));

        $styleArray3 = array(
        'font'  => array(
            'bold'  => true,
            'size'  => 12,
            'color' => array('rgb' => 'FFFFFF'),
        ));

        $styleArray4 = array(
          'borders' => array(
            'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
            )
          )
        );
        $this->excel->getActiveSheet()->mergeCells('A1:U1');
        $this->excel->getActiveSheet()->getStyle('A1:U1')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getStyle('A1:U1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A1', 'Sales Projection - '.$project.' ('.$year.')');
        $this->excel->getActiveSheet()->getStyle('A2:U2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
        $this->excel->getActiveSheet()->getStyle('A2:U2')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A2:U2')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(30);
        $this->excel->getActiveSheet()->setCellValue('A2', 'Lot ID');
        $this->excel->getActiveSheet()->setCellValue('B2', 'Lot Description');
        $this->excel->getActiveSheet()->setCellValue('C2', 'TCP');
        $this->excel->getActiveSheet()->setCellValue('D2', 'Customer');
        $this->excel->getActiveSheet()->setCellValue('E2', 'Invoiced');
        $this->excel->getActiveSheet()->setCellValue('F2', 'Booked');
        $this->excel->getActiveSheet()->setCellValue('G2', 'Deffered');
        $this->excel->getActiveSheet()->setCellValue('H2', 'Vattable');
        $this->excel->getActiveSheet()->setCellValue('I2', '% Paid');
        $this->excel->getActiveSheet()->setCellValue('J2', 'January');
        $this->excel->getActiveSheet()->setCellValue('K2', 'February');
        $this->excel->getActiveSheet()->setCellValue('L2', 'March');
        $this->excel->getActiveSheet()->setCellValue('M2', 'April');
        $this->excel->getActiveSheet()->setCellValue('N2', 'May');
        $this->excel->getActiveSheet()->setCellValue('O2', 'June');
        $this->excel->getActiveSheet()->setCellValue('P2', 'July');
        $this->excel->getActiveSheet()->setCellValue('Q2', 'August');
        $this->excel->getActiveSheet()->setCellValue('R2', 'September');
        $this->excel->getActiveSheet()->setCellValue('S2', 'October');
        $this->excel->getActiveSheet()->setCellValue('T2', 'November');
        $this->excel->getActiveSheet()->setCellValue('U2', 'December');

        $row = 3;

        foreach($data as $r){
            echo $r['lotid'];
        }
        
        foreach($data as $r){
            $this->excel->getActiveSheet()->fromArray(array($r['lotid'], $r['lotdescription'], number_format($r['tcp'], 2), $r['customer'], $r['invoiced'], $r['booked'], $r['deffered'], $r['vattable'], $r['percent'],number_format($r['jan'], 2), number_format($r['feb'], 2), number_format($r['mar'], 2), number_format($r['apr'], 2), number_format($r['may'], 2), number_format($r['jun'], 2), number_format($r['jul'], 2), number_format($r['aug'], 2), number_format($r['sep'], 2), number_format($r['oct'], 2), number_format($r['nov'], 2), number_format($r['dec'], 2)), null, 'A'.$row);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':U'.$row)->applyFromArray($styleArray2);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':U'.$row)->applyFromArray($styleArray4);
            $row++;
        }
        
        date_default_timezone_set("Asia/Manila");
        $timestamp=date("Y-m-d-His");
        $filename='SalesProjection.xls'; 
 
        $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0');

        ob_end_clean();
        $writer->save('./reports/'.$filename);
        exit();
    }

    public function print_collection_projection(){

        $data = $this->input->post('data');
        $data = json_decode($data,true);
        $project = $this->input->post('project');
        $year = $this->input->post('year');

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

        $pdf->AddPage("L");
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(3);
        $date = date('M Y');
        $pdf->writeHTMLCell(270, '', '', $y, '<h3>Collection Projection - '.$project.' '.$year.'</h3>', 0, 0, 0, true, 'C', true);

        $pdf->Ln(10);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(20, '', '', '', '<b>Lot ID</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(45, '', '', '', '<b>Lot Description</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(35, '', '', '', '<b>TCP</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Customer</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Invoiced</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Booked</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Deffered</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Vattable</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>% Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>January</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>February</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>March</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>April</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>May</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>June</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>July</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>August</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>September</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>October</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>November</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>December</b>', 0, 0, 0, true, 'L', true);

        foreach ($data as $r){
            $pdf->Ln(7);
            $pdf->writeHTMLCell(20, '', '', '', $r['lotid'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(45, '', '', '', $r['lotdescription'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(35, '', '', '', number_format($r['tcp'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['customer'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['invoiced'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['booked'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['deffered'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['vattable'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['percent'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['jan'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['feb'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['mar'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['apr'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['may'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['jun'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['jul'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['aug'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['sep'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['oct'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['nov'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['dec'], 2), 0, 0, 0, true, 'L', true);
        }

        $pdf->Output('C:\xampp\htdocs\irm\reports\CollectionProjection.pdf', 'F');

    }

    public function print_sales_projection(){

        $data = $this->input->post('data');
        $data = json_decode($data,true);
        $project = $this->input->post('project');
        $year = $this->input->post('year');

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

        $pdf->AddPage("L");
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(3);
        $date = date('M Y');
        $pdf->writeHTMLCell(270, '', '', $y, '<h3>Sales Projection - '.$project.' '.$year.'</h3>', 0, 0, 0, true, 'C', true);

        $pdf->Ln(10);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(20, '', '', '', '<b>Lot ID</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(45, '', '', '', '<b>Lot Description</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(35, '', '', '', '<b>TCP</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Customer</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Invoiced</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Booked</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Deffered</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Vattable</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>% Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>January</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>February</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>March</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>April</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>May</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>June</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>July</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>August</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>September</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>October</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>November</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>December</b>', 0, 0, 0, true, 'L', true);

        foreach ($data as $r){
            $pdf->Ln(7);
            $pdf->writeHTMLCell(20, '', '', '', $r['lotid'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(45, '', '', '', $r['lotdescription'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(35, '', '', '', number_format($r['tcp'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['customer'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['invoiced'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['booked'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['deffered'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['vattable'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', $r['percent'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['jan'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['feb'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['mar'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['apr'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['may'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['jun'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['jul'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['aug'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['sep'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['oct'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['nov'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(20, '', '', '', number_format($r['dec'], 2), 0, 0, 0, true, 'L', true);
        }

        $pdf->Output('C:\wamp64\www\irm\reports\SalesProjection.pdf', 'FD');
    }

    public function restructureamortization(){

        $this->data['content'] = 'restructureamortization';
        $this->data['page_title'] = 'Restructure Amortization';
        $this->data['customjs'] = 'restructureamortizationjs';
        $this->data['lots'] = $this->collection->getAllLots();
        $this->data['customers'] = $this->collection->get_customers();
        $this->load->view('default/index', $this->data);

    }

    public function getClientDetails2()
    {
        $contractid = $this->input->post('contractid');
        $datareturn['contract'] = $this->collection->getClientDetailsForPayment($contractid);
        $datareturn['discount'] = $this->collection->getDiscount($contractid);
        $datareturn['amortization'] = $this->collection->getAmortizationDetails2($contractid);
        $datareturn['payment'] = $this->collection->getPayments($contractid);
        echo json_encode($datareturn);
    }

    public function print_restructured()
    {

        $data = $this->input->post('data');
        $data = json_decode($data,true);

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

        ob_clean();
        
        $contract_date  = $this->input->post('contractdate');
        $cust_name      = $this->input->post('customer');
        $dp_scheme      = $this->input->post('dp');
        $bal_scheme     = $this->input->post('baldesc');
        $lot_desc       = $this->input->post('lotdesc');
        $sqm            = $this->input->post('area');
        $price_sqm      = $this->input->post('price');
        $lot_price      = $this->input->post('lotprice');
        $house          = $this->input->post('houseprice');
        $tcp_amount     = $this->input->post('tcp');
        $added_vat      = $this->input->post('lotvat');

 
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

        $pdf->writeHTMLCell(40, '', '', '', '<b>Lot: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', $lot_price, 0, 0, 0, true, 'R', true);

        $pdf->Ln(5);
        $pdf->writeHTMLCell(30, '',  '', '', '<b>Scheme/Terms: </b>', 0, 0, 0, true, 'L', true);
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
        $pdf->writeHTMLCell(30, '', '', '', $contract_date, 0, 0, 0, true, 'R', true);

        //Amort Schedule Infos
        $pdf->SetFont ('helvetica', '', 9 , 15, 'default', true );

        $pdf->Ln(8);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);
        $pdf->Ln(5);
        $pdf->writeHTMLCell(10, '', 15, '', '<b>No.</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', 30, '', '<b>Date</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', 50, '', '<b>Amortization</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 70, '', '<b>Interest</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 90, '', '<b>Principal</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 110, '', '<b>IPS Amort</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 130, '', '<b>IPS Interest</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 150, '', '<b>IPS Accrued</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 170, '', '<b>Balance</b>', 0, 0, 0, true, 'R', true);
        // $pdf->writeHTMLCell(20, '', '', '', '<b>Plan Type: </b>', 0, 0, 0, true, 'L', true);
        $pdf->Ln(1);
        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);

        $total_amort = 0; 
        $total_int = 0; 
        $total_princ = 0;
        $total_ips = 0;

        foreach ($data as $r){
            $pdf->Ln(5);
            $pdf->writeHTMLCell(20, '', 15, '', $r['desc'], 0, 0, 1, true, 'L', true);
            $pdf->writeHTMLCell(30, '', 30, '', $r['duedate'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(25, '', 50, '', number_format($r['amort'], 2), 0, 0, 0, true, 'R', true);
            $pdf->writeHTMLCell(25, '', 70, '', number_format($r['interest'], 2), 0, 0, 0, true, 'R', true);
            $pdf->writeHTMLCell(25, '', 90, '', number_format($r['principal'], 2), 0, 0, 0, true, 'R', true);
            $pdf->writeHTMLCell(25, '', 110, '', number_format($r['ips_amort'], 2), 0, 0, 0, true, 'R', true);
            $pdf->writeHTMLCell(25, '', 130, '', number_format($r['ips_interest'], 2), 0, 0, 0, true, 'R', true);
            $pdf->writeHTMLCell(25, '', 150, '', number_format($r['ips_accrued'], 2), 0, 0, 0, true, 'R', true);
            $pdf->writeHTMLCell(25, '', 170, '', number_format($r['runbal'], 2), 0, 0, 0, true, 'R', true);
            $amort = (int) $r['amort'];
            $interest = (int) $r['interest'];
            $principal = (int) $r['principal'];
            $ipsamort = (int) $r['ips_amort'];
            $ipsint = (int) $r['ips_interest'];
            $ipsacc = (int) $r['ips_accrued'];
            $total_amort += $amort;
            $total_int   += $interest;
            $total_princ += $principal;
            $total_ips_amort += $ipsamort;
            $total_ips_int += $ipsint;
            $total_ips_acc += $ipsacc;
            $top_margin = PDF_MARGIN_HEADER;
            if ($pdf->getY() > (240 /*height*/ - $top_margin + 30 /*another magic constant*/)) {
                $pdf->addPage();
            }
        }

        $pdf->Ln(4);

        $pdf->writeHTMLCell(200, '', '', '', '____________________________________________________________________________________________________', 0, 0, 0, true, 'L', true);
        $pdf->Ln(4);
        $pdf->writeHTMLCell(10, '', 15, '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', 30, '', '<b>TOTALS: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', 50, '', '<b>'.number_format($total_amort, 2).'</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 70, '', '<b>'.number_format($total_int, 2).'</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 90, '', '<b>'.number_format($total_princ, 2).'</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 110, '', '<b>'.number_format($total_ips_amort, 2).'</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 130, '', '<b>'.number_format($total_ips_int, 2).'</b>', 0, 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(25, '', 150, '', '<b>'.number_format($total_ips_acc, 2).'</b>', 0, 0, 0, true, 'R', true);
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
            


        $pdf->Output('C:\xampp\htdocs\irm\reports\RestructuredAmortization.pdf', 'F');
    }

    public function save_restructured_contract()
    {
        $data = $this->input->post('data');
        $data = json_decode($data,true);
        $contract_id = $this->input->post('contractid');
        $balance_ratio = $this->input->post('balanceratio');
        $balance_term = $this->input->post('newterm');
        $balance_interest_rate = $this->input->post('interestrate');
        $balance_surcharge_rate = $this->input->post('surchargerate');
        $restruction_date = $this->input->post('restructiondate');
        $principal_balance = $this->input->post('principalbalance');
        $newamort_date = $this->input->post('newamortdate');
        $dp_ratio = $this->input->post('dp_ratio');
        $dp_terms = $this->input->post('dp_terms');
        $dp_interest_rate = $this->input->post('dp_interest_rate');
        $dp_discount_rate = $this->input->post('dp_discount_rate');
        $dp_discount = $this->input->post('dp_discount');
        $dp_surcharge_rate = $this->input->post('dp_surcharge_rate');
        $user_id = $this->input->post('user_id');
        
        $this->collection->updateContractReconstructed($contract_id,$balance_ratio,$balance_term,$balance_interest_rate,
            $balance_surcharge_rate,$restruction_date,$principal_balance);

        $restruct_number = $this->collection->getLastReconstructed($contract_id);
        $restruct_number2 = (int) $restruct_number->is_reconstruct;
        $restruct_number_now = 0;
        $restruct_number_now = $restruct_number2 + 1;
        // foreach($restruct_number as $r){
        //     $restruct_number_now = 1 + (int) $r['is_reconstruct'];
        // }
        //make old amort sched inactive
        $this->collection->updateAmortizationReconstructed($contract_id);

        $contractScheme = array(
            'contract_id' => $contract_id,
            'history_date' => $restruction_date,
            'downpayment_ratio' => $dp_ratio,
            'downpayment_terms' => $dp_terms,
            'downpayment_interest_rate' => $dp_interest_rate,
            'downpayment_discount_rate' => $dp_discount_rate,
            'downpayment_discount' => $dp_discount,
            'downpayment_surcharge_rate' => $dp_surcharge_rate,
            'balance_ratio' => $balance_ratio,
            'balance_terms' => $balance_term,
            'balance_interest_rate' => $balance_interest_rate,
            'balance_surcharge_rate' => $balance_surcharge_rate,
            );

        $this->collection->saveContractScheme($contractScheme);

        $terms = (int) $balance_term;
        $x = 1;
        foreach ($data as $r){
            
            if($r['desc']=='20% Payable'){
                $line = 5;
            } else {
                $line = 4;
            }
            $amortReconstructed = array(
                'contract_id' => $contract_id,
                'line_type' => $line,
                'line_description' => $r['desc'],
                'due_date' => $r['duedate'],
                'amortization_amount' => $r['amort'],
                'interest_amount' => $r['interest'],
                'principal_amount' => $r['principal'],
                'outstanding_balance' => $r['runbal'],
                'ips_amortization' => $r['ips_amort'],
                'ips_interest' => $r['ips_interest'],
                'ips_accrued' => $r['ips_accrued'],
                'ips_balance' => $r['ipsbal'],
                'paid_up' => 0,
                'is_active' => 1,
                'is_reconstruct' => $restruct_number_now,
                'cashier_id' => $user_id,
                'line_order' => $x,
                );
            $this->collection->insertReconstructedAmortization($amortReconstructed);
            $x++;
        }
    }

    public function savePaymentCashPrincipalOnly()
    {
        $amortizationid = $this->input->post('amortization_id');
        $principal = $this->input->post('principal_paid');
        $contract_id = $this->input->post('contract_id');
        $pay_date = $this->input->post('payment_date');

        $or_code = $this->collection->get_or_code($contract_id);

        $this->collection->updateAmortizationLine2($amortizationid,$principal,$pay_date);

        $payment = array(
            'contract_id' => $this->input->post('contract_id'),
            'payment_type' => $this->input->post('payment_type'),
            'pay_reference' => $or_code,
            'pay_date' => $this->input->post('payment_date'),
            'amount' => $this->input->post('amount'),
            'principal' => $this->input->post('principal'),
            'cashier_id' => $this->input->post('cashier_id'),
            );

        $this->collection->insertPayment($payment);

        $lineorder = $this->collection->getLineOrder($amortizationid);

        $datareturn['unpaid'] = $this->collection->getCountAmortLeft($lineorder->line_order,$contract_id);

        $datareturn['lineorder'] = $this->collection->getAmortLeft($lineorder->line_order,$contract_id);
        $datareturn['success'] = 'GOOD!';
        echo json_encode($datareturn);

    }

    public function savePaymentCheckPrincipalOnly()
    {
        $amortizationid = $this->input->post('amortization_id');
        $principal = $this->input->post('principal_paid');
        $contract_id = $this->input->post('contract_id');

        $or_code = $this->collection->get_or_code($contract_id);


        $this->collection->updateAmortizationLine2($amortizationid,$principal, $this->input->post('payment_date'));

        $payment = array(
            'contract_id' => $this->input->post('contract_id'),
            'payment_type' => $this->input->post('payment_type'),
            'pay_reference' => $or_code,
            'pay_date' => $this->input->post('payment_date'),
            'amount' => $this->input->post('amount'),
            'principal' => $this->input->post('principal'),
            'cashier_id' => $this->input->post('cashier_id'),
            );

        $datareturn2 = $this->collection->insertPayment($payment);

        $checkPayment = array(
            'payment_id' => $datareturn2,
            'amount' => $this->input->post('amount'),
            'check_number' => $this->input->post('check_number'),
            'check_date' => $this->input->post('check_date'),
            'to_bank_id' => $this->input->post('bank_id'),
            );

        $this->collection->insertPaymentCheck($checkPayment);

        $lineorder = $this->collection->getLineOrder($amortizationid);

        $datareturn['unpaid'] = $this->collection->getCountAmortLeft($lineorder->line_order,$contract_id);

        $datareturn['lineorder'] = $this->collection->getAmortLeft($lineorder->line_order,$contract_id);

        echo json_encode($datareturn);

    }

    public function savePaymentCashAndCheckPrincipalOnly()
    {
        $amortizationid = $this->input->post('amortization_id');
        $principal = $this->input->post('principal_paid');
        $contract_id = $this->input->post('contract_id');

        $or_code = $this->collection->get_or_code($contract_id);

        $this->collection->updateAmortizationLine2($amortizationid,$principal,$this->input->post('payment_date'));

        $payment = array(
            'contract_id' => $this->input->post('contract_id'),
            'payment_type' => $this->input->post('payment_type'),
            'pay_reference' => $or_code,
            'pay_date' => $this->input->post('payment_date'),
            'amount' => $this->input->post('amount'),
            'principal' => $this->input->post('principal'),
            'cashier_id' => $this->input->post('cashier_id'),
            );

        $datareturn2 = $this->collection->insertPayment($payment);

        $checkPayment = array(
            'payment_id' => $datareturn2,
            'amount' => $this->input->post('amount'),
            'check_number' => $this->input->post('check_number'),
            'check_date' => $this->input->post('check_date'),
            'bank_id' => $this->input->post('bank_id'),
            );

        $this->collection->insertPaymentCheck($checkPayment);

        $lineorder = $this->collection->getLineOrder($amortizationid);

        $datareturn['unpaid'] = $this->collection->getCountAmortLeft($lineorder->line_order,$contract_id);

        $datareturn['lineorder'] = $this->collection->getAmortLeft($lineorder->line_order,$contract_id);

        echo json_encode($datareturn);

    }

    public function savePaymentInterbranchPrincipalOnly()
    {
        $amortizationid = $this->input->post('amortization_id');
        $principal = $this->input->post('principal_paid');
        $contract_id = $this->input->post('contract_id');

        $or_code = $this->collection->get_or_code($contract_id);

        $this->collection->updateAmortizationLine2($amortizationid,$principal, $this->input->post('payment_date'));

        $payment = array(
            'contract_id' => $this->input->post('contract_id'),
            'payment_type' => $this->input->post('payment_type'),
            'pay_reference' => $or_code,
            'pay_date' => $this->input->post('payment_date'),
            'amount' => $this->input->post('amount'),
            'principal' => $this->input->post('principal'),
            'cashier_id' => $this->input->post('cashier_id'),
            );

        $datareturn2 = $this->collection->insertPayment($payment);

        $interbranchPayment = array(
            'payment_id' => $datareturn2,
            'amount' => $this->input->post('amount'),
            'account_number' => $this->input->post('account_number'),
            'deposit_date' => $this->input->post('deposit_date'),
            'bank_id' => $this->input->post('bank_id'),
            );

        $this->collection->insertPaymentInterBranch($interbranchPayment);

        $lineorder = $this->collection->getLineOrder($amortizationid);

        $datareturn['unpaid'] = $this->collection->getCountAmortLeft($lineorder->line_order,$contract_id);

        $datareturn['lineorder'] = $this->collection->getAmortLeft($lineorder->line_order,$contract_id);

        echo json_encode($datareturn);

    }

    public function updateAmortizationPrincipalOnlyPayment()
    {
        $amortization_amount = $this->input->post('amortization_amount');
        $principal_amount = $this->input->post('principal_amount');
        $amortization_id = $this->input->post('amortization_id');
        $outstanding_balance = $this->input->post('outstanding_balance');

        $this->collection->updateAmortizationLine3($amortization_amount,$principal_amount,$amortization_id,$outstanding_balance);
    }

    public function sundry()
    {
        $this->data['content'] = 'sundry';
        $this->data['page_title'] = 'Sundry';
        $this->data['customjs'] = 'sundryjs';
        $this->data['customers'] = $this->collection->get_customers2();
        $this->data['organizations'] = $this->collection->get_organizations();
        $this->data['suppliers'] = $this->collection->get_suppliers();
        $this->data['employees'] = $this->collection->get_employees();
        $this->data['accounts'] = $this->collection->get_accounts();
        $this->data['paymentType'] = $this->collection->getPaymentTypes();
        $this->data['allbanks'] = $this->collection->getAllBanks();
        $this->data['allbanks2'] = $this->collection->getAllBanks();
        $this->data['books1'] = $this->collection->get_books();
        $this->data['books2'] = $this->collection->get_books();
        $this->load->view('default/index', $this->data);
    }

    public function get_account_code_description()
    {
        $account_code = $this->input->post('account_code');
        $datareturn = $this->collection->getAccountCodeDescription($account_code);
        echo json_encode($datareturn);
    }

    public function pay_sundry()
    {
        $cashamount = $this->input->post('cashamount');
        $checkamount = $this->input->post('checkamount');
        $depositamount = $this->input->post('depositamount');
        $amount = $cashamount + $checkamount + $depositamount;

        $vatableamount = $this->input->post('vatableamount');
        $vat = $this->input->post('vat');
        $netamountreceived = $vatableamount + $vat;

        $payment = array(
            'pay_reference' => $this->input->post('paymenttype'),
            'pay_date' => $this->input->post('paymentdate'),
            'amount' => $amount,
            'sundry' => $amount,
            'cashier_id' => $this->input->post('cashier_id'),
            );

        $datareturn2 = $this->collection->insertPayment($payment);

        $check_exist = $this->input->post('checknumber');

        if ($check_exist){

            $checkPayment = array(
            'payment_id' => $datareturn2,
            'amount' => $this->input->post('checkamount'),
            'check_number' => $this->input->post('checknumber'),
            'check_date' => $this->input->post('checkdate'),
            'bank_id' => $this->input->post('bankid'),
            );

            $this->collection->insertPaymentCheck($checkPayment);
        }

        $bank_exist = $this->input->post('depositdate');

        if ($bank_exist){
            $interbranchPayment = array(
            'payment_id' => $datareturn2,
            'amount' => $this->input->post('depositamount'),
            'account_number' => $this->input->post('accountnumber'),
            'deposit_date' => $this->input->post('depositdate'),
            'bank_id' => $this->input->post('bankid'),
            );

            $this->collection->insertPaymentInterBranch($interbranchPayment);
        }
        $book_code = $this->input->post('book_code_top');
        $reference_no = $this->reference_no;
        $transaction = array (
            'book_code' => $book_code,
            'book_prefix' => $this->input->post('book_prefix_top'),
            'reference' => $reference_no,
            'subsidiary_code' => $this->input->post('subcode'),
            'subsidiary_table' => $this->input->post('subtype'),
            'subsidiary_name' => $this->input->post('customername'),
            'encode_by' => $this->input->post('cashier_id'),
            );
        $transaction_id = $this->collection->insertTransaction($transaction);

        $data = $this->input->post('data');
        $data = json_decode($data,true);
        $subsidiary_code = $this->input->post('subcode');

        foreach ($data as $r){
            $date = date('Y-m-d');
            $book_code1 = $r['customer'];
            $transaction_detail = array (
                'transaction_id' => $transaction_id,
                'book_code' => $r['book_code'],
                'prefix' => $r['book_prefix'],
                'reference' => $reference_no,
                'account_code' => $r['account_code'],
                'post_date' => $date,
                'debit' => $r['debit'],
                'credit' => $r['credit'],
                'subsidiary_code' => $subsidiary_code,
                );
            $this->collection->insertTransactionDetails($transaction_detail);
        }

        $this->load->library('Pdf');
        //get user
        $user_id = $this->input->post('user_id');
        date_default_timezone_set("Asia/Manila");
        $date = date('Y-m-d');

        $pdf = new Pdf('L', 'in', 'MEMO', true, 'UTF-8', false);
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

        $pdf->AddPage();
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        

        $pdf->writeHTMLCell(180, '', '', '', '<h4>OFFICIAL RECEIPT</h4>', 0, 0, 0, true, 'C', true);
        $pdf->SetFont ('helvetica', '', 10 , 15, 'default', true );

        $pdf->Ln(6);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Customer Name: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', $this->input->post('customername'), 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Date: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $date, 0, 0, 0, true, 'L', true);

        $pdf->Ln(5);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Customer Address: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', '', 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>TIN: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', '', 0, 0, 0, true, 'L', true);

        $pdf->Ln(10);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Lot Description: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', '', 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Amount: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', sprintf("%.2f",$amount), 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);

        $pdf->writeHTMLCell(86, '', '', '', '<b>OR DETAILS</b>', 'LTBR', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(86, '', '', '', '<b>AMORT PAYMENT DETAILS</b>', 'LTBR', 0, 0, true, 'C', true);

        $pdf->Ln(5);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(43, '', '', '', '<b>Vatable Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', sprintf("%.2f",$vatableamount), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Surcharge</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '0', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Vat Exempt Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '0', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>IP & S</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '0', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Vat Zero Rated Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '0', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Interest</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '0', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Principal</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '0', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Total Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', sprintf("%.2f",$vatableamount), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>add VAT</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', sprintf("%.2f",$vat), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Net Amount Received</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>'.sprintf("%.2f",$netamountreceived).'</b>', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Total Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>0</b>', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(6);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Authenticated by</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Payment Type</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Bank</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Check No.</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Check Date</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Amount</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Remarks</b>', 'LTB', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(12, '', '', '', '', 'TRB', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '', 'LR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Cash</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', number_format($cashamount, 2), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'L', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'R', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '', 'LR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Check</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $this->input->post('bankname'), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $this->input->post('checknumber'), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $this->input->post('checkdate'), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', number_format($checkamount, 2), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'L', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'R', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '', 'LRB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Bank Deposit</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $this->input->post('bankname'), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', number_format($depositamount, 2), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'L', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'R', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Cashier/Date</b>', 'LBT', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Credit Card</b>', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'LB', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'BR', 0, 0, true, 'L', true);

        $pdf->Ln(5);

        $pdf->writeHTMLCell(180, '', '', '', '<i>This receipt, if fully authenticated by our cashier is our official confirmation of your payment made on or Provisional Receipt. Check payment will not be credited upon proper clearance from bank. Thank you.</i>', 0, 0, 0, true, 'L', true);



        $pdf->Output('C:\xampp\htdocs\irm\reports\SundryReceipt.pdf', 'F');

    }
    public function get_book_code_prefix()
    {
        $bookcode = $this->input->post('book_code');
        $datareturn = $this->collection->getBookCodePrefix($bookcode);
        echo json_encode($datareturn);
    }
    public function get_customer_desc()
    {
        $clientid = $this->input->post('clientid');
        $datareturn = $this->collection->getCustomerDetails($clientid);
        echo json_encode($datareturn);
    }
    public function get_org_desc()
    {
        $orgid = $this->input->post('orgid');
        $datareturn = $this->collection->getOrganizationDetails($orgid);
        echo json_encode($datareturn);
    }
    public function get_supp_desc()
    {
        $suppid = $this->input->post('suppid');
        $datareturn = $this->collection->getSupplierDetails($suppid);
        echo json_encode($datareturn);
    }
    public function get_emp_desc()
    {
        $empid = $this->input->post('empid');
        $datareturn = $this->collection->getEmployeeDetails($empid);
        echo json_encode($datareturn);
    }
    public function nonvat()
    {
        $this->data['content'] = 'nonvat';
        $this->data['page_title'] = 'Non Vat';
        $this->data['customjs'] = 'nonvatjs';
        $this->data['customers'] = $this->collection->get_customers2();
        $this->data['organizations'] = $this->collection->get_organizations();
        $this->data['suppliers'] = $this->collection->get_suppliers();
        $this->data['employees'] = $this->collection->get_employees();
        $this->data['accounts'] = $this->collection->get_accounts();
        $this->data['paymentType'] = $this->collection->getPaymentTypes();
        $this->data['allbanks'] = $this->collection->getAllBanks();
        $this->data['allbanks2'] = $this->collection->getAllBanks();
        $this->data['books1'] = $this->collection->get_books();
        $this->data['books2'] = $this->collection->get_books();
        $this->load->view('default/index', $this->data);
    }
    public function dailycollection()
    {
        $this->data['content'] = 'dailycollection';
        $this->data['page_title'] = 'Daily Collection';
        $this->data['customjs'] = 'dailycollectionjs';
        $this->data['projects'] = $this->collection->getProjects();
        $this->load->view('default/index', $this->data);
    }
    public function get_daily_collection_per_project()
    {
        $projectid = $this->input->post('projectid');
        $datareturn = $this->collection->getDailyCollectionPerProject($projectid);
        echo json_encode($datareturn);
    }
    public function get_daily_collection_per_vat()
    {
        $vatid = $this->input->post('vatid');
        $datareturn = $this->collection->getDailyCollectionPerVatType($vatid);
        echo json_encode($datareturn);
    }
    public function monthlycollection()
    {
        $this->data['content'] = 'monthlycollection';
        $this->data['page_title'] = 'Monthly Collection';
        $this->data['customjs'] = 'monthlycollectionjs';
        $this->data['projects'] = $this->collection->getProjects();
        $this->load->view('default/index', $this->data);
    }
    public function get_monthly_collection_per_project()
    {
        $projectid = $this->input->post('projectid');
        $datareturn = $this->collection->getMonthlyCollectionPerProject($projectid);
        echo json_encode($datareturn);
    }
    public function get_monthly_collection_per_vat()
    {
        $vatid = $this->input->post('vatid');
        $datareturn = $this->collection->getMonthlyCollectionPerVatType($vatid);
        echo json_encode($datareturn);
    }
    public function print_daily_collection()
    {
        $data = $this->input->post('data');
        $data = json_decode($data,true);
        $title = $this->input->post('title');
        $date = date('M d, Y');

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

        $pdf->AddPage("L");
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(3);
        $date = date('M Y');
        $pdf->writeHTMLCell(270, '', '', $y, '<h3>Daily Collection - '.$title.' '.$date.'</h3>', 0, 0, 0, true, 'C', true);

        $pdf->Ln(10);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(50, '', '', '', '<b>Customer</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Payment Type</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Source Bank</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Destination Bank</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Amount Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Principal Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Interest Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Surcharge Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>IP & S Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Sundry Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->Ln(3);
        foreach ($data as $r){
            $pdf->Ln(7);
            $pdf->writeHTMLCell(50, '', '', '', $r['customer'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', $r['paymenttype'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', $r['fromBank'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', $r['toBank'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['amount'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['principal'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['interest'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['surcharge'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['ips'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['sundry'], 2), 0, 0, 0, true, 'L', true);
        }

        $pdf->Output('C:\wamp64\www\irm\reports\DailyCollection.pdf', 'F');
    }
    public function print_monthly_collection()
    {
        // if (file_exists('C:\wamp64\www\irm\reports\MonthlyCollection.pdf')) unlink('MonthlyCollection.pdf');
        $data = $this->input->post('data');
        $data = json_decode($data,true);
        $title = $this->input->post('title');
        $date = date('M Y');

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

        $pdf->AddPage("L");
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln(3);
        $date = date('M Y');
        $pdf->writeHTMLCell(270, '', '', $y, '<h3>Monthly Collection - '.$title.' '.$date.'</h3>', 0, 0, 0, true, 'C', true);

        $pdf->Ln(10);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(50, '', '', '', '<b>Customer</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Payment Type</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Source Bank</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Destination Bank</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Amount Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Principal Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Interest Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Surcharge Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>IP & S Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Sundrys Paid</b>', 0, 0, 0, true, 'L', true);
        $pdf->Ln(3);
        foreach ($data as $r){
            $pdf->Ln(7);
            $pdf->writeHTMLCell(50, '', '', '', $r['customer'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', $r['paymenttype'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', $r['fromBank'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', $r['toBank'], 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['amount'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['principal'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['interest'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['surcharge'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['ips'], 2), 0, 0, 0, true, 'L', true);
            $pdf->writeHTMLCell(30, '', '', '', number_format($r['sundry'], 2), 0, 0, 0, true, 'L', true);
            if ($pdf->getY() > (150 /*height*/ - $top_margin + 27 /*another magic constant*/)) {
                $pdf->addPage('L');
            }
        }
        // echo json_encode($pdf->Output('C:\wamp64\www\irm\reports\MonthlyCollection.pdf', 'F'));
        $pdf->Output('C:\wamp64\www\irm\reports\MonthlyCollection.pdf', 'F');
    }

    public function get_daily_collection_report()
    {
        $date = date('M d, Y');
        $this->load->library('PHPExcel', NULL, 'excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Sales Projection');
        $data = $this->input->post('data');
        $title = $this->input->post('title');
        $data = json_decode($data,true);

        $styleArray = array(
        'font'  => array(
            'bold'  => true,
            'size'  => 12,
        ));

        $styleArray2 = array(
        'font'  => array(
            'size'  => 12,
        ));

        $styleArray3 = array(
        'font'  => array(
            'bold'  => true,
            'size'  => 12,
            'color' => array('rgb' => 'FFFFFF'),
        ));

        $styleArray4 = array(
          'borders' => array(
            'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
            )
          )
        );
        $this->excel->getActiveSheet()->mergeCells('A1:J1');
        $this->excel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A1', 'Daily Collection - '.$title.' ('.$date.')');
        $this->excel->getActiveSheet()->getStyle('A2:J2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
        $this->excel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $this->excel->getActiveSheet()->setCellValue('A2', 'Customer');
        $this->excel->getActiveSheet()->setCellValue('B2', 'Payment Type');
        $this->excel->getActiveSheet()->setCellValue('C2', 'Source Bank');
        $this->excel->getActiveSheet()->setCellValue('D2', 'Destination Bank');
        $this->excel->getActiveSheet()->setCellValue('E2', 'Amount Paid');
        $this->excel->getActiveSheet()->setCellValue('F2', 'Principal Paid');
        $this->excel->getActiveSheet()->setCellValue('G2', 'Interest Paid');
        $this->excel->getActiveSheet()->setCellValue('H2', 'Surcharge Paid');
        $this->excel->getActiveSheet()->setCellValue('I2', 'IP & S Paid');
        $this->excel->getActiveSheet()->setCellValue('J2', 'Sundry Paid');

        $row = 3;
        
        foreach($data as $r){
            $this->excel->getActiveSheet()->fromArray(array($r['customer'], $r['paymenttype'], $r['fromBank'], $r['toBank'], number_format($r['amount'], 2), number_format($r['principal'], 2), number_format($r['interest'], 2), number_format($r['surcharge'], 2), number_format($r['ips'], 2), number_format($r['sundry'], 2)), null, 'A'.$row);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':J'.$row)->applyFromArray($styleArray2);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':J'.$row)->applyFromArray($styleArray4);
            $row++;
        }
        
        date_default_timezone_set("Asia/Manila");
        $timestamp=date("Y-m-d-His");
        $filename='DailyCollection.xls'; 
 
        $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0');

        ob_end_clean();
        $writer->save('./reports/'.$filename);
        exit();
    }

    public function get_monthly_collection_report()
    {
        $date = date('M Y');
        $this->load->library('PHPExcel', NULL, 'excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Sales Projection');
        $data = $this->input->post('data');
        $title = $this->input->post('title');
        $data = json_decode($data,true);

        $styleArray = array(
        'font'  => array(
            'bold'  => true,
            'size'  => 12,
        ));

        $styleArray2 = array(
        'font'  => array(
            'size'  => 12,
        ));

        $styleArray3 = array(
        'font'  => array(
            'bold'  => true,
            'size'  => 12,
            'color' => array('rgb' => 'FFFFFF'),
        ));

        $styleArray4 = array(
          'borders' => array(
            'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
            )
          )
        );
        $this->excel->getActiveSheet()->mergeCells('A1:J1');
        $this->excel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A1', 'Monthly Collection - '.$title.' ('.$date.')');
        $this->excel->getActiveSheet()->getStyle('A2:J2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
        $this->excel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($styleArray4);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $this->excel->getActiveSheet()->setCellValue('A2', 'Customer');
        $this->excel->getActiveSheet()->setCellValue('B2', 'Payment Type');
        $this->excel->getActiveSheet()->setCellValue('C2', 'Source Bank');
        $this->excel->getActiveSheet()->setCellValue('D2', 'Destination Bank');
        $this->excel->getActiveSheet()->setCellValue('E2', 'Amount Paid');
        $this->excel->getActiveSheet()->setCellValue('F2', 'Principal Paid');
        $this->excel->getActiveSheet()->setCellValue('G2', 'Interest Paid');
        $this->excel->getActiveSheet()->setCellValue('H2', 'Surcharge Paid');
        $this->excel->getActiveSheet()->setCellValue('I2', 'IP & S Paid');
        $this->excel->getActiveSheet()->setCellValue('J2', 'Sundry Paid');

        $row = 3;
        
        foreach($data as $r){
            $this->excel->getActiveSheet()->fromArray(array($r['customer'], $r['paymenttype'], $r['fromBank'], $r['toBank'], number_format($r['amount'], 2), number_format($r['principal'], 2), number_format($r['interest'], 2), number_format($r['surcharge'], 2), number_format($r['ips'], 2), number_format($r['sundry'], 2)), null, 'A'.$row);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':J'.$row)->applyFromArray($styleArray2);
            $this->excel->getActiveSheet()->getStyle('A'.$row.':J'.$row)->applyFromArray($styleArray4);
            $row++;
        }
        
        date_default_timezone_set("Asia/Manila");
        $timestamp=date("Y-m-d-His");
        $filename='MonthlyCollection.xls'; 
 
        $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0');

        ob_end_clean();
        $writer->save('./reports/'.$filename);
        exit();
    }

    public function banks(){
        $this->data['content'] = 'banks';
        $this->data['page_title'] = 'Marketing';
        $this->data['page_title'] = 'Banks';
        $this->data['customjs'] = 'banksjs';
        $this->data['banks'] = $this->collection->getBanks();
        $this->data['allcity'] = $this->collection->getAllCity();
        $this->data['addtype'] = $this->collection->getAddressType();
        $this->data['addcountry'] = $this->collection->getAllCountry();
        $this->data['allprovince'] = $this->collection->getAllProvince();
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
        $lastPersonID = $this->collection->insertPersonBank($person);
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
        $this->collection->insertAddressBankContactPerson($personAddress,$lastPersonID);
        //bank contact person contact information
        $contact = array(
            'person_id' => $lastPersonID,
            'contact_type_id' => $this->input->post('person_contact_type'),
            'contact_value' => $this->input->post('person_contact'),
            'status' => 1,
            );
        $bankContactId = $this->collection->insertContactsBank($contact);
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
        $bankAddressId = $this->collection->insertAddressBank($bankAddress);
        //bank information
        $bank = array(
            'bank_name' => $this->input->post('bank_name'),
            'account_number' => $this->input->post('account_number'),
            'person_id' => $lastPersonID,
            'address_id' => $bankAddressId,
            'contact_id' => $bankContactId,
            'status_id' => 1,
            );
        $this->collection->insertBank($bank);
    }
    public function retrieveOnBank(){
        $bankid = $this->input->post('bankid');
        $personid = $this->input->post('personid');
        $addressid = $this->input->post('addressid');
        $datareturn['bank'] = $this->colletion->getOneBank($bankid,$addressid);
        $datareturn['person'] = $this->collection->getOneBankPerson($personid);
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
        $this->collection->updatePersonBank($person,$personID);
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
        $this->collection->updateAddressBankContactPerson($personAddress,$personAddressID);
        //bank contact person contact information
        $contact = array(
            'person_id' => $personID,
            'contact_type_id' => $this->input->post('person_contact_type'),
            'contact_value' => $this->input->post('person_contact'),
            'status' => 1,
            );
        $this->collection->updateContactsBank($contact,$contactID);
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
        $this->collection->updateAddressBank($bankAddress,$bankAddressID);
        //bank information
        $bank = array(
            'bank_name' => $this->input->post('bank_name'),
            'account_number' => $this->input->post('account_number'),
            'person_id' => $personID,
            'address_id' => $bankAddressID,
            'contact_id' => $contactID,
            'status_id' => 1,
            );
        $this->collection->updateBank($bank,$bankID);
    }
    public function commissionschemes()
    {
        $this->data['content'] = 'commissionschemes';
        $this->data['page_title'] = 'Commission Schemes';
        $this->data['customjs'] = 'commissionschemesjs';
        $this->data['commission'] = $this->collection->getCommissions();
        $this->data['commission_type'] = $this->collection->getCommissionsType();
        $this->data['commission_type2'] = $this->collection->getCommissionsType();
        $this->load->view('default/index', $this->data);  
    }
    public function saveCommission()
    {
        $commission = array (
            'commission_name' => $this->input->post('commission_name'),
            'commission_type' => $this->input->post('commission_type'),
            'percent_commission' => $this->input->post('percent_commission'),
            'percent_tcp_paid' => $this->input->post('percent_tcp_paid'),
            );
        $this->collection->insertCommissionScheme($commission);
    }
    public function retrieveOnCommissionScheme()
    {
        $datareturn = $this->collection->getOneCommissionScheme($this->input->post('commissionid'));
        echo json_encode($datareturn);
    }
    public function modifyCommission()
    {
        $commission_id = $this->input->post('commission_id');
        $commission = array (
            'commission_name' => $this->input->post('commission_name'),
            'commission_type' => $this->input->post('commission_type'),
            'percent_commission' => $this->input->post('percent_commission'),
            'percent_tcp_paid' => $this->input->post('percent_tcp_paid'),
            );
        $this->collection->updateCommission($commission_id,$commission);
    }
    public function incentiveschemes(){
        $this->data['content'] = 'incentiveschemes';
        $this->data['page_title'] = 'Incentive Schemes';
        $this->data['customjs'] = 'incentiveschemesjs';
        $this->data['incentives'] = $this->collection->getIncentives();
        $this->data['payment_schemes'] = $this->collection->getPaymentScheme();
        $this->data['projects'] = $this->collection->getProjects();
        $this->data['payment_schemes2'] = $this->collection->getPaymentScheme();
        $this->data['projects2'] = $this->collection->getProjects();
        $this->load->view('default/index', $this->data);  
    }
    public function saveIncentive(){
        $incentive = array (
            'project_id' => $this->input->post('project_id'),
            'payment_scheme_id' => $this->input->post('payment_scheme_id'),
            'reservation_bonus' => $this->input->post('reservation_bonus'),
            'scheme_bonus' => $this->input->post('scheme_bonus'),
            );
        $this->collection->insertIncentiveScheme($incentive);
    }
    public function retrieveOnIncentiveScheme(){
        $datareturn = $this->collection->getOneIncentiveScheme($this->input->post('incentiveid'));
        echo json_encode($datareturn);
    }
    public function modifyIncentive()
    {
        $incentiveId = $this->input->post('incentive_id');
        $incentiveScheme = array (
            'project_id' => $this->input->post('project_id'),
            'payment_scheme_id' => $this->input->post('payment_scheme_id'),
            'reservation_bonus' => $this->input->post('reservation_bonus'),
            'scheme_bonus' => $this->input->post('scheme_bonus'),
            );
        $this->collection->updateIncentiveScheme($incentiveId, $incentiveScheme);
    }
    public function save_postdated_check_single()
    {

        $postdatedcheck = array (
            'customer_id' => $this->input->post('customerid'),
            'amount' => $this->input->post('checkamount'),
            'check_number' => $this->input->post('checknumber'),
            'check_date' => $this->input->post('checkdate'),
            'from_bank_id' => $this->input->post('sourcebank'),
            'to_bank_id' => $this->input->post('destinationbank'),
            );

        $this->collection->savePostdatedCheck($postdatedcheck);
    }
    public function save_multiple_checks()
    {
        $data = $this->input->post('data');
        $data = json_decode($data,true);

        foreach ($data as $r){
            
            $check = array(
                'customer_id' => $r['customerid'],
                'amount' => $r['checkamount'],
                'check_number' => $r['checknumber'],
                'check_date' => $r['checkdate'],
                'to_bank_id' => $r['destbankid'],
                'from_bank_id' => $r['sourcebank'],
                );
            $this->collection->savePostdatedCheck($check);

        }
    }

    public function sundry_receipt()
    {

        $this->load->library('Pdf');
        //get user
        $user_id = $this->input->post('user_id');
        date_default_timezone_set("Asia/Manila");
        $date = date('Y-m-d');

        $pdf = new Pdf('L', 'in', 'MEMO', true, 'UTF-8', false);
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

        $pdf->AddPage();
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        

        $pdf->writeHTMLCell(180, '', '', '', '<h4>OFFICIAL RECEIPT</h4>', 0, 0, 0, true, 'C', true);
        $pdf->SetFont ('helvetica', '', 10 , 15, 'default', true );

        $pdf->Ln(6);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Customer Name: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', $r_customer_name, 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Date: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $date, 0, 0, 0, true, 'L', true);

        $pdf->Ln(5);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Customer Address: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', $r_customer_address, 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>TIN: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $r_customer_tin, 0, 0, 0, true, 'L', true);

        $pdf->Ln(10);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Lot Description: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', $r_lot_desc, 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Amount: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', number_format($r_total_amount, 2), 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);

        $pdf->writeHTMLCell(86, '', '', '', '<b>OR DETAILS</b>', 'LTBR', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(86, '', '', '', '<b>AMORT PAYMENT DETAILS</b>', 'LTBR', 0, 0, true, 'C', true);

        $pdf->Ln(5);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(43, '', '', '', '<b>Vatable Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_vatable_amount, 2), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Surcharge</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_surcharge_paid, 2), 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Vat Exempt Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_vat_exempt_amount, 2), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>IP & S</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_ips, 2), 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Vat Zero Rated Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_vat_zero_rated_amount, 2), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Interest</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_interest, 2), 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Principal</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_principal, 2), 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Total Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_total_or_details, 2), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>add VAT</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', number_format($r_add_vat, 2), 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '<b>Net Amount Received</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b></b>', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(10, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>Total Amount</b>', 'LB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>'.number_format($r_total_payment_details, 2).'</b>', 'LBR', 0, 0, true, 'L', true);

        $pdf->Ln(6);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Authenticated by</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Payment Type</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Bank</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Check No.</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '<b>Check Date</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Amount</b>', 1, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(30, '', '', '', '<b>Remarks</b>', 'LTB', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(12, '', '', '', '', 'TRB', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '', 'LR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Cash</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', number_format($r_cash_amount, 2), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'L', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'R', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '', 'LR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Check</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $r_check_bank, 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $r_check_number, 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $r_check_date, 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', number_format($r_check_amount, 2), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'L', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'R', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '', 'LRB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Bank Deposit</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', $r_bank_designated, 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', number_format($r_bank_amount, 2), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'L', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'R', 0, 0, true, 'L', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Cashier/Date</b>', 'LBT', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '<b>Credit Card</b>', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(20, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(25, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(5, '', '', '', '', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'LB', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(21, '', '', '', '', 'BR', 0, 0, true, 'L', true);

        $pdf->Ln(5);

        $pdf->writeHTMLCell(180, '', '', '', '<i>This receipt, if fully authenticated by our cashier is our official confirmation of your payment made on or Provisional Receipt. Check payment will not be credited upon proper clearance from bank. Thank you.</i>', 0, 0, 0, true, 'L', true);



        $pdf->Output('C:\xampp\htdocs\irm\reports\SundryReceipt.pdf', 'F');
    }

    public function pay_nvr()
    {
        $cashamount = $this->input->post('cashamount');
        $checkamount = $this->input->post('checkamount');
        $depositamount = $this->input->post('depositamount');
        $amount = $cashamount + $checkamount + $depositamount;

        $payment = array(
            'pay_reference' => $this->input->post('paymenttype'),
            'pay_date' => $this->input->post('paymentdate'),
            'amount' => $amount,
            'sundry' => $amount,
            'cashier_id' => $this->input->post('cashier_id'),
            );

        $datareturn2 = $this->collection->insertPayment($payment);

        $check_exist = $this->input->post('checknumber');

        if ($check_exist){

            $checkPayment = array(
            'payment_id' => $datareturn2,
            'amount' => $this->input->post('checkamount'),
            'check_number' => $this->input->post('checknumber'),
            'check_date' => $this->input->post('checkdate'),
            'bank_id' => $this->input->post('bankid'),
            );

            $this->collection->insertPaymentCheck($checkPayment);
        }

        $bank_exist = $this->input->post('depositdate');

        if ($bank_exist){
            $interbranchPayment = array(
            'payment_id' => $datareturn2,
            'amount' => $this->input->post('depositamount'),
            'account_number' => $this->input->post('accountnumber'),
            'deposit_date' => $this->input->post('depositdate'),
            'bank_id' => $this->input->post('bankid'),
            );

            $this->collection->insertPaymentInterBranch($interbranchPayment);
        }
        $book_code = $this->input->post('book_code_top');
        $reference_no = $this->reference_no;
        $transaction = array (
            'book_code' => $book_code,
            'book_prefix' => $this->input->post('book_prefix_top'),
            'reference' => $reference_no,
            'subsidiary_code' => $this->input->post('subcode'),
            'subsidiary_table' => $this->input->post('subtype'),
            'subsidiary_name' => $this->input->post('customername'),
            'encode_by' => $this->input->post('cashier_id'),
            );
        $transaction_id = $this->collection->insertTransaction($transaction);

        $data = $this->input->post('data');
        $data = json_decode($data,true);
        $subsidiary_code = $this->input->post('subcode');

        foreach ($data as $r){
            $date = date('Y-m-d');
            $book_code1 = $r['customer'];
            $transaction_detail = array (
                'transaction_id' => $transaction_id,
                'book_code' => $r['book_code'],
                'prefix' => $r['book_prefix'],
                'reference' => $reference_no,
                'account_code' => $r['account_code'],
                'post_date' => $date,
                'debit' => $r['debit'],
                'credit' => $r['credit'],
                'subsidiary_code' => $subsidiary_code,
                );
            $this->collection->insertTransactionDetails($transaction_detail);
        }

        $this->load->library('Pdf');
        //get user
        date_default_timezone_set("Asia/Manila");
        $date = date('Y-m-d');

        $pdf = new Pdf('L', 'in', 'MEMO', true, 'UTF-8', false);
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

        $pdf->AddPage();
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        

        $pdf->writeHTMLCell(180, '', '', '', '<h4>ACKNOWLEDGEMENT RECEIPT</h4>', 0, 0, 0, true, 'C', true);
        $pdf->SetFont ('helvetica', '', 10 , 15, 'default', true );

        $pdf->Ln(6);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Customer Name: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', $this->input->post('customername'), 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Date: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $date, 0, 0, 0, true, 'L', true);

        $pdf->Ln(5);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Customer Address: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', '', 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>TIN: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', '', 0, 0, 0, true, 'L', true);

        $pdf->Ln(10);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Lot Description: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', '', 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Amount: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', number_format($amount,2), 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);

        //EDIT HERE

        $pdf->writeHTMLCell(43, '', '', '', '', 'LTBR', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(139, '', '', '', 'P A Y M E N T'.' '.' '.' '.' '.' D E T A I L S', 'LTBR', 0, 0, true, 'C', true);

        $pdf->Ln(5);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(43, '', '', '', '<b>DESCRIPTION</b>', 'LB', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>AMOUNT</b>', 'LB', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(96, '', '', '', '<b>REMARKS</b>', 'LBR', 0, 0, true, 'C', true);

        $counter = 0;
        foreach($data as $r){
            $pdf->Ln(4);
            $debit = floatval($r['debit']);
            $credit = floatval($r['credit']);
            $sum = $debit + $credit;
            $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'C', true);
            $pdf->writeHTMLCell(43, '', '', '', number_format($sum,2), 'LB', 0, 0, true, 'R', true);
            $pdf->writeHTMLCell(96, '', '', '', $r['account_name'], 'LBR', 0, 0, true, 'C', true);
            $counter++;
        }

        $counter2 = 7 - $counter;

        for($y=0; $y<$counter2;$y++){
            $pdf->Ln(4);

            $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'C', true);
            $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'R', true);
            $pdf->writeHTMLCell(96, '', '', '', '', 'LBR', 0, 0, true, 'C', true);
        }

        $pdf->Ln(6);

        $pdf->writeHTMLCell(32, '', '', '', '<b>Authenticated by</b>', 1, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(34, '', '', '', '<b>Payment Type</b>', 1, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(29, '', '', '', '<b>Bank</b>', 1, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(27, '', '', '', '<b>Check No.</b>', 1, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(27, '', '', '', '<b>Check Date</b>', 1, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(32, '', '', '', '<b>Amount</b>', 1, 0, 0, true, 'C', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(32, '', '', '', '', 'LR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(34, '', '', '', '<b>Cash</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(29, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(32, '', '', '', number_format($cashamount, 2), 'BR', 0, 0, true, 'R', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(32, '', '', '', '', 'LR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(34, '', '', '', '<b>Check</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(29, '', '', '', $this->input->post('bankname'), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', $this->input->post('checknumber'), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', $this->input->post('checkdate'), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(32, '', '', '', number_format($checkamount, 2), 'BR', 0, 0, true, 'R', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(32, '', '', '', '', 'LRB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(34, '', '', '', '<b>Bank Deposit</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(29, '', '', '', $this->input->post('bankname'), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(32, '', '', '', number_format($depositamount, 2), 'BR', 0, 0, true, 'R', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(32, '', '', '', '<b>Cashier/Date</b>', 'LBT', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(34, '', '', '', '<b>Credit Card</b>', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(29, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(32, '', '', '', '', 'BR', 0, 0, true, 'L', true);

        $pdf->Ln(5);

        $pdf->writeHTMLCell(180, '', '', '', '<i>This receipt, if fully authenticated by our cashier is our official confirmation of your payment made on or Provisional Receipt. Check payment will not be credited upon proper clearance from bank. Thank you.</i>', 0, 0, 0, true, 'L', true);



        $pdf->Output('C:\xampp\htdocs\irm\reports\NonVatReceipt.pdf', 'F');

    }

    public function wiw()
    {

        $this->load->library('Pdf');
        //get user
        date_default_timezone_set("Asia/Manila");
        $date = date('Y-m-d');

        $pdf = new Pdf('L', 'in', 'MEMO', true, 'UTF-8', false);
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

        $pdf->AddPage();
        $y = $pdf->getY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        

        $pdf->writeHTMLCell(180, '', '', '', '<h4>ACKNOWLEDGEMENT RECEIPT</h4>', 0, 0, 0, true, 'C', true);
        $pdf->SetFont ('helvetica', '', 10 , 15, 'default', true );

        $pdf->Ln(6);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Customer Name: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', '', 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Date: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', $date, 0, 0, 0, true, 'L', true);

        $pdf->Ln(5);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Customer Address: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', '', 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>TIN: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', '', 0, 0, 0, true, 'L', true);

        $pdf->Ln(10);

        $pdf->writeHTMLCell(40, '', '', '', '<b>Lot Description: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(90, '', '', '', '', 0, 0, 0, true, 'L', true);

        $pdf->writeHTMLCell(25, '', '', '', '<b>Amount: </b>', 0, 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(50, '', '', '', '', 0, 0, 0, true, 'L', true);

        $pdf->Ln(7);

        //EDIT HERE

        $pdf->writeHTMLCell(43, '', '', '', '', 'LTBR', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(139, '', '', '', 'P A Y M E N T'.' '.' '.' '.' '.' D E T A I L S', 'LTBR', 0, 0, true, 'C', true);

        $pdf->Ln(5);
        $pdf->SetFont ('helvetica', '', 8 , 15, 'default', true );

        $pdf->writeHTMLCell(43, '', '', '', '<b>DESCRIPTION</b>', 'LB', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(43, '', '', '', '<b>AMOUNT</b>', 'LB', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(96, '', '', '', '<b>REMARKS</b>', 'LBR', 0, 0, true, 'C', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(96, '', '', '', '', 'LBR', 0, 0, true, 'C', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(96, '', '', '', '', 'LBR', 0, 0, true, 'C', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(96, '', '', '', '', 'LBR', 0, 0, true, 'C', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(96, '', '', '', '', 'LBR', 0, 0, true, 'C', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(96, '', '', '', '', 'LBR', 0, 0, true, 'C', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(96, '', '', '', '', 'LBR', 0, 0, true, 'C', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(43, '', '', '', '', 'LB', 0, 0, true, 'R', true);
        $pdf->writeHTMLCell(96, '', '', '', '', 'LBR', 0, 0, true, 'C', true);

        $pdf->Ln(6);

        $pdf->writeHTMLCell(32, '', '', '', '<b>Authenticated by</b>', 1, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(34, '', '', '', '<b>Payment Type</b>', 1, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(29, '', '', '', '<b>Bank</b>', 1, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(27, '', '', '', '<b>Check No.</b>', 1, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(27, '', '', '', '<b>Check Date</b>', 1, 0, 0, true, 'C', true);
        $pdf->writeHTMLCell(32, '', '', '', '<b>Amount</b>', 1, 0, 0, true, 'C', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(32, '', '', '', '', 'LR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(34, '', '', '', '<b>Cash</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(29, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(32, '', '', '', number_format($cashamount, 2), 'BR', 0, 0, true, 'R', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(32, '', '', '', '', 'LR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(34, '', '', '', '<b>Check</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(29, '', '', '', $this->input->post('bankname'), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', $this->input->post('checknumber'), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', $this->input->post('checkdate'), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(32, '', '', '', number_format($checkamount, 2), 'BR', 0, 0, true, 'R', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(32, '', '', '', '', 'LRB', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(34, '', '', '', '<b>Bank Deposit</b>', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(29, '', '', '', $this->input->post('bankname'), 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(32, '', '', '', number_format($depositamount, 2), 'BR', 0, 0, true, 'R', true);

        $pdf->Ln(4);

        $pdf->writeHTMLCell(32, '', '', '', '<b>Cashier/Date</b>', 'LBT', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(34, '', '', '', '<b>Credit Card</b>', 'LBR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(29, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(27, '', '', '', '', 'BR', 0, 0, true, 'L', true);
        $pdf->writeHTMLCell(32, '', '', '', '', 'BR', 0, 0, true, 'L', true);

        $pdf->Ln(5);

        $pdf->writeHTMLCell(180, '', '', '', '<i>This receipt, if fully authenticated by our cashier is our official confirmation of your payment made on or Provisional Receipt. Check payment will not be credited upon proper clearance from bank. Thank you.</i>', 0, 0, 0, true, 'L', true);



        $pdf->Output('C:\xampp\htdocs\irm\reports\NonVatReceipt.pdf', 'F');

    }

    public function recomputeamortization(){

        $this->data['content'] = 'recomputeamortization';
        $this->data['page_title'] = 'Recompute Amortization';
        $this->data['customjs'] = 'recomputeamortizationjs';
        $this->data['lots'] = $this->collection->getAllLots();
        $this->data['customers'] = $this->collection->get_customers();
        $this->load->view('default/index', $this->data);

    }

    public function getRemainingBalance(){
        $contractid = $this->input->post('contractid');
        $amortizationid = $this->input->post('amortizationid');
        $datareturn['contract'] = $this->collection->getTCPandDiscount($contractid);
        $datareturn['amortization'] = $this->collection->getPaidAmounts($amortizationid);
        echo json_encode($datareturn);
    }

    public function cancelPayment(){
        $paymentid = $this->input->post('paymentid');
        $paymenttypeid = $this->input->post('paymenttypeid');
        $amortizationid = $this->input->post('amortizationid');
        $principal = floatval($this->input->post('principal'));
        $interest = floatval($this->input->post('interest'));
        $surcharge = floatval($this->input->post('surcharge'));
        $sundry = floatval($this->input->post('sundry'));
        $ips_interest = floatval($this->input->post('ips_interest'));
        $ips_accrued = floatval($this->input->post('ips_accrued'));
        
        $amortizationline = $this->collection->getThisAmortization($amortizationid);

        $principal_paid = 0;
        $interest_paid = 0;
        $surcharge_paid = 0;
        $ips_interest_paid = 0;
        $ips_accrued_paid = 0;


        foreach($amortizationline as $a){ 
            $principal_paid = $a['principal_paid'];
            $interest_paid = $a['interest_paid'];
            $surcharge_paid = $a['surcharge_paid'];
            $ips_interest_paid = $a['ips_interest_paid'];
            $ips_accrued_paid = $a['ips_accrued_paid'];
        }

        $principal_paid = $principal_paid - $principal;
        $interest_paid = $interest_paid - $interest;
        $surcharge_paid = $surcharge_paid - $surcharge;
        $ips_interest_paid = $ips_interest_paid - $ips_interest;
        $ips_accrued_paid = $ips_accrued_paid - $ips_accrued;

        $this->collection->cancelPaymentAmortization($amortizationid,$principal_paid,$interest_paid,$surcharge_paid,$ips_interest_paid,$ips_accrued_paid);
        $this->collection->setPaymentCancelled($paymentid);

        if($paymenttypeid==2 || $paymenttypeid==3){
            $this->collection->setPaymentCheckCancelled($paymentid);
        }

        if($paymenttypeid==4){
            $this->collection->setPaymentInterBranchCancelled($paymentid);
        }
        
    }

    public function lots(){
        $this->data['content'] = 'lots';
        $this->data['page_title'] = 'Lots';
        $this->data['customjs'] = 'lotsjs';
        $this->data['all_project'] = $this->collection->retrieve_all_project();
        $this->data['lots'] = $this->collection->retrieve_project_byid_model(1);
        $this->load->view('default/index', $this->data);
    }
    public function brokers(){
        $this->data['content'] = 'brokers';
        $this->data['page_title'] = 'Brokers';
        $this->data['customjs'] = 'brokersjs';
        $this->data['allcity'] = $this->collection->getAllCity();
        $this->data['allcity1'] = $this->collection->getAllCity();
        $this->data['allprovince'] = $this->collection->getAllProvince();
        $this->data['allprovince1'] = $this->collection->getAllProvince();
        $this->data['addcountry'] = $this->collection->getAllCountry();
        $this->data['addcountry1'] = $this->collection->getAllCountry();
        $this->data['addtype'] = $this->collection->getAddressType();
        $this->data['brokers'] = $this->collection->getBrokers();
        $this->data['realty'] = $this->collection->get_realty_model();
        $this->data['realty2'] = $this->collection->get_realty_model();
        $this->data['contact_type'] = $this->collection->get_contact_type();
        $this->data['contact_type1'] = $this->collection->get_contact_type();
        $this->data['brokers'] = $this->collection->getBrokers();
        $this->load->view('default/index', $this->data);
    }

    public function get_contract_by_broker(){
        echo json_encode($this->collection->get_contract_by_broker_model($this->input->post('brok_id')));
    }

    public function customers()
    {
        $this->data['content'] = 'customers';
        $this->data['page_title'] = 'Customers';
        $this->data['customjs'] = 'customersjs';
        $this->data['customer'] = $this->collection->get_customers3();
        $this->data['allcity'] = $this->collection->getAllCity();
        $this->data['addtype'] = $this->collection->getAddressType();
        $this->data['addcountry'] = $this->collection->getAllCountry();
        $this->data['allprovince'] = $this->collection->getAllProvince();

        $this->load->view('default/index', $this->data);
    }

    public function retrieveOnCustomer(){
        $datareturn = $this->collection->getOnePerson($this->input->post('clientid'));
        echo json_encode($datareturn);
    }

    public function retrieveOnCustomerPartner(){
        $datareturn = $this->collection->getCustomerPartner($this->input->post('clientid'));
        echo json_encode($datareturn);
    }

    public function retrieve_customers_amortization(){
      $datareturn = $this->collection->get_contracts($this->input->post('clientid'));
      echo json_encode($datareturn);
    }
    public function get_address(){
        $datareturn = $this->collection->get_address_model($this->input->post('clientid'));
        echo json_encode($datareturn);
    } 
    public function contracts(){
        $this->data['content'] = 'contracts';
        $this->data['customjs'] = 'contractsjs';
        $this->data['all_contracts'] = $this->collection->get_contracts_model();
        $this->data['page_title'] = 'Contracts';
        $this->load->view('default/index', $this->data);
        // $this->load->view('errors/html/error_general', $this->data);
    }
    public function amortizationdetails(){
        $this->data['content'] = 'amortizationdetails';
        $this->data['page_title'] = 'Amortization Details';
        $this->data['amort'] = $this->collection->get_amortization($this->input->get('contractid'));
        $this->data['misc'] = $this->collection->get_miscellaneous_model($this->input->get('contractid'));
        $this->data['contract'] = $this->collection->get_contract_model($this->input->get('contractid'));
        $this->data['payment'] = $this->collection->paid_amortization_model($this->input->get('contractid'));
        $this->data['cont_stat_val'] = $this->collection->contract_status_model();
        $this->load->view('default/index', $this->data); 
    }
    public function diminishing_payment(){
        $contractid = $this->input->post('contractid');
        $datareturn = $this->collection->get_remaining_amortization($contractid);
        echo json_encode($datareturn);
    }
    public function save_new_amortization_sched_deminishing(){
        $data = $this->input->post('data2');
        $data = json_decode($data,true);

        foreach($data as $r){
            $amortization_id = $r['amortizationid'];
            $amortization_amount = $r['amortizationamount'];
            $interest = $r['interest'];
            $principal = $r['principal'];
            $remaining_balance = $r['remainingbalance'];
            $this->collection->update_amortization_sched_diminishing($amortization_id,$amortization_amount,$interest,$principal,$remaining_balance);
        }
    }

    public function updateAmortizationLine()
    {
        $amortizationid = $this->input->post('amortization_id');
        $principal = $this->input->post('principal');
        $outstanding_balance = $this->input->post('outstandingbalance');

        $this->collection->updateAmortizationLine4($amortizationid,$principal,$outstanding_balance);
    }


}

?>