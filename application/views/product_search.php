<link href="<?php echo base_url()?>assets/css/front_end/slide-banner.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url()?>assets/js/front_end/slider/jssor.core.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/front_end/slider/jssor.slider.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/front_end/slider/jssor.utils.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/front_end/slider/slide-banner.js"></script>
<section class="content main-product clearfix">
    <div class="container sanpham">
        <div class="row">
            <div class="col-left col-md-3 hidden-xs hidden-sm">
                <?php echo @$left;?>
            </div><!--end col-left-->
            <div class="main-content col-md-9">
                <div class="title-content">
                    <a href="javascript:void(0)" title="<?php echo @$cate_curent->name;?>">
                        Kết quả tìm kiếm
                    </a>
                </div><!--end title-content-->
                <div class="slide">
                    <div id="slider2_container"
                         style="position: relative; top: 0px; left: 0px; width: 1004px; height: 230px; overflow: hidden;
                      margin:0 auto; padding:0 auto">

                        <!-- Loading Screen -->
                        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                            </div>
                            <div style="position: absolute; display: block; background: url(img/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
                            </div>
                        </div>

                        <!-- Slides Container -->

                        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1004px; height: 230px; overflow: hidden;">
                            <div>

                                <img u="image" src="<?php echo base_url()?>assets/css/img/slide.png"/>
                            </div>
                            <div>
                                <img u="image" src="<?php echo base_url()?>assets/css/img/bgr_online.png"/>
                            </div>
                        </div>
                    </div>
                    <div u="navigator" class="jssorb05" style="position: absolute; bottom: 16px; right: 6px;">
                        <div u="prototype" style="POSITION: absolute; WIDTH: 16px; HEIGHT: 16px;"></div>
                    </div>
                    <span u="arrowleft" class="jssora12l" style="width: 30px; height: 46px; top: 163px; left: 0px;">
                    </span>
                    <!-- Arrow Right -->
                    <span u="arrowright" class="jssora12r" style="width: 30px; height: 46px; top: 163px; right: 0px">
                    </span>
                </div><!--end slide-->
                <div class="clearfix"></div>
                <div class="box-pro row">
                    <?php foreach($lists as $list) : ?>
                        <div class="item_sp col-md-3 col-sm-3 col-xs-6">
                            <div class="item-flow">
                                <a href="<?php echo base_url('san-pham/'.@$list->pro_alias)?>" title="<?php echo @$list->code?>">
                                    <img src="<?php echo base_url(@$list->pro_img)?>" alt="<?php echo @$list->code?>">
                                </a>
                            </div>
                            <div class="text-img">
                                <p>
                                    <?php echo @$list->code?>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="price">
                                <p>Giá: liên hệ</p>
                                <a href="<?php echo base_url('san-pham/'.@$list->pro_alias)?>" title="<?php echo @$list->code?>">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div><!--end item-sp-->
                    <?php endforeach;?>
                </div><!--end box-pro-->
                <div class="clearfix"></div>
            </div><!--end main-content-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end content-->
<script type="text/javascript">

    $(window).load(function() {

        $("#flexiselDemo3").flexisel({
            visibleItems: 4,
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
                    visibleItems: 2
                },
                tablet: {
                    changePoint:768,
                    visibleItems: 3
                }
            }
        });

    });
</script>