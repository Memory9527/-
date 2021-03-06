<?php
namespace Home\Controller;
use Think\Controller;
class CatController extends Controller {
    public function cat(){
        $goodsModel = D('Admin/goods');
        //分页
        $count = $goodsModel->field('goods_id,goods_name,shop_price,goods_img,market_price')->where('cat_id='.I('cat_id'))->count();
        $Page       = new \Think\Page($count,10);
        $show       = $Page->show();
        //查询商品
        $goodsList = $goodsModel->field('goods_id,goods_name,shop_price,goods_img,market_price')->where('cat_id='.I('cat_id'))->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('count',$count);
        $this->assign('goodslist',$goodsList);
        $this->assign('page',$show);
        $this->display();
    }
}
