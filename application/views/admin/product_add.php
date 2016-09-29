<link rel="stylesheet" href="<?php echo  base_url('assets/plugin/ValidationEngine/style/validationEngine.jquery.css')?>">
<script src="<?php echo  base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine-en.js')?>" charset="utf-8"></script>
<script src="<?php echo  base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine.js')?>"></script>

<link rel="stylesheet" href="<?php echo  base_url('assets/plugin/colorpicker/bootstrap-colorpicker.min.css')?>">

<script src="<?php echo  base_url('assets/plugin/colorpicker/jquery.minicolors.min.js')?>"></script>
<link rel="stylesheet" href="<?php echo  base_url('assets/plugin/colorpicker/jquery.minicolors.css')?>">
<script>


    $(document).ready( function() {
        $(".validate").validationEngine();


        $('.color_picker').each( function() {

            $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                defaultValue: $(this).attr('data-defaultValue') || '',
                inline: $(this).attr('data-inline') === 'true',
                letterCase: $(this).attr('data-letterCase') || 'lowercase',
                opacity: $(this).attr('data-opacity'),
                position: $(this).attr('data-position') || 'bottom left',
                change: function(hex, opacity) {
                    if( !hex ) return;
                    if( opacity ) hex += ', ' + opacity;
                    if( typeof console === 'object' ) {
                        console.log(hex);
                    }
                },
                theme: 'bootstrap'
            });

        });

    });
    function random_str()
    {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for( var i=0; i < 5; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }


</script>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?php echo  base_url('admin') ?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> <?php echo $btn_name;?> sản phẩm
                    </li>
                    <?php if (isset ($error)) { ?>
                        <li class="">
                            <span style="color: red"> <?php echo  $error; ?></span>
                        </li>
                    <?php } ?>
                </ol>
            </div>
            <style>
                li{
                    list-style: none;
                }
                .checklist_cate ul{padding: 0px; margin: 0px}
                .checklist_cate label{font-weight: normal}
            </style>
            <div class="col-sm-12">
                <div class="body collapse in" id="div1">
                    <form class="validate form-horizontal" role="form" id="form1" method="POST" action=""
                          enctype="multipart/form-data">
                        <input type="hidden" name="edit" value="<?php echo @$edit->id;?>">
                        <div class="text-right" style="padding-bottom: 15px">
                            <button type="submit" class="btn btn-success btn-xs" name="addnews"><i
                                    class="fa fa-check"></i> <?php echo $btn_name;?>
                            </button>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputEmail1" class="col-sm-3 control-label">Tên SP<span
                                        style="color: red">* </span>:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="validate[required] form-control input-sm " name="name"
                                           value="<?php echo @$edit->name;?>" placeholder=""/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail1" class="col-sm-3 control-label">Mã SP<span
                                        style="color: red">* </span>:</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm " name="code"
                                           value="<?php echo @$edit->code;?>" placeholder=""/>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="inputEmail1" class="col-sm-3 control-label">Tỉnh thành<span
                                        style="color: red">* </span>:</label>

                                <div class="col-sm-9">
                                    <select class="form-control input-sm" name="location">
<!--                                        <option value="0">-- Lựa chọn --</option>-->
                                        <?php
                                        foreach(@$tinhthanh as $t){?>
                                        <option value="<?php echo $t->provinceid;?>"
                                            <?php echo @$edit->location==$t->provinceid?'selected':''?>>
                                            <?php echo $t->name;?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Ảnh:</label>

                                <div class="col-sm-9">
                                    <input type="file" name="userfile" class=""/>
                                    <?php check_img2(@$edit->image);?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputcontent" class="col-sm-3 control-label">Giá gốc:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="price" class="validate[custom[onlyNumberSp]] form-control input-sm"
                                           value="<?php echo @$edit->price;?>" placeholder="Giá gốc"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputcontent" class="col-sm-3 control-label">Giá KM:</label>

                                <div class="col-sm-9">
                                    <input type="text" name="price_sale" class="validate[custom[onlyNumberSp]] form-control input-sm"
                                           value="<?php echo @$edit->price_sale;?>" placeholder="Giá khuyến mãi"/>
                                </div>
                            </div>
                           <!-- <div class="form-group">
                                <label for="inputEmail1" class="col-sm-3 control-label">Mô Tả:</label>

                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control input-sm" placeholder="Mô tả"
                                              rows="2"><?/*=@$edit->description;*/?></textarea>
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label for="inputEmail1" class="col-sm-3 control-label">Giảm giá:</label>

                                <div class="col-sm-9">
                                    <input name="caption_3" id="caption_3" value="<?php echo @$edit->caption_3;?>"
                                           type="text">&nbsp;(%)
                                </div>
                            </div>
                            <!---
                            <div class="form-group">
                                <label for="inputEmail1" class="col-sm-3 control-label">Màu:</label>

                                <div class="col-sm-1 ">
                                    <div class="btn btn-sm btn-default" onclick="add_corlor();"><i
                                            class="fa fa-plus"></i></div>
                                </div>
                                <div class="col-sm-4 color1" id="color_input">

                                        <?php if(@$edit->color==null || !isset($edit->color)){?>
                                            <input name="color[]" type="text" id="hue-demo" class=" form-control color_picker minicolors-input input-sm"
                                           data-control="hue" value="" size="7">
                                        <?php } else{
                                            $color=explode(',',@$edit->color);
                                                $t=1;
                                            foreach($color as $c){  $k=$t++;?>

                                                <div class="input-group" id="color_<?php echo $k;?>">
                                                    <input name="color[]" type="text" id="hue-demo" class="color_<?php echo $k;?> form-control color_picker minicolors-input input-sm"
                                                           data-control="hue" value="<?php echo $c;?>" size="7" aria-describedby="basic-addon2">
                                                    <span class="input-group-addon" id="basic-addon2" data-items="color_<?php echo $k;?>"
                                                        onclick="remove_color($(this))">
                                                        <i class="fa fa-times"></i>
                                                    </span>
                                                </div>

                                            <?php }
                                        }?>



                                </div>

                            </div>
                            <!-- <div class="form-group">
                                <label for="inputEmail1" class="col-sm-3 control-label">Size:</label>

                                <div class="col-sm-9 color1" id="color_input">
                                    <?php /*if(isset($edit->size)){
                                        $size=explode(',',$edit->size);
                                    }*/?>
                                    <label>
                                        <input type="checkbox" name="size[]" value="M" <?/*=(isset($size)&&in_array('M',@$size))?'checked':'';*/?>>
                                        M</label>&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input type="checkbox" name="size[]" value="L" <?/*=(isset($size)&&in_array('L',@$size))?'checked':'';*/?>>
                                        L</label>&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input type="checkbox" name="size[]" value="XL" <?/*=(isset($size)&&in_array('XL',@$size))?'checked':'';*/?>>
                                        XL</label>&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input type="checkbox" name="size[]" value="XXL" <?/*=(isset($size)&&in_array('XXL',@$size))?'checked':'';*/?>>
                                        XXL</label>&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input type="checkbox" name="size[]" value="XXXL" <?/*=(isset($size)&&in_array('XXXL',@$size))?'checked':'';*/?>>
                                        XXXL
                                    </label>
                                </div>


                            </div>-->

                            <div class="form-group clearfix">
                                <label for="inputcontent" class="control-label col-md-3" style="padding: 0">Link
                                    Xem Web:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="caption_1"
                                           value="<?php echo @$edit->caption_1;?>" />
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-4" >
                            <div class="">

                                <label class="col-sm-12" style="padding-left: 0px">
                                    Danh mục
                                </label>
                                <div class="col-sm-12" style="height: 200px; overflow-y: auto; border: 1px solid #ccc">

                                    <div class=" checklist_cate">
                                        <?php if(isset($cate_selected)) $cate_selected=$cate_selected;
                                                else $cate_selected=null;
                                        view_product_cate_checklist($cate,0,'',@$cate_selected)?>
                                    </div>

                                </div>
                                <div style="clear: both"></div>
                                <br>
                                <label class="col-sm-12" style="padding-left: 0px">
                                    Hiển thị
                                </label>

                                <div class="col-sm-12" style="  border: 1px solid #ccc; padding-left: 0px">
                                    <label class="col-sm-6">
                                        <input type="checkbox" value="1"
                                               name="home" <?php echo  @$edit->home == 1 ? 'checked' : '' ?>>
                                        <?php echo  _title_product_home ?>
                                    </label>

                                    <label class="col-sm-6">
                                        <input type="checkbox" value="1"
                                               name="hot" <?php echo  @$edit->hot == 1 ? 'checked' : '' ?>>
                                        <?php echo  _title_product_hot ?>
                                    </label>

                                    <label class="col-sm-6">
                                        <input type="checkbox" value="1"
                                               name="focus" <?php echo  @$edit->focus == 1 ? 'checked' : '' ?>>
                                        <?php echo  _title_product_focus ?>
                                    </label>

                                    <label class="col-sm-6">
                                        <input type="checkbox" value="1"
                                               name="coupon" <?php echo  @$edit->coupon == 1 ? 'checked' : '' ?>>
                                        <?php echo  _title_product_coupon ?>
                                    </label>
                                    <label class="col-sm-6">
                                        <input type="checkbox" value="1"
                                               name="design" <?php echo  @$edit->design == 1 ? 'checked' : '' ?>>
                                        Thiết kế
                                    </label>
                                </div>
                                <div style="clear: both"></div>
                                <!--<br>
                                <label class="col-sm-12" style="padding-left: 0px">
                                    Thông tin khác
                                </label>

                                <div class="col-sm-12" style="padding: 0px; border: none">
                                    <textarea name="caption_1" class="form-control input-sm"
                                        ><?/*=@$edit->caption_1;*/?></textarea>

                                </div>-->
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-5 " >
                                    <label for="inputcontent" class=" control-label">Tính năng nổi bật:</label>
                                    <textarea name="features" class="form-control input-sm" id="ckeditor3"
                                              style="height: 200px"><?php echo @$edit->features;?></textarea>
                                    <?php echo display_ckeditor($ckeditor3); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-1 "></div>
                                <div class="col-sm-7 " >
                                    <label for="inputcontent" class=" control-label">Mô tả:</label>
                                    <textarea name="description" class="form-control input-sm" id="ckeditor2"
                                              style="height: 200px"><?php echo @$edit->description;?></textarea>
                                    <?php echo display_ckeditor($ckeditor2); ?>
                                </div>
                            </div>

                        <div class="form-group">
                            <div class="col-sm-1 "></div>
                            <div class="col-sm-7 " >
                                <label for="inputcontent" class=" control-label">Chi tiết:</label>
                                <textarea name="detail" class="form-control input-sm" id="ckeditor"
                                          style="height: 200px"><?php echo @$edit->detail;?></textarea>
                                <?php echo display_ckeditor($ckeditor); ?>
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="inputEmail1" class="col-sm-2 control-label">Title Seo:</label>

                                <div class="col-sm-7">
                                    <input type="text" name="title_seo" placeholder="Title Seo"
                                           value="<?php echo @$edit->title_seo;?>" class="form-control input-sm"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail1" class="col-sm-2 control-label">Key word:</label>

                                <div class="col-sm-7">
                                    <input type="text" name="keyword" placeholder="Keyword SEO"
                                           value="<?php echo @$edit->keyword;?>" class="form-control input-sm"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail1" class="col-sm-2 control-label">Description SEO:</label>

                                <div class="col-sm-7">
                                    <textarea  name="description_seo" placeholder="Description SEO"
                                               class="form-control input-sm"><?php echo @$edit->description_seo;?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="text-center" style="padding-bottom: 15px">
                            <button type="submit" class="btn btn-success btn-xs" name="addnews"><i
                                    class="fa fa-check"></i> <?php echo $btn_name;?>
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