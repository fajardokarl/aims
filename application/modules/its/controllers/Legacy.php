<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Legacy extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->model('Legacy_model','legacy');
		$this->data['customjs'] = 'legacy_js';
		$this->data['navigation'] = 'navigation';
	}

	public function index(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Legacy';

		if(isset($this->session->userdata['logged_in'])){
			$this->load->view('default/index', $this->data);
		}
	}

	public function viewUomitem(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Unit of Measure Per Item';
		$this->data['input_control'] = 'uomitem';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getUomitem(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBUomitem();
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['itemid'],
				$record['itemnumber'],
				$record['categorycode'],
				$record['itemdescription'],
				$record['measureid'],
				$record['uomid'],
				$record['uomdesc']
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
	public function xlsUomitem(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('uomitem');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    //$from = $this->input->post('date_start');
    //$to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBUomitem();

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'UOM Item');
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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Item ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Item Number');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Category Code');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Item Description');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Measure ID');
    $this->excel->getActiveSheet()->setCellValue('F2', 'UOM ID');
    $this->excel->getActiveSheet()->setCellValue('G2', 'UOM Description');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['itemid'],
				$record['itemnumber'],
				$record['categorycode'],
				$record['itemdescription'],
				$record['measureid'],
				$record['uomid'],
				$record['uomdesc']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':G'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':G'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='uomitem.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewAgingReceivables(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Aging of Receivables';
		$this->data['input_control'] = 'agingreceivables';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getAgingReceivables(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBAgingReceivables();
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['contract_id'],
				$record['custname'],
				$record['lotid'],
				$record['cattitle'],
				$record['phasetitle'],
				$record['line_desc'],
				$record['amortization_date'],
				$record['pay_date'],
				$record['amortization_amount'],
				$record['principal'],
				$record['outstanding_balance'],
				$record['principal_pay'],
				$record['unpaidamort']
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
	public function xlsAgingReceivables(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('agingreceivables');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    //$from = $this->input->post('date_start');
    //$to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBAgingReceivables();

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Aging Receivables');
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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Contract ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Customer');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Lot ID');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Category Title');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Phase Title');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Line Description');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Amortization Date');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Pay Date');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Amortization Amount');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Principal');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Outstanding Balance');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Principal Pay');
    $this->excel->getActiveSheet()->setCellValue('M2', 'Unpaid Amortization');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['contract_id'],
				$record['custname'],
				$record['lotid'],
				$record['cattitle'],
				$record['phasetitle'],
				$record['line_desc'],
				$record['amortization_date'],
				$record['pay_date'],
				$record['amortization_amount'],
				$record['principal'],
				$record['outstanding_balance'],
				$record['principal_pay'],
				$record['unpaidamort']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':M'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':M'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='agingreceivables.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewPoserved(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'PO Served';
		$this->data['input_control'] = 'poserved';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getPoserved(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBPoserved($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['podate'],
				$record['ponumber'],
				$record['supplierid'],
				$record['subfullname'],
				$record['poamount'],
				$record['rramount'],
				$record['balance'],
				$record['status'],
				$record['project']
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
	public function xlsPOServed(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('poserved');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBPoserved($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'PO Served(' . $from . ' - ' . $to . ')');
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

    $this->excel->getActiveSheet()->setCellValue('A2', 'PO Date');
    $this->excel->getActiveSheet()->setCellValue('B2', 'PO Number');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Supplier ID');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Sub Fullname');
    $this->excel->getActiveSheet()->setCellValue('E2', 'PO Amount');
    $this->excel->getActiveSheet()->setCellValue('F2', 'RR Amount');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Balance');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Status');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Project');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['podate'],
				$record['ponumber'],
				$record['supplierid'],
				$record['subfullname'],
				$record['poamount'],
				$record['rramount'],
				$record['balance'],
				$record['status'],
				$record['project']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':I'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':I'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='poserved.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewProsdb(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'PROS DB';
		$this->data['input_control'] = 'prosdb';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getProsdb(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBProsdb();
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['custid'],
				$record['custname'],
				$record['tcpamount'],
				$record['contractdate'],
				$record['restdate'],
				$record['solddate'],
				$record['cpname'],
				$record['cpposition'],
				$record['contactnumber'],
				$record['emailadd'],
				$record['addrprovince'],
				$record['addrcity'],
				$record['addrbrgy'],
				$record['addrstreet'],
				$record['hpictfilenm'],
				$record['spictfilenm'],
				$record['active'],
				$record['rc'],
				$record['rm'],
				$record['rcu'],
				$record['rmu'],
				$record['branch'],
				$record['tin'],
				$record['addrstreet1'],
				$record['addrbrgy1'],
				$record['addrcity1'],
				$record['addrprovince1'],
				$record['business'],
				$record['faxnumber'],
				$record['fundsource'],
				$record['bdate'],
				$record['placeofbirth'],
				$record['nationality'],
				$record['gender'],
				$record['civilstatus'],
				$record['dependents'],
				$record['employername'],
				$record['jobtitle'],
				$record['occupation'],
				$record['grossincome'],
				$record['bdate2'],
				$record['tin2'],
				$record['businessphone2'],
				$record['contact2'],
				$record['emailadd2'],
				$record['employername2'],
				$record['jobtitle2'],
				$record['personal2'],
				$record['sendto'],
				$record['oldacct']
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
	public function xlsProsdb(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('prosdb');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    //$from = $this->input->post('date_start');
    //$to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBProsdb();

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


    $this->excel->getActiveSheet()->mergeCells('A1:AX1');
    $this->excel->getActiveSheet()->getStyle('A1:AX1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:AX1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'PROS DB');
    $this->excel->getActiveSheet()->getStyle('A2:AX2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:AX2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:AX2')->applyFromArray($styleArray4);

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
    $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AD')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AE')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AF')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AG')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AH')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AI')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AK')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AL')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AM')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AN')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AO')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AP')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AQ')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AR')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AS')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AT')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AU')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AV')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AW')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AX')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Cust ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Customer');
    $this->excel->getActiveSheet()->setCellValue('C2', 'TCP');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Contract Date');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Restructure Date');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Sold Date');
    $this->excel->getActiveSheet()->setCellValue('G2', 'CP Name');
    $this->excel->getActiveSheet()->setCellValue('H2', 'CP Position');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Contact Number');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Email Add');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Province');
    $this->excel->getActiveSheet()->setCellValue('L2', 'City');
    $this->excel->getActiveSheet()->setCellValue('M2', 'Brgy');
    $this->excel->getActiveSheet()->setCellValue('N2', 'Street');
    $this->excel->getActiveSheet()->setCellValue('O2', 'hpictfilenm');
    $this->excel->getActiveSheet()->setCellValue('P2', 'spictfilenm');
    $this->excel->getActiveSheet()->setCellValue('Q2', 'Active');
    $this->excel->getActiveSheet()->setCellValue('R2', 'RC');
    $this->excel->getActiveSheet()->setCellValue('S2', 'RM');
    $this->excel->getActiveSheet()->setCellValue('T2', 'RCU');
    $this->excel->getActiveSheet()->setCellValue('U2', 'RMU');
    $this->excel->getActiveSheet()->setCellValue('V2', 'Branch');
    $this->excel->getActiveSheet()->setCellValue('W2', 'TIN');
    $this->excel->getActiveSheet()->setCellValue('X2', 'Street2');
    $this->excel->getActiveSheet()->setCellValue('Y2', 'Brgy2');
    $this->excel->getActiveSheet()->setCellValue('Z2', 'City2');
    $this->excel->getActiveSheet()->setCellValue('AA2', 'Province2');
    $this->excel->getActiveSheet()->setCellValue('AB2', 'Business');
    $this->excel->getActiveSheet()->setCellValue('AC2', 'Fax Number');
    $this->excel->getActiveSheet()->setCellValue('AD2', 'Fund Source');
    $this->excel->getActiveSheet()->setCellValue('AE2', 'Date of Birth');
    $this->excel->getActiveSheet()->setCellValue('AF2', 'Place of Birth');
    $this->excel->getActiveSheet()->setCellValue('AG2', 'Nationality');
    $this->excel->getActiveSheet()->setCellValue('AH2', 'Gender');
    $this->excel->getActiveSheet()->setCellValue('AI2', 'Civil Status');
    $this->excel->getActiveSheet()->setCellValue('AJ2', 'Dependents');
    $this->excel->getActiveSheet()->setCellValue('AK2', 'Employer');
    $this->excel->getActiveSheet()->setCellValue('AL2', 'Job Title');
    $this->excel->getActiveSheet()->setCellValue('AM2', 'Occupation');
    $this->excel->getActiveSheet()->setCellValue('AN2', 'Gross Income');
    $this->excel->getActiveSheet()->setCellValue('AO2', 'Date of Birth2');
    $this->excel->getActiveSheet()->setCellValue('AP2', 'TIN2');
    $this->excel->getActiveSheet()->setCellValue('AQ2', 'Business2');
    $this->excel->getActiveSheet()->setCellValue('AR2', 'Contact2');
    $this->excel->getActiveSheet()->setCellValue('AS2', 'Email Add2');
    $this->excel->getActiveSheet()->setCellValue('AT2', 'Employer2');
    $this->excel->getActiveSheet()->setCellValue('AU2', 'Job Title2');
    $this->excel->getActiveSheet()->setCellValue('AV2', 'Personal2');
    $this->excel->getActiveSheet()->setCellValue('AW2', 'Send To');
    $this->excel->getActiveSheet()->setCellValue('AX2', 'Old Account');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['custid'],
				$record['custname'],
				$record['tcpamount'],
				$record['contractdate'],
				$record['restdate'],
				$record['solddate'],
				$record['cpname'],
				$record['cpposition'],
				$record['contactnumber'],
				$record['emailadd'],
				$record['addrprovince'],
				$record['addrcity'],
				$record['addrbrgy'],
				$record['addrstreet'],
				$record['hpictfilenm'],
				$record['spictfilenm'],
				$record['active'],
				$record['rc'],
				$record['rm'],
				$record['rcu'],
				$record['rmu'],
				$record['branch'],
				$record['tin'],
				$record['addrstreet1'],
				$record['addrbrgy1'],
				$record['addrcity1'],
				$record['addrprovince1'],
				$record['business'],
				$record['faxnumber'],
				$record['fundsource'],
				$record['bdate'],
				$record['placeofbirth'],
				$record['nationality'],
				$record['gender'],
				$record['civilstatus'],
				$record['dependents'],
				$record['employername'],
				$record['jobtitle'],
				$record['occupation'],
				$record['grossincome'],
				$record['bdate2'],
				$record['tin2'],
				$record['businessphone2'],
				$record['contact2'],
				$record['emailadd2'],
				$record['employername2'],
				$record['jobtitle2'],
				$record['personal2'],
				$record['sendto'],
				$record['oldacct']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':AX'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':AX'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='prosdb.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewCustomerPaymentLedger(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Customer Payment Ledger';
		$this->data['input_control'] = 'customerpaymentledger';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getCustomerPaymentLedger(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBCustomerPaymentLedger();
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['paymentid'],
				$record['custid'],
				$record['lotid'],
				$record['lotdesc'],
				$record['lotarea'],
				$record['areacost'],
				$record['tcp'],
				$record['withhouse'],
				$record['custname'],
				$record['paydate'],
				$record['refnum'],
				$record['amount'],
				$record['interest'],
				$record['principal'],
				$record['surcharge'],
				$record['vatamnt'],
				$record['newbal'],
				$record['sundry'],
				$record['ips'],
				$record['accrdips'],
				$record['ipsnewbal'],
				$record['shares'],
				$record['contractid'],
				$record['principalpay'],
				$record['vatonprin'],
				$record['intpay'],
				$record['vatonint'],
				$record['surpay'],
				$record['vatonsur'],
				$record['sundrypay'],
				$record['vatonsundry'],
				$record['ipspay'],
				$record['vatonips'],
				$record['accrdipspay'],
				$record['vatonaccrdipspay']
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
	public function xlsCustomerPaymentLedger(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('customerpaymentledger');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    //$from = $this->input->post('date_start');
    //$to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBCustomerPaymentLedger();

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


    $this->excel->getActiveSheet()->mergeCells('A1:AI1');
    $this->excel->getActiveSheet()->getStyle('A1:AI1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:AI1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'Customer Payment Ledger');
    $this->excel->getActiveSheet()->getStyle('A2:AI2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:AI2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:AI2')->applyFromArray($styleArray4);

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
    $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AD')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AE')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AF')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AG')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AH')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('AI')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Payment ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Cust ID');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Lot ID');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Lot Description');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Lot Area');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Area Cost');
    $this->excel->getActiveSheet()->setCellValue('G2', 'TCP');
    $this->excel->getActiveSheet()->setCellValue('H2', 'With House');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Customer');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Pay Date');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Amount');
    $this->excel->getActiveSheet()->setCellValue('M2', 'Interest');
    $this->excel->getActiveSheet()->setCellValue('N2', 'Principal');
    $this->excel->getActiveSheet()->setCellValue('O2', 'Surcharge');
    $this->excel->getActiveSheet()->setCellValue('P2', 'Vat Amount');
    $this->excel->getActiveSheet()->setCellValue('Q2', 'New Balance');
    $this->excel->getActiveSheet()->setCellValue('R2', 'Sundry');
    $this->excel->getActiveSheet()->setCellValue('S2', 'IPS');
    $this->excel->getActiveSheet()->setCellValue('T2', 'Accrued IPS');
    $this->excel->getActiveSheet()->setCellValue('U2', 'IPS New Balance');
    $this->excel->getActiveSheet()->setCellValue('V2', 'Shares');
    $this->excel->getActiveSheet()->setCellValue('W2', 'Contract ID');
    $this->excel->getActiveSheet()->setCellValue('X2', 'Principal Pay');
    $this->excel->getActiveSheet()->setCellValue('Y2', 'Vat on Principal');
    $this->excel->getActiveSheet()->setCellValue('Z2', 'Interest Pay');
    $this->excel->getActiveSheet()->setCellValue('AA2', 'Vat on Interest');
    $this->excel->getActiveSheet()->setCellValue('AB2', 'Surcharge Pay');
    $this->excel->getActiveSheet()->setCellValue('AC2', 'Vat on Surcharge');
    $this->excel->getActiveSheet()->setCellValue('AD2', 'Sundry Pay');
    $this->excel->getActiveSheet()->setCellValue('AE2', 'Vat on Sundry');
    $this->excel->getActiveSheet()->setCellValue('AF2', 'IPS Pay');
    $this->excel->getActiveSheet()->setCellValue('AG2', 'Vat on IPS');
    $this->excel->getActiveSheet()->setCellValue('AH2', 'Accrued IPS Pay');
    $this->excel->getActiveSheet()->setCellValue('AI2', 'Vat on Accrued IPS Pay');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['paymentid'],
				$record['custid'],
				$record['lotid'],
				$record['lotdesc'],
				$record['lotarea'],
				$record['areacost'],
				$record['tcp'],
				$record['withhouse'],
				$record['custname'],
				$record['paydate'],
				$record['refnum'],
				$record['amount'],
				$record['interest'],
				$record['principal'],
				$record['surcharge'],
				$record['vatamnt'],
				$record['newbal'],
				$record['sundry'],
				$record['ips'],
				$record['accrdips'],
				$record['ipsnewbal'],
				$record['shares'],
				$record['contractid'],
				$record['principalpay'],
				$record['vatonprin'],
				$record['intpay'],
				$record['vatonint'],
				$record['surpay'],
				$record['vatonsur'],
				$record['sundrypay'],
				$record['vatonsundry'],
				$record['ipspay'],
				$record['vatonips'],
				$record['accrdipspay'],
				$record['vatonaccrdipspay']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':AI'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':AI'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='customerpaymentledger.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewBreakdownCollectedSales(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Breakdown Collected Sales';
		$this->data['input_control'] = 'breakdwoncollectedsales';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getBreakdownCollectedSales(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBBreakdownCollectedSales();
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['reference'],
				$record['ornumber'],
				$record['glyear'],
				$record['gltrndate'],
				$record['glacctno'],
				$record['glacctdesc'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks'],
				$record['branch'],
				$record['taxtype'],
				$record['contractid']
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
	public function xlsBreakdownCollectedSales(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('breakdowncollectedsales');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    //$from = $this->input->post('date_start');
    //$to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBBreakdownCollectedSales();

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Inventory Summary Per Warehouse');
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($styleArray4);

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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('B2', 'OR Number');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Gl Year');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Gl Account No');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Account Description');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Remarks');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Branch');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Tax Type');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Contract ID');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['reference'],
				$record['ornumber'],
				$record['glyear'],
				$record['gltrndate'],
				$record['glacctno'],
				$record['glacctdesc'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks'],
				$record['branch'],
				$record['taxtype'],
				$record['contractid']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':L'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':L'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='breakdowncollectedsales.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewPORange(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'PO Range';
		$this->data['input_control'] = 'porange';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getPORange(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBPORange($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['recordnumber'],
				$record['ponumber'],
				$record['podate'],
				$record['entrydate'],
				$record['status'],
				$record['supplierid'],
				$record['subfullname'],
				$record['branch'],
				$record['encoder'],
				$record['drdate'],
				$record['terms'],
				$record['deliveradd'],
				$record['prfnums'],
				$record['canvasser']
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
	public function xlsPORange(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('porange');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBPORange($from, $to);

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


    $this->excel->getActiveSheet()->mergeCells('A1:N1');
    $this->excel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'PO Range(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:N2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:N2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:N2')->applyFromArray($styleArray4);

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
    $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Record Number');
    $this->excel->getActiveSheet()->setCellValue('B2', 'PO Number');
    $this->excel->getActiveSheet()->setCellValue('C2', 'PO Date');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Entry Date');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Status');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Supplier ID');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Sub Fullname');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Branch');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Encoder');
    $this->excel->getActiveSheet()->setCellValue('J2', 'DR Date');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Terms');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Deliver Address');
    $this->excel->getActiveSheet()->setCellValue('M2', 'PRF Number');
    $this->excel->getActiveSheet()->setCellValue('N2', 'Canvasser');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['recordnumber'],
				$record['ponumber'],
				$record['podate'],
				$record['entrydate'],
				$record['status'],
				$record['supplierid'],
				$record['subfullname'],
				$record['branch'],
				$record['encoder'],
				$record['drdate'],
				$record['terms'],
				$record['deliveradd'],
				$record['prfnums'],
				$record['canvasser']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':N'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':N'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='porange.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewCostFactor(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Cost Factor';
		$this->data['input_control'] = 'costfactor';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getCostFactor(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBCostFactor();
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['cattitle'],
				$record['phasetitle'],
				$record['costyear'],
				$record['costlot'],
				$record['costdev'],
				$record['costid'],
				$record['projectid'],
				$record['phaseid']
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
	public function xlsCostFactor(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('costfactor');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    //$from = $this->input->post('date_start');
    //$to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBCostFactor();

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Inventory Summary Per Warehouse');
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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Category Title');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Phase Title');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Cost Year');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Cost Lot');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Cost Development');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Cost ID');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Project ID');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Phase ID');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['cattitle'],
				$record['phasetitle'],
				$record['costyear'],
				$record['costlot'],
				$record['costdev'],
				$record['costid'],
				$record['projectid'],
				$record['phaseid']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='costfactor.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewInventoryMovement(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Inventory Movement';
		$this->data['input_control'] = 'inventorymovement';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getInventoryMovement(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBInventoryMovement($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['salesdocnumber'],
				$record['transactiondate'],
				$record['entrydate'],
				$record['itemid'],
				$record['itemdescription'],
				$record['remarks'],
				$record['customername'],
				$record['transactiontype'],
				$record['activitycode'],
				$record['project'],
				$record['activitydesc'],
				$record['branch'],
				$record['companydesc'],
				$record['salesid'],
				$record['inqty'],
				$record['outqty'],
				$record['price'],
				$record['cost'],
				$record['batchnumber'],
				$record['projectcode']
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
	public function xlsInventoryMovement(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('inventorymovement');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBInventoryMovement($from, $to);

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


    $this->excel->getActiveSheet()->mergeCells('A1:T1');
    $this->excel->getActiveSheet()->getStyle('A1:T1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:T1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'Inventory Movement(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:T2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:T2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:T2')->applyFromArray($styleArray4);

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
    $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Sales Doc Number');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Entry Date');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Item ID');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Item Description');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Remarks');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Customer');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Transaction Type');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Activity Code');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Project');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Activity Description');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Branch');
    $this->excel->getActiveSheet()->setCellValue('M2', 'Company Description');
    $this->excel->getActiveSheet()->setCellValue('N2', 'Sales ID');
    $this->excel->getActiveSheet()->setCellValue('O2', 'In Qty');
    $this->excel->getActiveSheet()->setCellValue('P2', 'Out Qty');
    $this->excel->getActiveSheet()->setCellValue('Q2', 'Price');
    $this->excel->getActiveSheet()->setCellValue('R2', 'Cost');
    $this->excel->getActiveSheet()->setCellValue('S2', 'Batch Number');
    $this->excel->getActiveSheet()->setCellValue('T2', 'Project Code');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['salesdocnumber'],
				$record['transactiondate'],
				$record['entrydate'],
				$record['itemid'],
				$record['itemdescription'],
				$record['remarks'],
				$record['customername'],
				$record['transactiontype'],
				$record['activitycode'],
				$record['project'],
				$record['activitydesc'],
				$record['branch'],
				$record['companydesc'],
				$record['salesid'],
				$record['inqty'],
				$record['outqty'],
				$record['price'],
				$record['cost'],
				$record['batchnumber'],
				$record['projectcode']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':T'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':T'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='inventorymovement.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();	
	}



	public function viewInventorySummaryPerProject(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Inventory Summary Per Project';
		$this->data['input_control'] = 'inventorysummaryperproject';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getInventorySummaryPerProject(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBInventorySummaryPerProject($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['itemid'],
				$record['itemdescription'],
				$record['balance'],
				$record['price'],
				$record['totalcost'],
				$record['branch'],
				$record['companydesc'],
				$record['batchnumber'],
				$record['activitydesc']
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
	public function xlsInventorySummaryPerProject(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('inventorysummaryperproject');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBInventorySummaryPerProject($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Inventory Summary Per Project(' . $from . ' - ' . $to . ')');
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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Item ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Item Description');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Balance');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Price');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Total Cost');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Branch');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Company Description');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Batch Number');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Activity Description');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['itemid'],
				$record['itemdescription'],
				$record['balance'],
				$record['price'],
				$record['totalcost'],
				$record['branch'],
				$record['companydesc'],
				$record['batchnumber'],
				$record['activitydesc']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':I'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':I'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='inventorysummaryperproject.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewInventorySummaryPerWarehouse(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Inventory Summary Per Warehouse';
		$this->data['input_control'] = 'inventorysummaryperwarehouse';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getInventorySummaryPerWarehouse(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBInventorySummaryPerWarehouse();
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['itemid'],
				$record['itemdescription'],
				$record['balance'],
				$record['price'],
				$record['totalcost'],
				$record['branch'],
				$record['companydesc']
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
	public function xlsInventorySummaryPerWarehouse(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('inventorysummaryperwarehouse');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    //$from = $this->input->post('date_start');
    //$to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBInventorySummaryPerWarehouse();

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Inventory Summary Per Warehouse');
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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Item ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Item Description');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Balance');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Price');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Total Cost');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Branch');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Warehouse');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['itemid'],
				$record['itemdescription'],
				$record['balance'],
				$record['price'],
				$record['totalcost'],
				$record['branch'],
				$record['companydesc']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':G'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':G'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='inventorysummaryperwarehouse.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewInventoryPerProject(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Inventory Per Project';
		$this->data['input_control'] = 'inventoryperproject';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getInventoryPerProject(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBInventoryPerProject();
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['salesdocnumber'],
				$record['transactiondate'],
				$record['entrydate'],
				$record['itemid'],
				$record['itemdescription'],
				$record['remarks'],
				$record['customername'],
				$record['transactiontype'],
				$record['activitycode'],
				$record['project'],
				$record['activitydesc'],
				$record['salesid'],
				$record['inqty'],
				$record['outqty'],
				$record['price'],
				$record['cost'],
				$record['batchnumber'],
				$record['batchid'],
				$record['branch']
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
	public function xlsInventoryPerProject(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('inventoryperproject');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    //$from = $this->input->post('date_start');
    //$to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBInventoryPerProject();

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


    $this->excel->getActiveSheet()->mergeCells('A1:S1');
    $this->excel->getActiveSheet()->getStyle('A1:S1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:S1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'Inventory Per Project');
    $this->excel->getActiveSheet()->getStyle('A2:S2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:S2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:S2')->applyFromArray($styleArray4);

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
    $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Sales Doc Number');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Entry Date');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Item ID');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Item Description');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Remarks');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Customer');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Transaction Type');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Activity Code');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Project');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Activity Description');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Sales ID');
    $this->excel->getActiveSheet()->setCellValue('M2', 'In Qty');
    $this->excel->getActiveSheet()->setCellValue('N2', 'Out Qty');
    $this->excel->getActiveSheet()->setCellValue('O2', 'Price');
    $this->excel->getActiveSheet()->setCellValue('P2', 'Cost');
    $this->excel->getActiveSheet()->setCellValue('Q2', 'Batch Number');
    $this->excel->getActiveSheet()->setCellValue('R2', 'Batch ID');
    $this->excel->getActiveSheet()->setCellValue('S2', 'Branch');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['salesdocnumber'],
				$record['transactiondate'],
				$record['entrydate'],
				$record['itemid'],
				$record['itemdescription'],
				$record['remarks'],
				$record['customername'],
				$record['transactiontype'],
				$record['activitycode'],
				$record['project'],
				$record['activitydesc'],
				$record['salesid'],
				$record['inqty'],
				$record['outqty'],
				$record['price'],
				$record['cost'],
				$record['batchnumber'],
				$record['batchid'],
				$record['branch']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':S'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':S'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='inventoryperproject.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewDCRWithSundry(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'DCR - With Sundry';
		$this->data['input_control'] = 'dcrwithsundry';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getDCRWithSundry(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBDCRWithSundry($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['bookprefix'],
				$record['ornumber'],
				$record['booktransdate'],
				$record['booksubsidiary'],
				$record['gldebit'],
				$record['cashamount'],
				$record['checkamount'],
				$record['bankdepoamt'],
				$record['creditcardamt'],
				$record['bankdesc'],
				$record['checknumber'],
				$record['glremarks']
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
	public function xlsDCRWithSundry(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('dcrwithsundry');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBDCRWithSundry($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'DCR - With Sundry(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($styleArray4);

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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Book Prefix');
    $this->excel->getActiveSheet()->setCellValue('B2', 'OR Number');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Book Subsidiary');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Cash Amount');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Check Amount');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Deposit Amount');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Credit Card Amount');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Bank Description');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Check Number');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Remarks');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['bookprefix'],
				$record['ornumber'],
				$record['booktransdate'],
				$record['booksubsidiary'],
				$record['gldebit'],
				$record['cashamount'],
				$record['checkamount'],
				$record['bankdepoamt'],
				$record['creditcardamt'],
				$record['bankdesc'],
				$record['checknumber'],
				$record['glremarks']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':L'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':L'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='dcrwithsundry.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewDCRNoSundry(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'DCR - No Sundry';
		$this->data['input_control'] = 'dcrnosundry';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getDCRNoSundry(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBDCRNoSundry($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['custid'],
				$record['custname'],
				$record['ornumber'],
				$record['ordate'],
				$record['oramount'],
				$record['cashamount'],
				$record['checkamount'],
				$record['bankdepoamt'],
				$record['creditcardamt'],
				$record['bankid'],
				$record['checknumber'],
				$record['checkdate'],
				$record['bankdesc'],
				$record['collectionid'],
				$record['contractid'],
				$record['lotid'],
				$record['lotdesc']
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
	public function xlsDCRNoSundry(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('dcrnosundry');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBDCRNoSundry($from, $to);

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


    $this->excel->getActiveSheet()->mergeCells('A1:Q1');
    $this->excel->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'DCR - No Sundry(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:Q2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:Q2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:Q2')->applyFromArray($styleArray4);

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
    $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Cust ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Customer');
    $this->excel->getActiveSheet()->setCellValue('C2', 'OR Number');
    $this->excel->getActiveSheet()->setCellValue('D2', 'OR Date');
    $this->excel->getActiveSheet()->setCellValue('E2', 'OR Amount');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Cash Amount');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Check Amount');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Deposit Amount');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Credit Card Amount');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Bank ID');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Check Number');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Check Date');
    $this->excel->getActiveSheet()->setCellValue('M2', 'Bank Description');
    $this->excel->getActiveSheet()->setCellValue('N2', 'Collection ID');
    $this->excel->getActiveSheet()->setCellValue('O2', 'Contract ID');
    $this->excel->getActiveSheet()->setCellValue('P2', 'Lot ID');
    $this->excel->getActiveSheet()->setCellValue('Q2', 'Lot Description');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['custid'],
				$record['custname'],
				$record['ornumber'],
				$record['ordate'],
				$record['oramount'],
				$record['cashamount'],
				$record['checkamount'],
				$record['bankdepoamt'],
				$record['creditcardamt'],
				$record['bankid'],
				$record['checknumber'],
				$record['checkdate'],
				$record['bankdesc'],
				$record['collectionid'],
				$record['contractid'],
				$record['lotid'],
				$record['lotdesc']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':Q'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':Q'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='dcrnosundry.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}




	public function viewInputTax(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Input Tax';
		$this->data['input_control'] = 'inputtax';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getInputTax(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBInputTax($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['glacctno'],
				$record['glactivitycode'],
				$record['activitydesc'],
				$record['glacctdesc'],
				$record['glreference'],
				$record['gltrndate'],
				$record['glbookprefix'],
				$record['gldebit'],
				$record['glcredit'],
				$record['recordnum'],
				$record['glremarks']
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
	public function xlsInputTax(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('inputtax');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBInputTax($from, $to);

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


    $this->excel->getActiveSheet()->mergeCells('A1:K1');
    $this->excel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'Input Tax(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:K2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:K2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:K2')->applyFromArray($styleArray4);

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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Gl Account No');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Activity Code');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Activity Description');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Account Description');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Book Prefix');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Record Num');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Remarks');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['glacctno'],
				$record['glactivitycode'],
				$record['activitydesc'],
				$record['glacctdesc'],
				$record['glreference'],
				$record['gltrndate'],
				$record['glbookprefix'],
				$record['gldebit'],
				$record['glcredit'],
				$record['recordnum'],
				$record['glremarks']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':K'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':K'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='inputtax.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewOutputTax(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Output Tax';
		$this->data['input_control'] = 'outputtax';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getOutputTax(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBOutputTax($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['glacctno'],
				$record['glactivitycode'],
				$record['activitydesc'],
				$record['glacctdesc'],
				$record['glreference'],
				$record['gltrndate'],
				$record['glbookprefix'],
				$record['gldebit'],
				$record['glcredit'],
				$record['recordnum'],
				$record['glremarks'],
				$record['contractid'],
				$record['lotid'],
				$record['lotdesc']
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
	public function xlsOutputTax(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('outputtax');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBOutputTax($from, $to);

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


    $this->excel->getActiveSheet()->mergeCells('A1:N1');
    $this->excel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'Output Tax(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:N2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:N2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:N2')->applyFromArray($styleArray4);

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
    $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Gl Account No');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Activity Code');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Activity Description');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Account Description');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Book Prefix');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Record Num');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Remarks');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Contract ID');
    $this->excel->getActiveSheet()->setCellValue('M2', 'Lot ID');
    $this->excel->getActiveSheet()->setCellValue('N2', 'Lot Description');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['glacctno'],
				$record['glactivitycode'],
				$record['activitydesc'],
				$record['glacctdesc'],
				$record['glreference'],
				$record['gltrndate'],
				$record['glbookprefix'],
				$record['gldebit'],
				$record['glcredit'],
				$record['recordnum'],
				$record['glremarks'],
				$record['contractid'],
				$record['lotid'],
				$record['lotdesc']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':N'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':N'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='outputtax.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewAccumulatedDepreciation(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Accumulated Depreciation';
		$this->data['input_control'] = 'accumulateddepreciation';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getAccumulatedDepreciation(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBAccumulatedDepreciation();
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['glacctno'],
				$record['glactivitycode'],
				$record['activitydesc'],
				$record['glacctdesc'],
				$record['glreference'],
				$record['gltrndate'],
				$record['glbookprefix'],
				$record['gldebit'],
				$record['glcredit'],
				$record['recordnum'],
				$record['glremarks'],
				$record['booksubsidiary']
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
	public function xlsAccumulatedDepreciation(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('accumulateddepreciation');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    //$from = $this->input->post('date_start');
    //$to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBAccumulatedDepreciation();

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Accumulated Depreciation');
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($styleArray4);

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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Gl Account No');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Activity Code');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Activity Description');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Account Description');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Book Prefix');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Record Num');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Remarks');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Book Subsidiary');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['glacctno'],
				$record['glactivitycode'],
				$record['activitydesc'],
				$record['glacctdesc'],
				$record['glreference'],
				$record['gltrndate'],
				$record['glbookprefix'],
				$record['gldebit'],
				$record['glcredit'],
				$record['recordnum'],
				$record['glremarks'],
				$record['booksubsidiary']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':L'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':L'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='accumulateddepreciation.xls'; 
 
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
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'EWT';
		$this->data['input_control'] = 'ewt';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getEWT(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBEWT($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['glacctno'],
				$record['glactivitycode'],
				$record['activitydesc'],
				$record['glacctdesc'],
				$record['reference'],
				$record['gltrndate'],
				$record['gldebit'],
				$record['glcredit'],
				$record['recordnum'],
				$record['glremarks'],
				$record['booksubsidiary']
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
    $records = $this->legacy->getREMSDBEWT($from, $to);

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


    $this->excel->getActiveSheet()->mergeCells('A1:K1');
    $this->excel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'EWT(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:K2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:K2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:K2')->applyFromArray($styleArray4);

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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Gl Account No');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Activity Code');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Activity Description');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Account Description');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Record Num');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Remarks');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Book Subsidiary');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['glacctno'],
				$record['glactivitycode'],
				$record['activitydesc'],
				$record['glacctdesc'],
				$record['reference'],
				$record['gltrndate'],
				$record['gldebit'],
				$record['glcredit'],
				$record['recordnum'],
				$record['glremarks'],
				$record['booksubsidiary']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':K'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':K'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='accumulateddepreciation.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}




	public function viewLapsing(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Lapsing';
		$this->data['input_control'] = 'lapsing';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getLapsing(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBLapsing($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['glacctno'],
				$record['glacctdesc'],
				$record['reference'],
				$record['gltrndate'],
				$record['glactivitycode'],
				$record['activitytype'],
				$record['activitydesc'],
				$record['glsubcode'],
				$record['subfullname'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks'],
				$record['booksubsidiary']
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
	public function xlsLapsing(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('lapsing');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBLapsing($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Lapsing(' . $from . ' - ' . $to . ')');
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
    $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Gl Account No');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Account Description');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Activity Code');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Activity Type');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Activity Description');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Gl Subcode');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Sub Fullname');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Remarks');
    $this->excel->getActiveSheet()->setCellValue('M2', 'Book Subsidiary');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['glacctno'],
				$record['glacctdesc'],
				$record['reference'],
				$record['gltrndate'],
				$record['glactivitycode'],
				$record['activitytype'],
				$record['activitydesc'],
				$record['glsubcode'],
				$record['subfullname'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks'],
				$record['booksubsidiary']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':M'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':M'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='lapsing.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewInventory17081(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Inventory 17081';
		$this->data['input_control'] = 'inventory17081';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getInventory17081(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBInventory17081($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['glacctno'],
				$record['reference'],
				$record['gltrndate'],
				$record['glactivitycode'],
				$record['activitytype'],
				$record['activitydesc'],
				$record['glsubcode'],
				$record['subfullname'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks'],
				$record['booksubsidiary']
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
	public function xlsInventory17081(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('inventory17081');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBInventory17081($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Inventory 17081(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($styleArray4);

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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Gl Account No');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Activity Code');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Activity Type');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Activity Description');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Gl Subcode');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Sub Fullname');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Remarks');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Book Subsidiary');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['glacctno'],
				$record['reference'],
				$record['gltrndate'],
				$record['glactivitycode'],
				$record['activitytype'],
				$record['activitydesc'],
				$record['glsubcode'],
				$record['subfullname'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks'],
				$record['booksubsidiary']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':L'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':L'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='inventory17081.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewCheckVoucher(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Check Voucher';
		$this->data['input_control'] = 'checkvoucher';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getCheckVoucher(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBCheckVoucher($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['gltrndate'],
				$record['reference'],
				$record['checknumber'],
				$record['amount'],
				$record['payee'],
				$record['glremarks'],
				$record['glacctno'],
				$record['subfullname'],
				$record['checkdate']
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
	public function xlsCheckVoucher(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('checkvoucher');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBCheckVoucher($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Check Voucher(' . $from . ' - ' . $to . ')');
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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Check Number');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Amount');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Payee');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Remarks');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Gl Account No');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Sub Fullname');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Check Date');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['gltrndate'],
				$record['reference'],
				$record['checknumber'],
				$record['amount'],
				$record['payee'],
				$record['glremarks'],
				$record['glacctno'],
				$record['subfullname'],
				$record['checkdate']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':I'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':I'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='checkvoucher.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewRR152010(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'RR-15-2010';
		$this->data['input_control'] = 'rr152010';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getRR152010(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBRR152010($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['glacctno'],
				$record['glactivitycode'],
				$record['glsubcode'],
				$record['gltrndate'],
				$record['gldebit'],
				$record['glcredit'],
				$record['reference'],
				$record['glremarks'],
				$record['subfullname'],
				$record['booksubsidiary'],
				$record['activitydesc'],
				$record['activitytype']
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
	public function xlsRR152010(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('rr152010');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBRR152010($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'RR-15-2010(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($styleArray4);

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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Gl Account No');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Activity Code');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Gl Subcode');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Remarks');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Sub Fullname');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Book Subsidiary');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Activity Description');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Activity Type');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['glacctno'],
				$record['glactivitycode'],
				$record['glsubcode'],
				$record['gltrndate'],
				$record['gldebit'],
				$record['glcredit'],
				$record['reference'],
				$record['glremarks'],
				$record['subfullname'],
				$record['booksubsidiary'],
				$record['activitydesc'],
				$record['activitytype']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':L'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':L'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='rr152010.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewBankRecon(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Bank Recon';
		$this->data['input_control'] = 'bankrecon';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getBankRecon(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBBankRecon($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['gltrndate'],
				$record['reference'],
				$record['checknumber'],
				$record['payee'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks'],
				$record['glacctno'],
				$record['subfullname'],
				$record['checkdate']
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
	public function xlsBankRecon(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('bankrecon');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBBankRecon($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Bank Recon(' . $from . ' - ' . $to . ')');
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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Check Number');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Payee');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Remarks');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Gl Account No');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Sub Fullname');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Check Date');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['gltrndate'],
				$record['reference'],
				$record['checknumber'],
				$record['payee'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks'],
				$record['glacctno'],
				$record['subfullname'],
				$record['checkdate']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':J'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':J'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='bankrecon.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewReservationListing(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Reservation Listing';
		$this->data['input_control'] = 'reservationlisting';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getReservationListing(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBReservationListing($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['contractid'],
				$record['contractdate'],
				$record['description'],
				$record['lotdesc'],
				$record['lotarea'],
				$record['areacost'],
				$record['tcp'],
				$record['custname']
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
	public function xlsReservationListing(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('reservationlisting');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBReservationListing($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Reservation Listing(' . $from . ' - ' . $to . ')');
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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Contract ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Contract Date');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Description');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Lot Description');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Lot Area');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Area Cost');
    $this->excel->getActiveSheet()->setCellValue('G2', 'TCP');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Customer');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['contractid'],
				$record['contractdate'],
				$record['description'],
				$record['lotdesc'],
				$record['lotarea'],
				$record['areacost'],
				$record['tcp'],
				$record['custname']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':H'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='reservationlisting.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewMRISIssuance(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'MRIS Issuance';
		$this->data['input_control'] = 'mrisissuance';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getMRISIssuance(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBMRISIssuance($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['salesdocnumber'],
				$record['transactiondate'],
				$record['entrydate'],
				$record['itemid'],
				$record['itemdescription'],
				$record['remarks'],
				$record['customername'],
				$record['transactiontype'],
				$record['activitycode'],
				$record['project'],
				$record['acitivitydesc'],
				$record['batchnumber'],
				$record['batchid'],
				$record['branch']
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
	public function xlsMRISIssuance(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('mrisissuance');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBMRISIssuance($from, $to);

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


    $this->excel->getActiveSheet()->mergeCells('A1:N1');
    $this->excel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'MRIS Issuance(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:N2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:N2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:N2')->applyFromArray($styleArray4);

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
    $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Sales Doc Number');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Entry Date');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Item ID');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Item Description');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Remarks');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Customer Name');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Transaction Type');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Acitivity Code');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Project');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Activity Description');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Batch Number');
    $this->excel->getActiveSheet()->setCellValue('M2', 'Batch ID');
    $this->excel->getActiveSheet()->setCellValue('N2', 'Branch');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['salesdocnumber'],
				$record['transactiondate'],
				$record['entrydate'],
				$record['itemid'],
				$record['itemdescription'],
				$record['remarks'],
				$record['customername'],
				$record['transactiontype'],
				$record['activitycode'],
				$record['project'],
				$record['acitivitydesc'],
				$record['batchnumber'],
				$record['batchid'],
				$record['branch']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':N'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':N'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='mrisissuance.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewDMCMEntry(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'DMCM Entry';
		$this->data['input_control'] = 'dmcmentry';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getDMCMEntry(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBDMCMEntry($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['glbookid'],
				$record['glbookprefix'],
				$record['glrefnum'],
				$record['gltrndate'],
				$record['glacctno'],
				$record['glacctdesc'],
				$record['glsubcode'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks'],
				$record['branch']
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
	public function xlsDMCMEntry(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('dmcmentry');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBDMCMEntry($from, $to);

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


    $this->excel->getActiveSheet()->mergeCells('A1:K1');
    $this->excel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'DMCM Entry(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:K2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:K2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:K2')->applyFromArray($styleArray4);

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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Book ID');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Book Prefix');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Gl Account No');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Account Description');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Gl Subcode');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Remarks');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Branch');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['glbookid'],
				$record['glbookprefix'],
				$record['glrefnum'],
				$record['gltrndate'],
				$record['glacctno'],
				$record['glacctdesc'],
				$record['glsubcode'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks'],
				$record['branch']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':K'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':K'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='dmcmentry.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewCollectionEntry(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Collection Entry';
		$this->data['input_control'] = 'collectionentry';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getCollectionEntry(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBCollectionEntry($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['glbookprefix'],
				$record['glrefnum'],
				$record['gltrndate'],
				$record['glactivitycode'],
				$record['glacctno'],
				$record['glacctdesc'],
				$record['glsubcode'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks'],
				$record['glentryby']
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
	public function xlsCollectionEntry(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('collectionentry');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBCollectionEntry($from, $to);

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


    $this->excel->getActiveSheet()->mergeCells('A1:K1');
    $this->excel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($styleArray4);
    $this->excel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->setCellValue('A1', 'Collection Entry(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:K2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:K2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:K2')->applyFromArray($styleArray4);

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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Book Prefix');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Activity Code');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Gl Account No');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Account Description');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Gl Subcode');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Remarks');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Entry By');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['glbookprefix'],
				$record['glrefnum'],
				$record['gltrndate'],
				$record['glactivitycode'],
				$record['glacctno'],
				$record['glacctdesc'],
				$record['glsubcode'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks'],
				$record['glentryby']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':K'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':K'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='collectionentry.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewDepartmentExpenses(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Department Expenses';
		$this->data['input_control'] = 'departmentexpenses';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getDepartmentExpenses(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBDepartmentExpenses($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['activitydesc'],
				$record['glactivitycode'],
				$record['glacctno'],
				$record['glacctdesc'],
				$record['glreference'],
				$record['gltrndate'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks']
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
	public function xlsDepartmentExpenses(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('departmentexpenses');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBDepartmentExpenses($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Department Expenses Report(' . $from . ' - ' . $to . ')');
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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Activity Description');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Activity Code');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Gl Account No');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Account Description');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Remarks');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['activitydesc'],
				$record['glactivitycode'],
				$record['glacctno'],
				$record['glacctdesc'],
				$record['glreference'],
				$record['gltrndate'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':I'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':I'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='departmentexpenses.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewCIP(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'CIP';
		$this->data['input_control'] = 'cip';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getCIP(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBCIP($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['glacctno'],
				$record['reference'],
				$record['trndate'],
				$record['glactivitycode'],
				$record['activitytype'],
				$record['activitydesc'],
				$record['glsubcode'],
				$record['subfullname'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks'],
				$record['booksubsidiary']
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
	public function xlsCIP(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('cip');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    $records = $this->legacy->getREMSDBCIP($from, $to);

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
    $this->excel->getActiveSheet()->setCellValue('A1', 'CIP Report(' . $from . ' - ' . $to . ')');
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '33FFE9'))));
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($styleArray);
    $this->excel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($styleArray4);

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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Gl Account No');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Transaction Date');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Activity Code');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Activity Type');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Activity Description');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Gl Subcode');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Sub Fullname');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('J2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Remarks');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Book Subsidiary');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['glacctno'],
				$record['reference'],
				$record['trndate'],
				$record['glactivitycode'],
				$record['activitytype'],
				$record['activitydesc'],
				$record['glsubcode'],
				$record['subfullname'],
				$record['gldebit'],
				$record['glcredit'],
				$record['glremarks'],
				$record['booksubsidiary']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':L'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':L'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='cip.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}



	public function viewUnbalancedEntries(){
		$this->data['content'] = 'legacy_view';
		$this->data['page_title'] = 'Unbalanced Entries';
		$this->data['input_control'] = 'unbalancedentries';

		if (isset($this->session->userdata['logged_in'])) {
			$this->load->view('default/index', $this->data);
		}
	}
	public function getUnbalancedEntries(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$records = $this->legacy->getREMSDBUnbalancedEntries($this->input->post('date_start'), $this->input->post('date_end'));
		$data = array();
		foreach ($records->result_array() as $record) {
			$data[] = array(
				$record['glbookprefix'],
				$record['glrefnum'],
				$record['debit'],
				$record['credit'],
				$record['difference'],
				$record['booksubsidiary'],
				$record['booktransdate']
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
	public function xlsUnbalancedEntries(){
		set_time_limit(0);
		ini_set('memory_limit', '1G');
		$this->load->helper('date');
    $this->load->library('Excel', NULL, 'excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('unbalancedentries');
    $this->excel->setActiveSheetIndex(0);

    //$this->input->post('date_start'), $this->input->post('date_end')
    $from = $this->input->post('date_start');
    $to   = $this->input->post('date_end');
    var_dump($from);
    
    //$from = '2017-01-01';
    //$to = '2017-01-15';
    $records = $this->legacy->getREMSDBUnbalancedEntries($from, $to);
    //var_dump($records);
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
    $this->excel->getActiveSheet()->setCellValue('A1', 'Unbalanced Entries Report(' . $from . ' - ' . $to . ')');
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

    $this->excel->getActiveSheet()->setCellValue('A2', 'Book Prefix');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Reference');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Debit');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Credit');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Differece');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Book Subsidiary');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Transaction Date');

    $r = 3;
    foreach ($records->result_array() as $record) {
     	$this->excel->getActiveSheet()->fromArray(array(
     		$record['glbookprefix'],
				$record['glrefnum'],
				$record['debit'],
				$record['credit'],
				$record['difference'],
				$record['booksubsidiary'],
				$record['booktransdate']
     	), null, 'A'.$r);
      $this->excel->getActiveSheet()->getStyle('A'.$r.':G'.$r)->applyFromArray($styleArray2); 
      $this->excel->getActiveSheet()->getStyle('A'.$r.':G'.$r)->applyFromArray($styleArray4);
     	$r++;
    }

    date_default_timezone_set("Asia/Manila");
    $timestamp=date("Y-m-d-His");
    $filename='unbalancedentries.xls'; 
 
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$filename.'"'); 
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // $writer->save('/var/www/html/reports/' . $filename); sa Server
    $writer->save('../irm/reports/' . $filename);

    exit();
	}

	public function migrate_rescust(){
		set_time_limit(0);
		$this->db->trans_start();
		$records = $this->legacy->getLegacyResCust();
		foreach ($records as $record) {
			$holder = '';
			$code = '';

			for ($i=0; $i < strlen($record['CustName']); $i++) { 
				if(substr($record['CustName'], $i,1) == '*'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '['){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i-2 );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == 'S' 
					and substr($record['CustName'], $i+1,1) == 'T'
					and substr($record['CustName'], $i+2,1) == '/'){
					$code = 'ST'.substr($record['CustName'], $i+3,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == 'X' 
					and substr($record['CustName'], $i+1,1) == 'V'
					and substr($record['CustName'], $i+2,1) == '/'){
					$code = 'XV'.substr($record['CustName'], $i+3,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == 'X' 
					and substr($record['CustName'], $i+1,1) == 'E'
					and substr($record['CustName'], $i+2,1) == '/'){
					$code = 'XE'.substr($record['CustName'], $i+3,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == 'X' 
					and substr($record['CustName'], $i+1,1) == 'E'
					and substr($record['CustName'], $i+2,1) == '-'){
					$code = substr($record['CustName'], $i,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == 'W' 
					and substr($record['CustName'], $i+1,1) == 'H'
					and substr($record['CustName'], $i+2,1) == '-'){
					$code = substr($record['CustName'], $i,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == 'X' 
					and substr($record['CustName'], $i+1,1) == 'E'
					and substr($record['CustName'], $i+2,1) == ' '
					and substr($record['CustName'], $i+3,1) == '/'){
					$code = 'XE'.substr($record['CustName'], $i+4,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == 'T' 
					and substr($record['CustName'], $i+1,1) == 'W'
					and substr($record['CustName'], $i+2,1) == '/'){
					$code = 'TW'.substr($record['CustName'], $i+3,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == 'T' 
					and substr($record['CustName'], $i+1,1) == 'W'
					and substr($record['CustName'], $i+2,1) == ' '
					and substr($record['CustName'], $i+3,1) == '/'){
					$code = 'TW'.substr($record['CustName'], $i+4,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == 'C' 
					and substr($record['CustName'], $i+1,1) == 'R'
					and substr($record['CustName'], $i+2,1) == 'E'
					and substr($record['CustName'], $i+3,1) == '/'){
					$code = 'CRE'.substr($record['CustName'], $i+4,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == 'M' 
					and substr($record['CustName'], $i+1,1) == 'V'
					and substr($record['CustName'], $i+2,1) == 'H'
					and substr($record['CustName'], $i+3,1) == '/'){
					$code = 'MVH'.substr($record['CustName'], $i+4,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == 'M' 
					and substr($record['CustName'], $i+1,1) == 'V'
					and substr($record['CustName'], $i+2,1) == 'H'
					and substr($record['CustName'], $i+3,1) == ' '
					and substr($record['CustName'], $i+4,1) == '/'){
					$code = 'MVH'.substr($record['CustName'], $i+5,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'X'
					and substr($record['CustName'], $i+2,1) == 'E'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'X'
					and substr($record['CustName'], $i+2,1) == 'V'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'X'
					and substr($record['CustName'], $i+2,1) == 'H'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'V'
					and substr($record['CustName'], $i+2,1) == 'E'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'V'
					and substr($record['CustName'], $i+2,1) == 'L'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'V'
					and substr($record['CustName'], $i+2,1) == 'R'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'T'
					and substr($record['CustName'], $i+2,1) == 'W'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'W'
					and substr($record['CustName'], $i+2,1) == 'H'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'S'
					and substr($record['CustName'], $i+2,1) == 'T'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'B'
					and substr($record['CustName'], $i+2,1) == ':'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'B'
					and substr($record['CustName'], $i+2,1) == '('){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'B'
					and substr($record['CustName'], $i+3,1) == '('){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'B'
					and substr($record['CustName'], $i+2,1) == 'l'
					and substr($record['CustName'], $i+3,1) == 'k'){
					$code = "B".substr($record['CustName'], $i+4,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'P'
					and substr($record['CustName'], $i+2,1) == '('){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'A'
					and substr($record['CustName'], $i+2,1) == 'P'
					and substr($record['CustName'], $i+3,1) == 'R'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'C'
					and substr($record['CustName'], $i+2,1) == 'R'
					and substr($record['CustName'], $i+3,1) == 'E'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'M'
					and substr($record['CustName'], $i+2,1) == 'V'
					and substr($record['CustName'], $i+3,1) == 'H'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'P'
					and substr($record['CustName'], $i+2,1) == 'H'
					and substr($record['CustName'], $i+3,1) == 'E'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'P'
					and substr($record['CustName'], $i+2,1) == 'T'
					and substr($record['CustName'], $i+3,1) == 'W'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'T'
					and substr($record['CustName'], $i+2,1) == 'a'
					and substr($record['CustName'], $i+3,1) == 'n'
					and substr($record['CustName'], $i+4,1) == 'a'
					and substr($record['CustName'], $i+5,1) == 'y'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and intval(substr($record['CustName'], $i+1,1)) != 0){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'P'
					and intval(substr($record['CustName'], $i+2,1)) != 0){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'B'
					and intval(substr($record['CustName'], $i+2,1)) != 0){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'S'
					and substr($record['CustName'], $i+3,1) == 'T'){
					$code = substr($record['CustName'], $i+2,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'T'
					and substr($record['CustName'], $i+3,1) == 'W'){
					$code = substr($record['CustName'], $i+2,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'X'
					and substr($record['CustName'], $i+3,1) == 'V'){
					$code = substr($record['CustName'], $i+2,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'X'
					and substr($record['CustName'], $i+3,1) == 'E'){
					$code = substr($record['CustName'], $i+2,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'X'
					and substr($record['CustName'], $i+3,1) == 'H'){
					$code = substr($record['CustName'], $i+2,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'W'
					and substr($record['CustName'], $i+3,1) == 'H'){
					$code = substr($record['CustName'], $i+2,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'V'
					and substr($record['CustName'], $i+3,1) == 'E'){
					$code = substr($record['CustName'], $i+2,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'V'
					and substr($record['CustName'], $i+3,1) == 'L'){
					$code = substr($record['CustName'], $i+2,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'A'
					and substr($record['CustName'], $i+3,1) == 'P'
					and substr($record['CustName'], $i+4,1) == 'R'){
					$code = substr($record['CustName'], $i+2,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'M'
					and substr($record['CustName'], $i+3,1) == 'V'
					and substr($record['CustName'], $i+4,1) == 'H'){
					$code = substr($record['CustName'], $i+2,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'C'
					and substr($record['CustName'], $i+3,1) == 'R'
					and substr($record['CustName'], $i+4,1) == 'E'){
					$code = substr($record['CustName'], $i+2,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'S'
					and substr($record['CustName'], $i+3,1) == 't'
					and substr($record['CustName'], $i+4,1) == '.'){
					$code = substr($record['CustName'], $i+2,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'B'
					and substr($record['CustName'], $i+2,1) == 'L'
					and substr($record['CustName'], $i+3,1) == 'O'
					and substr($record['CustName'], $i+4,1) == 'C'
					and substr($record['CustName'], $i+5,1) == 'K'){
					$code = "B".substr($record['CustName'], $i+6,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'B'
					and substr($record['CustName'], $i+3,1) == 'L'
					and substr($record['CustName'], $i+4,1) == 'O'
					and substr($record['CustName'], $i+5,1) == 'C'
					and substr($record['CustName'], $i+6,1) == 'K'){
					$code = "B".substr($record['CustName'], $i+7,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == 'P'
					and substr($record['CustName'], $i+2,1) == 'H'
					and substr($record['CustName'], $i+3,1) == 'A'
					and substr($record['CustName'], $i+4,1) == 'S'
					and substr($record['CustName'], $i+5,1) == 'E'){
					$code = "P".substr($record['CustName'], $i+6,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'P'
					and intval(substr($record['CustName'], $i+3,1)) != 0){
					$code = substr($record['CustName'], $i+2,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '/' 
					and substr($record['CustName'], $i+1,1) == ' '
					and substr($record['CustName'], $i+2,1) == 'B'
					and intval(substr($record['CustName'], $i+3,1)) != 0){
					$code = substr($record['CustName'], $i+2,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '(' 
					and substr($record['CustName'], $i+1,1) == 'T'
					and substr($record['CustName'], $i+2,1) == 'W'
					and substr($record['CustName'], $i+3,1) == ')'){
					$code = "TW B".substr($record['CustName'], $i+10,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '(' 
					and substr($record['CustName'], $i+1,1) == 'S'
					and substr($record['CustName'], $i+2,1) == 'T'
					and substr($record['CustName'], $i+3,1) == ')'){
					$code = "ST B".substr($record['CustName'], $i+10,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == ' ' 
					and substr($record['CustName'], $i+1,1) == 'V'
					and substr($record['CustName'], $i+2,1) == 'L'
					and substr($record['CustName'], $i+3,1) == ' '){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == ' ' 
					and substr($record['CustName'], $i+1,1) == 'T'
					and substr($record['CustName'], $i+2,1) == 'W'
					and substr($record['CustName'], $i+3,1) == ' '){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == ' ' 
					and substr($record['CustName'], $i+1,1) == 'X'
					and substr($record['CustName'], $i+2,1) == 'V'
					and substr($record['CustName'], $i+3,1) == ' '){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == ' ' 
					and substr($record['CustName'], $i+1,1) == 'X'
					and substr($record['CustName'], $i+2,1) == 'E'
					and substr($record['CustName'], $i+3,1) == ' '){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == ' ' 
					and substr($record['CustName'], $i+1,1) == 'W'
					and substr($record['CustName'], $i+2,1) == 'H'
					and substr($record['CustName'], $i+3,1) == ' '){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == ' ' 
					and substr($record['CustName'], $i+1,1) == 'M'
					and substr($record['CustName'], $i+2,1) == 'V'
					and substr($record['CustName'], $i+3,1) == 'H'
					and substr($record['CustName'], $i+4,1) == ' '){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == ' ' 
					and substr($record['CustName'], $i+1,1) == 'A'
					and substr($record['CustName'], $i+2,1) == 'P'
					and substr($record['CustName'], $i+3,1) == 'R'
					and substr($record['CustName'], $i+4,1) == ' '){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == ' ' 
					and substr($record['CustName'], $i+1,1) == 'B'
					and substr($record['CustName'], $i+2,1) == 'L'
					and substr($record['CustName'], $i+3,1) == 'O'
					and substr($record['CustName'], $i+4,1) == 'C'
					and substr($record['CustName'], $i+5,1) == 'K'){
					$code = "B".substr($record['CustName'], $i+6,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == ' ' 
					and substr($record['CustName'], $i+1,1) == 'S'
					and substr($record['CustName'], $i+2,1) == 'T'
					and substr($record['CustName'], $i+3,1) == ' '
					and substr($record['CustName'], $i+4,1) == 'B'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == ' ' 
					and substr($record['CustName'], $i+1,1) == 'C'
					and substr($record['CustName'], $i+2,1) == 'R'
					and substr($record['CustName'], $i+3,1) == 'E'
					and substr($record['CustName'], $i+4,1) == ' '
					and substr($record['CustName'], $i+5,1) == 'B'){
					$code = substr($record['CustName'], $i+1,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == 'T' 
					and substr($record['CustName'], $i+1,1) == 'W'
					and substr($record['CustName'], $i+2,1) == 'B'){
					$code = substr($record['CustName'], $i,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == 'V' 
					and substr($record['CustName'], $i+1,1) == 'E'
					and substr($record['CustName'], $i+2,1) == ' '
					and substr($record['CustName'], $i+3,1) == 'B'){
					$code = substr($record['CustName'], $i,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == 'B' 
					and intval(substr($record['CustName'], $i+1,1)) != 0){
					$code = substr($record['CustName'], $i,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == 'P' 
					and intval(substr($record['CustName'], $i+1,1)) != 0){
					$code = substr($record['CustName'], $i,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
				if(substr($record['CustName'], $i,1) == '-' 
					and substr($record['CustName'], $i+1,1) == 'L'
					and intval(substr($record['CustName'], $i+2,1)) != 0){
					$code = substr($record['CustName'], $i,strlen($record['CustName'])-$i );
					$holder = substr($record['CustName'], 0, $i);
					break;
				}
			}//end for loop
			if (empty($holder)) {
				$holder = $record['CustName'];
			}

			$clientinfo = array(
				'client_type_id' => '',
				'reference_id' 	=> '',
				'date_created' => '',
				'status_id' => 1,
				'subsidiary_code' => '',
				'legacy_custid' => $record['CustID'],
				'peachtree_customerid' => ''
			);

			if (substr_count($holder, 'Adjustment') == 0 
				and substr_count($holder, 'From CAINTA') == 0
				and substr_count($holder, 'For Verification') == 0
				and substr_count($holder, 'SAMPLE FOR JV') == 0
				and substr_count($holder, 'Binu Ang') == 0
				and substr_count($holder, 'Binu Angg') == 0
				and substr_count($holder, 'Others') == 0) {
				if ($this->legacy->checkCompany($holder)) {
					$clientinfo['client_type_id'] = 2;
			
					//---------------- ORGANIZATION
					$organizationinfo = array(
						'organization_name' 	=> $holder,
						'tin' 								=> $record['TIN'],
						'special_instruction' => '',
						'status_id' 					=> 1
					);
					$organization = $this->legacy->findOrganization($holder);
					if (!$organization) {
						$clientinfo['reference_id'] = $this->legacy->insertOrganization($organizationinfo);
					} else {
						$clientinfo['reference_id'] = $organization['organization_id'];
						
						$organizationinfo['tin'] = ($organization['tin']) ? $organization['tin'] : $record['TIN'];
						$organizationinfo['special_instruction'] = ($organization['special_instruction']) ? $organization['special_instruction'] : '';
						$this->legacy->updateOrganization($organizationinfo, $organization['organization_id']);
					}

					//----------------- ORGANIZATION_ACCOUNT
					$organization_partnerinfo = array(
						'organization_account_id' => '',
						'organization_id' 				=> $clientinfo['reference_id'],
						'person_id' 							=> '',
						'status_id' 							=> 1
					);

					$organization_accountinfo = array(
						'organization_id' => $clientinfo['reference_id'],
						'contract_id' 		=> '',
						'account' 				=> $code,
						'status_id' 			=> 1
					);
					
					$organization_account = $this->legacy->findOrganizationAccount($clientinfo['reference_id'], $code);
					if (!$organization_account) {
							$organization_partnerinfo['organization_account_id'] = $this->legacy->insertOrganizationAccount($organization_accountinfo);
					} else {
						$organization_partnerinfo['organization_account_id'] = $organization_account['organization_account_id'];
					}
					

					//--------------- ORGANIZATION_ADDRESS
					$organization_addressinfo = array(
						'organization_id' => '',
						'address_id'			=> '',
						'status_id'				=> 1
					);
					$addressinfo = array(
						'line_1' 					=> $record['AddrStreet'],
						'line_2' 					=> $record['AddrBrgy'],
						'line_3' 					=> '',
						'city_id' 				=> '',
						'province_id' 		=> 0,
						'postal_code' 		=> '',
						'country_id' 			=> '',
						'address_type_id' => ''
					);
					$organization_address = $this->legacy->findOrganizationAddress($clientinfo['reference_id']);
					if (!$organization_address) {

						$city = $this->legacy->eraseDoubleSpace($record['AddrCity']);
						$city = $this->legacy->renameCity($city);
						$city = $this->legacy->findCity($city);
						if ($record['AddrCity'] and !$city) {
							$addressinfo['line_3'] = $record['AddrCity'];
						} else {
							$addressinfo['city_id'] = $city['address_city_id'];
						}

						$province = $this->legacy->eraseDoubleSpace($record['AddrProvince']);
						$province = $this->legacy->renameProvince($province);
						$province = $this->legacy->findProvince($province);
						if ($record['AddrProvince'] and !$province) {
							$addressinfo['line_3'] = $addressinfo['line_3'].'/'.$record['AddrProvince'];
						} else {
							$addressinfo['province_id'] = $province['address_province_id'];
						}

						$organization_addressinfo['organization_id'] = $clientinfo['reference_id'];
						$organization_addressinfo['address_id'] = $this->legacy->insertAddress($addressinfo);
						$this->legacy->insertOrganizationAddress($organization_addressinfo);
					} 
					

					//-------------- ORGANIZATION_CONTACT
					$organization_contactinfo = array(
						'organization_id' => $clientinfo['reference_id'],
						'contact_id' 			=> '',
						'status_id'				=> 1
					);
					$contactinfo = array(
						'person_id' 			=> '',
						'contact_type_id' => '',
						'contact_value' 	=> '',
						'status_id' 			=> 1
					);
					if ($record['ContactNumber']) {
						$contactinfo['contact_type_id'] = 2;
						$contactinfo['contact_value']		= $record['ContactNumber'];

						if (!$this->legacy->findOrganizationContactValue($clientinfo['reference_id'], $contactinfo['contact_value'])) {
							$organization_contactinfo['contact_id'] = $this->legacy->insertContact($contactinfo);
							$this->legacy->insertOrganizationContact($organization_contactinfo);
						}
					}

					if ($record['EmailAdd']) {
						$contactinfo['contact_type_id'] = 4;
						$contactinfo['contact_value'] = $record['EmailAdd'];

						if (!$this->legacy->findOrganizationContactValue($clientinfo['reference_id'], $contactinfo['contact_value'])) {
							$organization_contactinfo['contact_id'] = $this->legacy->insertContact($contactinfo);
							$this->legacy->insertOrganizationContact($organization_contactinfo);
						}
					}

					if ($record['Business']) {
						$contactinfo['contact_type_id'] = 2;
						$contactinfo['contact_value'] = $record['Business'];

						if (!$this->legacy->findOrganizationContactValue($clientinfo['reference_id'], $contactinfo['contact_value'])) {
							$organization_contactinfo['contact_id'] = $this->legacy->insertContact($contactinfo);
							$this->legacy->insertOrganizationContact($organization_contactinfo);
						}
					}

					if ($record['FaxNumber']) {
						$contactinfo['contact_type_id'] = 5;
						$contactinfo['contact_value'] = $record['FaxNumber'];

						if (!$this->legacy->findOrganizationContactValue($clientinfo['reference_id'], $contactinfo['contact_value'])) {
							$organization_contactinfo['contact_id'] = $this->legacy->insertContact($contactinfo);
							$this->legacy->insertOrganizationContact($organization_contactinfo);
						}	
					}


					//----------ORGANIZATION PARTNER
					if ($record['CPName']) {
						$partner = $record['CPName'];
						if (substr_count($partner, 'N/A') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'N/A'))).trim(substr($partner, strpos($partner, 'N/A')+3, strlen($partner)-strpos($partner, 'N/A')-3)); 
						}
						if (substr_count($partner, 'c/o') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'c/o'))).trim(substr($partner, strpos($partner, 'c/o')+3, strlen($partner)-strpos($partner, 'c/o')-3));
						}
						if (substr_count($partner, 'C/O') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'C/O'))).trim(substr($partner, strpos($partner, 'C/O')+3, strlen($partner)-strpos($partner, 'C/O')-3));
						}
						if (substr_count($partner, 'Represented by:') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'Represented by:'))).trim(substr($partner, strpos($partner, 'Represented by:')+15, strlen($partner)-strpos($partner, 'Represented by:')-15));
						}
						if (substr_count($partner, 'REPRESENTED BY:') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'REPRESENTED BY:'))).trim(substr($partner, strpos($partner, 'REPRESENTED BY:')+15, strlen($partner)-strpos($partner, 'REPRESENTED BY:')-15));
						}
						if (substr_count($partner, 'REPRESENTED BY') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'REPRESENTED BY'))).trim(substr($partner, strpos($partner, 'REPRESENTED BY')+14, strlen($partner)-strpos($partner, 'REPRESENTED BY')-14));
						}
						if (substr_count($partner, 'REPRESETED BY:') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'REPRESETED BY:'))).trim(substr($partner, strpos($partner, 'REPRESETED BY:')+14, strlen($partner)-strpos($partner, 'REPRESETED BY:')-14));
						}
						if (substr_count($partner, 'REP. BY:') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'REP. BY:'))).trim(substr($partner, strpos($partner, 'REP. BY:')+8, strlen($partner)-strpos($partner, 'REP. BY:')-8));
						}
						if (substr_count($partner, 'REP BY:') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'REP BY:'))).trim(substr($partner, strpos($partner, 'REP BY:')+7, strlen($partner)-strpos($partner, 'REP BY:')-7));
						}
						if (substr_count($partner, 'CHAIRMAN,') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'CHAIRMAN,'))).trim(substr($partner, strpos($partner, 'CHAIRMAN,')+9, strlen($partner)-strpos($partner, 'CHAIRMAN,')-9));
						}
			

						if(substr_count(strtolower($partner), 'mr.') > 0 ){
							$pos = strpos(strtolower($partner), 'mr.');
 							$partner = trim(substr($partner, 0, $pos).substr($partner, $pos+3,strlen($partner)-$pos+3));
						}
						if(substr_count(strtolower($partner), 'mrs.') > 0){
							$pos = strpos(strtolower($partner), 'mrs.');
							$partner = trim(substr($partner, 0, $pos).substr($partner, $pos+4,strlen($partner)-$pos+4));
						}
						if(substr_count(strtolower($partner), 'sps.') > 0){
							$pos = strpos(strtolower($partner), 'sps.');
							$partner = trim(substr($partner, 0, $pos).substr($partner, $pos+4,strlen($partner)-$pos+4));
						}

						$lastname = '';
						$firstname = '';
						$middlename = '';
						$suffix = '';
						$prefix = '';
						$char = [];
						$charpos = [];
						$partner = $this->legacy->eraseDoubleSpace($partner);
						for ($i=0; $i < strlen($partner); $i++) { 
							switch (substr($partner, $i,1)) {
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
									if (substr($partner, $i-1,1) == ',' or 
										substr($partner, $i-1,1) == '(' or 
										substr($partner, $i-1,1) == '-' or 
										substr($partner, $i-1,1) == '.' or 
										substr($partner, $i-1,1) == '/' or 
										substr($partner, $i-1,1) == '&' or 
										substr($partner, $i+1,1) == ',' or
										substr($partner, $i+1,1) == '(' or 
										substr($partner, $i+1,1) == '-' or
										substr($partner, $i+1,1) == '.' or 
										substr($partner, $i+1,1) == '/' or 
										substr($partner, $i+1,1) == '&'){

									} else{
										array_push($char, ' ');
										array_push($charpos, $i);
									}	
								break;	
							}
						}
						switch (sizeof($char)) {
							case 1:
								if ($char[0] == ' ') {
									$lastname = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));
									$firstname = trim(substr($partner, 0, $charpos[0]));
								} elseif ($char[0] == ',') {
									$lastname = trim(substr($partner, 0, $charpos[0]));
									$firstname = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));
								}
							break;
							case 2:
								if ($char[0] == ' ' and $char[1] == ' ') {
									$lastname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
									$firstname = trim(substr($partner, 0, $charpos[1]));
								} elseif ($char[0] == ' ' and $char[1] == '.') {
									$lastname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
									$firstname = trim(substr($partner, 0, $charpos[0]));
									$middlename = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
								} elseif ($char[0] == ',' and $char[1] == '.') {
									$lastname = trim(substr($partner, 0, $charpos[0]));
									$firstname = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));
								} elseif ($char[0] == ',' and $char[1] == ' ') {
									$lastname = trim(substr($partner, 0, $charpos[0]));
									$firstname = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));
								} else {
									$lastname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
									$firstname = trim(substr($partner, 0, $charpos[1]));
								}
							break;
							case 3:
								switch ($char[0]) {
									case ',':
										if ($char[1] == ' ' and $char[2] == '.') {
											if ($charpos[2]+1 == strlen($partner)) {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											} elseif (substr_count($partner, 'JR.') > 0) {
												$suffix = 'Jr';
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
											} 												
										} elseif ($char[1] == ' ' and $char[2] == ' ') {
											if (substr_count($partner, 'DELA CRUZ') > 0) {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
											} else {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));
											}
										} elseif ($char[1] == ',' and $char[2] == '.') {
											if (substr_count($partner, 'JR') > 0) {
												$suffix = 'Jr';
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											}
										} else {
											
										}
									break;
									case ' ':
									if (substr_count($partner, 'DE LA') > 0) {
										$lastname = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));
										$firstname = trim(substr($partner, 0, $charpos[0]));
									} else {
										$lastname = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
										$firstname = trim(substr($partner, 0, $charpos[2]));
									}
									break;
									
								}
							break;
							case 4:
							if ($char[0] == ',' and $char[3] == '.') {
								$lastname = trim(substr($partner, 0, $charpos[0]));
								$firstname = trim(substr($partner, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
								$middlename = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
							} elseif ($char[0] == ' ' and $char[1] == ',' ) {
								$lastname = trim(substr($partner, 0, $charpos[1]));
								$firstname = trim(substr($partner, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
								$middlename = trim(substr($partner, $charpos[3]+1, strlen($partner)-$charpos[3]-1));
							} elseif ($char[0] == ' ' and $char[1] == '.' and $char[2] == ',' and $char[3] == '.') {
								if (substr_count($partner, 'Jr.') > 0) {
									$lastname = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									$firstname = trim(substr($partner, 0, $charpos[0]));
									$middlename = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									$suffix = 'Jr';
								}
							}
							break;
							case 5:
								if ($char[0] == ' ' and $char[1] == '.' and $char[2] == ',') {
									$lastname = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									$firstname = trim(substr($partner, 0, $charpos[0]));
									$middlename = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
								} elseif($char[3] == '/' ) {
									$lastname = trim(substr($partner, $charpos[4]+1, strlen($partner)-$charpos[4]-1));
									$firstname = trim(substr($partner, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
								}
							break;
						}//end switch

						$person = $this->legacy->findPerson($lastname, $firstname);
						if (!$person) {
							$personinfo = array(
								'lastname' 				=> $lastname,
								'firstname' 			=> $firstname,
								'middlename' 			=> $middlename,
								'suffix' 					=> $suffix,
								'prefix' 					=> $prefix,
								'sex' 						=> '',
								'birthdate'				=> $record['BDate2'],
								'birthplace'			=> '',
								'nationality'			=> '',
								'civil_status_id'	=> '',
								'tin'							=> $record['TIN2'],
								'picture_url'			=> ''
							);

							$organization_partnerinfo['person_id'] = $this->legacy->insertPerson($personinfo);
						} else {
							$organization_partnerinfo['person_id'] = $person['person_id'];
						}

						if($record['Contact2']){
							$contactinfo = array(
								'person_id' 			=> $organization_partnerinfo['person_id'],
								'contact_type_id' => 1,
								'contact_value'	 	=> $record['Contact2'],
								'status_id' 			=> 1
							);
							if (!$this->legacy->findPersonContactValue($contactinfo['person_id'], $contactinfo['contact_value'])) {
								$contact = $this->legacy->insertContact($contactinfo);
							}
						}

						if($record['BusinessPhone2']){
							$contactinfo = array(
								'person_id' 			=> $organization_partnerinfo['person_id'],
								'contact_type_id'	=> 2,
								'contact_value'		=> $record['BusinessPhone2'],
								'status_id'				=> 1
							);

							if (!$this->legacy->findPersonContactValue($contactinfo['person_id'], $contactinfo['contact_value'])) {
								$contact = $this->legacy->insertContact($contactinfo);
							}
						}

						if ($record['EmailAdd2']) {
							$contactinfo = array(
								'person_id'				=> $organization_partnerinfo['person_id'],
								'contact_type_id'	=> 3,
								'contact_value'		=> $record['EmailAdd2'],
								'status_id'				=> 1
							);

							if (!$this->legacy->findPersonContactValue($contactinfo['person_id'], $contactinfo['contact_value'])) {
								$contact = $this->legacy->insertContact($contactinfo);
							}
						}

						$this->legacy->insertOrganizationPartner($organization_partnerinfo);
					}//end CPName

				} else {
					$clientinfo['client_type_id'] = 1;
					
					//insert person
					//insert customer
					//insert customer_account
					//insert client
					//insert address
					//insert person_address
					//insert contact

					//cleaning CustName
					if(substr_count($holder, 'CAR-LOAN') > 0){
						$holder = trim(substr($holder, 0,strpos($holder, 'CAR-LOAN')));
					}
					if(substr_count($holder, '(') == 1 and 
						substr_count($holder, ')') == 0){
						
						$holder = trim(substr($holder,0,strpos($holder, '(')));
					}
					if(substr_count($holder, '(') == 1 and 
						substr_count($holder, ')') == 1){
						
						$holder = trim(substr($holder, 0, strpos($holder, '(')).substr($holder, strpos($holder, ')')+1, strlen($holder)-strpos($holder, ')')-1));
					}
					if(substr_count($holder, '(') == 2 and 
						substr_count($holder, ')') == 1){
						$holder = trim(substr($holder, 0, strpos($holder, '(')));
					}
					if(substr_count($holder, '(') == 2 and 
						substr_count($holder, ')') == 2){
						$holder = trim(substr($holder, 0, strpos($holder, '(')));
					}
					//delete XSCC
					if(substr_count($holder, '- XSCC') > 0){
						$holder = trim(substr($holder, 0,strpos($holder, '- XSCC')));
					}
					//delete XSCC
					if(substr_count($holder, 'XSCC') > 0){
						$holder = trim(substr($holder, 0,strpos($holder, 'XSCC')));
					}
					//delete -Per
					if(substr_count($holder, '-Per.') > 0){
						$holder = trim(substr($holder, 0,strpos($holder, '-Per.')));
					}
					//delete -Per
					if(substr_count($holder, '-Cluster') > 0){
						$holder = trim(substr($holder, 0,strpos($holder, '-Cluster')));
					}
					//delete -Per
					if(substr_count($holder, '-Club') > 0){
						$holder = trim(substr($holder, 0,strpos($holder, '-Club')));
					}
					if(substr_count($holder, '/ Club') > 0){
						$holder = trim(substr($holder, 0,strpos($holder, '/ Club')));
					}
					if (substr_count($holder, 'Zambo. Warehse.')) {
						$holder = trim(substr($holder, 0, strpos($holder, 'Zambo. Warehse.')));
					}
					//delete sps.
					if(substr_count(strtolower($holder), 'sps.') > 0){
						if(strpos(strtolower($holder), 'sps.') == 0){
							$holder = trim(substr($holder, strpos(strtolower($holder), 'sps.')+4,strlen($holder)-strpos(strtolower($holder), 'sps.')-4));
						} else {
							$holder = substr($holder, 0, strpos(strtolower($holder), 'sps.')).substr($holder, strpos(strtolower($holder), 'sps.')+4,strlen($holder)-strpos(strtolower($holder), 'sps.')-4);
						}
					}
											

					$lastname = '';
					$firstname = '';
					$middlename = '';
					$suffix = '';
					$prefix = '';
					$char = [];
					$charpos = [];
					$holder = $this->legacy->eraseDoubleSpace($holder);
					$holder = trim($holder);
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
					}//end for loop
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
								case '.':
									$lastname = trim(substr($holder, 0, $charpos[0]));
									$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
								break;
								default:
									$lastname = $holder;
								break;
							}								
						break;
						case 2:
							switch ($char[0]) {
								case ',':
									if ($char[1] == ' ' and $charpos[1]+2 == strlen($holder)) {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										$middlename = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
									} elseif ($char[1] == ' ') {
										if (substr_count($holder, 'Jr') > 0) {
											$suffix = 'Jr';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										} elseif (substr_count($holder, 'JR') > 0) {
											$suffix = 'Jr';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										} elseif (substr_count($holder, 'Sr') > 0) {

										} elseif (substr_count($holder, 'III') > 0) {
											$suffix = 'III';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										} elseif (substr_count($holder, 'II') > 0){

										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
										}
									} elseif ($char[1] == '.') {
										if ($charpos[1]+1 == strlen($holder)) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										} elseif (trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1)) == 'Dr') {
											$prefix = 'Dr';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										} elseif (trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1)) == 'Dra') {
											$prefix = 'Dr';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										} elseif (trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1)) == 'Atty') {
											$prefix = 'Atty';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										} elseif (trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1)) == 'Engr') {
											$prefix = 'Engr';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
										}
									} else {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
									}
								break;
								case ' ':
									if ($char[1] == ' ') {

									} elseif ($char[1] == '.') {
										if ($charpos[1]+1 == strlen($holder)) {
											$lastname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$firstname = trim(substr($holder, 0, $charpos[0]));
										} else {
											$lastname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
											$firstname = trim(substr($holder, 0, $charpos[0]));
											$middlename = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										}
									} elseif ($char[1] == ',') {
										if (trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1)) == 'III') {
											$suffix = 'III';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										} elseif (trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1)) == 'II') {
											$suffix = 'II';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										} elseif (trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1)) == 'IV') {
											$suffix = 'IV';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[1]));
											$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										}
									} else {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
									}
								break;
								case '-':
									$lastname = trim(substr($holder, 0, $charpos[1]));
									$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
								break;
								default:
									$lastname = $holder;
								break;
							}
						break;
						case 3:
							switch ($char[0]) {
								case ',':
									if ($char[1] == ' ' and $char[2] == '.') {
										if ($charpos[1]+2 == $charpos[2] and $charpos[2]+1 == strlen($holder)) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										} elseif ($charpos[1]+2 == $charpos[2] and $charpos[2]+1 != strlen($holder)) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											$suffix = trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1));
										} else {
											if (trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'Dr') {
												$prefix = 'Dr';
												$lastname = trim(substr($holder, 0, $charpos[0]));
												$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											} elseif (trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'Dra') {
												$prefix = 'Dr';
												$lastname = trim(substr($holder, 0, $charpos[0]));
												$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											} else {
												$suffix = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
												$lastname = trim(substr($holder, 0, $charpos[0]));
												$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											}
										}
									} elseif ($char[1] == ' ' and $char[2] == ' ') {
										if (trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1)) == 'III') {
											$suffix = 'III';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										} elseif (trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1)) == 'II') {
											$suffix = 'II';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										} elseif (trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1)) == 'VII') {
											$suffix = 'VII';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										} elseif ($charpos[2]+2 == strlen($holder)) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1));
										} elseif (trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1)) == 'del rosario') {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
										}
									} else if ($char[1] == ' ' and $char[2] == ','){
										if (trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1)) =='Jr') {
											$suffix = 'Jr';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1));
										}
									} elseif ($char[1] == ' ') {					
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
									} elseif ($char[1] == '.' and $char[2] == ' ') {
										if (trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1)) == 'Mr') {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)- $charpos[0]-1));
										}
									} elseif ($char[1] == '.' and $char[2] == '.') {
										if (trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1)) == 'Dra') {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										}
									} elseif ($char[1] == '.') {
										if (trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1)) == 'Dr') {
											$prefix = 'Dr';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										}
									} elseif ($char[1] == ',') {
										if (trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'Jr') {
											$suffix = 'Jr';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
										}
									} elseif ($char[1] == '&') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} else {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									}
								break;
								case ' ':
									if ($char[1] == ',' and $char[2] == ' ') {
										if (trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1)) == 'IV') {
											$suffix = 'IV';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										} elseif ($charpos[2]+2 == strlen($holder)) {
											$lastname = trim(substr($holder, 0, $charpos[1]));
											$firstname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											$middlename = trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[1]));
											$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										}
									} elseif ($char[1] == ',' and $char[2] == '.') {
										$lastname = trim(substr($holder, 0, $charpos[1]));
										$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
									} elseif ($char[1] == ',') {
										$lastname = trim(substr($holder, 0, $charpos[1]));
										$firstname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									} elseif ($char[1] == ' ' and $char[2] == '.') {
										if ($charpos[2]+1 == strlen($holder)) {
											$lastname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											$firstname = trim(substr($holder, 0, $charpos[1]));
										} else {
											$lastname = trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1));
											$firstname = trim(substr($holder, 0, $charpos[1]));
											$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										}
									} elseif ($char[1] == ' ' and $char[2] == ',') {
										$lastname = trim(substr($holder, 0, $charpos[2]));
										$firstname = trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1));
									} elseif ($char[1] == ' ' and $char[2] == ' ') {
										if ($holder == 'Chee De Jong Linda') {
											$lastname = 'Chee de Jong';
											$firstname = 'Linda'; 
										} else {
											$lastname = trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1));
											$firstname = trim(substr($holder, 0, $charpos[2]));
										}
									} else {
										
									}
								break;
								default:
									if ($char[1] == ',') {
										$lastname = trim(substr($holder, 0, $charpos[1]));
										$firstname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
									} 
									break;
							}
						break;
						case 4:
							switch ($char[0]) {
								case ',':
									if ($char[1] == ' ' and $char[2] == '.' and $char[3] == '.') {
										if ($charpos[1]+2 == $charpos[2] ) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											$suffix = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} elseif (trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'Jr') {
											$suffix = 'Jr';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										}
									} elseif ($char[1] == ' ' and $char[2] == ' ' and $char[3] == '.') {
										if ($charpos[2]+2 == $charpos[3]) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} elseif (trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1)) =='Jr') {
											$suffix = 'Jr';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										} elseif (trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1)) =='SR') {
											$suffix = 'SR';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										}
									} elseif ($char[1] == ' ' and $char[2] == ' ' and $char[3] == ' '){
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
									} elseif ($char[1] == ' ' and $char[2] == '&'){
										if (trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'III') {
											$suffix = 'III';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										}
									} elseif ($char[1] == ' ' and $char[2] == '.'){
										if ($charpos[1]+2 == $charpos[2]) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										} else {
											if (trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) =='Jr') {
												$suffix = 'Jr';
												$lastname = trim(substr($holder, 0, $charpos[0]));
												$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											} else {
												
											}
										}
									} elseif ($char[1] == ' '){
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[3]-$charpos[0]-1));
									} elseif ($char[1] == '.' and $char[2] == ' ' and $char[3] == '.') {
										if ($charpos[2]+2 == $charpos[3]) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} else {
											
										}
									} elseif ($char[1] == '.' and $char[2] == '.' and $char[3] == '.') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
									} elseif ($char[1] == '.' and $char[2] == '.' and $char[3] == ' '){
										if (trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1)) == 'Dr') {
											$prefix = 'Dr';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
											$middlename = trim(substr($holder, $charpos[3]+1, strlen($holder)-$charpos[2]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
										}
									} elseif ($char[1] == '.') {
										if (trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'III') {
											$suffix = 'III';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										} elseif ($char[2] == '&') {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
										}
									} elseif ($char[1] == '-') {
										if ($charpos[2]+2 == $charpos[3]) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]));
										}
									} elseif ($char[1] == '&') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} else {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									}
									break;
								case ' ':
									if ($char[1] == ',' and $char[2] == ' ' and $char[3] == '.') {
										if ($charpos[2]+2 == $charpos[3]) {
											$lastname = trim(substr($holder, 0, $charpos[1]));
											$firstname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[1]));
											$firstname = trim(substr($holder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
										}
									} elseif ($char[1] == ',' and $char[2] == '&') {
										$lastname = trim(substr($holder, 0, $charpos[1]));
										$firstname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									} elseif ($char[1] == ' ' and $char[2] == ',' and $char[3] == '&') {
										$lastname = trim(substr($holder, 0, $charpos[2]));
										$firstname = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
									} elseif ($char[1] == ' ' and $char[2] == ',') {
										$lastname = trim(substr($holder, 0, $charpos[2]));
										$firstname = trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1));
									} elseif ($char[1] == '/') {
										if (strtolower(trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1))) == 'jr') {
											$suffix = 'Jr';
											$lastname = trim(substr($holder, $charpos[3]+1, strlen($holder)-$charpos[3]-1));
											$firstname = trim(substr($holder, 0, $charpos[0]));
										} else {
											
										}
									} else {
									}
								break;
								case '-':
									if ($char[1] == ',' and $char[2] == ' ' and $char[3] == '.') {
										$lastname = trim(substr($holder, 0, $charpos[1]));
										$firstname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
									} elseif ($char[3] == '&') {
										$lastname = trim(substr($holder, 0, $charpos[1]));
										$firstname = trim(substr($holder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
									} else {
										
									}
								break;
								case '.':
									if ($char[1] == ' ' and $char[2] == ' ' and $char[3] == '.') {
										if ($charpos[2]+2 == $charpos[3]) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} else {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
										}
									} elseif ($char[2] == '&') {
										if (trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'III') {
											$suffix = 'III';
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										}
									} else {
										
									}
								break;
								default:
									# code...
									break;
							}
						break;
						case 5:
							switch ($char[0]) {
								case ',':
									if ($char[1] == ' ' and $char[2] == ' ' and $char[3] == ' ' and $char[4] == '.') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[3]-$charpos[0]-1));
										$middlename = trim(substr($holder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
									} elseif ($char[1] == ' ' and $char[2] == '.' and $char[3] == '.') {
										if ($charpos[1]+2 == $charpos[2]) {
											$suffix = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										} else {
											
										}
									} elseif ($char[1] == ' ' and $char[2] == '.') {
										if ($charpos[1]+2 == $charpos[2]) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										} else {
											if (trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'Jr') {
												$suffix = 'Jr';
												$lastname = trim(substr($holder, 0, $charpos[0]));
												$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											} else{
												
											}
										}
									} elseif ($char[1] == ' ' and $char[2] == ' ') {
										$suffix = trim(substr($holder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
									} elseif ($char[1] == ' ') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
									} elseif ($char[1] == '.') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} elseif ($char[1] == '&') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} elseif ($char[1] == '-') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[3]-$charpos[0]-1));
										$middlename = trim(substr($holder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
									} else {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									}
									break;
								case '-':
									if ($char[1] == ',') {
										$lastname = trim(substr($holder, 0, $charpos[1]));
										$firstname = trim(substr($holder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
										$middlename = trim(substr($holder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
									} else {
										
									}
								break;
								case ' ':
									if ($char[1] == '.' and $char[2] == ',') {
										$suffix = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										$middlename = trim(substr($holder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
									} elseif ($char[1] == '.' and $char[2] == '&') {
										if ($charpos[1]+2 == $charpos[2]) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										} else {
											$lastname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											$firstname = trim(substr($holder, 0, $charpos[0]));
											$middlename = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										}
									} else {
										
									}
								break;
								case '.':
									if ($char[1] == ',') {
										$lastname = trim(substr($holder, 0, $charpos[1]));
										$firstname = trim(substr($holder, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
										$middlename = trim(substr($holder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
									}
								break;
								default:
									break;
							}
						break;
						case 6:
							switch ($char[0]) {
								case ',':
									if ($char[1] == ' ' and $char[2] == '.') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									} elseif ($char[1] == '&') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} elseif ($char[1] == '.' and $char[2] =='&') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} else {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									}
									break;
								case ' ':
									if ($char[1] == ',') {
										$lastname = trim(substr($holder, 0, $charpos[1]));
										$firstname = trim(substr($holder, $charpos[1]+1, $charpos[4]-$charpos[1]-1));
										$middlename = trim(substr($holder, $charpos[4]+1, $charpos[5]-$charpos[4]-1));
									}
								break;
								default:
									break;
							}
						break;
						default:
							if ($char[0] == ',') {
								$lastname = trim(substr($holder, 0, $charpos[0]));
								$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
								$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
							} else {
								$lastname = $holder;
							}
						break;
					}
					

					//-------PERSON
					$person = $this->legacy->findPerson($lastname, $firstname);
					if (!$person) {
						$customerinfo = array(
							'customer_fullname' 	=> $record['CustName'],
							'person_id' 					=> '',
							'customer_work_id' 		=> '',
							'special_instruction' => ''
						);

						$personinfo = array (
							'lastname' 				=> $lastname,
							'firstname' 			=> $firstname,
							'middlename' 			=> $middlename,
							'prefix' 					=> $prefix,
							'suffix' 					=> $suffix,
							'sex' 						=> (substr($record['Gender'], 0, 1) == 'C')? '': substr($record['Gender'], 0, 1),
							'birthdate' 			=> $record['BDate'],
							'birthplace'			=> $record['PlaceofBirth'],
							'nationality' 		=> $record['Nationality'],
							'civil_status_id' => $this->legacy->getCivilStatusID($record['CivilStatus']),
							'tin'							=> $record['TIN'],
							'picture_url'			=> ''
						);
						
						$customerinfo['person_id'] = $this->legacy->insertPerson($personinfo);
					} else {
						$customerinfo['person_id'] = $person['person_id'];
					}	


					//--------CUSTOMER
					$customer = $this->legacy->findCustomer($customerinfo['person_id']);
					if (!$customer) {
						$customer_workinfo = array(
							'organization_id' 			=> '',
							'address_id' 						=> '',
							'occupation' 						=> $record['Occupation'],
							'job_title'							=> $record['JobTitle'],
							'monthly_gross_income'	=> '',
							'source_of_funds' 			=> $record['FundSource']. '-'. $record['GrossIncome']
						);

						$customerinfo['customer_work_id'] = $this->legacy->insertCustomerWork($customer_workinfo);

						$clientinfo['reference_id'] = $this->legacy->insertCustomer($customerinfo);
					} else {
						$clientinfo['reference_id'] = $customer['customer_id'];
					}


					//----------CUSTOMER ACCOUNT
					if ($code) {
						if (!$this->legacy->findCustomerAccount($customerinfo['person_id'], $code)) {
							$customer_accountinfo = array(
								'person_id' 							=> $customerinfo['person_id'],
								'contract_id' 						=> '',
								'account'									=> $code,
								'bill_type'								=> '',
								'bill_notification_type'	=> '',
								'subsidiary_code' 				=> '',
								'customer_old_id'					=> '',
								'customer_old_subcode'		=> '',
								'remarks'									=> '',
								'status_id'								=> 1
							);
							$this->legacy->insertCustomerAccount($customer_accountinfo);
						}
					}

					//------------PERSON ADDRESS
					if (!$this->legacy->findPersonAddress($customerinfo['person_id'])) {
						$person_addressinfo = array(
							'person_id' 	=> $customerinfo['person_id'],
							'address_id' 	=> '',
							'status_id' 	=> 1
						);

						$addressinfo = array(
							'line_1'					=> $record['AddrStreet'],
							'line_2'					=> $record['AddrBrgy'],
							'line_3'					=> '',
							'city_id'					=> '',
							'province_id'			=> 0,
							'postal_code'			=> '',
							'country_id'			=> '',
							'address_type_id' => ''
						);

						$city = $this->legacy->eraseDoubleSpace($record['AddrCity']);
						$city = $this->legacy->renameCity($city);
						$city = $this->legacy->findCity($city);
						if ($record['AddrCity'] and !$city) {
							$addressinfo['line_3'] = $record['AddrCity'];
						} else {
							$addressinfo['city_id'] = $city['address_city_id'];
						}

						$province = $this->legacy->eraseDoubleSpace($record['AddrProvince']);
						$province = $this->legacy->renameProvince($province);
						$province = $this->legacy->findProvince($province);
						if ($record['AddrProvince'] and !$province) {
							$addressinfo['line_3'] = $addressinfo['line_3'].'/'.$record['AddrProvince'];
						} else {
							$addressinfo['province_id'] = $province['address_province_id'];
						}

						$person_addressinfo['address_id'] = $this->legacy->insertAddress($addressinfo);
						$this->legacy->insertPersonAddress($person_addressinfo);
					}

					//------------PERSON CONTACT
					$contactinfo = array(
						'person_id' 			=> $customerinfo['person_id'],
						'contact_type_id' => '',
						'contact_value' 	=> '',
						'status_id' 			=> 1
					);
					if ($record['ContactNumber']) {
						$contactinfo['contact_type_id'] = 2;
						$contactinfo['contact_value']		= $record['ContactNumber'];

						if (!$this->legacy->findPersonContactValue($contactinfo['person_id'], $contactinfo['contact_value'])) {
							$organization_contactinfo['contact_id'] = $this->legacy->insertContact($contactinfo);
						}
					}

					if ($record['EmailAdd']) {
						$contactinfo['contact_type_id'] = 4;
						$contactinfo['contact_value'] = $record['EmailAdd'];

						if (!$this->legacy->findPersonContactValue($contactinfo['person_id'], $contactinfo['contact_value'])) {
							$organization_contactinfo['contact_id'] = $this->legacy->insertContact($contactinfo);
						}
					}

					if ($record['Business']) {
						$contactinfo['contact_type_id'] = 2;
						$contactinfo['contact_value'] = $record['Business'];

						if (!$this->legacy->findPersonContactValue($contactinfo['person_id'], $contactinfo['contact_value'])) {
							$organization_contactinfo['contact_id'] = $this->legacy->insertContact($contactinfo);
						}
					}

					if ($record['FaxNumber']) {
						$contactinfo['contact_type_id'] = 5;
						$contactinfo['contact_value'] = $record['FaxNumber'];

						if (!$this->legacy->findPersonContactValue($contactinfo['person_id'], $contactinfo['contact_value'])) {
							$organization_contactinfo['contact_id'] = $this->legacy->insertContact($contactinfo);
						}	
					}


					//---------PARTNER
					/*if ($record['CPName']){
						$partner = $record['CPName'];
						if (substr_count($partner, 'N/A') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'N/A'))).trim(substr($partner, strpos($partner, 'N/A')+3, strlen($partner)-strpos($partner, 'N/A')-3)); 
						}
						if (substr_count($partner, 'N.A') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'N.A'))).trim(substr($partner, strpos($partner, 'N.A')+3, strlen($partner)-strpos($partner, 'N.A')-3)); 
						}
						if (substr_count($partner, 'n/a') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'n/a'))).trim(substr($partner, strpos($partner, 'n/a')+3, strlen($partner)-strpos($partner, 'n/a')-3)); 
						}
						if (substr_count($partner, 'c/o') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'c/o'))).trim(substr($partner, strpos($partner, 'c/o')+3, strlen($partner)-strpos($partner, 'c/o')-3));
						}
						if (substr_count($partner, 'C/O') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'C/O'))).trim(substr($partner, strpos($partner, 'C/O')+3, strlen($partner)-strpos($partner, 'C/O')-3));
						}
						if (substr_count($partner, 'Represented by:') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'Represented by:'))).trim(substr($partner, strpos($partner, 'Represented by:')+15, strlen($partner)-strpos($partner, 'Represented by:')-15));
						}
						if (substr_count($partner, 'REPRESENTED BY:') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'REPRESENTED BY:'))).trim(substr($partner, strpos($partner, 'REPRESENTED BY:')+15, strlen($partner)-strpos($partner, 'REPRESENTED BY:')-15));
						}
						if (substr_count($partner, 'REPRESENTED BY') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'REPRESENTED BY'))).trim(substr($partner, strpos($partner, 'REPRESENTED BY')+14, strlen($partner)-strpos($partner, 'REPRESENTED BY')-14));
						}
						if (substr_count($partner, 'REPRESETED BY:') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'REPRESETED BY:'))).trim(substr($partner, strpos($partner, 'REPRESETED BY:')+14, strlen($partner)-strpos($partner, 'REPRESETED BY:')-14));
						}
						if (substr_count($partner, 'REP. BY:') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'REP. BY:'))).trim(substr($partner, strpos($partner, 'REP. BY:')+8, strlen($partner)-strpos($partner, 'REP. BY:')-8));
						}
						if (substr_count($partner, 'REP BY:') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'REP BY:'))).trim(substr($partner, strpos($partner, 'REP BY:')+7, strlen($partner)-strpos($partner, 'REP BY:')-7));
						}
						if (substr_count($partner, 'CHAIRMAN,') > 0) {
							$partner = trim(substr($partner, 0, strpos($partner, 'CHAIRMAN,'))).trim(substr($partner, strpos($partner, 'CHAIRMAN,')+9, strlen($partner)-strpos($partner, 'CHAIRMAN,')-9));
						}

						$lastname = '';
						$firstname = '';
						$middlename = '';
						$suffix = '';
						$prefix = '';
						$char = [];
						$charpos = [];
						$partner = $this->legacy->eraseDoubleSpace($partner);
						for ($i=0; $i < strlen($partner); $i++) { 
							switch (substr($partner, $i,1)) {
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
									if (substr($partner, $i-1,1) == ',' or 
										substr($partner, $i-1,1) == '(' or 
										substr($partner, $i-1,1) == '-' or 
										substr($partner, $i-1,1) == '.' or 
										substr($partner, $i-1,1) == '/' or 
										substr($partner, $i-1,1) == '&' or 
										substr($partner, $i+1,1) == ',' or
										substr($partner, $i+1,1) == '(' or 
										substr($partner, $i+1,1) == '-' or
										substr($partner, $i+1,1) == '.' or 
										substr($partner, $i+1,1) == '/' or 
										substr($partner, $i+1,1) == '&'){

									} else{
										array_push($char, ' ');
										array_push($charpos, $i);
									}	
								break;	
							}
						}
						switch (sizeof($char)) {
							case 1:
								if ($char[0] == ',') {
									$lastname = trim(substr($partner, 0, $charpos[0]));
									$firstname = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));
								} elseif ($char[0] == ' ') {
									$lastname = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));
									$firstname = trim(substr($partner, 0, $charpos[0]));
								} elseif ($char[0] == '.') {
									$lastname = trim(substr($partner, 0, $charpos[0]));
									$firstname = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));

								}
							break;
							case 2:
								if ($char[0] == ',' and $char[1] == ' ') {
									if ($charpos[1]+2 == strlen($partner)) {
										$lastname = trim(substr($partner, 0, $charpos[0]));
										$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										$middlename = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
									} else {
										$lastname = trim(substr($partner, 0, $charpos[0]));
										$firstname = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));
									}
								} elseif ($char[0] == ',' and $char[1] == '.') {
									$lastname = trim(substr($partner, 0, $charpos[0]));
									$firstname = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));
								} elseif ($char[0] == ',' and $char[1] == ',') {
									$lastname = trim(substr($partner, 0, $charpos[0]));
									$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									$middlename = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
								} elseif ($char[0] == ',' and $char[1] == '-') {
									$lastname = trim(substr($partner, 0, $charpos[0]));
									$firstname = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));
								} elseif ($char[0] == ',' and $char[1] == '&') {
									$lastname = trim(substr($partner, 0, $charpos[0]));
									$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
								} elseif ($char[0] == ' ' and $char[1] == ',') {
									$lastname = trim(substr($partner, 0, $charpos[1]));
									$firstname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
								} elseif ($char[0] == '-' and $char[1] == ',') {
									$lastname = trim(substr($partner, 0, $charpos[1]));
									$firstname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
								} elseif ($char[0] == ' ' and $char[1] == '.') {
									$lastname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
									$firstname = trim(substr($partner, 0, $charpos[0]));
									$middlename = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
								} elseif ($char[0] == ' ' and $char[1] == ' ') {
									$lastname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
									$firstname = trim(substr($partner, 0, $charpos[1]));
								} elseif ($char[0] == ' ' and $char[1] == '-') {
									$lastname = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));
									$firstname = trim(substr($partner, 0, $charpos[0]));
								} elseif ($char[0] == '.' and $char[1] == ' ') {
									if (trim(substr($partner, 0, $charpos[0])) == 'DR') {
										$prefix = 'Dr';
										$lastname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
										$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} elseif (trim(substr($partner, 0, $charpos[0])) == 'ATTY') {
										$prefix = 'Atty';
										$lastname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
										$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} elseif (trim(substr($partner, 0, $charpos[0])) == 'MA') {
										$lastname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
										$firstname = trim(substr($partner, 0, $charpos[1]));
									} elseif ($charpos[0] == 1) {
										$lastname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
										$firstname = trim(substr($partner, 0, $charpos[1]));
									} else {
										$lastname = trim(substr($partner, 0, $charpos[0]));
										$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										$middlename = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
									}
								}
							break;
							case 3:
								switch ($char[0]) {
									case ',':
										if ($char[1] == ' ' and $char[2] == '.') {
											if ($charpos[1]+2 == $charpos[2]) {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											} else {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$suffix = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											}
										} elseif ($char[1] == ' ' and $char[2] == ' ') {
											if ($charpos[2]+2 == strlen($partner)) {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
												$middlename = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
											} elseif ($charpos[1]+2 == $charpos[2]) {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
												$suffix = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
											} elseif (trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1))== 'JR' or trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1))== 'IV') {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
												$suffix = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
											} else {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));
											}
										}
									break;
									case '.':
										if ($char[1] == ' ' and $char[2] == ' ') {
											if (trim(substr($partner, 0, $charpos[0])) == 'DR') {
												$prefix = 'Dr';
												$lastname = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											} elseif (trim(substr($partner, 0, $charpos[0])) == 'ATTY') {
												$prefix = 'Atty';
												$lastname = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											} else {
												$lastname = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
												$firstname = trim(substr($partner, 0, $charpos[1]));
												$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											}
										} elseif ($char[1] == ' ' and $char[2] == '.') {
											if ($charpos[1]+2 == $charpos[2] and $charpos[2]+1 == strlen($partner)) {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											} else {
												if (trim(substr($partner, 0, $charpos[0])) == 'DR' or trim(substr($partner, 0, $charpos[0])) == 'DRA') {
													$prefix = 'Dr';
													$lastname = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
													$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
													$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
												} else {
													$lastname = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
													$firstname = trim(substr($partner, 0, $charpos[1]));
													$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
												}
											}
										} elseif ($char[1] == ',' and $char[2] == '.') {
											if (trim(substr($partner, 0, $charpos[0])) == 'DR') {
												$prefix = 'Dr';
												$lastname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$firstname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
											}
										}
									break;
									case ' ':
										if ($char[1] == ' ' and $char[2] == '.') {
											if ($charpos[1]+2 == $charpos[2] and $charpos[2]+1 == strlen($partner) ) {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											} elseif ($charpos[1]+3 == $charpos[2]) {
												$lastname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$firstname = trim(substr($partner, 0, $charpos[0]));
												$suffix = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											} else {
												$lastname = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
												$firstname = trim(substr($partner, 0, $charpos[1]));
												$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											}
										} elseif ($char[1] == ' ' and $char[2] == ' ') {
											$lastname = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
											$firstname = trim(substr($partner, 0, $charpos[1]));
											$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										} elseif ($char[1] == ',' and $char[2] == ' ') {
											if ($charpos[2]+2 == strlen($partner)) {
												$lastname = trim(substr($partner, 0, $charpos[1]));
												$firstname = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
												$middlename = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
											} else {
												$lastname = trim(substr($partner, 0, $charpos[1]));
												$firstname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
											}
										} elseif ($char[1] == ',' and $char[2] == ',') {
											$lastname = trim(substr($partner, 0, $charpos[1]));
											$firstname = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											$middlename = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
										} elseif ($char[1] == '.' and $char[2] == ',') {
											$lastname = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											$firstname = trim(substr($partner, 0, $charpos[0]));
											$middlename = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$suffix = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
										} elseif ($char[1] == '.' and $char[2] == ' ') {
											$lastname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
											$firstname = trim(substr($partner, 0, $charpos[0]));
											$middlename = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										} elseif ($char[1] == '.' and $char[2] == '-') {
											$lastname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
											$firstname = trim(substr($partner, 0, $charpos[0]));
											$middlename = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										} elseif ($char[1] == ' ' and $char[2] == ',') {
											$lastname = trim(substr($partner, 0, $charpos[2]));
											$firstname = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
										} else {
											$lastname = trim(substr($partner, 0, $charpos[0]));
											$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$middlename = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
										}
									break;
									case '-':
										if ($char[1] == ',' and $char[2] == ' ') {
											$lastname = trim(substr($partner, 0, $charpos[1]));
											$firstname = trim(substr($partner, $charpos[1]+1, strlen($partner)-$charpos[1]-1));
										} else {
											$lastname = trim(substr($partner, 0, $charpos[1]));
											$firstname = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											$middlename = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
										}
									break;
									default:
										break;
								}
							break;
							case 4:
								switch ($char[0]) {
									case ',':
										if ($char[1] == ' ' and $char[2] == ' ' and $char[3] == '.') {
											if (trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'II' or trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'III' or trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'Jr') {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
												$suffix = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											} else {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
												$middlename = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
											}
										} elseif ($char[1] == ' ' and $char[2] == ' ' and $char[3] == ','){
											$lastname = trim(substr($partner, 0, $charpos[0]));
											$firstname = trim(substr($partner, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($partner, $charpos[3]+1, strlen($partner)-$charpos[3]-1));
											$suffix = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} elseif ($char[1] == ' ' and $char[2] == '.' and $char[3] == '.') {
											if ($charpos[1]+2 == $charpos[2]) {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
												$suffix = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
											} else {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
												$middlename = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
												$suffix = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											}
										} elseif ($char[1] == ' ' and $char[2] == '.') {
											$lastname = trim(substr($partner, 0, $charpos[0]));
											$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$middlename = trim(substr($partner, $charpos[3]+1, strlen($partner)-$charpos[3]-1));
											$suffix = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										} elseif ($char[1] == ' ' and $char[2] == ' ' and $char[3] == '-') {
											$lastname = trim(substr($partner, 0, $charpos[0]));
											$firstname = trim(substr($partner, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
										} elseif ($char[1] == ' ') {
											if ($charpos[3]+2 == strlen($partner)) {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[0]+1, $charpos[3]-$charpos[0]-1));
												$middlename = trim(substr($partner, $charpos[3]+1, strlen($partner)-$charpos[3]-1));
											} else {
												if ($charpos[2]+2 == $charpos[3]) {
													$lastname = trim(substr($partner, 0, $charpos[0]));
													$firstname = trim(substr($partner, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
													$middlename = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
													$suffix = trim(substr($partner, $charpos[3]+1, strlen($partner)-$charpos[3]-1));
												} elseif (trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1)) == 'III') {
													$lastname = trim(substr($partner, 0, $charpos[0]));
													$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
													$middlename = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
													$suffix = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
												} else {
													if (trim(substr($partner, 0, $charpos[0])) == 'HISHAM') {
														$lastname = trim(substr($partner, 0, $charpos[0]));
														$firstname = trim(substr($partner, $charpos[0]+1, strlen($partner)-$charpos[0]-1));
													} else {
														$lastname = trim(substr($partner, 0, $charpos[0]));
														$firstname = trim(substr($partner, $charpos[0]+1, $charpos[3]-$charpos[0]-1));
														$middlename = trim(substr($partner, $charpos[3]+1, strlen($partner)-$charpos[3]-1));
													}

												}
											}
										} elseif ($char[1] == '.') {
											$lastname = trim(substr($partner, 0, $charpos[0]));
											$firstname = trim(substr($partner, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} elseif ($char[1] == '-') {
											$lastname = trim(substr($partner, 0, $charpos[0]));
											$firstname = trim(substr($partner, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} elseif ($char[1] == ',') {
											$lastname = trim(substr($partner, 0, $charpos[0]));
											$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$suffix = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										}
										break;
									case ' ':
										if ($char[1] == ',' and $char[2] == ' ' and $char[3] == '.') {
											if (trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1)) == 'III' or trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1)) == 'JR') {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
												$middlename = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
												$suffix = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											} elseif (trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1)) == 'JR') {
												$lastname = trim(substr($partner, 0, $charpos[1]));
												$firstname = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
												$middlename = trim(substr($partner, $charpos[3]+1, strlen($partner)-$charpos[3]-1));
												$suffix = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
											} else {
												$lastname = trim(substr($partner, 0, $charpos[1]));
												$firstname = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
												$middlename = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
											}
										} elseif ($char[1] == ',') {
											$lastname = trim(substr($partner, 0, $charpos[1]));
											$firstname = trim(substr($partner, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
											$middlename = trim(substr($partner, $charpos[3]+1, strlen($partner)-$charpos[3]-1));
										} elseif ($char[1] == ' ' and $char[2] == ',') {
											$lastname = trim(substr($partner, 0, $charpos[2]));
											$firstname = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
										} elseif ($char[1] == ' ' and $char[2] == '.' and $char[3] == ' ') {
											$lastname = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
											$firstname = trim(substr($partner, 0, $charpos[1]));
											$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										} elseif ($char[1] == ' ') {
											if (trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1)) == 'JR') {
												$lastname = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
												$firstname = trim(substr($partner, 0, $charpos[1]));
												$suffix = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
											} else {
												$lastname = trim(substr($partner, $charpos[3]+1, strlen($partner)-$charpos[3]-1));
												$firstname = trim(substr($partner, 0, $charpos[1]));
												$middlename = trim(substr($partner, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
											}
										} elseif ($char[1] == '.') {
											$lastname = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											$firstname = trim(substr($partner, 0, $charpos[0]));
											$middlename = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
											$suffix = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} else {
											
										}
									break;
									case '.':
										if ($char[1] == ' ' and $char[2] == '.' and $char[3] == ' ') {
											$lastname = trim(substr($partner, $charpos[2]+1, strlen($partner)-$charpos[2]-1));
											$firstname = trim(substr($partner, 0, $charpos[1]));
											$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										}
									break;
									case '-':
										if ($char[1] == ',') {
											$lastname = trim(substr($partner, 0, $charpos[1]));
											$firstname = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											$middlename = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										}
									break;
									default:
										# code...
										break;

								}
							break;
							case 5:
								switch ($char[0]) {
									case ',':
										if ($char[1] == ' ' and $char[2] == ' ' and $char[3] == ' ' and $char[4] == '.') {
											$lastname = trim(substr($partner, 0, $charpos[0]));
											$firstname = trim(substr($partner, $charpos[0]+1, $charpos[3]-$charpos[0]-1));
											$middlename = trim(substr($partner, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
										} elseif ($char[1] == ' ' and $char[2] == ' ' and $char[3] == '.' and $char[4] == '.') {
											$lastname = trim(substr($partner, 0, $charpos[0]));
											$firstname = trim(substr($partner, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($partner, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
											$suffix = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} elseif ($char[1] == ' ' and $char[2] == ' ' and $char[3] == '.') {
											$lastname = trim(substr($partner, 0, $charpos[0]));
											$firstname = trim(substr($partner, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$middlename = trim(substr($partner, $charpos[4]+1,strlen($partner)-$charpos[4]-1));
											$suffix = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} elseif ($char[1] == '.' and $char[2] == ' ' and $char[3] == ' ' and $char[4] == '.') {
											$lastname = trim(substr($partner, 0, $charpos[0]));
											$firstname = trim(substr($partner, $charpos[0]+1, $charpos[3]-$charpos[0]-1));
											$middlename = trim(substr($partner, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
										} else {
											$lastname = trim(substr($partner, 0, $charpos[0]));
											$firstname = trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										}
										break;
									case ' ':
										if ($char[1] == ',') {
											$lastname = trim(substr($partner, 0, $charpos[1]));
											$firstname = trim(substr($partner, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
											$middlename = trim(substr($partner, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
										} elseif ($char[1] == ' ' and $char[2] == ',') {
											$lastname = trim(substr($partner, 0, $charpos[2]));
											$firstname = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
											$middlename = trim(substr($partner, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
										} elseif ($char[1] == ' ' and $char[2] == '.') {
											$lastname = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
											$firstname = trim(substr($partner, 0, $charpos[1]));
											$middlename = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
											$suffix = trim(substr($partner, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
										} else {
											$lastname = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
											$firstname = trim(substr($partner, 0, $charpos[0]));
											$middlename = trim(substr($partner, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
											$suffix = trim(substr($partner, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
										}
									break;
									case '-':
										if ($char[1] == ',') {
											$lastname = trim(substr($partner, 0, $charpos[1]));
											$firstname = trim(substr($partner, $charpos[1]+1, $charpos[3]-$charpos[1]-1));
											$middlename = trim(substr($partner, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
										}
									break;
									default:
										# code...
										break;
								}
								break;
							case 6:
								switch ($char[0]) {
									case ' ':
										if ($char[1] == ' ' and $char[2] == ',') {
											$lastname = trim(substr($partner, 0, $charpos[2]));
											$firstname = trim(substr($partner, $charpos[2]+1, $charpos[4]-$charpos[2]-1));
											$middlename = trim(substr($partner, $charpos[4]+1, $charpos[5]-$charpos[4]-1));
										} elseif ($char[1] == '.') {
											if (trim(substr($partner, $charpos[0]+1, $charpos[1]-$charpos[0]-1)) == 'SPS') {
												$lastname = trim(substr($partner, 0, $charpos[0]));
												$firstname = trim(substr($partner, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
												$middlename = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
											}
										} else {
											if ($char[3] == '.') {
												$lastname = trim(substr($partner, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
												$firstname = trim(substr($partner, 0, $charpos[2]));
												$middlename = trim(substr($partner, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
												$suffix = trim(substr($partner, $charpos[4]+1, $charpos[5]-$charpos[4]-1));
											} else {
												
											}
										}
										break;
									
									default:
										# code...
										break;
								}
							break;
							default:
								# code...
								break;
						}


						if ($lastname) {

							$person = $this->legacy->findPerson($lastname, $firstname);
							if (!$person) {
								
							}
						}
					echo "<tr><td>".$partner."</td><td>".$lastname."</td><td>".$firstname."</td><td>".$middlename."</td><td>".$suffix."</td><td>".$prefix."</td></tr>";		
					}*/

				}//end checkcompany

				$tempclient = $this->legacy->findClient($clientinfo['client_type_id'], $clientinfo['reference_id']);
				if (!$tempclient) {
					$this->legacy->insertClient($clientinfo);
				} else {
					$updclientinfo = array(
						'legacy_custid' => $record['CustID']
					);
					$this->legacy->updateClient($updclientinfo, $tempclient['client_id']);
				}
			}//end if not included
		}//end foreach records
		$this->db->trans_complete();
		echo json_encode('done');
	}


	public function migrate_supplier(){
		set_time_limit(0);
		$max = 0;
		$this->db->trans_start();
		$records = $this->legacy->getLegacySupplier();
		foreach ($records as $record) {
			$supplierinfo = array(
				'client_type_id' 			=> '',
				'reference_id' 				=> '',
				'status_id' 					=> 1,
				'vatable' 						=> $record['Vatable'],
				'legacy_categorycode' => $record['CategoryCode'],
				'subsidiary_code' 		=> $record['SubCode'],
				'peachtree_vendorid' 	=> ''
			);

			$organizationinfo = array(
				'organization_name' 	=> $record['SubFullName'],
				'tin' 								=> $record['SubLName'],
				'special_instruction' => '',
				'status_id' 					=> 1
			);

			$organization_addressinfo = array(
				'organization_id' => '',
				'address_id' 			=> '',
				'status_id' 			=> 1
			);

			$organization_contactinfo = array(
				'organization_id' => '',
				'contact_id' => '',
				'status_id' => 1
			);

			$personinfo = array(
				'lastname' 				=> '',
				'firstname' 			=> '',
				'middlename' 			=> '',
				'prefix' 					=> '',
				'suffix' 					=> '',
				'sex' 						=> '',
				'birthdate' 			=> '',
				'birthplace' 			=> '',
				'nationality' 		=> '',
				'civil_status_id' => '',
				'tin' 						=> $record['SubLName'],
				'picture_url' 		=> ''
			);

			$person_addressinfo = array(
				'person_id' 	=> '',
				'address_id'	=> '',
				'status_id' 	=> 1
			);

			$addressinfo = array(
				'line_1' 					=> $record['SubAddress'],
				'line_2' 					=> '',
				'line_3' 					=> '',
				'city_id' 				=> '',
				'province_id' 		=> 0,
				'postal_code' 		=> '',
				'country_id' 			=> '',
				'address_type_id' => 2
			);

			$contactinfo = array(
				'person_id' 			=> '',
				'contact_type_id' => 2,
				'contact_value' 	=> '',
				'status_id' 			=> 1
			);

			if ($max < strlen($record['SubFullName'])) {
				$max = strlen($record['SubFullName']);
			}

			if (!$this->legacy->deleteType($record['SubFullName'])) {
				if ($this->legacy->checkCompany($record['SubFullName'])) {
					$supplierinfo['client_type_id'] = 2;

					$organization = $this->legacy->findOrganization($record['SubFullName']);
					if (!$organization) {
						$supplierinfo['reference_id'] = $this->legacy->insertOrganization($organizationinfo);
					} else {
						$supplierinfo['reference_id'] = $organization['organization_id'];
					}
		
					if ($record['SubAddress']){
						if (!$this->legacy->findOrganizationAddress($supplierinfo['reference_id'])) {
							$organization_addressinfo['organization_id'] = $supplierinfo['reference_id'];
							$organization_addressinfo['address_id'] = $this->legacy->insertAddress($addressinfo);
							$this->legacy->insertOrganizationAddress($organization_addressinfo);
						}
					}

					if ($record['SubContact']) {
						if (!$this->legacy->findOrganizationContact($supplierinfo['reference_id'])) {
							$contactinfo['contact_value'] = $record['SubContact'];
							$organization_contactinfo['organization_id'] = $supplierinfo['reference_id'];
							$organization_contactinfo['contact_id'] = $this->legacy->insertContact($contactinfo);
							$this->legacy->insertOrganizationContact($organization_contactinfo);
						}
					}
				} else {
					$supplierinfo['client_type_id'] = 1;
					$holder = $record['SubFullName'];
					if (substr_count($holder, '(') > 0) {
						$holder = trim(substr($holder,0,strpos($holder, '(')));
					}
					if (substr_count($holder, 'B3') > 0) {
						$holder = trim(substr($holder,0,strpos($holder, 'B3')));
					}	
					if (substr_count($holder, '/ XE B') > 0) {
						$holder = trim(substr($holder,0,strpos($holder, '/ XE B')));
					}	
					if (substr_count($holder, 'Atty.')) {
						$prefix = 'Atty';
						$holder = trim(substr($holder, 0, strpos($holder, 'Atty.'))).trim(substr($holder, strpos($holder, 'Atty.')+5, strlen($holder)-strpos($holder, 'Atty.')-5)); 
					}
					if (substr_count($holder, 'Engr.')) {
						$prefix = 'Engr';
						$holder = trim(substr($holder, 0, strpos($holder, 'Engr.'))).trim(substr($holder, strpos($holder, 'Engr.')+5, strlen($holder)-strpos($holder, 'Engr.')-5)); 
					}

					$lastname = '';
					$firstname = '';
					$middlename = '';
					$suffix = '';
					$prefix = '';
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
						case 1:
							switch ($char[0]) {
								case ' ':
									$lastname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
									$firstname = trim(substr($holder, 0, $charpos[0]));
								break;
								case ',':
									$lastname = trim(substr($holder, 0, $charpos[0]));
									$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
								break;
							}
						break;
						case 2:
							switch ($char[0]) {
								case ',':
									if ($charpos[1]+2 == strlen($holder)) {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));					
										$middlename = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));					
									} else {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, strlen($holder)-$charpos[0]-1));
									}
								break;
								case ' ':
									if ($char[1] == '.' and $charpos[0]+2 == $charpos[1]) {
										$lastname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										$firstname = trim(substr($holder, 0, $charpos[0]));
										$middlename = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));					
									} else {
										$lastname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));			 
										$firstname = trim(substr($holder, 0, $charpos[1]));
										
									}
								break;
							}
						break;
						case 3:
							if (substr_count($holder, 'III') > 0) {
								$suffix = 'III';
								$holder = trim(substr($holder, 0, strpos($holder, 'III'))).trim(substr($holder, strpos($holder, 'III')+3, strlen($holder)-strpos($holder, 'III')-3)); 
							}
							if (substr_count($holder, 'Jr.') > 0) {
								$suffix = 'Jr';
								$holder = trim(substr($holder, 0, strpos($holder, 'Jr.'))).trim(substr($holder, strpos($holder, 'Jr.')+3, strlen($holder)-strpos($holder, 'Jr.')-3)); 
							}
							if (substr_count($holder, 'Jr') > 0) {
								$suffix = 'Jr';
								$holder = trim(substr($holder, 0, strpos($holder, 'Jr'))).trim(substr($holder, strpos($holder, 'Jr')+2, strlen($holder)-strpos($holder, 'Jr')-2)); 
							}
							if (substr_count($holder, 'Sr.') > 0) {
								$suffix = 'Sr';
								$holder = trim(substr($holder, 0, strpos($holder, 'Sr.'))).trim(substr($holder, strpos($holder, 'Sr.')+3, strlen($holder)-strpos($holder, 'Sr.')-3)); 
							}
							switch ($char[0]) {
								case ',':
									if ($charpos[1]+2 == $charpos[2]) {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));					
										$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									} else {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));				
									}
								break;
								case '.':
									$lastname = trim(substr($holder, 0, $charpos[0]));
									$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
								break;
								case ' ':
									if ($char[1] == ' ' and $char[2] == '.' and $charpos[2]+1 != strlen($holder)) {
										$lastname = trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1));
										$firstname = trim(substr($holder, 0, $charpos[1]));
										$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									} elseif ($char[1] == '.' and $char[2] == ',') {
										$lastname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										$firstname = trim(substr($holder, 0, $charpos[0]));
										$middlename = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} elseif ($char[1] == '.' and $char[2] == '-') {
										$lastname = trim(substr($holder, $charpos[1]+1, strlen($holder)-$charpos[1]-1));
										$firstname = trim(substr($holder, 0, $charpos[0]));
										$middlename = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} elseif ($char[1] == ' ' and $char[2] == ' ') {
										if (substr_count($holder, 'and') > 0) {
											$lastname = trim(substr($holder, 0, $charpos[0]));
											$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										} elseif (substr_count($holder, 'dela') > 0) {
											$lastname = trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1));
											$firstname = trim(substr($holder, 0, $charpos[0]));
											$middlename = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										}
									} elseif ($char[1] == ' ' and $char[2] == '.') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									} elseif ($char[1] == ',') {
										$lastname = trim(substr($holder, 0, $charpos[1]));
										$firstname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									} else {

									}
								break;
							}
						break;
						case 4:
							if (substr_count($holder, 'III') > 0) {
								$suffix = 'III';
								//$holder = trim(substr($holder, 0, strpos($holder, 'III'))).trim(substr($holder, strpos($holder, 'III')+3, strlen($holder)-strpos($holder, 'III')-3)); 
							}
							if (substr_count($holder, 'JR.') > 0) {
								$suffix = 'Jr';
								//$holder = trim(substr($holder, 0, strpos($holder, 'JR.'))).trim(substr($holder, strpos($holder, 'JR.')+3, strlen($holder)-strpos($holder, 'JR.')-3)); 
							}
							if (substr_count($holder, 'Jr.') > 0) {
								$suffix = 'Jr';
								//$holder = trim(substr($holder, 0, strpos($holder, 'Jr.'))).trim(substr($holder, strpos($holder, 'Jr.')+3, strlen($holder)-strpos($holder, 'Jr.')-3)); 
							}
							if (substr_count($holder, 'Jr') > 0) {
								$suffix = 'Jr';
								//$holder = trim(substr($holder, 0, strpos($holder, 'Jr'))).trim(substr($holder, strpos($holder, 'Jr')+2, strlen($holder)-strpos($holder, 'Jr')-2)); 
							}
							if (substr_count($holder, 'SR.') > 0) {
								$suffix = 'Sr';
								//$holder = trim(substr($holder, 0, strpos($holder, 'Sr.'))).trim(substr($holder, strpos($holder, 'Sr.')+3, strlen($holder)-strpos($holder, 'Sr.')-3)); 
							}
							if (substr_count($holder, 'Sr.') > 0) {
								$suffix = 'Sr';
								//$holder = trim(substr($holder, 0, strpos($holder, 'Sr.'))).trim(substr($holder, strpos($holder, 'Sr.')+3, strlen($holder)-strpos($holder, 'Sr.')-3)); 
							}
							switch ($char[0]) {
								case ',':
									if ($char[1] == ' ' and $char[2] == ' ' and $char[3] == '.') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
									} elseif ($char[1] == ' ' and $char[2] == '.' and $char[3] == '.') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										if ($charpos[2]+3 == $charpos[3]) {
											$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
										} else {
											$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										}
									} elseif ($char[1] == '.' and $char[2] == ' ' and $char[3] =='.') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
									} elseif ($char[1] == ' ' and $char[2] == '.') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
										$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									} elseif ($char[1] == '-' and $char[2] == ' ' and $char[3] == '.') {
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
									} else {

									}
								break;
								case ' ':
									if ($char[1] == '.' and $char[2] == ' ') {
										$lastname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										$firstname = trim(substr($holder, 0, $charpos[0]));
										$middlename = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} elseif ($char[1] == '.' and $char[2] == ',') {
										$lastname = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
										$firstname = trim(substr($holder, 0, $charpos[0]));
										$middlename = trim(substr($holder, $charpos[0]+1, $charpos[1]-$charpos[0]-1));
									} else {

									}
								break;
								case '.':
									if ($char[1] == '.' and $char[2] == ' ' and $char[3] == '.') {
										$lastname = trim(substr($holder, $charpos[3]+1, strlen($holder)-$charpos[3]-1));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										$middlename = trim(substr($holder, $charpos[2]+1, $charpos[3]-$charpos[2]-1));
									}
								break;
							}
						break;
						case 5:
							switch ($char[0]) {
								case ',':
									if (substr_count($holder, 'Jr.') > 0) {
										$suffix = 'Jr';
										//$holder = trim(substr($holder, 0, strpos($holder, 'Jr.'))).trim(substr($holder, strpos($holder, 'Jr.')+3, strlen($holder)-strpos($holder, 'Jr.')-3)); 
										$lastname = trim(substr($holder, 0, $charpos[0]));
										$firstname = trim(substr($holder, $charpos[0]+1, $charpos[2]-$charpos[0]-1));
										$middlename = trim(substr($holder, $charpos[3]+1, $charpos[4]-$charpos[3]-1));
									}
								break;
								case ' ':
									if ($char[1] == ' ' and $char[2] == '.' and $char[3] == '-') {
										$lastname = trim(substr($holder, $charpos[2]+1, strlen($holder)-$charpos[2]-1));
										$firstname = trim(substr($holder, 0, $charpos[1]));
										$middlename = trim(substr($holder, $charpos[1]+1, $charpos[2]-$charpos[1]-1));
									}
								break;
							}
						break;
					}

					$personinfo['lastname'] 	= $lastname;
					$personinfo['firstname']	= $firstname;
					$personinfo['middlename'] = $middlename;
					$personinfo['prefix']			= $prefix;
					$personinfo['suffix']			= $suffix;

					$person = $this->legacy->findPerson($lastname, $firstname);
					if (!$person) {
						$supplierinfo['reference_id'] = $this->legacy->insertPerson($personinfo);
					} else {
						$supplierinfo['reference_id'] = $person['person_id'];
					}
						
					if ($record['SubAddress']){
						if (!$this->legacy->findPersonAddress($supplierinfo['reference_id'])) {
							$person_addressinfo['person_id'] = $supplierinfo['reference_id'];
							$person_addressinfo['address_id'] = $this->legacy->insertAddress($addressinfo);
							$this->legacy->insertPersonAddress($person_addressinfo);
						}
					}

					if ($record['SubContact']) {
						if (!$this->legacy->findContact($supplierinfo['reference_id'])) {
							$contactinfo['person_id'] = $supplierinfo['reference_id'];
							$contactinfo['contact_value'] = $record['SubContact'];
							$temp = $this->legacy->insertContact($contactinfo);
						}
					}
				}// end checkcompany

				$supplier = $this->legacy->findSupplier($supplierinfo['client_type_id'], $supplierinfo['reference_id']);
				if (!$supplier) {
					$this->legacy->insertSupplier($supplierinfo);
				} else {
					$supplierinfo['vatable'] = ($supplier['vatable']) ? $supplier['vatable'] : $record['Vatable'];
					$supplierinfo['legacy_categorycode'] = ($supplier['legacy_categorycode']) ? $supplier['legacy_categorycode'] : $record['CategoryCode'];
					$supplierinfo['subsidiary_code'] = ($supplier['subsidiary_code']) ? $supplier['subsidiary_code'] : $record['SubCode'];
					$supplierinfo['peachtree_vendorid'] = $supplier['peachtree_vendorid'];
					$this->legacy->updateSupplier($supplierinfo, $supplier['supplier_id']); 
				}
			}// end if delete type
		}// end foreach
		$this->db->trans_complete();
		echo json_encode('done');
	}


	public function countRecords(){
		switch ($this->input->post('switcherino')) {
			case 'contract':
				$table = 'AbrownNew.dbo.ResContract';
				$option = '';
			break;
			case 'amortization':
				$table = 'AbrownNew.dbo.ResAmortztn';
				$option = '';
			break;
			case 'collection':
				$table = 'AbrownNew.dbo.resCollection';
				$option = '';
			break;
			case 'payment':
				$table = 'AbrownNew.dbo.resPayments';
				$option = '';
			break;
			case 'item':
				$table = 'AbrownNew.dbo.Item_InventoryMaster';
				$option = '';
			break;
			case 'transaction':
				$table = 'AbrownNew.dbo.GlTransactions';
				$option = '';
			break;
			case 'customer':
				$table = 'AbrownNew.dbo.ResCust';
				$option = '';
			break;
			case 'supplier':
				$table = 'AbrownNew.dbo.GlSubsidiary';
				$option = array('SubType' => 'Supplier');
			break;
			case 'lots':
				$table = 'AbrownNew.dbo.TblLot';
				$option = '';
			break;
			case 'cv':
				$table = 'AbrownNew.dbo.M_CheckVouchers';
				$option = '';
			break;
			case 'bank':
				$table = 'AbrownNew.dbo.GlSubsidiary';
				$option = array('SubType' => 'BankFile');
			break;		
		}
		$data = $this->legacy->countRecords($table, $option);
		echo json_encode($data);
	}
}