<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/28
 * Time: 14:36
 */

class Hero
{
    //前驱
    public $pre = null;
    //后继
    public $next = null;
    public $no;
    public $name;
    public function __construct($no='',$name='')
    {
        $this->no = $no;
        $this->name = $name;
    }
}

class DoublyLinkedList
{
    public $head;

    public function __construct()
    {
        $this->head = new Hero();
    }

    /**
     * @param $no 英雄排名
     * @param $name 英雄名字
     */
    public function addHero($no,$name){
        $newHero = new Hero($no,$name);
        $cur =$this->head;
        $isExits = false;
        while ($cur->next !=null)
        {
            if($cur->next->no>$newHero->no){
                break;
            }else if($cur->next->no==$newHero->no){
                $isExits = true;
                echo "已存在排名";
            }
            $cur=$cur->next;
        }
        if(!$isExits)
        {
            if($cur->next !=null){
                $newHero->next = $cur->next;

            }
            $newHero->pre = $cur;

            if($cur->next !=null){
                $cur->next->pre = $newHero;
            }
            $cur->next = $newHero;
        }

    }

    public function showHero()
    {
        $cur = $this->head->next;
        while ($cur->next != null)
        {
            echo PHP_EOL;
            echo $cur->name.'排名'.$cur->no;
            $cur = $cur->next;
        }
        echo PHP_EOL;
        echo $cur->name.'排名'.$cur->no;
    }
     public function delHero($no)
     {
        $cur = $this->head->next;
        $isExits = false;
        while($cur!=null)
        {
            if($cur->no == $no)
            {
                $isExits = true;
                break;
            }

            $cur = $cur->next;
        }
        if($isExits)
        {
            if($cur->next!=null){
                $cur->next->pre = $cur->pre;
            }
           $cur->pre->next=$cur->next;

            echo PHP_EOL.'要删除的英雄编号是'.$cur->no;
        }else{
            echo PHP_EOL;
            echo '没有改英雄';
        }
     }

}

$a = new DoublyLinkedList();
$a->addHero(1,'宋江');
$a->addHero(2,'卢俊义');
$a->addHero(6,'林冲');
$a->addHero(3,'吴用');
$a->delHero(3);
$a->showHero();



