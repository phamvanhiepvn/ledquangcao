<div class="main">
    <div class="wrap">
        <div class="pro_img">
            <?php if ($pro->image == null) { ?>
                <img alt="<?php echo  ($pro->alias); ?>" title="<?php echo  ($pro->alias); ?>"
                     src="<?php echo  base_url('images/noimage.jpg'); ?>" alt=""/>
            <?php } else { ?>
                <img src="<?php echo  base_url($pro->image); ?>" alt=""/>
            <?php } ?>
        </div>
        <div class="pro_info">
            <div class="pro_name">
                <?php echo  $pro->name; ?>
            </div>
        </div>
    </div>
</div>

