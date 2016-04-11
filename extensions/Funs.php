<?php
namespace Store\Extensions;

/**
 * 常用类
 */
class Funs
{

    public static  function getTree5($items)
    {
        $tree = array();
        foreach ($items as $item){
            $tree[$item['id']] = $item;
            $tree[$item['id']]['son'] = array();
        }
        foreach ($tree as $k=>$i){
            if($i['pid']!=0){
                $tree[$i['pid']]['son'][] = &$tree[$k];
                unset($tree[$k]);
            }
        }
        return $tree;
       
    }

    /**
     * 将数据格式化成树形结构
     * 
     * @author Xuefen.Tong
     * @param array $items            
     * @return array
     */
    public static function getTree9($items)
    {
        $tree = array(); // 格式化好的树
        foreach ($items as $item)
            if (isset($items[$item['pid']]))
                $items[$item['pid']]['son'][] = &$items[$item['id']];
            else
                $tree[] = &$items[$item['id']];
        return $tree;
    }
}
