<?php

/**
 * Created by IntelliJ IDEA.
 * User: liuyi
 * Date: 16/8/28
 * Time: 下午4:36
 */
function format_array_parent_son($array,$primary_key = 'id',$parent_key = 'parentId',$son_key = 'sons')
{
    if (!is_array($array)){
        return array();
    }
    $maps = array();
    foreach ($array as $item) {
        $maps[$item[$primary_key]] = $item;
    }
    $res = array();
    foreach ($maps as $k=>$v) {
        if (!empty($v[$parent_key])){
            $maps[$v[$parent_key]][$son_key][] = &$maps[$v[$primary_key]];
        }else{
            $res[] = &$maps[$v[$primary_key]];
        }
    }
    return $res;
}

