<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/4
 * Time: 16:44
 */

//面向过程的处理方法
/**
class banzhu{
    public  function  handle(){
        echo "删帖";
    }
}

class admin{
    public  function  handle(){
        echo "封号";
    }
}

class police {
    public  function  handle(){
        echo "抓起来";
    }
}

$lev = intval($_GET['lev']);
if($lev == 1){
    $man = new  baozhu();
    $man->handle();
}else if ($lev = 2){

    $man = new  admin();
    $man->handle();

}else{
    $man = new  police();
    $man->handle();
}
 *
 *
 **/
//责任链模式来解决

/**
 * Class power
 * 定义公共父类 用来判断当前权限是否能处理，不能处理交给上一级处理
 */
 class power {
     //上一级
     public $toper =null;
     public function proc($lev){
         if($lev <= $this->power) {
            $this->handle();
         } else {
             //权限不足 移交给上一级处理
             $this->toper = new $this->top;
             $this->toper->proc($lev);
         }

     }
 }

 //具体处理者 $power 为权限等级  $top 为上一级处理者
class BanZhu extends power {
     protected $power =1;
     protected $top = 'admin';
    protected  function  handle(){
        echo "删帖";
    }
}

class admin extends power {
     protected $power = 2;
     protected $top = 'police';
    protected   function  handle(){
        echo "封号";
    }
}

class police extends power {
     protected $power = 3;
     protected $top =null;
     protected  function  handle(){
        echo "抓起来";
    }
}

$lev = intval($_GET['lev']);

 $man = new BanZhu();
 $man->proc($lev);
