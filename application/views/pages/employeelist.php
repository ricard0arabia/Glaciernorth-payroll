<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                    <!-- overtime -->
                     <?php if($this->uri->segment(1) == 'overtime') { ?>

                         <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>overtime" role="tab">Payperiod - Overtime Table </a></li>
                          <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>absences" role="tab">Payperiod - Absences Table</a></li>
                           <li class = "active"><a href="#" role="tab">Overtime List Table</a></li>

                            <?php if($_SESSION['userLevel'] == 1) {
                                        if($this->uri->segment(1) == 'overtime' && $this->uri->segment(3) != '') { ?>
                                <li>
                                    <a href="<?php echo site_url() ?>overtime/<?php echo $this->uri->segment(2)."/".$this->uri->segment(3); ?>/add">Add Employees Overtime</a>
                                </li>
                                <?php }} ?>

                             <!-- payslip -->        
                    <?php } elseif($this->uri->segment(1) == 'payslip') { ?>

                        <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>payperiod" role ="tab">Pay Period Table</a></li>
                      <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>yearperiod" role ="tab">Year Period Table</a></li>
                    <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>payslip" role="tab">Payslip Table</a></li>
                    
                <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>thirteenmonth" role ="tab">13th Month Pay</a></li>
                   <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>report" role ="tab">Reports Table</a></li>

                   <li class = "active"><a href="#" role="tab">Payslip List</a></li>

                      <?php if($_SESSION['userLevel'] == 1) {
                                        if($this->uri->segment(1) == 'payslip' && $this->uri->segment(3) != '') { ?>
                                <li >
                                    <a href="<?php echo site_url() ?>payslip/<?php echo $this->uri->segment(2)."/".$this->uri->segment(3); ?>/addnew">Add Payslip</a>
                                </li>
                                <?php }} ?>

                              <!-- absences -->   
                   <?php }  elseif($this->uri->segment(1) == 'absences') { ?>

                         <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>overtime" role="tab">Payperiod - Overtime Table</a></li>
                          <li style = "font-weight: bold;"><a href="#" role="tab">Payperiod - Absences Table</a></li>
                            <li class = "active"><a href="#" role="tab">Absences Table</a></li>
                               <?php if($_SESSION['userLevel'] == 1) {
                                        if($this->uri->segment(1) == 'absences' && $this->uri->segment(3) != '') { ?>
                                <li>
                                    <a href="<?php echo site_url() ?>absences/<?php echo $this->uri->segment(2)."/".$this->uri->segment(3); ?>/add">Add Employees Absences</a>
                                </li>
                                <?php }} ?>
                   <?php } else { ?>

                     <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>payperiod" role ="tab">Pay Period Table</a></li>
                      <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>yearperiod" role ="tab">Year Period Table</a></li>
                    <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>payslip" role="tab">Payslip Table</a></li>
                    
                <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>thirteenmonth" role ="tab">13th Month Pay</a></li>

                <li class = "active"><a href="#" role="tab">13th Month List</a></li>

                  <?php if($_SESSION['userLevel'] == 1) {
                            if($this->uri->segment(1) == 'thirteenmonth' && $this->uri->segment(3) != '') { ?>
                            <li >
                                <a href="<?php echo site_url() ?>thirteenmonth/<?php echo $this->uri->segment(2)."/".$this->uri->segment(3); ?>/add">Add 13th Month Pay</a>
                            </li>
                            <?php }} ?>

                <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>report" role ="tab">Reports</a></li>

                <li class = "active"><a href="#" role="tab">Summary Report</a></li>

                  <?php if($_SESSION['userLevel'] == 1) {
                            if($this->uri->segment(1) == 'report' && $this->uri->segment(3) != '') { ?>
                            <li >
                                <a href="<?php echo site_url() ?>report/<?php echo $this->uri->segment(2)."/".$this->uri->segment(3); ?>/add">Add New Report</a>
                            </li>
                            <?php }} ?>
                    <?php } ?>
                        
                </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">



