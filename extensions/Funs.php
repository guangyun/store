<?php
namespace Store\Extensions;

/**
 * 常用类
 */
class Funs
{

    public static  function genTree5($items)
    {
        foreach ($items as $item)
            $items[$item['pid']]['son'][$item['id']] = &$items[$item['id']];
        return isset($items[0]['son']) ? $items[0]['son'] : array();
    }

    /**
     * 将数据格式化成树形结构
     * 
     * @author Xuefen.Tong
     * @param array $items            
     * @return array
     */
    public static function genTree9($items)
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
