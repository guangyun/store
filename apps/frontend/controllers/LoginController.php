<?php
namespace Store\Frontend\Controllers;

use Store\Frontend\Models\Users;
use Store\Extensions\Captcha;

class LoginController extends ControllerBase
{
    
    public function loginAction() {
        if($this->request->isPost()){
            if ($this->request->hasPost('authcode')){
                $code = $this->request->getPost('authcode','trim');
                if($code!=$this->session->get('captcha')){
                    $this->flash->warning('验证码不正确');
                    return;
                }
            }
            $this->session->set('err', 0);
            $nick = $this->request->getPost('nick','trim');
            $passwd = $this->encryptPwd($this->request->getPost('passwd'));           
            if(!empty($nick)&&!empty($passwd)){
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
                        if($this->session->has('err')){
                            $this->session->remove('err');
                        }
                        $this->response->redirect('frontend/index/index');
                    }
                }else{
                    $num = $this->session->get('err');
                    $num++;
                    $this->session->set('err', $num);                   
                    $this->flash->warning('用户名或密码错误');
                }
            }else{
                $this->flash->warning('用户名密码不能为空');
            }
        }
    }
    
    public function registerAction() {
        if($this->request->isPost()){
            $user = $this->bag;
            $nick = $this->request->getPost('nick','trim');
            if(Users::findFirst(array('nick=?0','bind'=>array(0=>$nick)))){
                $this->flash->warning('用户已存在');
                $this->forwards('login/login');
                exit;
            }
            $user->nick = $nick;
            $user->passwd = $this->encryptPwd($this->request->getPost('passwd'));
            $user->login_ip = $this->getIp();
            $user->reg_time = $_SERVER["REQUEST_TIME"];
            if ($user->create()){
                $this->response->redirect('frontend/login/login');
                exit;
            }
        }
    }
    
    public function logoutAction(){
            $this->session->remove('back-auth');
            if(!$this->session->has('back-auth'))
               $this->response->redirect('frontend/login/login');
            $this->view->disable();
    }
    
    public function newloginAction(){
            
    }
    
    /**
     * 检测登陆错误次数
     */
    public function errcount() {

    }
    
    public function captchaAction() {
        $captcha = new Captcha();
        $captcha ->showImg();
        $code = $captcha->getCaptcha();
        $this->session->set('captcha', $code);        
    }
}

