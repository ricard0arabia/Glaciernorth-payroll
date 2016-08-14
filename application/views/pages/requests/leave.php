
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
   </style>
   <div class="container">
        
 
            <div class="panel with-nav-tabs panel-info">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1default" onclick="reload_table1()" data-toggle="tab">Leave Requested</a></li>
                            <li><a href="#tab2default" onclick="reload_table2()" data-toggle="tab">History of Filings</a></li>
                         
                           
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">


<!--                                                 Employee List                                         -->

                        <div class="tab-pane fade in active" id="tab1default">


        <h3>My Leave Requests</h3>
        <br />
        <button class="btn btn-success" onclick="add_leave()"><i class="glyphicon glyphicon-plus"></i> Add Leave</button>
        <button class="btn btn-default" onclick="reload_table1()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                
                                <th>Leave Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Duration</th>
                                <th>Cause</th>
                                <th style="width:100px;">Status</th>
                                
                                
                                <th style="width:155px;">Action</th>
                            </tr>
                        </thead>
                       
                    </table>




                </div>

<!--                                                 employee Request                                         -->

                <div class="tab-pane fade" id="tab2default">


                    <h3>Leave Request History</h3>
        <br />
        <button class="btn btn-default" onclick="reload_table2()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Leave Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Duration</th>
                                <th>Cause</th>
                                <th>Date Filed</th>
                                <th>Date Approved</th>
                                <th style="width:100px;">Status</th>                  
                            </tr>
                        </thead>
                       
                    </table>


    
                </div>
            </div><!-- tab content-->
        </div> <!--panel body-->           
     </div><!-- panel default -->
   </div>   <!-- container -->      



   



        
 
<script type="text/javascript">

var save_method; //for save method string
var table1;
var table2;


   $(document).ready(function () {

       //datatables
    table1 = $('#table1').DataTable({
         "dom": 'Bfrtip',
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "buttons": [
        {
            extend: 'pdf',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
               orientation: 'portrait',
               customize: function(doc) {
                  doc.defaultStyle.fontSize = 16; //<-- set fontsize to 16 instead of 10 
               }  
       },
       {
           extend: 'csv',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
          
       },
       {
           extend: 'excel',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
       },
       {
           extend: 'print',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
       }          
        ],
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('leave/request_list')?>",
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

      table2 = $('#table2').DataTable({
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "dom": 'Bfrtip',
         "buttons": [
        {
            extend: 'pdf',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
               orientation: 'portrait',
               customize: function(doc) {
                  doc.defaultStyle.fontSize = 16; //<-- set fontsize to 16 instead of 10 
               }  
       },
       {
           extend: 'csv',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
          
       },
       {
           extend: 'excel',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
       },
       {
           extend: 'print',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
       }          
        ],
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('leave/request_history_list')?>",
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
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });


     // set default dates
            var start = new Date();
            start.setDate(start.getDate() + 2);

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

function add_leave()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Leave Request'); // Set Title to Bootstrap modal title
}

function edit_leave(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('leave/edit_leave')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id"]').val(data.leave_id);
            $('[name="startdate"]').val(data.startdate);
            $('[name="enddate"]').val(data.enddate);
            $('[name="duration"]').val(data.duration);
            $('[name="cause"]').val(data.cause);
            $('[name="leavetype"]').val(data.leavetype);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Leave'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

      
 function calcDiff() {
    var date1 = $('#fromDate').datepicker('getDate');
    var date2 = $('#toDate').datepicker('getDate');
    var diff = 0;
    if (date1 && date2) {
      diff = Math.floor((date2.getTime() - date1.getTime()) / 86400000) + 1; 
    }
    $('#calculated').val(diff);
  }

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
 
    if(save_method == 'add') {
        url = "<?php echo site_url('leave/add_leave')?>";
    } else {
        url = "<?php echo site_url('leave/update_leave')?>";
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
                reload_table1();
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
                reload_table1();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}
 

function reload_table1()
{
    table1.ajax.reload(null,false); //reload datatable ajax
}
function reload_table2()
{
    table2.ajax.reload(null,false); //reload datatable ajax
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

                           <div class="form-group">
                            <label class="control-label col-md-3">Leave Type</label>
                            <div class="col-md-5">
                                <select name="leavetype" class="form-control">
                                    <option value="">--Select Gender--</option>
                                    <option value="Sick">Sick</option>
                                    <option value="Vacation">Vacation</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>                  
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
                            <label class="control-label col-md-3">Duration</label>
                            <div class="col-md-5">
                                <input name="duration" id="calculated" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="control-label col-md-3">Cause</label>
                            <div class="col-md-5">
                                <textarea name="cause" placeholder="Cause" class="form-control"></textarea>
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
 
