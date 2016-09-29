<script type="text/javascript" src="<?php echo base_url()?>/assets/js/slider/slider2.js"></script>
<div id="container" class="hidden-xs hidden-sm">
<div class="swap-content detail-wp">
<script>
    var cate_id = 8;
</script>

<div class="swap-content">
<div class="top-content">
    <div class="breadcrumb_detail clearfix">
        <a style=" color: #a599a5;" href="<?php echo base_url()?>">Trang chủ</a>
        <i style="font-size: 18px;" class="fa fa-angle-right"></i>
        <?php break_crum_product($cate_all,$pro_first->category_id); ?>
        <a href="#"><?php echo $pro_first->name;?></a>
    </div>
    <!-- <div class="login_box small-b util-clearfix" style="margin-top:6px">
            </div> -->
</div>
<!-- left col -->

<!--<link href="css/style_litebox.css" rel="stylesheet"/>-->
<div class="left-col detail-left-col ">
<div class="container-fluid">
<div class="row">
<div class="col-md-8 content-left">
<div class="row">
<div class="box">
    <div class="item-preview">
        <a  role="button" class="btn btn-icon screenshots" style="background-color: #fff">
            <img src="<?php echo check_img($pro_first->image);?>" alt="<?php echo @$pro_first->name;?>" style="width: 100% !important">
        </a>
        <div class="item-preview-action clearfix">
            <div class="live-pre-bt">
                <!--<a target="_blank" role="button" class="btn btn-icon screenshots">-->
                <?php if(!empty($pro_first->caption_1)) : ?>
                    <a href="<?php echo @$pro_first->caption_1;?>" target="_blank" class="btn btn-icon" >
                        Xem link web
                    </a>
                <?php else : ?>
                    <a  class="btn btn-icon" >
                        Xem link web
                    </a>
                <?php endif;?>
                <a  role="button" class="btn btn-icon screenshots">
                    Xem ảnh
                    <i style="padding-left: 10px;"  class="fa fa-picture-o"></i>
                </a>
            </div>
            <div class="item-preview__preview-buttons--social item-social" data-view="socialButtons">
                <div class="btn-group">
                    <div class="btn btn--label btn--group-item">Chia sẻ</div>
                    <a class="btn btn--group-item" data-social-network-link="" href="https://www.facebook.com/sharer/sharer.php?display=popup&amp;u=<?php echo current_url()?>" target="_blank"><i class="e-icon -icon-facebook fa fa-facebook"></i></a>
                    <a class="btn btn--group-item" data-social-network-link="" href="https://plus.google.com/share?url=<?php echo current_url()?>"><i class="e-icon -icon-google-plus fa fa-google-plus"></i></a>
                    <a class="btn btn--group-item" data-social-network-link="" href="https://twitter.com/intent/tweet?text=<?php echo $pro_first->name;?>&amp;url=<?php echo current_url()?>"><i class="e-icon -icon-twitter fa fa-twitter"></i></a>
                    <a class="btn btn--group-item" data-social-network-link="" href="http://pinterest.com/pin/create/button?description=<?php echo $pro_first->name;?>&amp;media=<?php echo $pro_first->image;?>&amp;url=<?php echo current_url()?>"><i class="e-icon -icon-pinterest fa fa-pinterest-p"></i></a>
                </div>
            </div>
        </div>
        <div class="no-display">
            <?php foreach($pimages as $img) :?>
                <a href="<?php echo check_img($img->link)?>" target="_self" class="inline-block litebox"
                   data-litebox-group="group-1" data-litebox-text="<?php echo @$img->title;?>">
                    <img src="<?php echo check_img($img->link)?>" class="inline-block" alt="<?php echo @$img->title?>"/>
                </a>
            <?php endforeach;?>
            <!--<a href="<?/*=check_img($pro_first->image)*/?>" target="_self" class="inline-block litebox"
                       data-litebox-group="group-1" data-litebox-text="This is a caption">
                        <img src="<?/*=check_img($pro_first->image)*/?>" class="inline-block"/>
                    </a>-->
        </div>
        <!----------video------------>
        <!--<div class="no-display">
            <a href="https://www.youtube.com/watch?v=gOLY7bjCTTE" target="_self" class="button litebox" data-litebox-group="group-2">YouTube</a>
        </div>-->
        <!--endvideo----------------->
        <?php if($pro_first->coupon == 1) : ?>
            <div class="discount-tag">-50%</div>
        <?php endif;?>
    </div>
