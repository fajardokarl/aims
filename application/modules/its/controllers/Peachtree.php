<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Peachtree extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->model('Peachtree_model','peachtree');
		$this->data['customjs'] = 'peachtree_js';
		$this->data['navigation'] = 'navigation';
	}

	public function index(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'Peachtree';

		if(isset($this->session->userdata['logged_in']) && $this->session->userdata['employee_id'] == '101'){
			$this->load->view('default/index', $this->data);
		}
	}

	public function countRecords(){
		switch ($this->input->post('switcherino')) {
			case 'customer':
				$table = 'peachtree_customer';
				$option = '';				
			break;
		}
		$data = $this->peachtree->countRecords($table, $option);
		echo json_encode($data);
	}

	public function viewVendors(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'Vendors';
		$this->data['input_control'] = 'vendor';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getVendors(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getVendors();
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['vendor_id'],
				$record['vendor_name'],
				$record['line_1'],
				$record['line_2'],
				$record['city_st_zip'],
				$record['contact'],
				$record['telephone1'],
				$record['telephone2'],
				$record['fax_number'],
				$record['1099_type'],
				$record['tax_id_no'],
				$record['terms'],
				$record['vend_since']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsVendors(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('vendor');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    //$from = $this->input->post('date_start');
    //$to   = $this->input->post('date_end');
    $records = $this->peachtree->getVendors();

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


    $this->excel->getActiveSheet()->mergeCells('A1:M1');
    $this->excel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'Vendor');
    $this->excel->getActiveSheet()->getStyle('A2:M2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:M2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:M2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Vendor ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Vendor');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Line 1');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Line 2');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Address City');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Contact');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Phone1');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Phone2');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Fax Number');
    $this->excel->getActiveSheet()->setCellValue('J2', '1099 Type');
    $this->excel->getActiveSheet()->setCellValue('K2', 'TIN');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Terms');
    $this->excel->getActiveSheet()->setCellValue('M2', 'Vend Since');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['vendor_id'],
				$record['vendor_name'],
				$record['line_1'],
				$record['line_2'],
				$record['city_st_zip'],
				$record['contact'],
				$record['telephone1'],
				$record['telephone2'],
				$record['fax_number'],
				$record['1099_type'],
				$record['tax_id_no'],
				$record['terms'],
				$record['vend_since']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':M'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':M'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='vendor.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewVendorLedger(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'Vendor Ledger';
		$this->data['input_control'] = 'vendorledger';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getVendorLedger(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getVendorLedger($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['vendor_id'],
				$record['vendor_name'],
				$record['vl_date'],
				$record['trans_no'],
				$record['type'],
				$record['debit_amount'],
				$record['credit_amount'],
				$record['balance']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsVendorLedger(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('vendorledger');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getVendorLedger($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Vendor Ledger(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Vendor ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Vendor');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Trans No');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Type');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Balance');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['vendor_id'],
				$record['vendor_name'],
				$record['vl_date'],
				$record['trans_no'],
				$record['type'],
				$record['debit_amount'],
				$record['credit_amount'],
				$record['balance']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='vendorledger.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewTransactionReport(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'Transaction Report';
		$this->data['input_control'] = 'transactionreport';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getTransactionReport(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getTransactionReport($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['tr_date'],
				$record['type'],
				$record['reference'],
				$record['id'],
				$record['name'],
				$record['amount']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsTransactionReport(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('transactionreport');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getTransactionReport($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Transaction Report(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Type');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('D2', 'ID');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Name');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Amount');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['tr_date'],
				$record['type'],
				$record['reference'],
				$record['id'],
				$record['name'],
				$record['amount']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':F'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':F'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='transactionreport.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewSalesJournal(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'Sales Journal';
		$this->data['input_control'] = 'salesjournal';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getSalesJournal(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getSalesJournal($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['sj_date'],
				$record['peachtree_accountid'],
				$record['invoice_no'],
				$record['line_description'],
				$record['debit_amount'],
				$record['credit_amount']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsSalesJournal(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('salesjournal');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getSalesJournal($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Sales Journal(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Account ID');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Invoice No');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Line Description');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Credit');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['sj_date'],
				$record['peachtree_accountid'],
				$record['invoice_no'],
				$record['line_description'],
				$record['debit_amount'],
				$record['credit_amount']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':F'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':F'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='salesjournal.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewSalesInvoice(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'Sales Invoice';
		$this->data['input_control'] = 'salesinvoice';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getSalesInvoice(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getSalesInvoice($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['peachtree_customerid'],
				$record['invoiceno'],
				$record['period'],
				$record['si_date'],
				$record['status'],
				$record['invoice_total'],
				$record['net_due'],
				$record['customer_name']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsSalesInvoice(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('salesinvoice');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getSalesInvoice($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Sales Invoice(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Customer ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Invoice No');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Period');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Status');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Invoice Total');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Net Due');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Customer Name');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['peachtree_customerid'],
				$record['invoiceno'],
				$record['period'],
				$record['si_date'],
				$record['status'],
				$record['invoice_total'],
				$record['net_due'],
				$record['customer_name']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='salesinvoice.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewReceiptList(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'Receipt List';
		$this->data['input_control'] = 'receiptlist';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getReceiptList(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getReceiptList($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['reference'],
				$record['customer_vendorid'],
				$record['customer_vendorname'],
				$record['receipt_no'],
				$record['period'],
				$record['rl_date'],
				$record['receipt_amount'],
				$record['deposit_ticketid']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsReceiptList(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('receiptlist');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getReceiptList($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Receipt List(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Vendor ID');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Vendor');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Receipt No');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Period');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Receipt Amount');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Deposit Ticket ID');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['reference'],
				$record['customer_vendorid'],
				$record['customer_vendorname'],
				$record['receipt_no'],
				$record['period'],
				$record['rl_date'],
				$record['receipt_amount'],
				$record['deposit_ticketid']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='receiptlist.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewPurchaseJournal(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'Purchase Journal';
		$this->data['input_control'] = 'purchasejournal';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getPurchaseJournal(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getPurchaseJournal($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['pj_date'],
				$record['peachtree_accountid'],
				$record['account_description'],
				$record['invoice_no'],
				$record['line_description'],
				$record['debit_amount'],
				$record['credit_amount']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsPurchaseJournal(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('purchasejournal');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getPurchaseJournal($from, $to);

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


    $this->excel->getActiveSheet()->mergeCells('A1:G1');
    $this->excel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'Purchase Journal(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:G2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Account ID');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Account Description');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Invoice No');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Line Description');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Credit');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['pj_date'],
				$record['peachtree_accountid'],
				$record['account_description'],
				$record['invoice_no'],
				$record['line_description'],
				$record['debit_amount'],
				$record['credit_amount']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':G'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':G'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='purchasejournal.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewInvoiceRegister(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'Invoice Register';
		$this->data['input_control'] = 'invoiceregister';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getInvoiceRegister(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getInvoiceRegister($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['invoice_no'],
				$record['ir_date'],
				$record['quote_no'],
				$record['name'],
				$record['amount']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsInvoiceRegister(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('invoiceregister');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getInvoiceRegister($from, $to);

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


    $this->excel->getActiveSheet()->mergeCells('A1:E1');
    $this->excel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'Invoice Register(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:E2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Invoice No');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Quote No');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Name');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Amount');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['invoice_no'],
				$record['ir_date'],
				$record['quote_no'],
				$record['name'],
				$record['amount']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':E'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':E'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='invoiceregister.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewGLManilaOffice(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'GL Manila Office';
		$this->data['input_control'] = 'glmanilaoffice';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getGLManilaOffice(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getGLManilaOffice($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['peachtree_accountid'],
				$record['account_description'],
				$record['gl_date'],
				$record['reference'],
				$record['trans_description'],
				$record['debit_amount'],
				$record['credit_amount'],
				$record['balance']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}	
	public function xlsGLManilaOffice(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('glmanilaoffice');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getGLManilaOffice($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'GL Manila Office(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Account ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Account Description');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Trans Description');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Balance');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['peachtree_accountid'],
				$record['account_description'],
				$record['gl_date'],
				$record['reference'],
				$record['trans_description'],
				$record['debit_amount'],
				$record['credit_amount'],
				$record['balance']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='glmanilaoffice.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewGeneralLedger(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'General Ledger';
		$this->data['input_control'] = 'generalledger';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getGeneralLedger(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getGeneralLedger($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['peachtree_accountid'],
				$record['account_description'],
				$record['gl_date'],
				$record['reference'],
				$record['trans_description'],
				$record['debit_amount'],
				$record['credit_amount'],
				$record['balance']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsGeneralLedger(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('generalledger');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getGeneralLedger($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'General Ledger(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Account ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Account Description');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Trans Description');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Balance');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['peachtree_accountid'],
				$record['account_description'],
				$record['gl_date'],
				$record['reference'],
				$record['trans_description'],
				$record['debit_amount'],
				$record['credit_amount'],
				$record['balance']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='generalledger.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewFixedAssets(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'Fixed Assets';
		$this->data['input_control'] = 'fixedassets';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getFixedAssets(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getFixedAssets($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['peachtree_accountid'],
				$record['account_description'],
				$record['fa_date'],
				$record['reference'],
				$record['journal'],
				$record['trans_description'],
				$record['debit_amount'],
				$record['credit_amount'],
				$record['balance']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}	
	public function xlsFixedAssets(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('fixedassets');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getFixedAssets($from, $to);

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


    $this->excel->getActiveSheet()->mergeCells('A1:I1');
    $this->excel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'Fixed Assets(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:I2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Account ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Account Description');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Journal');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Trans Description');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Balance');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['peachtree_accountid'],
				$record['account_description'],
				$record['fa_date'],
				$record['reference'],
				$record['journal'],
				$record['trans_description'],
				$record['debit_amount'],
				$record['credit_amount'],
				$record['balance']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':I'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':I'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='fixedassets.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewEWT(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'EWT';
		$this->data['input_control'] = 'ewt';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getEWT(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getEWT($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['peachtree_accountid'],
				$record['account_description'],
				$record['ewt_date'],
				$record['reference'],
				$record['journal'],
				$record['trans_description'],
				$record['debit_amount'],
				$record['credit_amount'],
				$record['balance'],
				$record['job_id']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsEWT(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('ewt');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getEWT($from, $to);

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


    $this->excel->getActiveSheet()->mergeCells('A1:J1');
    $this->excel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'EWT(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:J2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Account ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Account Description');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Journal');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Trans Description');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Balance');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Job ID');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['peachtree_accountid'],
				$record['account_description'],
				$record['ewt_date'],
				$record['reference'],
				$record['journal'],
				$record['trans_description'],
				$record['debit_amount'],
				$record['credit_amount'],
				$record['balance'],
				$record['job_id']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':J'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':J'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='ewt.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewCIBUBP(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'CIB-UBP';
		$this->data['input_control'] = 'cibubp';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getCIBUBP(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getCIBUBP($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['cib_date'],
				$record['reference'],
				$record['journal'],
				$record['trans_description'],
				$record['debit_amount'],
				$record['credit_amount'],
				$record['balance'],
				$record['job_id']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsCIBUBP(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('cibubp');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getCIBUBP($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'CIB - UBP(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Journal');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Trans Description');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Balance');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Job ID');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['cib_date'],
				$record['reference'],
				$record['journal'],
				$record['trans_description'],
				$record['debit_amount'],
				$record['credit_amount'],
				$record['balance'],
				$record['job_id']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='cibubp.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewCheckRegister(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'Check Register';
		$this->data['input_control'] = 'checkregister';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getCheckRegisters(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getCheckRegisters($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['check_no'],
				$record['cr_date'],
				$record['payee'],
				$record['cash_account'],
				$record['amount']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsCheckRegister(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('checkregister');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getCheckRegisters($from, $to);

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


    $this->excel->getActiveSheet()->mergeCells('A1:E1');
    $this->excel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'Check Register(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:E2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Check No');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Payee');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Cash Amount');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Amount');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['check_no'],
				$record['cr_date'],
				$record['payee'],
				$record['cash_account'],
				$record['amount']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':E'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':E'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='checkregister.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewCashReceiptsJournal(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'Cash Receipts Journal';
		$this->data['input_control'] = 'cashreceiptsjournal';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getCashReceiptsJournals(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getCashReceiptsJournals($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['crj_date'],
				$record['peachtree_accountid'],
				$record['transaction_ref'],
				$record['line_description'],
				$record['debit_amount'],
				$record['credit_amount']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsCashReceiptsJournals(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('cashreceiptsjournal');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getCashReceiptsJournals($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Cash Receipts Journal(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Account ID');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Transaction Reference');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Line Description');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Credit');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['crj_date'],
				$record['peachtree_accountid'],
				$record['transaction_ref'],
				$record['line_description'],
				$record['debit_amount'],
				$record['credit_amount']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':F'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':F'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='cashreceiptsjournal.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewCashDisbursementJournal(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'Cash Disbursement Journal';
		$this->data['input_control'] = 'cashdisbursementjournal';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getCashDisbursementJournals(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getCashDisbursementJournals($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['cdj_date'],
				$record['check_no'],
				$record['line_description'],
				$record['account_description'],
				$record['debit_amount'],
				$record['credit_amount']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsCashDisbursementJournal(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('cashdisbursementjournal');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getCashDisbursementJournals($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Cash Disbursement Journal(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Check No');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Line Description');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Account Description');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Credit');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['cdj_date'],
				$record['check_no'],
				$record['line_description'],
				$record['account_description'],
				$record['debit_amount'],
				$record['credit_amount']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':F'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':F'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='cashdisbursementjournal.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewAPRetitlingLot(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'AP Retitling Lot';
		$this->data['input_control'] = 'retitlinglot';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getRetitlingLots(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getRetitlingLots($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['ap_date'],
				$record['reference'],
				$record['journal'],
				$record['trans_description'],
				$record['debit_amount'],
				$record['credit_amount'],
				$record['balance']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsRetitlingLots(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('retitlinglot');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getRetitlingLots($from, $to);

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


    $this->excel->getActiveSheet()->mergeCells('A1:G1');
    $this->excel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'Retitling Lots(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:G2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Journal');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Trans Description');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Balance');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['ap_date'],
				$record['reference'],
				$record['journal'],
				$record['trans_description'],
				$record['debit_amount'],
				$record['credit_amount'],
				$record['balance']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':G'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':G'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='retitlinglot.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}




	public function viewGeneralJournals(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'General Journal';
		$this->data['input_control'] = 'generaljournal';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}	
	public function getGeneralJournals(){
		set_time_limit(0);
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getGeneralJournals($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['gj_date'],
				$record['peachtree_account_id'],
				$record['reference'],
				$record['trans_description'],
				$record['debit_amount'],
				$record['credit_amount']
			);
		}

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $records->num_rows(),
				"recordsFiltered" => $records->num_rows(),
				"data" => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsGeneralJournals(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('generaljournal');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->peachtree->getGeneralJournals($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'General Journal(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Date');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Account ID');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Trans Description');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Credit');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['gj_date'],
				$record['peachtree_account_id'],
				$record['reference'],
				$record['trans_description'],
				$record['debit_amount'],
				$record['credit_amount']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':F'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':F'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='generaljournal.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}

	public function viewCustomers(){
		$this->data['content'] = 'peachtree_view';
		$this->data['page_title'] = 'Customers';
		$this->data['input_control'] = 'customer';
		$this->data['records'] = $this->peachtree->getCustomers();

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getCustomers(){
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->peachtree->getCustomers();
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['customerid'],
				$record['customer']
			);
		}

		$output = array(
			'draw' => $draw,
				'recordsTotal' => $records->num_rows(),
				'recordsFiltered' => $records->num_rows(),
				'data' => $data
		);
		echo json_encode($output);
		exit();
	}
	public function xlsCustomers(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('customer');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    //$from = $this->input->post('date_start');
    //$to   = $this->input->post('date_end');
    $records = $this->peachtree->getCustomers();

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


    $this->excel->getActiveSheet()->mergeCells('A1:B1');
    $this->excel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'Customer');
    $this->excel->getActiveSheet()->getStyle('A2:B2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:B2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:B2')->applyFromArray($styleArray4);

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Customer ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Customer');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['customerid'],
				$record['customer']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':B'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':B'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='customer.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function convertTransactionReport(){
		set_time_limit(0);
		$records = $this->peachtree->getTransactionReportTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['tr_date'], 0, strpos($record['tr_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['tr_date'], strpos($record['tr_date'], '/')+1, strrpos($record['tr_date'], '/')-strpos($record['tr_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['tr_date'], strrpos($record['tr_date'], '/')+1, strlen($record['tr_date'])-strrpos($record['tr_date'], '/')-1);
			$year = (substr($year, 0,1) == '9')? '19'.$year:'20'.$year;

			$info = array(
				'tr_date' => $year.'-'.$month.'-'.$day,
				'type' => $record['type'],
				'reference' => $record['reference'],
				'id' => $record['id'],
				'name' => $record['name'],
				'amount' => str_replace(',', '', $record['amount'])
			);
			$this->peachtree->insertTransactionReport($info);
		}
		$this->db->trans_complete();
	}

	public function convertGeneralLedger(){
		set_time_limit(0);
		$records = $this->peachtree->getGeneralLedgerTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			if ($record['gl_date']) {
				$month = substr($record['gl_date'], 0, strpos($record['gl_date'], '/'));
				$month = ($month < 10)? '0'.$month:$month;
				$day = substr($record['gl_date'], strpos($record['gl_date'], '/')+1, strrpos($record['gl_date'], '/')-strpos($record['gl_date'], '/')-1);
				$day = ($day < 10)? '0'.$day:$day;
				$year = substr($record['gl_date'], strrpos($record['gl_date'], '/')+1, strlen($record['gl_date'])-strrpos($record['gl_date'], '/')-1);
				$year = (substr($year, 0,1) == '9')? '19'.$year:'20'.$year;
			}

			$info = array(
				'peachtree_accountid' => $record['peachtree_accountid'],
				'account_description' => $record['account_description'],
				'gl_date' => (!$record['gl_date'])? '': $year.'-'.$month.'-'.$day,
				'reference' => $record['reference'],
				'trans_description' => $record['trans_description'],
				'debit_amount' => str_replace(',', '', $record['debit_amount']),
				'credit_amount' => str_replace(',', '', $record['credit_amount']),
				'balance' => str_replace(',', '', $record['balance'])
			);
			$this->peachtree->insertGeneralLedger($info);
		}
		$this->db->trans_complete();
	}

	public function convertAPRetitlingLot(){
		set_time_limit(0);
		$records = $this->peachtree->getAPRetitlingLotTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['ap_date'], 0, strpos($record['ap_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['ap_date'], strpos($record['ap_date'], '/')+1, strrpos($record['ap_date'], '/')-strpos($record['ap_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['ap_date'], strrpos($record['ap_date'], '/')+1, strlen($record['ap_date'])-strrpos($record['ap_date'], '/')-1);
			$year = (substr($year, 0,1) == '9')? '19'.$year:'20'.$year;

			$info = array(
				'ap_date' => $year.'-'.$month.'-'.$day,
				'reference' => $record['reference'],
				'journal' => $record['journal'],
				'trans_description' => $record['trans_description'],
				'debit_amount' => str_replace(',', '', $record['debit_amount']),
				'credit_amount' => str_replace(',', '', $record['credit_amount']),
				'balance' => str_replace(',', '', $record['balance'])
			);
			$this->peachtree->insertAPRetitlingLot($info);
		}
		$this->db->trans_complete();
	}

	public function convertCashDisbursementJournal(){
		set_time_limit(0);
		$records = $this->peachtree->getCashDisbursementJournalTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['cdj_date'], 0, strpos($record['cdj_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['cdj_date'], strpos($record['cdj_date'], '/')+1, strrpos($record['cdj_date'], '/')-strpos($record['cdj_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['cdj_date'], strrpos($record['cdj_date'], '/')+1, strlen($record['cdj_date'])-strrpos($record['cdj_date'], '/')-1);
			$year = (substr($year, 0,1) == '9')? '19'.$year:'20'.$year;

			$info = array(
				'cdj_date' => $year.'-'.$month.'-'.$day,
				'check_no' => $record['check_no'],
				'line_description' => $record['line_description'],
				'account_description' => $record['account_description'],
				'debit_amount' => str_replace(',', '', $record['debit_amount']),
				'credit_amount' => str_replace(',', '', $record['credit_amount'])
			);
			$this->peachtree->insertCashDisbursementJournal($info);
		}
		$this->db->trans_complete();
	}

	public function convertCheckRegister(){
		set_time_limit(0);
		$records = $this->peachtree->getCheckRegisterTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['cr_date'], 0, strpos($record['cr_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['cr_date'], strpos($record['cr_date'], '/')+1, strrpos($record['cr_date'], '/')-strpos($record['cr_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['cr_date'], strrpos($record['cr_date'], '/')+1, strlen($record['cr_date'])-strrpos($record['cr_date'], '/')-1);
			$year = (substr($year, 0,1) == '9')? '19'.$year:'20'.$year;
			
			$info = array(
				'check_no' => $record['check_no'],
				'cr_date' => $year.'-'.$month.'-'.$day,
				'payee' => $record['payee'],
				'cash_account' => $record['cash_account'],
				'amount' => str_replace(',', '', $record['amount'])
			);
			$this->peachtree->insertCheckRegister($info);
		}
		$this->db->trans_complete();
	}

	public function convertCIBUBP(){
		set_time_limit(0);
		$records = $this->peachtree->getCIBUBPTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['cib_date'], 0, strpos($record['cib_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['cib_date'], strpos($record['cib_date'], '/')+1, strrpos($record['cib_date'], '/')-strpos($record['cib_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['cib_date'], strrpos($record['cib_date'], '/')+1, strlen($record['cib_date'])-strrpos($record['cib_date'], '/')-1);
			$year = (substr($year, 0,1) == '9')? '19'.$year:'20'.$year;

			$info = array(
				'cib_date' => $year.'-'.$month.'-'.$day,
				'reference' => $record['reference'],
				'journal' => $record['journal'],
				'trans_description' => $record['trans_description'],
				'debit_amount' => str_replace(',', '', $record['debit_amount']),
				'credit_amount' => str_replace(',', '', $record['credit_amount']),
				'balance' => str_replace(',', '', $record['balance']),
				'job_id' => $record['job_id']
			);
			$this->peachtree->insertCIBUBP($info);
		}
		$this->db->trans_complete();
	}

	public function convertGLManilaOffice(){
		set_time_limit(0);
		$records = $this->peachtree->getGLManilaOfficeTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['gl_date'], 0, strpos($record['gl_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['gl_date'], strpos($record['gl_date'], '/')+1, strrpos($record['gl_date'], '/')-strpos($record['gl_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['gl_date'], strrpos($record['gl_date'], '/')+1, strlen($record['gl_date'])-strrpos($record['gl_date'], '/')-1);
			$year = (substr($year, 0,1) == '9')? '19'.$year:'20'.$year;

			$info = array(
				'peachtree_accountid' => $record['peachtree_accountid'],
				'account_description' => $record['account_description'],
				'gl_date' => $year.'-'.$month.'-'.$day,
				'reference' => $record['reference'],
				'trans_description' => $record['trans_description'],
				'debit_amount' => str_replace(',', '', $record['debit_amount']),
				'credit_amount' => str_replace(',', '', $record['credit_amount']),
				'balance' => str_replace(',', '', $record['balance']) 
			);
			$this->peachtree->insertGLManilaOffice($info);
		}
		$this->db->trans_complete();
	}

	public function convertEWT(){
		set_time_limit(0);
		$records = $this->peachtree->getEWTTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['ewt_date'], 0, strpos($record['ewt_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['ewt_date'], strpos($record['ewt_date'], '/')+1, strrpos($record['ewt_date'], '/')-strpos($record['ewt_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['ewt_date'], strrpos($record['ewt_date'], '/')+1, strlen($record['ewt_date'])-strrpos($record['ewt_date'], '/')-1);
			$year = (substr($year, 0,1) == '9')? '19'.$year:'20'.$year;

			$info = array(
				'peachtree_accountid' => $record['peachtree_accountid'],
				'account_description' => $record['account_description'],
				'ewt_date' => $year.'-'.$month.'-'.$day,
				'reference' => $record['reference'],
				'journal' => $record['journal'],
				'trans_description' => $record['trans_description'],
				'debit_amount' =>  str_replace(',', '', $record['debit_amount']),
				'credit_amount' => str_replace(',', '', $record['credit_amount']),
				'balance' => str_replace(',', '', $record['balance']),
				'job_id' => $record['job_id']
			);
			$this->peachtree->insertEWT($info);
		}
		$this->db->trans_complete();
	}

	public function convertFixedAssets(){
		set_time_limit(0);
		$records = $this->peachtree->getFixedAssetsTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['fa_date'], 0, strpos($record['fa_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['fa_date'], strpos($record['fa_date'], '/')+1, strrpos($record['fa_date'], '/')-strpos($record['fa_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['fa_date'], strrpos($record['fa_date'], '/')+1, strlen($record['fa_date'])-strrpos($record['fa_date'], '/')-1);
			$year = (substr($year, 0,1) == '9')? '19'.$year:'20'.$year;

			$info = array(
				'peachtree_accountid' => $record['peachtree_accountid'],
				'account_description' => $record['account_description'],
				'fa_date' => $year.'-'.$month.'-'.$day,
				'reference' => $record['reference'],
				'journal' => $record['journal'],
				'trans_description' => $record['trans_description'],
				'debit_amount' => str_replace(',', '', $record['debit_amount']),
				'credit_amount' => str_replace(',', '', $record['credit_amount']),
				'balance' => str_replace(',', '', $record['balance']) 
			);
			$this->peachtree->insertFixedAssets($info);
		}
		$this->db->trans_complete();
	}

	public function convertPurchaseJournal(){
		set_time_limit(0);
		$records = $this->peachtree->getPurchaseJournalTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['pj_date'], 0, strpos($record['pj_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['pj_date'], strpos($record['pj_date'], '/')+1, strrpos($record['pj_date'], '/')-strpos($record['pj_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['pj_date'], strrpos($record['pj_date'], '/')+1, strlen($record['pj_date'])-strrpos($record['pj_date'], '/')-1);
			$year = (substr($year, 0,1) == '9')? '19'.$year:'20'.$year;
			
			$info = array(
				'pj_date' => $year.'-'.$month.'-'.$day,
				'peachtree_accountid' => $record['peachtree_accountid'],
				'account_description' => $record['account_description'],
				'invoice_no' => $record['invoice_no'],
				'line_description' => $record['line_description'],
				'debit_amount' => str_replace(',', '', $record['debit_amount']),
				'credit_amount' => str_replace(',', '', $record['credit_amount']) 
			);
			$this->peachtree->insertPurchaseJournal($info);
		}
		$this->db->trans_complete();
	}

	public function convertSalesJournal(){
		set_time_limit(0);
		$records = $this->peachtree->getSalesJournalTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['sj_date'], 0, strpos($record['sj_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['sj_date'], strpos($record['sj_date'], '/')+1, strrpos($record['sj_date'], '/')-strpos($record['sj_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['sj_date'], strrpos($record['sj_date'], '/')+1, strlen($record['sj_date'])-strrpos($record['sj_date'], '/')-1);
			$year = (substr($year, 0,1) == '9')? '19'.$year:'20'.$year;

			$info = array(
				'sj_date' => $year.'-'.$month.'-'.$day,
				'peachtree_accountid' => $record['peachtree_accountid'],
				'invoice_no' => $record['invoice_no'],
				'line_description' => $record['line_description'],
				'debit_amount' => str_replace(',', '', $record['debit_amount']),
				'credit_amount' => str_replace(',', '', $record['credit_amount'])
			);
			$this->peachtree->insertSalesJournal($info);
		}
		$this->db->trans_complete();
	}

	public function convertVendorLedger(){
		set_time_limit(0);
		$records = $this->peachtree->getVendorLedgerTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['vl_date'], 0, strpos($record['vl_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['vl_date'], strpos($record['vl_date'], '/')+1, strrpos($record['vl_date'], '/')-strpos($record['vl_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['vl_date'], strrpos($record['vl_date'], '/')+1, strlen($record['vl_date'])-strrpos($record['vl_date'], '/')-1);
			$year = (substr($year, 0,1) == '9')? '19'.$year:'20'.$year;

			$info = array(
				'vendor_id' => $record['vendor_id'],
				'vendor_name' => $record['vendor_name'],
				'vl_date' => $year.'-'.$month.'-'.$day,
				'trans_no' => $record['trans_no'],
				'type' => $record['type'],
				'debit_amount' => str_replace(',', '', $record['debit_amount']),
				'credit_amount' => str_replace(',', '', $record['credit_amount']),
				'balance' => str_replace(',', '', $record['balance']) 
			);
			$this->peachtree->insertVendorLedger($info);
		}
		$this->db->trans_complete();
	}

	public function convertVendorList(){
		set_time_limit(0);
		$records = $this->peachtree->getVendorListTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['vend_since'], 0, strpos($record['vend_since'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['vend_since'], strpos($record['vend_since'], '/')+1, strrpos($record['vend_since'], '/')-strpos($record['vend_since'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['vend_since'], strrpos($record['vend_since'], '/')+1, strlen($record['vend_since'])-strrpos($record['vend_since'], '/')-1);
			$year = (substr($year, 0,1) == '9')? '19'.$year:'20'.$year;

			$info = array(
				'vendor_id' => $record['vendor_id'],
				'vendor_name' => $record['vendor_name'],
				'line_1' => $record['line_1'],
				'line_2' => $record['line_2'],
				'city_st_zip' => $record['city_st_zip'],
				'contact' => $record['contact'],
				'telephone1' => $record['telephone1'],
				'telephone2' => $record['telephone2'],
				'fax_number' => $record['fax_number'],
				'1099_type' => $record['1099_type'],
				'tax_id_no' => $record['tax_id_no'],
				'terms' => $record['terms'],
				'vend_since' => $year.'-'.$month.'-'.$day
			);
			$this->peachtree->insertVendorList($info);
		}
		$this->db->trans_complete();
	}

	public function convertInvoiceRegister(){
		set_time_limit(0);
		$records = $this->peachtree->getInvoiceRegisterTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['ir_date'], 0, strpos($record['ir_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['ir_date'], strpos($record['ir_date'], '/')+1, strrpos($record['ir_date'], '/')-strpos($record['ir_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['ir_date'], strrpos($record['ir_date'], '/')+1, strlen($record['ir_date'])-strrpos($record['ir_date'], '/')-1);
			$year = '20'.$year;

			$info = array(
				'invoice_no' => $record['invoice_no'],
				'ir_date' => $year.'-'.$month.'-'.$day,
				'quote_no' => $record['quote_no'],
				'name' => $record['name'],
				'amount' => str_replace(',', '', $record['amount'])
			);
			$this->peachtree->insertInvoiceRegister($info);
		}
		$this->db->trans_complete();
	}

	public function convertCustomerLedger(){
		set_time_limit(0);
		$records = $this->peachtree->getCustomerLedgerTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['cl_date'], 0, strpos($record['cl_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['cl_date'], strpos($record['cl_date'], '/')+1, strrpos($record['cl_date'], '/')-strpos($record['cl_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['cl_date'], strrpos($record['cl_date'], '/')+1, strlen($record['cl_date'])-strrpos($record['cl_date'], '/')-1);
			$year = '20'.$year;

			$info = array(
				'peachtree_customerid' => $record['peachtree_customerid'],
				'customer_name' => $record['customer_name'],
				'cl_date' => $year.'-'.$month.'-'.$day,
				'trans_no' => $record['trans_no'],
				'type' => $record['type'],
				'debit_amount' => str_replace(',', '', $record['debit_amount']),
				'credit_amount' => str_replace(',', '', $record['credit_amount']),
				'balance_amount' => str_replace(',', '', $record['balance_amount'])
			);
			$this->peachtree->insertCustomerLedger($info);
		}
		$this->db->trans_complete();
	}
	
	public function convertReceiptList(){
		set_time_limit(0);
		$records = $this->peachtree->getReceiptListTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['rl_date'], 0, strpos($record['rl_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['rl_date'], strpos($record['rl_date'], '/')+1, strrpos($record['rl_date'], '/')-strpos($record['rl_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['rl_date'], strrpos($record['rl_date'], '/')+1, strlen($record['rl_date'])-strrpos($record['rl_date'], '/')-1);

			$info = array(
				'reference' => $record['reference'],
				'customer_vendorid' => $record['customer_vendorid'],
				'customer_vendorname' => $record['customer_vendorname'],
				'receipt_no' => $record['receipt_no'],
				'period' => $record['period'],
				'rl_date' => $year.'-'.$month.'-'.$day,
				'receipt_amount' => str_replace('(', '-', str_replace(array('$',',',')'), '', $record['receipt_amount'])),
				'deposit_ticketid' => $record['deposit_ticketid']
			);
			$this->peachtree->insertReceiptList($info);
		}
		$this->db->trans_complete();
	}

	public function convertCashReceiptsJournal(){
		ini_set('memory_limit', '1G');
		set_time_limit(0);
		$records = $this->peachtree->getCashReceiptsJournalTemp();
		$this->db->trans_start();
		foreach ($records as $record){
			$month = substr($record['crj_date'], 0, strpos($record['crj_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['crj_date'], strpos($record['crj_date'], '/')+1, strrpos($record['crj_date'], '/')-strpos($record['crj_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['crj_date'], strrpos($record['crj_date'], '/')+1, strlen($record['crj_date'])-strrpos($record['crj_date'], '/')-1);
			$year = '20'.$year;

			$info = array(
				'crj_date' => $year.'-'.$month.'-'.$day, 
				'peachtree_accountid' => $record['peachtree_accountid'],
				'transaction_ref' => $record['transaction_ref'],
				'line_description' => $record['line_description'],
				'debit_amount' => str_replace(',', '', $record['debit_amount']),
				'credit_amount' => str_replace(',', '', $record['credit_amount'])
			);
			$this->peachtree->insertCashReceiptsJournal($info);
		}
		$this->db->trans_complete();
	}

	public function convertSalesInvoice(){
		set_time_limit(0);
		$records = $this->peachtree->getSalesInvoiceTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['si_date'], 0, strpos($record['si_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['si_date'], strpos($record['si_date'], '/')+1, strrpos($record['si_date'], '/')-strpos($record['si_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['si_date'], strrpos($record['si_date'], '/')+1, strlen($record['si_date'])-strrpos($record['si_date'], '/')-1);
			
			$search1 = array('$',',',')');
			$invoicetotal = str_replace($search1, '', $record['invoice_total']);
			$invoicetotal = str_replace('(', '-', $invoicetotal);

			$netdue = str_replace($search1, '', $record['net_due']);
			$netdue = str_replace('(', '-', $netdue);
			$info = array(
				'peachtree_customerid' => $record['customerid'],
				'invoiceno' => $record['invoiceno'],
				'period' => $record['period'],
				'si_date' => $year.'-'.$month.'-'.$day,
				'status' => $record['status'],
				'invoice_total' => $invoicetotal,
				'net_due' => $netdue,
				'customer_name' => $record['customer_name']
			);
			$this->peachtree->insertSalesInvoice($info);
		}
		$this->db->trans_complete();
	}

	public function convertGeneralJournal(){
		set_time_limit(0);
		$records = $this->peachtree->getGeneralJournalTemp();
		$this->db->trans_start();
		foreach ($records as $record) {
			$month = substr($record['gj_date'], 0, strpos($record['gj_date'], '/'));
			$month = ($month < 10)? '0'.$month:$month;
			$day = substr($record['gj_date'], strpos($record['gj_date'], '/')+1, strrpos($record['gj_date'], '/')-strpos($record['gj_date'], '/')-1);
			$day = ($day < 10)? '0'.$day:$day;
			$year = substr($record['gj_date'], strrpos($record['gj_date'], '/')+1, strlen($record['gj_date'])-strrpos($record['gj_date'], '/')-1);
			$year = '20'.$year;
			
			$info = array(
				'gj_date' => $year.'-'.$month.'-'.$day,
				'peachtree_account_id' => $record['peachtree_account_id'],
				'reference' => $record['reference'],
				'trans_description' => $record['trans_description'],
				'debit_amount' => str_replace(',', '', $record['debit_amount']),
				'credit_amount' => str_replace(',', '', $record['credit_amount'])
			);
			$this->peachtree->insertGeneralJournal($info);
		}
		$this->db->trans_complete();
	}

	/*public function migrate_customer(){
		set_time_limit(0);
		$this->db->trans_start();
		echo "<table><tbody>";
		$records = $this->peachtree->getCustomers();
		foreach ($records->result_array() as $record) {
			$holder = $this->peachtree->eraseDoubleSpace($record['customer']);
			$type = 0;
			$code = '';
			$lastname = 'warning';
			$firstname = 'warning';
			$middlename = '';
			$suffix = '';
			$prefix = '';
			$reference = '';
			if ($this->peachtree->deleteType($holder)) {
				$type = 0;
			} else {
				if ($this->peachtree->checkCompany($holder)) {
					$type = 2;
				} else {
					$type = 1;
				}
				if ($type == 2) {
					$code = '';
					for ($i=0; $i < strlen($holder); $i++) { 
						if (substr($holder, $i, 1) == '/'
							and substr($holder, $i+1, 1) == 'B'
							and is_numeric(substr($holder, $i+2, 1))) {
							$code = substr($holder, $i+1, strlen($holder)-$i);
							$holder = substr($holder, 0, $i);
							break;
						}
						if (substr($holder, $i, 1) == 'B'
							and is_numeric(substr($holder, $i+1, 1))	
							and is_numeric(substr($holder, $i+2, 1))
						) {
							$code = substr($holder, $i, strlen($holder)-$i);
							$holder = substr($holder, 0, $i);
							break;
						}
					}//end for loop code and holder
					$organization = $this->peachtree->findOrganizationByName($holder);
					if(!$organization){
						$org_info = array(
							'organization_name' => $holder,
							'customer_old_id' => '',
							'tin' => '',
							'special_instruction' => '',
							'status_id' => 1
						);
						$reference = $this->peachtree->insertOrganization($org_info);
					} else {
						$reference = $organization['organization_id'];
					}
					$organization_account = $this->peachtree->findOrganizationAccount($reference, $code);
					if (!$organization_account) {
						$organization_accountinfo = array(
							'organization_id' => $reference,
							'contract_id' => '',
							'account' => $code
						);
						$this->peachtree->insertOrganizationAccount($organization_accountinfo);
					}
					$client = $this->peachtree->findClient($reference, $type);
					if (!$client) {
						$info = array(
							'client_type_id' => $type,
							'reference_id' => $reference,
							'date_created' => '',
							'status_id' => 1,
							'subsidiary_code' => '',
							'peachtree_customerid' => $record['customerid']
						);
						$this->peachtree->insertClient($info);
					} else {
						if (!$client['peachtree_customerid']) {
							$updinfo = array('peachtree_customerid' => $record['customerid']);
							$this->peachtree->updateClient($updinfo, $record['client_id']);
						}
					}
				} elseif ($type == 1){
					if (substr_count($holder, 'HO Guard') == 0) {
						if (substr_count($holder, '(') > 0 and substr_count($holder, ')') > 0) {
							$holder = trim(substr($holder, 0, strpos($holder, '('))).trim(substr($holder, strpos($holder, ')')+1, strlen($holder)-strpos($holder, ')')-1));
						}
						if (substr_count($holder, '9') > 0 and substr_count($holder, ')') > 0) {
							$holder = trim(substr($holder, 0, strpos($holder, '9'))).trim(substr($holder, strpos($holder, ')')+1, strlen($holder)-strpos($holder, ')')-1));
						}
					} else {
						$holder = trim(substr($holder, 0, strpos($holder, '('))).', '.trim(substr($holder, strpos($holder, '(')+1, strlen($holder)-strpos($holder, '(')-2));
					}
					for ($i=0; $i < strlen($holder); $i++) { 
						if (substr($holder, $i, 1) == 'B'
							and is_numeric(substr($holder, $i+1, 1))) {
							$code = substr($holder, $i, strlen($holder)-$i);
							$holder = substr($holder, 0, $i);
						}
						if (substr($holder, $i, 1) == '/'
							and substr($holder, $i+1,1) == 'B'
							and is_numeric(substr($holder, $i+2,1))) {
							$code = substr($holder, $i+1, strlen($holder)-$i+1);
							$holder = substr($holder, 0, $i);
						}
						if (substr($holder, $i, 1) == '/'
							and substr($holder, $i+1, 1) == 'B'
							and substr($holder, $i+2, 1) == ':'
							and is_numeric(substr($holder, $i+3, 1))) {
							$code = substr($holder, $i+1, strlen($holder)-$i+1);
							$holder = substr($holder, 0, $i);
						}
						if (substr($holder, $i, 1) == '/'
							and is_numeric(substr($holder, $i+1,1))) {
							$code = substr($holder, $i+1, strlen($holder)-$i+1);
							$holder = substr($holder, 0, $i);
						}
						if (substr($holder, $i, 1) == 'P'
							and is_numeric(substr($holder, $i+1,1))) {
							$code = substr($holder, $i, strpos($holder, '-'));
							$holder = substr($holder, strpos($holder, '-')+1, strlen($holder)-strpos($holder, '-')-1);
						}
					}//end for loop
					
					$char = [];
					$charpos = [];
					for ($i=0; $i < strlen($holder); $i++) { 
						switch (substr($holder, $i,1)) {
							case ',':
								array_push($char, ',');
								array_push($charpos, $i);			
							break;
							case '.':
								array_push($char, '.');
								array_push($charpos, $i);
							break;
							case '-':
								array_push($char, '-');
								array_push($charpos, $i);
							break;
							case '/':
								array_push($char, '/');
								array_push($charpos, $i);
							break;
							case '&':
								array_push($char, '&');
								array_push($charpos, $i);
							break;
							case ' ':
								if (substr($holder, $i-1,1) == ',' or 
									substr($holder, $i-1,1) == '(' or 
									substr($holder, $i-1,1) == '-' or 
									substr($holder, $i-1,1) == '.' or 
									substr($holder, $i-1,1) == '/' or 
									substr($holder, $i-1,1) == '&' or 
									substr($holder, $i+1,1) == ',' or
									substr($holder, $i+1,1) == '(' or 
									substr($holder, $i+1,1) == '-' or
									substr($holder, $i+1,1) == '.' or 
									substr($holder, $i+1,1) == '/' or 
									substr($holder, $i+1,1) == '&'){

								} else{
									array_push($char, ' ');
									array_push($charpos, $i);
								}	
							break;	
						}
					}
					switch (sizeof($char)) {
						case 0:
							$lastname = $holder;
						break;
						case 1:
							switch ($char[0]) {
								case ',':
									$lastname = trim(substr($holder, 0, $charpos[0]));
									$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
								break;
								case ' ':
									$lastname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
									$firstname = trim(substr($holder, 0, $charpos[0]));
								break;
								case '&':
									$lastname = trim(substr($holder, 0, $charpos[0]));
									$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
								break;
								case '.':
									if (substr_count($holder, 'Atty') > 0) {
										$lastname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
										$firstname = trim(substr($holder, 0, $charpos[0]));
									} else {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
									}
								break;
								case '/':
									$lastname = trim(substr($holder, 0, $charpos[0]));
									$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
								break;
							}
						break;
						case 2:
							if (substr_count($holder, 'III') > 0) {
								$suffix = 'III';
								$holder = trim(substr($holder, 0, strpos($holder, 'III'))).trim(substr($holder, strpos($holder, 'III')+3, strlen($holder)-strpos($holder, 'III')-3));
							}
							if (substr_count($holder, 'II') > 0) {
								$suffix = 'II';
								$holder = trim(substr($holder, 0, strpos($holder, 'II'))).trim(substr($holder, strpos($holder, 'II')+2, strlen($holder)-strpos($holder, 'II')-2));
							}
							if (substr_count($holder, 'JR') > 0) {
								$suffix = 'Jr';
								$holder = trim(substr($holder, 0, strpos($holder, 'JR'))).trim(substr($holder, strpos($holder, 'JR')+2, strlen($holder)-strpos($holder, 'JR')-2));
							}
							if (substr_count($holder, 'Jr') > 0) {
								$suffix = 'Jr';
								$holder = trim(substr($holder, 0, strpos($holder, 'Jr'))).trim(substr($holder, strpos($holder, 'Jr')+2, strlen($holder)-strpos($holder, 'Jr')-2));
							}


							switch ($char[0]) {
								case ' ':
									if ($char[1] == ',') {
										$lastname = trim(substr($holder, 0, $charpos[1]));
										$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
									} elseif ($char[1] == '.') {
										if ($charpos[1]+1 == strlen($holder)) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										} else {
											$lastname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
											$firstname = trim(substr($holder, 0, $charpos[0]));
											$middlename = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										}
									}
								break;
								case ',':
									if ($char[1] == ' ') {
										if ($charpos[1] == strlen($holder) or $charpos[1]+1 == strlen($holder)) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
										} else {
											if ($charpos[1]+2 == strlen($holder)) {
												$lastname = trim(substr($holder, 0, $charpos[0]));
												$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
											} else {
													$lastname = trim(substr($holder, 0, $charpos[0]));
													$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
											}
										}
									} elseif ($char[1] == '.') {
										if ($charpos[0]+3 == $charpos[1] and $charpos[1]+1 == strlen($holder)) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1,$charpos[1]-$charpos[0]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
										}
									} elseif ($char[1] == '&') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} elseif ($char[1] == '/') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} elseif ($char[1] == '-') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
									}
								break;
								case '-':
									$lastname = trim(substr($holder, 0, $charpos[1]));
									$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
								break;
							}
						break;	
						case 3:
							if (substr_count($holder, 'Jr') > 0) {
								$suffix = 'Jr';
								$holder = trim(substr($holder,0,strpos($holder, 'Jr'))).trim(substr($holder, strpos($holder, 'Jr')+2, strlen($holder)-strpos($holder, 'Jr')-2));
							}
							if (substr_count($holder, 'Sr') > 0) {
								$suffix = 'Sr';
								$holder = trim(substr($holder,0,strpos($holder, 'Sr'))).trim(substr($holder, strpos($holder, 'Sr')+2, strlen($holder)-strpos($holder, 'Sr')-2));
							}
							if (substr_count($holder, 'Atty') > 0) {
								$prefix = 'Atty';
								$holder = trim(substr($holder, 0,strpos($holder, 'Atty'))).trim(substr($holder, strpos($holder, 'Atty')+4, strlen($holder)-strpos($holder, 'Atty')-4));
							}
							if (substr_count($holder, '- ALORA') > 0) {
								$holder = trim(substr($holder, 0, strpos($holder, '- ALORA')));
							}

							switch ($char[0]) {
								case ',':
									if ($char[1] == ' ') {
										if ($char[2] == ' ') {
											if ($charpos[2]+2 == strlen($holder)) {
												$lastname = trim(substr($holder, 0, $charpos[0]));
												$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
												$middlename = trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1));
											} else {
												$lastname = trim(substr($holder, 0, $charpos[0]));
												$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
											}
										} elseif ($char[2] == '.') {
											if ($charpos[1]+2 == $charpos[2]) {
												$lastname = trim(substr($holder, 0, $charpos[0]));
												$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											} else {
												$lastname = trim(substr($holder, 0, $charpos[0]));
												$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											}
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										}
									} elseif ($char[1] == '-') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} elseif ($char[1] == '.') {
										if ($char[2] == ' ') {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										} elseif ($char[2] == '.') {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										} elseif ($char[2] == '/') {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										}
									} elseif ($char[1] == '&') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} elseif ($char[1] == '/') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									}
								break;
								case ' ':
									if ($char[1] == ',') {
										if ($char[2] == ' ') {
											$lastname = trim(substr($holder, 0, $charpos[1]));
											$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										} elseif ($char[2] == '.') {
											$lastname = trim(substr($holder, 0, $charpos[1]));
											$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										} elseif ($char[2] == '/') {
											$lastname = trim(substr($holder, 0, $charpos[1]));
											$firstname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										}
									} 		
								break;
								case '-':
									if ($char[2] == ' ') {
										$lastname = trim(substr($holder, 0, $charpos[1]));
										$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
									} else {
										$lastname = trim(substr($holder, 0, $charpos[1]));
										$firstname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									}
								break;
								case '/':
									$lastname = trim(substr($holder, 0, $charpos[0]));
									$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
								break;
							}
						break;
						case 4:
							if (substr_count($holder, 'Jr') > 0) {
								$suffix = 'Jr';
								$holder = trim(substr($holder,0,strpos($holder, 'Jr'))).trim(substr($holder, strpos($holder, 'Jr')+2, strlen($holder)-strpos($holder, 'Jr')-2));
							}
							if (substr_count($holder, 'Sr') > 0) {
								$suffix = 'Sr';
								$holder = trim(substr($holder,0,strpos($holder, 'Sr'))).trim(substr($holder, strpos($holder, 'Sr')+2, strlen($holder)-strpos($holder, 'Sr')-2));
							}


							switch ($char[0]) {
								case ',':
									if ($char[1] == ' ') {
										if ($char[2] == ' ') {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} else {
											if ($charpos[3]+1 == strlen($holder)) {
												$lastname = trim(substr($holder, 0, $charpos[0]));
												$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											} elseif ($charpos[1]+2 == $charpos[2]) {
												$lastname = trim(substr($holder, 0, $charpos[0]));
												$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											} else {
												$lastname = trim(substr($holder, 0, $charpos[0]));
												$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											}
										}
									} elseif ($char[1] == '.') {
										if (substr($holder, $charpos[1]-2, 2) == 'Ma') {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										}
									} else {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									}
								break;
								case ' ':
									if ($char[1] == ',') {
										$lastname = trim(substr($holder, 0, $charpos[1]));
										$firstname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
									} else {
										if ($char[3] == '&') {
											$lastname = trim(substr($holder, 0, $charpos[2]));
											$firstname = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[2]));
											$firstname = trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1));
										}
									}
								break;
								case '-':
									$lastname = trim(substr($holder, 0, $charpos[1]));
									$firstname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
								break;
								case '/':
									$lastname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									$firstname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									$middlename = trim(substr($holder, 0, $charpos[0]));
								break;
							}
						break;
						case 5:
							$lastname = trim(substr($holder, 0, $charpos[2]));
							$firstname = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
							$middlename  =trim(substr($holder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
						break;
					}
					$person = $this->peachtree->findPerson($lastname, $firstname);
					if (!$person) {
						$personinfo = array(
							'lastname' => $lastname,
							'firstname' => $firstname,
							'middlename' => $middlename,
							'prefix' => $prefix,
							'suffix' => $suffix,
							'sex' => '',
							'birthdate' => '',
							'birthplace' => '',
							'nationality' => '',
							'civil_status_id' => '',
							'tin' => '',
							'picture_url' => ''
						);
						$person_id = $this->peachtree->insertPerson($personinfo);
					} else {
						$updpersoninfo = array(
							'middlename' => (!$person['middlename'])? $middlename: $person['middlename'],
							'prefix' => (!$person['prefix'])? $prefix: $person['prefix'],
							'suffix' => (!$person['suffix'])? $suffix: $person['suffix']
						);
						$person_id = $person['person_id'];
						$this->peachtree->updatePerson($updpersoninfo, $person_id);
					}

					$customer = $this->peachtree->findCustomer($person_id);
					if (!$customer) {
						$customerinfo = array(
							'customer_fullname' => $record['customer'],
							'person_id' => $person_id,
							'customer_old_id' => '',
							'customer_work_id' => '',
							'special_instruction' => ''
						);
						$reference = $this->peachtree->insertCustomer($customerinfo);
					} else {
						$reference = $customer['customer_id'];
					}

					$customer_account = $this->peachtree->findCustomerAccount($person_id, $code);
					if (!$customer_account) {
						$customer_accountinfo = array(
							'person_id' => $person_id,
							'contract_id' => '',
							'account' => $code,
							'bill_type' => 'paper',
							'bill_notification_type' => 'none',
							'subsidiary_code' => '',
							'customer_old_id' => '',
							'customer_old_subcode' => '',
							'remarks' => '',
							'status_id' => 1
						); 
						$this->peachtree->insertCustomerAccount($customer_accountinfo);
					}

					$client = $this->peachtree->findClient($reference, $type);
					if (!$client) {
						$info = array(
							'client_type_id' => $type,
							'reference_id' => $reference,
							'date_created' => '',
							'status_id' => 1,
							'subsidiary_code' => '',
							'peachtree_customerid' => $record['customerid']
						);
						$this->peachtree->insertClient($info);
					} else {
						if (!$client['peachtree_customerid']) {
							$updinfo = array('peachtree_customerid' => $record['customerid']);
							$this->peachtree->updateClient($updinfo, $client['client_id']);
						}
					} 
				}//end sa type
					echo "<tr><td>".$record['customer'].'</td><td>'.$type.'</td><td>'.$code.'</td><td>'.$reference.'</td><td>'.$holder.'</td><td>'.$person['lastname'].'</td><td>'.$person['firstname'].'</td><td>'.$person['middlename'].'</td><td>'.$person['suffix'].'</td><td>'.$prefix.'</td></tr>';							
			}//end else deletetype
		}//end foreach
		echo "</tbody></table>";
		$this->db->trans_complete();
		//echo json_encode('done');
	}*/	

	/*public function migrate_vendor(){
		set_time_limit(0);
		$this->db->trans_start();
		echo "<table><tbody>";
		$records = $this->peachtree->getVendors();
		foreach ($records->result_array() as $record) {
			$type = 0;
			if (substr_count($record['vendor_id'], 'AEP/') == 0 
				&& substr_count($record['vendor_id'], 'AP/EE') == 0 
				&& substr_count($record['vendor_id'], 'AP/RETCHS-') == 0 
				&& substr_count($record['vendor_id'], 'AP/RETLOT-') == 0 
				&& substr_count($record['vendor_id'], 'AP/SBL-') == 0
				&& substr_count($record['vendor_id'], 'AP/PAY') == 0
				&& substr_count($record['vendor_id'], 'APO/LB-') == 0
				&& substr_count($record['vendor_id'], 'APO/TF-') == 0
				&& substr_count($record['vendor_id'], 'APO/TF/') == 0
				&& substr_count($record['vendor_id'], 'APO/OTH') == 0
				&& substr_count($record['vendor_id'], 'APO/WGD-') == 0
				&& substr_count($record['vendor_id'], 'APO/XECB-') == 0
				&& substr_count($record['vendor_id'], 'APO/XECN-') == 0
				&& substr_count($record['vendor_id'], 'APO/XEWS-') == 0
				&& substr_count($record['vendor_id'], 'APO//OE-') == 0
				&& substr_count($record['vendor_id'], 'AAP/HARRING') == 0
				&& substr_count($record['vendor_id'], 'AAP-PDC-VARIOUS') == 0
				&& substr_count($record['vendor_id'], 'AIP/') == 0
				&& substr_count($record['vendor_id'], 'DFC/') == 0
				&& substr_count($record['vendor_id'], 'RP/HAPIT') == 0
				&& substr_count($record['vendor_id'], 'RP/MABRAU') == 0
				&& substr_count($record['vendor_id'], 'RP/UNSPECIFIED') == 0
				&& substr_count($record['vendor_id'], 'RP/VIOS') == 0
			) {
				$holder = $this->peachtree->eraseDoubleSpace($record['vendor_name']);
				if($this->peachtree->checkCompany($holder)){
					$type = 2;
				
					$organization = $this->peachtree->findOrganizationByName($holder);
					if (!$organization) {
						$organizationinfo = array(
							'organization_name' => $holder,
							'customer_old_id' => '',
							'tin' => $record['tax_id_no'],
							'special_instruction' => '',
							'status_id' => 1
						);
						$organizationid = $this->peachtree->insertOrganization($organizationinfo);
					} else {
						$organizationid = $organization['organization_id'];
					}

					//insert Organization Address
					if (!$this->peachtree->findOrganizationAddress($organizationid)) {
						if ($record['line_1'] or $record['line_2'] or $record['city_st_zip']) {
							$addressinfo = array(
								'line_1' => $record['line_1'], 
								'line_2' => $record['line_2'],
								'line_3' => $record['city_st_zip'],
								'city_id' => '',
								'province_id' => '',
								'postal_code' => '',
								'country_id' => 175,
								'address_type_id' => 2
							);

							if (substr_count($record['city_st_zip'], 'Cagaya') > 0) {
								$addressinfo['city_id'] = 998;
								$addressinfo['province_id'] = 49;
								$addressinfo['postal_code'] = '9000';
							} elseif(substr_count($record['city_st_zip'], 'Davao') > 0) {
								$addressinfo['city_id'] = 530;
								$addressinfo['province_id'] = 29;
								$addressinfo['postal_code'] = '';
							} elseif(substr_count($record['city_st_zip'], 'Butuan') > 0) {
								$addressinfo['city_id'] = 28;
								$addressinfo['province_id'] = 2;
								$addressinfo['postal_code'] = '';
							} elseif(substr_count($record['city_st_zip'], 'Makati') > 0) {
								$addressinfo['city_id'] = 966;
								$addressinfo['province_id'] = 47;
								$addressinfo['postal_code'] = '';
							} elseif(substr_count($record['city_st_zip'], 'Cebu') > 0) {
								$addressinfo['city_id'] = 438;
								$addressinfo['province_id'] = 25;
								$addressinfo['postal_code'] = '';
							} elseif(substr_count($record['city_st_zip'], 'Muntinlupa') > 0) {
								$addressinfo['city_id'] = 971;
								$addressinfo['province_id'] = 47;
								$addressinfo['postal_code'] = '';
							} elseif(substr_count($record['city_st_zip'], 'Paranaque') > 0) {
								$addressinfo['city_id'] = 973;
								$addressinfo['province_id'] = 47;
								$addressinfo['postal_code'] = '';
							} elseif(substr_count($record['city_st_zip'], 'Caloocan') > 0) {
								$addressinfo['city_id'] = 964;
								$addressinfo['province_id'] = 47;
								$addressinfo['postal_code'] = '';
							} elseif(substr_count($record['city_st_zip'], 'Iligan') > 0) {
								$addressinfo['city_id'] = 792;
								$addressinfo['province_id'] = 41;
								$addressinfo['postal_code'] = '';
							} elseif(substr_count($record['city_st_zip'], 'Pasig') > 0) {
								$addressinfo['city_id'] = 975;
								$addressinfo['province_id'] = 47;
								$addressinfo['postal_code'] = '';
							} elseif(substr_count($record['city_st_zip'], 'Manila') > 0) {
								$addressinfo['city_id'] = 969;
								$addressinfo['province_id'] = 47;
								$addressinfo['postal_code'] = '';
							} elseif(substr_count($record['city_st_zip'], 'Pagadian') > 0) {
								$addressinfo['city_id'] = 1593;
								$addressinfo['province_id'] = 79;
								$addressinfo['postal_code'] = '';
							} elseif(substr_count($record['city_st_zip'], 'Lapu-Lapu') > 0){
								$addressinfo['city_id'] = 441;
								$addressinfo['province_id'] = 25;
								$addressinfo['postal_code'] = '6015';
							} elseif(substr_count($record['city_st_zip'], 'Mandaue') > 0) {
								$addressinfo['city_id'] = 442;
								$addressinfo['province_id'] = 25;
								$addressinfo['postal_code'] = '6014';
							} elseif(substr_count($record['city_st_zip'], 'Digos') > 0) {
								$addressinfo['city_id'] = 531;
								$addressinfo['province_id'] = 29;
								$addressinfo['postal_code'] = '';
							} elseif(substr_count($record['city_st_zip'], 'Bulacan') > 0) {
								$addressinfo['city_id'] = 286;
								$addressinfo['province_id'] = 17;
								$addressinfo['postal_code'] = '';
							} elseif(substr_count($record['city_st_zip'], 'Cabadbaran') > 0) {
								$addressinfo['city_id'] = 30;
								$addressinfo['province_id'] = 2;
								$addressinfo['postal_code'] = '';
							}
							$orgaddressid = $this->peachtree->insertAddress($addressinfo);
							
							$organization_addressinfo = array(
								'organization_id' => $organizationid,
								'address_id' => $orgaddressid,
								'status_id' => 1
							);
							$this->peachtree->insertOrganizationAddress($organization_addressinfo); 			
						}
					}

					//Organization Contact
					if ($record['telephone1']) {
						if (!$this->peachtree->findOrganizationContactByValue($organizationid, $record['telephone1'])) {
							$contactinfo = array(
								'person_id' => '',
								'contact_type_id' => 2,
								'contact_value' => $record['telephone1'],
								'status_id' => 1
							);
							$contactid = $this->peachtree->insertContact($contactinfo);

							$organization_contactinfo = array(
								'organization_id' => $organizationid,
								'contact_id' => $contactid,
								'status_id' => 1
							);
							$this->peachtree->insertOrganizationContact($organization_contactinfo);
						}
					}
					if ($record['telephone2']) {
						if (!$this->peachtree->findOrganizationContactByValue($organizationid, $record['telephone2'])) {
							$contactinfo = array(
								'person_id' => '',
								'contact_type_id' => 2,
								'contact_value' => $record['telephone2'],
								'status_id' => 1
							);
							$contactid = $this->peachtree->insertContact($contactinfo);

							$organization_contactinfo = array(
								'organization_id' => $organizationid,
								'contact_id' => $contactid,
								'status_id' => 1
							);
							$this->peachtree->insertOrganizationContact($organization_contactinfo);
						}
					}
					if ($record['fax_number']) {
						if (!$this->peachtree->findOrganizationContactByValue($organizationid, $record['fax_number'])) {
							$contactinfo = array(
								'person_id' => '',
								'contact_type_id' => 5,
								'contact_value' => $record['fax_number'],
								'status_id' => 1
							);
							$contactid = $this->peachtree->insertContact($contactinfo);

							$organization_contactinfo = array(
								'organization_id' => $organizationid,
								'contact_id' => $contactid,
								'status_id' => 1
							);
							$this->peachtree->insertOrganizationContact($organization_contactinfo);
						}
					}

					//Supplier
					if (!$this->peachtree->findSupplier(2, $organizationid)) {
						$supplierinfo = array(
							'client_type_id' => 2,
							'reference_id' => $organizationid,
							'status_id' => 1,
							'peachtree_vendorid' => $record['vendor_id']
						);
						$this->peachtree->insertSupplier($supplierinfo);
					}

					echo "<tr><td>".$record['vendor_name']."</td><td>".$record['telephone1']."</td><td>".$record['telephone2']."</td><td>".$record['fax_number']."</td><td>".$record['1099_type']."</td></tr>";
				}
			}
		}
		echo "</table></tbody>";
		$this->db->trans_complete();
	}*/
}