<?php
namespace Store\Frontend\Controllers;

use Store\Frontend\Models\Users;

class UserController extends ControllerBase
{
    
    public function loginAction() {
        if($this->request->isPost()){
            $nick = $this->request->getPost('nick','trim');
            $passwd = $this->encryptPwd($this->request->getPost('passwd'));           
            $user = Users::findFirst(array(
                'nick=?0 and passwd=?1',
                'bind'=>array($nick,$passwd)
            ));

            if (!empty($user)){
               $user->login_ip = $this->getIp();
               $user->counts++;                     
               if($user->save()){
                   $this->session->set('back-auth', array(
                       'id'=>$user->id,
                       'nick'=>$user->nick,
                       'time'=>$_SERVER['REQUEST_TIME'],
                       'authenticate'=>$this->getAuth($user)
                   ));
                   $this->response->redirect('frontend/index/index');
               }
            }else{
                $this->flash->error('用户名或密码错误');
            }            
        }
    }
    
    public function registerAction() {
        if($this->request->isPost()){
            $user = $this->bag;
            $nick = $this->request->getPost('nick','trim');;
            if(Users::findFirst(array('nick=?0','bind'=>array(0=>$nick)))){
                $this->flash->warning('用户已存在');
                $this->forwards('user/login');
                exit;
            }
            $user->nick = $nick;
            $user->passwd = $this->encryptPwd($this->request->getPost('passwd'));
            $user->login_ip = $this->getIp();
            $user->reg_time = $_SERVER["REQUEST_TIME"];
            if ($user->create()){
                $this->response->redirect('frontend/user/login');
                exit;
            }
        }
    }
    
    public function logoutAction(){
            $this->session->remove('back-auth');
            if(!$this->session->has('back-auth'))
               $this->response->redirect('frontend/user/login');
            $this->view->disable();
    }
    
}

