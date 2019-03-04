<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Controller;
use Think\Controller;
/**
 * Description of MemberController
 *
 * @author 26917
 */
class MemberController extends Controller{
    public function index(){
        // 取出会员信息
        $data=D('member')->getList('mid,user,phone,email',array(),'mid desc');
        $this->assign($data);
        $this->display();
    }
}
