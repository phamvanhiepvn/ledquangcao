<div class="wrap">
    <div class="pro_img">
        <?php if ($pro_first->image == null) { ?>
            <img alt="<?php echo  ($pro_first->alias); ?>" title="<?php echo  ($pro_first->alias); ?>"
                 src="<?php echo  base_url('images/noimage.jpg'); ?>" alt=""/>
        <?php } else { ?>
            <img src="<?php echo  base_url($pro_first->image); ?>" alt=""/>
        <?php } ?>
    </div>
    <div class="pro_info">
        <div class="pro_name">
            <?php echo  $pro_first->name; ?>
        </div>
        <div class="pro_detail">
            <table>
                <?php echo  $pro_first->detail; ?>
            </table>

        </div>
    </div>
</div>