</div>
<!--end .box-->
<!------------tu van online--------->
<div class="content-left-pos">
    <section id="da_noibat" class="relate-pro clearfix">
        <h4 class="text-left">Liên hệ tư vấn website</h4>
        <script>
            $(function () {
                var lenObj = $('#top-slider-lists').children().length;
                if (lenObj > 1) {
                    $('#top-slider-lists').owlCarousel({
                        loop: true,
                        margin: 0,
                        lazyLoad: true,
                        autoplay: true,
                        autoplayHoverPause: true,
                        nav: true,
                        dots: false,
                        items: 3,
                        stagePadding: 0,
                        responsiveClass: true,
                        responsive: {
                            1024: {items: 3},
                            1280: {items: 3},
                            1366: {items: 3}
                        }
                    });
                }
            });

        </script>
        <div class="slide-top-category slide-detail-category">
            <div id="top-slider-lists" class="owl-carousel owl-theme block-hotro">
                <?php foreach($memmer as $mem) : ?>
                    <div class="slider-category-block item hotro">
                        <img src="<?php echo base_url($mem->image)?>" title="<?php echo $mem->name;?>" width="103"
                             height="103">
                        <div class="member_name">
                            <?php echo $mem->name;?>
                        </div>
                        <div class="bgphone">
                            <!--<img src="<?/*=base_url('assets/img/phone.png')*/?>" width="20px" height="20px">-->
                            <span>Tư vấn viên - </span>
                                        <span class="numberphone">
                                            <?php echo $mem->phone;?>
                                        </span>
                        </div>
                        <div class="bgnick">
                            <a href="skype:<?php echo @$mem->skype;?>?chat"><img src="<?php echo base_url
                                ('assets/img/skype2.png')?>" width="60px" height="30px"></a>
                        </div>
                        <div class="bgmail">
                            <img src="<?php echo base_url('assets/img/gm.png')?>" width="20px" height="20px">
                                        <span class="mailname">
                                            <?php echo $mem->email;?>
                                        </span>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>
