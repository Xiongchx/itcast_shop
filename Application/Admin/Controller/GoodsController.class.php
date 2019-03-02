<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Controller;

/**
 * Description of GoodsController
 *
 * @author 26917
 */
class GoodsController extends CommonController{
    // 添加商品 -- 显示页面
    public function add(){
        // 获得请求参数
        $cid=I('get.cid',0,'int');
        // 为选择分类
        if($cid==0){
            $this->addNew();
            return ;
        }
        // 处理表单
        if(IS_POST){
            $this->addAction($cid);
            return ;
        }
        // 取得分类名
        $data['cname']=M('category')->where("cid=$cid")->getField('cname');
        // 获取指定 cid 下的属性
        $data['attr']=D('attribute')->getData("cid=$cid");
        // cid
        $data['cid']=$cid;
        // 视图
        $this->assign($data);
        $this->display();
    }
   
    // 添加商品 -- 选择分类
    public function addNew(){
        // 取得分类数据
        $data['category']=D('category')->getList();
        // 视图
        $this->assign($data);
        $this->display('new');
    }
    
    // 添加商品 -- 处理表单
    public function addAction($cid){
        // 添加商品
        $gid= $this->create('goods', 'add');
        if($gid===false){
            $this->error("添加商品失败");
        }
        // 保存属性数据
        $data=I('post.attr');
        if($data!=''){
            $rst=D('goodsAttr')->addData($data,$gid);
            if($rst===false){
                $this->error("添加属性失败");
            }
        }
        // 保存上传文件
        if(!empty($_FILES['thumb']['cname'])){
            $rst=D('goods')->uploadThumb($qid);
            if($rst!==true){
                $this->error($rst);
            }
        }
        $this->success('保存成功', U('index',"cid=$cid"));
    }
}
