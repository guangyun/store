<?php
namespace Store\Frontend\Controllers;


use Phalcon\Mvc\View;
use Store\Frontend\Models\Methods;
use Store\Extensions\Funs;
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
        
    }

    
}

