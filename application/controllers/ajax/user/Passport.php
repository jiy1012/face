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

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User');
    }

    public function regedit()
    {
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
                $this->response(0,encode_sign_code($uid));
            }else{
                $this->response('服务器错误,请稍后重试');
            }
        }elseif(is_phone($user)){
            $exists = $this->User->checkuser('',$user);
            if ($exists){
                $this->response('该手机号已经被注册');
            }
            $uid = $this->User->regedit('', $user, '', $pass);
            if ($uid !== false){
                $this->response(0,encode_sign_code($uid));
            }else{
                $this->response('服务器错误,请稍后重试');
            }
        }
        $this->response('请输入手机号或者邮箱');
        return;
    }

    private function need_code()
    {
        return false;
    }
    public function test()
    {
        $this->User->checkuser('1111111@163.com');
        $this->User->checkuser('','18211111111');
        $this->User->checkuser('','','1111012');
//        $this->User->regedit('', , , )
    }
}