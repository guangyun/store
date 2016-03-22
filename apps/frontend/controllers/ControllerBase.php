<?php

namespace Store\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
   
    public function onConstruct() {
        
        $this->assets->addCss('frontend/css/bootstrap.min.css')
                     ->addCss('frontend/css/font-awesome.min.css')
                     ->addCss('frontend/css/animate.min.css')
                     ->addCss('frontend/css/style.min.css');
        $this->assets->addJs('frontend/js/jquery.min.js')
                     ->addJs('frontend/js/bootstrap.min.js')
                     ->addJs('frontend/js/plugins/metisMenu/jquery.metisMenu.js')
                     ->addJs('frontend/js/plugins/slimscroll/jquery.slimscroll.min.js')
                     ->addJs('frontend/js/plugins/layer/layer.min.js')
                     ->addJs('frontend/js/hplus.min.js')
                     ->addJs('frontend/js/contabs.min.js')
                     ->addJs('frontend/js/plugins/pace/pace.min.js');
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
    
    //通过ip查出ip所在地区的详细地址
    public function getIpinfo($ip){
        $url = "http://ip.taobao.com/service/getIpInfo.php?ip=$ip";
        $ipinfo = $this->response->getContent($url);
        return json_decode($ipinfo,true);
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
