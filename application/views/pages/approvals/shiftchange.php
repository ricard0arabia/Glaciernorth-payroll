<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li style = "font-weight: bold;" ><a href="<?php echo site_url() ?>approvals/leave" role="tab">Leave</a></li>

                 <li style = "font-weight: bold;" ><a href="<?php echo site_url() ?>approvals/overtime" role="tab">Overtime</a></li>

                  <li style = "font-weight: bold;" class="active"><a href="" role="tab">Shift Change</a></li>

            

               
                        
                </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="basic-info">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">

    <a class="waves-effect waves-light btn" href="<?php echo site_url() ?>employees/add" role ="tab">Export this list</a>
        
     <a class="waves-effect waves-light btn" href="<?php echo site_url() ?>employees/add" role ="tab">All Request</a>

      <a class="waves-effect waves-light btn" href="<?php echo site_url() ?>employees/add" role ="tab">Pending Request</a>
<!-- /.row -->
<div class="row">

    <div class="col-lg-12">
        
          <div class = "panel-heading"><h5>Shift Change Requests submitted to me</h5></div> 
                <div class="divider"></div>
                <br><br>
     


            <div class="box-body">
                <?php if(!empty($success) || !empty($_SESSION['success'])) { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $_SESSION['success']; $_SESSION['success'] = '';?>
                </div>
                <?php } ?>
            </div>

            <!-- /.panel-heading -->
            <div class="box-body">
                  <div class="col-lg-6 pull-right">
                     <div class="col-lg-6">
                             <label>Department</label>

                             <form name="jump" class="center">
                                    <select class = "form-control "name="menu">
                                <?php if(!empty($dept)) { 
                                    foreach($dept as $_dept) {  ?>
                                                                  
                                    <option value="<?php echo site_url().'employees/print/'.$_dept['department']; ?>"><?php echo ucwords($_dept['department']);?></option>

                                <?php }} ?>
                                </select>
                            </form>
                    </div>
                    <br>
                    <div class="col-lg-6">
                    <input class="waves-effect waves-light btn" type="button" onClick="location=document.jump.menu.options[document.jump.menu.selectedIndex].value;" value="Print">

                     <!--   <button id = "but">Print</button> -->
                    </div>
                </div>

                <br>

                <br>

                <br>
                <div class="dataTables_wrapper">
             
                  
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="center">Image</th>
                            	<th class="center">ID</th>
                                <th class="center">Name</th>
                                <th class="center">Department</th>
                                <th class="center">Position</th>
                                <th class="center">Gender</th>
                                <th class="center">Contact Number</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $j=0;
                    		if(!empty($emp)) {
							$i=0;
							foreach($emp as $_emp) { 					
								if($i%2==0) { 
									$style = "odd";
									$i++;
								} else {
									$style = "even"; 
									$i++;
								}					
								$j++; ?>
                            <tr class="<?php echo $style; ?> gradeX">
                                <td><img height="60" width="60" src="<?=base_url().'uploads/'.$_emp['thumb_name'].$_emp['ext'];?>"></td>
                            	<td class="center"><?php echo $_emp['employeeid']; ?></td>
                                <td class="center"><?php echo $_emp['firstname'].$_emp['lastname'] ; ?></td>
                               	<td class="center"><?php echo $_emp['department']; ?></td>
                                <td class="center"><?php echo $_emp['jobtitle']; ?></td>
                                <td class="center"><?php echo $_emp['gender'];  ?></td>
                                <td class="center"><?php echo $_emp['contact_no'];  ?></td>
                                <td class="center"><a class="waves-effect waves-light btn" href="<?php echo site_url()."employees/edit/".$_emp['user_id']; ?>">Edit</a> | <a class="waves-effect waves-light btn" href="<?php echo site_url()."employees/delete/".$_emp['user_id']; ?>" onClick="return confirm('Are you sure you want to remove this employee <?php echo $_emp['employeeid']; ?>')">Delete</a></td>
                            </tr>
                            <?php }} ?>
                            
                        </tbody>
                    </table>
                </div>
               
            </div>
            <!-- /.panel-body -->
       
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
</div>
</div>
</div>
</div>

<!-- <script>
$(document).ready(function () {
            $('select.department').change(function(e){
              // this function runs when a user selects an option from a <select> element
              window.location.href = $("select.department option:selected").attr('value');
           });
    });
</script> --> 