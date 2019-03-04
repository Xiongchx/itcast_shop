<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Model;
use Think\Model;
/**
 * Description of MemberModel
 *
 * @author 26917
 */
class MemberModel extends Model{
    // 会员列表
    // 查询字段 条件   排序条件
    public function getList($field,$where,$order){
        // 查 数据
        $count= $this->where($where)->count();
        $Page=new \Think\Page($count,5);
        $limit=$Page->firstRow.','.$Page->listRows;
        // 取得数据
        $data['page']=$Page->show();
        $data['list']= $this->field($field)->where($where)->order($order)->limit($limit)->select();
        return $data;
    }
}
