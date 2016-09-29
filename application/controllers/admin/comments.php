<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends MY_Controller
{
    protected $module_name="Menu";
    function __construct()
    {
        parent::__construct();
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

}