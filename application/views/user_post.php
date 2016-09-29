
<script type="text/javascript" src="<?php echo  base_url('assets/plugin/autonumber/autoNumeric.js') ?>"></script>
<script type="text/javascript" src="<?php echo  base_url('assets/plugin/autonumber/jquery.number.js') ?>"></script>

<section class="container">
    <div class="fix-list"></div>
    <div class="menu-detail" style="margin-top: 50px;">
        <section class="cate-danh-muc">
            <a href="#">
                <p>Đăng tin</p>
            </a>
        </section>
    </div><!---menu-detail--->
    <div class="clearfix"></div>

    <section class="col-xs-12">
        <div class="row">
            <section class="col-md-3  col-sm-12 col-xs-12 hidden-xs">
                <div class="row">
                    <section class="sidebar">
                        <section class="sidebar_title">CÓ THỂ BẠN QUAN TÂM</section>
                        <ul style="background: #ffffff">
                            <li>
                                <a href="<?php echo  base_url() ?>">
                                    <i class="fa fa-home"></i>
                                    Trang chủ
                                </a>
                            </li>
                            <?php if (isset($menu_right)) {
                                foreach ($menu_right as $n) {
                                    ?>
                                    <li>
                                        <a href="<?php echo  base_url(@$n->url); ?>">
                                            <i class="sidebar_icon ">
                                                <img src=" <?php echo  base_url( @$n->icon) ; ?>" />
                                            </i>
                                            <?php echo  $n->name; ?>
                                        </a>
                                    </li>
                                <?php
                                }
                            } ?>
                        </ul>
                    </section>
                </div><!--end row-->
            </section>
            <!---End .sidebar_box_1--->
            <section class="col-md-9 col-sm-12 col-xs-12 form_post" >
            <div id="loginbox" style="padding-top: 10px">
            <form   class="validate form-horizontal"   method="post" action="" role="form" enctype="multipart/form-data" >
                <input name="edit" type="hidden" value="<?php echo @$edit->id;?>"/>
                <div class="panel panel-default" >
                <div class="panel-heading">
                    <div class="panel-title">Thông tin bài đăng</div>
                </div>
                <div style="padding-top:30px" class="panel-body" >


                    <div class="form-group">
                        <label for="password" style="text-align:left !important; "
                               class="col-md-2 control-label ">Danh mục</label>
                        <div class="col-md-4">
                            <select   class=" input-sm  form-control" name="loai_giaodich">
                                <option value="0">--Chọn danh mục--</option>
                                <?php view_product_cate_select($cate,0,'',@$edit->loai_giaodich);?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tieude"  style="text-align:left !important; "
                               class="col-md-2 control-label">Tiêu đề</label>
                        <div class="col-md-10">
                            <input type="text" class="validate[required] input-sm   input-sm  form-control"
                                   value="<?php echo @$edit->tieude;?>"
                                   name="tieude" placeholder="Tiêu đề">
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="tieude"  style="text-align:left !important; "
                               class="col-md-2 control-label">Giá bán</label>
                        <div class="col-md-4">
                            <input id="price" type="text" class="validate[required] input-sm   input-sm  form-control"
                                   value="<?php echo @$edit->gia_m;?>"
                                   data-v-max="9999999999999" data-v-min="0" name="gia_m">
                        </div>

                        <label for="tinhthanh" style="text-align:left !important; "
                               class="col-md-2 control-label ">Phạm vi bán</label>
                        <div class="col-md-4">
                            <select    class=" input-sm  form-control" name="tinh_thanh">
                                <option value="0">--Chọn Tỉnh/Thành--</option>
                                <?php
                                foreach(@$province as $t){?>
                                    <option value="<?php echo $t->provinceid;?>"
                                        <?php echo @$edit->tinh_thanh==$t->provinceid?'selected':''?>>
                                        <?php echo $t->name;?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label  style="text-align:left !important; "
                                class=" col-md-2 control-label  ">Hình ảnh</label>
                        <div class="col-md-9">
                            <input type="file"   name="userfile"  >
                            <br>
                            <?php
                            if(isset($edit->anh)&&file_exists($edit->anh)){?>
                                <img src="<?php echo base_url($edit->anh)?>" alt="" style="max-width: 100px; max-height: 50px"/>
                            <?php }
                            ?>

                        </div>
                    </div>

                    <div class="form-group">
                        <label  style="text-align:left !important; "
                                class=" col-md-2 control-label  ">Thêm hình ảnh</label>
                        <div class="col-md-9">
                            <input type="file"   name="file_more[]" multiple  >


                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea name="noidung" class="   input-sm  form-control input-sm" id="ckeditor"
                                      style="height: 200px"><?php echo @$edit->noidung;?></textarea>
                            <?php echo display_ckeditor($ckeditor); ?>
                        </div>
                    </div>



                </div>
            </div><!-- .panel panel-default-->




            <div class="form-group">
                <!-- Button -->
                <div class="  col-md-12 controls">
                    <button id="btn-login" type="submit" name="add_pro"  class="btn btn-primary"><?php echo $title;?></button>
                    <button id="btn-fblogin"  type="reset" class="btn btn-default">Hủy</button>
                </div>
            </div>
            </form>
            </div><!-- .loginbox-->
            </section>
            <!---End Left------->
        </div><!--end row-->
    </section>
</section>

<script>
    $('#price,#dientich').autoNumeric();

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>







