
<style>

.panel.with-nav-tabs .panel-heading{
    padding: 5px 5px 0 5px;
}
.panel.with-nav-tabs .nav-tabs{
  border-bottom: none;
}
.panel.with-nav-tabs .nav-justified{
  margin-bottom: -1px;
}
.with-nav-tabs.panel-primary .nav-tabs > li > a,
.with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
    color: #fff;
}
.with-nav-tabs.panel-primary .nav-tabs > .open > a,
.with-nav-tabs.panel-primary .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
  color: #fff;
  background-color: #3071a9;
  border-color: transparent;
}
.with-nav-tabs.panel-primary .nav-tabs > li.active > a,
.with-nav-tabs.panel-primary .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > li.active > a:focus {
  color: #428bca;
  background-color: #fff;
  border-color: #428bca;
  border-bottom-color: transparent;
}
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #428bca;
    border-color: #3071a9;
}
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #fff;   
}
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #3071a9;
}
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    background-color: #4a9fe9;
}
img{
  display: block;
  width: 200px;
  height: 200px;
  margin-left: auto;
    margin-right: auto;
}
.input1 {
  border:0;
  background:0;
  outline:none !important;
}

.input2 {
  border:0;
  background:0;
  outline:none !important;
}
.display{

  display:none;

}
.dataTables_info{

  display: none;
}
input, select{

  width: 60%;
}
.bootstrap-timepicker-widget.dropdown-menu {
    z-index: 99999!important;
}



 .fc th {
                padding: 10px 0px;
                vertical-align: middle;
                background:#F2F2F2;
            }
            .fc-day-grid-event>.fc-content {
                padding: 4px;
            }
            #calendar {
                max-width: 900px;
                margin: 0 auto;
            }
            .error {
                color: #ac2925;
                margin-bottom: 15px;
            }
            .event-tooltip {
                width:100px;
                background: rgba(0, 0, 0, 0.85);
                color:#FFF;
                padding:10px;
                position:absolute;
                z-index:10001;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 12px;

            }
            .modal-header
            {
                background-color: #3A87AD;
                color: #fff;
            }

</style>
<script type="text/javascript">

save_method = 'add';
$(document).ready(function () {

  var table1;
  var emp_id; 
      
    



   <?php if($this->uri->segment(1) == 'userprofile') { ?>
    var emp_id = "<?php echo $this->session->userdata('username');?>";
    $.ajax({
        url : "<?php echo site_url('userprofile/employee_details')?>",
        type: "GET",
        dataType: "JSON",

        success: function(data)
        {
 
           
            $('[name="user_id"]').val(data.user_id);
            $('[name="firstname"]').val(data.firstname);
            $('[name="middlename"]').val(data.middlename);
            $('[name="lastname"]').val(data.lastname);
            $('[name="birthdate"]').val(data.birthdate);
            $('[name="gender"]').val(data.gender);
            $('[name="cstatus"]').val(data.cstatus);
            $('[name="emailadd"]').val(data.email);
            $('[name="zipcode"]').val(data.zipcode);
            $('[name="contact_no"]').val(data.contact_no);
            $('[name="address"]').val(data.address);
            $('[name="password"]').val(data.password);

            $('[name="department"]').val(data.department);
            $('[name="position"]').val(data.position);
            $('[name="salary"]').val(data.salary);
            $('[name="datehired"]').val(data.datehired);
            $('[name="taxstatus"]').val(data.taxstatus);
            $('[name="userlevel"]').val(data.userlevel);
            $('[name="hdmf_no"]').val(data.hdmf_no);
            $('[name="tin_no"]').val(data.tin_no);
            $('[name="sss_no"]').val(data.sss_no);
            $('[name="philhealth_no"]').val(data.philhealth_no);

       
       
 
        },
       
    });

   
    

      <?php }else if($this->uri->segment(1) == 'employees'){ ?>
        var emp_id = "<?php echo $this->uri->segment(3);?>";
        $.ajax({
        url : "<?php echo site_url('employees/employee_details')?>/" + <?php echo $this->uri->segment(3); ?>,
        type: "GET",
        dataType: "JSON",

        success: function(data)
        {
 
           
            $('[name="user_id"]').val(data.user_id);
            $('[name="firstname"]').val(data.firstname);
            $('[name="middlename"]').val(data.middlename);
            $('[name="lastname"]').val(data.lastname);
            $('[name="birthdate"]').val(data.birthdate);
            $('[name="gender"]').val(data.gender);
            $('[name="cstatus"]').val(data.cstatus);
            $('[name="emailadd"]').val(data.email);
            $('[name="zipcode"]').val(data.zipcode);
            $('[name="contact_no"]').val(data.contact_no);
            $('[name="address"]').val(data.address);
            $('[name="password"]').val(data.password);

            $('[name="department"]').val(data.department);
            $('[name="position"]').val(data.position);
            $('[name="salary"]').val(data.salary);
            $('[name="datehired"]').val(data.datehired);
            $('[name="taxstatus"]').val(data.taxstatus);
            $('[name="userlevel"]').val(data.userlevel);
            $('[name="hdmf_no"]').val(data.hdmf_no);
            $('[name="tin_no"]').val(data.tin_no);
            $('[name="sss_no"]').val(data.sss_no);
            $('[name="philhealth_no"]').val(data.philhealth_no);

       
       
 
        },
       
    });
    


        <?php } ?>

     table1 = $('#payroll_table').DataTable({
      
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "dom": 'Bfrtip',
         "buttons": [
        {
            extend: 'pdf',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n SSS Contribution Table ',
               orientation: 'portrait',
               customize: function(doc) {
                  doc.defaultStyle.fontSize = 16; //<-- set fontsize to 16 instead of 10 
               }  
       },
       {
           extend: 'csv',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n SSS Contribution Table ',
          
       },
       {
           extend: 'excel',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n SSS Contribution Table ',
       },
       {
           extend: 'print',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n SSS Contribution Table ',
       }          
        ],
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('payroll/payroll_data')?>/" +emp_id,
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        {
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],
 
    });



    });
