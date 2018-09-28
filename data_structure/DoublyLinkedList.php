<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/28
 * Time: 14:36
 */

/**
 * Class Node
 * 定义链表节点
 */
class Node
{
    /**
     * @var 前指针
     */
    public $pre = null;
    /**
     * @var 后指针
     */
    public $next= null;
    /**
     * @var 节点数
     */
    public $key= null;
    /**
     * @var 节点值
     */
    public $data= null;

   public function __construct($key ,$data)
    {
        $this->data = $data;
        $this->key =$key;
        $this->pre = null;
        $this->next = null;
    }
}


class DoublyLinkedList
{
    /**
     * @var 头节点
     */
    public $head;
    /**
     * @var 尾节点
     */
    public $tail;
    /**
     * @var 当前节点
     */
    public $current;
    /**
     * @var 节点长度
     */
    public $len;

    /**
     * DoublyLinkedList constructor.\
     * 链表的初始化
     */
    public function __construct()
    {
        $this->head = $this->tail= new StdClass;
        $this->len = 0;
    }

    /**
     * @param $key
     * @param $data
     * 头部插入
     */
    public function lpush($key,$data)
    {

        $newNode =  new Node($key,$data);

        $newNode->next = $this->head;
        $this->head->pre->next = $newNode;
        $this->head->pre= $newNode;
        $this->head = $newNode;
        $this->len++;
        if($this->tail === NULL){
            $this->tail = $this->head;
        }
        //var_dump($this->head->pre->next);
    }

    /**
     * @param $key
     * @param $data
     * 尾部插入
     */
    public function rpush($key,$data)
    {

    }

    public function getAll(){
        if($this->len == 0){
            echo '链表为空';
        } else {
            $tmp = $this->head;
            while($tmp !== NULL){
                var_dump($tmp->key, $tmp->data);
                $tmp = $tmp->next;
            }
        }
    }
}

$a = new DoublyLinkedList();
$a->lpush('1','张三');
$a->getAll();

