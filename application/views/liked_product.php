<?php
$stt=1;
if(isset($liked)){
    $str='';
    foreach($liked as $l){
        $j  = $stt++;
        $id = 'pro' . $j;
        $str.='
            <div id="'.$id.'" style="font-size:11px;clear: both;padding:5px ">

                <a href="'.base_url('san-pham'.'/'.$l->alias).'" style="width:20%; float:left; display:block">
                <img src="'.base_url($l->image).'" style="width:100%;"/>
                </a>
                <a href="'.base_url('san-pham'.'/'.$l->alias).'" style="width:80%; float:left; display:block; color:#333; padding-left:5px">'.$l->name.'</a>
                <div style="width:40%; float:left; display:block; color:#ac0000;padding-left:5px  ">'.number_format($l->price).'<sup>đ</sup></div>
                <div style="width:40%; float:left; display:block; color:#333; text-align:right ">
                <a  data-items="'.$id.'" style="color:red;cursor: pointer"
                   onclick="un_like('.$l->id.',$(this).attr(\'data-items\'))"> xóa</a>
                </div>

            </div> ';
    }
}else{
    $str='
     <li style="color: #ccc" >
        Không có sản phẩm nào!
    </li>
    ';
}
echo $str;
?>