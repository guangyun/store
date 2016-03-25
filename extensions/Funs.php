<?php
namespace Store\Extensions;
/**
 * 常用类
 */
class Funs
{
    /*效率太低*/
    public function getTree($data = array(),$id = 0){
		$father = $this->fetch($data,$id);
		foreach($father as $val){
			if(empty($val['children'])){
				$val['children'] = $this->fetch($data,$val['id']);
			}else{
				$this->getTree($data,$val['id']);
			}
		}
		return $father;
	}
	
	public function fetch($data = array(),$id=0){
		$new = array();
		foreach($data as $val){
			if($val['id']==$id){
				$new[] = $val;
			}
		}
		return $new;
	}

}