</script>
 <div class="row">
       <div id="profile-page-sidebar" class="col s12 m4">
        <?php if(!empty($notif)) { ?>
          <?php if($notif == "please select an image") { ?>
                <div class="panel-body">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $notif; ?>    
                    </div> 
                </div>
                <?php }else{ ?>

                <div class="panel-body">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $notif; ?>    
                    </div> 
                </div>

                <?php } ?>
          <?php } ?>


          <hr>
<div class="container">

    <div class="row">
      <div class="col-sm-3"><!--left col-->
              
          <div class="panel panel-default">
           
                <div class="card white">
            <div class="card-content white-text">
           
               <img id="preview" src="<?=base_url(). 'uploads/'.$image[0]['img_name'].$image[0]['ext'];?>">
                
     
                
            </div>
             <div class="card-action">
              <?php if($this->uri->segment(1) == "employees") { ?>
                 <?php echo form_open_multipart('employees/do_upload/'.$this->uri->segment(3));?>
                 <?php } else { ?>
                   <?php echo form_open_multipart('userprofile/do_upload');?>
                   <?php } ?>

               <input id="res1"class="pull-left"type="file"  name="userfile" size="20" />
               <input  id="res2"type="submit" value="upload"  name="upload">
                </form>
            </div>
       
          </div>
        </div>
               
          <div class="panel panel-default">
            <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body"><a href="http://bootply.com"></a></div>
          </div>
          
          
          <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
          </ul> 
               
          <div class="panel panel-default">
            <div class="panel-heading">Social Media</div>
            <div class="panel-body">
              <i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
            </div>
          </div>
          
        </div><!--/col-3-->




      <div class="col-sm-9">


          <div class="panel with-nav-tabs panel-info">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#201file" data-toggle="tab">201 File</a></li>
                            
                            <li><a href="#payrolldata" data-toggle="tab">Payroll Data</a></li>
                            <li><a href="#schedule" data-toggle="tab">Schedule</a></li>
                          
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="201file">



