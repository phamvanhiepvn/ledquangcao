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
                        <i class="fa fa-table"></i> Thêm tin tức
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
                        <div class="text-right" style="padding-bottom: 15px">
                            <button type="submit" class="btn btn-success btn-sm" name="addnews"><i
                                    class="fa fa-check"></i> Thêm
                            </button>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Tiêu Đề <span
                                    style="color: red">* </span>:</label>

                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="title" placeholder="Tiêu đề"/>
                            </div>
                            <div class="col-md-5">
                                <!--<label>
                                    <input type="checkbox" value="1" name="home"> Trang chủ
                                </label>
                                &nbsp;&nbsp;&nbsp;
                                <label>
                                    <input type="checkbox" value="1" name="hot"> Hot
                                </label>
                                &nbsp;&nbsp;&nbsp;
                                <label>
                                    <input type="checkbox" value="1" name="focus"> Nổi bật
                                </label>-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Danh mục:</label>

                            <div class="col-lg-5">
                                <select name="category" class="form-control">
                                    <option value="">Lựa chọn</option>
                                    <?php foreach (@$cate_root as $v) {
                                            ?>
                                            <option value="<?php echo  $v->id; ?>"><?php echo  $v->name; ?></option>

                                        <?php
                                        foreach (@$cate_chil as $v2) {
                                            if ($v2->parent_id == $v->id) {
                                                ?>
                                                <option value="<?php echo  $v2->id; ?>">
                                                    &nbsp;&nbsp;&nbsp;|--<?php echo  $v2->name; ?></option>
                                            <?php
                                                foreach (@$cate_chil as $v3) {
                                                    if ($v3->parent_id == $v2->id) {
                                                        ?>
                                                        <option value="<?php echo  $v3->id; ?>">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--<?php echo  $v3->name; ?></option>
                                                    <?php
                                                        foreach (@$cate_chil as $v4) {
                                                            if ($v4->parent_id == $v3->id) {
                                                                ?>
                                                                <option value="<?php echo  $v4->id; ?>">
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
                            <label for="inputEmail1" class="col-lg-2 control-label">Mô Tả:</label>

                            <div class="col-lg-5">
                                <textarea name="description" class="form-control" placeholder="Mô tả"
                                          rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Hình thức:</label>
                            <div class="col-lg-5">
                                <label>
                                    <input type="radio" name="option" value="1" checked> Một ảnh
                                </label>
                                <label>
                                    <input type="radio" name="option" value="2"> Nhiều ảnh
                                </label>
                                <label>
                                    <input type="radio" name="option" value="3"> Video
                                </label>
                            </div>
                        </div>

                        <div class="form-group form-group-hidden form-group-image active">
                            <label class="col-lg-2 control-label">Cover:</label>

                            <div class="col-lg-5">
                                <input type="file" name="userfile" class="form-control"/>
                            </div>

                        </div>
                        <div class="form-group form-group-hidden form-group-images">
                            <input type="hidden" value="1" class="hddImages" name="hddImages"/>
                            <div class="wrap-muliti-images">
                                <label class="col-lg-2 control-label">Nhiều ảnh:</label>

                                <div class="col-lg-5">
                                    <input type="file" name="userfile_1" class="form-control"/>
                                </div>
                            </div>
                            <a class="btn btn-xs btn-success btn-add-images">Thêm ảnh</a>
                        </div>
                        <div class="form-group form-group-hidden form-group-video">
                            <label class="col-lg-2 control-label">Video:</label>
                            <div class="col-lg-5">
                                <input type="text" name="video" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputcontent" class="col-lg-2 control-label">Nội dung:</label>

                            <div class="col-lg-7">
                                <textarea name="content" class="form-control" id="ckeditor"></textarea>
                                <?php echo display_ckeditor($ckeditor); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keyword" class="col-lg-2 control-label">Từ khóa:</label>

                            <div class="col-lg-5">
                                <input type="text" name="keyword" class="form-control">
<!--                                <textarea name="keyword" class="form-control" placeholder="Từ khóa" rows="4"></textarea>-->
                            </div>
                        </div>

                        <div class="text-center" style="padding-bottom: 15px">
                            <button type="submit" class="btn btn-success btn-sm" name="addnews"><i
                                    class="fa fa-check"></i> Thêm
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
    <script type="text/javascript">
        $(function(){
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
            var i = 1;
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