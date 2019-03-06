<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Home\Model;

use Think\Model;

/**
 * Description of CategoryModel
 *
 * @author 26917
 */
class CategoryModel extends Model {

    // 分类查找，限制查找深度
    // 获得列表
    public function getList($max_deep = 3) {
        $data = $this->select();
        $data == null && $data == array();
        return $this->tree($data, 0, 0, $max_deep);
    }

    // 递归 父子关系排序分类
    private function tree(&$list, $pid, $deep = 0, $max_deep = 3) {
        $result = array();  // 当前子分类列表
        foreach ($list as $row) {
            if ($row['pid'] == $pid) {
                // 判断是否为最大深度
                if ($deep < $max_deep - 1) {
                    // 递归查找
                    $row['child'] = $this->tree($list, $row['pid'], $deep + 1, $max_deep);
                }
                $result[] = $row;
            }
        }
        return $result;
    }
    
    public function getPidList($cid){
        $pcat=array();
        while($cid){
            $cat= $this->field('cid,cname,pid')->where("cid=$cid")->find();
            $pcat[]=array(
                'cid'=>$cat['cid'],
                'cname'=>$cat['cname'],
            );
            $cid=$cat['pid'];
        }
        return array_reverse($pcat);
    }
}
