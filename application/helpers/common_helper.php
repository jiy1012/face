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

function ff_encode_code($source)
{
    if (mb_strlen(OPENSSL_ENCRYPT_KEY, '8bit') !== 32) {
        throw new Exception("Needs a 256-bit key!");
    }
    $ivsize = openssl_cipher_iv_length(OPENSSL_ENCRYPT_METHOD);
    $iv = openssl_random_pseudo_bytes($ivsize);

    $ciphertext = openssl_encrypt(
        $source,
        OPENSSL_ENCRYPT_METHOD,
        OPENSSL_ENCRYPT_KEY,
        OPENSSL_RAW_DATA,
        $iv
    );

    return base64_encode(base64_encode(base64_encode($iv . $ciphertext)));
}

function ff_decode_code($sign)
{
    if (mb_strlen(OPENSSL_ENCRYPT_KEY, '8bit') !== 32) {
        throw new Exception("Needs a 256-bit key!");
    }
    $sign = base64_decode(base64_decode(base64_decode($sign)));
    $ivsize = openssl_cipher_iv_length(OPENSSL_ENCRYPT_METHOD);
    $iv = mb_substr($sign, 0, $ivsize, '8bit');
    $ciphertext = mb_substr($sign, $ivsize, null, '8bit');

    return openssl_decrypt(
        $ciphertext,
        OPENSSL_ENCRYPT_METHOD,
        OPENSSL_ENCRYPT_KEY,
        OPENSSL_RAW_DATA,
        $iv
    );
}

function gen_user_ticket($array = array())
{
    $string = json_encode($array);
    return ff_encode_code($string);
}
function get_user_from_ticket($string)
{
    $decode_string = ff_decode_code($string);
    return json_decode($decode_string,true);
}