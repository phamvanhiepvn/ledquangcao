var cgSendo = angular.module('app', ['cgNotify','ngCookies','ngSanitize']);
var sendo_title = jQuery("title").text();
cgSendo.controller('Notify', function($scope, $timeout, notify, socketService,$window,$rootScope) {
    $scope.count_down = 0;
    $scope.server_time = 0;
    $scope.count_notify = 0;
    $scope.list_notify = [];
    $scope.list_sendo360 = [];
    $scope.list_vasuphome = [];
    $scope.domain = DOMAIN;
    $scope.stimage = ST_IMAGE;
    $scope.cate_id = 0;
    $rootScope.loading_notify = true;


    $scope.readNotify = function(){
        socketService.send('read');
    };
    $scope.readAllNotify = function(){
        socketService.send('readall');
        location.href = DOMAIN + 'notification/index/';
    };
    $scope.onTimeout = function(){
        var title = '(' + $scope.count_notify + ') ' + sendo_title;
        var current_title = jQuery("title").text();
        if (title == current_title) {
            jQuery("title").text(sendo_title);
        }else{
            jQuery("title").text(title);
        }
        var mytimeout = $timeout($scope.onTimeout,1500);

    };

    socketService.handlers.onopen = function() {
        if(window._gaq){
            _gaq.push(['_trackEvent', 'Notify', 'Client_connect', 'connect']);
        }

        jQuery("#block_sendo360").show();
        //jQuery("#block_vasup").show();
       

        if(is_home()){
            socketService.send('sendo360');
            socketService.send('vasuphome');
        }
        if(is_cate()){
            socketService.send('vasuphome'+cate_id);
        }
    }
    socketService.handlers.onclose = function() {
        if($scope.list_sendo360.length == 0){
            jQuery("#block_sendo360").hide();
        }
        if($scope.list_vasuphome.length == 0){
            //jQuery("#block_vasup").hide();
        }
    }
    socketService.handlers.onmessage = function(e) {
        if(e.data == 1){
            if(window._gaq){
                _gaq.push(['_trackEvent', 'Notify', 'Server_push', 'receive']);
            }
        }
        if(e.data == "timeout"){
            if(window._gaq){
                _gaq.push(['_trackEvent', 'Notify', 'Client_wait', 'timeout']);
            }
            jQuery("#block_sendo360").hide();
        }else{
            jQuery("#block_sendo360").show();
        }
        if(e.data.count_notify >=0){

            $scope.count_notify = e.data.count_notify;

            if(e.data.count_notify >0){
                var title = '(' + $scope.count_notify + ') ' + sendo_title;
                var current_title = jQuery("title").text();
                if (title == current_title) {
                    jQuery("title").text(sendo_title);
                }else{
                    jQuery("title").text(title);
                }

            }else{
                jQuery("title").text(sendo_title);
            }
        }
        if(typeof e.data.message!= "undefined"){
            //notify({message:e.data.message ,template:'temp.html',position:'left'});
            if(e.data.message.Type == 7 || e.data.message.Type == 8 || e.data.message.Type == 9 || e.data.message.Type == 10 || e.data.message.Type == 11){
                $scope.server_time  = e.data.server_time;
                $scope.list_sendo360.unshift(e.data.message);
                if( $scope.list_sendo360.length > 20){
                    var tmp = [];
                    for(i in $scope.list_sendo360){
                        if(i < 20){
                           tmp.push($scope.list_sendo360[i]);
                        }
                    }
                    $scope.list_sendo360 = tmp;
                }
            }
            if(e.data.message.Type == 12){
                $scope.server_time  = e.data.server_time;
                $scope.list_vasuphome.unshift(e.data.message);
                if( $scope.list_vasuphome.length > 20){
                    var tmp = [];
                    for(i in $scope.list_vasuphome){
                        if(i < 20){
                           tmp.push($scope.list_vasuphome[i]);
                        }
                    }
                    $scope.list_vasuphome = tmp;
                }
                //console.log($scope.list_vasuphome);
            }
        }
        if(typeof e.data.message_sendo360!= "undefined"){
            $scope.list_sendo360 = e.data.message_sendo360;
            var tmp = [];
            for(i in $scope.list_sendo360){
                if(i < 20){
                    if($scope.list_sendo360[i].Type == 7 || $scope.list_sendo360[i].Type == 8 || $scope.list_sendo360[i].Type == 9 || $scope.list_sendo360[i].Type == 10 || $scope.list_sendo360[i].Type == 11){
                        tmp.push($scope.list_sendo360[i]);
                    }
                }
            }
            $scope.list_sendo360 = tmp;
            $scope.server_time  = e.data.server_time;
        }
        if(typeof e.data.message_vasuphome!= "undefined"){
            $scope.list_vasuphome = e.data.message_vasuphome;
            var tmp = [];
            for(i in $scope.list_vasuphome){
                if(i < 20){
                    if($scope.list_vasuphome[i].Type == 12){
                        tmp.push($scope.list_vasuphome[i]);
                    }
                }
            }
            $scope.list_vasuphome = tmp;
            $scope.server_time  = e.data.server_time;
            //console.log($scope.list_vasuphome);
            //jQuery("#vasuphome").mCustomScrollbar("update");
        }
        if(typeof e.data.total_notify != "undefined"){
            $scope.list_notify = e.data.total_notify;
            var tmp = [];
            for(i in $scope.list_notify){
                if(check_notify_data($scope.list_notify[i])){
                    tmp.push($scope.list_notify[i]);
                }
            }
            $scope.list_notify = tmp;
            $scope.server_time = e.data.server_time;
        }
        if(typeof  e.data.broadcast != "undefined"){
            console.log(e.data.broadcast);
        }
    };
    $scope.setCate = function(a){
        var a = a || 0;
        $scope.cate_id = a;

    };

});
function changeTitle(a,b,s) {
    var title = jQuery("title");
    if (s) {
        jQuery("title").text(b);
        s= false;
    }else{
        jQuery("title").text(a);
        s= true;
    }
}
cgSendo.controller('Counter', function($scope,$timeout) {
    $scope.counter = 0;
    $scope.onTimeout = function(){
        $scope.counter++;
        mytimeout = $timeout($scope.onTimeout,1000);
    }
    var mytimeout = $timeout($scope.onTimeout,1000);
});
cgSendo.directive("listnotify",
    function($sceDelegate){
        return {
            restrict: 'E',
            templateUrl: DOMAIN+'templates/listnotify.html',
        }
    }
);
cgSendo.directive("notifyitem",
    function($sceDelegate){
        return {
            restrict: 'A',
            templateUrl: DOMAIN+'templates/notifyitem.html',
            scope: {
                notify: "=notify",
                domain: "@domain",
                stimage: "@stimage",
            },
        }
    }
);
cgSendo.directive("sendo360",
    function($sceDelegate){
        return {
            restrict: 'E',
            templateUrl: DOMAIN+'templates/sendo360.html',
        }
    }
);
cgSendo.directive("sendo360item",
    function($sceDelegate){
        return {
            restrict: 'A',
            templateUrl: DOMAIN+'templates/sendo360item.html',
            scope: {
                notify: "=notify",
                domain: "@domain",
                stimage: "@stimage",
            },
        }
    }
);

