<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: liuyi
 * Date: 16/8/14
 * Time: 下午4:51
 *
 * * system load.
 * @property CI_Input $input CI class
 * @property CI_Loader $model CI class
 * @property CI_Loader $helper CI class
 * @property CI_Loader $load CI class
 * @property CI_Config $config CI class
 *
 * @property session $session CI class
 */
class FF_Controller extends CI_Controller
{
    protected $uid = 0;
    protected $ticket = null;

    public function __construct()
    {
        parent::__construct();
        load_class('Model', 'core');
        load_class('Tables', 'core');
        $this->load->library('session');
    }
    protected function check_login()
    {
        $ticket = $this->input->post_get('ticket');
        $login_status = $this->get_login_session($ticket);
        if ($login_status !== false)
        {
            return true;
        }
        return false;
    }
    protected function set_login_session($uid,$ticket)
    {
        $this->uid = $uid;
        $this->ticket = $ticket;
        $this->session->uid = $this->uid;
        $this->session->ticket = $this->ticket;
    }

    protected function get_login_session($ticket)
    {
        $session_ticket = $this->session->ticket;
        if (!$session_ticket && !$ticket)
        {
            return false;
        }
        $login_status = get_user_from_ticket($ticket);
        if ($login_status === false){
            return false;
        }
        $this->uid = $login_status['uid'];
        $this->ticket = $ticket;
        return true;
    }
    /**
     * ajax输出封装
     * @param
     */
    protected function response()
    {
        $args_count = func_num_args();
        $errno = 0;
        $data = array();
        $errmsg = '';
        switch ($args_count) {
            case 0 :
                $errno = 0;
                $errmsg = 'OK';
                break;
            case 1 :
                $errno = 1;
                $errmsg = func_get_arg(0);
                break;
            case 2 :
                $errno = func_get_arg(0);
                $errno = is_numeric($errno) ? $errno : 0;
                if ($errno == 0) {
                    $errmsg = 'ok';
                    $data = func_get_arg(1);
                } else {
                    $errmsg = func_get_arg(1);
                }
                break;
            default :
                @list($errno, $errmsg, $data) = func_get_args();
                break;
        }

        $response = array(
            'errno' => $errno,
            'errmsg' => $errmsg,
            'data' => $data,
        );
        header('Content-type:application/json;charset=utf-8');
        echo json_encode($response);
    }
}