<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/5
 * Time: 16:09
 */
class Noodle
{
    protected  $decortor = [];
    protected $price = '10';
    protected $name  = '面条';

    public function adddecortor(Decortor $decortor)
    {
        $this->decortor[] = $decortor;
    }
    public function output(){
        $m = $this->make();
        echo '这是一碗'.$m['name'].'价格：'.$m['price'];
    }

    public function  make()
    {
        $n = $this->name;
        $p = $this->price;
        foreach ($this->decortor as $dec)
        {
            $p += $dec->makeprice($p);
            $n =$dec->makename($n).$n;

        }
        return array('name'=>$n,'price'=>$p);
    }



}

abstract class Decortor
{
    abstract public function makeprice($p);
    abstract public function makename($n);

}

class material extends Decortor
{
    protected $pirce;
    protected $name;
    public function __construct($name,$pirce)
    {
        $this->name = $name;
        $this->pirce =$pirce;
    }

    public function makeprice($p){
        return $this->pirce;
    }
    public  function makename($n){
        return $this->name;
    }

}


$m = new Noodle();
$m->adddecortor(new material('鸡蛋',3));
$m->adddecortor(new material('西红柿',2));
$m->adddecortor(new material('牛肉',5));

$m->output();