
/* fo register */
function fosp_register() {
    var register_loading = $('.signup-body .ajax-load-qa');
    register_loading.show();
    var register_error = $('#register_error');
    register_error.html('');
    var reg_error_email = $('#reg_error_email');
    reg_error_email.html('');
    $('input[type="text"], input[type="password"]').removeClass('validation-failed');
    var reg_email = $('#reg_email');
    var email = reg_email.val();
    if (email == '') {
        reg_email.addClass('validation-failed');
        reg_error_email.html("Vui lòng nhập địa chỉ email hợp lệ. Ví du abc@domain.com.").show();
        reg_email.focus();
        register_loading.hide();
        return false;
    }
    if (!validateEmail(email)) {
        reg_email.addClass('validation-failed').focus();
        reg_error_email.html("Vui lòng nhập địa chỉ email hợp lệ. Ví du abc@domain.com.").show();
        register_loading.hide();
        return false;
    }
    var reg_password = $('#reg_password');
    var reg_re_password = $('#reg_re_password');
    var p = reg_password.val();
    var rp = reg_re_password.val();
    if (p == '') {
        register_error.html('Vui lòng nhập mật khẩu.').show();
        reg_password.addClass('validation-failed').focus();
        register_loading.hide();
        return false;
    }
    if (p.length < 6 || p.length > 32) {
        register_error.html('Độ dài mật khẩu từ 6 đến 32 ký tự, vui lòng nhập lại.').show();
        reg_password.addClass('validation-failed');
        reg_password.focus();
        register_loading.hide();
        return false;
    }
    if (p != rp) {
        register_error.html('Mật khẩu không khớp nhau, vui lòng nhập lại.').show();
        reg_re_password.addClass('validation-failed');
        reg_re_password.focus();
        register_loading.hide();
        return false;
    }
    var reg_firstname = $('#reg_firstname');
    var fn = reg_firstname.val();
    if (fn == '') {
        register_error.html('Tên không được để trống.').show();
        reg_firstname.addClass('validation-failed').focus();
        register_loading.hide();
        return false;
    }
    var reg_lastname = $('#reg_lastname');
    var ln = reg_lastname.val();
    if (ln == '') {
        register_error.html('Họ và tên đệm không được để trống.').show();
        reg_lastname.addClass('validation-failed').focus();
        register_loading.hide();
        return false;
    }

//check captcha
    var captchaFlag = 1;
    jQuery.ajax({
        type: "POST",
        url: DOMAIN + 'general/login/validRegister/',
        data: $("#register-form-validate").serialize(),
        async: false,
        success: function(html) {
            if (html.type == 'captcha') {
                register_error.html('Mã captcha nhập không đúng, vui lòng nhập lại.').show();
                $('#catpcha_input').addClass('validation-failed');
                $('#catpcha_input').focus();
                register_loading.hide();
                captchaFlag = 0;
                return false;
            }
            if (html.type == 'email') {
                reg_email.addClass('validation-failed').focus();
                reg_error_email.html("Vui lòng nhập địa chỉ email hợp lệ. Ví du abc@domain.com.").show();
                register_loading.hide();
                captchaFlag = 0;
                return false;
            }
            return true;
        }
    });
    if (captchaFlag == 0)
        return false;
    var check = $("#check_agree").is(":checked");
    if (check == false) {
        register_error.html('Bạn phải đồng ý với các điều khoản sử dụng.').show();
        $('#check_agree').addClass('validation-failed');
        register_loading.hide();
        return false;
    }
}
function show_captcha() {
    jQuery.ajax({
        type: "GET",
        url: DOMAIN + 'gop-y/renewcaptcha/',
        success: function(html) {
            jQuery('.captcha_img').attr('src', html);
        }
    });
}

function fosp_login(a, b, c, d) {

    var x = $('.radio-login').is(":visible");
    if (x) {
        jQuery('.login-body .ajax-load-qa').show();
    var rdo = $("#login-form-validate input[type='radio'][name='radioLogin']:checked").val();
        if (rdo == "not_login")
            return false;
    }
    var a = a || false;
    var a = b || false;
    var c = c || false;
    jQuery('input[type="text"], input[type="password"]').removeClass('validation-failed');
    if (c == true) {
        $('#loading').show();
        var login_error = jQuery('#login_error_header');
        login_error.html('');
        var log_username_header = jQuery('#log_username_header');
        var log_password_header = jQuery('#log_password_header');
        var login_form_header = jQuery("#login-form-validate-header");
        email = log_username_header.val();
        pass = log_password_header.val();
        data = login_form_header.serialize();
        if (email == '') {
            log_username_header.addClass('validation-failed');
            jQuery('#login_error_header').html('Vui lòng nhập địa chỉ email.');
            jQuery('#loading').hide();
            return false;
        }
        if (!validateEmail(email)) {
            log_username_header.addClass('validation-failed');
            jQuery('#login_error_header').html('Địa chỉ email không hợp lệ.');
            jQuery('#loading').hide();
            return false;
        }

        if (pass == '') {
            log_password_header.addClass('validation-failed');
            jQuery('#login_error_header').html('Vui lòng nhập mật khẩu đăng nhập.');
            jQuery('#loading').hide();
            return false;
        }
        jQuery('#loading').show();
        var url = DOMAIN + 'general/login/login/';
        var csrf = jQuery('#csrf_token_fosp_login').val();
        jQuery.ajax({
            type: "POST",
            url: url,
            //data: 'username=' + jQuery('#log_username').val() + '&password=' + jQuery('#log_password').val() + '&current_url=' + jQuery('#fosp_login_current_url').val(),
            data: data,
            success: function(res) {
                if (res.error == 0) {
                    jQuery('#modalLogin').modal('hide');
                    OpenIDConnect.cookie('openid_buy_now', true, {expires: -3600, path: '/', domain: DOMAIN_COOKIE});
                    if (a) {
                        //case comment
                        FOConnect.getSession(DOMAIN + 'general/login/getSession/');
                        FOConnect.checkUserLogin(DOMAIN + 'general/login/checkLogin/');
                        checkLogin(userLogin);
                        jQuery("#" + b).submit();
                    } else {
                        if(jQuery('#flag_popup').html() == 5){
                            OpenIDConnect.redirect_url = DOMAIN + 'thong-tin-tai-khoan/san-pham-quan-tam/';
                        }
                        OpenIDConnect.login(OpenIDConnect.loginurl);
                    }

                } else {
                    jQuery('#loading').hide();
                    login_error.show().html(res.error);
                    log_username_header.addClass('validation-failed');
                    log_password_header.addClass('validation-failed');
                    return false;
                }
            }
        });
        return false;
    } else {
        $('.login-body .ajax-load-qa').show();
        var login_error = jQuery('#login_error');
        login_error.html('');
        var log_username = jQuery('#log_username');
        var log_password = jQuery('#log_password');
        var login_form = jQuery("#login-form-validate");
        data = login_form.serialize();
        email = log_username.val();
        pass = log_password.val();
        if (email == '') {
            log_username.addClass('validation-failed');
            login_error.html('Vui lòng nhập địa chỉ email.').show();
            $('.login-body .ajax-load-qa').hide();
            return false;
        }
        if (!validateEmail(email)) {
            log_username.addClass('validation-failed');
            login_error.html('Địa chỉ email không hợp lệ.').show();
            $('.login-body .ajax-load-qa').hide();
            return false;
        }

        if (pass == '') {
            log_password.addClass('validation-failed');
            login_error.html('Vui lòng nhập mật khẩu đăng nhập.').show();
            $('.login-body .ajax-load-qa').hide();
        return false;
    }
        jQuery('.login-body .ajax-load-qa').show();
    var url = DOMAIN + 'general/login/login/';
    var csrf = jQuery('#csrf_token_fosp_login').val();
    jQuery.ajax({
        type: "POST",
        url: url,
        //data: 'username=' + jQuery('#log_username').val() + '&password=' + jQuery('#log_password').val() + '&current_url=' + jQuery('#fosp_login_current_url').val(),
        data: data,
        success: function(res) {
            if (res.error == 0) {
                jQuery('#modalLogin').modal('hide');
                    OpenIDConnect.cookie('openid_buy_now', true, {expires: -3600, path: '/', domain: DOMAIN_COOKIE});
                if (a) {
                    //case comment
                    FOConnect.getSession(DOMAIN + 'general/login/getSession/');
                        notifyLogin();
                    checkLogin(userLogin);
                    jQuery("#" + b).submit();
                }else {
                        if(jQuery('#flag_popup').html() == 5){
                            OpenIDConnect.redirect_url = DOMAIN + 'thong-tin-tai-khoan/san-pham-quan-tam/';
                        }
                    OpenIDConnect.login(OpenIDConnect.loginurl);
                }
            } else {
				jQuery('.login-body .ajax-load-qa').hide();
                    login_error.show().html(res.error);
                    log_username.addClass('validation-failed');
                    log_password.addClass('validation-failed');
                return false;
            }
            
		}
	});
	return false;
    }

}
function getCookie(c_name) {
    var i, x, y, ARRcookies = document.cookie.split(";");
    for (i = 0; i < ARRcookies.length; i++) {
        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == c_name) {
            return unescape(y);
        }
    }
}

