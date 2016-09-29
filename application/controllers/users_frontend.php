<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Users_frontend extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('f_usersmodel');
        }

        public function signup()
        {

            if ($this->input->post()&&$this->input->post('status_check')=='1') {


                    $arr=$this->f_usersmodel->getField_array('users','email');
                    $input=array('email'=>$this->input->post('email'));
                    $rs['check']=true;

                    if(in_array($input,$arr)){
                        $rs['check']=false;
                        $rs['mss']='Email đã có người sử dụng';
                    }

                //======
                if ($rs['check'] == true) {

                    $password = $this->input->post('password');
                    for ($i = 0; $i < 5; $i++) {
                        $password = md5($password);
                    }
                    $arr = array(
                        'fullname'    => $this->input->post('fullname'),
                        'email'       => $this->input->post('email'),
                        'password'    => $password,
                        'province'    => $this->input->post('location'),
                        'active'      => 0,
                        'deleted'     => 0,
                        'block'       => 0,
                        'signup_date' => date('Y-m-d'),
                        'phone' => $this->input->post('phone',TRUE),
                    );
                    $id  = $this->f_usersmodel->Add('users', $arr);
                    $this->f_usersmodel->Update_Where('users', array('id' => $id),
                                                      array('md5_id' => md5($id), 'token' => md5($this->input->post('email') . $id),));

                }else{
                    redirect($_SERVER['HTTP_REFERER']);
                }


                if (isset($id)) {
                    $config = Array(
                        'protocol'  => 'smtp',
                        'smtp_host' => 'ssl://smtp.googlemail.com',
                        'smtp_port' => 465,
                        'smtp_user' => 'trantrung129@vnnetsoft.com', // change it to yours
                        'smtp_pass' => 'trungtrung129@@', // change it to yours
                        'mailtype'  => 'html',
                        'charset'   => 'utf-8',
                        'wordwrap'  => TRUE
                    );

                    $this->load->library('email', $config);

                    $user=$this->f_usersmodel->getFirstRowWhere('users',array('id'=>$id));
                    $subject = $this->site_name.' - Kích hoạt tài khoản';
                    $message = '
                    <p>Nhấn vào link dưới đây để kích hoạt tài khoản:</p>
                    <a href="'.base_url('kick-hoat?id='.$user->md5_id.'&token='.$user->token).'">
                    '.base_url('kick-hoat?id='.$user->md5_id.'&token='.$user->token).'</a>';

                    // Get full html:
                    $body =
                        '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                        <html xmlns="http://www.w3.org/1999/xhtml">
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            <title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) . '</title>
                        <style type="text/css">
                            body {
                                font-family: Arial, Verdana, Helvetica, sans-serif;
                                font-size: 16px;
                            }
                        </style>
                    </head>
                    <body>
                    ' . $message . '
                    </body>
                    </html>';


                    $this->email->set_newline("\r\n");
                    $this->email->from($user->email); // change it to yours
                    $this->email->to($user->email); // change it to yours
                    $this->email->subject($subject);
                    $this->email->message($message);
                    if ($this->email->send()) {
//                        echo 'Email sent.';
                        redirect(base_url('dang-ky-thanh-cong?u='.$user->md5_id));
                    } else {
                        redirect(base_url('dang-ky-thanh-cong'));
//                        show_error($this->email->print_debugger());
                    }
                }

            }
        }
        public function forgot_pass()
        {

            if (isset($_POST['email'])) {

                $email=$this->input->post('email');
                $pass=$this->randString(6);
                $new_pass=$pass;
                for($i=0;$i<5;$i++){
                    $new_pass=md5($new_pass);
                }
                $user=$this->f_usersmodel->getFirstRowWhere('users',array('email'=>$email));
                $this->f_usersmodel->Update_where('users',array('email'=>$email),array('password'=>$new_pass));

                //======
                $config = Array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'trantrung129@vnnetsoft.com', // change it to yours
                    'smtp_pass' => 'trungtrung129@@', // change it to yours
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8',
                    'wordwrap'  => TRUE
                );

                $this->load->library('email', $config);

                $subject = $this->site_name.' - Kích hoạt tài khoản';
                $message = '
                    <p>Mạt khẩu mới của bạn là: </p>'.$pass.'
                    <p>Vui lòng đăng nhập và đổi lại mật khẩu!</p>
                    ';

                // Get full html:
                $body =
                    '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) . '</title>
                        <style type="text/css">
                            body {
                                font-family: Arial, Verdana, Helvetica, sans-serif;
                                font-size: 16px;
                            }
                        </style>
                    </head>
                    <body>
                    ' . $message . '
                    </body>
                    </html>';


                $this->email->set_newline("\r\n");
                $this->email->from($this->input->post('email')); // change it to yours
                $this->email->to($this->input->post('email')); // change it to yours
                $this->email->subject($subject);
                $this->email->message($message);
                if ($this->email->send()) {
//                        echo 'Email sent.';
                    redirect(base_url('cap-lai-mat-khau?reset=1&u='.$user->md5_id));
                } else {
                    redirect(base_url('cap-lai-mat-khau'));
//                        show_error($this->email->print_debugger());
                }
            }
            if(isset($_GET['u'])){
                $data['u2']=$this->f_usersmodel->getFirstRowWhere('users',array('md5_id'=>$_GET['u']));
            }
            $data['menu_right'] = $this->f_usersmodel->getMenuRightRoot();
            $this->LoadHeader();
            $this->load->view('success_signup',$data);
            $this->LoadFooter();
        }

        public function signin(){
            $result = array();
            $result['login'] = false;
            $result['message'] = '';
            if ($this->input->post('user')) {
                $username = $this->input->post('user');
                $pass = $this->input->post('pass');

                if ($pass == 0) $result['message'] = 'Vui lòng nhập mật khẩu';

                $user = $this->f_usersmodel->loginUser($username, $pass);

//                print_r($user); die();
                if (isset($user->id)) {

                    if($user->active==0){
                        $result['message'] = 'Tài khoản của bạn chưa được kích hoạt';
                    }elseif($user->active==1&&$user->block==1){
                        $result['message'] = 'Tài khoản của bạn đang bị khóa';
                    }else{
                        $this->auth->loginUser($user);
                        $result['login'] = true;
                    }

                } else {
                    $result['message'] = 'Sai email hoặc mật khẩu!';
                }

            } else $result['message'] = 'Vui lòng nhập mail và mật khẩu!';
            echo json_encode($result);
            die();
        }
        public function check_email(){
            if ($this->input->post('email')) {
                $arr=$this->f_usersmodel->getField_array('users','email');
//                print_r($arr);echo '<br>';
                $input=array('email'=>$this->input->post('email'));
                $rs['check']=true;
                $rs['mss']='';
                if(in_array($input,$arr)){
                    $rs['check']=false;
                    $rs['mss']='Email đã có người sử dụng';
                }
                echo json_encode($rs);
            }
        }
        public function change_pass(){
            $this->auth->checkUserLogin();

            if ($this->input->post('pass_check')==1) {

                $password = $this->input->post('new_pass');
                for ($i = 0; $i < 5; $i++) {
                    $password = md5($password);
                }
                $rs=$this->f_usersmodel->update_pass_user($this->session->userdata('userid'),
                                                  array('password'    => $password,));
                }
                if($rs){
                    $_SESSION['mss_success']='Đổi mật khẩu thành công!';
                }
            redirect($_SERVER['HTTP_REFERER']);
            }
        public function check_old_pass(){
            if ($this->input->post('pass')) {

                $user=$this->f_usersmodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
                $rs['check']=false;
                $rs['mss']='Mật khẩu cũ không chính xác';
                $pass=$this->input->post('pass');
                for($i=0;$i<5;$i++){
                    $pass=md5($pass);
                }
                if($pass==$user->password){
                    $rs['check']=true;
                    $rs['mss']='';
                }

                echo json_encode($rs);
            }
        }

        public function atuto_active_user(){
            if(isset($_GET['id'])&& isset($_GET['token'])){
                $id=$_GET['id'];
                $user=$this->f_usersmodel->getFirstRowWhere('users',array('md5_id'=>$id));
                if($user->token==$_GET['token']){
                    $this->f_usersmodel->Update_where('users',array('id'=>$user->id),array('active'=>1));
                }

                $data['menu_right'] = $this->f_usersmodel->getMenuRightRoot();
                $this->LoadHeader();
                $this->load->view('success_active_user',$data);
                $this->LoadFooter();

            }else redirect(base_url());


        }
        public function success_signup(){

            if(isset($_GET['u'])){
                $data['u']=$this->f_usersmodel->getFirstRowWhere('users',array('md5_id'=>$_GET['u']));
            }
            $data['menu_right'] = $this->f_usersmodel->getMenuRightRoot();
            $this->LoadHeader();
            $this->load->view('success_signup',$data);
            $this->LoadFooter();
        }
        public function success_active_user(){

            $this->load->LoadHeader();
            $this->load->view('success_active_user');
            $this->load->LoadFooter();
        }
        public function signout(){
            $this->session->unset_userdata(array('userid'=>'','username'=>'','usermail'=>'',));
            redirect($_SERVER['HTTP_REFERER']);
        }
        public function check_capcha(){
            $capcha=$this->input->post('capcha');
            $challenge=$this->input->post('challenge');
            $this->load->library('recaptcha');
            $this->recaptcha->recaptcha_check_answer(null,$challenge,$capcha);
        }
        function randString($length, $charset='abcdefghijklmnopqrstuvwxyz0123456789')
        {
            $str = '';
            $count = strlen($charset);
            while ($length--) {
                $str .= $charset[mt_rand(0, $count-1)];
            }
            return $str;
        }

        public function updateProfile()
        {
            $id = $this->session->userdata('userid');
            $config['upload_path'] = './upload/img/avatar/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
            $config['max_size'] = '4000';
            $config['max_width'] = '3000';
            $config['max_height'] = '3000';
            $this->load->library('upload', $config);
            $data['edit'] = $this->f_usersmodel->getItemByID('users',$id);
            if (isset($_POST['update_profiler'])) {
                $arr = array(
                    'fullname' => $this->input->post('fullname'),
                    'phone' => $this->input->post('phone'),
                    //'email' => $this->input->post('email'),
                    'address' => $this->input->post('address'),
                    'province' => $this->input->post('province'),
                    'district' => $this->input->post('district'),
                    'ward' => $this->input->post('ward')
                );
                $this->f_usersmodel->Update('users',$id,$arr);
                if($_FILES['userfile']['name'] != '') {
                    if (!$this->upload->do_upload()) {
                        $data['error'] = 'Ảnh không thỏa mãn';
                    } else {
                        $upload = array('upload_data' => $this->upload->data());
                        $image = 'upload/img/avatar/' . $upload['upload_data']['file_name'];
                        $this->f_usersmodel->Update('users', $id, array('avatar' => $image,));
                        if(isset($data['edit'])&&file_exists($data['edit']->avatar)){
                            unlink($data['edit']->avatar);
                            //@unlink($data['edit']->avatar);
                            $temp_thumb = explode('/',$data['edit']->avatar);
                            //echo "<pre>";var_dump($temp_thumb);
                            $link_thumb = 'upload/img/avatar/thumbs/'.$temp_thumb[3];
                            //var_dump($link_thumb);
                            @unlink($link_thumb);

                        }
                        $config2['image_library'] = 'gd2';
                        $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                        $config2['new_image'] = './upload/img/avatar/thumbs';
                        //$config2['maintain_ratio'] = TRUE;
                        //$config2['create_thumb'] = TRUE;
                        //$config2['thumb_marker'] = '_thumb';
                        $config2['width'] = 70;
                        $config2['height'] = 70;
                        $this->load->library('image_lib',$config2);
                        if ( !$this->image_lib->resize()){
                            $data['error'] = $this->image_lib->display_errors('', '');
                        }
                    }
                }
                $_SESSION['mss_success']='Cập nhật thông tin thành công!';
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        public function listOrder()
        {
            $this->auth->checkUserLogin();
            $id = $this->session->userdata('userid');
            $data = array();
            $config['base_url'] = base_url('thong-tin-dat-hang');
            $config['total_rows'] = $this->f_usersmodel->countUserListOrder($id); // xác định tổng số record
            $config['per_page'] = 9; // xác định số record ở mỗi trang
            $config['uri_segment'] = 2; // xác định segment chứa page number
            $this->pagination->initialize($config);
            $data['orderlist'] = $this->f_usersmodel->getUserListOrder($id,$config['per_page'],$this->uri->segment(2));
            //echo "<pre>";var_dump($data['orderlist']);die();
            $data['detail'] = $this->f_usersmodel->UserOderDetail($id);
            //echo "<pre>";var_dump($data['detail']);die();
            $this->LoadHeader();
            $this->load->view('order_list',$data);
            $this->LoadFooter();
        }
        public function listLike()
        {
            $this->auth->checkUserLogin();
            $id = $this->session->userdata('userid');
            $item = $this->f_usersmodel->getWhere('users','id',$id);
            //echo "<pre>";var_dump($item);die();
            $id_item = json_decode($item->liked);
            //echo "<pre>";var_dump($id_item);
            $config['base_url'] = base_url('san-pham-quan-tam');
            $config['total_rows'] = $this->f_usersmodel->countListProLike($id_item); // xác định tổng số record
            //echo "<pre>";var_dump($config['total_rows']);die();
            $config['per_page'] = 9; // xác định số record ở mỗi trang
            $config['uri_segment'] = 2; // xác định segment chứa page number
            $this->pagination->initialize($config);
            $lists = $this->f_usersmodel->getListProLike($id_item,$config['per_page'],$this->uri->segment(2));
            //echo "<pre>";var_dump($lists);die();
            $data = array();
            $data['lists'] = $lists;
            $this->LoadHeader();
            $this->load->view('view_listliked',$data);
            $this->LoadFooter();
        }
        public function un_like($id){
            $this->auth->checkUserLogin();
            if(isset($id)){
                //$id=$this->input->post('id');
                $user=$this->f_usersmodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));

                if($user->liked !=null){
                    $liked=(array)json_decode($user->liked);
                }else $liked=array();
                $rs['status']=false;
                $new=array();
                foreach($liked as  $val){
                    if($id!=$val){
//                    unset($liked[$key]);
                        $new[]=$val;
                        $rs['status']=true;
                    }
                }
//            $liked=(array)$liked;
//            echo json_encode((array)$liked); die();


                $this->f_usersmodel->Update_Where('users',array('id'=>$this->session->userdata('userid')),
                    array('liked'=>json_encode($new)));
                //echo json_encode($rs);
            }
            redirect(base_url('san-pham-quan-tam'));
        }
        public function deleteItem($id)
        {
            $this->auth->checkUserLogin();
            $this->f_usersmodel->Update('order',$id,array(
                'view' => 0
            ));
            redirect(base_url('thong-tin-dat-hang'));
        }
    }