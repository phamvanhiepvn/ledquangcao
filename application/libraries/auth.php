<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of auth
 *
 * @author Huang
 */
class auth {
    function __construct() {
        $this->ci =& get_instance();
    }

    function login($admin){
        $this->ci->session->set_userdata('adminid',$admin->id);
        $this->ci->session->set_userdata('adminemail',$admin->email);
        $this->ci->session->set_userdata('adminname',$admin->fullname);
        //$this->ci->session->set_userdata('adminemail',$admin->email);
        //$this->ci->session->set_userdata('lastlogin',$admin->lastlogin);
    }
    function loginUser($user){
        $this->ci->session->set_userdata('userid',$user->id);
        $this->ci->session->set_userdata('username',$user->username);
        $this->ci->session->set_userdata('usermail',$user->email);
        $this->ci->session->set_userdata('fullname',$user->fullname);
//        $this->ci->session->set_userdata('avatar',$user->avatar);
    }

    function logout(){
        $this->ci->session->sess_destroy();

    }
    function getUser(){
        $user = array();
        $user['id'] = $this->ci->session->userdata('userid');
        $user['username']=$this->ci->session->userdata('username');
        return $user;
    }

    function getAdmin(){
        $admin = array();
        $admin['id'] = $this->ci->session->userdata('adminid');
        $admin['username'] = $this->ci->session->userdata('adminname');
        $admin['lastlogin'] = $this->ci->session->userdata('lastlogin');
        $admin['email'] = $this->ci->session->userdata('adminemail');
        return $admin;
    }
    function checkUserLogin(){
        if(!$this->ci->session->userdata('userid')){
            redirect(base_url());
        }
    }
    function check(){
        if (!$this->ci->session->userdata('adminid')){
            redirect(base_url('admin/login'));
        }
    }
    function error($error='',$errorcode=404,$headtext=''){
        if (!$error){
            $error = 'Trang bạn cần không có trong máy chủ. Xin hãy kiểm tra lại đường dẫn';
        }
        if (!$headtext){
            $headtext = 'Không tìm thấy trang bạn cần';
        }
        show_error($error, $errorcode, $headtext);
    }
    function checkLoggedIn(){
        if ($this->ci->session->userdata('userid')){
            redirect(base_url('home'));
        }else{
            redirect(base_url('dang-ky'));
        }
    }
}

?>
