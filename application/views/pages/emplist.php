 

<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  


                    <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>payperiod" role ="tab">Pay Period Table</a></li>
                      <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>yearperiod" role ="tab">Year Period Table</a></li>
                    <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>payslip" role="tab">Payslip Table</a></li>
                   
                      <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>thirteenmonth" role ="tab">13th Month Pay</a></li>
                         <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>report" role ="tab">Reports Table</a></li>
                       <li><a href="<?php echo site_url() ?>payslip/<?php echo $this->uri->segment(2)."/".$this->uri->segment(3); ?>" role="tab">Payslip List </a></li>
                       <li class = "active"><a href="#">Add Payslip</a></li>
                
                 

                     </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="basic-info">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class = "panel-heading"><h5>Add -  Manage Employee Payslip</h5></div> 
                <div class="divider"></div>
                <br><br> 

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
                    		if(!empty($employees)) {
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
                                <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."payslip/view/".$this->uri->segment(3)."/addnew/".$_employees['user_id']; ?>">Add</a></td>
                            </tr>
                            <?php }} ?>
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
 </div>
  </div>
   </div>
    </div>
       </div>


