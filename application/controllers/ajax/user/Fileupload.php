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
 * @property Upload $Upload CI libriaries
 */

class Fileupload extends FF_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->config->load('upload');
        $upload_config = $this->config->item('upload_img');
        $this->load->library('Upload', $upload_config);
    }

    public function all()
    {
        $loginstatus = $this->check_login();
        if ($loginstatus !== true)
        {
            $this->response('请登录后再试');
            return;
        }
        $file = $this->input->post_get('filename');
        $ret = $this->Upload->do_upload($file);
        if(!$ret){
            $this->response(1,strip_tags($this->upload->display_errors()));
            return;
        }
        $this->response(0,'ok');
        return ;
    }

}