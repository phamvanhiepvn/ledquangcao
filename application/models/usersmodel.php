<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usersmodel extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
    }
    public function UsersListAll($limit,$offset){
        $this->db->select('users.*,province.name provin_name');
        $this->db->join('province','users.province=province.provinceid','left');

        $this->db->order_by('users.id','desc');
        $this->db->limit($limit,$offset);
        $q=$this->db->get('users');
        return $q->result();
    }

    public function changeStatusUser($id, $status)
    {
        if (isset($id) && $id > 0 && is_numeric($id)   && isset($status) && is_numeric($status)) {
            if ($status == 1)
                $array = array('block' => 0);
            else {
                $array = array('block' => 1);
            }
            $this->db->where('id', $id);
            if ($this->db->update('users', $array)) {
                return true;
            };

        }
        return FALSE;
    }

    /*public function loginAdmin($username, $password)
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
    }*/

}
