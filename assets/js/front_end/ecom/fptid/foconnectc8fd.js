var userLogin = false;
var session_id = 0;
var session_hash = '';
var notify_id = 'sdp';
var notify_hash = 'e5765daf73117e5362122ccefe089ac5';
var user_id = 0;
var wl_hash = '';
var is_shop = false;
var fpt_id = 0;
var tracking_id = 0;
var data_login = [];
var user_last_name = "";
var saq_user_data = "";// this variable is used by sendo analytic, don't modify or delete;

if (!window.FOConnect)
    window.FOConnect = FOConnect = {
        redirect: null,
        loadFospScript: function (a, b, c) {
            var d = document.createElement("script");
            d.type = "text/javascript";
            d.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + a;
            if (!!b) {
                d.defer = "defer";
                d.async = true;
            }
            ;
            if (c instanceof Function)
                d.onreadystatechange = function () {
                    "loaded" === this.readyState && c.apply({}, [])
                }, d.onload = c;
            a = document.getElementsByTagName("script")[0];
            a.parentNode.insertBefore(d, a);
        },
        cookie: function (a, b, c) {
            if (1 < arguments.length && "[object Object]" !== "" + b) {
                c = "object" === typeof c ? c : {};

                if (null === b || void 0 === b)
                    c.expires = -1;
                if ("number" === typeof c.expires) {
                    var d = c.expires, e = c.expires = new Date;
                    e.setDate(e.getDate() +
                            d)
                }
                b = "" + b;
                return document.cookie = [encodeURIComponent(a), "=", c.raw ? b : encodeURIComponent(b), c.expires ? "; expires=" + c.expires.toUTCString() : "", c.path ? "; path=" + c.path : "", c.domain ? "; domain=" + c.domain : "", c.secure ? "; secure" : ""].join("")
            }
            c = b || {};

            e = c.raw ? function (a) {
                return a
            } : decodeURIComponent;
            return(d = RegExp("(?:^|; )" + encodeURIComponent(a) + "=([^;]*)").exec(document.cookie)) ? e(d[1]) : null
        },
        addListen: function (a, b, c) {
            Ed = function (a) {
                a.preventDefault ? a.preventDefault() : a.returnValue = false;
                return false;
            };
            El = window.addEventListener ? function (a, b, c) {
                var d = function (a) {
                    var b = c.call(this, a);
                    false === b && Ed(a);
                    return b;
                }
                a.addEventListener(b, d, false);
                return d;
            } : window.attachEvent ? function (a, b, c) {
                var d = function () {
                    var b = window.event, d = c.call(a, b);
                    false === d && Ed(b);
                    return d;
                };
                a.attachEvent("on" + b, d);
                return d;
            } : void 0;
            El(a, b, c);
        },
        isGoodBrowser: function () {
            var a = navigator.userAgent, b = a.indexOf("MSIE ");
            return-1 != b && 8 > parseFloat(a.substring(b + 5, a.indexOf(";", b))) ? !1 : !0
        },
        popupCenter: function (a, b, c, d, e, f) {
            "undefined" ===
                    typeof e && (e = screen.width / 2 - b / 2);
            "undefined" === typeof d && (d = screen.height / 2 - c / 2);
            120 < d && (d -= 70);
            a = window.open(a, "_blank", "menubar=0,resizable=1,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=yes,copyhistory=no," + ("width=" + b + ", height=" + c + ", top=" + d + ", left=" + e));
            "function" === typeof a.focus && !f && a.focus();
            return a
        },
        doLogin: function (a) {
            FOConnect.redirect = a || FOConnect.redirect;
            window.location.href = FOConnect.redirect;
        },
        logout: function (a) {
            FOConnect.doLogoutCallback();
            a = a || FOConnect.logouturl;
            FOConnect.deleteAllCookies();
            var c = document.getElementById(FOConnect.loginNodeId);
            var b = '<iframe src="' + "https://id.fpt.net/logout/?referersp=" + encodeURIComponent(a) + '" frameborder="0" style="border: 0 none; height:0px; overflow: hidden; width:0px; top: -10000; position: absolute; display:none;" onload="FOConnect.doLogoutCallback()" ></iframe>';
            c.innerHTML = b;
        },
        doLogoutCallback: function () {
            window.location.href = FOConnect.logouturl;
        },
        deleteAllCookies: function () {
            var cookies = document.cookie.split(";");
            var mydate = new Date();
            mydate.setTime(mydate.getTime() - 1);
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i];
                var eqPos = cookie.indexOf("=");
                var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                document.cookie = name + "=;expires=" + mydate.toGMTString();
            }
        },
        login: function (a) {
            FOConnect.redirect = a;
            try {
                if ("function" === typeof FOConnect.redirect) {
                    FOConnect.doLogin = function () {
                        try {
                            FOConnect.redirect.apply({}, arguments);
                        } catch (c) {
                            alert(c);
                        }
                    };
                } else {
                    if ("string" === typeof FOConnect.redirect && 0 === FOConnect.redirect.indexOf(location.protocol + "//" + location.host)) {
                        FOConnect.redirect = FOConnect.redirect.replace(/#.*$/, "");
                    } else {
                        FOConnect.redirect = FOConnect.loginurl;
                    }
                    FOConnect.doLogin = function () {
                        window.location.href = FOConnect.redirect;
                    };
                }
                d = "https://id.fpt.net/?display=connect&receiver=" + encodeURIComponent(FOConnect.receiver) + "&referersp=" + encodeURIComponent(FOConnect.receiver + '?action=foconnect&login=1&out=' + ST_DOMAIN + 'sso');
                FOConnect.popupCenter(d, 510, 440, 50);

            } catch (f) {
            }
        },
        register: function (a, refererUrl) {

            FOConnect.redirect = a;
            try {
                var reffersp = a + '?action=foconnect';
                if (typeof refererUrl != 'undefined') {
                    reffersp = reffersp + '&refererUrl=' + refererUrl;
                }
                var url = 'https://id.fpt.net/dang-ky-tai-khoan.html?referersp=' + encodeURIComponent(reffersp);

                FOConnect.popupCenter(url, 603, 490, 50);
            } catch (f) {
            }
        },
        activeEmail: function () {
            try {
                var url = 'https://id.fpt.net/kich-hoat-email.html?referersp=' + encodeURIComponent(FOConnect.baseurl + 'sso.php?action=foconnect');
                FOConnect.popupCenter(url, 603, 400);
            } catch (f) {
            }
        },
        changeEmail: function () {
            try {
                var url = 'https://id.fpt.net/cap-nhat-email.html?referersp=' + encodeURIComponent(FOConnect.baseurl + 'sso.php?action=foconnect');
                FOConnect.popupCenter(url, 603, 400);
            } catch (f) {
            }
        },
        fptIdCheck: function () {
            id = FOConnect.cookie('Fid') || 0;
            FOConnect.loadFoScript('https://id.fpt.net/index/foconnect/id/' + id + '/foconnect.js?receiver=' + encodeURIComponent(FOConnect.receiver) + '&layout=' + FOConnect.raw, !0);
        },
        doSync: function (a) {
            if (FOConnect.syncsesion) {
                window.location.href = FOConnect.loginurl;
                //location.reload();
            }
            if (FOConnect.raw) {
                FOConnect.layout.apply({}, a);
            }
        },
        isLogedIn: false,
        userInfoHandler: function (html) {
            //var profilePath = FOConnect.baseurl + 'customer/account/intro/';
            //var avatarUrl = response.user.avatar;
            if (html.trim() != '') {
                this.isLogedIn = true;
                jQuery('.login_box').html(html);
                jQuery('.login_box').removeClass('home');

                checkShop();
                if (typeof checkLogin == 'function') {
                    //checklogin cho trang detail
                    checkLogin();
                }
            }

        },
        checkUserLogin: function (url) {
            jQuery.ajax({
                type: 'GET',
                url: url,
                success: function (response) {
                    FOConnect.userInfoHandler(response);
                    $(document).trigger('onColumnHeightChange');
                }
            });

        },
        getSession: function (url) {
            jQuery.ajax({
                type: 'GET',
                url: url,
                async: false,
                success: function (response) {
                    var gtm_userid;
                    var obj_user = {
                        'sessionid': response.session_id ? response.session_id : 'anonymous',
                        'event' : 'authentication'
                    };
                    if (response.user_id) {
                        obj_user['userid'] = user_id = response.user_id;
                        gtm_userid = response.user_id;
                    } else {
                        gtm_userid = response.session_id ? response.session_id : 'anonymous';
                    }
                    var dataLayer = dataLayer || [];
                    dataLayer.push(obj_user);
                    if (response.is_login) {
                        userLogin = response.is_login;
                        user_last_name = response.user_last_name;
                        if (response.data.user.fpt_id) {
                            fpt_id = response.data.user.fpt_id;
                        }
                        if (response.data.user) {
                            data_login.push('"login_email":"' + response.data.user.username + '"');
                            data_login.push('"login_id":"' + response.data.user.fpt_id + '"');
                            data_login.push('"login_type":"' + response.login_type + '"');

                            saq_user_data = response.data.user;
                            if(response.login_type){
                                saq_user_data.login_type = response.login_type;
                            }
                        }
                    }
                    if (response.session_id) {
                        session_id = response.session_id;
                    }
                    if (response.session_hash) {
                        session_hash = response.session_hash;
                    }
                    if (response.notify_id) {
                        notify_id = response.notify_id;
                    }
                    if (response.notify_hash) {
                        notify_hash = response.notify_hash;
                    }
                    if (response.wl_hash) {
                        wl_hash = response.wl_hash;
                    }
                    if (response.tracking_id) {
                        tracking_id = response.tracking_id;
                    }
                }
            });

        },
        loadScript: function (a, b) {
            FOConnect.loadFoScript(a, b, !0)
        },
        loadFoScript: function (a, b, c) {
            var d = document.createElement("script");
            d.type = "text/javascript";
            d.src = a;
            if (c)
                d.defer = "defer", d.async = !0;
            if (b instanceof Function)
                d.onreadystatechange = function () {
                    "loaded" === this.readyState && b.apply({}, [])
                }, d.onload = b;
            a = document.getElementsByTagName("script")[0];
            a.parentNode.insertBefore(d, a);
        },
        init: function (a) {
            var href = window.location.href;
            FOConnect.receiver = a.receiver || a.baseurl + 'sso.php';
            FOConnect.logouturl = a.logouturl || href;
            FOConnect.loginurl = a.loginurl || href;
            FOConnect.loginNodeId = a.loginNodeId;
            FOConnect.baseurl = a.baseurl;
            FOConnect.skinurl = a.skinurl;
            FOConnect.raw = a.raw || !1;
            FOConnect.layout = "function" === typeof a.layout ? a.layout : function () {
            };
            FOConnect.syncsesion = a.syncsesion || !0;
            //FOConnect.fptIdCheck();
        },
        detailProduct: function (is_loggin) {
        }
    };

