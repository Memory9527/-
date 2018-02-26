<?php
namespace Admin\Model;

use Think\Model;

class CatModel extends Model{
    //无限级分类
    public function gettree($p=1,$lv=0){
        $t = array();

        foreach($this->select() as $k => $v ){
            if($v['parent_id'] == $p){
                $v['lv'] = $lv;
                $t[] = $v;
                $t=array_merge($t,$this->gettree($v['cat_id'],$lv=1));
            }
        }

        return $t;
    }

}