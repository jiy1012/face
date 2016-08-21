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
 */
class Id_generator extends FF_Tables
{

    public function __construct()
    {
        parent::__construct();
        $this->init_db(__CLASS__);
        $this->fields = array(
            'id',
            'createtime',
        );
    }

    public function generator_id()
    {
        $insert = array('createtime'=>time());
        $ret = $this->table_db->insert($this->table_name,$insert);
        if ($ret){
            return $this->table_db->insert_id();
        }
        return 0;
    }
}