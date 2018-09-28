<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/3
 * Time: 15:43
 */
//共同接口
interface db
{
    function  conn();
}

//服务端开发（不用知道将会被谁调用）
class dbmysql implements db {
    public function conn()
    {
      echo '连上了mysql';
    }
}

class dbsqlite implements db {

    public function conn()
    {
        echo '连上了sqlite';
    }
}

//客户端 看不到dbmysql dbsqlite的内部细节
//只要知道，上两个类实现了db接口
//
//$mysql = new dbmysql();
//$mysql ->conn();
//$sqlite = new dbsqlite();
//$sqlite->conn();

/**
 * 简单工厂
 * Class Factory 上面的实例还是知道的 服务端的类名 通过工厂模式来是实例化类
 */
class Factory {
    public static function createDB($type)
    {
        if($type == 'mysql')
        {
            return new dbmysql();
        }elseif ($type =='sqlite')
        {
            return new dbsqlite();
        }else{
            throw new Exception("数据库类型错误",1);
        }

    }
}

//通过是用工厂模式 现在客户端不知道服务端到底有哪些类名，只知道对方开放了一个Fabtory::createDb方法
//方法只允许传数据库类型

$db = Factory::createDB('mysql');

$db->conn();

//如果新增oracle 类型 还需要修改 Factory的内容 （java C++ 还需要重新编译）
//在面向对象设计法则中重要的开闭原则，对于修改是封闭的，只能通过增加子类


























