<div id="page-wrapper">

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo  base_url('admin')?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Quản lý nội dung trang service
                    </li>
                    <?php if(isset ($error)){?>
                        <li class="">
                            <span style="color: red"> <?php echo  $error;?></span>
                        </li>
                    <?php }?>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="body collapse in" id="div1">
                    <form class="form-horizontal" role="form" id="form1" method="POST" action="" enctype="multipart/form-data" >
                        <input type="hidden" value="<?php echo isset($editpage)?$editpage:null ?>" name="editpage"/>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Text head :</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="text_head" placeholder="Text head" value="<?php echo @$home->text_head ?>"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Text middle :</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="text_middle" placeholder="Text small" value="<?php echo @$home->text_middle ?>"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Description :</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="description" placeholder="Description"  value="<?php echo @$home->description ?>" />
                            </div>
                        </div>
                        <div class="wrap-parent-column">
                            <div class="wrap-icon"><a class="text-right"><i class="fa fa-chevron-circle-down"></i></a></div>
                            <div class="wrap-column">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 1 icon: </label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control " name="column_top_1_icon" value="<?php echo @$home->column_top_1_icon ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 1 text :</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control " name="column_top_1_text" placeholder="Column top 1 text" value="<?php echo @$home->column_top_1_text ?>"   />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 1 content :</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control " name="column_top_1_content"><?php echo @$home->column_top_1_content ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 2 icon: </label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control " name="column_top_2_icon" value="<?php echo @$home->column_top_2_icon ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 2 text :</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control " name="column_top_2_text" placeholder="Column top 2 text" value="<?php echo @$home->column_top_2_text ?>"   />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 2 content :</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control " name="column_top_2_content"><?php echo @$home->column_top_2_content ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 3 icon: </label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control " name="column_top_3_icon" value="<?php echo @$home->column_top_3_icon ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 3 text :</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control " name="column_top_3_text" placeholder="Column top 3 text" value="<?php echo @$home->column_top_3_text ?>"   />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 3 content :</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control " name="column_top_3_content"><?php echo @$home->column_top_3_content ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 4 icon: </label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control " name="column_top_4_icon" value="<?php echo @$home->column_top_4_icon ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 4 text :</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control " name="column_top_4_text" placeholder="Column top 4 text" value="<?php echo @$home->column_top_4_text ?>"   />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 4 content :</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control " name="column_top_4_content"><?php echo @$home->column_top_4_content ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 5 icon: </label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control " name="column_top_5_icon" value="<?php echo @$home->column_top_5_icon ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 5 text :</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control " name="column_top_5_text" placeholder="Column top 5 text" value="<?php echo @$home->column_top_5_text ?>"   />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 5 content :</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control " name="column_top_5_content"><?php echo @$home->column_top_5_content ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 6 icon: </label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control " name="column_top_6_icon" value="<?php echo @$home->column_top_6_icon ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 6 text :</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control " name="column_top_6_text" placeholder="Column top 6 text" value="<?php echo @$home->column_top_6_text ?>"   />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 6 content :</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control " name="column_top_6_content"><?php echo @$home->column_top_6_content ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 7 icon: </label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control " name="column_top_7_icon" value="<?php echo @$home->column_top_7_icon ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 7 text :</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control " name="column_top_7_text" placeholder="Column top 7 text" value="<?php echo @$home->column_top_7_text ?>"   />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 7 content :</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control " name="column_top_7_content"><?php echo @$home->column_top_7_content ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 8 icon: </label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control " name="column_top_8_icon" value="<?php echo @$home->column_top_8_icon ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 8 text :</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control " name="column_top_8_text" placeholder="Column top 8 text" value="<?php echo @$home->column_top_8_text ?>"   />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 8 content :</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control " name="column_top_8_content"><?php echo @$home->column_top_8_content ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 9 icon: </label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control " name="column_top_9_icon" value="<?php echo @$home->column_top_9_icon ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 9 text :</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control " name="column_top_9_text" placeholder="Column top 9 text" value="<?php echo @$home->column_top_9_text ?>"   />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column top 9 content :</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control " name="column_top_9_content"><?php echo @$home->column_top_9_content ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="text-center" style="padding-bottom: 15px">
                            <button type="submit" class="btn btn-success btn-sm" name="addpage"><i class="fa fa-check"></i> Thêm</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>