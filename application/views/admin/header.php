<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta property="og:title" content="<?php echo  @$Pagetitle; ?>" />
    <meta property="og:type" content="<?php echo @$facebook['type'];?>" />
    <meta property="og:image" content="<?php echo @$facebook['image'];?>" />
    <meta property="og:url" content="<?php echo @$facebook['url'];?>" />
    <meta property="og:description" content="<?php echo  @$Description ?>" />
    <title><?php echo  @$headerTitle?></title>
    <!-- Bootstrap Core CSS -->


    <link href="<?php echo  base_url('assets/app/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo  base_url('assets/app/css/animate.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/app/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/app/css/custom.css')?>" rel="stylesheet">
    <script src="<?php echo  base_url('assets/app/js/jquery-1.11.0.min.js') ?>"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

</head>


<body class="nav-md">

<div class="container body">


<div class="main_container">

<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="/" class="site_title"><i class="fa fa-paw"></i> <span> Dashboard!</span></a>
        </div>
        <div class="clearfix"></div>



        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">

                <ul class="nav side-menu">
                    <li><a><i class="fa fa-edit"></i> Quản lý trang tĩnh <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">

                            <li>
                                <a href="<?php echo  base_url('admin/about')?>">Giới thiệu</a>
                            </li>
                            <li>
                                <a href="<?php echo  base_url('admin/skill')?>"> Quản lý skill</a>
                            </li>
                            <li>
                                <a href="<?php echo  base_url('admin/service')?>">Dịch vụ</a>
                            </li>

                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i> Quản lý sản phẩm <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">

                            <li>
                                <a href="<?php echo  base_url('admin/du-an/Add')?>">Thêm sản phẩm</a>
                            </li>
                            <li>
                                <a href="<?php echo  base_url('admin/danh-sach-du-an')?>"> Danh sách sản phẩm</a>
                            </li>
                            <li>
                                <a href="<?php echo  base_url('admin/danh-muc-san-pham')?>">Danh mục sản phẩm</a>
                            </li>

                        </ul>
                    </li>
                    <li><a><i class="fa fa-book"></i> Quản lý tin tức <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">

                            <li>
                                <a href="<?php echo  base_url('admin/tin-tuc/add')?>">Thêm tin tức</a>
                            </li>
                            <li>
                                <a href="<?php echo  base_url('admin/danh-sach-tin-tuc')?>"> Danh sách tin tức</a>
                            </li>
                            <li>
                                <a href="<?php echo  base_url('admin/danh-muc-tin-tuc')?>"> Danh mục tin tức</a>
                            </li>

                        </ul>
                    </li>

                    <li><a><i class="fa fa-th-list"></i> Quản lý menu <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li>
                                <a href="<?php echo  base_url('admin/menu/Add')?>"> Thêm Menu</a>
                            </li>
                            <li>
                                <a href="<?php echo  base_url('admin/danh-sach-menu')?>">Danh sách menu</a>
                            </li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-camera"></i> Quản lý Slider <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li>
                                <a href="<?php echo  base_url('admin/sliders/add')?>"> Thêm sliders</a>
                            </li>
                            <li>
                                <a href="<?php echo  base_url('admin/sliders')?>"> Danh sách sliders</a>
                            </li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-photo"></i> Quản lý media <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li>
                                <a href="<?php echo  base_url('admin/imageupload/banner')?>"> Quản lý media</a>
                            </li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-cogs"></i> Cấu hình hệ thống <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li>
                                <a href="<?php echo  base_url('admin/site_option')?>"> Cấu hình hệ thống</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="fa fa-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="fa fa-crop" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="fa fa-eye" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('admin/logout') ?>">
                <span class="fa fa-power-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">

    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="images/img.jpg" alt="">Admin
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                        <li>
                            <a href="<?php echo  base_url('admin/admin-permission')?>"> Phân quyền </a>
                        </li>
                        <li>
                            <a href="<?php echo  base_url('admin/doi-mat-khau')?>"> Đổi mật khẩu</a>
                        </li>
                        <li>
                            <a href="<?php echo  base_url('admin/logout')?>"> Đăng xuất</a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
    </div>

</div>
<!-- /top navigation -->


<!-- page content -->
<div class="right_col" role="main">

