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


    public function test()
    {
        $this->User->checkuser('1111111@163.com');
        $this->User->checkuser('','18211111111');
        $this->User->checkuser('','','1111012');
//        $this->User->regedit('', , , )
    }
}