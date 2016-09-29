<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Recursive{
    public $recursive;
    public function __construct()
    {
        $this->arr = null;
    }
    public function recursives($parentid = 0, $data = NULL,$level = 0)
    {
        if(isset($data) && is_array($data)){
            foreach($data as $key =>$val)
            {
                if($val['parent_id'] == $parentid){
                    $this->arr[$key]['id'] = $val['id'];
                    $this->arr[$key]['parent_id'] = $val['parent_id'];
                    $this->arr[$key]['name'] = $val['name'];
                    $this->arr[$key]['image'] = $val['image'];
                    $this->arr[$key]['alias'] = $val['alias'];
                    $this->arr[$key]['sort'] = $val['sort'];
                    $this->arr[$key]['level'] = $level;
                    $this->recursives($val['id'],$data,$level+1);
                }
            }
        }
        return $this->arr;
    }
}
?>