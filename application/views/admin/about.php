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
                        <i class="fa fa-table"></i> Quản lý nội dung trang about
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
                                        <input type="file" class="form-control " name="column_top_1_icon"/>
                                        <?php if(isset($home->column_top_1_icon) && $home->column_top_1_icon!=""){ ?>
                                            <img class="display" src="<?php echo base_url($home->column_top_1_icon) ?>" />
                                        <?php }?>
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


                            </div>
                        </div>
                        <div class="wrap-parent-column">
                            <div class="wrap-icon"><a class="text-right"><i class="fa fa-chevron-circle-down"></i></a></div>
                            <div class="wrap-column wrap-column-about">

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column bot 1 text :</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control " name="column_bot_1_text" placeholder="Column bot 1 text"  value="<?php echo @$home->column_bot_1_text ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column bot 1 content :</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control " name="column_bot_1_content"><?php echo @$home->column_bot_1_content ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column bot 2 text :</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control " name="column_bot_2_text" placeholder="Column bot 2 text" value="<?php echo @$home->column_bot_2_text ?>"  />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column bot 2 content :</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control " name="column_bot_2_content"><?php echo @$home->column_bot_2_content ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column bot 3 text :</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control " name="column_bot_3_text" placeholder="Column bot 3 text" value="<?php echo @$home->column_bot_3_text ?>"  />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Column bot 3 content :</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control " name="column_bot_3_content"><?php echo @$home->column_bot_3_content ?></textarea>
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