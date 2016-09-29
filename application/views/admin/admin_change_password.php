<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Đổi mật khẩu
                    </li>
                    <?php if(isset ($mss)){?>
                        <li class="">
                            <?php echo  $mss;?>
                        </li>
                    <?php }?>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="clear"></div>

                <div class="body collapse in" id="div1">
                    <form class="form-horizontal" role="form" id="form1" method="POST" action="" enctype="multipart/form-data" >

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Mật khẩu cũ:</label>
                            <div class="col-lg-5">
                                <input type="password" class="form-control " name="old_pass"    />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Mật khẩu mới:</label>
                            <div class="col-lg-5">
                                <input type="password" class="form-control " name="new_pass"    />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Xác nhận mật khẩu mới:</label>
                            <div class="col-lg-5">
                                <input type="password" class="form-control " name="re_pass"    />
                            </div>
                        </div>



                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm" name="submit" onclick="$('#form1').submit();"><i class="fa fa-check"></i> Hoàn thành</button>
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