<?php
namespace Store\Components;
use Phalcon\Mvc\Controller,Phalcon\Mvc\View;

class Controllers extends Controller{

    public function initialize(){

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
	    $password = substr(md5(md5($encry_after.$str.$encry_before)),2,22);
	    return $password;
	}
	
	// 获得验证字符串
	public function getAuth($userinfo){
	
	    return substr(md5($userinfo->counts.$userinfo->login_ip), 0,8);
	}
	
	public function errorAction($param) {
	
	}
}
?>