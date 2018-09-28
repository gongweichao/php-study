<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/3
 * Time: 15:33
 * 单例模式
 */

//普通类
//class sigle
//{
//
//}
//
//$s1  =new sigle();
//$s2 = new sigle();
////2个对象是一个的时候，才全等
//
//if($s1 === $s2 ){
//    echo "是一个对象";
//}else{
//    echo "不是一个对象";
//}

// 封锁new操作

//class  sigle
//{
//    protected  function __construct()
//    {
//
//    }
//}
//
//$s1  =new sigle(); //这时就不能new对象

// 留个接口来new对象
//
//class sigle
//{
//    protected  function __construct()
//    {
//
//    }
//    public  static  function getIns(){
//        return new self();
//    }
//}
//$s1  =sigle::getIns();
//$s2 = sigle::getIns();
////2个对象是一个的时候，才全等
//
//if($s1 === $s2 ){
//    echo "是一个对象";
//}else{
//    echo "不是一个对象";
//}
 //还不是一个对象


//如果getIns 判断实例
class sigle{
    protected static $ins = null;
    public static function getIns(){
        if(self::$ins ==null){
            self::$ins == new self();
        }
        return self::$ins;
    }
    // 这个时候加一个final  防止继承类不能覆盖构造方法   防止子类构造方法为public 时 可以new多个对象
   final protected function __construct()
    {

    }
    //到这还可以通过clone 来产生对象 所以可以将clone 直接封闭 不让进行clone
    final protected  function  __clone()
    {
        // TODO: Implement __clone() method.
    }
}
$s1  =sigle::getIns();
$s2 = sigle::getIns();
//2个对象是一个的时候，才全等

if($s1 === $s2 ){
    echo "是一个对象";
}else{
    echo "不是一个对象";
}
//这个时候是一个对象。说明只new 了一次对象




























