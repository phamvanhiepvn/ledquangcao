<?php 
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    if(isset($config_chat)){


?>
<div id="page-wrapper">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/css/front_end/ecom/chat/global.css" />
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAGpUBVPQSax-onAjUoeVAHXjX2EPEixo"
        async defer></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/chat/chat_backend.js"></script>
    <input type="hidden" value="<?php echo $config_chat->adminRefresh?>" id="adminRefresh">
    <input type="hidden" value="<?php echo $config_chat->convoRefresh?>" id="chatRefresh">
    
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
                        <i class="fa fa-table"></i> Quản lý thông tin chat
                    </li>
                    <?php if(isset ($error)){?>
                        <li class="">
                            <span style="color: red"> <?php echo  $error;?></span>
                        </li>
                    <?php }?>
                </ol>
            </div>
            

                <div class="body collapse in" id="div1">
                <div class="col-md-3">
                 <div class="wrap_all_list_guest">
                      <div class="panel panel-success">
                      <div class="panel-heading">Khách hàng đã hỗ trợ</div>
                      <div id="panel-body-chatted" class="panel-body">
                        
                      </div>
                    </div>
                     <div class="panel panel-default">
                      <div class="panel-heading">Khách hàng đang cần hỗ trợ</div>
                      <div id="panel-body-chatting" class="panel-body">
                        
                      </div>
                    </div>
                     <div class="panel panel-default">
                      <div class="panel-heading">Khách hàng đang truy cập</div>
                      <div id="panel-body-logged" class="panel-body">
                        
                      </div>
                    </div>
                </div>
                </div>
                <div class="col-md-9 col-chatting-with-guest">
                    <div class="panel panel-default">
                      <div class="panel-heading">Nội dung chat</div>
                      <div id="panel-body-userinfo" class="panel-body">
                        
                      </div>

                      <div id="chatOutput_admin"></div>
                      <div class="wrap_input_chat">

                       <form action="javascript:sendInput(activeConvo);" id="inputForm">
                            <form name="messageInput" id="MessageInput" action="javascript:sendInput(activeConvo);">
                            <input type="hidden" name="userID" id="userID" value="<?php if(isset($_SESSION['userID'])){echo $_SESSION['userID'];}?>" />
                            <input type="hidden" name="userName" id="userName" value="<?php if(isset($_SESSION['name'])){echo $_SESSION['name'];}?>" />
                            <input type="text" name="messageID" id="messageID" size="81" class="input_field" autocomplete="off" >
                            <input type="submit" value="Gửi tin nhắn" class="input_field submit"/>&nbsp;&nbsp;
                        </form> 

                </div>
                <div class="modal fade" id="myModalMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document" style="z-index:9999;">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Địa chỉ khách hàng</h4>
                    </div>
                    <div class="modal-body" style="height:450px;">
                      <div id="map" style="height: 100%;"></div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
                    </div>
                </div>
               
                  
                    
                </div>
            
        </div>
       

    </div>
   
</div>
<?php 
}
?>