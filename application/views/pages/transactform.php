<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Employees Mandatory Contributions</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                SSS, Philhealth, Pag-Ibig
            </div>

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

                <div class="panel-body">
                    <div class="row">
                    	<div class="col-lg-6">
                            <div class="form-group">
                                <label>Employee Name</label>
                                <?php if($this->uri->segment(4) == 'edit') { ?>
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
                <!-- /.panel-body -->
                <div class="panel-heading">
                    Deductions
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>SSS</label>
                                <input type="text" id="sss" name="sss" class="form-control" disabled value="<?php if(!empty($_POST['sss'])) { echo $_POST['sss']; } elseif(!empty($emp[0]['sss'])) { echo $emp[0]['sss']; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Philhealth</label>
                                <input type="text" id="philhealth" name="philhealth" class="form-control" disabled value="<?php if(!empty($_POST['philhealth'])) { echo $_POST['philhealth']; } elseif(!empty($emp[0]['philhealth'])) { echo $emp[0]['philhealth']; } ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Pag-Ibig</label>
                                <input type="text" id="pagibig" name="pagibig" class="form-control" disabled value="<?php if(!empty($_POST['pagibig'])) { echo $_POST['pagibig']; } elseif(!empty($emp[0]['pagibig'])) { echo $emp[0]['pagibig']; } ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php if($this->uri->segment(2) == "edit") { ?>
                            <button type="submit" name="saveinfo" class="btn btn-lg btn-primary btn-block">Save</button>
                            <?php } else { ?>
                            <button type="submit" name="addnew" class="btn btn-lg btn-primary btn-block">Save</button>
                            <?php } ?>
                        </div>    
                    </div>
                </div>
            </form>
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
