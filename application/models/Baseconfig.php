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
 * @property China $China
 */
class Baseconfig extends FF_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tables/China');
    }

    public function get_all_country()
    {
        $china = $this->China->get_all_table();
        if ($china){
            return $china;
        }
        return array();
    }

}