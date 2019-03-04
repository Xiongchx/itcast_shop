<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Home\Controller;

/**
 * Description of UserController
 *
 * @author 26917
 */
class UserController extends CommonController {
    public function __construct() {
        parent::__construct();
        $allow_action=array(
            // 不需要检查登陆的方法列表
            'login','captcha','register'
        );
        if($this->userInfo===false && !in_array(ACTION_NAME, $allow_action)){
            $this->error('请先登陆',U('User/login'));
        }
    }
    
    //会员中心首页
    public function index(){
        $this->display();
    }
    
    // 查看收货地址
    public function addr(){
        $mid= $this->userInfo['mid'];
        $data['addr']=D('member')->getAddr($mid);
        $this->assign($data);
        $this->display();
    }
    
    // 修改收货地址
    public function addrEdit(){
        if(IS_POST){
            $mid= $this->userInfo['mid'];
            $rst= $this->create('member', 'save',2,"mid=$mid");
            if($rst===false){
                $this->error('修改失败');
            }
            $this->redirect('User/addr');
            return ;
        }
        $this->addr();
    }
    
    // 用户登陆
    public function login(){
        if(IS_POST){
            // 判断验证码
            $this->checkVerify(I('post.captcha'));
            // 判断用户名   密码
            $name=I('post.user','','');
            $pwd=I('post.pwd','','');
            $rst=D('member')->checkUser($name,$pwd);
            if($rst!==true){
                $this->error($rst);
            }
            $this->success('登陆成功,请稍后', U('Index/index'));
            return ;
        }
        $this->display();
    }
    
    // 退出登陆
    public function logout(){
        session('[destroy]');
        $this->success('退出成功', U('Index/index'));
    }
    
    // 用户注册
    public function register() {
        if (IS_POST) {
            $this->checkVerify(I('post.captcha'));
            $rst = $this->create('member', 'add');
            if ($rst === FALSE) {
                $this->error($rst->getError());
            }
            $this->success('用户注册成功', U('Index/index'));
            return ;
        }
        $this->display();
    }

    // 验证码生成
    public function captcha() {
        $verify = new \Think\Verify();
        return $verify->entry();
    }

    // 验证码检查
    public function checkVerify($code, $id = '') {
        $verify = new \Think\Verify();
        $rst = $verify->check($code, $id);
        if ($rst !== true) {
            $this->error('验证码输入有误');
        }
    }

}