<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
  

            
                  <?php if($this->uri->segment(1) == 'overtime') { ?>

                     <div class = "panel-heading"><h5>Name -  Manage Employees Overtime</h5></div> 
                <div class="divider"></div>
                <br><br>

                <?php } elseif($this->uri->segment(1) == 'payslip') { ?>

                  <div class = "panel-heading"><h5>Name -  Manage Employees Payslip</h5></div> 
                <div class="divider"></div>
                <br><br>

               <?php } elseif($this->uri->segment(1) == 'absences') { ?>

                     <div class = "panel-heading"><h5>Name -  Manage Employees Absences</h5></div> 
                <div class="divider"></div>
                <br><br>

                <?php } elseif($this->uri->segment(1) == 'report') { ?>

                     <div class = "panel-heading"><h5>Summary Report</h5></div> 
                <div class="divider"></div>
                <br><br>

                <?php } else { ?>

                  <div class = "panel-heading"><h5>Name -  Manage Employees 13th Month Pay</h5></div> 
                <div class="divider"></div>
                <br><br>

                <?php } ?>
           
            <div class="box-body">
                <?php if(!empty($success) || !empty($_SESSION['success'])) { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $_SESSION['success']; $_SESSION['success'] = '';?>
                </div>
                <?php } ?>
            </div>

            <!-- /.panel-heading -->
            <div class="box-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $j=0;
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
                                $j++; ?>
                            <tr class="<?php echo $style; ?> gradeX">
                                <td class="center"><?php echo $_employees['id']; ?></td>
                                <td><?php echo $_employees['firstname']; ?></td>
                                <td><?php echo $_employees['lastname']; ?></td>
                                <td><?php if($_employees['status'] == 1) { echo "Enabled"; } else { echo "Disabled"; } ?></td>
                                <?php if($this->uri->segment(1) == 'transactions') { ?>
                                <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."transactions/view/".$this->uri->segment(3)."/edit/".$_employees['id']; ?>">Edit</a> | <a class="waves-effect waves-light btn" href="<?php echo site_url()."transactions/delete/".$_employees['id']; ?>" onClick="return confirm('Are you sure you want to remove this record?')">Delete</a></td>
                                <?php } elseif($this->uri->segment(1) == 'overtime') { 
                                        if($_SESSION['userLevel'] == 1) { ?>
                                    <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."overtime/view/".$this->uri->segment(3)."/edit/".$_employees['user_id']; ?>">Edit</a> | <a class="waves-effect waves-light btn" href="<?php echo site_url()."overtime/view/".$this->uri->segment(3)."/delete/".$_employees['id']; ?>" onClick="return confirm('Are you sure you want to remove this record?')">Delete</a></td>
                                    <?php } else { ?>
                                    <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."overtime/view/".$this->uri->segment(3)."/edit/".$_employees['user_id']; ?>">View</a></td>
                                    <?php } ?>
                                <?php } elseif($this->uri->segment(1) == 'absences') { 
                                        if($_SESSION['userLevel'] == 1) { ?>
                                    <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."absences/view/".$this->uri->segment(3)."/edit/".$_employees['user_id']; ?>">Edit</a> | <a class="waves-effect waves-light btn" href="<?php echo site_url()."absences/view/".$this->uri->segment(3)."/delete/".$_employees['id']; ?>" onClick="return confirm('Are you sure you want to remove this record?')">Delete</a></td>
                                    <?php } else { ?>
                                    <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."absences/view/".$this->uri->segment(3)."/edit/".$_employees['user_id']; ?>">View</a></td>
                                    <?php } ?>
                                <?php } elseif($this->uri->segment(1) == 'payslip') {
                                        if($_SESSION['userLevel'] == 1) { ?>
                                    <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."payslip/view/".$this->uri->segment(3)."/edit/".$_employees['user_id']; ?>">Edit</a> | <a class="waves-effect waves-light btn" href="<?php echo site_url()."payslip/view/".$this->uri->segment(3)."/print/".$_employees['user_id']; ?>">Print</a> | <a class="waves-effect waves-light btn" href="<?php echo site_url()."payslip/view/".$this->uri->segment(3)."/delete/".$_employees['id']; ?>" onClick="return confirm('Are you sure you want to remove this record?')">Delete</a></td>
                                    <?php } else { ?>
                                    <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."payslip/view/".$this->uri->segment(3)."/edit/".$_employees['user_id']; ?>">View</a> | <a class="waves-effect waves-light btn" href="<?php echo site_url()."payslip/view/".$this->uri->segment(3)."/print/".$_employees['user_id']; ?>">print</a></td>
                                    <?php } ?>
                                <?php } elseif($this->uri->segment(1) == 'report') { ?>
                                        
                                    <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."report/view/".$this->uri->segment(3); ?>">View</a> | <a class="waves-effect waves-light btn" href="<?php echo site_url()."payslip/view/".$this->uri->segment(3)."/print/".$_employees['user_id']; ?>">print</a></td>
                                    
                                <?php } elseif($this->uri->segment(1) == 'thirteenmonth') {
                                        if($_SESSION['userLevel'] == 1) { ?>
                                    <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."thirteenmonth/view/".$this->uri->segment(3)."/edit/".$_employees['user_id']; ?>">Edit</a> | <a class="waves-effect waves-light btn" href="<?php echo site_url()."thirteenmonth/view/".$this->uri->segment(3)."/delete/".$_employees['id']; ?>" onClick="return confirm('Are you sure you want to remove this record?')">Delete</a></td>
                                    <?php } else { ?>
                                    <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."thirteenmonth/view/".$this->uri->segment(3)."/edit/".$_employees['user_id']; ?>">View</a></td>
                                    <?php } ?>
                                <?php } else { ?>
                                <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."mandatory/edit/".$_employees['id']; ?>">Edit</a> | <a class="waves-effect waves-light btn" href="<?php echo site_url()."mandatory/delete/".$_employees['id']; ?>" onClick="return confirm('Are you sure you want to remove this record?')">Delete</a></td>
                                <?php } ?>
                            </tr>
                            <?php }} ?>
                            
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

