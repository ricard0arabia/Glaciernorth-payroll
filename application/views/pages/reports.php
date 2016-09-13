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
                    <li class="active"><a href="#sss" onclick="reload_table1()" data-toggle="tab">SSS Report</a></li>
                    <li><a href="#philhealth" onclick="reload_table2()" data-toggle="tab">Philhealth Report</a></li>
                    <li><a href="#pagibig" onclick="reload_table3()" data-toggle="tab">HDMF Report</a></li>
                    <li><a href="#bir" onclick="reload_table4()" data-toggle="tab">Withholding Tax Report</a></li>
                         
                           
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">


<!--                                                 Employee List                                         -->

                        <div class="tab-pane fade in active" id="sss">
  <h3>Social Security System Report from <?php echo $period->date_from;?> to <?php echo $period->date_to;?> </h3>
        <br />
        <button class="btn btn-default" onclick="reload_table1()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                

                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Period Covered</th>
                                <th>SSS Number</th>
                                <th>Employee Share</th>
                                <th>Employer Share</th>
                                <th>Total Share</th>
                            </tr>
                        </thead>
                       
                    </table>




                </div>

<!--                                                 employee Request                                         -->

                <div class="tab-pane fade" id="philhealth">


                           <h3>Philhealth Contribution Table</h3>
        <br />
        <button class="btn btn-default" onclick="reload_table2()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>

                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Period Covered</th>
                                <th>Philhealth Number</th>
                                <th>Employee Share</th>
                                <th>Employer Share</th>
                                <th>Total Share</th>
                 
                            </tr>
                        </thead>
                       
                    </table>


                  
    
                </div>


      <div class="tab-pane fade" id="pagibig">


                           <h3>HDMF Contribution Table</h3>
        <br />
        <button class="btn btn-default" onclick="reload_table3()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table3" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>

                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Period Covered</th>
                                <th>HDMF Number</th>
                                <th>Employee Share</th>
                                <th>Employer Share</th>
                                <th>Total Share</th>
                 
                            </tr>
                        </thead>
                       
                    </table>


                  
    
                </div>



       <div class="tab-pane fade in" id="bir">

         <h3>BIR Tax Table</h3>
        <br />
        <button class="btn btn-default" onclick="reload_table4()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table4" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>

                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Period Covered</th>
                                <th>TIN Number</th>
                                <th>Withholding Tax</th>
                 
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
var table3;
var period = "<?php echo $period->date_to;?>";

   $(document).ready(function () {
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
                columns: [0,1,2,3,4,5,6]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n SSS Contribution Table ',
                orientation: 'landscape',
               customize: function(doc) {
                  doc.defaultStyle.fontSize = 13; //<-- set fontsize to 16 instead of 10 
               }  
       },
       {
           extend: 'csv',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n SSS Contribution Table ',
          
       },
       {
           extend: 'excel',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n SSS Contribution Table ',
       },
       {
           extend: 'print',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
            },
             header: true,
               title: '<center>Glacier North Refrigeration Inc. </center><center> Social Security System Reports</center><center><?php echo $period->date_from;?> to <?php echo $period->date_to;?></center>',
       }          
        ],
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('reports/sss_reports')?>/" + period,
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
               title: 'Glacier North Refrigeration Inc. \n Philhealth Contribution Table ',
                 orientation: 'landscape',
               customize: function(doc) {
                  doc.defaultStyle.fontSize = 13; //<-- set fontsize to 16 instead of 10 
               }  
       },
       {
           extend: 'csv',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Philhealth Contribution Table ',
          
       },
       {
           extend: 'excel',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Philhealth Contribution Table ',
       },
       {
           extend: 'print',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
            },
             header: true,
               title: '<center>Glacier North Refrigeration Inc. </center><center>Philhealth Reports</center><center> <?php echo $period->date_from;?> to <?php echo $period->date_to;?></center>',
       }          
        ],
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('reports/philhealth_reports')?>/"+period,
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


  table3 = $('#table3').DataTable({
 
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
               title: 'Glacier North Refrigeration Inc. \n Home and Development Mutual Fund Contribution Table ',
              orientation: 'landscape',
               customize: function(doc) {
                  doc.defaultStyle.fontSize = 13; //<-- set fontsize to 16 instead of 10 
               }  
       },
       {
           extend: 'csv',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Home and Development Mutual Fund Contribution Table ',
          
       },
       {
           extend: 'excel',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Home and Development Mutual Fund Contribution Table ',
       },
       {
           extend: 'print',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
            },
             header: true,
               title: '<center>Glacier North Refrigeration Inc. </center><center>Home Development Fund Reports</center><center> <?php echo $period->date_from;?> to <?php echo $period->date_to;?></center>',
       }          
        ],
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('reports/pagibig_reports')?>/"+period,
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





      table4 = $('#table4').DataTable({
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "dom": 'Bfrtip',
         "buttons": [
        {
            extend: 'pdf',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5]
            },
             header: true,
               title: '<center>Glacier North Refrigeration Inc. </center><br><center> Bir Tax Table</center>',
               orientation: 'landscape',
               customize: function(doc) {
                  doc.defaultStyle.fontSize = 13; //<-- set fontsize to 16 instead of 10 
               }  
       },
       {
           extend: 'csv',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Bir Tax Table ',
          
       },
       {
           extend: 'excel',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Bir Tax Table ',
       },
       {
           extend: 'print',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4,5]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n Bir Tax Table ',
       }          
        ],
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('reports/bir_table')?>",
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
 

function reload_table1()
{
    table1.ajax.reload(null,false); //reload datatable ajax
}
function reload_table2()
{
    table2.ajax.reload(null,false); //reload datatable ajax
}
function reload_table3()
{
    table3.ajax.reload(null,false); //reload datatable ajax
}
function reload_table4()
{
    table4.ajax.reload(null,false); //reload datatable ajax
}
 </script>

