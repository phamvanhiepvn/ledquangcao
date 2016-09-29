<section id="body">
    <div class="content">
        <h3>Kết quả tìm kiếm</h3>
        <div style="width: 20%"><hr></div>
        <?php if($lists) : ?>
            <div class="row">
                <?php foreach ($lists as $key => $val) : ?>
                    <?php if(($key % 3 == 0) && ($key >=3)){echo "<div class='clear'></div></div><div class='row'>";}?>
                    <div class="item">
                        <div class="item_img">
                            <?php if(!empty($val->pro_image)) : ?>
                                <a href="<?php echo base_url('san-pham/'.$val->pro_alias);?>"><img src="<?php echo  base_url($val->pro_image) ?>" /></a>
                            <?php else :?>
                                <a href="<?php echo base_url('san-pham/'.$val->pro_alias);?>"><img src="<?php echo  base_url('upload/img/noimage.jpg') ?>" /></a>
                            <?php endif;?>
                        </div><!---End.item_img--->
                        <div class="item_f">
                            <p class="item_title"><a href="<?php echo base_url('san-pham/'.$val->pro_alias);?>"><?php echo $val->pro_name?></a></p>
                            <p class="item_price">Giá:&nbsp;<?php echo number_format($val->price,0,'', '.');?> đ</p>
                            <p class="item_text">
                                <a href="<?php echo base_url('san-pham/'.$val->pro_alias);?>"><span class="chitiet left">Chi tiết</span></a>
                                <a href="#"><span class="chitiet right">Download</span></a>
                            <div style="clear:both"></div>
                            </p>
                        </div><!---Enditem_title--->
                    </div><!---EndItem--->
                <?php endforeach;?>
                <div style="clear: both"></div>
            </div><!---End.row-->
        <?php else :?>
            <br/>
            <p>Không tìm thấy sản phẩm nào !!!</p>
        <?php endif;?>
    </div><!--End.Content--->
</section>