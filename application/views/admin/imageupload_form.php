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
                        <i class="fa fa-table"></i> Ảnh
                    </li>
                </ol>
            </div>
            <div class="clear"></div>
            <div class="col-md-12">
                <?php echo form_open_multipart(base_url('admin/imageupload/doupload')); ?>
                <div class="col-md-3">
                <input name="userfile[]" id="userfile" type="file" multiple="" class="form-control input-sm"/>
                </div>
                <div class="col-md-1">
                <input type="submit" value="upload" class="btn btn-success btn-sm"/>
                </div>
                <div style="padding-top: 5px;   font-style: italic;">
                    (Note: Bạn có thể chọn nhiều ảnh Upload cùng 1 lúc.)
                </div>
                <?php echo form_close() ?>
            </div>
            <br>
            <br>
            <div class="col-md-12">
                <table class="table table-hover">
                    <tr>
                        <th width='5%'>ID</th>
                        <th width='10%'>Image</th>
                        <th width='5%'>Item ID</th>
                        <th width='10%'>Loại</th>
                        <th width='40%'>Link</th>
                        <th width='10%'>Action</th>
                    </tr>
                <?php if(isset($imagelist)){
                    foreach($imagelist as $v1){?>
                        <tr>
                            <td><?php echo  $v1->id;?></td>
                            <td><img src="<?php echo  base_url($v1->link)?>" style="height: 50px"></td>
                            <td><?php echo  $v1->id_item;?></td>
                            <td><?php echo  $v1->type;?></td>
                            <td style="font-size: 11px"><?php echo  base_url().$v1->link;?></td>
                            <td>
                                <a href="<?php echo  base_url('admin/imageupload/delete/' . $v1->id) ?>" title="Xóa"style="color: #fff">
                                            <button class="btn btn-xs btn-danger">Xóa </button>
                                </a>

                                <a href="<?php echo  base_url('admin/imageupload/edit/' . $v1->id) ?>" title="Xóa"style="color: #fff">
                                            <button class="btn btn-xs btn-success">Sửa </button>
                                </a>
                            </td>
                        </tr>
                    <?php   }
                }?>

                </table>
            </div>
            <div class="pagination">
                <?php
                echo $this->pagination->create_links(); // tạo link phân trang
                ?>
            </div>
    </div>
    </div>
    <!-- /.container-fluid -->

</div>