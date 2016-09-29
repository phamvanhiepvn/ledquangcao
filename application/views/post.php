<div class="bodyContainer">

<?php date_default_timezone_set("Asia/Bangkok"); ?>
<div class="mainContent">
<!-- About us -->

<div data-id="!about" class="contentWrapper autoPosition m-Scrollbar backGround animated fadeOutLeft">

<div class="top_space"></div>

<!-- Content display with Background image -->
<div class="fullWidth parallax  topHeaderBg top_bot_pad"
     data-src="<?php echo base_url(@$this->banner) ?>"
     data-src-small="<?php echo base_url(@$this->banner) ?>">
    <div class="overlayBg dark"></div>
    <div class="container">
        <div class="row-fluid">
            <div class="col-md-12 textAlignCenter" data-animated-time="5" data-animated-in="animated flipInX"
                 data-animated-innerContent="yes">
                <h1 class="white_color"><?php echo @$about->text_head; ?></h1>
                <br>

                <h3 class="white_color"><?php echo @$about->description; ?></h3>
                <h4 class="white_color"><?php echo @$about->text_middle; ?></h4>
            </div>
        </div>
        <hr>
    </div>
</div>

<div class="container">

    <div class="row">
        <div class="col-md-12 thumbItem_holder large_size gridType col3 content" style="visibility: visible;">
            <?php if (isset($news_bycate))  {
                foreach ($news_bycate as $n) {
                    ?>
                    <div class="thumbItem" style="visibility: visible;">
                        <div class="large_image">
                            <figure class="itemOver" aria-haspopup="true">
                                <div class="overlay">
                                    <span class="popup_overlay">
                                        <span class="popup_links">
                                            <!-- Thumbnail overlay to display video -->
                                            <a target="_self" href="<?php echo  base_url($n->image) ?>"
                                               data-title="<?php echo  $n->title ?>" class="magnificPopup">
                                                <span class="link_image"></span>
                                            </a>
                                            <!-- Thumbnail overlay links -->
                                            <a class="smoothPageLoad"
                                               href="<?php echo  base_url('tin/' . $n->news_alias) ?>"><span
                                                    class="link_link"></span> </a>
                                        </span>
                                    </span>
                                </div>
                                <!-- Thumbnail image -->
                                <img data-src="<?php echo  base_url($n->image) ?>" src="<?php echo  base_url($n->image) ?>"
                                     class="preload alignCenter resize-with-grid" alt="image_alt_text">
                            </figure>
                        </div>
                        <!-- Thumbnail Description -->
                        <div class="thumb_desc">
                            <!-- post items are placed here -->
                            <ul class="tools">
                                <li class="date"><i class="fa fa-calendar-o"></i><?php echo date("Y-m-d",$n->time); ?></li>

                            </ul>
                            <h5 class="item_title">"<?php echo  $n->title ?></h5>
                            <span class="mate text_icons right normal_over">
                                <i class="fa fa-tags"></i>
                                <a><?php echo $n->tag; ?></a>
                            </span>

                            <p><?php echo  $n->description; ?></p>
                            <a class="smoothPageLoad readMore" href="<?php echo  base_url('tin/' . $n->news_alias) ?>">Xem thêm </a>
                        </div>
                    </div>
                    <hr class="gird_separator animated fadeInUp" style="visibility: visible;">
                <?php
                }
            }
            ?>
            <!-- Pagination -->
            <div data-anchor-to="parent" data-animated-innercontent="yes" data-animated-in="animated fadeInUp"
                 data-animated-time="0" class="pagination" style="visibility: visible;">

                <?php
                echo $this->pagination->create_links(); // tạo link phân trang
                ?>
            </div>

        </div>
    </div>

</div>



</div>


</div>


</div>