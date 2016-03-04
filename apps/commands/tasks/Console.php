<?php
use Phalcon\Cli\Task;
class Console extends Task
{
    public function getIp(){
        $ip = '192.168.11.123';
        echo $ip;
    }
}