<article class="container content">
    <section class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="menu-detail">
                <section class="cate-danh-muc">
                    <a href="#">
                        Tìm kiếm sản phẩm
                    </a>
                </section>

            </div>
        </div>
        <!--menu-detail-->
        <Div class="clearfix"></Div>
        <div>
            <div class="clearfix" style="clear: both"></div>
            <div class="col-md-12">
                <div class="row">
                    <?php if($list) : ?>
                    <?php if (isset($list)) {
                        foreach ($list as $n) {
                            ?>
                            <section class="col-md-3 col-sm-4 col-xs-12" >
                                <div class="item_pro">
                                    <section>
                                        <a href="<?php echo  base_url('san-pham/' . @$n->pro_alias); ?>" class="item_img">
                                            <img style="width: 100% !important;" src="<?php echo  base_url( $n->pro_img); ?>" />

                                            <?php if($n->caption_1!=''){?>
                                                <div class="caption">
                                                    <div class="blur"></div>
                                                    <div class="caption-text">
                                                        <ul>
                                                            <?php
                                                            $arr=explode(';',$n->caption_1);
                                                            foreach($arr as $it){
                                                                echo "<li>$it</li>";
                                                            }
                                                            ?>
                                                        </ul>
                                                        <div style="clear: both"></div>
                                                    </div>
                                                    <div style="clear: both"></div>
                                                </div>
                                            <?php }?>
                                        </a>
                                    </section>
                                    <div class="clearfix"></div>
                                    <div class="item_title">
                                        <a href="<?php echo  base_url('san-pham/' . @$n->pro_alias); ?>">
                                            <?php echo  LimitString($n->pro_name, 90, '...'); ?>
                                        </a>
                                    </div>
                                    <div class="item_price col-md-12">
                                        <div class="item_price">
                                            <div class="col-md-6 col-sm-6 col-xs-6 item_price_news"><?php echo  number_format($n->pro_price_sale) . '&nbsp;VND';?></div>
                                            <div class="col-md-6 col-sm-6 col-xs-6 item_old_price"><?php echo   number_format($n->pro_price) . '&nbsp;VND' ;?></div>
                                        </div>
                                    </div>
                                    <div class="item_desc row">
                                        <div class="save_money col-xs-9">
                                            Tiết kiệm
                                            <?php echo number_format($n->pro_price-$n->pro_price_sale)?>đ
                                            (<?php echo $n->pro_price==0?0:floor(100-($n->pro_price_sale/$n->pro_price)*100)?>%)
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3">
                                            <a href="<?php echo  base_url('san-pham/' . @$n->pro_alias); ?>" class="pull-right">
                                                <div class="more-read">
                                                    <i class="fa fa-angle-right"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        <?php }
                    } ?>
                    <div class="clearfix"></div>
                    <div class="pagination">
                        <?php
                        echo $this->pagination->create_links(); // tạo link phân trang
                        ?>
                    </div>


                </div>
                <div class="clearfix"></div>
                <?php else :?>

                    <p style="margin-left: 15px;">Không tìm thấy sản phẩm nào !!!</p>
                <?php endif;?>
            </div>



    </section>


</article>
