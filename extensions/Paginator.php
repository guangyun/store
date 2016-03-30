<?php
namespace Store\Extensions;

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
    
    public $html;
    
    
    public function __construct($obj,$config=array()) {
        if (empty($config)){
            $this->buttons = 10;
            $this->limit = 20;
        }
        $this->buttons = $config['buttons'];
        $this->limit = $config['limit'];
        $this->obj = $obj;
        $this->html = "<ul id='pages'>";
        $this->current = intval($_REQUEST['page']);
    }
    
    public static function getPages(){
        $count = $this->obj->find()->count();
        $this->total = round($count/$this->limit);
        $center = ceil($this->buttons/2);
        $start = $this->buttons>$this->total?1:($this->current-$center);
        $start = $start<=1?1:$start;
        $end = $this->buttons>$this->total?$this->total:($this->current+$center);
        for($i=$this->start;$i<$end;$i++){
            $active = $i==$this->current?"class='selected'":'';
            $this->html .= "<li ".$active."><a href='".$url.$i."'>".$i."</a></li>";
        }
    }
    
    public static function getPre(){
        
    }
    
    public static function getNext(){
        
    }
    
    public static function getFirst(){
        
    }
    
    public static function getLast(){
        
    }

    public static function getTotal() {
        
    }
    
    public static function getItems(){
        
    }
    
    public static function getUrl(){
        
    }
}
