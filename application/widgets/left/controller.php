<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Left_widget extends MY_Widget
{
    // Nhận 2 biến truyền vào
    function index(){
        $this->load->helper('url');
        $this->load->model('f_homemodel');
        $data = array();
        $data['cates'] = $this->f_homemodel->getCateHome();
        $data['supports']=$this->f_homemodel->GetData('support_online',null,array('id','random'),18);
        $data['new_cats'] = $this->f_homemodel->getFirstRowWhere('news_category',array(
            'focus' => 1
        ));
        $data['news'] = $this->f_homemodel->GetData('news',array(
            'focus' => 1,
            'category_id' => @$data['new_cats']->id
        ),array('id','desc'),5,null);
        $data['cate_yk'] = $this->f_homemodel->getFirstRowWhere('news_category',array(
            'home' => 1
        ));
        $data['listyks'] = $this->f_homemodel->getField_array('news',array(
            'title','description','keyword','content','image'
        ),array('category_id' => $data['cate_yk']->id));
        //echo "<pre>";var_dump($data['news']);die();
        // truyền qua view
        $this->load->view('view',$data);
    }
}