</div>
<!------------End tu van online ----->
<!------------Form lien he------------>
<!------------tu van online--------->
<div class="content-left-pos">
    <!--<div class="content-left-text">
                <?/*=$pro_first->detail;*/?>
            </div>-->

    <section id="da_noibat" class="relate-pro clearfix">
        <button  type="button" class="btn btn-success" data-toggle="modal" data-target="#addcart_bt">
            <i class="fa fa-sticky-note-o" style="font-size: 22px"></i>
            Hãy gửi thông tin cho chúng tôi . Để nhận giá ưu đãi nhất
        </button>
        <!--<h5 class="text-left">
            Bạn vui lòng điền thông tin theo 1 trong 2 mẫu dưới đây để liên hệ mua website với chúng tôi.
        </h5>-->
        <div class="content sp_tieubieu clearfix">
            <div class="box_products util-clearfix">
                <div class="responsive_box_product">
                    <div role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab"
                                                                      data-toggle="tab">Dành cho công ty / Tổ chức</a></li>
                            <li role="presentation">
                                <a href="#videotab" aria-controls="videotab" role="tab" data-toggle="tab">
                                    Dành cho cá nhân / cửa hàng</a></li>
                        </ul>

                        <!-- Tab panes -->

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="profile">
                                <form name="companycontact" id="companycontact" method="post"
                                      action="<?php echo base_url
                                      ('contact/companyContact')?>">
                                    <div style="margin-top: 25px">
                                        <div class="col-md-6">
                                            <div class="form-head">Thông tin công ty / tổ chức</div>
                                            <div class="form-group">
                                                <input placeholder="Tên công ty / Tổ chức"  class="form-control" type="text"
                                                       name="companyname" />
                                            </div>
                                            <div class="form-group">
                                                <input placeholder="Ngành nghề kinh doanh" type="text" class="form-control"
                                                       name="companytype"  />
                                            </div>
                                            <div class="form-group">
                                                <input placeholder="Địa chỉ" type="text" class="form-control"
                                                       name="companyaddress"  />
                                            </div>
                                            <div class="form-group">
                                                <input placeholder="Điện thoại" class="form-control" type="text" size="30"
                                                       name="companyphone" />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="companynamefax"
                                                       placeholder="Fax" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-head">Thông tin người phụ trách</div>
                                            <div class="form-group">
                                                <input type="text" class="form-control validate[required]" name="personname"
                                                       placeholder="Họ và tên"/>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="person_address"
                                                       placeholder="Địa chỉ" />
                                            </div>
                                            <div class="form-group">
                                                <input placeholder="Điện thoại" type="text" class="form-control validate[required,custom[phone]]"
                                                       name="person_phone" />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control validate[required]" name="person_email"
                                                       placeholder="Email" />
                                            </div>
                                            <div class="form-group">
                                                <input placeholder="Nick yahoo/skype"  type="text" class="form-control"
                                                       name="yahoo_skyle"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div style="text-align: center">
                                        <input type="submit" value="Gửi liên hệ" name="ctlh" class="btn
                                                btn-info btn-sm"/>
                                        <input type="reset" value="Nhập lại" class="btn btn-info btn-sm" />
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="videotab">
                                <form name="customercontact" id="customercontact" method="post"
                                      action="<?php echo base_url('contact/customerContact')?>" >
                                    <div style="margin-top: 20px">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input placeholder="Họ và tên" type="text" class="form-control validate[required]"
                                                       size="30"
                                                       name="cusnname" />
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="text" size="30"
                                                       name="cusaddress"
                                                       placeholder="Địa chỉ"
                                                    />
                                            </div>
                                            <div class="form-group">
                                                <input placeholder="Điệnthoại" type="text" size="30" name="cusphone"
                                                       class="form-control validate[required,custom[phone]]"/>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" size="30" name="cusemail" placeholder="Email"
                                                       class="form-control validate[required]"/>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" size="30" name="cusyahoo" placeholder="Nick yahoo/skype"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <textarea cols="40" rows="8" placeholder="Thông tin khác"
                                                          name="otherprofile" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div style="text-align: center">
                                        <input type="submit" value="Gửi liên hệ" name="clh" class="btn
                                                btn-info btn-sm"/>
                                        <input type="reset" value="Nhập lại" class="btn btn-info btn-sm" />
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!------------End tu van online ----->
<!------------end form lien he--------->
<!----------San pham lien quan------->
<div class="content-left-pos">
    <!--<div class="content-left-text">
                <?/*=$pro_first->detail;*/?>
            </div>-->
    <section id="da_noibat" class="relate-pro clearfix">
        <h4 class="text-left">Website liên quan</h4>
        <div class="content sp_tieubieu clearfix">
            <div class="box_products util-clearfix">
                <div class="responsive_box_product">
                    <?php foreach($product_similar as $list) : ?>
                        <input type='hidden' name='etx_info[]' value='<?php echo @$list->id?>'/>
                        <div class="col-md-4 box_product">
                            <div class="content_item content_item_hover">
                                <div class="overflow_box">
                                    <div class="box-go">
                                        <!--<span onclick="wl_modal_click(this,<?/*=@$list->id;*/?>, '<?/*=@$list->pro_name;*/?>', '<?/*=base_url(@$list->pro_img)*/?>', '<?/*=base_url(@$list->pro_alias)*/?>')"
                              title="Yêu thích"><svg class="icon-favorite2">
                                <use xlink:href="#icon-favorite2"></use>
                            </svg>
                        </span>-->
                                    </div>
                                    <a class="imgtodrag img_product" title="<?php echo @$list->pro_name;?>"
                                       href="<?php echo base_url('san-pham/'.@$list->pro_alias);?>">
                                        <img class="lazy"  data-original="<?php echo base_url(@$list->pro_image);?>"
                                             src="<?php echo @$list->pro_image;?>"
                                             width="200" height="200" alt="<?php echo @$list->pro_name;?>"/></a>

                                    <div class="price-box">
                                        <?php /*if($list->price_sale > 0) : */?><!--
                                                    <span class="current_price"><?/*=number_format(@$list->price_sale);*/?>&nbsp;VNĐ</span>
                                                <?php /*endif;*/?>
                                                <?php /*if($list->pro_price > 0) :*/?>
                                                    <span class="old_price"><?/*=number_format(@$list->pro_price);*/?> &nbsp;VNĐ</span>
                                                --><?php /*endif;*/?>
                                        <span class="current_price">Giá : Liên hệ</span>
                                    </div>
                                    <!--icon shop tu thien-->
                                    <!--  <div class="ic-event-eldy-listing" title="Ủng hộ 5,000 đồng vào chương trình từ thiện Em là để yêu khi mua sản phẩm này.">&nbsp;</div> -->
                                    <?php /*if(($list->price_sale > 0)&&($list->pro_price > 0)) :*/?><!--
                                            <div class="discount-tag">-<?/*=@$list->pro_price==0?0:floor(100-(@$list->price_sale/@$list->pro_price)*100)*/?>%</div>
                                            --><?php /*endif;*/?>
                                    <?php if($list->coupon == 1) : ?>
                                        <div class="discount-tag">-50%</div>
                                    <?php endif;?>
                                    <div>
                                        <a class="name_product fullname" title="<?php echo @$list->pro_name;?>"
                                           href="<?php echo base_url('san-pham/'.@$list->pro_alias);?>">
                                            <?php echo @$list->code;?>
                                        </a>
                                    </div>
                                    <div class="social_box">
                                    </div>
                                    <div class="fee-ship">
                                        <span data-original-title="Miễn phí vận chuyển" class="ic-fee-ship tool-tip" title=""> </span>
                                    </div>
                                    <div class="cls"></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </section>
