<?php 
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    if(isset($config_chat)){

?>
<div id="page-wrapper">



<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/css/front_end/ecom/chat/jquery.datetimepicker.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/chat/jquery.datetimepicker.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/css/front_end/ecom/chat/setting.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/colorpicker/css/colorpicker.css" type="text/css" />
    

  <script type="text/javascript" src="<?php echo base_url()?>assets/colorpicker/js/colorpicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/colorpicker/js/eye.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/colorpicker/js/utils.js"></script>
    

<script type="text/javascript" src="<?php echo base_url()?>assets/js/chat/chat_setting.js"></script>

    
    <input type="hidden" value="<?php echo base_url()?>" id="baseurl">
    
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row" style="margin-top:20px;">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Cấu hình hệ thống chat
                    </li>
                    <?php if(isset ($error)){?>
                        <li class="">
                            <span style="color: red"> <?php echo  $error;?></span>
                        </li>
                    <?php }?>
                </ol>
            </div>
            
<div class="col-lg-12">
<form role="form" id="form1" method="POST" action="<?php echo  base_url('admin/chat-setting')?>"
                          enctype="multipart/form-data">
<div class="form-horizontal">
          <input type="hidden" name="Id_Edit" value="" id="Id_Edit">
           <div class="form-group">
            <label class="col-md-3 control-label"> Trạng thái</label>
            <div class="col-md-3 col-toggle" onclick="change_toggle(this)" data-disable="1">
            <input type="hidden" value="<?php echo $config_chat->offline?>" id="status" name="status">

            <?php
              if($config_chat->offline==0){
                  echo '<i class="fa fa-2x fa-toggle-off"></i></a>';
              }else{
                  echo '<i class="fa fa-2x fa-toggle-on" disabled></i>';
              }
            ?>
            </div>
            </div>

            <div class="form-group">
            <label class="col-md-3 control-label"> Client Refresh</label>
            <div class="col-md-3">
              <input type="text" name="clientrefresh" disabled class="form-control controlDisable" value="<?php echo $config_chat->clientRefresh?>" id="clientrefresh">
            </div>
            </div>
             <div class="form-group">
            <label class="col-md-3 control-label"> Admin Refresh</label>
            <div class="col-md-3">
              <input type="text" name="adminrefresh" disabled class="form-control controlDisable" value="<?php echo $config_chat->adminRefresh?>" id="adminrefresh">
            </div>
            </div>
             <div class="form-group">
            <label class="col-md-3 control-label"> Convo Refresh</label>
            <div class="col-md-3">
              <input type="text" name="convorefresh" disabled class="form-control controlDisable" value="<?php echo $config_chat->convoRefresh?>" id="convorefresh">
            </div>
            </div>
           <div class="form-group">
            <label class="col-md-3 control-label"> Thời gian bắt đầu</label>
            <div class="col-md-3">
              <input type="text" name="timeon" disabled class="form-control controlDisable datepicker" value="<?php echo $config_chat->time_on?>" id="timeon">
            </div>
            </div>
            <div class="form-group">
            <label class="col-md-3 control-label"> Thời gian kết thúc</label>
            <div class="col-md-3">
              <input type="text" disabled class="form-control controlDisable datepicker" value="<?php echo $config_chat->time_off?>" id="timeoff" name="timeoff">
            </div>
            </div>
            <div class="form-group">
            <label class="col-md-3 control-label"> Ngày off</label>
            <div class="col-md-3">
              <input type="hidden" value="<?php echo $config_chat->date_off?>" id="dateoff" name="dateoff">
              <select class="form-control controlDisable" disabled id="sldateoff">
              
                <option value="Sat">Thứ 7</option>
                <option value="Sun">Chủ nhật</option>
              </select>
              
            </div>
            </div>

            <div class="form-group">
            <label class="col-md-3 control-label"> Welcome</label>
            <div class="col-md-9">
              <input type="text" disabled class="form-control controlDisable" value="<?php echo $config_chat->welcome?>" id="welcome" name="welcome">
            </div>
            </div>
            <div class="form-group">
            <label class="col-md-3 control-label"> Ảnh admin</label>
            <div class="col-md-6">
              <div class="wrap-avatar">
                    <img src="<?php echo base_url()."upload/img/".$config_chat->avatar ?>"/>
                    <span class="change-image">Thay đổi ảnh</span>
                    <input type="file" name="imageadmin" id="imageadmin" class="controlDisable" disabled>
              </div>
            </div>
            </div>
               <div class="form-group">
            <label class="col-md-3 control-label"> Email</label>
            <div class="col-md-9">
              <input type="text" disabled class="form-control controlDisable" value="<?php echo $config_chat->email?>" id="email" name="email">
            </div>
            </div>
            <div class="form-group">
            <label class="col-md-3 control-label"> Text header</label>
            <div class="col-md-9">
              <input type="text" disabled class="form-control controlDisable" value="<?php echo $config_chat->textheader?>" id="textheader" name="textheader">
            </div>
            </div>
            <div class="form-group">
            <label class="col-md-3 control-label"> Chữ chạy</label>
            <div class="col-md-9">
              <input type="text" disabled class="form-control controlDisable" value="<?php echo $config_chat->textmarquee?>" id="textmarquee" name="textmarquee">
            </div>
            </div>
            <div class="form-group">
            <label class="col-md-3 control-label"> Color layout</label>
            <div class="col-md-3">
             <div id="colorSelector" style="background-color:<?php echo $config_chat->colorLayout?>">
                <div class="div_bg"></div>
              </div>
              <input type="hidden" class="controlDisable" value="<?php echo $config_chat->colorLayout?>" id="colorlayout" name="colorlayout">
              
            </div>
            
            </div>

            <div class="form-group">
            <label class="col-md-3 control-label"> </label>
            <div class="col-md-9">
            
              <a class="btn btn-primary btn-sm" onclick="update_config(this)"><i
                                    class="fa fa-check"></i> Sửa</a>
              <button type="submit" class="btn btn-success btn-sm controlDisable-update" name="Update"><i
                                    class="fa fa-check"></i> Lưu thay đổi
              </button>
            </div>
            </div>
          </div>
          </form>
        </div>

                
            <script type="text/javascript">
            

            $(document ).ready(function() {
            
                          $('#colorSelector').ColorPicker({
                          onShow: function (colpkr) {
                            $(colpkr).fadeIn(500);
                            return false;
                          },
                          onHide: function (colpkr) {
                            $(colpkr).fadeOut(500);
                            return false;
                          },
                          onChange: function (hsb, hex, rgb) {
                            $('#colorSelector div').css('backgroundColor', '#' + hex);
                            $('#colorlayout').val('#' + hex);
                            
                          }
                        });
            

             function readURL(input) {
                  if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      
                      reader.onload = function (e) {
                          $('.wrap-avatar img').attr('src', e.target.result);
                      }
                      reader.readAsDataURL(input.files[0]);
                  }
              }
              
              $(".wrap-avatar input[type='file']").change(function(){
                  readURL(this);
              });
             $(".change-image").click(function(){
              $(".wrap-avatar input[type='file']").click();
             });
             });
            </script>
        </div>
        
       

    </div>
   
</div>
<?php 
}
?>