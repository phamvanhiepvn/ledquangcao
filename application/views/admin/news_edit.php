<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?php echo  base_url('admin')?>">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Sửa tin tức
                    </li>
                    <?php if (isset ($error)) { ?>
                        <li class="">
                            <?php echo  $error; ?>
                        </li>
                    <?php } ?>
                </ol>
            </div>
            <div class="col-md-12">

                <div class="body collapse in" id="div1">
                    <form class="form-horizontal" role="form" id="form1" method="POST" action=""
                          enctype="multipart/form-data">
                        <div class="text-right" style="padding-bottom: 15px">
                            <button type="submit" class="btn btn-success btn-sm" name="editnews"><i class="fa fa-check"></i> Lưu</button>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Tiêu Đề <span
                                    style="color: red">* </span>:</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="title" placeholder="Tiêu đề"
                                       value="<?php echo  @$news->title; ?>"/>
                            </div>
                            <div class="col-md-5">
                                <!--<label>
                                    <input type="checkbox" value="1" name="home" <?php /*if(@$news->home==1) echo 'checked';*/?>> Trang chủ
                                </label>
                                &nbsp;&nbsp;&nbsp;
                                <label>
                                    <input type="checkbox" value="1" name="hot" <?php /*if(@$news->hot==1) echo 'checked';*/?>> Hot
                                </label>
                                &nbsp;&nbsp;&nbsp;
                                <label>
                                    <input type="checkbox" value="1" name="focus" <?php /*if(@$news->focus==1) echo 'checked';*/?>> Nổi bật
                                </label>-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Danh mục:</label>

                            <div class="col-lg-5">
                                <select name="category" class="form-control">
                                    <option value="">Lựa chọn</option>
                                    <?php foreach (@$cate_root as $v) {
                                        ?>
                                        <option value="<?php echo  $v->id; ?>" <?php if(@$news->category_id==$v->id) echo 'selected';?>><?php echo  $v->name; ?></option>

                                        <?php
                                        foreach (@$cate_chil as $v2) {
                                            if ($v2->parent_id == $v->id) {
                                                ?>
                                                <option value="<?php echo  $v2->id; ?>" <?php if(@$news->category_id==$v2->id) echo 'selected';?>>
                                                    &nbsp;&nbsp;&nbsp;|--<?php echo  $v2->name; ?></option>
                                                <?php
                                                foreach (@$cate_chil as $v3) {
                                                    if ($v3->parent_id == $v2->id) {
                                                        ?>
                                                        <option value="<?php echo  $v3->id; ?>" <?php if(@$news->category_id==$v3->id) echo 'selected';?>>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--<?php echo  $v3->name; ?></option>
                                                        <?php
                                                        foreach (@$cate_chil as $v4) {
                                                            if ($v4->parent_id == $v3->id) {
                                                                ?>
                                                                <option value="<?php echo  $v4->id; ?>" <?php if(@$news->category_id==$v4->id) echo 'selected';?>>
                                                                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;|--<?php echo  $v4->name; ?></option>
                                                            <?php
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Hình thức:</label>
                            <input type="hidden" value="<?php echo $news->option; ?>" class="hddOption">
                            <div class="col-lg-5">
                                <label>
                                    <input type="radio" name="option" value="1" > Một ảnh
                                </label>
                                <label>
                                    <input type="radio" name="option" value="2"> Nhiều ảnh
                                </label>
                                <label>
                                    <input type="radio" name="option" value="3"> Video
                                </label>
                            </div>
                        </div>

                            <div class="form-group form-group form-group-hidden form-group-image" data-active="1">
                                <?php if ($news->image != null) { ?>
                                    <div class="col-md-3 text-right">
                                        <label class="control-label">Ảnh:</label>
                                        <img src="<?php echo  base_url($news->image) ?>"
                                             style="width: 100px; max-height: 100px"/>
                                    </div>
                                    <label class="col-lg-2 control-label">Thay đổi ảnh:</label>

                                    <div class="col-lg-3">
                                        <input type="file" name="userfile" class="form-control" style="font-size: 12px"/>
                                    </div>
                                <?php }else{?>
                                    <label class="col-lg-2 control-label">Ảnh:</label>

                                    <div class="col-lg-5">
                                        <input type="file" name="userfile" class="form-control" style="font-size: 12px"/>
                                    </div>
                                <?php } ?>

                            </div>

                        <div class="form-group form-group-hidden form-group-images" data-active="2">
                            <input type="hidden" value="<?php echo count(@$listImage); ?>" class="hddImages" name="hddImages"/>
                            <a class="btn btn-xs btn-success btn-add-images">Thêm ảnh</a>
                            <div class="wrap-muliti-images">
                                <?php if(!empty($listImage)){
                                    $i = 1;
                                    foreach($listImage as $value){
                                    ?>
                                <div class='div-append form-group'>
                                        <label class="col-lg-2 control-label">Ảnh <?php echo $i; ?> :
                                            <img src="<?php echo  base_url(@$value->url) ?>"
                                                 style="width: 100px; max-height: 100px"/>

                                        </label>
                                        <div class="col-lg-5">
                                            <input type="file" name="userfile_<?php echo $i; ?>" class="form-control"/>
                                        </div>
                                    <a class="btn btn-danger btn-xs btn-del-images" data-id="<?php echo @$value->id; ?>">Xóa</a>
                                    </div>

                                <?php $i++; }
                                    }
                                ?>
                            </div>

                        </div>
                        <div class="form-group form-group-hidden form-group-video" data-active="3">
                            <label class="col-lg-2 control-label">Video:</label>
                            <div class="col-lg-5">
                                <input type="text" name="video" value="<?php echo @$news->video; ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-2 control-label">Nội dung:</label>
                            <div class="col-lg-7">
                                <textarea name="content" class="form-control"
                                          id="ckeditor"><?php echo  $news->content; ?></textarea>
                                <?php echo display_ckeditor($ckeditor); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Mô Tả:</label>

                            <div class="col-lg-5">
                                <textarea name="description" class="form-control" placeholder="Mô tả"
                                          rows="4"><?php echo  @$news->description; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keyword" class="col-lg-2 control-label">Từ khóa:</label>
                            <div class="col-lg-5">
                                <input name="keyword" class="form-control" placeholder="Từ khóa" rows="4"value="<?php echo  $news->keyword;?>" >
                            </div>
                        </div>
                        <div class="text-center" style="padding-bottom: 15px">
                            <button type="submit" class="btn btn-success btn-sm" name="editnews"><i class="fa fa-check"></i> Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->
    <input type="hidden" class="hddBaseUrl" value="<?php echo base_url(); ?>">
    </div>
    <!-- /.container-fluid -->
    <script type="text/javascript">
        $(function(){
            var option = $(".hddOption").val();
            var baseUrl = $(".hddBaseUrl").val();
            $("input[type='radio'][name='option'][value='"+option+"']").attr("checked",true);

            $(".form-group-hidden[data-active='"+option+"']").addClass("active");

            $(".btn-del-images").click(function(){
               var id = $(this).attr("data-id");
                $.ajax({
                    type: "POST",
                    url: baseUrl + 'admin/delete-images',
                    data: {id:id},
                    success: function (html) {
                        if(html=="success"){
                            location.reload();
                        }
                    }
                });
            });
            $("input[type='radio'][name='option']").click(function(){
                var vl = parseInt($(this).val());
                $(".form-group-hidden").removeClass("active");
                if($(this).is(":checked")){
                    if(vl==2){
                        $(".form-group-images").addClass("active");
                    }
                    else if(vl==3){
                        $(".form-group-video").addClass("active");
                    }
                    else{
                        $(".form-group-image").addClass("active");
                    }
                }
            });
            var i = parseInt($(".hddImages").val());
            $(".btn-add-images").click(function(){
                i++;
                $(".hddImages").val(i);
                var content = '<input type="file" name="userfile_'+i+'" class="form-control"/>';
                var newContent= "<div class='div-append form-group'><label class='col-lg-2'></label><div class='col-lg-5'>"+content+"</div>";
                $(this).closest(".form-group").append(newContent);
            });
        });
    </script>
</div>