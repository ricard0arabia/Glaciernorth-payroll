<style>
td.highlight {
        font-weight: bold;
        color: blue;
    }
</style>
   <div class="container">
        
 <?php if($user == '2'){ ?>
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1default" data-toggle="tab">Timesheet</a></li>
                <li><a href="#tab2default" data-toggle="tab">Attendance</a></li>

                         
                           
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">


              <div class="tab-pane fade in active" id="tab1default">

        <button class="btn btn-success" onclick="add_timesheet()"><i class="glyphicon glyphicon-plus"></i> Timesheet </button>

               <h3>Manage Timesheet</h3>
    <br>
 <button class="btn btn-default" onclick="reload_table_timesheet()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table_timesheet" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Timesheet Date</th>
                    
                                
                        
                                <th style="width:180px;">Action</th>
                            </tr>
                        </thead>
                       
                    </table>
              </div>

<!--                                                 Employee List                                         -->


                        <div class="tab-pane fade in" id="tab2default">

<h3>My Attendnace</h3>
    <br>
 <button class="btn btn-default" onclick="reload_table_attendance()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table_attendance" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Timesheet Date</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Hours Worked</th>
                                <th>Overtime</th>
                                <th>Undertime</th>
                                <th>Tardiness</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                       
                    </table>

<?php }else{ ?>

<h3>My Atttendance</h3>
    <br>
 <button class="btn btn-default" onclick="reload_table_attendance()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table_attendance" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Timesheet Date</th>
                               <th>Time In</th>
                                <th>Time Out</th>
                                <th>Hours Worked</th>
                                <th>Overtime</th>
                                 <th>Tardiness</th>
                                <th>Undertime</th>
                                <th>Sched Type</th>
                                <th>Work Status</th>
                                <th>OT Status</th>
                           
                            </tr>
                        </thead>
                       
                    </table>



<?php } ?>


<script type="text/javascript">
var table1;
var table2;

   $(document).ready(function () {

       //datatables
    table1 = $('#table_timesheet').DataTable({
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('time/timesheet_list')?>",
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

    table2 = $('#table_attendance').DataTable({

        
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.


 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('time/emp_attendance_list')?>",
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

   

      $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });



            //
            var start = new Date();
          

            // set end date to max one year period:
            var end = new Date(new Date().setYear(start.getFullYear()+1));

            $('#fromDate').datepicker({
                format: "yyyy-mm-dd",
            
               
            // update "toDate" defaults whenever "fromDate" changes
            }).on('changeDate', function(){
                // set the "toDate" start to not be later than "fromDate" ends:
                $('#toDate').datepicker('setStartDate', new Date($(this).val()));
                calcDiff();
            }); 

            $('#toDate').datepicker({
                format: "yyyy-mm-dd",
                startDate : start,
                endDate   : end
            // update "fromDate" defaults whenever "toDate" changes
            }).on('changeDate', function(){
                // set the "fromDate" end to not be later than "toDate" starts:
                $('#fromDate').datepicker('setEndDate', new Date($(this).val()));
                calcDiff();
            });

 
});

function add_timesheet()
{

    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Timesheet'); // Set Title to Bootstrap modal title
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable

 

    // ajax adding data to database
    $.ajax({
        url : "<?php echo site_url('time/add_timesheet')?>",
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
             
                if(data.warning == false){

                     alert('Invalid entered date');

                }else{
                $('#modal_form').modal('hide');
                reload_table_timesheet();
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
function delete_leave(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('leave/delete_leave')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table_timesheet();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}
 

function reload_table_timesheet()
{
    table1.ajax.reload(null,false); //reload datatable ajax
}
function reload_table_attendance()
{
    table2.ajax.reload(null,false); //reload datatable ajax
}

 </script>



                </div>


                       
          
            </div><!-- tab content-->
        </div> <!--panel body-->           
     </div><!-- panel default -->
   </div>   <!-- container -->      





<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h3 class="modal-title">Add Timesheet</h3>
               
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                     <input type="hidden" value="" name="sub_id"/>
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
                

                         
                    </div>
                     
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 

  <!-- Modal Structure -->
 
