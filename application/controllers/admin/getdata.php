<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Getdata extends MY_Controller
    {
        protected $module_name="Getdata";

        private $expressions = [
            'title' => [
                'type' => 2,
                'selector' => 'span.watch-title',
            ],
            'image' => [
                'type' => 3,
                'selector' => 'link[itemprop=thumbnailUrl]',
                'attribute' => 'href'
            ],
            'content'=>[
                'type'=>2,
                'selector'=>'#watch-description-clip'
            ],


        ];
        public function __construct()
        {
            parent::__construct();
            $this->load->library('simple_html_dom');

        }

        public function index()
        {



        } //admin Change Password

        public function add(){
            $this->load->helper('model_helper');

            $this->load->helper('ckeditor_helper');
            if (isset($_POST['getdata'])) {

                $url       = $this->input->post('url');
                $data_tmp = $this->simple_html_dom->read_detail($url,$this->expressions);

                if(!empty($data_tmp)){
                    $data = $data_tmp;
                    $data['show'] = 'block';
                    $data['url'] = $url;
                }

            }
            $data['ckeditor']        = array(
                //ID of the textarea that will be replaced
                'id'     => 'ckeditor',
                'path' => 'assets/app/js/ckeditor',
                'attributes' => true,
                //Optionnal values
                'config' => array(
                    'toolbar' => "Full", //Using the Full toolbar
                    'width'   => "800px", //Setting a custom width
                    'height'  => '300px', //Setting a custom height
                ));



            $data['headerTitle'] = "Get data";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/getdata', $data);
            $this->load->view('admin/footer');
        }


    }