   <div class="container">

  <h3>Timesheet for <?php echo date("F j,Y", strtotime($timesheet_data->date)); ?></h3>
    <br>
 <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table_attendance" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Department</th>
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

</div>








<script type="text/javascript">
var word_date = "<?php echo date("F j,Y", strtotime($timesheet_data->date)); ?>";
var save_method; //for save method string
var table;
var date_id = "<?php echo $timesheet_data->date; ?>";
   $(document).ready(function () {


       //datatables
    table1 = $('#table_attendance').DataTable({
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('time/attendance_list')?>/" + date_id,
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

    $('#time_in').timepicker().on('changeTime.timepicker', function (a) {
         $('#time_out').timepicker().on('changeTime.timepicker', function (b){

           
        var newDate =(b.time.hours)-(a.time.hours);
         $("#duration").val(newDate);
      
         });
     });
   $('#time_out').timepicker().on('changeTime.timepicker', function (b) {
         $('#time_in').timepicker().on('changeTime.timepicker', function (a){
        var newDate =(b.time.hours)-(a.time.hours);
         $("#duration").val(newDate);
      
         });
     });

            
    });


function formatDate(date) {
    var date = new Date(date);
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear() + "  " + strTime;
}



function add_attendance(id)
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
   
    $.ajax({
        url : "<?php echo site_url('time/get_attendance')?>/" + id +"/"+ date_id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
             var start = formatDate(data.start);
             var end = formatDate(data.end);
             $('[name="id"]').val(id);
            $('[name="start"]').val(start);
            $('[name="end"]').val(end);
           $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Attendance ' + word_date ); // Set Title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


   


function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
 

    $.ajax({
        url : "<?php echo site_url('time/add_attendance')?>/"+date_id,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
              if(data.warning == false){

                  alert('Entered date not valid');

                }
                else{

                  
                $('#modal_form').modal('hide');
                reload_table();
                
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
 

function reload_table()
{
    table1.ajax.reload(null,false); //reload datatable ajax
}

 </script>





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

                       
                            <div class="col-md-6">  
                                <div class="form-group">
                                    
                                        <div class="col-md-12">    
                                        <label class="control-label">Schedule Start time</label>
                                        <input id="start" name="start" class="form-control" type="text" readonly>
                                        </div>
                                       
                                </div>  
                            </div> 
                                <div class="col-md-6">  
                                <div class="form-group">
                                 
                                        <div class="col-md-12">  
                                        <label class="control-label">Schedule End time</label>                     
                                        <input id="end" name="end"  class="form-control" type="text" readonly>
                                        </div>  
                                </div>   
                            </div>
                      
                    <div class="form-group">
                             <label class="control-label col-md-3">Time-in</label>
                            <div class="col-md-5">                           
                          <input id="time_in" name="time_in" placeholder="yyyy-mm-dd" class="time form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                       
                       
                        <div class="form-group">
                             <label class="control-label col-md-3">Time-out</label>
                            <div class="col-md-5">                           
                          <input id="time_out" name="time_out" placeholder="yyyy-mm-dd" class="time form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                         

                         <div class="form-group">
                            <label class="control-label col-md-3">Hours worked</label>
                            <div class="col-md-5">
                                <input name="totalhours" id="totalhours" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="control-label col-md-3">Overtime</label>
                           <div class="col-md-5">
                                <input name="overtime" id="overtime" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Undertime</label>
                            <div class="col-md-5">
                                <input name="undertime" id="undertime" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tardiness</label>
                             <div class="col-md-5">
                                <input name="tardiness" id="tardiness" class="form-control"></input>
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