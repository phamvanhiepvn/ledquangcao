<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo  base_url('admin')?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Thêm skill
                    </li>
                    <?php if(isset ($error)){?>
                        <li class="">
                            <span style="color: red"> <?php echo  $error;?></span>
                        </li>
                    <?php }?>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="body collapse in" id="div1">
                    <form class="form-horizontal" role="form" id="form1" method="POST" action="" enctype="multipart/form-data" >

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Tên skill <span style="color:
                            red">* </span>:</label>
                            <div class="col-lg-5">
                                <input name="Id_Edit" type="hidden" value="<?php echo @$item->id?>">
                                <input type="text" class="form-control " name="name" placeholder="Tên skill" value="<?php echo @$item->name;?>"  />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-2 control-label">Giá trị :</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="value" placeholder="Giá trị skill"
                                       value="<?php echo @$item->value;?>"  />
                            </div>
                        </div>

                        <div class="text-center" style="padding-bottom: 15px">
                            <button type="submit" class="btn btn-success btn-sm" name="addpage"><i class="fa fa-check"></i> Thêm</button>
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