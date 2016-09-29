
<div id="home-news">
    <?php foreach($cate_home as $k => $cathome) :  ?>
    <h1 class="heading"><?=@$cathome->name;?></h1>
                    <ul class="product-list">
                    <?php foreach($product as $list) : ?>
                        <?php if($list->category_id == $cathome->id) : ?>
                            <li class="product-item">
                                <div class="product-img">
                                    <a title="<?php echo $list->name; ?>" href="<?php echo base_url("san-pham/".@$list->alias); ?>" class="img">
                                        <img height="225" width="300" alt="<?php echo $list->name; ?>" class="attachment-medium wp-post-image" src="<?php echo base_url(@$list->image); ?>"></a>
                                </div>
                                <a title="<?=@$list->name;?>" href="<?php echo base_url("san-pham/".@$list->alias); ?>" class="product-title"><?php echo $list->name; ?></a>
                                <p class="price">
                                    Giá:
                                    <?=@$list->price;?> VNĐ</p>
                            </li>
                        <?php endif;?>
                    <?php endforeach;?>
                </ul>
    <?php endforeach;?>
</div>