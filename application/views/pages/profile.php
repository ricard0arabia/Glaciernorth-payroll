
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
</style>
<script type="text/javascript">

save_method = 'add';
$(document).ready(function () {

   <?php if($this->uri->segment(1) == 'userprofile') { ?>

    $.ajax({
        url : "<?php echo site_url('userprofile/basicinfo_list')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
           
            $('[name="user_id"]').val(data.user_id);
            $('[name="firstname"]').val(data.firstname);
            $('[name="middlename"]').val(data.middlename);
            $('[name="lastname"]').val(data.lastname);
            $('[name="department"]').val(data.department);
            $('[name="address"]').val(data.address);
            $('[name="position"]').val(data.position);
            $('[name="contact_no"]').val(data.contact_no);
       
       
 
        },
       
    });
    <?php if($exist == 1){ ?>
    $.ajax({
        url : "<?php echo site_url('userprofile/otherdetails_list')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
           
            $('[name="birthdate"]').val(data.birthdate);
            $('[name="gender"]').val(data.gender);
            $('[name="datehired"]').val(data.datehired);
            $('[name="cstatus"]').val(data.cstatus);
            $('[name="hdmf_no"]').val(data.hdmf_no);
            $('[name="tin_no"]').val(data.tin_no);
            $('[name="sss_no"]').val(data.sss_no);
            $('[name="philhealth_no"]').val(data.philhealth_no);
       
       
 
        },
       
    });
      <?php } ?>
    <?php } else { ?>


      $.ajax({
        url : "<?php echo site_url('employees/basicinfo_list')?>/"+ <?php echo $this->uri->segment(3) ?>,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
           
            $('[name="user_id"]').val(data.user_id);
            $('[name="firstname"]').val(data.firstname);
            $('[name="middlename"]').val(data.middlename);
            $('[name="lastname"]').val(data.lastname);
            $('[name="department"]').val(data.department);
            $('[name="address"]').val(data.address);
            $('[name="position"]').val(data.position);
            $('[name="contact_no"]').val(data.contact_no);
       
       
 
        },
       
    });
      <?php if($exist == 1){ ?>
      $.ajax({
        url : "<?php echo site_url('employees/otherdetails_list')?>/"+ <?php echo $this->uri->segment(3) ?>,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
           
            $('[name="birthdate"]').val(data.birthdate);
            $('[name="gender"]').val(data.gender);
            $('[name="datehired"]').val(data.datehired);
            $('[name="cstatus"]').val(data.cstatus);
            $('[name="hdmf_no"]').val(data.hdmf_no);
            $('[name="tin_no"]').val(data.tin_no);
            $('[name="sss_no"]').val(data.sss_no);
            $('[name="philhealth_no"]').val(data.philhealth_no);
       
       
 
        },
       
    });
      <?php } ?>

      <?php } ?>

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
                            <li><a href="#schedule" data-toggle="tab">Schedule</a></li>
                            <li><a href="#tab3primary" data-toggle="tab">Primary 3</a></li>
                          
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

     <button id="save1" style="display: none;" type="button" name="submit" class=" btn btn-info pull-right" onclick="employeeprofile1()">   Save  </button>

    <?php } ?>


  <table id="view1" class="table table-stripped">
  <tr>
    <th>Employee Id</th>
    <td><input type="text" id="user_id" class="basic input1"name="user_id" readonly></td>
    <th>Department</th>
    <td><input type="text" id="department" class="basic input1" name="department"  readonly></td>
  </tr>
  <tr>
    <th>First Name</th>
    <td><input type="text" id="firstname"class="basic input1" name="firstname"  readonly></td>
    <th>Position</th>
    <td><input type="text" id="position"  class="basic input1"name="position"  readonly></td>
  </tr>
  <tr>
    <th>Middle Name</th>
    <td><input type="text" id="middlename" class="basic input1" name="middlename"  readonly></td>
    <th>Address</th>
    <td><textarea type="text" id="address" class="basic input1" name="address" style="min-width: 100%" readonly></textarea></td>
  </tr>
  <tr>
    <th>Last Name</th>
    <td><input type="text" id="lastname"class="basic input1" name="lastname" readonly></td>
    <th>Contact No.</th>
    <td><input type="text" id="contact_no"class="basic input1" name="contact_no" readonly></td>
    
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
    <th>Birthdate</th>
    <td><input type="date" id="birthdate" class="detailed input2"name="birthdate" readonly></td>
    <th>HDMF No.</th>
    <td><input type="text" id="hdmf_no" class="detailed input2" name="hdmf_no"  readonly></td>
  </tr>
  <tr>
    <th>Gender</th>
    <td><select id="gender" name="gender" class="detailed input2" disabled="disabled">
                                    <option value="">--Select Gender--</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select></td>
    <th>TIN No.</th>
    <td><input type="text" id="tin_no"  class="detailed input2"name="tin_no"  readonly></td>
  </tr>
  <tr>
    <th>Datehired</th>
    <td><input type="date" id="datehired" class="detailed input2" name="datehired"  readonly></td>
    <th>SSS No.</th>
    <td><input type="text" id="sss_no" class="detailed input2" name="sss_no" readonly></td>
  </tr>
  <tr>
    <th>Civil Status</th>
    <td><input type="text" id="cstatus" class="detailed input2" name="cstatus" readonly></td>
    <th>Philhealth No.</th>
    <td><input type="text" id="philhealth_no" class="detailed input2" name="philhealth_no" readonly></td>
    
  </tr>

  </form>
