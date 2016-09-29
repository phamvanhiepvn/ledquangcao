<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller
{
    protected $module_name="Menu";
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('menu_model');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();

        $this->Check_module($this->module_name);
    }

    public function menulist()
    {
        $data['menu_top'] = $this->menu_model->GetData('menu',array('position'=>'top'),array('sort','esc'));
        $data['menu_left'] = $this->menu_model->GetData('menu',array('position'=>'left'),array('sort','esc'));
        $data['menu_right'] = $this->menu_model->GetData('menu',array('position'=>'right'),array('sort','esc'));
        $data['menu_bottom'] = $this->menu_model->GetData('menu',array('position'=>'bottom'),array('sort','esc'));

        $data['menu_root'] = $this->menu_model->getListRoot();
        $data['menu_chil'] = $this->menu_model->getListChil();

        $data['headerTitle'] = 'Danh sách menu';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/menu_list', $data);
        $this->load->view('admin/footer');
    }

    //ajax==========
    public function get_subcat()
    {
        $cat=$this->input->post('name');
        $rs['cat']=$cat;
        echo json_encode($rs);
    }
    public function cate_show($module,$edit=null){
        $data['edit']=$edit;
        if($module=='0'){
            $data['cate']=array();
        }
        if($module=='products'){
            $data['cate']=$this->menu_model->GetData('product_category',null,array('id','esc'));
        }
        if($module=='news'){
            $data['cate']=$this->menu_model->GetData('news_category',null,array('id','esc'));
        }
        if($module=='pages'){
            $data['cate']=$this->menu_model->GetData('staticpage',null,array('id','esc'));
        }
        $this->load->view('admin/show_cate_menuadd', $data);
    }
    //save sort menu
    public function Save_menu(){

        if(isset($_POST['name'])){
            $a=str_replace("\\",'',$_POST['name']);
            $arr=json_decode($a);
            $this->sort_menu($arr);
            echo 1;
        }

    }
    public function sort_menu($arr,$parent=0)
    {
        if ($arr != null) {
            foreach ($arr as $k2 => $v2) {

                $this->menu_model->Update_where('menu', array('id_menu' => $v2->id), array('sort' => $k2,'parent_id' => $parent));
                unset($arr[$k2]);
                isset($v2->id)?$id=$v2->id:$id=0;

                if(isset($v2->children)){
                    $this->sort_menu($v2->children,$id);
                }
            }
        }
    }


    //Add menu====================================================================================
    public function addmenu($id=null)
    {
        $this->load->helper('model_helper');

        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);

        if($id!=null){
            $data['edit'] = $this->menu_model->getFirstRowWhere('menu',array('id_menu'=>$id));
            $data['id_edit'] =$id;
            $str=explode('/',$data['edit']->url);
            if(sizeof($str)>1){
                if($data['edit']->module=='news'){
                    $data['cate_edit'] = $this->menu_model->getFirstRowWhere('news_category',array('alias'=>$str[1]));
                }
                if($data['edit']->module=='pages'){
                    $data['cate_edit'] = $this->menu_model->getFirstRowWhere('staticpage',array('alias'=>$str[1]));
                }
                if($data['edit']->module=='products'){
                    $data['cate_edit'] = $this->menu_model->getFirstRowWhere('product_category',array('alias'=>$str[1]));
                }
            }
        }

        if (isset($_POST['addmenu'])) {

            $title       = $this->input->post('title');
            $parent      = $this->input->post('parent');
            $description = $this->input->post('description');
            $position    = $this->input->post('position');
            $module      = $this->input->post('module');
            $sort        = $this->input->post('sort');
            $icon        = $this->input->post('icon');
            $alias       = make_alias($title);
            $link        = $this->input->post('subcat');

            if($this->input->post('module')){
                if($this->input->post('module')=='news'){
                    $url='tin-tuc/'.$link;
                } else if($this->input->post('module')=='products'){
                    $url ='danh-muc/'.$link;
                } else if($this->input->post('module')=='pages'){
                    $url ='page/'.$link;
                }
            }else{
                $url=$alias;
            }
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];
                }
            } else { $image=''; }

            $arr = array('name'        => $title,
                         'description' => $description,
                         'parent_id'   => $parent,
                         'icon'        => $icon,
                         'alias'       => $alias,
                         'url'         => $url,
                         'position'    => $position,
                         'module'      => $module, );
            if($this->input->post('edit_id')!=0){
                $this->menu_model->Update_where('menu',array('id_menu'=>$id),$arr);
                if ($id) {
                    redirect(base_url('admin/danh-sach-menu'));
                }
            }else{
                $ins = $this->menu_model->Add('menu', $arr);
                if ($ins) {
                    redirect(base_url('admin/danh-sach-menu'));
                }
            }

        }
        if(isset($_GET['p'])){
            $data['menu'] = $this->menu_model->Get_where('menu',array('position'=>$_GET['p']));
        }else $data['menu'] = $this->menu_model->getList('menu');


        $data['menu_root'] = $this->menu_model->getListRoot();
        $data['menu_chil'] = $this->menu_model->getListChil();

