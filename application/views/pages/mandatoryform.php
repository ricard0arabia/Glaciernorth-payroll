<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>sss" role="tab">SSS Contributions Table</a></li>
                   <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>philhealth" role="tab">Philhealth Contributions Table</a></li>
                  
                   <?php if($_SESSION['userLevel'] == 1) { ?>
                   <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>mandatory" role="tab">Mandatory Contributions Table</a></li>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                    <li class = "active"><a href="#" role="tab">View Mandatory Contributions</a></li>

               <?php } else { ?>  
                      <li class = "active"><a href="#" role="tab">Add Mandatory Contributions</a></li>
                       <?php }} else {?> 

                       <li class = "active"><a href="#" role="tab">Mandatory Contributions Table</a></li>
                        <?php }?>

                   </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
      <div class = "panel-heading"><h5>SSS, Philhealth, Pag-Ibig</h5></div> 
                <div class="divider"></div>
                <br><br>


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
                                <?php if($this->uri->segment(2) == 'edit') { ?>
                                <input type="text" id="empid" name="empid" class="form-control" disabled value="<?php if(!empty($_POST['empid'])) { echo $_POST['empid']; } elseif(!empty($emp[0]['firstname'])) { echo $emp[0]['firstname']." ".$emp[0]['lastname']; } ?>" placeholder="Contribution will base on the SSS table">
                                <?php } else { ?>
                                <select class="form-control" name="empid">
                                    <?php if(!empty($emp)) {
                                            foreach($emp as $_emp) { ?>
                                    <option value="<?php echo $_emp['user_id'];?>"><?php echo $_emp['firstname']." ".$_emp['lastname'];?></option>
                                    <?php }} ?>
                                </select>
                                <?php } ?>
                            </div>
                    	</div>
                    </div>
                </div>
                <?php if($this->uri->segment(2) != 'add') { ?>
                <!-- /.panel-body -->
               <div class="clear text-primary bold"><i class="fa fa-user text-primary"></i> Deductions </div> 
                <?php } ?>
                <div class="box-body">
                    <div class="row">
                    	<?php if($this->uri->segment(2) != 'add') { ?>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>SSS</label>
                                <?php if($this->uri->segment(2) != 'add') { ?>
                                <input type="text" id="sss2" name="sss2" class="form-control" disabled value="<?php if(!empty($_POST['sss'])) { echo $_POST['sss']; } elseif(!empty($mandatory[0]['sss'])) { echo $mandatory[0]['sss']; } ?>" placeholder="Contribution will base on the SSS table">
								<input type="hidden" id="sss" name="sss" class="form-control" value="<?php if(!empty($_POST['sss'])) { echo $_POST['sss']; } elseif(!empty($mandatory[0]['sss'])) { echo $mandatory[0]['sss']; } ?>" placeholder="Contribution will base on the SSS table">
                                <?php } else { ?>
                              	<input type="hidden" id="sss" name="sss" class="form-control" disabled="disabled" value="<?php if(!empty($_POST['sss'])) { echo $_POST['sss']; }  ?>" placeholder="This will be filled by the system">  
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label>Pag-Ibig</label>
                                <?php if($this->uri->segment(2) != 'add') { ?>
                                <input type="text" id="pagibig2" name="pagibig2" class="form-control" disabled value="<?php if(!empty($_POST['pagibig'])) { echo $_POST['pagibig']; } elseif(!empty($mandatory[0]['pagibig'])) { echo $mandatory[0]['pagibig']; } ?>" placeholder="Pag-Ibig contributions">
								<input type="hidden" id="pagibig" name="pagibig" class="form-control" value="<?php if(!empty($_POST['pagibig'])) { echo $_POST['pagibig']; } elseif(!empty($mandatory[0]['pagibig'])) { echo $mandatory[0]['pagibig']; } ?>" placeholder="Pag-Ibig contributions">
                           		<?php } else { ?>
                                <input type="hidden" id="pagibig" name="pagibig" class="form-control" value="<?php if(!empty($_POST['pagibig'])) { echo $_POST['pagibig']; } ?>" placeholder="Pag-Ibig contributions">
                                <?php } ?>     
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-lg-6">
                        	<?php if($this->uri->segment(2) != 'add') { ?>
                            <div class="form-group">
                                <label>Philhealth</label>
                                <?php if($this->uri->segment(2) != 'add') { ?>
                                <input type="text" id="philhealth2" name="philhealth2" class="form-control" disabled value="<?php if(!empty($_POST['philhealth'])) { echo $_POST['philhealth']; } elseif(!empty($mandatory[0]['philhealth'])) { echo $mandatory[0]['philhealth']; } ?>" placeholder="Philhealth contributions">
								<input type="hidden" id="philhealth" name="philhealth" class="form-control" value="<?php if(!empty($_POST['philhealth'])) { echo $_POST['philhealth']; } elseif(!empty($mandatory[0]['philhealth'])) { echo $mandatory[0]['philhealth']; } ?>" placeholder="Philhealth contributions">
                                <?php } else { ?>
                                <input type="hidden" id="philhealth" name="philhealth" class="form-control" value="<?php if(!empty($_POST['philhealth'])) { echo $_POST['philhealth']; } ?>" placeholder="Philhealth contributions">
                                <?php } ?>  
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <?php if($mandatory[0]['status'] == 1) { ?>
                                    <option selected="selected" value="1">Enabled</option>
                                    <option value="0">Disable</option>
                                    <?php } else { ?>
                                    <option selected="selected" value="0">Disabled</option>
                                    <option value="1">Enable</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <?php if($_SESSION['userLevel'] == 1) { ?>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <?php if($this->uri->segment(2) == "edit") { ?>
                                <button type="submit" name="saveinfo" class="btn btn-lg btn-primary btn-block">Save</button>
                                <?php } else { ?>
                                <button type="submit" name="addnew" class="btn btn-lg btn-primary btn-block">Save</button>
                                <?php } ?>
                            </div>    
                        </div>
                        <?php } ?>
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
