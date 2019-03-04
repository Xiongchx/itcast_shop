<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Home\Model;
use Think\Model;
/**
 * Description of AttributeModel
 *
 * @author 26917
 */
class AttributeModel extends Model{
    // 取出属性数据
    public function getData($where){
        $data= $this->field('aid,aname,a_def_val')->where($where)->select();
        $data==null && $data=array();
        // 整理数据
        varToArr($data, 'a_def_val', true);
        return $data;
    }
}
