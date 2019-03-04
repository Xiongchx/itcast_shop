<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Controller;

/**
 * Description of RecycleController
 *
 * @author 26917
 */
class RecycleController extends CommonController{
    // 查看回收站的商品
    public function index() {
        // 请求参数
        $data['cid'] = I('get.cid', 0, 'int');
        // 获得分类列表
        $data['category'] = D('category')->getList();
        // 获得商品列表
        $data['goods'] = D('goods')->getList(
                // 查询字段  查询条件
                'gid,cid,identifier,gname', array('recycle' => 'yes', 'cid' => $data['cid']), 'gid desc'
        );
        $this->assign($data);
        $this->display();
    }
    
    // 还原
    public function undel() {
        $gid = I('get.gid', 0, 'int');
        // 操作数据
        $rst = M('godos')->where("gid=$gid")->save(array('recycle' => 'no'));
        if ($rst === false) {
            $this->error('还原失败');
        }
        $cid = I('get.cid', 0, 'int');
        $this->success('还原成功', U('Goods/index', "cid=$cid"));
    }
    
    // 彻底删除 清回收站
    public function del(){
        $gid=I('get.gid',0,'int');
        // 删商品
        $rst=D('goods')->delAll($gid);
        if($rst===false){
            $this->error('删除商品失败');
        }
        // 删商品属性
        $rst=M('goodAttr')->where("gid=$gid")->delete();
        if($rst===false){
            $this->error('删除商品关联属性失败');
        }
        $cid=I('get.cid',0,'int');
        $this->success('删除成功', U('index',"cid=$cid"));
    }

}
