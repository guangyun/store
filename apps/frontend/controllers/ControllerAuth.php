<?php
namespace Store\Frontend\Controllers;

use Phalcon\Mvc\View;
class ControllerAuth extends ControllerBase
{

    public function beforeExecuteRoute()
    {
        if (!$this->session->has('back-auth')) {             
           $this->response->redirect('frontend/login/login');
        }else{
            $user = $this->session->get('back-auth');
            if (!empty($user['uid']) || !empty($user['nick'])) {                               
                if($user['authenticate'] != $this->getAuth(\Store\Frontend\Models\Admins::findFirst($user['id']))){                    
                    $this->response->redirect('frontend/login/login');
                }  
            } else {                
               $this->response->redirect('frontend/login/login');
            }
            $time = $_SERVER['REQUEST_TIME'];
            if(($time-7200)>$user['time']){
                $this->forwards('login/newlogin/nickname/'.$user['nick']);
            }
        }        
    }
    
    public function initialize(){
        $this->view->setRenderLevel(View::LEVEL_LAYOUT)->setLayout('login');
    }
    
    
    public function  beforeCheckAcl(){
        
    }
    
    public function checkAcl($param) {
        ;
    }
}

