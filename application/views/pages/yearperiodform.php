<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li style = "font-weight: bold; " ><a href="<?php echo site_url() ?>payperiod" role="tab">Pay Period Table</a></li>
                   <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>yearperiod" role ="tab">Year Period Table</a></li>
                  <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>payslip" role ="tab">Payslip Table</a></li>                  
                  <li style = "font-weight: bold; "><a href="<?php echo site_url() ?>thirteenmonth" role ="tab">13th Month Pay</a></li>
                <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>report" role ="tab">Reports Table</a></li>

                       <?php if($_SESSION['userLevel'] == 1) { ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                   <li class="active"><a href="#"role ="tab">Edit Year Period</a></li>
               <?php } else { ?>  
                    <li class="active"><a href="#"role ="tab">Add Year Period</a></li>
                 <?php }} else { ?>
                 <li class="active"><a href="#"role ="tab">View Year Period</a></li>
                  <?php } ?>

                </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">

<div class="row">
    <div class="col-lg-12">
       

        <?php if($_SESSION['userLevel'] == 1) { ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
            <div class = "panel-heading"><h5>Edit -  Manage Employee Year Period</h5></div> 
                <div class="divider"></div>
                <br><br>
               <?php } else { ?>  
                   <div class = "panel-heading"><h5>Add -  Manage Employee Year Period</h5></div> 
                <div class="divider"></div>
                <br><br>
                 <?php }} else { ?>
                <div class = "panel-heading"><h5>View -  Manage Employee Year Period</h5></div> 
                <div class="divider"></div>
                <br><br>
                  <?php } ?>

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
                                <label>Year Period</label>
                                <input type="text" id="myear" name="myear" class="form-control" value="<?php if(!empty($_POST['myear'])) { echo $_POST['myear']; } elseif(!empty($yearperiod[0]['title'])) { echo $yearperiod[0]['title']; } ?>" placeholder="Year ex. (yyyy)">
                            </div>
                    	</div>
                    	<div class="col-lg-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <?php if($yearperiod[0]['status'] == 1) { ?>
                                    <option selected="selected" value="1">Enabled</option>
                                    <option value="0">Disable</option>
                                    <?php } else { ?>
                                    <option selected="selected" value="0">Disabled</option>
                                    <option value="1">Enable</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php if($_SESSION['userLevel'] == 1) { ?>
                            <div class="col-lg-4" style="padding-left:0;">
                                <?php if($this->uri->segment(2) == "edit") { ?>
                                <button type="submit" name="saveinfo" class="btn btn-lg btn-primary btn-block">Save</button>
                                <?php } else { ?>
                                <button type="submit" name="addnew" class="btn btn-lg btn-primary btn-block">Save</button>
                                <?php } ?>
                            </div>
                            <?php } ?>
                    	</div>
                    </div>
                </div>
                <!-- /.panel-body -->
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
