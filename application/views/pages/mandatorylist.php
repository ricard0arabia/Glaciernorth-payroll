<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>sss" role="tab">SSS Contributions Table</a></li>
                    <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>philhealth" role="tab">Philhealth Contributions Table</a></li>
                   <li style = "font-weight: bold;" class = "active" ><a href="#" role="tab">Mandatory Contributions Table</a></li>

                       <?php if($_SESSION['userLevel'] == 1) {
                                        if($this->uri->segment(1) == 'mandatory') { ?>
                                <li>
                                    <a href="<?php echo site_url() ?>mandatory/add">Add Mandatory Contributions</a>
                                </li>
                                <?php }} ?>

                   </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">
<div class="row">
    <div class="col-lg-12">
        
        <div class = "panel-heading"><h5>Manage Employees Mandatory Contributions</h5></div> 
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
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>SSS</th>
                                <th>Philhealth</th>
                                <th>Pag-Ibig</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $j=0;
                    		if(!empty($mandatory)) {
							$i=0;
							foreach($mandatory as $_mandatory) { 					
								if($i%2==0) { 
									$style = "odd";
									$i++;
								} else {
									$style = "even"; 
									$i++;
								}					
								$j++; ?>
                            <tr class="<?php echo $style; ?> gradeX">
                            	<td class="center"><?php echo $_mandatory['id']; ?></td>
                                <td><?php echo $_mandatory['firstname']; ?></td>
                                <td><?php echo $_mandatory['lastname']; ?></td>
                               	<td><?php echo $_mandatory['sss']; ?></td>
                                <td><?php echo $_mandatory['philhealth']; ?></td>
                                <td><?php echo $_mandatory['pagibig']; ?></td>
                                <td><?php if($_mandatory['status'] == 1) { echo "Enabled"; } else { echo "Disabled"; } ?></td>
                                <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."mandatory/edit/".$_mandatory['id']; ?>">Edit</a> | <a class="waves-effect waves-light btn" href="<?php echo site_url()."mandatory/delete/".$_mandatory['id']; ?>" onClick="return confirm('Are you sure you want to remove this record?')">Delete</a></td>
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
