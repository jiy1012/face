<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: liuyi
 * Date: 16/8/14
 * Time: 下午4:47
 *
 *
 * * system load.
 * @property CI_Input $input CI class
 * @property CI_Loader $model CI class
 * @property CI_Loader $helper CI class
 * @property CI_Loader $load CI class
 * @property CI_Config $config CI class
 *
 * @property User $User
 */

class Passport extends FF_Controller {

    protected $session_espire_time = 86400;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User');
    }

    public function regedit()
    {
        $loginstatus = $this->check_login();
        if ($loginstatus !== false)
        {
            $this->response('已经登录无需注册');
            return;
        }
        $user = trim($this->input->post_get('name'));
        if (!$user){
            $this->response('请输入手机号或者邮箱');
            return;
        }
        $pass = trim($this->input->post_get('pass'));
        if (!$pass){
            $this->response('请输入密码');
            return;
        }
        if ($this->need_code()){
            $code = $this->input->post_get('code');
            if (!$code){
                $this->response('请输入验证码');
                return;
            }
        }
        $uid = 0;
        if (is_email($user)){
            $exists = $this->User->checkuser($user);
            if ($exists){
                $this->response('该邮箱已经被注册');
                return;
            }
            $uid = $this->User->regedit($user, '', '', $pass);
            if ($uid !== false){
                $logintime = $this->User->login($uid);
                $ticket = gen_user_ticket(array('uid'=>$uid,'logintime'=>$logintime));
                $this->set_login_session($uid,$ticket);
                $this->response(0,$ticket);
                return;
            }else{
                $this->response('服务器错误,请稍后重试');
                return;
            }
        }elseif(is_phone($user)){
            $exists = $this->User->checkuser('',$user);
            if ($exists){
                $this->response('该手机号已经被注册');
                return;
            }
            $uid = $this->User->regedit('', $user, '', $pass);
            if ($uid !== false){
                $logintime = $this->User->login($uid);
                $ticket = gen_user_ticket(array('uid'=>$uid,'logintime'=>$logintime));
                $this->set_login_session($uid,$ticket);
                $this->response(0,$ticket);
                return;
            }else{
                $this->response('服务器错误,请稍后重试');
                return;
            }
        }
        $this->response('请输入手机号或者邮箱');
        return;
    }

    public function login()
    {
        $loginstatus = $this->check_login();
        if ($loginstatus !== false)
        {
            $this->response('已经登录无需再次登录');
            return;
        }
        $user = trim($this->input->post_get('name'));
        if (!$user){
            $this->response('请输入手机号或者邮箱');
            return;
        }
        $pass = trim($this->input->post_get('pass'));
        if (!$pass){
            $this->response('请输入密码');
            return;
        }
        if ($this->need_code()){
            $code = $this->input->post_get('code');
            if (!$code){
                $this->response('请输入验证码');
                return;
            }
        }
        $uid = 0;
        if (is_email($user)){
            $exists = $this->User->checkuser($user);
            if (!$exists){
                $this->response('该邮箱还没有注册');
                return;
            }
            $check_password = $this->User->check_password($exists,$pass);
            if ($check_password === true){
                $uid = $exists['uid'];
                $logintime = $this->User->login($uid);
                $ticket = gen_user_ticket(array('uid'=>$uid,'logintime'=>$logintime));
                $this->set_login_session($uid,$ticket);
                $this->response(0,$ticket);
                return;
            }else{
                $this->response('服务器错误,请稍后重试');
                return;
            }
        }elseif(is_phone($user)){
            $exists = $this->User->checkuser('',$user);
            if (!$exists){
                $this->response('该手机号还没有注册');
                return;
            }
            $check_password = $this->User->check_password($exists,$pass);
            if ($check_password === true){
                $uid = $exists['uid'];
                $logintime = $this->User->login($uid);
                $ticket = gen_user_ticket(array('uid'=>$uid,'logintime'=>$logintime));
                $this->set_login_session($uid,$ticket);
                $this->response(0,$ticket);
                return;
            }else{
                $this->response('服务器错误,请稍后重试');
                return;
            }
        }
        $this->response('请输入手机号或者邮箱');
        return;
    }

    private function need_code()
    {
        return false;
    }

}