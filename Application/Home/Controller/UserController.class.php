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
