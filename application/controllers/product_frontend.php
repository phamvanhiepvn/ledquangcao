<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_frontend extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('f_productmodel');
        $this->load->library('pagination');
    }
    public function index($alias){
            $this->pro_bycategory($alias);
    }

    public function pro_bycategory($alias){

        $this->load->library('user_agent');
        $config['base_url'] = base_url('danh-muc/'.$alias.'/page');
        $config['total_rows'] = $this->f_productmodel->CountProByCategory($alias); // xác định tổng số record
        $config['per_page'] = 20; // xác định số record ở mỗi trang
        $config['uri_segment'] = 4; // xác định segment chứa page number
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
        $data['cate_curent']=$this->f_productmodel->getItemByAlias('product_category',$alias);
        $data['cate_sub']=$this->f_productmodel->Get_where('product_category',array('parent_id'=>$data['cate_curent']->id));
        $data['cate_curent']=$this->f_productmodel->getItemByAlias('product_category',$alias);
        $data['cate_sub']=$this->f_productmodel->Get_where('product_category',array('parent_id'=>$data['cate_curent']->id));

        /*$data['list_cates'] = $this->f_productmodel->Get_where('product_category',array('home' => '1'));*/
        $data['list_cates'] = $this->f_productmodel->listAll('product_category');
        $data['pro_focus'] = $this->f_productmodel->getProFocusByCate($data['cate_curent']->id);
        //echo "<pre>";var_dump($data['pro_focus']);die();
        $data['lists'] = $this->f_productmodel->ProductBycategory($alias,$config['per_page'], $this->uri->segment(4));
//        /echo "<pre>";var_dump($data['list']);die();

        $title = isset($data['cate_curent']->title_seo) ? $data['cate_curent']->title_seo : $data['cate_curent']->name;
        $keyword = isset($data['cate_curent']->keyword) ? $data['cate_curent']->keyword : $data['cate_curent']->description;
        $description = isset($data['cate_curent']->description_seo) ? $data['cate_curent']->description_seo : $data['cate_curent']->description;

        $this->LoadHeader($title,$keyword,$description);

        $this->load->view('pro_bycategory',$data);
        //$this->LoadRight();
        $this->LoadFooter();
    }
    //News detail
    public function productdetail($alias){
        $this->load->library('user_agent');
        $data['pro_first']=$this->f_productmodel->getItemByAlias('product',$alias);
        $title = @$data['pro_first']->title_seo==null?@$data['pro_first']->name : @$data['pro_first']->title_seo;
        $keyword=@$data['pro_first']->keyword;
        $description=@$data['pro_first']->description_seo;
        $this->LoadHeader($title,$keyword,$description);
        $this->load->view('product_detail',$data);
        $this->LoadFooter();
    }
    public function Search_pro($ma_hang = 'null')
    {
        $config['base_url']    = base_url('tim-kiem/' . $ma_hang );
        $config['total_rows']  = $this->f_productmodel->Count_search_rs($ma_hang); // xác d?nh t?ng s? record
        $config['per_page']    = 20 ; // xác d?nh s? record ? m?i trang
        $config['uri_segment'] = 3; // xác d?nh segment ch?a page number
        $this->pagination->initialize($config);
        $data = array();
        $data['list'] = $this->f_productmodel->Search_rs($ma_hang, $config['per_page'], $this->input->get('per_page'));
        $data['tenhang'] = $this->uri->segment(3);
        $title=$this->site_name;
        $keyword=$this->site_keyword;
        $description=@$this->site_description;
        $this->LoadHeader($title,$keyword,$description);
        $this->load->view('Search_pro', $data);
        $this->LoadFooter();
    }
    public function like(){
        if(isset($_POST['id'])){
            $id=$this->input->post('id');
            $user=$this->f_productmodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
            if($user->liked !=null){
                $liked=(array)json_decode($user->liked);
            }else  $liked=array();
            $rs['status']=false;
            if(!in_array($id,$liked)){
                $liked[]=$id;
                $rs['status']=true;
            }
            $this->f_productmodel->Update_Where('users',array('id'=>$this->session->userdata('userid')),
                                                array('liked'=>json_encode($liked)));
            echo json_encode($rs);
        }
    }

    public function getProByAlias($alias = null)
    {
        if($alias == 'focus')
        {
            $temp = 'Sản phẩm nổi bật';
        }
        $data = array();
        $data['cate'] = @$temp;
        $config['base_url'] = base_url('deal/'.$alias);
        $config['total_rows'] = $this->f_productmodel->countProByType($alias); // xác định tổng số record
        $config['per_page'] = 20; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
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
        $data['lists'] = $this->f_productmodel->getProByType($alias,$config['per_page'], $this->uri->segment(3));
        $data['list_cates'] = $this->f_productmodel->Get_where('product_category',array(
            'home' => '1'
        ));
        $title=@$temp;
        $keyword=@$temp;
        $description=@$temp;
        $this->LoadHeader($title,$keyword,$description);
        $this->LoadMenuTop();
        $this->load->view('product_byalias',$data);
        $this->LoadRight();
        $this->LoadFooter();
    }
}