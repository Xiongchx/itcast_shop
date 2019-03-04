<?php

namespace Home\Controller;

class IndexController extends CommonController {

    public function index() {
        // 获得分类列表
        $data['cate']=D('category')->getList();
        $this->assign($data);
        $this->display();
    }

}
