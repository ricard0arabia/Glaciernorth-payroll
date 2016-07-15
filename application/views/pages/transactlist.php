<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pay Period Transactions</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Manage Transactions
            </div>
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
                                <th>Pay Period</th>
                                <th>Month End</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $j=0;
                    		if(!empty($payperiod)) {
							$i=0;
							foreach($payperiod as $_payperiod) { 					
								if($i%2==0) { 
									$style = "odd";
									$i++;
								} else {
									$style = "even"; 
									$i++;
								}					
								$j++; ?>
                            <tr class="<?php echo $style; ?> gradeX">
                            	<td class="center"><?php echo $_payperiod['id']; ?></td>
                                <td><?php echo $_payperiod['payfrom']." - ".$_payperiod['payto']; ?></td>
                               	<td><?php if($_payperiod['monthend'] == 1) { echo "Yes"; } else { echo "No"; } ?></td>
                                <td><?php if($_payperiod['status'] == 1) { echo "Enabled"; } else { echo "Disabled"; } ?></td>
                                <td class="center"><a href="<?php echo site_url()."transactions/view/".$_payperiod['id']; ?>">View</a> | <a href="<?php echo site_url()."transactions/delete/".$_payperiod['id']; ?>" onClick="return confirm('Are you sure you want to remove this record?')">Delete</a></td>
                            </tr>
                            <?php }} ?>
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
