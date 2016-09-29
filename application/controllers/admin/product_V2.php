<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller
{
    protected $module_name="Products";
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('productmodel');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();
        $this->Check_module($this->module_name);
    }

    public function UploadFileEx()
    {

        $config['upload_path'] = './upload/file/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = '5000';
//        $config['max_width']  = '1500';
//        $config['max_height']  = '768';
        $this->load->library('upload', $config);
        $err = '';
        if (isset($_POST['Upload'])) {
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/file/' . $upload['upload_data']['file_name'];
                    if (file_exists($image)) {
                        $this->InsertExcel($image);
                    } else return $err = 'Import thất bại!';


                    //redirect(base_url('admin/danh-sach-tin-tuc'));
                }
            } else {
                return false;
            }
        }
        $data['err'] = $err;
        $this->load->view('admin/header');
        $this->load->view('admin/UploadNumber', $data);
        $this->load->view('admin/footer');
    }

    public function InsertExcel($file)
    {
        // $file = 'upload/file/test.xlsx';
        //$file = $this->UploadFileEx();

        //load the excel library
        $this->load->library('Excel');

        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);

        //get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

            //header will/should be in row 1 only. of course this can be modified to suit your need.
            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {
                $arr_data[$row][$column] = $data_value;
            }
        }
        //send the data in an array format
        $data['header'] = $header;
        // print_r($data['header']);
        $data['values'] = $arr_data;

        foreach ($arr_data as $val) {

            if (@$val['B'] != null) {
                $this->db->set('number', @$val['B']);
                $this->db->set('network', @$val['C']);
                $this->db->set('price', @$val['D']);
                $this->db->set('type', @$val['E']);
                $this->db->set('alias', make_alias($val['B']));
                $this->db->set('head_num', substr($val['B'],0,5));
                $this->db->insert('sim');
            }

        }
    }

    public function ExportExcel(){
        // $file = 'upload/file/test.xlsx';
        //$file = $this->UploadFileEx();

        //load the excel library
        $this->load->library('Excel');

        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('test worksheet');
        //set cell A1 content with some text


        $ar=$this->productmodel->getList('sim');

            $i=3;
        foreach($ar as $v){
            $j=$i++;
            $this->excel->getActiveSheet()->setCellValue('A'.$j, $i++);
            $this->excel->getActiveSheet()->setCellValue('B'.$j, $v->number);
            $this->excel->getActiveSheet()->setCellValue('C'.$j, $v->price);
            $this->excel->getActiveSheet()->setCellValue('D'.$j, $v->network);
        }

        $this->excel->getActiveSheet()->setCellValue('A1', 'anh Nhất');



        //change the font size
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to D1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



        $filename='just_some_random_name.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

        redirect(base_url('admin'));


    }

    function open($file_name, $row_tag = "Row", $cell_tag = "Cell", $data_tag = "Data")
    {
        $dom = DOMDocument::load($file_name);

        $rows = $dom->getElementsByTagName($row_tag);

        $counter = 0;

        foreach ($rows as $row) {
            $counter++;

            $cells = $row->getElementsByTagName($cell_tag);
            $cells_array = array();

            foreach ($cells as $cell) {
                if ($data_tag != "") {
                    $data = $cell->getElementsByTagName($data_tag);

                    foreach ($data as $value) $cells_array[] = $value->nodeValue;
                } else {
                    $cells_array[] = $cell->nodeValue;
                }
            }

            $sheet_fields[] = array(
                'ROW' => $counter,
                'CELLS' => $cells_array
            );
        }
    }

