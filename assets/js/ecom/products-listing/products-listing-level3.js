SETTINGS.isActiveGetProductShopVasup = false;
SETTINGS.isActiveGetXuHuongRecommend = false;
jQuery(document).ready(function() {
    jQuery('a').click(function(e){
	    if($(this).attr('rel') == 'disabled') e.preventDefault();
});
    getProductInfoListingRenderHtml('listing');
    getProductInfoOther();
    jQuery(document).on('click','.color-attr label',function(){
        jQuery(this).toggleClass('active');
    });
    jQuery(document).on('click','.cont-filter-attr .view-more',function(e){
        jQuery(this).toggleClass("show");
        jQuery(this).siblings('ul').toggleClass("active");
        e.preventDefault();
    });
    /*sortTypePrice */
    $('ul.other-filters .sortTypePrice').click(function(){
        //$(this).toggleClass('arr');
    });
    /*remove class content_item_hover in Ipad*/
    checkIpadDevice();

    /*init localStorage for icon arr of sortTypePrice property*/
    localStorage.setItem('test','');
    $(window).on('scroll', function(){       
        owl_owl_brands ('#owl-brands');
    });   
});

function getWidgetHotSale(element,param1,param2){
    var main_cont = $('#container ');
    var left_col = main_cont.find('.left-col');
    var right_col = main_cont.find('.right-col');
    var ITEM_HEIGHT = 135;
    var BOX_HEADER = 40;
    var item_count = Math.floor((left_col.height()-right_col.height()-BOX_HEADER)/ITEM_HEIGHT);
	jQuery.ajax({
        url: DOMAIN+'widget/rightHotsale/?path='+param1+"&cat="+param2+"&limit="+item_count,
        type: "GET",
        success: function(data){
           jQuery("#"+element).html(data);
        }
    });
}

function getWidgetTopshop(element,param1,param2){
	jQuery.ajax({
        url: DOMAIN+'widget/rightTopshop/?path='+param1+"&cat="+param2,
        type: "GET",
        success: function(data){
           jQuery("#"+element).html(data);
        }
    });
}

function getWidgetCnms(element,param1,param2){
	jQuery.ajax({
        url: DOMAIN+'widget/rightCnms/?path='+param1+"&cat="+param2,
        type: "GET",
        success: function(data){
           jQuery("#"+element).html(data);
        }
    });
}

function resetActive(current){
     jQuery('#products-listing-filter-load ul.other-filters li').not(current.parent()).removeClass('active');    
}
function listingRedirectUrl(ajax_config, url_value, current, intType){
    if(current != null){
        if(current.parent().hasClass('sortTypePrice')){ 
                 
            current.parent().addClass('active');            
        //    current.parent().toggleClass('arr');  
        }else{
           
            current.parent().toggleClass('active');  
           // if($('ul.other-filters .sortTypePrice').hasClass('arr')){
          //      $('ul.other-filters .sortTypePrice').removeClass('arr');     
          //  }
                      
        }
    }
    if(ajax_config != 1){
        window.location.href = url_value;
    }else{
        jQuery('.ajax-load-qa').show();
        baseUrl = url_value;
        if(jQuery('.filter .ic-minus').hasClass('active')){
            call_data = {ajax_active:"1",ic_minus_active:"1"};
        }else{
            call_data = {ajax_active:"1"};
        }

        var arrFirst = url_value.split('?');
        var arrFinal = arrFirst[1].split('&');
        var flagIcArr = '';
        for(var i in arrFinal){
            if(arrFinal[i]=='ajax=1'){
                arrFinal.splice(i,1);
                break;
            }
        }          
        flagIcArr =   arrFinal[1];         
        jQuery.ajax({
            type:"POST",
            url:baseUrl,
            data: call_data,
            dataType: 'json',
            //cache: false,
            success:function(data){
                window.history.pushState("", "", "?"+arrFinal.join("&"));
                jQuery('#filter-cate').html(data.filter);
                jQuery('#products-listing-filter-load').html(data.listing);
                jQuery(".ajax-load-qa").hide();
                _gaq.push(['_trackPageview', window.location.pathname + location.search]);
                getProductInfoListingRenderHtml('listing');  
                getProductInfoOther();
                //checkFilterPosition();
                if (intType == 1){crolltop_listing();}
                jQuery("img.lazy").lazyload({effect : "fadeIn"});
                if(flagIcArr=='sortType=price_asc'){
                    $('.sortTypePrice').addClass('arr');
                }
                else{$('.sortTypePrice').removeClass('arr');}
            },
            error:function (xhr, ajaxOptions, thrownError) {
                jQuery('.ajax-load-qa').hide();                
                //checkFilterPosition();                
            },
            timeout:3000
        });
    }
}

