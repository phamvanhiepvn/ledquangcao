<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/



$route['default_controller'] = "home/index";
$route['404_override'] = 'my404';
$route['admin/login'] = 'admin/admin/login';
$route['admin/logout'] = 'admin/admin/logout';
$route['admin'] = 'admin/news/index';

$route['translate_uri_dashes'] = TRUE;

$route['admin/doi-mat-khau'] = 'admin/admin/admin_change_password';



// FrontEnd=======================================
$route['home'] = "home/home";
$route['gioi-thieu'] = "home/about";
$route['gioi-thieu-bts-media'] = "home/about";
$route['dich-vu'] = "home/service";

$route['tin-tuc'] = 'news_frontend/news_all';
$route['tin-tuc/(:num)'] = 'news_frontend/news_all/$1';
$route['tin-tuc/du-an'] = 'news_frontend/news_bycategory/$1';
$route['tin-tuc/du-an/(:num)'] = 'news_frontend/news_bycategory/$1/$2';
$route['tin-tuc/du-an/(:any)'] = 'news_frontend/news_bycategory/$1';

$route['tin-tuc/bai-viet'] = 'news_frontend/post';
$route['tin-tuc/bai-viet/(:num)'] = 'news_frontend/post/$1';

$route['tin/(:any)'] = 'news_frontend/news_content/$1';//newsdetail($alias_cate,$alias_news)

$route['gui-email'] = 'home/addAnEmail';


$route['danh-muc/(:any)'] = 'product_frontend/pro_bycategory/$1';

$route['san-pham/(:any)'] = 'product_frontend/productdetail/$1';
//$route['san-pham/(:any)'] = 'product_frontend/signout';
//===========================trang tinh
$route['page/(:any)'] = 'staticpage_frontend/pagecontent/$1';
$route['danh-sach-khach-hang'] = 'staticpage_frontend/listCustomer';
$route['danh-sach-khach-hang/(:num)'] = 'staticpage_frontend/listCustomer/$1';
//===========================tinh thanh
$route['tinh-thanh/(:any)'] = 'product_frontend/pro_location/$1';
$route['tinh-thanh/(:any)/(:num)'] = 'product_frontend/pro_location/$1/$2';



$route['lien-he'] = 'contact';
$route['promotion'] = 'contact/promotion';


$route['admin/site_option'] = 'admin/admin/site_option';

//link menu==========

$route['danh-muc-tin-tuc/(:any)'] = 'f_news/newsbycate/$1';

//News
$route['admin/danh-sach-tin-tuc'] = 'admin/news/newsListAll/0';
$route['admin/danh-sach-tin-tuc/(:num)'] = 'admin/news/newsListAll/$1';
$route['admin/tin-tuc/(:any)'] = 'admin/news/news_by_category/$1';
$route['admin/tin-tuc/Add'] = 'admin/news/add';
$route['admin/tin-tuc/Edit/(:any)'] = 'admin/news/edit/$1';
$route['admin/tin-tuc/change-category/(:any)'] = 'admin/news/change_newscate/$1';

$route['admin/delete-images'] = 'admin/news/delete_images';

$route['admin/news/deletecate/(:num)'] = 'admin/news/deletecate/$1';
$route['admin/news/change_newscate/(:num)'] = 'admin/news/change_newscate/$1';
$route['admin/news/edit/(:num)'] = 'admin/news/edit/$1';
$route['admin/news/delete/(:num)'] = 'admin/news/delete/$1';


