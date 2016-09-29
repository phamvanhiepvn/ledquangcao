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
                        <i class="fa fa-table"></i> Danh sách email đăng ký
                    </li>
                </ol>
            </div>
            <div class="col-md-12">

                <div class="clear"></div>

                <div class="">

                        <form class="form-horizontal" role="form" id="mail_list" method="POST"
                              action="<?php echo base_url('admin/emails/send-mail')?>"
                              enctype="multipart/form-data">

                        <button type="submit" name="btn"
                            class="btn btn-xs btn-default" style="margin-bottom: 10px">
                            Gửi mail</button>
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>
                                <input type="checkbox" name="check_all">
                            </th>
                            <th>STT</th>
                            <th>Email</th>
                            <th>Ngày đăng ký</th>
                            <th></th>
                        </tr>
                        <?php if (isset($list)) {
                            $s=1;
                            foreach ($list as $v) {
                                ?>
                                <tr>
                                    <td width="5%">
                                    <input name="email[]" type="checkbox" class="idRow" value="<?php echo @$v->email;?>">
                                    </td>
                                    <td width="5%"><?php echo $s++; ?></td>
                                    <td width="20%"><?php echo  @$v->email ?></td>
                                    <td ><?php echo  date('d-m-Y',@$v->time); ?></td>

                                    <td width='5%' class="text-center">
                                        <div class="btn-group btn-group-xs">
                                                <a href="<?php echo  base_url('admin/emails/delete/' . $v->id) ?>" title="Xóa"
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
                    </form>
                </div>
                <div class="pagination">
                    <?php
                    echo $this->pagination->create_links(); // tạo link phân trang
                    ?>
                </div>
                <script type="text/javascript">
                    $(document).on('click change','input[name="check_all"]',function() {
                        var checkboxes = $('.idRow');
                        if($(this).is(':checked')) {
                            checkboxes.each(function(){
                                this.checked = true;
                            });
                        } else {
                            checkboxes.each(function(){
                                this.checked = false;
                            });
                        }
                    });
                </script>
            </div>
        </div>


        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>