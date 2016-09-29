<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class StaticPage_frontend extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->helper('url');
            $this->load->model('f_pagesmodel');
            $this->load->library('pagination');
        }

        public function pagecontent($alias){
            $data['page']=$this->f_pagesmodel->getPage($alias);

            $data['menu_right'] = $this->f_pagesmodel->getMenuRightRoot();
            $title=@$data['page']->name;
            $keyword=@$data['page']->keyword;
            $description=@$data['page']->description;

            $view = 'static_right';
            $this->LoadHeader($title,$keyword,$description);
            $this->LoadMenuTop();

            $this->load->view('pagecontent',$data);
            $this->LoadRight($view);
            $this->LoadFooter();
        }
        public function listCustomer()
        {
            $config['base_url'] = base_url('danh-sach-khach-hang');
            $config['total_rows'] = $this->f_pagesmodel->Count('customer'); // xác định tổng số record
            //echo "<pre>";var_dump($config['total_rows']);die();
            $config['per_page'] = 40; // xác định số record ở mỗi trang
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
            $data['title'] = 'Danh sách khách hàng';
            $data['keyword'] = 'Danh sách khách hàng';
            $data['description'] = 'Danh sách khách hàng';
            $data['lists'] = $this->f_pagesmodel->GetData('customer',null,array('id','desc'),$config['per_page'],
                $this->uri->segment(2));
            //echo "<pre>";var_dump($data['lists']);die();
            $this->load->view('view_list_customer',$data);
        }
    }