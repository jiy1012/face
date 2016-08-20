<?php
/**
 * Created by IntelliJ IDEA.
 * User: liuyi
 * Date: 16/8/14
 * Time: 下午7:53
 */

function ff_password($password)
{
    return md5(md5($password).PASSWORD_SALT);
}

function is_email($email)
{
    $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
    if ( preg_match( $pattern, $email ) ){
        return true;
    }
    return false;
}

function is_phone($phone)
{
    if(preg_match("/^1[345789]{1}\d{9}$/",$phone)){
        return true;
    }
    return false;
}

function encode_sign_code($uid){

}

function decode_sign_code($sign){

}