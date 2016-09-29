<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('staticpagemodel');
        $this->load->model('f_homemodel');
        $this->load->model('f_newsmodel');
        $this->load->library('pagination');
        $this->load->model('contact_model');
        $this->load->library('parser');
        $this->load->model('f_productmodel');
    }
    //index
    public function index(){

        $this->home();

    }
    public function add_contact(){
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


     }redirect($_SERVER['HTTP_REFERER']);

 }
    //Home

    public function capcha(){

        $this->load->library('recaptcha');

        //Store the captcha HTML for correct MVC pattern use.
        $data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();
//        die($data['recaptcha_html']);
            $this->load->view('capcha');
    }
    public function home(){
        $this->load->library('user_agent');
        $data = array();
        $title=@$this->site_name;
        $keyword=@$this->site_keyword;
        $description=@$this->site_description;
        $data['cate_home']=$this->f_homemodel->homeview_category();
        $data['product'] = $this->f_homemodel->New_Product();
        $this->LoadHeader($title,$keyword,$description);
        $this->load->view('home',$data);
        $this->LoadFooter();
    }

    public function about(){
        $this->load->library('user_agent');
        $data = array();

        $title=@$this->site_name;
        $keyword=@$this->site_keyword;
        $description=@$this->site_description;
        $data['latestProject'] = $this->f_newsmodel->getNewsByCategory("du-an",12,0);

        $data['about'] = $this->staticpagemodel->get_data("pageabout");
        $data['skill'] = $this->staticpagemodel->Get_where('skill',array(
            'type'=>0
        ));
        $this->LoadHeader($title,$keyword,$description);

        $this->load->view('about',$data);

        $this->LoadFooter();
    }
    public function service(){
        $this->load->library('user_agent');
        $data = array();

        $title=@$this->site_name;
        $keyword=@$this->site_keyword;
        $description=@$this->site_description;

        $data['service'] = $this->staticpagemodel->get_data("pageservice");
        $data['latestProject'] =  $this->f_newsmodel->getNewsByCategory("du-an",12,0);


        $this->LoadHeader($title,$keyword,$description);

        $this->load->view('service',$data);

        $this->LoadFooter();
    }
    public function addAnEmail(){
        $arr=array('full_name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'comment' => $this->input->post('comments'),
            'time' => time(),
        );
        $id=$this->contact_model->Add('contact',$arr);

        if($id){
            $_SESSION['message']="Bạn đã đăng ký thành công!!!";
        }
    }

}