//Category
$route['admin/danh-muc-tin-tuc'] = 'admin/news/categoryList';
$route['admin/category/Add'] = 'admin/news/addcategory';
$route['admin/category/Edit/(:num)'] = 'admin/news/editcategory/$1';
//Tags
$route['admin/quan-ly-tags'] = 'admin/news/taglist';
$route['admin/quan-ly-tags/(:num)'] = 'admin/news/taglist/$1';
$route['admin/tags/Add'] = 'admin/news/addtags';
$route['admin/tags/Edit'] = 'admin/news/edittags';
$route['admin/tags/Delete/(:num)'] = 'admin/news/deletetags/$1';
//Staticpage=================================================================
$route['admin/manager-page'] = 'admin/staticpage/staticpagelist';
$route['admin/manager-page/(:num)'] = 'admin/staticpage/staticpagelist/$1';
$route['admin/manager-page/Add'] = 'admin/staticpage/addpage';
$route['admin/manager-page/Edit/(:num)'] = 'admin/staticpage/editpage/$1';
$route['admin/manager-page/Delete/(:num)'] = 'admin/staticpage/deletepage/$1';

$route['admin/danh-sach-khach-hang'] = 'admin/staticpage/listCustomer';
$route['admin/danh-sach-khach-hang/(:num)'] = 'admin/staticpage/listCustomer/$1';
$route['admin/them-khach-hang'] = 'admin/staticpage/addCustomer';
$route['admin/sua-thong-tin-khach-hang/(:num)'] = 'admin/staticpage/addCustomer/$1';
$route['admin/xoa-khach-hang/(:num)'] = 'admin/staticpage/deleteCustomer/$1';
//Product==============================================================
$route['admin/danh-sach-du-an'] = 'admin/product/productlist';
$route['admin/danh-sach-du-an/(:num)'] = 'admin/product/productlist/$1';
$route['admin/du-an/Add'] = 'admin/product/addpro';
$route['admin/du-an/Edit/(:num)'] = 'admin/product/addpro/$1';
//$route['admin/product/Edit/(:num)'] = 'admin/product/editpro/$1';
$route['admin/du-an/Delete/(:num)'] = 'admin/product/deletepro/$1';

$route['admin/danh-muc-san-pham'] = 'admin/product/categoryList';

$route['admin/product/change-category/(:any)'] = 'admin/product/change_procate/$1';

$route['admin/product/(:any)'] = 'admin/product/pro_by_category/$1';

$route['admin/product/(:any)/(:num)'] = 'admin/product/pro_by_category/$1/$2';

$route['admin/product_images/(:num)'] = 'admin/product/productimages/$1';



$route['admin/danh-muc-san-pham'] = 'admin/product/categoryList';
$route['admin/danh-muc-san-pham/(:num)'] = 'admin/product/categoryList/$1';
$route['admin/product_category/Add'] = 'admin/product/addprocategory';
$route['admin/product_category/Edit/(:num)'] = 'admin/product/addprocategory/$1';
$route['admin/product_category/Delete/(:num)'] = 'admin/product/deletecategory/$1';
 

//Menu=================================================================
$route['admin/danh-sach-menu'] = 'admin/menu/menulist';
$route['admin/menu/Add'] = 'admin/menu/addmenu';
$route['admin/menu/Edit/(:num)'] = 'admin/menu/addmenu/$1';
$route['admin/menu/delete/(:num)'] = 'admin/menu/deletemenu/$1';

//Sliders
$route['admin/sliders'] = 'admin/sliders/index';
$route['admin/sliders/(:num)'] = 'admin/sliders/index/$1';
$route['admin/sliders/add'] = 'admin/sliders/add';
$route['admin/sliders/edit/(:num)'] = 'admin/sliders/edit/$1';
$route['admin/sliders/delete/(:num)'] = 'admin/sliders/delete/$1';



//Images=================================================================

$route['admin/imageupload'] = 'admin/imageupload/index';
$route['admin/imageupload/(:num)'] = 'admin/imageupload/index/$1';
$route['admin/imageupload/banner'] = 'admin/imageupload/banner';
$route['admin/imageupload/banner_add'] = 'admin/imageupload/banner_add';
$route['admin/imageupload/delete/(:num)'] = 'admin/imageupload/delete/$1';
$route['admin/imageupload/doupload'] = 'admin/imageupload/doupload';


//$route['admin/imageupload/banner_edit/(:num)'] = 'admin/imageupload/banner_add/$1';
$route['admin/imageupload/banner_edit/(:num)'] = 'admin/imageupload/edit/$1';


