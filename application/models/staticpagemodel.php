<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staticpagemodel extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
        $this->load->database();
    }
    public function get_data($table)
    {
        $query=$this->db->get($table);
        return $query->first_row();
    }
}