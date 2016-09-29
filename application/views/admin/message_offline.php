<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    Liên hệ
                </h3>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?php echo  base_url('admin') ?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Danh sách tin nhắn offline
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
            
                <div class="">
                    <div class="clear"></div>
                    <table class="table  table-hover table-bordered">
                        <tr>
                            <th>STT</th>
                            <th>Tên khách hàng</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Nội dung</th>
                            <th class="text-center">Action</th>
                        </tr>
                        <?php if (isset($message)) {
                            $s=1;
                            foreach ($message as $v) {
                                ?>
                                <tr>
                                    <td><?php echo  $s++; ?></td>
                                    <td><?php echo  @$v->email ?></td>
                                    <td><?php echo  @$v->name ?></td>
                                    <td><?php echo  @$v->address ?></td>
                                    <td><?php echo  @$v->message ?></td>
                                    
                                    <td>
                                        <div style="text-align: center; " class="action">
                                        
                                        <a href="<?php echo  base_url('admin/chat/del-transcript/' . $v->id).'/chat_transcript_offline' ?>"
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                           class="btn btn-xs btn-danger"title="Xóa" style="color: #fff"><i class="fa fa-times"></i> </a>
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