</table>



                   
    
                        </div>
                        <div class="tab-pane fade" id="schedule">

                          <div id='calendar'></div>


                        </div>
                        <div class="tab-pane fade" id="tab3primary">Primary 3</div>
                    </div>
                </div>
            </div>
        
          
        </div><!--/col-9-->
    </div><!--/row-->



                    
  
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
         
      })
      ();
$('#edit1').click(function(){
 
       
  $('input, textarea').each(function(){
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
      document.getElementById("save1").style.display = "block";
 

         
    }
    else {
        
        $(this).toggleClass('input1');
      
        <?php if($this->uri->segment(1) == 'userprofile') { ?>
    $.ajax({
        url : "<?php echo site_url('userprofile/basicinfo_list')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
           
            $('[name="user_id"]').val(data.user_id);
            $('[name="firstname"]').val(data.firstname);
            $('[name="middlename"]').val(data.middlename);
            $('[name="lastname"]').val(data.lastname);
            $('[name="department"]').val(data.department);
            $('[name="address"]').val(data.address);
            $('[name="position"]').val(data.position);
            $('[name="contact_no"]').val(data.contact_no);
       
       
 
        },
       
    });

    <?php } else { ?>


      $.ajax({
        url : "<?php echo site_url('employees/basicinfo_list')?>/"+ <?php echo $this->uri->segment(3) ?>,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
           
            $('[name="user_id"]').val(data.user_id);
            $('[name="firstname"]').val(data.firstname);
            $('[name="middlename"]').val(data.middlename);
            $('[name="lastname"]').val(data.lastname);
            $('[name="department"]').val(data.department);
            $('[name="address"]').val(data.address);
            $('[name="position"]').val(data.position);
            $('[name="contact_no"]').val(data.contact_no);
       
       
 
        },
       
    });

      <?php } ?>

      

      inp.attr('readonly', 'readonly');
      $('#basicinfo')[0].reset();
      document.getElementById("edit1").innerHTML = 'edit';
      document.getElementById("res1").disabled = false;
      document.getElementById("res2").disabled = false;  
      document.getElementById("save1").style.display = "none";


       
    }
  }
  });
});
 $('#save1').click(function(){
 
  $('input, textarea').each(function(){
    var inp = $(this);

if($(this).hasClass('basic')){

   $(this).toggleClass('input1');

   
      inp.attr('readonly', 'readonly');
      document.getElementById("edit1").innerHTML = 'edit';
      document.getElementById("res1").disabled = false;
      document.getElementById("res2").disabled = false;  
      document.getElementById("save1").style.display = "none";
    }
  });
});
 function employeeprofile1()
 {
   $.ajax({
        url :  "<?php echo site_url('employees/update_basicinfo')?>",
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
        document.getElementById("gender").disabled = false;
        document.getElementById("save2").style.display = "block";
   

         
    }
    else {
   

        $(this).toggleClass('input2');


        <?php if($this->uri->segment(1) == 'userprofile') { ?>
    $.ajax({
        url : "<?php echo site_url('userprofile/otherdetails_list')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
           
            $('[name="birthdate"]').val(data.birthdate);
            $('[name="gender"]').val(data.gender);
            $('[name="datehired"]').val(data.datehired);
            $('[name="cstatus"]').val(data.cstatus);
            $('[name="hdmf_no"]').val(data.hdmf_no);
            $('[name="tin_no"]').val(data.tin_no);
            $('[name="sss_no"]').val(data.sss_no);
            $('[name="philhealth_no"]').val(data.philhealth_no);
       
       
 
        },
       
    });

    <?php } else { ?>


       $.ajax({
        url : "<?php echo site_url('employees/otherdetails_list')?>/"+ <?php echo $this->uri->segment(3) ?>,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
           
            $('[name="birthdate"]').val(data.birthdate);
            $('[name="gender"]').val(data.gender);
            $('[name="datehired"]').val(data.datehired);
            $('[name="cstatus"]').val(data.cstatus);
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
      document.getElementById("gender").disabled = true;
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
      document.getElementById("gender").disabled = true;
      document.getElementById("save2").style.display = "none";
    }
  });
});




 function userprofile2()
 {

   <?php if($exist == 1) { ?>
    
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

   

  <?php } else { ?>

      if(save_method == 'add'){
      save_method = 'update';
       $.ajax({
          url :  "<?php echo site_url('userprofile/add_otherdetails')?>",
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

      }  else {

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

  <?php } ?>
 }

 function employeeprofile2(id)
 {

   <?php if($exist == 1) { ?>
    
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

   

  <?php } else { ?>

      if(save_method == 'add'){
      save_method = 'update';
       $.ajax({
          url :  "<?php echo site_url('employees/add_otherdetails')?>/" + id,
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

      }  else {

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

  <?php } ?>
 }


 </script>