cgSendo.directive("vasup",
    function($sceDelegate){
        return {
            restrict: 'E',
            templateUrl: DOMAIN+'templates/vasup.html',
        }
    }
);
cgSendo.directive("vasupitem",
    function($sceDelegate){
        return {
            restrict: 'A',
//            templateUrl: $sceDelegate.getTrusted(DOMAIN+'templates/vasupitem.html'),
            templateUrl: DOMAIN+'templates/vasupitem.html',
            scope: {
                notify: "=notify",
                domain: "@domain",
                stimage: "@stimage",
            },
        }
    }
);
cgSendo.directive("vasupcate",
    function($sceDelegate){
        return {
            restrict: "E",
            templateUrl: DOMAIN+'templates/vasupcate.html',
        }
    }
);
cgSendo.directive("vasupcateitem",
    function($sceDelegate){
        return {
            templateUrl: DOMAIN+'templates/vasupcateitem.html',
        }
    }
);

cgSendo.directive('notifyclass', function() {
    return {
        restrict: 'A',
        scope: {
            'status': '='
        },
        link: function (scope, element, attrs) {
            scope.$watch('status', function(status){
                if(status == 1){
                    element.addClass('new-n');
                }
                else{
                    element.removeClass('new-n');
                };
            });
        }
    }
})
cgSendo.directive('myRepeatDirective', function() {
  return function(scope, element, attrs) {
    //jQuery("div.box-ac").show();
    if (scope.$first){
        angular.element(element).css({"display":"none"});
        var mytimeout = setTimeout(function(){
            angular.element(element).css('opacity', 0).slideDown('1000').animate({ opacity: 1 },{ queue: false, duration: '500' })
        },1000);
    }

    if (scope.$last){
        jQuery('.ajax-load-notify').hide();
        var mytimeout = setTimeout(function(){
            jQuery("#sendo_360").mCustomScrollbar();
            //jQuery("#sendo_360").mCustomScrollbar("update");
        },1000);

    }

  };
})
cgSendo.directive('myCustomScrollbar', function() {
  return function(scope, element, attrs) {
    if (scope.$first){
        angular.element(element).css({"display":"none"});
        var mytimeout1 = setTimeout(function(){
            angular.element(element).css('opacity', 0).slideDown('1000').animate({ opacity: 1 },{ queue: false, duration: '500' })
        },1000);
    }
    if (scope.$last){
        var mytimeout1 = setTimeout(function(){jQuery("#vasup").mCustomScrollbar("update");},1500);

    }

  };
})
cgSendo.directive("renderdata",
    function($sceDelegate){
        return {
            restrict: 'A',
            scope: {
            "data": "@data",
            },
            templateUrl: DOMAIN+'templates/data.html',
        };
    }
);
cgSendo.directive('loadingnotify', function ($rootScope) {
      return {
        restrict: 'E',
        replace:true,
        template: '<div class="ajax-load-notify-item">&nbsp;</div>',
        link: function (scope, element, attr) {
              scope.$watch('loading_notify', function (val) {
                  if (val)
                      $(element).show();
                  else
                      $(element).hide();
              });
        }
      }
});

