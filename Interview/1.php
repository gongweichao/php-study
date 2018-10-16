<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/10/8
 * Time: 9:51
 * PHP面试题
 */

/**
 *  1 echo (int)((0.1+0.7)*10);  输出结果并说明原因
 *
 * 7
 * 你看似有穷的小数, 在计算机的二进制表示里却是无穷的
 * echo serialize((0.1+0.7)*10)/d:0.79999999999999993
 */

/**
 *2 熟悉的5种设计模式及用单例模式建立一个数据库连接
 *
 */

class db
{
    private static $_instance;
    private  $link;
    private function __construct($host,$user,$pwd,$dbname)
    {
        $this->link =  mysqli_connect($host,$user,$pwd,$dbname);
        mysqli_query($this->link,"SET NAMES 'utf8'");

        return $this->link;
    }
    private function  __clone()
    {
        // TODO: Implement __clone() method.
    }

    static  public function  getIntance($host,$user,$pwd,$dbname){
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self($host,$user,$pwd,$dbname);
        }
        return self::$_instance;
    }
}

/**
 * 3  冒泡排序 大的在前
 */
//$arr  = [1,23,7,12,32,4,9];
//for($i=1;$i<=count($arr);$i++)
//{
//    for ($j=0;$j<=$i;$j++){
//        if($arr[$j]<$arr[$j+1])
//        {
//            list($arr[$j+1],$arr[$j]) = [$arr[$j],$arr[$j+1]];
//        }
//
//    }
//}
//var_dump($arr);
//$arr = [1,2,3];
//var_dump(array_filter(explode(',',str_repeat(implode(',',$arr).',',3))));

$num  = 10;
function multiply($num)
{
    $num =  $num * 10;
}
multiply($num);
echo $num;



