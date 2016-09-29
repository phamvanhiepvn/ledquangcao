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


            <br>
            <div class="col-md-12">
                <table class="table table-hover">
                    <tr>
                        <th width='5%'>ID</th>
                        <th width='30%'>Image/Video</th>
                        <th width='10%'>Link</th>
                        <th width='10%'>Loại</th>
                        <th width='10%'>Action</th>
                    </tr>
                <?php if(isset($imagelist)){
                    foreach($imagelist as $v1){?>
                        <tr>
                            <td><?php echo  $v1->id;?></td>
                            <td><?php if($v1->video_url!=""){
                                ?>
                                <a target="_blank" href="<?php echo $v1->video_url; ?>"><i class="fa fa-4x fa-film"></i></a>
                            <?php }else{?>
                                    <img src="<?php echo  base_url($v1->img_url)?>" style="height: 50px">
                            <?php }?>
                            </td>
                            <td><?php echo  $v1->url;?></td>
                            <td><?php echo  $v1->type;?></td>

                            <td>
                                <a href="<?php echo  base_url('admin/sliders/delete/' . $v1->id) ?>" title="Xóa"style="color: #fff">
                                            <button class="btn btn-xs btn-danger">Xóa </button>
                                </a>

                                <a href="<?php echo  base_url('admin/sliders/edit/' . $v1->id) ?>" title="Xóa"style="color: #fff">
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