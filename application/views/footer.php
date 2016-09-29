</main>
<aside class="sidebar sidebar-primary widget-area">
    <section id="dc_jqaccordion_widget-2" class="widget ">
        <div class="widget-wrap"><h4 class="widget-title widgettitle">Danh mục sản phẩm</h4>

            <div class="dcjq-accordion" id="dc_jqaccordion_widget-2-item">
                <ul id="menu-menu-left" class="menu">
                    <?php
                        foreach ($menu_footer as $value){?>
                            <li id="menu-item-<?php echo $value->id; ?>"
                                class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-<?php echo $value->id; ?>">
                                <a href="<?php echo base_url("danh-muc/".@$value->alias); ?>"><?php echo $value->name; ?></a>
                            </li>
                        <?php }

                    ?>

                </ul>
            </div>
        </div>
    </section>

    <section id="facebook-like-widget-2" class="widget facebook_like">
        <div class="widget-wrap"><h4 class="widget-title widgettitle">FANPAGE Facebook</h4>

        </div>
    </section>
    <section id="countperday_widget-2" class="widget widget_countperday_widget">
        <div class="widget-wrap"><h4 class="widget-title widgettitle">Thống kê truy cập</h4>
            <ul class="cpd">
                <li class="cpd-l"><span id="cpd_number_getuserall" class="cpd-r">21569</span>Tổng truy cập:</li>
                <li class="cpd-l"><span id="cpd_number_getusertoday" class="cpd-r">15</span>Hôm nay:</li>
                <li class="cpd-l"><span id="cpd_number_getuseryesterday" class="cpd-r">62</span>Hôm qua:</li>
                <li class="cpd-l"><span id="cpd_number_getuseronline" class="cpd-r">1</span>Đang online:</li>
            </ul>
        </div>
    </section>
</aside>   </div> <!-- end #content-sidebar-wrap -->
</div>
<div class="clear"></div>
<div class="footer-widgets">
    <div class="wrap">
        <div class="footer-widgets-1 widget-area">
            <section id="text-2" class="widget widget_text">
                <div class="widget-wrap"><h4 class="widget-title widgettitle">CÔNG TY CỔ PHẦN LED QUẢNG CÁO BÁ THỰ</h4>

                    <div class="textwidget">
                        <p>Website : ledquangcao24h.com<br>
                            Điện thoại : 0964.388.040 - 0902.145.964
                            <br>
                            Email : advbathu@gmail.com<br>
                            Địa chỉ : 94 Phú Kiều, Kiều Mai, Bắc Từ Liêm - Hà Nội

                    </div>
                </div>
            </section>
            <section id="text-4" class="widget widget_text">
                <div class="widget-wrap">
                    <div class="textwidget">
                        <img style="border:2px solid #017AD7;position:fixed; bottom:0px; right:0px;" src="<?php echo base_url("upload/img/call/call_me.gif")?>" alt="Call: 0964.388.040" onclick="goog_report_conversion('tel:0964388040')">
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
</div>


</body></html>