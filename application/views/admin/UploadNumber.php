<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo  base_url()?>">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Import file Excel
                    </li>
                    <?php if(isset ($err)){?>
                        <li class="">
                            <span style="color: red"> <?php echo  $err;?></span>
                        </li>
                    <?php }?>
                </ol>
            </div>
            <div class="col-md-12">

                <div class="body collapse in" id="div1">
                    <form class="form-horizontal" role="form" id="form1" method="POST" action="" enctype="multipart/form-data" >

                        <div class="form-group">
                            <label  class="col-lg-2 control-label">File Excel:</label>
                            <div class="col-lg-3">
                                <input type="file" name="userfile" class="form-control input-sm"/>
                            </div>
                            <div class="col-gl-3">
                                <button type="submit" class="btn btn-success btn-sm" name="Upload"><i class="fa fa-check"></i> Import</button>
                            </div>
                        </div>

                        <div class="text-center">

                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>