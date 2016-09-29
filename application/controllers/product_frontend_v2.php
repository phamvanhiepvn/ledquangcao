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

    public function pro_bycategory($alias,$tinh='toan-quoc'){

        $config['base_url'] = base_url('deal-'.$tinh.'/'.$alias);
        $config['total_rows'] = $this->f_productmodel->CountProByCategory($alias,$tinh); // xác định tổng số record
        $config['per_page'] = 12; // xác định số record ở mỗi trang
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
        $data = array();
        $data['cate_curent']=$this->f_productmodel->getItemByAlias('product_category',$alias);
        $data['cate_sub']=$this->f_productmodel->Get_where('product_category',array('parent_id'=>$data['cate_curent']->id));
        $data['cate_curent']=$this->f_productmodel->getItemByAlias('product_category',$alias);
        $data['cate_sub']=$this->f_productmodel->Get_where('product_category',array('parent_id'=>$data['cate_curent']->id));

        $data['list_cates'] = $this->f_productmodel->Get_where('product_category',array(
            'home' => '1'
        ));
        $data['pro_focus'] = $this->f_productmodel->getProFocusByCate($data['cate_curent']->id);
        //echo "<pre>";var_dump($data['pro_focus']);die();
        $data['lists'] = $this->f_productmodel->ProductBycategory($alias,$config['per_page'], $this->uri->segment(3));
//        /echo "<pre>";var_dump($data['list']);die();
        $data['partner']=$this->f_productmodel->getSlider_partners();



//        print_r($data['cate_curent']);

        $title=@$data['cate_curent']->name;
        $keyword=@$data['cate_curent']->description;
        $description=@$data['cate_curent']->description;


        $this->LoadHeader($title,$keyword,$description);

        $this->load->view('pro_bycate_mobi',$data);

        $this->LoadMenuTop();
        $this->load->view('pro_bycategory',$data);
        $this->LoadRight();
        $this->LoadFooter();
    }


