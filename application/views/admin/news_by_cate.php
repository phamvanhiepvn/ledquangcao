<div id="page-wrapper">
<?php  date_default_timezone_set("Asia/Bangkok"); ?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?php echo  base_url('admin')?>">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> <a href="<?php echo  base_url('admin/danh-sach-tin-tuc')?>">Tin tức </a>
                    </li>
                    <li><?php echo  @$cate_curent->name;?></li>

                </ol>
            </div>
            <div class="col-md-12">

                <div class="clear"></div>
                <div class="" style="padding-bottom: 15px">
                    <div class="col-md-3" style="padding-bottom: 10px">
                        <a href="<?php echo  base_url('admin/tin-tuc/Add') ?>">
                            <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm</button>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Chọn danh mục <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo  base_url('admin/danh-sach-tin-tuc')?>">Tất cả</a></li>
                                <?php foreach(@$cate as $v){
                                    if($v->parent_id==0){
                                        ?>

                                        <li><a href="<?php echo  base_url('admin/tin-tuc/'. $v->alias)?>"><?php echo  $v->name?></a></li>
                                    <?php }
                                    foreach(@$cate as $v2){
                                        if($v2->parent_id==$v->id){?>

                                            <li><a href="<?php echo  base_url('admin/tin-tuc/'. $v2->alias)?>" style="font-size: 12px">
                                                    &nbsp;&nbsp;&nbsp;|--<?php echo  $v2->name?>
                                                </a></li>

                                        <?php  }
                                    }
                                } ?>

                            </ul>
                        </div>
                    </div>


                    <div class="col-md-6 text-right">
                       <!-- <label>Trạng thái:</label>
                        <label style="padding: 0px 10px">
                            <div style='width: 15px; height: 15px; background: #000088; float: left;'></div>
                            Trang chủ</label>
                        <label style="padding: 0px 10px">
                            <div style='width: 15px; height: 15px; background:red; float: left;'></div>
                            Hot</label>
                        <label style="padding: 0px 10px">
                            <div style='width: 15px; height: 15px; background: #008855; float: left;'></div>
                            Nổi bật</label>-->
                    </div>
                </div>
                <div class="table-striped">
                    <table class="table">
                        <tr>


                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>Danh mục</th>
                            <th>Ảnh</th>
                            <th>Hiển thị</th>
                            <th>Thời gian</th>
                            <th class="text-center">Action</th>
                        </tr>
                        <?php if (isset($news_bycate)) {
                            $stt=1;
                            foreach ($news_bycate as $v) {
                                ?>

                                <tr>
                                    <td width="5%"><?php echo  $stt++; ?></td>
                                    <td width="30%">
                                        <a target="_blank" href="<?php echo  base_url('tin/' . $v->alias) ?>">
                                            <?php echo  @$v->title ?>
                                        </a>
                                    </td>
                                    <td width="20%"><?php echo  @$v->cate_name ?></td>

                                    <td width="10%"><?php if (@$v->image != null) { ?>
                                            <img src="<?php echo  base_url(@$v->image) ?>" style="height: 35px">
                                        <?php } else echo "No image" ?>
                                    </td>
                                    <td>
                                        <?php if ($v->home == 1) echo "<div style='width: 10px; height: 10px; background: #000088; float: left; margin-right: 10px '></div>" ?>
                                        <?php if ($v->hot == 1) echo "<div style='width: 10px; height: 10px; background: red; float: left;margin-right: 10px '></div>" ?>
                                        <?php if ($v->focus == 1) echo "<div style='width: 10px; height: 10px; background: #008855; float: left;margin-right: 10px '></div>" ?>
                                    </td>

                                    <td width="10%"
                                        style="font-size: 12px"><?php echo  date('H:i', @$v->time) . '<br>' . date('d-m-Y', @$v->time) ?></td>
                                    <td width='15%'>
                                        <div style="text-align: right; " class="action">

                                            <div class="btn-group btn-group-xs">

                                                <button class="btn btn-primary btn-xs">
                                                    <a href="<?php echo  base_url('admin/news/change_newscate/' . $v->news_id) ?>"
                                                       title="Chuyển danh mục" style="color: #fff">Chuyển </a>
                                                </button>


                                                <button class="btn btn-xs btn-primary">
                                                    <a href="<?php echo  base_url('admin/news/edit/' . $v->news_id) ?>" title="Sửa"style="color: #fff">Sửa</a>
                                                </button>


                                                <button class="btn btn-xs btn-danger">
                                                    <a href="<?php echo  base_url('admin/news/delete/' . $v->news_id) ?>" title="Xóa"style="color: #fff">
                                                        Xóa </a></button>

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