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
                        <i class="fa fa-table"></i> Danh sách sản phẩm
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="" style="padding-bottom: 15px">

                    <div class="col-md-3" style="padding-bottom: 10px">
                        <a href="<?php echo  base_url('admin/product/Add')?>">
                            <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm</button></a>
                    </div>

                    <div class="col-md-3">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Chọn danh mục <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo  base_url('admin/danh-sach-san-pham') ?>">Tất cả</a></li>
                                <?php foreach (@$cate_root as $v) { ?>
                                    <li><a href="<?php echo  base_url('admin/product/' . $v->alias) ?>"><?php echo  $v->name ?></a></li>
                                    <?php
                                    foreach (@$cate_chil as $v2) {
                                        if ($v2->parent_id == $v->id) {
                                            ?>

                                            <li><a href="<?php echo  base_url('admin/product/' . $v2->alias) ?>">
                                                    &nbsp;&nbsp;&nbsp;|--<?php echo  $v2->name ?>
                                                </a></li>

                                            <?php
                                            foreach (@$cate_chil as $v3) {
                                                if ($v3->parent_id == $v2->id) {
                                                    ?>

                                                    <li><a href="<?php echo  base_url('admin/product/' . $v3->alias) ?>">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--<?php echo  $v3->name ?>
                                                        </a>
                                                    </li>

                                                    <?php
                                                    foreach (@$cate_chil as $v4) {
                                                        if ($v4->parent_id == $v3->id) {
                                                            ?>

                                                            <li>
                                                                <a href="<?php echo  base_url('admin/product/' . $v4->alias) ?>">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--<?php echo  $v4->name ?>
                                                                </a>
                                                            </li>

                                                        <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                } ?>

                            </ul>
                        </div>
                    </div>


                    <div class="col-md-6 text-right">

                        <script>
                            $(function () {
                                $('[data-toggle="tooltip"]').tooltip()
                            })
                        </script>
                        <style>
                            .view_color{width: 10px; height: 10px;float: left;margin-top: 5px;cursor: pointer}
                        </style>
                        <div style="padding: 0px 10px; float:right">
                            <div class="view_color" style='background: #000088;'
                                 data-toggle="tooltip" data-placement="top" title="<?php echo _title_product_home?>"></div>
                            <?php echo _title_product_home?></div>

                        <div style="padding: 0px 10px; float:right">
                            <div class="view_color" style='background:red;'
                                 data-toggle="tooltip" data-placement="top" title="<?php echo _title_product_hot?>"></div>
                            <?php echo _title_product_hot?></div>

                        <div style="padding: 0px 10px; float:right">
                            <div class="view_color" style='background: #008855;'
                                 data-toggle="tooltip" data-placement="top" title="<?php echo _title_product_focus?>"></div>
                            <?php echo _title_product_focus?></div>
                    </div>
                </div>
                <div class="">
                    <div style="clear: both"></div>
                    <table class="table  table-hover">
                        <tr>
                            <th width="5%">STT</th>
                            <th width="20%">Tên</th>
                            <th width="10%">Danh mục</th>
                            <th width="10%">Ảnh</th>
                            <th width="5%">Trạng thái</th>
                            <th width="10%">Action</th>
                        </tr>
                        <?php if(isset($pro_bycate)){
                            $s=1;
                            foreach($pro_bycate as $v){?>
                                <tr>
                                    <td><?php echo  $s++;?></td>
                                    <td><?php echo  @$v->pro_name?></td>
                                    <td><?php echo  @$v->cate_name?></td>
                                    <td>
                                        <?php if(@$v->pro_img!= null){?>
                                            <img src="<?php echo  base_url(@$v->pro_img)?>" style="width: 65px; height: 30px">
                                        <?php } else echo 'No image';?>
                                    </td>
                                    <td>
                                        <?php if ($v->home == 1) echo "<div style='width: 10px; height: 10px; background: #000088; float: left; margin-right: 10px '></div>" ?>
                                        <?php if ($v->hot == 1) echo "<div style='width: 10px; height: 10px; background: red; float: left;margin-right: 10px '></div>" ?>
                                        <?php if ($v->focus == 1) echo "<div style='width: 10px; height: 10px; background: #008855; float: left;margin-right: 10px '></div>" ?>
                                    </td>
                                    <td>
                                        <div style="text-align: right; " class="action">
                                            <div class="btn-group btn-group-xs">

                                                <a href="<?php echo  base_url('admin/product/Edit/' . $v->pro_id) ?>"
                                                   class="btn btn-xs btn-default" title="Sửa">
                                                    <i class="fa fa-pencil"></i></a>

                                                <a href="<?php echo  base_url('admin/product_images/' . $v->pro_id) ?>"
                                                   class="btn btn-xs btn-default" title="Ảnh sản phẩm"  >
                                                    <i class="fa fa-image"></i></a>

                                                <a href="<?php echo  base_url('admin/product/Delete/' . $v->pro_id) ?>"
                                                   onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                   class="btn btn-xs btn-danger"title="Xóa" style="color: #fff">
                                                    <i class="fa fa-times"></i> </a>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </table>
                </div>
                <div class="pagination">
                    <?php
                    echo $this->pagination->create_links(); // tạo link phân trang
                    ?>
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