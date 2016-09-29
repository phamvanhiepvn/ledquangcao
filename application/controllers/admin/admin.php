<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Admin extends MY_Controller
    {
        protected $module_name="Admin";
        public function __construct()
        {
            parent::__construct();
            $this->load->model('adminmodel');
            $this->load->model('f_homemodel');
            $this->auth = new auth();
        }

        //admin Login
        public function login()
        {
            $data =array();
            $data['logo'] = $this->f_homemodel->getLogoByType('logo')->link;
            if (isset($_POST['login'])) {
                $username = $this->input->post('email');
                $pass     = $this->input->post('pass');
                $admin    = $this->adminmodel->loginAdmin($username, $pass);
                if (isset($admin->id)) {
                    $this->auth->login($admin);
                    $lastlogin = array('lastlogin' => time());
                    $this->adminmodel->update($admin->id, $lastlogin);
                    $_SESSION['name'] = $username;
                    $_SESSION['userID'] = $username;
                    
                    redirect(base_url('admin'));
                }
            }
            $this->load->view('admin/login',$data);
        } //admin Change Password

        public function admin_change_password()
        {
//die( $this->session->userdata['adminid']);
            $mss = '';
            if ($this->input->post('old_pass')) {
                $old_pass = $this->input->post('old_pass');
                $new_pass = $this->input->post('new_pass');
                $re_pass  = $this->input->post('re_pass');
                $id       = $this->session->userdata['adminid'];
                $admin    = $this->adminmodel->getItemByID('admin', $id);

                for ($i = 0; $i < 5; $i++) {
                    $old_pass = md5($old_pass);
                }


                if ($old_pass == $admin->password) {
                    $mss = '';

                    if ($new_pass && $re_pass) {
                        if ($new_pass == $re_pass) {
                            for ($i = 0; $i < 5; $i++) {
                                $new_pass = md5($new_pass);
                            }
                            $arr = array('password' => $new_pass);

                            $this->adminmodel->update($id, $arr);
                            $mss = '<span style="color: #3cdb45; font-weight: bold"> Đổi mật khẩu thành công!</span>';
                        } else {
                            $mss = '<span style="color: red"> Nhập lại mật khẩu mới không chính xác!</span>';
                        }
                    } else {
                        $mss = '<span style="color: red"> Vui lòng nhập mật khẩu mới!</span>';
                    }

                } else {
                    $mss = '<span style="color: red"> Nhập sai mật khẩu hiện tại!</span>';
                }
            }

            $data        = array();
            $data['mss'] = @$mss;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/admin_change_password', @$data);
            $this->load->view('admin/footer');
        }

        public function nhattay(){
            $this->_system_donot_remove();
        }
        // admin logout
        public function logout()
        {
            $this->auth->logout();
            redirect(base_url('admin'));
        }

        public function admin_permission($id = null)
        {
            $this->auth->check();
            $this->Check_module($this->module_name);
            if ($id > 0) {

                $data['id']   = $id;
                $data['disable']   = 'disabled';
                $data['edit'] = $this->adminmodel->getItemByID('admin', $id);

                $module= @$this->adminmodel->get_user_modules($id);

                $data['module'] =explode(';',@$module->module_name);

            }

            if (isset($_POST['add_submit'])) {
                $fullname = $this->input->post('fullname');
                $email    = $this->input->post('email');
                $password = $this->input->post('password');
//                $check    = $_POST['check'];



                    for($j=0; $j<5; $j++){
                        $password=md5($password);
                    }
//                die($password);

                $data_array = array('fullname' => $fullname,
                                    'password' => $password,
                                    'email'    => $email,
                                    'level'    => 0);

                if ($_POST['id']) {

                    $data_update= array('fullname' => $fullname,
                                        'email'    => $email);
//                    print_r($data_update); die();

                    if (isset($_POST['check']) && sizeof($_POST['check']) > 0) {

                        $string      = implode(";", $_POST['check']);

                        $arr_permiss = array('module_name' => $string);

                        $this->adminmodel->Update_usermodules('user_modules',$id,$arr_permiss);
                    }

                    $this->adminmodel->update($id,$data_update);
                    redirect (base_url('admin/admin-permission'));

                } else {

                    $id_user = $this->adminmodel->Add('admin', $data_array);

                    if (isset($_POST['check'])&&sizeof($_POST['check']) > 0) {


                        $string      = implode(";", $_POST['check']);
                        $arr_permiss = array('module_name' => $string, 'user_id' => $id_user);

                        $this->adminmodel->Add('user_modules', $arr_permiss);
                    }else{
                        $arr_permiss = array('module_name' => '', 'user_id' => $id_user);

                        $this->adminmodel->Add('user_modules', $arr_permiss);
                    }

                    redirect($_SERVER['HTTP_REFERER']);
                }

            }

            $data['modules_list'] = $this->adminmodel->listAll('modules');
//            $data['admin_list']   = $this->adminmodel->Get_where('admin', array('level <>' => 1));

//            $data['admin_list']   = $this->adminmodel->Get_multi_table('admin', array('level <>' => 1),array(array('user_modules','user_id','admin','id','left')));

            $data['admin_list']   = $this->adminmodel->get_user_list();



            $data['headerTitle'] = "Phân quyền quản trị";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/admin_permission', $data);
            $this->load->view('admin/footer');
        }

        public  function reset_pass($id){
            $this->auth->check();
            $this->Check_module($this->module_name);
            if($id>0){
                $password=_PASSWORD_RESET;
                for($j=0; $j<5; $j++){
                    $password=md5($password);
                }
                $this->adminmodel->Update_where('admin',array('id'=>$id),array('password'=>$password));
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        public  function delete_acc($id){
            $this->Check_module($this->module_name);
            if($id>0){
                $this->adminmodel->Delete('admin',$id);
                $this->adminmodel->Delete_where('user_modules',array('user_id'=>$id));
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        public function site_option($id=null){
            $this->load->helper('ckeditor_helper');
            $data['ckeditor2'] = array(
                //ID of the textarea that will be replaced
                'id' => 'ckeditor2',
                'path' => 'assets/admin/ckeditor',
                //Optionnal values
                'config' => array(
                    'toolbar' => "Full", //Using the Full toolbar
                    'width' => "800px", //Setting a custom width
                    'height' => '300px', //Setting a custom height
                ));
            $data['ckeditor1'] = array(
                //ID of the textarea that will be replaced
                'id' => 'ckeditor1',
                'path' => 'assets/admin/ckeditor',
                //Optionnal values
                'config' => array(
                    'toolbar' => "Full", //Using the Full toolbar
                    'width' => "800px", //Setting a custom width
                    'height' => '300px', //Setting a custom height
                ));
            $config['upload_path'] = './upload/img/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '40000000';
            $config['max_width'] = '3024';
            $config['max_height'] = '3000';
            $this->load->library('upload', $config);


            $row=$this->adminmodel->getFirstRow('site_option');



            if(isset($_POST['Update'])){


                if(isset($_POST['Id_Edit'])){
                    $video=explode('=',$this->input->post('video'));
                    $arr=array(
                        'site_url'=>$this->input->post('site_url'),
                        'site_name'=>$this->input->post('site_name'),
                        'site_description'=>$this->input->post('site_description'),
                        'site_keyword'=>$this->input->post('site_keyword'),
                        'company_name'=>$this->input->post('company_name'),
                        'hotline1'=>$this->input->post('hotline1'),
                        'hotline2'=>$this->input->post('hotline2'),
                        'address1'=>$this->input->post('address1'),
                        'address2'=>$this->input->post('address2'),
                        'shipping'=>$this->input->post('shipping'),
                        'video'=>@$video[1],
                        'topkeyword'=>$this->input->post('topkeyword'),
                        'link_fanpage'=>$this->input->post('link_fanpage'),
                        'facebook'=>$this->input->post('facebook'),
                        'twiter'=>$this->input->post('twiter'),
                        'google_plus'=>$this->input->post('google_plus'),
                        'linked'=>$this->input->post('linked'),
                        'tumbr'=>$this->input->post('tumbr'),
                        'text_copyright'=>$this->input->post('text_copyright'),
                        'mail_contact'=>$this->input->post('mail_contact'),
                        'latlong'=>$this->input->post('latlong'),
                    );
                    $this->adminmodel->Update_where('site_option',array('id'=>$row->id),$arr);

                }

               /* if($_FILES['site_logo']['name']!=null){
                    echo $_FILES['site_logo']['name'];
//                    print_r($_FILES);die();

                    if (!$this->upload->do_upload()) {
                        $data['error'] = 'Ảnh quá lớn hoặc không đúng định dạng';
                    } else {
                        $upload = array('upload_data' => $this->upload->data());
                        $image = 'upload/img/' . $_FILES['site_logo']['name'];

                        $this->adminmodel->Update_where('site_option',array('id'=>$row->id),array('site_logo'=>$image));

                    }

                    $this->adminmodel->Update_where('site_option',array('id'=>$row->id),array());
                }*/
                redirect($_SERVER['HTTP_REFERER']);
            }

            $data['headerTitle'] = 'Cấu hình website';

                $data['item'] = $row;

            $this->load->view('admin/header', $data);
            $this->load->view('admin/site_option', $data);
            $this->load->view('admin/footer');
        }
        public function count_comments(){
            $c=$this->adminmodel->Count('comments',array('review'=>0));
            echo json_encode($c);
        }
        public function count_post(){
            $c=$this->adminmodel->Count('user_post',array('view'=>0));
            echo json_encode($c);
        }
        public function count_order(){
            $c=$this->adminmodel->Count('order',array('show'=>0));
            echo json_encode($c);
        }
        
        
    }