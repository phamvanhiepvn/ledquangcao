<div id="show_mss" style="position: fixed; top: 100px; right: 20px;  z-index: 9999999"></div>
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
                        <i class="fa fa-dashboard"></i> <a href="<?php echo  base_url('admin') ?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Danh sách sim số
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="container-fluid">
                    <style>
                        .red{background:  red}
                        .blue{background:  #4cae4c}
                    </style>
                    <table class="table  table-hover table-bordered">
                        <tr>
                            <th width="3%"></th>
                            <th width="3%">STT</th>
                            <th>Mã ĐH</th>
                            <th>Họ tên</th>

                            <th width="10%">Điện thoại</th>
                            <th width="10%">Email</th>
                            <th width="10%">Địa chỉ</th>
                            <th width="10%">Thời gian</th>
                            <th width=10%>Trạng thái</th>
                            <th width="8%">Chức năng</th>
                        </tr>
                        <?php if (isset($item_list)) {
                            $stt = 1;
                            foreach ($item_list as $v) {
                                $j=$stt++;
                                $id_tr='id_tr'.$j;
                                ?>
                                <tr>

                                    <td class="text-center">
                                        <i style="cursor: pointer" id="<?php echo $id_tr.'2';?>"
                                           data-toggle="tooltip" data-placement="right" title="Đánh dấu"
                                           class="fa <?php echo $v->mark==0?'fa-square-o':'fa-check-square-o'?>"
                                           onclick="mark(<?php echo $v->id?>,<?php echo $v->mark?>,$(this).attr('id'))"></i>
                                    </td>

                                    <td class="text-center"><?php echo  $j++; ?>
                                    </td>

                                    <td>
                                        <div data-items="<?php echo $id_tr;?>"     onclick="show_detail($(this).attr('data-items'),<?php echo $v->id?>,'<?php echo $id_tr.'1';?>',<?php echo $v->show?>)">
                                             <a style="cursor: pointer" data-toggle="tooltip" data-placement="right" title="Xem chi tiết">
                                                 <i class="fa fa-caret-down" style="font-size: 11px"></i> <?php echo  @$v->code?>
                                             </a>
                                            <div id="<?php echo $id_tr.'1';?>" style="float: right; border-radius: 50%; width: 8px; height: 8px;margin-top: 6px; cursor: help"
                                                 data-toggle="tooltip" data-placement="right" title="<?php echo $v->show==0?'Chưa xem':'Đã xem'?>"
                                                 class="<?php echo $v->show==0?'red':'blue'?>"></div>
                                        </div>
                                    </td>
                                    <td class="text-center"><?php echo  $v->fullname; ?>
                                    </td>
                                    <td><?php echo  @$v->phone ?></td>
                                    <td><?php echo  $v->email ?></td>
                                    <td><?php echo  @$v->address ?></td>
                                    <td><div style="font-size: 11px"><?php echo  date('d-m-Y H:i',@$v->time) ?></div></td>
                                    <td>
                                        <select name="ord_status" onchange="window.location.href='<?php echo base_url('admin/order/updateStatusOrder/'.$v->id)?>/'+this.value">
                                            <option value="0" <?php if($v->status == 0){echo "selected='selected'";}?>>Không duyệt</option>
                                            <option value="1" <?php if($v->status == 1){echo "selected='selected'";}?>>Đã duyệt</option>
                                            <option value="2" <?php if($v->status == 2){echo "selected='selected'";}?>>Chưa xử lý</option>
                                            <option value="3" <?php if($v->status == 3){echo "selected='selected'";}?>>Đã thanh toán</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div style="text-align: center; " class=" ">

                                            <div class=" t">

                                                <a href="<?php echo  base_url('admin/deleteorder/' . $v->id) ?>"
                                                   class="btn btn-xs btn-danger" title="Xóa"
                                                   onclick="return confirm('Bạn có chắc chắn muốn xóa?')" >
                                                    <i class="fa fa-times-circle"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr style="display: none" id="<?php echo $id_tr;?>" data-value="1">
                                    <td colspan="10">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">

                                                <tr>
                                                    <td   colspan="2">
                                                        <p><b>Admin ghi chú:</b></p>
                                                        <textarea id="<?php echo 'ad_note'.$v->id;?>" class="form-control"><?php echo @$v->admin_note;?></textarea>
                                                        <input type="button" value="Lưu" data-items="<?php echo 'ad_note'.$v->id;?>"
                                                               onclick="add_admin_note(<?php echo $v->id?>,'<?php echo 'ad_note'.$v->id;?>')"
                                                               class="btn btn-xs btn-default pull-right" style="margin-top: 5px">
                                                    </td>
                                                    <td colspan="4">
                                                        <p><b>Nội dung:</b></p>
                                                        <?php echo   @$v->note; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Tên hàng</th>
                                                    <th>Số lượng</th>
                                                    <th>Màu</th>
                                                    <th>Size</th>
                                                    <th>Đơn giá(đ)</th>
                                                    <th>Thành tiền(đ)</th>
                                                </tr>
                                                <?php
                                                    $tootle=0;
                                                foreach($detail as $d){
                                                    if($d->order_id==$v->id){
                                                        $tootle+=$d->price*$d->count;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $d->name;?></td>
                                                        <td><?php echo $d->count;?></td>
                                                        <td>
                                                            <?php echo  ($d->color=='0'||$d->color=='')?'':'<div style="padding: 0px 5px ; float: left">Màu:</div> <div style="background:'.$d->color.';width: 20px; height:20px;float:left "></div> ';?>
                                                        </td>
                                                        <td>
                                                            <?php echo  ($d->size=='0'||$d->size=='')?'':'<div style="padding: 0px 5px ; float: left">Size:</div> <div style="">'.$d->size.'</div> ';?>
                                                        </td>
                                                        <td><?php echo number_format($d->price);?></td>
                                                        <td><?php echo number_format($d->price*$d->count);?></td>
                                                    </tr>

                                                <?php }
                                                }

                                                ?>
                                                <tr>
                                                    <td colspan="6" class="text-right">Tổng giá trị đơn hàng: <?php echo number_format($tootle);?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>

                            <?php
                            }
                        } ?>
                    </table>
                <div data-value=""></div>
                    <input type="hidden" id="baseurl" value="<?php echo base_url();?>">
                    <script>
                        function show_detail(id_tr,id_order,status,show){
                            if($('#'+id_tr).attr('data-value')=='1'){
                                $('#'+id_tr).show();
                                $('#'+id_tr).attr('data-value','2');
                            }else{
                                $('#'+id_tr).hide();
                                $('#'+id_tr).attr('data-value','1');
                            }
                            if(show==0){
                                var baseurl = $('#baseurl').val();
                                $.ajax({
                                    type: "POST",
                                    dataType: 'json',
                                    url: baseurl + 'admin/order/update_show',
                                    data: {order:id_order},
                                    success: function (rs) {
                                        $('#'+status).removeClass('red').addClass('blue');
                                        count_order();
                                    }
                                })
                            }
                        }
                        function mark(id_order, mark, div) {

                            var baseurl = $('#baseurl').val();
                            $.ajax({
                                type: "POST",
                                dataType: 'json',
                                url: baseurl + 'admin/order/update_show',
                                data: {id_order: id_order},
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


                        function add_admin_note(id,note){
                            var baseurl = $('#baseurl').val();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: baseurl + 'admin/order/update_admin_note',
                                data: {id:id,note:$('#'+note).val()},
                                success: function (result) {

                                    if(result.status==true){

                                        var t2='<div class=" alert-ml col-xs-12 alert alert-info alert-dismissible" role="alert" style="opacity: 1 !important;  ">\
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                                            +result.mess+
                                            '</div>';
                                        $('#show_mss').html(t2);

                                        setTimeout(function(){
                                            $('#show_mss').empty();
                                        }, 5000)
                                    }
                                }
                            })
                        }

                        function messs () {
                            setTimeout(show_mss, 2000)
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