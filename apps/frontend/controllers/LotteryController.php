<?php
namespace Store\Frontend\Controllers;

/*
 * 彩票管理
 */
class LotteryController extends ControllerAuth
{
    public $data = array(
        0=>array(
            'qishu'=>'2016031',
            'one'=>'03',
            'two'=>'08',
            'three'=>'10',
            'four'=>'19',
            'five'=>'23',
            'six'=>'33',
            'seven'=>'03'
        ),
        1=>array(
            'qishu'=>'2016030',
            'one'=>'10',
            'two'=>'14',
            'three'=>'19',
            'four'=>'22',
            'five'=>'25',
            'six'=>'29',
            'seven'=>'12'
        ),        
        2=>array(
            'qishu'=>'2016030',
            'one'=>'12',
            'two'=>'15',
            'three'=>'18',
            'four'=>'20',
            'five'=>'21',
            'six'=>'27',
            'seven'=>'15'
        ),        
    );
    
    public $reds;
    public $blue;
    
    public function initialize(){
        $this->reds = $this->getAllred();
    }
  
    public function indexAction()
    {
        $this->view->disable();
        $arr = $this->data;
        var_dump($this->methodOne($arr[2]));
        
    }
       
    public function methodOne($arrs = array()){
        $arr = array();
		$reds = $this->getReds($arrs);
		foreach ($reds as $val){
		    for($i=count($reds)-1;$i>0;$i--){
		        $res = abs($val-$reds[$i]);
		        if ($res!=0)
		          $arr[] = $res;
		    }
		}
		$arr = array_unique($arr);
		sort($arr);
		$res = array_diff($this->reds, $arr);
		sort($res);
		return $res;
	}
	public function methodTwo(){
		
	}
	public function methodThree(){
		
	}
	public function methodFour(){
		
	}
	public function methodFive(){
		
	}
	public function methodSix(){
		
	}
	public function methodSeven(){
		
	}
	public function methodEight(){
		
	}
	public function methodNine(){
		
	}
	public function methodTen(){
		
	}
	public function methodEleven(){
		
	}
	public function methodTwelve(){
		
	}
	public function methodThirteen(){
		
	}
	
	public function getReds($arr=array()){
	    $data = array();
	    foreach ($arr as $key=>$val){
	        if($key!='qishu' && $key!='seven'){
	            $data[] = $val;
	        }
	    }
	    return $data;
	}
	
	public function getBlue($arr = array()){
	    return $arr['seven'];
	}
	
	public function getAllred(){
	    $arr = array();
	    for($i=1;$i<34;$i++){
	        $arr[] = $i;
	    }
	    
	    return $arr;
	}
	
	public function getAllblue(){
	    $arr = array();
	    for($i=1;$i<17;$i++){
	        $arr[] = $i;
	    }
	     
	    return $arr;
	}
}

