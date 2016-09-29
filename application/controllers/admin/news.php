<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class News extends MY_Controller
    {
        protected $module_name = "News";

        function __construct()
        {
            parent::__construct();
            $this->load->helper('url');
            $this->load->model('news_model');
            $this->load->library('pagination');
            $this->auth = new Auth();
            $this->auth->check();


        }

        public function index()
        {
            $data['news']     = $this->news_model->count_All('news');
            $data['products'] = $this->news_model->count_All('product');

            $data['headerTitle'] = 'Admin CP';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('admin/footer');
        }

        public function categoryList()
        {
            $this->Check_module($this->module_name);
            $data['cate_root'] = $this->news_model->getListRoot();
            $data['cate_chil'] = $this->news_model->getListChil();

            $data['headerTitle'] = 'Danh mục tin tức';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/cate_list', $data);
            $this->load->view('admin/footer');
        }

        public function newsListAll()
        {
            $this->Check_module($this->module_name);
            $config['base_url']    = base_url('admin/danh-sach-tin-tuc');
            $config['total_rows']  = $this->news_model->count_All('news'); // xác định tổng số record
            $config['per_page']    = 10; // xác định số record ở mỗi trang
            $config['uri_segment'] = 3; // xác định segment chứa page number
            $this->pagination->initialize($config);
            $data              = array();
            $data['newslist']  = $this->news_model->newsListAll($config['per_page'], $this->uri->segment(3));
            $data['cate_root'] = $this->news_model->getListRoot();
            $data['cate_chil'] = $this->news_model->getListChil();

            $data['headerTitle'] = "Danh sách tin tức";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/news_list_all', $data);
            $this->load->view('admin/footer');
        }

        public function news_by_category($alias)
        {
            $this->Check_module($this->module_name);
            //$cate=$this->news_model->getNewsByID($id);
            // print_r($cate); die();
            $config['base_url']    = base_url('admin/tin-tuc/' . $alias);
            $config['total_rows']  = $this->news_model->countNewsByCategory($alias); // xác định tổng số record
            $config['per_page']    = 10; // xác định số record ở mỗi trang
            $config['uri_segment'] = 4; // xác định segment chứa page number
            $this->pagination->initialize($config);
            $data                = array();
            $data['news_bycate'] = $this->news_model->newsBycategory($alias, $config['per_page'], $this->uri->segment(4));

            $cate_curent         = $this->news_model->getItemByAlias('news_category', $alias);
            $data['cate_curent'] = $cate_curent;
            //print_r($cate_curent);die();

            $data['cate']        = $this->news_model->getList('news_category');
            if(!empty($cate_curent)){
                $data['headerTitle'] = "Tin tức / " . $cate_curent->name;
            }
            else{
                $data['headerTitle'] = "Tin tức";
            }

            $this->load->view('admin/header', $data);
            $this->load->view('admin/news_by_cate', $data);
            $this->load->view('admin/footer');
        }

        //add News
        public function add()
        {
            $this->Check_module($this->module_name);
            $this->load->helper('ckeditor_helper');
            $this->load->helper('model_helper');
            $data['ckeditor']        = array(
                //ID of the textarea that will be replaced
                'id'     => 'ckeditor',
                'path' => 'assets/admin/ckeditor',
                //Optionnal values
                'config' => array(
                    'toolbar' => "Full", //Using the Full toolbar
                    'width'   => "800px", //Setting a custom width
                    'height'  => '300px', //Setting a custom height
                ));
            $config['upload_path']   = './upload/img/';
            $config['allowed_types'] = 'gif|jpg|png|PNG|JPG|GIF';
            $config['max_size']      = '4000';
            $config['max_width']     = '3000';
            $config['max_height']    = '2000';
            $this->load->library('upload', $config);


            if (isset($_POST['addnews'])) {

                $title       = $this->input->post('title');
                $option       = $this->input->post('option');
                $video       = $this->input->post('video');
                $category    = $this->input->post('category');
                $description = $this->input->post('description');
                $content     = $this->input->post('content');
                $home        = $this->input->post('home');
                $hot         = $this->input->post('hot');
                $focus       = $this->input->post('focus');
                $keyword     = $this->input->post('keyword');
                $time        = time();

                $new  = array('title'       => $title,
                    'description' => $description,
                    'content'     => $content,
                    'category_id' => $category,
                    'home'        => $home,
                    'hot'         => $hot,
                    'focus'       => $focus,
                    'keyword'     => $keyword,
                    'time'        => $time,
                    'option'      => $option,
                    'video'      =>$video);

                if($option=="1"){

                    if ($_FILES['userfile']['name'] != '') {
                        if (!$this->upload->do_upload()) {
                            $data['error'] = 'Ảnh không thỏa mãn';
                        } else {


                            $upload = array('upload_data' => $this->upload->data());


                            $image  = 'upload/img/' . $upload['upload_data']['file_name'];
                            $new['image']= $image;
                            $id_new = $this->news_model->Add('news', $new);
                            $alias     = make_alias($title) . '-' . $id_new;
                            $alias_new = array('alias' => $alias);
                            $this->news_model->Update('news', $id_new, $alias_new);

                            redirect(base_url('admin/danh-sach-tin-tuc'));
                        }
                    }
                }
                if($option=="2"){
                    $id_new = $this->news_model->Add('news', $new);
                    $alias     = make_alias($title) . '-' . $id_new;
                    $alias_new = array('alias' => $alias);
                    $this->news_model->Update('news', $id_new, $alias_new);

                    $hddImages = $this->input->post('hddImages');
                    for($i=1; $i<=intval($hddImages); $i++){
                        if ($_FILES['userfile_'.$i.'']['name'] != '') {
                            if (!$this->upload->do_upload('userfile_'.$i.'')) {
                                $data['error'] = 'Ảnh không thỏa mãn';
                            } else {
                                $upload = array('upload_data' => $this->upload->data());
                                $image  = 'upload/img/' . $upload['upload_data']['file_name'];
                                $newsImage['url'] = $image;
                                $newsImage['id_news'] = $id_new;
                                $this->news_model->Add('images_news', $newsImage);
                            }
                        }
                    }
                    redirect(base_url('admin/danh-sach-tin-tuc'));
                }
                if($option=="3"){
                    $id_new = $this->news_model->Add('news', $new);
                    $alias     = make_alias($title) . '-' . $id_new;
                    $alias_new = array('alias' => $alias);
                    $this->news_model->Update('news', $id_new, $alias_new);
                    redirect(base_url('admin/danh-sach-tin-tuc'));
                }
            }
            $data['cate_root'] = $this->news_model->getListRoot();
            $data['cate_chil'] = $this->news_model->getListChil();

            $data['headerTitle'] = "Thêm tin tức";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/news_add', $data);
            $this->load->view('admin/footer');
        }

        //Edit News
        public function edit($id)
        {

            $this->Check_module($this->module_name);
            $this->load->helper('ckeditor_helper');
            $this->load->helper('model_helper');
            $data['ckeditor']        = array(
                //ID of the textarea that will be replaced
                'id'     => 'ckeditor',
                'path' => 'assets/admin/ckeditor',
                //Optionnal values
                'config' => array(
                    'toolbar' => "Full", //Using the Full toolbar
                    'width'   => "800px", //Setting a custom width
                    'height'  => '300px', //Setting a custom height
                ));
            $config['upload_path']   = './upload/img/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '4000';
            $config['max_width']     = '3000';
            $config['max_height']    = '2000';
            $this->load->library('upload', $config);

            $news = $this->news_model->getNewsByID($id);
            $data['listImage'] = $this->news_model->getImageByNewsId($id);

            if (isset($_POST['editnews'])) {

                $title       = $this->input->post('title');
                $option       = $this->input->post('option');
                $category    = $this->input->post('category');
                $description = $this->input->post('description');
                $content     = $this->input->post('content');
                $home        = $this->input->post('home');
                $hot         = $this->input->post('hot');
                $focus       = $this->input->post('focus');
                $keyword     = $this->input->post('keyword');
                $time        = time();
                //$alias       = make_alias($title) . '-' . $news->id;


                $new = array('title'       => $title,
                    'description' => $description,
                    'option'      => $option,
                    'content'     => $content,
                    'category_id' => $category,
                    'home'        => $home,
                    'hot'         => $hot,
                    'focus'       => $focus,
                    'keyword'     => $keyword,
                    'time'        => $time);

                if($option=="1"){
                    if ($_FILES['userfile']['name'] != '') {
                        if (!$this->upload->do_upload()) {
                            $data['error'] = 'Ảnh không thỏa mãn';
                        } else {
                            $upload = array('upload_data' => $this->upload->data());
                            $image  = 'upload/img/' . $upload['upload_data']['file_name'];
                            $new['image'] = $image;
                            $this->news_model->Update('news', $id, $new);

                            redirect(base_url('admin/danh-sach-tin-tuc'));
                        }
                    }
                }

                if($option=="2"){
                    $this->news_model->Update('news', $id, $new);
                    $hddImages = $this->input->post('hddImages');
                    for($i=1; $i<=intval($hddImages); $i++){
                        if ($_FILES['userfile_'.$i.'']['name'] != '') {
                            if (!$this->upload->do_upload('userfile_'.$i.'')) {
                                $data['error'] = 'Ảnh không thỏa mãn';
                            } else {
                                $upload = array('upload_data' => $this->upload->data());
                                $image  = 'upload/img/' . $upload['upload_data']['file_name'];

                                $this->news_model->Delete('images_news',$data['listImage'][$i]->id);

                                $newsImage['url'] = $image;
                                $newsImage['id_news'] = $id;
                                $this->news_model->Add('images_news', $newsImage);
                            }
                        }
                    }
                    redirect(base_url('admin/danh-sach-tin-tuc'));
                }



            }

            $data['cate_root'] = $this->news_model->getListRoot();
            $data['cate_chil'] = $this->news_model->getListChil();

            $data['news']        = $news;
            $data['headerTitle'] = "Sửa tin tức";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/news_edit', $data);
            $this->load->view('admin/footer');
        }

        //Change category of news
        public function change_newscate($id)
        {
            $this->Check_module($this->module_name);
            if (isset($_POST['changecate'])) {
                $idcate = $this->input->post('category');
                $arr    = array('category_id' => $idcate);
                $this->news_model->Update('news', $id, $arr);
                redirect(base_url('admin/danh-sach-tin-tuc'));
            }
            $data['cate_root'] = $this->news_model->getListRoot();
            $data['cate_chil'] = $this->news_model->getListChil();

            $data['headerTitle'] = "Chuyển danh mục";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/news_changecate', $data);
            $this->load->view('admin/footer');
        }

        //Delete News
        public function delete($id)
        {
            $this->Check_module($this->module_name);
            $this->news_model->Delete('news', $id);
            redirect($_SERVER['HTTP_REFERER']);
        }

        //Add Category
        public function addcategory()
        {
            $this->Check_module($this->module_name);
            $this->load->helper('model_helper');

            $config['upload_path']   = './upload/img/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '2000';
            $config['max_width']     = '1500';
            $config['max_height']    = '1000';
            $this->load->library('upload', $config);


            if (isset($_POST['addcate'])) {
                $title       = $this->input->post('title');
                $parent      = $this->input->post('parent');
                $description = $this->input->post('description');
                $alias       = make_alias($title);
                if ($_FILES['userfile']['name'] != '') {
                    if (!$this->upload->do_upload()) {
                        $data['error'] = 'Ảnh không thỏa mãn';
                    } else {
                        $upload = array('upload_data' => $this->upload->data());
                        $image  = 'upload/img/' . $upload['upload_data']['file_name'];

                        $cate    = array('name'        => $title,
                                         'description' => $description,
                                         'parent_id'   => $parent,
                                         'icon'        => $image,
                                         'home'        => $this->input->post('home'),
                                         'focus'       => $this->input->post('focus'),
                                         'hot'         => $this->input->post('hot'),
                                         'tour'         => $this->input->post('tour'),
                                         'alias'       => $alias
                        );
                        $id_cate = $this->news_model->Add('news_category', $cate);
                        if ($id_cate)
                            redirect(base_url('admin/danh-muc-tin-tuc'));
                    }
                } else {
                    $cate    = array('name'        => $title,
                                     'description' => $description,
                                     'parent_id'   => $parent,
                                     'home'        => $this->input->post('home'),
                                     'focus'       => $this->input->post('focus'),
                                     'hot'         => $this->input->post('hot'),
                                     'tour'         => $this->input->post('tour'),
                                     'alias'       => $alias);
                    $id_cate = $this->news_model->Add('news_category', $cate);

                    redirect(base_url('admin/danh-muc-tin-tuc'));
                }
            }
            $data['cate_root'] = $this->news_model->getListRoot();
            $data['cate_chil'] = $this->news_model->getListChil();

            $data['headerTitle'] = "Thêm danh mục";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/cate_add', $data);
            $this->load->view('admin/footer');
        }

        //Edit Category
        public function editcategory($id)
        {
            $this->Check_module($this->module_name);
            $this->load->helper('model_helper');

            $config['upload_path']   = './upload/img/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '1000';
            $config['max_width']     = '1500';
            $config['max_height']    = '1000';
            $this->load->library('upload', $config);

            $cate1 = $this->news_model->getItemByID('news_category', $id);
            if (isset($_POST['editcate'])) {
                $title       = $this->input->post('title');
                $parent      = $this->input->post('parent');
                $description = $this->input->post('description');
                $alias       = make_alias($title);
                if ($_FILES['userfile']['name'] != '') {
                    if (!$this->upload->do_upload()) {
                        $data['error'] = 'Ảnh không thỏa mãn';
                    } else {
                        $upload = array('upload_data' => $this->upload->data());
                        $image  = 'upload/img/' . $upload['upload_data']['file_name'];

                        $cate = array('name' => $title,
                                      'description' => $description,
                                      'parent_id' => $parent,
                                      'icon' => $image,
                                      'home'        => $this->input->post('home'),
                                      'focus'       => $this->input->post('focus'),
                                      'hot'         => $this->input->post('hot'),
                                      'tour'         => $this->input->post('tour'),
                                      'alias' => $alias);
                        $this->news_model->Update('news_category', $id, $cate);

                        redirect(base_url('admin/danh-muc-tin-tuc'));
                    }
                } else {
                    $cate = array('name' => $title,
                                  'description' => $description,
                                  'parent_id' => $parent,
                                  'home'        => $this->input->post('home'),
                                  'focus'       => $this->input->post('focus'),
                                  'hot'         => $this->input->post('hot'),
                                  'tour'         => $this->input->post('tour'),
                                  'alias' => $alias);

                    $this->news_model->Update('news_category', $id, $cate);

                    redirect(base_url('admin/danh-muc-tin-tuc'));
                }
            }
            $data['cate_root'] = $this->news_model->getListRoot();
            $data['cate_chil'] = $this->news_model->getListChil();

            $data['catev']       = $cate1;
            $data['headerTitle'] = "Sửa danh mục tin tức";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/cate_edit', $data);
            $this->load->view('admin/footer');
        }

        //Delete News
        public function deletecate($id)
        {
            $this->Check_module($this->module_name);
            $this->news_model->Delete('news_category', $id);
            redirect($_SERVER['HTTP_REFERER']);
        }

        //--------------------Quan ly Tags---------------------------
        public function taglist()
        {
            $this->Check_module($this->module_name);
            if (isset($_POST['addtags'])) {
                if ($this->input->post('hidden-tags') != '') {
                    $tag   = $this->input->post('hidden-tags');
                    $array = explode(",", $tag);
                    foreach ($array as $v) {
                        $alias  = make_alias($v);
                        $tags   = array('tagname' => $v, 'tags_alias' => $alias);
                        $id_tag = $this->news_model->Add('tags', $tags);
                    }

                    if ($id_tag)
                        redirect($_SERVER['HTTP_REFERER']);
                } else $error = "Chưa có tag được thêm";
            }

            $data['error'] = @$error;

            $config['base_url']    = base_url('admin/quan-ly-tags');
            $config['total_rows']  = $this->news_model->count_All('tags'); // xác định tổng số record
            $config['per_page']    = 10; // xác định số record ở mỗi trang
            $config['uri_segment'] = 3; // xác định segment chứa page number
            $this->pagination->initialize($config);
            $data                = array();
            $data['tagslist']    = $this->news_model->listAll('tags', $config['per_page'], $this->uri->segment(3));
            $data['headerTitle'] = "Quản lý Tags";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/tags_list', $data);
            $this->load->view('admin/footer');
        }

        public function addtags()
        {
            $this->Check_module($this->module_name);
            if (isset($_POST['addtags'])) {
                if ($this->input->post('hidden-tags') != '') {
                    $tag   = $this->input->post('hidden-tags');
                    $array = explode(",", $tag);
                    foreach ($array as $v) {
                        $alias  = make_alias($v);
                        $tags   = array('tagname' => $v, 'tags_alias' => $alias);
                        $id_tag = $this->news_model->Add('tags', $tags);
                    }

                    if ($id_tag)
                        redirect($_SERVER['HTTP_REFERER']);
                } else $error = "Chưa có tag được thêm";
            }

            $data['error']       = @$error;
            $data['headerTitle'] = "Thêm Tags";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/tags_add', $data);
            $this->load->view('admin/footer');
        }

        public function deletetags($id)
        {
            $this->Check_module($this->module_name);
            $this->news_model->Delete('tags', $id);
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function delete_images()
        {
            $id =$this->input->post('id');
            $this->news_model->Delete('images_news', $id);
            echo "success";
        }



        public function test()
        {
            $this->Check_module($this->module_name);
            $t     = "fsfs,gdgdg,uutu,fg";
            $array = explode(",", $t);
            foreach ($array as $v) {
                echo $v . ' -';
            }
        }
    }