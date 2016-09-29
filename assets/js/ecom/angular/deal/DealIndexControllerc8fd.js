cgSendo.controller('DealIndexController', function ($scope, $http) {
    $scope.shop_info = [];
    $scope.comment = [];
    $scope.view = [];
    $scope.deal_list = [];
    $scope.DOMAIN = DOMAIN;
    $scope.test = 0;
    for (i in $scope.deal_list){
        var deal = $scope.deal_list[i];
        console.log(deal.Name);
    }
    $scope.getShopData = function(){
        var param = 'https://www.sendo.vn/homepage/partial/proExtInfo2/?param=';
        var deal_list = $scope.deal_list;
        for (i in deal_list){
            var deal = deal_list[i];
            param += deal.Product_id + "_" + deal.Type_product + "_" + deal.Admin_id + ",";
        }
        $http.get(DOMAIN+param).success(function(data) {
            var shop_info = [];
            var comment = [];
            var view = [];
            for (product_id in data){
                shop_info[product_id] = data[product_id]['shop_info'];
                comment[product_id] = data[product_id]['comment'];
                view[product_id] = data[product_id]['view'];
            }
            $scope.shop_info = shop_info;
            $scope.comment = comment;
            $scope.view = view;
        });
    }

    //pagination
    $scope.page_count = 0;
    $scope.getPages = function(){
        var pages = [];
        for (i = 1; i<= $scope.page_count; i++){
            pages.push(i);
        }
        return pages;
    }
});

cgSendo.directive('pLazyLoadDeal', function() {
  return function(scope, element, attrs) {
    if (scope.$last){        
       setTimeout(function(){$('.lazyDeal').lazyload({effect : "fadeIn"}); },200);       
    }
  };
})
