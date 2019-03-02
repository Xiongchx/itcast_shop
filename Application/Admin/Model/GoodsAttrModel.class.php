<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Model;
use Think\Model;
/**
 * Description of GoodsAttrModel
 *
 * @author 26917
 */
class GoodsAttrModel extends Model {
    // 添加数据
    public function addData($data,$gid){
        // 整理数组
        $data= $this->getAttrArr($data,$gid);
        // 批量添加
        return $this->addAll($data);
    }
    
    // 获取商品属性信息
    public function getData($cid,$gid){
        // 拼接完整表名
        $goodsAttr=C('DB_PREFIX').'goods_attr';
        $attr=C('DB_PREFIX').'attribute';
        // 执行SQL查询
        $sql="select ga.gaid,a.aid,ga.avalue,a.aname,a.a_def_val "
                . "from $attr as a left join (select gaid,gid,aid,"
                . "avalue from $goodsAttr where gid=$gid) as ga on "
                . "ga.aid=a.aid where a.cid=$cid";
        $data= $this->query($sql);
        valToArr($data,'a_def_val');
        return $data;
    }
    
    // 整理数组，将attr[aid]=>value 转为 []=array(aid,avalue,gid)
    private function getAttrArr($data,$gid){
        $new_data=array();
        foreach($data as $k=>$v){
            $new_data[]=array(
                'aid'=>$k,
                'avalue'=>$v,
                'gid'=>$gid,
            );
        }
        return $new_data;
    }
}
