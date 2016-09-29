<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
        $this->load->database();
    }
    public function getList($table){
        $this->db->select('*');
        $q=$this->db->get($table);
        return $q->result();
    }
    public function newsListAll($limit,$offset){
        $this->db->select('news.*, news_category.id as cate_id, news_category.name as cate_name ');
        $this->db->join('news_category','news.category_id=news_category.id','left');
        $this->db->limit($limit,$offset);
        $this->db->order_by('news.id','desc');
        $q=$this->db->get('news');
        return $q->result();
    }

    public function newsBycategory($alias,$limit,$offset){
        $this->db->select('news.id as news_id, news.title, news.alias,news.category_id,news.home,news.hot,news.focus,news.image, news_category.id as cate_id,
         news_category.name as cate_name,news_category.alias as cate_alias');
        $this->db->join('news_category','news.category_id=news_category.id','left');
        $this->db->where('news_category.alias',$alias);

        $this->db->limit($limit,$offset);

        $q=$this->db->get('news');
        return $q->result();
    }
    /*count  news by category*/
    public function countNewsByCategory($alias){
        $this->db->select('news.id as news_id, news.category_id,news.home,news.hot,news.focus,news.image, news_category.id as cate_id,
         news_category.name as cate_name,news_category.alias as cate_alias');
        $this->db->join('news_category','news.category_id=news_category.id','left');
        $this->db->where('news_category.alias',$alias);;
        $q=$this->db->get('news');
        return $q->num_rows();
    }
    public function getNewsByID($id){
        $this->db->where('id',$id);
        $q=$this->db->get('news');
        return $q->first_row();
    }

    public function getListRoot(){
        $this->db->select('*');
        $this->db->where('parent_id =',0);
        $q=$this->db->get('news_category');
        return $q->result();
    }
    public function getListChil(){
        $this->db->select('*');
        $this->db->where('parent_id !=',0);
        $q=$this->db->get('news_category');
        return $q->result();
    }
    public function getImageByNewsId($newsId){
        $this->db->select('*');
        $this->db->where('id_news',$newsId);
        $q=$this->db->get('images_news');
        return $q->result();
    }
}
