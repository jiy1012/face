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
 */
class FF_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        load_class('Model', 'core');
        load_class('Tables', 'core');
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
            'data' => $data,
            'errmsg' => $errmsg
        );
        header('Content-type:application/json;charset=utf-8');
        echo json_encode($response);
    }
}