<!-- Basic information -->
<!-- Basic information -->
<!-- Basic information -->
    <h3><span class="glyphicon glyphicon-user" style="color:#5cb85c" aria-hidden="true"> Basic&nbsp;Information</span></h3>
 
  <button id="edit1" type="button" class="btn btn-info pull-right">edit</button>
   <form id="basicinfo" name="basicinfo" method="post" role="form" >  

    <?php if($this->uri->segment(1) == "userprofile") { ?>

    <button id="save1" style="display: none;" type="button" name="submit" class=" btn btn-info pull-right" onclick="userprofile1()">   Save  </button>

    <?php } else { ?> 

     <button id="save1" style="display: none;" type="button" name="submit" class=" btn btn-info pull-right" onclick="employeeprofile1(<?php echo $this->uri->segment(3); ?>)">   Save  </button>

    <?php } ?>


  <table id="view1" class="table table-stripped">
  <tr>
    <th>Employee Id</th>
    <td><input type="text" id="user_id" class="basic input1"name="user_id" readonly></td>
     <th>Civil Status</th>
    <td><select id="cstatus" name="cstatus" class="basic input1" disabled="disabled" readonly>
                                    <option value="">--Select civil status--</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                     <option value="widowed">Widowed</option>
                                </select></td>
  </tr>
  <tr>
    <th>First Name</th>
    <td><input type="text" id="firstname"class="basic input1" name="firstname"  readonly></td>
     <th>Contact No.</th>
    <td><input type="text" id="contact_no"class="basic input1" name="contact_no" readonly></td>
  </tr>
  <tr>
    <th>Middle Name</th>
    <td><input type="text" id="middlename" class="basic input1" name="middlename"  readonly></td>
    <th>Email Address</th>
    <td><input type="text" id="emailadd" class="basic input1" name="emailadd"  readonly></td>
   
  </tr>
  <tr>
    <th>Last Name</th>
    <td><input type="text" id="lastname"class="basic input1" name="lastname" readonly></td>
    <th>Zip code</th>
    <td><input type="text" id="zipcode" class="basic input1" name="zipcode"  readonly></td>
   
    
  </tr>
  <tr>
   <tr>
    <th>Gender</th>
    <td><select id="gender" name="gender" class="basic input1" disabled="disabled" readonly>
                                    <option value="">--Select Gender--</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select></td>
    <th>Password</th>
    <td><input type="text" id="password" class="basic input1" name="password"  readonly></td>
   
    
  </tr>
  <tr>
      <th>Birthdate</th>
    <td><input type="date" id="birthdate" class="basic input1"name="birthdate" readonly></td>
     <th>Address</th>
    <td><textarea type="text" id="address" class="basic input1" name="address" style="min-width: 100%" readonly></textarea></td>
  </tr>


  </form>
</table>
<!-- Other details -->
<!-- Other details -->
<!-- Other details -->

  <h3><span class="glyphicon glyphicon-user" style="color:#5cb85c" aria-hidden="true"> Other&nbsp;Details</span></h3>
 
  <button id="edit2" type="button" class="btn btn-info pull-right">edit</button>
   <form id="otherdetails" name="otherdetails" method="post" role="form" >  

    <?php if($this->uri->segment(1) == "userprofile") { ?>


    <button id="save2" style="display: none;" type="button" name="submit" class=" btn btn-info pull-right" onclick="userprofile2()">   Save  </button>

    <?php } else { ?> 

     <button id="save2" style="display: none;" type="button" name="submit" class=" btn btn-info pull-right" onclick="employeeprofile2(<?php echo $this->uri->segment(3); ?>)">   Save  </button>

    <?php } ?>


  <table id="view2" class="table table-stripped">
  <tr>
    <th>Department</th>
    <td><input type="text" id="department" class="detailed input2"name="department" readonly></td>
    <th>HDMF No.</th>
    <td><input type="text" id="hdmf_no" class="detailed input2" name="hdmf_no"  readonly></td>
  </tr>
  <tr>
    <th>Position</th>
    <td><input type="text" id="position"  class="detailed input2"name="position"  readonly></td>
    <th>TIN No.</th>
    <td><input type="text" id="tin_no"  class="detailed input2"name="tin_no"  readonly></td>
  </tr>
  <tr>
  <th>Userlevel</th>
    <td><select id="userlevel" name="userlevel" class="detailed input2" disabled="disabled" readonly>
                                    <option value="">--Select user level--</option>
                                    <option value="1">Accountant</option>
                                    <option value="2">H.R supervisor</option>
                                     <option value="3">Employee</option>
                                </select></td>
    <th>SSS No.</th>
    <td><input type="text" id="sss_no" class="detailed input2" name="sss_no" readonly></td>
  </tr>
  <tr>
    <th>Datehired</th>
    <td><input type="date" id="datehired" class="detailed input2" name="datehired" readonly></td>
    <th>Philhealth No.</th>
    <td><input type="text" id="philhealth_no" class="detailed input2" name="philhealth_no" readonly></td>
    
  </tr>
  <tr>
   <th>Tax Status</th>
   <td><select id="taxstatus" name="taxstatus" class="detailed input2" disabled="disabled" readonly>
                                    <option value="">--Select civil status--</option>
                                    <option value="s">Single</option>
                                    <option value="s1">Single/With 1 Dependent</option>
                                    <option value="s2">Single/With 2 Dependent</option>
                                    <option value="s3">Single/With 3 Dependent</option>
                                    <option value="s4">Single/With 4 Dependent</option>
                                    <option value="me">Married</option>
                                    <option value="me1">Married With 1 Dependent</option>
                                    <option value="me2">Married With 2 Dependent</option>
                                    <option value="me3">Married With 3 Dependent</option>
                                    <option value="me4">Married With 4 Dependent</option>
                                </select></td>
    <th></th>
    <td></td>
  </tr>
  <tr>
     <th>Salary</th>
    <td>&#x20B1;&nbsp;<input type="text" id="salary" class="detailed input2" name="salary" readonly></td>
    <th></th>
    <td></td>

  </tr>

  </form>
