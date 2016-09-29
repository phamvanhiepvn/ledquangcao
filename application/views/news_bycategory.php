<div class="bodyContainer">
    <div class="mainContent">
        <div  class="contentWrapper autoPosition m-Scrollbar backGround animated fadeOutLeft">
            <div class="top_space"></div>
            <!-- Content display with Background image -->
            <div class="fullWidth parallax  topHeaderBg top_bot_pad"
                 data-src="<?php echo base_url(@$this->banner) ?>"
                 data-src-small="<?php echo base_url(@$this->banner) ?>">
                <div class="overlayBg dark"></div>

            </div>
            <div class=" fullWidth removePadding" >
                <div class="container">

                    <div class="row-fluid" style="display: <?php if($hiddenFilter==false){ echo "none"; }else{ echo "block"; } ?>">
                        <div class="page_header block col-md-12">
                            <div class="col-md-3">
                                <h1><?php echo $cate_curent->name; ?></h1>
                            </div>
                            <div class="col-md-9">
                                <h4>Các dự án của chúng tôi.</h4>
                            </div>
                        </div>

                    </div>

                    <!-- Portfolio Category Navigation -->
                    <div class="row-fluid"   >
                        <div class="col-md-12">
                            <section class="controls alignLeft" >
                                <ul class="clearfix" >
                                    <!-- Add portfolio category -->
                                    <li style="display: <?php if($hiddenFilter==false){ echo "none"; }else{ echo "block"; } ?>" class="options_title"><h6>Lọc</h6></li>
                                    <li  class="filter active" data-filter="all" style="display: <?php if($hiddenFilter==false){ echo "none"; }else{ echo "block"; } ?>">
                                        <a >
                                            <div class="catName fxEmbossBtn">
                                                <span class="c_text">Toàn bộ</span>
                                                <span class="btn_hover"></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li  class="filter active" data-filter="all" style="display: <?php if($hiddenFilter==false){ echo "block"; }else{ echo "none"; } ?>; margin-top: 30px;">
                                        <a >
                                            <div class="catName fxEmbossBtn">
                                                <span class="c_text"><?php echo @$name_cate; ?></span>
                                                <span class="btn_hover"></span>
                                            </div>
                                        </a>
                                    </li>

                                    <?php if($cate_filter){ foreach($cate_filter as $value){?>
                                        <li class="filter" data-filter="<?php echo @$value->alias; ?>">
                                            <a >
                                                <div class="catName fxEmbossBtn">
                                                    <span class="c_text"><?php echo @$value->name; ?></span>
                                                    <span class="btn_hover"></span>
                                                </div>
                                            </a>
                                        </li>
                                    <?php }} ?>

                                </ul>
                            </section>
                        </div>

                    </div>
                </div>
            </div>


            <div class="container-fluid removePadding">

                <div class="masonry_items portfolio_items catFilterEffect_2">

                    <?php if (isset($news_bycate)) {
                        foreach ($news_bycate as $n) {
                            ?>
                            <div class="item mix mix_all hover_enable <?php echo @$n->cate_alias; ?> enablHardwareAcc" style="display: inline-block; opacity: 1; position: relative; width: 25%;">
                                <!-- Thumbnail -->
                                <div class="porImgOver">
                                    <div class="overlay_img"></div>
                                    <!-- Thumbnail Image -->
                                    <img alt="image_alt_text" data-src="<?php echo  base_url($n->image) ?>" src="<?php echo  base_url($n->image) ?>" class="preload">
                                </div>
                                <div class="imageText">
                                    <div class="overlay content">
                                        <div class="navs">
                                            <!-- The detail_btn class is used to display the project detail -->
                                            <div class="infoText detail_btn alignRight">
                                                <ul class="font_awesome_2x addFxEmbossBtn ">
                                                    <li><a class="fxEmbossBtn" href="<?php echo base_url('tin/'.@$n->news_alias) ?>"><i class="icon-thin-089_file_document_writing_script detail_icon"></i><span class="btn_hover"></span> </a></li>
                                                </ul>
                                            </div>

                                            <a class="linkText addFxEmbossBtn ">
                                                Launch site
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text_field">
                                        <h5><?php echo  ($n->title); ?></h5>
                                        <h6><?php echo  LimitString($n->description, 50,'...'); ?></h6>
                                    </div>
                                </div>
                            </div>



                        <?php
                        }}
                    ?>
                </div>

                <hr class="bottom_space">

            </div>


        </div>


    </div>


</div>