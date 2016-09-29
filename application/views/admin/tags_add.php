<div id="page-wrapper">

    <div class="container-fluid" style="min-height: 550px">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo  base_url('admin')?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Thêm Tags
                    </li>
                    <?php if(isset ($error)){?>
                        <li class="">
                            <span style="color: red"> <?php echo  $error;?></span>
                        </li>
                    <?php }?>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="body collapse in" id="div1">
                    <form class="form-horizontal" role="form" id="form1" method="POST" action="" enctype="multipart/form-data" >
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Tên tag <span style="color: red">* </span>:</label>
                            <input type="text" autocomplete="off" name="tags"
                                   placeholder="Add Tags" style="width:9em;"
                                   class="input-medium tm-input tm-input-info "
                                   data-original-title="">
                        </div>
                        <div style="padding-bottom: 15px; padding-left: 90px">
                            <button type="submit" class="btn btn-success btn-sm" name="addtags"><i class="fa fa-check"></i> Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--loadjs tags-->
        <script id="facebook-jssdk"
                src="<?php echo base_url()?>assets/js/all.js"></script>
        <script type="text/javascript" async=""
                src="<?php echo base_url()?>assets/js/ga.js"></script>
        <script id="tinyhippos-injected">if (window.top.ripple) {
                window.top.ripple("bootstrap").inject(window, document);
            }</script>
        <script src="<?php echo base_url()?>assets/js/jquery"></script>

        <!--    <script src="--><?//=base_url()?><!--assets/js/modernizr"></script>-->
        <!--    <script src="--><?//=base_url()?><!--assets/js/scripts"></script>-->


        <script src="<?php echo base_url()?>assets/js/typeahead.min.js"></script>
        <script src="<?php echo base_url()?>assets/js/tagmanager.js"></script>
        <link href="<?php echo base_url()?>assets/css/css1.css" rel="stylesheet">
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-261013-8']);
            _gaq.push(['_trackPageview']);

            (function () {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();

        </script>

        <script>  (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/it_IT/all.js#xfbml=1&appId=447946985232153";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <!--end load js tags-->
        <script>
            jQuery(document).ready(function () {
                prettyPrint();
            });

            jQuery(".tm-input:eq(0)").tagsManager({
                prefilled: [""],
                blinkBGColor_1: '#FFFF9C',
                blinkBGColor_2: '#CDE69C'//,
            });

            jQuery(".tm-input:eq(2)").typeahead({
                name: 'countries',
                limit: 15,
                prefetch: '/ajax/countries/json'
            }).on('typeahead:selected', function (e, d) {

                    console.log("new tag from typeahead.js: " + d.value);
                    console.log("all existing tags: " + tagApi.tagsManager("tags").tags);

                    tagApi.tagsManager("pushTag", d.value);

                    console.log("new list of tags: " + tagApi.tagsManager("tags").tags);

                });

            jQuery('#addtag').on('click', function (e) {
                e.preventDefault();

                var tag = "";
                var albet = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
                for (var i = 0; i < 5; i++)
                    tag += albet.charAt(Math.floor(Math.random() * albet.length));
                tmfour.tagsManager('pushTag', tag);
            });

            jQuery('#removetag').on('click', function (e) {
                e.preventDefault();

                tmfour.tagsManager('popTag');
            });

        </script>
        <!-- /.row -->
        <!-- /.row -->
        <!-- /.row -->
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</div>