var current_url = location.href;
OpenIDConnect.init({
    loginurl: DOMAIN + 'general/login/dologin/',
    redirect_url: current_url,
    fb_url: DOMAIN + 'general/login/facebook/',
    gg_url: DOMAIN + 'general/login/google/',
    yh_url: DOMAIN + 'general/login/yahoo/'

});
var url = DOMAIN + 'general/login/checkLogin/';
FOConnect.getSession(DOMAIN + 'general/login/getSession/');
jQuery('#Modal_login').modal('hide');
jQuery('#social_login a').click(function() {
    jQuery('#social_login a').removeAttr('onclick');
    jQuery('.login-ext a').removeAttr('onclick');
});
jQuery('.login-ext a').click(function() {
    jQuery('.login-ext a').removeAttr('onclick');
    jQuery('#social_login a').removeAttr('onclick');
});
var openid_error = OpenIDConnect.cookie('openid_error');
var openid_error_type = OpenIDConnect.cookie('openid_error_type');
var openid_buy_now = OpenIDConnect.cookie('openid_buy_now');
if (openid_error && openid_error !== '') {
    if (openid_buy_now && openid_buy_now !== '') {
//OpenIDConnect.cookie('redirect_url',openid_buy_now,{ expires: 60,domain :DOMAIN_COOKIE,path: '/'});
        OpenIDConnect.redirect_url = openid_buy_now;
        openid_buy_now = encodeURIComponent(openid_buy_now);
        jQuery('#fosp_login_current_url').val(openid_buy_now);
        jQuery('#fosp_register_current_url').val(openid_buy_now);
    }
    var type = 'login';
    if (openid_error_type && openid_error_type == 'register') {
        type = 'register';
    }
    modal_error(Base64.decode(openid_error), type);
    OpenIDConnect.cookie('openid_error', '', {expires: -3600, domain: DOMAIN_COOKIE, path: '/'});
    OpenIDConnect.cookie('openid_error_type', '', {expires: -3600, domain: DOMAIN_COOKIE, path: '/'});
}
openid_sendemail = OpenIDConnect.cookie('openid_sendemail');
if (openid_sendemail && openid_sendemail != null) {
    jQuery('#Modal_SendMail').modal('show');
    OpenIDConnect.cookie('openid_sendemail', '', {expires: -3600, path: '/', domain: DOMAIN_COOKIE, path:'/'});
}
/* modal login */
function login_click(bol, b, bol_buy, buy_cart, flag, sid) {//buy cart,buy not login in checkout cart
    var login_error = jQuery('#login_error');
    login_error.html('');
    var b = b || false;
    var bol_buy = bol_buy || false;
    var buy_cart = buy_cart || false;
    var flag = flag || 0;
    jQuery('#flag_popup').html(flag);
    jQuery('.box-l-c.login ').removeClass('current');
    if (b == false && bol_buy == false && buy_cart == false) {
        jQuery('#modalLogin').find('.radio-login').hide();
        jQuery('#modalLogin').find('#buynow_detail').hide();
        jQuery('#modalLogin').find('#login_buynow').show();
        $('#log_username').removeAttr('disabled');
        $('#log_password').removeAttr('disabled');
    }
    if (bol_buy == true) {
        $('.modal-header .caption').html("Đăng nhập để mua hàng");
        $('.login-social .b-email').find('input').focus();
        jQuery('#modalLogin').find('.radio-login').show();
        //console.log('0');
    } else {
        $('.modal-header .caption').html("Đăng ký tài khoản");
        $('.signup-body .b-email').find('input').focus();
        jQuery('#modalLogin').find('.radio-login').hide();
        //console.log('signup);
        }
    if (buy_cart == true) {
        jQuery('#modalLogin').find('#buynow_detail').show();
        jQuery('#modalLogin').find('#login_buynow').hide();
    }
    if (bol == true) {//login
        $('#caption').html("Đăng nhập");
        $('.login-body').find('input[name="username"]').focus();
        //show content login
        jQuery('#modalLogin').find('.signup-body').hide();
        jQuery('#modalLogin').find('.login-body').show();
        //opacity button login facebook, google
        jQuery('#Modal_login #mask_social_login').css({'z-index': '1'});
        jQuery('#Modal_login #social_login').css({'opacity': '0.5'});
        jQuery('#Modal_login #lbl_register').css({'display': 'none'});
        jQuery('#Modal_login #btn_register').css({'display': 'none'});
        //show modal popup
        jQuery('#modalLogin').modal('show');
        //buynow login
        /*
         if (jQuery('.quickview').html() != undefined && jQuery('.quickview').html().trim() != '') {
         //1. get url buy now
         buynow_url = getBuynowUrl(DOMAIN);
         //2.set redirect url = buynow login
         OpenIDConnect.loginurl = buynow_url;
         }*/
    } else if (bol == false) {//signup
        $('#caption').html("Đăng ký tài khoản");
        $('.signup-body').find('input[name="email"]').focus();
        //show content signup
        jQuery('#modalLogin').find('.login-body').hide();
        jQuery('#modalLogin').find('.signup-body').show();
        //show modal popup
        jQuery('#modalLogin').modal('show');
    }
    if (b) {
        OpenIDConnect.cookie('c_senpay', true, {expires: 3600, path: '/', domain: DOMAIN_COOKIE});
    }
}

function login_comment(e) {
//case login comment
    var login_error = jQuery('#login_error');
    login_error.html('');
    jQuery('.login-extt').removeAttr("onclick");
    jQuery('.login-extt.fb').attr("onclick", "OpenIDConnect.fb_login(true,'" + e + "');");
    jQuery('.login-extt.ya').attr("onclick", "OpenIDConnect.yh_login(true,'" + e + "');");
    jQuery('.login-extt.go').attr("onclick", "OpenIDConnect.gg_login(true,'" + e + "');");
    jQuery('#login-form-validate').removeAttr("onsubmit");
    jQuery('#login-form-validate').attr("onsubmit", "return fosp_login(true,'" + e + "');");
    jQuery('#caption').html("Đăng nhập");
    jQuery('#modalLogin').find('.radio-login').hide();
    $('#login_real').show();
    $('#buynow_detail').hide();
    $('#login_buynow').hide();
    $('#checkout_guest').hide();
    jQuery('#modalLogin').find('.signup-body').hide();
    jQuery('#modalLogin').find('.login-body').show();
    jQuery('#Modal_login #mask_social_login').css({'z-index': '1'});
    jQuery('#Modal_login #social_login').css({'opacity': '0.5'});
    jQuery('#Modal_login #lbl_register').css({'display': 'none'});
    jQuery('#Modal_login #btn_register').css({'display': 'none'});
    jQuery('#modalLogin').modal('show');
}
function login_modal_click(a, b) {
    var a = a || false;
    var b = b || false;
    jQuery('#Modal_login .signup-body').hide();
    jQuery('#Modal_login .modal-footer').hide();
    jQuery('#Modal_login .login-body').show();
    if (a) {
        jQuery('#Modal_login #mask_social_login').css({'z-index': '1'});
        jQuery('#Modal_login #social_login').css({'opacity': '0.5'});
        jQuery('#Modal_login #lbl_register').css({'display': 'none'});
        jQuery('#Modal_login #btn_register').css({'display': 'none'});
    }
    if (b) {
        OpenIDConnect.cookie('c_senpay', true, {expires: 3600, path: '/', domain: DOMAIN_COOKIE});
    }
    jQuery('#Modal_login').modal('show');
}
function check_email(e) {
    var email = jQuery('#' + e).val();
    //console.log(validateEmail(email));
    return checkEmailExist(email);
}
function validateEmail(v) {
    var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return result = reg.test(v);
}
function checkEmailExist(value, element) {
    var reg_error_email = $('#reg_error_email');
    var reg_email = $('#reg_email');
    chkEmailResult = false;
    $('#reg_email').removeClass('validation-failed');
    if (jQuery.trim(value))
    {
        if (!validateEmail(value)) {

            reg_error_email.html("Vui lòng nhập địa chỉ email hợp lệ. Ví du abc@domain.com.").show();
            $('#reg_email').addClass('validation-failed');
            return false;
        }
        jQuery.ajax({
            type: 'POST',
            cache: false,
            url: DOMAIN + "general/login/checkEmailExists/",
            data: "email=" + value,
            dataType: 'json',
            success: function(data) {
                if (data) {
                    chkEmailResult = false;
                    reg_error_email.html("Email này đã được đăng ký.").show();
                    reg_email.addClass('validation-failed').focus();
                } else {
                    reg_error_email.html('').hide();
                    chkEmailResult = true;
                }
            }

        });
    } else {
        reg_error_email.html("Bạn chưa nhập email.").show();
        reg_email.addClass('validation-failed');
    }
    return chkEmailResult;
}
function modal_error(e, t) {
    if (t == 'register') {
        jQuery('#Modal_login').find('.register_error').html(e);
        login_click(false);
    }
    if (t == 'login') {
        jQuery('#Modal_login').find('#login_error').html(e);
        login_click(true);
    }
}

/* function */
function addScrollTopAnimation() {
    var scrolltop_link = $('#scroll-top');
    if ($("#header").offset() != null) {
        var h_t = $("#header").offset().top;
        scrolltop_link.click(function(ev) {
            //ev.preventDefault();
            $('html, body').animate({scrollTop: h_t}, 500);
        });
    }
//scrolltop_link.data('hidden', 1).hide();
    var scroll_event_fired = false;
    jQuery(window).on('scroll', function() {
        scroll_event_fired = true;
    });
    setInterval(function() {
        if (scroll_event_fired) {
            scroll_event_fired = false;
            var is_hidden = scrolltop_link.data('hidden');
            if ($(this).scrollTop() > 500) {
                if (is_hidden) {
                    scrolltop_link.fadeIn(300).data('hidden', 0);
                }
            }
            else {
                if (!is_hidden) {
                    scrolltop_link.slideUp().data('hidden', 1);
                }
            }
        }
    }, 300);
}
function enableSelectBoxes() {
    jQuery('.selectBox span.selected').click(function() {
        jQuery(this).parent('div.selectBox').toggleClass('active');
    });
    jQuery('.selectBox span.selectOption').click(function() {
        var set_sel = jQuery(this).attr('value');
        var con_sel = jQuery(this).text();
        sessionStorage.setItem('setsel', set_sel);
        sessionStorage.setItem('consel', con_sel);
        jQuery('div.selectBox').removeClass('active');
        jQuery(this).closest('div.selectBox').attr('value', set_sel);
        jQuery(this).parent().siblings('span.selected').html(con_sel);
        jQuery('input.param_s').attr('value', jQuery(this).attr('value'));
    });
}
function set_active_search() {
    var sel = sessionStorage.getItem('setsel');
    var con = sessionStorage.getItem('consel');
    var pathname = $(location).attr('pathname');
    if (sel && con && pathname == 'tim-kiem/index.html') {
        $('.selectBox').attr('value', sel);
        $('.selectBox .selected').html(con);
    }
}
function quality(bol) {
    var va = $('.quality input[name="qty"]').val();
    if (bol == true && va >= 1 && va < 999) {
        va++;
        $('.quality input[name="qty"]').val(va);
    } else if (bol == false && va > 1 && va < 999) {
        va--;
        if (va == 1) {
            $('.quality input[name="qty"]').val(1);
        } else {
            $('.quality input[name="qty"]').val(va);
        }
    } else {
        $('.quality input[name="qty"]').val(1);
    }
}

if (window.angular) {
    jQuery('.angular').css({"display": "block"});
}

function checkQty() {
    /*check qty*/
    jQuery.ajax({
        url: DOMAIN + 'general/check/qty/',
        cache: false,
        type: 'POST',
        data: '',
        success: function(obj) {
            if (obj.trim() != '') {
                var arr_data = obj.split('@');
                //jQuery('.quickcart').html(arr_data[0]);
                jQuery('.shopping_cart_modal').removeClass("box-link-svg").attr("data-toggle","modal").attr("data-target","#shoppingcartmodal");
                jQuery('.cart_qty').html(arr_data[1]);
            } else {
                jQuery('.shopping_cart_modal').removeAttr("data-toggle").removeAttr("data-target").addClass("box-link-svg");
                jQuery('.cart_qty').html("0");
                jQuery('.quickcart').html('<li>Chưa có sản phẩm trong giỏ hàng</li>');
            }
        }
    });
}

