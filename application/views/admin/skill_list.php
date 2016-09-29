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
                        <i class="fa fa-table"></i> Danh sách skill
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="text-left" style="padding-bottom: 15px">
                    <a href="<?php echo  base_url('admin/skill-add')?>">
                        <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm skill</button></a>
                </div>
                <div class="">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Giá trị</th>
                            <th width="15%">Action</th>
                        </tr>
                        <?php if(isset($lists)){
                            foreach($lists as $v){?>

                                <tr>
                                    <td><?php echo  @$v->id ?></td>
                                    <td><?php echo  @$v->name ?></td>
                                    <td><?php echo  @$v->value ?></td>
                                    <td>
                                        <a href="<?php echo  base_url('admin/skill-add/'.$v->id)?>">
                                            <button class="btn btn-xs btn-primary">Sửa</button>
                                        </a>
                                        <a href="<?php echo  base_url('admin/skill-delete/'.$v->id)?>">
                                            <button class="btn btn-xs btn-danger">Xóa</button>
                                        </a>
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