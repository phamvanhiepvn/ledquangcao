<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Danh sách tin tức
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary btn-sm">Thêm</button>
                <div class="table-striped"  >
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Alias</th>
                            <th>Ảnh</th>
                            <th>Mô tả</th>
                            <th>Action</th>
                        </tr>
                        <?php if(isset($news_bycate)){
                            foreach($news_bycate as $v){?>

                                <tr>
                                    <td><?php echo  @$v->id?></td>
                                    <td>
                                        <a target="_blank" href="<?php echo  base_url('tin/' . $v->alias) ?>">
                                            <?php echo  @$v->title ?>
                                        </a>
                                    </td>
                                    <td><?php echo  @$v->alias?></td>
                                    <td><?php echo  @$v->image?></td>
                                    <td><?php echo  @$v->description?></td>
                                    <td>
                                        <a href="#" title="Chuyển danh mục">
                                            <i class="fa fa-external-link-square" style="font-size: 23px"></i>
                                        </a>
                                        <a href="<?php echo  base_url('admin/sua-danh-muc/'.$v->id)?>">
                                            <button class="btn btn-xs btn-primary">Sửa</button>
                                        </a>
                                        <a href="<?php echo  base_url('admin/xoa-danh-muc/'.$v->id)?>">
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