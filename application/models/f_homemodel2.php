<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class F_homemodel extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
    }
    public function getMenuTopRoot(){
        $this->db->select('*');
        $this->db->where('position','top');
        $this->db->where('parent_id',0);
        $this->db->order_by('sort','esc');
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

    public function getSlider(){
        $this->db->where('type','banner');
        $q=$this->db->get('images');
        return $q->result();
    }

    public function NewsCate_focus(){
        $this->db->select('news.id as news_id, news.title,news.category_id,news.home,news.hot,news.focus,news.image, news_category.id as cate_id,
         news_category.name as cate_name,news_category.alias as cate_alias,news.alias as news_alias');

        $this->db->where('news_category.focus',1);
        $this->db->where('news.home',1);
        $this->db->join('news_category','news.category_id=news_category.id','left');
        $this->db->order_by('news.id','desc');
        $this->db->limit(4,0);
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
    public function getMenuLeft_chil(){
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
    public function getProCateLeft_chil(){
        $this->db->select('*');
        $this->db->where('parent_id !=',0);
        $q=$this->db->get('product_category');
        return $q->result();
    }
    public function new_Product(){
        $this->db->select('*');
        $this->db->limit(10,0);
        $q=$this->db->get('product');
        return $q->result();
    }
    public function Banner(){
        $this->db->select('*');
        $this->db->where('type','banner');
        $q=$this->db->get('images');
        return $q->result();
    }
/*
    public function Simlist(){
        $this->db->select('sim.*,sim_type.*, sim_type.alias as type_alias, sim.alias as alias_sim');
        $this->db->where('sim.home','1');
        $this->db->join('sim_type','sim.type=sim_type.alias','left');
        $q=$this->db->get('sim');
        return $q->result();
    }

    public function getSimType(){
        $this->db->select('*');
        $this->db->where('home','1');
        $q=$this->db->get('sim_type');
        return $q->result();
    }
    public function Search_Sim(){

        $this->db->select('sim.*,sim_type.*, sim_type.alias as type_alias, sim.alias as alias_sim');


        if($_POST['number']){
            $this->db->like('number',$_POST['number']);
        }
        if($_POST['network']){
            $this->db->where('network',$_POST['network']);
        }
        if($_POST['type']){
            $this->db->where('type',$_POST['type']);
        }
        if($_POST['price_min']>0){
            $this->db->where('price >=',$_POST['price_min']);
        }
        if($_POST['price_max']>0){
            $this->db->where('price <=',$_POST['price_max']);
        }

        $this->db->join('sim_type','sim.type=sim_type.alias','left');

        $this->db->order_by('sim.id','desc');
        $q=$this->db->get('sim');
//        print_r($this->db->last_query());
        return $q->result();
    }*/
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
    public function TourNuocNgoai(){
        $this->db->select('news.id as news_id, news.title,news.category_id,news.home,news.hot,news.focus,news.image,news.description, news_category.id as cate_id,
         news_category.name as cate_name,news_category.alias as cate_alias,news.alias as news_alias');

        $this->db->where('news_category.tour',1);

        $this->db->join('news_category','news.category_id=news_category.id','left');
        $this->db->where('news.home',1);
        $this->db->order_by('news.id','desc');
        $this->db->limit(10,0);
        $q=$this->db->get('news');
        return $q->result();
    }




}