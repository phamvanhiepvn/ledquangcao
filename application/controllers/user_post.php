<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_post extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('f_user_post');
    }


    public function user_post2($id=null){
        $this->auth->checkUserLogin();
        $data['title']='Đăng tin';
        if($id){
            $edit=$this->f_user_post->getFirstRowWhere('user_post',array('id'=>$id));
            $data['edit']=$edit;
            $data['title']='Cập nhật';
        }
        $this->load->helper('ckeditor_helper');
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor',
            'path' => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' =>  array(
                    array( 'Undo','Redo','-','NumberedList','BulletedList', '-',
                        'Bold', 'Italic', 'Underline','JustifyLeft','JustifyCenter','JustifyRight', 'Strike' ,'-',
                        'Image')
                ), //Using the Full toolbar
                'width' => "100%", //Setting a custom width
                'height' => '300', //Setting a custom height
            ));
        $config['upload_path'] = './upload/img/user_post/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);

        if(isset($_POST['add_pro'])){
            $arr=array('tieude' => $this->input->post('tieude'),
                       'ma' => $this->input->post('ma'),
                       'loai_giaodich' => $this->input->post('loai_giaodich'),
                       'tinh_thanh' => $this->input->post('tinh_thanh'),
                       'gia_m' =>  str_replace(',','',$this->input->post('gia_m')),
                       'anh' => '',
                       'noidung' => $this->input->post('noidung'),
                       'userid' => $this->session->userdata('userid'),
                       'alias'       => '',
                       'time' => time(),
            );

            if($this->input->post('edit')){//edit
                $this->f_user_post->Update_where('user_post',array('id'=>$id),$arr);
            }else{//add
                $id=$this->f_user_post->Add('user_post',$arr);
            }
            $this->f_user_post->Update_where('user_post',array('id'=>$id),
                                             array('alias' => make_alias($this->input->post('tieude')).'-'.$id,));


            if ( !empty($_FILES['userfile'])) {
//                die();
                if (!$this->upload->do_upload('userfile')) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $anh = 'upload/img/user_post/' . $upload['upload_data']['file_name'];
                    $this->f_user_post->Update_where('user_post',array('id'=>$id) , array('anh' => $anh,));
                    if(isset($edit)&&file_exists($edit->anh)){
                        unlink($edit->anh);
                    }
                }
            }
            if (!empty($_FILES['file_more'])) {
                $name_array = array();

                $count = count(@$_FILES['file_more']['size']);
                $iw    = 1;
                foreach ($_FILES as $key => $value) {
                    if ($key == 'file_more') {
                        for ($s = 0; $s <= $count - 1; $s++) {
                            $_FILES['file_more']['name']     = $value['name'][$s];
                            $_FILES['file_more']['type']     = $value['type'][$s];
                            $_FILES['file_more']['tmp_name'] = $value['tmp_name'][$s];
                            $_FILES['file_more']['error']    = $value['error'][$s];
                            $_FILES['file_more']['size']     = $value['size'][$s];

                            $this->upload->do_upload('file_more');

                            $data_u = $this->upload->data();
//                            print_r($data_u); die();
                            $name_array[] = $data_u['file_name'];
                            if ($data_u['file_name'] != null) {
                                $link = 'upload/img/user_post/' . $data_u['file_name'];
                                $db_data = array('id'      => NULL,
                                    'name'    => $data_u['file_name'],
                                    'link'    => $link,
                                    'id_item' => $id
                                );
                                $this->f_user_post->Add('user_post_images', $db_data);

                            }
                            if($s==1) break;
                        }
                    }
                }
            }

            redirect( base_url('trang-ca-nhan'));
        }

        $data['province'] = $this->f_user_post->getList('province');
        $data['menu_right'] = $this->f_user_post->getMenuRightRoot();
        $data['cate'] = $this->f_user_post->getList('post_cate');
        $this->LoadHeader('Đăng tin');
        $this->load->view('user_post',$data);
        $this->LoadFooter();

    }


    //Them anh cho san pham===========================
    public function productimages($id)
    {
        $name_array = array();
        $count = count(@$_FILES['userfile_all']['size']);
        foreach ($_FILES as $key => $value) {
            for ($s = 0; $s <= $count - 1; $s++) {
                $_FILES['userfile_all']['name'] = $value['name'][$s];
                $_FILES['userfile_all']['type'] = $value['type'][$s];
                $_FILES['userfile_all']['tmp_name'] = $value['tmp_name'][$s];
                $_FILES['userfile_all']['error'] = $value['error'][$s];
                $_FILES['userfile_all']['size'] = $value['size'][$s];
                $config['upload_path'] = './upload/img/user_post/';
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
                    $link = './upload/img/user_post/' . $data['file_name'];
                    $db_data = array('id' => NULL,
                        'name' => $data['file_name'],
                        'link' => $link,
                        'id_item' => $id
                    );
                    $id_i = $this->db->insert('user_post_images', $db_data);
                }

            }
        }


        $data['id'] = $id;

        $data['headerTitle'] = "Ảnh sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_images', $data);
        $this->load->view('admin/footer');
    }




    public function getdistric()
    {
        if (isset($_POST['id'])) {
            $list        = $this->f_user_post->Get_where('district', array('provinceid' => $_POST['id']));
            echo json_encode($list);
        }
    }







}