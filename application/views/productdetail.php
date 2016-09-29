<section class="content main-product clearfix">
<div class="container sanpham">
<div class="row">
    <div class="col-left col-md-3 hidden-xs hidden-sm">
       <?php echo @$left;?>
    </div><!--end col-left-->

<div class="main-content col-md-9">
<input type="hidden" value="<?php echo @$cate_curent->category_id?>" class="current_category" />
    <div class="title_link">
        <a title="<?php echo @$this->option->site_name;?>" href="<?php echo base_url()?>">Trang chủ</a>
        <i  class="fa fa-angle-right"></i>
        <?php break_crum_product($cate_all,$pro_first->category_id); ?>
        <a href="javascript:void(0)"><?php echo $pro_first->name;?></a>
    </div>
<div class="box-detail">
    <div class="col-md-8 content-detail">
        <div class="row">
            <div class="box">
                <div class="item-preview">
                    <a  role="button" class="btn btn-icon screenshots litebox group1" style="background-color: #fff" href="<?php echo check_img($pro_first->image);?>">
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
            </div><!--end box-->
        </div>
    </div><!--end content-detail-->
    <div class="col-md-4 content-right">

        <div class="box">
            <div class="content-box">
                <p class="ma-so">Mã số: NTKT25</p>
                <p class="count">Giá: Liên hệ</p>
                <div class="clearfix"></div>
                <p style="color: red; margin-top: 10px;"><span style="font-size: 18px">Hotline : </span>
                    <span style="font-size: 15px;">0975 195 112   -  0904 931 933</span></p>
            </div>
        </div><!--end box-->
        <div class="box tinhnang">
            <div class="content-box content1">
                <div class="intro">
                    <strong>THANH TOÁN</strong>
                    <br>
                    <span>+ Lần 1: 50% sau khi ký hợp đồng.&nbsp;</span>
                    <br>
                    <span>+ Lần 2: 50% sau khi bàn giao website.</span>
                    <br>
                    <br>
                    <strong>QUÀ TẶNG</strong>
                    <br>
                    <span>+ Tư vấn miễn phí SEO website, nâng cao thứ hạng Web trên Google.</span>
                    <br>
                    <span>+ Tặng 1 tên miền .com trị giá 250.000 vnđ/1 năm.</span>
                    <br>
                    <span>+ Tặng 1 gói Hosting QTS-02 trị giá 756.000 vnđ/1 năm </span>
                    <em><a href="" title="" style="color:rgb(255, 0, 0)">(Xem bảng giá Hosting tại đây).</a> </em>
                    <br>
                    <br>
                    <strong>THỜI GIAN THỰC HIỆN</strong><br>
                    <span>+ 15 ngày sau khi ký hợp đồng.</span>
                    <br>
                    <br>
                    <strong>BẢO HÀNH</strong>
                    <br>
                    <span>+ Bảo hành website vĩnh viễn trong trường hợp khách hàng sử dụng tại QTS.</span>
                    <br>
                    <span>+ Hỗ trợ khách hàng miễn phí trong quá trình sử dụng website.</span>
                    <br>
                    <br>
                    <strong>BÀN GIAO</strong><br>
                    <span>+ Website hoàn chỉnh theo mẫu.</span><br>
                    <span>+ Admin quản trị website.</span><br>
                                         <span>+ Thông tin hướng dẫn quản trị website.<span><br>

                </div>
            </div><!--end content-box-->
        </div><!--end box-tinhnang-->
    </div>

