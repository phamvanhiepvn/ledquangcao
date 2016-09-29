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
                    <form class="validate form-horizontal" role="form" id='form1' method="POST" action=""
                          enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo  @$id; ?>"/>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="panel panel-default">
                                    <div class="panel-heading"><b>Thông tin tài khoản</b></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-4 control-label">
                                                <div class="row">Họ tên:</div>
                                            </label>

                                            <div class="col-lg-8">
                                                <input type="text" class="validate[required] form-control input-sm " name="fullname"
                                                       value="<?php echo  @$edit->fullname ?>" placeholder=""/>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-4 control-label">
                                                <div class="row">Tên đăng nhập:</div>
                                            </label>

                                            <div class="col-lg-8">
                                                <input type="text" class="validate[required] form-control input-sm " name="email"
                                                       value="<?php echo  @$edit->email ?>" placeholder=""/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-4 control-label">
                                                <div class="row">Mật khẩu:</div>
                                            </label>

                                            <div class="col-lg-8">
                                                <input type="password" class="validate[required] form-control input-sm " id="password" name="password"
                                                       value="" placeholder="" <?php echo  @$disable?>/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-4 control-label">
                                                <div class="row">Xác nhận mật khẩu:</div>
                                            </label>

                                            <div class="col-lg-8">
                                                <input type="password" class="validate[required,equals[password]] form-control input-sm " name=""
                                                       value="" placeholder="" <?php echo  @$disable?>/>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="panel panel-default">
                                    <div class="panel-heading"><b>Phân quyền quản trị</b></div>
                                    <div class="panel-body" style="overflow-y: auto;height: 210px ">
                                        <table class="table table-hover">
                                            <tr>
                                                <th style="padding: 0px">
                                                    <label style="display: block; width: 100%;  cursor: pointer;padding: 3px 5px">
                                                    <input type="checkbox" value="Full" name="check[]"
                                                        <?php
                                                            if(isset($module)&&in_array('Full',@$module)){
                                                                echo 'checked';
                                                            }else echo ''; ?>
                                                        />
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: red">Quyền quản trị cao nhất</span>

                                                    </label>
                                                </th>
                                                <!--<th width="10%">

                                                </th>-->
                                            </tr>
                                            <?php $i = 1;
                                                foreach (@$modules_list as $v) {
                                                    ?>

                                                    <tr>
                                                        <td style="padding: 0px">
                                                            <label style="display: block; width: 100%; font-weight: normal;cursor: pointer;padding: 3px 5px">
                                                            <input name="check[]" type="checkbox" value="<?php echo  $v->alias; ?>"
                                                                <?php
                                                                    if(isset($module)&&in_array(@$v->alias,@$module)){
                                                                        echo 'checked';
                                                                    }else echo ''; ?>
                                                                />

                                                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Quản lý <?php echo  $v->module_name; ?>
                                                                </label>

                                                        </td>
                                                       <!-- <td style="padding: 3px 5px">

                                                        </td>-->

                                                    </tr>

                                                <?php } ?>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="text-center">
                                <input type="submit" name="add_submit" value="Hoàn thành"
                                       class="btn btn-primary btn-sm"/>
                                <input type="reset" value="Nhập lại" class="btn btn-primary btn-sm"/>
                            </div>
                        </div>


                    </form>

                    <link rel="stylesheet" href="<?php echo  base_url('assets/css/validationEngine.jquery.css')?>">
                    <script src="<?php echo  base_url('assets/js/jquery.validationEngine-en.js')?>" charset="utf-8"></script> <!-- jQuery Validation Engine Language File -->
                    <script src="<?php echo  base_url('assets/js/jquery.validationEngine.js')?>"></script> <!-- jQuery Validation Engine -->
                    <script>
                        $(document).ready(function(){
                            $(".validate").validationEngine();
                        });
                    </script>

                </div>
                <div class="clear"></div>
                <br>
                <br>
                <table class="table table-bordered">
                    <tr>
                        <th width="5%" class="text-center">STT</th>
                        <th width="25%">Họ tên</th>
                        <th width="25%">Tên đăng nhập</th>
                        <th width="25%">Quyền truy cập</th>
                        <th width="20%" class="text-center">Chức năng</th>
                    </tr>

                    <?php if (isset($admin_list)) {
                        $i = 1;
                        foreach ($admin_list as $v_ad) {
                            ?>
                            <tr>
                                <td class="text-center"><?php echo  $i++; ?></td>
                                <td><?php echo  $v_ad->fullname ?></td>
                                <td><?php echo  @$v_ad->email; ?></td>
                                <td><?php echo  @$v_ad->module_name ?></td>
                                <td class="text-center">
                                    <a href="<?php echo  base_url('admin/admin-permission-edit/' . $v_ad->admin_id) ?>">
                                        <div class="btn btn-xs btn-primary">Sửa</div>
                                    </a>&nbsp;&nbsp;
                                    <a href="<?php echo  base_url('admin/admin-reset-pass/' . $v_ad->admin_id) ?>">
                                        <div class="btn btn-xs btn-warning" title="Reset mật khẩu">Reset</div>
                                    </a>&nbsp;&nbsp;
                                    <a href="<?php echo  base_url('admin/admin-permission-delete/' . $v_ad->admin_id) ?>">
                                        <div class="btn btn-xs btn-danger">Xóa</div>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                    }

                    ?>


                </table>

                <div>

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

