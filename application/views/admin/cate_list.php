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
                        <i class="fa fa-table"></i> Danh mục tin tức
                    </li>
                </ol>
            </div>
            <div class="col-md-12">

                    <div class="text-left col-md-6" style="padding-bottom: 15px">
                        <a href="<?php echo  base_url('admin/category/Add')?>">
                             <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i>  Thêm</button>
                        </a>
                    </div>
                <div class="col-md-6 text-right">
                   <!-- <label style="padding: 0px 10px">
                        <div style='width: 15px; height: 15px; background: #000088; float: left;'></div>
                        Trang chủ</label>
                    <label style="padding: 0px 10px">
                        <div style='width: 15px; height: 15px; background:red; float: left;'></div>
                        Hot</label>
                    <label style="padding: 0px 10px">
                        <div style='width: 15px; height: 15px; background: #008855; float: left;'></div>
                        Nổi bật</label>-->
                </div>

                <div class="table-striped">
                    <div class="clear"></div>
                    <table class="table">
                        <tr>
                            <th width="40%">Tên</th>
                            <th width="30%">Ảnh</th>
                            <th width="20%">Hiển thị</th>
                            <th width="20%" class="text-center">Action</th>
                        </tr>
                        <?php foreach(@$cate_root as $v){

                            ?>
                            <tr style="background: #f5f5f5">
                                <td><b><?php echo  $v->name?></b></td>
                                <td><?php echo  $v->icon?></td>
                                <td>
                                    <?php if ($v->home == 1) echo "<div style='width: 10px; height: 10px; background: #000088; float: left; margin-right: 10px '></div>" ?>
                                    <?php if ($v->hot == 1) echo "<div style='width: 10px; height: 10px; background: red; float: left;margin-right: 10px '></div>" ?>
                                    <?php if ($v->focus == 1) echo "<div style='width: 10px; height: 10px; background: #008855; float: left;margin-right: 10px '></div>" ?>
                                </td>
                                <td class="text-right">
                                    <a href="<?php echo  base_url('admin/category/Edit/'.$v->id)?>">
                                        <button class="btn btn-xs btn-primary">Sửa</button>
                                    </a>
                                    <a href="<?php echo  base_url('admin/news/deletecate/'.$v->id)?>">
                                        <button class="btn btn-xs btn-danger">Xóa</button>
                                    </a>
                                </td>
                            </tr>

                        <?php
                            foreach(@$cate_chil as $v2){
                            if($v2->parent_id==$v->id){?>
                                <tr>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $v2->name?></td>
                                    <td>&nbsp;&nbsp;&nbsp;<?php echo  $v2->icon?></td>
                                    <td>
                                        <?php if ($v2->home == 1) echo "<div style='width: 10px; height: 10px; background: #000088; float: left; margin-right: 10px '></div>" ?>
                                        <?php if ($v2->hot == 1) echo "<div style='width: 10px; height: 10px; background: red; float: left;margin-right: 10px '></div>" ?>
                                        <?php if ($v2->focus == 1) echo "<div style='width: 10px; height: 10px; background: #008855; float: left;margin-right: 10px '></div>" ?>
                                    </td>
                                    <td class="text-right">

                                        <a href="<?php echo  base_url('admin/category/Edit/'.$v2->id)?>">
                                            <i class="fa fa-edit fa-2x" style="font-size: 19px"></i>
                                        </a>&nbsp;&nbsp;
                                        <a href="<?php echo  base_url('admin/news/deletecate/'.$v2->id)?>">
                                            <i class="fa fa-trash-o fa-2x" style="font-size: 19px"></i>
                                        </a>
                                    </td>
                                </tr>
                         <?php
                                foreach(@$cate_chil as $v3){
                                    if($v3->parent_id==$v2->id){?>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $v3->name?></td>
                                            <td>&nbsp;&nbsp;&nbsp;<?php echo  $v3->icon?></td>
                                            <td>
                                                <?php if ($v3->home == 1) echo "<div style='width: 10px; height: 10px; background: #000088; float: left; margin-right: 10px '></div>" ?>
                                                <?php if ($v3->hot == 1) echo "<div style='width: 10px; height: 10px; background: red; float: left;margin-right: 10px '></div>" ?>
                                                <?php if ($v3->focus == 1) echo "<div style='width: 10px; height: 10px; background: #008855; float: left;margin-right: 10px '></div>" ?>
                                            </td>
                                            <td class="text-right">

                                                <a href="<?php echo  base_url('admin/category/Edit/'.$v3->id)?>">
                                                    <i class="fa fa-edit fa-2x" style="font-size: 19px"></i>
                                                </a>&nbsp;&nbsp;
                                                <a href="<?php echo  base_url('admin/news/deletecate/'.$v3->id)?>">
                                                    <i class="fa fa-trash-o fa-2x" style="font-size: 19px"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                        foreach(@$cate_chil as $v4){
                                            if($v4->parent_id==$v3->id){?>
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $v4->name?></td>
                                                    <td>&nbsp;&nbsp;&nbsp;<?php echo  $v4->icon?></td>
                                                    <td>
                                                        <?php if ($v4->home == 1) echo "<div style='width: 10px; height: 10px; background: #000088; float: left; margin-right: 10px '></div>" ?>
                                                        <?php if ($v4->hot == 1) echo "<div style='width: 10px; height: 10px; background: red; float: left;margin-right: 10px '></div>" ?>
                                                        <?php if ($v4->focus == 1) echo "<div style='width: 10px; height: 10px; background: #008855; float: left;margin-right: 10px '></div>" ?>
                                                    </td>
                                                    <td class="text-right">

                                                        <a href="<?php echo  base_url('admin/category/Edit/'.$v4->id)?>">
                                                            <i class="fa fa-edit fa-2x" style="font-size: 19px"></i>
                                                        </a>&nbsp;&nbsp;
                                                        <a href="<?php echo  base_url('admin/news/deletecate/'.$v4->id)?>">
                                                            <i class="fa fa-trash-o fa-2x" style="font-size: 19px"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php   }
                                        }
                                    }
                                }
                            }
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