function showWaiting(obj) {
    img_load = '<img class="ajax-load-dev" src="' + ST_IMAGE + 'ajax-loader.gif" style="margin-left:45%" />';
    jQuery(obj).html(img_load);
}

function hideWaiting(obj) {
    jQuery(obj).html('');
}

function checkShop() {
    jQuery.ajax({
        url: DOMAIN + 'general/check/checkshop/',
        cache: false,
        type: 'POST',
        data: '',
        success: function(obj) {
            if (parseInt(obj.is_birthday) == 1) {
                if (jQuery.cookie('is_birthday') == undefined) {
                    jQuery('.bg-chuc-mung-sn').show();
                    jQuery.cookie('is_birthday', '1', {expires: 30, path: '/'});
                }
            }
            if (parseInt(obj.is_shop) == 1) {
                jQuery("a.openshop span").html('Vào shop');
                //shop frontend
                jQuery("a.openshop").attr('title', 'Vào shop');
            } else {
                jQuery("a.openshop span").html('Mở shop');
            }
        }
    });
}

//set just viewed product
//var just_viewed_product set in detail -> index.phtml(json)
//get current viewed product
function initJVCookie() {
    if (typeof jQuery.cookie('viewed_product_3') == 'undefined') {
        jQuery.cookie('viewed_product_3', '', {expires: 7, path: '/'});
    }
    if (typeof jQuery.cookie('viewed_product_2') == 'undefined') {
        jQuery.cookie('viewed_product_2', '', {expires: 7, path: '/'});
    }
    if (typeof jQuery.cookie('viewed_product_1') == 'undefined') {
        jQuery.cookie('viewed_product_1', '', {expires: 7, path: '/'});
    }
    jv3 = jQuery.cookie('viewed_product_3');
    jv2 = jQuery.cookie('viewed_product_2');
    jv1 = jQuery.cookie('viewed_product_1');
    cookieJV = '';
    if (jv3 != '') {
        cookieJV += jv3;
    }
    if (jv2 != '') {
        cookieJV += jv2;
    }
    if (jv1 != '') {
        cookieJV += jv1;
    }

    if (cookieJV == '') {
        cookieJV = '{}';
    }

    return cookieJV;
}
/*
 *just_viewed_product chua sp vua xem sau cung, gan gia tri o product detail -> indexAction
 **/
function checkRedundancy(jv) {
    is_new = true;
    try {
        just_viewed_product_obj = JSON.parse(just_viewed_product);
    } catch (e) {
        just_viewed_product = '{}';
        return false;
    }
    jv_id = -1;
    for (i in just_viewed_product_obj) {
        jv_id = i;
        break;
    }
    try {
        viewed_product = JSON.parse(jv);
    } catch (e) {
        return false;
    }
    for (j in viewed_product) {
        if (jv_id == j) {
            is_new = false;
        }
    }

    return is_new;
}
function setJVData(jv) {
    just_viewed_product = just_viewed_product.substr(1, just_viewed_product.length - 2);
    viewed_product = jv.substr(1, jv.length - 2);
    if (viewed_product == '') {
        viewed = '{' + just_viewed_product + '}';
    } else {
        viewed = '{' + just_viewed_product + ',' + viewed_product + '}';
    }
    str3 = viewed.substr(0, 2500);
    str2 = viewed.substr(2500, 2500);
    str1 = viewed.substr(5000);
    jQuery.cookie('viewed_product_3', str3, {expires: 7, path: '/'});
    jQuery.cookie('viewed_product_2', str2, {expires: 7, path: '/'});
    jQuery.cookie('viewed_product_1', str1, {expires: 7, path: '/'});
}
function initJustViewed() {
    jv = initJVCookie();
    is_new = checkRedundancy(jv);
    if (!is_new) {//if has exist, remove
//json to array[object]
        try {
            just_viewed_product_obj = JSON.parse(just_viewed_product);
        } catch (e) {
            just_viewed_product = '{}';
            return false;
        }
        jv_id = -1;
        for (i in just_viewed_product_obj) {
            jv_id = i;
            break;
        }
//remove exist object
        try {
            viewed_product = JSON.parse(jv);
        } catch (e) {
            return false;
        }
        countJV = 0;
        for (j in viewed_product) {
            if (jv_id == j || countJV > 19) {
                delete viewed_product[j];
            }
            countJV++;
        }
//parse object to json
        try {
            jv = JSON.stringify(viewed_product);
        } catch (e) {
            return false;
        }
    }
    setJVData(jv);
}

function getJVs() {
    return initJVCookie();
}

function getJV() {
    jvs = getJVs();
    for (i in jvs) {
        return jvs[i];
        break;
    }
    return '';
}
/*gop-y*/
function validComment() {
    gy_content = jQuery('#gy_content').val();
    gy_email = jQuery('#gy_email').val();
    gy_captcha = jQuery('#gy_captcha').val();
    jQuery('#gy_content, #gy_email, #gy_captcha').removeClass('validation-failed');
    if (gy_content == '') {
        jQuery('#gy_content').addClass('validation-failed');
        return false;
    }

    email_pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (gy_email == '' || email_pattern.test(gy_email) == false) {
        jQuery('#gy_email').addClass('validation-failed');
        return false;
    }
    if (gy_captcha == '') {
        jQuery('#gy_captcha').addClass('validation-failed');
        return false;
    }
    return true;
}

function getProductInfoListing() {
    var _str_id = "";
    jQuery('input[name="etx_info[]"]').each(function() {
        _str_id += jQuery(this).val() + ',';
    });
    if (_str_id != '') {
        jQuery.ajax({
            url: DOMAIN + 'homepage/partial/proExtInfo/?param=' + _str_id + '&type=listing',
            type: "GET",
            dataType: "json",
            success: function(data) {
                for (i in data) {
                    each_item = data[i];
                    shop_info = each_item['shop_info']["info"];
                    shop_warehouse = each_item['shop_info']["warehouse"];
                    free_ship = each_item['free_ship'];
                    jQuery('._' + i + '_' + ' .content_item .overflow_box').append(shop_info);
                    jQuery('._' + i + '_' + ' .box_shop_place').html(shop_warehouse);
                    if (free_ship == 1) {
                        jQuery('._' + i + '_' + ' .fee-ship').show();
                    }
                }
                jQuery('.tool-tip').tooltip();
            }
        });
    }
}
/*
function initChat(){
	require(['converse'], function (converse) {
        converse.listen.on('noResumeableSession', function () {
            $.getJSON('/general/login/prebind/', function (data) {
                var session = data.session;
                console.log('get prebind1');
                converse.initialize({
                    prebind: true,
                    keepalive: true,
                    message_carbons: true,
                    allow_contact_requests: false,
                    allow_muc: false,
                    forward_messages: true,
                    roster_groups: true,
                    allow_otr: false,
                    bosh_service_url: session.bosh_service_url,
                    jid: session.jid,
                    sid: session.sid,
                    rid: session.rid
                },function(){
                	$('.modal-backdrop').remove();
                });
            });
        });

        converse.initialize({
            prebind: true,
            keepalive: true,
            message_carbons: true,
            allow_contact_requests: false,
            allow_muc: false,
            forward_messages: true,
            roster_groups: true,
            allow_otr: false,
            bosh_service_url: JABBERD_HOST
        },function(){
        	$('.modal-backdrop').remove();
        });
	});
}
*/
function renderShopInfoHtml(shopData) {
    var html = [];
    if (shopData['Score'] > 0) {
        html.push('<div class="box_owner_shop">');
        html.push('<div class="logo">');
        html.push('		<a title="' + shopData['Name'] + '" href="' + shopData['shopUrl'] + '"><img alt="Shop ' + shopData['Name'] + '" src="' + shopData['Logo'] + '" width="60" height="30"></a>');
        if(shopData['chat_online'] == 0){
            html.push('		<span class="chat-now chat_' + shopData['sendo_id'] + '" rel="' + shopData['sendo_id'] + '" title="Chat với Shop"><svg class="icon icon-chat"><use xlink:href="#icon-chat"></use></svg></span>');
        }
        html.push('		<a rel="nofollow" title="Xem shop" href="' + shopData['shopUrl'] + '">xem shop »</a>');
        html.push('</div>');
        html.push('<div class="point"> Điểm: <span>' + shopData['Score'] + '</span><span style="width: ' + Math.floor(shopData['lotus'] * 20) + 'px"  title="Biểu tượng cho số điểm từ ' + shopData['lt_start'] + ' đến ' + shopData['lt_end'] + ' của shop." class="box-ic-star ' + shopData['class'] + '">&nbsp;</span>  </div>');
        html.push('<div class="goodrating"> <b style="color:#f00;">' + shopData['GoodReviewPercent'] + '</b><font style="color:#f00;">% </font> phản hồi tích cực </div>');
        html.push('</div>');
    }
    return html.join('');
}

function renderViewNumberInfoHtml(viewed) {
    var html = [];
    html.push('<div class="s_b">');
    html.push('<span title="" class="luotxem tool-tip" data-original-title="Đã có ' + viewed + ' lượt xem">' + viewed + '</span>');
    html.push('</div>');
    return html.join('');
}

function renderOrderNumberInfoHtml(ordered) {
    var html = [];
    html.push('<div class="s_b">');
    html.push('<span title="" class="luotmua tool-tip" data-original-title="Đã có ' + ordered + ' lượt mua">' + ordered + '</span>');
    html.push('</div>');
    return html.join('');
}

function renderCommentNumberInfoHtml(commented) {
    var html = [];
    html.push('<div class="s_b">');
    html.push('<span title="" class="luotcomment tool-tip" data-original-title="Đã có ' + commented + ' hỏi đáp">' + commented + '</span>');
    html.push('</div>');
    return html.join('');
}

function checkShopChatOnline(listShopChat) {
    require(['converse'], function(converse) {
        var checkOnline = converse.contacts.get(listShopChat);
        $.each(checkOnline, function(key, value) {
            if (value != null) {
                var index = listShopChat.indexOf(value.id);
                if (index > -1) {
                    listShopChat.splice(index, 1);
                }
                var shopId = value.id;
                shopId = shopId.split('@');
                shopId = shopId[0];
                $('.chat_' + shopId).attr('title', value.chat_status);
            }
        });
        $.each(listShopChat, function(key, value) {
            if (value != null) {
                var shopId = value;
                shopId = shopId.split('@');
                shopId = shopId[0];
                $('.chat_' + shopId).remove();
            }
        });
    });
}

