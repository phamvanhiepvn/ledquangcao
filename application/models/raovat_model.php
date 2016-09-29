<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Raovat_model extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
    }

    public function User_post($limit,$offset){
        $this->db->select('user_post.*,users.fullname');
        $this->db->join('users','users.id=user_post.userid','left');
        $this->db->limit($limit,$offset);
        $this->db->order_by('user_post.id','desc');
        $q=$this->db->get('user_post');
        return $q->result();
    }

    public function getDetail($alias){
        $this->db->select('user_post.*,users.fullname,province.name');
        $this->db->join('users','users.id=user_post.userid','left');
        $this->db->join('province','province.provinceid=user_post.tinh_thanh','left');
        $this->db->where('user_post.alias',$alias);
        $q=$this->db->get('user_post');
        return $q->first_row();
    }

    public function count_user_post(){
        $this->db->select('id');
        $this->db->where('userid',$this->session->userdata('userid'));
        $q=$this->db->get('user_post');
        return $q->num_rows();
    }






    public function getpost_image($arr){
        if(is_array($arr)&&!empty($arr)){
            $this->db->where_in('id_item',$arr);
            $q=$this->db->get('user_post_images');
            return $q->result();
        }else return array();

    }

    public function changeStatusUser($id, $status)
    {
        if (isset($id) && $id > 0 && is_numeric($id)   && isset($status) && is_numeric($status)) {
            if ($status == 1)
                $array = array('block' => 0);
            else {
                $array = array('block' => 1);
            }
            $this->db->where('id', $id);
            if ($this->db->update('users', $array)) {
                return true;
            };

        }
        return FALSE;
    }

    public function getNewsByID($id){
        $this->db->where('id',$id);
        $q=$this->db->get('user_post');
        return $q->first_row();
    }

    ///lay thu vien anh
    public function getProImage($id){
        $this->db->select('user_post.*,user_post_images.*');
        $this->db->join('user_post_images','user_post.id=user_post_images.id_item','left');
        $this->db->where('user_post.id',$id);
        $q=$this->db->get('user_post');
        return $q->result();
    }
    public function getuser_post($tinh,$limit=0,$offset=0){

        if($tinh!='toan-quoc'){
            $q1 = $this->db->query("SELECT provinceid,alias,name FROM province where alias = '" . $tinh . "'")->first_row();
        }

        $this->db->select('user_post.*,users.fullname,users.avatar,province.name as province_name');
        $this->db->join('users','users.id=user_post.userid','left');
        $this->db->join('province','user_post.tinh_thanh=province.provinceid','left');
        if($tinh!='toan-quoc'){
            $this->db->where_in('user_post.tinh_thanh',array(@$q1->provinceid,'00'));
        }
        $this->db->where('user_post.view',1);
        $this->db->order_by('user_post.time','desc');
        $this->db->limit($limit,$offset);
        $q=$this->db->get('user_post');
        return $q->result();
    }
    public function countuser_post($tinh){
        if($tinh!='toan-quoc'){
            $q1 = $this->db->query("SELECT provinceid,alias,name FROM province where alias = '" . $tinh . "'")->first_row();
        }
        $this->db->select('user_post.id');
        if($tinh!='toan-quoc'){
            $this->db->where_in('user_post.tinh_thanh',array(@$q1->provinceid,'00'));
        }
        $this->db->where('user_post.view',1);
        $this->db->order_by('user_post.time');
        $q=$this->db->get('user_post');
        return $q->num_rows();
    }


    public function getuser_post_bycate($alias,$tinh,$limit=0,$offset=0){

        if($tinh!='toan-quoc'){
            $q1 = $this->db->query("SELECT provinceid,alias,name FROM province where alias = '" . $tinh . "'")->first_row();
        }
        @$cate=$this->getFirstRowWhere('post_cate',array('alias'=>$alias));

        $this->db->select('user_post.*,users.fullname,
        users.avatar,province.name as province_name ,
        post_cate.name');
        $this->db->join('users','users.id=user_post.userid','left');
        $this->db->join('province','user_post.tinh_thanh=province.provinceid','left');
        $this->db->join('post_cate','user_post.loai_giaodich=post_cate.id','left');

        if($tinh!='toan-quoc'){
            $this->db->where_in('user_post.tinh_thanh',array(@$q1->provinceid,'00'));
        }

        $this->db->where('user_post.view',1);
        $this->db->where('user_post.loai_giaodich',@$cate->id);
        $this->db->order_by('user_post.time');
        $this->db->limit($limit,$offset);
        $q=$this->db->get('user_post');
        return $q->result();
    }
    public function countuser_post_bycate($alias,$tinh){
        if($tinh!='toan-quoc'){
            $q1 = $this->db->query("SELECT provinceid,alias,name FROM province where alias = '" . $tinh . "'")->first_row();
        }
        @$cate=$this->getFirstRowWhere('post_cate',array('alias'=>$alias));

        $this->db->select('user_post.*,users.fullname,
        users.avatar,province.name as province_name ,
        post_cate.name');
        $this->db->join('users','users.id=user_post.userid','left');
        $this->db->join('province','user_post.tinh_thanh=province.provinceid','left');
        $this->db->join('post_cate','user_post.loai_giaodich=post_cate.id','left');

        if($tinh!='toan-quoc'){
            $this->db->where_in('user_post.tinh_thanh',array(@$q1->provinceid,'00'));
        }

        $this->db->where('user_post.view',1);
        $this->db->where('user_post.loai_giaodich',@$cate->id);
        $this->db->order_by('user_post.time');
        $q=$this->db->get('user_post');
        return $q->num_rows();
    }


    public function getuser_post_bycate_manager($alias,$limit=0,$offset=0){
        $this->db->select('user_post.*,users.fullname,province.name,product_category.name');
        $this->db->join('users','users.id=user_post.userid','left');
        $this->db->join('province','user_post.tinh_thanh=province.provinceid','left');
        $this->db->join('product_category','user_post.loai_giaodich=product_category.id','left');
        $this->db->where('product_category.alias',$alias);
        $this->db->where('userid',$this->session->userdata('userid'));
        $this->db->order_by('user_post.id','desc');
        $this->db->limit($limit,$offset);
        $q=$this->db->get('user_post');
        return $q->result();
    }
    public function countuser_post_bycate_manager($alias){
        $this->db->select('user_post.*,users.fullname,province.name,product_category.name');
        $this->db->join('users','users.id=user_post.userid','left');
        $this->db->join('province','user_post.tinh_thanh=province.provinceid','left');
        $this->db->join('product_category','user_post.loai_giaodich=product_category.id','left');
        $this->db->where('user_post.view',1);
        $this->db->where('product_category.alias',$alias);
        $this->db->where('userid',$this->session->userdata('userid'));
        $this->db->order_by('user_post.time');
        $q=$this->db->get('user_post');
        return $q->num_rows();
    }
    /*menu right*/
    public function getMenuRightRoot(){
        $this->db->select('*');
        $this->db->where('position','right');
        $this->db->where('parent_id',0);
        $q=$this->db->get('menu');
        return $q->result();
    }
}