cgSendo.directive('endloadingnotify', function ($rootScope) {
      return function(scope, element, attrs) {
        if (scope.$last){
            $rootScope.loading_notify = false;
        }
      };
});
cgSendo.directive('autoheight', function () {
      return function(scope, element, attrs) {
        if (scope.$last){
            var leng = $('.swiper-wrapper').children().length;
            leng = leng > 3 ? 3 : leng;
            if(leng <=3 ){
                $('.swiper-container').css({'height': (leng*60)+'px'});
            }else{
                $('.swiper-container').css({'height': 0});
            }
        }
      };
});
cgSendo.filter('ceilPercent', function(){
    return function(input){
      var result = Math.ceil(input);
      return result;
    }
})
cgSendo.filter('checkCate', function(){
    return function(a,b){
        var a = a || ""
        var b = b || ""
        if (a !="" && b !=""){
          var tmp = a.split("index.html");
          if (tmp.length >=2){
            if(tmp[2] == b){
                return true;
            }
          }
        }
          return false;
    }
})
cgSendo.filter('formatTimer', function() {
  return function(input)
    {
        function z(n) {return (n<10? '0' : '') + n;}
        var seconds = input;
        var minutes = Math.floor(input / 60);
        var hours = Math.floor(minutes / 60);
        var days = Math.floor(hours / 24);
        if(seconds <=5){
            return 'vừa xong';
        }else if (seconds < 60){
            return 'Vài giây trước';
        }else if (minutes < 60){
            var return_minute = (minutes == 0) ? 1 : minutes;
            return 'Cách đây ' + (z(return_minute) + ' phút');
        }else if(hours < 24){
            var return_hour = (hours == 0) ? 1 : hours;
            return  'Cách đây ' + (z(return_hour) + ' giờ');
        }else if(days >30){
            var today = new Date();
            day_from_time = new Date((Math.round(today.getTime()/1000) - input)*1000);
            var dateString = day_from_time.format("dd mmm yyyy HH:MM");
            return 'Ngày ' + dateString;
        }else{
            return  'Cách đây ' + (z(days) + ' ngày');
        }

    };
});


