<section class="content main-product clearfix">
<div class="container sanpham">
<div class="row">
<div class="col-left col-md-3 hidden-xs hidden-sm">
    <?php echo @$left;?>
</div><!--end col-left-->
<div class="main-content col-md-9">
    <input type="hidden" value="<?php echo @$cate_curent->id?>" class="current_category" />
    <div class="title_link">
        <a title="<?php echo @$this->option->site_name;?>" href="<?php echo base_url()?>">Trang chủ</a>
        <i  class="fa fa-angle-right"></i>
        <a href="javascript:void(0)" title="<?php echo @$cate_curent->name?>"><?php echo @$cate_curent->name?></a>
    </div>
<div class="box">
    <div class="content-box cate-content hideContent">
        <?php echo @$cate_curent->content;?>
    </div>
    <div class="show-more">
        <a href="javascript:void(0)">
            Show more
        </a>
    </div>
</div>
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
<?php if(count($pro_focus)) : ?>
    <div class="sp_noibat">
        <div class="title_noibat col-md-12 col-sm-12">
            <div class="col-md-3 col-sm-3 text_noibat">
                <h4>Mẫu sản phẩm nổi bật</h4>
            </div>
            <div class="line_title col-md-9 col-sm-9 hidden-xs">
                <span class="line line-1"></span>
                <span class="line line-2"></span>
                <span class="line line-3"></span>
            </div>
        </div><!--end title-->
        <div class="col-md-12">
            <div class="row">
                <div class="sp_noibat clearfix"><?php /*echo "<pre>";var_dump($pro_focus);die();*/?>
                    <ul id="flexiselDemo3">
                        <?php foreach($pro_focus as $focus) : ?>
                            <li>
                                <div class="item_sli">
                                    <a href="<?php echo base_url('san-pham/'.@$focus->alias)?>" title="<?php echo @$focus->code;?>">
                                        <img src="<?php echo base_url(@$focus->image);?>" alt="<?php echo @$focus->code;?>">
                                    </a>
                                    <div class="text-img text-sli">
                                        <p>
                                            <?php echo @$focus->code;?>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="price price-sli">
                                        <p>Giá: liên hệ</p>
                                        <a href="<?php echo base_url('san-pham/'.@$focus->alias)?>" title="<?php echo @$focus->code;?>">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div><!--end item-sp-->
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    </div><!--end sp_noibat-->
<?php endif;?>
</div><!--end main-content-->
</div><!--end row-->
</div><!--end container-->
</section><!--end content-->

<script>
    $(document).ready(function(){
        var id_current_cate = $(".current_category").val();
        $(".danh-muc ul li.item[data-id-parent='"+id_current_cate+"']").addClass("active");

        $(".danh-muc ul li.item").hover(function(){
            $(".danh-muc ul li.item").removeClass("active");
        },function(){
            $(".danh-muc ul li.item[data-id-parent='"+id_current_cate+"']").addClass("active");            
        });
        $(".show-more a").click(function(){
            var $this = $(this);
            var $content = $this.parent().prev("div.cate-content");
            var linkText = $this.text().toUpperCase();
            if(linkText === "SHOW MORE"){
                linkText = "Close";
                $content.switchClass("hideContent", "showContent", 400);
            } else {
                linkText = "Show more";
                $content.switchClass("showContent", "hideContent", 400);
            }
            $this.text(linkText);
        })
    })
</script>

<link href="<?php echo base_url()?>assets/css/front_end/slide-banner.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url()?>assets/js/front_end/slider/jssor.core.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/front_end/slider/jssor.slider.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/front_end/slider/jssor.utils.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/front_end/slider/slide-banner.js"></script>
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
<script type="text/javascript" src="<?php echo base_url()?>assets/plugin/ui/jquery-ui.js"></script>