//        $item = $this->menu_model->getList('menu');
//        $data['item'] = $item;
        $data['headerTitle'] = "Thêm menu";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/menu_add', $data);
        $this->load->view('admin/footer');
    }
    //Edit Menu=====================================================================================
    public function editmenu($id){
        $this->load->helper('model_helper');

        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '1000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $this->load->library('upload', $config);

        $item1=$this->menu_model->getMenuByID($id);
        if(isset($_POST['editmenu'])){
            $title = $this->input->post('title');
            $parent = $this->input->post('parent');
            $url = $this->input->post('url');
            $position = $this->input->post('position');
            $description = $this->input->post('description');
            $icon = $this->input->post('icon');
            $module = $this->input->post('module');
            $alias = make_alias($title);
            $sort = $this->input->post('sort');
            $link=$this->input->post('subcat');

            if($this->input->post('module')){
                if($this->input->post('module')=='news'){
                    $url='tin-tuc/'.$link;
                } else if($this->input->post('module')=='products'){
                    $url ='danh-muc/'.$link;
                } else if($this->input->post('module')=='pages'){
                    $url ='page/'.$link;
                }
            }else{
                $url=$alias;
            }

            if($_FILES['userfile']['name'] != ''){
                if(! $this->upload->do_upload()){
                    $data['error'] = 'Ảnh quá lớn hoặc không đúng định dạng';
                }else{
                    $upload= array('upload_data' => $this->upload->data());
                    $image = 'upload/img/'.$upload['upload_data']['file_name'];

                    $arr = array('name'=>$title,'description'=>$description,'parent_id'=>$parent ,'icon'=>$image,'alias'=>$alias,'position'=>$position, 'url'=>$url,'module'=>$module,'sort'=>$sort,'icon'=>$icon);
                    $this->menu_model->UpdateMenu($id,$arr);

                    redirect(base_url('admin/danh-sach-menu'));
                }
            }else{
                $arr = array('name'=>$title,'description'=>$description,'parent_id'=>$parent ,'alias'=>$alias,'url'=>$url,'position'=>$position, 'url'=>$url,'module'=>$module,'sort'=>$sort,'icon'=>$icon);

                $this->menu_model->UpdateMenu($id,$arr);

                redirect(base_url('admin/danh-sach-menu'));
            }
        }
        $data['menu_root'] = $this->menu_model->getListRoot();
        $data['menu_chil'] = $this->menu_model->getListChil();
        $data['item1']=$item1;
        $data['headerTitle']="Sửa menu";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/menu_edit',$data);
        $this->load->view('admin/footer');
    }
    //Delete Menu
    public function deletemenu($id){
        $this->menu_model->DeleteMenu($id);
        redirect($_SERVER['HTTP_REFERER']);
    }

}