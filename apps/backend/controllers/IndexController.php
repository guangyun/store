<?php
namespace Store\Backend\Controllers;
class IndexController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
    }
    /*
     * 首页
     */
    public function indexAction() {        
        $this->tag->setTitle("系统信息");
        if (file_exists(APP_PATH."/sys/lock")){
            $sys = require_once APP_PATH.'/sys/sys.php';
        }else{
            $this->response->redirect('frontend/index/setsys');
            exit();
        }
        $this->view->sys = $sys;
    }
    
    public function setsysAction(){
        $this->tag->setTitle("系统设置");
        if(file_exists(APP_PATH."/sys/lock")){
            $this->response->redirect('frontend/index/index');
            exit;
        }
        if ($this->request->isAjax()){
            $sys = array();
            if ($this->request->hasFiles()){
                foreach ($this->request->getUploadedFiles() as $file){
                    $name = $file->getName();
                    $size = $file->getSize();
                    $type = $file->getType();
                    $validate = new Validation();
                    $file = new \Phalcon\Http\Request\File();
                }
                //图片验证
                //$this->filter->sanitize();
                //图片宽度重置
                //图片名称重置
            }else{
                $logo = '';
            }
            $tool['system'] = $this->request->getPost('system',"string");
            $tool['php'] = $this->request->getPost('php',"string");
            $tool['mysql'] = $this->request->getPost('mysql',"string");
            $tool['runsys'] = $this->request->getPost('runsys',"string");
            $tool['tools'] = $this->request->getPost('tools',"string");
            $company['company'] = $this->request->getPost('company',"string");
            $company['logo'] = $logo;
            $company['founded'] = $this->request->getPost('founded',"string");
            $company['people'] = $this->request->getPost('people',"string");
            $company['money'] = $this->request->getPost('money',"string");
            $company['intro'] = $this->request->getPost('intro',"string");
            $sys['tool'] = $tool;
            $sys['company'] = $company;
        }
    }
    
    
}

