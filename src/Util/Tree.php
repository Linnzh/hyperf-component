<?php

namespace Linnzh\HyperfComponent\Util;

class Tree
{
    /**
     * 树形结构转二维数组
     *
     * @param array $tree
     *
     * @return array
     */
    public static function toArray(array $tree)
    {
        $queen = $out = [];

        $queen = array_merge($queen, $tree);
        $count = count($queen);

        while ($count > 0) {
            $first = array_shift($queen);
            $queen = array_merge($queen, $first['children']);
            unset($first['children']);
            $out[] = $first;
            $count = count($queen);
        }

        return $out;
    }


    /**
     * 二维数组转树形结构
     * 
     * @param array  $result
     * @param int    $level
     * @param string $pidKeyName
     *
     * @return array
     */
    public static function toTree(array $result, int $level = 1, string $pidKeyName = 'pid'): array
    {
        // 预先找出那些顶级
        $tops = [];
        $ids = array_column($result, 'id');
        foreach ($result as $key=>$item) {
            if (!in_array($item[$pidKeyName], $ids, true)) {
                $tops[] = $item;
            }
        }

        $list = [];
        foreach ($tops as $item) {
            $tree = static::recursion($result, $item[$pidKeyName]);
            $list = array_merge($list, $tree);
        }

        return $list;
    }

    public static function recursion(array $list, int $pid = 0, int $level = 1, string $pidKeyName = 'pid'): array
    {
        $out = [];

        foreach ($list as $node) {
            if ($node[$pidKeyName] == $pid) {
                $node['level'] = $level;
                $children = static::recursion($list, $node['id'], $level + 1, $pidKeyName);
                $node['children'] = $children;
                $out[] = $node;
            }
        }

        return $out;
    }
}