<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>sss" role="tab">SSS Contributions Table</a></li>
                   <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>philhealth" role="tab">Philhealth Contributions Table</a></li>
                   <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>mandatory" role="tab">Mandatory Contributions Table</a></li>
                <li class = "active"><a href="#" role="tab">Edit Philhealth Table</a></li>
                   </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class = "panel-heading"><h5>Manage Philhealth Contribution Reference</h5></div> 
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
                                <label>Salary Range</label>
                                <input type="number" id="minsal" name="minsal" class="form-control" step="any" value="<?php if(!empty($_POST['minsal'])) { echo $_POST['minsal']; } elseif(!empty($philhealth[0]['min_salary'])) { echo $sss[0]['min_salary']; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Employer Share</label>
                                <input type="number" id="empshare" name="empshare" class="form-control" step="any" value="<?php if(!empty($_POST['empshare'])) { echo $_POST['empshare']; } elseif(!empty($philhealth[0]['employer'])) { echo $philhealth[0]['employer']; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Total Contribution</label>
                                <input type="number" id="total" name="total" class="form-control" step="any" value="<?php if(!empty($_POST['total'])) { echo $_POST['total']; } elseif(!empty($philhealth[0]['total'])) { echo $philhealth[0]['total']; } ?>">
                            </div>
                    	</div>
                        <div class="col-lg-1">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <input type="text" id="" name="" class="form-control" value=" TO " style="border:none;box-shadow:none;">
                            </div>
                        </div>
                    	<div class="col-lg-5">
                    		<div class="form-group">
                                <label>&nbsp;</label>
                                <input type="number" id="maxsal" name="maxsal" class="form-control" step="any" value="<?php if(!empty($_POST['maxsal'])) { echo $_POST['maxsal']; } elseif(!empty($philhealth[0]['max_salary'])) { echo $philhealth[0]['max_salary']; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Employee Share</label>
                                <input type="number" id="emplshare" name="emplshare" class="form-control" step="any" value="<?php if(!empty($_POST['emplshare'])) { echo $_POST['emplshare']; } elseif(!empty($philhealth[0]['employee'])) { echo $philhealth[0]['employee']; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <?php if($sss[0]['status'] == 1) { ?>
                                    <option selected="selected" value="1">Enabled</option>
                                    <option value="0">Disable</option>
                                    <?php } else { ?>
                                    <option selected="selected" value="0">Disabled</option>
                                    <option value="1">Enable</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-4" style="padding-left:0;">
                                <?php if($this->uri->segment(2) == "edit") { ?>
                                <button type="submit" name="saveinfo" class="btn btn-lg btn-primary btn-block">Save</button>
                                <?php } else { ?>
                                <button type="submit" name="addnew" class="btn btn-lg btn-primary btn-block">Save</button>
                                <?php } ?>
                                
                            </div>
                    	</div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </form>
      
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
</div>
</div>
</div>
</div>