<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/27
 * Time: 15:37
 */

/**
 * Class Node
 */
class Node
{
    public $data;
    public $next;
    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }
}

class SingleLinkedList
{
    public $header;

    public function __construct()
    {
        $this->header = new Node(null);
    }

    /**
     * 头插入
     * @param $data
     */
    public function lpush($data)
    {
        $cur  = $this->header->next;
        $newheader = new Node($data);
        $newheader->next = $cur;
        $this->header->next = $newheader;

    }

    /**
     * @param $data
     * 尾插入
     */
    public function rpush($data)
    {
        $newheader = new Node($data);

        $cur = $this->header->next;

        while ($cur->next!=null)
        {
            $cur = $cur->next;
        }
        $cur->next = $newheader;

    }

    /**
     *
     * @param $n 第几个节点插入
     * @param $data
     */
    public  function push($n,$data)
    {
        $cur = $this->header->next;
        $j = 0;//计数器
        if($n==0){
            $this->lpush($data);
        }else{
            while ($cur->next && $j<$n-1)
            {
                $cur = $cur->next;
                $j++;
            }
            if($cur==null)
            {
                echo "没有".$n.'节点';
            }else{
                $new = new Node($data);
                $new->next = $cur->next;
                $cur->next = $new;
            }
        }

    }

    /**
     * @param $n 要删除的节点
     * @return mixed
     */
    public function del($n){
        $cur = $this->header->next;
        if($n<0){
            echo '参数不合法';exit;
        }
        $j =0;
        if($n==0){
            $this->header = $cur->next;
            return $cur->data;

        }else{
            while ($cur->next!=null&&$j<$n-1){
                $cur = $cur->next;
                $j++;
            }
            if($cur->next == null){
                echo 1111111;
            }else{
                $curs = $cur->next;
                $cur->next = $curs->next;
                $res = $curs->data;
                unset($curs);
                return $res;
            }
        }

    }

    public  function  delAll()
    {
        $cur = $this->header->next;
        while ($cur->next != null)
        {
            $a =$cur->next;
            unset($cur);
            $cur = $a;
        }
        $this->header = new Node(null);
    }

    public function show()
    {
       $cur = $this->header->next;
       if($cur==null){
           echo "kong ";
       }else{
           while(!is_null($cur->next)){

               echo $cur->data;
               echo PHP_EOL;
               $cur = $cur->next;
           }
           echo $cur->data;
       }

    }
    //

}
$a  =  new SingleLinkedList();
$a->lpush('张三');
$a->rpush('王五');
$a->push('1','龚六');
$a->push('2','赵七');
$a->del('4');
$a->delAll();
$a->show();