//    ======================================================================================================================
    public function productlist()
    {
        if($this->input->get('name')){

            if($this->input->get('name')&&$this->input->get('name')!=''){
                $where=array('product.name'=>$this->input->get('name',true));
            }else $where=null;


            $config['page_query_string'] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['base_url'] = base_url('admin/danh-sach-san-pham?name='.$this->input->get('name'));
            $config['total_rows'] = $this->productmodel->Count_search('product',$where);
            $config['per_page'] = 20;
            $config['uri_segment'] = 3;
            $this->pagination->initialize($config);
            $data['prolist'] = $this->productmodel->Getdata_search('product',$where,null,$config['per_page'], $this->input->get('per_page'));

        }else{
            $config['base_url'] = base_url('admin/danh-sach-san-pham');
            $config['total_rows'] = $this->productmodel->count_All('product'); // xác định tổng số record
            $config['per_page'] = 20; // xác định số record ở mỗi trang
            $config['uri_segment'] = 3; // xác định segment chứa page number
            $this->pagination->initialize($config);
            $data['prolist'] = $this->productmodel->getListProduct('product', $config['per_page'], $this->uri->segment(3));
        }




        $data['cate'] = $this->productmodel->getList('product_category');
        $data['cate_root'] = $this->productmodel->getListRoot('product_category');
        $data['cate_chil'] = $this->productmodel->getListChil('product_category');
        $data['headerTitle'] = "Danh sách sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_list', $data);
        $this->load->view('admin/footer');
    }

    //===================
    public function pro_by_category($alias)
    {
        $config['base_url'] = base_url('admin/product/' . $alias);
        $config['total_rows'] = $this->productmodel->countProByCategory($alias); // xác định tổng số record
        $config['per_page'] = 20; // xác định số record ở mỗi trang
        $config['uri_segment'] = 4; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data = array();

        $data['pro_bycate'] = $this->productmodel->ProductBycategory($alias, $config['per_page'], $this->uri->segment(4));
//        print_r($data['pro_bycate']);
        $data['cate_root'] = $this->productmodel->getListRoot('product_category');
        $data['cate_chil'] = $this->productmodel->getListChil('product_category');
        $data['headerTitle'] = "Danh sách sản phẩm";

        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_by_cate', $data);
        $this->load->view('admin/footer');
    }

    public function addpro($id_edit=null)
    {
        $this->load->helper('ckeditor_helper');
        $this->load->helper('model_helper');
        $this->load->helper('thumbnail_helper');
        $this->load->library('upload');
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor',
            'path' => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "800px", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ));
        $data['ckeditor2'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor2',
            'path' => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' =>  array(
                    array( 'Source','NumberedList','BulletedList', '-', 'Bold', 'Italic', 'Underline', 'Strike' ,'-', 'Link', 'Unlink', 'Anchor','Image')
                ), //Using the Full toolbar
                'width' => "800px", //Setting a custom width
                'height' => '100', //Setting a custom height
            ));
        $data['ckeditor3'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor3',
            'path' => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' =>  array(
                    array( 'Source','NumberedList','BulletedList', '-', 'Bold', 'Italic', 'Underline', 'Strike' ,'-', 'Link', 'Unlink', 'Anchor','Image')
                ), //Using the Full toolbar
                'width' => "600px", //Setting a custom width
                'height' => '100', //Setting a custom height
            ));
        $data['btn_name']='Thêm';
        if($id_edit!=null){
            $data['edit']=$this->productmodel->getFirstRowWhere('product',array('id'=>$id_edit));
            $data['cate_selected']=$this->productmodel->getField_array('product_to_category','id_category',array('id_product'=>$id_edit));
            $data['btn_name']='Cập nhật';
        }
        $name = $this->input->post('name');
