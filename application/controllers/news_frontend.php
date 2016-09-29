<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News_frontend extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('f_newsmodel');
        $this->load->library('pagination');
        $this->load->helper('model_helper');
    }
    //News list
    public function news_content($alias){

        $data['news']=$this->f_homemodel->getItemByAlias('news',$alias);
        $data['last_news']=$this->f_newsmodel->getSimilar($alias,6,0);
        $data['cate']=$this->f_newsmodel->getFirstRowWhere('news_category',array('id'=>$data['news']->category_id));
        $data['banner_right'] = $this->f_newsmodel->Get_where('images',array('type'=>'ads_right'));
        $data['cate_all'] = $this->f_newsmodel->getList('news_category');

        $title='Dự án | '.$data['news']->title;
        $data['latestProject'] =  $this->f_newsmodel->getNewsByCategory("du-an",12,0);
        $keyword=$data['news']->keyword;
        $description=$data['news']->description;

        $this->LoadHeader($title,$keyword,$description);

        $this->load->view('news_content',$data);

        $this->LoadFooter();
    }
    //News list
    public function newslist(){

    }
    //Hot News
    public function hotnew(){

    }
    //News by category
    public function post($page=null){

        $alias = "bai-viet";


        $config['base_url'] = base_url('tin-tuc/'.$alias);
        $config['total_rows'] = $this->f_newsmodel->countNewsByCategory($alias); // xác định tổng số record
        $config['per_page'] = 9; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        $this->pagination->initialize($config);
        $data = array();
        $data['news_bycate'] = $this->f_newsmodel->getNewsByCategory($alias,$config['per_page'], $this->uri->segment(3));

        $cate_curent=$this->f_newsmodel->getItemByAlias('news_category',$alias);

        $data['cate_curent'] =  $cate_curent;


        $data['cate'] = $this->f_newsmodel->getList('news_category');
        $title=@$cate_curent->name;
        $keyword=$title;
        $description=@$cate_curent->description;


        $this->LoadHeader(@$title,@$keyword,@$description);

        $this->load->view('post',@$data);


        $this->LoadFooter();

    }
    public function news_bycategory($cateChild){
        $data = array();

        if($cateChild=="$1"){
            $alias = 'du-an';
            $data['cate_filter'] = $this->f_newsmodel->getChildCateByAlias($alias);
            $data['hiddenFilter'] = true;
        }else{
            $alias = $cateChild;
            $data['cate_filter'] = array();
            $data['hiddenFilter'] = false;

        }

        $config['base_url'] = base_url('tin-tuc/'.$alias);
        $config['total_rows'] = $this->f_newsmodel->countNewsByCategory($alias);
        // xác định tổng số record
        $config['per_page'] = 100; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        $this->pagination->initialize($config);

        $data['news_bycate'] = $this->f_newsmodel->getNewsByCategory($alias,$config['per_page'], $this->uri->segment(3));
        $cate_curent=$this->f_newsmodel->getItemByAlias('news_category',$alias);

        $data['cate_curent'] =  $cate_curent;

        $data['cate'] = $this->f_newsmodel->getList('news_category');
        $title=@$cate_curent->name;
        $data['name_cate'] =$title;
        $keyword=$title;
        $description=@$cate_curent->description;
        $this->LoadHeader(@$title,@$keyword,@$description);

        $this->load->view('news_bycategory',@$data);


        $this->LoadFooter();
    }
    //News all
    public function news_all(){

        $config['base_url'] = base_url('tin-tuc');
        $config['total_rows'] = $this->f_newsmodel->CountNews(); // xác định tổng số record
        $config['per_page'] = 20; // xác định số record ở mỗi trang
        $config['uri_segment'] = 2; // xác định segment chứa page number

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        $this->pagination->initialize($config);

        $data = array();
        $data['news_bycate'] = $this->f_newsmodel->getNews($config['per_page'], $this->uri->segment(3));

//        $data['last_news']=$this->f_newsmodel->LastNews();
        $data['cate_curent'] =  (object)array('id'=>0);

        $data['banner_right'] = $this->f_newsmodel->Get_where('images',array('type'=>'ads_right'));

        $data['cate'] = $this->f_newsmodel->getList('news_category');
        $title='Tin tức';
        $keyword='Thiết kế website, phần mềm bán hàng, phần mềm quản lý văn bản';
        $description='Tin tức';
        $view = 'new_right';

        $this->LoadHeader(@$title,@$keyword,@$description);
        //$this->LoadHeaderMobi();
        $this->LoadMenuTop();

        $this->load->view('new_bycate_mobi',$data);

        $this->load->view('news_bycategory',@$data);
        $this->LoadRight($view);
        //$this->LoadFooterMobi();
        $this->LoadFooter();
    }
    //News by category
    public function newssimilar(){

    }
    //News Content
    public function newscontent(){

    }

}