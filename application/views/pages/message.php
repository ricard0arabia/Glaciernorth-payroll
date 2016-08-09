
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

  #load { height: 100%; width: 100%; }
  #load {
    position    : fixed;
    z-index     : 99999; /* or higher if necessary */
    top         : 0;
    left        : 0;
    overflow    : hidden;
    text-indent : 100%;
    font-size   : 0;
    opacity     : 0.6;
    background  : #E0E0E0  url(<?php echo base_url('assets/images/load.gif');?>) center no-repeat;
  }
  
  .RbtnMargin { margin-left: 5px; }
  
 
  </style>

<div id="load">Please wait ...</div>
<audio id="notif_audio"><source src="<?php echo base_url('sounds/notify.ogg');?>" type="audio/ogg"><source src="<?php echo base_url('sounds/notify.mp3');?>" type="audio/mpeg"><source src="<?php echo base_url('sounds/notify.wav');?>" type="audio/wav"></audio>
 
<div class="container">
        
 
            <div class="panel with-nav-tabs panel-info">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1default" data-toggle="tab">Messages</a></li>
                            <li><a href="#tab2default"  data-toggle="tab">Send Message</a></li>
                         
                           
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">


<!--                                     Send message                                -->

                        <div class="tab-pane fade in active" id="tab1default">



<div id="new-message-notif"></div>
  <div class="row">
     <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Time</th>
            <th>Read</th>
          </thead>
       
          <tbody id="message-tbody">
               
    <?php
              
       if($message->num_rows() > 0){
            
          foreach($message->result() as $row){
              
    ?>
              
          <tr>
            <td><?php echo $row->name;?></td>
            <td><?php echo $row->email;?></td>
            <td><?php echo $row->subject;?></td>
            <td><?php echo $row->created_at;?></td>
            <td><a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="detail-message" id="<?php echo $row->id;?>"><span class="glyphicon glyphicon-search"></span></a></td>
          </tr>
    <?php
          
          }
              
              
       } else {
              
    ?>
              
              <tr id="no-message-notif">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              
    <?php
       }
    ?>
        
           </tbody>
    </table>

    </div>

  </div>

    </div>

<!--                                                 employee Request                -->

                <div class="tab-pane fade" id="tab2default">


                   <h3>Employee List</h3>
        <br />
        
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
                                <th>Action</th>
                            </tr>
                        </thead>
                       
                    </table>





                  </div>
            </div><!-- tab content-->
        </div> <!--panel body-->           
     </div><!-- panel default -->
   </div>   <!-- container -->      


  <script>
  $(document).ready(function(){
    $("#load").hide();
    if(<?php echo $this->db->where('read_status',0)->count_all_results('message'); ?> == 0){

      $( "#new_count_message" ).hide();
    } 

       //datatables
    table = $('#table').DataTable({
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('message/ajax_list')?>",
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


     $(document).on("click",".detail-message",function() {

     
      $( "#load" ).show();
       var dataString = { 
              id : $(this).attr('id')
            };
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('message/detail');?>",
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){
              $( "#load" ).hide();
              if(data.success == true){
                $("#show_name").html(data.name);
                $("#show_email").html(data.email);
                $("#show_subject").html(data.subject);
                $("#show_message").html(data.message);
                var socket = io.connect( 'http://'+window.location.hostname+':3000' );
                
                socket.emit('update_count_message', { 
                  update_count_message: data.update_count_message

                });
              } 
            if(data.update_count_message == 0){
              $( "#new_count_message" ).hide();
            }
            } ,error: function(xhr, status, error) {
              alert(error);
            },
        });

    });

  });
  var socket = io.connect( 'http://'+window.location.hostname+':3000' );
  socket.on( 'new_count_message', function( data ) {
   
     $( "#new_count_message" ).show();
      $( "#new_count_message" ).html( data.new_count_message );
      $('#notif_audio')[0].play();
    
  });
  socket.on( 'update_count_message', function( data ) {
    
      $( "#new_count_message" ).html( data.update_count_message );
    
  });
  socket.on( 'new_message', function( data ) {
     //if(data.recipient_id == <?php echo $this->session->userdata('username'); ?>){
  
      $( "#message-tbody" ).prepend('<tr><td>'+data.name+'</td><td>'+data.email+'</td><td>'+data.subject+'</td><td>'+data.created_at+'</td><td><a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="detail-message" id="'+data.id+'"><span class="glyphicon glyphicon-search"></span></a></td></tr>');
      $( "#no-message-notif" ).html('');
      $( "#new-message-notif" ).html('<div class="alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>New message ...</div>');
    
  });




var id;
var table;

function send_message(id)
{
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('message/get_id')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="recipient_id"]').val(data.user_id);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Leave'); // Set title to Bootstrap modal title
 
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
  

    // ajax adding data to database
    $.ajax({
        url : "<?php echo site_url('message/send_message')?>",
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
              
              $("#notif").html(data.notif);
            
                var socket = io.connect( 'http://'+window.location.hostname+':3000' );
               alert('message recipient id '+ data.recipient_id);
               alert('message email id '+ data.email);
               alert('message subject id '+ data.subject);
                socket.emit('new_count_message', { 
      
                  new_count_message: data.new_count_message
         
                 
                });

                socket.emit('new_message', { 
                  name: data.name,
                  email: data.email,
                  subject: data.subject,
                  created_at: data.created_at,
                  recipient_id: data.recipient_id,
                  id: data.id
                });
                $('#modal_form').modal('hide');
                

            }
            else
            {
              alert();
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

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}

 </script>


        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">✕</button>
                      <h4>Detail Message</h4>
                  </div>
                  
                  <div class="modal-body" style="text-align:center;">
                    <div class="row-fluid">
                     <div class="span10 offset1">
                       <div id="modalTab">
                         <div class="tab-content">
                           <div class="tab-pane active" id="about">

                            <center>
                             <p class="text-left">
                              <b>Name</b> : <span id="show_name"></span><br />
                              <b>Email</b> : <span id="show_email"></span><br />
                              <b>Subject</b> : <span id="show_subject"></span><br />
                              <b>Message</b> : <span id="show_message"></span><br />
                             </p>
                             <br>
                           </center>
                  
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    
 <!-- /.modal --><!-- /.modal --><!-- /.modal --><!-- /.modal --><!-- /.modal --><!-- /.modal -->

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
                            <label class="control-label col-md-3">Recipient Id</label>
                            <div class="col-md-5">
                                <input name="recipient_id" placeholder="Recipient Id" class="form-control" readonly></input>
                                <span class="help-block"></span>
                            </div>
                        </div>               
                         
                    
                        <div class="form-group">
                            <label class="control-label col-md-3">Name</label>
                            <div class="col-md-5">
                                <input name="name" placeholder="Name" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-5">
                                <input name="email" placeholder="Email" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Subject</label>
                            <div class="col-md-5">
                                <input name="subject" placeholder="Subject" class="form-control"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Message</label>
                            <div class="col-md-5">
                                <textarea name="message" placeholder="Message" class="form-control"></textarea>
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
 

