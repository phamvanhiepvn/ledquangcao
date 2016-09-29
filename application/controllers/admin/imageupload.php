<?php
class Imageupload extends MY_Controller
{
    protected $module_name="Images";
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('imagemodel');
        $this->load->library('pagination');

        $this->auth->check();
        $this->Check_module($this->module_name);
    }

    function index()
    {
        $config['base_url'] = base_url('admin/imageupload');
        $config['total_rows'] = $this->imagemodel->count_All('images'); // xác ??nh t?ng s? record
        $config['per_page'] = 15; // xác ??nh s? record ? m?i trang
        $config['uri_segment'] = 3; // xác ??nh segment ch?a page number
        $this->pagination->initialize($config);
        $data = array();
        $data['imagelist'] = $this->imagemodel->listAll('images', $config['per_page'], $this->uri->segment(3));


        $data['headerTitle'] = "Quản lý ảnh";

        $this->load->view('admin/header', $data);
        $this->load->view('admin/imageupload_form', $data);
        $this->load->view('admin/footer');
    }

    function doupload(){
        $this->load->helper('model_helper');
        $name_array = array();
        $count = count($_FILES['userfile']['size']);

        foreach ($_FILES as $key => $value) {
            // print_r($value);die();
            for ($s = 0; $s <= $count - 1; $s++) {
                $_FILES['userfile']['name'] = $value['name'][$s];
                $_FILES['userfile']['type'] = $value['type'][$s];
                $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
                $_FILES['userfile']['error'] = $value['error'][$s];
                $_FILES['userfile']['size'] = $value['size'][$s];
                $config['upload_path'] = './upload/img/';
                $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
                $config['max_size'] = '4000';
                $config['max_width'] = '3500';
                $config['max_height'] = '3000';

                $this->load->library('upload', $config);

                $this->upload->do_upload();
                $data = $this->upload->data();
                $name_array[] = $data['file_name'];
                if ($data['file_name'] != null && $this->upload->do_upload()) {
                    $this->load->database();
                    //$name=make_alias($data['file_name']);
                    $link = 'upload/img/' . $data['file_name'];
                    $db_data = array('id' => NULL,
                        'name' => $data['file_name'],
                        'link' => $link
                    );
                    $id_i = $this->db->insert('images', $db_data);

                } else {
                    echo "<script>alert('Anh lon hon kich thuoc cho phep');
                    var base_url = window.location.origin;
                    window.location.href = base_url+'/admin/imageupload'</script>";
                }
            }
            redirect(base_url('admin/imageupload/'));
        }

        /* $names = implode(',', $name_array);
          $this->load->database();
         $db_data = array('id'=> NULL,
                         'name'=> $names);
         $this->db->insert('images',$db_data) ;

         print_r($names);*/
    }

    //Delete Image
    public function delete($id)
    {
        $img = $this->imagemodel->getItemByID('images', $id);

        if(file_exists($img->link)){
            unlink(($img->link)); //die(base_url($img->link));
        }

        $this->imagemodel->Delete('images', $id);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function banner()
    {
        $data['list'] = $this->imagemodel->getBannerList();
        $data['headerTitle'] = 'Quản lý Banner';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/banner', $data);
        $this->load->view('admin/footer');
    }

    //add banner
    public function banner_add($id=null)
    {

        $config['upload_path'] = './upload/img/banner/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '4000';
        $config['max_width']     = '3000';
        $config['max_height']    = '2000';
        $this->load->library('upload', $config);

        if($id>0){
            $data['edit']=$this->imagemodel->getFirstRowWhere('images',array('id'=>$id));
            //            print_r($data['edit']);
        }
        if (isset($_POST['upload'])) {
            $title = $this->input->post('title');
            $type = $this->input->post('type');
            $url = $this->input->post('url');
            $target = $this->input->post('target');


            if(isset($_POST['edit_id'])){
                $item = array('type' => $type,
                    'url' => $url,
                    'target' => $target,
                    'title' => $title,
                    'cate' => $this->input->post('cate')
                );
                $this->imagemodel->Update_where('images',array('id'=>$_POST['edit_id']), $item);
            }else{
                $item = array('type' => $type,
                    'url' => $url,
                    'target' => $target,
                    'title' => $title,
                    'cate' => $this->input->post('cate')
                );
                $id = $this->imagemodel->Add('images', $item);
            }

            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh lớn hơn kích cho phép hoặc không đúng định dạng';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/banner/' . $upload['upload_data']['file_name'];

                    if(file_exists($image)){
                        if(file_exists(@$data['edit']->link)){
                            unlink($data['edit']->link);
                        }
                    }
                    $item = array(
                        'link' => $image,
                    );
                    $this->imagemodel->Update_where('images',array('id'=>$id), $item);
                }
            }redirect(base_url('admin/imageupload/banner'));
        }


        $data['headerTitle'] = "Cập nhật banner";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/banner_add', $data);
        $this->load->view('admin/footer');
    }
    public function edit($id)
    {
        $data['images'] = $this->imagemodel->getFirstRowWhere('images',array('id'=>$id));
        //        print_r($data['images']);

        $config['upload_path'] = './upload/img/banner/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '4000';
        $config['max_width']     = '3000';
        $config['max_height']    = '2000';
        $this->load->library('upload', $config);


        if (isset($_POST['upload'])) {
            $title = $this->input->post('title');
            $type = $this->input->post('type');
            $url = $this->input->post('url');
            $target = $this->input->post('target');

            $item = array('type' => $type,
                'url' => $url,
                'target' => $target,
                'title' => $title,
                'cate' => $this->input->post('cate')
            );
            $this->imagemodel->Update_where('images', array('id'=>$id),$item);

            if ($_FILES['userfile']['size'] >0) {
                if (!$this->upload->do_upload('userfile')) {
                    $data['error'] = 'Ảnh không hợp lệ!';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/banner/' . $upload['upload_data']['file_name'];

                    $arr=array('link' => $image);

                    $this->imagemodel->Update_where('images', array('id'=>$id),$arr);
                }
            }
            redirect(base_url('admin/imageupload/banner'));
        }
        $data['procate'] = $this->imagemodel->getList('product_category');
        $data['error'] = @$error;

        $data['headerTitle'] = "Cập nhật banner";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/banner_edit', $data);
        $this->load->view('admin/footer');
    }

}

?>