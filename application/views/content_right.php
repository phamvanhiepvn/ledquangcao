<!-- right col -->
<div class="right-col home">
<div class="small-b no-float">
    <div class="iframe_sendo360">
        <div class="box-360 box-activity"  >
            <div class="title">
                <h4><span title="Hoạt động mới">Hỗ trợ kỹ thuật</span></h4>
            </div>
            <div class="promotion-box" >
                <?php foreach(@$support as $row){?>
                    <?php if($row->type == 1) :?>
                        <div class="supportitem" >
                            <div class="col-md-8" style="padding: 0">
                                <a href="skype:<?php echo $row->skype;?>?chat"  style="float: left;width: 100%;margin-bottom:
                                         5px">
                                    <b><i class="fa fa-angle-double-right">&nbsp;</i><?php echo $row->name;?></b>
                                </a>
                                <span style="padding-left: 10px;color: #017DC3;"><?php echo $row->phone?></span>
                            </div>
                            <a href="skype:<?php echo $row->skype;?>?chat" class=""  >
                                <img src="<?php echo  base_url('img/skype.png') ?>" alt=""/>
                            </a>
                            <a href="<?php echo $row->email;?>">
                                <img src="<?php echo  base_url('img/fb.png') ?>" alt=""/>
                            </a>
                            <a href="ymsgr:sendIM?<?php echo $row->yahoo;?>">
                                <img border="0" src="http://opi.yahoo.com/online?u=con_gio_la_910&m=g&t=0" width="16px">

                            </a>
                        </div>
                    <?php endif;?>
                <?php }?>

            </div>

        </div>
        <div class="box-360 box-activity"  >
            <div class="title_kd">
                <h4><span title="Hỗ trợ kinh doanh">Hỗ trợ kinh doanh</span></h4>
            </div>
            <div class="promotion-box" >
                <?php foreach(@$support as $row){?>
                    <?php if($row->type == 0) :?>
                        <div class="supportitem" >
                            <div class="col-md-8" style="padding: 0">
                                <a href="skype:<?php echo $row->skype;?>?chat"  style="float: left;width: 100%;margin-bottom:
                                     5px">
                                    <b><i class="fa fa-angle-double-right">&nbsp;</i><?php echo $row->name;?></b>
                                </a>
                                <span style="padding-left: 10px;color: #017DC3;"><?php echo $row->phone?></span>
                            </div>
                            <a href="skype:<?php echo $row->skype;?>?chat" class=""  >
                                <img src="<?php echo  base_url('img/skype.png') ?>" alt=""/>
                            </a>
                            <a href="<?php echo $row->email;?>">
                                <img src="<?php echo  base_url('img/fb.png') ?>" alt=""/>
                            </a>
                            <a href="ymsgr:sendIM?<?php echo $row->yahoo;?>">
                                <img border="0" src="http://opi.yahoo.com/online?u=con_gio_la_910&m=g&t=0" width="16px">

                            </a>
                        </div>
                    <?php endif;?>
                <?php }?>

            </div>

        </div>
    </div>
    <div style="clear: both"></div>

</div>
    <?php foreach(@$bannerright as $ads){?>
        <div class="home-pro-ads m-t-10">
            <?php echo $ads->url!=''?"<a href='".$ads->url."'>":"";?>
            <img src="<?php echo  base_url($ads->link) ?>" alt=""/>
            <?php echo $ads->url!=''?"</a>":"";?>
        </div>
    <?php }?>
<div class="camnangmuasam" style="position: relative">
    <h4 class="title_qt">
        <span>Ý kiến khách hàng</span></h4>
    <div class="other_list">
        <ul class="yk-list">
            <li>
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo base_url('assets/images/adv_119chien-img.png')?>">
                    </div>
                    <div class="col-md-8" style="padding-left: 0;padding-top: 2px;line-height: 1.5">
                        <p style="color: #616161">Nguyễn Xuân Thủy</p>
                        <p style="color:#3d75cc">
                            xuanthuy@gmail.com</p>
                    </div>
                </div>
                <div class="row yk-content" style="margin-top: 8px">
                    <div class="col-md-12">
                        <i class="fa fa-quote-left" style="color: #616161"></i>
                        <p class="text">
                            Chúng tôi có hệ thống cửa hàng máy tính lào cai hoạt động được một thời gian khá dài,
                            hòa cùng với xu thế thương mại điện tử, kinh doanh online phát triển rầm rộ,
                            chúng tôi đã tìm hiểu và tin tưởng lựa chọn QTS để xây dựng
                            <i class="fa fa-quote-right" style="color: #616161"></i>
                        </p>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo base_url('assets/images/adv_120a2.png')?>">
                    </div>
                    <div class="col-md-8" style="padding-left: 0;padding-top: 2px;line-height: 1.5">
                        <p style="color: #616161">Hà Thị Giang</p>
                        <p style="color:#3d75cc">
                            hathigiang@gmail.com</p>
                    </div>
                </div>
                <div class="row yk-content" style="margin-top: 8px">
                    <div class="col-md-12">
                        <i class="fa fa-quote-left" style="color: #616161"></i>
                        <p class="text">
                            Tôi thực sự ấn tượng về nhân viên QTS. Tôi không có chuyên môn về CNTT,
                            nhờ có QTS tôi đã có một website khá bắt mắt và tôi đã thành công
                            trong lĩnh vực bán hàng online.
                            <i class="fa fa-quote-right" style="color: #616161"></i>
                        </p>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo base_url('assets/images/adv_118a1.png')?>">
                    </div>
                    <div class="col-md-8" style="padding-left: 0;padding-top: 2px;line-height: 1.5">
                        <p style="color: #616161">Nguyễn Thái Sơn</p>
                        <p style="color:#3d75cc">
                            sontn@gmail.com</p>
                    </div>
                </div>
                <div class="row yk-content" style="margin-top: 8px">
                    <div class="col-md-12">
                        <i class="fa fa-quote-left" style="color: #616161"></i>
                        <p class="text">
                            Tôi đã bị QTS chinh phục ngay từ những ngày đầu dùng thử.
                            QTS rất dễ sử dụng với hệ quản trị thân thiện,
                            có nhiều công cụ hỗ trợ quảng bá website hay tối ưu hóa công cụ tìm kiếm.

                            <i class="fa fa-quote-right" style="color: #616161"></i>
                        </p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="camnang_footer"></div>
</div>
</div>