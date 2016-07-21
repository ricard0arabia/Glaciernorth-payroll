
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

   
    $.ajax({
        url : "<?php echo site_url('userprofile/display')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
           
            $('[name="brand_name"]').val(data.brandname);
            $('[name="dealername"]').val(data.dealername);
            $('[name="emailid"]').val(data.emailid);
            $('[name="webaddress"]').val(data.wedaddress);
            $('[name="city"]').val(data.city);
            $('[name="contactno"]').val(data.contactno);
            $('[name="state"]').val(data.state);
       
 
        },
       
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

               <input id="res1"class="pull-left"type="file" id="input"  name="userfile" size="20" />
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
   <form id="branddet" name="branddet" method="post" role="form" >  

    <?php if($this->uri->segment(1) == "userprofile") { ?>

    <button id="save" style="display: none;" type="button" name="submit" class=" btn btn-info pull-right" onclick="userprofile()">   Save  </button>

    <?php } else { ?> 

     <button id="save" style="display: none;" type="button" name="submit" class=" btn btn-info pull-right" onclick="employeeprofile(<?php echo $this->uri->segment(3) ?>)">   Save  </button>

    <?php } ?>


  <table id="view" class="table table-striped">
  <tr>
    <th>brand_name</th>
    <td><input type="text" id="user_id" class="input"name="brand_name" readonly></td>
    <th>dealername</th>
    <td><input type="text" id="birthdate" class="input" name="dealername"  readonly></td>
  </tr>
  <tr>
    <th>emailid</th>
    <td><input type="text" id="firstname"class="input" name="emailid"  readonly></td>
    <th>webaddress</th>
    <td><input type="text" id="gender"  class="input"name="webaddress"  readonly></td>
  </tr>
  <tr>
    <th>city</th>
    <td><input type="text" id="middlename" class="input" name="city"  readonly></td>
    <th>contactno</th>
    <td><input type="text" id="cstatus" class="input" name="contactno" readonly></td>
  </tr>
  <tr>
    <th>state</th>
    <td><input type="text" id="lastname"class="input" name="state" readonly></td>
    
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


$('#edit').click(function(){
  $('input').toggleClass('input');
  $('input').each(function(){
    var inp = $(this);

   
    if (inp.attr('readonly')) {

        $.ajax({
        url : "<?php echo site_url('userprofile/display')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
           
            $('[name="brand_name"]').val(data.brandname);
            $('[name="dealername"]').val(data.dealername);
            $('[name="emailid"]').val(data.emailid);
            $('[name="webaddress"]').val(data.wedaddress);
            $('[name="city"]').val(data.city);
            $('[name="contactno"]').val(data.contactno);
            $('[name="state"]').val(data.state);
       
 
        },
       
    });
      
      inp.removeAttr('readonly');   

      document.getElementById("edit").innerHTML = 'cancel';
      document.getElementById("res1").disabled = true;
      document.getElementById("res2").disabled = true;  
      document.getElementById("save").style.display = "block";
 

         
    }
    else {

        $.ajax({
        url : "<?php echo site_url('userprofile/display')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
           
            $('[name="brand_name"]').val(data.brandname);
            $('[name="dealername"]').val(data.dealername);
            $('[name="emailid"]').val(data.emailid);
            $('[name="webaddress"]').val(data.wedaddress);
            $('[name="city"]').val(data.city);
            $('[name="contactno"]').val(data.contactno);
            $('[name="state"]').val(data.state);
       
 
        },
       
    });


      inp.attr('readonly', 'readonly');
      $('#branddet')[0].reset();
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
        url :  "<?php echo site_url('employees/branddetailsinsert')?>/"+id,
        type: "POST",
        data: $('#branddet').serialize(),
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
        url :  "<?php echo site_url('userprofile/branddetailsinsert')?>",
        type: "POST",
        data: $('#branddet').serialize(),
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


