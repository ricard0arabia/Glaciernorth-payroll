
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
.input {
  border:0;
  background:0;
  outline:none !important;
}
.display{

  display:none;

}
</style>
<script type="text/javascript">
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
            <div class="panel-body"><a href="http://bootply.com">bootply.com</a></div>
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
                            <li><a href="#tab2primary" data-toggle="tab">Primary 2</a></li>
                            <li><a href="#tab3primary" data-toggle="tab">Primary 3</a></li>
                          
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="201file">


 
  <button id="edit" class="btn btn-info pull-right">edit</button>
   <form id="basicinfo" name="basicinfo" method="post" role="form" >  

    <?php if($this->uri->segment(1) == "userprofile") { ?>

    <button id="save" style="display: none;" type="button" name="submit" class=" btn btn-info pull-right" onclick="userprofile()">   Save  </button>

    <?php } else { ?> 

     <button id="save" style="display: none;" type="button" name="submit" class=" btn btn-info pull-right" onclick="employeeprofile(<?php echo $this->uri->segment(3) ?>)">   Save  </button>

    <?php } ?>


  <table id="view" class="table table-striped">
  <tr>
    <th>Employee Id</th>
    <td><input type="text" id="user_id" class="input"name="user_id" readonly></td>
    <th>Department</th>
    <td><input type="text" id="department" class="input" name="department"  readonly></td>
  </tr>
  <tr>
    <th>First Name</th>
    <td><input type="text" id="firstname"class="input" name="firstname"  readonly></td>
    <th>Position</th>
    <td><input type="text" id="position"  class="input"name="position"  readonly></td>
  </tr>
  <tr>
    <th>Middle Name</th>
    <td><input type="text" id="middlename" class="input" name="middlename"  readonly></td>
    <th>Address</th>
    <td><input type="text" id="address" class="input" name="address" readonly></td>
  </tr>
  <tr>
    <th>Last Name</th>
    <td><input type="text" id="lastname"class="input" name="lastname" readonly></td>
    <th>Contact No.</th>
    <td><input type="text" id="contact_no"class="input" name="contact_no" readonly></td>
    
  </tr>

  </form>
</table>


                   
    
                        </div>
                        <div class="tab-pane fade" id="tab2primary">Primary 2</div>
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
$('#edit').click(function(){
  $('input').toggleClass('input');
  $('input').each(function(){
    var inp = $(this);

   
    if (inp.attr('readonly')) {

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
      
      inp.removeAttr('readonly');   
      document.getElementById('user_id').readOnly = true;
      document.getElementById("user_id").style.outline = "none";
      document.getElementById("user_id").style.border = "0";
      document.getElementById("user_id").style.background = "0";
     
      document.getElementById("edit").innerHTML = 'cancel';
      document.getElementById("res1").disabled = true;
      document.getElementById("res2").disabled = true;  
      document.getElementById("save").style.display = "block";
 

         
    }
    else {

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
      document.getElementById("edit").innerHTML = 'edit';
      document.getElementById("res1").disabled = false;
      document.getElementById("res2").disabled = false;  
      document.getElementById("save").style.display = "none";


       
    }
  });
});
 $('#save').click(function(){
  $('input').toggleClass('input');
  $('input').each(function(){
    var inp = $(this);

   
      inp.attr('readonly', 'readonly');
      document.getElementById("edit").innerHTML = 'edit';
      document.getElementById("res1").disabled = false;
      document.getElementById("res2").disabled = false;  
      document.getElementById("save").style.display = "none";
  });
});
 function employeeprofile(id)
 {
   $.ajax({
        url :  "<?php echo site_url('employees/update_basicinfo')?>/"+id,
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
 function userprofile()
 {
   $.ajax({
        url :  "<?php echo site_url('userprofile/basicinfo_insert')?>",
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


 </script>


