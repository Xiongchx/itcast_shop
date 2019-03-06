<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Home\Controller;

/**
 * Description of CartController
 *
 * @author 26917
 */
class CartController extends CommonController{
    public function __construct() {
        parent::__construct();
        if($this->userInfo===false){
            $this->error('请先登陆', U('User/login'));
        }
    }
    
    //购物车 列表
    public function index(){
        $mid= $this->userInfo['mid'];
        $data['cart']=D('shopcart')->getList($mid);
        $this->assign($data);
        $this->display();
    }
    
    // 添加到购物车
    public function add(){
        $gid=I('get.gid',0,'int');
        $num=I('get.num',0,'int');
        $mid= $this->userInfo['mid'];
        $rst=D('shopcart')->addCart($gid,$mid,$num);
        if($rst===false){
            $this->error('添加购物车失败');
        }
        $this->success('添加购物车成功');
    }
    
    // 删除购物车
    public function del(){
        $scid=I('get.scid',0,'int');
        $mid= $this->userInfo['mid'];
        $rst=M('shopcart')->where("scid=$scid and mid=$mid")->delete();
        if($rst===false){
            $this->error('删除失败');
        }
        $this->redirect('Cart/index');
    }
}
