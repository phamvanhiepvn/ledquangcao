<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends MY_Controller
{
    protected $module_name="Comment";
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('m_comment');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();

        $this->Check_module($this->module_name);
    }

    public function listComment()
    {
        $config['base_url']    = base_url('admin/comment/list');
        $config['total_rows']  = $this->m_comment->countComment(); // xác định tổng số record
        //echo"<pre>";var_dump($config['total_rows']);die();
        $config['per_page']    = 15; // xác định số record ở mỗi trang
        $config['uri_segment'] = 4; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data              = array();
        $data['list']  = $this->m_comment->listAllComment($config['per_page'],$this->uri->segment(4));

        $this->m_comment->Update_where('comments',array('review'=>0),array('review'=>1));
        $data['headerTitle'] = 'Danh sách bình luận';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/comment_list', $data);
        $this->load->view('admin/footer');
    }
    public function Delete($id){
        $this->m_comment->Delete('comments',$id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function popupdata()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $id   = $_GET['id'];
            $item = $this->m_comment->getFirstRowWhere('comments', array('id' => $id));
            echo '
                        <div class="col-xs-12">
                            <p> '.@$item->comment.'</p>
                        </div>
                ';
        }
    }
}