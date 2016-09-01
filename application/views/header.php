<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Glacier Payroll System</title>

 
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
  
        <link href="<?php echo base_url('assets/fullcalendar-2.1.1/fullcalendar.min.css')?>" rel="stylesheet">

        <link href="<?php echo base_url('assets/fullcalendar-2.1.1/fullcalendar.min.css')?>" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
   <link href="<?php echo base_url();?>assets/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>assets/css/bootstrap-timepicker.min.css" rel="stylesheet" />

<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<style>
@font-face {
    font-family: billabong;
    src: url(assets/font/billabong.woff) format('woff'),
         url(../assets/font/billabong.woff) format('woff'),
         url(../../assets/font/billabong.woff) format('woff');
}

.bootstrap-timepicker-widget.dropdown-menu {
    z-index: 1050!important;
}



</style>
<body>

   <div class="navbar navbar-inverse" role="navigation">
  
  <div class="navbar-header">
      
         <?php if($this->session->userdata('level') == 1) { ?>

              <a href = "<?php echo site_url()."dashboard"; ?>" style="font-family: billabong; font-size: 200%;"class="navbar-brand">Accounting</a><?php } elseif ($this->session->userdata('level') == 2) { ?>

              <a href = "<?php echo site_url()."dashboard"; ?>" style="font-family: billabong; font-size: 200%;"class="navbar-brand">Human Resources</a>
               <?php } else { ?>

              <a href = "<?php echo site_url()."dashboard"; ?>" style="font-family: billabong; font-size: 200%;" class="navbar-brand">Employee Portal</a>

               <?php } ?>
  </div>
                
         
 <div class="collapse navbar-collapse">
             
             <ul class="nav navbar-nav">


                        <!-- _______________Profile________________  -->

                <?php if($this->uri->segment(1) == "userprofile" || $this->uri->segment(1) == "settings") { ?> <li  class = "active" > <?php }else { ?>
                 <li> <?php } ?> <a  class="waves-effect waves-default btn-small"  href="<?php echo site_url()."userprofile"; ?>"> <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Profile</a></li>


                             <!-- _______________time________________  -->

                    <?php if($this->uri->segment(1) == "time" ) { ?> <li  class = "active" > <?php } else { ?>
                 <li> <?php } ?>
                    <a  class="waves-effect waves-default btn-small"  href="<?php echo site_url(). "time"; ?>"> <span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Time </a></li>

                        <!-- _______________Request________________  -->
                 
                 <li class="dropdown">
                  
                  <a href="#" data-toggle="dropdown" class="dropdown-toggle active">Requests<b class="caret"></b></a>
                   <ul class="dropdown-menu">
                    <li class="dropdown-header">Leaves</li>              
            <li><a href="<?php echo site_url()."leave/request"; ?>">List of Leave Requests</a></li>
                   <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Overtime</li>
          <li><a href="<?php echo site_url()."overtime/request"; ?>">List of OT Requests</a></li>
          <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Shift Change</li>
          <li><a href="<?php echo site_url()."shift"; ?>">List of Shift requests</a></li>
                   </ul>
                    </li>

<!-- *****************************      Hr      ************************************************* -->

                  <?php if($this->session->userdata('level') == 2) { ?>

                          <!-- _______________Approvals________________  -->

                 <li class="dropdown">
                  <a href="#" data-toggle="dropdown" class="dropdown-toggle active">Approvals<b class="caret"></b></a>
                   <ul class="dropdown-menu">
                    
            <li><a href="<?php echo site_url()."leave/approval"; ?>">Leaves</a></li>             
          <li><a href="<?php echo site_url()."overtime/approval"; ?>">Overtime</a></li>
         <li><a href="<?php echo site_url()."shift"; ?>">Shift Change</a></li>
                   </ul>
                    </li>


                            <!-- _______________Employees________________  -->

                     <?php if($this->uri->segment(1) == "employees" ) { ?> <li  class = "active" > <?php } else { ?>
                 <li> <?php } ?> <a  class="waves-effect waves-default btn-small"  href="<?php echo site_url(). "employees"; ?>"> <span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Employees </a></li>
                                   
                  <?php } ?>

         <!-- *****************************    Employee    ****************************** -->
                

                        
                  <?php if($this->uri->segment(1) == "compensation" ) { ?> <li  class = "active" > <?php }else { ?>
                <li> <?php } ?><a  class="waves-effect waves-default btn-small"  href="<?php if($this->session->userdata('level') == 1) {  echo site_url(). "compensation/payperiod"; } else {echo site_url(). "compensation/payslip";} ?>"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Compensation</a></li>


 <!-- *****************************    Payroll for accountant    ****************************** -->
  <?php if($this->session->userdata('level') == 1) { ?>
         
           <?php if($this->uri->segment(1) == "payroll" ) { ?> <li  class = "active" > <?php }else { ?>
           <li> <?php } ?><a  class="waves-effect waves-default btn-small"  href="<?php echo site_url(). "payroll"; ?>"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Payroll</a></li>



<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                     <li ><a href="<?php echo site_url()."reports/tables";?>" >Tables</a></li>
                      <li><a href="<?php echo site_url()."reports/reports_period";?>">Reports</a></li>
                     </ul>
                    </li>

<?php } ?>



                 <!-- *****************************    Options    ****************************** -->


                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Options</a>
                    <ul class="dropdown-menu">
                     <li ><a href="<?php echo site_url()."settings"; ?>" >Settings</a></li>
                      <li><a href="<?php echo site_url()."userprofile/view".$this->session->userdata('username'); ?>">Profile</a></li>
                      <li><a href="<?php echo site_url()."login/logout";?>" >Sign out</a></li>         
                     </ul>
                    </li>
              </ul>        

    
          </div>
     </div>

       <!-- jQuery -->
    <script src="<?php echo base_url('assets/js/moment.js')?>"></script>
  <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>

<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>

 <script src='<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js'></script>
  <script src="<?php echo base_url()?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
 <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
 <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
 <script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
 <script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>

         <script src='<?php echo base_url();?>assets/fullcalendar-2.1.1/fullcalendar.min.js'></script>
     
<script src='<?php echo base_url();?>assets/js/bootstrap-colorpicker.min.js'></script>
        <script src='<?php echo base_url();?>assets/js/bootstrap-timepicker.min.js'></script>
                <script src='<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js'></script>
        
       <div class = "row">
         
 