<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/5
 * Time: 11:05
 * 策略模式实现一个超市打折
 *
 * 理解：策略模式就是封装一个公共抽象算法  具体的类来实现这个借口，最后定义一个策略工厂类来调用具体的算法类
 *
 *
 *
 */

/**
 * Class SupermarketActivity
 * 抽象一个超市活动类 抽象一个具体活动规则
 */
abstract class SupermarketActivity {
    abstract public function doAction($money);
}

//具体实施者

/**
 * Class discount
 * 打折算法策略
 */
class discount extends  SupermarketActivity {

    public $sale;

    /**
     * discount constructor
     * @param $sale 折扣力度
     */
    public function __construct($sale)
    {
        $this->sale = $sale;
    }
    public function doAction($money)
    {
        echo '原价'.$money.',活动打'.$this->sale.'折，现价'.round($money*$this->sale,2);
    }

}

/**
 * Class manjian
 * 满减算法策略
 */
class manjian extends SupermarketActivity {

    public $sale ;

    /**
     * manjian constructor.
     * @param $sale 满减金额
     */
    public function __construct($sale)
    {
        $this->sale =$sale;
    }

    public function doAction($money)
    {
        $nowpice = $money-$this->sale;
        echo '原价'.$money.'活动减'.$this->sale.',现价'.$nowpice;
    }
}

//策略工厂
class  strategy
{
    public  $strategy = null;

    /**
     * strategy constructor.
     * @param SupermarketActivity $obj 初始化传入具体策略
     */
    public function __construct(SupermarketActivity $obj)
    {
        $this->strategy = $obj;
    }

    public function todo($money){
        $this->strategy->doAction($money);
    }


}


/**
 * 测试
 *
 */

$act = new strategy(new discount('0.8'));
$act->todo(500);

echo '<br>';

$act1 = new strategy(new manjian(390));
$act1->todo(1000);


























