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

}
