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
 *
 * @property Id_generator $Id_generator
 * @property App_passport $App_passport
 */
class User extends FF_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tables/Id_generator');
        $this->load->model('tables/App_passport');
    }

    public function regedit($email= '' , $phone = '', $username = '',$password)
    {
        $uid = $this->Id_generator->generator_id();
        if ($uid){
            $user = array(
                'uid'=>$uid,
                'email'=>$email,
                'username'=>$username,
                'phone'=>$phone,
                'password'=>ff_password($password),
            );
            $this->App_passport->insert($user);
        }else{

        }
    }

    public function checkuser($email= '' , $phone = '', $username = '')
    {
        $ret = array();
        if ($email != ''){
            $ret = $this->App_passport->get_one_by_email($email);
        }elseif($phone != ''){
            $ret = $this->App_passport->get_one_by_phone($phone);
        }elseif ($username != ''){
            $ret = $this->App_passport->get_one_by_username($username);
        }else{

        }
        return $ret;
    }

    public function login()
    {

    }
}