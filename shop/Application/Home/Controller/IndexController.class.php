<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        //栏目
        $catModel = D('Admin/Cat');
        $this->assign('cattree',$catModel->gettree());

        $goodsModel =  D('Admin/goods');
        //热销商品
        $hot = $goodsModel->field('goods_id,goods_name,shop_price,goods_img,market_price')->where('is_hot=1')->order('goods_id desc')->limit('0,4')->select();
        //推荐商品
        $best = $goodsModel->field('goods_id,goods_name,shop_price,goods_img,market_price')->where('is_best=1')->order('goods_id desc')->limit('0,4')->select();
        //新商品
        $new = $goodsModel->field('goods_id,goods_name,shop_price,goods_img,market_price')->order('goods_id desc')->limit('0,4')->select();
        $this->assign('hot',$hot);
        $this->assign('best',$best);
        $this->assign('hot',$new);

        $this->display();
    }
}
