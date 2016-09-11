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
 * @property Id_generator $Id_generator
 * @property App_passport $App_passport
 * @property User_profile $User_profile
 * @property session $session
 * @property Question $Question
 * @property Answer $Answer
 * @property Favourite $Favourite
 */
class DefaultPage extends FF_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tables/Question');
        $this->load->model('tables/Answer');
    }


    public function get_quesion($id)
    {
        return $this->Question->get_by_id($id);
    }
    public function get_question_list($where,$limit,$offset)
    {
        return $this->Question->get_by_where($where,$limit,$offset);
    }
    public function get_question_counts($where)
    {
        return $this->Question->count_result($where);
    }
    
    public function get_answer_list($qid,$limit,$offset)
    {
        $where = array('qid'=>$qid);
        return $this->Answer->get_by_where($where,$limit,$offset);
    }

    public function get_answer_count($qid)
    {
        $where = array('qid'=>$qid);
        return $this->Answer->count_result($where);
    }
}