<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminmodel extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
    }

    public function loginAdmin($username, $password)
    {
        if ($username == null || $password == null)
            return false;
        $this->db->where('email', $username);
        $user = $this->db->get('admin');
        if ($user->num_rows <= 0 || $user->num_rows > 1)
            return false;
        $user = $user->first_row();
        for ($i = 1; $i <= 5; $i++)
            $password = md5($password);
        if ($user->password === $password)
            return $user;
    }
    public function login($email, $pass){
        $email = $this->db->escape_str($email);
        $this->db->select('*');
        $this->db->where('email',$email);
        $query=$this->db->get('users');
        if($query->num_rows()==0) return false;
        $admin = $query->first_row();
        $password = md5($pass);
        if ($password != $admin->password){
                return 'Wrong password';
        }
        return $admin;
    }
    public function update($id,$data){
        if(isset($data) && $data != NULL){
            $this->db->where('id',$id);
            $this->db->update('admin',$data);
        }
    }
    public function Update_usermodules($table, $id, $data)
    {
        if (isset($data) && $data != NULL) {
            $this->db->where('user_id', $id);
            $this->db->update($table, $data);
        }
    }
    public function get_user_modules($id)
    {
        $this->db->where('user_id', $id);
        $q = $this->db->get('user_modules');
        return $q->first_row();
    }
    public function get_user_list()
    {
        $this->db->select('admin.*,user_modules.*,admin.id as admin_id');
        $this->db->where('admin.id <>', 1);
        $this->db->join('user_modules', 'user_modules.user_id=admin.id','left');

        $q = $this->db->get('admin');
        return $q->result();
    }


}
