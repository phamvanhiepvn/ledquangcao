<div id="container" class="hidden-xs hidden-sm">
    <div class="swap-content home">
        <div class="left-col home">
            <div class="top-content">
                <div class="breadcrumb_detail clearfix">
                    <a style=" color: #a599a5;" href="<?php echo base_url()?>">Trang chủ</a>
                    <i style="font-size: 18px;" class="fa fa-angle-right"></i>
                    <a href="#">Đăng ký nhận khuyến mại</a>
                </div>
            </div>
            <div class="col-md-12" style="width: 100%">
                <div style="margin:0px 0px 10px -15px; font-size: 15px;line-height: 1.5;">
                    <h1><span style="color:#FF8C00"><span style="font-size:14px">
                                Đăng ký nhận khuyến mại
                            </span></span></h1>

                    <p></p>
                </div><!-----End Thông tin contact---->
            </div> <!--thong tin contact-->
            <!--<section class="col-sm-2"></section>-->
            <section class="col-sm-9 col-xs-12" style="padding-left: 120px">
                <div class="form-contact">
                    <form action="" method="post" class="validate form-horizontal" role="form">
                        <div class="alert alert-success alert-dismissible" role="alert"
                             style="position: fixed; right: 450px;background:none;;font-style:italic;
                                     top:250px; width: 650px;
                                     font-size:40px;padding: 2px; margin: auto; line-height: normal;
                                     color: red; border: none; text-shadow: 0px 0px 5px #ffff00;
                                     ">
                            <?php if(isset($_SESSION['message'])){
                                echo $_SESSION['message']; unset($_SESSION['message']);}  ?>
                        </div>
                        <script type="text/javascript">
                            (function () {
                                setTimeout(showTooltip, 1500)
                            })();

                            function showTooltip() {
                                $('.alert-success').fadeOut();
                            }
                        </script>
                        <div class="form-group">
                            <label class="control-label">Lĩnh vực :</label>
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-addon"><i style="font-size:10px;" class="fa fa-windows"></i></span>
                                    <select name="type_web" class="validate[required] form-control ">
                                        <option value="">[---Vui lòng chọn lĩnh vực---]</option>
                                        <?php foreach($type_web as $t) :?>
                                            <option value="<?php echo $t->id?>"><?php echo $t->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Họ và tên :</label>
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-addon"><i style="font-size:15px;" class="fa fa-user"></i></span>
                                    <input type="text" style="z-index: 0;" name="full_name" class="validate[required] form-control placeholder" id="personName"
                                           placeholder="Họ Tên" data-bind="value: name">
                                    <input type="hidden" name="promotion" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Số điện thoại :</label>
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-addon"><i style="font-size:20px;" class="fa fa-mobile"></i></span>
                                    <input  name="phone" class="validate[required,custom[phone]] form-control placeholder" id="phone"
                                            data-original-title="Your activation email will be sent to this address."
                                            data-bind="value: email, event: { change: checkDuplicateEmail }"
                                            type="text" style="z-index: 0;" class="form-control"  placeholder="Số Điện Thoại">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email :</label>
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-addon"><i style="font-size:10px;" class="fa fa-envelope-o"></i></span>
                                    <input type="text"  style="z-index: 0;"  placeholder="Email"
                                           name="email" class="validate[required,custom[email]] form-control placeholder" id="personEmail"
                                           data-original-title="Your activation email will be sent to this address."
                                           data-bind="value: email, event: { change: checkDuplicateEmail }">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Ghi chú :</label>
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-addon"><i style="font-size:10px;" class="fa fa-home"></i></span>
                                    <input type="text"  style="z-index: 0;" placeholder="Ghi chú"
                                           name="address" class="validate[required] form-control placeholder" id="personName"
                                           data-bind="value: name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label">Nội dung :</label>
                            <div class="controls">
                                <div class="input-group" style="z-index: 0;">
                                    <span  class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                    <textarea  name="comment"   class="form-control placeholder"
                                               rows="4" cols="78" placeholder="Nội Dung"></textarea>

                                </div>
                            </div>
                        </div>
                        <div class="controls" style="margin-left: 40%;">
                            <input type="submit"  name="sendcontact" id="signupuser"
                                   class="btn btn-primary" value="Gửi Đi" />
                            <input type="reset" id="mybtn" class="btn btn-primary" value="Nhập Lại">
                        </div><!--end form-contact-->
                    </form>
                </div><!----End from contact--->

            </section><!--col-md-8 form contact-->
        </div>

        <link rel="stylesheet" type="text/css" href="<?php echo  base_url('assets/css/validationEngine.jquery.css') ?> "  media="all">

        <script type="text/javascript" src="<?php echo  base_url('assets/js/jquery.validationEngine-en.js') ?>"></script>
        <script type="text/javascript" src="<?php echo  base_url('assets/js/jquery.validationEngine.js') ?>"></script>
        <script>
            $(document).ready(function () {
                $(".validate").validationEngine();
            });
        </script>