//                $category = $this->input->post('category');
        $description = $this->input->post('description');
        $keyword     = $this->input->post('keyword');
        $detail      = $this->input->post('detail');
        $price       = $this->input->post('price');
        $home        = $this->input->post('home');
        $focus       = $this->input->post('focus');
        $hot         = $this->input->post('hot');
        $design      = $this->input->post('design');
        $features    = $this->input->post('features');
        $title_seo   = $this->input->post('title_seo');
        $caption_1   = $this->input->post('caption_1');
        /*$video       =explode('=',$this->input->post('caption_1'));*/
        if (isset($_POST['addnews'])) {
            if($_POST['edit']){
                $pro = array('name'            => $name,
                             'description'     => $description,
                             'code'            => $this->input->post('code'),
                             'keyword'         => $keyword,
                             'detail'          => $detail,
                             'price'           => $price,
                             'price_sale'      => $this->input->post('price_sale'),
                             'home'            => $home,
                             'hot'             => $hot,
                             'focus'           => $focus,
                             'coupon'          => $this->input->post('coupon'),
                             'location'        => $this->input->post('location'),
                             'alias'           => make_alias($name) . '-' . $id_edit,
                             'note'            => $this->input->post('note'),
                             'description_seo' => $this->input->post('description_seo'),
                             /*'caption_1'       => $this->input->post('caption_1'),*/
                             //'color'           => implode(',', @$color),
                             //'size'            => implode(',', @$size),
                             'design'          => $design,
                             'features'        => $features,
                             'caption_1'       => $caption_1,
                             'title_seo'       => $title_seo,
                            );

                $this->productmodel->Update('product',$id_edit,$pro);
                #BEGIN: Upload image
                $this->load->library('upload');
                $pathImage = "upload/img/products/";
                #Create folder
                $dir_image = date('dmY');
                if(!is_dir($pathImage.$dir_image))
                {
                    @mkdir($pathImage.$dir_image);
                    $this->load->helper('file');
                    @write_file($pathImage.$dir_image.'/index.html', '<p>Directory access is forbidden.</p>');
                }
                //$dir_image = $data['edit']->pro_dir;
                if($dir_image == 'default')
                {
                    $dir_image = date('dmY');
                }
                $image = $data['edit']->image;
                if(!is_dir($pathImage.$dir_image))
                {
                    @mkdir($pathImage.$dir_image);
                    $this->load->helper('file');
                    @write_file($pathImage.$dir_image.'/index.html', '<p>Directory access is forbidden.</p>');
                }
                $config['upload_path'] = $pathImage.$dir_image.'/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '5000';
                $config['max_width'] = '5000';
                $config['max_height'] = '5000';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                $imageArray = '';
                if($this->upload->do_upload('userfile'))
                {
                    $uploadData = $this->upload->data();
                    if($uploadData['is_image'] == TRUE)
                    {
                        $imageArray = $uploadData['file_name'];
                    }
                    elseif(file_exists($pathImage.$dir_image.'/'.$uploadData['file_name']))
                    {
                        @unlink($pathImage.$dir_image.'/'.$uploadData['file_name']);
                    }
                    unset($uploadData);
                }
                if(isset($imageArray))
                {
                    if(file_exists($pathImage.$dir_image.'/'.$image))
                    {
                        @unlink($pathImage.$dir_image.'/'.$image);
                    }
                    for($j = 1; $j <= 3; $j++)
                    {
                        if(file_exists($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$image))
                        {
                            @unlink($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$image);
                        }
                    }
                    $this->load->library('image_lib');
                    if(file_exists($pathImage.$dir_image.'/'.$imageArray))
                    {
                        for($j = 1; $j <= 3; $j++)
                        {
                            switch($j)
                            {
                                case 1:
                                    $maxWidth = 120;#px
                                    $maxHeight = 120;#px
                                    break;
                                case 3:
                                    $maxWidth = 220;#px
                                    $maxHeight = 250;#px
                                    break;
                                default:
                                    $maxWidth = 125;#px
                                    $maxHeight = 90;#px
                            }
                            $sizeImage = size_thumbnail($pathImage.$dir_image.'/'.$imageArray, $maxWidth, $maxHeight);
                            $configImage['source_image'] = $pathImage.$dir_image.'/'.$imageArray;
                            $configImage['new_image'] = $pathImage.$dir_image.'/thumbnail_'.$j.'_'.$imageArray;
                            $configImage['maintain_ratio'] = TRUE;
                            $configImage['width'] = $sizeImage['width'];
                            $configImage['height'] = $sizeImage['height'];
                            $this->image_lib->initialize($configImage);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                        }
                    }
                    #END Create thumbnail
                }
                if($imageArray == 'none.gif')
                {
                    #Remove dir
                    $this->load->library('file');
                    if(trim($dir_image) != '' && trim($dir_image) != 'default' && is_dir('upload/img/product/'.$dir_image) && count($this->file->load('upload/img/product/'.$dir_image,'index.html')) == 0)
                    {
                        if(file_exists('upload/img/product/'.$dir_image.'/index.html'))
                        {
                            @unlink('upload/img/product/'.$dir_image.'/index.html');
                        }
                        @rmdir('upload/img/product/'.$dir_image);
                    }
                    $dir_image = 'default';
                }
                //var_dump($imageArray);die();
                $this->productmodel->Update('product',$id_edit,array(
                    'image' => $imageArray,
                    'pro_dir' => $dir_image
                ));
            }else{
                $pro = array('name'            => $name,
                             'description'     => $description,
                             'code'            => $this->input->post('code'),
                             'keyword'         => $keyword,
                             'detail'          => $detail,
                             'price'           => $price,
                             'price_sale'      => $this->input->post('price_sale'),
                             'home'            => $home,
                             'hot'             => $hot,
                             'focus'           => $focus,
                             'coupon'          => $this->input->post('coupon'),
                             'location'        => $this->input->post('location'),
                             'note'            => $this->input->post('note'),
                             'description_seo' => $this->input->post('description_seo'),
                             /*'caption_1'       => $this->input->post('caption_1'),*/
                             //'color'           => implode(',', @$color),
                             //'size'            => implode(',', @$size),
                             'design'          => $design,
                             'features'        => $features,
                             'caption_1'       => $caption_1,
                             'title_seo'       => $title_seo,
                );
                $id = $this->productmodel->Add('product', $pro);
                $alias = make_alias($name) . '-' . $id;
                $this->productmodel->Update('product', $id, array('alias' => $alias));
                $pathImage = "upload/img/products/";
                #Create folder
                $dir_image = date('dmY');
                $image = 'none.gif';
                if(!is_dir($pathImage.$dir_image))
                {
                    @mkdir($pathImage.$dir_image);
                    $this->load->helper('file');
                    @write_file($pathImage.$dir_image.'/index.html', '<p>Directory access is forbidden.</p>');
                }
                //$config['upload_path'] = './upload/img/products/';
                $config['upload_path'] = $pathImage.$dir_image.'/';
                $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
                $config['max_size'] = '5000';
                $config['max_width'] = '5000';
                $config['max_height'] = '5000';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                //$imageArray = array();
                if($this->upload->do_upload('userfile'))
                {
                    $uploadData = $this->upload->data();
                    if($uploadData['is_image'] == TRUE)
                    {
                        $image = $uploadData['file_name'];
                    }
                    elseif(file_exists($pathImage.$dir_image.'/'.$uploadData['file_name']))
                    {
                        @unlink($pathImage.$dir_image.'/'.$uploadData['file_name']);
                    }
                    unset($uploadData);
                }
                if(isset($image))
                {
                    #BEGIN: Create thumbnail
                    $this->load->library('image_lib');
                    if(file_exists($pathImage.$dir_image.'/'.$image))
                    {
                        for($j = 1; $j <= 2; $j++)
                        {
                            switch($j)
                            {
                                case 1:
                                    $maxWidth = 120;#px
                                    $maxHeight = 120;#px
                                    break;
                                case 3:
                                    $maxWidth = 200;#px
                                    $maxHeight = 170;#px
                                    break;
                                default:
                                    $maxWidth = 125;#px
                                    $maxHeight = 90;#px
                            }
                            $sizeImage = size_thumbnail($pathImage.$dir_image.'/'.$image, $maxWidth, $maxHeight);
                            $configImage['source_image'] = $pathImage.$dir_image.'/'.$image;
                            $configImage['new_image'] = $pathImage.$dir_image.'/thumbnail_'.$j.'_'.$image;
                            $configImage['maintain_ratio'] = TRUE;
                            $configImage['width'] = $sizeImage['width'];
                            $configImage['height'] = $sizeImage['height'];
                            $this->image_lib->initialize($configImage);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                        }
                    }
                    #END Create thumbnail
                }
                if($image == 'none.gif')
                {
                    #Remove dir
                    $this->load->library('file');
                    if(trim($dir_image) != '' && trim($dir_image) != 'default' && is_dir('upload/img/product/'.$dir_image) && count($this->file->load('upload/img/product/'.$dir_image,'index.html')) == 0)
                    {
                        if(file_exists('upload/img/product/'.$dir_image.'/index.html'))
                        {
                            @unlink('upload/img/product/'.$dir_image.'/index.html');
                        }
                        @rmdir('upload/img/product/'.$dir_image);
                    }
                    $dir_image = 'default';
                }
                $this->productmodel->Update('product', $id, array(
                    'image' => $image,
                    'pro_dir' => $dir_image,
                ));
            }

            if($id_edit!=null){$id=$id_edit;}else $id=$id;

            if(isset($_POST['category'])&&sizeof($_POST['category'])>0){

                $this->productmodel->Delete_where('product_to_category', array('id_product'=>$id));
                for($i=0;$i<sizeof($_POST['category']);$i++){
                    $ca = array('id_product' => $id, 'id_category' => $_POST['category'][$i]);
                    $this->productmodel->Add('product_to_category', $ca);
                }
                $this->productmodel->Update('product', $id, array('category_id'=>end($_POST['category'])));
            }


            /*if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/products/' . $upload['upload_data']['file_name'];
                    $this->productmodel->Update('product', $id, array('image' => $image,));
                    if(isset($data['edit'])&&file_exists($data['edit']->image)){
                        unlink($data['edit']->image);
                    }
                }
            }*/
            redirect(base_url('admin/danh-sach-san-pham'));

        }
        $data['cate'] = $this->productmodel->GetData('product_category',null,array('id','desc'));
        $data['tinhthanh'] = $this->productmodel->getList('province');
        $data['headerTitle'] = "Thêm sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_add', $data);
        $this->load->view('admin/footer');
    }


    //Change category product
    public function change_procate($id)
    {

        if (isset($_POST['changecate'])) {
            $idcate = $this->input->post('category');
            $arr = array('category_id' => $idcate);
            $this->productmodel->Update('product', $id, $arr);

            //danh muc
            $this->productmodel->Deltete_cate($id);

            $c = $this->productmodel->getItemByID('product_category', $idcate);
            $ca = array('id_product' => $id, 'id_category' => $idcate);
            $this->productmodel->Add('product_to_category', $ca);

            if ($c->parent_id > 0) {
                $c1 = $this->productmodel->getItemByID('product_category', $c->parent_id);
                $cate1 = array('id_product' => $id, 'id_category' => $c1->id);
                $this->productmodel->Add('product_to_category', $cate1);
                if ($c1->parent_id > 0) {
                    $c2 = $this->productmodel->getItemByID('product_category', $c1->parent_id);
                    $cate2 = array('id_product' => $id, 'id_category' => $c2->id);
                    $this->productmodel->Add('product_to_category', $cate2);
                    if ($c2->parent_id > 0) {
                        $c3 = $this->productmodel->getItemByID('product_category', $c2->parent_id);
                        $cate3 = array('id_product' => $id, 'id_category' => $c3->id);
                        $this->productmodel->Add('product_to_category', $cate3);
                    }
                }
            }

            redirect(base_url('admin/danh-sach-san-pham'));
        }

        $data['cate_root'] = $this->productmodel->getListRoot('product_category');
        $data['cate_chil'] = $this->productmodel->getListChil('product_category');
        $data['headerTitle'] = "Chuyển danh mục";

        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_changecate', $data);
        $this->load->view('admin/footer');
    }

    //Xóa
    public function deletepro($id)
    {
        if (is_numeric($id)) {
            $item=$this->productmodel->getFirstRowWhere('product',array('id'=>$id));
            $pathImage = "upload/img/products/";
            $dir_image = $item->pro_dir;
            /*if(isset($item->image)&&file_exists($item->image)) {unlink($item->image);}*/
            if(file_exists($pathImage.$dir_image.'/'.$item->image))
            {
                @unlink($pathImage.$dir_image.'/'.$item->image);
            }
            for($j = 1; $j <= 3; $j++)
            {
                if(file_exists($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$item->image))
                {
                    @unlink($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$item->image);
                }
            }
            $this->productmodel->Delete('product', $id);
            $this->productmodel->Delete_where('product_to_category',array('id_product'=>$id));
            redirect($_SERVER['HTTP_REFERER']);
        } else return false;
    }


    ///category
    public function categoryList()
    {
        $data['cate'] = $this->productmodel->GetData('product_category',null,array('sort','esc'));

        $data['headerTitle'] = 'Danh mục sản phẩm';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_cate_list', $data);
        $this->load->view('admin/footer');
    }

    public function addprocategory($id_edit=null)
    {
        $this->load->helper('ckeditor_helper');
        $this->load->helper('model_helper');
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor',
            'path' => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "650px", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ));
        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);

        $data['btn_name']='Thêm';
        $data['max_sort']=$this->productmodel->SelectMax('product_category','sort')+1;

        if($id_edit!=null){
            $data['edit']=$this->productmodel->getFirstRowWhere('product_category',array('id'=>$id_edit));
            $data['btn_name']='Cập nhật';
            $data['max_sort']=$data['edit']->sort;
        }

        if (isset($_POST['addcate'])) {

            $title = $this->input->post('name');
            $parent = $this->input->post('parent');
            $description = $this->input->post('description');
            $alias = make_alias($title);

            $cate = array('name' => $title,
                          'description' => $description,
                          'parent_id' => $parent,
                          'alias' => $alias,
                          'home' => $this->input->post('home'),
                          'hot' => $this->input->post('hot'),
                          'focus' => $this->input->post('focus'),
                          'sort' => $this->input->post('sort'),
                          'title_seo' => $this->input->post('title_seo'),
                          'keyword' => $this->input->post('keyword'),
                          'content' => $this->input->post('content'),
                          'description_seo' => $this->input->post('description_seo')
            );

            if(!empty($_POST['edit'])){
                //edit product category

                $id = $this->productmodel->Update_where('product_category',array('id'=>$id_edit),$cate);
            }else{
                //add product category
                $id = $this->productmodel->Add('product_category', $cate);
            }

            if($id_edit!=null){$id=$id_edit;}else $id=$id;
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];

                    $this->productmodel->Update_where('product_category',array('id'=>$id),array('image'=>$image));
                }
            }

            redirect(base_url('admin/danh-muc-san-pham'));
        }
        $data['cate'] = $this->productmodel->getList('product_category');

        $data['headerTitle'] = "Thêm danh mục sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_cate_add', $data);
        $this->load->view('admin/footer');
    }

    public function editcategory($id)
    {
        $this->load->helper('model_helper');

        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);

        $item = $this->productmodel->getItemByID('product_category', $id);
        if (isset($_POST['editcate_pro'])) {
            $name = $this->input->post('name');
            $parent = $this->input->post('parent');
            $description = $this->input->post('description');
            $home = $this->input->post('home');
            $alias = make_alias($name);
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];

                    $cate = array(
                        'name' => $name,
                        'description' => $description,
                        'parent_id' => $parent,
                        'image' => $image,
                        'alias' => $alias,
                        'home' => $home
                    );

                    $this->productmodel->Update('product_category', $id, $cate);

                    redirect(base_url('admin/danh-muc-san-pham'));
                }
            } else {
                $cate = array('name' => $name, 'description' => $description, 'parent_id' => $parent, 'alias' => $alias);

                $this->productmodel->Update('product_category', $id, $cate);

                redirect(base_url('admin/danh-muc-san-pham'));
            }
        }
        $catelist = $this->productmodel->getList('product_category');
        $data['cate'] = $catelist;
        $data['item'] = $item;
        $data['headerTitle'] = "Sửa sản danh mục sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_cate_edit', $data);
        $this->load->view('admin/footer');
    }

    public function deletecategory($id)
    {
        if (is_numeric($id)) {
            $this->productmodel->Delete('product_category', $id);
            $this->productmodel->Delete_Where('product_category', array('parent_id'=>$id));
            redirect($_SERVER['HTTP_REFERER']);
        } else return false;
    }


    //Them anh cho san pham===========================
    public function productimages($id)
    {
        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '5000';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';

        $this->load->library('upload', $config);

        $pro=$this->productmodel->getFirstRowWhere('product',array('id'=>$id));
        $data['product_name'] = $pro->name;

        if(isset($_POST['Upload'])){

            $db_data = array(
                             'link' => '',
                             'title' => $this->input->post('title'),
                             'id_item' => $id
            );
            if(isset($_POST['edit'])&&$_POST['edit']!=null){
                $this->productmodel->Update_where('images',array('id'=>$_POST['edit']),array('title' => $this->input->post('title'),));
                $id_img=$_POST['edit'];
            }else{
                $id_img=$this->productmodel->Add('images',$db_data);
            }
            if(!empty($_FILES['userfile'])){
                $name_array = array();
                $count = count(@$_FILES['userfile']['size']);
                foreach ($_FILES as $key => $value) {

                    for ($s = 0; $s <= $count - 1; $s++) {
                        $_FILES['userfile']['name'] = $value['name'][$s];
                        $_FILES['userfile']['type'] = $value['type'][$s];
                        $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
                        $_FILES['userfile']['error'] = $value['error'][$s];
                        $_FILES['userfile']['size'] = $value['size'][$s];

                        $this->upload->do_upload();

                        $data = $this->upload->data();
                        $name_array[] = $data['file_name'];
                        if ($data['file_name'] != null) {

                            //$name=make_alias($data['file_name']);
                            $link = 'upload/img/' . $data['file_name'];

                            $id_i = $this->productmodel->Update_where('images',array('id'=>$id_img),array('link' => $link,));

                        }
                    }
                }
            }
            redirect($_SERVER['HTTP_REFERER']);
        }



        $data['pro_image'] = $this->productmodel->getProImage($id);
        $data['id'] = $id;

        $data['headerTitle'] = "Ảnh sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_images', $data);
        $this->load->view('admin/footer');
    }

    //ajax
    public function popupdata()
    {
        if (isset($_POST['id'])) {
            $item        = $this->productmodel->getFirstRowWhere('images', array('id' => $_POST['id']));
            $arr         = (array)$item;
        }
        echo json_encode(@$arr);

    }

}