cgSendo.filter('smartTrim', function() {
    return function (str, length, delim, appendix) {
        var delim = delim || " ";
        var appendix = appendix || "...";
        if (str.length <= length) return str;

        var trimmedStr = str.substr(0, length+delim.length);

        var lastDelimIndex = trimmedStr.lastIndexOf(delim);
        if (lastDelimIndex >= 0) trimmedStr = trimmedStr.substr(0, lastDelimIndex);

        if (trimmedStr) trimmedStr += appendix;
        return trimmedStr;
    }
});
cgSendo.filter('checkProtocol', function() {
    return function (input) {
        var url = input.split(":/");
        if(url.length>1){
            url[0] = "";
            return url.join("index.html");    
        }
        return input;
        
    }
});
cgSendo.filter('checkImageShop', function() {
    return function (input) {
        patt = /.jpg|.png|.gif/g;
        result = patt.test(input);
        if(result){
            return input;
        }
        //default logo shop
        return ST_IMAGE + "icon-shop35.jpg";
        
    }
});
cgSendo.filter('renderWishList', function() {
    return function(input){
        var content = '';
         for(i in input){
             content+='<div class="swiper-slide">';
             content+='<a href="'+ input[i].Cat_path + '" title="' + input[i].Name + '" ><img src="' + input[i].Image +'" width="50" height="50" alt="'+ input[i].Name+'" /></a>';
             content+='<span class="remove fa '+ input[i].Product_id +'">&nbsp;</span>';
             content+='</div>';
         }
        return content;
    };
});
cgSendo.filter('renderOneWishList', function() {
    return function(input){
        var content = '';
        content+='<a href="'+ input.Cat_path + '" title="' + input.Name + '" ><span class="img"><img src="' + input.Image +'" width="50" height="50" alt="'+ input.Name+'" /></span><span class="name-prod">'+input.Name+'</span></a>';

        return content;
    };
});
angular.module('app').factory('socketService',['$rootScope','$log', function($rootScope, $log){
    var createSocket = function(){

        var url = location.protocol + '//'+ location.host;        
        url += '/notify/' + notify_id + 'notify' + notify_hash;

        if(is_home()){
            url +="sendo360wwwvasuphome";
        }else if(is_cate()){
            url +="vasuphome"+cate_id;
        }else{
            if(notify_id == "" || notify_id == "sdp"){
                return;
            }
        }

        socket = new SockJS(url);
        socket.onopen = function(){
            var args = arguments;
            service.open = true;
            service.timesOpened++;

            $rootScope.$broadcast( 'SOCKET_CLOSED' );

            if( service.handlers.onopen ){
                $rootScope.$apply
                    ( function(){
                            service.handlers.onopen.apply( socket, args )
                        }
                    )
            }
        }

        socket.onmessage = function( data ){
            var args = arguments;
            try{
                args[0].data = JSON.parse(args[0].data);

            } catch(e){
                // there should be a better way to do this
                // but it is fast
            }
            if( service.handlers.onmessage ){
                $rootScope.$apply(
                    function(){
                        service.handlers.onmessage.apply(socket, args);
                    }
                )
            }
        }

        socket.onclose = function(){
            service.open = false;
            setTimeout( function(){ socket = createSocket(service); } , 60000 );
            var args = arguments;
            $rootScope.$broadcast( 'SOCKET_OPEN' );

            if( service.handlers.onclose ){
                $rootScope.$apply(
                    function(){
                        service.handlers.onclose.apply(socket,args);
                    }
                )
            }
        }

        return socket;
    }

    var service =
        { handlers : {}
        , onopen:
            function( callback ){
                this.handlers.onopen = callback;
            }
        , onmessage:
            function( callback ){
                this.handlers.onmessage = callback;
            }
        , onclose:
            function( callback ){
                this.handlers.onclose = callback;
            }
        , send:
            function( data ){
                var msg = typeof(data) == "object" ? JSON.stringify(data) : data;
                var status = socket.send(msg);
            }
        , open: false
        };

    var socket = createSocket();
    return service;
}]);

