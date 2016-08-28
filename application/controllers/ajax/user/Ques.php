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

class Ques extends FF_Controller {

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
        $title = trim($this->input->post_get('title'));
        $content = $this->input->post_get('content');
        $catid = intval($this->input->post_get('catid'));
        $res = $this->User->add_quesion($title,$catid,$content,$this->uid);
        if ($res){
            $this->response(0,'ok',$res);
            return;
        }
        $this->response('服务错误,请稍后重试');
        return;
    }

    public function edit()
    {
        $loginstatus = $this->check_login();
        if ($loginstatus === false){
            $this->response('请先登录');
            return false;
        }
        $title = trim($this->input->post_get('title'));
        $content = $this->input->post_get('content');
        $catid = intval($this->input->post_get('catid'));
        $id = intval($this->input->post_get('id'));

        $row = $this->User->get_quesion($id);
        if (empty($row) || $row['author'] != $this->uid) {
            $this->response('没有编辑权限');
            return;
        }
        $ret = $this->User->modify_quesion($id,$title,$catid,$content);
        if ($ret > 0){
            $this->response();
            return;
        }
        $this->response('更新失败,请稍后重试');
        return;
    }


}