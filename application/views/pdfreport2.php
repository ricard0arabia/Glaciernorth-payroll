<?php
	tcpdf();


$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Employee List";
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


$html .= <<<EOD
	

	<table>
	<tr>
	<br><br>
		<th><h3>Employee Id</h3></th>
		<th><h3>Name</h3></th>
		<th><h3>Department</h3></th>
		<th><h3>Position</h3></th>
		<th><h3>Gender</h3></th>
		<th><h3>Birthdate</h3></th>
		<th><h3>Basic Salary</h3></th>
	</tr>
	</table>

EOD;

$temp = 0;
$length = sizeof($emp);
while($temp < $length){

$html .= <<<EOD

	<style>
		td{

			font-size: 12px;
		}
	</style>
	<table>
	<tr>
	<br>
		<td>{$emp[$temp ]['employeeid']}</td>
		<td>{$emp[$temp ]['firstname']} {$emp[$temp ]['lastname']}</td>
		<td>{$emp[$temp ]['department']}</td>
		<td>{$emp[$temp ]['jobtitle']}</td>
		<td>{$emp[$temp ]['gender']}</td>
		<td>{$emp[$temp ]['birthdate']}</td>
		<td>{$emp[$temp ]['salary']}</td>
	
	</tr>
	
	
	</table>
	
	
EOD;

$temp += 1;
}



    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($html, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');

?>