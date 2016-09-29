
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Đăng nhập hệ thống quản trị</title>


    <link type="text/css" href="<?php echo  base_url('assets/app/css/bootstrap.min.css')?>" rel="stylesheet"/>
    <link type="text/css" href="<?php echo  base_url('assets/app/css/animate.css')?>" rel="stylesheet"/>

    <link href="<?php echo  base_url('assets/app/css/style_login.css') ?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo  base_url('assets/app/js/jquery-1.11.0.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo  base_url('assets/app/js/jquery.cookie.js')?>"></script>
    
    


</head>

    <body>

    <div class="site_main">
    <div class="container">
        <div id="Home" class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <div class="wall-logo">
                    <div class="Logo-module ">
                        <div class="divLogo">
                            <a class="logo" title="" href=""><img alt="" src="<?php echo base_url(@$logo) ?>" class="img-responsive" style="margin: auto auto 15px; border: 1px solid rgb(204, 204, 204); border-radius: 8px; box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15); padding: 2px 2px 5px 10px;width: 85%;"></a>
                        </div>
                    </div>
                </div>
                <form class="form-signin" role="form" method="post"action="">
                    <input type="text" autofocus="autofocus" placeholder="Tài khoản" class="form-control txtUser" name="email">
                    <input type="password" placeholder="Mật khẩu" class="form-control txtPass" name="pass">
                    <label class="checkbox pull-left" style="margin-left: 20px;">
                        <input type="checkbox" value="remember-me"> Nhớ mật khẩu
                    </label>
                    <button type="submit" name="login" onclick="return validate_f()" class="btn btn-info btn-lg btn-block">Đăng nhập</button>
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>



<script type="text/javascript">
function validate_f(){
    if($(".txtUser").val()==""){
        $.cookie("fileLoading", true);
    }
}
    $(function(){
       // setInterval(function(){

      if ($.cookie("fileLoading")) {
            $.removeCookie("fileLoading");
            $("#Home").addClass("animated shake");
        
      }
    //},1000);
});
   
</script>

    </body>


 </html>





