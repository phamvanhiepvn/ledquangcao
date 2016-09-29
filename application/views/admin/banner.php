<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-header">
                    QUẢN LÝ MEDIA
                </h3>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?php echo  base_url('admin')?>">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i>  Quản lý MEDIA
                    </li>

                </ol>
            </div>
            <div class="col-md-12">

                <div class="clear"></div>
                <div class="" style="padding-bottom: 15px">
                    <div class="col-md-3" style="padding-bottom: 10px">
                        <a href="<?php echo  base_url('admin/imageupload/banner_add') ?>">
                            <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm</button>
                        </a>
                    </div>

                </div>
                <div class="clearfix"></div>
                <div class="table-striped" style="overflow-x: auto">
                    <div class="clearfix"></div>
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th >Ảnh</th>
                            <th>Loại</th>
                            <th>Target</th>
                            <th>Action</th>
                        </tr>
                        <?php if (isset($list)) {
                            $stt=1;
                            foreach ($list as $v) {
                                ?>
                                <tr>
                                    <td width="5%"><?php echo  $stt++; ?></td>
                                    <td width="20%"><?php echo  @$v->title ?></td>
                                    <td width="20%"><img width="150" src="<?php echo  base_url($v->link); ?>" alt=""/></td>
                                    <td width="20%"><?php echo  @$v->type ?></td>
                                    <td width="20%"><?php echo  @$v->target ?></td>

                                    <td width='15%' class="text-right">

                                        <div class="btn-group btn-group-xs">

                                            <a class="btn btn-xs btn-default"
                                               href="<?php echo  base_url('admin/imageupload/banner_edit/' . $v->id) ?>"><i class="fa fa-pencil"></i> </a>

                                            <a class="btn btn-xs btn-danger"
                                               href="<?php echo  base_url('admin/imageupload/delete/' . $v->id) ?>" title="Xóa"
                                               style="color: #fff" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="fa fa-times"></i> </a>

                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                        } ?>
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