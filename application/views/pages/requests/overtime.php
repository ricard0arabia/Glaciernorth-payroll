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
                    <li class="active"><a href="#tab1default" onclick="reload_table1()" data-toggle="tab">Overtime Requested</a></li>
                            <li><a href="#tab2default" onclick="reload_table2()" data-toggle="tab">History of Filings</a></li>
                         
                           
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">


<!--                                                 Employee List                                         -->

                        <div class="tab-pane fade in active" id="tab1default">


        <h3>My Overtime Requests</h3>
        <br />
        <button class="btn btn-success" onclick="add_overtime()"><i class="glyphicon glyphicon-plus"></i> Add Overtime</button>
        <button class="btn btn-default" onclick="reload_table1()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                

                                <th>Start Date</th>
                                <th>Duration</th>
                                <th>Cause</th>
                                <th style="width:100px;">Status</th>
                                <th style="width:170px;">Action</th>
                            </tr>
                        </thead>
                       
                    </table>




                </div>

<!--                                                 employee Request                                         -->

                <div class="tab-pane fade" id="tab2default">


                    <h3>Overtime Request History</h3>
        <br />
        <button class="btn btn-default" onclick="reload_table2()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>

                                <th>Start Date</th>
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
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
           "dom": 'Bfrtip',
         "buttons": [
        {
            extend: 'pdf',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Overtime Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
               orientation: 'portrait',
               customize: function(doc) {
                  doc.defaultStyle.fontSize = 16; //<-- set fontsize to 16 instead of 10 
               }  
       },
       {
           extend: 'csv',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Overtime Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
             
          
       },
       {
           extend: 'excel',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Overtime Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
              
       },
       {
           extend: 'print',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Overtime Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
             
       }          
        ],
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('overtime/request_list')?>",
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
               title: 'Glacier North Refrigeration Inc. \n Overtime Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
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
               title: 'Glacier North Refrigeration Inc. \n Overtime Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
              
          
       },
       {
           extend: 'excel',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Overtime Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
              
       },
       {
           extend: 'print',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Overtime Request Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
              
       }          
        ],
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('overtime/request_history_list')?>",
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


      var dateToday = new Date(); 

          $( ".datepicker" ).datepicker({
              minDate: 0
          });
 
            
    });

function add_overtime()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Overtime Request'); // Set Title to Bootstrap modal title
}

function edit_overtime(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('overtime/edit_overtime')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id"]').val(data.overtime_id);
            $('[name="date"]').val(data.date);
            $('[name="duration"]').val(data.duration);
            $('[name="cause"]').val(data.cause);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Overtime'); // Set title to Bootstrap modal title
 
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
 
    if(save_method == 'add') {
        url = "<?php echo site_url('overtime/add_overtime')?>";
    } else {
        url = "<?php echo site_url('overtime/update_overtime')?>";
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
              if(data.start == false){

                  alert('Start date not valid! Kingina mo! Overtime pa more');

                }
                else{

                  if(data.warning){

                     alert(data.warning);

                  }
                  else{
                $('#modal_form').modal('hide');
                reload_table1();
                }
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

function delete_overtime(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('overtime/delete_overtime')?>/"+id,
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
                <h3 class="modal-title">Add Overtime Request</h3>
               
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div class="row">

                                          
                         <div class="form-group">
                            <label class="control-label col-md-3">Date</label>
                            <div class="col-md-5">
                             <input name="date" placeholder="yyyy-mm-dd" id="datepicker" class="form-control datepicker" type="text">

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
 
