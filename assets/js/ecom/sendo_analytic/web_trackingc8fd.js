/**
 * Created by namdt9 on 3/27/15.
 */
//if user already push message to _saq before file finish loading
//save message to a temp variable so we can use _saq to call api later
if(typeof _saq !== 'undefined'){
    if(Object.prototype.toString.call( _saq )==='[object Array]'){
        //If there any other _saq12345_tmp declare global,do nothing right after loading site
        if (typeof _saq12345_tmp === 'undefined'){
            _saq12345_tmp = _saq;
        }else{
            console.log('the variable _saq12345_tmp has been declared somewhere outside');
        }
    }
}

_saq = (function () {
    var q = [];
    var domain = window.location.hostname;
    var appId = '';
    var detectReferrer = function(){
        return encodeURIComponent(document.referrer);
    };

    var getClientTime = function(){
        var currentDate = new Date();
        return currentDate.getTime();

    }

    var isGoogleBog = function(){
        var userAgent = navigator.userAgent.replace(/\;/g, ',');
        if(userAgent.toLowerCase().indexOf("googlebog") != -1){
            return true;
        }else{
            return false;
        }
    }


    var detectDevice = function(){
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            return "mobile";
        }else{
            return "desktop";
        }
    };

    /*var detectDevice = function(){
        var check = "desktop";
        (function(a,b){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od|ad)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = "mobile"})(navigator.userAgent||navigator.vendor||window.opera);
        return check;
    }*/

    //private functions
    var run = function() {
        if(q.length)q.shift().call();
    };

    var isRegister = function(){
        if('' === domain || '' === appId) return false;
        return true;
    };

    var gatherTrackProductAccess = function(jsonString){
        try{
            var track = {
                login_id:null,
                login_email:null,
                login_type:null,
                product_id:null,
                belong_cate_lvl1_id: null,
                belong_cate_lvl2_id:null,
                belong_cate_lvl3_id:null,
                belong_cate_lvl1_name: null,
                belong_cate_lvl2_name:null,
                belong_cate_lvl3_name:null,
                belong_shop_id:null,
                page_id:null
            };
            track.domain = domain;
            track.user_id = _saqCookies.getItem("tracking_id");
            track.client_time = getClientTime();
            track.referrer = detectReferrer();
            track.device = detectDevice() ;
            track.href = encodeURIComponent(window.location.href);
            var param = JSON.parse(jsonString);
            for(var key in param){
                if(track.hasOwnProperty(key)){
                    track[key] = param[key];
                }
            }
            return JSON.stringify(track);
        }catch(e){
            return false;
        }
    }

    var gatherTrackCategoryAccess = function(jsonString){
        try{
            var track = {
                login_id:null,
                login_email:null,
                login_type:null,
                access_cate_id:null,
                access_cate_lvl:null,
                belong_cate_lvl1_id: null,
                belong_cate_lvl2_id:null,
                belong_cate_lvl3_id:null,
                belong_cate_lvl1_name:null,
                belong_cate_lvl2_name:null,
                belong_cate_lvl3_name:null
            };
            track.domain = domain;
            track.user_id = _saqCookies.getItem("tracking_id");
            track.client_time = getClientTime();
            track.referrer = detectReferrer();
            track.device = detectDevice() ;
            track.href = encodeURIComponent(window.location.href);
            var param = JSON.parse(jsonString);
            for(var key in param){
                if(track.hasOwnProperty(key)){
                    track[key] = param[key];
                }
            }
            return JSON.stringify(track);
        }catch(e){
            return false;
        }
    }

    var gatherTrackLinkImpress = function(jsonString){
        try{
            var track = {
                login_id:null,
                login_email:null,
                login_type:null,
                from_page_id:null,
                from_cate_id:null,
                from_product_id:null,
                from_block_id:null,
                from_shop_id:null,
                recommend:null,
                to_page_id:null,
                to_cate_id:null,
                to_product_id:null,
                to_block_id:null,
                to_shop_id:null,
                to_href:null
            };
            track.domain = domain;
            track.user_id = _saqCookies.getItem("tracking_id");
            track.client_time = getClientTime();
            track.referrer = detectReferrer();
            track.device = detectDevice() ;
            track.from_href = encodeURIComponent(window.location.href);
            var param = JSON.parse(jsonString);
            for(var key in param){
                if(track.hasOwnProperty(key)){
                    track[key] = param[key];
                }
            }
            return JSON.stringify(track);
        }catch(e){
            return false;
        }
    }

    var gatherTrackImpressData = function(jsonString){
        try{
            var track = {
                login_id:null,
                login_email:null,
                login_type:null,
                from_page_id:null,
                from_cate_id:null,
                from_product_id:null,
                from_block_id:null,
                from_shop_id:null,
                recommend:null,
                to_page_id:null,
                to_cate_id:null,
                to_product_id:null,
                to_block_id:null,
                to_shop_id:null,
                to_href:null

            };
            track.domain = domain;
            track.user_id = _saqCookies.getItem("tracking_id");
            track.client_time = getClientTime();
            track.referrer = detectReferrer();
            track.device = detectDevice() ;
            track.from_href = encodeURIComponent(window.location.href);
            var param = JSON.parse(jsonString);
            for(var key in param){
                if(track.hasOwnProperty(key)){
                    track[key] = param[key];
                }
            }
            return JSON.stringify(track);
        }catch(e){
            return false;
        }
    }

    var gatherTrackClickData = function(jsonString){

        try{
            var track = {
                login_id:null,
                login_email:null,
                login_type:null,
                from_page_id:null,
                from_cate_id:null,
                from_product_id:null,
                from_block_id:null,
                from_shop_id:null,
                recommend:null,
                to_page_id:null,
                to_cate_id:null,
                to_product_id:null,
                to_block_id:null,
                to_shop_id:null,
                to_href:null
            };
            track.domain = domain;
            track.user_id = _saqCookies.getItem("tracking_id");
            track.client_time = getClientTime();
            track.referrer = detectReferrer();
            track.device = detectDevice();
            track.from_href = encodeURIComponent(window.location.href);

            var param = JSON.parse(jsonString);
            for(var key in param){
                if(track.hasOwnProperty(key)){
                    track[key] = param[key];
                }
            }
            return JSON.stringify(track);
        }catch(e){
            return false;
        }

    }

    var gatherTrackLinkClick = function(jsonString){

        try{
            var track = {
                login_id:null,
                login_email:null,
                login_type:null,
                from_page_id:null,
                from_cate_id:null,
                from_product_id:null,
                from_block_id:null,
                from_shop_id:null,
                recommend:null,
                to_page_id:null,
                to_cate_id:null,
                to_product_id:null,
                to_block_id:null,
                to_shop_id:null,
                to_href:null
            };
            track.domain = domain;
            track.user_id = _saqCookies.getItem("tracking_id");
            track.client_time = getClientTime();
            track.referrer = detectReferrer();
            track.device = detectDevice();
            track.from_href = encodeURIComponent(window.location.href);;
            var param = JSON.parse(jsonString);
            for(var key in param){
                if(track.hasOwnProperty(key)){
                    track[key] = param[key];
                }
            }
            return JSON.stringify(track);
        }catch(e){
            return false;
        }

    }

    var sendXmlHttpRequest = function(taskName, params){
        try{
            if(isGoogleBog()) return false;
            var fluentd_url = location.protocol + '//track.sendo.vn/';
            var url = fluentd_url + taskName;
            var strPush= 'json=' + params.toString();
            var http = new XMLHttpRequest();
            http.open("POST.html", url, true);
            //Send the proper header information along with the request
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            /*http.onreadystatechange = function() {//Call a function when the state changes.
                if(http.readyState == 4 && http.status == 200) {
                    console.log(http.responseText);
                }
            }*/
            http.send(strPush);
        }catch(e){
            console.log("sendXmlHttpRequest failed: "+ e.message);
        }
    };





    //sendo tracker api
    var trackers = {

        trackClick : function(jsonString){
            var track = gatherTrackClickData(jsonString);
            if(track){
                sendXmlHttpRequest("clickTracking",track);
            }
            run();
        },

        trackLinkClick : function(jsonString){
            var track = gatherTrackLinkClick(jsonString);
            if(track){
                sendXmlHttpRequest("trackLinkClick",track);
            }
            run();
        },

        trackImpress: function(jsonString){
            var track = gatherTrackImpressData(jsonString);
            if(track){
                sendXmlHttpRequest("impressTracking",track);
            }
            run();
        },

        trackLinkImpress: function(jsonString){
            var track = gatherTrackLinkImpress(jsonString);
            if(track){
                sendXmlHttpRequest("trackLinkImpress",track);
            }
            run();
        },

        trackProductAccess: function(jsonString){
            var track = gatherTrackProductAccess(jsonString);
            if(track){
                sendXmlHttpRequest("trackProductAccess",track);
            }
            run();
        },

        trackCategoryAccess: function(jsonString){
            var track = gatherTrackCategoryAccess(jsonString);
            if(track){
                sendXmlHttpRequest("trackCategoryAccess",track);
            }
            run();
        },



        register : function(d,a){
            domain = d;appId = a;run();
        }



    };



    return {
        push : function (messages){
            try{
                var fn = messages.shift();
                var params = messages;
                q.push(function(){ trackers[fn].apply(null,params||[]); });
                run();
            }catch(e){
                console.log("pushing failed: " + e);
            }
        },
        test : function(){
            var a = isMobile();
            console.log(a);
        }

    }
})();



