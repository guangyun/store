<?php
namespace Store\Backend\Controllers;
use Store\Components\Controllers;
class ControllerBase extends Controllers
{
    public function initialize() {
        parent::initialize();
        $this->assets->addCss('front/css/bootstrap.min.css')
                     ->addCss('front/css/font-awesome.min.css')
                     ->addCss('front/css/animate.min.css')
                     ->addCss("/front/css/plugins/iCheck/custom.css")
                     ->addCss('front/css/style.min.css');
        $this->assets->addJs('front/js/jquery.min.js')
                     ->addJs('front/js/bootstrap.min.js')
                     ->addJs('front/js/plugins/metisMenu/jquery.metisMenu.js')
                     ->addJs('front/js/plugins/slimscroll/jquery.slimscroll.min.js')
                     ->addJs('front/js/plugins/layer/layer.min.js')
                     ->addJs('front/js/hplus.min.js')
                     ->addJs('front/js/contabs.min.js');
                     
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