function listingRedirectUrlCallBack(ajax_config, url_value, intType){
    if(ajax_config != 1){
        window.location.href = url_value;
    }else{
        jQuery('.ajax-load-qa').show();
        baseUrl = url_value;
        if(jQuery('.filter .ic-minus').hasClass('active')){
            call_data = {ajax_active:"1",ic_minus_active:"1"};
        }else{
            call_data = {ajax_active:"1"};
        }
		var flagIcArr = '';
        var arrFirst = url_value.split('?');
			if(typeof(arrFirst[1]) != 'undefined'){
			var arrFinal = arrFirst[1].split('&');
			
			for(var i in arrFinal){
				if(typeof(arrFinal[i]) != 'undefined' && arrFinal[i]=='ajax=1'){
					arrFinal.splice(i,1);
					break;
				}
			}          
			if(typeof(arrFinal[1]) != 'undefined'){
				flagIcArr =   arrFinal[1]; 
			}      
		}		
        jQuery.ajax({
            type:"POST",
            url:baseUrl,
            data: call_data,
            dataType: 'json',
            //cache: false,
            success:function(data){
                jQuery('#filter-cate').html(data.filter);
                jQuery('#products-listing-filter-load').html(data.listing);
                jQuery(".ajax-load-qa").hide();
                _gaq.push(['_trackPageview', window.location.pathname + location.search]);
                getProductInfoListingRenderHtml('listing');  
                getProductInfoOther();
                //checkFilterPosition();
                if (intType == 1){crolltop_listing();}
                jQuery("img.lazy").lazyload({effect : "fadeIn"});
                if(flagIcArr=='sortType=price_asc'){
                    $('.sortTypePrice').addClass('arr');
                }
                else{$('.sortTypePrice').removeClass('arr');}
            },
            error:function (xhr, ajaxOptions, thrownError) {
                jQuery('.ajax-load-qa').hide();                
                //checkFilterPosition();                
            },
            timeout:3000
        });
    }
}

/*remove hover box for ipad device*/
function checkIpadDevice(){    
    if (navigator && navigator.userAgent && navigator.userAgent != null) 
    {  
        var strUserAgent = navigator.userAgent.toLowerCase();
        var arrMatches = strUserAgent.match(/(iphone|ipod|ipad)/);
        if (arrMatches != null){ 
                $('.content_item_hover').removeClass('content_item_hover');        
         }
    }
}
/*check arr for sortTypePrice*/
function checkSessionForSortTypePrice(){
    storage= $.localStorage;
    if($('.sortTypePrice.active')){
        if(storage.isEmpty('test')){
            alert('empty');
            storage.set('test','value');
        }
        else{
            alert('not emty');
        }
    }
    else{
        storage.set('test','');
    }
}

const ajaxRequest = new (function () {	
	onpopstate = function (oEvent) {		
		var urlCurrent = window.location.href;
		checkLink = urlCurrent.indexOf("?"); 
		if(checkLink > 0){
			urlCurrent = window.location.href + '&ajax=1';
		}else{
			urlCurrent = window.location.href + '?ajax=1';
		}		
		listingRedirectUrlCallBack(1, urlCurrent, 0);		
	};
})();

function owl_owl_brands (object) {
        var $run_object = $(object);
        var lenObj = $run_object.children().length;
        if(!$run_object.hasClass('onScreen') && isScrolledIntoView(object) && lenObj > 1){
            $run_object.owlCarousel({
                loop: true,
                margin: 0,
                lazyLoad: true,
                autoplay: true,
                nav: true,
                dots: false,
                items: 8,
                stagePadding: 0,
                responsiveClass:true,
                responsive:{
                    1024:{items:5},
                    1280:{items:6},
                    1366:{items:6}
                }                
            }).addClass('onScreen');
        }else{
            if (lenObj === 1 && isScrolledIntoView(object)) {
              $run_object.find('.owl-lazy').lazyload({data_attribute:'src'}).removeClass('owl-lazy');              
            };
        }           
    }
