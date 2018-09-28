<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/4
 * Time: 13:25
 * php实现观察者模式
 *
 */

//php 5+ 中提供了观察者obsever 和被观察者subject的接口 Splsubject

/**
 * Class user
 */
class  user implements SplSubject {

    public $lognum;

    public $username;
    public $hoddy;
    //存放观察者
    public $obsevers =null;

    public function __construct($username,$hoddy)
    {
        //模拟登陆次数
        $this->lognum = rand(1,10);
        $this->hoddy = $hoddy;
        $this->username = $username;
        /**
         * SplObjectStorage类实现了以对象为键的映射（map）或对象的集合（如果忽略作为键的对象所对应的数据）这种数据结构。
         * 这个类的实例很像一个数组，但是它所存放的对象都是唯一的。这个特点就为快速实现 Observer 设计模式贡献了不少力量，
         * 因为我们不希望同一个观察者被注册多次。该类的另一个特点是，可以直接从中删除指定的对象，而不需要遍历或搜索整个集合。
         */
        $this->obsevers = new SplObjectStorage();
    }
    public function login (){
        //验证密码等等

        //通知观察者
        $this->notify();
    }

    /**
     * @param SplObserver $observer
     * 添加观察者
     */
    public function attach(SplObserver $observer)
    {
        $this-> obsevers->attach($observer);
    }

    /**
     * @param SplObserver $observer
     * 删除观察者
     */
    public function detach(SplObserver $observer)
    {
       $this->obsevers->detach($observer);
    }

    /**
     *遍历所有观察者 并通知他们进行改变
     */
    public function notify()
    {
        $userInfo = array();
        $userInfo['username'] = $this->username;
        $userInfo['hoddy'] = $this->hoddy;

        foreach($this->obsevers as $obsever){
            //func_get_arg() 在php 中 只要给的参数不少于要求的参数，那么多余的参数就可以用func_get_arg()来获取
            // 例如 update 要求穿当前对象，可以后跟一个参数，下面用func_get_arg()来接收

            $obsever->update($this,$userInfo);
        }
    }
}

/**
 * ad 和seaf 为观察者，实现了SplObserver接口的update 方法
 */
class ad implements SplObserver{
    public function update(SplSubject $subject)
    {
        $userInfo = func_get_arg(1);
       echo $userInfo['username'].'根据您的爱好我们将为您推送一下关于'.$userInfo['hoddy'].'的广告<br>';
    }
}

class seaf implements SplObserver{
    public function update(SplSubject $subject)
    {
        $userInfo = func_get_arg(1);
        if($subject->lognum >3){
            echo $userInfo['username'].'您的登录次数为'.$subject->lognum.'账号存在多次登录的风险<br>';
        }else{
            echo $userInfo['username'].'您的登录次数为'.$subject->lognum.'登录安全<br>';

        }
     }
}

$user = new user('龚伟超','足球');
$user->attach(new ad());
$user->attach(new seaf());
$user->login();
