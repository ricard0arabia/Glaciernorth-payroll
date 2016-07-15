<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>overtime" role="tab">Payperiod - Overtime Table</a></li>
                   <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>absences" role="tab">Payperiod - Absences Table</a></li>
                    <li><a href="<?php echo site_url() ?>absences/<?php echo $this->uri->segment(2)."/".$this->uri->segment(3); ?>" role="tab">Absences Table</a></li>
              <?php if($_SESSION['userLevel'] == 1) { ?>     
                <?php if($this->uri->segment(4) == 'edit') { ?>
                   <li class="active"><a href="#"role ="tab">Edit Employees Absences</a></li>
               <?php } else { ?>  
                    <li class="active"><a href="#"role ="tab">Add Employees Absences</a></li>
                <?php }} else { ?>
                      <li class="active"><a href="#"role ="tab">View Employee Absences</a></li>
                  <?php } ?>
                </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">


<!-- /.row -->
<div class="row">
    <div class="col-lg-12">

         <div class="clear text-primary bold"><i class="fa fa-user text-primary"></i> Manage Employees Absences </div> 

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
                                <?php if($this->uri->segment(4) == 'edit') { ?>
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
                                <label>No of days</label>
                                <input type="number" id="absent" name="absent" class="form-control" step="any" value="<?php if(!empty($_POST['absent'])) { echo $_POST['absent']; } elseif(!empty($ov[0]['absent'])) { echo $ov[0]['absent']; } ?>" placeholder="No of days">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<?php if($this->uri->segment(4) == 'edit') { ?>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Absent Rate</label>
                                <input type="number" id="absentrate" name="absentrate" class="form-control" step="any" value="<?php if(!empty($_POST['absentrate'])) { echo $_POST['absentrate']; } elseif(!empty($ov[0]['rate'])) { echo $ov[0]['rate']; } ?>" placeholder="Absent fee">
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <?php if($ov[0]['status'] == 1) { ?>
                                    <option selected="selected" value="1">Enabled</option>
                                    <option value="0">Disable</option>
                                    <?php } else { ?>
                                    <option value="0">Disabled</option>
                                    <option selected="selected" value="1">Enable</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <?php if($_SESSION['userLevel'] == 1) { ?>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <?php if($this->uri->segment(4) == "edit") { ?>
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
