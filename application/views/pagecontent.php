<div id="container" class="hidden-xs hidden-sm">
    <div class="swap-content home">
        <!--<div class="col-sm-9 left-new">-->
        <div class="left-col home">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-content">
                        <div class="breadcrumb_detail clearfix">
                            <a style=" color: #a599a5;" href="<?php echo base_url()?>">Trang chủ</a>
                            <i style="font-size: 18px;" class="fa fa-angle-right"></i>
                            <a href="#"><?php echo @$page->name;?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="new-content">
                        <div class="box" style="line-height: 1.5">
                            <h4><?php echo  @$page->name; ?></h4>
                            <h6 style="color: #818181; font-weight: bold; font-size: 13px"><?php echo  @$page->description; ?></h6>
                            <div class="fix-list"></div>
                            <?php echo  @$page->content; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>