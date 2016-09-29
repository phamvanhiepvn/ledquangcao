<div class="">

<?php
if(isset($comments)&& !empty($comments)){?>


    <h2 class="page-header"> </h2>
        <?php foreach($comments as $v){
            if($v->reply==0){
                ?>
                <!-- First Comment -->
                <article class="row">

                    <div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <figure class="thumbnail">
                                <?php if(file_exists($v->avatar)){?>
                                    <img class="img-responsive" src="<?php echo base_url($v->avatar)?>" />
                                <?php  }else{?>
                                <img class="img-responsive" src="<?php echo base_url('img/default-avatar.jpg')?>" />
                                <?php }?>
                            </figure>
                        </div>
                        <div class="col-md-10 col-sm-10 col-xs-10">
                            <div class="row">
                                <header class="text-left">
                                    <div class="comment-user"><i class="fa fa-user"></i> <?php echo $v->fullname;?></div>
                                    <time class="comment-date" datetime="<?php echo  date('d-m-Y H:i',$v->time);?>"><i class="fa fa-clock-o"></i> <?php echo  date('d-m-Y',$v->time);?></time>
                                </header>

                                <div class="comment-post">
                                    <p>
                                        <?php echo  $v->comment;?>
                                    </p>
                                </div>
                                <p class="btn-reply"><a
                                        <?php if($this->session->userdata('userid')){?>
                                            onclick="show_reply('<?php echo $v->id?>')"
                                        <?php  }else{?>
                                            data-toggle="modal" data-target=".bs-example-modal-sm"
                                        <?php  }?>

                                        >Trả lời</a> </p>

                                <?php
                                foreach($comments_sub as $v2){
                                    if($v2->reply==$v->id){ ?>
                                        <!-- Second Comment Reply -->
                                        <article class="">
                                            <div class="col-md-2 col-sm-2   col-xs-2">
                                                <figure class="thumbnail">
                                                    <?php if(file_exists($v2->avatar)){?>
                                                        <img class="img-responsive" src="<?php echo base_url($v2->avatar)?>" />
                                                    <?php  }else{?>
                                                        <img class="img-responsive" src="<?php echo base_url('img/default-avatar.jpg')?>" />
                                                    <?php }?>


                                                </figure>
                                            </div>

                                            <div class="col-md-10 col-sm-10 col-xs-10">

                                                <div class="row">
                                                    <div class="panel-body row" style="padding-top: 0px">
                                                        <header class="text-left">
                                                            <div class="comment-user"><i class="fa fa-user"></i> <?php echo $v2->fullname;?></div>
                                                            <time class="comment-date" datetime="<?php echo  date('d-m-Y H:i',$v2->time);?>">
                                                                <i class="fa fa-clock-o"></i> <?php echo  date('d-m-Y H:i',$v2->time);?></time>
                                                        </header>
                                                        <div class="comment-post">
                                                            <p>
                                                                <?php echo  @$v2->comment;?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    </div>

                                            </div>
                                        </article>
                                        <!-- Third Comment -->
                                    <?php }
                                }?>

                                <article class="row" style="display: none" id="<?php echo $v->id?>">
                                    <div class="col-md-2 col-sm-2   hidden-xs">
                                        <figure class="thumbnail">
                                            <img class="img-responsive" src="<?php echo base_url('img/default-avatar.jpg')?>" />
                                        </figure>
                                    </div>


                                    <div class="col-md-10 col-sm-10" >

                                        <div class="row">
                                            <div style="position: relative;"  >
                                                <textarea  class="form-control"
                                                           id="txt_<?php echo $v->id?>"
                                                           onblur="blur_comments('<?php echo $v->id?>',$(this))"></textarea>
                                                <button style="position: absolute; top: 10px; right: 10px"
                                                        data-content="txt_<?php echo $v->id?>" data-reply="<?php echo $v->id?>"
                                                        data-items="<?php echo $product_id;?>"
                                                        onclick="send_reply($(this))"
                                                    >Gửi</button>
                                            </div>
                                        </div>

                                    </div>
                                </article>

                            </div>


                        </div>
                    </div>

                </article>

                        <!-- Third Comment -->
                    <?php
            }
        }?>

    <a onclick="show_comment()" style="cursor: pointer">Xem thêm</a>

<?php }
else echo '<div class="row">Chưa có bình luận nào.</div>';
?>

</div>
<style>
    .comment-date{
        font-size: 12px;
        opacity: 0.9;
    }
</style>
