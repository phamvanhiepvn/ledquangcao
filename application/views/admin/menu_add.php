<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
        </li>
        <li class="active">
            <i class="fa fa-table"></i> Thêm danh menu
        </li>
        <?php if (isset ($error)) { ?>
            <li class="">
                <span style="color: red"> <?php echo  $error; ?></span>
            </li>
        <?php } ?>
    </ol>
</div>
<div class="col-md-12">

    <div class="body collapse in" id="div1">
        <form class="form-horizontal" role="form" id="form1" method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="edit_id" value="<?php echo @$id_edit;?>">
            <div class="form-group">
                <label for="inputEmail1" class="col-lg-2 control-label">Tên menu <span
                        style="color: red">* </span>:</label>

                <div class="col-lg-5">
                    <input type="text" class="form-control input-sm " name="title"
                           value="<?php echo @$edit->name;?>" placeholder="Tên menu"/>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail1" class="col-lg-2 control-label">Menu cha:</label>

                <div class="col-lg-5">
                    <select name="parent" class="form-control input-sm">
                        <option value="0">Root</option>
                        <?php show_menu_select($menu,0,'',@$edit->parent_id);?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Vị trí:</label>

                <div class="col-lg-5">
                    <select name="position" class="form-control input-sm">
                        <option value="top"
                            <?php echo @$edit->position=='top'?'selected':''?>
                            <?php echo $this->input->get('p')=='top'?'selected':''?>
                            >Top (Trên)</option>
                        <option value="left"
                            <?php echo @$edit->position=='left'?'selected':''?>
                            <?php echo $this->input->get('p')=='left'?'selected':''?>
                            >Left (Trái)</option>
                        <option value="right"
                            <?php echo @$edit->position=='right'?'selected':''?>
                            <?php echo $this->input->get('p')=='right'?'selected':''?>
                            >Right (Phải)</option>
                        <option value="bottom" <?php echo @$edit->position=='bottom'?'selected':''?>
                            <?php echo $this->input->get('p')=='bottom'?'selected':''?>
                            >Bottom (Dưới)</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Icon:</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm " name="icon"
                           value="<?php echo @$edit->icon;?>" placeholder="Nhập class icon"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Module:</label>

                <div class="col-lg-3">
                    <select name="module" id="sc_get" class="form-control input-sm">
                        <option value="0">Chọn module</option>
                        <option value="news" <?php echo @$edit->module=='news'?'selected':''?> >Tin tức</option>
                        <option value="products" <?php echo @$edit->module=='products'?'selected':''?> >Sản phẩm</option>
                        <option value="pages" <?php echo @$edit->module=='pages'?'selected':''?> >Trang tĩnh</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Danh mục:</label>

                <div class="col-lg-3">
                    <select name="subcat" id="sc_show" class="form-control input-sm">
                        <?php echo isset($cate_edit)?'<option value="'.$cate_edit->alias.'">'.$cate_edit->name.'</option>':''?>
                    </select>
                </div>
            </div>

            <input type="hidden" id="baseurl" value="<?php echo base_url();?>">
            <script>

                function getXMLHTTP() { //fuction to return the xml http object
                    var xmlhttp = false;
                    try {
                        xmlhttp = new XMLHttpRequest();
                    }
                    catch (e) {
                        try {
                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        catch (e) {
                            try {
                                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                            }
                            catch (e1) {
                                xmlhttp = false;
                            }
                        }
                    }

                    return xmlhttp;
                }
                //Script for getting the dynamic values from database using jQuery and AJAX
                $(document).ready(function () {
                    $('#sc_get').change(function () {
                        var baseurl = $("#baseurl").val();
                        var form_data = {
                            name: $('#sc_get').val()
                        };
                        $.ajax({
                            url: baseurl+"admin/menu/get_subcat",
                            type: 'POST',
                            dataType: 'json',
                            data: form_data,
                            success: function (rs) {
                                show_cate(rs.cat);
                            }
                        });
                    });
                });


                function show_cate(module) {

                    var baseurl = $("#baseurl").val();
                    var strURL = baseurl + "admin/menu/cate_show/"+module ;
                    var req = getXMLHTTP();

                    if (req) {

                        req.onreadystatechange = function () {
                            if (req.readyState == 4) {
                                // only if "OK"
                                if (req.status == 200) {

                                    document.getElementById('sc_show').innerHTML = req.responseText;

                                } else {
                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                }
                            }
                        }
                        req.open("GET", strURL, true);
                        req.send(null);
                    }
                }
            </script>


            <div class="form-group">
                <label class="col-lg-2 control-label">Ảnh:</label>

                <div class="col-lg-3">
                    <input type="file" name="userfile"  />
                    <?php echo  file_exists(@$edit->icon)?'<br/><img src="'.base_url($edit->icon).'" style="width: 100px"/>':''?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail1" class="col-lg-2 control-label">Mô Tả:</label>

                <div class="col-lg-5">
                    <textarea name="description"
                              class="form-control input-sm" placeholder="Mô tả" ><?php echo @$edit->description;?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail1" class="col-lg-2 control-label "> </label>

                <div class="col-lg-5">
                    <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm" name="addmenu"><i class="fa fa-save"></i> Lưu
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<!-- /.row -->


<!-- /.row -->


<!-- /.row -->


<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>