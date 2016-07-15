

 <?php $deduction = ($contri[0]['sss']/2) + ($contri[0]['philhealth']/2) + ($contri[0]['pagibig']/2); 
                                      //if($payperiod[0]['monthend'] == 1) { 
                                       // $taxable_income = ($emp[0]['salary']/2) + $ot[0]['rate'] - $ab[0]['rate'] - $deduction;
                                      //} else {
                                        
                                    $grosspay = ($emp[0]['salary']/2) + $ot[0]['rate'];
                                        $taxable_income = $grosspay - $ab[0]['rate'] - $deduction;
                                      //}
                                      
                                       $status = $emp[0]['cstatus'];
                                        foreach($tax as $_tax) {
                                            $a = explode("/",$_tax['cstatus']);
                                            
                                            if($status == $a[0]) {
                                                $stat = $a[0];
                                                if($_tax['minrange'] < $taxable_income) {
                                                    if($_tax['maxrange'] > $taxable_income) {
                                                        if (strpos($_tax['cstatus'],$stat) !== false) {
                                                            $tax1 = $_tax['tax1'];
                                                            $tax2 = $_tax['tax2'];
                                                            $min = $_tax['minrange'];
                                                        }
                                                    }
                                                }   
                                            } else {
                                                if($status == $a[1]) {
                                                    $stat = $a[1];
                                                    if($_tax['minrange'] < $taxable_income) {
                                                        if($_tax['maxrange'] > $taxable_income) {
                                                            if (strpos($_tax['cstatus'],$stat) !== false) {
                                                                $tax1 = $_tax['tax1'];
                                                                $tax2 = $_tax['tax2'];
                                                                $min = $_tax['minrange'];
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                        $excess = ($taxable_income - $min) * $tax2;
                                        $with_holdingtax = $tax1 + $excess;
                                        $netpay = $taxable_income - $with_holdingtax;
                                        
                                    ?>

<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  

                      <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>payperiod" role ="tab">Pay Period Table</a></li>
                      <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>yearperiod" role ="tab">Year Period Table</a></li>
                    <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>payslip" role="tab">Payslip Table</a></li>
                  

                      <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>thirteenmonth" role ="tab">13th Month Pay</a></li>
                     <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>report" role ="tab">Reports Table</a></li>
                         <li><a href="<?php echo site_url() ?>payslip/<?php echo $this->uri->segment(2)."/".$this->uri->segment(3); ?>" role="tab">Payslip List </a></li>
                <?php if($_SESSION['userLevel'] == 1) { ?>
                <?php if($this->uri->segment(4) == 'edit') { ?>
                   <li class="active"><a href="#"role ="tab">Edit Payslip</a></li>
               <?php } else { ?>  
                    <li class="active"><a href="#"role ="tab">Add Payslip</a></li>
                 <?php }} else { ?>
                 <li class="active"><a href="#"role ="tab">View Payslip</a></li>
                  <?php } ?>


                   <!-- <li><a href="<?php echo site_url() ?>payslip/<?php echo $this->uri->segment(2)."/".$this->uri->segment(3); ?>">Payslip Table</a></li>  -->

             

                     </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="basic-info">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">
<div class="row">
    <div class="col-lg-12">
      

       <?php if($_SESSION['userLevel'] == 1) { ?>
                <?php if($this->uri->segment(4) == 'edit') { ?>
                 <div class = "panel-heading"><h5>Edit -  Manage Employee Payslip</h5></div> 
                <div class="divider"></div>
                <br><br>
               <?php } else { ?>  
                    <div class = "panel-heading"><h5>Add -  Manage Employee Payslip</h5></div> 
                <div class="divider"></div>
                <br><br>
                 <?php }} else { ?>
              <div class = "panel-heading"><h5>View -  Manage Employee Payslip</h5></div> 
                <div class="divider"></div>
                <br><br>
                  <?php } ?>

            <!-- /.panel-heading -->
            <form action="" method="post" enctype="multipart/form-data" id="empform" role="form" name="empform">
                <?php if(!empty($disMsg) || !empty($_SESSION['disMsg'])) { ?>
                <div class="panel-body">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $_SESSION['disMsg']; $_SESSION['disMsg'] =''; ?>    
                    </div> 
                </div>
                <?php } ?>

                <div class="box-body">
                    <div class="row">
                    	<div class="col-lg-6">
                            <div class="form-group">
                                <label>Employee Name</label>
                                <?php if($this->uri->segment(4) == 'edit' || $this->uri->segment(4) == 'addnew') { ?>
                                <input type="text" id="empid" name="empid" class="form-control" disabled value="<?php if(!empty($_POST['empid'])) { echo $_POST['empid']; } elseif(!empty($emp[0]['firstname'])) { echo $emp[0]['firstname']." ".$emp[0]['lastname']; } ?>">
                                <input type="hidden" id="userid" name="userid" class="form-control" value="<?php echo $emp[0]['user_id']; ?>">
                                <?php } else { ?>
                                <select class="form-control" name="userid">
                                    <?php if(!empty($emp)) {
                                            foreach($emp as $_emp) { ?>
                                    <option value="<?php echo $_emp['user_id'];?>"><?php echo $_emp['firstname']." ".$_emp['lastname'];?></option>
                                    <?php }} ?>
                                </select>
                                <?php } ?>
                            </div>
                    	</div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Basic Salary</label>
                                <input type="text" id="salary" name="salary" class="form-control" disabled value="<?php if(!empty($_POST['salary'])) { echo $_POST['salary']; } elseif(!empty($emp[0]['salary'])) { echo $emp[0]['salary']; } ?>" placeholder="Basic Salary">
                                
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Pay Period</label>
                                <input type="text" id="payperiod" name="payperiod" class="form-control" disabled value="<?php if(!empty($_POST['payperiod'])) { echo $_POST['payperiod']; } elseif(!empty($payperiod[0]['payfrom'])) { echo $payperiod[0]['payfrom']." - ".$payperiod[0]['payto']; } ?>" placeholder="SSS">
                                <input type="hidden" id="payperiod2" name="payperiod2" class="form-control" value="<?php if(!empty($_POST['payperiod2'])) { echo $_POST['payperiod2']; } elseif(!empty($payperiod[0]['payfrom'])) { echo $payperiod[0]['payfrom']." - ".$payperiod[0]['payto']; } ?>" placeholder="SSS">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Month End</label>
                                <input type="text" id="monthend" name="monthend" class="form-control" disabled value="<?php if(!empty($_POST['monthend'])) { echo $_POST['monthend']; } elseif(!empty($payperiod[0]['monthend'])) { if($payperiod[0]['monthend'] == 1) { echo "Yes"; } else { echo "No"; }} ?>" placeholder="Month End">
                                <input type="hidden" id="monthend2" name="monthend2" class="form-control" value="<?php if(!empty($_POST['monthend2'])) { echo $_POST['monthend2']; } elseif(!empty($payperiod[0]['monthend'])) { echo $payperiod[0]['monthend']; } ?>" placeholder="Month End">
                            </div>
                        </div>
                      
                    </div>
                </div>

                    <div class="panel-heading"><i class="fa fa-clock-o text-primary"></i>&nbsp;&nbsp;Overtime  </div> 

                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>No. of Hours</label>
                                <input type="text" id="othours" name="othours" class="form-control" disabled value="<?php if(!empty($_POST['othours'])) { echo $_POST['othours']; } elseif(!empty($ot[0]['hours'])) { echo $ot[0]['hours']; } ?>" placeholder="No. of Hours">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" id="otrate" name="otrate" class="form-control" disabled value="<?php if(!empty($_POST['otrate'])) { echo $_POST['otrate']; } elseif(!empty($ot[0]['rate'])) { echo number_format($ot[0]['rate'],2); } ?>" placeholder="Overtime Rate">
                                <input type="hidden" id="otrate2" name="otrate2" class="form-control" value="<?php if(!empty($_POST['otrate2'])) { echo $_POST['otrate2']; } elseif(!empty($ot[0]['rate'])) { echo $ot[0]['rate']; } ?>" placeholder="Overtime Rate">
                            </div>
                        </div>
                    </div>
                </div>

            <div class="panel-heading"><i class="fa fa-clock-o text-primary"></i>&nbsp;&nbsp;Gross Pay  </div> 

            <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Gross Pay </label>
                               <input type="text" id="grosspay" name="grosspay" class="form-control" disabled value="<?php if(!empty($_POST['grosspay'])) { echo $_POST['grosspay']; } elseif(!empty($grosspay)) { echo number_format($grosspay,2); } ?>" placeholder="Gross Pay">
                                <input type="hidden" id="grosspay2" name="grosspay2" class="form-control" value="<?php if(!empty($_POST['grosspay2'])) { echo $_POST['grosspay2']; } elseif(!empty($grosspay)) { echo $grosspay; } ?>" placeholder="Gross Pay">
                            </div>
                        </div>
                      </div>
            </div>

              <div class="panel-heading"><i class="fa fa-tasks text-primary"></i>&nbsp;&nbsp;Mandatory Contributions  </div> 
                <div class="panel-body">
                    <div class="row">

                  <div class="col-lg-6">
                            <div class="form-group">
                                <label>SSS</label>
                                <input type="number" id="sss" name="sss" class="form-control" disabled step="any" value="<?php if(!empty($_POST['sss'])) { echo $_POST['sss']; } elseif(!empty($contri[0]['sss'])) { echo $contri[0]['sss']; } ?>" placeholder="SSS">
                                <input type="hidden" id="sss2" name="sss2" class="form-control" value="<?php if(!empty($_POST['sss2'])) { echo $_POST['sss2']; } elseif(!empty($contri[0]['sss'])) { echo $contri[0]['sss']/2; } ?>" placeholder="SSS">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Philhealth</label>
                                <input type="number" id="philhealth" name="philhealth" class="form-control" disabled value="<?php if(!empty($_POST['philhealth'])) { echo $_POST['philhealth']; } elseif(!empty($contri[0]['philhealth'])) { echo $contri[0]['philhealth']; } ?>" placeholder="Philhealth">
                                <input type="hidden" id="philhealth2" name="philhealth2" class="form-control" value="<?php if(!empty($_POST['philhealth2'])) { echo $_POST['philhealth2']; } elseif(!empty($contri[0]['philhealth'])) { echo $contri[0]['philhealth']/2; } ?>" placeholder="Philhealth">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Pag-Ibig</label>
                                <input type="number" id="pagibig" name="pagibig" class="form-control" disabled step="any" value="<?php if(!empty($_POST['pagibig'])) { echo $_POST['pagibig']; } elseif(!empty($contri[0]['pagibig'])) { echo $contri[0]['pagibig']; } ?>" placeholder="Pag-Ibig">
                                <input type="hidden" id="pagibig2" name="pagibig2" class="form-control" value="<?php if(!empty($_POST['pagibig2'])) { echo $_POST['pagibig2']; } elseif(!empty($contri[0]['pagibig'])) { echo $contri[0]['pagibig']/2; } ?>" placeholder="Pag-Ibig">
                            </div>
                        </div>
                    </div>
                </div>

       
               <div class="panel-heading"><i class="fa fa-tasks text-primary"></i>&nbsp;&nbsp;Absences  </div> 
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>No. of day/s</label>
                                <input type="text" id="absent" name="absent" class="form-control" disabled value="<?php if(!empty($_POST['absent'])) { echo $_POST['absent']; } elseif(!empty($ab[0]['absent'])) { echo $ab[0]['absent']; } ?>" placeholder="No of Days">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" id="abrate" name="abrate" class="form-control" disabled value="<?php if(!empty($_POST['abrate'])) { echo $_POST['abrate']; } elseif(!empty($ab[0]['rate'])) { echo number_format($ab[0]['rate'],2); } ?>" placeholder="Absent Rate">
                                <input type="hidden" id="abrate2" name="abrate2" class="form-control" value="<?php if(!empty($_POST['abrate2'])) { echo $_POST['abrate2']; } elseif(!empty($ab[0]['rate'])) { echo $ab[0]['rate']; } ?>" placeholder="Absent Rate">
                            </div>
                        </div>
                    </div>
                </div>

               <div class="panel-heading"><i class="fa fa-money text-primary"></i>&nbsp;&nbsp;Net Pay </div> 
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>With Holding Tax</label>
                               
                                <input type="text" id="withholdingtax" name="withholdingtax" class="form-control" disabled value="<?php if(!empty($_POST['withholdingtax'])) { echo $_POST['withholdingtax']; } elseif(!empty($with_holdingtax)) { echo number_format($with_holdingtax,2); } ?>" placeholder="With Holding Tax">
                                <input type="hidden" id="withholdingtax2" name="withholdingtax2" class="form-control" value="<?php if(!empty($_POST['withholdingtax2'])) { echo $_POST['withholdingtax2']; } elseif(!empty($with_holdingtax)) { echo $with_holdingtax; } ?>" placeholder="With Holding Tax">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Net Pay</label>
                                <input type="text" id="netpay" name="netpay" class="form-control" disabled value="<?php if(!empty($_POST['netpay'])) { echo $_POST['netpay']; } elseif(!empty($netpay)) { echo number_format($netpay,2); } ?>" placeholder="Net Pay">
                                <input type="hidden" id="netpay2" name="netpay2" class="form-control" value="<?php if(!empty($_POST['netpay2'])) { echo $_POST['netpay2']; } elseif(!empty($netpay)) { echo $netpay; } ?>" placeholder="Net Pay">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <?php if($this->uri->segment(4) == "edit") { ?>
                                <!--<button type="submit" name="saveinfo" class="btn btn-lg btn-primary btn-block">Save</button>-->
                                <?php } else { ?>
                                <button type="submit" name="addnew" class="btn btn-lg btn-primary btn-block">Save</button>
                                <?php } ?>
                            </div>    
                        </div>
                    </div>
                </div>
            </form>
        
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
</div>
</div>
</div>
</div>

