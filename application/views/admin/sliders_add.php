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
                        <i class="fa fa-table"></i> Thêm Sliders
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
                            <label for="inputEmail1" class="col-lg-2 control-label">Loại:</label>
                            <div class="col-lg-5">
                                <select name="type" class="form-control slType">
                                    <option value="image">Mặc định</option>
                                    <option value="image">Ảnh</option>
                                    <option value="video">Video</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Url:</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="url" placeholder="..."  />
                            </div>
                        </div>
                        <div class="form-group form-group-images">
                            <label  class="col-lg-2 control-label">Ảnh:</label>
                            <div class="col-lg-3">
                                <input type="file" name="userfile" class="form-control"  />
                            </div>
                        </div>
                        <div class="form-group form-group-video">
                            <label  class="col-lg-2 control-label">Video:</label>
                            <div class="col-lg-5">
                                <input type="text" name="video" class="form-control"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Icon 1:</label>
                            <div class="col-lg-5">
                                <input type="text" name="icon1" class="form-control"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Text 1:</label>
                            <div class="col-lg-5">
                                <input type="text" name="text1" class="form-control"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Icon 2:</label>
                            <div class="col-lg-5">
                                <input type="text" name="icon2" class="form-control"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Text 2:</label>
                            <div class="col-lg-5">
                                <input type="text" name="text2" class="form-control"  />
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Icon 3:</label>
                            <div class="col-lg-5">
                                <input type="text" name="icon3" class="form-control"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Text 3:</label>
                            <div class="col-lg-5">
                                <input type="text" name="text3" class="form-control"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Icon 4:</label>
                            <div class="col-lg-5">
                                <input type="text" name="icon4" class="form-control"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Text 4:</label>
                            <div class="col-lg-5">
                                <input type="text" name="text4" class="form-control"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Icon 5:</label>
                            <div class="col-lg-5">
                                <input type="text" name="icon5" class="form-control"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Text 5:</label>
                            <div class="col-lg-5">
                                <input type="text" name="text5" class="form-control"  />
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
<script type="text/javascript">
$(".slType").change(function(){
    $(".form-group-video .form-control, .form-group-images .form-control").val("");
   if($(this).val()=="video"){
        $(".form-group-video").css("display","block");
        $(".form-group-images").css("display","none");
   }else{
       $(".form-group-images").css("display","block");
       $(".form-group-video").css("display","none");
   }
});
</script>