function renderWareHouseInfoHtml(shopData) {
    var html = [];
    if (shopData['isBrand'] == 1) {
        html.push('<span class="icBrand" title="Thương hiệu">&nbsp;</span>');
    }
    if (shopData['Is_certified'] == 1) {
        if (shopData['isBrand'] == 0) {
            html.push('<span class="lotus" title="Shop Hoa Sen">&nbsp;</span>');
        }
    }
    html.push('<a rel="nofollow" class="name_shop ensure_shop" href="' + shopData['shopUrl'] + '" title="' + shopData['Name'] + '" >' + shopData['Name'] + '</a>');
//    html.push('<span  class="shop_place" title="Shop tại ' + shopData['Warehouse'] + ', Vận chuyển toàn quốc">' + shopData['Warehouse'] + '</span>');
    return html.join('');
}

function getProductInfoListingRenderHtml(typeListing) {
    var _str_id = "";
    jQuery('input[name="etx_info[]"]').each(function () {
        _str_id += jQuery(this).val() + ',';
    });
    if (_str_id != '') {
        jQuery.ajax({
            url: DOMAIN + 'homepage/partial/proExtInfo3/?param=' + _str_id + '&type=' + typeListing,
            type: "GET",
            dataType: "json",
            success: function(data) {
                var listShop = [];
                for (i in data.product) {
                    adminId = $('#admin_id_' + i).val();
                    each_item = data.product[i];
                    shop_info = data.shop[adminId];
                    if (typeof (shop_info) != 'undefined' && shop_info != null) {
                        htmlShopInfo = renderShopInfoHtml(shop_info);
                        htmlWareHouseInfo = renderWareHouseInfoHtml(shop_info);
                        free_ship = each_item['free_ship'];
                        jQuery('._' + i + '_' + ' .content_item .overflow_box').append(htmlShopInfo);
                        jQuery('._' + i + '_' + ' .box_shop_place').html(htmlWareHouseInfo);
                        if (free_ship == 1) {
                            jQuery('._' + i + '_' + ' .fee-ship').show();
                        }
                        if (typeof (each_item['order']) != 'undefined' && each_item['order'] != 0) {
                        	ordered = renderOrderNumberInfoHtml(each_item['order']);
                            jQuery('._' + i + '_' + ' .social_box').append(ordered);
                        }
                        if (typeof (each_item['view']) != 'undefined' && each_item['view'] != 0) {
                            viewed = renderViewNumberInfoHtml(each_item['view']);
                            jQuery('._' + i + '_' + ' .social_box').append(viewed);
                        }
                        if (typeof (each_item['comment']) != 'undefined' && each_item['comment'] != 0) {
                        	commented = renderCommentNumberInfoHtml(each_item['comment']);
                            jQuery('._' + i + '_' + ' .social_box').append(commented);
                        }
                        listShop.push(shop_info['chat_id']);
                    }
                }
                //checkShopChatOnline(listShop);
                jQuery('.tool-tip').tooltip();
            }
        });
    }
}

function getProductInfoOther() {
    var _str_id = "";
    jQuery('input[name="etx_info[]"]').each(function() {
    	var _str_id_tmp = jQuery(this).val();
    	_str_id_tmp = _str_id_tmp.split('_');
    	_str_id_tmp = _str_id_tmp[0];
        _str_id += _str_id_tmp + ',';
    });
    if (_str_id != '') {
        jQuery.ajax({
            url: DOMAIN + 'homepage/partial/productInfo/?param=' + _str_id,
            type: "GET",
            dataType: "json",
            success: function(data) {
                var listShop = [];
                for (i in data) {
                	each_item = data[i];
                    if (typeof (each_item['order']) != 'undefined' && each_item['order'] != 0) {
                    	ordered = renderOrderNumberInfoHtml(each_item['order']);
                        jQuery('._' + i + '_' + ' .social_box').append(ordered);
                    }
                    if (typeof (each_item['view']) != 'undefined' && each_item['view'] != 0) {
                        viewed = renderViewNumberInfoHtml(each_item['view']);
                        jQuery('._' + i + '_' + ' .social_box').append(viewed);
                    }
                    if (typeof (each_item['comment']) != 'undefined' && each_item['comment'] != 0) {
                        commented = renderCommentNumberInfoHtml(each_item['comment']);
                        jQuery('._' + i + '_' + ' .social_box').append(commented);
                }
                }
                jQuery('.tool-tip').tooltip();
            }
        });
    }
}

function getProductInfo() {
    var _str_id = "";
    jQuery('input[name="etx_info[]"]').each(function() {
        _str_id += jQuery(this).val() + ',';
    });
    if (_str_id != '') {
        jQuery.ajax({
            url: DOMAIN + 'homepage/partial/proExtInfo/?param=' + _str_id,
            type: "GET",
            dataType: "json",
            success: function(data) {
                for (i in data) {
                    each_item = data[i];
                    viewed = each_item['view'];
                    comment_count = each_item['comment'];
                    shop_info = each_item['shop_info']["info"];
                    shop_warehouse = each_item['shop_info']["warehouse"];
                    free_ship = each_item['free_ship'];
                    jQuery('._' + i + '_' + ' .social_box').append(viewed);
                    jQuery('._' + i + '_' + ' .social_box').append(comment_count);
                    jQuery('._' + i + '_' + ' .content_item .overflow_box').append(shop_info);
                    jQuery('._' + i + '_' + ' .box_shop_place').html(shop_warehouse);
                    if (free_ship == 1) {
                        jQuery('._' + i + '_' + ' .fee-ship').show();
                    }
                }
                jQuery('.tool-tip').tooltip();
            }
        });
    }
}
/*view-more-aw click*/
function viewMoreAW(e) {
    jQuery(e).hide();
    jQuery(e).siblings(".cmt-hide").slideToggle('fast');
}
function validate_input(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault)
            theEvent.preventDefault();
    }
}
/*scroll last-child-rg-box*/
function scrollBoxRight() {
    var h_l = $('.left-col').height();
    var h_r = $('.right-col').height();
    if (DOMAIN != window.location && h_l > h_r) {
        numb = $('.right-col > div').length;
        lastChild = $('.right-col > div:nth-of-type(' + numb + ')');
        if ($(lastChild).offset() != null && $(".sp-quan-tam").offset() != null) {
            stickyNavTop = $(lastChild).offset().top;
            heighLastChild = $(lastChild).height();
            endScroll = $(".sp-quan-tam").offset().top - 30;
            abc = endScroll - heighLastChild;
            $(window).scroll(function() {
                scrollTop = $(window).scrollTop();
                $(lastChild).css({'width': '220px'});
                if (scrollTop > stickyNavTop && scrollTop < abc) {
                    $(lastChild).css({"position": "fixed", "top": "-10px"});
                } else {
                    if (scrollTop > abc) {
                        temp = $(".sp-quan-tam").offset().top - scrollTop - 30;
                        if (temp < heighLastChild && temp > 0) {
                            t = "-" + (heighLastChild - temp + "px");
                            $(lastChild).css({"position": "fixed", "top": t});
                        } else {
                            if (temp > heighLastChild && temp > 0) {
                                $(lastChild).css({"position": "fixed", "top": "-10px"});
                            }
                            else {
                                $(lastChild).removeAttr('style');
                            }
                        }
                    }
                    else {
                        $(lastChild).removeAttr('style');
                    }
                }
            });
        }
    }

}
function checkIsNumberInput(evt)
{
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    if (key != 13) {
        key = String.fromCharCode(key);
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault)
                theEvent.preventDefault();
        }
    }
}

/*filter-scroll*/
function filterScroll() {
    if ($('.box-filter-page').offset() != null && $('.sp-quan-tam').offset() != null) {
        var topH = $('.box-filter-page').offset().top;
        var topQT = ($('.sp-quan-tam').offset().top) - 500;
        $(window).on('scroll', function() {
            var pos_s = $(window).scrollTop();
            if (!$('.box-filter-wrapper.scrolling-w').hasClass('filter-hide-flag')) {
                if (topH < pos_s && pos_s < topQT) {
                    $('.box-filter-wrapper').addClass('scrolling-w filter-hide');
                    $('.box-filter-wrapper').next().css({"padding-top": "20px"});
                    $('.append-minus-bot').remove();
                    //$('.content-search-product .box-filter-wrapper.filter-hide').append('<span class="ic-minus-bot append-minus-bot" style="bottom: -14px;">&nbsp;</span>');
                } else {
                    $('.box-filter-wrapper').removeClass('scrolling-w filter-hide');
                    $('.box-filter-wrapper').next().removeAttr('style');
                    $('.append-minus-bot').remove();
                }
            } else if (topQT < pos_s || pos_s < topH) {
                $('.box-filter-wrapper').removeClass('scrolling-w filter-hide-flag');
                $('.box-filter-wrapper').next().removeAttr('style');
                $('.append-minus-bot').remove();
            }
        });
    }
}
function filterToggle() {
    $(document).on('click', '.box-filter-wrapper .ic-minus-bot,.box-filter-wrapper .ic-minus', function() {
        $('.box-filter-wrapper').toggleClass('filter-hide');
    });
    $(document).on('click', '.scrolling-w .ic-minus-bot', function() {
        $('.box-filter-wrapper').toggleClass('filter-hide-flag');
    });
}

function hover_menu_left() {
    var firstTime = true;
    var top = -1;
    jQuery('.nav-main-box').hover(function() {
        $('#jsMenuMarkLayer').stop().delay(20).fadeIn(100);
    }, function() {
        $('#jsMenuMarkLayer').stop().delay(20).fadeOut(100);
    });
    $('.nav-main').menuAim({
        rowSelector: "li.menuItem",
        submenuDirection: "right",
        activate: function(a) {
            if (firstTime) {
                $(a).addClass('active').children('div.sub-cate').css({width: '0px', display: 'block'}).animate({width: '800px'}, 100);
            } else {
                $(a).addClass('active').children('div.sub-cate').show();
            }
            var ind = $(a).index();
            for (var i = 0; i <= ind; i++) {
                $('.nav-main > li').eq(ind).find('div.sub-cate').css({'top': top + 'px'});
                top = top - 61;
            }
            firstTime = false;
            $("img.lazyMenu", $(a)).each(function() {
                $(this).attr("src", $(this).attr("data-original"));
                $(this).removeAttr("data-original");
            });
        },
        deactivate: function(a) {
            $(a).removeClass('active').children('div.sub-cate').hide();
            top = -1;
        },
        exitMenu: function() {
            firstTime = true;
            $('div.sub-cate').hide();
            $('.nav-main-box > nav-main > li').removeClass('active');
            top = -1;
            return true;
        }
    });
}

