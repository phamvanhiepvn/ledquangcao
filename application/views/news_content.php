<div class="bodyContainer">


    <div class="mainContent">
        <!-- About us -->

        <div data-id="!about" class="contentWrapper autoPosition m-Scrollbar backGround">

            <div class="top_space"></div>

            <!-- Content display with Background image -->
            <div class="fullWidth parallax  topHeaderBg top_bot_pad"
                 data-src="<?php echo base_url(@$this->banner) ?>"
                 data-src-small="<?php echo base_url(@$this->banner) ?>">
                <div class="overlayBg dark"></div>
                <div class="container">
                    <div class="row-fluid">
                        <div class="col-md-12 textAlignCenter">

                        </div>
                    </div>
                    <hr>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div  class="fullDetails fullDetails-remove-css" >

                        <div class="container max_height" >
                            <hr class="space_max">
                            <div class="row-fluid">
                                <div class="col-md-6">
                                    <div class="flexSlideshow slideAnimation showControlNav" >
                                        <ul class="slides">
                                            <li>
                                                <a  class="lazyload" href="<?php echo base_url(@$news->image); ?>" title="Some text">IMAGE</a>

                                            </li>

                                        </ul>
                                        <hr class="slide_bottomSpace">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h3><?php echo @$news->title; ?></h3>
                                    <p><?php echo @$news->description; ?></p>
                                    <ul class="item_feature">
                                        <?php echo @$news->content; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">

                <div class="row" data-animated-time="0" data-animated-in="animated fadeInUp" data-animated-innerContent="yes">

                    <div class="page_header remove_bottomSpace text-center">
                        <h3 class="bold_weight active">SẢN PHẨM MỚI THỰC HIỆN</h3>
                    </div>
                </div>

                <div class="row carousel_container thumbItem_holder large_size">
                    <ul class="carousel_thumbails" data-animated-time="0" data-animated-in="animated fadeInUp"
                        data-animated-innerContent="yes" data-anchor-to="parent.parent">
                        <?php if (isset($latestProject)) {
                            foreach ($latestProject as $n) {
                                ?>
                                <li class="thumbItem itemOver" aria-haspopup="true" style="visibility: visible; width: 100%;">
                                    <div class="large_image">
                                        <!-- Thumbnail image -->
                                        <img data-src="<?php echo  base_url($n->image) ?>" src="<?php echo  base_url($n->image) ?>" class="preload scale-with-grid" alt="<?php echo  @$n->title ?>">
                                        <div class="overlay flatHover">
                                            <div class="popup_overlay">
                                                <div class="popup_links">
                                                    <!-- Thumbnail overlay to display single image -->
                                                    <a target="_self" href="<?php echo  base_url($n->image) ?>" data-title="<?php echo  @$n->title ?>" class="magnificPopup">
                                                        <span class="link_image"></span>
                                                    </a>
                                                    <!-- Thumbnail overlay link -->
                                                    <a href="<?php  echo base_url('tin/'.@$n->news_alias); ?>"><span class="link_link"></span> </a>
                                                    <!-- Thumbnail overlay to display gallery -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- Thumbnail Description -->
                                    <div class="thumb_desc">
                                        <h5 class="item_title"><?php echo  @$n->title; ?></h5>
                                        <p><?php echo  @$n->description; ?></p>
                                    </div>
                                </li>
                            <?php
                            }
                        }
                        ?>


                    </ul>

                </div>


            </div>
        </div>

    </div>
</div>