//Users=================================================================
$route['admin/quan-ly-thanh-vien'] = 'admin/users/userslist';
$route['admin/quan-ly-thanh-vien/(:num)'] = 'admin/users/userslist/$1';
$route['admin/users/delete/(:num)'] = 'admin/users/delete/$1';
$route['admin/active_user'] = 'admin/users/active_user';
$route['admin/emails'] = 'admin/users/emails';
$route['admin/emails/(:num)'] = 'admin/users/emails/$1';
$route['admin/emails/delete/(:num)'] = 'admin/users/delete_mail/$1';
$route['admin/emails/send-mail'] = 'admin/users/mail_coupon';


//Oder=================================================================
$route['admin/danh-sach-dat-hang'] = 'admin/order/Oderlist';
$route['admin/danh-sach-dat-hang/(:num)'] = 'admin/order/Oderlist/$1';
$route['admin/deleteorder/(:num)'] = 'admin/order/Deleteorder/$1';

//Modules=================================================================
$route['admin/danh-sach-modules'] = 'admin/modules/list';
$route['admin/quan-ly-modules'] = 'admin/modules/modulemanager';
$route['admin/edit-modules/(:num)'] = 'admin/modules/modulemanager/$1';
$route['admin/delete-module/(:num)'] = 'admin/modules/delete/$1';

        //phan quyen admin
$route['admin/admin-permission'] = 'admin/admin/admin_permission';

$route['admin/admin-permission-edit/(:num)'] = 'admin/admin/admin_permission/$1';
$route['admin/admin-reset-pass/(:num)'] = 'admin/admin/reset_pass/$1';
$route['admin/admin-permission-delete/(:num)'] = 'admin/admin/delete_acc/$1';

        //Tesst========================
$route['admin/ExportExcel'] = 'admin/product/ExportExcel';

//Contact===========
$route['admin/contact/list'] = 'admin/contact/contact_list';
$route['admin/contact/list/(:num)'] = 'admin/contact/contact_list/$1';
$route['admin/contact/Delete/(:num)'] = 'admin/contact/Delete/$1';

$route['admin/contact/promo-list'] = 'admin/contact/promoList';
$route['admin/contact/promo-add'] = 'admin/contact/promoAdd';
$route['admin/contact/promo-add/(:num)'] = 'admin/contact/promoAdd/$1';
$route['admin/contact/promo-list/(:num)'] = 'admin/contact/promoList/$1';
$route['admin/contact/promo-delete/(:num)'] = 'admin/contact/promoDelete/$1';
$route['admin/contact/promo-customer-list'] = 'admin/contact/promoCustomerList';
$route['admin/contact/promo-customer-list/(:num)'] = 'admin/contact/promoCustomerList/$1';
$route['admin/contact/promo-customer-delete/(:num)'] = 'admin/contact/promoCustomerDelete/$1';

// ======================Manager Page==========================================
$route['admin/home'] = 'admin/home/index';
$route['admin/about'] = 'admin/home/about';
$route['admin/service'] = 'admin/home/service';
$route['admin/skill'] = 'admin/home/skill_list';
$route['admin/skill-add'] = 'admin/home/skill_add';
$route['admin/skill-add/(:num)'] = 'admin/home/skill_add/$1';



//================FRONT END=======================================================================================================






//Comments=================================================================
$route['admin/comment/list'] = 'admin/comment/listComment';
$route['admin/comment/list/(:num)'] = 'admin/comment/listComment/$1';
$route['admin/comment/Delete/(:num)'] = 'admin/comment/Delete/$1';

$route['huy-dat-hang/(:num)'] = 'users_frontend/deleteItem/$1';
$route['san-pham-quan-tam'] = 'users_frontend/listLike';
$route['san-pham-quan-tam/(:num)'] = 'users_frontend/listLike/$1';
//payment =======================
$route['search'] = 'home/search';





