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

class User extends FF_Controller {

    protected $session_espire_time = 86400;
    private $update_fields = array(
        'nickname',
        'head_img',
        'twitter',
        'introduction',
        'area',
        'profession',
        'company',
        'job',
        'school',
        'major',
    );
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User');
    }

    public function info()
    {
        $loginstatus = $this->check_login();
        if ($loginstatus === false){
            $this->response('请先登录');
            return false;
        }
        $info = $this->User->get_user_by_uid($this->uid);
        if ($info){
            $this->response(0,'ok',$info);
            return;
        }
        $this->response('数据错误');
        return;
    }

    public function edit()
    {
        $loginstatus = $this->check_login();
        if ($loginstatus === false){
            $this->response('请先登录');
            return false;
        }
        $params = array();
        foreach ($this->update_fields as $key) {
            $p = $this->input->post_get($key);
            if ($p){
                $params[$key] = $p;
            }
        }
        if (empty($params)){
            $this->response('没有更新的字段');
            return;
        }
        $ret = $this->User->update_user_by_uid($this->uid,$params);
        if ($ret > 0){
            $this->response();
            return;
        }
        $this->response('更新失败,请稍后重试');
        return;
    }


}