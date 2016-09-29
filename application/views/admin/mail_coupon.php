<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?php echo  base_url('admin') ?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Gửi mail khuyến mãi
                    </li>
                    <?php if (isset ($error)) { ?>
                        <li class="">
                            <span style="color: red"> <?php echo  $error; ?></span>
                        </li>
                    <?php } ?>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="body collapse in" id="div1">


                    <form class="form-horizontal" role="form" id="form1" method="POST" action=""
                          enctype="multipart/form-data">

                        <input type="submit" name="send" class="btn btn-xs btn-default" value="Gửi mail">

                        <!--<div class="text-right" style="padding-bottom: 15px">
                            <button type="submit" class="btn btn-primary btn-xs" name="send">
                                <i class="fa fa-check"></i> Gửi mail
                            </button>
                        </div>-->
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Tiêu Đề <span
                                    style="color: red">* </span>:</label>

                            <div class="col-lg-8">
                                <input type="text" class="form-control " name="subject" placeholder="Tiêu đề"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Người nhận:</label>

                            <div class="col-lg-8">
                                <input type="text" class="form-control " name="" style="font-size: 11px"
                                       value="<?php echo @$_SESSION['email']?>" placeholder="Tiêu đề"/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-2 control-label">Nội dung:</label>

                            <div class="col-lg-7">
                                <textarea name="content" class="form-control" id="ckeditor"></textarea>
                                <?php echo display_ckeditor($ckeditor); ?>
                            </div>
                        </div>

                        <div class="text-center" style="padding-bottom: 15px">
                            <button type="submit" class="btn btn-primary btn-xs" name="send"><i
                                    class="fa fa-check"></i> Gửi mail
                            </button>
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