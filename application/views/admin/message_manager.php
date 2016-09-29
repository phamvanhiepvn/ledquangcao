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
                        <i class="fa fa-table"></i> Danh sách liên hệ
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
                <input type="hidden" value="<?php echo base_url()?>" id="hddurl" />
                <div class="">
                    <div class="clear"></div>
                    <table class="table  table-hover table-bordered">
                        <tr>
                            <th>STT</th>
                            <th>IP khách hàng</th>
                            <th>Địa chỉ</th>
                            <th class="text-center">Action</th>
                        </tr>
                        <?php if (isset($message)) {
                            $s=1;
                            foreach ($message as $v) {
                                ?>
                                <tr>
                                    <td><?php echo  $s++; ?></td>
                                    <td><?php echo  substr(str_replace("khach","",@$v->user),0,-3)  ?></td>
                                    <td><?php echo  @$v->location ?></td>
                                    <td>
                                        <div style="text-align: center; " class="action">
                                        <a data-convoid="<?php echo @$v->convoID ?>"
                                           onclick="readAllMessage(this)"
                                           class="btn btn-xs btn-success" title="Chi tiết" style="color: #fff"><i class="fa fa-comments-o"></i> </a>
                                       

                                        <a href="<?php echo  base_url('admin/chat/del-transcript/' . $v->convoID).'/chat_transcript' ?>"
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                           class="btn btn-xs btn-danger"title="Xóa" style="color: #fff"><i class="fa fa-times"></i> </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                        } ?>
                    </table>

                    <!-- Modal -->
<div class="modal fade" id="myModalAllMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="z-index:9999">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nội dung chi tiết</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
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
        <script type="text/javascript">
        function readAllMessage(obj){
            var convoID = $(obj).attr("data-convoid");
            $("#myModalAllMessage").modal('show');
             var baseurl = $('#hddurl').val();
            $.ajax({
                type: "POST",
                url: baseurl + 'admin/chat/get_all_message_byId',
                data: {
                    convoID: convoID
                },
                success: function(rs) {
                 var result = jQuery.parseJSON(rs);

                var str = '<table class="table table-bordered"><tr class="success"><th>Tên</th><th>Nội dung</th><th>Ngày giờ</th><th class="text-center">Chức năng</th></tr>';
                $.each(result, function(key, val) {

                    var date = val.time_chat.split(" ");
                    var time = date[1].split(":");
                    
                    var day  = date[0].split("-");
                    var dateFormat = time[0] + ":" + time[1] + ":" + time[2] + " "+ day[2]+"/"+day[1]+"/"+day[0];

                    str += '<tr>';
                    str += '<td>' + val.name + '</td>';
                    str += '<td>' + val.message + '</td>';
                    str += '<td>' + dateFormat + '</td>';
                    str += '<td class="text-center"><a class="btn-skip" onclick="delmessge(this)" data-id="' + val.id + '"><i class="fa fa-times-circle-o"></i></a></td>';
                    str += '</tr>';
                });
                str += '</table>';
                 $("#myModalAllMessage .modal-body").html(str);
                    
                }
            });

        }
        function delmessge(obj){
             var baseurl = $('#hddurl').val();
             var id = $(obj).attr('data-id');
            $.ajax({
                type: "POST",
                url: baseurl + 'admin/chat/del_message_byId',
                data: {
                    id: id
                },
                success: function(rs) {
                    $(obj).closest("tr").css("display","none");
                }
            });

        }
        </script>
    </div>
    <!-- /.container-fluid -->

</div>