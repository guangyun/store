<?php
namespace Store\Frontend\Controllers;

use Store\Frontend\Models\Lottery;
use Store\Extensions\HTTP;
use Phalcon\Db\RawValue;
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
            'six'=>'29',
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
            'qishu'=>'2016029',
            'one'=>'12',
            'two'=>'15',
            'three'=>'18',
            'four'=>'20',
            'five'=>'21',
            'six'=>'29',
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
        var_dump($this->methodThree($arr));

        
    }
    
    public function showAction(){
       
    }
    //七：开奖日期为下期杀号，注：如果连续准确7期必须放弃此规律，转成选号。
    //九：开奖的蓝号，乘05加02，所得的值为下期杀号。
    
   // 十：开奖的蓝号为双数时，乘上2，再加02，计算的结果在下一期不出， 到目前为止，此条件无错误。如：蓝06X2+2=14，下期红球杀14.3
    //十一：开奖第5个红球加5，所得的值为下期杀号。比较准。
    
   // 十二：34减去第一个红球，所得的值为下期杀号。
    
    //十三：34减去开奖的第三个红球，所得出来的值再加7，结果下期不会出。
    
    /**
     * ajax获得数据
     */
    public function getdataAction(){
        
        if (!empty($this->request->hasPost('qishu'))){
            $lottery =new Lottery();
            $lottery->qishu = new RawValue($this->request->getPost('qishu'));
            $lottery->kdate = $this->request->getPost('dates');
            $redstr = $this->request->getPost('redBalls');
            $bluestr = $this->request->getPost('blueBalls');
            $red = $this->getNum($redstr);
            $blue = $this->getNum($bluestr);
            $lottery->one = $red[0];
            $lottery->two = $red[1];
            $lottery->three = $red[2];
            $lottery->four = $red[3];
            $lottery->five = $red[4];
            $lottery->six = $red[5];
            $lottery->seven = $blue[0];
            
            if ( $lottery->save() ){
                echo $_GET['jsoncallback']."(insert a data)";
            }else{
                echo 'failed';
            }
        }else{
            echo "no data";
        }
        $this->view->disable();       
    }
    
    public function contentAction(){
        $this->assets->addJs("/js/data.js");
        $str = HTTP::get("http://baidu.lecai.com/lottery/draw/list/50?type=latest&num=50");
        preg_match("/<!--双色球历史开奖列表 S-->([\S\s]+)<!--双色球历史开奖列表 E-->/", $str,$arr);
        $this->view->content = $arr[1];
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
	
	/*计算红球各个位数的和*/
	public function methodTwo($arr){
	    $blues = $this->getReds($arr);
	    $arr = array();
	    foreach ($blues as $val){
	        $new = str_split($val);
	        $arr = array_merge($new,$arr);
	    }
	    
	    return array_sum($arr)>33?42-array_sum($arr):array_sum($arr);		
	}
	//杀掉连续出现3次的
	public function methodThree($data){
	    $arr = array();
		foreach($data as $val){
		    foreach ($val as $v){
		        $arr[] = $v;
		    }
		}
		$contain = array();
		$count = array();
		foreach($arr as $v){
		    if (array_key_exists($v, $contain)){
		        $contain[$v]++;
		        if ($contain[$v]>=3){
		            $count[] = $v;
		        }
		    }else {
		        $contain[$v]=1;
		    }
		}
		return $count;
	}
	//54减去第三个红球
	public function methodFour($arr){
		return 54-$arr['three'];
	}
	//开奖红球最大的号码减去红球最小的号码，所得的值为下期杀号
	public function methodFive($arr){
	    $data = $this->getReds($arr);
	    return max($data)-min($data);
	}
	//最大的红球减去当期蓝球，所得的值为下期杀号
	public function methodSix($arr){
	    $data = $this->getReds($arr);
	    return max($data)-$arr['seven'];
	}
	//开奖的号码总和加起的结果拆分再加，所得的值为下期杀号。如：总和为114的，1+1+4=6.  那么.6为下期杀号。
	public function methodSeven($arr){
		unset($arr['qishu']);
		$num = array_sum($arr);
		$arr = str_split($num);
		return array_sum($arr);
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

?>