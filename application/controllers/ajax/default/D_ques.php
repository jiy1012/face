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
 * @property Defaultpage $Defaultpage
 */

class D_ques extends FF_Controller {

    protected $session_espire_time = 86400;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Defaultpage');
    }


    
    public function qlist()
    {
        $page_index = intval($this->input->post_get('page_index'));
        $page_size = $this->page_size;
        $offset = ($page_index-1)*$this->page_size;
        $offset < 0 && $offset = 0;
        $list = $this->Defaultpage->get_question_list(array(),$page_size,$offset);
        $count = $this->Defaultpage->get_question_counts(array());
        $this->response(0,'ok',array('list'=>$list,'count'=>$count));
    }

    public function qdetail()
    {
        $qid = intval($this->input->post_get('qid'));
        $qdetail = $this->Defaultpage->get_quesion($qid);
        $answer = $this->Defaultpage->get_answer_list($qid,$this->page_size,0);
        $answer_count = $this->Defaultpage->get_answer_count($qid);
        $this->response(0,'ok',array('question'=>$qdetail,'alist'=>$answer,'acount'=>$answer_count));
        return;
    }

    public function alist()
    {
        $qid = intval($this->input->post_get('qid'));
        $page_index = intval($this->input->post_get('page_index'));
        $page_size = $this->page_size;
        $offset = ($page_index-1)*$this->page_size;
        $offset < 0 && $offset = 0;
        $answer = $this->Defaultpage->get_answer_list($qid,$page_size,$offset);
        $answer_count = $this->Defaultpage->get_answer_count($qid);
        $this->response(0,'ok',array('list'=>$answer,'count'=>$answer_count));
        return;
    }
}