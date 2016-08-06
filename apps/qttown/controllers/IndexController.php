<?php
namespace Store\Qttown\Controllers;

class IndexController extends ControllerQt
{

    public function initialize(){
        parent::initialize();
        $this->view->setTemplateAfter("blank");
    }
    public function indexAction()
    {
        
    }

    public function testAction()
    {
        $this->view->disable();
    }
}