/*
Wishlist
*/

cgSendo.controller('Wishlist', ['$scope','$rootScope','$cookieStore','$http', function Wishlist($scope, $rootScope, $cookieStore, $http) {
    $scope.wishliststore = [];
    $scope.wishliststore_count = 0;
    $scope.wishlistFilter = function(data){
        $wishlist_tmp = {};
        $wishlist_result = [];
        angular.forEach(data, function(wl) {
            if(wl.Product_id != 0){
                $wishlist_tmp[wl.Product_id] = wl;    
            }
        });
        angular.forEach($wishlist_tmp, function(wl) {
            $wishlist_result.push({Product_id:wl.Product_id, Name:wl.Name, Image : wl.Image, Cat_path : wl.Cat_path})
        });
        return $wishlist_result;

    }
    $scope.getWishlist = function() {
        $wishlist = store.get('wishlist');

        if (typeof $wishlist == "undefined"){
            if(userLogin){

                $wishlist = $scope.getWishlistUser(user_id);

                if (typeof $wishlist == "undefined"){
                    $wishlist = [];
                }
            }else{
                $wishlist = [];
            }            
            
        }else{
            if(userLogin){
                $wishlist_user = $scope.getWishlistUser(user_id);
                if (typeof $wishlist_user == "undefined"){
                    $wishlist_user = [];
                }
                var tmp = [];
                for (i in $wishlist_user) {
                    tmp.push($wishlist_user[i].Product_id);
                };
                for (i in $wishlist) {
                    if(tmp.indexOf($wishlist[i].Product_id) <0){
                        $wishlist_user.unshift($wishlist[i]);
                    }
                };
                $wishlist = $wishlist_user;
            }
        }
        $wishlist = $scope.wishlistFilter($wishlist);
        store.set("wishlist",$wishlist);
        $scope.wishliststore = $wishlist;
        $scope.wishliststore_count = $scope.wishliststore.length;
    }

    $scope.addWishlist = function(product_id, name, image, cat_path) {
        $wishlist = store.get('wishlist');
        if (typeof $wishlist == "undefined"){
            $wishlist = [];
        }
        $scope.wishliststore = $wishlist;
        var is_exists = false;
        for(i in $scope.wishliststore){
            if($scope.wishliststore[i].Product_id == product_id){
                is_exists = true;
            }
        }
        if(is_exists == false){
            var product = {Product_id:product_id, Name:name, Image : image, Cat_path : cat_path};            
            $scope.wishliststore.unshift(product);            
        }
        $scope.wishliststore = $scope.wishlistFilter($scope.wishliststore);
        if(userLogin){
            $scope.addWishlist_U(user_id,$scope.wishliststore);
        }        
        store.set('wishlist',$scope.wishliststore);
    }

    $scope.removeWishlist = function(product_id) {
        $wishlist = store.get('wishlist');
        if (typeof $wishlist == "undefined"){
            $wishlist = [];
        }
        $wishlist_tmp = [];
        $scope.wishliststore = $wishlist;
        angular.forEach($scope.wishliststore, function(wl) {
            if (wl.Product_id != product_id){
                 $wishlist_tmp.push({Product_id:wl.Product_id, Name:wl.Name, Image : wl.Image, Cat_path : wl.Cat_path})                 
            }
        });
        $scope.wishliststore = $scope.wishlistFilter($wishlist_tmp);
        if(userLogin){
            $scope.addWishlist_U(user_id,$scope.wishliststore);
        }
        store.set('wishlist', $scope.wishliststore);
        $scope.wishliststore_count = $scope.wishliststore.length;

    }

    $scope.removeAllWishlist = function() {
        store.remove('wishlist');
        $scope.wishliststore = [];
        $scope.getWishlist();
    }
    $scope.getWishlistUser = function(c_id) {
        var result = [];
        var url = location.protocol + '//'+ location.host + '/service/product/get-wishlist/'+c_id;        
       jQuery.ajax({
           url: url,
           type:"GET",
           async:false,
           dataType:"json",
           success:function(data){
                if(typeof data != "undefined" && data != null){
                    if (typeof data.Product_data != "undefined"){
                        result = data.Product_data;
                    }
                }
           },
           timeout:5000
        })
        return result;
    };
    $scope.addWishlist_U = function(c_id, product_data) {
        var p_data = product_data;
        var data = new Object();
        data.customer_id = c_id;
        data.wl_hash = wl_hash;
        data.product_data = p_data;
        data_json = JSON.stringify(data);

        var url = location.protocol + '//'+ location.host + '/api3/products/add-wishlist/';
        jQuery.ajax({
            url:url,
            data:data_json,
            dataType:"json",
            //async:false,
            type:"POST",
            success:function(response){
                $scope.getWishlistUser(user_id)            
            },
            timeout:5000,
        })
    };
}]);

