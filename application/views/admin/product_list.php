<div id="page-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    SẢN PHẨM
                </h3>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?php echo  base_url('admin') ?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Danh sách dự án
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="" style="padding-bottom: 15px">

                    <div class="col-md-3" style="padding-bottom: 10px">
                        <a href="<?php echo  base_url('admin/du-an/Add') ?>">
                            <div class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm</div>
                        </a>
                    </div>


                    <div class="col-md-9 text-right">

                        <script>
                            $(function () {
                                $('[data-toggle="tooltip"]').tooltip()
                            })
                        </script>
                        <style>
                            .view_color{width: 10px; height: 10px;float: left;margin-top: 5px;cursor: pointer}
                        </style>

                        <form class="form-inline" action="" method="get">
                            <div class="form-group">
                                <label>Tên</label>
                                <input name="name" type="text" class="form-control input-sm">
                            </div>

                            <button type="submit" class="btn btn-default btn-sm "><i class="fa fa-search"></i></button>
                        </form>

                    </div>
                </div>
                <div class="">
                    <div class="clear"></div>
                    <table class="table  table-hover">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="20%">Tên</th>
                            <th width="10%">Danh mục</th>
                            <th width="10%">Ảnh</th>
                            <th width="5%">Hiển thị</th>
                            <th width="10%">Action</th>
                        </tr>
                        <?php if (isset($prolist)) {
                            $s=1;
                            foreach ($prolist as $v) {
                                ?>
                                <tr>
                                    <td><?php echo  $s++; ?></td>
                                    <td><?php echo  @$v->name ?></td>
                                    <td><?php echo  @$v->cate_name ?></td>
                                    <td>
                                        <?php if (@$v->image != null) { ?>
                                            <img src="<?php echo  base_url(@$v->image) ?>" style="width: 65px; height: 30px">
                                        <?php } else echo 'No image'; ?>
                                    </td>
                                    <td>
                                        <?php if ($v->home == 1) echo "<div data-toggle=\"tooltip\" data-placement=\"top\" title=\""._title_product_home."\"
                                        class='view_color' style='background: #000088;margin-right: 10px;'></div>" ?>
                                        <?php if ($v->hot == 1) echo "<div data-toggle=\"tooltip\" data-placement=\"top\" title=\""._title_product_hot."\"
                                        class='view_color' style='background: red;margin-right: 10px;'></div>" ?>
                                        <?php if ($v->focus == 1) echo "<div data-toggle=\"tooltip\" data-placement=\"top\" title=\""._title_product_focus."\"
                                        class='view_color' style='background: #008855;margin-right: 10px;'></div>" ?>

                                    </td>
                                    <td>
                                        <div style="text-align: right; " class="action">
                                            <div class="btn-group btn-group-xs">




                                                    <a href="<?php echo  base_url('admin/du-an/Edit/' . $v->id) ?>"
                                                       class="btn btn-xs btn-default" title="Sửa"><i class="fa fa-pencil"></i></a>


                                                    <a href="<?php echo  base_url('admin/du-an/' . $v->id) ?>"
                                                       class="btn btn-xs btn-default" title="Ảnh sản phẩm"  ><i class="fa fa-image"></i></a>

                                                    <a href="<?php echo  base_url('admin/du-an/Delete/' . $v->id) ?>"
                                                       onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                       class="btn btn-xs btn-danger"title="Xóa" style="color: #fff"><i class="fa fa-times"></i> </a>



                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
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