</div>

</div>
</div>
<div class="col-md-4 content-right">
<div class="row">
<div class="box">
    <div class="content-box">
        <div class="purchase-form__selection">
            <span class="pro_detail_title">
                 <input class="js-purchase-default-license is-active" data-license="regular" id="license" name="license" type="hidden" value="regular">
                <b>Mã số : <?php echo $pro_first->code;?></b>
            </span>
            <div class="purchase-form__price">
                <br/>
                <!--<span>Giá :</span>
                <span style="color: red">
                <?php /*if(!empty($pro_first->price_sale)) :*/?>
                    <?/*=number_format($pro_first->price_sale)*/?>
                <?php /*else : */?>
                    <?/*=number_format($pro_first->price)*/?>
                <?php /*endif;*/?>
                vnđ-->
            </div>
            <span style="color:red;font-weight: bold">Giá : Liên hệ</span>
        </div>
        <!--<div class="purchase-form__info">
            <p class="t-body -size-m">
                <?/*=LimitString($pro_first->description,250,'...')*/?>
            </p>
        </div>-->
        <div class="purchase-bt">
            <b style="color: red"><span style="font-size: 20px">Hotline :</span>
                <span style="font-size: 16px">0975 195 112  -  0904 931 933</span>
            </b>
            <!--<button onclick="add_cart(<?/*=$pro_first->id;*/?>)" type="button" class="btn btn-success" data-toggle="modal" data-target="#addcart_bt">
                <i class="fa fa-shopping-cart"></i>
                Thêm vào giỏ hàng
            </button>-->
            <!--<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#muangay_bt"><i class="fa fa-check-square-o" ></i> &nbsp; Mua ngay</button>-->
            <div class="modal fade pp-shopping-cart" id="addcart_bt" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</h4>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-1">
                                <i style="color: green;zoom: 2;" class="fa fa-check-square"></i>
                            </div>
                            <div class="col-md-2">
                                <img src="<?php echo base_url($pro_first->image)?>" title="<?php echo $pro_first->name;?>">
                            </div>
                            <div class="col-md-9 text-left">
                                <a href="#"><strong><?php echo $pro_first->name?></strong></a> đã được thêm vào hàng
                                <br>Hiện đang có <span  style="color: #e5101d;" class="cart_qty"><?php echo $this->count_cart;?></span> sản phẩm trong giỏ hàng
                            </div>
                        </div>
                        <div class="row text-center addcart_fw">
                            <a href="<?php echo base_url()?>" type="button" class="btn btn-success">Tiếp tục mua hàng</a> &nbsp;
                            <a href="#" type="button" class="btn btn-warning" data-toggle="modal" data-target="#shoppingcartmodal">Xem giỏ hàng</a>
                        </div>

                    </div>
                    <!--<ul>-->
                    <!--<li><i style="color: green;" class="fa fa-check-square"></i></li>-->
                    <!--<li>-->
                    <!---->
                    <!--</li>-->
                    <!--<li>-->
                    <!---->
                    <!--</li>-->
                    <!--</ul>-->


                    <div class="pro-cart">
                    </div>

                </div>

            </div>
            <!--end #addcart_bt-->


            <div class="modal fade pp-shopping-cart" id="muangay_bt" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Mua sản phẩm này</h4>
                </div>
                <!-- <div class="modal-dialog">     -->
                <!-- <div class="modal-content"> -->
                <div class="modal-body">
                    <form name="form1" method="post" action="">
                        <div class="modal-body">

                            <div class="row row-cell">
                                <div class="col-xs-3  text-left">
                                    <label for="count" class="control-label">Số lượng</label>
                                </div>
                                <div class="col-xs-5 col-md-3">
                                    <input type="number" class="form-control soluong" id="count" name="soluong" value="1">
                                </div>
                            </div>

                            <div class="row row-cell">
                                <div class="col-xs-3  text-left">
                                    <label for="tongtien" class="control-label" id="thanhtien">Thành tiền</label>
                                </div>
                                <div class="col-xs-6 gia text-left">
                                    <span id="tongtien"> </span> &nbsp VNĐ
                                </div>
                            </div>

                            <div class="row row-cell">
                                <div class="col-xs-3  text-left">
                                    <label for="full_name" class="control-label">Họ và tên</label>
                                </div>
                                <div class="col-md-6 col-xs-9">
                                    <input type="text" class="form-control" name="full_name" value="">
                                </div>
                            </div>


                            <div class="row row-cell">
                                <div class="col-xs-3  text-left">
                                    <label for="dienthoai" class="control-label">Điện thoại &nbsp<span style="color:red;
                                    "><sup>*</sup></span></label>
                                </div>
                                <div class="col-md-6 col-xs-9">
                                    <input type="text" class="form-control" name="dienthoai" value="">
                                </div>
                            </div>


                            <div class="row row-cell">
                                <div class="col-xs-3  text-left">
                                    <label for="email" class="control-label">Email &nbsp<span style="color:red;"><sup>*</sup></span></label>
                                </div>
                                <div class="col-xs-6">
                                    <input type="text" class="form-control" name="email" value="">
                                </div>
                            </div>


                            <div class="row row-cell">
                                <div class="col-xs-3  text-left">
                                    <label for="diachi" class="control-label">Địa chỉ</label>
                                </div>
                                <div class="col-md-6 col-xs-9">
                                    <textarea class="form-control" name="diachi"  value=""></textarea>
                                </div>
                            </div>

                            <div class="row row-cell">
                                <div class="col-xs-3  text-left">
                                    <label for="ghichu" class="control-label">Ghi chú</label>
                                </div>
                                <div class="col-md-6 col-xs-9">
                                    <textarea class="form-control" name="ghichu"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"  name="Thanhtoan">Gửi</button>
                            <button type="reset" class="btn btn-default">Reset</button>

                        </div>

                    </form>

                </div>
                <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
