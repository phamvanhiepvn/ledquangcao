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

                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Danh mục:</label>

                            <div class="col-lg-5">
                                <select name="category" class="form-control">
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
                        <div class="text-center" style="padding-bottom: 15px">
                            <button type="submit" class="btn btn-success btn-sm" name="changecate"><i class="fa fa-check"></i> Lưu</button>
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