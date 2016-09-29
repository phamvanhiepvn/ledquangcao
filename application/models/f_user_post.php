<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class F_user_post extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
        $this->load->database();
    }

    //====================================================================================================================
    /*menu right*/
    public function getMenuRightRoot(){
        $this->db->select('*');
        $this->db->where('position','right');
        $this->db->where('parent_id',0);
        $q=$this->db->get('menu');
        return $q->result();
    }

    //====================================================================================================================
    public function getListProduct($table,$limit,$offset){

        $this->db->select(' product.*,product.id as pro_id,  product_category.id as cate_id, product_category.name as cate_name');
        $this->db->join('product_category','product.category_id=product_category.id','left');
        $this->db->limit($limit,$offset);
        $this->db->order_by('id','desc');
        $q=$this->db->get($table);
        return $q->result();
    }
    public function getProImage($id){
        $this->db->select('product.id as pro_id, product.name as pro_name,images.*, images.id as img_id ');
        $this->db->join('images','product.id=images.id_item','left');
        $this->db->where('product.id',$id);
        $q=$this->db->get('product');
        return $q->result();
    }

    public function ProductBycategory($alias,$limit,$offset){
        $cate=$this->getFirstRowWhere('product_category',array('alias'=>$alias));
//        print_r($cate);
        $q= $this->db->select('product.id as pro_id, product.name as pro_name,product.category_id, product.alias as pro_alias,
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
    public function countProByCategory($alias){

        $cate=$this->getFirstRowWhere('product_category',array('alias'=>$alias));
//        print_r($cate);
        $q= $this->db->select('product.id as pro_id, product.name as pro_name,product.category_id, product.alias as pro_alias,
        product.home,product.image as pro_img,product.hot,product.focus,product_category.id as cate_id,
        product_category.name as cate_name, product_category.alias as cate_alias,
        product_to_category.*')
            ->join('product_to_category','product_to_category.id_product=product.id')
            ->join('product_category','product_to_category.id_category=product_category.id','left')
            ->where('product_to_category.id_category',$cate->id)
            ->group_by('product.id')
            ->get('product');
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
    public function Deltete_cate($id_pro){
        if(is_numeric($id_pro)){
            $this->db->where('id_product',$id_pro);
            $this->db->delete('product_to_category');
        }else return false;
    }

    public function Getdata_search($table,$where = null,$order=null, $limit = null, $offset = null)
    {
        $this->db->select(' product.*,product.id as pro_id,  product_category.id as cate_id, product_category.name as cate_name');
        $this->db->join('product_category','product.category_id=product_category.id','left');

        if (is_array($where)||$where!=null) {
            $this->db->like($where);
        }

        if ($limit || $offset) {
            $this->db->limit($limit, $offset);
        }
        if (is_array($order)) {
            $this->db->order_by($order[0],$order[1]);
        }

        $q = $this->db->get($table);
        return $q->result();
    }
    public function Count_search($table,$where= null)
    {
        $this->db->select(' product.*,product.id as pro_id,  product_category.id as cate_id, product_category.name as cate_name');
        $this->db->join('product_category','product.category_id=product_category.id','left');

        if (is_array($where)||$where!=null) {
            $this->db->like($where);
        }
        $q= $this->db->get($table);
        return $q->num_rows();
    }
}