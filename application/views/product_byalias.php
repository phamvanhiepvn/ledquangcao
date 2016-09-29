<div id="container" class="hidden-xs hidden-sm">
    <div class="swap-content">
        <script>
            var cate_id = 8;
        </script>

        <div class="swap-content ">
            <div class="top-content">
                <div class="breadcrumb_detail util-clearfix" xmlns:v="http://rdf.data-vocabulary.org/#" itemprop="breadcrumb">
                    <div class="br first" typeof="v:Breadcrumb">
                        <a title="Sendo" href="<?php echo base_url();?>" rel="v:url" property="v:title">Trang chủ</a></div>
                    <div class="br end link" typeof="v:Breadcrumb">
                        <a href="#">
                            <?php echo @$cate;?>
                        </a>
                    </div>
                </div>
                <!-- <div class="login_box small-b util-clearfix" style="margin-top:6px">
                        </div> -->
            </div>
            <!-- left col -->
            <div class="left-col">
                <!-- promotion -->
                <!-- block hot product -->
                <div class="block_cat_home woman">
                    <div class="title_extra_menu">
                        <h3><?php echo @$cate;?></h3>
                        <div class="extra_menu">

                        </div>
                    </div>
                    <div class="box_products util-clearfix">
                        <div class="responsive_box_product">
                            <?php foreach($lists as $list) : ?>
                                <input type='hidden' name='etx_info[]' value='<?php echo $list->id?>'/>
                                <div class="box_product _<?php echo $list->id?> ">
                                    <div class="content_item content_item_hover">
                                        <div class="overflow_box">
                                            <div class="box-go">
                                                <!--<span onclick="wl_modal_click(this,<?/*=$list->id;*/?>, '<?/*=$list->pro_name;*/?>', '<?/*=base_url($list->pro_img)*/?>', '<?/*=base_url($list->pro_alias)*/?>')"
                                  title="Yêu thích"><svg class="icon-favorite2">
                                    <use xlink:href="#icon-favorite2"></use>
                                </svg>
                            </span>-->
                                                <!---<span data-target="#quickview" data-toggle="modal" class="quick-view" rel="<?php echo $list->id;?>"
                                                   title="Xem nhanh"><svg class="icon icon-iconview">
                                            <use xlink:href="#icon-iconview"></use>
                            </svg></span>--->
                                            </div>
                                            <a class="imgtodrag img_product" title="<?php echo $list->pro_name;?>"
                                               href="<?php echo base_url('san-pham/'.$list->pro_alias);?>">
                                                <img class="lazy"  data-original="<?php echo base_url($list->pro_img);?>"
                                                     src="<?php echo $list->pro_img;?>"
                                                     width="200" height="200" alt="<?php echo $list->pro_name;?>"/></a>

                                            <div class="price-box">
                                                <?php /*if($list->pro_price_sale > 0) :*/?><!--
                                                    <span class="current_price"><?/*=number_format($list->pro_price_sale);*/?>&nbsp;
                                            VNĐ</span>
                                                <?php /*endif;*/?>
                                                <?php /*if($list->pro_price > 0) :*/?>
                                                    <span class="old_price"><?/*=number_format($list->pro_price);*/?> &nbsp;VNĐ</span>
                                                --><?php /*endif;*/?>
                                                <span class="current_price">Giá : Liên hệ</span>
                                            </div>
                                            <!--icon shop tu thien-->
                                            <!--  <div class="ic-event-eldy-listing" title="Ủng hộ 5,000 đồng vào chương trình từ thiện Em là để yêu khi mua sản phẩm này.">&nbsp;</div> -->
                                            <?php if($list->pro_price > 0 && $list->pro_price_sale > 0) :?>
                                                <div class="discount-tag">-<?php echo $list->pro_price==0?0:floor(100-($list->pro_price_sale/$list->pro_price)*100)?>%</div>
                                            <?php endif;?>
                                            <div>
                                                <!--<a class="name_product fullname" title="<?/*=$list->pro_name;*/?>"
                                        href="<?/*=base_url($list->pro_alias);*/?>">
                                        <?/*=$list->pro_name;*/?>
                                    </a>-->
                                                <a class="name_product fullname" title="<?php echo $list->code;?>"
                                                   href="<?php echo base_url('san-pham/'.$list->pro_alias);?>">
                                                    <?php echo $list->code;?>
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
                    <div class="clearfix"></div>
                    <div class="pagination">
                        <?php
                        echo $this->pagination->create_links(); // tạo link phân trang
                        ?>
                    </div>
                </div>

                <!--best seller-->
                <!-- brands carousel -->
                <br>
                <div class="cate-categories clearfix">
                    <?php foreach($list_cates as $cat) :?>
                        <div class="block-category">
                            <h2 class="title">
                                <a href=<?php echo base_url('danh-muc/'.$cat->alias)?>" title="<?php echo $cat->name;?>" class="img">
                                <img src="<?php echo base_url($cat->image)?>" width="35" height="35"   alt="<?php echo $cat->name;?>"/></a>
                                <a href="<?php echo base_url('danh-muc/'.$cat->alias)?>" title="<?php echo $cat->name;?>"><?php echo $cat->name;?></a>
                            </h2>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
            <!-- right col -->
