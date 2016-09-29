<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo  base_url('assets/favicon.png') ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo  @$Description ?>"/>
    <meta name="keywords" content="<?php echo  @$Keyword ?>"/>
    <title><?php echo  @$Pagetitle; ?></title>
    <meta property="og:description" content="<?php echo  @$Description ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="<?php echo  base_url() ?>assets/app/images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo  base_url() ?>assets/app/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo  base_url() ?>assets/app/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo  base_url() ?>assets/app/images/apple-touch-icon-114x114.png">

    <link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>assets/app/theme_simple/css/counter.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>assets/app/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>assets/app/theme_simple/css/css.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>assets/app/theme_simple/css/default.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>assets/app/theme_simple/css/diggdigg-style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>assets/app/theme_simple/css/nivo-slider.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>assets/app/theme_simple/css/pagenavi-css.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>assets/app/theme_simple/css/public.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>assets/app/theme_simple/css/res.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>assets/app/theme_simple/css/skin.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>assets/app/theme_simple/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>assets/app/theme_simple/css/styles.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>assets/app/theme_simple/css/wprmenu.css">
    <script type="text/javascript" src="<?php echo  base_url() ?>assets/app/js/jquery-1.11.0.min.js"></script>

</head>
<body class="home blog sidebar-content">
<div class="site-container">
    <header class="header">
        <div class="banner_top">
            <img src="<?php echo base_url("upload/img/banner/logo.png")?>">
        </div>
        <nav class="nav-primary">
            <div class="wrap">
                <ul id="menu-menu-top" class="menu genesis-nav-menu menu-primary">
                    <li id="menu-item-1" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-3290"><a href="/">Trang chủ</a></li>
                    <?php $i=2; foreach (@$menutops as $v) { ?>
                        <li id="menu-item-<?php echo $i; ?>" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-<?php echo $i; ?>"><a href="<?php echo  base_url(@$v->url); ?>"><?php echo  @$v->name; ?></a></li>
                        <?php $i++; }
                    ?>

                </ul></div>
        </nav>
    </header>

    <div class="site-inner">
        <div class="content-sidebar-wrap">
            <main class="content">


