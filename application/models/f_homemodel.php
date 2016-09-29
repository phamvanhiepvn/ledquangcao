<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class F_homemodel extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
    }
    public function getMenuBottomRoot(){
        $this->db->select('*');
        $this->db->where('position','bottom');
        $this->db->order_by('sort','esc');
        $q=$this->db->get('menu');
        return $q->result();
    }
    public function getMenuTopRoot(){
        $this->db->select('*');
        $this->db->where('position','top');
        $this->db->where('parent_id',0);
        $this->db->order_by('sort','esc');
        $q=$this->db->get('menu');
        return $q->result();
    }
    public function getMenuRightRoot(){
        $this->db->select('*');
        $this->db->where('position','right');
        $this->db->where('parent_id',0);
        $q=$this->db->get('menu');
        return $q->result();
    }


    public function getMenu_chil(){
        $this->db->select('*');
        $this->db->where('parent_id !=',0);
        $this->db->order_by('sort','esc');
        $q=$this->db->get('menu');
        return $q->result();
    }

    /*banner 1*/
    public function getBanner($type,$offset){

        $this->db->select('*');
        $this->db->where('type',$type);
        if($type!="slider"){
            $this->db->limit(1, $offset);
        }


        $this->db->order_by('sort','esc');
        $q = $this->db->get('images');
        return $q->result();
    }


    // tỉnh thành
    public function getMenuTopLocation(){
        $this->db->select('province.*');
        $this->db->where('view',1);
        $q=$this->db->get('province');
        return $q->result();
    }


    public function getSlider(){
        $this->db->where('type','banner');
        $q=$this->db->get('images');
        return $q->result();
    }
    public function getSlider_partners(){
        $this->db->where('type','partners');
        $q=$this->db->get('images');
        return $q->result();
    }
    public function NewsCate_focus(){
        $this->db->select('news.id as news_id, news.title,news.category_id,news.home,
        news.hot,news.focus,news.image, news_category.id as cate_id,
         news_category.name as cate_name,news_category.alias as cate_alias,news.alias as news_alias');
        $this->db->where('news_category.focus',1);
        $this->db->where('news.home',1);
        $this->db->join('news_category','news.category_id=news_category.id','left');
        $this->db->order_by('news.id','desc');
        $this->db->limit(2,0);
        $q=$this->db->get('news');
        return $q->result();
    }

    public function getNewsCateHome($view){
        $this->db->where($view,1);
        $q=$this->db->get('news_category');
        return $q->result();
    }

    public function getNewsByCate($view){
        $this->db->select('id , title,category_id,home,hot,focus,image,alias,description');
        $this->db->where($view,1);
        $q=$this->db->get('news');
        return $q->result();
    }

    public function FirstHotNews(){
        $this->db->select('news.*,news.alias as news_alias, news_category.*');
        $this->db->join('news_category','news_category.id=news.category_id');
        $this->db->where('news.home',1);
        $this->db->where('news_category.hot',1);
        $this->db->order_by('news.id','desc');
        $this->db->limit(1,0);
        $q=$this->db->get('news');
        return $q->result();
    }

    public function SecondHotNews(){
        $this->db->select('news.*,news.alias as news_alias,news_category.*');
        $this->db->join('news_category','news_category.id=news.category_id');
        $this->db->where('news.home',1);
        $this->db->where('news_category.hot',1);
        $this->db->order_by('news.id','desc');
        $this->db->limit(2,1);
        $q=$this->db->get('news');
        return $q->result();
    }


    public function getBannerByType($type){
        $this->db->where('type',$type);
        $this->db->limit(1);
        $q=$this->db->get('images');
        return $q->first_row();
    }
    public function Bannerbottom(){
        $this->db->where('type','ads_bottom');
        $q=$this->db->get('images');
        return $q->result();
    }

    //Menu left
    public function getMenuLeft_root(){
        $this->db->select('*');
        $this->db->where('parent_id',0);
        $this->db->where('position','left');
        $this->db->order_by('sort','esc');
        $q=$this->db->get('menu');
        return $q->result();
    }
    public function getMenuLeft_child(){
        $this->db->select('*');
        $this->db->where('parent_id !=',0);
        $this->db->order_by('sort','esc');
        $q=$this->db->get('menu');
        return $q->result();
    }
    //cate gory
    public function getProCateLeft_root(){
        $this->db->select('*');
        $this->db->where('parent_id',0);
        $q=$this->db->get('product_category');
        return $q->result();
    }
    public function getIdNameParentCategory(){
        $this->db->select('id,name');
        $this->db->where('parent_id',0);
        $q=$this->db->get('product_category');
        return $q->result();
    }
    public function getIdNameChildCategory($id){
        $this->db->select('id,name');
        $this->db->where('parent_id',$id);
        $q=$this->db->get('product_category');
        return $q->result();
    }
    public function getProductByAllCategory($idChild,$idParent){
        $this->db->select('id,name');
        $this->db->where('category_id',$idChild);
        $this->db->or_where('category_id',$idParent);
        $this->db->order_by('id','desc');

        $q=$this->db->get('product');
        return $q->result();
    }
    public function getProCateLeft_child(){
        $this->db->select('*');
        $this->db->where('parent_id !=',0);
        $q=$this->db->get('product_category');
        return $q->result();
    }
    public function New_Product(){
        $this->db->select('*');
        $this->db->order_by('id','desc');
        $q=$this->db->get('product');
        return $q->result();
    }
    public function Banner(){
        $this->db->select('*');
        $this->db->where('type','banner');
        $q=$this->db->get('images');
        return $q->result();
    }

    public function Home_products_cate(){
        $this->db->select('*');
        $this->db->where('home','1');
        $this->db->limit(3,0);
        $q=$this->db->get('product_category');
        return $q->result();
    }
    /**** menu main  bottom*****/
    public function Menu_home(){
        $this->db->select('product_category.name,product_category.alias,product_category.id,
        product_category.image as cate_image,product_category.parent_id');
//        $this->db->where('parent_id','0');
        $q=$this->db->get('product_category');
        return $q->result();
    }
    /**** menu main top *****/
    public function Menu_home_top(){
        $this->db->select('product_category.name,product_category.alias,product_category.id,
        product_category.image as cate_image,product_category.parent_id');
        $this->db->where('parent_id','0');
        $this->db->where('home !=',1);
        $q=$this->db->get('product_category');
        return $q->result();
    }

    /**** menu main top *****/
    public function Menu_home_child(){
        $this->db->select('product_category.name,product_category.alias,product_category.id,
        product_category.image as cate_image,product_category.parent_id');
        $q=$this->db->get('product_category');
        return $q->result();
    }


    public function Products_by_view($view,$tinh){

        @$q1 = $this->db->query("SELECT provinceid,alias,name FROM province where alias = '" . $tinh . "'")->first_row();

        $this->db->select('product.id as pro_id,product.alias  as pro_alias,product_category.alias,product.caption_1,
        product.price,product.price_sale,product.name,product.image,product.category_id,product_category.id,
        product_category.home, product_category.name as cate_name,');
        $this->db->join('product_category','product.category_id=product_category.id');
        $this->db->where('product.'.$view,'1');

        if($tinh!='toan-quoc'){
            $this->db->where_in('product.location',array(@$q1->provinceid,'00'));
        }
        $q=$this->db->get('product',20);
        return $q->result();
    }



    public function homeview_category(){
        $this->db->select('product_category.*');
        $this->db->where('product_category.home',1);
        $this->db->order_by('product_category.sort');
        $q=$this->db->get('product_category');
        return $q->result();

    }

    public function Banner_by_cate_home($cate_id){
        $this->db->select('images.*');
        $this->db->where_in('images.cate',$cate_id);
        $q=$this->db->get('images');
        return $q->result();
    }
    public function array_cate($id_product){
        $this->db->select('product_to_category.id_category');
        $this->db->where('product_to_category.id_product',$id_product);
        $q=$this->db->get('product_to_category');
        $b=array();
        $rs=$q->result();
        foreach($rs as $v){
            $b[]=$v->id_category;
        }
        return $b;
    }
    public function Products_by_cate_home($cate){

        $this->db->select('product.id as pro_id,product.alias  as pro_alias,product_category.alias,product.caption_1,product.category_id,
        product.price,product.hot,product.focus,product.price_sale,product.name,product.code,
        product.image,product.category_id,product_category.id,product.coupon,
        product_category.home, product_category.name as cate_name,
        product_to_category.id_category
        ');
        $this->db->join('product_category','product.category_id=product_category.id');
        $this->db->join('product_to_category','product.id=product_to_category.id_product');
        $this->db->where('product_to_category.id_category',$cate);


        $this->db->group_by('product.id');
        $q=$this->db->get('product',20);
        return $q->result();
    }


    /*httt*/
    public function Home_support(){
        $this->db->select('support_online.name,support_online.phone,support_online.skype,support_online.yahoo');
        $this->db->where('support_online.active',1);
        $this->db->limit(3,0);
        $n=$this->db->get('support_online');
        return $n->result();
    }
    // search
    public function searchProduct($key)
    {
        $this->db->select('product.*,product.name as pro_name,product.alias as pro_alias,product.image as pro_image, product_category.*');
        $this->db->join('product_category','product_category.id=product.category_id');
        $this->db->like("product.name",$key);
        $q=$this->db->get('product');
        return $q->result();
    }


    public function news_promotion(){
        $this->db->select('*');
        $this->db->where('focus','1');
        $q=$this->db->get('news');
        return $q->result();
    }
    public function news_home(){
        $this->db->select('*');
        $this->db->where('home','1');
        $this->db->order_by('id','desc');
        $q=$this->db->get('news');
        return $q->result();
    }

    /*deal noi bat*/
    public function ProductBycategory($alias,$limit,$offset){
        $cate=$this->getFirstRowWhere('product_category',array('alias'=>$alias));
//        print_r($cate);
        $q= $this->db->select('product.id as pro_id,product.location,product.alias as pro_alias,product.location,product.price as pro_price,product.price_sale as pro_price_sale, product.name as pro_name,product.category_id, product.alias as pro_alias,
        product.home,product.image as pro_img,product.hot,product.focus,product_category.id as cate_id,
        product_category.name as cate_name, product_category.alias as cate_alias,
        product_to_category.*')
            ->join('product_to_category','product_to_category.id_product=product.id')
            ->join('product_category','product_to_category.id_category=product_category.id','left')
            ->where('product_to_category.id_category',$cate->id)
            ->order_by('product.id','desc')
            ->group_by('product.id')
            ->limit($limit,$offset)
            ->get('product');
//        echo $q->last_query();
        return $q->result();
    }

    /*count  news by category*/
    public function CountProByCategory($alias=null){
        if($alias){
            $cate=$this->getFirstRowWhere('product_category',array('alias'=>$alias));
        }


        $q= $this->db->select('product.id as pro_id,product.location,product.price as pro_price,product.price_sale as pro_price_sale, product.name as pro_name,product.category_id, product.alias as pro_alias,
        product.home,product.image as pro_img,product.hot,product.focus,product_category.id as cate_id,
        product_category.name as cate_name, product_category.alias as cate_alias,
        product_to_category.*')
            ->join('product_to_category','product_to_category.id_product=product.id')
            ->join('product_category','product_to_category.id_category=product_category.id','left')
            ->where('product_to_category.id_category',@$cate->id)
            ->group_by('product.id')
            ->get('product');
        return $q->num_rows();
    }
    /* Search tin tưc==============================================*/
    public function getProSale()
    {
        $this->db->select('product.id as pro_id,product.alias  as pro_alias,product_category.alias,
        product.price,product.price_sale,product.name,product.image,product.code,
        product.category_id,product_category.id,product.coupon,product.caption_3,
        product_category.home, product_category.name as cate_name');
        $this->db->join('product_category','product.category_id=product_category.id');
        $this->db->where('product.coupon',1);
        $this->db->order_by('product.id','desc');
        $this->db->limit(5);
        $q = $this->db->get('product');
        return $q->result();
    }
    public function getProFocus()
    {
        $this->db->select('product.id as pro_id,product.alias  as pro_alias,product_category.alias,
        product.price,product.price_sale,product.name,product.image,product.code,
        product.category_id,product_category.id,product.coupon,
        product_category.home, product_category.name as cate_name');
        $this->db->join('product_category','product.category_id=product_category.id');
        $this->db->where('product.focus',1);
        $this->db->order_by('product.id','desc');
        $this->db->limit(20);
        $q = $this->db->get('product');
        return $q->result();
    }
    public function getCateHome()
    {
        $this->db->select('*');
//        $this->db->where('home','1');
        $this->db->order_by('sort');
        $q = $this->db->get('product_category');
        return $q->result_array();
    }
    public function getListDesign()
    {
        $this->db->select('product.id as pro_id,product.alias  as pro_alias,product_category.alias,
        product.price,product.price_sale,product.name,product.image,product.coupon,
        product.category_id,product_category.id,
        product_category.home, product_category.name as cate_name');
        $this->db->join('product_category','product.category_id=product_category.id');
        $this->db->where('product.design','1');
        $this->db->order_by('product.id','desc');
        $q = $this->db->get('product');
        return $q->result();
    }
    public function getPoduct_search($where,$limit,$offset){
        $this->db->select('product.id as pro_id,product.alias as pro_alias,product.location,product.caption_1,
        product.price as pro_price,product.price_sale as pro_price_sale,product.code,
        product.name as pro_name,product.category_id, product.alias as pro_alias,
        product.home,product.image as pro_img,product.hot,product.focus,product_category.id as cate_id,
        product_category.name as cate_name, product_category.alias as cate_alias');
        $this->db->join('product_category','product_category.id=product.category_id','left');
        if($where['id'] != '') {
            $this->db->where('product_category.id',$where['id']);
        }
        if($where['key'] != '') {
            $this->db->like('product.name',$where['key']);
        }
        $this->db->order_by('product.id','desc');
        $this->db->limit($limit,$offset);
        $q=$this->db->get('product');
        return $q->result();
    }

    public function countPoduct_search($where){
        $this->db->select('product.id as pro_id,product.alias as pro_alias,product.location,product.caption_1,
        product.price as pro_price,product.price_sale as pro_price_sale, product.name as pro_name,product.category_id, product.alias as pro_alias,
        product.home,product.image as pro_img,product.hot,product.focus,product_category.id as cate_id,
        product_category.name as cate_name, product_category.alias as cate_alias');
        $this->db->join('product_category','product_category.id=product.category_id','left');
        if($where['id'] != '') {
            $this->db->where('product_category.id',$where['id']);
        }
        if($where['key'] != '') {
            $this->db->like('product.name',$where['key']);
        }
        $q=$this->db->get('product');
        return $q->num_rows();
    }
    public function getSupport()
    {
        $this->db->select();
        $this->db->where('type',0);
        $this->db->order_by('id','random');
        $q = $this->db->get('support_online');
        return $q->result();
    }
    public function getStaticPageById($id)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $q = $this->db->get('staticpage');
        return $q->first_row();
    }

    public function getPromo()
    {
        $this->db->where('status','1');
        $q = $this->db->get('promotion');
        return $q->first_row();
    }
    public function getDescGuestTop()
    {
        $this->db->where('category_id',20);
        $this->db->where('home',1);
        $q=$this->db->get('news');
        return $q->first_row();
    }
    public function getNewsByCategoryId($id,$limit,$type=null){
        $this->db->select('*');
        if($type!=="focus"){
            $this->db->where('category_id',$id);
        }
        if($type!==null){
            $this->db->where($type,1);
        }
        $this->db->order_by('id','desc');
        $this->db->limit($limit);
        $q=$this->db->get('news');
        return $q->result();
    }
    public function getNewsTop($limit){
        $this->db->select('*');
        $this->db->order_by('id','desc');
        $this->db->limit($limit);
        $q=$this->db->get('news');
        return $q->result();
    }
    public function getLogoByType($type){
        $this->db->select('link');
        if($type=="banner"){
            $this->db->where('title',1);
        }
        $this->db->where('type',$type);
        $q=$this->db->get('images');
        return $q->first_row();
    }
    public function getLatestProject(){
        $this->db->select('*');
        $this->db->limit(12,0);
        $this->db->order_by('id','desc');
        $this->db->where('category_id',21);
        $q=$this->db->get('news');
        return $q->result();
    }

}