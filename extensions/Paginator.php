<?php
namespace Store\Extensions;

use Phalcon\Http\Request;
/**
 * 常用类
 */
class Paginator
{
    //显示的页码个数
    public $buttons;
    //总页数
    public $total;
    //每页显示的条数
    public $limit;
    //起始值
    public $start;
    //model对象
    protected $obj;
    //当前页
    protected $current;
    
    public $url;
    
    public  $condition;
    
    
    
    public function __construct($obj,$config=array(),$condition=array()) {
        if (empty($config)){
            $this->buttons = 10;
            $this->limit = 20;
        }else{
            $this->buttons = $config['buttons'];
            $this->limit = $config['limit'];
        }
        $this->condition = $condition;
        $this->obj = $obj;
        $this->current = isset($_REQUEST['page'])?intval($_REQUEST['page']):1;
        $this->url = $this->getUrl();
    }
    
    public function getPages(){
        $count = $this->obj->find()->count();
        $this->total = round($count/$this->limit);
        $center = ceil($this->buttons/2);
        $start = $this->buttons>$this->total?1:($this->current-$center);
        $start = $start<=1?1:$start;
        $end = $this->buttons>$this->total?$this->total:($this->current+$center);
        $html = '';
        for($i=$this->start;$i<$end;$i++){
            $active = $i==$this->current?"class='selected'":'';
            $html .= "<li ".$active."><a href='".$this->url.$i."'>".$i."</a></li>";
        }
        return $html;
       
    }
    
    public function getPre($str=""){
        $str = !empty($str)?$str:"pre";
        $page = $this->current - 1;
        if ($page<=1){
            $page = 1;
        }
        return "<li class='pre'><a href=".$this->url.$page.">".$str."</a></li>";
    }
    
    public  function getNext($str=""){
        $str = !empty($str)?$str:"next";
        $page = $this->current+1;
        if ($page>$this->total){
            $page= $this->total;
        }
        return "<li class='next'><a href=".$this->url.$page.">".$str."</a></li>";
    }
    
    public  function getFirst($str=""){
        $str = !empty($str)?$str:"first";
        return "<li class='firsrt'><a href='".$this->url."1'>".$str."</a></li>";
    }
    
    public  function getLast($str=""){
        $str = !empty($str)?$str:"last";
        return "<li class='last'><a href='".$this->url.$this->total."'>".$str."</a></li>";
    }

    public  function getTotal() {
        $obj = $this->obj;
        return $obj::find($this->condition)->count();
    }
    
    public function getItems(){
        $condition = $this->condition;
        $obj = $this->obj;
        $page = $this->current*$this->limit;
        $condition = array_merge($condition,array('limit'=>array('number'=>$page,'limit'=>$this->limit)));
        return $obj::find($condition)->toArray();
    }
    
    public function getUrl(){
        $req = new Request();
        $param = $req->get();
        $url = $param['_url'];
        unset($param['_url']);        
        if (isset($param['page'])){
            unset($param['page']);
        }
        $pstr = http_build_query($param);
        $sysbol = "&";
        if (empty($pstr)){
            $sysbol = "?";
        }
        return $url.$pstr.$sysbol."page=";
    }
    
    public function showpage($config = array()) {
        $html = "<ul id='pages'>";
        if (empty($config)){
            $html .= $this->getFirst().$this->getPre().$this->getPages().$this->getNext().$this->getLast();
        }else{
            foreach ($config as $key=>$val){
                $html .= $this->$key($val);
            }
        }        
        $html .= "</ul>";
        if($this->total>$this->limit){
            return $html;
        }else{
            return '';
        }
    }
}
