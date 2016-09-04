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
    public function init_db($table,$db = 'default')
    {
        $this->table_db = $this->load->database($db , true);
        $this->table_name = strtolower($table);
    }

    public function get_one($where)
    {
        $this->table_db->select($this->fields);
        $this->table_db->where($where);
        $this->table_db->from($this->table_name);
        return $this->table_db->get()->row_array();
    }

    public function get_all($where)
    {
        $this->table_db->select($this->fields);
        $this->table_db->where($where);
        $this->table_db->from($this->table_name);
        return $this->table_db->get()->result_array();
    }

    protected function get_list($where ,$limit ,$offset)
    {
        $this->table_db->select($this->fields);
        $this->table_db->where($where);
        $this->table_db->from($this->table_name);
        $this->table_db->limit($limit ,$offset);
        return $this->table_db->get()->result_array();
    }

    public function count_result($where)
    {
        $this->table_db->where($where);
        $this->table_db->from($this->table_name);
        return $this->table_db->count_all_results();
    }

    public function insert($row)
    {
        return $this->table_db->insert($row);
    }
    public function last_insert_id()
    {
        return $this->table_db->insert_id();
    }
    public function update($modify , $where)
    {
        return $this->table_db->update($this->table_name,$modify,$where);
    }

    public function affected_rows()
    {
        return $this->table_db->affected_rows();
    }
}