function wl_modal_click(a,b,c,d,e){
    angular.element(jQuery('#boxFavorite')).scope().addWishlist(b,c,d,e);
    var nokia = a;
    var qt_box = $('#boxFavorite');    
    var imgtodrag = $(nokia).parents('.overflow_box').find(".imgtodrag");
    if (imgtodrag) {
        var imgclone = imgtodrag.clone().offset({
            top: imgtodrag.offset().top,
            left: imgtodrag.offset().left
        }).css({
                'opacity': '0.7',
                'position': 'absolute',
                'height': '150px',
                'width': '150px',
                'z-index': '100'
            })
            .appendTo($('body'))
            .animate({
                'top': qt_box.offset().top + 10,
                'left': qt_box.offset().left + 10,
                'width': 50,
                'height': 50
            }, 1000, 'easeInOutExpo');
        setTimeout(function () {
            qt_box.effect("shake", {
                times: 2
            }, 100);
        }, 800);
        imgclone.animate({
            'width': 0,
            'height': 0
        }, function () {/*imgtodrag.removeClass('imgtodrag');*/
            update_wl_detail();
            $('#boxFavorite').addClass('activeSub');
        });

    }
    jQuery('.bt-click2').click();     
}
function wl_modal_click_shop(a,b,c,d,e){
    angular.element(jQuery('#boxFavorite')).scope().addWishlist(b,c,d,e);
	update_wl_detail();
}
function get_wishlist(){
    
    jQuery('.bt-click2').click();
}

function remove_wl(e,r){
    var r = r || false;
    var pid = jQuery(e).attr("data-items");
    angular.element(jQuery('#boxFavorite')).scope().removeWishlist(pid);
    update_wl_detail();
    
    if(r){
        location.reload();
    }
    
}
function update_wl_detail(){
    var wl = store.get("wishlist");
    if(typeof  wl != "undefined"){
        jQuery("span.wl-num").html(wl.length);
    }
}
function wlcallback(data){
    tmp =[]
    for (i in data){
        tmp.push(data[i].product_data);
    }
    store.set("wishlish",tmp);
}
function check_notify_data(input){
    if(input.Type == 1){
        var data = input.Data;
        if(data.Merchant_name){
            return true
        }
        return false;
    }else if(input.Type == 2){

        var data = input.Data;
        if(data.Increment_id){
            return true;
        }
        return false;
    }else if(input.Type == 3){
        var data = input.Data;

        if(data.order.Status && data.order.Increment_id){
            if(data.order.Status == 'ecom_canceled'){
                return true;
            }else if(data.order.Status == 'ecom_delay' || data.order.Status == 'ecom_delayed'){
                return true;
            }else if(data.order.Status == 'ecom_delivering'){
                return true;
            }else if(data.order.Status == 'ecom_pod'){
                return true;
            }else if(data.order.Status == 'ecom_processing'){
                return true;
            }
        }
        return false;

    }else if(input.Type == 4){
        var data = input.Data;
        if(data.Merchant && data.Product_count){
            return true;
        }
        return content;
    }else if(input.Type == 5){
        var data = input.Data;
        if(data.Customer){
            return true;
        }
        return false;
    }else if(input.Type == 6){
        var data = input.Data;
        if(data.Customer_name){
            return true;
        }
        return false;;
    }else if(input.Type == 61){
        var data = input.Data;
        if(data.Customer_name){
            return true;
        }
        return false;
    }else{
        return "";
    }

}
function is_home(){
    return (location.pathname == "index.html") ? true:false;
}

