
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
                    <li class="active"><a href="#tab1default" data-toggle="tab">Employee List</a></li>
                            <li><a href="#tab2default" data-toggle="tab">employee Requests</a></li>
                         
                           
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">


<!--                                                 Employee List                                         -->

                        <div class="tab-pane fade in active" id="tab1default">



        
 
        <h3>Employee List</h3>
        <br />
        <button class="btn btn-success" onclick="add_employee()"><i class="glyphicon glyphicon-plus"></i> Add Employee</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Employee Id</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Contact No.</th>
                                <th>Address</th>
                                <th style="width:150px;">Action</th>
                            </tr>
                        </thead>
                       
                    </table>


                </div>

<!--                                                 employee Request                                         -->

                <div class="tab-pane fade" id="tab2default">


    
                </div>
            </div><!-- tab content-->
        </div> <!--panel body-->           
     </div><!-- panel default -->
   </div>   <!-- container -->      




<script type="text/javascript">

var save_method; //for save method string
var table;

   $(document).ready(function () {

       //datatables
    table = $('#table').DataTable({
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('employees/ajax_list')?>",
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


            
    });

function add_employee()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty();
     $.ajax({
        url : "<?php echo site_url('employees/generate')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="user_id"]').val(data.year+data.month+data.total);
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    }); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Employee'); 

    
}
   
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}
 

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
 
   
    // ajax adding data to database
    $.ajax({
        url : "<?php echo site_url('employees/add_employee')?>",
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

function delete_employee(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('employee/delete_employee')?>/"+id,
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
 

 </script>



<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h3 class="modal-title">Add Employee</h3>
               
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">

                <div class="row">   
                    <div class="col-md-6">     
                                 
                         <div class="form-group">
                         <div class="col-md-12">                                                  
                            <label>Employee Id</label>
                             <input id="user_id" name="user_id" placeholder="User Id" class="form-control" type="text" readonly>
                                <span class="help-block"></span>                      
                        </div>
                    </div>
                    </div>

                    <div class="col-md-6">   
                        
                            <div class="form-group">
                                <div class="col-md-12"> 
                                <label>Department</label>
                                <input name="department" id="department" placeholder="Department"class="form-control" type="text"></input>
                                <span class="help-block"></span>
                            </div>                         
                        </div>
                    </div>
                </div>
                <div class="row">   
                         <div class="col-md-6">
                            
                            <div class="form-group"> 
                            <div class="col-md-12">                                             
                                <label>First Name</label>                           
                                <input id="firstname" name="firstname" placeholder="First Name" class="form-control" type="text">
                                <span class="help-block"></span>                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                             <div class="form-group">
                                <div class="col-md-12">
                                <label>Position</label>
                                <input name="position" id="position" placeholder="position"class="form-control" type="text"></input>
                                <span class="help-block"></span>
                            </div>
                            </div>
                        </div>
                </div>
                 <div class="row">   
                        <div class="col-md-6">
                           
                           <div class="form-group">
                            <div class="col-md-12">                                                 
                                <label>Middle Name</label>
                                 <input name="middlename" id="middlename" placeholder="Middle Name"class="form-control" type="text"></input>
                                <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <div class="col-md-12">
                                <label>Contact No.</label>
                                <input name="contact_no" id="contact_no" placeholder="Contact No."class="form-control" type="text"></input>
                                <span class="help-block"></span>
                            </div>
                            </div>
                        </div>
                </div>
                 <div class="row">   

                        <div class="col-md-6">
                           
                           <div class="form-group">   
                            <div class="col-md-12">                            
                                <label>Last Name</label>
                                <input name="lastname" id="lastname" placeholder="Last Name"class="form-control" type="text"></input>
                                <span class="help-block"></span>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                           
                            <div class="form-group"> 
                             <div class="col-md-12">      
                                <label>Address</label>
                                <textarea id="address" name="address" placeholder="Address" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
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
 
