<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class F_newsmodel extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
    }
    public function getNewsByCategory($alias,$limit,$offset){
        $q1=$this->db->query("SELECT id,alias FROM news_category where alias = '".$alias."'");
        $query = $this->db->select('news.id as news_id,news.time as time,news.tag as tag, news.title, news.description,news.alias as news_alias,news.category_id,news.image,
                            news_category.id as cate_id, news_category.name, news_category.alias as cate_alias, news_category.parent_id')
            ->from('news')
            ->join('news_category', 'news_category.id = news.category_id')
            ->where('news_category.alias',$alias)
            ->or_where('news_category.parent_id',$q1->first_row()->id)
            ->order_by('news.id','desc')
            ->get('', $limit, $offset);

        return $query->result();
    }
    public function getNews($limit,$offset){
        $query = $this->db->select('news.id as news_id, news.title, news.description,news.alias as news_alias,news.category_id,news.image,
                            news_category.id as cate_id, news_category.name, news_category.alias as cate_alias, news_category.parent_id')
            ->from('news')
            ->join('news_category', 'news_category.id = news.category_id')
            ->order_by('news.id','desc')
            ->get('', $limit, $offset);

        return $query->result();
    }
    public function CountNews(){
        $query = $this->db->select('news.id as news_id, news.title, news.description,news.alias as news_alias,news.category_id,news.image,
                            news_category.id as cate_id, news_category.name, news_category.alias as cate_alias, news_category.parent_id')
            ->from('news')
            ->join('news_category', 'news_category.id = news.category_id')
            ->order_by('news.id','desc')
            ->get('');

        return $query->num_rows();
    }
    public function getMenuRightRoot(){
        $this->db->select('*');
        $this->db->where('position','right');
        $this->db->where('parent_id',0);
        $q=$this->db->get('menu');
        return $q->result();
    }


    public function getSimilar($alias,$limit,$offset){
        $q1=$this->db->query("SELECT id,alias,category_id FROM news where alias='".$alias."'");

        $query = $this->db->select('news.id as news_id, news.title, news.description,news.alias ,news.category_id,news.image,
                            news_category.id as cate_id, news_category.name,  news_category.parent_id')
            ->from('news')
            ->join('news_category', 'news_category.id = news.category_id')
            ->where('news_category.id',$q1->first_row()->category_id)
            ->where('news.alias !=',$alias)
            ->get('', $limit, $offset);

        return $query->result();
    }
   /* public function getNewSimilar($item)
    {
        $this->db->select();
        $this->db->where('category');
    }*/
    public function News_view_detail($view,$limit,$offset){
        $this->db->select('news.*');
        $this->db->where('news.'.$view,1);
        $this->db->order_by('news.id','desc');
        $this->db->limit($limit,$offset);
        $q=$this->db->get('news');
        return $q->result();
    }

    /*count  news by category*/
    public function countNewsByCategory($alias){
        $q1=$this->db->query("SELECT id,alias FROM news_category where alias = '".$alias."'");

        $query = $this->db->select('news.id as news_id, news.title, news.description,news.alias as news_alias,news.category_id,news.image,
                            news_category.id as cate_id, news_category.name, news_category.alias as cate_alias, news_category.parent_id')
            ->from('news')
            ->join('news_category', 'news_category.id = news.category_id')
            ->where('news_category.alias',$alias)
            ->or_where('news_category.parent_id',$q1->first_row()->id)
            ->order_by('news.id','desc')
            ->get('');
        return $query->num_rows();
    }


    public function News_stand_out_focus(){
        $this->db->select('news.*');
        $this->db->where('news.focus',1);
        $this->db->order_by('news.id','desc');
        $this->db->limit(7,0);
        $q=$this->db->get('news');
        return $q->result();
    }
    public function getNewsDetail($category,$alias){
        $this->db->select('news.id as news_id, news.title, news.description,news.image,news.alias as news_alias,news.category_id,news.content,
                            news_category.id as cate_id, news_category.name, news_category.alias as cate_alias');
        $this->db->join('news_category','news.category_id=news_category.id','left');

        $this->db->where('news_category.alias',$category);
        $this->db->where('news.alias',$alias);
        $q=$this->db->get('news');
        return $q->first_row();
    }

    public function getChildCateByAlias($alias){
        $id = $this->db->select('id')->where('alias',$alias)->get('news_category')->first_row();
        $this->db->select('*');
        $this->db->where('news_category.parent_id',$id->id);
        $q=$this->db->get('news_category');
        return $q->result();
    }

    public function Home_support(){
        $this->db->select('*');
        $this->db->limit(3,0);
        $n=$this->db->get('support_online');
        return $n->result();
    }

}