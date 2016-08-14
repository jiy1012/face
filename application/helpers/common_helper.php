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