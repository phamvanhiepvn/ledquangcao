<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Modules extends MY_Controller
    {
        protected $module_name = "Modules";

        function __construct()
        {
            parent::__construct();
            $this->load->helper('url');
            $this->load->model('modules_model');
            $this->load->library('pagination');
            $this->auth = new Auth();
            $this->auth->check();

            $this->Check_module($this->module_name);

        }


        //add News
        public function modulemanager($id=null)
        {
            $this->load->helper('model_helper');


            if (isset($_POST['add_submit'])) {
                $module_name = $this->input->post('module_name');
                $alias       = $this->input->post('alias');

                $data_array = array('module_name' => $module_name,
                                    'alias'       => $alias);

                if($_POST['id']){

                    $this->modules_model->Update('modules',$id,$data_array);
                    redirect(base_url('admin/quan-ly-modules'));

                }else{

                    $this->modules_model->Add('modules', $data_array);
                    redirect(base_url('admin/quan-ly-modules'));
                }
            }

            if($id){
                $data['id']=$id;
                $data['edit']=$this->modules_model->getItemByID('modules',$id);
            }

            $data['modules_list']=$this->modules_model->listAll('modules');


            $data['headerTitle'] = "Thêm module";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/module_manager', $data);
            $this->load->view('admin/footer');
        }



        //Change category of news

        public function delete($id)
        {
            $this->modules_model->Delete('modules', $id);
            redirect($_SERVER['HTTP_REFERER']);
        }

        //Add Category
        public function addcategory()
        {
            $this->load->helper('model_helper');

            $config['upload_path']   = './upload/img/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '1000';
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

                        $cate    = array('name' => $title, 'description' => $description, 'parent_id' => $parent, 'icon' => $image, 'alias' => $alias);
                        $id_cate = $this->modules_model->Add('news_category', $cate);
                        if ($id_cate)
                            redirect(base_url('admin/danh-muc-tin-tuc'));
                    }
                } else {
                    $cate    = array('name' => $title, 'description' => $description, 'parent_id' => $parent, 'alias' => $alias);
                    $id_cate = $this->modules_model->Add('news_category', $cate);

                    redirect(base_url('admin/danh-muc-tin-tuc'));
                }
            }
            $data['cate_root'] = $this->modules_model->getListRoot();
            $data['cate_chil'] = $this->modules_model->getListChil();

            $data['headerTitle'] = "Thêm danh mục";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/cate_add', $data);
            $this->load->view('admin/footer');
        }

        //Edit Category
        public function editcategory($id)
        {
            $this->load->helper('model_helper');

            $config['upload_path']   = './upload/img/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '1000';
            $config['max_width']     = '1500';
            $config['max_height']    = '1000';
            $this->load->library('upload', $config);

            $cate1 = $this->modules_model->getItemByID('news_category', $id);
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

                        $cate = array('name' => $title, 'description' => $description, 'parent_id' => $parent, 'icon' => $image, 'alias' => $alias);
                        $this->modules_model->Update('news_category', $id, $cate);

                        redirect(base_url('admin/danh-muc-tin-tuc'));
                    }
                } else {
                    $cate = array('name' => $title, 'description' => $description, 'parent_id' => $parent, 'alias' => $alias);

                    $this->modules_model->Update('news_category', $id, $cate);

                    redirect(base_url('admin/danh-muc-tin-tuc'));
                }
            }
            $data['cate_root'] = $this->modules_model->getListRoot();
            $data['cate_chil'] = $this->modules_model->getListChil();

            $data['catev']       = $cate1;
            $data['headerTitle'] = "Sửa danh mục tin tức";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/cate_edit', $data);
            $this->load->view('admin/footer');
        }
    }