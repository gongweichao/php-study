<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/3
 * Time: 16:20
 */
//共同接口
interface db
{
    function  conn();
}

/**
 * Interface Factory 工厂方法
 */
interface Factory
{
    function  createDb();
}

//服务端开发（不用知道将会被睡调用）
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
// 实现工厂方法
class  mysqlFactory implements Factory
{
    public function createDb()
    {
        return new dbmysql();
    }
}

class sqliteFactory implements  Factory
{
    public function createDb()
    {
        // TODO: Implement createDb() method.
        return new dbsqlite();
    }

}

/**
 * 如果这个时候需要添加oracle 连接  不需要修改代码 只需要新增类
 *先添加oracle 实现类
 * 再实现oracle 工厂方法
 *
 */
class dboracle implements db
{
    public function conn()
    {
        // TODO: Implement conn() method.
        echo "连接上了oracle";
    }
}

class oracleFactory implements Factory
{
    public function createDb()
    {
        // TODO: Implement createDb() method.
        return new dboracle();
    }
}


//客户端实现

$f = new oracleFactory();
$db = $f->createDb();
$db ->conn();