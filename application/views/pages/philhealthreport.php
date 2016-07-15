<div class="nav-tabs-custom">
                <ul style = "font-weight: bold;" class="nav nav-tabs">
                  <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>payperiod" role="tab">Pay Period Table</a></li>
                <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>yearperiod" role ="tab">Year Period Table</a></li>
                <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>payslip" role ="tab">Payslip Table</a></li>                  
                <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>thirteenmonth" role ="tab">13th Month Pay</a></li>
                <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>report" role ="tab">Report Table</a></li>
                <li><a href="<?php echo site_url()."report/sss/".$this->uri->segment(3) ?>" role ="tab">SSS Reports</a></li>
                 <li  class = "active"><a href="<?php echo site_url()."report/phic/".$this->uri->segment(3) ?>" role ="tab">PHIC Report</a></li>
                  <li><a href="<?php echo site_url()."report/pagibig/".$this->uri->segment(3) ?>" role ="tab">Pag-Ibig Report</a></li>
                  <li><a href="<?php echo site_url()."report/wtax/".$this->uri->segment(3) ?>" role ="tab">W.Tax Report</a></li>
                        
                </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="basic-info">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">



   
<div class="row">
    <div class="col-lg-12">

         <div class = "panel-heading"><h5>Manage Philhealth Summary Report</h5></div> 
                <div class="divider"></div>
                <br><br>
                 <a class="waves-effect waves-light btn" href="<?php echo site_url()."report/phic/".$this->uri->segment(3)."/print" ?>">Print</a> 

            <div class="panel-body">
                <?php if(!empty($success) || !empty($_SESSION['success'])) { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $_SESSION['success']; $_SESSION['success'] = '';?>
                </div>
                <?php } ?>
            </div>

            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                            	<th>ID</th>
                                <th>Employee Name</th>
                                <th>PHIC Number</th>
                                <th>Cover Period</th>
                                <th>Employee Share</th>
                                <th>Employer Share</th>
                                <th>Total Contributions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $j=0;
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
                                 ?>
                            <tr class="<?php echo $style; ?> gradeX">
                            	<td class="center"><?php echo $i; ?></td>
                                <td><?php echo $_employees['firstname']." ".$_employees['lastname']; ?></td>
                                <td><?php echo $_employees['philhealth_no'] ?></td>
                                <td><?php echo $_employees['payfrom']." - ".$_employees['payto']; ?></td>
                                <td><?php echo $empshare; ?></td>
                                <td><?php echo $emplshare; ?></td>
                                <td><?php echo $totalshare; ?></td>
                            </tr>
                            <?php }} ?>
                            <tr>
                                <td colspan="4">Total</td>
                                <td><?php echo number_format($sum1,2); ?></td>
                                <td><?php echo number_format($sum2,2); ?></td>
                                <td><?php echo number_format($sum3,2); ?></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
</div>
</div>
</div>
</div>