</table>



                   
    
      </div>




      <div class="tab-pane fade" id="payrolldata"> 
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
         
          <br />
         <br />
                  <table id="payroll_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                  <thead>
                                      <tr>
                                          <th>Period Covered</th>
                                          <th>Gross Amaount</th>
                                          <th>Deductions</th>
                                          <th>Withholding Tax</th>
                                          <th>Net Amount</th>
                                          <th style="width:160px;">Payslip</th>
                                      </tr>
                                  </thead>
                                 
                              </table>




                                                                           
          </div>

        

                        <div class="tab-pane fade" id="schedule">
                       <?php if($level == '2'){ ?>   
                          <br>
                          <button class="btn btn-success" onclick="add_sched()"><i class="glyphicon glyphicon-plus"></i> Work Schedule</button>
                          <button class="btn btn-primary" onclick="edit_sched()"><i class="glyphicon glyphicon-pencil"></i> Edit Schedule</button>
                          <br>
                          <br>
                          <?php } ?>
                          <div id='calendar'></div>


                        </div>
                       
                    </div>
                </div>
            </div>
        
          
        </div><!--/col-9-->
    </div><!--/row-->



                    
  
  </div>           
           
</div>
</div>   














<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h3 class="modal-title">Add Leave Request</h3>
               
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div class="row">

                           <div class="form-group">
                            <label class="control-label col-md-3">Start Date</label>
                            <div class="col-md-5">
                             <input id="fromDate" name="startdate" placeholder="yyyy-mm-dd" class="form-control" type="text">

                                <span class="help-block"></span>
                            </div>
                        </div>
                       
                       
                        <div class="form-group">
                             <label class="control-label col-md-3">End Date</label>
                            <div class="col-md-5">                           
                          <input id="toDate" name="enddate" placeholder="yyyy-mm-dd" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                           <div class="form-group">
                            <label class="control-label col-md-3">Monday</label>
                            <div class="col-md-5">
                                <select name="mon_sched" class="form-control">
                                    <option value="">--Select Time--</option>
                                    <option value="a">6am - 2pm</option>
                                    <option value="b">2pm - 10pm</option>
                                    <option value="c">10pm - 6am</option>
                                    <option value="d">8pm - 5pm</option>
                                    <option value="e">No work</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="control-label col-md-3">Tuesday</label>
                            <div class="col-md-5">
                                <select name="tue_sched" class="form-control">
                                    <option value="">--Select Time--</option>
                                    <option value="a">6am - 2pm</option>
                                    <option value="b">2pm - 10pm</option>
                                    <option value="c">10pm - 6am</option>
                                    <option value="d">8pm - 5pm</option>
                                    <option value="e">No work</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="control-label col-md-3">Wednesday</label>
                            <div class="col-md-5">
                                <select name="wed_sched" class="form-control">
                                    <option value="">--Select Time--</option>
                                    <option value="a">6am - 2pm</option>
                                    <option value="b">2pm - 10pm</option>
                                    <option value="c">10pm - 6am</option>
                                    <option value="d">8pm - 5pm</option>
                                    <option value="e">No work</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="control-label col-md-3">Thursday</label>
                           <div class="col-md-5">
                                <select name="thurs_sched" class="form-control">
                                    <option value="">--Select Time--</option>
                                    <option value="a">6am - 2pm</option>
                                    <option value="b">2pm - 10pm</option>
                                    <option value="c">10pm - 6am</option>
                                    <option value="d">8pm - 5pm</option>
                                    <option value="e">No work</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="control-label col-md-3">Friday</label>
                            <div class="col-md-5">
                                <select name="fri_sched" class="form-control">
                                    <option value="">--Select Time--</option>
                                    <option value="a">6am - 2pm</option>
                                    <option value="b">2pm - 10pm</option>
                                    <option value="c">10pm - 6am</option>
                                    <option value="d">8pm - 5pm</option>
                                    <option value="e">No work</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="control-label col-md-3">Saturday</label>
                            <div class="col-md-5">
                                <select name="sat_sched" class="form-control">
                                    <option value="">--Select Time--</option>
                                    <option value="a">6am - 2pm</option>
                                    <option value="b">2pm - 10pm</option>
                                    <option value="c">10pm - 6am</option>
                                    <option value="d">8pm - 5pm</option>
                                    <option value="e">No work</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="control-label col-md-3">Sunday</label>
                            <div class="col-md-5">
                                <select name="sun_sched" class="form-control">
                                    <option value="">--Select Time--</option>
                                    <option value="a">6am - 2pm</option>
                                    <option value="b">2pm - 10pm</option>
                                    <option value="c">10pm - 6am</option>
                                    <option value="d">8pm - 5pm</option>
                                    <option value="e">No work</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>                  
                        

                         
                    </div>
                     
                    </div>
                </form>
            </div>
            <div class="modal-footer">
               <?php if($this->uri->segment(1) == 'employees') { ?>
                <button type="button" id="btnSave" onclick="save(<?php echo $this->uri->segment(3); ?>)" class="btn btn-primary">Save</button>
                <?php }else{ ?>
                 <button type="button" id="btnSave" onclick="save(<?php echo $this->session->userdata('username'); ?>)" class="btn btn-primary">Save</button>
                <?php } ?>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 

  <!-- Modal Structure -->
 
