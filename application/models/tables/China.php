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
class China extends FF_Tables
{

    public function __construct()
    {
        parent::__construct();
        $this->init_db(__CLASS__);
        $this->fields = array(
            'id' ,
            'name',
            'parentId',
            'shortName',
            'levelType',
        );
    }



    public function get_by_id($id)
    {
        $where = array('id'=>$id);
        return $this->get_one($where);
    }

    public function get_by_parentid($parentid)
    {
        $where = array('parentId'=>$parentid);
        return $this->get_all($where);
    }

    public function get_all_table()
    {
        return $this->get_all(array());
    }
}