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
                        <i class="fa fa-table"></i> Thêm modules
                    </li>
                    <?php if (isset ($error)) { ?>
                        <li class="">
                            <span style="color: red"> <?php echo  $error; ?></span>
                        </li>
                    <?php } ?>
                </ol>
            </div>
            <div class="col-md-12">

                <div class="body collapse in" id="div1">
                    <form class="form-horizontal" role="form" id="form1" method="POST" action=""
                          enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo  @$id;?>"/>

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-1 control-label">Alias: <span
                                    style="color: red">* </span></label>

                            <div class="col-lg-2">
                                <input type="text" class="form-control input-sm " name="alias" value="<?php echo  @$edit->alias?>" placeholder=""/>
                            </div>
                            <label for="inputEmail1" class="col-lg-2 control-label">Tên modules: <span
                                    style="color: red">* </span></label>

                            <div class="col-lg-3">
                                <input  type="text" class="form-control input-sm" name="module_name" value="<?php echo  @$edit->module_name?>" placeholder="Tên modules"/>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-success btn-sm" name="add_submit"><i
                                        class="fa fa-check"></i> Cập nhật
                                </button>
                            </div>

                        </div>

                        <div class="form-group">

                        </div>
                    </form>
                </div>
                <div class="clear"></div>
                <div>
                    <table class="table table-hover">
                        <tr>
                            <th width="5%">STT</th>
                            <th>Tên ngắn</th>
                            <th>Tên đầy đủ</th>
                            <th width="10%">Chức năng</th>
                        </tr>
                        <?php $i=1;
                            foreach(@$modules_list as $v){?>

                            <tr>
                                <td><?php echo  $i++;?></td>
                                <td><?php echo $v->alias;?></td>
                                <td><?php echo $v->module_name;?></td>
                                <td>
                                    <a href="<?php echo  base_url('admin/edit-modules/' . $v->id) ?>">
                                       <div class="btn btn-xs btn-primary">Sửa</div>
                                    </a>&nbsp;&nbsp;
                                    <a href="<?php echo  base_url('admin/delete-module/' . $v->id) ?>">
                                        <div class="btn btn-xs btn-danger">Xóa</div>
                                    </a>
                                </td>
                            </tr>

                        <?php }?>

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