<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('contact_model');

    }
    //index
    public function index(){
        if(isset($_POST['sendcontact'])){

            $arr=array('full_name' => $this->input->post('full_name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'country' => $this->input->post('country'),
                'comment' => $this->input->post('comment'),
                'time' => time(),
            );
            $id=$this->contact_model->Add('contact',$arr);

            if($id){
                $_SESSION['message']="Bạn đã gửi thông tin thành công!!!";
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
        $view = 'content_right';
        $site_name='Liên Hệ';
        $site_keyword='Liên Hệ';
        $site_description='';
        $data['home_support']=$this->f_homemodel->Home_support('contact');

        $this->LoadHeader($site_name,$site_keyword,$site_description);
        $this->LoadMenuTop();
        $this->load->view('contact',$data);
        $this->LoadRight($view);
        $this->LoadFooter();
    }

}