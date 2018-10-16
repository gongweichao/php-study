<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/10/9
 * Time: 13:38
 */

/**
 * 冒泡
 */

function Bubble ($arr){
    for ($i = 1 ; $i < count($arr);$i++)
    {
        for ($j = 0;$j<count($arr)-$i;$j++)
        {
            if($arr[$j]>$arr[$j+1])
            {
                list($arr[$j],$arr[$j+1]) = [$arr[$j+1],$arr[$j]];
            }
        }

    }
    return $arr;
}

/**
 * 选择排序
 */

function Select($arr)
{
    for ($i=0;$i<count($arr);$i++)
    {
        $min =  $i;
        //元素开始比较
        for ($j = $i+1;$j<count($arr);$j++)
        {
            if($arr[$j]<$arr[$min])
            {
                $min = $j;
            }
        }

        if($min !=$i)
        {
            list($arr[$i],$arr[$min]) = [$arr[$min],$arr[$i]];
        }

    }
    return $arr;
}

/**
 * 插入排序
 */

function insert($arr)
{
    for ($i = 1 ;$i<count($arr);$i++)
    {


        for ($j=$i;$j>0;$j--)
        {
            if($arr[$j] > $arr[$j-1]){
                break;
            }else{

                list($arr[$j],$arr[$j-1]) = [$arr[$j-1],$arr[$j]];
            }

        }

    }
    return $arr;
}

/**
 *  快速排序
 */
function Quick($arr)
{
    $l = count($arr);
    if($l<=1){
        return $arr;
    }
    $l_arr = [];
    $r_arr = [];

    $base_num = $arr[0];
    for ($i=1;$i<$l;$i++)
    {
        if($arr[$i]>$base_num)
        {
            $r_arr[] =  $arr[$i];
        }else{
            $l_arr[] =  $arr[$i];
        }
    }
    $l_arr = Quick($l_arr);
    $r_arr = Quick($r_arr);
    return array_merge($l_arr,array($base_num),$r_arr);

}

/**
 * 归并排序
 */
function merges($arr){
     $l = count($arr);
     if($l<=1){
         return $arr;
     }else{
         $mid  = $l/2;
         $left = array_slice($arr,0 ,$mid);
         $right = array_slice($arr,$mid);
         $left = merges($left);
         $right =  merges($right);

          return mergessort($left,$right);
     }

}
function mergessort($left,$right)
{
    $res =[];
    while (count($left) && count($right))
    {
        if($left[0]>$right[0])
        {
            $res[] = array_shift($right);
        }else{
            $res[] = array_shift($left);
        }
    }
    return array_merge($res,$left,$right);
}

$arr = [3,5,2,8,10,6,1];
print_r(merges($arr));