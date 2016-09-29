<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class my404 extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->output->set_status_header('404');
        $data['content'] = 'error_404'; // View name
        $this->load->view('errors',$data);//loading in my template
    }
}
?>