</div><!--end box-title-->
<div class="clearfix"></div>
<div class="lien-ket col-md-12">
    <div class="row">
        <div class="content-lienket">
            <h4>Liên hệ tư vấn website</h4>
            <div class=" note_nv col-xs-12">
                <ul id="flexiselDemo7">
                    <?php foreach($memmer as $mb) : ?>
                        <li>
                            <div class="col-md-12 col-xs-12 col-sm-12 col-1">
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="img-cell1 col-md-4 col-xs-4 col-sm-4">
                                        <a href="javascript:void(0)" title="<?php echo @$mb->name;?>">
                                            <img src="<?php echo base_url($mb->image)?>" alt="<?php echo @$mb->name;?>">
                                        </a>
                                    </div>
                                    <div class="text-cell1 col-md-8 col-xs-8 col-sm-8">
                                        <p style="color:#0596c5; text-transform:uppercase;padding-bottom:7px">
                                            <?php echo @$mb->name;?>
                                        </p>
                                        <p class="phone">
                                            <i class="fa fa-phone"></i> <?php echo @$mb->phone;?>
                                        </p>
                                        <p class="phone">
                                            <i class="fa fa-envelope-o"></i><?php echo @$mb->phone;?>
                                        </p>
                                        <a href="" title="">
                                            <img src="<?php echo base_url()?>assets/css/img/sky.png" alt="" class="sky">
                                        </a>
                                    </div>
                                </div><!--end cell-->
                            </div>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div><!--end note-kh-->
        </div>


    </div>
</div><!--end lien-ket-->
<div class="clearfix"></div>
<div class="thong-tin lien-ket col-md-12">
    <div class="row">
        <div class="content-thongtin">
            <a href="" title="" class="btn btn-success">
                Hãy gửi thông tin cho chúng tôi. Để nhận giá ưu đãi nhất
            </a>
            <div class="box-tab" role="tabpanel">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Dành cho công ty / tổ chức</a></li>
                    <li><a data-toggle="tab" href="#menu1">Dành cho cá nhân / cửa hàng</a></li>

                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <form name="companycontact" method="post" id="companycontact"
                              action="<?php echo base_url('contact/companyContact')?>">
                            <div style="margin-top: 20px">
                                <div class="col-md-6 form-1">
                                    <p style="padding-bottom: 10px">Thông tin công ty / tổ chức</p>
                                    <div class="form-group">
                                        <input placeholder="Tên công ty / Tổ chức" class="form-control inp" type="text" name="companyname">
                                    </div>
                                    <div class="form-group">
                                        <input placeholder="Ngành nghề kinh doanh" type="text" class="form-control  inp" name="companytype">
                                    </div>
                                    <div class="form-group">
                                        <input placeholder="Địa chỉ" type="text" class="form-control  inp" name="companyaddress">
                                    </div>
                                    <div class="form-group">
                                        <input placeholder="Điện thoại" class="form-control  inp" type="text" size="30" name="companyphone">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control inp" name="companynamefax" placeholder="Fax">
                                    </div>
                                </div><!--end form-1-->
                                <div class="col-md-6 form-1">
                                    <p style="padding-bottom: 10px">Thông tin người phụ trách</p>
                                    <div class="form-group">
                                        <input placeholder="Họ và tên" class="form-control inp validate[required]" type="text"
                                               name="personname">
                                    </div>
                                    <div class="form-group">
                                        <input placeholder="Địa chỉ" type="text" class="form-control  inp"
                                               name="person_address">
                                    </div>
                                    <div class="form-group">
                                        <input placeholder="Điện thoại" type="text" class="form-control  inp validate[required,custom[phone]]"
                                               name="person_phone">
                                    </div>
                                    <div class="form-group">
                                        <input placeholder="Email" class="form-control  inp validate[required]" type="text" size="30"
                                               name="person_email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control inp" name="yahoo_skyle" placeholder="Nick yahoo/Skype">
                                    </div>
                                </div><!--end form-1-->
                            </div><!--end-->
                            <div style="text-align: center">
                                <input type="submit" value="Gửi liên hệ" name="ctlh" class="btn
                                                btn-info btn-sm">
                                <input type="reset" value="Nhập lại" class="btn btn-info btn-sm">
                            </div>
                        </form>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <form name="customercontact" id="customercontact" method="post"
                              action="<?php echo base_url('contact/customerContact')?>">
                            <div style="margin-top: 20px">

                                <div class="col-md-6 form-1">

                                    <div class="form-group">
                                        <input placeholder="Họ và tên" class="form-control inp validate[required]" type="text"
                                               name="cusnname">
                                    </div>
                                    <div class="form-group">
                                        <input placeholder="Địa chỉ" type="text" class="form-control  inp "
                                               name="cusaddress">
                                    </div>
                                    <div class="form-group">
                                        <input placeholder="Điện thoại" type="text" class="form-control  inp validate[required,custom[phone]]"
                                               name="cusphone">
                                    </div>
                                    <div class="form-group">
                                        <input placeholder="Email" class="form-control  inp validate[required,custom[email]]" type="text" size="30"
                                               name="cusemail">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control inp" name="companynamefax" placeholder="Nick yahoo/Skype">
                                    </div>
                                </div><!--end form-1-->
                                <div class="col-md-6 form-1">

                                    <div class="form-group">
                                        <textarea cols="40" rows="8" placeholder="Thông tin khác" name="otherprofile" class="form-control"></textarea>
                                    </div>

                                </div>
                                <div class="clearfix"></div>
                                <div style="text-align: center">
                                    <input type="submit" value="Gửi liên hệ" name="clh" class="btn
                                                btn-info btn-sm">
                                    <input type="reset" value="Nhập lại" class="btn btn-info btn-sm">
                                </div>
                            </div><!--end-->
                        </form>
                    </div>

                </div>
            </div><!--end box-tab-->
        </div><!--end content-thongtin-->
    </div>
