
var _saq = _saq || [];
var saqHomeTopSlideClicked = [];
var saqHomeTopSlideImpressed =[];

$(document).ready(function(){

    //--begin track impression home top banner slide item when carousel change
    var carouselHomeTopSlide = $("#owl-home-top");
    var carouselHomeTopSlideItem = $(carouselHomeTopSlide).find(".owl-item");

    $(carouselHomeTopSlide).on('changed.owl.carousel',function(property){
        var current = property.item.index;
        var bannerHref = $(property.target).find(".owl-item").eq(current).find("a").attr('href');
        var bannerId = $(property.target).find(".owl-item").eq(current).find("a").attr('saq_bannerId');
        trackImpressHomeTopSlideItem(bannerId,bannerHref);
    });
    //--end track impression home top banner slide item when carousel change



    $(window).on("load resize scrollstop", function(event) {
        var activeBanner = carouselHomeTopSlide.find(".owl-item.active .item a");

        //--begin track impression home top banner slide item when page load, scrolling,resize
        var bannerHref = activeBanner.attr("href");
        var bannerId = activeBanner.attr("saq_bannerId");
        trackImpressHomeTopSlideItem(bannerId,bannerHref);
        //--end track impression home top banner slide item when page load, scrolling,resize
    });

    //--begin track click home top banner slide item
    carouselHomeTopSlideItem.mousedown(function(event) {
        //left and right mouse click event
        if(event.which === 1 || event.which ===3){
            //neu banner dang active thi track
            if($(this).hasClass("active")){
                var activeBanner = $(this).find(".item a");
                var bannerHref = activeBanner.attr('href');
                var bannerId = activeBanner.attr('saq_bannerId');
                trackClickHomeTopSlideItem(bannerId, bannerHref);
            }

        }
    });
    //--end track click home top banner slide item
});




function trackClickHomeTopSlideItem(bannerId, bannerHref){
    try{
        if(typeof bannerId !== 'undefined' && typeof bannerHref !== 'undefined'){
            // neu chua click bao gio thi track
            if($.inArray(bannerId,saqHomeTopSlideClicked) === -1){
                saqHomeTopSlideClicked.push(bannerId);
                var pushData = {
                    from_block_id:"top-banner",
                    from_page_id:"home",
                    from_cate_id:"0",
                    to_product_id:bannerId,
                    to_href:encodeURIComponent(bannerHref)
                }
                if(saq_user_data != ""){
                    pushData.login_id = saq_user_data.fpt_id;
                    pushData.login_email = saq_user_data.email;
                    pushData.login_type = saq_user_data.login_type;
                }
                _saq.push(["trackLinkClick",JSON.stringify(pushData)]);
            }
        }
    }catch(err){
        console.log ("Error from home_banner.js, function: trackClickHomeTopSlideItem, message: " + err);
    }
}

function trackImpressHomeTopSlideItem(bannerId, bannerHref){
    if($("#slide_home_top").is(":in-viewport")){
        try{
            if( typeof bannerId !== 'undefined' && typeof bannerHref !== 'undefined'){
                //neu chua impress bao gio thi track
                if($.inArray(bannerId,saqHomeTopSlideImpressed) === -1){
                    saqHomeTopSlideImpressed.push(bannerId);
                    var pushData = {
                        from_block_id:"top-banner",
                        from_page_id:"home",
                        from_cate_id:"0",
                        to_product_id:bannerId,
                        to_href:encodeURIComponent(bannerHref)
                    };

                    if(saq_user_data != ""){
                        pushData.login_id = saq_user_data.fpt_id;
                        pushData.login_email = saq_user_data.email;
                        pushData.login_type = saq_user_data.login_type;
                    }

                    _saq.push(["trackLinkImpress",JSON.stringify(pushData)]);
                }
            }
        }catch(err){
            console.log ("Error from home_banner.js, function: trackImpressHomeTopSlideItem, message: " + err);
        }

    }
}
