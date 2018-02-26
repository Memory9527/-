<?php
namespace Admin\Model;

use Think\Model\RelationModel;

class GoodsModel extends RelationModel{

    public $_link = array(
        'comment' => self::HAS_MANY,
    );

public $insertFields = 'goods_name,goods_sn,goods_desc';
public $updateFields = 'goods_id,cat_id,goods_name,goods_number,goods_weight,shop_price,goods_desc,
goods_brief,ori_img,goods_img,thumb_img,is_best,is_new,is_hot,is_sale,last_update';
 //自动添加
    public $_auto = array(
      array('add_time','time',3,'function'),
    );
 //自动验证
    public $_validate = array(
        array('goods_name','6,16','商品名称在6-16字符之间',1,'length',3),
        array('is_best',array(0,1),'精品只能是0或1',0,'in',3),
        array('cat_id','ckc','请先分类',1,'callback',3),
        array('goods_sn','','goods_sn重复了',1,'unique',3),
    );

    protected function ckc(){
        $cat = D('Cat');
        return $cat->find(I('post.cat_id')) ? true : false;
    }
}