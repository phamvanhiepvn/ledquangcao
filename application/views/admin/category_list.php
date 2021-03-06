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
                <i class="fa fa-table"></i> Danh mục tin
            </li>
        </ol>
    </div>
    <div class="col-md-12">
        <div class="text-right" style="padding-bottom: 15px">
            <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm</button>
        </div>
        <div class="table-striped">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Alias</th>
                    <th>Ảnh</th>
                    <th>Mô tả</th>
                    <th>Action</th>
                </tr>
                <?php foreach(@$cate_list as $v){?>

                <tr>
                    <td><?php echo  $v->id?></td>
                    <td><?php echo  $v->name?></td>
                    <td><?php echo  $v->alias?></td>
                    <td><?php echo  $v->icon?></td>
                    <td><?php echo  $v->description?></td>
                    <td>
                        <a href="#" title="Danh sách tins">
                            <i class="fa fa-folder" style="font-size: 23px"></i>
                        </a>
                        <a href="<?php echo  base_url('admin/sua-danh-muc/'.$v->id)?>">
                            <button class="btn btn-xs btn-primary">Sửa</button>
                        </a>
                        <a href="<?php echo  base_url('admin/xoa-danh-muc/'.$v->id)?>">
                            <button class="btn btn-xs btn-danger">Xóa</button>
                        </a>
                    </td>
                </tr>
                <?php } ?>
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