var NUM_OF_RESIZABLE_ITEMS = 4;
var num_of_resizable_count = 0;
var is_proads_drawn = false;
$(document).on('onColumnHeightChange', function() {
    if (++num_of_resizable_count >= NUM_OF_RESIZABLE_ITEMS && !is_proads_drawn) {
        is_proads_drawn = true;
        proAds();
    }
});
function proAds() { 
    var main_cont = $('#container ');
    var left_col = main_cont.find('.left-col').first();
    var right_col = main_cont.find('.right-col').first();
    var ITEM_HEIGHT = 130;
    var BOX_HEADER = 40;
    var item_count = Math.floor((left_col.height()-right_col.height()-BOX_HEADER)/ITEM_HEIGHT);
    if (SETTINGS.isActiveGetProductShopVasup) {
        jQuery.ajax({
            url: DOMAIN + 'homepage/partial/proads/?item_count='+item_count,
            type: "GET",
            success: function(data) {
                jQuery('.home-pro-ads').html(data);
                jQuery(".home-pro-ads img.lazy").lazyload();
            }
        });
    }
}
$(document).ready(function() {

    $(document).on('mouseup', '#t_home_trend a', function(event) {
        var element = "#t_home_trend";
        if(true === isTrackingClickAllowed(element,event)){
            var blockId = $(element).attr("saq_track_id");
            $(element).attr("saq_click", "1");
            tracking_view_home('normal', blockId, null);
        }
    });

    $(document).on('mouseup', '#saq_rec_top_women a', function(event) {
        var element = "#saq_rec_top_women";
        if(true === isTrackingClickAllowed(element,event)){
            var blockId = $(element).attr("saq_track_id");
            var recommend = $(element).attr("saq_recommend");
            $(element).attr("saq_click", "1");
            tracking_view_home('normal', blockId, recommend);
        }
    });

    $(document).on('mouseup', '#saq_rec_top_men a', function(event) {
        var element = "#saq_rec_top_men";
        if(true === isTrackingClickAllowed(element,event)){
            var blockId = $(element).attr("saq_track_id");
            var recommend = $(element).attr("saq_recommend");
            $(element).attr("saq_click", "1");
            tracking_view_home('normal', blockId, recommend);
        }
    });

    $(document).on('mouseup', '#saq_rec_top_mombaby a', function(event) {
        var element = "#saq_rec_top_mombaby";
        if(true === isTrackingClickAllowed(element,event)){
            var blockId = $(element).attr("saq_track_id");
            var recommend = $(element).attr("saq_recommend");
            $(element).attr("saq_click", "1");
            tracking_view_home('normal', blockId, recommend);
        }

    });



    jQuery(document).ajaxComplete(function(event, request, ajaxOptions) {

        doTrackingImpress();
        $(window).on("load resize scrollstop", function(event) {
            doTrackingImpress();
        });
    });



    getProductInfo();
    autoClickTab();
    //handleOwlcarouselScroll();

    //$(".houseware img.lazyClick").lazyload({effect: "fadeIn"});
     $('.lazy').lazyload({"effect":"fadeIn","threshold" : 100});        

    /* owlcarousel RECOMMEND_HOME */
    if (SETTINGS.isActiveGetXuHuongRecommend == true) {
        if (typeof RECOMMEND_HOME != "undefined") {
            //collab recommend cho xu huong
            jQuery.ajax({
                url: DOMAIN + 'homepage/xu-huong/?recommend=' + RECOMMEND_HOME,
                type: 'GET',
                success: function(data) {
                    if(data.trim()){
                        jQuery('.xu-huong').html(data);

                    }

                }
            }).always(function() {
                //after ajax complete get recommend, enable track
                enableTrackingTrend()
            });

            //collab recommend cho top thoi trang
            jQuery.ajax({
                url: DOMAIN + 'homepage/partial/home-top-categories/?recommend=' + RECOMMEND_HOME,
                type: 'GET',
                dataType:'json',
                success: function(data) {
                    if(data){                        
                        jQuery("#home_category_first").html(data.home_top_categories_first);
                        jQuery("#home_category_second").html(data.home_top_categories_second);
                        jQuery("#home_category_third").html(data.home_top_categories_third);                        
                    }


                }
            }).always(function() {
                //after ajax complete get recommend, enable track
                enableTrackingTopCate()
            });

        }
    }



    /* owlcarousel run in on screen */
    owl_home_top('#owl-home-top');        
    /* run owlcarousel when scroll there */    
    $(window).on('scroll', function(){
        owl_home_top('#owl-home-top');

        owl_box_shopthuonghieu('.box-shopthuonghieu');
        owl_click_slide_run('.item-tabs.active');
    });

   
});
/* set scroll for owlcarousel */
//function handleOwlcarouselScroll(){
    var owlcarousel_option = {
        autoplay: true,
        lazyLoad: true,
        autoplayHoverPause: true,
        loop: true,
        margin: 0,
        navText: [ '', '' ],
        stagePadding: 0
    };
    /* owlcarousel banner home */
    var owl_home_top = function (object) {
        var $run_object = $(object);
        var lenObj = $run_object.children().length;
        if(!$run_object.hasClass('onScreen') && isScrolledIntoView(object) && lenObj > 1){
            $run_object.owlCarousel(
                $.extend({},owlcarousel_option,{
                    items: 1,
                    nav: false,
                    dots: true
                })
            ).addClass('onScreen');
        }else{
            if (lenObj === 1 && isScrolledIntoView(object)) {
              $run_object.find('.owl-lazy').lazyload({data_attribute:'src'}).removeClass('owl-lazy');
            };
        }
    }
    /* owl slide brand  */
    var owl_slide_brand = function(object) {
        var $run_object = $(object);
        var lenObj = $run_object.children().length;
        if(!$run_object.hasClass('onScreen') && isScrolledIntoView(object) && lenObj > 1){
            $run_object.owlCarousel(
                $.extend({},owlcarousel_option,{
                    items: 1,
                    nav: true,
                    dots: false
                })
            ).addClass('onScreen');
        }else{
            if (lenObj === 1 && isScrolledIntoView(object)) {
                $run_object.find('.owl-lazy').lazyload({data_attribute:'src'}).removeClass('owl-lazy');
            };
        }
    }
    /* owlcarousel slide collection */
    var owl_slide_run = function (object) {
        var $run_object = $(object).find('.slide-run');
        var lenObj = $run_object.children().length;
        if(!$run_object.hasClass('onScreen') && isScrolledIntoView(object) && lenObj > 1){

            $run_object.owlCarousel(
                $.extend({},owlcarousel_option,{
                    items: 1,
                    nav: false,
                    dots: true
                })
            ).addClass('onScreen');
        }else{
            if (lenObj === 1 && isScrolledIntoView(object)) {
                $run_object.find('.owl-lazy').lazyload({data_attribute:'src'}).removeClass('owl-lazy');
            };
        }
    }
    /* owlcarousel slide collection other */
    var owl_click_slide_run =  function (object) {
        var $run_object = $(object).find('.click-slide-run');
        var lenObj = $run_object.children().length;
        if(!$run_object.hasClass('onScreen') && isScrolledIntoView(object) && lenObj > 1){
            $run_object.owlCarousel(
                $.extend({},owlcarousel_option,{
                    items: 1,
                    nav: false,
                    dots: true
                })
            ).addClass('onScreen');
        }else{
            if (lenObj === 1 && isScrolledIntoView(object)) {
                $run_object.find('.owl-lazy').lazyload({data_attribute:'src'}).removeClass('owl-lazy');
            };
        }
    }
    /* owlcarousel box-shopthuonghieu */
    var owl_box_shopthuonghieu = function (object) {
        var $run_object = $(object).find('.brand-collection');
        var lenObj = $run_object.children().length;
        if(!$run_object.hasClass('onScreen') && isScrolledIntoView(object) && lenObj > 1){
            $run_object.owlCarousel(
                $.extend({},owlcarousel_option,{
                    items: 6,
                    nav: true,
                    dots: false,
                    responsiveClass: true,
                    responsive: {
                        1024: {items: 5},
                        1280: {items: 5},
                        1366: {items: 6}
                    }
                })
            ).addClass('onScreen');
        }else{
            if (lenObj === 1 && isScrolledIntoView(object)) {
                $run_object.find('.owl-lazy').lazyload({data_attribute:'src'}).removeClass('owl-lazy');
            };
        }
    }

