<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Controller;

/**
 * Description of CategoryController
 *
 * @author 26917
 */
class CategoryController extends CommonController{
    // 分类列表
    public function index(){
        // 获得数据
        $data['data']=M('category')->select();
        // 视图
        $this->assign($data);
        $this->display();
    }
    
    // 添加分类
    public function add(){
        // 处理表单
        if(IS_POST){
            $rst= $this->create('cagegory', 'add');
            if($rst===false){
                $this->error('添加分类失败');
            }
            $this->success('添加分类成功','index');
            return;
        }
    }
}
