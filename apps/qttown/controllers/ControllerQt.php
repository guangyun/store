<?php
namespace Store\Qttown\Controllers;

use Store\Components\Controllers;
use Phalcon\Mvc\Controller;
class ControllerQt extends Controller
{
    public function initialize(){
        
        $this->assets->addCss("css/bootstrap/bootstrap.min.css")
                     ->addCss("css/main.css")
                     ->addJs("js/jquery.min.js")
                     ->addJs("js/bootstrap.min.js");
    }
}