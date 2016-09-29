<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Staticpage extends MY_Controller
{
    protected $module_name="Staticpage";
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('staticpagemodel');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();
        $this->Check_module($this->module_name);
    }
    public function staticpagelist(){
        $config['base_url'] = base_url('admin/manager-page');
        $config['total_rows'] = $this->staticpagemodel->count_All('staticpage'); // xác định tổng số record
        $config['per_page'] = 10; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data = array();
        $data['pagelist'] = $this->staticpagemodel->listAll('staticpage',$config['per_page'], $this->uri->segment(3));
        $data['headerTitle']="Danh sách trang tĩnh";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/staticpage_list',$data);
        $this->load->view('admin/footer');
    }
    public function addpage(){
        $this->load->helper('ckeditor_helper');
        $this->load->helper('model_helper');
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor',
            'path' => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "800px", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ));
        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '1000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $this->load->library('upload', $config);


        if(isset($_POST['addpage'])){
            $name = $this->input->post('name');
            $alias = make_alias($name);
            $description = $this->input->post('description');
            $content = $this->input->post('content');
            if($_FILES['userfile']['name'] != ''){
                if(! $this->upload->do_upload()){
                    $data['error'] = 'Ảnh không thỏa mãn';
                }else{
                    $upload= array('upload_data' => $this->upload->data());
                    $image = 'upload/img/'.$upload['upload_data']['file_name'];

                    $page = array('name'=>$name,'description'=>$description,'content'=>$content ,'icon'=>$image,'alias'=>$alias);
                    $id_page = $this->staticpagemodel->Add('staticpage',$page);

                    if(isset($id_page))
                    redirect(base_url('admin/manager-page'));
                }
            }else{
                $page = array('name'=>$name,'description'=>$description,'content'=>$content ,'alias'=>$alias);
                $id_page = $this->staticpagemodel->Add('staticpage',$page);

                if(isset($id_page))
                    redirect(base_url('admin/manager-page'));
            }
        }
        $data['headerTitle']="Thêm trang tĩnh";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/staticpage_add',$data);
        $this->load->view('admin/footer');
    }
    public function editpage($id){
        $this->load->helper('ckeditor_helper');
        $this->load->helper('model_helper');
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor',
            'path' => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "800px", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ));
        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '1000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $this->load->library('upload', $config);

        $page=$this->staticpagemodel->getItemByID('staticpage',$id);
        if(isset($_POST['editpage'])){
            $name = $this->input->post('name');
            $alias = make_alias($name);
            $description = $this->input->post('description');
            $content = $this->input->post('content');
            if($_FILES['userfile']['name'] != ''){
                if(! $this->upload->do_upload()){
                    $data['error'] = 'Ảnh không thỏa mãn';
                }else{
                    $upload= array('upload_data' => $this->upload->data());
                    $image = 'upload/img/'.$upload['upload_data']['file_name'];

                    $new = array('name'=>$name,'description'=>$description,'content'=>$content ,'icon'=>$image,'alias'=>$alias);
                    $this->staticpagemodel->Update('staticpage',$id,$new);

                    redirect(base_url('admin/manager-page'));
                }
            }else{
                $new = array('name'=>$name,'description'=>$description,'content'=>$content ,'alias'=>$alias);

                $this->staticpagemodel->Update('staticpage',$id,$new);

                redirect(base_url('admin/manager-page'));;
            }
        }
        $data['page']=$page;
        $data['headerTitle']="Sửa trang ".$page->name;
        $this->load->view('admin/header',$data);
        $this->load->view('admin/staticpage_edit',$data);
        $this->load->view('admin/footer');
    }
    public function deletepage($id){
        $this->staticpagemodel->Delete('staticpage',$id);
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function  listCustomer()
    {
        $data['list'] = $this->staticpagemodel->getList('customer');
        $data['headerTitle'] = 'Quản khách hàng';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/customer_list', $data);
        $this->load->view('admin/footer');
    }
    public function addCustomer($id = null)
    {
        $config['upload_path'] = './upload/img/banner/';
        $config['allowed_types'] = 'gif|jpg|png|PNG';
        $config['max_size'] = '3000';
        $config['max_width'] = '2424';
        $config['max_height'] = '1768';
        $this->load->library('upload', $config);

        if($id !=null){
            $data['edit']=$this->staticpagemodel->getFirstRowWhere('customer',array('id'=>$id));
            //            print_r($data['edit']);
            $data['id_edit'] =$id;
        }
        if (isset($_POST['upload'])) {
            $title = $this->input->post('title');
            $name = $this->input->post('name');
            $url = $this->input->post('link');
            //$target = $this->input->post('target');
            if($_POST['id_edit']){
               //die('sfsf');
                $item = array(
                    'name' => $name,
                    'title' => $title,
                );
                $this->staticpagemodel->Update_where('customer',array('id'=>$_POST['id_edit']), $item);
            }else{
                $item = array(
                    'name' => $name,
                    'title' => $title,
                );
                $id = $this->staticpagemodel->Add('customer', $item);
            }

            if ($_FILES['userfile']['name'] != '') {

                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh lớn hơn kích cho phép hoặc không đúng định dạng';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/banner/' . $upload['upload_data']['file_name'];
                    if(file_exists($image)){
                        if(file_exists(@$data['edit']->image)){
                            unlink($data['edit']->image);
                        }
                    }
                    $item = array(
                        'image' => $image,
                    );
                    $this->staticpagemodel->Update_where('customer',array('id'=>$id), $item);
                }
            }redirect(base_url('admin/danh-sach-khach-hang'));
        }
        //        $data['error'] = @$error;
        $data['headerTitle'] = "Cập nhật khách hàng";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/customer_add', $data);
        $this->load->view('admin/footer');
    }
    public function deleteCustomer($id)
    {
        $img = $this->staticpagemodel->getItemByID('customer', $id);

        if(file_exists($img->image)){
            unlink(($img->image)); //die(base_url($img->link));
        }

        $this->staticpagemodel->Delete('customer', $id);

        redirect($_SERVER['HTTP_REFERER']);
    }

}