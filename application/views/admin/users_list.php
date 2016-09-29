<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    QUẢN LÝ THÀNH VIÊN
                </h3>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Danh sách thành viên
                    </li>
                </ol>
            </div>
            <div class="col-md-12">

                <div class="clear"></div>

                <div class="">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Họ và tên</th>
                            <th>Điện thoại</th>
                            <th>Tỉnh/Thành</th>
                            <th>Trạng thái</th>
                            <th>Đăng ký</th>
                            <th>Đăng nhập</th>
                            <th></th>
                        </tr>
                        <?php if (isset($userslist)) {
                            $s=1;
                            foreach ($userslist as $v) {
                                ?>
                                <tr>
                                    <td width="5%"><?php echo $s++; ?></td>
                                    <td width="20%"><?php echo  @$v->email ?></td>
                                    <td ><?php echo  @$v->fullname ?></td>
                                    <td ><?php echo  @$v->phone ?></td>
                                    <td ><?php echo  @$v->provin_name ?></td>

                                    <td width="10%" class="text-center">
                                        <label class="checkbox-inline" onclick="active_user(<?php echo $v->id;?>)">
                                            <input type="checkbox" <?php echo $v->active==1?'checked':''?>  data-toggle="toggle"  id="toggle" data-size="mini">
                                        </label>
                                    </td>
                                    <td width="10%"
                                        style="font-size: 12px"><?php echo  $v->signup_date;?> </td>
                                    <td width="15%"
                                        style="font-size: 12px"><?php echo  date('Y-m-d H:i',$v->last_login);?> </td>
                                    <td width='5%' class="text-center">

                                            <div class="btn-group btn-group-xs">
                                                    <a href="<?php echo  base_url('admin/users/delete/' . $v->id) ?>" title="Xóa"
                                                       class="btn btn-xs btn-danger" style="color: #fff"
                                                       onclick="return confirm('Xóa thành viên?')">
                                                        <i class="fa fa-times"></i> </a>
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

        <link href="<?php echo base_url('assets/css/bootstrap-toggle.min.css')?>" rel="stylesheet">
        <script src="<?php echo base_url('assets/js/bootstrap-toggle.min.js')?>"></script>

        <script type="text/javascript">

            function active_user(user){
                var baseurl = '<?php echo base_url();?>';

                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: baseurl + 'admin/active_user',
                    data: {id:user},
                    success: function (ketqua) {

                    }
                })
            }
            function changeStatus(id) {
                var data = {id: id};
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "<?php echo   base_url('admin/users/changeStatusUser')?>",
                    cache: false,
                    dataType: 'json',
                    success: function (e) {
                        if (e) {
                            $("#" + id).html(e);
                        }
                    }
                });
            }
        </script>
        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>