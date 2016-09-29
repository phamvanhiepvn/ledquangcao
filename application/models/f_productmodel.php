<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class F_productmodel extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('model');
    }

    public function getarr_idcategory($product_id){
        $q1 = $this->db->query("SELECT id_category FROM product_to_category where id_product = '" . $product_id . "'")->result();
        $arr=array();
        foreach($q1 as $v){
            $arr[]=$v->id_category;
        }
        return $arr;
    }
    public function getProductSimilar($product_id, $limit, $offset)
    {
//        $q1 = $this->db->query("SELECT id,alias,category_id FROM product where alias = '" . $alias . "'");
        $arr_in=$this->getarr_idcategory($product_id);
        $query = $this->db->select('product.id,product_category.id,product.alias as pro_alias,product.image as pro_image,product.caption_1,
                                product.category_id, product.price,product.price_sale,product_category.name as cate_name,
                                product.name as pro_name,product.description,product.code,
                                product.price as pro_price,product.coupon,
                                product_category.alias,product_category.alias as cate_alias,product_category.parent_id,
                                product_to_category.id as product_to_category_id ')
            ->from('product')
            ->join('product_to_category', 'product_to_category.id_product = product.id')
            ->join('product_category', 'product_to_category.id_category = product_category.id')
            ->where_in('product_category.id',$arr_in)
            ->where('product.id !=', $product_id)
            ->group_by('product.id')
            ->get('', $limit, $offset);

        return $query->result();
    }

    public function getProbyCate($alias, $limit, $offset)
    {
        $q1 = $this->db->query("SELECT id,alias FROM product_category where alias = '" . $alias . "'");
        $query = $this->db->select('product.id,product.name as pro_name,product_category.id,product.alias as pro_alias,
        product.image as pro_image,product.price as pro_price,product_category.alias,product_category.alias as cate_alias,product_category.parent_id ')
            ->from('product')
            ->join('product_category', 'product_category.id=product.category_id', 'left')
            ->where('product_category.alias', $alias)

            ->or_where('product_category.parent_id', @$q1->first_row()->id)

            ->limit($limit, $offset)
            ->order_by('product.id', 'desc')
            ->get();

        return $query->result();
    }

    public function count_ProbyCate($alias)
    {
        $q1 = $this->db->query("SELECT id,alias FROM product_category where alias = '" . $alias . "'");

        $query = $this->db->select('product.id,product.name as pro_name,product.price as pro_price,product_category.id,product.alias as pro_alias,
        product.image as pro_image,product_category.alias,product_category.alias as cate_alias,product_category.parent_id ')
            ->from('product')
            ->join('product_category', 'product_category.id=product.category_id', 'left')
            ->where('product_category.alias', $alias)
            ->or_where('product_category.parent_id', @$q1->first_row()->id)

            ->order_by('product.id', 'desc')
            ->get();

        return $query->num_rows();
    }
    /********products show home *************/
    public function Products_cate_home(){
        $this->db->select('product.id as pro_id,product.alias  as pro_alias,product_category.alias,
        product.price,product.price_sale,product.name,product.image,product.category_id,product_category.id,
        product_category.home, product_category.name as cate_name');
        $this->db->join('product_category','product.category_id=product_category.id');
        $this->db->where('product.home','1');
        $this->db->limit(12);
        $this->db->order_by('id','random');
        $q=$this->db->get('product');
        return $q->result();
    }
    public function ProductBycategory($alias,$limit,$offset){
        $cate=$this->getFirstRowWhere('product_category',array('alias'=>$alias));
        //print_r($cate);
        $this->db->select('product.id as pro_id,product.alias as pro_alias,product.location,product.caption_1,
        product.price as pro_price,product.price_sale as pro_price_sale, product.name as pro_name,
        product.category_id, product.alias as pro_alias,product.code,product.coupon,
        product.home,product.image as pro_img,product.hot,product.focus,product_category.id as cate_id,
        product_category.name as cate_name, product_category.alias as cate_alias,
        product_to_category.*');
        $this->db->join('product_to_category','product_to_category.id_product=product.id');
        $this->db->join('product_category','product_category.id=product.category_id','left');
        $this->db->where('product_category.id',$cate->id);
        /*$this->db->where('product.focus !=','1');*/
        $this->db->order_by('product.id','desc');
        $this->db->limit($limit,$offset);
        $q=$this->db->get('product');
        return $q->result();
    }

    /*count  news by category*/
    public function CountProByCategory($alias){
        $cate=$this->getFirstRowWhere('product_category',array('alias'=>$alias));
//        print_r($cate);
        $this->db->select('product.id as pro_id,product.location,product.alias as pro_alias,product.location,product.price as pro_price,product.price_sale as pro_price_sale, product.name as pro_name,product.category_id, product.alias as pro_alias,
        product.home,product.image as pro_img,product.hot,product.focus,product_category.id as cate_id,
        product_category.name as cate_name, product_category.alias as cate_alias,
        product_to_category.*');
        $this->db->join('product_to_category','product_to_category.id_product=product.id');
        $this->db->join('product_category','product_to_category.id_category=product_category.id','left');
        $this->db->where('product_to_category.id_category',$cate->id);
        /*$this->db->where('product.focus !=','1');*/
        $this->db->order_by('product.id','desc');
        $q=$this->db->get('product');
//        return $q->result();
        return $q->num_rows();
    }




    public function getProductImages($alias)
    {
        $this->db->select('product.id, product.alias, product.image, images.id as image_id,images.id_item ,images.link ');
        $this->db->join('product', 'images.id_item=product.id', 'left');
        $this->db->where('product.alias', $alias);
        $q = $this->db->get('images');
        return $q->result();
    }

    public function new_Product()
    {
        $this->db->select('*');
        $this->db->limit(10, 0);
        $q = $this->db->get('product');
        return $q->result();
    }
    public function Search_rs($ma_hang,$limit,$offset){

        $this->db->select('product.id as pro_id,product.alias as pro_alias,product.price as pro_price,product.caption_1,
        product.price_sale as pro_price_sale, product.name as pro_name,product.category_id, product.alias as pro_alias,
        product.home,product.image as pro_img,product.hot,product.focus,product_category.id as cate_id,
        product_category.name as cate_name, product_category.alias as cate_alias,
        product_to_category.*')
        ->join('product_to_category','product_to_category.id_product=product.id')
        ->join('product_category','product_to_category.id_category=product_category.id','left');

        $this->db->limit($limit,$offset);
        if($ma_hang!='null'){
            $this->db->like('product.name',rawurldecode($ma_hang));
        }
        $this->db->order_by('product.id','desc');
        $this->db->group_by('product.id');
        $q=$this->db->get('product');
        return $q->result();
    }

    public function Count_search_rs($ma_hang){

        $this->db->select('product.id as pro_id,product.alias as pro_alias,product.price as pro_price,product.price_sale as pro_price_sale, product.name as pro_name,product.category_id, product.alias as pro_alias,
        product.home,product.image as pro_img,product.hot,product.focus,product_category.id as cate_id,
        product_category.name as cate_name, product_category.alias as cate_alias,
        product_to_category.*')
            ->join('product_to_category','product_to_category.id_product=product.id')
            ->join('product_category','product_to_category.id_category=product_category.id','left');

        if($ma_hang!='null'){
            $this->db->like('product.name',rawurldecode($ma_hang));
        }
        $this->db->order_by('product.id','desc');
        $this->db->group_by('product.id');
        $q=$this->db->get('product');
        return $q->num_rows();
    }


    public function getListRoot(){
        $this->db->select('*');
        $this->db->where('parent_id =',0);
        $q=$this->db->get('product_category');
        return $q->result();
    }
    public function getListChil(){
        $this->db->select('*');
        $this->db->where('parent_id !=',0);
        $q=$this->db->get('product_category');
        return $q->result();
    }


    public function count_ByType($alias)
    {
        $this->db->select('id');
        $this->db->where('type', $alias);
        $q = $this->db->get('sim');
        return $q->num_rows();
    }


    /*httt*/
    public function Home_support(){
        $this->db->select('support_online.name,support_online.phone,support_online.skype,support_online.yahoo');
        $this->db->where('support_online.active',1);
        $this->db->limit(3,0);
        $n=$this->db->get('support_online');
        return $n->result();
    }
    public function getComments($product_id,$limit){
        $this->db->select('comments.*, users.fullname,users.avatar');
        $this->db->join('users','users.id=comments.user');
        $this->db->where('comments.item_id',$product_id);
        $this->db->order_by('comments.id','desc');
        $n=$this->db->get('comments',$limit);
        return $n->result();
    }
    public function getComments_desc($product_id){
        $this->db->select('comments.*, users.fullname, users.avatar');
        $this->db->join('users','users.id=comments.user');
        $this->db->where('comments.item_id',$product_id);
        $n=$this->db->get('comments');
        return $n->result();
    }
    //getpro focus by cate
    public function getProFocusByCate($id)
    {
        $this->db->select('id,name,alias,image,code,coupon');
        $this->db->where('category_id',$id);
        $this->db->where('focus','1');
        $q = $this->db->get('product');
        return $q->result();
    }
    public function getProByType($type,$limit,$offset)
    {
        $this->db->select('product.id as pro_id,product.alias as pro_alias,product.location,product.caption_1,
        product.price as pro_price,product.price_sale as pro_price_sale, product.name as pro_name,
        product.category_id, product.alias as pro_alias,product.code,
        product.home,product.image as pro_img,product.hot,product.focus,product_category.id as cate_id,
        product_category.name as cate_name, product_category.alias as cate_alias,
        product_to_category.*');
        $this->db->join('product_to_category','product_to_category.id_product=product.id');
        $this->db->join('product_category','product_to_category.id_category=product_category.id','left');
        if($type == 'focus')
        {
            $this->db->where('product.focus','1');
        }

        $this->db->order_by('product.id','desc');
        $this->db->limit($limit,$offset);
        $q=$this->db->get('product');
        return $q->result();
    }
    public  function countProByType($type)
    {
        $this->db->select('product.id');
        $this->db->join('product_to_category','product_to_category.id_product=product.id');
        $this->db->join('product_category','product_to_category.id_category=product_category.id','left');
        if($type == 'focus')
        {
            $this->db->where('product.focus','1');
        }

        $this->db->order_by('product.id','desc');

        $q=$this->db->get('product');
        return $q->num_rows();
    }
}