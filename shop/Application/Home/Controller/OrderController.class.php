<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller {

    //
    public function checkout(){
        $kache = session('kache');
        $tool = \Home\Tool\AddTool::getIns();
        $this->assign('zj',$tool->calcMoney());
        $this->assign('kache',$kache);
        $this->display();
    }

    /**
     * 结算购物车
     */
    public function done(){
        $oi = M('ordinfo');
        $og = M('ordgoods');
        $cart = \Home\Tool\AddTool::getIns();

        //写入ordinfo表
       $oi->create();//收取$_POST数据
        $oi->ord_sn = $ord_sn = date('Ymd').rand(1000,9999);
        $oi->user_id = cookie('user_id') ? cookie('user_id') : 8;
        $oi->money = $money = $cart->calcMoney();
        $oi->ordtime = time();

        if($ordinfo_id = $oi->add()){
            //添加ordgoods表
            $data = array();

            foreach($cart->items() as $k=>$v){
                $row = array();
                $row['goods_id'] = $k;
                $row['goods_name'] = $v['goods_name'];
                $row['shop_price'] = $v['shop_price'];
                $row['goods_num'] = $v['num'];
                $row['ordinfo_id'] = $ordinfo_id;

                $data[] = $row;

                if($og->addAll($data)){
                    $this->assign('ord_sn',$ord_sn);
                    $this->assign('money',$money);

                    //在线支付
                    $jdpay = new \Home\Pay\Jdpay($ord_sn,$money);
                    $this->assign('form',$jdpay->form());

                    $cart->clear();
                    $this->display();
                }
            }
        }else{
            echo 'error';
        }

    }
}