if (!window.OpenIDConnect)
    window.OpenIDConnect = OpenIDConnect = {
        loadScript: function (a, b, c) {
            var d = document.createElement("script");
            d.type = "text/javascript";
            d.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + a;
            if (!!b) {
                d.defer = "defer";
                d.async = true;
            }
            ;
            if (c instanceof Function)
                d.onreadystatechange = function () {
                    "loaded" === this.readyState && c.apply({}, [])
                }, d.onload = c;
            a = document.getElementsByTagName("script")[0];
            a.parentNode.insertBefore(d, a);
        },
        cookie: function (a, b, c) {
            if (1 < arguments.length && "[object Object]" !== "" + b) {
                c = "object" === typeof c ? c : {};

                if (null === b || void 0 === b)
                    c.expires = -1;
                if ("number" === typeof c.expires) {
                    var d = c.expires, e = c.expires = new Date;
                    e.setDate(e.getDate() +
                            d)
                }
                b = "" + b;
                return document.cookie = [encodeURIComponent(a), "=", c.raw ? b : encodeURIComponent(b), c.expires ? "; expires=" + c.expires.toUTCString() : "", c.path ? "; path=" + c.path : "", c.domain ? "; domain=" + c.domain : "", c.secure ? "; secure" : ""].join("")
            }
            c = b || {};

            e = c.raw ? function (a) {
                return a
            } : decodeURIComponent;
            return(d = RegExp("(?:^|; )" + encodeURIComponent(a) + "=([^;]*)").exec(document.cookie)) ? e(d[1]) : null
        },
        hash: function (s) {
            return Base64.encode(JSON.stringify(s));
        },
        login: function (a) {
            var Reg = /\?/g;
            a = Reg.test(a) ? a + "&current_url=" : a + "?current_url=";
            a = a + encodeURIComponent(OpenIDConnect.redirect_url);
            a = Reg.test(a) ? a + "&old_url=" : a + "?old_url=";
            a = a + encodeURIComponent(OpenIDConnect.old_url);

            window.location.href = a || OpenIDConnect.loginurl;
        },
        init: function (a) {
            var href = window.location.href;
            OpenIDConnect.redirect_url = a.redirect_url || href;
            OpenIDConnect.loginurl = a.loginurl || href;
            OpenIDConnect.old_url = a.old_url || href;
            OpenIDConnect.fb_url = a.fb_url || href;
            OpenIDConnect.gg_url = a.gg_url || href;
            OpenIDConnect.yh_url = a.yh_url || href;

        },
        fb_login: function (a, b)
        {
            var a = a || false;
            var a = b || false;
            removeOnclick();
            url = OpenIDConnect.fb_url;
            jQuery.ajax({
                url: url,
                data: {_t: (new Date().getTime()), auth_url: true},
                dataType: "json",
                cache: false,
                async: false,
                type: 'POST',
                success: function (obj) {
                    if (obj.auth_url) {
                        if (a) {
                            PopupManager.open(obj.auth_url, 500, 300, b);
                        } else {
                            PopupManager.open(obj.auth_url, 500, 300, OpenIDConnect.fb_callback_login)
                        }
                    }
                }
            });


        },
        fb_callback_login: function ()
        {
            OpenIDConnect.login(OpenIDConnect.loginurl);
        },
        gg_login: function (a, b) {
            var a = a || false;
            var a = b || false;
            removeOnclick();
            url = OpenIDConnect.gg_url;
            jQuery.ajax({
                url: url,
                data: {_t: (new Date().getTime()), auth_url: true},
                dataType: "json",
                cache: false,
                async: false,
                type: 'POST',
                success: function (obj) {
                    if (obj.auth_url) {
                        if (a) {
                            PopupManager.open(obj.auth_url, 500, 450, b);
                        } else {
                            PopupManager.open(obj.auth_url, 500, 450, OpenIDConnect.gg_callback_login)
                        }
                    }
                }
            });
        },
        gg_callback_login: function () {
            OpenIDConnect.login(OpenIDConnect.loginurl);
        },
        yh_login: function (a, b) {
            var a = a || false;
            var a = b || false;
            removeOnclick();
            url = OpenIDConnect.yh_url;
            jQuery.ajax({
                url: url,
                data: {_t: (new Date().getTime()), auth_url: true},
                dataType: "json",
                cache: false,
                type: 'GET',
                async: false,
                success: function (obj) {
                    if (obj.auth_url) {
                        if (a) {
                            PopupManager.open(obj.auth_url, 500, 365, b);
                        } else {
                            PopupManager.open(obj.auth_url, 560, 365, OpenIDConnect.yh_callback_login)
                        }
                    }
                }
            });
        },
        yh_callback_login: function () {
            OpenIDConnect.login(OpenIDConnect.loginurl);
        },
        checkEmailExist: function (value, element) {

            chkEmailResult = false;
            jQuery('#reg_email').removeClass('validation-failed');
            if (jQuery.trim(value))
            {
                if (!OpenIDConnect.validateEmail(value)) {
                    jQuery('#reg_error_email').html("Vui lòng nhập địa chỉ email hợp lệ. Ví du abc@domain.com.");
                    jQuery('#reg_email').addClass('validation-failed');
                    return false;
                }
                jQuery.ajax({
                    type: 'POST',
                    cache: false,
                    async: false,
                    url: DOMAIN + "general/login/checkEmailExists/",
                    data: "email=" + value,
                    dataType: 'json',
                    success: function (data) {
                        if(data.exist){
                            chkEmailResult = false;
                            jQuery('#reg_error_email').html("Email này đã được đăng ký.");
                            jQuery('#reg_email').addClass('validation-failed');
                        } else {
                            jQuery('#reg_error_email').html('');
                            chkEmailResult = true;
                        }
                    }

                });
            } else {
                jQuery('#reg_error_email').html("Bạn chưa nhập email.");
                jQuery('#reg_email').addClass('validation-failed');
            }
            return chkEmailResult;

        },
        validateEmail: function ($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,3})?$/;
            if (!emailReg.test($email)) {
                return false;
            } else {
                return true;
            }
            jQuery.ajax({
                type: 'POST',
                cache:false,
                async:false,
                url: DOMAIN + "general/login/checkEmailExists/",
                data: "email="+value,
                dataType: 'json',
                success:function(data){
                    if(data){
                        chkEmailResult = false;
                        jQuery('#reg_error_email').html("Email này đã được đăng ký.");
                        jQuery('#reg_email').addClass('validation-failed');
                    }else{
                        jQuery('#reg_error_email').html('');
                        chkEmailResult =true;
                    }
                }

            });
        }

    }
