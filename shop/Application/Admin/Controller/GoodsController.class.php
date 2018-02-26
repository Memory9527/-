<?php
namespace Admin\Controller;
use Think\Controller;

class GoodsController extends Controller {
    public $gm;
    public function __construct()
    {
        parent::__construct();
        $this->gm = D('goods');
    }

    public function goodsadd(){
    if(IS_POST){
        $upload = new \Think\Upload();
        $upload->maxSize = 3145728;
        $upload->exts = array('jpg','gif','png','jpeg');
        $upload->rootPath = './Public/Upload/';
        $upload->savePath = '';
        $info = $upload->upload();
        if(!$info){
            $this->error($upload->getError());
        }else{
            $img_path1 = './Public/Upload/'.$info['goods_img']['savepath'];
            $img_path2 = $info['goods_img']['savename'];

            //生成缩略图
            $image = new \Think\Image();
            $image->open($img_path1.$img_path2);
            $img_xiao = './Upload/thumb/'.$img_path2;
            $image->thumb(230, 230)->save($img_xiao);
            $this->gm->thumb_img = $img_xiao;
            $this->gm->goods_img = $img_path1.$img_path2;
        }
        if(!$this->gm->create(I('post.'))){
            echo $this->gm->getError();
            exit;
        }

        $result = $this->gm->add() ;
        if($result){
            $this->success('增加成功','goodslist');
            exit;
        }else{
            $this->error('添加失败','goodslist');
            exit;
        }
    }
    $this->display();
    }
    public function goodslist(){
        $p = I('p') ? I('p') : 1;
        $list = $this->gm->order('goods_id')->page($p.',5')->select();
        $this->assign('list',$list);
        $count = $this->gm->count();
        $Page = new \Think\Page($count,5);
        $show = $Page->show();
        $this->assign('page',$show);
        $this->display();
    }

    public function del(){
        if($this->gm->delete(I('get.goods_id'))) {
              $this->redirect('admin/goods/goodslist');exit;
        }

    }


    
}