//}

function isTrackingClickAllowed( element,event ){
    var isClicked =  $(element).attr("saq_click");
    var mousePress = event.which;
    var isEnableTrack = $(element).attr("saq_enable_track");
    // we won't tracking click if:
    // user clicked the link (isClicked == 1)
    // user did not click the left mouse button ( mousePress !=1)
    // Ajax still not complete get recommend data (isEnableTrack ==0)
    if (isClicked == 1 || mousePress != 1 || isEnableTrack == 0){
        return false;
    }else{
        return true;
    }
}

function autoClickTab() {
    var tabs = $('.tabs-cate-block2 > li');
    var timeClick = 8000;
    var tabAutoClick;
    tabs.on('click', function() {               
        var ind = $(this).index();
        $(this).addClass('active').siblings('.active').removeClass('active');
        $('.cont-tabs-cate .item-tabs').removeClass('active');
        $('.cont-tabs-cate .item-tabs:eq(' + ind + ')').show().addClass('active');
        $('.item-tabs.active .lazyClick').each(function(){
             $(this).lazyload().removeClass('lazyClick');           
        });
        owl_click_slide_run('.item-tabs.active');
        clearInterval(tabAutoClick);
        tabAutoClick =  setInterval(function() {
                nexTabClick();
        }, timeClick);

    });
   function nexTabClick(){
        var onTab = tabs.filter('.active');
        var nextTab = onTab.index() < (tabs.length - 1) ? onTab.next() : tabs.first();                  
        nextTab.click();
   }
   tabAutoClick =  setInterval(function() {
        nexTabClick();
    }, timeClick);
}
function pushTrackingCollab(arrPush, url) {
    url = "/collab_" + url;
    if (arrPush.length > 0) {
        var fluentd_url = location.protocol + '//track.sendo.vn/';
        var strPush = 'json={' + arrPush.toString() + '}';
        jQuery.post(fluentd_url + url,
                strPush,
                function(data, textStatus, jqXHR)
                {
                }).fail(function(jqXHR, textStatus, errorThrown) {
        });
    }
}

