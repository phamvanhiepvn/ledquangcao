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
                        <i class="fa fa-table"></i> Cập nhật khách hàng
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
                            <input type="hidden" name="id_edit" value="<?php echo @$id_edit;?>" />
                            <label for="inputEmail1" class="col-lg-3 control-label">Tên miền:</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="title" placeholder="Tiêu đề..."
                                       value="<?php echo @$edit->title;?>"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-3 control-label">Tên công ty (Cá nhân):</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="name" placeholder="..."
                                    value="<?php echo @$edit->name;?>" />
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Target:</label>
                            <div class="col-lg-5">
                                <label  class="col-lg-3  ">
                                    <input type="radio"  name="taget" value=""  checked=""/>
                                    Mặc định</label>

                                <label   class="col-lg-3  ">
                                    <input type="radio"  name="taget" value="_blank"  />
                                    Tab mới
                                </label>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label  class="col-lg-3 control-label">Ảnh:</label>
                            <div class="col-lg-3">
                                <input type="file" name="userfile" class="form-control"  />
                            </div>
                            <?php if(!empty($edit->image)) : ?>
                                <img src="<?php echo base_url($edit->image)?>" width="60" height="60">
                            <?php endif;?>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm" name="upload"><i class="fa fa-check"></i> Thêm</button>
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