<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_comment extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
        $this->load->database();
    }
    public function listAllComment($limit,$offset)
    {
        $this->db->select('comments.*,users.fullname as user_name,product.name as pro_name, product.alias');
        $this->db->join('product','product.id=comments.item_id','left');
        $this->db->join('users','users.id=comments.user','left');
        $this->db->limit($limit,$offset);
        $this->db->order_by('id','desc');
        $q = $this->db->get('comments');
        return $q->result();
    }
    public function countComment()
    {
        $this->db->select('comments.*,users.fullname as user_name,product.name as pro_name');
        $this->db->join('product','product.id=comments.item_id','left');
        $this->db->join('users','users.id=comments.user','left');
        $q = $this->db->get('comments');
        return $q->num_rows();
    }
}