$.fn.menuAim = function(opts) {
// Initialize menu-aim for all elements in jQuery collection
    this.each(function() {
        init.call(this, opts);
    });
    return this;
};
function init(opts) {
    var $menu = $(this),
            activeRow = null,
            mouseLocs = [],
            lastDelayLoc = null,
            timeoutId = null,
            options = $.extend({
                rowSelector: "> li",
                submenuSelector: "*",
                submenuDirection: "right",
                tolerance: 75, // bigger = more forgivey when entering submenu
                enter: $.noop,
                exit: $.noop,
                activate: $.noop,
                deactivate: $.noop,
                exitMenu: $.noop
            }, opts);
    var MOUSE_LOCS_TRACKED = 3, // number of past mouse locations to track
            DELAY = 300;  // ms delay when user appears to be entering submenu

    var mousemoveDocument = function(e) {
        mouseLocs.push({x: e.pageX, y: e.pageY});
        if (mouseLocs.length > MOUSE_LOCS_TRACKED) {
            mouseLocs.shift();
        }
    };
    var mouseleaveMenu = function() {
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
        if (options.exitMenu(this)) {
            if (activeRow) {
                options.deactivate(activeRow);
            }

            activeRow = null;
        }
    };
    var mouseenterRow = function() {
        if (timeoutId) {
            // Cancel any previous activation delays
            clearTimeout(timeoutId);
        }

        options.enter(this);
        possiblyActivate(this);
    },
            mouseleaveRow = function() {
                options.exit(this);
            };
    var clickRow = function() {
        activate(this);
    };
    var activate = function(row) {
        if (row == activeRow) {
            return;
        }

        if (activeRow) {
            options.deactivate(activeRow);
        }

        options.activate(row);
        activeRow = row;
    };
    var possiblyActivate = function(row) {
        var delay = activationDelay();
        if (delay) {
            timeoutId = setTimeout(function() {
                possiblyActivate(row);
            }, delay);
        } else {
            activate(row);
        }
    };
    var activationDelay = function() {
        if (!activeRow || !$(activeRow).is(options.submenuSelector)) {
            // If there is no other submenu row already active, then
            // go ahead and activate immediately.
            return 0;
        }

        var offset = $menu.offset(),
                upperLeft = {
                    x: offset.left,
                    y: offset.top - options.tolerance
                },
        upperRight = {
            x: offset.left + $menu.outerWidth(),
            y: upperLeft.y
        },
        lowerLeft = {
            x: offset.left,
            y: offset.top + $menu.outerHeight() + options.tolerance
        },
        lowerRight = {
            x: offset.left + $menu.outerWidth(),
            y: lowerLeft.y
        },
        loc = mouseLocs[mouseLocs.length - 1],
                prevLoc = mouseLocs[0];
        if (!loc) {
            return 0;
        }

        if (!prevLoc) {
            prevLoc = loc;
        }

        if (prevLoc.x < offset.left || prevLoc.x > lowerRight.x ||
                prevLoc.y < offset.top || prevLoc.y > lowerRight.y) {
            // If the previous mouse location was outside of the entire
            // menu's bounds, immediately activate.
            return 0;
        }

        if (lastDelayLoc &&
                loc.x == lastDelayLoc.x && loc.y == lastDelayLoc.y) {
            // If the mouse hasn't moved since the last time we checked
            // for activation status, immediately activate.
            return 0;
        }
        function slope(a, b) {
            return (b.y - a.y) / (b.x - a.x);
        }
        ;
        var decreasingCorner = upperRight,
                increasingCorner = lowerRight;
        if (options.submenuDirection == "left") {
            decreasingCorner = lowerLeft;
            increasingCorner = upperLeft;
        } else if (options.submenuDirection == "below") {
            decreasingCorner = lowerRight;
            increasingCorner = lowerLeft;
        } else if (options.submenuDirection == "above") {
            decreasingCorner = upperLeft;
            increasingCorner = upperRight;
        }

        var decreasingSlope = slope(loc, decreasingCorner),
                increasingSlope = slope(loc, increasingCorner),
                prevDecreasingSlope = slope(prevLoc, decreasingCorner),
                prevIncreasingSlope = slope(prevLoc, increasingCorner);
        if (decreasingSlope < prevDecreasingSlope &&
                increasingSlope > prevIncreasingSlope) {

            lastDelayLoc = loc;
            return DELAY;
        }

        lastDelayLoc = null;
        return 0;
    };
    $menu
            .mouseleave(mouseleaveMenu)
            .find(options.rowSelector)
            .mouseenter(mouseenterRow)
            .mouseleave(mouseleaveRow)
            .click(clickRow);
    $(document).mousemove(mousemoveDocument);
}
;
function crolltop_listing() {
    jQuery('html, body').animate({
        scrollTop: jQuery("#header").offset().top
    }, 500);
}
function gotopageGeneral(obj, url) {
    p = jQuery(obj).parent().find('input[name="p"]').val();
    window.location = url + p
}

function gotopageListing(a) {
    var url = a.getAttribute("data-link");
    p = jQuery(a).parent().find('input[name="p"]').val();
    window.location = url + p
}

/* for event */

function GetCookie(name) {
    var arg = name + "=";
    var alen = arg.length;
    var clen = document.cookie.length;
    var i = 0;
    while (i < clen) {
        var j = i + alen;
        if (document.cookie.substring(i, j) == arg)
            return getCookieVal(j);
        i = document.cookie.indexOf(" ", i) + 1;
        if (i == 0)
            break;
    }
    return null;
}

function SetCookie(name, value, expires) {
    var argv = SetCookie.arguments;
    var argc = SetCookie.arguments.length;
    var expires = (argc > 2) ? argv[2] : null;
    document.cookie = name + '=' + escape(value) +
            ((expires == null) ? '' : ('; expires=' + expires.toGMTString())) + '; path=/ ';
//            ((path == null) ? "" : ("; path=/" )) +
//            ((domain == null) ? "" : ("; domain=." + "abc.com")) +
//            ((secure == true) ? "; secure" : "");
}

function DeleteCookie(name) {
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = GetCookie(name);
    document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
}
function getCookieVal(offset) {
    var endstr = document.cookie.indexOf(";", offset);
    if (endstr == -1)
        endstr = document.cookie.length;
    return unescape(document.cookie.substring(offset, endstr));
}
function checkCountEvent() {
            jQuery.ajax({
                type: "GET",
                url: DOMAIN + "su-kien/getcountdown/?current_time=" + $.now(),
                success: function(res) {
                    if (res.header_flag ==1) {
                        var relaytime = (1 * 24 * 60 * 60) > (res.data) ? res.data : (1 * 24 * 60 * 60);
                        exp = new Date();
                        exp.setTime(exp.getTime() + (relaytime * 1000));
                            $('.ad-event').css('background-color', res.header.Color);
                            $('.ad-event a').first().attr('href', res.header.Url);
                            $('.ad-event a').first().attr('onclick', "_gaq.push(['_trackEvent', 'Header', 'click', '"+res.header.Title+"',, false]);");
                            $('.ad-event a').first().attr('title', res.header.Title);
                            $('.ad-event img').first().attr('src', res.header.Image);
                            $('.ad-event img').first().attr('alt', res.header.Title);
//                            $('.popup-event-fw2 img').first().attr('src', ST_IMAGE + 'events/ballon/popup_400x400_20141228_3ngayvangxahangduoivon_1.jpg');
                            $('.ad-event').show();
//                        if (ballon_flag == 1 && ballon_count == null) {
//                            $('.free-shipping-box img').attr('src', ST_IMAGE + 'events/ballon/Balloon_250x60_20141228_3ngayvangxahangduoivon.jpg');
//                            $('.free-shipping-box').fadeIn().addClass('show-fsb');
//                        }
//                        if (popup_flag == 1 && popup_count == null && res.is_redirect == 0) {
//                            popup_count++;
//                            SetCookie(popup_cookie, popup_count, exp);
//                            jQuery('.overflow-popup-event,.popup-event-fw2').show();
//                        }
                        }

                }
            });
}

function checkCountHeader() {
    var count = GetCookie('header_delete');
    if (count == null) {
        count++;
        expDays = 1;
        exp = new Date();
        exp.setTime(exp.getTime() + (expDays * 24 * 60 * 60 * 1000));
        SetCookie('header_delete', count, exp);
    }
}
function checkCountBallon() {
    var count = GetCookie('ballon_delete');
    if (count == null) {
        count++;
        expDays = 1;
        exp = new Date();
        exp.setTime(exp.getTime() + (expDays * 24 * 60 * 60 * 1000));
        SetCookie('ballon_delete', count, exp);
    }
}

/* search box */
function getShopInfoSearch() {
    var strListShopId = "";
    jQuery('input[name="etx_info[]"]').each(function() {
        strListShopId += jQuery(this).val() + ',';
    });
    if (strListShopId != '') {
        jQuery.ajax({
            url: DOMAIN + 'search/partial/getShopInfo/?param=' + strListShopId,
            type: "GET",
            dataType: "json",
            success: function(data) {
                for (i in data) {
                    each_item = data[i];
                    jQuery('._' + i + '_').append(each_item['shop_info']);
                    jQuery('._' + i + '_').append(each_item['shop_cate']);
                }
            }
        });
    }
}
function setDefaultSearchPosition() {
    liPossition = 0;
    tpLiPossition = 0;
}
function keyPressSearch(keyCode) {
    arr = jQuery('.search-autocomplete').find('.sub-search-item');
    if (keyCode == 40) { // down arrow key code
        if (liPossition != arr.length - 1) {
            tpLiPossition = liPossition;
            liPossition++;
        }
        else {
            tpLiPossition = liPossition;
            liPossition = 0;
        }
        jQuery('.search-autocomplete').find('.sub-search-item').removeClass('active');
        jQuery('.search-autocomplete').find('.sub-search-item').eq(liPossition - 1).addClass('active');
        var valueItemActive = jQuery('.search-autocomplete').find('.sub-search-item').children().eq(liPossition - 1).attr('rel');
        if (valueItemActive) {
            jQuery("#search_keyword").val(decodeURIComponent(valueItemActive));
        }
        var valueSuggestCate = jQuery('.search-autocomplete').find('.sub-search-item').children().eq(liPossition - 1).attr('title');
        if (valueSuggestCate) {
            jQuery("#input_search").val(valueSuggestCate);
        } else {
            jQuery("#input_search").val(1);
        }
    }
    if (keyCode == 38) { // up arrow key code
        if (liPossition != 0) {
            tpLiPossition = liPossition;
            liPossition--;
        } else {
            tpLiPossition = liPossition;
            liPossition = arr.length - 1;
            ;
        }
        jQuery('.search-autocomplete').find('.sub-search-item').removeClass('active');
        jQuery('.search-autocomplete').find('.sub-search-item').eq(liPossition - 1).addClass('active');
        var valueItemActive = jQuery('.search-autocomplete').find('.sub-search-item').children().eq(liPossition - 1).attr('rel');
        if (valueItemActive) {
            jQuery("#search_keyword").val(decodeURIComponent(valueItemActive));
        }

        var valueSuggestCate = jQuery('.search-autocomplete').find('.sub-search-item').children().eq(liPossition - 1).attr('title');
        if (valueSuggestCate) {
            jQuery("#input_search").val(valueSuggestCate);
        } else {
            jQuery("#input_search").val(1);
        }
    }
    if (keyCode == 13) { // enter key code
        jQuery('input').val(arr.eq(tp).html());
    }
}

