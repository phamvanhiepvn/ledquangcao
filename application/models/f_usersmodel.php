<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class F_usersmodel extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
    }
    public function getPage($alias){
        $this->db->select('*');
        $this->db->where('alias',$alias);
        $q=$this->db->get('staticpage');
        return $q->first_row();
    }
    public function loginUser($username,$password){
        if($username==null || $password==null)
            return false;
        $this->db->where('email',$username);
        $user = $this->db->get('users');
        if($user->num_rows<=0|| $user->num_rows>1)
            return false;
        $user=$user->first_row();

        for($i =1; $i <=5; $i++)
            $password = md5($password);

        if($user->password === $password){
            $datauser = array(
                'last_login' => time()
            );
            $this->db->where('id',$user->id);
            $this->db->update('users',$datauser);

            return $user;
        }
    }
    public function update_pass_user($id,$array){
        if(isset($id)&&is_array($array)){
            $this->db->where('id',$id);
            $this->db->update('users', $array);
            return $id;
        }else return false;
    }
    public function getMenuRightRoot(){
        $this->db->select('*');
        $this->db->where('position','right');
        $this->db->where('parent_id',0);
        $q=$this->db->get('menu');
        return $q->result();
    }

}