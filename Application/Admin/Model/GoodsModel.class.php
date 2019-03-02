<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Model;

use Think\Model;

/**
 * Description of GoodsModel
 *
 * @author 26917
 */
class GoodsModel extends Model {

    protected $insertFields = 'cid,gname,price,description,stock,identifier,status,is_best';
    protected $updateFields = 'cid,gname,price,description,stock,identifier,status,is_best,recycle';
    protected $_validate = array(
        array('cid', 'require', '未选择分类', 1, '', 1),
        array('gname', 'require', '商品名不能为空', 1, '', 3),
        array('price', 'require', '商品价格不能为空', 1, '', 3),
        array('description', 'require', '商品描述不能为空', 1, '', 3),
        array('stock', 'require', '商品库存量不能为空', 1, '', 3),
        array('identifier', 'require', '商品编号不能为空', 1, '', 3),
        array('status', 'require', '是否上架不能为空', 1, '', 3),
        array('identifier', '0,10', '编号位数不合法（最多10位）', 1, 'length', 3),
        array('price', '/^[\d]+$/', '商品价格只能是数字', 1, '', 3),
        array('stock', '/^[\d]+$/', '商品库存只能是数字', 1, '', 3),
        array('identifier', '', '商品编号已经存在', 1, 'unique', 1),
    );

    // 上传文件
    /**
     * 
     * @param int $gid 商品ID
     * @return string 错误信息 成功返回true
     */
    public function uploadThumb($gid) {
        // 准备上传目录
        $file['temp'] = './Public/uploads/temp/';
        // 不存在则创建
        file_exists($file['temp']) or mkdir($file['temp'], 0777, true);
        // 上传文件
        $Upload = new \Think\Upload(array(
            'exts' => array('jpg'),
            'rootPath' => $file['temp'],
            'autoSub' => false,
        ));
        $rst = $Upload->upload();
        if ($rst === false) {
            return $Upload->getError();
        }
        // 生成文件信息
        $file['name'] = $rst['thumb']['savename'];
        $file['save'] = date('Y-m/d/');
        $file['path1'] = './Public/uploads/' . $file['save'];
        $file['path2'] = './Public/uploads/thumb/' . $file['save'];
        // 创建保存目录
        file_exists($file['path1']) or mkdir($file['path1'], 0777, true);
        file_exists($file['path2']) or mkdir($file['path1'], 0777, true);
        // 生成缩略图
        $Image = \Think\Image();
        $Image->open($file['temp'] . $file['name']);
        // 大图
        $Image->thumb(350, 300, 2)->save($file['path1'] . $file['name']);
        // 小图
        $Image->thumb(176, 120, 2)->save($file['path2'] . $file['name']);
        // 删除临时文件
        unlink($file['temp'] . $file['name']);
        // 删除原来的图片文件
        $this->delImage($gid);
        // 保存缩略图
        $this->where("gid=$gid")->save(array(
            'thumb' => $file['save'] . $file['name'],
        ));
        return true;
    }

    // 删除商品关联文件
    private function delImage($gid = 0, $file = '') {
        $path = './Public/uploads/';
        if ($file == '') {
            $file = $this->where("gid=$gid")->getField('thumb');
        }
        if ($file && strlen(trim($file)) > 4) {
            // 删除文件 （空目录仍然存在，需要用其他办法清理空目录）
            unlink($path . $file);
            unlink($path . 'thumb/' . $file);
        }
    }

}
