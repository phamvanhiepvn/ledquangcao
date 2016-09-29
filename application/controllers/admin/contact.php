<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller
{
    protected $module_name="Menu";
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('contact_model');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();

        $this->Check_module($this->module_name);
    }

    public function contact_list()
    {

        $config['base_url']    = base_url('admin/contact/list');
        $config['total_rows']  = $this->contact_model->count_All('contact'); // xác định tổng số record
        $config['per_page']    = 15; // xác định số record ở mỗi trang
        $config['uri_segment'] = 4; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data              = array();
        $data['list']  = $this->contact_model->listAll('contact',$config['per_page'], $this->uri->segment(4));


        $data['headerTitle'] = 'Liên hệ';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/contact_list', $data);
        $this->load->view('admin/footer');
    }

    //ajax
    public function popupdata()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {

            $id   = $_GET['id'];
            $item = $this->contact_model->getFirstRowWhere('contact', array('id' => $id));
            if($item->show==0){
                $this->contact_model->Update_where('contact',array('id'=>$id),array('show'=>1));
            }

                echo '

                        <div class="col-xs-2">
                            <p>Họ tên:</p>
                        </div>
                        <div class="col-xs-3">
                            <p>'.@$item->full_name.'</p>
                        </div>

                        <div class="col-xs-2">
                            <p>Điện thoại:</p>
                        </div>
                        <div class="col-xs-3">
                            <p>'.@$item->phone.' </p>
                        </div>
                    <div class="clear"></div>

                        <div class="col-xs-2">
                            <p>Email:</p>
                        </div>
                        <div class="col-xs-3">
                            <p> '.@$item->email.'</p>
                        </div>
                    <div class="clear"></div>

                        <div class="col-xs-2">
                            <p>Địa chỉ:</p>
                        </div>
                        <div class="col-xs-3">
                            <p>'.@$item->address.' </p>
                        </div>
                    <div class="clear"></div>

                        <div class="col-xs-2">
                            <p>Nội dung:</p>
                        </div>
                        <div class="col-xs-3">
                            <p> '.@$item->comment.'</p>
                        </div>
                ';
        }
    }


    //Delete Menu
    public function Delete($id){
        $this->contact_model->Delete('contact',$id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_show(){
        if($this->input->post('contact')!=0){
            $this->contact_model->Update_where('contact',array('id'=>$this->input->post('contact')),array('show'=>1));
            echo 1;
        }
        if($this->input->post('id_contact')!=0){
            $item= $this->contact_model->GetFirstRowWhere('contact',array('id'=>$this->input->post('id_contact')));
            if($item->mark==0){
                $this->contact_model->Update_where('contact',array('id'=>$this->input->post('id_contact')),array('mark'=>1));
                echo 1;
            }
            if($item->mark==1){
                $this->contact_model->Update_where('contact',array('id'=>$this->input->post('id_contact')),array('mark'=>0));
                echo 0;
            }
        }
    }

    public function promoList()
    {
        $config['base_url'] = base_url('admin/contact/promo-list');
        $config['total_rows'] = $this->contact_model->count_All('promotion'); // xác định tổng số record
        $config['per_page'] = 10; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data = array();
        $data['lists'] = $this->contact_model->listAll('promotion',$config['per_page'], $this->uri->segment(3));
        $data['headerTitle'] = 'Quản lý khuyến mại';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/promo_list', $data);
        $this->load->view('admin/footer');
    }
    public function promoAdd($id = null)
    {
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

        if ($id != null) {
            $data['item']  = $this->contact_model->getFirstRowWhere('promotion',array('id'=>$id));
            //            print_r($data['item']);
        }
        if(isset($_POST['addpage'])){

            if($_POST['Id_Edit']){
            $name = $this->input->post('name');
            $alias = make_alias($name);
            $description = $this->input->post('description');
            $content = $this->input->post('content');
            $status = $this->input->post('status');
            if($_FILES['userfile']['name'] != ''){
                if(! $this->upload->do_upload()){
                    $data['error'] = 'Ảnh không thỏa mãn';
                }else{
                    $upload= array('upload_data' => $this->upload->data());
                    $image = 'upload/img/'.$upload['upload_data']['file_name'];

                    $new = array(
                        'name'=>$name,
                        'description'=>$description,
                        'content'=>$content ,
                        'image'=>$image,
                        'status' => $status
                    );
                    $this->contact_model->Update('promotion',$id,$new);
                    @unlink($data['item']->image);
                    redirect(base_url('admin/contact/promo-list'));
                }
            }else{
                $new = array('name'=>$name,'description'=>$description,'content'=>$content,'status' => $status);

                $this->contact_model->Update('promotion',$id,$new);

                redirect(base_url('admin/contact/promo-list'));
                }
            }
            else{
                    $name = $this->input->post('name');
                    $alias = make_alias($name);
                    $description = $this->input->post('description');
                    $content = $this->input->post('content');
                    $status = $this->input->post('status');
                    if($_FILES['userfile']['name'] != ''){
                        if(! $this->upload->do_upload()){
                            $data['error'] = 'Ảnh không thỏa mãn';
                        }else{
                            $upload= array('upload_data' => $this->upload->data());
                            $image = 'upload/img/'.$upload['upload_data']['file_name'];

                            $page = array(
                                'name'=>$name,
                                'description'=>$description,
                                'content'=>$content ,
                                'image'=>$image,
                                'status' => $status
                            );
                            $id_page = $this->contact_model->Add('promotion',$page);

                            if(isset($id_page))

                                redirect(base_url('admin/contact/promo-list'));
                        }
                    }else{
                        $page = array('name'=>$name,'description'=>$description,'content'=>$content,'status' => $status);
                        //echo "<pre>";var_dump($page);die();
                        $id_page = $this->contact_model->Add('promotion',$page);

                        if(isset($id_page))
                            redirect(base_url('admin/contact/promo-list'));
                    }
            }
        }
        $data['headerTitle']="Thêm khuyến mại";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/promo_add',$data);
        $this->load->view('admin/footer');
    }
    public function promoDelete($id)
    {
        $item = $this->contact_model->getItemByID('promotion',$id);
        $check = $this->contact_model->Delete('promotion',$id);
        if($check)
        {
            @unlink($item->image);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}