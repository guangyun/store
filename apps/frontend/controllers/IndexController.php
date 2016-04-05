<?php
namespace Store\Frontend\Controllers;


use Phalcon\Mvc\View;
use Store\Frontend\Models\Methods;
use Store\Extensions\Funs;
use Phalcon\Mvc\Model;
class IndexController extends ControllerAuth
{
    /*
     * 首页
     */
    public function indexAction()
    {
        $this->view->setLayout('index');
        $this->assets->addJs('front/js/plugins/pace/pace.min.js');
        $tools = Methods::find("show!=0")->toArray();
        $tree = Funs::genTree5($tools);
        $this->view->tools = $tools;
    }
    
    public function sysinfoAction() {        
        $condition = "show!=0";
        $obj = Methods();
        $res = $this->obj($obj, $condition);
        var_dump($res);
        $this->view->disable();
        
    }

    public function obj($obj,$condition) {
        return $obj::find($condition)->toArray();
    }
}

