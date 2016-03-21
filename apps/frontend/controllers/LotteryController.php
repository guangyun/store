<?php
namespace Store\Frontend\Controllers;

use Store\Frontend\Models\Lottery;
/*
 * 彩票管理
 */
class LotteryController extends ControllerBase
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
    
    public function showAction(){
       
    }
    
    /**
     * ajax获得数据
     */
    public function getdataAction(){
        
        if (!empty($this->request->hasQuery('qishu'))){
            $lottery =new Lottery();
            $lottery->qishu = $this->request->getQuery('qishu');
            $lottery->kdate = $this->request->getQuery('dates');
            $redstr = $this->request->getQuery('redBalls');
            $bluestr = $this->request->getQuery('blueBalls');
            $red = $this->getNum($redstr);
            $blue = $this->getNum($bluestr);
            $lottery->one = $red[0];
            $lottery->two = $red[1];
            $lottery->three = $red[2];
            $lottery->four = $red[3];
            $lottery->five = $red[4];
            $lottery->six = $red[5];
            $lottery->seven = $blue[0];
            
            if ( $lottery->create() ){
                echo $_GET['jsoncallback']."(insert a data)";
            }
        }else{
            echo "no data";
        }
        $this->view->disable();
        
    }
    
    public function getNum($str=""){
        $arr = array();
        preg_match_all("/<\/?\w+>(\d+)/i",$str,$arr);
        if(empty($arr)){
            echo "error";
            return false;
        }
        if(count($arr[1])==2){
            $blue = "";
            foreach($arr[1] as $val){
                $blue .= $val.",";
            }
            return trim($blue,",\t\n\r");
        }
        return $arr[1];
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

