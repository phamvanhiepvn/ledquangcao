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
                        <i class="fa fa-table"></i> Change support online
                    </li>
                    <?php if (isset ($error)) { ?>
                        <li class="">
                            <span style="color: red"> <?php echo  $error; ?></span>
                        </li>
                    <?php } ?>
                </ol>
            </div>
            <div class="col-lg-8">
                <div class="body collapse in" id="div1">
                    <form class="form-horizontal" role="form" id="form1" method="POST" action=""
                          enctype="multipart/form-data">

                        <input name="Id_Edit" type="hidden" value="<?php echo @$item->id?>">

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-4 control-label">Họ tên:</label>

                            <div class="col-lg-8">
                                <input type="text" class="form-control input-sm " name="name" placeholder=""
                                       value="<?php echo  @$item->name ?>"/>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-4 control-label">Điện thoại</label>

                            <div class="col-lg-8">
                                <input type="text" class="form-control input-sm " name="phone" placeholder=""
                                       value="<?php echo  @$item->phone ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-4 control-label">Email</label>

                            <div class="col-lg-8">
                                <input type="text" class="form-control input-sm " name="email" placeholder=""
                                       value="<?php echo  @$item->email ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-4 control-label">Skype</label>

                            <div class="col-lg-8">
                                <input type="text" name="skype" class="form-control input-sm" value="<?php echo  @$item->skype ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-4 control-label">Facebook</label>

                            <div class="col-lg-8">
                                <input type="text" name="yahoo" class="form-control input-sm" value="<?php echo  @$item->yahoo ?>"/>
                            </div>
                        </div>
                        <div class="form-group  ">
                            <?php if (@$item->image != null) { ?>
                                <label class="col-lg-4 control-label">Thay đổi ảnh:</label>

                                <div class="col-lg-5">
                                    <input type="file" name="userfile" class="form-control input-sm" style="font-size: 12px"/>
                                </div>
                                <div class="col-md-3 text-right">
                                    <img src="<?php echo  base_url(@$item->image) ?>"
                                         style="width: 70px; max-height: 60px"/>
                                </div>

                            <?php }else{?>
                                <label class="col-lg-4 control-label">Ảnh:</label>

                                <div class="col-lg-5">
                                    <input type="file" name="userfile" class="form-control input-sm"   style="font-size: 12px"/>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-4 control-label">Hoạt động</label>

                            <div class="col-lg-8">
                                <label class="radio-inline">
                                    <input type="radio" name="active" id="inlineRadio1" value="1"
                                        <?php if(!isset($item)) echo 'checked'; else?>
                                        <?php echo @$item->active==1?'checked':''?>
                                        > Có
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="active" id="inlineRadio2" value="0"
                                        <?php if(isset($item) &&@$item->active==0) echo 'checked'; else?>
                                        > Không
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-4 control-label">Nhân viên</label>

                            <div class="col-lg-8">
                                <label class="radio-inline">
                                    <input type="radio" name="type" id="inlineRadio3" value="1"
                                        <?php if(!isset($item)) echo 'checked'; else?>
                                        <?php echo @$item->type==1?'checked':''?>
                                        > Kỹ thuật
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" id="inlineRadio4" value="0"
                                        <?php if(isset($item) &&@$item->type==0) echo 'checked'; else?>
                                        > Kinh doanh
                                </label>
                            </div>
                        </div>

                        <div class="clear"></div>
                        <div class="text-center" style="padding-bottom: 15px">
                            <button type="submit" class="btn btn-success btn-xs" name="Update"><i
                                    class="fa fa-check"></i> Cập nhật
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>

