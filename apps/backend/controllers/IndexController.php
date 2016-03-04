<?php

namespace Store\Backend\Controllers;

use Store\Backend\Models\Users;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->pick('index/index');
    }

}

