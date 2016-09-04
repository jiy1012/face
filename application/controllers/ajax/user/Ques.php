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
        $content = trim($this->input->post_get('content'));
        $catid = intval($this->input->post_get('catid'));
        if (!$title){
            $this->response('请输入标题');
            return false;
        }
        if (!$content){
            $this->response('请输入内容');
            return false;
        }
        if (!$catid){
            $this->response('请输入类别');
            return false;
        }
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
        if (!$id){
            $this->response('id错误');
            return false;
        }
        if (!$title){
            $this->response('请输入标题');
            return false;
        }
        if (!$content){
            $this->response('请输入内容');
            return false;
        }
        if (!$catid){
            $this->response('请输入类别');
            return false;
        }
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
        $row = $this->User->get_quesion($id);
        if (empty($row) || $row['author'] != $this->uid) {
            $this->response('没有编辑权限');
            return;
        }
        $ret = $this->User->delete_quesion($id);
        if ($ret > 0){
            $this->response();
            return;
        }
        $this->response('更新失败,请稍后重试');
        return;
    }
    
    public function qlist()
    {
        $loginstatus = $this->check_login();
        if ($loginstatus === false){
            $this->response('请先登录');
            return false;
        }
        $page_index = intval($this->input->post_get('page_index'));
        $page_size = $this->page_size;
        $offset = ($page_index-1)*$this->page_size;
        $offset < 0 && $offset = 0;
        $list = $this->User->get_question_list($this->uid,array(),$page_size,$offset);
        $count = $this->User->get_question_counts($this->uid,array());
        $this->response(0,'ok',array('list'=>$list,'count'=>$count));
    }
}