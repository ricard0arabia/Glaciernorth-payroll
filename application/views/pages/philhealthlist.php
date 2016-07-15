<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>sss" role="tab">SSS Contributions Table</a></li>
                  <li style = "font-weight: bold;" class = "active"><a href="<?php echo site_url() ?>philhealth" role="tab">Philhealth Contributions Table</a></li>
                      <li style = "font-weight: bold;">
                        
                                    <?php if($_SESSION['userLevel'] != 1) { ?>
                                    <a href="<?php echo site_url()."mandatory/edit/".$_SESSION['userId']; ?>">Mandatory Contributions</a>
                                    <?php } else { ?>
                                    <a href="<?php echo site_url() ?>mandatory">Mandatory Contributions Table</a>
                                    <?php } ?>
                                </li>
                   </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class = "panel-heading"><h5>Manage Philhealth Contribution</h5></div> 
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
                                <th>Salary Range</th>
                                <th>Employer Share</th>
                                <th>Employee Share</th>
                                <?php if($_SESSION['userLevel'] == 1) { ?>
                                <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $j=0;
                    		if(!empty($philhealthlist)) {
							$i=0;
							foreach($philhealthlist as $_philhealthlist) { 					
								if($i%2==0) { 
									$style = "odd";
									$i++;
								} else {
									$style = "even"; 
									$i++;
								}					
								$j++; ?>
                            <tr class="<?php echo $style; ?> gradeX">
                            	<td class="center"><?php echo $_philhealthlist['id']; ?></td>
                                <td><?php echo $_philhealthlist['min_salary']." - ".$_philhealthlist['max_salary']; ?></td>
                               	<td><?php echo $_philhealthlist['employer']; ?></td>
                                <td><?php echo $_philhealthlist['employee']; ?></td>
                                <?php if($_SESSION['userLevel'] == 1) { ?>
                                <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."philhealth/edit/".$_philhealthlist['id']; ?>">Edit</a> | <a class="waves-effect waves-light btn" href="<?php echo site_url()."philhealth/delete/".$_philhealthlist['id']; ?>" onClick="return confirm('Are you sure you want to remove this record?')">Delete</a></td>
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
        <!-- /.panel -->
    
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
</div>
</div>
</div>
</div>
