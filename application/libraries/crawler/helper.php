<?php


class Helper{
    public static function fix_price($str = ''){
        if(!empty($str)){
            $str = preg_replace("/[^\d+|.]/","", $str);
        }
        else{
            $str = 0;
        }
        return $str; 
    }
    public static function fixedHref($str = ''){
        if(!empty($str)){
             $strArr = self::checkHref($str);
             if(!empty($strArr)){
                $str = "http://www.trananh.vn".$str;  
             }
             else{
                $str = "http://www.trananh.vn/".$str;  
              
             }
        }
        return $str; 
    }


    public static function getCateId($str = ''){
        if(!empty($str)){
             $strArr = self::checkHref($str);
             if(!empty($strArr)){
                $temp = explode('/', $str);   
             }
             else{
                $str = "/".$str;
                $temp = explode('/', $str);
             }
        }
        else{
            $temp = null;
        }
        return count($temp); 
    }
    public static function checkHref($str='')
    {
        $matches = array();
        $regex = "/^\//";
        preg_match_all($regex, $str, $matches);
        return $matches[0];
    }
    public static function extract_url($str=""){
        $matches = array();
        preg_match_all('!https?://\S+!', $str, $matches);
        $url = str_replace("',this)","Peter",$matches[0]);
        $url_extract = explode("',",$url[0]);
        return $url_extract[0];
    }
    public static function getInbetweenStrings($start, $end, $str){
        $matches = array();
        $regex = "/$start([a-zA-Z0-9_]*)$end/";
        preg_match_all($regex, $str, $matches);
        return $matches[1];
    }
    public static function check_Asin($str){
        $matches = array();
        $regex = "/^(B|\d|b)(\w{9})/";
        preg_match_all($regex, $str, $matches);
        return $matches[0];
    }

    public static function check_Seller_Id($str){
        $matches = array();
        $regex = "/^(A)(\w{13}|\w{14}|\w{15})/";
        preg_match_all($regex, $str, $matches);
        return $matches[0];
    }
    public static  function get_quantity($str='')
    {
        if ($str == '')
            return 1;
        else
            return trim($str);
    }
    public static function check_prime_product ($str='')
    {
        if (strpos($str, 'Prime'))
            return true;
        return false;
    }

    public static function get_asin($str = '')
    {
        if($str != null){
            $str_arr = self::getInbetweenStrings('\/dp\/', '\/ref=', $str);
            $asin = self::fix_Asin($str_arr[0]);
            return $asin;
        }
        else{
            $str_arr = '';
        }
        return $str_arr[0];
    }
    public static function get_asin2($str = '')
    {
        if($str != null){
            $str_arr = self::getInbetweenStrings('\/dp\/', '?', $str);
            if (isset($str_arr[0]))
            {
                $asin = self::fix_Asin($str_arr[0]);
                return $asin;
            }
        }
        else{
            $str_arr = '';
        }
        return $str_arr;
    }

    public static function get_mechantsId_2($str = ''){
        if($str != null) {
            $temp = explode('/', $str);
            if (strpos($temp[4], 'ref=olp_merch') !== false) {
                $temp = explode('=', $str);
                $str = ucfirst(end($temp)); #Make the first letter in merchant id uppercase and validate if it is 'A'. If not, skip
            } else {
                $str = ucfirst($temp[4]); #Make the first letter in merchant id uppercase and validate if it is 'A'. If not, skip
            }
        }
        else{
            $str = '';
        }
        return $str;
    }
    public static function get_deliverytime($str = '')
    {
        if (strpos($str, 'Arrives between')) //For English HTML Page
        {
            $str = str_replace("Arrives between", "", $str);
            $temp = trim($str);
            $temp = trim($temp, '.');
            $temp = explode('-', $temp);
            $time_from = $temp[0] . ' ' . date('Y');
            $time_to = trim($temp[1]);
            $temp = explode(' ', $time_from);
            $month_from = $temp[0];
            is_numeric($time_to) ? $time_to = $month_from . ' ' . $time_to . ' ' . date('Y') : $time_to = $time_to . ' ' . date('Y');
            $time_from = time();
            $time_to = strtotime($time_to);
            if ($time_to > $time_from)
                $deliverytime = ceil(abs($time_to - $time_from) / 86400);
            else
                $deliverytime = NULL;
        }
        else // For Japanese HTML Page
        {
            $str = trim($str);
            $str = substr($str,0,5);
            $arr = explode(' ', $str);
            $date = $arr[0];
            $date = explode('/', $date);
            if (isset($date[0]) && isset($date[1])) {
                $month_to = $monthName = date('F', mktime(0, 0, 0, $date[0], 10));
                $day_to = $date[1];
                $time_to = $month_to . ' ' . $day_to . ' ' . date('Y');
                $time_to = strtotime($time_to);
                if ($time_to > time())
                    $deliverytime = ceil(abs($time_to - time()) / 86400);
                else
                    $deliverytime = NULL;
            }else
                return NULL;
        }


        return $deliverytime;
    }

    public static function get_mechantsId($str = ''){
        if($str != null){
            $str_arr = self::getInbetweenStrings('6%3A', '&', $str);
        }
        else{
            $str_arr = '';
        }
        return $str_arr[0];
    }
    public static function get_total_inventory($str = ''){
        if($str != null){
            $rs = preg_replace("/[^\d+]/","",$str);
        }
        else{
            $rs = '';
        }
        return $rs;
    }
    public static function fix_Seller_Id($str = ''){
        if($str != null){
            $str_arr = self::check_Seller_Id($str);
            if(!empty($str_arr)){
                $rs = ucfirst($str_arr[0]);
            }
            else{
                $rs = "";
            }
        }
        else{
            $rs = '';
        }
        return $rs;
    }
    public static function fix_Asin($str = ''){
        if($str != null){
            $str_arr = self::check_Asin($str);

            if(!empty($str_arr)){
                $rs = ucfirst($str_arr[0]);
            }
            else{
                $rs = "";
            }
        }
        else{
            $rs = '';
        }

        return $rs;
    }
    public static function xml_attribute($object, $attribute)
    {
        if(isset($object[$attribute]))
            return (string) $object[$attribute];
    }
    
    public static function fix_text_month($str = ''){
        if(!empty($str)){
            $str = preg_replace("/[^\w+]/","", $str);
        }
        else{
            $str = '';
        }
        return $str;
    }
    
    public static function trim_text($str){
        return trim($str);
    }
    
    public static function lowercase_text($str){
        return strtolower($str);
    }
}