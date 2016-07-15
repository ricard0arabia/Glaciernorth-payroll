<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active" style = "font-weight: bold;" ><a href="<?php echo site_url() ?>employees" role="tab">Employee List</a></li>

                  <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>loan" role="tab">Loan</a></li>

                  <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>shift" role="tab">Shift</a></li>

                  <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>leave" role="tab">Leave</a></li>

                  <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>overtime" role="tab">Overtime</a></li>

                 
                        
                </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        
         <div class = "panel-heading"><h5>Personal Information</h5></div> 
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
                            <div class="input-field col s12">
                                <label>Firstname</label>
                                <input type="text" id="fname" name="fname" class="form-control" value="<?php if(!empty($_POST['fname'])) { echo $_POST['fname']; } elseif(!empty($emp[0]['firstname'])) { echo $emp[0]['firstname']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label>Middle Name</label>
                                <input type="text" id="mname" name="mname" class="form-control" value="<?php if(!empty($_POST['mname'])) { echo $_POST['mname']; } elseif(!empty($emp[0]['middlename'])) { echo $emp[0]['middlename']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label>Password</label>
                                <input type="password" id="empass" name="empass" class="form-control" value="<?php if(!empty($_POST['empass'])) { echo $_POST['empass']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label>Employee ID</label>
                                <input type="text" id="empno" name="empno" class="form-control" value="<?php if(!empty($_POST['empno'])) { echo $_POST['empno']; } elseif(!empty($emp[0]['employeeid'])) { echo $emp[0]['employeeid']; } ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-field col s12">
                                <label>Lastname</label>
                                <input type="text" id="lname" name="lname" class="form-control" value="<?php if(!empty($_POST['lname'])) { echo $_POST['lname']; } elseif(!empty($emp[0]['lastname'])) { echo $emp[0]['lastname']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label>Email Address</label>
                                <input type="text" id="emailadd" name="emailadd" class="form-control" value="<?php if(!empty($_POST['emailadd'])) { echo $_POST['emailadd']; } elseif(!empty($emp[0]['emailadd'])) { echo $emp[0]['emailadd']; } ?>">
                            </div>
                            <div class="form-group">
                                <label>User Level</label>
                                <select class="form-control" name="userLevel">
                                <?php if(!empty($level)) {
                                    foreach($level as $_level) {
                                        if($_level['levelid'] == $emp[0]['userlevel']) { ?>
                                    <option selected="selected" value="<?php echo $_level['levelid'] ;?>"><?php echo ucwords($_level['title']);?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $_level['levelid'] ;?>"><?php echo ucwords($_level['title']);?></option>
                                <?php }}} ?>
                                </select>
                            </div>
                             <div class="form-group">
                                <label>Tax Status</label>
                                <select class="form-control" name="civilStatus">
                                <?php if(!empty($status)) {
                                    foreach($status as $_status) {
                                        if($_status['empstatus'] == $info[0]['cstatus']) { ?>
                                    <option selected="selected" value="<?php echo $_status['empstatus'] ;?>"><?php echo ucwords($_status['title']);?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $_status['empstatus'] ;?>"><?php echo ucwords($_status['title']);?></option>
                                <?php }}} ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->

                <div class = "panel-heading"><h5>Additional Information</h5></div> 
                <div class="divider"></div>
                <br><br>

               
                <!-- /.panel-heading -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6">
                             <div class="input-field col s12">
                                <label>Department</label>
                                <input type="text" id="department" name="department" class="form-control" value="<?php if(!empty($_POST['department'])) { echo $_POST['department']; } elseif(!empty($info[0]['department'])) { echo $info[0]['department']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label>Job Title</label>
                                <input type="text" id="jobtitle" name="jobtitle" class="form-control" value="<?php if(!empty($_POST['jobtitle'])) { echo $_POST['jobtitle']; } elseif(!empty($info[0]['jobtitle'])) { echo $info[0]['jobtitle']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label>Birthdate</label>
                                <input type="text" id="bdate" name="bdate" class="form-control" value="<?php if(!empty($_POST['bdate'])) { echo $_POST['bdate']; } elseif(!empty($info[0]['birthdate'])) { echo $info[0]['birthdate']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label>Gender</label>
                                <input type="text" id="gender" name="gender" class="form-control" value="<?php if(!empty($_POST['gender'])) { echo $_POST['gender']; } elseif(!empty($info[0]['gender'])) { echo $info[0]['gender']; } ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                             <div class="input-field col s12">
                                <label>Contact Number</label>
                                <input type="text" id="contact_no" name="contact_no" class="form-control" value="<?php if(!empty($_POST['contact_no'])) { echo $_POST['contact_no']; } elseif(!empty($info[0]['contact_no'])) { echo $info[0]['contact_no']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label>Date Hired</label>
                                <input type="text" id="datehired" name="datehired" class="form-control" value="<?php if(!empty($_POST['datehired'])) { echo $_POST['datehired']; } elseif(!empty($info[0]['datehired'])) { echo $info[0]['datehired']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label>Basic Salary</label>
                                <input type="text" id="salary" name="salary" class="form-control" value="<?php if(!empty($_POST['salary'])) { echo $_POST['salary']; } elseif(!empty($info[0]['salary'])) { echo $info[0]['salary']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label>Address</label>
                                <input type="text" id="address" name="address" class="form-control" value="<?php if(!empty($_POST['address'])) { echo $_POST['address']; } elseif(!empty($info[0]['address'])) { echo $info[0]['address']; } ?>">
                            </div>
                        </div>
                            <div class="col-lg-6">
                            <div class="input-field col s12">
                            <label>Contact Person in case of Emergency</label>
                                <input type="text" id="contperson" name="contperson" class="form-control" value="<?php if(!empty($_POST['contperson'])) { echo $_POST['contperson']; } elseif(!empty($info[0]['incase_emergency'])) { echo $info[0]['incase_emergency']; } ?>">
                                
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-field col s12">
                                <label>Emergency number</label>
                                <input type="number" id="emernumber" name="emernumber" class="form-control" value="<?php if(!empty($_POST['emernumber'])) { echo $_POST['emernumber']; } elseif(!empty($info[0]['emergency_no'])) { echo $info[0]['emergency_no']; } ?>">
                            </div>              
                           
                        </div>

                         <div class="col-lg-6">
                            <div class="input-field col s12">
                                <label>SSS No.</label>
                                <input type="text" id="sss_no" name="sss_no" class="form-control" value="<?php if(!empty($_POST['sss_no'])) { echo $_POST['sss_no']; } elseif(!empty($info[0]['sss_no'])) { echo $info[0]['sss_no']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label>TIN No.</label>
                                <input type="text" id="tin_no" name="tin_no" class="form-control" value="<?php if(!empty($_POST['tin_no'])) { echo $_POST['tin_no']; } elseif(!empty($info[0]['tin_no'])) { echo $info[0]['tin_no']; } ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-field col s12">
                                <label for = "hdmf_no">HDMF (Pag-IBIG | MID No./RTN)</label>
                                <input type="text" id="hdmf_no" name="hdmf_no" class="form-control" value="<?php if(!empty($_POST['hdmf_no'])) { echo $_POST['hdmf_no']; } elseif(!empty($info[0]['hdmf_no'])) { echo $info[0]['hdmf_no']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label>PhilHealth No.</label>
                                <input type="text" id="philhealth_no" name="philhealth_no" class="form-control" value="<?php if(!empty($_POST['philhealth_no'])) { echo $_POST['philhealth_no']; } elseif(!empty($info[0]['philhealth_no'])) { echo $info[0]['philhealth_no']; } ?>">
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
       
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
</div>
</div>
</div>
</div>
