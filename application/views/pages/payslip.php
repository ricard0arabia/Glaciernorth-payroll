<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                  <li style = "font-weight: bold;"class = "active"><a href="#" role="tab">Payslip Table</a></li>               
                 
                 
                   </ul>


                        <div class="tab-content  ">

                            <div class="tab-pane active" id="">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">
<div class="row">
    <div class="col-lg-12">
     

       <div class = "panel-heading"><h5>My Payslip</h5></div> 
                <div class="divider"></div>

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
                                <th>Pay Period</th>
                                <th>Month End</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $j=0;
                    		if(!empty($paylist)) {
							$i=0;
							foreach($paylist as $_paylist) { 					
								if($i%2==0) { 
									$style = "odd";
									$i++;
								} else {
									$style = "even"; 
									$i++;
								}					
								$j++; ?>
                            <tr class="<?php echo $style; ?> gradeX">
                            	<td class="center"><?php echo $_paylist['id']; ?></td>
                                <td><?php echo $_paylist['payfrom']." - ".$_paylist['payto']; ?></td>
                               	<td><?php if($_paylist['monthend'] == 1) { echo "Yes"; } else { echo "No"; } ?></td>
                                <td><?php if($_paylist['status'] == 1) { echo "Enabled"; } else { echo "Disabled"; } ?></td>
                                <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."compensation/payslip/".$_paylist['id']."/view"; ?>"><i class="large material-icons">pageview</i></a></td>
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
