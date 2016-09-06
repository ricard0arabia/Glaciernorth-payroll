   <div class="container">

  <h3>Reports Period</h3>
  
    <br>
       <button class="btn btn-success" onclick="add_reports_period()"><i class="glyphicon glyphicon-plus"></i> Reports Period </button>
       <button class="btn btn-success pull-right" onclick="test()"><i class="glyphicon glyphicon-plus"></i> test </button>
 <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Period</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Total Employee Share</th>
                                <th>Total Employer Share</th>
                                <th>Total Share</th>
                                 <th style="width:160px;">Action</th>
                           
                            </tr>
                        </thead>
                       
                    </table>

</div>








<script type="text/javascript">


var table;

   $(document).ready(function () {


       //datatables
   table = $('#table').DataTable({
 
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
               title: 'Glacier North Refrigeration Inc. \n Payperiod Summary Table ',
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
               title: 'Glacier North Refrigeration Inc. \n Payperiod Summary Table ',
          
       },
       {
           extend: 'excel',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Payperiod Summary Table ',
       },
       {
           extend: 'print',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Payperiod Summary Table ',
       }          
        ],
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('reports/reports_period_list')?>",
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



       

            $('#fromDate').datepicker({
                format: "yyyy-mm-dd",
            });

            $('#toDate').datepicker({
                format: "yyyy-mm-dd",
        
            });


  

            
    });


    function test()
{

    $.ajax({
        url : "<?php echo site_url('reports/test_tax')?>",
        type: "GET",
        dataType: "JSON",

        success: function(data)
        {
 

        },
       
    });
}

   function add_reports_period()
{

    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Reports Period'); // Set Title to Bootstrap modal title
}


function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
   

    
 
    
    $.ajax({
        url : "<?php echo site_url('reports/add_reports_period')?>",
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
             
               if(data.warning){

                alert(data.info);
               }else{
               
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


function delete_reports_period(id,date)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('reports/delete_reports_Period')?>/"+id+"/"+date,
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

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}



 </script>





<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h3 class="modal-title">Add Reports Period</h3>
               
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
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
 