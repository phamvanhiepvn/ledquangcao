jQuery(document).ready(function(){
    jQuery(document).on('change','#est_city', function(){
        jQuery('#est_district').html('<option>Chọn..</option>');
        jQuery('#est_ward').empty().html('<option>Chọn..</option>');
        get_district(jQuery(this).val());
        load_carrier();
    });

    jQuery(document).on('change','#est_district', function(){
        jQuery('#est_ward').show();
        get_ward(jQuery(this).val());
        load_carrier();
        jQuery.cookie('ecom_cus_to_district_id', jQuery(this).val(), { expires:7, path: '/' , domain:DOMAIN_COOKIE});
    });
    jQuery(document).on('change','#est_ward', function(){
        load_carrier();
        jQuery.cookie('ecom_cus_to_ward_id', jQuery(this).val(), { expires:7, path: '/', domain:DOMAIN_COOKIE});
    });

    //chose carrier
    jQuery(document).on('click','.choice_supplier_btn', function(){
        //set new shipping city
        var distric = jQuery("select#est_district option").filter(":selected").val().trim();
        if(!is_int(distric)){
            jQuery.cookie('ecom_cus_to_district_id', 0, { expires:7, path: '/' , domain:DOMAIN_COOKIE});
        }
        var ward = jQuery("select#est_ward option").filter(":selected").val().trim();
        if(!is_int(ward)){
            jQuery.cookie('ecom_cus_to_ward_id', 0, { expires:7, path: '/', domain:DOMAIN_COOKIE});
        }
        jQuery.cookie('ecom_cus_to_region_name', jQuery("select#est_city option").filter(":selected").text().trim(), {path: '/', expires: 7, domain:DOMAIN_COOKIE});
        jQuery.cookie('ecom_cus_to_region_id', jQuery("select#est_city option").filter(":selected").val(), {path: '/', expires: 7, domain:DOMAIN_COOKIE});
        //set carrier shop
        est_carrier = jQuery('input[name="est_carrier"]:checked');
        var params = jQuery('#estShopFee').val()+jQuery.cookie('ecom_cus_to_region_id')+'/'+jQuery.cookie('ecom_cus_to_district_id') + '/'+jQuery.cookie('ecom_cus_to_ward_id');
        if(est_carrier.length > 0){
            $('#modalShipping').modal('hide');
            jQuery.ajax({
                type:"GET",
                url:DOMAIN+'get-shipping/setCarrier/',
                data:'params='+params+'&crr='+jQuery(est_carrier).val(),
                //async:false,
                success:function(html){
                    html_json = JSON.parse(html);

                    try{
                        jQuery('.est-shipping-fee > .attrs').html(html_json.block1);
                        jQuery('.est-shipping-fee > #modalShipping .modal-body').html(html_json.block2);
                        jQuery('.tooltip24').tooltip();
                    }catch(e){

                    }
                }
            });
        }

    });
    //addtocart
    jQuery(document).on('click','.addtocart',function(){
        isvalid = valid_product_checkout();
        if (isvalid == false){
            jQuery("#modalAddtocart").modal('hide');
        }else{
            addToCart();
            jQuery("#modalAddtocart").modal('show');
            showWaiting('.waiting_addtocart');
            is_quickviewed = jQuery('.quickview');
            if(typeof is_quickviewed != 'undefined'){
                jQuery('#quickview').modal('hide');
                jQuery('#modalAddtocart').modal('show');
                jQuery.ajax({
                    type:"GET",
                    url: DOMAIN+'homepage/partial/spQuanTamMin/',
                    data: 'cats='+jQuery('#cats').val(),
                    success:function(html){
                        jQuery('.addtocart_modal .recommend').html(html);
                    }
                });
            }
        }
        return false;
    });
});
function is_int(value){
    return !isNaN(parseFloat(value)) && isFinite(value);
}
function load_carrier(){
    var to_city = jQuery("select#est_city option").filter(":selected").val();
    var to_district = jQuery("select#est_district option").filter(":selected").val();
    if(!is_int(to_district)){
        to_district = 0;
    }
    var to_ward = jQuery("select#est_ward option").filter(":selected").val();
    if(!is_int(to_ward)){
        to_ward = 0;
    }
    jQuery.ajax({
        type:"GET",
        url:DOMAIN+'get-shipping/quickEstShipFee/',
        data:'params='+jQuery('#estShopFee').val() + to_city + '/' + to_district + '/' + to_ward,
        success:function(html){
            jQuery('#modalShipping .box_supplier').html(html);
            t = jQuery('.box_modal_ship input[type="radio"]');
            //jQuery(t[0]).attr('checked', 'checked');
            jQuery('.tooltip24').tooltip();
        }
    });
}
function get_district(city_id, selected){
    var city = jQuery("select#est_city option").filter(":selected").val();
    if(city != 'undefined'){
        jQuery.ajax({
            url:DOMAIN + "checkout/onepage/getDistrict/?city_id=" + city_id,
            type :"GET",
            success: function(data){
                var option = '<option>Chọn..</option>';
                var select = '';
                for(i in data){
                    if(data[i].id == selected){
                        select = 'selected';
                    }else{
                        select = '';
                    }
                    option += '<option '+select+' value='+data[i].id+'>'+ data[i].name + '</option>';
                }
                jQuery("#est_district").html(option);
            }
        });
    }
    else{
        var option = '<option>Chọn..</option>';
        jQuery("#est_district").html(option);
    }
}
function get_ward(district_id, selected){
    var district = jQuery("select#est_district option").filter(":selected").val();
    if(district != 'undefined'){
        jQuery.ajax({
            url:DOMAIN + "checkout/onepage/getWard/?district_id=" + district_id,
            type :"GET",
            success: function(data){
                var option = '<option>Chọn..</option>';
                var select = '';
                for(i in data){
                    if(data[i].id == selected){
                        select = 'selected';
                    }else{
                        select = '';
                    }
                    option += '<option '+select+' value='+data[i].id+'>'+ data[i].name + '</option>';
                }
                jQuery("#est_ward").html(option);
            }
        });
    }
    else{
        var option = '<option>Chọn..</option>';
        jQuery("#est_ward").html(option);
    }
}
function valid_product_checkout(){
    var is_submit = true;
    var not_found_att = "";
    jQuery(".attrs .option").each(function(){
        found_check = false;
        jQuery(this).find("label").each(function(){
            if (jQuery(this).hasClass('check')){
                found_check = true;
                return true;
            }
        });
        if (found_check == false){
            is_submit = false;
            var text = jQuery(this).parent().find(".label").html();
            text = text.trim();
            if (text != ""){
                if (text[text.length-1] == ":"){
                    text = text.substring(0, text.length-1);
                }
                if (not_found_att == "") not_found_att += text;
                else not_found_att += ", "+text;
            }
        }
    });
    var va_n = $('.quality input[name="qty"]').val();
    if(!$.isNumeric(va_n) || va_n < 1 || va_n > 1000 ){
        is_submit = false;
        if (not_found_att == "") not_found_att += "Số lượng";
            else not_found_att += ", Số lượng";
            $('.quality input[name="qty"]').val('');
    }
    if (is_submit == false){
        jQuery("span.check-attribute").html("Vui lòng chọn <b>"+not_found_att+"</b>").addClass('show');
    }else{jQuery("span.check-attribute").fadeOut();}

    return is_submit;
}
function check_quatity(){}
function checkNumber(myfield, e, dec){
        temp = myfield.value;
    var key;
    var keychar;

    if (window.event)
        key = window.event.keyCode;
    else if (e)
        key = e.which;
    else
        return true;

        if(parseInt(myfield.value)>=100 && (key!=8) && (key!=0))
        {
            myfield.value = temp;
            return false;
        }

    keychar = String.fromCharCode(key);

    // control keys
    if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
        return true;

    // numbers
    else if ((("0123456789").indexOf(keychar) > -1))
        return true;

    // decimal point jump
    else if (dec && (keychar == ".")) {
        myfield.form.elements[dec].focus();
        return false;
    } else
        return false;
}



