<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ordermodel extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
    }
    public function Getlist_oder($limit,$offset){
        $this->db->select('*');
        $this->db->limit($limit,$offset);
        $this->db->order_by('id','desc');
        $q=$this->db->get('order');
        return $q->result();
    }
    public function order_detail(){
        $this->db->select('product.id as product_id,product.name,order_item.*');
        $this->db->join('product','product.id=order_item.item_id');
        $this->db->order_by('product.id','desc');
        $q=$this->db->get('order_item');
        return $q->result();
    }


}
