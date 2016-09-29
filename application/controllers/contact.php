<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('contact_model');

    }
    //index
    public function index(){
        if(isset($_POST['sendcontact'])){

            $arr=array('full_name' => $this->input->post('full_name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'country' => $this->input->post('country'),
                'comment' => $this->input->post('comment'),
                'time' => time(),
            );
            $id=$this->contact_model->Add('contact',$arr);

            if($id){
                $_SESSION['message']="Bạn đã gửi thông tin thành công!!!";
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
        $view = 'content_right';
        $site_name='Liên Hệ';
        $site_keyword='Liên Hệ';
        $site_description='';
        $data['home_support']=$this->f_homemodel->Home_support('contact');

        $this->LoadHeader($site_name,$site_keyword,$site_description);

        $this->load->view('contact',$data);

        $this->LoadFooter();
    }
    public function companyContact()
    {
        if(isset($_POST['ctlh'])&& $this->input->post('personname') !=''){
            $arr=array('full_name' => $this->input->post('personname'),
                'phone' => $this->input->post('person_phone'),
                'email' => $this->input->post('person_email'),
                'address' => $this->input->post('person_address'),
                'yahoo'   => $this->input->post('yahoo_skyle'),
                /*'city' => $this->input->post('city'),
                'country' => $this->input->post('country'),
                'comment' => $this->input->post('comment'),*/
                'company' => $this->input->post('companyname'),
                'company_address' => $this->input->post('companyaddress'),
                'company_phone' => $this->input->post('companyphone'),
                'company_type' => $this->input->post('companytype'),
                'company_fax' => $this->input->post('companynamefax'),
                'time' => time(),
            );
            $id=$this->contact_model->Add('contact',$arr);

            if($id){
                //send mail to user , code,productName...
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
                $subject = 'Thông tin đặt hàng - '.$this->input->post('personname');
                $message = '<p><h2>Kính gủi ban lãnh đạo công ty qts!</h2></p>';
                $message .= '<p>Thông tin của khách hàng liên hệ như sau:</p>';
                $message .='<p>Họ và tên :'.$this->input->post('personname').',<p>';
                $message .='<p>Số điện thoại :'.$this->input->post('person_phone').'</p>';
                $message .='<p>Email :'.$this->input->post('person_email').'</p>';
                $message .='<p>Địa chỉ :'.$this->input->post('person_address').'</p>';
                $message .='<p>Yahoo/skpe'.$this->input->post('yahoo_skyle').'</p>';
                $message .='<p>Tên công ty :'.$this->input->post('companyname').'</p>';
                $message .='<p>Địa chỉ công ty :'.$this->input->post('companyaddress').'</p>';
                $message .='<p>Điện thoại công ty :'.$this->input->post('companyphone').'</p>';
                $message .='<p>Lĩnh vực kinh doanh :'.$this->input->post('companytype').'</p>';
                $message .='<p>Fax :'.$this->input->post('companynamefax').'</p>';
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
                $this->email->from($this->input->post('email'),$this->input->post('personname')); // change it to yours
                $this->email->to('info@qts.com.vn,trungtv@qts.com.vn,vulq@qts.com.vn'); // change it to yours
                $this->email->subject($subject);
                $this->email->message($body);
                $this->email->send();
                $_SESSION['message']="Bạn đã gửi thông tin thành công!!!";
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function customerContact()
    {
        if(isset($_POST['clh'])&& $this->input->post('cusnname') != ''){
            $arr=array('full_name' => $this->input->post('cusnname'),
                'phone' => $this->input->post('cusphone'),
                'email' => $this->input->post('cusemail'),
                'address' => $this->input->post('cusaddress'),
                'yahoo'   => $this->input->post('cusyahoo'),
                'time' => time(),
            );
            $id=$this->contact_model->Add('contact',$arr);
            if($id){
                //send mail to user , code,productName...
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
                $subject = 'Thông tin đặt hàng - '.$this->input->post('cusnname');
                $message = '<p><h2>Kính gủi ban lãnh đạo công ty qts!</h2></p>';
                $message .= '<p>Thông tin của khách hàng liên hệ như sau:</p>';
                $message .='<p>Họ và tên :'.$this->input->post('cusnname').',<p>';
                $message .='<p>Số điện thoại :'.$this->input->post('cusphone').'</p>';
                $message .='<p>Email :'.$this->input->post('cusemail').'</p>';
                $message .='<p>Địa chỉ :'.$this->input->post('cusaddress').'</p>';
                $message .='<p>Yahoo/skpe'.$this->input->post('cusyahoo').'</p>';
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
                $this->email->from($this->input->post('email'),$this->input->post('cusnname')); // change it to yours
                $this->email->to('info@qts.com.vn,trungtv@qts.com.vn,vulq@qts.com.vn'); // change it to yours
                $this->email->subject($subject);
                $this->email->message($body);
                $this->email->send();
                $_SESSION['message']="Bạn đã gửi thông tin thành công!!!";
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function promotion()
    {
        if(!isset($_SESSION['chose_promo']))
        {
            $_SESSION['chose_promo'] = '1';
        }
        if(isset($_POST['sendcontact'])){

            $arr=array('full_name' => $this->input->post('full_name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'country' => $this->input->post('country'),
                'comment' => $this->input->post('comment'),
                'time' => time(),
                'type'    => $this->input->post('promotion'),
                'type_web' => $this->input->post('type_web'),
            );
            $id=$this->contact_model->Add('contact',$arr);

            if($id){
                $_SESSION['message']="Bạn đã gửi thông tin thành công!!!";
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data['type_web'] = $this->contact_model->getList('product_category');
        //echo "<pre>";var_dump($data['type_web']);die();
        $view = 'content_right';
        $site_name='Gửi thông tin khuyến mại';
        $site_keyword='Khuyến mại giảm giá website';
        $site_description='';
        $data['home_support']=$this->f_homemodel->Home_support('contact');

        $this->LoadHeader($site_name,$site_keyword,$site_description);
        $this->LoadMenuTop();
        $this->load->view('form_promotion',$data);
        $this->LoadRight($view);
        $this->LoadFooter();
    }

}