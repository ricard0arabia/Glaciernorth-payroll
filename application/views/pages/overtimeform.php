<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li style = "font-weight: bold;" ><a href="<?php echo site_url() ?>overtime" role="tab">Payperiod - Overtime Table</a></li>
                   <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>absences" role="tab">Payperiod - Absences Table</a></li>
                       <li><a href="<?php echo site_url() ?>overtime/<?php echo $this->uri->segment(2)."/".$this->uri->segment(3); ?>" role="tab">Overtime List Table</a></li>
            <?php if($_SESSION['userLevel'] == 1) { ?>       
                <?php if($this->uri->segment(4) == 'edit') { ?>
                   <li class="active"><a href="#"role ="tab">Edit Employees Overtime</a></li>
               <?php } else { ?>  
                    <li class="active"><a href="#"role ="tab">Add Employees Overtime</a></li>
                 <?php }} else { ?>
                      <li class="active"><a href="#"role ="tab">View Employee Overtime</a></li>
                  <?php } ?>
                </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">


<div class="row">
    <div class="col-lg-12">
        
           <div class = "panel-heading"><h5>Manage Employee Overtime</h5></div> 
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
                                <label>No of Hours</label>
                                <input type="number" id="hours" name="hours" class="form-control" step="any" value="<?php if(!empty($_POST['hours'])) { echo $_POST['hours']; } elseif(!empty($ov[0]['hours'])) { echo $ov[0]['hours']; } ?>" placeholder="No of hours">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            
                            <div class="form-group">
                                <label>Overtime Rate</label>
                                <input type="number" id="otrate" name="otrate" class="form-control" step="any" value="<?php if(!empty($_POST['otrate'])) { echo $_POST['otrate']; } elseif(!empty($ov[0]['rate'])) { echo $ov[0]['rate']; } ?>" placeholder="Overtime fee">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <?php if($ov[0]['status'] == 1) { ?>
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