function enableTrackingTrend(){
    $("#t_home_trend").attr("saq_enable_track", "1");
}

function enableTrackingTopCate(){
    $("#saq_rec_top_women").attr("saq_enable_track", "1");
    $("#saq_rec_top_men").attr("saq_enable_track", "1");
    $("#saq_rec_top_mombaby").attr("saq_enable_track", "1");
}

function doTrackingImpress(){
    if ($("#t_home_trend").attr("saq_enable_track") == "1" && $("#t_home_trend").is(":in-viewport") && $("#t_home_trend").attr("saq_impress") == "0") {
        $("#t_home_trend").attr("saq_impress", "1");
        var blockId = $("#t_home_trend").attr("saq_track_id");
        tracking_view_home("impression", blockId, null);
    }

    if ($("#saq_rec_top_women").attr("saq_enable_track") == "1" && $("#saq_rec_top_women").is(":in-viewport") && $("#saq_rec_top_women").attr("saq_impress") == "0") {
        var blockId = $("#saq_rec_top_women").attr("saq_track_id");
        var recommend = $("#saq_rec_top_women").attr("saq_recommend");
        $("#saq_rec_top_women").attr("saq_impress", "1");
        tracking_view_home("impression", blockId, recommend);
    }

    if ($("#saq_rec_top_men").attr("saq_enable_track") == "1" && $("#saq_rec_top_men").is(":in-viewport") && $("#saq_rec_top_men").attr("saq_impress") == "0") {
        var blockId = $("#saq_rec_top_men").attr("saq_track_id");
        var recommend = $("#saq_rec_top_men").attr("saq_recommend");
        $("#saq_rec_top_men").attr("saq_impress", "1");
        tracking_view_home("impression", blockId,recommend);
    }

    if ($("#saq_rec_top_mombaby").attr("saq_enable_track") == "1" && $("#saq_rec_top_mombaby").is(":in-viewport") && $("#saq_rec_top_mombaby").attr("saq_impress") == "0") {
        var blockId = $("#saq_rec_top_mombaby").attr("saq_track_id");
        var recommend = $("#saq_rec_top_mombaby").attr("saq_recommend");
        $("#saq_rec_top_mombaby").attr("saq_impress", "1");
        tracking_view_home("impression", blockId, recommend);
    }
}

function tracking_view_home(type, block_id, recommend) {
    var cookies = getCookiesArray();
    //var arrApproved = ["browserid", "s_c_id", "s_c_id_type"];
    var arrApproved = ["browserid"];
    var arrPush = [];
    jQuery.merge(arrPush, data_login);
    for (var name in cookies) {

        if (jQuery.inArray(name, arrApproved) !== -1) {

            arrPush.push('"' + name + '":"' + cookies[name] + '"');
        }
        else if (name === "trackingCollab") {
            var trackCollab = jQuery.parseJSON(cookies[name]);
            if (RECOMMEND_HOME === 'a') {
                arrPush.push('"p_url":"' + window.location.origin + '/a/"', '"userId":"' + trackCollab.uid + '"', '"ipClient":"' + trackCollab.ip_client + '"', '"time":"' + trackCollab.time_srv + '"');
            } else {
                arrPush.push('"p_url":"' + window.location.origin + '"', '"userId":"' + trackCollab.uid + '"', '"ipClient":"' + trackCollab.ip_client + '"', '"time":"' + trackCollab.time_srv + '"');
            }
            impression_str = '"block_id":"' + block_id + '"' + ',' + '"level_cate":"' + trackCollab.level_cate + '"' + ',' + '"cate_id":"' + trackCollab.cate_id + '"' + ',' + '"combine":"' + trackCollab.combined + '"' + ',' + '"recommend":"' + recommend + '"';
        }
        /*if (!cookies["s_c_id_type"]) {
            arrPush.push('"login_type":" "');
        }*/
    }
    if (arrPush.length > 0) {
        var deviceName = isMobile();
        arrPush.push('"u_agent":"' + navigator.userAgent.replace(/\;/g, ',') + '"', '"os_info":"' + navigator.platform + '"', '"time_client":"' + jQuery.now() + '"', '"screen_size":"' + jQuery(window).width() + "x" + jQuery(window).height() + '"', '"device_name":"' + deviceName + '"');
        arrPush.push(impression_str);
        if (type === 'impression') {
            //impression case
            pushTrackingCollab(arrPush, 'impression');
        } else {
            //default
            pushTrackingCollab(arrPush, 'access');
//            localStorage.removeItem("combined_session");
//            $.session.remove("combined_session");
        }
        //localStorage.removeItem("trend_type");
    }
}

