<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/29
 * Time: 9:32
 * 约瑟夫问题：射编号为1，2，...n的n个人围坐一圈，约定编号为k（1<=k<=n）的人从1开始报数，数到m的那个人出列
 * ，它的下一位又从1开始报数，数到m的那个人又出列，依次类推，直到所有人出列为止，由此产生一个出队编号的序列。
 * 并求出最后出列的人是哪个？(和丢手帕差不多)
 *
 * 使用环形链表来解决
 */

/**
 * Class Child
 * 构建节点  每个节点相当于一个小朋友
 */
class Child
{
    /**
     * @var 小孩子编号
     */
    public $no;
    public $next = null;
    public function __construct($no)
    {
        $this->no = $no;
    }
}

class Josephu
{
    public $head = null;
    /**
     * @var 小朋友数量
     */
    public $n;
    public function __construct($n)
    {
        $this->n = $n;
        $this->head = new Child(null);
        /**
         * 生成环形链表
         */

        $this->addChild();
    }

    /**
     * 定义一个环形链表  让head指向第一个小朋友
     */
     public function addChild(){
         /**
          *头节点不能去动  所以让cur去做操作;
          * cur表示当前的指针
          */
        $cur  = $this->head;
        for($i = 0;$i<$this->n;$i++)
        {
            /**
             * 因为小孩的编号是从1 开始的 所以要+1
             */
            $child =  new Child($i+1);
            /**
             * 第一个小孩 要自己指向自己
             * 就是head 和cur 指向同一个节点
             */
            if($i==0){
                $this->head = $child;
                $this->head->next = $child;
                $cur = $this->head;
            }else{
                //当前的指针指向新节点
                $cur->next = $child;
                //新节点指向head 头结点形成环
                $child->next = $this->head;
                $cur = $cur->next;
            }

        }
     }


     public function showChild()
     {
         $cur = $this->head;
         while ($cur->next!=$this->head)
         {
             echo "小孩的编号为".$cur->no;
             echo PHP_EOL;
             $cur = $cur->next;
         }
         //上面的while 结束是 当前指针指向最后一个节点 还需要处理
         echo "小孩的编号为".$cur->no;
     }

    /**
     * @param $k 从第几个小孩开始数
     * @param $m 数到几出列
     */
     public function count($k,$m)
     {
         /**
          * 因为单链表是不能直接把自己给删除了（不知道上一个节点）
          * 所以我们就需要定义一个指针来指向他的上一个节点
          * 定义一个指针
          * 让$tail 指向$this->>head; 就是让$head 比$tail多走一步
          *
          */
         $tail  =  $this->head;
         //循环介素  tail 就是指向head de上一个节点 就是最后一个小孩子
         while($tail->next!=$this->head)
         {
             $tail = $tail->next;
         }
         /**
          * 先找到第K个小朋友
          * 因为指针移动一次，相当于数2下 因为本身也要数一下 所以k-1
          * 让head 和tail 向后移 指向第K个小朋友
          */
         for($i=0;$i<$k-1;$i++){
            $tail = $tail->next;
            $this->head = $this->head->next;
         }
//         echo PHP_EOL;
//         echo $this->head->no;
         /**
          * 如果2个相同就说明只剩下最后一个节点了
          */
        while ($tail!=$this->head){
            for ($i=0;$i<$m-1;$i++)
            {
                $this->head = $this->head->next;
                $tail = $tail->next;
            }
            echo PHP_EOL;
            echo "出去的小朋友的编号为".$this->head->no;

            $this->head = $this->head->next;
            $tail->next = $this->head;

        }
         echo PHP_EOL;
         echo "最后小朋友的编号为".$this->head->no;



     }


}

$a = new Josephu(5);
$a->showChild();
$a->count(3,3);
