
<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li style = "font-weight: bold;"class="active"><a href="#basic-info" data-toggle="tab">Master File</a></li>
                <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>settings" data-toggle = "tab "role ="tab">Settings</a></li>
                        
                </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="basic-info">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">

           
             <div class = "panel-heading"><h5>Manage Employee Record</h5></div> 
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
                    	<div class="col s6">
                            <div class="input-field col s12">
                                <label for = "fname">Firstname</label>
                                <input type="text" id="fname" name="fname" class="validate" value="<?php if(!empty($_POST['fname'])) { echo $_POST['fname']; } elseif(!empty($emp[0]['firstname'])) { echo $emp[0]['firstname']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label for = "mname">Middle Name</label>
                                <input type="text" id="mname" name="mname" class="validate" value="<?php if(!empty($_POST['mname'])) { echo $_POST['mname']; } elseif(!empty($emp[0]['middlename'])) { echo $emp[0]['middlename']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label for = "empno">Employee ID</label>
                                <input type="text" id="empno" name="empno" class="validate" disabled value="<?php if(!empty($_POST['empno'])) { echo $_POST['empno']; } elseif(!empty($emp[0]['employeeid'])) { echo $emp[0]['employeeid']; } ?>">
                            </div>
                    	</div>
                    	<div class="col s6">
                    		<div class="input-field col s12">
                                <label for = "lname">Lastname</label>
                                <input  type="text" id="lname" name="lname" class="validate" value="<?php if(!empty($_POST['lname'])) { echo $_POST['lname']; } elseif(!empty($emp[0]['lastname'])) { echo $emp[0]['lastname']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label for = "emailadd">Email Address</label>
                                <input  type="text" id="emailadd" name="emailadd" class="validate" value="<?php if(!empty($_POST['emailadd'])) { echo $_POST['emailadd']; } elseif(!empty($emp[0]['emailadd'])) { echo $emp[0]['emailadd']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label for = "emailadd">Department</label>
                                <input  type="text" id="department" name="department" class="validate" value="<?php if(!empty($_POST['department'])) { echo $_POST['department']; } elseif(!empty($emp[0]['department'])) { echo $emp[0]['department']; } ?>">
                            </div>
                          
                    	</div>
                    </div>
              </div>
                <!-- /.panel-body -->

          
        
               
                <!-- /.panel-heading -->
                 <div class="box-body">
                    <div class="row">
              
                        <div class="col s6">



                            <div class="input-field col s12">
                              
                            
                                  <label for="jobtitle">Job Title</label>
                                <input  style="display:inline-block;"  type="text" id="jobtitle" name="jobtitle" class="validate" value="<?php if(!empty($_POST['jobtitle'])) { echo $_POST['jobtitle']; } elseif(!empty($info[0]['jobtitle'])) { echo $info[0]['jobtitle']; } ?>" required>

                                 
                            </div>
                            <div class="input-field col s12">
                                <label for = "bdate">Birthdate (mm/dd/yyyy)</label>
                                <input type="text" id="bdate" name="bdate" class="validate" value="<?php if(!empty($_POST['bdate'])) { echo $_POST['bdate']; } elseif(!empty($info[0]['birthdate'])) { echo $info[0]['birthdate']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label for = "gender">Gender</label>
                                <input   type="text" id="gender" name="gender" class="validate" value="<?php if(!empty($_POST['gender'])) { echo $_POST['gender']; } elseif(!empty($info[0]['gender'])) { echo $info[0]['gender']; } ?>">
                            </div>

                             <div class="input-field col s12">
                                <label for = "contperson">Contact Person</label>
                                <input type="text" id="contperson" name="contperson" class="validate" value="<?php if(!empty($_POST['contperson'])) { echo $_POST['contperson']; } elseif(!empty($info[0]['incase_emergency'])) { echo $info[0]['incase_emergency']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label for = "emailadd">Contact Number</label>
                                <input  type="text" id="contact_no" name="contact_no" class="validate" value="<?php if(!empty($_POST['contact_no'])) { echo $_POST['contact_no']; } elseif(!empty($emp[0]['contact_no'])) { echo $emp[0]['contact_no']; } ?>">
                            </div>
                        </div>
                        <div class="col s6">

                            <div class="input-field col s12">
                                <label for = "datehired">Date Hired</label>
                                <input  type="text" id="datehired" name="datehired" disabled class="validate" value="<?php if(!empty($_POST['datehired'])) { echo $_POST['datehired']; } elseif(!empty($info[0]['datehired'])) { echo $info[0]['datehired']; } ?>">
                            </div>
                            <div class="input-field col s12">
                                <label for = "salary">Basic Salary</label>
                                <input  type="text" id="salary" name="salary" class="validate" disabled value="<?php if(!empty($_POST['salary'])) { echo $_POST['salary']; } elseif(!empty($info[0]['salary'])) { echo $info[0]['salary']; } ?>">
                            </div>
                             <div class="input-field col s12">
                                <label for = "address">Address</label>
                                <input  type="text" id="address" name="address" class="validate" value="<?php if(!empty($_POST['address'])) { echo $_POST['address']; } elseif(!empty($info[0]['address'])) { echo $info[0]['address']; } ?>">
                            </div>

                            
                             <div class="input-field col s12">
                                <label for = "emernumber">Emergency Number</label>
                                <input type="text" id="emernumber" name="emernumber" class="validate"  value="<?php if(!empty($_POST['emernumber'])) { echo $_POST['emernumber']; } elseif(!empty($info[0]['emergency_no'])) { echo $info[0]['emergency_no']; } ?>">
                            </div>
                           
                           
                           
                        </div>
                  
                       
                    </div>
                </div>


            <div class="box-body">
                <div class="row">

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
                                <button type="submit" name="saveinfo" class="btn btn-md btn-primary btn-block">Save</button>
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

            </div>  <!-- box-body-->
        </div> <!-- box-primary-->

    </div> <!-- tab-pane-->
 </div> <!-- tab content-->



             

</div> <!-- nav tabs custom--> 