<div class="modal fade" id="sched_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"  id="sched_modal_title" ></h4>
                    </div>
                    <div class="modal-body">
                        <div class="error"></div>
                        <form class="form-horizontal" id="crud-form">
                           
                            <div class="form-group">
                               <label class="control-label col-md-4">Time</label>
                              <div class="col-md-4">
                                <select name="time" class="form-control">
                                    <option value="">--Select Time--</option>
                                    <option value="a">6am - 2pm</option>
                                    <option value="b">2pm - 10pm</option>
                                    <option value="c">10pm - 6am</option>
                                    <option value="d">8pm - 5pm</option>
                                </select>
                              </div>
                          
                            </div>
  
        
                        </form>
                    </div>
                    <div class="modal-footer" id="sched_modal_footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">

(
          function() {

          var URL = window.URL || window.webkitURL;

          var input = document.querySelector('#res1');
          var preview = document.querySelector('#preview');
          
          // When the file input changes, create a object URL around the file.
          input.addEventListener('change', function () {
              preview.src = URL.createObjectURL(this.files[0]);
          });
          
          // When the image loads, release object URL
          $("#hdmf_no").mask("999999999999");
          $("#sss_no").mask("99-9999999-9");
          $("#tin_no").mask("999-999-999");
          $("#philhealth_no").mask("99-999999999-9");
         
      })
      ();
$('#edit1').click(function(){
 
       
  $('input, textarea, select').each(function(){
    var inp = $(this);

  if($(this).hasClass('basic')){
   
    if (inp.attr('readonly')) {

      $(this).toggleClass('input1');

      
      inp.removeAttr('readonly');   
      document.getElementById('user_id').readOnly = true;
      document.getElementById("user_id").style.outline = "none";
      document.getElementById("user_id").style.border = "0";
      document.getElementById("user_id").style.background = "0";
     
      document.getElementById("edit1").innerHTML = 'cancel';
      document.getElementById("res1").disabled = true;
      document.getElementById("res2").disabled = true;  
      document.getElementById("cstatus").disabled = false;
      document.getElementById("gender").disabled = false;
      document.getElementById("save1").style.display = "block";
 

         
    }
    else {
        
        $(this).toggleClass('input1');
      
        <?php if($this->uri->segment(1) == 'userprofile') { ?>
    $.ajax({
        url : "<?php echo site_url('userprofile/employee_details')?>",
        type: "GET",
        dataType: "JSON",

        success: function(data)
        {
 
           
           $('[name="user_id"]').val(data.user_id);
            $('[name="firstname"]').val(data.firstname);
            $('[name="middlename"]').val(data.middlename);
            $('[name="lastname"]').val(data.lastname);
            $('[name="birthdate"]').val(data.birthdate);
            $('[name="gender"]').val(data.gender);
            $('[name="cstatus"]').val(data.cstatus);
            $('[name="emailadd"]').val(data.email);
            $('[name="zipcode"]').val(data.zipcode);
            $('[name="contact_no"]').val(data.contact_no);
            $('[name="address"]').val(data.address);
            $('[name="password"]').val(data.password);
       
       
 
        },
       
    });

    <?php } else { ?>


      $.ajax({
        url : "<?php echo site_url('employees/employee_details')?>/"+ <?php echo $this->uri->segment(3) ?>,
        type: "GET",
        dataType: "JSON",

        success: function(data)
        {
 
           
              $('[name="user_id"]').val(data.user_id);
            $('[name="firstname"]').val(data.firstname);
            $('[name="middlename"]').val(data.middlename);
            $('[name="lastname"]').val(data.lastname);
            $('[name="birthdate"]').val(data.birthdate);
            $('[name="gender"]').val(data.gender);
            $('[name="cstatus"]').val(data.cstatus);
            $('[name="emailadd"]').val(data.email);
            $('[name="zipcode"]').val(data.zipcode);
            $('[name="contact_no"]').val(data.contact_no);
            $('[name="address"]').val(data.address);
            $('[name="password"]').val(data.password);
       
       
 
        },
       
    });

      <?php } ?>

      

      inp.attr('readonly', 'readonly');
      $('#basicinfo')[0].reset();
      document.getElementById("edit1").innerHTML = 'edit';
      document.getElementById("res1").disabled = false;
      document.getElementById("res2").disabled = false;  
       document.getElementById("cstatus").disabled = true;
      document.getElementById("gender").disabled = true;
      document.getElementById("save1").style.display = "none";


       
    }
  }
  });
});
 $('#save1').click(function(){
 
  $('input, textarea, select').each(function(){
    var inp = $(this);

if($(this).hasClass('basic')){

   $(this).toggleClass('input1');

   
      inp.attr('readonly', 'readonly');
      document.getElementById("edit1").innerHTML = 'edit';
      document.getElementById("res1").disabled = false;
      document.getElementById("res2").disabled = false;  
      document.getElementById("cstatus").disabled = true;
      document.getElementById("gender").disabled = true;
      document.getElementById("save1").style.display = "none";
    }
  });
});
 function employeeprofile1(id)
 {
   $.ajax({
        url :  "<?php echo site_url('employees/update_basicinfo')?>/" + id,
        type: "POST",
        data: $('#basicinfo').serialize(),
        dataType: "JSON",

        success: function(data) 
        {
         if(data == "Success")
         {
          $('#success_msg').show();
          $('#success_msg').text(" Record saved successfully");
         }
        }
      }); 
    
 }
 function userprofile1()
 {
   $.ajax({
        url :  "<?php echo site_url('userprofile/update_basicinfo')?>",
        type: "POST",
        data: $('#basicinfo').serialize(),
        dataType: "JSON",

        success: function(data) 
        {
         if(data == "Success")
         {
          $('#success_msg').show();
          $('#success_msg').text(" Record saved successfully");
         }
        }
      }); 
    
 }
