 <style>
 th{

  text-align: center;
}
 </style> 
   <div class="container">

  <h3>Payroll for <?php echo date("F j,Y", strtotime($payperiod->date_from)); ?> to <?php echo date("F j,Y", strtotime($payperiod->date_to)); ?></h3>
    <br>

 <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
  <button class="btn btn-success pull-right" onclick="generate_payroll()"><i class="glyphicon glyphicon-plus"></i> Generate Payroll</button>
        <br />
        <br />
        <table id="payroll_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Basic Salary</th>
                                <th>Allowance</th>
                                <th>Overtime</th>
                                <th>Gross Salary</th>
                                <th>Deductions</th>
                                <th>Gov't Contributions</th>
                                <th>Withholding Tax</th>
                                <th>Net Income</th>
                                <th style="width:160px;">Action</th>
                            </tr>
                        </thead>
                       
                    </table>

</div>








<script type="text/javascript">
var table1;

   $(document).ready(function () {

       //datatables
    table1 = $('#payroll_table').DataTable({
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "dom": 'Bfrtip',
         "buttons": [
        {
            extend: 'pdf',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n SSS Contribution Table ',
               orientation: 'portrait',
               customize: function(doc) {
                  doc.defaultStyle.fontSize = 16; //<-- set fontsize to 16 instead of 10 
               }  
       },
       {
           extend: 'csv',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n SSS Contribution Table ',
          
       },
       {
           extend: 'excel',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4]
             },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n SSS Contribution Table ',
       },
       {
           extend: 'print',
           footer: true,
           exportOptions: {
                columns: [0,1,2,3,4]
            },
             header: true,
               title: 'Glacier North Refrigeration Inc. \n SSS Contribution Table ',
       }          
        ],
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('payroll/payroll_table')?>",
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

function generate_payroll(){

 $.ajax({
        url : "<?php echo site_url('payroll/generate_payroll')?>",
        type: "GET",
        dataType: "JSON",

        success: function(data)
        {
          alert(data.hello);
          reload_table();
        },
       
    });
  
}
function reload_table()
{
    table1.ajax.reload(null,false); //reload datatable ajax
}

 </script>
