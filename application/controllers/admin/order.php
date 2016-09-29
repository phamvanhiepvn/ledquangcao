<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller
{
    protected $module_name="Order";
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('ordermodel');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();
        $this->Check_module($this->module_name);
    }


    public function Oderlist()
    {

        $config['base_url'] = base_url('admin/danh-sach-dat-hang');
        $config['total_rows'] = $this->ordermodel->count_All('order'); // xác định tổng số record
        $config['per_page'] = 20; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
        $this->pagination->initialize($config);

        $data = array();
        //        $data['cate_root'] = $this->ordermodel->getListRoot('product_category');
        //        $data['cate_chil'] = $this->ordermodel->getListChil('product_category');

        $data['item_list'] = $this->ordermodel->Getlist_oder( $config['per_page'], $this->uri->segment(3));
        $data['detail'] = $this->ordermodel->order_detail();



        $data['headerTitle'] = "Danh sách đặt hàng";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/Oderlist', $data);
        $this->load->view('admin/footer');
    }

    public function Deleteorder($id){
        if (is_numeric($id)) {
            $this->ordermodel->Delete('order', $id);
            redirect($_SERVER['HTTP_REFERER']);
        } else return false;
    }

    public function UpdateSim($id = null)
    {
        $this->load->helper('ckeditor_helper');
        $this->load->helper('model_helper');
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor',
            'path' => 'js/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "800px", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ));


        $item = $this->ordermodel->getItemByID('sim', $id);

        if (isset($_POST['Update'])) {

            if ($_POST['Id_Edit']) {
                //die('edit');
                $name = $this->input->post('name');
                $category = $this->input->post('category');
                $description = $this->input->post('description');
                $detail = $this->input->post('detail');
                $price = $this->input->post('price');
                $home = $this->input->post('home');
                $focus = $this->input->post('focus');
                $hot = $this->input->post('hot');
                $keyword = $this->input->post('keyword');
                $alias = make_alias($name);

                $pro = array('number' => $name,
                    'network' => $category,
                    'price' => $price,
                    'short_desc' => $description,
                    'description' => $detail,
                    'price' => $price,
                    'home' => $home,
                    'hot' => $hot,
                    'focus' => $focus,
                    'keyword' => $keyword,
                );

                $rs = $this->ordermodel->Update('sim', $id, $pro);

            } else {
                // die('add');
                $name = $this->input->post('name');
                $category = $this->input->post('category');
                $description = $this->input->post('description');
                $detail = $this->input->post('detail');
                $price = $this->input->post('price');
                $home = $this->input->post('home');
                $focus = $this->input->post('focus');
                $hot = $this->input->post('hot');
                $keyword = $this->input->post('keyword');
                $alias = make_alias($name);

                $pro = array('number' => $name,
                    'network' => $category,
                    'price' => $price,
                    'short_desc' => $description,
                    'description' => $detail,
                    'price' => $price,
                    'home' => $home,
                    'hot' => $hot,
                    'focus' => $focus,
                    'keyword' => $keyword,
                );

                $rs = $this->ordermodel->Add('sim', $pro);
            }
            redirect(base_url('admin/danh-sach-sim'));
        }
//
//        $data['cate_root'] = $this->ordermodel->getListRoot('product_category');
//        $data['cate_chil'] = $this->ordermodel->getListChil('product_category');
        $data['item'] = $item;
        $data['headerTitle'] = "Sửa thông tin sim";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sim_update', $data);
        $this->load->view('admin/footer');
    }


    public function deletesim($id)
    {
        if (is_numeric($id)) {
            $this->ordermodel->Delete('sim', $id);
            redirect($_SERVER['HTTP_REFERER']);
        } else return false;
    }

    public function sim_bytype($type)
    {
        $config['base_url'] = base_url('admin/search-by-type/'.$type);
        $config['total_rows'] = $this->ordermodel->CountSimByType($type); // xác định tổng số record
        $config['per_page'] = 20; // xác định số record ở mỗi trang
        $config['uri_segment'] = 4; // xác định segment chứa page number
        $this->pagination->initialize($config);

        $data = array();

        $data['item_list'] = $this->ordermodel->getSimByType($type, $config['per_page'], $this->uri->segment(4));

        $data['headerTitle'] = "Danh sách Sim";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sim_bytype', $data);
        $this->load->view('admin/footer');
    }
    public function sim_bycategory($cate)
    {
        $config['base_url'] = base_url('admin/search-by-category/'.$cate);
        $config['total_rows'] = $this->ordermodel->CountSimByCategory($cate); // xác định tổng số record
        $config['per_page'] = 20; // xác định số record ở mỗi trang
        $config['uri_segment'] = 4; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data = array();

        $data['item_list'] = $this->ordermodel->getSimByCategory($cate, $config['per_page'], $this->uri->segment(4));

        $data['headerTitle'] = "Danh sách Sim";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sim_bycategory', $data);
        $this->load->view('admin/footer');
    }
    public function sim_bynetwork($net)
    {
        $config['base_url'] = base_url('admin/search-by-network/'.$net);
        $config['total_rows'] = $this->ordermodel->CountSimByNetwork($net); // xác định tổng số record
        $config['per_page'] = 20; // xác định số record ở mỗi trang
        $config['uri_segment'] = 4; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data = array();

        $data['item_list'] = $this->ordermodel->getSimByNetwork($net, $config['per_page'], $this->uri->segment(4));

        $data['headerTitle'] = "Danh sách Sim";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sim_bynetwork', $data);
        $this->load->view('admin/footer');
    }
    public function sim_byprice($min,$max)
    {
        $config['base_url'] = base_url('admin/search-by-price/'.$min.'/'.$max);
        $config['total_rows'] = $this->ordermodel->CountSimByPrice($min,$max); // xác định tổng số record
        $config['per_page'] = 20; // xác định số record ở mỗi trang
        $config['uri_segment'] = 5; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data = array();

        $data['item_list'] = $this->ordermodel->getSimByPrice($min,$max, $config['per_page'], $this->uri->segment(5));

        $data['headerTitle'] = "Danh sách Sim";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sim_byprice', $data);
        $this->load->view('admin/footer');
    }


