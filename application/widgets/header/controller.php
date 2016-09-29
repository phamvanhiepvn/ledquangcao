<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Header_widget extends MY_Widget
{
    // Nhận 2 biến truyền vào
    function index($title, $content){
        $this->load->model('f_productmodel');
        $cate_root = $this->f_productmodel->getCateRoot();
        //echo "<pre>";var_dump($cate_root);die();
        // truyền qua view
        $this->load->view('view', array(
            'title' => $title,
            'content' => $content
        ));
    }
}