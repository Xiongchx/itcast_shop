<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Model;

use Think\Model;

/**
 * Description of AttributeModel
 *
 * @author 26917
 */
class AttributeModel extends Model {

    protected $insertFields = 'cid,aname,a_def_val';
    protected $updateFields = 'aname,a_def_val';
    protected $_validate = array(
        array('aname', 'require', '属性名不能为空'),
        array('cid', 'require', '父级分类不能为空', 0, 'regex', 1),
    );

    // 取出属性数据
    public function getData($where) {
        $data = $this->field('aid,aname,a_def_val')->where($where)->select();
        if ($data == null) {
            return false;
        }
        // 整理数据
        varToArr($data, 'a_def_val');
        return $data;
    }

}