function validateSearch() {
    if ("" == jQuery("#search_keyword").val() || "Nhập từ khoá tìm kiếm sản phẩm" == $("#search_keyword").val())
        return !1;
    return !0
}
/* REGISTER MAIL */
function sendNewletter(gender) {

    var email = jQuery(".block-email input[name=email]").val();
    var gen = gender;
    var format = jQuery(".block-email input[name=format]").val();
    var base_url = jQuery(".block-email input[name=url_base]").val();
    var url_sendmail = jQuery(".block-email input[name=url_sendmail]").val();
    // jQuery('#buttonsent').hide();
    //jQuery('#waitsent').show();

    var email_re = /[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i;
    if (!email_re.test(email)) {
        jQuery('#mail_register').find('.comment_modal_box').html("Email không hợp lệ!")
        jQuery('#mail_register').modal('show');
        return false;
    }

    var data = "url=" + url_sendmail + "/form.php?form=1&email=" + email + "&CustomFields=" + gen + "&h=" + format;
    jQuery.ajax({
        url: DOMAIN + "hop-thu/crossdomainnewletter",
        data: data,
        type: "POST",
        success: function(data) {
            //if(data == "1")alert("asds");
            jQuery('#mail_register').find('.comment_modal_box').html("Cảm ơn bạn đã đăng ký!");
            jQuery('#mail_register').modal('show');
        },
        error: function() {
            //jQuery('#Modal_registerMail').modal('hide');
            //jQuery('#content_data_sub_fail').show();
            //jQuery('#content_data_sub_ok').hide();
            //jQuery('#buttonsent').show();
            //jQuery('#waitsent').hide();
        }
    });
}

function checkMenuIconRight() {
    var w_width = $(document).width();
    if (w_width && w_width > 1280) {
        $('#wishlist-right').removeClass('active');
        $('.swiper-container').css({'height': 0});
    } else {
        $('#wishlist-right').addClass('active');
    }
    $(window).resize(function() {
        w_width = $(document).width();
        if (w_width && w_width > 1280) {
            $('#wishlist-right').removeClass('active');
            if ($('.swiper-wrapper').children().length > 0) {
                $('.swiper-container').css({'height': '180px'});
            } else {
                $('.swiper-container').css({'height': 0});
            }
        } else {
            $('#wishlist-right').addClass('active');
        }
    });
}
function eventForMenuIconRight() {
    /* INTERESTING */
    $("#menu_icon_fix .bt-click").on('click', function() {
        $('#menu_icon_fix').toggleClass("active");
    });
    // menu right scroll
    /*
     $(window).on('scroll', function() {
     var pos_s = $(window).scrollTop();
     if (pos_s > 200) {
     $('#menu_icon_fix').css({'top': '16%'});
     } else {
     $('#menu_icon_fixt').css({'top': '148px'});
     }
     });*/

    $('.interesting .comment .bt-close').click(function() {
        $('.interesting .comment').fadeOut();
        $('.return-old-version').fadeOut();
    });
}
/*
function scrollBlockSearch() {
    var topC = $(window).height();
    $(window).on('scroll', function() {
        var pos_s = $(window).scrollTop();
        if (pos_s > topC) {
            $('body').addClass('header-fix');
        } else {
            $('body').removeClass('header-fix');
        }
    });
}
*/
function scrollBlockSearch() {
    if($('.header-wrap').html() != null){
        var topC = $('.header-wrap').offset().top;
        $(window).on('scroll', function() {
            var pos_s = $(window).scrollTop();
            if (pos_s > topC) {
                $('body').addClass('header-fix');
            } else {
                $('body').removeClass('header-fix');
            }
        });
    }
}
function isScrolledIntoView(elem){
    var $elem = $(elem);
    var $window = $(window);

    var docViewTop = $window.scrollTop();
    var docViewBottom = docViewTop + $window.height();

    if($elem.length){
        var elemTop = $elem.offset().top;
    }
    var elemBottom = elemTop + $elem.height();

    //return ((elemBottom <= (docViewBottom+200)) && ((docViewTop-200) <= elemTop ));
    return (docViewBottom > elemTop);
}



/* ------------- run document reay ---------------*/
jQuery(document).ready(function() {       
    checkIpadDevice();
    $(document).on('click', '.ic-showmore-filter-mobile', function() {
        $('.optionsFilterForShop').toggleClass('showmore');
    })
    $('.ic-event-eldy-listing,.ic-event-eldy-detail').hover(function() {
        $('.ic-event-eldy-listing,.ic-event-eldy-detail').tooltip(); //tooltip event-em-la-de-yeu
    })

    if (navigator.userAgent.match(/iPad/i)) {
        viewport = document.querySelector("meta[name=viewport]");
        viewport.setAttribute('content', 'width=900');
    }
//$('.icLoyalty,.shop_place').tooltip();//tooltip Loyalty

    $('.tool-tip').tooltip(); /* tooltip */

    /* CATEGORIES */
    $(".block-category").find('.show').mousemove(function() {
        var nokia = $(this);
        nokia.addClass('up');
        nokia.parents('.block-category').find(".nav-category").addClass("active");
        nokia.parents('.block-category').mouseleave(function() {
            nokia.parents('.block-category').find(".nav-category").removeClass("active");
            nokia.parents('.block-category').find('.show').removeClass('up');
        });
    });
    $(".view-more-category").find('span').click(function() {
        $(this).toggleClass("content");
        $(".last-child-row").toggle();
    });
    /* detail page attr */
    $(document).on('click', '.attrs-item.option label', function() {
        $(this).parent().find('label').removeClass('check');
        $(this).addClass('check');
    });
    /*for shop page*/
    $('.shopinfo_in_detail .box_accordion .ic').click(function() {
        $('.box_accordion').find('.sub_cat').not($(this).siblings('.sub_cat')).slideUp();
        $('.box_accordion').find('.active').not($(this)).removeClass('active');
        $(this).toggleClass('active');
        $(this).siblings('.sub_cat').slideToggle('fast');
    });
    /*for search page*/
    $('.saleoff-by-cate .box_accordion .ic').click(function() {
        $(this).parent('.ttl-block').toggleClass('active');
        $(this).parent().next('.sub_cat').slideToggle(300);
    });
    /*quality in detail*/
    $(document).on('click', '.quality .add-sl', function() {
        quality(true);
    });
    $(document).on('click', '.quality .sub-sl', function() {
        quality(false)
    });
    $(document).find('.close').on('click', '.modal-header', function() {
        $('.modal').modal('hide');
    });
    $(document).on('click', '.modal-backdrop', function() {
        $(".modal").modal('hide');
        $(this).hide();
    });
    //check cart
    checkQty();
    //quick view
    jQuery(document).on('click', '.quick-view', function(e) {
        jQuery('#quickview .modal-body').html('<img src="' + ST_IMAGE + 'ajax-loader.gif" style="margin-left: 45%;" />');
        jQuery.ajax({
            url: DOMAIN + 'detail/quickDetail/?param=' + encodeURIComponent(jQuery(this).attr('rel')),
            type: 'GET',
            success: function(data) {

                jQuery('#quickview .modal-body').html(data);
                if (FOConnect.isLogedIn == true) {//neu da login
                    jQuery('.buynow').show();
                }
            }
        });
        e.preventDefault();
    });

    jQuery(document).on('click', '.chat-now', function(e) {
    	$('body').append('<div class="modal-backdrop fade in"></div>');
        e.preventDefault();
    });

    last_viewed_cats = '1/2/index.html';
    last_viewed = jQuery.cookie('last_viewed');
    if (typeof last_viewed != 'undefined') {
        try {
            obj_lastviewed = JSON.parse(last_viewed);
            for (i in obj_lastviewed) {
                last_product = obj_lastviewed[i];
                break;
            }
            last_viewed_cats = last_product.category_id;
        } catch (e) {
            last_viewed_cats = '1/2/index.html';
        }

    }
    //sp quan tam
    var recommend = "";
    if (PAGE_TYPE == "product_detail" && RECOMMEND == "a") {
        recommend = "&recommend=analytic";
    }

    ajaxSPQT();
    function ajaxSPQT() {
    jQuery.ajax({
        url: DOMAIN + 'homepage/partial/spQuanTam/?cats=' + last_viewed_cats + recommend,
        type: 'GET',
        success: function(data) {
                jQuery('.sp-quan-tam').html(data);
        }
    });
    };
    //khuyen mai tot
    jQuery.ajax({
        url: DOMAIN + 'homepage/partial/goodPromotion/?cats=' + last_viewed_cats + recommend,
        type: "GET",
        success: function(data) {
            jQuery('.khuyen-mai-tot').html(data);
        }
    });

    //sp vua xem(just view)
    viewed_str = '';
    viewed_product = initJVCookie();
    if (typeof viewed_product != 'undefined' && viewed_product != '{}') {
        try {
            obj_viewed_product = JSON.parse(viewed_product);
            viewed_str += '<div class="product-just-view">';
            viewed_str += '<div class="tl">Những sản phẩm bạn vừa xem:</div>';
            viewed_str += '<div id="view_products" class="view-products">';
            if (typeof obj_viewed_product != 'undefined') {
                var obj_viewed_product_tmp = []
                for (i in obj_viewed_product) {
                    item_viewed = obj_viewed_product[i];
                    obj_viewed_product_tmp.push(item_viewed);
                }
                var no = 0;
                for (i in obj_viewed_product_tmp) {

                    item_viewed = obj_viewed_product_tmp[i];
                    var linkSplit = item_viewed['image'].split("://");
                    if(linkSplit.length == 2){
                        item_viewed['image'] = location.protocol + "//" + linkSplit[1];
                    }

                    viewed_str += '<div class="item-v"><a title="' + item_viewed['name'] + '" href="' + DOMAIN + item_viewed['cat_path'] + '"><img class="owl-lazy" alt="' + item_viewed['name'] + '" data-src="' + item_viewed['image'] + '" width="60" height="60"/></a></div>';
                    /*
                    if (no <= 14) {
                        viewed_str += '<div class="item-v"><a title="' + item_viewed['name'] + '" href="' + DOMAIN + item_viewed['cat_path'] + '"><img class="lazy_view" alt="' + item_viewed['name'] + '" data-original="' + item_viewed['image'] + '" width="60" height="60"/></a></div>';
                    } else {
                        viewed_str += '<div class="item-v"><a title="' + item_viewed['name'] + '" href="' + DOMAIN + item_viewed['cat_path'] + '"><img class="owl-lazy" alt="' + item_viewed['name'] + '" data-src="' + item_viewed['image'] + '" width="60" height="60"/></a></div>';
                    }*/
                    no++;
                }
            }
            viewed_str += '</div>';
            viewed_str += '</div>';
            jQuery('.sp-vua-xem').html(viewed_str);


        } catch (e) {//parse sp vua xem loi

        }
    }
    $(window).on('scroll', function(){
        owl_view_products();
    });
    function owl_view_products(){
        var $run_object = $('#view_products');
            var lenObj = $run_object.children().length;
            if(!$run_object.hasClass('onScreen') && isScrolledIntoView('.wrap-slider-blocks') && lenObj > 14){
                $run_object.owlCarousel({
                        loop: true,
                        margin: 20,
                        lazyLoad: true,
                        autoplay: true,
                        autoWidth: true,
                        autoplayHoverPause: true,
                        nav: true,
                        items: 14,
                        dots: false,
                        navText: ['', ''],
                        responsiveClass: true,
                        responsive: {
                            1024: {items: 10},
                            1280: {items: 12},
                            1366: {items: 14}
                }
                }).addClass('onScreen');
            }else{
                if (isScrolledIntoView('.wrap-slider-blocks')) {
                    $run_object.find('.owl-lazy').lazyload({data_attribute:'src'}).removeClass('owl-lazy');
                };
            }
    }

// Set device
    jQuery(document).on('click', '#set_device,#set_device_02', function() {
        url = DOMAIN + 'general/check/setDevice/';
        jQuery.ajax({
            type: "POST",
            url: url,
            data: '',
            success: function(res) {
                window.location.reload();
            }
        });
    });
    //renew captcha
    jQuery(document).on('click', '#reComImg', function() {
        url = DOMAIN + 'gop-y/renewcaptcha/';
        jQuery.ajax({
            type: "POST",
            url: url,
            data: '',
            success: function(html) {
                jQuery('#comment_capt').attr('src', html);
            }
        });
    });
    //click event
    jQuery('.comment').click(function() {
        jQuery('#reComImg').trigger('click');
    });
    $(".newletter .cl").click(function() {
        $(".newletter").hide();
    });
    $(" .bar-top-right > li.ktdh a").click(function() {
        $(this).parent().toggleClass('current');
    });
    jQuery(document).on('click', '.sendComment', function() {
        if (validComment() == false) {
            return;
        }
        url = DOMAIN + 'gop-y/save/';
        ccontent = jQuery('#gy_content').val();
        cemail = jQuery('#gy_email').val();
        ccaptcha = jQuery('#gy_captcha').val();
        jQuery.ajax({
            type: "POST",
            url: url,
            data: 'content=' + ccontent + '&cemail=' + cemail + '&captcha=' + ccaptcha,
            success: function(html) {
                if (parseInt(html) == 2) {//wrong captcha
                    jQuery('#gy_captcha').addClass('validation-failed');
                } else if (parseInt(html) == 1) {
                    jQuery('#comments_modal .cancel').trigger('click');
                    //jQuery('#comment').html(jQuery('.comment_succ').html());
                } else {//fail
                    alert('Gởi góp ý không thành công, vui lòng thực hiện lại.');
                }
            }
        });
    });
    //quan tam
    jQuery('.quick-inter').click(function() {
        showWaiting('.wishlist_modal .recommend');
        jQuery.ajax({
            type: "GET",
            url: DOMAIN + 'homepage/partial/spQuanTamMin/',
            data: 'cats=' + jQuery(this).attr('rel'),
            success: function(html) {
                jQuery('.wishlist_modal .recommend').html(html);
            }
        });
    });
    /*chuong-trinh-shop-hoa-sen*/
    $('.ctshs .tabs a').click(function() {
        $('.ctshs .tabs a').removeClass('active');
        $(this).addClass('active');
        $('.content-tabs .cont-tab').removeClass('active');
        $('.content-tabs .cont-tab').eq($(this).parent('li').index()).addClass('active');
    });
    /* lazyload */
    $("img.lazy,.houseware img.lazyClick").lazyload({effect: "fadeIn"});
    jQuery(document).ajaxSuccess(function(event, request, settings) {
        $("img.lazyajax").lazyload();
        $('.shop_place').tooltip();
    });

    /*close header*/
    $('.close-header-event').on('click', function() {
        $('.ad-event').hide();
        checkCountHeader();
    });
    /*Close popup*/
    jQuery('.popup-event-fw2 .bt-close,.overflow-popup-event').click(function(e) {
        jQuery('.overflow-popup-event,.popup-event-fw2').hide();
        e.preventDefault();
    });
    jQuery('.popup-event-fw2,.overflow-popup-event').click(function(e) {
        jQuery('.overflow-popup-event,.popup-event-fw2').hide();
    });
    hover_menu_left(); /* hover left menu */
    filterToggle(); /* up filter */
    filterScroll(); /*filter-scroll*/
    if (PAGE_TYPE == "homepage") {
        FOConnect.checkUserLogin(url);
    }
    addScrollTopAnimation(); /* scroll top */
    enableSelectBoxes(); /* SEARCH BAR */
    set_active_search();
    eventForMenuIconRight();
    hoverBallonImg(); /* add img to ballon */
    checkCountEvent(); //show popup expire
    ppShoppingCart(); /*checkMenuIconRight();*/
    sendMsg(); //send message
    viewMoreAW(); /*view-more-aw click*/
    notifyLogin(); /*login status header*/
    clickBoxInfo();
    clickNonTarger();
    focusInput();
    closeModalCart () ;
});
function closeModalCart () {
    $(document).on('click','.modal-cart .close ,.modal-cart .choice_supplier_btn',function(){
        $('.modal-cart').modal('hide');
    });
    $(document).on('click','.modal-ship-for-cart .close',function(){
        $('.modal-ship-for-cart').modal('hide');
    });
   $(document).on('click','.modal-ship-for-cart .choice_supplier_btn',function(){
        $('.modal-ship-for-cart').modal('hide');
    });
}
function focusInput() {
    $('.bar-top-right > li.ktdh .sub-ktdh').hover(function() {
        $(this).find('#increment_id').focus();
    }, function() {
        $(this).find('#increment_id').blur();
    });
    $('.box-l-c .login-block').hover(function() {
        $(this).find('#log_username').focus();
    }, function() {
        $(this).find('#log_username').blur();
    });
}
function clickBoxInfo() {
    $(document).on('click', '.box-l-c .box-link-svg', function() {
        $('.box-info .box-l-c').removeClass('current');
        $(this).parent().addClass('current');
        if ($(this).siblings('.sub-link-show').hasClass('activeSub')) {
            $(this).siblings('.sub-link-show').removeClass('activeSub');
        } else {
            $('.box-l-c .sub-link-show').removeClass('activeSub');
            $(this).siblings('.sub-link-show').addClass('activeSub');
        }

        if ($(this).parent().hasClass('mess')) {
            if (userLogin) {
                angular.element(document.getElementById('Notify-controller')).scope().readNotify();
            } else {
                $('.box-l-c .sub-link-show').removeClass('activeSub');
                login_click(true);
            }
        }
    });
    $('#login-deafault .box-link-svg').on('click', function() {
        if (tmp_overlay_login) {
            $('body').addClass('class_overlay_login');
            tmp_overlay_login = false;
            $('#log_username_header').focus();
        } else {
            $('body').removeClass('class_overlay_login');
            tmp_overlay_login = true;
        }
    });
    $('.a-signup > a').on('click', function() {
        $('#login-deafault .sub-link-show').removeClass('activeSub');
    });
}
function clickNonTarger() {
    tmp_overlay_login = true;
    $(document).on('mouseup', function(event) {
        var target = $(event.target);
        if (target.parents('div.selectBox').length == 0) {
            jQuery('div.selectBox').removeClass('active');
        }
        if (target.parents('.box-l-c').parents('.box-link').length == 0) {
            $('.box-l-c .sub-link-show').removeClass('activeSub');
            $('.box-l-c').removeClass('current');
            $('body').removeClass('class_overlay_login');
            tmp_overlay_login = true;
        }
        if (target.parents('div.search-input-select').length == 0) {
            jQuery("div.search-autocomplete").hide();
        }
        if (target.parents('.qa .text').length == 0) {
            jQuery("button.bt-send").removeClass('active');
        }
        var con_liktdh = $('.bar-top-right > li.ktdh');
        if (!con_liktdh.is(event.target) && con_liktdh.has(event.target).length == 0) {
            $('.bar-top-right > li.ktdh').removeClass('current');
        }

    });
}
function notifyLogin() {
    var pageFlag = PAGE_TYPE;
    pageFlag = pageFlag.substr(0, 4);
    if(userLogin){
        var str_box_info = '<div class="box-l-c da-login">';
        str_box_info = str_box_info + '<a class="box-link-svg" rel="nofollow" href="javascript:void(0);" title="Thông tin tài khoản"' + user_last_name + '>';
        str_box_info = str_box_info + '<svg class="icon icon-login-new"><use xlink:href="#icon-login-new"></use></svg>';
        str_box_info = str_box_info + '<svg class="icon-navigation_down_home"><use xlink:href="#icon-navigation_down_home"></use></svg>';
        str_box_info = str_box_info + '<span class="tl">Chào <b>' + user_last_name +',</b></span>';
        str_box_info = str_box_info + '<p><svg class="icon icon-a_down"><use xlink:href="#icon-a_down"></use></svg></p>';
        str_box_info = str_box_info + '</a>';
        str_box_info = str_box_info + '<ul class="tk-box sub-link-show">';
        str_box_info = str_box_info + '<li class="tttk"><a title="Thông tin tài khoản Sendo" href="' + DOMAIN + 'thong-tin-tai-khoan">Thông tin tài khoản Sendo</a></li>';
        str_box_info = str_box_info + '<li class="tddh"><a title="Theo dõi đơn hàng" href="' + DOMAIN + 'sales/order/history">Theo dõi đơn hàng</a></li>';
        str_box_info = str_box_info + '<li class="ds"><a title="Ví điểm SEN" href="' + DOMAIN + 'thong-tin-tai-khoan/vi-sen">Ví điểm SEN</a></li>';
        str_box_info = str_box_info + '<li class="sqt"><a title="Shop yêu thích" href="' + DOMAIN + 'customer/favorites/shop">Shop yêu thích</a></li>';
        str_box_info = str_box_info + '<li class="ht"><a title="Hộp thư" href="' + DOMAIN + 'thong-tin-tai-khoan/hop-thu">Hộp thư</a></li>';
        str_box_info = str_box_info + '<li class="thoat"><a title="Thoát" href="' + DOMAIN + 'dang-xuat">Thoát</a></li>';
        str_box_info = str_box_info + '</ul>';
        str_box_info = str_box_info + '</div>';
        if (pageFlag != "shop-frontend" && pageFlag != "shop") {
            jQuery('#login-deafault').remove();
            jQuery('#Notify-controller').append(str_box_info);
        }
        else{
            jQuery('#login-deafault1').remove();
            jQuery('#login_box').html(str_box_info);
        }
    }
}

function hoverBallonImg() {
//var expDays = 1;
//var exp = new Date();

    $('.free-shipping-box').hover(function() {
        $('.free-shipping-box img').attr('src', ST_IMAGE + 'events/ballon/Balloon_250x250_20141228_3ngayvangxahangduoivon.jpg');
    }, function() {
        $('.free-shipping-box img').attr('src', ST_IMAGE + 'events/ballon/Balloon_250x60_20141228_3ngayvangxahangduoivon.jpg');
    });
    $('.free-shipping-box em').on('click', function() {
        $('.free-shipping-box').fadeOut('fast');
        checkCountBallon();
    });
}
/*pp-shopping-cart*/
function ppShoppingCart() {
//Close popup
    $('.overlay-pp-shopping-cart,.pp-shopping-cart .bt-close').on('click', function() {
        $('body').removeClass('show-pp-cart');
    });
    //toggle-box-cart
    $('.block-cart .ic-minus').click(function() {
        $(this).toggleClass('thumb');
        $(this).siblings('.box-cart').find('.prods-list').slideToggle('fast');
    });
    //scrollbar
    $(".cont-pp-shopping-cart").mCustomScrollbar();
}

function add_product_view(p_id, name, cat_path, category_id, image) {
    product_viewed = store.get("product_viewed");
    if (typeof product_viewed == "undefined") {
        product_viewed = [];
    }
    var is_exists = false;
    for (i in product_viewed) {
        if (product_viewed[i].product_id == p_id) {
            is_exists = true;
            break;
        }

    }
    if (is_exists == false) {
        product_viewed.unshift({"product_id": p_id, "name": name, "cat_path": cat_path, "category_id": category_id, "image": image});
    }
    store.set("last_viewed_cats", category_id);
    store.set("product_viewed", product_viewed);
}
function get_product_viewed() {
    product_viewed = store.get("product_viewed");
    if (typeof product_viewed == "undefined" || product_viewed == "") {
        product_viewed = [];
    }
    return product_viewed;
}
/*remove hover box for ipad device*/
function checkIpadDevice() {
    if (navigator && navigator.userAgent && navigator.userAgent != null)
    {
        var strUserAgent = navigator.userAgent.toLowerCase();
        var arrMatches = strUserAgent.match(/(iphone|ipod|ipad)/);
        if (arrMatches != null) {
            $('.content_item_hover').removeClass('content_item_hover');
        }
    }
}
function sendMsg() {
    jQuery(document).on('click', '#sendMsg', function() {
        if (!userLogin) {
            jQuery('#modalMessage').modal('hide');
            login_click(true);
            return false;
        }
        url = DOMAIN + 'hop-thu/save/';
        sub = jQuery("#mess-title").val().trim();
        content = jQuery("#mess-content").val().trim();
        validate = true;
        if (sub == "") {
            jQuery("#mess-title").css({"border": "1px dotted #c00"});
            validate = false;
        }
        if (content == "") {
            jQuery("#mess-content").css({"border": "1px dotted #c00"});
            validate = false;
        }
        if (!validate) {
            alert("Vui lòng nhập thông tin cần thiết!.");
            return false;
        }
        jQuery.ajax({
            type: "POST",
            url: url,
            data: jQuery('#fmessage').serialize(),
            success: function(html) {
                if (parseInt(html) == 0) {
                    alert('Gửi tin nhắn không thành công.');
                    jQuery('#cancelMsg').trigger('click');
                    jQuery('.send_msg_load').hide();
                    jQuery('#modalMessage').modal('hide');
                } else if (parseInt(html) == 2) {
                    alert('Mã xác nhận không đúng.');
                    jQuery('.send_msg_load').hide();
                    return;
                } else {
                    alert('Gửi tin nhắn thành công.');
                    jQuery('.send_msg_load').hide();
                    jQuery('#modalMessage').modal('hide');
                }
                show_captcha();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert('Gửi tin nhắn không thành công.');
                jQuery('.send_msg_load').hide();
                jQuery('#cancelMsg').trigger('click');
                jQuery('#modalMessage').modal('hide');
            },
            timeout: 6000
        });
    });
}
function show_modal_message() {
    if (!userLogin) {
        login_click(true);
        return false;
    } else {
        jQuery('#modalMessage').modal('show');
    }
}
function isMobile() {
    if (sessionStorage.desktop) // desktop storage
        return "General_Desktop";
    else if (localStorage.mobile) // mobile storage
        return "Genaral Mobile";
    // alternative
    mobile = ['iphone', 'ipad', 'android', 'blackberry', 'nokia', 'opera mini', 'windows mobile', 'windows phone', 'iemobile'];
    for (var i in mobile)
        if (navigator.userAgent.toLowerCase().indexOf(mobile[i].toLowerCase()) > 0)
            return mobile[i].toLowerCase();
    // nothing found.. assume desktop
    return "General_Desktop Other";
}

function getCookiesArray() {
    var cookies = {};
    if (document.cookie && document.cookie != '') {
        var split = document.cookie.split(';');
        for (var i = 0; i < split.length; i++) {
            var name_value = split[i].split("=");
            name_value[0] = name_value[0].replace(/^ /, '');
            cookies[decodeURIComponent(name_value[0])] = decodeURIComponent(name_value[1]);
        }
    }
    return cookies;
}
function pushTrackingBoughtView(arrPush, url) {
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

/*hide favorite-product*/
function hideFavoritProdut() {
    $('.sub-favorite .bt-close').on('click', function(e) {
        $(this).parents('.item').hide();
        e.preventDefault();
    });
}
function randomNumber(startValue, endValue) {
    var quantity = endValue - startValue + 1;
    return Math.floor(Math.random() * quantity + startValue);
}
function viewshoppingcart(){
    
    var popup = jQuery('#shoppingcartmodal .main-popupcart');
    if(popup.length > 0){
        jQuery.ajax({
        url: DOMAIN + "checkout/cart/popupcart/",
        type:"GET",
        dataType: 'html',
        cache: false,
        beforeSend: function ( xhr ) {
                popup.html('<img src="' + ST_IMAGE + 'ajax-loader.gif" style="margin: 25% 50%;" />');
        },
        success: function(data){
                popup.html(data).show();   
                setHeightBoxShipping();
        },
        error: function(xhr,status,error){
            jQuery('.main-popupcart').html('Đã có lỗi xảy ra. Vui lòng thử lại sau!');
        }
    });
    }
    else{
        jQuery(".shopping_cart_modal").removeAttr("data-target");
        window.location = DOMAIN + "checkout/cart/";
    }
}
function setHeightBoxShipping(){
    $('.pp-shopping-cart .box_modal_ship').removeClass('height');
    if(($('.cont-pp-shopping-cart .block-cart').length == 1) && ($('.block-cart:first-child .prods-list .product_box').length == 1)){
        $('.pp-shopping-cart .box_modal_ship').addClass('height');           
    } 
}
function popup_update_quantity(url,t,v,e){
    var qty = jQuery(t).parent().find('.qty').val();
    jQuery.ajax({
        url:url,
        type:"POST",
        data:{"update_cart_action":"update_qty","qty":qty},
        asycn: false,
        beforeSend: function(){

        },
        success: function(data){
            viewshoppingcart();
            checkQty();
        },
        error: function(){
            jQuery('.main-popupcart').html('Đã có lỗi xảy ra. Vui lòng thử lại sau!');
        },
    });
    e.preventDefault();
}
function popup_delete_product(url,t,e){
    jQuery.ajax({
        url:url,
        type:"POST",
        data:{"delete_cart_action":"delete_product"},
        asycn: false,
        beforeSend: function(){

        },
        success: function(data){
            viewshoppingcart();
            checkQty();
        },
        error: function(){
            jQuery('.main-popupcart').html('Đã có lỗi xảy ra. Vui lòng thử lại sau!');
        },
    });
    e.preventDefault();
}
function popup_clear_shop_cart(url,e){
    jQuery.ajax({
        url:url,
        type:"GET",
        asycn: false,
        beforeSend: function(){

        },
        success: function(data){
            viewshoppingcart();
            checkQty();
        },
        error: function(){
            jQuery('.main-popupcart').html('Đã có lỗi xảy ra. Vui lòng thử lại sau!');
        },
    });
    e.preventDefault();
}
function only_number_key(evt){
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    var backspace = key;

    key = String.fromCharCode( key );
    var regex = /[0-9]|\./;
    if( !regex.test(key) && backspace != 8) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
function popup_login_docheckout(bool,u, e){
    jQuery("#shoppingcartmodal").modal("hide");
    OpenIDConnect.loginurl= u;
    login_click(true,false,false,true,3);
    jQuery('#checkout_guest').click(function(){
        location.href = u;
    })
    e.preventDefault();
}

function popoup_choose_shipping_carrier(e,u,s){
    var e = e || false;
    var u = u || false;
    var s = s || false;
    var tmp = '#box_supplier'+s+' input:checked';
    var method = jQuery(tmp).val()
    jQuery.ajax({
        url:CHECKOUT_DOMAIN + "checkout/onepage/saveInfo/",
        data:{"method":method,"action":"set_shipping_method","s":s},
        type :"POST",
        asycn: false,
        success: function(data){
            if(!data.error){
                viewshoppingcart();
            }
        }
    })
}
function remove_voucher(){
    jQuery.ajax({
        url:CHECKOUT_DOMAIN + "checkout/onepage/removeVoucher/",
        data:{"action":"remove_voucher"},
        type :"POST",
        asycn: false,
        success: function(data){
            if(!data.error){
                viewshoppingcart();
            }
        }
    });
    return false;
}
function remove_loyalty(){
    jQuery.ajax({
        url:CHECKOUT_DOMAIN + "checkout/onepage/removeLoyalty/",
        type :"POST",
        asycn: false,
        data: {"action":"remove_loyalty"},
        success: function(data){
            if(!data.error){
                viewshoppingcart();
            }
            return true;
        }
    });
    return false;
}
function set_location(e){
    var e = e || location.href;
    window.location.href = e;
}
function goto_popupcheckout(t){
    jQuery(t).attr("data-toggle","modal").attr("data-target","#shoppingcartmodal");
    jQuery('#modalAddtocart').modal('hide');
    viewshoppingcart();
}