<?php
namespace Store\Frontend\Controllers;

class ControllerAuth extends ControllerBase
{

    public function initialize()
    {
        
        if (!$this->session->has('back-auth')) {             
           $this->response->redirect('frontend/user/login');
        }else{
            $user = $this->session->get('back-auth');
            if (!empty($user['uid']) || !empty($user['nick'])) {                               
                if($user['authenticate'] != $this->getAuth(\Store\Frontend\Models\Users::findFirst($this->bag->uid))){                    
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
        
        parent::initialize();
    }
}

