<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Time Sheet Table</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Manage Time Sheet
            </div>

            <!-- /.panel-heading -->
            <form action="" method="post" enctype="multipart/form-data" id="empform" role="form" name="empform">
                <?php if(!empty($disMsg) || !empty($_SESSION['disMsg'])) { ?>
                <div class="panel-body">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $_SESSION['disMsg']; $_SESSION['disMsg'] =''; ?>    
                    </div> 
                </div>
                <?php } ?>

                <div class="panel-body">
                    <div class="row">
                    	<div class="col-lg-5">
                            <?php if($_SESSION['userLevel'] == 1) { ?>
                            <div class="col-lg-4" style="padding-left:0;">
                                <button type="submit" name="addnew" class="btn btn-lg btn-primary btn-block">Save</button>
                            </div>
                            <?php } ?>
                    	</div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </form>
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