/*Base64*/
/**
 *
 *  Base64 encode / decode
 *  http://www.webtoolkit.info/
 *
 **/
var Base64 = {
// private property
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
// public method for encoding
    encode: function (input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = Base64._utf8_encode(input);

        while (i < input.length) {

            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output +
                    this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
                    this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

        }

        return output;
    },
// public method for decoding
    decode: function (input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {

            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }

        }

        output = Base64._utf8_decode(output);

        return output;

    },
// private method for UTF-8 encoding
    _utf8_encode: function (string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },
// private method for UTF-8 decoding
    _utf8_decode: function (utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while (i < utftext.length) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

}

/*end base 64*/
var PopupManager = {
    popup_window: null,
    interval: null,
    interval_time: 80,
    waitForPopupClose: function (cb) {
        if (PopupManager.isPopupClosed()) {
            PopupManager.destroyPopup();
            if (cb) {
                if (typeof (cb) == 'function') {
                    cb();
                } else {
                    //case for comment
                    FOConnect.getSession(DOMAIN + 'general/login/getSession/');
                    FOConnect.checkUserLogin(DOMAIN + 'general/login/checkLogin/');
                    checkLogin(userLogin);
                    jQuery('#modalLogin').modal('hide');
                    jQuery("#" + cb).submit();
                }
            } else {
                window.location.reload();
            }
        }
    },
    destroyPopup: function () {
        this.popup_window = null;
        window.clearInterval(this.interval);
        this.interval = null;
    },
    isPopupClosed: function () {
        return (!this.popup_window || this.popup_window.closed);
    },
    open: function (url, width, height, cb) {
        this.popup_window = window.open(url, "", this.getWindowParams(width, height));
        this.interval = window.setInterval(this.waitForPopupClose, this.interval_time, cb);
        return this.popup_window;
    },
    getWindowParams: function (width, height) {
        var center = this.getCenterCoords(width, height);
        return "width=" + width + ",height=" + height + ",status=1,location=1,resizable=yes,left=" + center.x + ",top=" + center.y;
    },
    getCenterCoords: function (width, height) {
        var parentPos = this.getParentCoords();
        var parentSize = this.getWindowInnerSize();

        var xPos = parentPos.width + Math.max(0, Math.floor((parentSize.width - width) / 2));
        var yPos = parentPos.height + Math.max(0, Math.floor((parentSize.height - height) / 2));

        return {x: xPos, y: yPos};
    },
    getWindowInnerSize: function () {
        var w = 0;
        var h = 0;

        if ('innerWidth' in window) {
            // For non-IE
            w = window.innerWidth;
            h = window.innerHeight;
        } else {
            // For IE
            var elem = null;
            if (('BackCompat' === window.document.compatMode) && ('body' in window.document)) {
                elem = window.document.body;
            } else if ('documentElement' in window.document) {
                elem = window.document.documentElement;
            }
            if (elem !== null) {
                w = elem.offsetWidth;
                h = elem.offsetHeight;
            }
        }
        return {width: w, height: h};
    },
    getParentCoords: function () {
        var w = 0;
        var h = 0;

        if ('screenLeft' in window) {
            // IE-compatible variants
            w = window.screenLeft;
            h = window.screenTop;
        } else if ('screenX' in window) {
            // Firefox-compatible
            w = window.screenX;
            h = window.screenY;
        }
        return {width: w, height: h};
    }
}

function removeOnclick() {
    jQuery('.fb').removeAttr('onclick');
    jQuery('.login-fb').removeAttr('onclick');
    jQuery('.go').removeAttr('onclick');
    jQuery('.login-go').removeAttr('onclick');
    jQuery('.ya').removeAttr('onclick');
    jQuery('.login-ya').removeAttr('onclick');
}