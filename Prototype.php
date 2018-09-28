<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/5
 * Time: 13:37
 * 原型模式
 *
 */

class  draw
{
    protected $height;
    protected $width;
    protected $graph;
    protected  $data;

    public function __construct($height = '10',$width='30',$graph= '0')
    {
        $this->height = $height;
        $this->width = $width;
        $this->graph = $graph;
    }

    public function init(){
        $data = array();
        for ($i =0 ; $i<= $this->height;$i++)
        {
            for ($j =0 ;$j<=$this->width;$j++)
            {
                $data[$i][$j] = $this->graph;
            }
        }
        $this->data = $data;
    }

    public function draw()
    {
        foreach ($this->data as $d1)
        {
            foreach ($d1 as $d2)
            {
                echo $d2;
            }
            echo '<br>';
        }
    }

    public function shape($a,$b,$c,$d){

        foreach ($this->data as $k1 =>$d1)
        {
            if($k1<$a || $k1 >$b) continue;
            foreach ($d1 as $k2 =>$d2)
            {
                if($k2<$c || $k2>$d) continue;
                $this->data[$k1][$k2] = '1';
            }
        }


    }

    public function clone1()
    {
        // TODO: Implement __clone() method.
        return clone $this;
    }

}

/**
 * //原型模式 就是实例化一个原型  然后通过clone 来创建新对象
 * 因为有的时候 实例化一个类  需要多个步骤才能完成对象的创建，如果在重新实例化 这些步骤就需要多次执行
 * 而原型模式 先将这些步骤 执行完 ，直接复制 ，可省去很多步骤；
 */

$a = new draw();
$a->init();

$a2 = $a->clone1();
$a2->shape(2,8,3,20);
$a2->draw();

echo "_____________________________________<br>".PHP_EOL;

$a3 = $a->clone1();
$a3->shape(2,8,3,23);
$a3->draw();