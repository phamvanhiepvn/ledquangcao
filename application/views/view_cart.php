<div class="modal-header">
    <span class="caption" id="caption">Bạn có <span class="cart_qty"><?php echo $this->count_cart;?></span> sản phẩm trong giỏ hàng</span>
    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
    <a href="javascript:void(0);" onclick="set_location('index.html')" title="Tiếp tục mua hàng" class="ttmh">Tiếp
        tục mua hàng</a>
</div>
<!-- <div class="modal-dialog">     -->
<!-- <div class="modal-content"> -->
<div class="modal-body">
    <div class="ssmain-popupcart">
        <div class="cont-pp-shopping-cart mCustomScrollbar _mCS_1" style="overflow: hidden;"><div class="mCustomScrollBox mCS-light" id="mCSB_1" style="position: relative; height: 100%; overflow: hidden; max-width: 100%; max-height: 430px;"><div class="mCSB_container mCS_no_scrollbar" style="position: relative; top: 0px;">
                    <div class="block-cart">
                        <span title="" class="ic-minus">&nbsp;</span>
                        <div class="box-cart">
                            <div class="product_in_order">
                                <div class="title">
                                    <div class="name_shop">
                                        <div class="shop">
                                            <a href="#" target="_blank" title="website">Santhuonghieu.vn</a>&nbsp;Mẫu website
                                        </div>

                                    </div>
                                    <div class="sl">Số lượng</div>
                                    <div class="gt">Giá thành</div>
                                    <div class="tt">Tổng tiền</div>
                                    <div class="sl"></div>
                                </div>
                                <div class="prods-list" id="cats-list">
                                    <!---product_box--->
                                    <?php if(!empty($pro_cats)) :?>
                                        <?php
                                        $total = 0;
                                        $subtotal = 0;
                                        ?>
                                        <?php foreach($pro_cats as $cat) :?>
                                            <?php
                                            $subtotal = $cat['qty']*$cat['price'];
                                            $total += $subtotal;
                                            ?>
                                            <div class="product_box">
                                                <form action="https://www.sendo.vn/checkout/cart/update/30904fb50487094d3ebb36f18bc525d6/" method="post" class="ng-pristine ng-valid">
                                                    <div class="img_product">
                                                        <div class="img">
                                                            <a href="#" title="<?php echo $cat['name']?>" class="product-image">
                                                                <img width="75" height="75" src="<?php echo base_url($cat['image'])?>" alt="<?php echo $cat['name'];?>">
                                                            </a>
                                                        </div>
                                                        <div class="name_attr">
                                                            <div class="name">
                                                                <h2 class="product-name">
                                                                    <a href="#"><?php echo $cat['name'];?></a></h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="sl">
                                                        <input onchange="update_cart(<?php echo $cat['rowid']?>,$(this).val())" type="number" min="1"  class="input-text qty" title="Số lượng" size="8" value="<?php echo $cat['qty'];?>" onkeypress="return only_number_key(event)" name="qty">
                                                        <!---<button class="button btn-update" title="Cập nhật" value="update_qty" name="update_cart_action" onclick="popup_update_quantity('https://www.sendo.vn/checkout/cart/update/30904fb50487094d3ebb36f18bc525d6/',this,'update_qty',event);"><span>Cập nhật</span></button>--->
                                                    </div>
                                                    <div class="gt">
                                                        <span class="price"><?php echo number_format($cat['price'])?>&nbsp;VNĐ</span>
                                                    </div>
                                                    <div class="tt">
                                                        <span class="price" id="item_total_<?php echo $cat['rowid'];?>"><?php echo number_format($subtotal)?>&nbsp;VNĐ</span>
                                                    </div>
                                                    <div class="sl">
                                                        <a href="#" onclick="delete_cart(<?php echo $cat['rowid'];?>)" class="btn btn-danger btn-xs">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endforeach;?>
                                        <!---Endproduct-box--->
                                        <div class="cart-payment util-clearfix" id="cart-payment8418">
                                            <div class="cp-left">
                                                <script type="text/javascript">
                                                    $(document).ready(function(){
                                                        $('.tooltip-checkout').tooltip();
                                                    });
                                                </script>
                                                <a href="<?php echo base_url();?>" title="Mua sản phẩm khác của giaodiendep.vn" class="other-prods">Mua sản phẩm khác của shop</a>
                                            </div>
                                            <ul class="cart-total">
                                                <!--<div class="cart-total-price"> <span>Tổng thanh toán: </span><strong>&nbsp;VNĐ</strong> </div>-->

                                                <!--<li>
                                                    <span class="fl">
                                                    Phí thực trả:
                                                    </span>
                                                    <span class="fr">&nbsp;VNĐ</span>
                                                </li>-->
                                                <li>
                                                    <span class="fl red basegrandtotal label"><strong>Tổng thành tiền</strong></span>
                                                    <i class="points">:</i>
                                                    <span class="fr red basegrandtotal"><strong id="total_cart"><?php echo number_format($total)?>&nbsp;VNĐ</strong></span>
                                                </li>


                                                <li class="cart-total-btn">

                                                    <a href="<?php echo base_url('shoppingcart/check_out');?>" class="btn-pay"
                                                       title="Thanh toán" >
                                                        Đặt hàng
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    <?php endif;?>
                                </div>
                                <!--product_box-->
                            </div>
                            <!--product_in_order-->
                            <script></script>
                        </div>
                        <!--box-cart-->
                    </div>
                </div><div class="mCSB_scrollTools" style="position: absolute; display: none;"><div class="mCSB_draggerContainer"><div class="mCSB_dragger" style="position: absolute; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="position:relative;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
    </div>
</div>