</div>
<div class="clearfix"></div>
<?php if(count($product_similar)) : ?>
    <div class="website lien-ket col-md-12">
        <div class="row">
            <div class="box-web">
                <h4>Website liên quan</h4>
                <?php foreach($product_similar as $ps) : ?>
                    <div class="item_sp sp1 col-md-3 col-sm-3 col-xs-6">
                        <div class="item-flow">
                            <a href="<?php echo base_url('san-pham/'.$ps->alias)?>" title="<?php echo @$ps->pro_name?>">
                                <img src="<?php echo base_url($ps->pro_image)?>" alt="<?php echo @$ps->pro_name?>">
                            </a>
                        </div>
                        <div class="text-img">
                            <p>
                                <?php echo @$ps->code;?>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="price">
                            <p>Giá: liên hệ</p>
                            <a href="<?php echo base_url('san-pham/'.$ps->alias)?>" title="<?php echo @$ps->pro_name?>">
                                Xem chi tiết
                            </a>
                        </div>
                    </div><!--end item-sp-->
                <?php endforeach;?>
            </div>
        </div>
    </div>
<?php endif;?>
</div><!--end main-content-->

</div><!--end row-->
</div><!--end container-->
</section><!--end content-->
<script type="text/javascript">

    $(window).load(function() {
          var id_current_cate = $(".current_category").val();
        $(".danh-muc ul li.item[data-id-parent='"+id_current_cate+"']").addClass("active");

        $(".danh-muc ul li.item").hover(function(){
            $(".danh-muc ul li.item").removeClass("active");
        },function(){
            $(".danh-muc ul li.item[data-id-parent='"+id_current_cate+"']").addClass("active");            
        });
        
        $("#flexiselDemo7").flexisel({
            visibleItems: 3,
            animationSpeed: 1000,
            autoPlay: true,
            autoPlaySpeed: 3000,
            pauseOnHover: true,
            enableResponsiveBreakpoints: true,
            responsiveBreakpoints: {
                portrait: {
                    changePoint:480,
                    visibleItems: 1
                },
                landscape: {
                    changePoint:640,
                    visibleItems: 1
                },
                tablet: {
                    changePoint:768,
                    visibleItems: 2
                }
            }
        });

    });
</script>
<link href="<?php echo  base_url('assets/plugin/colorbox/colorbox.css') ?>" rel="stylesheet" media="all"/>
<script src="<?php echo  base_url('assets/plugin/colorbox/jquery.colorbox.js');?>"></script>
<script>
    $(".group1").colorbox({rel:'group1'});
</script>
<script src="<?php echo base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine.js') ?>"></script>
<script src="<?php echo base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine-en.js') ?>"></script>
<link href="<?php echo base_url('assets/plugin/ValidationEngine/style/validationEngine.jquery.css') ?>" rel="stylesheet"/>
<script>
    $(document).ready(function(){
        $("#companycontact").validationEngine();
        $("#customercontact").validationEngine();
    });
</script>