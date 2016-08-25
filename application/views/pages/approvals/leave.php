 
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
                    <li class="active"><a href="#tab1default" onclick="reload_table1()" data-toggle="tab">Approvals List</a></li>
                            <li><a href="#tab2default" onclick="reload_table2()" data-toggle="tab">History of Approvals</a></li>
                         
                           
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">


<!--                                                 Employee List                                         -->

                        <div class="tab-pane fade in active" id="tab1default">



        
 
      
 <h3>Manage Requested Leaves</h3>
        <br />
        <button class="btn btn-default" onclick="reload_table1()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Leave Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Duration</th>
                                <th>Cause</th>
                                <th style="width:100px;">Status</th>
                                <th style="width:150px;">Action</th>
                            </tr>
                        </thead>
                       
                    </table>


                </div>

<!--                                                 employee Request                                         -->

                <div class="tab-pane fade" id="tab2default">

 <h3>History of Approvals</h3>
        <br />
        <button class="btn btn-default" onclick="reload_table2()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Department</th>
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
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
         "dom": 'Bfrtip',
         "buttons": [
        {
            extend: 'pdf',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Summary Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
               orientation: 'landscape',
               customize: function(doc) {
                  doc.defaultStyle.fontSize = 16; //<-- set fontsize to 16 instead of 10 
               }  
       },
       {
           extend: 'csv',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Summary Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
          
       },
       {
           extend: 'excel',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Summary Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
       },
       {
           extend: 'print',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Summary Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
       }          
        ],
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('leave/approval_list')?>",
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

          //datatables
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
                columns: [0,1,2,3,4,5,6,7,8,9,10]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Summary Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
               orientation: 'portrait',
               customize: function(doc) {
                  doc.defaultStyle.fontSize = 12; //<-- set fontsize to 16 instead of 10 
               }  
       },
       {
           extend: 'csv',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Summary Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
          
       },
       {
           extend: 'excel',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Summary Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
       },
       {
           extend: 'print',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Leave Summary Report \n <?php echo ucfirst($name[0]['firstname']).' '.ucfirst(substr($name[0]['middlename'],0,1)).'. '.ucfirst($name[0]['lastname']); ?> ',
       }          
        ],
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('leave/approval_history_list')?>",
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

    });

function accept_leave(id)
{
    
    $.ajax({
            url : "<?php echo site_url('leave/accept_leave')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
              alert(data.check);
                reload_table1();
            },
        });
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
