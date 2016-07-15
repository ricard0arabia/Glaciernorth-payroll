<?php
	tcpdf();
if($this->uri->segment(4) == 'print'){

$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Payslip";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);


$obj_pdf->AddPage();
ob_start();
    // we can have any view part here like HTML, PHP etc

$basic_salary = $ov[0]['salary'] / 2;

$basic_salary =  number_format($basic_salary, 2, '.', ',');

$overtime =  number_format($ov[0]['rate'], 2, '.', ',');

$netpay =  number_format($ov[0]['netpay'], 2, '.', ',');

$wtax  = number_format($ov[0]['witholdingtax'], 2, '.', ',');

$grosspay = number_format($ov[0]['grosspay'], 2, '.', ',');




$html = <<<EOD

	
	<table>
	<tr>
	<br>

		<th><h3>Name:</h3></th><td align = "center"><h3>{$ov[0]['firstname']}  {$ov[0]['middlename']}  {$ov[0]['lastname']}</h3></td><th></th>
	</tr>
	<br>
	<tr>
		<th><h3>Pay Period Covered:</h3></th><td align = "center"><h3>{$ov[0]['payfrom']} - {$ov[0]['payto']}</h3></td><th></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h3>Particulars</h3></th><th align = "center"><h3>Hours</h3></th><th align = "center"><h3>Total</h3></th>
	</tr>
	<tr>
	<br>
		<th><h3>Basic Salary</h3></th><th align = "center"><h4></h4></th><th align = "center"><h4>{$basic_salary}</h4></th>
	</tr>
	<tr>
	<br>
		<th><h4>Allowance</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th><h4>Adjustment</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th><h4>Overtime</h4></th><th align = "center"><h4>{$ov[0]['hours']}</h4></th><th align = "center"><h4>{$overtime}</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Regular</h4></th><th align = "center"><h4>0</h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
	<th align = "center"><h4>Sunday/Rest Day</h4></th><th align = "center"><h4>0</h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Special Holiday</h4></th><th align = "center"><h4>0</h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Legal Holiday</h4></th><th align = "center"><h4>0</h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Night Differential</h4></th><th align = "center"><h4>0</h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th><h3>Gross Salary</h3></th><th align = "center"><h4></h4></th><th align = "center"><h4>{$grosspay}</h4></th>
	</tr>
	<tr>
	<br>
		<th><h4>Deductions</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4></h4></th>
	</tr>
	<tr>
	<br>
	<th align = "center"><h4>SSS Contribution</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>{$ov[0]['sss']}</h4></th>
	</tr>
	<tr>
	<br>
	<th align = "center"><h4>HDMF Contribution</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>{$ov[0]['pagibig']}</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Philhealth Contribution</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>{$ov[0]['philhealth']}</h4></th>
	</tr>
	<tr>
	<br>
	<th align = "center"><h4>With Holding Tax</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>{$wtax}</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>SSS Loan</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Pag-Ibig Loan</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Savings Plan</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Healthcard</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Uniform</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Cash Advance</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Leave w/o Pay</h4></th><th align = "center"><h4>{$ov[0]['absent']}</h4></th><th align = "center"><h4>{$ov[0]['rate']}</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Others</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br><br>
		<th><h4></h4></th><th align = "center"><h3>NET PAY</h3></th><th align = "center"><h4>{$netpay}</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"colspan = "3"><h4>I hereby acknowledge receipt of the above amount</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Authenticated By:</h4></th><th></th><th align = "center"><h4>Received By:</h4></th>
	</tr>
	<tr>
	<br><br>
		<th align = "center"><h4>________________________</h4></th><th></th><th align = "center"><h4>________________________</h4></th>
	</tr>
	</table>
	
	
EOD;






    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($html, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
}
else{

$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Payslip";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);


$obj_pdf->AddPage();
ob_start();
    // we can have any view part here like HTML, PHP etc


	if(!empty($ov)) {
							$i=0;
							foreach($ov as $_ov) { 					
								if($i%2==0) { 
									$style = "odd";
									$i++;
								} else {
									$style = "even"; 
									$i++;
								}					
								$j++; 



$basic_salary = $_ov['salary'] / 2;

$basic_salary =  number_format($basic_salary, 2, '.', ',');

$overtime =  number_format($_ov['overtime'], 2, '.', ',');

$netpay =  number_format($_ov['netpay'], 2, '.', ',');

$wtax  = number_format($_ov['witholdingtax'], 2, '.', ',');

$grosspay = number_format($_ov['grosspay'], 2, '.', ',');




$html .= <<<EOD

	
	<table>
	<tr>
	<br>

		<th><h3>Name:</h3></th><td align = "center"><h3>{$_ov['firstname']}  {$_ov['middlename']}  {$_ov['lastname']}</h3></td><th></th>
	</tr>
	<br>
	<tr>
		<th><h3>Pay Period Covered:</h3></th><td align = "center"><h3>{$_ov['payfrom']} - {$_ov['payto']}</h3></td><th></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h3>Particulars</h3></th><th align = "center"><h3>Hours</h3></th><th align = "center"><h3>Total</h3></th>
	</tr>
	<tr>
	<br>
		<th><h3>Basic Salary</h3></th><th align = "center"><h4></h4></th><th align = "center"><h4>{$basic_salary}</h4></th>
	</tr>
	<tr>
	<br>
		<th><h4>Allowance</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th><h4>Adjustment</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th><h4>Overtime</h4></th><th align = "center"><h4>{$_ov['hours']}</h4></th><th align = "center"><h4>{$overtime}</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Regular</h4></th><th align = "center"><h4>0</h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
	<th align = "center"><h4>Sunday/Rest Day</h4></th><th align = "center"><h4>0</h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Special Holiday</h4></th><th align = "center"><h4>0</h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Legal Holiday</h4></th><th align = "center"><h4>0</h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Night Differential</h4></th><th align = "center"><h4>0</h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th><h3>Gross Salary</h3></th><th align = "center"><h4></h4></th><th align = "center"><h4>{$grosspay}</h4></th>
	</tr>
	<tr>
	<br>
		<th><h4>Deductions</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4></h4></th>
	</tr>
	<tr>
	<br>
	<th align = "center"><h4>SSS Contribution</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>{$_ov['sss']}</h4></th>
	</tr>
	<tr>
	<br>
	<th align = "center"><h4>HDMF Contribution</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>{$_ov['pagibig']}</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Philhealth Contribution</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>{$_ov['philhealth']}</h4></th>
	</tr>
	<tr>
	<br>
	<th align = "center"><h4>With Holding Tax</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>{$wtax}</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>SSS Loan</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Pag-Ibig Loan</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Savings Plan</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Healthcard</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Uniform</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Cash Advance</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Leave w/o Pay</h4></th><th align = "center"><h4>{$_ov['absent']}</h4></th><th align = "center"><h4>{$_ov['rate']}</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Others</h4></th><th align = "center"><h4></h4></th><th align = "center"><h4>0</h4></th>
	</tr>
	<tr>
	<br><br>
		<th><h4></h4></th><th align = "center"><h3>NET PAY</h3></th><th align = "center"><h4>{$netpay}</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"colspan = "3"><h4>I hereby acknowledge receipt of the above amount</h4></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Authenticated By:</h4></th><th></th><th align = "center"><h4>Received By:</h4></th>
	</tr>
	<tr>
	<br><br>
		<th align = "center"><h4>________________________</h4></th><th></th><th align = "center"><h4>________________________</h4></th>
	
	</tr>

	</table>
	<br>
	<br>

	
EOD;




}
}



    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($html, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');

}
?>