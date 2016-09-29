<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo @$title;?></title>
    <link rel="shortcut icon" href="<?php echo  base_url('assets/favicon.png') ?>"/>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/cus_style.css" type="text/css" />
    <link href="<?php echo base_url()?>assets/css/cus_menu.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

</head>

<body>
<div class="swapper">
<div class="container">
<div class="row">
<header id="header-top">
    <section class="hidden-xs hidden-sm">
        <div class="col-md-3">
            <div class="logo">
                <a href="#">
                    <!--<img src="<?/*=base_url()*/?>assets/css/images/logo.png" />-->
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <!--<img src="<?/*=base_url()*/?>assets/css/images/logo-text.png" />-->
        </div>
        <div class="col-md-3 z">
            <a href="#" class="anh">
                <!--<img src="<?/*=base_url()*/?>assets/css/images/sale.png" />-->
            </a>
        </div>
    </section>
    <div class="clearfix"></div>
    <nav class="nav is-fixed" role="navigation">
        <div class="visible-xs visible-sm logo_mobile">
            <a href="#">
                <img src="<?php echo base_url()?>assets/css/images/logo.png" />
            </a>
        </div>
    </nav>
    <div class="page-title">Danh sách khách hàng </div>
</header>
<div class="clearfix"></div>
<article id="main">
<section id="content">
    <div class="col-md-12">
        <?php if(isset($lists)) : ?>
            <div class="row">
                <?php foreach($lists as $k => $list) : ?>
                    <?php if($k  % 4 == 0) : ?>
                        </div><div class="row">
                    <?php endif;?>
                    <div class="col-md-3 col-sm-12 col-xs-12 clearfix">
                        <div class="box-tin">
                            <figure>
                                <img  src="<?php echo base_url($list->image)?>">
                                <figcaption>
                                    <p><a href="<?php echo @$list->title;?>" target="_blank">Xem ngay</a></p>
                                </figcaption>
                            </figure>
                            <span>
                                <span>Website:</span>
                                <a href="<?php echo @$list->title;?>" target="_blank" title="<?php echo $list->title;?>">
                                    <?php echo $list->title;?>
                                </a>
                            </span>
                        </div> <!-- end box-tin -->
                    </div>
                <?php endforeach;?>
            </div>
        <?php endif;?>
    </div>
    <div class="col-md-12">
        <?php echo $this->pagination->create_links();?>
    </div>
</section>
</article>
</div>
</div>
</div>
</body>
</html>