if (typeof _saq12345_tmp !== 'undefined'){
    for(var i = 0 ; i < _saq12345_tmp.length; i ++){
        _saq.push(_saq12345_tmp[i]);
    }
}

 /*\
 |*|  A complete cookies reader/writer framework with full unicode support.
 |*|
 |*|  Revision #1 - September 4, 2014
 |*|
 |*|  https://developer.mozilla.org/en-US/docs/Web/API/document.cookie
 |*|  https://developer.mozilla.org/User:fusionchess
 |*|
 |*|  This framework is released under the GNU Public License, version 3 or later.
 |*|  http://www.gnu.org/licenses/gpl-3.0-standalone.html
 |*|
 |*|  Syntaxes:
 |*|
 |*|  * docCookies.setItem(name, value[, end[, path[, domain[, secure]]]])
 |*|  * docCookies.getItem(name)
 |*|  * docCookies.removeItem(name[, path[, domain]])
 |*|  * docCookies.hasItem(name)
 |*|  * docCookies.keys()
 |*|
 \*/

var _saqCookies = {
    getItem: function (sKey) {
        if (!sKey) { return null; }
        return decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
    },
    setItem: function (sKey, sValue, vEnd, sPath, sDomain, bSecure) {
        if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) { return false; }
        var sExpires = "";
        if (vEnd) {
            switch (vEnd.constructor) {
                case Number:
                    sExpires = vEnd === Infinity ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + vEnd;
                    break;
                case String:
                    sExpires = "; expires=" + vEnd;
                    break;
                case Date:
                    sExpires = "; expires=" + vEnd.toUTCString();
                    break;
            }
        }
        document.cookie = encodeURIComponent(sKey) + "=" + encodeURIComponent(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "") + (bSecure ? "; secure" : "");
        return true;
    },
    removeItem: function (sKey, sPath, sDomain) {
        if (!this.hasItem(sKey)) { return false; }
        document.cookie = encodeURIComponent(sKey) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "");
        return true;
    },
    hasItem: function (sKey) {
        if (!sKey) { return false; }
        return (new RegExp("(?:^|;\\s*)" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=")).test(document.cookie);
    },
    keys: function () {
        var aKeys = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "").split(/\s*(?:\=[^;]*)?;\s*/);
        for (var nLen = aKeys.length, nIdx = 0; nIdx < nLen; nIdx++) { aKeys[nIdx] = decodeURIComponent(aKeys[nIdx]); }
        return aKeys;
    }
};


