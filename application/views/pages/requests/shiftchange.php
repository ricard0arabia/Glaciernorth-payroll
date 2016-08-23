
   <div class="container">
        
 
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1default" data-toggle="tab">Employee List</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Shift Change Requests</a></li>
                         
                           
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">


<!--                                                 Employee List                                         -->
<!--                                                 Employee List                                         -->

                        <div class="tab-pane fade in active" id="tab1default">




        <h3>Employee List</h3>
    <br>
 <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <?php

    $dates = array();
    $date = date('Y-m-d');
    $date = new DateTime($date);
    $week = $date->format("W");
    $year = date("Y");
    for($day=1; $day<=7; $day++)
    {
        $dates[] = date('Y-m-d', strtotime($year."W".$week.$day));
    }

    if($shift->num_rows() > 0){
            $temp = 0;
            $checks = array();
            $image = array();
            $name = array();
            $position = array();
            $department = array();
        
            foreach($check->result() as $list){ 
                $checks[] = $list->user_id;
                $image[] = '<img height="60" width="60" src="'.base_url().'uploads/'.$list->thumb_name.$list->ext.'">';
                $name[] = ucfirst($list->firstname).' '.ucfirst(substr($list->middlename,0,1)).'. '.ucfirst($list->lastname);
                $position[] = $list->position;
                $department[] = $list->department; 

            }
              
            $data = array();       
            $enddate = array();
            $ctrs = 0;
            $ctr = 0;
            $counter = 0;

              foreach($shift->result() as $row){ // loop through rows
                   
                    if($ctrs == 0){
                        if($row->day=='Mon'){
                              if($row->work_status == 'inactive'){
                                $data[] = ''; 
                                $enddate[] = "no work";
                                $counter++;
                                $ctrs++;
                                }
                                else{
                                $data[] = $row->start; 
                                $enddate[] = $row->end; 
                                $counter++; 
                                $ctrs++;
                            }
                        }
                        else if($row->day=='Tue'){
                            if($row->work_status == 'inactive'){
                                $data[] = ''; 
                                $data[] = ''; 
                                $enddate[] = "no work";
                                $enddate[] = "no work";
                                $counter+=2;
                                $ctrs++;
                                }
                                else{
                                $data[] = ''; 
                                $enddate[] = "no work"; 
                                $enddate[] = $row->end; 
                                $data[] = $row->start; $counter+=2; $ctrs++;
                            }
                        }
                        else if($row->day=='Wed'){
                             if($row->work_status == 'inactive'){
                                $data[] = ''; 
                                $data[] = '';
                                $data[] = '';
                                $enddate[] = "no work"; 
                                $enddate[] = "no work"; 
                                $enddate[] = "no work"; 
                                $counter+=3; $ctrs++;
                             }
                             else{
                                $data[] = ''; 
                                $data[] = '';
                                $enddate[] = "no work"; 
                                $enddate[] = "no work"; 
                                $enddate[] = $row->end; 
                                $data[] = $row->start; $counter+=3; $ctrs++;
                            }
                        }
                        else if($row->day=='Thu'){
                             if($row->work_status == 'inactive'){
                                $data[] = ''; 
                                $data[] = '';
                                $data[] = '';
                                $data[] = '';
                                $enddate[] = "no work";              
                                $enddate[] = "no work";            
                                $enddate[] = "no work";      
                                $enddate[] = "no work"; 
                                 $counter+=4; $ctrs++;
                             }
                             else{
                                $data[] = ''; 
                                $data[] = '';
                                $data[] = '';
                                $enddate[] = "no work";              
                                $enddate[] = "no work";            
                                $enddate[] = "no work";      
                                $enddate[] = $row->end; 
                                $data[] = $row->start; $counter+=4; $ctrs++;
                            }
                        }
                        else if($row->day=='Fri'){
                            if($row->work_status == 'inactive'){
                                $data[] = ''; 
                                $data[] = '';
                                $data[] = '';
                                $data[] = '';
                                $data[] = '';
                                $enddate[] = "no work"; 
                                $enddate[] = "no work";
                                $enddate[] = "no work"; 
                                $enddate[] = "no work"; 
                                $enddate[] = "no work";
                                $counter+=5; $ctrs++;
                            }
                            else{
                                $data[] = ''; 
                                $data[] = '';
                                $data[] = '';
                                $data[] = '';
                                $enddate[] = "no work"; 
                                $enddate[] = "no work";
                                $enddate[] = "no work"; 
                                $enddate[] = "no work"; 
                                $enddate[] = $row->end;
                                $data[] = $row->start; $counter+=5; $ctrs++;
                            }
                        }
                        else if($row->day=='Sat'){
                            if($row->work_status == 'inactive'){
                                $data[] = ''; 
                                $data[] = ''; 
                                $data[] = ''; 
                                $data[] = ''; 
                                $data[] = '';
                                $data[] = ''; 
                                $enddate[] = "no work";
                                $enddate[] = "no work";
                                $enddate[] = "no work";
                                $enddate[] = "no work"; 
                                $enddate[] = "no work";               
                                $enddate[] = "no work"; $counter+=6; $ctrs++;
                            }
                            else{
                                $data[] = ''; 
                                $data[] = ''; 
                                $data[] = ''; 
                                $data[] = ''; 
                                $data[] = '';
                                $enddate[] = "no work";
                                $enddate[] = "no work";
                                $enddate[] = "no work";
                                $enddate[] = "no work"; 
                                $enddate[] = "no work";
                                $data[] = $row->start;; 
                                $enddate[] = $row->end; $counter+=6; $ctrs++;
                            }
                        }
                        else if($row->day=='Sun'){
                            if($row->work_status == 'inactive'){
                                $data[] = ''; 
                                $data[] = '';  
                                $data[] = '';
                                $data[] = '';                
                                $data[] = ''; 
                                $data[] = ''; 
                                $data[] = '';  
                                $enddate[] = "no work";
                                $enddate[] = "no work";
                                $enddate[] = "no work"; 
                                $enddate[] = "no work";
                                $enddate[] = "no work";
                                $enddate[] = "no work";
                                $enddate[] = "no work"; $counter+=7; $ctrs++;
                            }
                            else{
                                $data[] = '';  
                                $data[] = '';
                                $data[] = '';                
                                $data[] = ''; 
                                $data[] = ''; 
                                $data[] = '';
                                $enddate[] = "no work";
                                $enddate[] = "no work";
                                $enddate[] = "no work"; 
                                $enddate[] = "no work";
                                $enddate[] = "no work";
                                $enddate[] = "no work";
                                $data[] = $row->start;  
                                $enddate[] = $row->end; $counter+=7; $ctrs++;
                            }
                        }
                    }
                    else{
                        if($row->work_status == 'inactive'){
                        $data[] = '';
                        $enddate[] = "no work";
                        $counter++;
                        }
                        else{
                        $data[] = $row->start;
                        $enddate[] = $row->end;
                        $counter++;
                        }
                    }
                

            if($counter == 7){

                $ctrs = 0;
            
                $counter = 0;
            }
                 
        }



        ?>
           <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Monday<br><?php echo date("M j,Y", strtotime($dates[0])); ?></th>
                                <th>Tuesday<br><?php echo date("M j,Y", strtotime($dates[1])); ?></th>
                                <th>Wednesday<br><?php echo date("M j,Y", strtotime($dates[2])); ?></th>
                                <th>Thursday<br><?php echo date("M j,Y", strtotime($dates[3])); ?></th>
                                <th>Friday<br><?php echo date("M j,Y", strtotime($dates[4])); ?></th>
                                <th>Saturday<br><?php echo date("M j,Y", strtotime($dates[5])); ?></th>
                                <th>Sunday<br><?php echo date("M j,Y", strtotime($dates[6])); ?></th>
                        
                                <th style="width:125px;">Action</th>
                            </tr>
                        </thead>
       
          <tbody id="message-tbody">
               
    <?php
              
      
    
    for($i = 1; $i <= $distinct; $i++){

    ?>
         <tr>

                            <td><?php echo $image[$i-1]; ?></td>
                            <td><?php echo $name[$i-1]; ?></td>
                            <td><?php echo $position[$i-1]; ?></td>
                            <td><?php echo $department[$i-1]; ?></td>
                            <td>
                                <?php if($enddate[$temp + 0] == 'no work'){ ?>
                                <h4><span class="label label-warning">no work</span></h4>
                             <?php  }else{ ?>
                                <?php echo date("h:i:sa", strtotime($data[$temp + 0])); ?> - <br>
                                <?php echo date("h:i:sa", strtotime($enddate[$temp + 0])); ?>
                            <?php } ?>
                            </td>
                            <td>
                               <?php if($enddate[$temp + 1] == 'no work'){ ?>
                               <h4><span class="label label-warning">no work</span></h4>
                             <?php  }else{ ?>
                                <?php echo date("h:i:sa", strtotime($data[$temp + 1])); ?> - <br>
                                <?php echo date("h:i:sa", strtotime($enddate[$temp + 1])); ?>
                            <?php } ?>
                            </td>
                            <td>
                               <?php if($enddate[$temp + 2] == 'no work'){ ?>
                                <h4><span class="label label-warning">no work</span></h4>
                             <?php  }else{ ?>
                                <?php echo date("h:i:sa", strtotime($data[$temp + 2])); ?> - <br>
                                <?php echo date("h:i:sa", strtotime($enddate[$temp + 2])); ?>
                            <?php } ?>
                            </td>
                            <td>
                               <?php if($enddate[$temp + 3] == 'no work'){ ?>
                                <h4><span class="label label-warning">no work</span></h4>
                             <?php  }else{ ?>
                                <?php echo date("h:i:sa", strtotime($data[$temp + 3])); ?> - <br>
                                <?php echo date("h:i:sa", strtotime($enddate[$temp + 3])); ?>
                            <?php } ?>
                            </td>
                            <td>
                              <?php if($enddate[$temp + 4] == 'no work'){ ?>
                                <h4><span class="label label-warning">no work</span></h4>
                             <?php  }else{ ?>
                                <?php echo date("h:i:sa", strtotime($data[$temp + 4])); ?> - <br>
                                <?php echo date("h:i:sa", strtotime($enddate[$temp + 4])); ?>
                            <?php } ?>
                            </td>
                            <td>
                             <?php if($enddate[$temp + 5] == 'no work'){ ?>
                                <h4><span class="label label-warning">no work</span></h4>
                             <?php  }else{ ?>
                                <?php echo date("h:i:sa", strtotime($data[$temp + 5])); ?> - <br>
                                <?php echo date("h:i:sa", strtotime($enddate[$temp + 5])); ?>
                            <?php } ?>
                            </td>
                            <td>
                                <?php if($enddate[$temp + 6] == 'no work'){ ?>
                                <h4><span class="label label-warning">no work</span></h4>
                             <?php  }else{ ?>
                                <?php echo date("h:i:sa", strtotime($data[$temp + 6])); ?> - <br>
                                <?php echo date("h:i:sa", strtotime($enddate[$temp + 6])); ?>
                            <?php } ?>
                            </td>
                    
                            <td><a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="detail-message" id="<?php echo $row->user_id;?>"><span class="glyphicon glyphicon-search"></span></a></td>
                </tr>
            <?php $temp += 7;} ?>

                   </tbody>
            </table>


            <?php } else{ ?>

             <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
        
                <th>Image</th>
                <th>Name</th>
                <th>Position</th>
                <th>Department</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
            <th>Sunday</th>
                        
            <th style="width:125px;">Action</th>
                            
          </thead>

           <tbody id="message-tbody">
       
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
           
               </tbody>
    </table>


<?php } ?>
    



