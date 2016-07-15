<?php
	tcpdf();

if($this->uri->segment(2) == 'sss'){
$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Social Security Systems Reports";
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
	<br><br>
	<tr>
	
		<th><h3>Id</h3></th>
		<th><h3>Employee Name</h3></th>
		<th><h3>SSS Number</h3></th>
		<th><h3>Cover Period</h3></th>
		<th><h3>Employee Share</h3></th>
		<th><h3>Employer Share</h3></th>
		<th><h3>Total Contributions</h3></th>
	</tr>
	</table>

EOD;

							$j=0;
							if(is_array($employees) || is_object($employees)) {
							$i=0;
                            $sum1 = 0;
                            $sum2 = 0;
                            $sum3 = 0;
							foreach($employees as $_employees) { 					
								if($i%2==0) { 
									$style = "odd";
									$i++;
								} else {
									$style = "even"; 
									$i++;
								}					
								$j++; 

                                $empshare = $_employees['sss'];
                                $sum1 = $empshare + $sum1;

                                $emplshare = ($empshare)*2;
                                $sum2 = $emplshare + $sum2;

                                $totalshare = $empshare + $emplshare;
                                $sum3 = $totalshare + $sum3;

                              $sum1 = number_format($sum1,2);
                               $sum2 =  number_format($sum2,2);
                                $sum3 = number_format($sum3,2);
$html .= <<<EOD

	<style>
		td{

			font-size: 12px;
		}
	</style>
	<table>
	<br><br>
                            <tr>
                           
                            	<td>{$i}</td>
                                <td>{$_employees['firstname']} {$_employees['lastname']}</td>
                                <td>{$_employees['sss_no']}</td>
                                <td>{$_employees['payfrom']} - {$_employees['payto']}</td>
                                <td align = "center">Php. {$empshare}</td>
                                <td align = "center">Php. {$emplshare}</td>
                                <td align = "center">Php. {$totalshare}</td>
                            </tr>
                          
                        
                            
	
	<br><br>
	</table>


	
	
EOD;
}
}

$html .= <<<EOD
<style>
		td{

			font-size: 12px;
		}
	</style>
<table>
<br><br>
	    					<tr>
	    				
                                <td colspan="4"><h3>Total</h3></td>
                                <td align = "center"><h3>Php. {$sum1}</h3></td>
                                <td align = "center"><h3>Php. {$sum2}</h3></td>
                                <td align = "center"><h3>Php. {$sum3}</h3></td>
                            </tr>
</table>



EOD;



    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($html, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
}elseif ($this->uri->segment(2) == 'phic'){

$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Philippine Health Insurance Corporation Reports";
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
	<br><br>
	<tr>
	
		<th><h3>Id</h3></th>
		<th><h3>Employee Name</h3></th>
		<th><h3>Philhealth Number</h3></th>
		<th><h3>Cover Period</h3></th>
		<th><h3>Employee Share</h3></th>
		<th><h3>Employer Share</h3></th>
		<th><h3>Total Contributions</h3></th>
	</tr>
	</table>

EOD;

							 $j=0;
							if(is_array($employees) || is_object($employees)) {
							$i=0;
                            $sum1 = 0;
                            $sum2 = 0;
                            $sum3 = 0;
							foreach($employees as $_employees) { 					
								if($i%2==0) { 
									$style = "odd";
									$i++;
								} else {
									$style = "even"; 
									$i++;
								}					
								$j++; 

                                $empshare = $_employees['philhealth'];
                                $sum1 = $empshare + $sum1;

                                $emplshare = ($empshare)*2;
                                $sum2 = $emplshare + $sum2;

                                $totalshare = $empshare + $emplshare;
                                $sum3 = $totalshare + $sum3;
$html .= <<<EOD

	<style>
		td{

			font-size: 12px;
		}
	</style>
	<table>
	<br><br>
                            <tr>
                           
                            	<td>{$i}</td>
                                <td>{$_employees['firstname']} {$_employees['lastname']}</td>
                                <td>{$_employees['philhealth_no']}</td>
                                <td>{$_employees['payfrom']} - {$_employees['payto']}</td>
                                <td align = "center">Php. {$empshare}</td>
                                <td align = "center">Php. {$emplshare}</td>
                                <td align = "center">Php. {$totalshare}</td>
                            </tr>
                          
                        
                            
	
	<br><br>
	</table>


	
	
EOD;
}
}

$html .= <<<EOD
<style>
		td{

			font-size: 12px;
		}
	</style>
<table>
<br><br>
	    					<tr>
	    				
                               <td colspan="4"><h3>Total</h3></td>
                                <td align = "center"><h3>Php. {$sum1}</h3></td>
                                <td align = "center"><h3>Php. {$sum2}</h3></td>
                                <td align = "center"><h3>Php. {$sum3}</h3></td>
                            </tr>
</table>



EOD;



    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($html, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');

}elseif ($this->uri->segment(2) == 'pagibig'){

$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Home Development Mutual Fund Reports";
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
	<br><br>
	<tr>
	
		<th><h3>Id</h3></th>
		<th><h3>Employee Name</h3></th>
		<th><h3>HDMF Number</h3></th>
		<th><h3>Cover Period</h3></th>
		<th><h3>Employee Share</h3></th>
		<th><h3>Employer Share</h3></th>
		<th><h3>Total Contributions</h3></th>
	</tr>
	</table>

EOD;

						$j=0;
							if(is_array($employees) || is_object($employees)) {
							$i=0;
                            $sum1 = 0;
                            $sum2 = 0;
                            $sum3 = 0;
							foreach($employees as $_employees) { 					
								if($i%2==0) { 
									$style = "odd";
									$i++;
								} else {
									$style = "even"; 
									$i++;
								}					
								$j++; 

                                $empshare = $_employees['pagibig'];
                                $sum1 = $empshare + $sum1;

                                $emplshare = ($empshare);
                                $sum2 = $emplshare + $sum2;

                                $totalshare = $empshare + $emplshare;
                                $sum3 = $totalshare + $sum3;
$html .= <<<EOD
<style>
		td{

			font-size: 12px;
		}
	</style>
	
	<table>
	<br><br>
                            <tr>
                           
                            	<td>{$i}</td>
                                <td>{$_employees['firstname']} {$_employees['lastname']}</td>
                                <td>{$_employees['hdmf_no']}</td>
                                <td>{$_employees['payfrom']} - {$_employees['payto']}</td>
                                <td align = "center">Php. {$empshare}</td>
                                <td align = "center">Php. {$emplshare}</td>
                                <td align = "center">Php. {$totalshare}</td>
                            </tr>
                          
                        
                            
	
	<br><br>
	</table>


	
	
EOD;
}
}

$html .= <<<EOD
<style>
		td{

			font-size: 12px;
		}
	</style>
<table>
<br><br>
	    					<tr>
	    				
                                <td colspan="4"><h3>Total</h3></td>
                                <td align = "center"><h3>Php. {$sum1}</h3></td>
                                <td align = "center"><h3>Php. {$sum2}</h3></td>
                                <td align = "center"><h3>Php. {$sum3}</h3></td>
                            </tr>
</table>



EOD;



    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($html, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');

}elseif ($this->uri->segment(2) == 'wtax'){

$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Withholding Tax Reports";
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
	<br><br>
	<tr>
	
		<th><h3>Id</h3></th>
		<th><h3>Employee Name</h3></th>
		<th><h3>HDMF Number</h3></th>
		<th><h3>Cover Period</h3></th>
		<th><h3>Withholding Tax</h3></th>
	</tr>
	</table>

EOD;

						$j=0;
							if(is_array($employees) || is_object($employees)) {
							$i=0;
                         
							foreach($employees as $_employees) { 					
								if($i%2==0) { 
									$style = "odd";
									$i++;
								} else {
									$style = "even"; 
									$i++;
								}					
								$j++; 

$html .= <<<EOD
<style>
		td{

			font-size: 12px;
		}
	</style>
	
	<table>
	<br><br>
                            <tr>
                           
                            	<td>{$i}</td>
                                <td>{$_employees['firstname']} {$_employees['lastname']}</td>
                                <td>{$_employees['tin_no']}</td>
                                <td>{$_employees['payfrom']} - {$_employees['payto']}</td>
                                <td align = "center">Php. {$_employees['witholdingtax']}</td>
                            </tr>
                          
                        
                            
	
	<br><br>
	</table>


	
	
EOD;
}
}



    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($html, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');

}


?>