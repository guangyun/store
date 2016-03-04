<?php
namespace Store\Frontend\Controllers;

use Store\Frontend\Models\Users;
use Phalcon\Session\Bag;

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
               $bag = new Bag('user');
               $bag->uid = $user->id;
               $bag->nick = $user->nick;
               $bag->authenticate = $this->getAuth($user);
               if($user->save()){
                   $this->forwards('frontend/user/login');
               }
            }else{
                $this->flash->error('用户名或密码错误');
                exit();
            }            
        }
    }
    
    public function registerAction() {
        if($this->request->isPost()){
            $user = new Users();
            $nick = $this->request->getPost('nick','trim');;
            if(Users::findFirst(array('nick=?0','bind'=>array(0=>$nick)))){
                $this->forwards('frontend/user/login');
                exit;
            }
            $user->nick = $nick;
            $user->passwd = $this->encryptPwd($this->request->getPost('passwd'));
            $user->login_ip = $this->getIp();
            $user->reg_time = $_SERVER["REQUEST_TIME"];
            if ($user->create()){
                $this->forwards('frontend/user/login');
                exit;
            }
        }
    }
    
}

