<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/5
 * Time: 15:29
 */

//食物   抽象产品
abstract class Food
{
    abstract function price();
    function getDesc(){
        return $this->desc;
    }
}

//面条 具体的产品
class Noodle extends Food
{
    public $desc = "面条";
    public function price()
    {
        return 10;
    }
}

//抽象修饰者
abstract class Decortor extends Food
{
    public $food = null;
    public function __construct(Food $food)
    {
        $this->food = $food;
    }
}
//具体修饰者
class AddEgg extends Decortor
{
    public function price()
    {
            return $this->food->price() +2;
    }
    public  function getDesc()
    {
            return $this->food->getDesc()."这是加了鸡蛋";
    }
}
class AddTomato extends Decortor
{
    public function getDesc()
    {
        return $this->food->getDesc()."这是加了西红柿";
    }
    public function price()
    {
        return $this->food->price() +5;
    }
}

$m = new Noodle();
$m  = new AddEgg($m);
$m = new AddTomato($m);
echo $m->getDesc();
echo $m->price();