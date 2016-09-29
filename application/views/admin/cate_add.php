<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Thêm danh mục tin tức
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

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Tên danh mục: <span
                                    style="color: red">* </span>:</label>

                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="title" placeholder="Tên danh mục"/>
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
                                </label>
                                &nbsp;&nbsp;&nbsp;
                                <label>
                                    <input type="checkbox" value="1" name="tour"> Tour nước ngoài
                                </label>-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Danh mục cha:</label>

                            <div class="col-lg-5">
                                <select name="parent" class="form-control">
                                    <option value="0">Root</option>
                                    <?php foreach (@$cate_root as $v) {

                                        ?>
                                        <option value="<?php echo  $v->id; ?>"><?php echo  $v->name; ?></option>

                                        <?php
                                        foreach (@$cate_chil as $v2) {
                                            if ($v2->parent_id == $v->id) {
                                                ?>
                                                <option value="<?php echo  $v2->id; ?>">
                                                    &nbsp;&nbsp;&nbsp;|-<?php echo  $v2->name; ?></option>
                                            <?php
                                                foreach (@$cate_chil as $v3) {
                                                    if ($v3->parent_id == $v2->id) {
                                                        ?>
                                                        <option value="<?php echo  $v3->id; ?>">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-<?php echo  $v3->name; ?></option>
                                                    <?php
                                                        foreach (@$cate_chil as $v4) {
                                                            if ($v4->parent_id == $v3->id) {
                                                                ?>
                                                                <option value="<?php echo  $v4->id; ?>">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-<?php echo  $v4->name; ?></option>
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
                            <label class="col-lg-2 control-label">Cover:</label>

                            <div class="col-lg-5">
                                <input type="file" name="userfile" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Mô Tả:</label>

                            <div class="col-lg-5">
                                <textarea name="description" class="form-control" placeholder="Mô tả"
                                          rows="4"></textarea>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm" name="addcate"><i
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

</div>