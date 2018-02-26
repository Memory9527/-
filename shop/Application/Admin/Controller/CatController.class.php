<?php
namespace Admin\Controller;
use Think\Controller;

class CatController extends Controller {
    public function cateadd(){
        if(IS_POST){
                $catModel = D('Cat');
                $result = $catModel->add(I('post.'));
                if($result){
                    $this->success('增加成功','catelist');
                    exit;
                }else{
                    $this->error('增加失败','catelist');
                    exit;
                }
        }
            $this->display();
    }

    public function catelist(){
        $catModel = D('Cat');
        $this->assign('catlist',$catModel->gettree());
        $this->display();
    }

    public function cateedit(){
        $catModel = D('Cat');
        if(IS_POST){
            $cat_id = I('cat_id');
            $result = $catModel->where('cat_id='.$cat_id)->save(I('post.'));
            if($result){
                $this->success('更新成功','catelist');
                exit;
            }else{
                $this->error('增加失败','catelist');
            }
        }
        $this->assign('gettree',$catModel->select());
        $this->assign('catinfo',$catModel->find(I('get.cat_id')));
        $this->display();
    }

    public function catedel(){
        $catModel = D('Cat');

        $catModel->delete(I('get.cat_id'));
        $this->redirect('Admin/Cat/catelist');
    }

}