<?php

/**
 * 
 * @param mixed $data 属性数组
 * @param string $field 待分割字段名
 * @param bool $empty 是否包含文本框属性
 */
function varToArr(&$data, $field, $empty = false) {
    foreach ($data as $k => $v) {
        $data[$k][$field] = explode(',', $v[$field]);
        if ($empty && count($data[$k][$field]) == 1) {
            unset($data[$k]);
        }
    }
}

/**
 * 商品列表过滤项的URl生成
 * @param type $type 生成的URL类型( aid*  price  order )
 * @param type $data 相应的数据的当前值( 为空表示清除该参数 )
 * @return stirng 生成好的携带正确参数的URL
 */
function mkFilterURL($type, $data = '') {
    $params = I('get.');
    unset($params['p']); // 清除分页
    if ($data == '') {
        unset($params['$type']);  // $data 为空时清空参数
    } elseif ($type == 'price') {
        // 处理价格参数
        $price_arr = explode('-', $data);
        $params['min_p'] = $price_arr[0] == 0 ? null : $price_arr[0];
        $params['max_p'] = $price_arr[1] == 0 ? null : $price_arr[1];
    } elseif (substr($type, 0, 3) == 'aid') {
        // 处理属性参数
        $params[$type] = $data;
    } else {
        // 其他
        $params[$type] = $data;
    }
    return U('Index/find', $params);
}
