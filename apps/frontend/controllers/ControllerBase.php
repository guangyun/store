<?php

namespace Store\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
   
    public function initialize() {
        $this->assets->addCss('css/bootstrap/bootstrap.min.css');
        $this->assets->addJs('js/jquery/jquery-2.1.4.min.js')->addJs('js/bootstrap/bootstrap.min.js');
    }
        
    public function forwards($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
        return $this->dispatcher->forward(
            array(
                'namespace'=> 'Store\Frontend\Controllers',
                'controller' => $uriParts[0],
                'action' => $uriParts[1],
                'params' => $params
            )
        );
    }
    //获得ip地址
    public function getIp()
    {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        else
            $ip = "unknown";
    
        return $ip;
    }
    
    // 获得加密密码
    public function encryptPwd($str)
    {
        $encry_before = 'phalcon';
        $encry_after = '@163.com';
        $password = md5(md5($encry_after.$str.$encry_before));
        return $password;
    }
    
    // 获得验证字符串
    public function getAuth($userinfo){
        
        return substr(md5($userinfo->counts.$userinfo->login_ip), 0,8);
    }
    
    public function errorAction($param) {
        
    }
}
