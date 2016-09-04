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

class Favo extends FF_Controller {

    protected $session_espire_time = 86400;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User');
    }

    public function add()
    {
        $loginstatus = $this->check_login();
        if ($loginstatus === false){
            $this->response('请先登录');
            return false;
        }
        $type = trim($this->input->post_get('type'));
        $withid = intval($this->input->post_get('withid'));
        if (!$withid){
            $this->response('id错误');
            return false;
        }
        if (!$type){
            $this->response('type错误');
            return false;
        }
        $have = $this->User->get_favourite_list($this->uid,array('type'=>$type,'withid'=>$withid,'status'=>1));
        if ($have){
            $this->response(0,'ok',array_pop($have));
            return;
        }
        $res = $this->User->add_favourite($type, $withid, $this->uid);
        if ($res){
            $this->response(0,'ok',$res);
            return;
        }
        $this->response('服务错误,请稍后重试');
        return;
    }

    public function del()
    {
        $loginstatus = $this->check_login();
        if ($loginstatus === false){
            $this->response('请先登录');
            return false;
        }
        $id = intval($this->input->post_get('id'));
        if (!$id){
            $this->response('id错误');
            return false;
        }

        $row = $this->User->get_favourite($id);
        if (empty($row) || $row['userid'] != $this->uid) {
            $this->response('没有编辑权限');
            return;
        }
        $ret = $this->User->delete_favourite($id);
        if ($ret > 0){
            $this->response();
            return;
        }
        $this->response('更新失败,请稍后重试');
        return;
    }
    
}