//
//
//

$('#edit2').click(function(){
  


  $('input, select').each(function(){

    var inp = $(this);

  
    if($(this).hasClass('detailed')){

    if (inp.attr('readonly')) {

      $(this).toggleClass('input2');


         inp.removeAttr('readonly');   
       
        document.getElementById("edit2").innerHTML = 'cancel';
        document.getElementById("res1").disabled = true;
        document.getElementById("res2").disabled = true;  
        document.getElementById("userlevel").disabled = false;
        document.getElementById("taxstatus").disabled = false;
        document.getElementById("save2").style.display = "block";
   

         
    }
    else {
   

        $(this).toggleClass('input2');


        <?php if($this->uri->segment(1) == 'userprofile') { ?>
    $.ajax({
        url : "<?php echo site_url('userprofile/employee_details')?>",
        type: "GET",
        dataType: "JSON",

        success: function(data)
        {
 
           
            $('[name="department"]').val(data.department);
            $('[name="position"]').val(data.position);
            $('[name="salary"]').val(data.salary);
            $('[name="datehired"]').val(data.datehired);
            $('[name="taxstatus"]').val(data.taxstatus);
            $('[name="userlevel"]').val(data.userlevel);
            $('[name="hdmf_no"]').val(data.hdmf_no);
            $('[name="tin_no"]').val(data.tin_no);
            $('[name="sss_no"]').val(data.sss_no);
            $('[name="philhealth_no"]').val(data.philhealth_no);
       
       
 
        },
       
    });

    <?php } else { ?>


       $.ajax({
        url : "<?php echo site_url('employees/employee_details')?>/"+ <?php echo $this->uri->segment(3) ?>,
        type: "GET",
        dataType: "JSON",

        success: function(data)
        {
 
           
             $('[name="department"]').val(data.department);
            $('[name="position"]').val(data.position);
            $('[name="salary"]').val(data.salary);
            $('[name="datehired"]').val(data.datehired);
            $('[name="taxstatus"]').val(data.taxstatus);
            $('[name="userlevel"]').val(data.userlevel);
            $('[name="hdmf_no"]').val(data.hdmf_no);
            $('[name="tin_no"]').val(data.tin_no);
            $('[name="sss_no"]').val(data.sss_no);
            $('[name="philhealth_no"]').val(data.philhealth_no);
       
       
 
        },
       
    });

      <?php } ?>
    

      inp.attr('readonly', 'readonly');
      $('#otherdetails')[0].reset();
      document.getElementById("edit2").innerHTML = 'edit';
      document.getElementById("res1").disabled = false;
      document.getElementById("res2").disabled = false;  
  document.getElementById("taxstatus").disabled = true;
  document.getElementById("userlevel").disabled = true;
      document.getElementById("save2").style.display = "none";

    
       }
    }
  
  });
});
$('#save2').click(function(){
 
  $('input, select').each(function(){
    var inp = $(this);

if($(this).hasClass('detailed')){

   $(this).toggleClass('input2');

   
      inp.attr('readonly', 'readonly');
      document.getElementById("edit2").innerHTML = 'edit';
      document.getElementById("res1").disabled = false;
      document.getElementById("res2").disabled = false;  
       document.getElementById("taxstatus").disabled = true;
       document.getElementById("userlevel").disabled = true;
      document.getElementById("save2").style.display = "none";
    }
  });
});




 function userprofile2()
 {

 
   $.ajax({
        url :  "<?php echo site_url('userprofile/update_otherdetails')?>",
        type: "POST",
        data: $('#otherdetails').serialize(),
        dataType: "JSON",

        success: function(data) 
        {
         if(data == "Success")
         {
          $('#success_msg').show();
          $('#success_msg').text(" Record saved successfully");
         }
        }
      }); 
 
 }

 function employeeprofile2(id)
 {

 
   $.ajax({
        url :  "<?php echo site_url('employees/update_otherdetails')?>/" + id,
        type: "POST",
        data: $('#otherdetails').serialize(),
        dataType: "JSON",

        success: function(data) 
        {
         if(data == "Success")
         {
          $('#success_msg').show();
          $('#success_msg').text(" Record saved successfully");
         }
        }
      }); 

   
 }



 //
