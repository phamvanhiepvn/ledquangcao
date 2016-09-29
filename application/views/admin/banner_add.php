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
                        <i class="fa fa-table"></i> Thêm Media
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
                            <label for="inputEmail1" class="col-lg-2 control-label">Tiêu đề:</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="title" placeholder="Tiêu đề..."  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Loại:</label>
                            <div class="col-lg-5">
                                <select name="type" class="form-control">
                                    <option value="">Mặc định</option>
                                    <option value="slider">Slider</option>
                                    <option value="logo">Logo</option>
                                    <option value="banner">Banner</option>
                                    <option value="bannerslider">Banner Slider</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Url:</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="url" placeholder="..."  />
                            </div>
                        </div>
                        <div class="form-group">
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
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Ảnh:</label>
                            <div class="col-lg-3">
                                <input type="file" name="userfile" class="form-control"  />
                            </div>
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