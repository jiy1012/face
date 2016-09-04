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
 * @property User_profile $User_profile
 * @property session $session
 * @property Question $Question
 * @property Answer $Answer
 * @property Favourite $Favourite
 */
class User extends FF_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tables/Id_generator');
        $this->load->model('tables/App_passport');
        $this->load->model('tables/User_profile');
        $this->load->model('tables/Question');
        $this->load->model('tables/Answer');
        $this->load->model('tables/Favourite');

    }

    /**
     * 注册函数
     * @param string $email 邮箱
     * @param string $phone 手机号
     * @param string $username 用户名
     * @param $password 密码
     */
    public function regedit($email= '' , $phone = '', $username = '', $password)
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
            $this->User_profile->insert(array('uid'=>$uid,'reg_ip'=>$this->input->ip_address()));
            return $uid;
        }
        return false;
    }

    public function checkuser($email= '' , $phone = '', $username = '')
    {
        $ret = null;
        if ($email != ''){
            $ret = $this->App_passport->get_one_by_email($email);
        }elseif($phone != ''){
            $ret = $this->App_passport->get_one_by_phone($phone);
        }elseif ($username != ''){
            $ret = $this->App_passport->get_one_by_username($username);
        }
        return $ret;
    }

    public function check_password($passport,$password)
    {
        if ($passport['password'] == ff_password($password)){
            return true;
        }
        return false;
    }

    public function login($uid)
    {
        $updatetime = time();
        $affectrows = $this->App_passport->update_field($uid,array());
        if ($affectrows > 0 ){
            $array = array('uid'=>$uid,'logintime'=>$updatetime);
            $ticket = gen_user_ticket($array);
            $this->session->ticket = $ticket;
            $this->User_profile->update_field($uid,array('login_ip'=>$this->input->ip_address()));
            return $updatetime;
        }else{
            return 0;
        }
    }

    public function get_user_by_uid($uid)
    {
        $user = $this->User_profile->get_by_uid($uid);
        return $user;
    }

    public function update_user_by_uid($uid,$modify)
    {
        $ret = $this->User_profile->update_field($uid,$modify);
        return $ret;
    }

    public function add_quesion($titile,$catid,$content,$author)
    {
        $array = array('title'=>$titile,'catid'=>$catid,'content'=>$content,'author'=>$author);
        return $this->Question->insert($array);
    }
    public function modify_quesion($id,$titile,$catid,$content)
    {
        $array = array('title'=>$titile,'catid'=>$catid,'content'=>$content);
        return $this->Question->update_field($id,$array);
    }
    public function delete_quesion($id)
    {
        $array = array('delete'=>1);
        return $this->Question->update_field($id,$array);
    }
    public function get_quesion($id)
    {
        return $this->Question->get_by_id($id);
    }
    public function get_question_list($user,$where,$limit,$offset)
    {
        $where['author'] = $user;
        return $this->Question->get_by_where($where,$limit,$offset);
    }
    public function get_question_counts($user,$where)
    {
        $where['author'] = $user;
        return $this->Question->count_result($where);
    }
    

    public function get_answer($id)
    {
        return $this->Answer->get_by_id($id);
    }
    public function add_answer($qid,$content,$author)
    {
        $array = array('qid'=>$qid,'content'=>$content,'author'=>$author);
        return $this->Answer->insert($array);
    }
    public function modify_answer($id,$content)
    {
        $array = array('content'=>$content);
        return $this->Answer->update_field($id,$array);
    }
    public function delete_answer($id)
    {
        $array = array('delete'=>1);
        return $this->Answer->update_field($id,$array);
    }

    public function add_favourite($type,$id,$user)
    {
        $array = array('type'=>$type,'withid'=>$id,'userid'=>$user);
        return $this->Favourite->insert($array);
    }
    public function delete_favourite($id)
    {
        $array = array('status'=>1);
        return $this->Favourite->update_field($id,$array);
    }
    public function modify_favourite($id,$modify)
    {
        return $this->Favourite->update_field($id, $modify);
    }
    public function get_favourite($id)
    {
        return $this->Favourite->get_by_id($id);
    }
    public function get_favourite_list($user,$where,$limit = 10,$offset=0)
    {
        $where['userid'] = $user;
        return $this->Favourite->get_by_where($where,$limit,$offset);
    }
}