function is_cate(){
    var cate_list = ["/thoi-trang-nu/","thoi-trang-nam/index.html","me-va-be/index.html","phu-kien-cong-nghe/index.html","the-thao-giai-tri/index.html","do-dung-trong-nha/index.html","my-pham/index.html","khong-gian-song/index.html","do-dien-gia-dung/index.html","/thuc-pham/"]
    for (i in cate_list){
        if(cate_list[i] == location.pathname){
            return true
        }
    }
    return false;
}
 
var dateFormat = function () {
    var    token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
        timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
        timezoneClip = /[^-+\dA-Z]/g,
        pad = function (val, len) {
            val = String(val);
            len = len || 2;
            while (val.length < len) val = "0" + val;
            return val;
        };

    // Regexes and supporting functions are cached through closure
    return function (date, mask, utc) {
        var dF = dateFormat;

        // You can't provide utc if you skip other args (use the "UTC:" mask prefix)
        if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
            mask = date;
            date = undefined;
        }

        // Passing date through Date applies Date.parse, if necessary
        date = date ? new Date(date) : new Date;
        if (isNaN(date)) throw SyntaxError("invalid date");

        mask = String(dF.masks[mask] || mask || dF.masks["default"]);

        // Allow setting the utc argument via the mask
        if (mask.slice(0, 4) == "UTC:") {
            mask = mask.slice(4);
            utc = true;
        }

        var    _ = utc ? "getUTC" : "get",
            d = date[_ + "Date"](),
            D = date[_ + "Day"](),
            m = date[_ + "Month"](),
            y = date[_ + "FullYear"](),
            H = date[_ + "Hours"](),
            M = date[_ + "Minutes"](),
            s = date[_ + "Seconds"](),
            L = date[_ + "Milliseconds"](),
            o = utc ? 0 : date.getTimezoneOffset(),
            flags = {
                d:    d,
                dd:   pad(d),
                ddd:  dF.i18n.dayNames[D],
                dddd: dF.i18n.dayNames[D + 7],
                m:    m + 1,
                mm:   pad(m + 1),
                mmm:  dF.i18n.monthNames[m],
                mmmm: dF.i18n.monthNames[m + 12],
                yy:   String(y).slice(2),
                yyyy: y,
                h:    H % 12 || 12,
                hh:   pad(H % 12 || 12),
                H:    H,
                HH:   pad(H),
                M:    M,
                MM:   pad(M),
                s:    s,
                ss:   pad(s),
                l:    pad(L, 3),
                L:    pad(L > 99 ? Math.round(L / 10) : L),
                t:    H < 12 ? "a"  : "p",
                tt:   H < 12 ? "am" : "pm",
                T:    H < 12 ? "A"  : "P",
                TT:   H < 12 ? "AM" : "PM",
                Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
                o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
                S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
            };

        return mask.replace(token, function ($0) {
            return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
        });
    };
}();

// Some common format strings
dateFormat.masks = {
    "default":      "ddd mmm dd yyyy HH:MM:ss",
    shortDate:      "m/d/yy",
    mediumDate:     "mmm d, yyyy",
    longDate:       "mmmm d, yyyy",
    fullDate:       "dddd, mmmm d, yyyy",
    shortTime:      "h:MM TT",
    mediumTime:     "h:MM:ss TT",
    longTime:       "h:MM:ss TT Z",
    isoDate:        "yyyy-mm-dd",
    isoTime:        "HH:MM:ss",
    isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
    isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};

// Internationalization strings
dateFormat.i18n = {
    dayNames: [        
        "Chủ nhật", "Thứ hai", "Thứ 3", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"
    ],
    monthNames: [
        "Tháng giêng", "Tháng hai", "Tháng ba", "Tháng tư", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai"
    ]
};

// For convenience...
Date.prototype.format = function (mask, utc) {
    return dateFormat(this, mask, utc);
};
