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
            <i class="fa fa-table"></i> Get Data
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
                <label for="inputEmail1" class="col-lg-2 control-label">Nhập URL <span
                        style="color: red">* </span>:</label>

                <div class="col-lg-10">
                    <input type="text" class="form-control input-sm " name="url"
                           value="<?php echo @$url; ?>" placeholder="URL"/>
                </div>
            </div>
            <div class="wrap_show_content" style="display: <?php if(isset($show)){ echo "block"; }else{ echo "none"; } ?>">
                <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">Images :</label>

                    <div class="col-lg-10">
                        <img src="<?php echo @$image; ?>" style="width: 500px;"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">Content :</label>

                    <div class="col-lg-10">
                        <textarea name="content" class="form-control"
                                  id="ckeditor"><?php echo @$content; ?></textarea>
                        <?php echo display_ckeditor($ckeditor); ?>
                    </div>
                </div>

            </div>

            <input type="hidden" id="baseurl" value="<?php echo base_url();?>">

            <div class="form-group">
                <label for="inputEmail1" class="col-lg-2 control-label "> </label>

                <div class="col-lg-5">
                    <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm" name="getdata"><i class="fa fa-save"></i> Get Data
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