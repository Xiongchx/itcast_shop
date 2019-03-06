<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Home\Model;
use Think\Model;
/**
 * Description of GoodsAttrModel
 *
 * @author 26917
 */
class GoodsAttrModel extends Model{
    // 获得商品属性信息
    public function getData($cid,$gid){
        //拼接完整表名
        $goodsAttr=C('DB_PREFIX').'goods_attr';
        $attr=C('DB_PREFIX').'attribute';
        $sql = "select ga.avalue,a.aname from $attr as a  
                left join (select aid,avalue from $goodsAttr where gid=
                $gid) as ga
                on ga.aid=a.aid where a.cid=$cid";
        $data= $this->query($sql);
        return $data;
    }
}
