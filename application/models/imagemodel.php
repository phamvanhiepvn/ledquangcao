<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Imagemodel extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('model');
        $this->load->database();
    }
    public function getBannerList(){
        $this->db->where('type !=','');
        $this->db->order_by('id','desc');
        $q=$this->db->get('images');
        return $q->result();
    }
}