//
//
//



function reload_table()
{
    table1.ajax.reload(null,false); //reload datatable ajax
}





//
//
//
//

 // modal

 $(document).ready(function () {
     // set default dates
            var start = new Date();
            start.setDate(start.getDate() - 10);

            // set end date to max one year period:
            var end = new Date(new Date().setYear(start.getFullYear()+1));

            $('#fromDate').datepicker({
                format: "yyyy-mm-dd",
            
                startDate : start,
                endDate   : end
            // update "toDate" defaults whenever "fromDate" changes
            }).on('changeDate', function(){
                // set the "toDate" start to not be later than "fromDate" ends:
                $('#toDate').datepicker('setStartDate', new Date($(this).val()));
               
            }); 

            $('#toDate').datepicker({
                format: "yyyy-mm-dd",
                startDate : start,
                endDate   : end
            // update "fromDate" defaults whenever "toDate" changes
            }).on('changeDate', function(){
                // set the "fromDate" end to not be later than "toDate" starts:
                $('#fromDate').datepicker('setEndDate', new Date($(this).val()));
                
            });

 
 });
 function add_sched()
{
  sched_save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Employee Work Schedule'); // Set Title to Bootstrap modal title
}
 function edit_sched()
{
  sched_save_method = 'edit';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Edit Employee Work Schedule'); // Set Title to Bootstrap modal title
}
function save(id)
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable

    if(sched_save_method == 'add') {

    url = "<?php echo site_url('employees/add_sched')?>/" + id;

    } else {

      
    url = "<?php echo site_url('employees/edit_sched')?>/" +  id;

    }

    $.ajax({

       <?php if($this->uri->segment(1) == 'employees') { ?>

        url : url,

        <?php } else { ?>

        url : "<?php echo site_url('userprofile/add_sched')?>/" + id,

        <?php } ?>


        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
               if(data.start == false || data.end == false){

                  alert('Stardate or end date not valid! Kingina mo');

                }
                else{
                $('#modal_form').modal('hide');
              }
              
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
 
        }
    });
}




// calendar
//
//
//
//
//
//
//