<script type="text/javascript">

var save_method; //for save method string
var table;

   $(document).ready(function () {

       //datatables
    table = $('#table_list').DataTable({
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('shift/empsched_list')?>",
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


function add_shift(id)
{
   
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('shift/add_shift')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
         
            $('[name="id"]').val(data.id);
            $('[name="sub_id"]').val(id);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Add shift'); // Set title to Bootstrap modal title
 
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
      diff = Math.floor((date2.getTime() - date1.getTime()) / 86400000); 
    }
    $('#calculated').val(diff);
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
        url = "<?php echo site_url('shift/save_shift')?>";
      
    } else {
        url = "<?php echo site_url('shift/update_shift')?>";
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

function delete_shift(id)
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



                </div>

<!--                                                 Leave Request                                         -->
<!--                                                 Leave Request                                         -->
<!--                                                 Leave Request                                         -->
<!--                                                 Leave Request                                         -->
<!--                                                 Leave Request                                         -->
<!--                                                 Leave Request                                         -->
<!--                                                 Leave Request                                         -->
<!--                                                 Leave Request                                         -->
<!--                                                 Leave Request                                         -->
<!--                                                 Leave Request                                         -->
<!--                                                 Leave Request                                         -->
<!--                                                 Leave Request                                         -->
                       
                <div class="tab-pane fade" id="tab2default">


        <h3>My Shift Requests</h3>
        <br />
   
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table_rqst" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Reason</th>
                                <th>Sub. Name</th>
                                <th>Sub. Dept</th>
                                <th>Sub. Position</th>
                                <th>Monday</th>
                                <th>Tuesday</th>
                                <th>Wednesday</th>
                                <th>Thursday</th>
                                <th>Friday</th>
                                <th>Saturday</th>
                                <th>Sunday</th>


                                <th style="width:125px;">Action</th>
                            </tr>
                        </thead>
                       
                    </table>


<script type="text/javascript">

var save_method; //for save method string
var table;

   $(document).ready(function () {

       //datatables
    table = $('#table_rqst').DataTable({
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('shift/shift_list')?>",
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
                <h3 class="modal-title">Add Shift Request</h3>
               
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
                         

                         <div class="form-group">
                            <label class="control-label col-md-3">Duration</label>
                            <div class="col-md-5">
                                <input name="duration" id="calculated" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>

                  
                       
                    
                        <div class="form-group">
                            <label class="control-label col-md-3">Reason</label>
                            <div class="col-md-5">
                                <textarea name="reason" placeholder="Cause" class="form-control"></textarea>
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
 
