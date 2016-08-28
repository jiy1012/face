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
 * @property Baseconfig $Baseconfig
 */

class Area extends FF_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Baseconfig');
        $this->load->helper('arraytool');
    }

    public function all()
    {
        $loginstatus = $this->check_login();
        if ($loginstatus !== true)
        {
            $this->response('请登录后再试');
            return;
        }
        $area = $this->Baseconfig->get_all_country();
        $this->response(0,'ok',format_array_parent_son($area));
        return ;
    }

}