<div class="danh-muc">
    <ul>
        <?php $kc = 0;?>
        <?php 
        //echo "<pre>";
            //var_dump($cates);
            //echo "</pre>";
            //exit;
             foreach($cates as $cate) : ?>

            <?php $kc ++;?>

            <li class="item" data-id-parent="<?php echo @$cate['id']?>">
                <a href="<?php echo base_url('danh-muc/'.@$cate['alias'])?>" title="<?php echo @$cate['name']?>">
                    <div class="bd_bot">
                        <div class="box_icon_menu">
                            <img src="<?php echo base_url('assets/css/img/'.$kc.'.png')?>" alt="<?php echo @$cate['name']?>"/>
                        </div>
                        <div class="title_menu">
                            <?php echo @$cate['name']?>
                        </div>
                    </div>
                </a>
            </li>
        <?php endforeach;?>
    </ul>
</div><!--end danh muc-->
<div class="clearfix"></div>
<?php if(count($supports)) : ?>
    <div class="sidebar ho-tro col-md-12">
        <div class="title-sidebar col-md-12">
            <img src="<?php echo base_url()?>assets/css/img/icon_left.png" alt="">
            <h4>Hỗ trợ kỹ thuật</h4>
        </div><!--end title-->
        <div class="support col-md-12">
            <ul>
                <?php foreach($supports as $support) : ?>
                    <?php if($support->type == 1) : ?>
                        <li>
                            <div class="col-md-8 name" style="padding:0px;">
                                <a href="" title="">
                                    <b>
                                        <i class="fa fa-angle-double-right">&nbsp;</i>
                                        <?php echo @$support->name;?>
                                    </b>
                                </a>
                                <div class="clearfix"></div>
                                <span style="padding-left: 10px;color: #017DC3;">
                                    <?php echo @$support->phone;?>
                                </span>
                            </div>
                            <a href="" title="">
                                <img src="<?php echo base_url()?>assets/css/img/skype.png" alt="">
                            </a>
                            <a href="" title="">
                                <img src="<?php echo base_url()?>assets/css/img/fb1.png" alt="">
                            </a>
                        </li>
                    <?php endif;?>
                <?php endforeach;?>
            </ul>
        </div><!--end support-->
        <div class="title-sidebar title1 col-md-12">
            <img src="<?php echo base_url()?>assets/css/img/icon_left.png" alt="">
            <h4>Hỗ trợ kinh doanh</h4>
        </div><!--end title-->
        <div class="support col-md-12">
            <ul>
                <?php foreach($supports as $support) : ?>
                    <?php if($support->type == 0) : ?>
                        <li>
                            <div class="col-md-8 name" style="padding:0px;">
                                <a href="" title="">
                                    <b>
                                        <i class="fa fa-angle-double-right">&nbsp;</i>
                                        <?php echo @$support->name;?>
                                    </b>
                                </a>
                                <div class="clearfix"></div>
                                <span style="padding-left: 10px;color: #017DC3;">
                                    <?php echo @$support->phone;?>
                                </span>
                            </div>
                            <a href="" title="">
                                <img src="<?php echo base_url()?>assets/css/img/skype.png" alt="">
                            </a>
                            <a href="" title="">
                                <img src="<?php echo base_url()?>assets/css/img/fb1.png" alt="">
                            </a>
                        </li>
                    <?php endif;?>
                <?php endforeach;?>
            </ul>
        </div><!--end support-->
    </div><!--end sidebar-->
<?php endif;?>
<div class="clearfix"></div>
<?php if(!empty($new_cats)) : ?>
    <div class="sidebar tin-tuc col-md-12">
        <div class="title-sidebar col-md-12">
            <img src="<?php echo base_url()?>assets/css/img/icon_n.png" alt="<?php echo @$new_cats->name;?>">
            <h4>
                <?php echo @$new_cats->name;?>
            </h4>
        </div><!--end title-->
        <div class="list-new">
            <ul>
                <?php foreach($news as $new) : ?>
                    <li>
                        <a href="<?php echo base_url('tin/'.$new->alias)?>" title="<?php echo @$new->title?>">
                            <?php echo @$new->title?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div><!--end list-new-->
    </div><!--end sidebar-->
<div class="clearfix"></div>
<?php endif;?>
<?php if(isset($cate_yk)) : ?>
    <div class="sidebar y-kien col-md-12">
        <div class="title-sidebar col-md-12">
            <img src="<?php echo base_url()?>assets/css/img/icon_n.png" alt="">
            <h4>
                <?php echo @$cate_yk->name;?>
            </h4>
        </div><!--end title-->
        <div class="clearfix"></div>
        <div class="list-kh">
            <ul>
                <?php foreach($listyks as $yk) : ?>
                    <li>
                        <div class="row">
                            <div class="col-md-4 img_kh">
                                <img src="<?php echo base_url($yk['image'])?>" alt="<?php echo @$yk['title'];?>">
                            </div>
                            <div class="col-md-8" style="padding-left: 0;padding-top: 2px;line-height: 1.5">
                                <p style="color: #616161">
                                    <?php echo @$yk['title'];?>
                                </p>
                                <p style="color:#3d75cc">
                                    <?php echo @$yk['keyword']?>
                                </p>
                            </div>
                        </div>
                        <div class="row yk-content" style="margin-top: 8px">
                            <div class="col-md-12">
                                <i class="fa fa-quote-left" style="color: #616161"></i>
                                <p class="text-kh">
                                   <?php echo @$yk['description']?>
                                    <i class="fa fa-quote-right" style="color: #616161"></i>
                                </p>
                            </div>
                        </div>
                    </li>
                <?php endforeach;?>
            </ul>
        </div><!--end list-kh-->
        <div class="line_list"></div>
    </div><!--end sidebar-->
<?php endif;?>