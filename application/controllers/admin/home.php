<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
    protected $module_name = "Home";

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('staticpagemodel');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();
        $this->Check_module($this->module_name);
        $this->load->helper('ckeditor_helper');
        $this->load->helper('model_helper');
    }

    public function index()
    {

        $config['upload_path'] = './upload/img/homepage/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '1000';
        $config['max_width'] = '1424';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);

        $data = array();
        $data['headerTitle'] = "Manager homepage";
        $data['home'] = $this->staticpagemodel->get_data("pagehome");

        $textHead = $this->input->post('text_head');
        $textMiddle = $this->input->post('text_middle');
        $description = $this->input->post('description');

        $column_top_1_text = $this->input->post('column_top_1_text');
        $column_top_1_content = $this->input->post('column_top_1_content');

        $column_top_2_text = $this->input->post('column_top_2_text');
        $column_top_2_content = $this->input->post('column_top_2_content');

        $column_top_3_text = $this->input->post('column_top_3_text');
        $column_top_3_content = $this->input->post('column_top_3_content');


        $column_top_4_text = $this->input->post('column_top_4_text');
        $column_top_4_content = $this->input->post('column_top_4_content');

        $column_bot_1_icon = $this->input->post('column_bot_1_icon');
        $column_bot_1_text = $this->input->post('column_bot_1_text');
        $column_bot_1_content = $this->input->post('column_bot_1_content');

        $column_bot_2_icon = $this->input->post('column_bot_2_icon');
        $column_bot_2_text = $this->input->post('column_bot_2_text');
        $column_bot_2_content = $this->input->post('column_bot_2_content');

        $column_bot_3_icon = $this->input->post('column_bot_3_icon');
        $column_bot_3_text = $this->input->post('column_bot_3_text');
        $column_bot_3_content = $this->input->post('column_bot_3_content');

        $column_bot_4_icon = $this->input->post('column_bot_4_icon');
        $column_bot_4_text = $this->input->post('column_bot_4_text');
        $column_bot_4_content = $this->input->post('column_bot_4_content');

        $array = array(
            'text_head' => $textHead,
            'text_middle' => $textMiddle,
            'description' => $description,
            'column_top_1_text' => $column_top_1_text,
            'column_top_1_content' => $column_top_1_content,
            'column_top_2_text' => $column_top_2_text,
            'column_top_2_content' => $column_top_2_content,
            'column_top_3_text' => $column_top_3_text,
            'column_top_3_content' => $column_top_3_content,
            'column_top_4_text' => $column_top_4_text,
            'column_top_4_content' => $column_top_4_content,

            'column_bot_1_icon' => $column_bot_1_icon,
            'column_bot_1_text' => $column_bot_1_text,
            'column_bot_1_content' => $column_bot_1_content,
            'column_bot_2_icon' => $column_bot_2_icon,
            'column_bot_2_text' => $column_bot_2_text,
            'column_bot_2_content' => $column_bot_2_content,
            'column_bot_3_icon' => $column_bot_3_icon,
            'column_bot_3_text' => $column_bot_3_text,
            'column_bot_3_content' => $column_bot_3_content,
            'column_bot_4_icon' => $column_bot_4_icon,
            'column_bot_4_text' => $column_bot_4_text,
            'column_bot_4_content' => $column_bot_4_content
        );

        $id = $data['home']->id;

        if(isset($id) && $id!=null){

            $data['editpage']=$id;
        }

        if (isset($_POST['addpage'])) {

            if(isset($_POST['editpage']) && $_POST['editpage']!=null){
                $this->staticpagemodel->Update_where('pagehome',array('id'=>$_POST['editpage']), $array);
            }else{
                $id = $this->staticpagemodel->Add('pagehome', $array);
            }

            $arrayUpdate = array();

            if ($_FILES['column_top_1_icon']['name'] != '') {
                if (!$this->upload->do_upload('column_top_1_icon')) {
                    $data['error'] = 'Ảnh lớn hơn kích cho phép hoặc không đúng định dạng';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $column_top_1_icon = 'upload/img/homepage/' . $upload['upload_data']['file_name'];

                }
            }
            if ($_FILES['column_top_2_icon']['name'] != '') {
                if (!$this->upload->do_upload('column_top_2_icon')) {
                    $data['error'] = 'Ảnh lớn hơn kích cho phép hoặc không đúng định dạng';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $column_top_2_icon = 'upload/img/homepage/' . $upload['upload_data']['file_name'];
                }
            }
            if ($_FILES['column_top_3_icon']['name'] != '') {
                if (!$this->upload->do_upload('column_top_3_icon')) {
                    $data['error'] = 'Ảnh lớn hơn kích cho phép hoặc không đúng định dạng';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $column_top_3_icon = 'upload/img/homepage/' . $upload['upload_data']['file_name'];
                }
            }
            if ($_FILES['column_top_4_icon']['name'] != '') {
                if (!$this->upload->do_upload('column_top_4_icon')) {
                    $data['error'] = 'Ảnh lớn hơn kích cho phép hoặc không đúng định dạng';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $column_top_4_icon = 'upload/img/homepage/' . $upload['upload_data']['file_name'];

                }
            }
            if (!empty($column_top_1_icon)) {
                $arrayColumn1 = array('column_top_1_icon' => $column_top_1_icon);
                $arrayUpdate = array_merge($arrayUpdate, $arrayColumn1);
            }
            if (!empty($column_top_2_icon)) {
                $arrayColumn2 = array('column_top_2_icon' => $column_top_2_icon);
                $arrayUpdate = array_merge($arrayUpdate, $arrayColumn2);
            }
            if (!empty($column_top_3_icon)) {
                $arrayColumn3 = array('column_top_3_icon' => $column_top_3_icon);
                $arrayUpdate = array_merge($arrayUpdate, $arrayColumn3);
            }
            if (!empty($column_top_4_icon)) {
                $arrayColumn4 = array('column_top_4_icon' => $column_top_4_icon);
                $arrayUpdate = array_merge($arrayUpdate, $arrayColumn4);
            }
            if (!empty($arrayUpdate)) {
                $this->staticpagemodel->Update_where('pagehome', array('id' => $id), $arrayUpdate);
                redirect(base_url('admin/home/index'));
            }else{
                redirect(base_url('admin/home/index'));
            }



        }

        $this->load->view('admin/header', $data);
        $this->load->view('admin/home', $data);
        $this->load->view('admin/footer');
    }
    public function about()
    {

        $config['upload_path'] = './upload/img/about/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1424';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);


        $data = array();
        $data['headerTitle'] = "Manager about";

        $data['home'] = $this->staticpagemodel->get_data("pageabout");

        $textHead = $this->input->post('text_head');
        $textMiddle = $this->input->post('text_middle');
        $description = $this->input->post('description');

        $column_top_1_text = $this->input->post('column_top_1_text');
        $column_top_1_content = $this->input->post('column_top_1_content');



        $column_bot_1_text = $this->input->post('column_bot_1_text');
        $column_bot_1_content = $this->input->post('column_bot_1_content');


        $column_bot_2_text = $this->input->post('column_bot_2_text');
        $column_bot_2_content = $this->input->post('column_bot_2_content');


        $column_bot_3_text = $this->input->post('column_bot_3_text');
        $column_bot_3_content = $this->input->post('column_bot_3_content');



        $array = array(
            'text_head' => $textHead,
            'text_middle' => $textMiddle,
            'description' => $description,
            'column_top_1_icon' => "",
            'column_top_1_text' => $column_top_1_text,
            'column_top_1_content' => $column_top_1_content,

            'column_bot_1_text' => $column_bot_1_text,
            'column_bot_1_content' => $column_bot_1_content,

            'column_bot_2_text' => $column_bot_2_text,
            'column_bot_2_content' => $column_bot_2_content,

            'column_bot_3_text' => $column_bot_3_text,
            'column_bot_3_content' => $column_bot_3_content,

        );
        if(!empty($data['home'])){
            $id = $data['home']->id;
        }


        if(isset($id) && $id!=null){

            $data['editpage']=$id;
        }

        if (isset($_POST['addpage'])) {


            if(isset($_POST['editpage']) && $_POST['editpage']!=null ){
                $this->staticpagemodel->Update_where('pageabout',array('id'=>$_POST['editpage']), $array);
            }else{
                $id = $this->staticpagemodel->Add('pageabout', $array);
            }


            $arrayUpdate = array();

            if ($_FILES['column_top_1_icon']['name'] != '') {
                if (!$this->upload->do_upload('column_top_1_icon')) {
                    $data['error'] = 'Ảnh lớn hơn kích cho phép hoặc không đúng định dạng';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $column_top_1_icon = 'upload/img/about/' . $upload['upload_data']['file_name'];

                }
            }

            if (!empty($column_top_1_icon)) {
                $arrayColumn1 = array('column_top_1_icon' => $column_top_1_icon);
                $arrayUpdate = array_merge($arrayUpdate, $arrayColumn1);
            }

            if (!empty($arrayUpdate)) {
                $this->staticpagemodel->Update_where('pageabout', array('id' => $id), $arrayUpdate);
                redirect(base_url('admin/home/about'));
            }else{
                redirect(base_url('admin/home/about'));
            }



        }

        $this->load->view('admin/header', $data);
        $this->load->view('admin/about', $data);
        $this->load->view('admin/footer');
    }
    public function skill_list()
    {
        $config['base_url'] = base_url('admin/skill-list');
        $config['total_rows'] = $this->staticpagemodel->count_All('skill'); // xác định tổng số record
        $config['per_page'] = 10; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data = array();
        $data['lists'] = $this->staticpagemodel->listAll('skill',$config['per_page'], $this->uri->segment(3));


        $data['headerTitle'] = "Manager skill";

        $this->load->view('admin/header', $data);
        $this->load->view('admin/skill_list', $data);
        $this->load->view('admin/footer');
    }

    public function skill_add($id=null)
    {
        $data = array();
        if ($id != null) {
            $data['item']  = $this->staticpagemodel->getFirstRowWhere('skill',array('id'=>$id));

        }
        $name = $this->input->post('name');
        $value = $this->input->post('value');

        $array = array(
            'name'=>$name,
            'value'=>$value
        );
        if(isset($_POST['addpage'])){

            if($_POST['Id_Edit']){
                if(isset($id) && $id!=null){
                    $this->staticpagemodel->Update('skill',$id,$array);
                    redirect(base_url('admin/skill'));
                }
            }
            else{
                $array['type'] = 1;
                $idPage = $this->staticpagemodel->Add('skill',$array);
                if($idPage){
                    redirect(base_url('admin/skill'));
                }
                }
            }



        $data['headerTitle'] = "Add skill";

        $this->load->view('admin/header', $data);
        $this->load->view('admin/skill_add', $data);
        $this->load->view('admin/footer');
    }
    public function service()
    {

        $data = array();
        $data['headerTitle'] = "Manager service";

        $data['home'] = $this->staticpagemodel->get_data("pageservice");

        $textHead = $this->input->post('text_head');
        $textMiddle = $this->input->post('text_middle');
        $description = $this->input->post('description');

        $column_top_1_icon = $this->input->post('column_top_1_icon');
        $column_top_1_text = $this->input->post('column_top_1_text');
        $column_top_1_content = $this->input->post('column_top_1_content');

        $column_top_2_icon = $this->input->post('column_top_2_icon');
        $column_top_2_text = $this->input->post('column_top_2_text');
        $column_top_2_content = $this->input->post('column_top_2_content');

        $column_top_3_icon = $this->input->post('column_top_3_icon');
        $column_top_3_text = $this->input->post('column_top_3_text');
        $column_top_3_content = $this->input->post('column_top_3_content');

        $column_top_4_icon = $this->input->post('column_top_4_icon');
        $column_top_4_text = $this->input->post('column_top_4_text');
        $column_top_4_content = $this->input->post('column_top_4_content');

        $column_top_5_icon = $this->input->post('column_top_5_icon');
        $column_top_5_text = $this->input->post('column_top_5_text');
        $column_top_5_content = $this->input->post('column_top_5_content');

        $column_top_6_icon = $this->input->post('column_top_6_icon');
        $column_top_6_text = $this->input->post('column_top_6_text');
        $column_top_6_content = $this->input->post('column_top_6_content');

        $column_top_7_icon = $this->input->post('column_top_7_icon');
        $column_top_7_text = $this->input->post('column_top_7_text');
        $column_top_7_content = $this->input->post('column_top_7_content');

        $column_top_8_icon = $this->input->post('column_top_8_icon');
        $column_top_8_text = $this->input->post('column_top_8_text');
        $column_top_8_content = $this->input->post('column_top_8_content');

        $column_top_9_icon = $this->input->post('column_top_9_icon');
        $column_top_9_text = $this->input->post('column_top_9_text');
        $column_top_9_content = $this->input->post('column_top_9_content');


        $array = array(
            'text_head' => $textHead,
            'text_middle' => $textMiddle,
            'description' => $description,
            'column_top_1_icon' =>    $column_top_1_icon,
            'column_top_1_text' =>    $column_top_1_text,
            'column_top_1_content' => $column_top_1_content,
            'column_top_2_icon' =>    $column_top_2_icon,
            'column_top_2_text' =>    $column_top_2_text,
            'column_top_2_content' => $column_top_2_content,
            'column_top_3_icon' =>    $column_top_3_icon,
            'column_top_3_text' =>    $column_top_3_text,
            'column_top_3_content' => $column_top_3_content,
            'column_top_4_icon' =>    $column_top_4_icon,
            'column_top_4_text' =>    $column_top_4_text,
            'column_top_4_content' => $column_top_4_content,
            'column_top_5_icon' =>    $column_top_5_icon,
            'column_top_5_text' =>    $column_top_5_text,
            'column_top_5_content' => $column_top_5_content,
            'column_top_6_icon' =>    $column_top_6_icon,
            'column_top_6_text' =>    $column_top_6_text,
            'column_top_6_content' => $column_top_6_content,
            'column_top_7_icon' =>    $column_top_7_icon,
            'column_top_7_text' =>    $column_top_7_text,
            'column_top_7_content' => $column_top_7_content,
            'column_top_8_icon' =>    $column_top_8_icon,
            'column_top_8_text' =>    $column_top_8_text,
            'column_top_8_content' => $column_top_8_content,
            'column_top_9_icon' =>    $column_top_9_icon,
            'column_top_9_text' =>    $column_top_9_text,
            'column_top_9_content' => $column_top_9_content,


        );
        if(!empty($data['home'])){
            $id = $data['home']->id;
        }


        if(isset($id) && $id!=null){

            $data['editpage']=$id;
        }

        if (isset($_POST['addpage'])) {


            if(isset($_POST['editpage']) && $_POST['editpage']!=null ){
                $this->staticpagemodel->Update_where('pageservice',array('id'=>$_POST['editpage']), $array);
                redirect(base_url('admin/home/service'));
            }else{
                $id = $this->staticpagemodel->Add('pageservice', $array);
                redirect(base_url('admin/home/service'));
            }






        }

        $this->load->view('admin/header', $data);
        $this->load->view('admin/service', $data);
        $this->load->view('admin/footer');
    }
}