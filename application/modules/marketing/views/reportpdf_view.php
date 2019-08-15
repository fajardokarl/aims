<!-- <h1>AKJSGDHHGAS</h1> -->
<?php
	// $pdf = new Pdf('L', 'in', 'MEMO', true, 'UTF-8', false);
 //    $pdf->SetTitle('My Title');
 //    $pdf->SetHeaderMargin(30);
 //    $pdf->SetTopMargin(20);
 //    $pdf->setFooterMargin(20);
 //    $pdf->SetAutoPageBreak(true);
 //    $pdf->SetAuthor('IRM System Generated PDF');
 //    $pdf->SetDisplayMode('real', 'default');

 //    $pdf->AddPage();

 //    $pdf->Write(5, 'Some Sample text');
 //    $pdf->Output('My-File-Name.pdf', 'I');




    $name = $persons->firstname;

    // $id_person = $this->input->get('personid');

    $this->load->library('Pdf');
    // $this->load->view('marketing/reportpdf_view');
    $pdf = new Pdf('L', 'in', 'MEMO', true, 'UTF-8', false);
    $pdf->SetTitle('My Title');
    $pdf->SetHeaderMargin(30);
    $pdf->SetTopMargin(20);
    $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true);
    $pdf->SetAuthor('IRM System Generated PDF');
    $pdf->SetDisplayMode('real', 'default');


    ob_clean(); 
    $pdf->AddPage();
    // $pdf->WriteHTML($htmla, true, 0, true, true);
    $y = $pdf->getY();
    // set color for background
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln();

    $pdf->writeHTMLCell(30, '', '', $y, 'Name: ', 0, 0, 0, true, 'L', true);
    $pdf->writeHTMLCell(60, '', '', '', $name, 0, 0, 0, true, 'L', true);
    // $pdf->Ln(7);
    $pdf->writeHTMLCell(30, '', '', '', 'Lastname: ', 0, 0, 0, true, 'L', true);
    $pdf->writeHTMLCell(70, '', '', '', 'lqwek', 0, 0, 0, true, 'L', true);
    $pdf->Ln(7);
    $pdf->writeHTMLCell(30, '', '', '', 'Name: ', 0, 0, 0, true, 'L', true);
    $pdf->writeHTMLCell(60, '', '', '', 'aksdhjjh', 0, 0, 0, true, 'L', true);
    // $pdf->Ln(7);
    $pdf->writeHTMLCell(30, '', '', '', 'Lastname: ', 0, 0, 0, true, 'L', true);
    $pdf->writeHTMLCell(70, '', '', '', 'lqwek', 0, 0, 0, true, 'L', true);
    // $pdf->writeHTMLCell(40, '', '', '', 'middle name: ', 0, 0, 0, true, 'L', true);
    // $pdf->writeHTMLCell(40, '', '', '', $mname, 0, 0, 0, true, 'L', true);
    $pdf->Output('My-File-Name.pdf', 'I');

 ?>