// Location
    public function pro_location($alias){

        $config['base_url'] = base_url('danh-muc-san-pham-tinh-thanh/'.$alias);
        $config['total_rows'] = $this->f_productmodel->CountProByLocation($alias); // xác định tổng số record
        $config['per_page'] = 12; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data = array();

        $data['list'] = $this->f_productmodel->ProductByLocation($alias,$config['per_page'], $this->uri->segment(3));

        $data['cate_curent']=$this->f_productmodel->getItemByAlias('tinhthanh',$alias);
        $data['cate_sub']=$this->f_productmodel->Get_where('tinhthanh',array('parent_id'=>$data['cate_curent']->region_id));



        $title=@$data['cate_curent']->name;
        $keyword=@$data['cate_curent']->description;
        $description=@$data['cate_curent']->description;


        $this->LoadHeader($title,$keyword,$description);
        $this->load->view('pro_location',$data);
        $this->LoadFooter();
    }


    //News detail
    public function productdetail($alias){
        $data['pro_first']=$this->f_productmodel->getItemByAlias('product',$alias);
        //$data['cate']=$this->f_productmodel->getFirstRowWhere('product_category',array('id'=>$data['pro_first']->category_id));
        //@$data['cate_sub']=$this->f_productmodel->Get_where('product_category',array('parent_id'=>$data['cate']->id));
        $data['cate_all']=$this->f_productmodel->getList('product_category');
        $data['products_cate_home']=$this->f_productmodel->Products_cate_home('home');
        //$data['product_img']=$this->f_productmodel->getProductImages($alias);
        $data['pimages'] = $this->f_productmodel->Get_where('images',array(
            'id_item' => $data['pro_first']->id
        ));
        //echo "<pre>";var_dump($data['pimages']);die();
        $data['num_img']=sizeof($data['pimages']);

        $data['product_similar']=$this->f_productmodel->getProductSimilar($data['pro_first']->id,18,0);

//        $data['product_similar2']=$this->f_productmodel->getarr_idcategory($data['pro_first']->id);

        $data['category']=$this->f_productmodel->getList('product_category');
        $data['link_share']=base_url('san-pham/'.$data['pro_first']->alias);
//        print_r($data['product_similar']);
        $data['comments']=$this->f_productmodel->getComments($data['pro_first']->id,10);
        if($this->session->userdata('userid')){
            $u=$this->f_homemodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));

            $liked_id=(array)json_decode(@$u->liked);

            if(!empty($liked_id))
                $data['liked']=$this->f_homemodel->getLikedPro($liked_id);

            if(in_array($data['pro_first']->id,$liked_id)){
                $data['class']='liked';
            }
        }
        $face=array(
            'title'=>@$data['pro_first']->name,
            'type'=>'product',
            'image'=>base_url(@$data['pro_first']->image),
            'url'=>base_url('san-pham/'.$data['pro_first']->alias),
            'description'=>@$data['pro_first']->description_seo,
        );
        $data['memmer'] = $this->f_homemodel->listAll('support_online',6,0);
        //echo "<pre>";var_dump($data['memmer']);die();
        $title=@$data['pro_first']->name;
        $keyword=@$data['pro_first']->keyword;
        $description=@$data['pro_first']->description_seo;
        $this->LoadHeader($title,$keyword,$description,$face);
        $this->LoadMenuTop();
        $this->load->view('productdetail',$data);
        $this->LoadRight();
        $this->LoadFooter();
    }
    public function search_demo(){
        if($this->input->get('name')&&$this->input->get('name')!=''){
            $where=array('name'=>$this->input->get('name',true));
        }else $where=null;
        $config['page_query_string'] = TRUE;
        $config['enable_query_strings'] = TRUE;
        $config['base_url'] = base_url('product_frontend/search_demo/?name='.$this->input->get('name'));
        $config['total_rows'] = $this->f_productmodel->Count2('product',$where);
        $config['per_page'] = 1;
//        $config['suffix'] = "?page=".($this->input->get('per_page')/$config['per_page']+2);
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['list'] = $this->f_productmodel->GetData2('product',$where,null,$config['per_page'], $this->input->get('per_page'));

        print_r($data['list']);
        echo '<br>' ;
        echo $this->pagination->create_links();
    }
    /// search ////
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
    public function un_like(){
        if(isset($_POST['id'])){
            $id=$this->input->post('id');
            $user=$this->f_productmodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
            if($user->liked !=null){
                $liked=(array)json_decode($user->liked);
            }else $liked=array();
            $rs['status']=false;
            $new=array();
            foreach($liked as  $val){
                if($id!=$val){
//                    unset($liked[$key]);
                    $new[]=$val;
                    $rs['status']=true;
                }
            }
//            $liked=(array)$liked;
//            echo json_encode((array)$liked); die();
            $this->f_productmodel->Update_Where('users',array('id'=>$this->session->userdata('userid')),
                                                array('liked'=>json_encode($new)));
            echo json_encode($rs);
        }
    }
    public function liked_product(){
        $data=array();
        if($this->session->userdata('userid')){
            $u=$this->f_productmodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
            $liked_id=(array)json_decode($u->liked);

            if(!empty($liked_id))
                $data['liked']=$this->f_productmodel->getLikedPro($liked_id);
        }
        $this->load->view('liked_product', $data);
    }
    public function send_comment(){
        if($this->input->post('id_pro')){
            if($this->input->post('comment')!=null){
                $rs= $this->f_productmodel->Add('comments',array('item_id'=>$this->input->post('id_pro'),
                                                                 'comment'=>$this->input->post('comment'),
                                                                 'reply'=>$this->input->post('id_reply'),
                                                                 'user'=>$this->session->userdata('userid'),
                                                                 'time'=>time(),
                ));
            }

        }
        echo 1;
    }
    public function productcoments($product_id,$limit=10){
        $data['comments']=$this->f_productmodel->getComments($product_id,$limit);
        $data['comments_sub']=$this->f_productmodel->getComments_desc($product_id);
        $data['product_id']=$product_id;
        $this->load->view('productcoments', $data);
    }

}