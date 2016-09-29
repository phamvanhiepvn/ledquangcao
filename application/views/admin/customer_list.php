<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-header">
                    Danh sách khách hàng
                </h3>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?php echo  base_url('admin')?>">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i>  Danh sách khách hàng
                    </li>

                </ol>
            </div>
            <div class="col-md-12">

                <div class="clear"></div>
                <div class="" style="padding-bottom: 15px">
                    <div class="col-md-3" style="padding-bottom: 10px">
                        <a href="<?php echo  base_url('admin/them-khach-hang') ?>">
                            <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm</button>
                        </a>
                    </div>

                </div>
                <div class="clearfix"></div>
                <div class="table-striped" style="overflow-x: auto">
                    <div class="clearfix"></div>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr class="active">
                                <th>ID</th>
                                <th >Ảnh</th>
                                <th>Tên miền</th>
                                <th>Tên cơ quan (Cá Nhân)</th>
                                <th>Target</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($list)) {
                                $stt=1;
                                foreach ($list as $v) {
                                    ?>
                                    <tr>
                                        <td width="5%"><?php echo  $stt++; ?></td>
                                        <td width="10%">
                                            <img width="60" height="60" src="<?php echo  base_url($v->image); ?>" alt=""
                                                 style="border: 1px solid #f2f2f2; padding: 2px"/></td>
                                        <td width="20%"><?php echo  @$v->title ?></td>
                                        <td width="20%"><?php echo  @$v->name; ?></td>
                                        <td width="20%"><?php echo  @$v->target ?></td>

                                        <td width='8%' class="text-right">

                                            <div class="btn-group btn-group-xs">

                                                <a class="btn btn-xs btn-default"
                                                   href="<?php echo  base_url('admin/sua-thong-tin-khach-hang/' . $v->id) ?>"><i class="fa fa-pencil"></i> </a>

                                                <a class="btn btn-xs btn-danger"
                                                   href="<?php echo  base_url('admin/xoa-khach-hang/' . $v->id) ?>"
                                                   title="Xóa"
                                                   style="color: #fff" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="fa fa-times"></i> </a>

                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } ?>
                        </tbody>
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