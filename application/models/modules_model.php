<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class  Modules_model extends MY_Model{
        function __construct() {
            parent::__construct();
            $this->load->helper('model');
            $this->load->database();
        }
        public function getList($table){
            $this->db->select('*');
            $q=$this->db->get($table);
            return $q->result();
        }


    }
