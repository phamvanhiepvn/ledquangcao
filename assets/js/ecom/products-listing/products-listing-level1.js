var listLevel1 = {
		getProductVasupByCategory: function(catePath){
		    if (catePath != '') {
		        jQuery.ajax({
		            url: DOMAIN + 'homepage/partial/getVasupDataByCategory/?cate_path=' + catePath ,
		            type: "GET",
		            dataType: "json",
		            success: function(data) {
		            	var html = []
		                for (i in data) {
		                	html.push(listLevel1.renderProductVasupByCategoryHtml(data[i]));
		                }   
		            	$('#vasup_product').html(html.join(''));
		            }
		        });
		    }
		},
		getShopHoaSen: function(){
		    jQuery.ajax({
		            url: DOMAIN + 'homepage/partial/shopHoaSen',
		            type: "GET",
		            dataType: "json",
		            success: function(data) {
		            	$('#owl-brands').html(data);
		            }
		    });		    
		},
		renderProductVasupByCategoryHtml: function(productData){
			var htmlItem = [];
			htmlItem.push('<div class="product-box">');

			htmlItem.push('<a href="' + DOMAIN + productData['Cat_path'] + '" title="" class="img"> <img src="'+productData['Image']+'" width="100" height="100" alt="'+productData['Name']+'" title="'+productData['Name']+'"/></a>');
			htmlItem.push('<div class="content">');
            if (productData['Is_promotion']){
            	htmlItem.push('<div class="price old">'+productData['Price']+'&nbsp;VNĐ</div>');
                htmlItem.push('<div class="price">'+productData['Special_price']+'&nbsp;VNĐ</div>');
            }else{
            	htmlItem.push('<div class="price">'+productData['Price']+'&nbsp;VNĐ</div>');
            }

            htmlItem.push('<a class="name" href="'+DOMAIN+productData['Cat_path'] + '" title="'+productData['Name']+'">'+productData['Name']+'</a>');
            htmlItem.push('<h3><a class="shop_name" href="'+DOMAIN+'shop/'+productData['Merchant']['Username']+'" title="'+productData['Merchant']['Name']+'" rel="nofollow">Shop:<br/><strong>'+productData['Merchant']['Name']+'</strong></a></h3>');
           	htmlItem.push('</div>');
            if (productData['tuthien'] == 1) {
            htmlItem.push('<div class="ic-event-eldy-listing" title="Ủng hộ 5,000 đồng vào chương trình từ thiện Em là để yêu khi mua sản phẩm này." data-placement="right">&nbsp;</div>');
            }
            if (productData['discount_percent'] > 0 && productData['discount_percent'] < 100){
            	htmlItem.push('<div class="discount-tag">-'+productData['discount_percent']+'%</div>');
            }       
            htmlItem.push('</div>');
            return htmlItem.join('');
		}	
};


