<?php
namespace Store\Backend\Controllers;

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
        $this->view->setLayout('login');
    }
    
    
    public function  beforeCheckAcl(){
        
    }
    
    public function checkAcl($param) {
        ;
    }
    public function loginAction()
    {
        if ($this->request->isPost()) {
            if ($this->request->hasPost('authcode')) {
                $code = $this->request->getPost('authcode', 'trim');
                if ($code != $this->session->get('captcha')) {
                    $this->flash->warning('验证码不正确');
                    return;
                }
            }
            $this->session->set('err', 0);
            $nick = $this->request->getPost('nick', 'trim');
            $passwd = $this->encryptPwd($this->request->getPost('passwd'));
            if (! empty($nick) && ! empty($passwd)) {
                $user = Admins::findFirst(array(
                    'nick=?0 and passwd=?1',
                    'bind' => array(
                        $nick,
                        $passwd
                    )
                ));
    
                if (! empty($user)) {
                    $user->login_ip = $this->getIp();
                    $user->counts ++;
                    if ($user->save()) {
                        $this->session->set('back-auth', array(
                            'id' => $user->id,
                            'nick' => $user->nick,
                            'time' => $_SERVER['REQUEST_TIME'],
                            'authenticate' => $this->getAuth($user)
                        ));
                        if ($this->session->has('err')) {
                            $this->session->remove('err');
                        }
                        $this->response->redirect('frontend/index/index');
                    }
                } else {
                    $num = $this->session->get('err');
                    $num ++;
                    $this->session->set('err', $num);
                    $this->flash->warning('用户名或密码错误');
                }
            } else {
                $this->flash->warning('用户名密码不能为空');
            }
        }
    }
    
    public function registerAction()
    {
        $this->assets->addCss("/frontend/css/plugins/iCheck/custom.css");
        if ($this->request->isPost()) {
            $user = $this->bag;
            $nick = $this->request->getPost('nick', 'trim');
            if (Users::findFirst(array(
                'nick=?0',
                'bind' => array(
                    0 => $nick
                )
            ))) {
                $this->flash->warning('用户已存在');
                $this->forwards('login/login');
                exit();
            }
            $user->nick = $nick;
            $user->passwd = $this->encryptPwd($this->request->getPost('passwd'));
            $user->login_ip = $this->getIp();
            $user->reg_time = $_SERVER["REQUEST_TIME"];
            if ($user->create()) {
                $this->response->redirect('frontend/login/login');
                exit();
            }
        }
    }
    
    public function logoutAction()
    {
        $this->session->remove('back-auth');
        if (! $this->session->has('back-auth'))
            $this->response->redirect('frontend/login/login');
        $this->view->disable();
    }
    
    public function newloginAction()
    {}
    
    public function captchaAction()
    {
        $captcha = new Captcha();
        $captcha->showImg();
        $code = $captcha->getCaptcha();
        $this->session->set('captcha', $code);
    }
}

