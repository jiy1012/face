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
        $this->table_name = strtolower(__CLASS__);
    }
    protected function init_db($db = 'default')
    {
        $this->table_db = $this->load->database($db , true);
    }

    protected function get_one($where)
    {
        $this->table_db->select($this->fields);
        $this->table_db->where($where);
        $this->table_db->from($this->table_name);
        return $this->table_db->get()->row_array();
    }

    protected function get_all($where)
    {
        $this->table_db->select($this->fields);
        $this->table_db->where($where);
        $this->table_db->from($this->table_name);
        return $this->table_db->get()->result_array();
    }

    protected function insert($row)
    {
        return $this->table_db->insert($row);
    }
    protected function last_insert_id()
    {
        return $this->table_db->insert_id();
    }
    protected function update($modify , $where)
    {
        $this->table_db->update($modify);
        $this->table_db->where($where);
        $this->table_db->from($this->table_name);
        return $this->table_db->update();
    }

    protected function affect_rows()
    {
        return $this->table_db->affect_rows();
    }
}