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
class FF_Tables extends CI_Model
{
    protected $fields = array();
    protected $table_db = null;
    protected $table_name = null;
    public function __construct()
    {
        parent::__construct();

    }
    public function init_db($db = 'default')
    {
        $this->table_db = $this->load->database($db , true);
    }
}