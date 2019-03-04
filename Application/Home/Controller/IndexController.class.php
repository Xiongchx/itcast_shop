<?php

namespace Home\Controller;

class IndexController extends CommonController {

    public function index() {
        // 获得分类列表
        $data['cate'] = D('category')->getList();
        // 获得推荐商品
        $data['best'] = M('goods')->field(
                        'gid,gname,price,thumb'  // 取 id 名字 价格 图片
                )->where(array(
                    'is_best' => 'yes', // 是推荐商品
                    'status' => 'yes', // 已上架
                    'recycle' => 'no'    // 不在回收站
                ))->limit(5)->select();
        $this->assign($data);
        $this->display();
    }
    
    // 商品列表页
    public function find(){
        $cid = I('get.cid', 0, 'int');
        $data=D('Goods')->getByFilter(
                    // 待查询字段
                    'gid,gname,price,thumb',
                    // 查询条件  不在回收站 已上架  分类属于指定分类
                    array('recycle'=>'no','status'=>'yes','cid'=>$cid)                       
                );
        // 获得分类名
        $data['cname'] = M('category')->where("cid=$cid")->getField('cname');
        // 视图
        $data['cid'] = $cid;
        $this->assign($data);
        $this->display();
    }

}
