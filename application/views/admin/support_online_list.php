<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?php echo  base_url('admin') ?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Support online
                    </li>
                    <?php if (isset ($error)) { ?>
                        <li class="">
                            <span style="color: red"> <?php echo  $error; ?></span>
                        </li>
                    <?php } ?>
                </ol>
            </div>

            <div class="col-lg-12">
                <div class="clear"></div>
                <div class="">
                    <a href="<?php echo  base_url('admin/support-online')?>" class="btn btn-success btn-xs" style="margin-bottom: 5px">
                        <i class="fa fa-plus"></i> Thêm</a>

                </div>
                <table class="table tabbable-bordered">
                    <tr>
                        <th width='5%'>STT</th>
                        <th>Avatar</th>
                        <th width='15%'>Họ tên</th>
                        <td width="15%">Phone</td>
                        <th width='15%'>Email</th>
                        <th width='15%'>Skype</th>
                        <th width='15%'>Facebook</th>
                        <th width='10%'>#</th>
                    </tr>

                    <?php if(isset($list)){
                        $stt=1;
                        foreach($list as $v){?>

                            <tr>
                                <td><?php echo  $stt++;?></td>
                                <td><img src="<?php echo base_url($v->image)?>" width="50" height="50"></td>
                                <td><?php echo  $v->name;?></td>
                                <td><?php echo @$v->phone;?></td>
                                <td><?php echo  $v->email;?></td>
                                <td><?php echo  $v->skype;?></td>
                                <td><?php echo  $v->yahoo;?></td>
                                <td>
                                    <a href="<?php echo  base_url('admin/support-online/'.$v->id);?>" class="btn btn-primary btn-xs">Sửa</a>
                                    <a href="<?php echo  base_url('admin/support-online/delete/'.$v->id);?>" class="btn btn-danger btn-xs">Xóa</a>
                                </td>
                            </tr>


                        <?php   }
                    }?>



                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>

