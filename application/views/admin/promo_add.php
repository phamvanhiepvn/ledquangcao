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
                        <i class="fa fa-table"></i> Thêm tin tức
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
                        <div class="text-right" style="padding-bottom: 15px">
                            <button type="submit" class="btn btn-success btn-sm" name="addpage"><i class="fa fa-check"></i> Thêm</button>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Tên khuyến mại <span style="color:
                            red">* </span>:</label>
                            <div class="col-lg-5">
                                <input name="Id_Edit" type="hidden" value="<?php echo @$item->id?>">
                                <input type="text" class="form-control " name="name" placeholder="Tên khuyến mại"
                                       value="<?php echo @$item->name;?>"  />
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <?php if (@$item->image != null) { ?>
                                    <div class="col-md-3 text-right">
                                        <label class="control-label">Ảnh:</label>
                                        <img src="<?php echo  base_url(@$item->image) ?>"
                                             style="width: 100px; max-height: 100px"/>
                                    </div>
                                <?php } ?>
                                <label class="col-lg-2 control-label">Thay đổi ảnh:</label>

                                <div class="col-lg-3">
                                    <input type="file" name="userfile" class="form-control" style="font-size: 12px"/>
                                </div>
                            </div>
                        </div>
                       <!-- <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Mô Tả:</label>
                            <div class="col-lg-5">
                                <textarea name="description" class="form-control" placeholder="Mô tả" rows="4" ></textarea>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-2 control-label">Nội dung:</label>
                            <div class="col-lg-7">
                                <textarea name="content" class="form-control" id="ckeditor"
                                    ><?php echo @$item->content;?></textarea>
                                <?php echo display_ckeditor($ckeditor); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-2 control-label">Hoạt động :</label>

                            <div class="col-lg-7">
                                <label class="radio-inline">
                                    <input type="radio" name="status" id="inlineRadio1" value="1"
                                        <?php if(!isset($item)) echo 'checked'; else?>
                                        <?php echo @$item->status==1?'checked':''?>
                                        > Có
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" id="inlineRadio2" value="0"
                                        <?php if(isset($item) &&@$item->status==0) echo 'checked'; else?>
                                        > Không
                                </label>
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