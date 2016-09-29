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
                        <i class="fa fa-table"></i> Danh mục sản phẩm
                    </li>
                </ol>
            </div>
            <div class="col-md-12">

                <div class="text-right" style="padding-bottom: 15px">
                    <a href="<?php echo  base_url('admin/product_category/Add') ?>">
                        <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm</button>
                    </a>
                </div>

                <div class="table-striped">
                    <table class="table">
                        <tr>
                            <th width="60%">Tên</th>
                            <th width="20%">Ảnh</th>
                            <th width="20%" class="text-center">Action</th>
                        </tr>
                        <?php
                        view_product_cate_table($cate,0,'');




                            /*foreach (@$cate_root as $v) {
                                */?><!--
                                <tr style="background: #f5f5f5">
                                    <td><b><?/*= $v->name */?></b></td>
                                    <td>
                                        <?php /*if ($v->image != '') { */?><img src="<?/*= base_url(@$v->image) */?>"
                                                                            style="width: 65px; height: 30px"><?php /*} */?>
                                    </td>
                                    <td class="text-right">
                                        <a href="<?/*= base_url('admin/product_category/Edit/' . $v->id) */?>">
                                            <button class="btn btn-xs btn-primary">Sửa</button>
                                        </a>
                                        <a href="<?/*= base_url('admin/product_category/Delete/' . $v->id) */?>">
                                            <button class="btn btn-xs btn-danger">Xóa</button>
                                        </a>
                                    </td>
                                </tr>

                                <?php
/*                                $stt = 1;
                                foreach (@$cate_chil as $v2) {
                                    if ($v2->parent_id == $v->id) {
                                        */?>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?/*= $v2->name */?></td>
                                            <td>&nbsp;&nbsp;&nbsp;<?php /*if ($v2->image != '') { */?>
                                                    <img  src="<?/*= base_url(@$v2->image) */?>"
                                                          style="width: 65px; height: 30px"><?php /*} */?>
                                            </td>
                                            <td class="text-right">

                                                <a href="<?/*= base_url('admin/category/Edit/' . $v2->id) */?>">
                                                    <i class="fa fa-edit fa-2x" style="font-size: 19px"></i>
                                                </a>&nbsp;&nbsp;
                                                <a href="<?/*= base_url('admin/product_category/Delete/' . $v2->id) */?>">
                                                    <i class="fa fa-trash-o fa-2x" style="font-size: 19px"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
/*                                        foreach (@$cate_chil as $v3) {
                                            if ($v3->parent_id == $v2->id) {
                                                */?>
                                                <tr>
                                                    <td>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?/*= $v3->name */?></td>
                                                    <td>&nbsp;&nbsp;&nbsp;<?php /*if ($v3->image != '') { */?>
                                                            <img src="<?/*= base_url(@$v3->image) */?>"
                                                                 style="width: 65px; height: 30px"><?php /*} */?></td>
                                                    <td class="text-right">

                                                        <a href="<?/*= base_url('admin/category/Edit/' . $v3->id) */?>">
                                                            <i class="fa fa-edit fa-2x" style="font-size: 19px"></i>
                                                        </a>&nbsp;&nbsp;
                                                        <a href="<?/*= base_url('admin/product_category/Delete/' . $v3->id) */?>">
                                                            <i class="fa fa-trash-o fa-2x" style="font-size: 19px"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
/*
                                                foreach (@$cate_chil as $v4) {
                                                    if ($v4->parent_id == $v3->id) {
                                                        */?>
                                                        <tr>
                                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?/*= $v4->name */?></td>
                                                            <td>&nbsp;&nbsp;&nbsp;<?php /*if ($v4->image != '') { */?>
                                                                    <img  src="<?/*= base_url(@$v4->image) */?>"
                                                                    style="width: 65px; height: 30px"><?php /*} */?></td>
                                                            <td class="text-right">

                                                                <a href="<?/*= base_url('admin/category/Edit/' . $v4->id) */?>">
                                                                    <i class="fa fa-edit fa-2x"
                                                                       style="font-size: 19px"></i>
                                                                </a>&nbsp;&nbsp;
                                                                <a href="<?/*= base_url('admin/product_category/Delete/' . $v4->id) */?>">
                                                                    <i class="fa fa-trash-o fa-2x"
                                                                       style="font-size: 19px"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    --><?php
/*                                                    }

                                                }
                                            }

                                        }
                                    }


                                }
                            } */
                        ?>
                    </table>
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