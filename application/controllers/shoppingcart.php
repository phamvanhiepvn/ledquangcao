<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shoppingcart extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('f_shoppingcartmodel');
//        $config['sess_use_database'] = TRUE;
//        session_start();
    }

    //index
    public function check_out()
    {
        $this->load->helper('model_helper');
        $items = $_SESSION['cart'];
        if(isset($_POST['sendcart'])){

            $arr=array(
                'fullname' => $this->input->post('fullname'),
                'province' => $this->input->post('province'),
                'district' => $this->input->post('district'),
                'ward' => $this->input->post('ward'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'note' => $this->input->post('note'),
                'time' => time(),
                //'user_id' => $this->session->userdata('userid'),
            );

            $id=$this->f_shoppingcartmodel->Add('order',$arr);
            if($id)
            {

                $code = 'DH_'.date('d').$id;
                $this->f_shoppingcartmodel->Update_where('order',array(
                    'id' => $id
                ),
                array(
                    'code' => $code
                )
                );
               /* $_SESSION['message']="Bạn đã đặt hàng thành công !";*/
            }
            /*
            foreach($items as $item){
                 //  $this->f_shoppingcartmodel->getFirstRowWhere('product',array('id'=>$_POST['item_id'][$i]));

                   $detai_order=array(
                                'order_id'=>$id,
                                'item_id'=>$_POST['item_id'][$i],
                                'count'=>$_POST['count'][$i],
                                'price'=>$_POST['price'][$i],
                                //'color'=>$_POST['color'][$i],
                                //'size'=>$_POST['size'][$i],
                   );
                   $id_order_item=$this->f_shoppingcartmodel->Add('order_item',$detai_order);
             }
            */

           /* $count        = 0;
            $total        = 0;*/
            if(isset($_SESSION['cart'])){
                foreach ($_SESSION['cart'] as $v) {
                    /*$count += $v['qty'];
                    $total += ($v['qty'] * $v['price']);*/
                    $detai_order=array(
                        'order_id'=>$id,
                        'item_id'=>$v['rowid'],
                        'count'=> $v['qty'],
                        'price'=> $v['price'],
                        //'color'=>$_POST['color'][$i],
                        //'size'=>$_POST['size'][$i],
                    );
                    $id_order_item=$this->f_shoppingcartmodel->Add('order_item',$detai_order);
                }
            }
            if($id){
                //Send mail
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

                $subject = $this->site_name.' - Thông tin đặt hàng';
                $htm = '<table width="100%" border="1" cellpadding="0" cellspacing="0"><thead><tr><td>Stt</td><td>Tên sản phẩm</td>
                <td>Số lượng</td><td>Đơn giá(vnđ)</td><td>Thành tiền(vnđ)</td></tr></thead><tbody>';
                $subtotal = 0;
                $total = 0;
                $stt = 0;
                foreach($_SESSION['cart'] as $key => $tcat){
                    $stt ++;
                    $subtotal = $tcat['price']*$tcat['qty'];
                    $total +=$subtotal;
                    $htm .='<tr>';
                    $htm .='<td>'.($stt).'</td>';
                    $htm .='<td>'.$tcat['name'].'</td>';
                    $htm .='<td>'.$tcat['qty'].'</td>';
                    $htm .='<td>'.number_format($tcat['price']).'</td>';
                    $htm .='<td>'.number_format($tcat['price']*$tcat['qty']).'</td>';
                    $htm .='</tr>';
                }
                $htm .='<tr><td colspan="5">Tổng tiền thanh toán là:'.number_format($total).'&nbsp;vnđ</td></tr>';
                $htm .='</tbody>';
                $htm .='</table>';
                $message ='<p>Cảm ơn bạn đã đặt hàng của chúng tôi !</p>';
                $message .='<p>Chúng tôi sẽ chuyển sản phẩm đến với bạn trong thời gian sớm nhất !</p>';
                $message .='<p>Thông tin về sản phẩm của bạn như sau:</p>';
                $message .=$htm;
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
                $this->email->from($this->input->post('email','santhuonghieu.vn')); // change it to yours
                //$this->email->from('dai.itbk@gmail.com','Dai Nguyen');
                $this->email->to($this->input->post('email')); // change it to yours
                $this->email->subject($subject);
                $this->email->message($body);
                $this->email->send();
                $_SESSION['message']="Bạn đã đặt hàng thành công !";
            }else{
                $message = "sory please try again";
            }

            if(isset($_SESSION['cart'])){
                //unset($_SESSION['cart']);
                session_destroy();
            }
            redirect(base_url('thanh-toan-dat-hang'));
        }
       /* $data['count'] = $count;
        $data['total'] = $total;
        $data['fullname'] = $this->session->userdata('fullname');
        $data['user_mail'] = $this->session->userdata('usermail');
        $data['shipping'] =  $this->f_shoppingcartmodel->getFirstRowWhere('site_option');
        $data['user'] =  $this->f_shoppingcartmodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
        $data['province'] =  $this->f_shoppingcartmodel->GetData('province',null,null);
//        print_r($data['province'])
        $data['shipping'] =  $this->f_shoppingcartmodel->getFirstRowWhere('site_option');
        if(!empty($data['user']->province))
        {
            $data['district'] = $this->f_homemodel->Get_where('district',array(
                'provinceid' => $data['user']->province
            ));
        }
        if(!empty($data['user']->district))
        {
            $data['ward'] = $this->f_homemodel->Get_where('ward',array(
                'districtid' => $data['user']->district
            ));
        }*/
        $data['province'] =  $this->f_shoppingcartmodel->GetData('province',null,null);
        $data['cart'] = @$_SESSION['cart'];
        $this->LoadHeader();



        $this->LoadMenuTop();
        $this->LoadHeader($this->site_name, $this->site_keyword, $this->site_description);
        $this->load->view('shoppingcart_checkout', $data);
        $this->LoadFooter();
    }
    public function payment(){
        $data = array();
        $this->LoadHeader($this->site_name, $this->site_keyword, $this->site_description);
        //$this->LoadHeaderMobi();
        //$this->load->view('pro_bycate_mobi',$data);
        //$this->LoadFooterMobi();
        $this->LoadMenuTop();
        $this->load->view('payment',$data);
        $this->LoadFooter();
    }
    //ajax
    public function add_cart()
    {
        $id=$this->input->post('id');
        $row = $this->f_shoppingcartmodel->getFirstRowWhere('product', array('id' => $id));
        if($row->price_sale !=0)
        {
            $temp_price = $row->price_sale;
        }else{
            $temp_price = $row->price;
        }
//        $cart_id=str_replace('#','-',$id.$color.$size);
        $cart_id = $id;
//        print_r($row); die($id);

        $_SESSION['messege']='';
        $rs['status']=false;

        if (!empty($_SESSION['cart'])&&isset($_SESSION['cart'][$cart_id])&&in_array($_SESSION['cart'][$cart_id], $_SESSION['cart'])) {
            $old = $_SESSION['cart'][$cart_id];

            $_SESSION['cart'][$cart_id] = array(
                'rowid' => $id,
                'name'  => $row->name,
                'qty'   => ($old['qty'] + 1),
                //'price' => $row->price,
                'price' => $temp_price,
                'image' => $row->image,
            );
            $_SESSION['messege']='Sản phẩm đã cập nhật vào giỏ hàng của bạn!';
            $rs['status']=true;

        } else {
            $_SESSION['cart'][$cart_id] = array(
                'rowid' => $id,
                'name'  => $row->name,
                'qty'   => 1,
                //'price' => $row->price,
                'price' => $temp_price,
                'image' => $row->image,
            );
            $_SESSION['messege']='Sản phẩm đã thêm vào giỏ hàng của bạn!';
            $rs['status']=true;
        }
        $count = 0;
        foreach ($_SESSION['cart'] as $v) {
            $count += $v['qty'];
        }
        $rs['count']      = $count;
        $rs['mess']=$_SESSION['messege'];
    echo  json_encode($rs);
    }

    /**
     * View cart
     * @param $id
     */
    public function view_cart()
    {
        $data['pro_cats'] = $_SESSION['cart'];
        $this->load->view('view_cart', $data);
    }
    public function add_cart2($id)
    {
        /*//du lieu luu vao gio hang
        $cart = array(
            array ('id'    => $row->id,
                   'qty'   => 1,
                   'price' => $row->price,
                   'name'  => $row->name) ,
        );
        //goi phương thức thêm vào giỏ hàng
        $this->cart->insert($cart);*/

        $row = $this->f_shoppingcartmodel->getFirstRowWhere('product', array('id' => $id));

        if (!empty($_SESSION['cart'])) {
            if(in_array($_SESSION['cart'][$id], $_SESSION['cart'])){
                $old = ($_SESSION['cart'][$id]);

                $_SESSION['cart'][$id] = array(
                    'rowid' => $id,
                    'name'  => $row->name,
                    'qty'   => ($old['qty'] + 1),
                    'price' => $row->price,
                    'image' => $row->image,
                );
            }

        } else {
            $_SESSION['cart'][$id] = array(
                'rowid' => $id,
                'name'  => $row->name,
                'qty'   => 1,
                'price' => $row->price,
                'image' => $row->image,
            );
        }
//            print_r($_SESSION['cart']);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_cart()
    {
        if (isset($_POST['id']) && isset($_POST['qty'])) {
            $old = $_SESSION['cart'][$_POST['id']];

            $new                            = array(
                'rowid' => $old['rowid'],
                'name'  => $old['name'],
                'qty'   => $_POST['qty'],
                'price' => $old['price'],
                'image' => $old['image'],
            );
            $_SESSION['cart'][$_POST['id']] = $new;
            $count = 0;
            $total = 0;
            foreach ($_SESSION['cart'] as $v) {
                $count += $v['qty'];
                $total += ($v['qty'] * $v['price']);
            }
            $data['count']      = $count;
            $data['total']      = $total;
            $data['item_price'] = $old['price'];
            $data['item_total'] = $old['price'] * $_POST['qty'];
            echo json_encode($data);
        }


//            redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete($id)
    {
        unset($_SESSION['cart'][$id]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function destroy_cart()
    {
        if(isset($_SESSION['cart'])){
            unset($_SESSION['cart']);
        }
        redirect(base_url());
    }

    public function getdistric()
    {
        if (isset($_POST['id'])) {
            $list        = $this->f_shoppingcartmodel->Get_where('district', array('provinceid' => $_POST['id']));
            echo json_encode($list);
        }
    }

    public function getward()
    {
        if (isset($_POST['id'])) {
            $list        = $this->f_shoppingcartmodel->Get_where('ward', array('districtid' => $_POST['id']));
            echo json_encode($list);
        }
    }

    public function detele_item()
    {
        $count = 0;
        $id = $_POST['id'];
        if(isset($id)) {
            unset($_SESSION['cart'][$id]);
        }
        foreach ($_SESSION['cart'] as $v) {
            $count += $v['qty'];
        }
        $rs['count']      = $count;
        echo json_encode($rs);
    }
}