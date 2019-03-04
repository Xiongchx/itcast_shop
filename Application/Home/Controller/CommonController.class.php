<?php

namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller {
    protected $userInfo=false; // 用户登陆信息 未登录--false
    
    public function __construct() {
        parent::__construct();
        // 检查登陆
        $this->checkUser();
    }
    
    public function checkUser(){
        if(session('?user_id')){
            $userinfo=array(
                'mid'=> session('user_id'),  // 会员ID
                'mname'=>session('user_name'),  // 用户名
            );
            // 保存登陆信息
            $this->userInfo=$userinfo;
            // 为模板分配用户信息变量
            $this->assign($userinfo);
        }
    }
    
    /**
     * 公共数据创建方法
     * @param string $tablename 表名
     * @param string $func 操作方法
     * @param int $type 验证时机（1=添加 2=修改）
     * @param string/array $where 查询条件
     * @return mixed 操作结果
     */
    protected function create($tablename, $func, $type = 1, $where = array()) {
        $Model = D($tablename);
        if (!$Model->create(I('post.'), $type)) {
            $this->error($Model->getError());
        }
        if (empty($where)) {
            return $Model->$func();
        }
        return $Model->where($where)->$func();
    }
    
    
}
