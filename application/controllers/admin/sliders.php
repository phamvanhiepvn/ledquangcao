<?php
class Sliders extends MY_Controller
{
    protected $module_name="Sliders";
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
        $config['base_url'] = base_url('admin/sliders');
        $config['total_rows'] = $this->imagemodel->count_All('sliders'); // xác ??nh t?ng s? record
        $config['per_page'] = 15; // xác ??nh s? record ? m?i trang
        $config['uri_segment'] = 3; // xác ??nh segment ch?a page number
        $this->pagination->initialize($config);
        $data = array();
        $data['imagelist'] = $this->imagemodel->listAll('sliders', $config['per_page'], $this->uri->segment(3));


        $data['headerTitle'] = "Quản lý Sliders";

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sliders', $data);
        $this->load->view('admin/footer');
    }



    //Delete Image
    public function delete($id)
    {
        $img = $this->imagemodel->getItemByID('sliders', $id);

        if(file_exists($img->link)){
            unlink(($img->link)); //die(base_url($img->link));
        }

        $this->imagemodel->Delete('sliders', $id);

        redirect($_SERVER['HTTP_REFERER']);
    }



    //add banner
    public function add($id=null)
    {

        $config['upload_path'] = './upload/img/sliders/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1424';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);


        $type = $this->input->post('type');
        $url = $this->input->post('url');
        $video = $this->input->post('video');

        $icon1 = $this->input->post('icon1');
        $icon2 = $this->input->post('icon2');
        $icon3 = $this->input->post('icon3');
        $icon4 = $this->input->post('icon4');
        $icon5 = $this->input->post('icon5');

        $text1 = $this->input->post('text1');
        $text2 = $this->input->post('text2');
        $text3 = $this->input->post('text3');
        $text4 = $this->input->post('text4');
        $text5 = $this->input->post('text5');

        $array  = array(
            'type'=>$type,
            'url'=>$url,
            'video_url'=>$video,
            'icon1'=>$icon1,
            'icon2'=>$icon2,
            'icon3'=>$icon3,
            'icon4'=>$icon4,
            'icon5'=>$icon5,
            'text1'=>$text1,
            'text2'=>$text2,
            'text3'=>$text3,
            'text4'=>$text4,
            'text5'=>$text5,

        );

        if($id>0){
            $data['edit']=$this->imagemodel->getFirstRowWhere('sliders',array('id'=>$id));
        }
        if (isset($_POST['upload'])) {
            if(isset($_POST['edit_id'])){
                $this->imagemodel->Update_where('sliders',array('id'=>$_POST['edit_id']), $array);
            }else{

                $id = $this->imagemodel->Add('sliders', $array);
            }

            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh lớn hơn kích cho phép hoặc không đúng định dạng';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/sliders/' . $upload['upload_data']['file_name'];

                    if(file_exists($image)){
                        if(file_exists(@$data['edit']->link)){
                            unlink($data['edit']->link);
                        }
                    }
                    $array = array(
                        'img_url' => $image,
                    );
                    $this->imagemodel->Update_where('sliders',array('id'=>$id), $array);
                }
            }redirect(base_url('admin/sliders'));
        }


        $data['headerTitle'] = "Thêm sliders";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sliders_add', $data);
        $this->load->view('admin/footer');
    }
    public function edit($id)
    {
        $data['images'] = $this->imagemodel->getFirstRowWhere('sliders',array('id'=>$id));
        //        print_r($data['images']);

        $config['upload_path'] = './upload/img/sliders/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '5000';
        $config['max_width'] = '3000';
        $config['max_height'] = '1000';
        $this->load->library('upload', $config);

        $type = $this->input->post('type');
        $url = $this->input->post('url');
        $video = $this->input->post('video');

        $icon1 = $this->input->post('icon1');
        $icon2 = $this->input->post('icon2');
        $icon3 = $this->input->post('icon3');
        $icon4 = $this->input->post('icon4');
        $icon5 = $this->input->post('icon5');

        $text1 = $this->input->post('text1');
        $text2 = $this->input->post('text2');
        $text3 = $this->input->post('text3');
        $text4 = $this->input->post('text4');
        $text5 = $this->input->post('text5');

        $array  = array(
            'type'=>$type,
            'url'=>$url,
            'video_url'=>$video,
            'icon1'=>$icon1,
            'icon2'=>$icon2,
            'icon3'=>$icon3,
            'icon4'=>$icon4,
            'icon5'=>$icon5,
            'text1'=>$text1,
            'text2'=>$text2,
            'text3'=>$text3,
            'text4'=>$text4,
            'text5'=>$text5,
        );

        if (isset($_POST['upload'])) {
            $this->imagemodel->Update_where('sliders', array('id'=>$id),$array);
            if ($_FILES['userfile']['size'] >0) {
                if (!$this->upload->do_upload('userfile')) {
                    $data['error'] = 'Ảnh không hợp lệ!';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/sliders/' . $upload['upload_data']['file_name'];
                    $array=array('img_url' => $image);

                    $this->imagemodel->Update_where('sliders', array('id'=>$id),$array);
                }
            }
            redirect(base_url('admin/sliders'));
        }


        $data['headerTitle'] = "Cập nhật sliders";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sliders_edit', $data);
        $this->load->view('admin/footer');
    }

}

?>