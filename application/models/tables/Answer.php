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
class Answer extends FF_Tables
{
    private $per_page = 10;
    public function __construct()
    {
        parent::__construct();
        $this->init_db(__CLASS__);
        $this->fields = array(
            'id',
            'qid',
            'content',
            'createtime',
            'updatetime',
            'like',
            'dislike',
            'author',
            'delete'
        );
    }

    public function insert($array)
    {
        $insert = array();
        foreach ($this->fields as $field) {
            if (isset($array[$field])){
                $insert[$field] = $array[$field];
            }
        }
        $insert['createtime']=time();
        $ret = $this->table_db->insert($this->table_name,$insert);
        if ($ret){
            return $this->last_insert_id();
        }
        return 0;
    }

    public function get_by_id($id)
    {
        $where = array('id'=>$id);
        return $this->get_one($where);
    }

    public function get_by_where($where,$limit = 10,$offset = 0)
    {
        return $this->get_list($where,$limit,$offset);
    }

    public function update_field($uid,$modify){
        $where = array('id'=>$uid);
        foreach ($this->fields as $field) {
            if (isset($modify[$field])){
                $update[$field] = $modify[$field];
            }
        }
        $update['updatetime'] = time();
        $ret = $this->update($update, $where);
        if ($ret){
            return $this->affected_rows();
        }
        return 0;
    }
}