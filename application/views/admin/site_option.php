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
                        <i class="fa fa-table"></i> Cấu hình
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
                    <form class="form-horizontal" role="form" id="form1" method="POST" action="<?php echo  base_url('admin/admin/site_option')?>"
                          enctype="multipart/form-data">

                        <input name="Id_Edit" type="hidden" value="<?php echo @$item->id?>">

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Tên website<span
                                    style="color: red">* </span>:</label>

                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="site_name" placeholder=""
                                       value="<?php echo  @$item->site_name ?>"/>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Tên công ty/đơn vị</label>

                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="company_name" placeholder=""
                                       value="<?php echo  @$item->company_name ?>"/>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="row">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-2 control-label">Site URL</label>

                            <div class="col-lg-5">
                                <input type="text" name="site_url" class="form-control" value="<?php echo  @$item->site_url; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-2 control-label">Hotline 1</label>

                            <div class="col-lg-5">
                                <input type="text" name="hotline1" class="form-control" value="<?php echo  @$item->hotline1; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-2 control-label">Hotline 2</label>

                            <div class="col-lg-5">
                                <input type="text" name="hotline2" class="form-control" value="<?php echo  @$item->hotline2; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-2 control-label">Address 1</label>

                            <div class="col-lg-5">
                                <input type="text" name="address1" class="form-control" value="<?php echo  @$item->address1; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-2 control-label">Address 2</label>

                            <div class="col-lg-5">
                                <input type="text" name="address2" class="form-control" value="<?php echo  @$item->address2; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-2 control-label">Lat Long</label>

                            <div class="col-lg-5">
                                <input type="text" name="latlong" class="form-control" value="<?php echo  @$item->latlong; ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-2 control-label">Từ khóa</label>

                            <div class="col-lg-5">
                                <input type="text" name="site_keyword" class="form-control" value="<?php echo  @$item->site_keyword ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Chữ trang chủ:</label>

                            <div class="col-lg-5">
                                <div class="col-lg-5">
                                    <textarea name="shipping" class="form-control" id="ckeditor1" ><?= @$item->shipping;?></textarea>
                                    <?php echo display_ckeditor($ckeditor1); ?>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Mô Tả:</label>

                            <div class="col-lg-5">
                                <textarea name="site_description" class="form-control" placeholder="Mô tả"
                                          rows="4"><?php echo  @$item->site_description ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Top từ khóa:</label>

                            <div class="col-lg-5">
                                <textarea name="topkeyword" class="form-control" id="ckeditor2" ><?= @$item->topkeyword;?></textarea>
                                <?php echo display_ckeditor($ckeditor2); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Link fanpage:</label>

                            <div class="col-lg-5">
                                <input name="link_fanpage" class="form-control" placeholder="Link fanpage" value="<?php echo  @$item->link_fanpage ?>" />

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Facebook:</label>
                            <div class="col-lg-5">
                                <input name="facebook" class="form-control"  value="<?php echo  @$item->facebook ?>" />

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Twitter:</label>
                            <div class="col-lg-5">
                                <input name="twiter" class="form-control"  value="<?php echo  @$item->twiter ?>" />

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Google Plus:</label>
                            <div class="col-lg-5">
                                <input name="google_plus" class="form-control"  value="<?php echo  @$item->google_plus ?>" />

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">linked:</label>
                            <div class="col-lg-5">
                                <input name="linked" class="form-control"  value="<?php echo  @$item->linked ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">tumbr:</label>
                            <div class="col-lg-5">
                                <input name="tumbr" class="form-control"  value="<?php echo  @$item->tumbr ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Text copyright:</label>
                            <div class="col-lg-5">
                                <textarea name="text_copyright" class="form-control"><?php echo  @$item->text_copyright; ?></textarea>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Mail contact:</label>
                            <div class="col-lg-5">
                                <input name="mail_contact" class="form-control"  value="<?php echo  @$item->mail_contact; ?>" />
                            </div>
                        </div>


                        <div class="clear"></div>
                        <div class="text-center" style="padding-bottom: 15px">
                            <button type="submit" class="btn btn-success btn-sm" name="Update"><i
                                    class="fa fa-check"></i> Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>