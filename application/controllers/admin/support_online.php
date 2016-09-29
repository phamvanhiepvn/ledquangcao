<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Support_online extends MY_Controller
{
    protected $module_name = "Support_online";

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('support_online_model');
        $this->auth = new Auth();
        $this->auth->check();

        $this->Check_module($this->module_name);
    }

    public function index($id = null)
    {
        $this->load->helper('model_helper');
        $config['upload_path'] = './upload/img/user_post/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '5000';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';
        $this->load->library('upload', $config);

        if ($id != null) {
            $data['item']  = $this->support_online_model->getFirstRowWhere('support_online',array('id'=>$id));
//            print_r($data['item']);
        }
        if(isset($_POST['Update'])){
            if($_POST['Id_Edit']){
                //update
                $arr=array(
                    'name'=>$this->input->post('name'),
                    'phone'=>$this->input->post('phone'),
                    'skype'=>$this->input->post('skype'),
                    'email'=>$this->input->post('email'),
                    'yahoo'=>$this->input->post('yahoo'),
                    'active'=>$this->input->post('active'),
                    'type'=>$this->input->post('type'),
                );
                $this->support_online_model->Update_where('support_online',array('id'=>$id),$arr);
                /*redirect($_SERVER['HTTP_REFERER']);*/
                if ($_FILES['userfile']['name'] != '') {
                    if (!$this->upload->do_upload()) {
                        $data['error'] = 'Ảnh không thỏa mãn';
                    } else {
                        $upload = array('upload_data' => $this->upload->data());
                        $image = 'upload/img/user_post/' . $upload['upload_data']['file_name'];
                        $this->support_online_model->Update('support_online', $id, array('image' => $image,));
                        if(isset($data['item'])&&file_exists($data['item']->image)){
                            unlink($data['item']->image);
                        }
                    }
                }
            }else{
                /*die('here');*/
                //add
                $arr=array(
                    'name'=>$this->input->post('name'),
                    'phone'=>$this->input->post('phone'),
                    'skype'=>$this->input->post('skype'),
                    'email'=>$this->input->post('email'),
                    'yahoo'=>$this->input->post('yahoo'),
                    'active'=>$this->input->post('active'),
                    'type'=>$this->input->post('type'),
                );
                $this->support_online_model->Add('support_online',$arr);
                /*redirect($_SERVER['HTTP_REFERER']);*/
            }
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/user_post/' . $upload['upload_data']['file_name'];
                    $this->support_online_model->Update('support_online', $id, array('image' => $image,));
                    if(isset($data['item'])&&file_exists($data['item']->image)){
                        unlink($data['item']->image);
                    }
                }
            }

            /*redirect($_SERVER['HTTP_REFERER']);*/
            redirect(base_url('admin/support-online-list'));
        }
        $data['list']  = $this->support_online_model->getList('support_online');
        $data['headerTitle'] = 'Support online';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/support_online', $data);
        $this->load->view('admin/footer');
    }

    public function listSuport()
    {
        $data['list']  = $this->support_online_model->getList('support_online');
        $data['headerTitle'] = 'Support online';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/support_online_list', $data);
        $this->load->view('admin/footer');
    }


    //Delete Menu
    public function Delete($id){
        $this->support_online_model->Delete('support_online',$id);
        redirect($_SERVER['HTTP_REFERER']);
    }

}