$(function(){

    var currentDate; // Holds the day clicked when adding a new event
    var currentEvent; // Holds the event object when editing an event
    var id;
    <?php if($this->uri->segment(1) == "employees"){ ?>
      id = <?php echo $this->uri->segment(3) ?>;
      <?php }else{ ?>
      id = <?php echo $this->session->userdata('username') ?>;
      <?php } ?>

    $('#color').colorpicker(); // Colopicker
    $('#time').timepicker({
        minuteStep: 5,
        showInputs: false,
        disableFocus: true,
        showMeridian: false
    });  // Timepicker

    var base_url='http://glacierpayroll.com/'; // Here i define the base_url

    // Fullcalendar
    $('#calendar').fullCalendar({
        timeFormat: 'hh:mm a',
        header: {
            left: 'prev, next, today',
            center: 'title',
              right: 'month,agendaWeek,agendaDay'
        },
        // Get all events stored in database
       nextDayThreshold: "06:00:00",
      editable: true,
        selectable: true,
      selectHelper: true,
       displayEventEnd: true,
        eventLimit: true,
        events:"<?php echo site_url('/calendar/getEvents')?>/" + id,
     
         
       
        // Handle Day Click
        dayClick: function(date, event, view) {
            currentDate = date.format('MMM DD, YYYY');
            // Open modal to add event
            modal({
                // Available buttons when adding
                buttons: {
                    add: {
                        id: 'add-event', // Buttons id
                        css: 'btn-success', // Buttons class
                        label: 'Add' // Buttons label
                    }
                },
                title: 'Add Event: ' + date.format('MMM DD, YYYY') // Modal title
            });
        },
   
          editable: true, // Make the event draggable true 
         eventDrop: function(event, delta, revertFunc) {  

            
               $.post(base_url+'/calendar/dragUpdateEvent',{                            
                id:event.id,
                date: event.start.format()
            }, function(result){
                if(result)
                {
                alert('Updated');
                }
                else
                {
                    alert('Try Again later!')
                }

            });



          },
        // Event Mouseover
         eventMouseover: function(calEvent, jsEvent) {  

                    var durationTime = moment(calEvent.start).format('hh:mm a') + " - " + moment(calEvent.end).format('hh:mm a')
                    var tooltip = '<div class="event-tooltip">' + durationTime + '</div>';
                    $("body").append(tooltip);
                    $(this).mouseover(function(e) {
                        $(this).css('z-index', 10000);
                        $('.event-tooltip').fadeIn('500');
                        $('.event-tooltip').fadeTo('10', 1.9);
                    }).mousemove(function(e) {
                        $('.event-tooltip').css('top', e.pageY + 10);
                        $('.event-tooltip').css('left', e.pageX + 20);
                    });
                },

                eventMouseout: function(calEvent, jsEvent) {
                    $(this).css('z-index', 8);
                    $('.event-tooltip').remove();
                },
        // Handle Existing Event Click
        eventClick: function(calEvent, jsEvent, view) {
            // Set currentEvent variable according to the event clicked in the calendar
            currentEvent = calEvent;

            // Open modal to edit or delete event
            modal({
                // Available buttons when editing
                buttons: {
                    delete: {
                        id: 'delete-event',
                        css: 'btn-danger',
                        label: 'Delete'
                    },
                    update: {
                        id: 'update-event',
                        css: 'btn-success',
                        label: 'Update'
                    }
                },
                title: 'Edit Event' +": "+ moment(calEvent.start).format('MMM DD, YYYY') +" "+ moment(calEvent.start).format('hh:mm a') + " - " + moment(calEvent.end).format('hh:mm a'),
                event: calEvent
            });
        }

    });

    // Prepares the modal window according to data passed
    function modal(data) {
        // Set modal title
        $('#sched_modal_title').html(data.title);
        // Clear buttons except Cancel
        $('#sched_modal_footer button:not(".btn-default")').remove();
        // Set input values
        $('#title').val(data.event ? data.event.title : '');
        $('#time').val('b');
    
        // Create Butttons
        $.each(data.buttons, function(index, button){
            $('#sched_modal_footer').prepend('<button type="button" id="' + button.id  + '" class="btn ' + button.css + '">' + button.label + '</button>')
        })
        //Show Modal
        $('#sched_modal').modal('show');
    }

    // Handle Click on Add Button
    $('#sched_modal').on('click', '#add-event',  function(e){
        if(validator(['title', 'description'])) {
            $.post("<?php echo site_url('/calendar/addEvent')?>", {
                title: $('#title').val(),
                description: $('#description').val(),
                color: $('#color').val(),
                date: currentDate + ' ' + getTime()
            }, function(result){
                $('#sched_modal').modal('hide');
                $('#calendar').fullCalendar("refetchEvents");
            });
        }
    });


    // Handle click on Update Button
    $('#sched_modal').on('click', '#update-event',  function(e){
        if(validator(['title', 'description'])) {
            $.post(base_url+'/calendar/updateEvent', {
                id: currentEvent._id,
                title: $('#title').val(),
                date: currentEvent.date.split(' ')[0]  + ' ' +  getTime()
            }, function(result){
                $('#sched_modal').modal('hide');
                $('#calendar').fullCalendar("refetchEvents");
            });
        }
    });



    // Handle Click on Delete Button
    $('.modal').on('click', '#delete-event',  function(e){
        $.get(base_url+'/calendar/deleteEvent?id=' + currentEvent._id, function(result){
            $('.modal').modal('hide');
            $('#calendar').fullCalendar("refetchEvents");
        });
    });


    // Get Formated Time From Timepicker
    function getTime() {
        var time = $('#time').val();
        return (time.indexOf(':') == 1 ? '0' + time : time) + ':00';
    }

    // Dead Basic Validation For Inputs
    function validator(elements) {
        var errors = 0;
        $.each(elements, function(index, element){
            if($.trim($('#' + element).val()) == '') errors++;
        });
        if(errors) {
            $('.error').html('Please insert title and description');
            return false;
        }
        return true;
    }
});


 </script>