//    ======================================================================================================================
    public function productlist()
    {
        $config['base_url'] = base_url('admin/danh-sach-san-pham');
        $config['total_rows'] = $this->ordermodel->count_All('product'); // xác định tổng số record
        $config['per_page'] = 20; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data = array();
        $data['cate_root'] = $this->ordermodel->getListRoot('product_category');
        $data['cate_chil'] = $this->ordermodel->getListChil('product_category');
        $data['prolist'] = $this->ordermodel->getListProduct('product', $config['per_page'], $this->uri->segment(3));
        $data['headerTitle'] = "Danh sách sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_list', $data);
        $this->load->view('admin/footer');
    }

    //===================
    public function pro_by_category($alias)
    {
        $config['base_url'] = base_url('admin/product/' . $alias);
        $config['total_rows'] = $this->ordermodel->countProByCategory($alias); // xác định tổng số record
        $config['per_page'] = 20; // xác định số record ở mỗi trang
        $config['uri_segment'] = 4; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data = array();

        $data['pro_bycate'] = $this->ordermodel->ProductBycategory($alias, $config['per_page'], $this->uri->segment(4));
        $data['cate_root'] = $this->ordermodel->getListRoot('product_category');
        $data['cate_chil'] = $this->ordermodel->getListChil('product_category');
        $data['headerTitle'] = "Danh sách sản phẩm";

        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_by_cate', $data);
        $this->load->view('admin/footer');
    }

    public function addpro()
    {
        $this->load->helper('ckeditor_helper');
        $this->load->helper('model_helper');
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor',
            'path' => 'js/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "800px", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ));
        $config['upload_path'] = './upload/img/products/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);


        if (isset($_POST['addnews'])) {
            $name = $this->input->post('name');
            $category = $this->input->post('category');
            $description = $this->input->post('description');
            $keyword = $this->input->post('keyword');
            $detail = $this->input->post('detail');
            $price = $this->input->post('price');
            $home = $this->input->post('home');
            $focus = $this->input->post('focus');
            $hot = $this->input->post('hot');


            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/products/' . $upload['upload_data']['file_name'];

                    $pro = array('name' => $name,
                        'description' => $description,
                        'keyword' => $keyword,
                        'detail' => $detail,
                        'price' => $price,
                        'image' => $image,
                        'category_id' => $category,
                        'home' => $home,
                        'hot' => $hot,
                        'focus' => $focus,
                    );
                    $id = $this->ordermodel->Add('product', $pro);

                    $alias = make_alias($name) . '-' . $id;
                    $arr = array('alias' => $alias);
                    $this->ordermodel->Update('product', $id, $arr);

                    $c = $this->ordermodel->getItemByID('product_category', $category);
                    $ca = array('id_product' => $id, 'id_category' => $category);
                    $this->ordermodel->Add('product_to_category', $ca);

                    if ($c->parent_id > 0) {
                        $c1 = $this->ordermodel->getItemByID('product_category', $c->parent_id);
                        $cate1 = array('id_product' => $id, 'id_category' => $c1->id);
                        $this->ordermodel->Add('product_to_category', $cate1);
                        if ($c1->parent_id > 0) {
                            $c2 = $this->ordermodel->getItemByID('product_category', $c1->parent_id);
                            $cate2 = array('id_product' => $id, 'id_category' => $c2->id);
                            $this->ordermodel->Add('product_to_category', $cate2);
                            if ($c2->parent_id > 0) {
                                $c3 = $this->ordermodel->getItemByID('product_category', $c2->parent_id);
                                $cate3 = array('id_product' => $id, 'id_category' => $c3->id);
                                $this->ordermodel->Add('product_to_category', $cate3);
                            }
                        }
                    }


                    redirect(base_url('admin/danh-sach-san-pham'));
                }
            } else {
                $new = array('name' => $name,
                    'description' => $description,
                    'keyword' => $keyword,
                    'detail' => $detail,
                    'price' => $price,
                    'category_id' => $category,
                    'home' => $home,
                    'hot' => $hot,
                    'focus' => $focus,
                );
                $id = $this->ordermodel->Add('product', $new);

                $alias = make_alias($name) . '-' . $id;
                $arr = array('alias' => $alias);
                $this->ordermodel->Update('product', $id, $arr);
                //danh muc
                $c = $this->ordermodel->getItemByID('product_category', $category);
                $ca = array('id_product' => $id, 'id_category' => $category);
                $this->ordermodel->Add('product_to_category', $ca);

                if ($c->parent_id > 0) {
                    $c1 = $this->ordermodel->getItemByID('product_category', $c->parent_id);
                    $cate1 = array('id_product' => $id, 'id_category' => $c1->id);
                    $this->ordermodel->Add('product_to_category', $cate1);
                    if ($c1->parent_id > 0) {
                        $c2 = $this->ordermodel->getItemByID('product_category', $c1->parent_id);
                        $cate2 = array('id_product' => $id, 'id_category' => $c2->id);
                        $this->ordermodel->Add('product_to_category', $cate2);
                        if ($c2->parent_id > 0) {
                            $c3 = $this->ordermodel->getItemByID('product_category', $c2->parent_id);
                            $cate3 = array('id_product' => $id, 'id_category' => $c3->id);
                            $this->ordermodel->Add('product_to_category', $cate3);
                        }
                    }
                }

                redirect(base_url('admin/danh-sach-san-pham'));
            }
        }
        $data['cate_root'] = $this->ordermodel->getListRoot('product_category');
        $data['cate_chil'] = $this->ordermodel->getListChil('product_category');
        //$data['cate'] = $cate;
        $data['headerTitle'] = "Thêm sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_add', $data);
        $this->load->view('admin/footer');
    }

    public function editpro($id)
    {
        $this->load->helper('ckeditor_helper');
        $this->load->helper('model_helper');
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor',
            'path' => 'js/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "800px", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ));

        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $this->load->library('upload', $config);

        $item = $this->ordermodel->getItemByID('product', $id);

        if (isset($_POST['editpro'])) {
            $name = $this->input->post('name');
            $category = $this->input->post('category');
            $description = $this->input->post('description');
            $detail = $this->input->post('detail');
            $price = $this->input->post('price');
            $home = $this->input->post('home');
            $focus = $this->input->post('focus');
            $hot = $this->input->post('hot');
            $alias = make_alias($name);
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];

                    $pro = array('name' => $name,
                        'description' => $description,
                        'detail' => $detail,
                        'price' => $price,
                        'image' => $image,
                        'category_id' => $category,
                        'home' => $home,
                        'hot' => $hot,
                        'focus' => $focus,
                        'alias' => $alias,
                    );

                    $this->ordermodel->Update('product', $id, $pro);

                    //danh muc
                    $this->ordermodel->Deltete_cate($id);

                    $c = $this->ordermodel->getItemByID('product_category', $category);
                    $ca = array('id_product' => $id, 'id_category' => $category);
                    $this->ordermodel->Add('product_to_category', $ca);

                    if ($c->parent_id > 0) {
                        $c1 = $this->ordermodel->getItemByID('product_category', $c->parent_id);
                        $cate1 = array('id_product' => $id, 'id_category' => $c1->id);
                        $this->ordermodel->Add('product_to_category', $cate1);
                        if ($c1->parent_id > 0) {
                            $c2 = $this->ordermodel->getItemByID('product_category', $c1->parent_id);
                            $cate2 = array('id_product' => $id, 'id_category' => $c2->id);
                            $this->ordermodel->Add('product_to_category', $cate2);
                            if ($c2->parent_id > 0) {
                                $c3 = $this->ordermodel->getItemByID('product_category', $c2->parent_id);
                                $cate3 = array('id_product' => $id, 'id_category' => $c3->id);
                                $this->ordermodel->Add('product_to_category', $cate3);
                            }
                        }
                    }

                    redirect(base_url('admin/danh-sach-san-pham'));
                }
            } else {
                $pro = array('name' => $name,
                    'description' => $description,
                    'detail' => $detail,
                    'price' => $price,
                    'category_id' => $category,
                    'home' => $home,
                    'hot' => $hot,
                    'focus' => $focus,
                    'alias' => $alias,
                );

                $this->ordermodel->Update('product', $id, $pro);

                //danh muc
                $this->ordermodel->Deltete_cate($id);

                $c = $this->ordermodel->getItemByID('product_category', $category);
                $ca = array('id_product' => $id, 'id_category' => $category);
                $this->ordermodel->Add('product_to_category', $ca);

                if ($c->parent_id > 0) {
                    $c1 = $this->ordermodel->getItemByID('product_category', $c->parent_id);
                    $cate1 = array('id_product' => $id, 'id_category' => $c1->id);
                    $this->ordermodel->Add('product_to_category', $cate1);
                    if ($c1->parent_id > 0) {
                        $c2 = $this->ordermodel->getItemByID('product_category', $c1->parent_id);
                        $cate2 = array('id_product' => $id, 'id_category' => $c2->id);
                        $this->ordermodel->Add('product_to_category', $cate2);
                        if ($c2->parent_id > 0) {
                            $c3 = $this->ordermodel->getItemByID('product_category', $c2->parent_id);
                            $cate3 = array('id_product' => $id, 'id_category' => $c3->id);
                            $this->ordermodel->Add('product_to_category', $cate3);
                        }
                    }
                }

                redirect(base_url('admin/danh-sach-san-pham'));
            }
        }
        $data['cate_root'] = $this->ordermodel->getListRoot('product_category');
        $data['cate_chil'] = $this->ordermodel->getListChil('product_category');
        $data['item'] = $item;
        $data['headerTitle'] = "Sửa sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_edit', $data);
        $this->load->view('admin/footer');
    }

    //Change category product
    public function change_procate($id)
    {

        if (isset($_POST['changecate'])) {
            $idcate = $this->input->post('category');
            $arr = array('category_id' => $idcate);
            $this->ordermodel->Update('product', $id, $arr);

            //danh muc
            $this->ordermodel->Deltete_cate($id);

            $c = $this->ordermodel->getItemByID('product_category', $idcate);
            $ca = array('id_product' => $id, 'id_category' => $idcate);
            $this->ordermodel->Add('product_to_category', $ca);

            if ($c->parent_id > 0) {
                $c1 = $this->ordermodel->getItemByID('product_category', $c->parent_id);
                $cate1 = array('id_product' => $id, 'id_category' => $c1->id);
                $this->ordermodel->Add('product_to_category', $cate1);
                if ($c1->parent_id > 0) {
                    $c2 = $this->ordermodel->getItemByID('product_category', $c1->parent_id);
                    $cate2 = array('id_product' => $id, 'id_category' => $c2->id);
                    $this->ordermodel->Add('product_to_category', $cate2);
                    if ($c2->parent_id > 0) {
                        $c3 = $this->ordermodel->getItemByID('product_category', $c2->parent_id);
                        $cate3 = array('id_product' => $id, 'id_category' => $c3->id);
                        $this->ordermodel->Add('product_to_category', $cate3);
                    }
                }
            }

            redirect(base_url('admin/danh-sach-san-pham'));
        }

        $data['cate_root'] = $this->ordermodel->getListRoot('product_category');
        $data['cate_chil'] = $this->ordermodel->getListChil('product_category');
        $data['headerTitle'] = "Chuyển danh mục";

        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_changecate', $data);
        $this->load->view('admin/footer');
    }

    //Xóa
    public function deletepro($id)
    {
        if (is_numeric($id)) {
            $this->ordermodel->Delete('product', $id);
            redirect($_SERVER['HTTP_REFERER']);
        } else return false;
    }


    ///category
    public function categoryList()
    {
        $data['cate_root'] = $this->ordermodel->getListRoot('product_category');
        $data['cate_chil'] = $this->ordermodel->getListChil('product_category');
        $data['headerTitle'] = 'Danh mục sản phẩm';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_cate_list', $data);
        $this->load->view('admin/footer');
    }

    public function addprocategory()
    {
        $this->load->helper('model_helper');

        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1500';
        $config['max_height'] = '1000';
        $this->load->library('upload', $config);


        if (isset($_POST['addcate'])) {
            $title = $this->input->post('name');
            $parent = $this->input->post('parent');
            $description = $this->input->post('description');
            $alias = make_alias($title);
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];

                    $cate = array('name' => $title, 'description' => $description, 'parent_id' => $parent, 'image' => $image, 'alias' => $alias);
                    $id_cate = $this->ordermodel->Add('product_category', $cate);
                    if ($id_cate)
                        redirect(base_url('admin/danh-muc-san-pham'));
                }
            } else {
                $cate = array('name' => $title, 'description' => $description, 'parent_id' => $parent, 'alias' => $alias);
                $id_cate = $this->ordermodel->Add('product_category', $cate);

                redirect(base_url('admin/danh-muc-san-pham'));
            }
        }
        $data['cate_root'] = $this->ordermodel->getListRoot('product_category');
        $data['cate_chil'] = $this->ordermodel->getListChil('product_category');
        $data['headerTitle'] = "Thêm danh mục sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_cate_add', $data);
        $this->load->view('admin/footer');
    }

    public function editcategory($id)
    {
        $this->load->helper('model_helper');

        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);

        $item = $this->ordermodel->getItemByID('product_category', $id);
        if (isset($_POST['editcate_pro'])) {
            $name = $this->input->post('name');
            $parent = $this->input->post('parent');
            $description = $this->input->post('description');
            $alias = make_alias($name);
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];

                    $cate = array('name' => $name, 'description' => $description, 'parent_id' => $parent, 'image' => $image, 'alias' => $alias);

                    $this->ordermodel->Update('product_category', $id, $cate);

                    redirect(base_url('admin/danh-muc-san-pham'));
                }
            } else {
                $cate = array('name' => $name, 'description' => $description, 'parent_id' => $parent, 'alias' => $alias);

                $this->ordermodel->Update('product_category', $id, $cate);

                redirect(base_url('admin/danh-muc-san-pham'));
            }
        }
        $catelist = $this->ordermodel->getList('product_category');
        $data['cate'] = $catelist;
        $data['item'] = $item;
        $data['headerTitle'] = "Sửa sản danh mục sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_cate_edit', $data);
        $this->load->view('admin/footer');
    }

    public function deletecategory($id)
    {
        if (is_numeric($id)) {
            $this->ordermodel->Delete('product_category', $id);
            redirect($_SERVER['HTTP_REFERER']);
        } else return false;
    }


    //Them anh cho san pham===========================
    public function productimages($id)
    {

        $name_array = array();
        $count = count(@$_FILES['userfile']['size']);
        foreach ($_FILES as $key => $value) {

            for ($s = 0; $s <= $count - 1; $s++) {
                $_FILES['userfile']['name'] = $value['name'][$s];
                $_FILES['userfile']['type'] = $value['type'][$s];
                $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
                $_FILES['userfile']['error'] = $value['error'][$s];
                $_FILES['userfile']['size'] = $value['size'][$s];
                $config['upload_path'] = './upload/img/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '1000';
                $config['max_width'] = '1500';
                $config['max_height'] = '1000';

                $this->load->library('upload', $config);
                $this->upload->do_upload();

                $data = $this->upload->data();
                $name_array[] = $data['file_name'];
                if ($data['file_name'] != null) {
                    $this->load->database();
                    //$name=make_alias($data['file_name']);
                    $link = 'upload/img/' . $data['file_name'];
                    $db_data = array('id' => NULL,
                        'name' => $data['file_name'],
                        'link' => $link,
                        'id_item' => $id
                    );
                    $id_i = $this->db->insert('images', $db_data);

                    // redirect(base_url('admin/product_images/' . $id));
                }
            }
        }
        $data['pro_image'] = $this->ordermodel->getProImage($id);
        $data['id'] = $id;

        $data['headerTitle'] = "Ảnh sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_images', $data);
        $this->load->view('admin/footer');
    }

    public function update_show(){
        if($this->input->post('order')!=0){
            $this->ordermodel->Update_where('order',array('id'=>$this->input->post('order')),array('show'=>1));
            echo 1;
        }
        if($this->input->post('id_order')!=0){
            $item= $this->ordermodel->GetFirstRowWhere('order',array('id'=>$this->input->post('id_order')));
            if($item->mark==0){
                $this->ordermodel->Update_where('order',array('id'=>$this->input->post('id_order')),array('mark'=>1));
                echo 1;
            }
            if($item->mark==1){
                $this->ordermodel->Update_where('order',array('id'=>$this->input->post('id_order')),array('mark'=>0));
                echo 0;
            }
        }
    }

    public function update_admin_note(){
        $id=$this->input->post('id');
        $_SESSION['messege']='';
        $rs['status']=false;

        $this->ordermodel->Update_where('order', array('id' => $id),array('admin_note'=>$this->input->post('note')));

        $_SESSION['messege']='Cập nhật ghi chú thành công!';
        $rs['status']=true;

        $rs['mess']=$_SESSION['messege'];
        echo  json_encode($rs);
    }

    public function updateStatusOrder($id,$value)
    {
        //var_dump($value);die();
        $this->ordermodel->update('order',$id,array('status' => $value));

        redirect(base_url('admin/danh-sach-dat-hang'));
    }
}