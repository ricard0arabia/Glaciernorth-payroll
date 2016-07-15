<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li style = "font-weight: bold;" ><a href="<?php echo site_url() ?>userprofile" role="tab">Master File</a></li>
                <li style = "font-weight: bold;" class="active"><a href="#"role ="tab">Settings</a></li>
                        
                </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="settings">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        
           <div class = "panel-heading"><h5>Change Password</h5></div> 
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
                                <label>Password</label>
                                <input type="password" id="empass" name="empass" class="form-control" value="<?php if(!empty($_POST['empass'])) { echo $_POST['empass']; } ?>">
                            </div>
                    	</div>
                    	<div class="col-lg-6">
                    		<div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" id="newPass" name="newPass" class="form-control" value="<?php if(!empty($_POST['newPass'])) { echo $_POST['newPass']; } ?>">
                            </div>
                    	</div>
                        <div class="col-lg-6">
                            <div class="col-lg-4" style="padding-left:0;">
                                <button type="submit" name="saveinfo" class="btn btn-lg btn-primary btn-block">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </form>
        </div>
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