function addToCart(){
    url = DOMAIN+'checkout/cart/add/uenc/aHR0cDovL3d3dy5zZW5kby52bi90aG9pLXRyYW5nLW51L2FvLW51L2FvLXNvLW1pLWNvbmctc28vaGFwcHktZi0tLWFvLXNvLW1pLXZvYW4tY28tdHJ1LXRheS1waG9uZy0xNzI3NTgv/';
    //check isset popup
    isset_popup = typeof jQuery('#is_popup').val();
    if(isset_popup == 'undefined'){
        jQuery('#product_detail_infomation').prepend('<input type="hidden" name="popup" id="is_popup" value="1">');
    }

    jQuery.ajax({
        type:"POST",
        url: url,
        data: jQuery("#product_detail_infomation").serialize(),
        success:function(html){
            hideWaiting('.waiting_addtocart');
            is_quickview = jQuery('#is_quickview').attr('type');
            if(is_quickview == undefined){
                jQuery('#quickview').trigger('click');
            }
            if(html.name == undefined || html.name.trim() == ''){
                jQuery('#modalAddtocart .addtocart_modal').html('Thêm sản phẩm vào giỏ hàng không thành công, vui lòng thử lại sau');
            }else{
                jQuery('.ajax-load').hide();
                //review add
                str_review_add = '';
                str_review_add += '<img src="'+html.thumbnail+'">';
                str_review_add += '<p class="name">';
                str_review_add += '<strong><a title="" href="#">'+html.name+' </a></strong> đã được đưa vào giỏ hàng<br>';
                str_review_add += '</p>';
                str_review_add += 'Hiện đang có <strong>'+html.total_item+'</strong> sản phẩm trong giỏ hàng';
                str_review_add += '';
                $('div.buttons').find('.shoplink').remove();
                $('div.buttons').append('<a href="' + html.shop_url + '" title="Mua những sản phẩm khác của shop" class="btn shoplink">Mua những sản phẩm khác của shop</a>');
                jQuery('#modalAddtocart .addtocart_modal .box_product_incart').html(str_review_add);
                //lay sp quan tam ben duoi
                sp_quan_tam = jQuery('.sp-quan-tam .slider-full #owl-thesame .item.product');
                jQuery.each(sp_quan_tam, function(){
                    str_quantam = '';
                });
                //refresh cart
                checkQty();

                }
            }
    });
    return false;
}
function getBuynowUrl(domain){
    url = DOMAIN;
    url += 'checkout/cart/add/uenc/aHR0cDovL3d3dy5zZW5kby52bi90aG9pLXRyYW5nLW51L2FvLW51L2FvLXNvLW1pLWNvbmctc28vaGFwcHktZi0tLWFvLXNvLW1pLXZvYW4tY28tdHJ1LXRheS1waG9uZy0xNzI3NTgv/';
    url += 'product/';
    url += jQuery('#pid').val();
    url += '/buynow/1/';
    return url;
}
function buyNow(){
    jQuery('.login-body .ajax-load-qa').show();
    if(!valid_product_checkout()){
        jQuery('.login-body .ajax-load-qa').hide();
        return false;
    }
    url = getBuynowUrl();
    //remove popup flag
    jQuery('#is_popup').remove();
    jQuery('#product_detail_infomation').attr('action', url);
    jQuery('#product_detail_infomation').submit();
}

function loginAndBuyNow(flag){
    if(!valid_product_checkout())
        return false;
    uri = DOMAIN+'checkout/cart/add/uenc/aHR0cDovL3d3dy5zZW5kby52bi90aG9pLXRyYW5nLW51L2FvLW51L2FvLXNvLW1pLWNvbmctc28vaGFwcHktZi0tLWFvLXNvLW1pLXZvYW4tY28tdHJ1LXRheS1waG9uZy0xNzI3NTgv/';
    uri += 'product/';
    uri += jQuery('#pid').val();
    jQuery('#is_popup').remove();
    uri += '/buynow/1/?';
    uri += jQuery("#product_detail_infomation").serialize();
    OpenIDConnect.cookie('openid_buy_now',uri,{expires: 180,path: '/'});
    OpenIDConnect.redirect_url = uri;
    jQuery('#fosp_login_current_url').val(uri);
    jQuery('#quickview').modal('hide');
    login_click(true,false,true,false,1);
}