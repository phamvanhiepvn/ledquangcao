<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller
{
    protected $module_name="Users";
    public function __construct() {
        parent::__construct();
        $this->load->model('usersmodel');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();
        $this->Check_module($this->module_name);
    }

    public function userslist(){
        $config['base_url'] = base_url('admin/quan-ly-thanh-vien');
        $config['total_rows'] = $this->usersmodel->count_All('users'); // xác định tổng số record
        $config['per_page'] = 10; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data = array();
        $data['userslist'] = $this->usersmodel->UsersListAll($config['per_page'], $this->uri->segment(3));

        $data['headerTitle']="Quản lý thành viên";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/users_list',$data);
        $this->load->view('admin/footer');
    }
    //Delete News
    public function delete($id){
        $this->usersmodel->Delete('users',$id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function changeStatusUser(){
        $id = $this->input->post('id');
        $user = $this->usersmodel->getItemByID('users',$id);
        if($user){
            if($this->usersmodel->changeStatusUser($id,$user->block)){
                if($user->block == 1){
                    echo json_encode('Block');
                }elseif($user->block == 0){
                    echo json_encode('Unlock');
                }
            }else
                echo json_encode(0);
        }else
            echo json_encode(0);
    }


    //user Login
    public function login(){
        if($this->input->post('email')){
            $username = $this->input->post('email');
            $pass = $this->input->post('pass');
            $admin = $this->usersmodel->loginAdmin($username,$pass);
            if(isset($admin->id)){
                $this->auth->login($admin);
                $lastlogin=array('lastlogin'=>time());
                $this->usersmodel->update($admin->id,$lastlogin);
                redirect(base_url('admin'));
            }
        }
        $this->load->view('admin/login');
    }
    // user logout
    public function logout(){
        $this->auth->logout();
        redirect(base_url('admin'));
    }

    public function active_user(){
        //$this->auth->check();
        $u=$this->usersmodel->getFirstRowWhere('users',array('id'=>$_POST['id']));

        if($u->active==1){
            $this->usersmodel->Update_where('users', array('id' => $_POST['id']), array('active'=>0));

        }else if($u->active==0){
            $this->usersmodel->Update_where('users', array('id' => $_POST['id']), array('active'=>1));
        }
        echo 1;
    }
//    ===================================================
    public function emails(){
        $config['base_url'] = base_url('admin/emails');
        $config['total_rows'] = $this->usersmodel->count_All('emails'); // xác định tổng số record
        $config['per_page'] = 10; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data = array();
        $data['list'] = $this->usersmodel->GetData('emails',null,array('id','desc'),$config['per_page'], $this->uri->segment(3));

//        print_r($data['list']); die();
        $data['headerTitle']="Emails";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/emails',$data);
        $this->load->view('admin/footer');
    }
    public function delete_mail($id){
        $this->usersmodel->Delete('emails',$id);
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function mail_coupon(){
        $this->load->helper('ckeditor_helper');
        $data['ckeditor']        = array(
            //ID of the textarea that will be replaced
            'id'     => 'ckeditor',
            'path'   => 'assets/admin/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width'   => "800px", //Setting a custom width
                'height'  => '300px', //Setting a custom height
            ));

        if ($this->input->post('email')) {

              $email=implode(',',$this->input->post('email'));

            $_SESSION['email']=$email;
        }


        if(isset($_POST['send'])){
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

            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

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
            $this->email->from($_SESSION['email']); // change it to yours
//            $this->email->to($_SESSION['email']); // change it to yours
            $this->email->bcc($_SESSION['email']);
            $this->email->subject($subject);
            $this->email->message($message);
            if ($this->email->send()) {
                       unset($_SESSION['email']);
                       $_SESSION['mess']='Gửi mail thành công!';
                redirect(base_url('admin/emails'));
            } else {
                $_SESSION['mess']='Gửi mail thất bại!';
                redirect(base_url('admin/emails'));
            }
        }

        $data['headerTitle']="Emails";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/mail_coupon',$data);
        $this->load->view('admin/footer');
    }
}