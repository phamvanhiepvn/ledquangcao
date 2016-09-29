<div id="page-wrapper">
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo  base_url('admin')?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Danh sách liên hệ
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="">
                    <input id="baseurl" type="hidden" value="<?php echo  base_url();?>">
                    <div class="modal fade bs-example-modal-lg popup1" id="popup1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myLargeModalLabel">Liên hệ</h4>
                                </div>
                                <div class="modal-body">
                                    <div id="getmodal" style="min-height: 300px">



                                        <div class="clear" style="clear: both; "></div>
                                    </div>
                                    <div class="clear" style="clear: both"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        .red{background:  red}
                        .blue{background:  #4cae4c}
                    </style>

                    <table class="table table-hover table-bordered">
                        <tr>
                            <th width="3%"></th>
                            <th width="3%" class="text-center">STT</th>
                            <th>Tên</th>
                            <th width="15%">Điện thoại</th>
                            <th width="15%">Email</th>
                            <th width="15%">Địa chỉ</th>
                            <th width="10%">Thời gian gửi</th>
                            <th width="10%" class="text-center">Action</th>
                        </tr>
                        <?php if(isset($list)){
                            $stt=1;
                            foreach($list as $v){
                                $j=$stt++;
                                $id_tr='id_tr'.$j;
                                ?>

                                <tr>
                                    <td>
                                        <i style="cursor: pointer" id="<?php echo $id_tr.'2';?>"
                                           data-toggle="tooltip" data-placement="right" title="Đánh dấu"
                                           class="fa <?php echo $v->mark==0?'fa-square-o':'fa-check-square-o'?>"
                                           onclick="mark(<?php echo $v->id?>,<?php echo $v->mark?>,$(this).attr('id'))"></i>
                                    </td>
                                    <td class="text-center"><?php echo  $j;?></td>
                                    <td><?php echo  @$v->full_name?>
                                        <div id="<?php echo $id_tr.'1';?>" style="float: right; border-radius: 50%; width: 8px; height: 8px;margin-top: 6px; cursor: help"
                                             data-toggle="tooltip" data-placement="right" title="<?php echo $v->show==0?'Chưa xem':'Đã xem'?>"
                                             class="<?php echo $v->show==0?'red':'blue'?>"></div>
                                    </td>
                                    <td><?php echo  @$v->phone?></td>
                                    <td><?php echo  @$v->email?></td>
                                    <td><?php echo  @$v->address?></td>
                                    <td><?php echo  !empty($v->time)?date('d-m-Y',@$v->time):'';?> </td>
                                    <td class="text-center">
                                      <div onclick="getModal(<?php echo $v->id;?>,'<?php echo $id_tr.'1';?>')"

                                           class="btn btn-xs btn-default" data-toggle="modal" data-target=".popup1" title="Xem chi tiết">
                                                <i class="fa fa-eye" style=""></i></div>

                                        <a href="<?php echo  base_url('admin/contact/Delete/'.$v->id)?>"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                            <div class="btn btn-xs btn-danger"><i class="fa fa-times-circle" style=""></i></div>
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </table>
                    <script>
                        function mark(id_contact, mark, div) {

                            var baseurl = $('#baseurl').val();
                            $.ajax({
                                type: "POST",
                                dataType: 'json',
                                url: baseurl + 'admin/contact/update_show',
                                data: {id_contact: id_contact},
                                success: function (rs) {
                                    if(rs==1){
                                        $('#' + div).removeClass('fa-square-o').addClass('fa-check-square-o');
                                    }
                                    if(rs==0){
                                        $('#' + div).removeClass('fa-check-square-o').addClass('fa-square-o');
                                    }

                                }
                            })
                        }

                        function getModal(id,div) {
                            var baseurl = $('#baseurl').val();

                            $.ajax({
                                type: "GET",
                                url: baseurl + 'admin/contact/popupdata',
                                data: "id=" + id,
                                success: function (ketqua) {
                                    $('#'+div).removeClass('red').addClass('blue');
                                    $("#getmodal").html(ketqua);

                                }
                            })
                            $("#num").select();
                        }
                    </script>
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
