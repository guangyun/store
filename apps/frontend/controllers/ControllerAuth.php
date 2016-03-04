<?php
namespace Store\Frontend\Controllers;

use Phalcon\Session\Bag;

class ControllerAuth extends ControllerBase
{

    public $bag;

    public function initialize()
    {
        $this->bag = new Bag('user');
        if ($this->bag->has('user')) {
            $this->forwards('frontend/user/login');
        }else{
            if (!empty($this->bag->uid) && !empty($this->bag->nick) && $this->bag->authenticate == $this->getAuth(\Store\Frontend\Models\Users::findFirst($this->bag->uid))) {                               
                //$this->forwards('frontend/index/index');
            } else {
                $this->forwards('frontend/user/login');
            }
        }
        parent::initialize();
    }
}