<div class="box tinhnang">
    <div class="content-box">
        <div class="purchase-form__selection">
            <div style="text-align: justify;"><strong>THANH TOÁN</strong><br>
                <span style="color:rgb(102, 102, 102); font-family:arial,helvetica,sans-serif; font-size:14px">+ Lần 1: 50% sau khi ký hợp đồng.&nbsp;</span><br>
                <span style="color:rgb(102, 102, 102); font-family:arial,helvetica,sans-serif; font-size:14px">+ Lần 2: 50% sau khi bàn giao website.</span><br>
                <br>
                <strong>QUÀ TẶNG</strong><br>
                <span style="color:rgb(102, 102, 102); font-family:arial,helvetica,sans-serif; font-size:14px">+ Tư vấn miễn phí SEO website, nâng cao thứ hạng Web trên Google.&nbsp;</span><br>
                <span style="color:rgb(102, 102, 102); font-family:arial,helvetica,sans-serif; font-size:14px">+ Tặng 1 tên miền .com trị giá 250.000 vnđ/1 năm.&nbsp;</span><br>
                <span style="color:rgb(102, 102, 102); font-family:arial,helvetica,sans-serif; font-size:14px">+ Tặng 1 gói Hosting QTS-02 trị giá 756.000 vnđ/1 năm (</span><em><a href="http://giaodiendep.vn/page/hosting/" style="box-sizing: border-box; padding: 0px; margin: 0px; text-decoration: none; color: rgb(51, 51, 51); border: 0px; cursor: pointer; background-color: transparent;"><span style="color:rgb(255, 0, 0)">Xem bảng giá Hosting tại đây</span></a></em><span style="color:rgb(102, 102, 102); font-family:arial,helvetica,sans-serif; font-size:14px">).</span><br>
                <br>
                <strong>THỜI GIAN THỰC HIỆN</strong><br>
                <span style="color:rgb(102, 102, 102); font-family:arial,helvetica,sans-serif; font-size:14px">+ 15&nbsp;ngày sau khi ký hợp đồng.</span><br>
                <br>
                <strong>BẢO HÀNH</strong><br>
                <span style="color:rgb(102, 102, 102); font-family:arial,helvetica,sans-serif; font-size:14px">+ Bảo hành website vĩnh viễn trong trường hợp khách hàng sử dụng tại QTS.&nbsp;</span><br>
                <span style="color:rgb(102, 102, 102); font-family:arial,helvetica,sans-serif; font-size:14px">+ Hỗ trợ khách hàng miễn phí trong quá trình sử dụng website.</span><br>
                <br>
                <strong>BÀN GIAO</strong><br>
                <span style="color:rgb(102, 102, 102); font-family:arial,helvetica,sans-serif; font-size:14px">+ Website hoàn chỉnh theo mẫu.&nbsp;</span><br>
                <span style="color:rgb(102, 102, 102); font-family:arial,helvetica,sans-serif; font-size:14px">+ Admin quản trị website.&nbsp;</span><br>
                <span style="color:rgb(102, 102, 102); font-family:arial,helvetica,sans-serif; font-size:14px">+ Thông tin hướng dẫn quản trị website.</span></div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

<script src="<?php echo base_url()?>/assets/js/litebox/jquery-ui.min.js"></script>
<script src="<?php echo base_url()?>/assets/js/litebox/images-loaded.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>/assets/js/litebox/litebox.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $('.litebox').liteBox();
    $('.screenshots').on('click',function(){
        $('.litebox:first-child').click();
    });
    $('.liteboxs').liteBox();
</script>
</div>

<script type="text/javascript">
    $(function(){
        $('.litebox-container').slimScroll();
    });
</script>
<script src="<?php echo base_url('assets/js/jquery.validationEngine.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.validationEngine-en.js') ?>"></script>
<link href="<?php echo base_url('assets/css/validationEngine.jquery.css') ?>" rel="stylesheet"/>
<script>
    $(document).ready(function(){
        $("#companycontact").validationEngine();
        $("#customercontact").validationEngine();
    });
</script>