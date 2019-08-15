<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Home Page';
		$data['userprofile'] = 'welcome/userprofile';
		$data['navigation'] = 'welcome/navigation';
		$data['customcss'] = 'welcome/customcss';
		$data['customjs'] = 'welcome/customjs';

		$CI =& get_instance();
		// $this->load->library('fb');
		// $CI->fb->info($data, "GLEEEEEEEn");

//		$this->load->library('excel');
//		$this->load->library('iofactory');
//		$this->excel->setActiveSheetIndex(0);
//		//name the worksheet
//		$this->excel->getActiveSheet()->setTitle('test worksheet');
//		//set cell A1 content with some text
//		$this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
//		//change the font size
//		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
//		//make the font become bold
//		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
//		//merge cell A1 until D1
//		$this->excel->getActiveSheet()->mergeCells('A1:D1');
//		//set aligment to center for that merged cell (A1 to D1)
//		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//
//		$filename='just_some_random_name.xls'; //save our workbook as this file name
//		header('Content-Type: application/vnd.ms-excel'); //mime type
//		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
//		header('Cache-Control: max-age=0'); //no cache
		            
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
//		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
//		//force user to download the Excel file without writing it to server's HD
//		$objWriter->save('php://output');


		$this->load->view('default/index', $data);		
	}

    function mypdf(){

        $this->load->library('Pdf');

        $pdf = new Pdf('L', 'in', 'MEMO', true, 'UTF-8', false);
        $pdf->SetTitle('My Title');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('IRM System Generated PDF');
        $pdf->SetDisplayMode('real', 'default');

        $pdf->AddPage();

        $pdf->Write(5, 'Some samdpsle text');
        $pdf->Output('My-File-Name.pdf', 'I');
    }
    function inbox(){
   
    $this->data['page_title'] = '.';
    //$this->data['customjs'] = 'dashboardjs';
    if(!isset($this->session->userdata['logged_in'])){
            redirect('logout', 'refresh');
        }
        $this->load->library('layouts');

        $this->layouts->set_title('Inbox');
                                                      //foldername/filename 
        $this->layouts->view('home',array('latest' => 'sidebar/latest')); 
     
    }   

    }
    


