<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/10/17
 * Time: 13:32
 */

/**
 * 两数之和 01
 * @param $nums 给定的数组
 * @param $target 和
 */

function twoSum($nums,$target)
{
    $arr = array();
    for ($i=0;$i<count($nums);$i++)
    {
        $n = $target - $nums[$i];
        if(in_array($n,$arr)){
            return array(array_search($n,$arr),$i);
        }
        if(!in_array($nums[$i],$arr)){
            $arr[] =  $nums[$i];
        }
    }
    var_dump($arr);
    var_dump(in_array(7,$arr));
}

//var_dump(twoSum([2,7,9,11],11));
/**
 * 回文数
 * @param $num
 * @return bool
 */
function isPalindrome($num)
{
    $arr = str_split($num);
    $arr1 = array_reverse($arr);
    if($arr == $arr1){
        return true;
    }else{
        return false;
    }
}

//var_dump(isPalindrome(12211));
/**
 * @param $str 只包含括号的字符串
 */
function isValid($str)
{
    $stack = new  SplStack();
    $arr = str_split($str);

    foreach ($arr as $v){
        if($v == '('){
            $stack->push(')');
        }elseif ($v == '{'){
            $stack->push('}');

        }elseif($v == '[')
        {
            $stack->push(']');
        }elseif($stack->count()==0 || $stack->pop() !=$v){
          return false;
        }
    }
    if($stack->count()==0) {
        return true;
    } else{
        return false;
    }
}
var_dump(isValid('{}[]([)]'));