<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>payperiod" role="tab">Pay Period Table</a></li>
                  <li style = "font-weight: bold; " ><a href="<?php echo site_url() ?>yearperiod" role ="tab">Year Period Table</a></li>
                            
                  <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>payslip" role ="tab">Payslip Table</a></li>                  
                  <li class = "active" style = "font-weight: bold; "><a href="<?php echo site_url() ?>thirteenmonth" role ="tab">13th Month Pay</a></li>
                   <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>report" role ="tab">Reports Table</a></li>
                   </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">
<div class="row">
    <div class="col-lg-12">
 
         
            <div class = "panel-heading"><h5>Year Period List -  Manage Employee 13th Month Pay</h5></div> 
                <div class="divider"></div>
                <br><br>

            <div class="panel-body">
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
                                <th>Year Period</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $j=0;
                    		if(!empty($yearperiod)) {
							$i=0;
							foreach($yearperiod as $_yearperiod) { 					
								if($i%2==0) { 
									$style = "odd";
									$i++;
								} else {
									$style = "even"; 
									$i++;
								}					
								$j++; ?>
                            <tr class="<?php echo $style; ?> gradeX">
                            	<td class="center"><?php echo $_yearperiod['id']; ?></td>
                                <td><?php echo $_yearperiod['title']; ?></td>
                                <td><?php if($_yearperiod['status'] == 1) { echo "Enabled"; } else { echo "Disabled"; } ?></td>
                                <?php if($_SESSION['userLevel'] == 1) { ?>
                                <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."thirteenmonth/view/".$_yearperiod['id']; ?>">Edit</a> | <a class="waves-effect waves-light btn" href="<?php echo site_url()."thirteenmonth/delete/".$_yearperiod['id']; ?>" onClick="return confirm('Are you sure you want to remove this record?')">Delete</a></td>
                                <?php } else { ?>
                                <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."thirteenmonth/view/".$_yearperiod['id']; ?>">View</a></td>
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
