<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: liuyi
 * Date: 16/8/14
 * Time: 下午4:49
 *
 * * system load.
 * @property CI_Input $input CI class
 * @property CI_Loader $model CI class
 * @property CI_Loader $helper CI class
 * @property CI_Loader $load CI class
 * @property CI_Config $config CI class
 */
class App_passport extends FF_Tables
{

    public function __construct()
    {
        parent::__construct();
        $this->init_db(__CLASS__);
        $this->fields = array(
            'uid',
            'email',
            'username',
            'phone',
            'password',
            'createtime',
            'updatetime',
        );
    }

    public function insert($array)
    {
        $insert = array();
        foreach ($this->fields as $field) {
            if (isset($array[$field])){
                $insert[$field] = $array[$field];
            }
        }
        $insert['createtime']=time();
        $ret = $this->table_db->insert($this->table_name,$insert);
        if ($ret){
            return $this->last_insert_id();
        }
        return 0;
    }

    public function get_one_by_phone($phone)
    {
        $where = array('phone'=>$phone);
        return $this->get_one($where);
    }

    public function get_one_by_username($username)
    {
        $where = array('username'=>$username);
        return $this->get_one($where);
    }

    public function get_one_by_email($email)
    {
        $where = array('email'=>$email);
        return $this->get_one($where);
    }

    public function update_field($uid,$update){
        $where = array('uid'=>$uid);
        foreach ($this->fields as $field) {
            if (isset($modify[$field])){
                $update[$field] = $modify[$field];
            }
        }
        $update['updatetime'] = time();
        $ret = $this->update($update, $where);
        if ($ret){
            return $this->affect_rows();
        }
        return 0;
    }
}