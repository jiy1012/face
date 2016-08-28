<?php

/**
 * Created by IntelliJ IDEA.
 * User: liuyi
 * Date: 16/8/28
 * Time: 下午4:36
 */
function format_array_parent_son($array,$primary_key = 'id',$parent_key = 'parentid',$son_key = 'data')
{
    if (!is_array($array)){
        return array();
    }
    $res = array();
    foreach ($array as $k=>$v) {
        $res[$v[$parent_key]][$son_key][] = $v;
        !isset($res[$v[$primary_key]]) && $res[$v[$primary_key]] = array();
        $res[$v[$primary_key]] = array_merge($res[$v[$primary_key]],$v);
    }
    return $res;
}