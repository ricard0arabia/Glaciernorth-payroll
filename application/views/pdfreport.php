<?php
	tcpdf();


$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Payslip";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 9));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 11.5);
$obj_pdf->setCellHeightRatio(0.66);
$obj_pdf->setFontSubsetting(false);


$obj_pdf->AddPage();
ob_start();
    // we can have any view part here like HTML, PHP etc

$basic_salary = $payslip->salary / 2;

$basic_salary =  number_format($basic_salary, 2, '.', ',');

$overtime =  number_format($payslip->total_overtime_pay, 2, '.', ',');

$netpay =  number_format($payslip->net_pay, 2, '.', ',');

$wtax  = number_format($payslip->withholding_tax, 2, '.', ',');

$grosspay = number_format($payslip->gross_salary, 2, '.', ',');




$html = <<<EOD

	
	<table>
	<tr>
	<br>

		<th><h4>Name:</h4></th><td align = "center">{$payslip->lastname}  {$payslip->firstname}  {$payslip->middlename}</td><th></th>
	</tr>
	<br>
	<tr>
		<th><h4>Pay Period Covered:</h4></th><td align = "center">{$payslip->period}</td><th></th>
	</tr>
	<tr>
	<br>
		<th align = "center"><h4>Particulars</h4></th><th align = "center"><h4>Hours</h4></th><th align = "center"><h4>Total</h4></th>
	</tr>
	<tr>
	<br>
		<th><h4>Basic Salary</h4></th><th align = "center"><h4></h4></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. {$basic_salary}</th>
	</tr>
	<tr>
	<br>
		<th>Allowance</th><th align = "center"><h4></h4></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. 0</th>
	</tr>
	<tr>
	<br>
		<th>Adjustment</th><th align = "center"><h4></h4></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. 0</th>
	</tr>
	<tr>
	<br>
		<th>Overtime</th><th align = "center"><h4>{$payslip->total_overtime_hours} Hrs.</h4></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. {$overtime}</th>
	</tr>
	<tr>
	<br>
		<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Regular</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. {$payslip->ordinary_ot_pay}</th>
	</tr>
	<tr>
	<br>
		<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sunday/Rest Day</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. {$payslip->rest_day_pay}</th>
	</tr>
	<tr>
	<br>
		<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Special Holiday</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. {$payslip->special_holiday_pay}</th>
	</tr>
	<tr>
	<br>
		<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Legal Holiday</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. {$payslip->regular_holiday_pay}</th>
	</tr>
	<tr>
	<br>
		<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Night Differential</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. {$payslip->night_diff_pay}</th>
	</tr>
	<tr>
	<br>
		<th><h4>Gross Salary</h4></th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php.{$grosspay}</th>
	</tr>
	<tr>
	<br>
		<th>Deductions</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
	</tr>
	<tr>
	<br>
	<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSS Contrib.</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. {$payslip->sss_contrib}</th>
	</tr>
	<tr>
	<br>
	<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HDMF Contrib.</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. {$payslip->hdmf_contrib}</th>
	</tr>
	<tr>
	<br>
		<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Philhealth Contrib</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. {$payslip->philhealth_contrib}</th>
	</tr>
	<tr>
	<br>
	<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;With Holding Tax</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. {$wtax}</th>
	</tr>
	<tr>
	<br>
		<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSS Loan</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. 0</th>
	</tr>
	<tr>
	<br>
		<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pag-Ibig Loan</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. 0</th>
	</tr>
	<tr>
	<br>
		<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Savings Plan</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. 0</th>
	</tr>
	<tr>
	<br>
		<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Healthcard</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. 0</th>
	</tr>
	<tr>
	<br>
		<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Uniform</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. 0</th>
	</tr>
	<tr>
	<br>
		<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cash Advance</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. 0</th>
	</tr>
	<tr>
	<br>
		<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Leave w/o Pay</th><th align = "center">{$payslip->deductions}</th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. {$payslip->deductions}</th>
	</tr>
	<tr>
	<br>
		<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Others</th><th align = "center"></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. 0</th>
	</tr>
	<tr>
	<br><br>
		<th><h4></h4></th><th align = "center"><h4>NET PAY</h4></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Php. {$netpay}</th>
	</tr>
	<tr>
	<br>
	<br>
		<td align = "center"colspan = "3">I hereby acknowledge receipt of the above amount</td>
	</tr>
	<tr>
	<br>
	<br>
		<th align = "center"><h5>Authenticated By:</h5></th><th></th><th align = "center"><h5>Received By:</h5></th>
	</tr>
	<tr>
	<br><br>
		<td align = "center">__________________</td><td></td><td align = "center">__________________</td>
	</tr>
	</table>
	
	
EOD;






    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($html, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');

?>