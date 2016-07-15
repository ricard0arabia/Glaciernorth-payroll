<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li style = "font-weight: bold;" ><a href="<?php echo site_url() ?>employees" role="tab">Employee List</a></li>

                 <li style = "font-weight: bold;" ><a href="<?php echo site_url() ?>loan" role="tab">Loan</a></li>

                  <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>shift" role="tab">Shift</a></li>

                  <li style = "font-weight: bold;" class="active"><a href="#" role="tab">Leave</a></li>

                  <li style = "font-weight: bold;"><a href="<?php echo site_url() ?>overtime" role="tab">Overtime</a></li>

               
                        
                </ul>

                        <div class="tab-content  ">

                            <div class="tab-pane active" id="basic-info">
                                 <div class="box box-primary">
                                           
                                    <div class="box-body">

       <button class="waves-effect waves-light btn" onclick="add_leave()"><i class="glyphicon glyphicon-plus"></i> Add Leave</button>
        <button class="waves-effect waves-light btn" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>

<!-- /.row -->
<div class="row">

    <div class="col-lg-12">
        
          <div class = "panel-heading"><h5>Manage Employees Leave</h5></div> 
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
            
                <br>
                <div class="dataTables_wrapper">
             
                  
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="center">Name</th>
                                <th class="center">Department</th>
                            	<th class="center">Leave Type</th>
                                <th class="center">Leave Start Date</th>
                                <th class="center">Leave End Date</th>
                                <th class="center">Leave Balance</th>
                                <th class="center">Created Date</th>
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

 
<script type="text/javascript">
 
var save_method; //for save method string
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('person/ajax_list')?>",
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
 
    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });
 
    //set input/textarea/select event when change value, remove class error and remove text help block
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
 
});
 
 
 
function add_leave()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Leave'); // Set Title to Bootstrap modal title
}
 
function edit_leave(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('person/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id"]').val(data.id);
            $('[name="firstName"]').val(data.firstName);
            $('[name="lastName"]').val(data.lastName);
            $('[name="gender"]').val(data.gender);
            $('[name="address"]').val(data.address);
            $('[name="dob"]').datepicker('update',data.dob);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}
 
function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
 
    if(save_method == 'add') {
        url = "<?php echo site_url('person/ajax_add')?>";
    } else {
        url = "<?php echo site_url('person/ajax_update')?>";
    }
 
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
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
 
function delete_leave(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('person/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}
 $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
 
</script>


<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
            
                <h6 class="modal-title">Add Leave</h6>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="control-label col-md-3">Employee Name</label>
                           
                                <input name="empname" placeholder="Employee Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label col-md-3">Leave Type</label>
                           
                              
                                <select name="type" class="form-control">
                                    <option value="">--Select Type--</option>
                                    <option value="sick">Sick Leave</option>
                                    <option value="vacation">Vacation Leave</option>
                                    <option value="emergency">Emergency Leave</option>
                                </select>

                                <span class="help-block"></span>
                           
                        </div>
                      </div> 
                      <div class="row">
                       <div class="col-lg-6">
                            <label class="control-label col-md-3">Leave Start Date</label>
                           

                                <input name="startdate"  class="datepicker" type="date">
                                <span class="help-block"></span>
                                
                         
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label col-md-3">Leave End Date</label>
                            
                                <input name="enddate" class="datepicker" type="date">
                                <span class="help-block"></span>
                          
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-lg-6">
                            <label class="control-label col-md-3">Reason</label>
                           
                                <textarea name="reason" placeholder="Reason" class="form-control"></textarea>
                                <span class="help-block"></span>
                         
                        </div>
                   </div>
                     
                    </div>
                </form>
                <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
            </div>
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- <script>
$(document).ready(function () {
            $('select.department').change(function(e){
              // this function runs when a user selects an option from a <select> element
              window.location.href = $("select.department option:selected").attr('value');
           });
    });
</script> --> 