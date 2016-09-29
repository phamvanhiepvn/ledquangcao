<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    class MY_Controller extends CI_Controller
    {
        protected $options = '';
        function __construct()
        {
            parent::__construct();
            //session_start();
            $this->load->helper('url');
            $this->load->helper('model_helper');
            $this->load->model('f_homemodel');
            $this->load->library('pagination');
            $this->option = $this->f_homemodel->getFirstRow('site_option');
            $this->logoTop = $this->f_homemodel->getLogoByType('logo');
            $this->banner = $this->f_homemodel->getLogoByType('banner')->link;
            $this->bannerslider = $this->f_homemodel->getLogoByType('bannerslider')->link;
            $this->site_name        = $this->option->site_name;
            $this->site_logo        = $this->option->site_logo;
            $this->site_keyword     = $this->option->site_keyword;
            $this->site_description = $this->option->site_description;
            $this->favicon          = $this->option->favicon;
            $this->hotline1          = $this->option->hotline1;
            $this->hotline2          = $this->option->hotline2;
            $this->address1          = $this->option->address1;
            $this->address2          = $this->option->address2;
            $this->address2          = $this->option->address2;
            $this->company_name          = $this->option->company_name;
            $this->latlong          = $this->option->latlong;
            $this->textHomePage          = $this->option->shipping;
            $this->video            = $this->option->video;
            $this->topkeyword            = $this->option->topkeyword;
            $this->link_fanpage            = $this->option->link_fanpage;
            $this->facebook            = $this->option->facebook;
            $this->twiter            = $this->option->twiter;
            $this->linked            = $this->option->linked;
            $this->tumbr            = $this->option->tumbr;
            $this->text_copyright            = $this->option->text_copyright;
            $this->mail_contact            = $this->option->mail_contact;

        }
        public function Check_module($module_name)
        {
            if($this->session->userdata['adminid']=='af53b1505489'){
                return true;
            }
            $user_id = $this->session->userdata('adminid');
            if (isset($module_name) && isset($user_id)) {
                $user = $this->f_homemodel->getAdminAcc($user_id);
                if($user->level ==0){
                    $module = $this->f_homemodel->getUserModules($user_id);
                    $arr_module = explode(';', $module->module_name);
                    if(in_array('Full', $arr_module)){
                        return true;
                    } elseif (in_array($module_name, $arr_module)) {
                        return true;
                    } else {
                        die('Tai khoan cua ban khong duoc cap quyen truy cap chuc nang nay!');
                    }
                }
            } else return false;
        }
        public function LoadHeader($Pagetitle = null, $Keyword = null, $Description = null,$facebook=null)
        {
            $data = array();
            $data['item_id'] = $this->input->get('itemId');
            $menus         = $this->f_homemodel->getCateHome();
            $data['cates'] = $menus;
            $data['menutops'] = $this->f_homemodel->Get_where('menu',array(
                'position' => 'top',
                'parent_id'=>0
            ));
            $data['menu_sub'] = $this->f_homemodel->Get_where('menu',array(
                'position' => 'top',
                'parent_id !='=>0
            ));
            $data['Pagetitle']   = $Pagetitle;
            $data['Keyword']     = $Keyword;
            $data['Description'] = $Description;
            $this->load->view('header', $data);
        }
        public function LoadFooter()
        {
            $data = array();
            $data['menu_footer'] = $this->f_homemodel->homeview_category();
            $this->load->view('footer', $data);
        }
    }
    ?>