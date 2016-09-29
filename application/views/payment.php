<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="top-content">
                <div class="breadcrumb_detail util-clearfix" xmlns:v="#" itemprop="breadcrumb">
                    <div class="br first" typeof="v:Breadcrumb">
                        <a title="santhuonghieu.vn" href="<?php echo base_url();?>" rel="v:url" property="v:title">
                            Trang chủ</a></div>
                    <div class="br end link" typeof="v:Breadcrumb">
                        <a href="#">
                            Đặt hàng thành công
                        </a>
                    </div>
                </div>
                <!-- <div class="login_box small-b util-clearfix" style="margin-top:6px">
                        </div> -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <center>
                <img  src="<?php echo base_url('assets/img/payment.png')?>" alt=""/>
            </center>
        </div>
    </div>
</div>

<script type="text/javascript">
    function newpage()
    {
        self.location = "<?php echo base_url();?>"; //Mở 1 trang mới có địa chỉ là b.html
    }
    setTimeout("newpage()",5000); //Goi hàm "newpage" sau 1 giây
</script>